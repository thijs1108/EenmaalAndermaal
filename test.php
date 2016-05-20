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
    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css" />

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

                    <div class="large-8 columns">


                        <h2><b>Tijd tot pauze:</b><br/></h2>

                        <h2><div class="alt-2">05/18/2016 12:00 PM</div></h2>
                        <div class="alt-2">06/09/2016 4:00 PM</div>
                        
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
                        test van github
                        <br>
                        <br>
                    </div>
                    <div class="large-4 columns">
                        <?php include 'includes/hotitems.php';?>
                    </div>

    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="datepicker/jquery.js"></script>
    <script src="datepicker/jquery.datetimepicker.full.js"></script>
</body>

</html>
