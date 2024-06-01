<?php

namespace App\Two;

class StatsCounter {

    public function getTextEntropyBySymbolFrequencies(string $symbols, string $text) : float {

        $entropy = 0;
        $frequencies = $this->getFileSymbolsFrequency($symbols, $text);

        foreach ($frequencies as $frequency) {
            if ($frequency->frequency > 0) $entropy += $frequency->frequency * log(floatval($frequency->frequency), 2);
        }

        return $entropy * -1;
    }

    public function getFileSymbolsFrequency(string $needle, string $haystack) : array {

        $needleSymbols = str_split($needle);
        $haystackLength = strlen($haystack);
        $results = [];

        foreach ($needleSymbols as $symbol) {
            $symbolCount = substr_count($haystack, $symbol);
            $symbolFrequency = $symbolCount / $haystackLength;
            $results[] = (object) array('symbol' => $symbol, 'frequency' => $symbolFrequency);
        }

        return $results;
    }
}