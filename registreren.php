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
    <link rel="stylesheet" type="text/css" href="awesomefont/css/font-awesome.min.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">

    <?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $errors = array();
        //ga alle verplichte velden langs en voer een simpele controle uit
        if(!isset($_POST['email']) || $_POST['email'] == ""){
            array_push($errors, "Verplichte veld 'email' niet ingevuld!");
        }

        if(!isset($_POST['username']) || $_POST['username'] == ""){
            array_push($errors, "Verplichte veld 'Gebruikersnaam' niet ingevuld!");
        }
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
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="large-6 columns">
                                <table>
                                    <tr>
                                        <td>
                                            Email:
                                        </td>
                                        <td>
                                            <input type="text" name="email" placeholder="voorbeeld@voorbeeld.nl">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Gebruikersnaam:
                                        </td>
                                        <td>
                                            <input type="text" name="username" placeholder="Gebruikersnaam">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Wachtwoord:
                                        </td>
                                        <td>
                                            <input type="password" name="password" placeholder="Wachtwoord">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Herhaal Wachtwoord:
                                        </td>
                                        <td>
                                            <input type="password" name="confirmpassword" placeholder="Wachtwoord">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Voornaam:
                                        </td>
                                        <td>
                                            <input type="text" name="firstname" placeholder="Voornaam">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Achternaam:
                                        </td>
                                        <td>
                                            <input type="text" name="lasttname" placeholder="Achternaam">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telefoonnummer 1:
                                        </td>
                                        <td>
                                            <input type="text" name="phone1" placeholder="Telefoonnummer 1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telefoonnummer 2:
                                        </td>
                                        <td>
                                            <input type="text" name="phone2" placeholder="Telefoonnummer 2">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="large-6 columns">
                                <table>
                                    <tr>
                                        <td>
                                            Adres:
                                        </td>
                                        <td>
                                            <input type="text" name="adres" placeholder="Adres">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Postcode:
                                        </td>
                                        <td>
                                            <input type="text" name="postalcode" placeholder="1234 AB">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Plaats:
                                        </td>
                                        <td>
                                            <input type="text" name="place" placeholder="Plaats">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Land:
                                        </td>
                                        <td>
                                            <input type="text" name="country" placeholder="Land">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Geboortedatum:
                                        </td>
                                        <td>
                                            <input id="datetimepicker" name="birthday" type="text" placeholder="&#xf073;  20/01/1990" class="fontawesome">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Geheime vraag:
                                        </td>
                                        <td>
                                            <select name="secretquestion">
                                                <option value="1">In welke straat ben je geboren?</option>
                                                <option value="2">Wat is de meisjesnaam van je moeder?</option>
                                                <option value="3">Wat is je lievelingsgerecht?</option>
                                                <option value="4">Hoe heet je oudste zusje</option>
                                                <option value="5">Hoe heet je huisdier?</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Antwoord:
                                        </td>
                                        <td>
                                            <input type="text" name="anweser" placeholder="Antwoord">
                                        </td>
                                    </tr>
                                </table>
                                <input type="submit" value="Registreren" class="rechts smallbtn">
                            </div>
                        </form>


                        <div class="row"></div>
                        <div class="large-12 columns">
                            <table>
                                <?php
                                    if(isset($errors)){
                                        foreach($errors as $error){
                                            echo '
                                            </div>
                                                <div class="small-6 columns small-centered">
                                                    <div data-alert class="alert-box warning">
                                                    <i class="fi-alert"></i>'. $error .'
                                                </div>
                                            </div>';

                                        }
                                    }
                                    ?>
                            </table>






                        </div>

                    </div>
                    <script src="js/vendor/jquery.js"></script>
                    <script src="js/vendor/what-input.js"></script>
                    <script src="js/vendor/foundation.js"></script>
                    <script src="js/app.js"></script>
                    <script src="datepicker/jquery.js"></script>
                    <script src="datepicker/jquery.datetimepicker.full.js"></script>
                    <script>
                        /*
                                                                                        window.onerror = function(errorMsg) {
                                                                                        	$('#console').html($('#console').html()+'<br>'+errorMsg)
                                                                                        }*/

                        $.datetimepicker.setLocale('en');
                        $('#datetimepicker').datetimepicker({
                            yearOffset: 0
                            , lang: 'nl'
                            , timepicker: false
                            , format: 'd/m/Y'
                            , formatDate: 'Y/m/d', //minDate: '-1970/01/02', // yesterday is minimum date
                            maxDate: '+1970/01/01' // and today is maximum date calendar
                        });
                    </script>
</body>

</html>
