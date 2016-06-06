<?php
    session_start();
    include 'includes/database.php';
    $id = $_GET['id'];
    $bedrag = $_POST['bieding'];
    if(!isset($_SESSION['username']))
    {
        
    }
    else if (isset($_SESSION['username']))
    {
        echo 'session is set';
        $username = $_SESSION['username'];
    }

    $today = getdate();
    $date = $today['mday'].'-'.$today['mon'].'-'.$today['year'] ;

    $time = $today['hours'].':'.$today['minutes'].':'.$today['seconds'];    
    
    //er moet ingelogd zijn om te kunnen bestellen
    if($username == false)
    {   
        header('Location:loginscreen.php?fout3');
    }
    else if($username == true){
		$ok = true;
		$sql2 = "SELECT MAX(Bodbedrag) FROM Bod WHERE voorwerp = '$id' ";
		$result = sqlsrv_query($db, $sql2);
		$record=sqlsrv_fetch_array($result);
        if ($record[0] >= 1 && $record[0] <= 49.99){
			if($bedrag < ($record[0] + 0.50)){
				$ok = false;
				header('Location:productdetails.php?id='.$id.'&fout1');
			}
		} else if ($record[0] >= 50 && $record[0] <= 499.99){
			if($bedrag < ($record[0] + 1.00)){
				$ok = false;
				header('Location:productdetails.php?id='.$id.'&fout2');
			}
		} else if ($record[0] >= 500 && $record[0] <= 999.99){
			if($bedrag < ($record[0] + 5.00)){
				$ok = false;
				header('Location:productdetails.php?id='.$id.'&fout3');
			}
		} else if ($record[0] >= 1000 && $record[0] <= 4999.99){
			if($bedrag < ($record[0] + 10.00)){
				$ok = false;
				header('Location:productdetails.php?id='.$id.'&fout4');
			}
		} else if ($record[0] >= 5000){
			if($bedrag < ($record[0] + 50.00)){
				$ok = false;
				header('Location:productdetails.php?id='.$id.'&fout5');
			}
		}
		if ($ok){
			$sql = "INSERT bod values ('$id','$bedrag','$username','$date','$time')";
			sqlsrv_query($db, $sql);
			header('Location:productdetails.php?id='.$id);
		}		
    }
?>