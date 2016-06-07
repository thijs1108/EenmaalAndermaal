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
										<?php 
											if (isset($_GET['fout'])){
												echo 'Graag gebruikersnaam en wachtwoord invoeren.';
											} else if (isset($_GET['fout2'])){
												echo 'Gebruikersnaam en wachtwoord kloppen niet.';
											}
                                            else if (isset($_GET['fout3'])){
                                                echo 'U moet inloggen om een bieding te plaatsen.';
                                            }
                                            else if (isset($_GET['reset']))
                                            {
                                                echo 'U ontvangt spoedig een mail om u wachtwoord te veranderen.';
                                            }
											
										?>
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
    <?php include 'includes/footer.php';?>     <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
