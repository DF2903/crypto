<?php

namespace App\One;

use PhpSpellcheck\Spellchecker\Aspell;
use PhpSpellcheck\Utils\CommandLine;
use App\One\CaesarCipher;
use App\One\Dictionary;

class CaesarCipherAttack {

    private array $abc;
    private CaesarCipher $caesarCipher;
    private Dictionary $dictionary;

    public function __construct() {

        $this->abc = range('a', 'z');
        $this->caesarCipher = new CaesarCipher();
        $this->dictionary = new Dictionary();
    }

    public function attackByOpenText(string $openText, string $cipherText) : int|string {

        if (strlen($openText) !== strlen($cipherText)) {

            return 'Texts have different lengths';
        }

        foreach($this->abc as $key => $value) {

            $encodeResult = $this->caesarCipher->encode($openText, $key);

            if ($encodeResult === strtolower($cipherText)) {

                return $key;
            }
        }

        return 'The text pair does not match the Caesar cipher';
    }

    public function attackByCipherText(string $cipherText) : array {

        $results = [];

        foreach($this->abc as $key => $value) {

            $encodeResult = $this->caesarCipher->decode($cipherText, $key);

            $results[] = (object) array('key' => $key, 'text' => $encodeResult);
        }

        return $results;

    }

    public function attackByCipherTextWIthDictionary(string $cipherText) : array {

        $results = [];

        foreach($this->abc as $key => $value) {

            $encodeResult = $this->caesarCipher->decode($cipherText, $key);
            $persentOfMeaningfulWords = $this->getPercentOfMeaningfulWords($encodeResult);

            if ($persentOfMeaningfulWords > 0) {
                $results[] = (object) array('key' => $key, 'text' => $encodeResult, 'meaningfulWords' => $persentOfMeaningfulWords);
            }

        }

        return $results;
    }

    private function getPercentOfMeaningfulWords(string $text) : float
     {
        $words = explode(' ', $text);

        $countOfMeaningfulWords = 0;

        foreach ($words as $word) {
            $dictionaryEntry = json_decode($this->dictionary->findWord($word), true);
            if (isset($dictionaryEntry[0]) && isset($dictionaryEntry[0]["word"])) $countOfMeaningfulWords++;
        }

        return round($countOfMeaningfulWords / count($words), 5);
    }

}