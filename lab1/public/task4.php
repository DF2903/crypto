<?php

require_once('../../vendor/autoload.php');

use App\One\CaesarCipherAttack;

$caesarCipherAttack = new CaesarCipherAttack();

if (count($argv) < 2) {
    echo "Not all arguments received \n";
    exit();
}

$results = $caesarCipherAttack->attackByCipherTextWIthDictionary($argv[1]);

if (count($results) > 0) {

    foreach ($results as $result) {

        echo "Result for key $result->key: $result->text. Meaningful persent:$result->meaningfulWords \n"; 
    }

} else {
    echo "No messages found with meaning \n";
}