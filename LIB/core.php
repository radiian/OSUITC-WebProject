<?php
//This file contains core functions and classes for the project

	//This function is used to parse data hooks
	//It takes $input and searches for data hooks in the form of {hookname}
	//It then searches the hook database for {hookname} and inserts the hook data
	//Where the hook was found in the $input string.
	//**********
	//INPUT: A string for which hooks are to be parsed
	//OUTPUT: A string in which hooks have been inserted and parsed
	function hookr($input){
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
		
	}
	

	//This function is used to remove hook characters from input
	//It searches for '{' and '}' and replaces then with &#123; and &#125;
	//**********
	//INPUT: A string to be sanitized of hook brackets
	//OUTPUT: A string for which '{' and '}' have been replaced with html equivalents
	function cleanr($input){
		$regx = "/\{+/";//The regex to match { at least once
		$output = preg_replace($regx, "&#123;", $input);
		
		$regx = "/\}+/";//The regex to match } at least once
		$output = preg_replace($regx, "&#125;", $output);
		
		return $output;//Return the output with sanitized text 
	}

?>
