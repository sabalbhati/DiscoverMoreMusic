// JQuery - Javascript

$( document ).ready(function() {
	$("#username").focus();
	
	//state change trigger for file upload input
	$("#avatar").change(function(){
		readURL(this);
	});
	
	//remove image from the sample view
	$("#file_close").click(function(){
		$("#avatar").val("");
		$('#sample_img').attr('src', " ");
	});
	
	$("input").change(function(e) {
		// Error initalized to true. Validation must prove errors don't exist on initalization
		// This is to prevent errors from passing through accidentally
		var error_flag = true;
		
		switch(e.target.id){
			case "username":
				error_flag = string_validation($(this).val(), 2, 25);
				if (error_flag == true)
				{ 
					switch_class_to_error(this);
				}
				else if(special_chars($(this).val()))//if there is a special chars - show error color
				{
					switch_class_to_error(this);
				}
				else
				{
					switch_class_to_valid(this);
				}
				break;
			case "password":
				error_flag = string_validation($(this).val(), 5, 12);
				if (error_flag == true)
				{ 
					switch_class_to_error(this);
				}
				else
				{
					switch_class_to_valid(this);
				}
				break;
			case "password_again":
				if ($(this).val() != $("#password").val())
				{
					switch_class_to_error(this);
				}
				else
				{
					switch_class_to_valid(this);
				}
				break;
			case "email":
				error_flag = validate_email($(this).val());
				if (error_flag == true){ 
					switch_class_to_error(this); 
				}
				else
				{
					switch_class_to_valid(this);
				}
				break;
			case "avatar":
				error_flag = validate_avatar($(this).val());
				if (error_flag == true)
				{ 
					$("#avatar").val("");
					$('#sample_img').attr('src', " ");					
				}
				break;
		}
	});
});



 /*
 * Shows image from the input file uploader in the
 * sample preview box
 */
 function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function (e) {
			$('#sample_img').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
	
}


   
