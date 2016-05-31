<?php
echo "<h3>Hot items!</h3>";
    $sql = "SELECT TOP 2 titel,voorwerpnummer, max(Bodbedrag)as maxbedrag, COUNT(Bodbedrag)as geboden,looptijdeindeDag, looptijdeindeTijdstip FROM Voorwerp LEFT OUTER JOIN Bod ON Voorwerp.voorwerpnummer=bod.Voorwerp GROUP BY titel,voorwerpnummer, looptijdeindeDag, looptijdeindeTijdstip";
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
        
        echo 'Tijd tot sluiting:';
        $date = date_format($record['looptijdeindeDag'], 'Y-m-d');
        $time = date_format($record['looptijdeindeTijdstip'], 'H:i:s');
        echo '<div class="alt-2 right">'.$date.' '.$time.'</div>';
        
        echo '</div>';
        echo '</a>';
        echo '</td>';
        echo '</tr>';
    }
echo '</table>';
?>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script>
        window.jQuery(function($) {
            "use strict";

            $('time').countDown({
                with_separators: false
            });
            $('.alt-1').countDown({
                css_class: 'countdown-alt-1'
            });
            $('.alt-2').countDown({
                css_class: 'countdown-alt-2'
            });

        });

    </script>
