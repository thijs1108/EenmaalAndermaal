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
    <script type="text/javascript" src="js/jssor.slider.min.js"></script>
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
                            $sql = "SELECT TOP 1 titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp GROUP BY titel,voorwerpnummer, looptijd";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                            <div class="large-6 columns">
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
                                        <div data-p="112.50" style="display: none;">
                                            <?php echo '<img src="voorwerpen/bieding_'.$record['voorwerpnummer'].'_01.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                            ?>
                                        </div>
                                        <div data-p="112.50" style="display: none;">
                                            <img src="Images/02.jpg">
                                        </div>
                                        <div data-p="112.50" style="display: none;">
                                            <img src="Images/05.jpg">
                                        </div>
                                        <div data-p="112.50" style="display: none;">
                                            <img src="Images/09.jpg">
                                        </div>
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
                            <div class="large-2 columns">
                                <?php echo '<a href="productdetails.php?id='.$record['voorwerpnummer'].'" class="clicklink"><img src="Images/back_button.png" alt="terug knop">Vorige pagina</a> ';?>
                            </div>
                            <div class="large-4 columns">
                                <?php echo '<h3>'.$record['titel'].'</h3>'; 
                                echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
                                echo '<br/>';  
                                echo 'Totaal aantal biedingen:'.$record['geboden'];
                                echo '<br/>';
                                echo 'Tijd tot sluiting:'.date("h:i:s");
                                echo '<br/>';
                                }
                            ?>
                            </div>

                    </div>

                    <script src="js/vendor/jquery.js"></script>
                    <script src="js/vendor/what-input.js"></script>
                    <script src="js/vendor/foundation.js"></script>
                    <script src="js/app.js"></script>
</body>

</html>
