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
        <?php include 'menu.php';?>
            <?php include 'database_connectie.php';?>
                <?php include 'functions.php';?>
                    <div class="content">
                        <div class="large-8 columns">
                            <form action="forgot.php" method="post">
                                <?php 
                                $id = "JanPiet";
                                $sql = "SELECT * FROM Gebruiker LEFT OUTER JOIN Vraag ON Vraag= vraagnummer WHERE gebruikersnaam ='$id'";
                                $result = sqlsrv_query($db, $sql);

                                while($record=sqlsrv_fetch_array($result))
                                {
                                ?>
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
                                            Uw geheime vraag:
                                        </td>
                                        <td>
                                           <?php echo $record['tekstvraag']; ?>
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
                                <?php } ?>
                                <input type="submit" value="Reseten" class="rechts smallbtn">
                            </form>
                            <br/>
                            <br/>
                        </div>
                        <div class="large-4 columns">
                            <?php include 'hotitems.php';?>
                        </div>
                    </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
