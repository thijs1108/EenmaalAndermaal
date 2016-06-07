<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php include('includes/header.php'); ?>
    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css" />

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

                    <div class="large-8 columns">
                        
                        <form action="testupload.php" method="post" enctype="multipart/form-data">
                            <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
                          <input type="submit" value="Upload!" />
                        </form>

                        
                        
                        <h2><b>Tijd om alles af te maken:</b></h2>
                        <h2><div class="alt-2">06/09/2016 4:00 PM</div></h2>
                        
                        <h3><b>Tijd tot pauze:</b><br/></h3>
                        <h3><div class="alt-2">06/07/2016 12:00 PM</div></h3>
                        
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
    <?php include 'includes/footer.php';?>
    <?php include 'includes/footer.php';?>     <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script src="datepicker/jquery.js"></script>
    <script src="datepicker/jquery.datetimepicker.full.js"></script>
</body>

</html>
