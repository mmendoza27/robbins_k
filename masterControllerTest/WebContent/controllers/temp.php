<?php 

echo "<br>help<br>";
$t =  __DIR__ . "\..\autolaod.php";
echo "t = $t<br>";
$w = realpath($t);
echo "w = $w<br>";

$g = realpath($_SERVER["DOCUMENT_ROOT"]);
echo "g = $g<br>";
$h = $g . DIRECTORY_SEPARATOR . "masterControllerTest" . DIRECTORY_SEPARATOR . "autoload.php";
echo "h = $h<br>";

$g = realpath($_SERVER["DOCUMENT_ROOT"]);
echo "g = $g<br>";
$h = realpath($_SERVER["DOCUMENT_ROOT"] . "/masterControllerTest/autoload.php");
echo "h = $h<br>";

$v = realpath(".");
echo "v=$v";
		
$r = realpath(".."). DIRECTORY_SEPARATOR ."autoload.php";
echo "r=$r";
?>