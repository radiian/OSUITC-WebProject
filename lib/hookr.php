<?php
//This file contains the entire hookr subsystem

//The hookr subsystem takes special strings called hooks and parses
//them into specific data. It will then replace the hooks with the
//data that they represent. In this manner html templates can be
//easily created to represent entire, rich pages by simply
//defining the layout and the hooks.

//Hooks look something like the following:
//  {%basehook}
//  {%basehook->extensionhook}

//For example, to get a username:
//  {%user->username}
//To get a user's email:
//  {%user->email}

//
class HookR{
	private $hookRGX = "/\{\%[a-zA-Z_\-\>]+\}/g"; //The regular expression to match all hooks


	//Get an array of the hooks contained within $input
	private function getHooks($input){
		$hooks;
		$hookCount = preg_match_all($this->hookRGX, $input, $hooks);
		return $hooks;	
	}


	//Check if the basehook is a valid hook
	private function validateBaseHook($basehook){
		if(class_exists($basehook))return true;
		return false;
	}


	//Check if a basehook has an extension and is a valid complex hook
	private function baseHasExtension($basehook, $extension){
		if(validateBaseHook($basehook)){
			if(method_exists($basehook, $extension))return true;
		}
		return false;
	}


	//Translate the hook into actual data
	//INPUT $hook: The hook string to translate
	//INPUT $context: A context object that contains information about the context of the hook
	private function translateHook($hook, $context){
		$outputData;
		//Check if the hook is a basic hook or a complex hook
		if(strpos($hook, "->") !== false){
			$base = explode($hook, "->")[0];
			$extension = explode($hook, "->")[1];
			if(baseHasExtension($base, $extension)){
				$hookClass = new $base();
				$outputData = $hookClass->$extension($context);
			}
		}
		else {
			if(validateBaseHook($hook)){
				$hookClass = new $hook($context);
				$outputData = $hookClass();
			}
		}

		return $outputData;
	}

	
}

?>
