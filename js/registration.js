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
		// forces proof that no errors exist
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

function switch_class_to_error(obj) {
	if ($(obj).hasClass("input_valid"))
	{
		$(obj).removeClass("input_valid");
	}
	$(obj).addClass("input_error");
}

function switch_class_to_valid(obj){
	if ($(obj).hasClass("input_error"))
	{
		$(obj).removeClass("input_error");
	}
	$(obj).addClass("input_valid");
}

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


   
