<?php

namespace App\One;

class CaesarCipher {

    private array $abc;

    public function __construct()
    {
        $this->abc = range('a', 'z');
    }

    public function encode(string $text, int $casas) :string {

        $decifrado = '';

        foreach (str_split(strtolower($text)) as $letter) {

            if (ctype_alpha($letter)) {

                foreach ($this->abc as $key => $alpha) {

                    if ($letter === $alpha) {

                        if (($key + $casas) >= count($this->abc)) {

                            $decifrado .= $this->abc[(($key + $casas) - count($this->abc))];

                        } else {

                            $decifrado .= $this->abc[($key + $casas)];

                        }
                    }
                }
            } else {

                $decifrado .= $letter;
            }
        }
        return $decifrado;
    }

    public function decode(string $text, int $casas) :string {

        $decifrado = '';

        foreach (str_split(strtolower($text)) as $letter) {

            if (ctype_alpha($letter)) {

                foreach ($this->abc as $key => $alpha) {

                    if ($letter === $alpha) {

                        if (($key - $casas) < 0) {

                            $decifrado .= $this->abc[(($key - $casas) + count($this->abc))];

                        } else {

                            $decifrado .= $this->abc[($key - $casas)];

                        }
                    }
                }
            } else {
                $decifrado .= $letter;
            }
        }
        return $decifrado;
    }
}