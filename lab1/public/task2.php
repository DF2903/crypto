<?php

require_once('../../vendor/autoload.php');

use App\One\CaesarCipherAttack;

$caesarCipherAttack = new CaesarCipherAttack();

if (count($argv) < 3) {
    echo "Not all arguments received \n";
    exit();
}

$result = $caesarCipherAttack->attackByOpenText($argv[1], $argv[2]);

if (is_int($result)) {

    echo 'Result key: ' . $result . "\n";
} else {
    echo $result . "\n";
}