<?php
require_once "./bnumbers.class.php";
echo "Максимальная длина числа integer - ".strlen(strval(PHP_INT_MAX))."<br>";
$bClassObj2 = new BNumber('92233720368547758075546521321');
$bClassObj = new BNumber('9223372036854');
$twoObjectsSum = $bClassObj->makeSum($bClassObj2);
echo "<br>Число А ".$bClassObj->getNumberString()."<br>";
echo "<br>Число Б ".$bClassObj2->getNumberString()."<br>";
echo "<br>Полученная сумма <br>".$twoObjectsSum."<br>";
echo "<br>Длина полученной суммы - ".strlen(strval($twoObjectsSum))."<br>";
?>