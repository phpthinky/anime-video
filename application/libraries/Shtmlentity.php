<?php 
/**
* 
*/
class shtmlentity 
{
	
	function fixcodeblocks($string) {
	// Create a new array to hold our converted string
	$newstring = array();
	
	// This variable will be true if we are currently between two code tags
	$code = false;
	
	// The total length of our HTML string
	$j = mb_strlen($string);
	
	// Loop through the string one character at a time
	for ($k = 0; $k < $j; $k++) {
		// The current character
		$char = mb_substr($string, $k, 1);
		
		if ($code) {
			// We are between code tags
			// Check for end code tag
			if ($this->atendtag($string, $k)) {
				// We're at the end of a code block
				$code = false;
				
				// Add current character to array
				array_push($newstring, $char);
				
			} else {
				// Change special HTML characters
				$newchar = htmlspecialchars($char, ENT_QUOTES);
				
				// Add character code to array
				array_push($newstring, $newchar);
			}
		} else {
			// We are not between code tags
			// Check for start code tag
			if ($this->atstarttag($string, $k)) {
				// We are at the start of a code block
				$code = true;
			}
			// Add current character to array
			array_push($newstring, $char);
		}
	}
	//Turn the new array into a string
	$newstring = join("", $newstring);
	
	// Return the new string
	return $newstring;
}

function atstarttag($string, $pos) {
	// Only check if the last 6 characters are the start code tag
	// if we are more then 6 characters into the string
	if ($pos > 4) {
		// Get previous 6 characters
		$prev = mb_substr($string, $pos - 5, 6);
		
		// Check for a match
		if ($prev == "<code>") {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function atendtag($string, $pos) {
	// Get length of string
	$slen = mb_strlen($string);
	
	// Only check if the next 7 characters are the end code tag
	// if we are more than 6 characters from the end
	if ($pos + 7 <= $slen) {
		// Get next 7 characters
		$next = mb_substr($string, $pos, 7);
		
		// Check for a match
		if ($next == "</code>") {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
}