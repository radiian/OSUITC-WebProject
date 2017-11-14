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

	public function getHooks($input){
		$hooks;
		$hookCount = preg_match_all($this->hookRGX, $input, $hooks);	
	}
}

?>
