<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php 
        include('includes/header.php');
        if(isset($_GET['categorie']) && !is_null($_GET['categorie'])){
            $_SESSION['categorie'] = $_GET['categorie'];
        }
        if(isset($_GET['resetcategorie']) && !is_null($_GET['resetcategorie'])){
            unset($_SESSION['categorie']);
            unset($_SESSION['zoekterm']);
        }
    ?>
</head>

<body>
    <div class="row">
        <img class="logo" src="Images/Logo_v1.1.png" alt="Logo">
    </div>
    <br/>
    <div class="row">
        <?php include 'includes/menu.php';?>
            <?php include 'includes/database.php';?>
                <?php include 'includes/functions.php';?>
                    <div class="content">
                        <div class="large-3 columns">
                            <span id="categorieen"><?php include 'includes/categorie-rendered.php'?></span>
                        </div>
                        <div class="large-9 columns">
                            <form method="get" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                                <?php
                                    if(isset($_GET['page']))
                                    {
                                        if($_GET['page']==1){
                                            $page = 11;
                                        }
                                        else{
                                            $page = $_GET['page']*10;
                                        }
                                    }
                                    else{
                                        $page =11;
                                    }
                                    if(isset($_GET['zoeken']) && !is_null($_GET['zoeken']) && $_GET['zoeken']!=''){
                                        $zoekterm = $_GET['zoeken'];
                                        $_SESSION['zoekterm'] = $zoekterm;
                                    }
                                ?>
                                <input type="submit" value="Zoeken" class="zoekenknop">
                                <div class="zoeken">
                                    <input type="text" name="zoeken" value="<?php if(isset($zoekterm)){echo $zoekterm; } ?>" placeholder="&#xf002; Zoekterm toevoegen" class="fontawesome zoeken"><br>
                                </div>
                                <?php   
                                    if(isset($_SESSION['categorie'])&&isset($_SESSION['zoekterm']))
                                    {
                                        $sql = "SELECT rubrieknaam FROM Rubriek WHERE rubrieknummer=".$_SESSION['categorie'];
                                        $result = sqlsrv_query($db, $sql);
                                        $record=sqlsrv_fetch_array($result);
                                        $categorienaam = $record['rubrieknaam'];
                                        $zoekterm = $_SESSION['zoekterm'];
                                        echo "U zoekt binnen de categorie: ". utf8_encode($categorienaam ). ", op de zoekterm: ". $zoekterm ."  <a href='?resetcategorie=true' class='white smallbtn'>Reset</a>";
                                    
                                    }
                                    else if(isset($_SESSION['categorie'])){
                                        $sql = "SELECT rubrieknaam FROM Rubriek WHERE rubrieknummer=".$_SESSION['categorie'];
                                        $result = sqlsrv_query($db, $sql);
                                        $record=sqlsrv_fetch_array($result);
                                        $categorienaam = $record['rubrieknaam'];
                                        echo "U zoekt binnen de categorie: ". utf8_encode($categorienaam ). "  <a href='?resetcategorie=true' class='white smallbtn'>Reset</a>";
                                    }
                                    else if(isset($_SESSION['zoekterm'])){
                                        $zoekterm = $_SESSION['zoekterm'];
                                        echo "U zoekt op: ". $zoekterm . "  <a href='?resetcategorie=true' class='white smallbtn'>Reset</a>";
                                    }
                                ?> 
                            </form>
                            <br/>
                            <?php
                            if (isset($_SESSION['zoekterm']) && isset($_SESSION['categorie'])){
                                $categorie = $_SESSION['categorie'];
                                $zoekterm = $_SESSION['zoekterm'];
                                $sql = "SELECT TOP 10 titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM (SELECT TOP $page titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp INNER JOIN Voorwerp_in_rubriek ON Voorwerp.voorwerpnummer=Voorwerp_in_rubriek.voorwerpnummer WHERE titel LIKE '%$zoekterm%' AND Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie ORDER BY voorwerpnummer ASC) Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                        WHERE titel LIKE '%$zoekterm%' AND Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie AND looptijdeindeDag > CONVERT (date, GETDATE()) OR looptijdeindeDag = CONVERT (date, GETDATE()) AND looptijdeindeTijdstip > CONVERT (time, GETDATE())
                                        GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip
                                        ORDER BY voorwerpnummer DESC";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else if (isset($_SESSION['zoekterm'])){
                                $zoekterm = $_SESSION['zoekterm'];
                                $sql = "SELECT TOP 10 titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM (SELECT TOP $page * FROM Voorwerp WHERE titel LIKE '%$zoekterm%' ORDER BY voorwerpnummer ASC) Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        WHERE titel LIKE '%$zoekterm%' AND looptijdeindeDag > CONVERT (date, GETDATE()) OR looptijdeindeDag = CONVERT (date, GETDATE()) AND looptijdeindeTijdstip > CONVERT (time, GETDATE())
                                        GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip
                                        ORDER BY voorwerpnummer DESC";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else if (isset($_SESSION['categorie'])){
                                $categorie = $_SESSION['categorie'];
                                $sql = "SELECT TOP 10 titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM (SELECT TOP $page titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp INNER JOIN Voorwerp_in_rubriek ON Voorwerp.voorwerpnummer=Voorwerp_in_rubriek.voorwerpnummer WHERE Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie ORDER BY voorwerpnummer ASC) Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                        WHERE Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie AND looptijdeindeDag > CONVERT (date, GETDATE()) OR looptijdeindeDag = CONVERT (date, GETDATE()) AND looptijdeindeTijdstip > CONVERT (time, GETDATE()) 
                                        GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip
                                        ORDER BY voorwerpnummer DESC";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else{
                                $sql = "SELECT TOP 10 titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM (SELECT TOP $page * FROM Voorwerp ORDER BY voorwerpnummer ASC) Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp
                                        WHERE looptijdeindeDag > CONVERT (date, GETDATE()) OR looptijdeindeDag = CONVERT (date, GETDATE()) AND looptijdeindeTijdstip > CONVERT (time, GETDATE()) 
                                        GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip
                                        ORDER BY voorwerpnummer DESC";
                                $result = sqlsrv_query($db, $sql);
                            }
                            $count = 0;
                            while($record=sqlsrv_fetch_array($result))
                            {                               
                                $count++;
                                echo '<div class="large-6 columns">';
                                echo '<a href="productdetails.php?id='.$record['voorwerpnummer'].'" >';
                                echo '<div class="product">';
                                $_POST['id'] = $record['voorwerpnummer'];
                                
                                $img = "SELECT TOP 1 * FROM Bestand WHERE Voorwerp =".$record['voorwerpnummer'];
                                $plaatje = sqlsrv_query($db, $img);
                                $afbeelding=sqlsrv_fetch_array($plaatje);
                                if($afbeelding==true){
                                    echo '<img src="http://iproject21.icasites.nl/'.$afbeelding['filenaam'].'" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                }
                                else {
                                    echo '<img src="Images/placeholder_product.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";   
                                }
                                echo '<b>'.$record['titel'].'</b>';
                                echo '<br/>';
                                echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
                                echo '<br/>';
                                echo 'Totaal aantal biedingen:'.$record['geboden'];
                                echo '<br/>';
                                echo 'Tijd tot sluiting:';
                                
                                $date = date_format($record['looptijdeindeDag'], 'Y-m-d');
                                $time = date_format($record['looptijdeindeTijdstip'], 'H:i:s');
                                echo '<div class="alt-3 right">'.$date.' '.$time.'</div>';
                                
                                echo '</div>';
                                echo '</a>';
                                echo '</div>';
                            }
                            if($count==0){
                                if(isset($zoekterm) && isset($categorienaam)){
                                    echo"Geen resultaten gevonden op de zoekterm: '" . $zoekterm . "' binnen de categorie: '" . utf8_encode($categorienaam) . "'";
                                }
                                else if (isset($zoekterm)){
                                    echo"Geen resultaten gevonden op de zoekterm: '" . $zoekterm . "'";
                                }
                                else if (isset($categorienaam)){
                                    echo"Geen resultatien binnen de categorie: '" . utf8_encode($categorienaam) . "'";
                                }
                            }
                            ?>
                            <div class="large-12 columns">
                            <?php include 'includes/navigation.php';?>
                        </div>
                        </div>

                        
                    </div>

    </div>
    <?php include 'includes/footer.php';?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script>
        window.jQuery(function ($) {
            "use strict";

            $('.alt-3').countDown({
                css_class: 'countdown-alt-2'
            }).on('time.elapsed',function(event) {
                $(this).html('GESLOTEN!');
                $('.biedenknop').disabled=true;
            });

        });
    </script>
</body>

</html>
