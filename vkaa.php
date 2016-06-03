<?php
	session_start();
	include 'includes/database.php';
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$username = $_SESSION['username'];
		$bank = $_POST['bank'];
		$rekeningnummer = $_POST['number'];
		$controle = $_POST['check'];
		$creditcardnummer = $_POST['creditcard'];
		$ok = true;
		if (!isset($_POST['bank']) || $_POST['bank'] === ''){
			$ok = false;
		} else {
			$bank = $_POST['bank'];
		}
		if (!isset($_POST['number']) || $_POST['number'] === ''){
			$ok = false;
		} else {
			$rekeningnummer = $_POST['number'];
		}
		if($ok === true){
			$sql1= "UPDATE Gebruiker SET Verkoper = 1 WHERE gebruikersnaam = '$username'";
			sqlsrv_query($db,$sql1);
			$sql2= " INSERT INTO Verkoper VALUES ('$username','$bank','$rekeningnummer','$controle', '$creditcardnummer')";
			sqlsrv_query($db,$sql2);
			header('location:mijnaccount.php');
		} else {
			echo 'Nope!';
		}
		
	}


?>
