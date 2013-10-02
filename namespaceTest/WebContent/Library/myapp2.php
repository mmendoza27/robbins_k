<?php

require_once('lib1.php');
require_once('lib2.php');

header('Content-type: text/plain');

echo "In myapp2 with namespace ". __NAMESPACE__ . "\n";
echo AppLib2\MYCONST . "\n";
echo AppLib2\MyFunction() . "\n";
echo AppLib2\MyClass::WhoAmI() . "\n";
?>