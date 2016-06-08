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
            $body= '
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
                    color: #FFFFFF;
                    padding: 15px 32px;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
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
                            Gefeliciteerd, u bent de winnaar van de veiling: '.$titel.', u kunt contact opnemen met: <br/>'.$mailboxverkoper.' 
                            <br/>
                            Via Mijn account kunt u een review achter laten.
            
                    </div>
                </div>
            </body>
            ';
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