<?php
	session_start();
	include 'includes/database.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($_POST['username']) || empty($_POST['password'])) {
		echo 'Please enter Username and Password';
	} else {
		$sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam = '$username' AND wachtwoord = '$password'";
		$result = sqlsrv_query($db, $sql);
		if($result === false){
			die( print_r( sqlsrv_errors(), true));
		}
		if(!sqlsrv_fetch($result)){
			echo "Username or Password not found";
		} else {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$username = $row['gebruikersnaam'];
			}
			echo 'logged in?'; 
			$_SESSION['username'] = $username;
		}
		header('location:index.php');
	}
?>