<div class="navigation">
   <ul class="pagination" role="navigation" aria-label="Pagination">
       <?php 
        //telt hoeveel pagina's er gemaakt moeten worden
            $aantal = 10;
            if(isset($_GET['page']))
            {
                $page = $_GET['page'];
            }
            else{
                $page =1;
            }
            if (isset($zoekterm) && isset($_SESSION['categorie'])){
                $categorie = $_SESSION['categorie'];
                $SqlAantalItems = "SELECT titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                    FROM Voorwerp 
                                    LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                    INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                    WHERE titel LIKE '%$zoekterm%' AND Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie
                                    GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
            }
            else if (isset($zoekterm)){
                $SqlAantalItems = "SELECT titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                    FROM Voorwerp 
                                    LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                    WHERE titel LIKE '%$zoekterm%' 
                                    GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
            }
            else if (isset($_SESSION['categorie'])){
                $categorie = $_SESSION['categorie'];
                $SqlAantalItems = "SELECT titel, Voorwerp.voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip 
                                    FROM Voorwerp 
                                    LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp 
                                    INNER JOIN Voorwerp_in_rubriek ON Voorwerp_in_rubriek.voorwerpnummer = Voorwerp.voorwerpnummer
                                    WHERE Voorwerp_in_rubriek.RubriekOpLaagsteNiveau = $categorie 
                                    GROUP BY titel, Voorwerp.voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
            }
            else{
                $SqlAantalItems = "SELECT * FROM Voorwerp";
            }
            $stmt = sqlsrv_query( $db, $SqlAantalItems , array(), array( "Scrollable" =>    SQLSRV_CURSOR_KEYSET ));
            $aantalItem = sqlsrv_num_rows($stmt);
            $pages = ceil($aantalItem/$aantal);
            
            if($pages>0){
                echo '<li><a href="?page=1" aria-label="First page">«««</a></li>';
            
                if($page==1)
                {
                    echo '<li class="disabled">«</li>';
                }
                else{
                    ?>
                    <li><a href="?page=<?php echo $page-1 ?>" aria-label="Previous page">«</a></li>
                    <?php
                }
                echo '<span class="show-for-sr">Previous page</span>';

                if($page<=5)
                {
                    $number = 1;
                    if($pages<10)
                    {
                        $pagesmax = $pages;
                    }
                    else{
                        $pagesmax = 10;
                    }
                }
                else if($page >=$pages-5)
                {
                    if($pages<10)
                    {
                        $number= 1;
                        $pagesmax = $pages;
                    }
                    else{
                        $number = $pages-10;
                        $pagesmax = $pages;
                    }
                }
                else{
                    $number = $page-5;
                    $pagesmax = 5+$page; 
                }


                for($number; $number<=$pagesmax;$number++)
                {
                    if($page == $number){
                    echo '<li class="current"><span class="show-for-sr">You re on page</span>'.$number.'</a></li>';
                }
                else{
                    echo '<li><a href="?page='.$number.'" aria-label="Page'.$number.' ">'.$number.'</a></li>';
                    }
                }

                if($page==$pages)
                {
                    echo '<li class="disabled">»</li>';
                }
                else{
                    ?>
                    <li><a href="?page=<?php echo $page+1 ?>" aria-label="Next page">»</a></li>
                    <?php
                }
                echo '<span class="show-for-sr">Next page</span>';

                echo '<li><a href="?page='.$pages.'" aria-label="Last page">»»»</a></li>';
            }
            ?>
    </ul>
</div>
