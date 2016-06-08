<?php
session_start();
	include 'includes/database.php';

    $antwoord = $_POST['anwser'];
    $id = $_POST['username'];
    $sql = "SELECT * FROM Gebruiker LEFT OUTER JOIN Vraag ON Vraag= vraagnummer WHERE gebruikersnaam ='$id'";
    $result = sqlsrv_query($db, $sql);
    $record=sqlsrv_fetch_array($result);
    
    $username = $record['gebruikersnaam'];
    $email = $record['Mailbox'];
    
    if($antwoord == $record['antwoordtekst'])
    {
        echo $code = rand(0, 9999999);
        $valid_on= date("Y-m-d");
        $sql= "INSERT INTO Email_validatie VALUES ('$email','$code','$valid_on')";
        sqlsrv_query($db,$sql);
        
        $url = 'http://iproject21.icasites.nl/includes/sendmail.php';
        echo $link = 'http://iproject21.icasites.nl/reset.php?code='.$code.'-'.$username;
        $body= 'Klik hier om u wachtwoord te resetten: '.$link;
        $data = 'to=' . $email . '&subject=Wachtoord%20Vergeten&body='.$body;
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        
        echo $body;
        
        header('location:loginscreen.php?reset');
    }
    else
    {
        header('location:wachtwoordvergeten.php?fout');
    }	
?>