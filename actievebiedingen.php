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
                                    if(isset($_GET['zoeken']) && !is_null($_GET['zoeken'])){
                                        $zoekterm = $_GET['zoeken'];
                                    }
                                ?>
                                <input type="submit" value="Zoeken" class="zoekenknop">
                                <div class="zoeken">
                                    <input type="text" name="zoeken" value="<?php if(isset($zoekterm)){echo $zoekterm; } ?>" placeholder="&#xf002; Zoekterm toevoegen" class="fontawesome zoeken"><br>
                                </div>
                                <?php       
                                    if(isset($_SESSION['categorie'])){
                                        $sql = "SELECT rubrieknaam FROM Rubriek WHERE rubrieknummer=".$_SESSION['categorie'];
                                        $result = sqlsrv_query($db, $sql);
                                        $record=sqlsrv_fetch_array($result);
                                        echo "U zoekt binnen de categorie: ". $record['rubrieknaam'] . "  <a href='?resetcategorie=true' class='white smallbtn'>Reset</a>";
                                    }
                                ?> 
                            </form>
                            <br/>
                            <?php
                            if (isset($zoekterm) && isset($_SESSION['categorie'])){
                                $categorie = $_SESSION['categorie'];
                                $sql = "SELECT titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                        WHERE titel LIKE '%$zoekterm%' AND Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie
                                        GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else if (isset($zoekterm)){
                                $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp WHERE titel LIKE '%$zoekterm%' GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else if (isset($_SESSION['categorie'])){
                                $categorie = $_SESSION['categorie'];
                                $sql = "SELECT titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                        FROM Voorwerp 
                                        LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                        WHERE Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie 
                                        GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
                                $result = sqlsrv_query($db, $sql);
                            }
                            else{
                                $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
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
                                echo '<img src="voorwerpen/bieding_'.$record['voorwerpnummer'].'_01.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                echo '<b>'.$record['titel'].'</b>';
                                echo '<br/>';
                                echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
                                echo '<br/>';
                                echo 'Totaal aantal biedingen:'.$record['geboden'];
                                echo '<br/>';
                                echo 'Tijd tot sluiting:';
                                $date = date_format($record['looptijdeindeDag'], 'Y-m-d');
                                $time = date_format($record['looptijdeindeTijdstip'], 'H:i:s');
                                echo '<div class="alt-2 right">'.$date.' '.$time.'</div>';
                                echo '</div>';
                                echo '</a>';
                                echo '</div>';
                            }
                            if($count==0){
                                echo"Geen resultaten gevonden op de zoekterm: '" . $zoekterm . "'";
                            }
                            ?>
                        </div>

                        <div class="row">
                            <div class="navigation">
                                <ul class="pagination" role="navigation" aria-label="Pagination">
                                    <li class="disabled">« <span class="show-for-sr">Previous page</span></li>
                                    <li class="current"><span class="show-for-sr">You're on page</span> 1</li>
                                    <li><a href="#" aria-label="Page 2">2</a></li>
                                    <li><a href="#" aria-label="Page 3">3</a></li>
                                    <li><a href="#" aria-label="Page 4">4</a></li>
                                    <li><a href="#" aria-label="Page 5">5</a></li>
                                    <li><a href="#" aria-label="Next page">» <span class="show-for-sr">Next page</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script>
        window.jQuery(function ($) {
            "use strict";

            $('time').countDown({
                with_separators: false
            });
            $('.alt-1').countDown({
                css_class: 'countdown-alt-1'
            });
            $('.alt-2').countDown({
                css_class: 'countdown-alt-2'
            });

        });
    </script>
</body>

</html>
