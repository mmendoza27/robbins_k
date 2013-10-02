<?php
// application library 2
namespace AppLib2;

const MYCONST = 'AppLib2MYCONST';

function MyFunction() {
	return "My method is: " . __FUNCTION__;
}

class MyClass {
	static function WhoAmI() {
		return "My static method is: " . __METHOD__;
	}
}
?>