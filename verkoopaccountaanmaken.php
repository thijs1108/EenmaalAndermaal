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
                        <div class="large-6 columns">
                            <?php
                            $id = "JanPiet";
                            $sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam ='$id'";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                                <form action="vkaa.php" method="post">
                                    <table>
                                        <tr>
                                            <td>
                                                Gebruikersnaam:
                                            </td>
                                            <td>
                                                <?php echo $record['gebruikersnaam']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bank:
                                            </td>
                                            <td>
                                                <input type="text" name="bank" placeholder="Bank">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Rekeningnummer:
                                            </td>
                                            <td>
                                                <input type="password" name="number" placeholder="Rekeningnummer">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Controle via:
                                            </td>
                                            <td>
                                                <input type="radio" name="check" value="creditcard" checked>Creditcard
                                                <input type="radio" name="check" value="post">Post
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Creditcardnummer:
                                            </td>
                                            <td>
                                                <input type="text" name="creditcard" placeholder="Creditcardnummer">
                                            </td>
                                        </tr>
                                    </table>
                                     <input type="submit" value="Aanmaken" class="rechts smallbtn">
                                </form>
                                <?php 
                            }
                            ?>
                            <br/>
                            <br/>
                        </div>
                    </div>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
