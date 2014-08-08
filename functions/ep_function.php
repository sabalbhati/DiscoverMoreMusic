<?php
function redirect($new_location) {
	header("Location: " . $new_location);
	exit;
}

function password_encrypt($password){
	$hash_format= "$2a$05$"; //blowfish
	$salt = generate_salt();
	$format_and_salt = $hash_format . $salt;
	//crypt using password and 22 characters (salt and blowfish)
	$hash = crypt($password, $format_and_salt);
	return $hash;
}

//random string generated 
//cuts off at 22 characters 
function generate_salt(){
	$unique_random_string = md5(uniqid(mt_rand(), true));
	
	// gets rid of illegal signs, except plus
	$base64_string = base64_encode($unique_random_string);
	
	// replace plus sign with period
	$modified_base64_string = str_replace('+', '.', $base64_string);
	$salt = substr($modified_base64_string, 0, 22);
	return $salt;
}

//uppercases first letter of each word 
// removes underlines
function pretify($string){
	return ucwords(str_replace("_"," ",$string));
}

/**
* params sValue:  The value to be checked 
* params sLength: The valid length 
* checks a user's string length to make sure it's a valid length
**/
function string_validation($sValue, $min_length, $max_length){
	if((strlen($sValue) > $min_length) and (strlen($sValue) < $max_length))
	{
		echo("Valid string");
	}
	else
	{
		echo strlen($sValue);
	}
	
}

?>