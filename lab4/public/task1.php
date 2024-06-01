<?php

require_once('../../vendor/autoload.php');

use App\Four\XTEA;

if (count($argv) < 4) {
    echo "Not all arguments received \n";
    exit();
}

try {
    $xtea = new XTEA();
    $keys_binary = random_bytes(4 * 4);
    $keys_array = XTEA::binary_key_to_int_array($keys_binary);

    if (!file_exists($argv[1])) {
        throw new \Exception("The text file does not exist");
    }

    $data = file_get_contents($argv[1]);
    $encrypted = XTEA::encrypt($data, $keys_array);
    $decrypted = XTEA::decrypt($encrypted, $keys_array);

    file_put_contents($argv[2], $encrypted);
    echo "Encrypted message writing is ended \n";

    file_put_contents($argv[3], $decrypted);
    echo "Decrypted message writing is ended \n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}