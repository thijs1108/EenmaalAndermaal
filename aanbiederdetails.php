<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php include('includes/header.php'); ?>
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
                        <?php
                            $id = $_GET['id'];
                            $sql = "SELECT gebruikersnaam, voornaam, achternaam,adresregel,postcode,Gebruiker.plaatsnaam,Land,GeboorteDag,Mailbox,wachtwoord,Vraag,antwoordtekst,Verkoper,Valid ,COUNT(titel) AS Actieve_Biedingen
                            FROM Gebruiker LEFT OUTER JOIN Voorwerp 
                            ON Gebruiker.gebruikersnaam=Voorwerp.verkopernaam
                            GROUP BY gebruikersnaam, voornaam, achternaam,adresregel,postcode,Gebruiker.plaatsnaam,Land,GeboorteDag,Mailbox,wachtwoord,Vraag,antwoordtekst,Verkoper,Valid
                            HAVING gebruikersnaam ='$id'";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                            <div class="row margin">
<!--
                                <div class="large-3 columns">
                                    <?php echo '<img src="gebruikers/'.$record['gebruikersnaam'].'.jpg" alt="'.$record['gebruikersnaam'].'" class="aanbiedersfoto">'?>
                                </div>
-->
                                <div class="large-9 columns">
                                    <?php 
                                        echo '<h3>Aanbieder:<br/>'.$record['gebruikersnaam'].'</h3>'; 
                                        echo 'Actief sinds:'.date("d-m-Y");
                                        echo '<br/>';
                                        echo 'Actieve beidingen:'.$record['Actieve_Biedingen'];
                                        echo '<br/>';
                                        if($record['Verkoper'] == 1){
                                            $sql1 = "SELECT COUNT(Feedbacksoort) AS Ng FROM Feedback LEFT OUTER JOIN Voorwerp ON Voorwerp.voorwerpnummer=Feedback.Voorwerp WHERE Feedbacksoort = 'Negatief' AND Verkopernaam = '$id'";
                                            $sql2 = "SELECT COUNT(Feedbacksoort) AS Nt FROM Feedback LEFT OUTER JOIN Voorwerp ON Voorwerp.voorwerpnummer=Feedback.Voorwerp WHERE Feedbacksoort = 'Neutraal' AND Verkopernaam = '$id'";
                                            $sql3 = "SELECT COUNT(Feedbacksoort) AS Pt FROM Feedback LEFT OUTER JOIN Voorwerp ON Voorwerp.voorwerpnummer=Feedback.Voorwerp WHERE Feedbacksoort = 'Positief' AND Verkopernaam = '$id'";
                                            $result1 = sqlsrv_query($db, $sql1);
                                            $record1=sqlsrv_fetch_array($result1);
                                            
                                            $result2 = sqlsrv_query($db, $sql2);
                                            $record2=sqlsrv_fetch_array($result2);
                                            
                                            $result3 = sqlsrv_query($db, $sql3);
                                            $record3=sqlsrv_fetch_array($result3);
                                            
                                            $sql4 = "SELECT COUNT(Feedbacksoort) AS Tt FROM Feedback LEFT OUTER JOIN Voorwerp ON Voorwerp.voorwerpnummer=Feedback.Voorwerp WHERE Verkopernaam = '$id'";
                                            $result4 = sqlsrv_query($db, $sql4);
                                            $record4=sqlsrv_fetch_array($result4);
                                            
                                            echo 'Beoordeling van de aanbieder:';
                                            echo '<div class="stars">';
                                            $score = $record1['Ng'] + ($record2['Nt']*2) + ($record3['Pt']*3);
                                            if($score>0)
                                            {
                                                $totalscore = $score/$record4['Tt'];
                                            }
                                            else
                                            {
                                                $totalscore = 0;
                                            }
                                            
                                            if ($totalscore==0)
                                            {
                                                for ($i=0; $i<3; $i++)
                                                {
                                                    echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                                }
                                            }
                                            else if ($totalscore>0&&$totalscore<=1.5)
                                            {
                                                echo '<img src="Images\star.png" alt="Star">';
                                                for ($i=0; $i<2; $i++)
                                                {
                                                    echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                                }
                                            }
                                            else if ($totalscore>1.5&&$totalscore<=2.5)
                                            {
                                                for ($i=0; $i<2; $i++)
                                                {
                                                    echo '<img src="Images\star.png" alt="Star">';
                                                }
                                                echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                            }
                                            else if ($totalscore>2.5&&$totalscore<=3)
                                            {
                                                for ($i=0; $i<3; $i++)
                                                {
                                                    echo '<img src="Images\star.png" alt="Star">';
                                                }
                                            }
                                            echo '</div>';

                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <br/>
                            <div class="row margin">
                                <div class="large-12 columns">
                                    <?php
                                    echo "<h3>Aangeboden Artikelen</h3>";
                                        $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd,looptijdeindeDag,looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp WHERE verkopernaam ='$id' GROUP BY titel,voorwerpnummer, looptijd,looptijdeindeDag,looptijdeindeTijdstip ";
                                        $result = sqlsrv_query($db, $sql);

                                        $i=0;
                                        while($record=sqlsrv_fetch_array($result))
                                        {
                                            echo '<div class="large-4 columns">';
                                            echo '<a href="productdetails.php?id='.$record['voorwerpnummer'].'" >';
                                            echo '<div class="product">';
                                            $_POST['id'] = $record['voorwerpnummer'];
                                            $img = "SELECT TOP 1 * FROM Bestand WHERE Voorwerp =".$record['voorwerpnummer'];
                                            $plaatje = sqlsrv_query($db, $img);
                                            $afbeelding=sqlsrv_fetch_array($plaatje);
                                            if($afbeelding==true){
                                                echo '<img src="'.$afbeelding['filenaam'].'" alt="'.$record['titel'].'" class="prdimg">'."<br>";
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
                                  
                                    ?>
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
