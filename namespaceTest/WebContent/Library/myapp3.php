<?php


header('Content-type: text/plain');
include "autoload.php";

echo "In myapp3 with namespace ". __NAMESPACE__ . "\n";
$m1 = new MyClass1();
echo $m1->whoAmI() . "\n";

echo "\nNow trying to load a class from a subdirectory\n";
$m2 = new MyClass2();
echo $m2->whoAmI();
?>