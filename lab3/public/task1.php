<?php

require_once('../../vendor/autoload.php');

use App\Three\FileWorker;

$fileGenerator = new FileWorker();

if (count($argv) < 3) {
    echo "Not all arguments received \n";
    exit();
}

if (!is_numeric($argv[1])) {
    echo "The second argument must be integer \n";
    exit();
}

$fileGenerator->generateRandomTextFile((int)$argv[1], $argv[2]);

echo 'File created successfully' . "\n";