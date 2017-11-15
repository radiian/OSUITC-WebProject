<?php
//This file tests creating a class
//and calling it's methods with the use
//of string variables. 
//This method will be used to implement the HookR
//system for dynamic content generation
class testClass1 {
	public function test(){
		echo "From testClass1";
	}

}


class testClass2 {
	public function test(){
		echo "From testClass2";
	}
}

$base = "testClass1";
$extension = "extension1";
echo "Attempting to create a class from a variable: $base <br>";


if(class_exists($base)){
	$class = new $base();
	$class->$extension();
}
else echo "Class not found";




echo "<br>";
echo "end of test";

?>
