<?php
    //connectie leggen met de database
    $dbinfo = array( "Database" => "EenmaalAndermaal", "UID" => "sa", "PWD" => "SQL");
    $db = sqlsrv_connect("localhost\SQLEXPRESS", $dbinfo);
?>