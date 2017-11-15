<?php

class testClass {

	public function testClass(){
		echo "Hello from testClass()!";
	}
	
	public function __construct(){
		echo "This is from the constructor";
	}
}

$test = new testClass();

?>
