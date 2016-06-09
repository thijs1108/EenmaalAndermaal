<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php include('includes/header.php'); ?>

    <link rel="stylesheet" type="text/css" href="datepicker/jquery.datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="awesomefont/css/font-awesome.min.css">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php include('includes/database.php'); ?>

</head>

<body>
    <?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $voornaam = $_POST['firstname'];
        $achternaam = $_POST['lastname'];
        $adres = $_POST['adres'];
        $postcode = $_POST['postalcode'];
        $plaats = $_POST['place'];
        $land = $_POST['country'];
        $datum = $_POST['birthday'];
        $datumfix=$datum[6].$datum[7].$datum[8].$datum[9].'/'.$datum[3].$datum[4].'/'.$datum[0].$datum[1];
        $email = $_POST['email'];
        $wachtwoord = $_POST['password'];
        $vraag = $_POST['secretquestion'];
        $antwoord = $_POST['answer'];
        
        $siteKey = '6LdSySATAAAAAMeX7dp0wyqXHLNS3C5O6f87Ut7P';
        $secret = '6LdSySATAAAAAPuV_9do9HkzZTKyIo1JOj4YI76u';


        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
         /*   $capchaResponse = "";
            //vraag Captcha gegevens op
            if (isset($_POST['g-recaptcha-response']))
            {
                    require('autoload.php');
                    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                    $capchaResponse = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }    
            //error wanneer capcha niet klopt
            if ((empty($capchaResponse)) || (!$capchaResponse->isSuccess()))
            {
                
            }
            else{*/
                $sql="INSERT INTO Gebruiker VALUES ('$username','$voornaam','$achternaam','$adres', '$postcode', '$plaats','$land','$datumfix', '$email', '$wachtwoord',$vraag,'$antwoord',0,0)";
                if(sqlsrv_query($db,$sql)){
                    
                    $code = rand(0, 9999999);
                    $valid_on= date("Y-m-d");
                    $sql= "INSERT INTO Email_validatie VALUES ('$email','$code','$valid_on')";
                    sqlsrv_query($db,$sql);
                    
                    $url = 'http://iproject21.icasites.nl/includes/sendmail.php';
                    $body= '<head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Eenmaal Andermaal</title>
                <style>
                a {
                    float: left;
                    margin-left:20px;
                    inline: block;
                    color:#3F5FB5;
                }

                .button {
                    background-color: #3F5FB5;
                    color: #FFFFFF;
                    padding: 15px 32px;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                }

                .button:hover{
                    background-color:#FFB600;
                }
                </style>
            </head>
            <body>
                <div class="row">
                    <img src="http://iproject21.icasites.nl/Images/Logo_v1.1.png" alt="Logo" width="250px">
                        <div class="content">
                            <a href="http://iproject21.icasites.nl/index.php"class="button">Home</a></li>
                            <a href="http://iproject21.icasites.nl/mijnaccount.php"class="button">Mijn Account</a>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                    
                    U heeft u geregistreerd op de website van EenmaalAndermaal, uw persoonlijke code is: '.$code.'     <br>U kunt ook klikken op: http://iproject21.icasites.nl/validate.php
                    </div>
                </div>
            </body>
                    
                    
                    ';
                    $body.= '?username='.$username.'&code='.$code;
                    $data = 'to=' . $email . '&subject=Uw%20Code&body='.$body;
                    $ch = curl_init( $url );
                    curl_setopt( $ch, CURLOPT_POST, 1);
                    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt( $ch, CURLOPT_HEADER, 0);
                    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

                    $response = curl_exec( $ch );
                    
                    header("location: validate.php?username=$username");
                }
                else{
                    if( ($errors = sqlsrv_errors() ) != null) {
                        foreach( $errors as $error ) {
                                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                                echo "code: ".$error[ 'code']."<br />";
                                echo "message: ".$error[ 'message']."<br />";
                            }
                        }
                    }
            //}
        }
    }

    ?>
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
                                <i class="subtitle">Velden met een <span class="star">*</span> zijn verplicht</i>
                                <table>
                                    <tr>
                                        <td style="vertical-align:top">
                                            Email: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="email" placeholder="voorbeeld@voorbeeld.nl" id="email" onkeyup="check_email()" onchange="check_email()" maxlength="50">
                                            <div class="email-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            Gebruikersnaam: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="username" id="username" placeholder="Gebruikersnaam" onkeyup="check_availability()" onchange="check_availability()" maxlength="50">
                                            <div class="username-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            Wachtwoord: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="password" name="password" placeholder="Wachtwoord" id="password" onkeyup="check_password()" onchange="check_password()" maxlength="30">
                                            <div class="password-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">
                                            Herhaal Wachtwoord: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="password" name="confirmpassword" placeholder="Wachtwoord" id="second_password" onkeyup="check_second_password()"
                                             onchange="check_second_password()" maxlength="30">
                                            <div class="second_password-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Voornaam: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="firstname" placeholder="Voornaam" id="voornaam" onkeyup="check_voornaam()"
                                                    onchange="check_voornaam()" maxlength="50">
                                            <div class="voornaam-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Achternaam: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="lastname" placeholder="Achternaam" id="achternaam"
                                             onchange="check_achternaam()" onkeyup="check_achternaam()" maxlength="50">
                                            <div class="achternaam-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telefoonnummer 1: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="phone1" placeholder="Telefoonnummer 1" id="telefoon" onkeyup="check_telefoon()" onchange="check_telefoon()">
                                            <div class="telefoon-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telefoonnummer 2:
                                        </td>
                                        <td class="field">
                                            <input type="text" name="phone2" placeholder="Telefoonnummer 2">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="large-6 columns">
                                <table>
                                    <tr>
                                        <td>
                                            Adres: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="adres" placeholder="Adres" id="adres" onkeyup="check_adres()" onchange="check_adres()"
                                                   maxlength="255">
                                            <div class="adres-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Postcode: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="postalcode" placeholder="1234 AB" id="postcode" onkeyup="check_postcode()" onchange="check_postcode()"
                                                   maxlength="7">
                                            <div class="postcode-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Plaats: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="place" placeholder="Plaats"
                                            id="plaats" onkeyup="check_plaats()" maxlength="25" onchange="check_plaats()">
                                            <div class="plaats-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Land: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input type="text" name="country" placeholder="Land" id="land" onkeyup="check_land()" maxlength="50" onchange="check_land()">
                                            <div class="land-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Geboortedatum: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <input id="datetimepicker" name="birthday" type="text" placeholder="&#xf073;  20/01/1990" class="fontawesome">
                                            <div class="datum-box"></div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Geheime vraag: <span class="star">*</span>
                                        </td>
                                        <td class="field">
                                            <select name="secretquestion" id="vraag" onkeyup="check_vraag()" onchange="check_vraag()">
                                                <option value=1>In welke straat ben je geboren?</option>
                                                <option value=2>Wat is de meisjesnaam van je moeder?</option>
                                                <option value=3>Wat is je lievelingsgerecht?</option>
                                                <option value=4>Hoe heet je oudste zusje</option>
                                                <option value=5>Hoe heet je huisdier?</option>
                                            </select>
                                            <div class="vraag-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Antwoord: <span class="star">*</span>
                                        </td>
                                        <td>
                                            <input type="text" name="answer" placeholder="Antwoord" id="antwoord" onkeyup="check_antwoord()" onchange="check_antwoord()" maxlength="255">
                                            <div class="antwoord-box"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><!--<div class="g-recaptcha" data-sitekey="<?php //echo $siteKey; ?>"></div>--></td>
                                    </tr>
                                </table>
                                <input id="submitregister" type="submit" value="Registreren" class="rechts smallbtn" disabled>
                            </div>
                        </form>







                        </div>

                    </div>
                    <?php include 'includes/footer.php';?>     
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
