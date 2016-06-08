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
        $link = 'http://iproject21.icasites.nl/reset.php?code='.$code.'-'.$username;
        
        
        
        $body = '
                <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Eenmaal Andermaal</title>
                <style>
                a {
                    float: left;
                    margin-left:20px;
                    inline: block;
                    color:#3F5FB5;
                }

                .button {
                    background-color: #3F5FB5;
                    border: none;
                    color: #FFFFFF;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    cursor: pointer;
                }

                .button:hover{
                    background-color:#FFB600;
                }
                </style>
            </head>
            <body>
                <div class="row">
                    <img src="http://iproject21.icasites.nl/Images/Logo_v1.1.png" alt="Logo" width="250px">
                        <div class="content">
                            <a href="http://iproject21.icasites.nl/index.php"class="button">Home</a></li>
                            <a href="http://iproject21.icasites.nl/mijnaccount.php"class="button">Mijn Account</a>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                                U heeft aangevraagd om u wachtwoord te resetten.
                                <br/> 
                                Klik hier om u wachtwoord te resetten: '.$link.'
                                <br/> 
                                Bent u niet u wachtwoord vergeten? Negeer dan deze mail.
                        </div>
                </div>
            </body>
                ';
        
        
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