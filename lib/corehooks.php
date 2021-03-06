<?php
//This file contains the classes for all the core hooks
//Each hook must consist of a class with at least one function
//That one function must be named run() as thats what HookR expects for basic hooks
//Each class may have more functions that define complex hooks.


//Every hook that HookR sees gets replaced with the output of the hook function
//Not all hooks need to have output and this can lead to some interesting things
//Like creating notifications to other applications with a simple hook


//This hook will demonstrate the functionality of hooks
class sysinfo {
	public function run($context){
		return "not a basic hook";
	}

	public function infophp($context){
		return "phpinfo()";
	}
	
	public function time($context){
		return time();
	}

	public function test($context){
		return "This is a test function";
	}
}


?> 
