<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$to = $_POST['to'];
$subject = $_POST['subject'];
$body = $_POST['body'];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

try{
    mail($to,$subject,$body,$headers);
}
catch(Exeption $e){
    echo $e;
}


?>