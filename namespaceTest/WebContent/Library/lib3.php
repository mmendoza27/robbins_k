<?php
const MYCONST = 'MYCONST';

function MyFunction() {
	return "My method is: " . __FUNCTION__;
}

class MyClass {
	static function WhoAmI() {
		return "My static method is: " . __METHOD__;
	}
}
?>