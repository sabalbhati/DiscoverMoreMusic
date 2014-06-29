// JavaScript Document
function string_validation(value, min_value, max_value)
{
	var error_flag = true;
	
	//checks to see if string is valid length
	if((value.length >= min_value) && (value.length <= max_value))
	{
		error_flag = false;
	}
	return error_flag;
}

function special_chars(value)
{
	//hypens allowed
 	var iChars = "!@#$%^&*()+=[]\\\';,./{}|\":<>?~_";
	
   	for (var i = 0; i < value.length; i++) {
		if (iChars.indexOf(value.charAt(i)) != -1) 
		{
			return true;
		}
  	}
}

//basic email validation
function validate_email(email)
{
	var email_string = email;
	var atpos = email_string.indexOf("@");
	var dotpos = email_string.lastIndexOf(".");
	if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= email_string.length)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function validate_avatar(avatar) {
	var error_flag = true;
	
	if(avatar.length > 1) 
	{
		var extension = avatar.split('.').pop().toUpperCase();
		
		if (extension=="PNG" || extension=="JPG" || extension=="TIFF" || extension=="JPEG")
		{
			error_flag = false;
		}
	}
	return error_flag;
}
