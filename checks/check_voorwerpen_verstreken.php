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
    echo "De looptijd van het voorwerp met nummer $voorwerpnummer is verstreken.\n";
    $sql = "SELECT TOP 1 Gebruiker,BodBedrag FROM Bod WHERE Voorwerp = $voorwerpnummer ORDER BY Bodbedrag DESC";
    $result = sqlsrv_query($db, $sql);
    $record=sqlsrv_fetch_array($result);
    
    //als er een winnende gebuiker is
    if(isset($record['Gebruiker'])){
        $winGebruiker = $record['Gebruiker'];
        $bodBedrag = $record['BodBedrag'];
        echo "Gebruiker: $winGebruiker had het hoogste bod, namelijk: $bodBedrag\n";
        $sql="UPDATE Voorwerp SET kopernaam = '$winGebruiker', verkoopprijs = $bodBedrag WHERE voorwerpnummer=$voorwerpnummer";
        echo $sql;
        sqlsrv_query($db, $sql);
    }
    else{
        echo "Er zijn geen boden op dit voorwerp\n";
    }
    $sql="UPDATE Voorwerp SET veilingGesloten = 1 WHERE voorwerpnummer=$voorwerpnummer";
    sqlsrv_query($db, $sql);
    
}

?>