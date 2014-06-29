<!-- Stores images into a dababase table converts to binary -->
<?php
$error_flag = 0;
require_once("includes/db_con.php");
require_once("functions/ep_function.php");

if(isset($_POST['register']))
{
 	//User input
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$password_again = $mysqli->real_escape_string( $_POST['password_again']);
	$email = $mysqli->real_escape_string($_POST['email']);

	string_validation($username, 8, 15);
	
	if ($password == $password_again)
	{
		//password encryption
		$crypt_password = password_encrypt($password);
	}
	else
	{
		//wrong password
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
		if ($_FILES["avatar"]["error"] > 0) 
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  		} 
		else
		{
        	move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__."/temp/".$_FILES["avatar"]["name"]);
        	$bin_string = file_get_contents(__DIR__."/temp/".$_FILES["avatar"]["name"]);
        	$hex_string = base64_encode($bin_string);
			unlink(__DIR__."/temp/".$_FILES["avatar"]["name"]);
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
	$query = 	
		"INSERT INTO members (username, password, avatar, email, registered_on) " .
		"VALUES ('".$username . "' , '". $crypt_password."' , '" .$hex_string . "' , '" . $email ."' , ' ". date('Y-m-d') ."' )";
	
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