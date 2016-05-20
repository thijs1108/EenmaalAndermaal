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
                        <div class="large-8 columns">
                            Welkom bij onze veilingsite genaamd ‘Eenmaal Andermaal’, deze site is ontworpen en in werking gebracht door project groep 21. deze groep bestaan uit de mensen: Thijs Beltman, Maarten Beuzel, Wouter Holtslag en Robin Schneiders. Deze site is gemaakt als project voor de opleiding HBO-ICT op de ICA in Arnhem in samenwerking met het bedrijf iConcepts met de opdrachtgever Anton Mijnder.
                            <br/>
                            <br/> Op deze site is het mogenlijk om producten aan te bieden voor een veiling, maar ook om te bieden op actieve veilingen dus heeft u 1,2,3,4 spullen te koop? bied ze hier aan!
                            <br/>
                            <br/> Heeft u vragen of wilt u contact met ons opnemen gebruik dan het onderstaande email formulier.
                            <br/>
                            <br/>
                            <br/>
                            <br/> <b>Contact opnemen:</b>
                            <form action="contact_send.php" method="post">
                                <table>
                                    <tr>
                                        <td>
                                            Email:
                                        </td>
                                        <td>
                                            <input type="text" name="email" placeholder="Email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <textarea class="FormElement" name="message" cols="40" rows="7" maxlength="500" placeholder="Vraag/suggestie/opmerking"></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <input type="submit" value="Versturen" class="rechts smallbtn">
                            </form>
                            <br/>
                            <br/>
                        </div>
                        <div class="large-4 columns">
                            <?php include 'includes/hotitems.php';?>
                        </div>
                    </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
