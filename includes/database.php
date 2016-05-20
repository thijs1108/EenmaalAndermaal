<?php
    //connectie leggen met de database
    $dbinfo = array( "Database" => "EenmaalAndermaal", "UID" => "sa", "PWD" => "SQL");
    $db = sqlsrv_connect("localhost\SQLEXPRESS", $dbinfo);

    if(!$db ) {
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
?>
