<?php

function encrypt($string) {
    $output = false;
    $action = 'encrypt';

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('MD5', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('MD5', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    return $output;
}

$words = ["SELECT", "select", "*","--","'"];
$string = NULL;

// Use this function to strip illegal characters/words from the string:
function prepare_inputs($string,$words) {
    foreach($words AS $word) {
        if(stripos($string, $word)!==false){
            $string = str_replace($word, "", $string);       
        }
    }
    
    return $string;
}
// Use this function to check if a string contains the given characters/words, if return is false, then the string is invalid.
function check_inputs($string,$words) {
    $returnable = TRUE;
    
    foreach($words AS $word) {
        if(stripos($string, $word)!==false){
            $returnable = FALSE;
        }
    }
    
    return $returnable;
}

?>
