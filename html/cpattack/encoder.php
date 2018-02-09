<?php

$plaintext = $_POST['plaintext'];
$key = '|/igen3re';
$ciphertext = '';
$source = '0123456789!"#$%&\'()-=^~\\|@`[]{};+:*,.<>/?_ abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

error_log("Plaintext=$plaintext");

if(!is_string($plaintext)) {
    echo '';
    exit();
}

for($i = 0; $i < strlen($plaintext); $i++) {
    $p_i = strpos($source, $plaintext[$i]);
    if($p_i !== false) {
        $k_i = strpos($source, $key[$i % strlen($key)]);
        $c_i = ($p_i + $k_i) % strlen($source);
        $ciphertext .= $source[$c_i];
    } else {
        $ciphertext .= $plaintext[$i];
    }
}

echo $ciphertext;

?>
