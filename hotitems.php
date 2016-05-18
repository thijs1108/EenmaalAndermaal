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
        echo '<img src="voorwerpen/bieding_'.$record['voorwerpnummer'].'_01.png" alt="'.$record['titel'].'" class="prdimg">'."<br>";
        echo '<b>'.$record['titel'].'</b>';
        echo '<br/>';
        echo 'Hoogste bod: € '.number_format($record['maxbedrag'],2);
        echo '<br/>';  
        echo 'Totaal aantal biedingen:'.$record['geboden'];
        echo '<br/>';
        echo 'Tijd tot sluiting:';
        echo '<br/>'; 
        
        $date = date_format($record['looptijdeindeDag'], 'Y-m-d');
        echo '<div class="alt-2">'.$date.'</div>';
        
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
