<?php
require_once 'corehooks.php';
require_once 'core.php';
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
	public $hookRGX = "/\{\%[a-zA-Z_\-\>]+\}/"; //The regular expression to match all hooks
	public $layoutRGX = "/\{\&[a-zA-Z_\-\>]+\}/";//The regular expression to match all layout hooks

	//Get an array of the hooks contained within $input
	//NOTE: preg_match_all returns a multidimensional array. The results are contained in the array $_hooks[0][]
	private function getHooks($input){
		$_hooks;
		//$hookCount = preg_match_all($this->hookRGX, $input, $hooks);
		preg_match_all($this->hookRGX, $input, $_hooks);
		return $_hooks;	
	}


	//Check if the basehook is a valid hook
	private function validateBaseHook($basehook){
		if(class_exists($basehook))return true;
		return false;
	}


	//Check if a basehook has an extension and is a valid complex hook
	private function baseHasExtension($basehook, $extension){
		if($this->validateBaseHook($basehook)){
			if(method_exists($basehook, $extension))return true;
		}
		return false;
	}


	//Translate the hook into actual data
	//INPUT $hook: The hook string to translate
	//INPUT $context: A context object that contains information about the context of the hook
	private function translateHook($_hook, $context){
		
		$hook = substr($_hook, 2);
		$hook = chop($hook, "}");

		$outputData;
		//Check if the hook is a basic hook or a complex hook
		if(strpos($hook, "->") !== false){
			$base = preg_split("/\-\>/", $hook)[0];
			$extension = preg_split("/\-\>/", $hook)[1];
			if($this->baseHasExtension($base, $extension)){
				$hookClass = new $base();
				$outputData = $hookClass->$extension($context);
			}
		}
		else {
			if($this->validateBaseHook($hook)){
				$hookClass = new $hook($context);
				$outputData = $hookClass->run();
			}
		}

		return $outputData;
	}


	//Actually parse out the hooks in a string
	public function parse($stringtoparse, $context){
		$foundhooks = $this->getHooks($stringtoparse);
		$output = $stringtoparse;
		for($i = 0; $i < count($foundhooks[0]); ++$i){
			$thishook = $foundhooks[0][$i];
			$thishook = preg_quote($thishook);
			$hookDat = $this->translateHook($foundhooks[0][$i], $context);	
			
			$output = preg_replace("/".$thishook."/", $hookDat, $output); 

		}
		return $output;
	}



	//********************************************************************************
	//                          HTML Template Parsing Functions                       
	//********************************************************************************
	

	//Fetch a list of layoutHooks from a layout
	//NOTE: preg_match_all returns a multidimensional array. The results are contained in the array $hooks[0][];
	public function getLayoutHooks($layout){
		$hooks;
		preg_match_all($this->layoutRGX, $layout, $hooks);
		return $hooks;
	}

	public function translateLayoutHook($_hook){
		$hook = substr($_hook, 2);
		$hook = chop($hook, "}");
		//Should check the database for the layout based on the hook
		//$query = "SELECT * FROM templates WHERE 'hookname' = '$hook'";
		//$result =	
	}
	

	public function parseLayout($layoutToParse){



	}

}

?>
