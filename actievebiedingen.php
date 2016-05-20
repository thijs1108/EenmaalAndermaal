<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eenmaal Andermaal</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="awesomefont/css/font-awesome.min.css">
</head>

<body>
    <div class="row">
        <img class="logo" src="Images/Logo_v1.1.png" alt="Logo">
    </div>
    <br/>
    <div class="row">
        <?php include 'includes/menu.php';?>
            <?php include 'includes/database_connectie.php';?>
                <?php include 'includes/functions.php';?>
                    <div class="content">
                        <div class="large-3 columns">
                                <?php include 'includes/categorie.php'?>
                        </div>
                        <div class="large-9 columns">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="submit" value="Zoeken" class="zoekenknop">
                                <div class="zoeken">
                                    <input type="text" name="zoeken" value="" placeholder="&#xf002; Zoekterm toevoegen" class="fontawesome zoeken">
                                </div>
                            </form>
                            <br/>
                            <?php
                                    $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
                                    $result = sqlsrv_query($db, $sql);

                                    while($record=sqlsrv_fetch_array($result))
                                    {   
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
                                        echo '<div class="alt-2 right">'.$date.'</div>';
                                        echo '</div>';
                                        echo '</a>';
                                        echo '</div>';
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
        window.jQuery(function($) {
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
