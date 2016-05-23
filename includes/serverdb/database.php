<?php
    //connectie leggen met de database
    //de server heeft een andere database dus daarom deze voor de server
    $dbinfo = array( "Database" => "iproject21", "UID" => "iproject21", "PWD" => "3EwwKS8r");
    $db = sqlsrv_connect("mssql.iproject.icasites.nl", $dbinfo);

    if(!$db ) {
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
?>
