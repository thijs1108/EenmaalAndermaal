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
                            $sql = "SELECT titel,voorwerpnummer,verkopernaam,beschrijving,startprijs, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp WHERE voorwerpnummer='$id' GROUP BY titel,voorwerpnummer,verkopernaam, beschrijving,startprijs, looptijdeindeDag, looptijdeindeTijdstip";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                            <div class="large-8 columns">
                                <div class="large-5 columns">
                                    <script>
                                        jssor_1_slider_init = function() {

                                            var jssor_1_SlideshowTransitions = [{
                                                $Duration: 1200,
                                                $Opacity: 2
                                            }];

                                            var jssor_1_options = {
                                                $AutoPlay: true,
                                                $SlideshowOptions: {
                                                    $Class: $JssorSlideshowRunner$,
                                                    $Transitions: jssor_1_SlideshowTransitions,
                                                    $TransitionsOrder: 1
                                                },
                                                $ArrowNavigatorOptions: {
                                                    $Class: $JssorArrowNavigator$
                                                },
                                                $BulletNavigatorOptions: {
                                                    $Class: $JssorBulletNavigator$
                                                }
                                            };

                                            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                                            //responsive code begin
                                            //you can remove responsive code if you don't want the slider scales while window resizing
                                            function ScaleSlider() {
                                                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                                                if (refSize) {
                                                    refSize = Math.min(refSize, 1200);
                                                    jssor_1_slider.$ScaleWidth(refSize);
                                                } else {
                                                    window.setTimeout(ScaleSlider, 30);
                                                }
                                            }
                                            ScaleSlider();
                                            $Jssor$.$AddEvent(window, "load", ScaleSlider);
                                            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                                            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                                            //responsive code end
                                        };

                                    </script>

                                    <style>
                                        /* jssor slider bullet navigator skin 05 css */
                                        /*
                                        .jssorb05 div           (normal)
                                        .jssorb05 div:hover     (normal mouseover)
                                        .jssorb05 .av           (active)
                                        .jssorb05 .av:hover     (active mouseover)
                                        .jssorb05 .dn           (mousedown)
                                        */
                                        
                                        .jssorb05 {
                                            position: absolute;
                                        }
                                        
                                        .jssorb05 div,
                                        .jssorb05 div:hover,
                                        .jssorb05 .av {
                                            position: absolute;
                                            /* size of bullet elment */
                                            width: 16px;
                                            height: 16px;
                                            background: url('Images/b05.png') no-repeat;
                                            overflow: hidden;
                                            cursor: pointer;
                                        }
                                        
                                        .jssorb05 div {
                                            background-position: -7px -7px;
                                        }
                                        
                                        .jssorb05 div:hover,
                                        .jssorb05 .av:hover {
                                            background-position: -37px -7px;
                                        }
                                        
                                        .jssorb05 .av {
                                            background-position: -67px -7px;
                                        }
                                        
                                        .jssorb05 .dn,
                                        .jssorb05 .dn:hover {
                                            background-position: -97px -7px;
                                        }
                                        /* jssor slider arrow navigator skin 12 css */
                                        /*
                                        .jssora12l                  (normal)
                                        .jssora12r                  (normal)
                                        .jssora12l:hover            (normal mouseover)
                                        .jssora12r:hover            (normal mouseover)
                                        .jssora12l.jssora12ldn      (mousedown)
                                        .jssora12r.jssora12rdn      (mousedown)
                                        */
                                        
                                        .jssora12l,
                                        .jssora12r {
                                            display: block;
                                            position: absolute;
                                            /* size of arrow element */
                                            width: 30px;
                                            height: 46px;
                                            margin-top: 125px;
                                            cursor: pointer;
                                            background: url('Images/a12.png') no-repeat;
                                            overflow: hidden;
                                        }
                                        
                                        .jssora12l {
                                            background-position: -16px -37px;
                                        }
                                        
                                        .jssora12r {
                                            background-position: -75px -37px;
                                        }
                                        
                                        .jssora12l:hover {
                                            background-position: -136px -37px;
                                        }
                                        
                                        .jssora12r:hover {
                                            background-position: -195px -37px;
                                        }
                                        
                                        .jssora12l.jssora12ldn {
                                            background-position: -256px -37px;
                                        }
                                        
                                        .jssora12r.jssora12rdn {
                                            background-position: -315px -37px;
                                        }

                                    </style>


                                    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 500px; height: 300px; overflow: hidden; visibility: hidden;">
                                        <!-- Loading Screen -->
                                        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                            <div style="position:absolute;display:block;background:url('Images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                        </div>
                                        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 500px; height: 300px; overflow: hidden;">
                                            <?php
                                            $img = "SELECT * FROM Bestand WHERE Voorwerp =".$record['voorwerpnummer'];
                                            $plaatje = sqlsrv_query($db, $img);
                                            while($afbeelding=sqlsrv_fetch_array($plaatje))
                                            {
                                            echo '<div data-p="112.50" style="display: none;">';
                                                //echo'<a href="productpictures.php?id='.$record['voorwerpnummer'].'" >';
                                                 echo '<img src="http://iproject21.icasites.nl/'.$afbeelding['filenaam'].'" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                                //echo '</a>';
                                            echo '</div>';
                                            }
                                            
                                            ?>
                                            <a data-u="ad" href="http://www.jssor.com" style="display:none">jQuery Slider</a>

                                        </div>
                                        <!-- Bullet Navigator -->
                                        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
                                            <!-- bullet navigator item prototype -->
                                            <div data-u="prototype" style="width:16px;height:16px;"></div>
                                        </div>
                                        <!-- Arrow Navigator -->
                                        <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                        <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
                                    </div>
                                    <script>
                                        jssor_1_slider_init();

                                    </script>

                                </div>
                                <div class="large-1 columns">
                                    &nbsp;</div>
                                <div class="large-4 columns">
                                    <?php echo '<h3>'.$record['titel'].'</h3>'; 
                                echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
                                echo '<br/>';  
                                echo 'Totaal aantal biedingen:'.$record['geboden'];
                                echo '<br/>';
                                echo 'Tijd tot sluiting:';
                                $date = date_format($record['looptijdeindeDag'], 'Y-m-d');
                                $time = date_format($record['looptijdeindeTijdstip'], 'H:i:s');
                                echo '<div class="alt-3 right">'.$date.' '.$time.'</div>';
                        
                                echo '<br/>';
                                echo 'Aanbieder:<a href="aanbiederdetails.php?id='.$record['verkopernaam'].'" class="clicklink" >'.$record['verkopernaam'].'</a>';
                                echo '<br/>';
                                echo 'Beoordeling van de aanbieder:';
                                echo '<div class="stars">';
                                if ($record['voorwerpnummer']==0)
                                {
                                    for ($i=0; $i<3; $i++)
                                    {
                                        echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                    }
                                }
                                else if ($record['voorwerpnummer']==1)
                                {
                                    echo '<img src="Images\star.png" alt="Star">';
                                    for ($i=0; $i<2; $i++)
                                    {
                                        echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                    }
                                }
                                else if ($record['voorwerpnummer']==2)
                                {
                                    for ($i=0; $i<2; $i++)
                                    {
                                        echo '<img src="Images\star.png" alt="Star">';
                                    }
                                    echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                }
                                else if ($record['voorwerpnummer']>=3)
                                {
                                    for ($i=0; $i<3; $i++)
                                    {
                                        echo '<img src="Images\star.png" alt="Star">';
                                    }
                                }
                                echo '</div>';
                                ?>
                                        <br/>
                                        <br/>
                                </div>
                                <div class="large-2 columns">
                                    <form method="post" action="<?php echo 'plaatsbod.php?id='.$record['voorwerpnummer']; ?>">
                                        <div class="bieden">
                                            <input type="text" name="bieding" value="" placeholder="€<?php
                                if($record['maxbedrag']<$record['startprijs'])
                                {
                                    echo number_format($record['startprijs'],2);
                                }
                                else{
                                    echo number_format($record['maxbedrag'],2);
                                }
                                ?>">
								
                                            <input type="submit" value="Plaats bod" class="biedenknop">
                                        </div>
										<?php if(isset($_GET['fout1'])){
											echo "Het geplaatste bod moet minimaal 0.50 euro hoger zijn dan het huidige bod!";
										} else if(isset($_GET['fout2'])){
											echo "Het geplaatste bod moet minimaal 1.00 euro hoger zijn dan het huidige bod!";
										} else if(isset($_GET['fout3'])){
											echo "Het geplaatste bod moet minimaal 5.00 euro hoger zijn dan het huidige bod!";
										} else if(isset($_GET['fout4'])){
											echo "Het geplaatste bod moet minimaal 10.00 euro hoger zijn dan het huidige bod!";
										} else if(isset($_GET['fout5'])){
											echo "Het geplaatste bod moet minimaal 50.00 euro hoger zijn dan het huidige bod!";
										} 
										?>
                                    </form>
                                </div>
                                <div class="column row">
                                    <hr>
                                    <ul class="tabs" data-tabs id="example-tabs">
                                        <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Productinformatie</a></li>
                                        <li class="tabs-title"><a href="#panel2">Biedingshistorie</a></li>
                                    </ul>
                                    <div class="tabs-content" data-tabs-content="example-tabs">
                                        <div class="tabs-panel is-active" id="panel1">
                                            <div class="media-object stack-for-small">
                                                <?php echo htmlspecialchars($record['beschrijving']); ?>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                            <div class="tabs-panel" id="panel2">
                                                <div class="media-object stack-for-small">
                                                    <?php 
                                                $sql = "SELECT * FROM Voorwerp LEFT OUTER JOIN Bod on Voorwerp.voorwerpnummer= Bod.Voorwerp WHERE voorwerpnummer ='$id' ORDER BY Bodbedrag DESC";
                                                $result = sqlsrv_query($db, $sql);
                                                
                                                echo '<table>';
                                                echo '<tr>';
                                                    echo '<td>';
                                                        echo '<b>Gebruiker</b>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                        echo '<b>Bedrag</b>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                        echo '<b>Datum</b>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                        echo '<b>Tijd</b>';
                                                    echo '</td>';
                                                echo '</tr>';
                                                while($record=sqlsrv_fetch_array($result))
                                                {
                                                    $bool = $record['Bodbedrag'];
                                                    if (isset ($bool)){
                                                        echo '<div class="bieding">'; 
                                                        echo '<tr>';
                                                        echo '<td>';
                                                        echo $record['Gebruiker'];
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo '€ '.number_format($record['Bodbedrag'],2);
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo date_format($record['BodDag'], 'd-m-Y');
                                                        echo '</td>';
                                                        echo '<td>';
                                                        echo date_format($record['BodTijdstip'], 'H:i:s');
                                                        echo '</td>';
                                                        echo '</tr>';
                                                        echo '</div>';
                                                    }
                                                }
                                                echo '</table>';
                                                ?>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            </div>
                            <div class="large-4 columns">
                                <?php include 'includes/hotitems.php';?>
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
