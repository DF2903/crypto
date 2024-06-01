<?php

require_once('../../vendor/autoload.php');

use App\Three\RC4;

if (count($argv) < 5) {
    echo "Not all arguments received \n";
    exit();
}

$rc4 = new RC4();

try {

    if (!file_exists($argv[1])) {
        throw new \Exception("The text file does not exist");
    }

    if (!file_exists($argv[2])) {
        throw new \Exception("The key file does not exist");
    }

    $message = file_get_contents($argv[1]);

    $key = file_get_contents($argv[2]);
    
    $rc4->setKey($key);
    
    
    $rc4->crypt($message);
    file_put_contents($argv[3], $message);
    echo "Encrypted message writing is ended \n";
    
    $rc4->decrypt($message);
    file_put_contents($argv[4], $message);
    echo "Decrypted message writing is ended \n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}

