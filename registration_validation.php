<?php
	session_start();
?>

<!-- Stores images into a dababase table converts to binary -->
<?php
$error_flag = 0;
require("includes/header.php");
include("includes/utility.class.php");
include("includes/config.class.php");
include("includes/db.class.php");

require_once("functions/ep_function.php");

$config = new config();
$db = new db($config);

$db->openConnection();

if(isset($_POST['register']))
{
	$username = $db->stringEscape($_POST['username']);
	$password = $db->stringEscape($_POST['password']);
	$password_again = $db->stringEscape($_POST['password_again']);
	$email = $db->stringEscape($_POST['email']);

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
	$query = 	"CALL add_user('" . $username . "', '" . $crypt_password . "' ,'" . $main_image . "' , '" . $extension . "' , '" . $email . "' , '". date('Y-m-d') ."' )";
	
	if ($result = $db->query($query)) 
	{
		$_SESSION['user']= $username;
		echo "<script> location.href=\"account.php\" </script>";
	}
	else
	{
		echo "<script> location.href=\"#\" </script>";
	}
}
?>