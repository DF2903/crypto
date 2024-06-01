<?php

namespace App\One;

class Dictionary {
    private const DICTIONARY_URL = 'https://api.dictionaryapi.dev/api/v2/entries/en/';

    public function findWord (string $word) :string 
    {
        $curl = curl_init(self::DICTIONARY_URL . $word);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }

}