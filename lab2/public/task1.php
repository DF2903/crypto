<?php

require_once('../../vendor/autoload.php');

use App\Two\StatsCounter;

if (count($argv) < 3) {
    echo "Not all arguments received \n";
    exit();
}

$needle = $argv[2];

if (strlen($needle) > 1) {
    echo "The second argument must be a symbol \n";
    exit();
}

try {
    if (!file_exists($argv[1])) {
        throw new \Exception("The text file does not exist");
    }
    
    $statsCounter = new StatsCounter();
    
    $haystack = file_get_contents($argv[1]);
    
    $frequency = $statsCounter->getFileSymbolsFrequency($needle, $haystack)[0];
    
    echo 'Symbol frequency : ' . $frequency->frequency . "\n";

} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}