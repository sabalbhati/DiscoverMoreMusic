<?php
	//session_start();
?>

<!-- Stores images into a dababase table converts to binary -->
<?php
	$msgResult = array();
	$error_flag = 0;
	$imageMaxSize = 2 * 1024 * 1024; // 2 MB
	$destination = __DIR__ . "\image_temp\\";
	//$upload->allowAllTypes();
	include("includes/header.php");
	include("includes/utility.class.php");
	include("includes/config.class.php");
	include("includes/db.class.php");

	require_once("functions/ep_function.php");

	$config = new config();
	$db = new db($config);

	$db->openConnection();

	if(isset($_POST['register']))
	{
		// add the upload class
		require("includes/uploadfile.class.php");

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

		$temp = explode(".", $_FILES["avatar"]["name"]);
		$extension = end($temp);
		$destination .="$username\\";
	
		// try to create a new upload object
		try{
			$upload = new UploadFile($destination, "image");
			$upload->setMaxSize($imageMaxSize);
			$upload->upload(false);
		
			$filename = $upload->getFilename();

			$msgResult = $upload->getmessages();
		}catch (Exception $e) {
			$msgResult[] = $e->getMessage();
		}

		//upload user and avatar to db
		if ($error_flag == 0)
		{
			$query = 	"CALL add_user('" . $username . "', '" . $crypt_password . "' ,'" . $filename  ."' , '" . $extension . "' , '" . $email . "' , '". date('Y-m-d') ."' )";

			if ($result = $db->query($query)) 
			{
				$_SESSION['user']= $username;
				echo "<script> location.href=\"account.php\" </script>";
				if(isset($msgResult))
				{
					foreach($msgResult as $msg)
					{
					echo $msg . "*";
					}
				}
			}
			else
			{
				echo "<script> location.href=\"registration.php\" </script>";
				$_SESSION['error'] = $msgResult;
			}
		}
	}
?>