<ul class="vertical accordion-menu menu" data-accordion-menu>
    <?php
    include('database.php');
    
    $sql = "SELECT * FROM Rubriek WHERE parent=-1";
    $result = sqlsrv_query($db, $sql);
    while($record=sqlsrv_fetch_array($result))
    {
        echo '<li>';
        echo '<a href="#/?categorie='.$record['rubrieknummer'].'" class="subitem">'.$record['rubrieknaam'].'</a>';
            $first2=true;
            $sql2 = "SELECT * FROM Rubriek WHERE parent=" . $record['rubrieknummer'];
            $result2 = sqlsrv_query($db, $sql2);
            while($record2=sqlsrv_fetch_array($result2))
            {
                if($first2){
                    $first=false;
                    echo '<ul class="menu vertical sublevel-1">';
                } 

                echo '<li>';
                echo '<a href="#/?categorie='.$record2['rubrieknummer'].'" class="subitem">'.$record2['rubrieknaam'].'</a>';
                echo '</li>';
                echo '</ul>';
            }
                
        echo '</li>';
    }
    
    
    ?>
    <li>
        <a href="#" class="subitem">Auto's boten en motoren(3)</a>
        <ul class="menu vertical sublevel-1">
            <li>
                <a href="#" class="subitem">Auto's (3)</a>
                <ul class="menu vertical sublevel-2">
                    <li><a class="subitem" href="#">Suv's</a></li>
                    <li><a class="subitem" href="#">Sportwagens</a></li>
                    <li><a class="subitem" href="#">Hatchback</a></li>
                </ul>
            </li>
            <li><a class="subitem" href="#">Boten</a></li>
            <li><a class="subitem" href="#">Motoren</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="subitem">Baby (2)</a>
        <ul class="menu vertical sublevel-1">
            <li><a class="subitem" href="#">Speelgoed</a></li>
            <li><a class="subitem" href="#">Meubels</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="subitem">Muziek en Instrumenten (2)</a>
        <ul class="menu vertical sublevel-1">
            <li><a class="subitem" href="#">Muziekblad</a></li>
            <li><a class="subitem" href="#">Instrumenten</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="subitem">Meubels (2)</a>
        <ul class="menu vertical sublevel-1">
            <li><a class="subitem" href="#">Banken</a></li>
            <li><a class="subitem" href="#">Stoelen</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="subitem">Elektronica (3)</a>
        <ul class="menu vertical sublevel-1">
            <li><a class="subitem" href="#">Computers</a></li>
            <li><a class="subitem" href="#">Telefoon</a></li>
            <li><a class="subitem" href="#">Beamers</a></li>
        </ul>
    </li>
</ul>
