<?php
namespace AppLib1;

require_once('lib1.php');
require_once('lib2.php');

header('Content-type: text/plain');

echo "In myapp1 with namespace ". __NAMESPACE__ . "\n";
echo MYCONST . "\n";
echo MyFunction() . "\n";
echo MyClass::WhoAmI() . "\n";
?>