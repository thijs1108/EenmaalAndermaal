<?php
include('database.php');
//get the username
$username = stripslashes($_POST['username']);
//mysql query to select field username if it's equal to the username that we check '
$sql='SELECT gebruikersnaam FROM Gebruiker WHERE gebruikersnaam = \''. $username .'\'';
$result = sqlsrv_query($db, $sql);
$i=0;
while(sqlsrv_fetch_array($result)){
    $i++;
}
//if number of rows fields is bigger them 0 that means it's NOT available '
if($i==1){
    //and we send 0 to the ajax request
    echo 0;
}else{
    //else if it's not bigger then 0, then it's available '
    //and we send 1 to the ajax request
    echo 1;
}
?>