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
                            <?php 
                            if(isset($_GET['code'])&&isset($_GET['username']))
                            {
                                $code=$_GET['code'];
                                $username=$_GET['username'];
                                $sql = "SELECT * FROM Email_validatie LEFT OUTER JOIN Gebruiker ON Mailbox=email WHERE code = '$code' AND gebruikersnaam = '$username'";
                                $result = sqlsrv_query($db, $sql);
                                if($result == false)
                                {
                                    echo 'Deze code klopt niet';
                                }
                                else if($result == true){
                                    ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <table>
                                        <tr>
                                            <td>
                                                Gebruikersnaam:
                                            </td>
                                            <td>
                                                <input type="text" name="username" placeholder="Gebruikersnaam" onkeyup="showVraag(this.value)">
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
                                    </table>
                                    <input type="submit" value="Reseten" class="rechts smallbtn">
                                </form>
                                <?php
                                }
                            }
                            else{
                                echo 'Bent u uw wachtwoord vergeten? <a href"wachtwoordvergeten.php">Klik hier!</a>';
                            }
                            
                            
                            
                            ?>
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
</body>

</html>
