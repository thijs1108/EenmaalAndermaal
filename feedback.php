<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <?php include('includes/header.php'); ?>
        <script>
            function showVraag(vraag) {
                if (vraag == "") {
                    document.getElementById("GeheimeVraag").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("GeheimeVraag").innerHTML = xmlhttp.responseText;
                        }
                    };
                    xmlhttp.open("GET", "selectvraag.php?q=" + vraag, true);
                    xmlhttp.send();
                }
            }

        </script>
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
                            if(isset($_SESSION['username']))
                            {
                                $username = $_SESSION['username'];
                                $sql = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijd, looptijdeindeDag,looptijdeindeTijdstip, Soort_gebruiker, Feedbacksoort, Dag, Tijdstip, commentaar, kopernaam, Verkoper 
                                FROM ((Voorwerp LEFT OUTER JOIN Bod 
                                ON Voorwerp.voorwerpnummer=bod.Voorwerp)
                                LEFT OUTER JOIN Feedback ON Voorwerp.voorwerpnummer = Feedback.Voorwerp)
                                LEFT OUTER JOIN Gebruiker ON kopernaam=gebruikersnaam 
                                WHERE kopernaam ='$username' 
                                GROUP BY titel,voorwerpnummer, looptijd, looptijdeindeDag,looptijdeindeTijdstip, Soort_gebruiker, Feedbacksoort, Dag, Tijdstip, commentaar, kopernaam, Verkoper";
                                $result = sqlsrv_query($db, $sql);
                                $record=sqlsrv_fetch_array($result);
                                
                                if (isset($_GET['id'])&& $username==$record['kopernaam'])
                                {
                                    $id = $_GET['id'];
                                    
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <table>
                                    <i class="subtitle">Velden met een <span class="star">*</span> zijn verplicht</i>
                                    <tr>
                                        <td>
                                            Voorwerp:
                                        </td>
                                        <td>
                                            <?php echo $record['titel'] ; ?>
                                            <input type="hidden" name="nummer" value="<?php echo $record['voorwerpnummer'] ; ?>">
                                            <input type="hidden" name="verkoper" value="<?php echo $record['Verkoper'] ; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Algemene beoordeling:<span class="star">*</span>
                                        </td>
                                        <td>
                                            <select name="feedbacksoort" default>
                                            <option value="" selected hidden>Algemene beoordling</option>
                                            <option value="Negatief">Negatief</option>
                                            <option value="Neutraal">Neutraal</option>
                                            <option value="Postief">Positief</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Toelichting:<span class="star">*</span>
                                            <br/>
                                            <i class="subtitle">Maximaal 50 characters</i>
                                        </td>
                                        <td>
                                            <textarea name="review"  rows="2" maxlength="50" placeholder="Plaats hier u review..."></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <input type="submit" value="Verstuur" class="rechts smallbtn">
                            </form>
                            <?php
                                }
                                else if(isset($_POST['feedbacksoort']))
                                {
                                    $nummer = $_POST['nummer'];
                                    $feedback = $_POST['feedbacksoort'];
                                    $review = $_POST['review'];
                                    $verkoper = $_POST['verkoper'];

                                    $today = getdate();
                                    $date = $today['mon'].'-'.$today['mday'].'-'.$today['year'] ;
                                    $time = $today['hours'].':'.$today['minutes'].':'.$today['seconds'];    


                                    $sql = "INSERT INTO Feedback Values ($nummer,$verkoper,'$feedback','$date','$time','$review')";
                                    $result = sqlsrv_query($db, $sql);
                                    if(!$result)
                                    {
                                        header('location:mijnaccount.php');
                                    }
                                    else{
                                        header('location:mijnaccount.php');
                                    }

                                }
                                else
                                {
                                    echo 'U kunt geen review achter laten op dit product.';
                                }
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
