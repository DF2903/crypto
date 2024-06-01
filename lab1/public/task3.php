<?php

require_once('../../vendor/autoload.php');

use App\One\CaesarCipherAttack;

$caesarCipherAttack = new CaesarCipherAttack();

if (count($argv) < 2) {
    echo "Not all arguments received \n";
    exit();
}

$results = $caesarCipherAttack->attackByCipherText($argv[1]);

foreach ($results as $result) {

    echo "Result for key $result->key: $result->text \n"; 
}