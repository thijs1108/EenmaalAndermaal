<?php
    //Afbeeldingen toevoegen kan nog niet!!
    //Categorie kiezen kan nog niet!!
    //Status staat niet in onze database!!
        
    session_start();
    include 'includes/database.php';

    $naam = $_POST['productname'];
    $beschrijving = $_POST['description'];
    $startbedrag = $_POST['startingprice'];
    $looptijd = $_POST['numberdays'];
    $plaats = $_POST['place'];
    $land = $_POST['country'];
    $betalingswijze = $_POST['paymethod'];
    $betalingsins = $_POST['paying'];
    $verzendkosten = $_POST['transportcost'];
    $verzendins = $_POST['sendinginstructions'];

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
    else if($username == true)
    {
        echo $sql = "INSERT Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('$naam','$beschrijving','$startbedrag','$betalingswijze','$plaats','$land','$looptijd','$date','$time','$username','$time',0)";   
        sqlsrv_query($db, $sql);
        //header('Location:productdetails.php?id='.$id);
    }
?>