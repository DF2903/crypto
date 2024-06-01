<?php

require_once('../../vendor/autoload.php');

use App\Two\StatsCounter;

if (count($argv) < 3) {
    echo "Not all arguments received \n";
    exit();
}

$needle = $argv[2];
$statsCounter = new StatsCounter();

try {
    if (!file_exists($argv[1])) {
        throw new \Exception("The text file does not exist");
    }
    
    $haystack = file_get_contents($argv[1]);
    
    $entropy = $statsCounter->getTextEntropyBySymbolFrequencies($needle, $haystack);
    
    echo "Entropy for symbols $needle: $entropy" . "\n";
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit();
}