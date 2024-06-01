<?php

namespace App\Three;

class Vernam {

	private $text;
	private $key;
	private $bytes;
	private $textNew;
	private $textLen;
	private $keyLen;
	private $len;

	function __construct( $text, $key, $bytes = 1500 ) {
		$this->text = $text;
		$this->key = $key;
		$this->bytes = $bytes;
		$this->textNew = str_split($text);
		$this->textLen = strlen($text);
		$this->keyLen = strlen($key);
		$this->len = 0;
	}

	function slow() {
		if ($this->textLen <= 200000) {
			foreach( $this->textNew as $k=>$value ) {
				$this->textNew[$k] = $value ^ $this->key[$k % $this->keyLen];
			}
		} else {
			--$this->len;
			while ( ++$this->len < $this->textLen ) {
				$this->textNew[$this->len] = $this->text[$this->len] ^ $this->key[$this->len % $this->keyLen];
			}
		}

		return implode('', $this->textNew);
	}

	function fast() {
		$this->textNew[$this->len] = $this->text[$this->len] ^ $this->key[$this->len % $this->keyLen];
		return (++$this->len < $this->textLen) ? $this->fast() : implode('', $this->textNew);
	}

	function __toString() {
		return ($this->textLen <= $this->bytes) ? $this->fast() : $this->slow();
	}
}

class Vcrypt extends Vernam {
	function encode() {
		$this->text = gzdeflate(htmlspecialchars(stripslashes(trim($this->text))), 9);
		$this->textNew = str_split($this->text);
		return $this->slow();
	}

	function decode() {
		$this->text = $this->slow();
		return gzinflate($this->text);
	}
}
?>