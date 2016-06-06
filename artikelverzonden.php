<?php
    //Afbeeldingen toevoegen kan nog niet!!
    //Afbeeldingen staan niet op de server!!
    //Categorie kiezen kan nog niet!!
        
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
    $rubriek = $_POST['rubriek'];
    $filenaam = $_FILES['filesToUpload']['name'];

    if(!isset($_SESSION['username']))
    {
        
    }
    else if (isset($_SESSION['username']))
    {
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
        $sql = "INSERT Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('$naam','$beschrijving','$startbedrag','$betalingswijze','$plaats','$land','$looptijd','$date','$time','$username','$time',0)";   
        sqlsrv_query($db, $sql);
        
        $length = count($filenaam);
        
        $sql = "SELECT * FROM Voorwerp WHERE looptijdbeginDag ='$date' AND looptijdbeginTijdstip = '$time'";
        $result=sqlsrv_query($db, $sql);
        $record=sqlsrv_fetch_array($result);

        $uploaddir = "upload/voorwerpen/".$record['voorwerpnummer']."/";
        print_r($_FILES);
        $filename = 'filesToUpload';
        $newdir = (string) $uploaddir;
        mkdir($newdir, 0777);
        
        $uploadfile = $uploaddir . basename($_FILES['filesToUpload']['name']);
        echo $uploadfile;
        move_uploaded_file($_FILES['filesToUpload']['tmp_name'], $uploadfile);
        
        
        
        
        
        for($i=0;$i<$length;$i++)
        {
            echo $img = $filenaam[$i];
            echo $path = "upload/voorwerpen/".$record['voorwerpnummer']."/".$img;
            echo $sqlBestand = "INSERT Bestand (filenaam,Voorwerp) VALUES ('$path',".$record['voorwerpnummer'].")";
            sqlsrv_query($db, $sqlBestand);
            
        }
        
        $lengthRB = count($rubriek);
        
        for ($y=0;$y<$lengthRB;$y++)
        {
            $sqlBestand = "INSERT Voorwerp_in_rubriek (voorwerpnummer,RubriekOpLaagsteNiveau) VALUES (".$record['voorwerpnummer'].",$rubriek[$y])";
            sqlsrv_query($db, $sqlBestand);
        }
        
        header('Location:productdetails.php?id='.$record['voorwerpnummer']);
    }
?>