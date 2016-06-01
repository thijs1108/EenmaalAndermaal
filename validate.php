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
                            
                            if(isset($_GET['remail'])){
                                $code = rand(0, 9999999);
                                $valid_on= date("Y-m-d");
                                $username = $_GET['username'];
                                $sql = "SELECT Mailbox FROM Gebruiker WHERE gebruikersnaam='".$_GET['username']."'";
                                $result = sqlsrv_query($db, $sql);
                                $record = sqlsrv_fetch_array($result);
                                $email = $record[0];
                                
                                $sql= "INSERT INTO Email_validatie VALUES ('$email','$code','$valid_on')";
                                sqlsrv_query($db,$sql);

                                $url = 'http://iproject21.icasites.nl/includes/sendmail.php';
                                $body= 'U heeft u geregistreerd op de website van EenmaalAndermaal, uw persoonlijke code is: '.$code.'     <br>U kunt ook klikken op: http://iproject21.icasites.nl/validate.php';
                                $body.= '?username='.$username.'&code='.$code;
                                $data = 'to=' . $email . '&subject=Uw%20Code&body='.$body;
                                $ch = curl_init( $url );
                                curl_setopt( $ch, CURLOPT_POST, 1);
                                curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
                                curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                                curl_setopt( $ch, CURLOPT_HEADER, 0);
                                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

                                $response = curl_exec( $ch );
                            }
                            
                            if(isset($_GET['code'])){ 
                            
                                $sql = "SELECT Mailbox FROM Gebruiker WHERE gebruikersnaam='".$_GET['username']."'";
                                $result = sqlsrv_query($db, $sql);
                                $record = sqlsrv_fetch_array($result);

                                $sql = "SELECT code FROM Email_validatie WHERE email='".$record[0]."' AND code='".$_GET['code']."'";
                                $result = sqlsrv_query($db, $sql);
                                $record = sqlsrv_fetch_array($result);
                                $username = $_GET['username'];

                                if(count($record)>0)
                                {
                                    
                                    $sql = "UPDATE Gebruiker SET valid=1 WHERE gebruikersnaam='".$_GET['username']."'";
                                    $result = sqlsrv_query($db, $sql);
                                    echo"Gebruiker gevalideerd";
                                }
                                else{
                                    echo"Code onjuist";
                                    echo"<br><a href='validate.php?username=$username'>Probeer opnieuw</a>";
                                    echo"<br><a href='validate.php?username=$username&remail=true'>Stuur nieuwe mail</a>";
                                }
    
                            } else{ ?>
                            
                            Voor de validatiecode in die op het emailadres van <?php echo $_GET['username']; ?> is ontvangen:<br>
                            <form method="get" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                                <input type="text" name="code"><input type=submit>
                                <input type=hidden name="username" value="<?php echo $_GET['username']; ?>">
                            </form>
                            
                            <?php } ?>
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
