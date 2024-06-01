<?php

namespace App\Three;

class FileWorker {

    private array $abc;

    public function __construct() {
        $this->abc = array_merge(range(0, 9), range('a', 'z'));
    }

    public function generateRandomTextFile (int $symbolCount, string $fileName = null) {
        try {
            $fileContent = $this->generateRandomString($symbolCount);
            $fileName = $fileName ? $fileName . '.txt' : $this->generateRandomString(20) . '.txt';
    
            $newFile = fopen($fileName, "w");
            fwrite($newFile, $fileContent);
            fclose($newFile);
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            exit();
        }
    }

    private function generateRandomString (int $length) : string {
        
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $this->abc[array_rand($this->abc)];
        }

        return $randomString;
    }
}