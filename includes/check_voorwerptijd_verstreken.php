<?php
include('database.php');
$sql = "SELECT TOP 1 voorwerpnummer, Gebruiker, max(Bodbedrag) AS 'Hoogstebod'
        FROM Voorwerp 
        LEFT OUTER JOIN Bod ON voorwerpnummer = Bod.Voorwerp
        WHERE looptijdeindeDag < convert(date,getdate()) OR looptijdeindeDag = convert(date,getdate()) AND looptijdeindeTijdstip <convert(time,getdate()) AND veilingGesloten = 0
        GROUP BY voorwerpnummer, Gebruiker, Bodbedrag
        ORDER BY 'Hoogstebod' DESC
        "
$result = sqlsrv_query($db,sql);
$record = sqlsrv_fetch_array($result);
echo $record;


?>