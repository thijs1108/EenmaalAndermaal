<ul class="vertical accordion-menu menu" data-accordion-menu>
    <?php
    include('database.php');
    
    $sql = "SELECT * FROM Rubriek WHERE parent=-1";
    $result = sqlsrv_query($db, $sql);
    //laag 1
    while($record=sqlsrv_fetch_array($result))
    {
        echo '<li>';
        echo '<a href="#/?categorie='.$record['rubrieknummer'].'" class="subitem">'.$record['rubrieknaam'].'</a>';
            //laag 2
            $first2=true;
            $sql2 = "SELECT * FROM Rubriek WHERE parent=" . $record['rubrieknummer'];
            $result2 = sqlsrv_query($db, $sql2);
            while($record2=sqlsrv_fetch_array($result2))
            {
                if($first2){
                    $first2=false;
                    echo '<ul class="menu vertical sublevel-1">';
                } 
                echo '<li>';
                echo '<a href="#/?categorie='.$record2['rubrieknummer'].'" class="subitem">'.$record2['rubrieknaam'].'</a>';
                    //laag3
                    $first3=true;
                    $sql3 = "SELECT * FROM Rubriek WHERE parent=" . $record2['rubrieknummer'];
                    $result3 = sqlsrv_query($db, $sql3);
                    while($record3=sqlsrv_fetch_array($result3))
                    {
                        if($first3){
                            $first3=false;
                            echo '<ul class="menu vertical sublevel-2">';
                        } 
                        echo '<li>';
                        echo '<a href="#/?categorie='.$record3['rubrieknummer'].'" class="subitem">'.$record3['rubrieknaam'].'</a>';
                        echo '</li>';

                    }
                    if(!$first3){
                        echo '</ul>';
                    }
                echo '</li>';
                
            }
            if(!$first2){
                echo '</ul>';
            }
        echo '</li>';
    }
    
    
    ?>
</ul>
