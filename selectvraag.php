<?php 
	include 'includes/database.php';
	
	$gebruikersnaam = "";
    $sql = "SELECT * FROM Gebruiker LEFT OUTER JOIN Vraag ON Vraag= vraagnummer WHERE gebruikersnaam ='$gebruikersnaam'";
    $result = sqlsrv_query($db, $sql);
?>
