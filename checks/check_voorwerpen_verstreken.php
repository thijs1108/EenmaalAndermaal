<?php

include('../includes/database.php');
$sql = "SELECT * FROM Voorwerp 
        WHERE veilingGesloten = 0 AND 
		looptijdeindeDag < CONVERT (date, GETDATE()) 
		OR (looptijdeindeDag = CONVERT (date, GETDATE()) 
		AND looptijdeindeTijdstip < CONVERT (time, GETDATE()))
        AND veilingGesloten = 0";
$result = sqlsrv_query($db, $sql);

//doorloop alle verstreken voorwerpen.
while($record=sqlsrv_fetch_array($result)){
    $voorwerpnummer = $record['voorwerpnummer'];
    $titel = $record['titel'];
    echo "De looptijd van het voorwerp met nummer $voorwerpnummer is verstreken.\n";
    $sql = "SELECT TOP 1 Gebruiker, BodBedrag FROM Bod WHERE Voorwerp = $voorwerpnummer ORDER BY Bodbedrag DESC";
    $result = sqlsrv_query($db, $sql);
    $record=sqlsrv_fetch_array($result);
    
    //als er een winnende gebuiker is
    if(isset($record['Gebruiker'])){
        $winGebruiker = $record['Gebruiker'];
        $bodBedrag = $record['BodBedrag'];
        echo "Gebruiker: $winGebruiker had het hoogste bod, namelijk: $bodBedrag\n";
        $sql="UPDATE Voorwerp SET kopernaam = '$winGebruiker', verkoopprijs = $bodBedrag WHERE voorwerpnummer=$voorwerpnummer";
        sqlsrv_query($db, $sql);
        //mail de gebruiker
            $sql = "SELECT mailbox FROM Gebruiker WHERE gebruikersnaam = '$winGebruiker'";
            $result = sqlsrv_query($db, $sql);
            $row= sqlsrv_fetch_array($result);
            $mailboxwinnaar = $row['mailbox'];
            $sql = "SELECT mailbox FROM Gebruiker INNER JOIN Voorwerp ON verkopernaam = Gebruiker.gebruikersnaam WHERE Voorwerp.voorwerpnummer=$voorwerpnummer";
            $result = sqlsrv_query($db, $sql);
            $row= sqlsrv_fetch_array($result);
            $mailboxverkoper = $row["mailbox"];
            $url = 'http://iproject21.icasites.nl/includes/sendmail.php';
            $body= "Gefeliciteerd, u bent de winnaar van de veiling: '$titel', u kunt contact opnemen met: $mailboxverkoper";
            $data = 'to=' . $mailboxwinnaar . '&subject=Gewonnen&body='.$body;
            echo "er is een mail gestuurd naar: $mailboxwinnaar \n";
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $ch, CURLOPT_HEADER, 0);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec( $ch );

    }
    else{
        echo "Er zijn geen boden op dit voorwerp\n";
    }
    $sql="UPDATE Voorwerp SET veilingGesloten = 1 WHERE voorwerpnummer=$voorwerpnummer";
    sqlsrv_query($db, $sql);
    
}

?>