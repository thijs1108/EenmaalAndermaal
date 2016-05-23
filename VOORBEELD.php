<?php
    define("TITLE", "Home | Eenmaal Andermaal: voor al uw veilingen");
    //constant named 'Title'
?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/menu.css">

</head>

<body>
    <div class="row">
        <img class="logo" src="Images/Logo_v1.1.png" alt="Logo">
    </div>
    <br/>

    <!--Onder row moet de div class content komen, dit zorgt ervoor dat de tekst op een witte achtergrond komt-->

    <div class="row">
        <div class="content">
            <?php include 'includes/menu.php';?>
                <!--Hier onder kunnen verschillende columns komen die in foundation staan-->

                <div class="large-12 columns">
                    Aliquam consectetur dignissim tincidunt. Sed porta lacinia sagittis. Aliquam nibh tortor, scelerisque nec sollicitudin sit amet, euismod cursus massa. Nullam non pharetra justo, sit amet congue enim. Maecenas vitae mauris sed mauris aliquet dignissim. In hac habitasse platea dictumst. Donec rutrum, purus at tincidunt aliquam, risus quam maximus nisl, non tempor dolor sapien quis orci. Quisque ultrices ligula condimentum leo molestie rutrum. Quisque pretium neque ante, id blandit ante malesuada sit amet. Sed vel mi vel risus commodo mollis ornare vel elit. Etiam in sapien nulla. Donec sit amet gravida tellus. Nullam quis diam turpis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in facilisis arcu. Phasellus iaculis orci bibendum, lacinia erat a, luctus dui. In condimentum est neque, at tempor nisi placerat eget. Ut dignissim, ex at varius tristique, nibh ex pretium ipsum, pharetra tristique justo turpis id ligula. Morbi sollicitudin eros ut leo bibendum aliquet. Donec id laoreet nisl. Nam risus libero, tempus sit amet ligula sed, pulvinar posuere felis. Vivamus gravida odio sed eros facilisis, id mollis neque condimentum. Integer tellus lectus, cursus nec augue eget, pharetra iaculis neque. Aenean efficitur purus sed velit euismod malesuada quis vitae leo. Proin sed bibendum nisi. Morbi et quam non lectus luctus sollicitudin eu sit amet nisi. Sed a molestie augue, id porttitor metus. Integer ac elementum neque, eget pulvinar elit. Etiam sit amet enim imperdiet, cursus nisl vel, efficitur orci. Cras maximus dignissim ex quis malesuada. Proin eu nibh quis metus bibendum tempor. Suspendisse non leo eleifend, dapibus lacus nec, iaculis urna. Aenean pretium fermentum velit, vitae euismod enim finibus ac. Nulla tempor ante quis nibh consectetur gravida. Morbi consectetur sapien sed nisi ultrices dictum. Integer sed egestas enim. Phasellus eget dui eu enim hendrerit pulvinar in non turpis. Nunc mollis blandit enim vitae sodales. Proin sagittis nulla nec tempor convallis. Suspendisse varius varius enim a elementum. Quisque convallis, leo quis ultrices vestibulum, felis enim eleifend diam, eu euismod libero enim nec magna.
                </div>
        </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
