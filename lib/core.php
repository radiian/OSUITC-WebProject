<?php
//This file contains core functions and classes for the project



	//This function is used to parse data hooks
	//It takes $input and searches for data hooks in the form of {hookname}
	//It then searches the hook database for {hookname} and inserts the hook data
	//Where the hook was found in the $input string.
	//**********
	//INPUT: A string for which hooks are to be parsed
	//OUTPUT: A string in which hooks have been inserted and parsed
	
	//This function will instead be implemented as an entire class subsystem in the file hookr.php
	/*function hookr($input){
		$matches;
		$regx = "/\{[a-zA-Z0-9_\-\>]+\}/";//The regex to match all characters contained within {brackets}
		$match_count = preg_match_all($regx, $input, $matches);	
		
		//***BEGIN TEST***
		
		if($match_count == 0) echo "No matches <br>";
		else{
			for($i = 0; $i < $match_count; ++$i){
				echo "Match $i: " . $matches[0][$i] . "<br>";
			}
		}
		
		//***END TEST***
		
		//for each match, get the appropriate data and replace it
		for($i = 0; $i < $match_count; ++$i){

		}	
	}
	*/
	
	//This function is used to remove restricted characters from user input
	//It will remove hook characters, html, and SQL special characters to sanitize strings
	//**********
	//cleaner
	//**********
	//INPUT: A string to be sanitized
	//OUTPUT: A string for which special characters have been replaced with html equivalents

	//All user input must pass through this function BEFORE being stored in the database
	function cleanr($input){
		$regx = "/\{+/";//Sanitize {
		$output = preg_replace($regx, "&#123;", $input);
		
		$regx = "/\}+/";//Sanitize }
		$output = preg_replace($regx, "&#125;", $output);
		
		$regx = "/\;+/";//Sanitize ;
		$output = preg_replace($regx, "&#59;", $output);	
	
		$regx = "/\/+/";//Sanitize/
		$output = preg_replace($regx, "&#47;", $output);

		$regx = "/<+/";//Sanitize <
		$output = preg_replace($regx, "&lt;", $output);

		$regx = "/>+/";//Sanitize >
		$output = preg_replace($regx, "&gt;", $output);

		$regx = "/\'+/"//Sanitize '
		$output = preg_replace($regx, "&#39;", $output);

		$regx = "/\"+/"//Sanitize "
		$output = preg_replace($regx, "&quot;", $output);

		$regx = "/\`+/"//Sanitize `
		$output = preg_replace($regx, "&#96;", $output);

		return $output;//Return the output with sanitized text 
	}




class Context{
	public $path;
	public $GETVars;
	public $POSTVars;
	public $sessid;

	public function Context($SessionId){
		$this->sessid = $SessionId;
	}

}


?>
