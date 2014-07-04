$(document).ready(function() {
	$("#discount_placement").hide();
	$("label[for=discount_placement]").hide();
	$("#bundle_name").focus();

	$("#discount").keyup(function(){
		// if the user chooses to have discounts enable this dropdown
		if ($(this).val() > 0 && $(this).val() <= 90) 
		{
			$("#discount_placement").show(500);
			$("label[for=discount_placement]").show(500);
		}
		else
		{
			$("#discount_placement").hide(500);
			$("label[for=discount_placement]").hide(500);
		}
	});

	$("textarea").change(function(e){
		var error_flag = true;
		error_flag = string_validation($(this).val(), 0 ,140); 
		if(error_flag == true)
		{
			switch_class_to_error(this);

		}
		else if(special_chars($(this).val()))//check for special character entries
		{
			switch_class_to_error(this);
		}
		else
		{
			switch_class_to_valid(this);
		}
	});

	// checks for focus changes on input fields
	$("input").change(function(e){
		var error_flag = true;
			
		switch(e.target.id){
			case "bundle_name": 
				error_flag = string_validation($(this).val(), 5, 25); // between 5-25 characters
				if (error_flag == true)
				{
					switch_class_to_error(this);
				}
				else if(special_chars($(this).val()))//check for special character entries
				{
					switch_class_to_error(this);
				}
				else
				{
					switch_class_to_valid(this);
				}
				break; //end bundle audio
			case "producer":
				error_flag = string_validation($(this).val(), 2,25); 
				if(error_flag == true)
				{
					switch_class_to_error(this);

				}
				else if(special_chars($(this).val()))//check for special character entries
				{
					switch_class_to_error(this);
				}
				else
				{
					switch_class_to_valid(this);
				}
				break;
		}
	});
});