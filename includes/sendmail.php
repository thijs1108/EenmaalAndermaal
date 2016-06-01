<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['body'];

try{
    mail($to,$subject,$body);
}
catch(Exeption $e){
    echo $e;
}


?>