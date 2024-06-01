<?php

require_once('../../vendor/autoload.php');

use App\One\CaesarCipher;

$caesarCipher = new CaesarCipher();

if (count($argv) < 3) {
    echo "Not all arguments received \n";
    exit();
}

if (!is_numeric($argv[2])) {
    echo "The second argument must be integer \n";
    exit();
}

echo 'Decode result: ' . $caesarCipher->decode($argv[1], (int)$argv[2]) . "\n";