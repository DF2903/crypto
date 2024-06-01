<?php

require_once('../../vendor/autoload.php');

use App\Three\Vernam;

if (count($argv) < 5) {
    echo "Not all arguments received \n";
    exit();
}

try {
    if (!file_exists($argv[1])) {
        throw new \Exception("The text file does not exist");
    }
    
    if (!file_exists($argv[2])) {
        throw new \Exception("The key file does not exist");
    }
    
    $originalText = file_get_contents($argv[1]);
    $key = file_get_contents($argv[2]);
    
    $cipherResult = new Vernam($originalText, $key);
    $cipherString = (string)$cipherResult;
    file_put_contents($argv[3], $cipherString);
    echo "Encrypted message writing is ended \n";
    
    $plainResult = new Vernam( $cipherString, $key );
    $plainString = (string)$plainResult;
    file_put_contents($argv[4], $plainString);
    echo "Decrypted message writing is ended \n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}