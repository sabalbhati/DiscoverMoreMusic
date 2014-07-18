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

//checks to see if images have the extensions JPG, TIFF, PNG, or JPEG
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

//calls class that triggers css styling for error messages
function switch_class_to_error(obj) {
	if ($(obj).hasClass("input_valid"))
	{
		$(obj).removeClass("input_valid");
	}
	$(obj).addClass("input_error");
}

//calls class that triggers css style for valid 
function switch_class_to_valid(obj){
	if ($(obj).hasClass("input_error"))
	{
		$(obj).removeClass("input_error");
	}
	$(obj).addClass("input_valid");
}
