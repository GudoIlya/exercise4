<?php 

class BNumber {

	private $maxIntLen;
	private $numberArray;


	public function setNumber($stringNumber) {
		$numberLength = strlen($stringNumber);
		$wordsNumber = ceil($numberLength / $this->maxIntLen);
		$tempCursor = $numberLength;
		for($i = 0; $i < $wordsNumber; $i++) {
			$start = $tempCursor - $this->maxIntLen < 0 ? 0 : $tempCursor - $this->maxIntLen;
			$word = substr($stringNumber, $start, $tempCursor);
			$this->numberArray[] = intval($word);
			$tempCursor -= $this->maxIntLen;
		}
		return true;
	}

	public function __construct($stringNumber) {
		// Задаем максимальну длину "слова"
		$this->maxIntLen = strlen(strval(PHP_INT_MAX)) - 1; 
		$this->setNumber($stringNumber);	}


	public function getNumberArray() {
		return $this->numberArray;
	}

	public function getNumberString() {
		return implode('', array_reverse($this->numberArray));
	}

	private function _makeSum(Array $a, Array $b) {
		$resultSum = array();
		$nIterations = max(array(count($a), count($b)));
		$tempWord = false;
		$next = 0;
		for($i=0; $i < $nIterations; $i++) {
			$tA = isset($a[$i]) ? $a[$i] : 0;
			$tB = isset($b[$i]) ? $b[$i] : 0;
			$tempWord = $tA + $tB + $next;
			if( $next != 0 ) {
				$tempWord += $next;
				$next = 0;
			}
			$tempWord = strval($tempWord);
			$tempWordLen = strlen($tempWord);
			// Случай, когда длина слова превышает максимальну длину слова, то, что не влезло, нужно перенести в следующее слово
			if( strlen(strval($tempWord)) > $this->maxIntLen ) {
				$next = 1;
				$tempWord = substr($tempWord, 1);
			}
			if($tempWord != false) {
				$resultSum[] = $tempWord;
			}
		}
		// Случай, когда сумма выходит за пределы максимальной длины большего массива
		if($next != 0) {
			$resultSum[] = $next;
		}
		return implode(array_reverse($resultSum));
	}

	public function makeSum(BNumber $bNumberObject) {
		$anotherValue = $bNumberObject->getNumberArray();
		return $this->_makeSum($this->numberArray, $anotherValue);
	}

}

?>