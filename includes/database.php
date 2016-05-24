<?php
    //connectie leggen met de database
    $dbinfo = array( "Database" => "iproject21", "UID" => "iproject21", "PWD" => "3EwwKS8r");
    $db = sqlsrv_connect("mssql.iproject.icasites.nl", $dbinfo);

    if(!$db ) {
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
    }
?>
