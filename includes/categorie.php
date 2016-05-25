<ul class="vertical accordion-menu menu" data-accordion-menu>
    <?php
    include('database.php');
    
    $sql = "SELECT * FROM Rubriek WHERE parent=-1";
    $result = sqlsrv_query($db, $sql);
    //level 1
    while($record=sqlsrv_fetch_array($result))
    {
        echo '<li>';
        echo '<a href="?categorie='.$record['rubrieknummer'].'" class="subitem">'.$record['rubrieknaam'].'</a>';
            //level 2
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
                echo '<a href="?categorie='.$record2['rubrieknummer'].'" class="subitem">'.$record2['rubrieknaam'].'</a>';
                    //level 3
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
                        echo '<a href="?categorie='.$record3['rubrieknummer'].'" class="subitem">'.$record3['rubrieknaam'].'</a>';
                            //level 4
                            $first4=true;
                            $sql4 = "SELECT * FROM Rubriek WHERE parent=" . $record3['rubrieknummer'];
                            $result4 = sqlsrv_query($db, $sql4);
                            while($record4=sqlsrv_fetch_array($result4))
                            {
                                if($first4){
                                    $first4=false;
                                    echo '<ul class="menu vertical sublevel-3">';
                                } 
                                echo '<li>';
                                echo '<a href="?categorie='.$record4['rubrieknummer'].'" class="subitem">'.$record4['rubrieknaam'].'</a>';
                                    //level 5
                                    $first5=true;
                                    $sql5 = "SELECT * FROM Rubriek WHERE parent=" . $record4['rubrieknummer'];
                                    $result5 = sqlsrv_query($db, $sql5);
                                    while($record5=sqlsrv_fetch_array($result5))
                                    {
                                        if($first5){
                                            $first5=false;
                                            echo '<ul class="menu vertical sublevel-4">';
                                        } 
                                        echo '<li>';
                                        echo '<a href="?categorie='.$record5['rubrieknummer'].'" class="subitem">'.$record5['rubrieknaam'].'</a>';
                                        //maybe up to level 6??
                                        echo '</li>';

                                    }
                                    if(!$first5){
                                        echo '</ul>';
                                    }
                                
                                echo '</li>';

                            }
                            if(!$first4){
                                echo '</ul>';
                            }
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