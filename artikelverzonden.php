<?php
    //Afbeeldingen toevoegen kan nog niet!!
    //Afbeeldingen staan niet op de server!!
    //Categorie kiezen kan nog niet!!
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    $filenaam = $_FILES['files']['name'];

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
        echo $sql = "INSERT Voorwerp (titel,beschrijving,startprijs,betalingswijzenaam,plaatsnaam,landnaam,looptijd,looptijdbeginDag,looptijdbeginTijdstip,verkopernaam,looptijdeindeTijdstip,veilingGesloten) VALUES ('$naam','$beschrijving','$startbedrag','$betalingswijze','$plaats','$land','$looptijd','$date','$time','$username','$time',0)";   
        sqlsrv_query($db, $sql);
        
        $length = count($filenaam);
        
        echo $sql = "SELECT * FROM Voorwerp WHERE looptijdbeginDag ='$date' AND looptijdbeginTijdstip = '$time'";
        $result=sqlsrv_query($db, $sql);
        $record=sqlsrv_fetch_array($result);

        for($i=0;$i<$length;$i++)
        {
            echo $img = $filenaam[$i];
            echo $path = "upload/".$img;
            echo $sqlBestand = "INSERT Bestand (filenaam,Voorwerp) VALUES ('$path',".$record['voorwerpnummer'].")";
            sqlsrv_query($db, $sqlBestand);
            
        }
        
        $lengthRB = count($rubriek);
        
        for ($y=0;$y<$lengthRB;$y++)
        {
            $sqlBestand = "INSERT Voorwerp_in_rubriek (voorwerpnummer,RubriekOpLaagsteNiveau) VALUES (".$record['voorwerpnummer'].",$rubriek[$y])";
            sqlsrv_query($db, $sqlBestand);
        }
        
        $valid_formats = array("jpg", "png", "gif", "bmp", "JPG", "PNG", "GIF", "BMP");
        $max_file_size = 2400*2400; //100 kb
        $path = "upload/"; // Upload directory
        $count = 0;

        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
            // Loop $_FILES to exeicute all files
            foreach ($_FILES['files']['name'] as $f => $name) {     
                if ($_FILES['files']['error'][$f] == 4) {
                    continue; // Skip file if any error found
                }	       
                if ($_FILES['files']['error'][$f] == 0) {	           
                    if ($_FILES['files']['size'][$f] > $max_file_size) {
                        echo $message[] = "$name is too large!.";
                        continue; // Skip large files
                    }
                    elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
                        echo $message[] = "$name is not a valid format";
                        continue; // Skip invalid file formats
                    }
                    else{ // No error found! Move uploaded files 
                        if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
                        echo $count++; // Number of successfully uploaded file
                    }
                }
            }
        }
        
        header('Location:productdetails.php?id='.$record['voorwerpnummer']);
    }
?>