<!-- Stores images into a dababase table converts to binary -->
<?php
$error_flag = 0;
require_once("includes/db_con.php");
require_once("functions/ep_function.php");

if(isset($_POST['register']))
{
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$password_again = $mysqli->real_escape_string( $_POST['password_again']);
	$email = $mysqli->real_escape_string($_POST['email']);

	string_validation($username, 8, 15);
	
	//if password matches the retype, encrypt the user's password
	if ($password == $password_again)
	{
		//password encryption
		$crypt_password = password_encrypt($password);
	}
	else
	{
		$error_flag++;
	}
	
	//image storage
	//allowed extensions
	$allowedExts = array("jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["avatar"]["name"]);
	$extension = end($temp);
	
	if ((($_FILES["avatar"]["type"] == "image/jpeg")
		|| ($_FILES["avatar"]["type"] == "image/jpg")
		|| ($_FILES["avatar"]["type"] == "image/png"))
		&& ($_FILES["avatar"]["size"] < 1000000)
		&& in_array($extension, $allowedExts)) 
	{
		//check if image has errors, no errors then move to a directory
		//under the user's name 
		if ($_FILES["avatar"]["error"] > 0) 
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  		} 
		else
		{
			//define the audio upload directory(each user gets a folder of their own
			define("UPLOAD_DIR", __DIR__ . "/image_temp/" . $username . "/");
				
			// if directory doesn't exist attempt to create it
			if (!file_exists(UPLOAD_DIR))
			{
				mkdir(UPLOAD_DIR, 0700);
			}
    	move_uploaded_file($_FILES["avatar"]["tmp_name"], UPLOAD_DIR. "image1." . $extension);
    }
	}
	else
	{
		//wrong file type or size
		$error_flag++;
	}
}
else
{
	$error_flag++;
}

if ($error_flag == 0)
{
	$main_image = "image1";
	$query = 	
		"INSERT INTO members (username, password, avatar, avatar_ext, email, registered_on) " .
		"VALUES ('" . $username . "' , '" . $crypt_password . "' , '" . $main_image . "' , '" . $extension . "' , '" . $email ."' , ' ". date('Y-m-d') ."' )";
	
	$result = $mysqli->query($query);
	
	if ($mysqli->error) 
	{
		try 
		{    
			throw new Exception("MySQL error $mysqli->error <br> Query:<br> $query", $msqli->errno);    
		} 
		catch(Exception $e ) 
		{
			echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
			echo nl2br($e->getTraceAsString());
		}
	}
	else
	{
		echo "Welcome ". $username;
	}
}
else
{
	//form missing input 
	//let user know which inputs are missing data, and or what's incorrect
	echo "Form missing input";
}

?>