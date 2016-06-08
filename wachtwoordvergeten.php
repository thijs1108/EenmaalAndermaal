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
			xmlhttp.open("GET","selectvraag.php?q="+vraag,true);
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
                                if(isset($_POST['username']))
                                {
                                    $id = $_POST['username'];
                                    $sql = "SELECT * FROM Gebruiker LEFT OUTER JOIN Vraag ON Vraag= vraagnummer WHERE gebruikersnaam ='$id'";
                                    $result = sqlsrv_query($db, $sql);
                                    $record=sqlsrv_fetch_array($result);
                                    if(!$_POST['username']==$record['gebruikersnaam']){
                                        echo 'U bent niet geresitreed bij ons!';
                                        echo '<br/>';
                                        echo '<a href="registreren.php" class="clicklink">Klik hier om te registreren!</a>';
                                    }
                                    else{
                                    ?>
                                    
                                    <form action="forgot.php" method="post">
                                        <input type="hidden" name="username" value="<?php echo $id;?>">
                                        <table>
                                            <tr>
                                                <td>
                                                    Uw geheime vraag:
                                                </td>
                                                <td>
                                                    <span id="GeheimeVraag"><?php echo $record['tekstvraag'];?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Antwoord:
                                                </td>
                                                <td>
                                                    <input type="text" name="anwser" placeholder="Antwoord">
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="submit" value="Verstuur Mail" class="rechts smallbtn">
                                    </form>
                                <?php 
                                    }
                                }
                                else if(!isset($_POST['username']))
                                {
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
                                    </table>
                                    <input type="submit" value="Reseten" class="rechts smallbtn">
                                </form>
                            <?php 
                            }
                            if (isset($_GET['fout'])){
				                    echo 'Uw antwoord klopt niet.';
				                }
                            ?>
                            <br/>
                            <br/>
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
