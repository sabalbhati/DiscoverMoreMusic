<!-- Stores images into a dababase table converts to binary -->
<?php
	include("includes/config.class.php");
	include("includes/db.class.php");
	include("includes/mp3file.class.php");

	$config = new config();
	$db = new db($config);

	$db->openConnection();
	session_start();
	$username = $_SESSION['user'];

	$error_flag = 0;

include("functions/ep_function.php");

if(isset($_POST['add_new_audio']))
{
	//escape variables for security reasons
	$audio_name = $db->stringEscape($_POST['audio_name']);
	$description = $db->stringEscape($_POST['description']);
	$tempo = $db->stringEscape($_POST['tempo']);
	$genre = $db->stringEscape($_POST['genre']);
	$copyright = $db->stringEscape($_POST['copyright']);
	$price = $db->stringEscape($_POST['price']);
	$member_id = $_SESSION['id'];

	//allowed extensions
	$allowedExts = array("mp3", "acc");
	$temp = explode(".", $_FILES["audiofile"]["name"]);
	$extension = end($temp); //stores the extension retrieved from the array
	$size = floatval($_FILES["audiofile"]["size"]) / 1024 ;
	$bitrate='';

	/** 
	* Ensure the file is an mp3, mpeg, or acc file
	* and the file is less than 10 mb 
	* ***** and all inputs have been entered *******
	*/
	if (($_FILES["audiofile"]["type"] == "audio/mpeg") ||
		 ($_FILES["audiofile"]["type"] == "audio/mp3") || 
		 ($_FILES["audiofile"]["type"] == "audiofile/acc")
		&& ($size <	10)
		&& in_array($extension, $allowedExts)) 
	{
		if ($_FILES["audiofile"]["error"] > 0) // error found
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  	} 
		else // No error found
		{
			//define the audio upload directory(each user gets a folder of their own
			define("UPLOAD_DIR", __DIR__ . "/audio_temp/" . $username . "/");
			
			$audioFile = $_FILES["audiofile"];
			
			// ensure a safe filename
			$name = preg_replace("/[^A-Z0-9._-]/i", "_", $audio_name. "." . $extension);

			// if directory doesn't exist attempt to create it
			if (!file_exists(UPLOAD_DIR))
			{
				mkdir(UPLOAD_DIR, 0700);
			}

			//stores the file location...relative directory
			$fileLocation = UPLOAD_DIR . $name;
			print_r($fileLocation);
			
			// try to move the file to the proper directory
			$success = move_uploaded_file($audioFile["tmp_name"], $fileLocation);

			// if unsucessful print error and exit
			if (!$success){
				echo "<p> unable to save file. </p>";
				exit;
			}
			else
			{

				$mp3Info = new mp3file($fileLocation);
				$mp3Data = $mp3Info->get_metadata();

				$mp3Duration = $mp3Info->getDuration($mp3Data,0);

				$length = $mp3Data['Length mm:ss']; 
				
				// set permissions on the new file
				chmod(UPLOAD_DIR . $name, 0644);

				// add user's audio to db
				$query ='CALL audio_add("'.
							$audio_name . '","' .
							$extension . '","' . 
							$bitrate . '","' .
							$tempo . '","' .
							$size . '","' .
							$length . '","' .
							$genre . '","' .
							$price . '","' . 
							$member_id	 . '"' .
							')';
				$result = $db->query($query);
			}
    } // no error found
	} 
	else // file is greater than 7 mb or type
	{
		$error_flag++;
		echo "<p> Wrong file </p>";
		echo $_FILES["audiofile"]["error"] . " " . $_FILES["audiofile"]["type"] ;
	}
	// if($db->pingServer())
	// {
	// 	$db->closeConnection();
	// }
}