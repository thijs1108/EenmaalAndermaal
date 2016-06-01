<?php
 session_start();
    include 'includes/database.php';
    $id = $_GET['id'];
    $bedrag = $_POST['bieding'];
    if(!isset($_SESSION['username']))
    {
        echo 'session is not set';
        $_SESSION['username']='';
    }
    else
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
        header('Location:productdetails.php?id='.$id);
    }
    else if($username == true)
    {
        
        $sql = "INSERT bod values ('$id','$bedrag','$username','$date','$time')";   
        sqlsrv_query($db, $sql);
        header('Location:productdetails.php?id='.$id);
    }
?>