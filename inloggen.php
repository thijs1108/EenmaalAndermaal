<?php
	session_start();
	include 'includes/database.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($_POST['username']) || empty($_POST['password'])) {
		header('location:loginscreen.php?fout');
	} else {
		echo $sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam = '$username' COLLATE Latin1_General_CS_AS AND wachtwoord = '$password' COLLATE Latin1_General_CS_AS ";
		$result = sqlsrv_query($db, $sql);
		if($result === false){
			die( print_r( sqlsrv_errors(), true));
		}
		if(!sqlsrv_fetch($result)){
			header('location:loginscreen.php?fout2');
		} else {
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
				$username = $row['gebruikersnaam'];
			}
            //check if activated
            $sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam = '$username' AND wachtwoord = '$password' AND valid=1";
		    $result = sqlsrv_query($db, $sql);
            if(!sqlsrv_fetch($result)){
			    header("location:validate.php?username=$username");
            }
            else{
                echo 'logged in?'; 
                $_SESSION['username'] = $username;
                header('location:index.php');
            }
		}
		
	}
?>