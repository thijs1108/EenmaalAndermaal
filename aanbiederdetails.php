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
                        <?php
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM Gebruiker WHERE gebruikersnaam ='$id'";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                            <div class="row margin">
                                <div class="large-3 columns">
                                    <?php echo '<img src="gebruikers/'.$record['gebruikersnaam'].'.jpg" alt="'.$record['gebruikersnaam'].'" class="aanbiedersfoto">'?>
                                </div>
                                <div class="large-9 columns">
                                    <?php 
                                        echo '<h3>Aanbieder:<br/>'.$record['gebruikersnaam'].'</h3>'; 
                                        echo 'Actief sinds:'.date("d-m-Y");
                                        echo '<br/>';
                                        echo 'Actieve beidingen:'.$record['Vraag'];
                                        echo '<br/>';
                                        echo 'Beoordeling van de aanbieder:';
                                        echo '<div class="stars">';
                                        if ($record['Vraag']==0)
                                        {
                                            for ($i=0; $i<3; $i++)
                                            {
                                                echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                            }
                                        }
                                        else if ($record['Vraag']==1)
                                        {
                                            echo '<img src="Images\star.png" alt="Star">';
                                            for ($i=0; $i<2; $i++)
                                            {
                                                echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                            }
                                        }
                                        else if ($record['Vraag']==2)
                                        {
                                            for ($i=0; $i<2; $i++)
                                            {
                                                echo '<img src="Images\star.png" alt="Star">';
                                            }
                                            echo '<img src="Images\star_empty.png" alt="Star Empty">';
                                        }
                                        else if ($record['Vraag']>=3)
                                        {
                                            for ($i=0; $i<3; $i++)
                                            {
                                                echo '<img src="Images\star.png" alt="Star">';
                                            }
                                        }
                                        echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <br/>
                            <div class="row margin">
                                <div class="large-12 columns">
                                    <?php
                                    echo "<h3>Aangeboden Artikelen</h3>";
                                        $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp WHERE verkopernaam ='$id' GROUP BY titel,voorwerpnummer, looptijd ";
                                        $result = sqlsrv_query($db, $sql);

                                        $i=0;
                                        echo '<table>';
                                        while($record=sqlsrv_fetch_array($result))
                                        {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo '<a href="productdetails.php?id='.$record['voorwerpnummer'].'" >';
                                            echo '<div class="product">';
                                            $_POST['id'] = $record['voorwerpnummer'];
                                            echo '<img src="voorwerpen/bieding_'.$record['voorwerpnummer'].'_01.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                            echo '<b>'.$record['titel'].'</b>';
                                            echo '<br/>';
                                            echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
                                            echo '<br/>';  
                                            echo 'Totaal aantal biedingen:'.$record['geboden'];
                                            echo '<br/>';
                                            echo 'Tijd tot sluiting:'.date("h:i:s");
                                            echo '</div>';
                                            echo '</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    echo '</table>';
                                    ?>
                                </div>
                            </div>
                    </div>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
