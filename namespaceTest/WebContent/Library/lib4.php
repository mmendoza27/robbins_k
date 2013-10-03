<?php
// application library 1
namespace AppLib1;

const MYCONST = 'AppLib1MYCONST';

function MyFunction() {
	return "My method is: " . __FUNCTION__;
}

class MyClass {
	static function WhoAmI() {
		return "My -4-static method is: " . __METHOD__;
	}
}
?>