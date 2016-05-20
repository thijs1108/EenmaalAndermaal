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
            <?php include 'includes/database.php';?>
                <?php include 'includes/functions.php';?>
                    <div class="content">
                        <div class="large-8 columns">
                            <form action="inloggen.php" method="post">
                                <table>
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
                                </table>
                                <a href="wachtwoordvergeten.php" class="clicklink">Wachtwoord vergeten?</a>
                                <input type="submit" value="Inloggen" class="rechts smallbtn">
                                <br/>
                                <br/>
                                <a href="registreren.php" class="clicklink">Registreren</a>
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
