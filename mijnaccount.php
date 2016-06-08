<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php include('includes/header.php');?>
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
						if (!$_SESSION['username']) {
							header('location:loginscreen.php');
						}
                            $id = $_SESSION['username'];
                            $sql = "SELECT gebruikersnaam, voornaam, achternaam,adresregel,postcode,Gebruiker.plaatsnaam,Land,GeboorteDag,Mailbox,wachtwoord,Vraag,antwoordtekst,Verkoper,Valid ,COUNT(titel) AS Actieve_Biedingen
                            FROM Gebruiker LEFT OUTER JOIN Voorwerp 
                            ON Gebruiker.gebruikersnaam=Voorwerp.verkopernaam
                            GROUP BY gebruikersnaam, voornaam, achternaam,adresregel,postcode,Gebruiker.plaatsnaam,Land,GeboorteDag,Mailbox,wachtwoord,Vraag,antwoordtekst,Verkoper,Valid
                            HAVING gebruikersnaam ='$id'";
                            $result = sqlsrv_query($db, $sql);

                            while($record=sqlsrv_fetch_array($result))
                            {
                            ?>
                            <div class="row margin">
<!--
                                <div class="large-3 columns">
                                    <?php echo '<img src="gebruikers/'.$record['gebruikersnaam'].'.jpg" alt="'.$record['gebruikersnaam'].'" class="aanbiedersfoto">'?>
                                    <input type="submit" value="Aanpassen" class="aanpassenknop">
                                    <br/>
                                    <br/>
                                </div>
-->
                                <div class="large-5 columns">
                                    <?php 										
                                        echo '<h3>Aanbieder:<br/>'.$record['gebruikersnaam'].'</h3>'; 
                                        echo 'Actief sinds:'.date("d-m-Y");
                                        echo '<br/>';
                                        echo 'Actieve beidingen:'.$record['Actieve_Biedingen'];
                                        echo '<br/>';
										if($record['Verkoper'] == 1){
											echo '<a href="artikelaanbieden.php" class="clicklink">Artikel aanbieden</a>';
											echo '<br/>';
										} else {			
											echo '<a href="verkoopaccountaanmaken.php" class="clicklink">Verkoop account aanmaken</a>';
											echo '<br/>';
										}
//                                        echo 'Beoordeling van de aanbieder:';
//                                        echo '<div class="stars">';
//                                        if ($record['Vraag']==0)
//                                        {
//                                            for ($i=0; $i<3; $i++)
//                                            {
//                                                echo '<img src="Images\star_empty.png" alt="Star Empty">';
//                                            }
//                                        }
//                                        else if ($record['Vraag']==1)
//                                        {
//                                            echo '<img src="Images\star.png" alt="Star">';
//                                            for ($i=0; $i<2; $i++)
//                                            {
//                                                echo '<img src="Images\star_empty.png" alt="Star Empty">';
//                                            }
//                                        }
//                                        else if ($record['Vraag']==2)
//                                        {
//                                            for ($i=0; $i<2; $i++)
//                                            {
//                                                echo '<img src="Images\star.png" alt="Star">';
//                                            }
//                                            echo '<img src="Images\star_empty.png" alt="Star Empty">';
//                                        }
//                                        else if ($record['Vraag']>=3)
//                                        {
//                                            for ($i=0; $i<3; $i++)
//                                            {
//                                                echo '<img src="Images\star.png" alt="Star">';
//                                            }
//                                        }
//                                        echo '</div>';
                                        }
                                    ?>
                                </div>
                                <div class="large-4 columns">
                                    <form action='uitloggen.php' method= 'POST'>
										<input type="submit" value="Uitloggen" class="uitlogknop">
									</form>
                                </div>
                            </div>
                            <br/>
                            <div class="row margin">
                                <div class="large-6 columns">
                                    <?php
                                    echo "<h3>Mijn biedingen</h3>";
                                        $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd 
                                        FROM Voorwerp LEFT OUTER JOIN Bod 
                                        ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                        WHERE Gebruiker ='$id' GROUP BY titel,voorwerpnummer, looptijd";
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
                                            
                                            $img = "SELECT TOP 1 * FROM Bestand WHERE Voorwerp =".$record['voorwerpnummer'];
                                            $plaatje = sqlsrv_query($db, $img);
                                            $afbeelding=sqlsrv_fetch_array($plaatje);
                                            if($afbeelding==true){
                                                echo '<img src="'.$afbeelding['filenaam'].'" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                            }
                                            else {
                                                echo '<img src="Images/placeholder_product.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";   
                                            }
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
                                <div class="large-6 columns">
                                    <?php
                                    echo "<h3>Mijn aangeboden artikelen</h3>";
                                        $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp WHERE verkopernaam ='$id' GROUP BY titel,voorwerpnummer, looptijd";
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
                                            $img = "SELECT TOP 1 * FROM Bestand WHERE Voorwerp =".$record['voorwerpnummer'];
                                            $plaatje = sqlsrv_query($db, $img);
                                            $afbeelding=sqlsrv_fetch_array($plaatje);
                                            if($afbeelding==true){
                                                echo '<img src="'.$afbeelding['filenaam'].'" alt="'.$record['titel'].'" class="prdimg">'."<br>";
                                            }
                                            else {
                                                echo '<img src="Images/placeholder_product.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";   
                                            }
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

    <?php include 'includes/footer.php';?>     <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
</body>

</html>
