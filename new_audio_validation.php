<!-- Stores images into a dababase table converts to binary -->
<?php
	session_start();
	$username = $_SESSION['user'];
	echo "<p>" . $username . "</p>";
	echo $_SESSION['id'];
?>
<?php
$error_flag = 0;
require_once("includes/db_con.php");
require_once("functions/ep_function.php");

if(isset($_POST['add_new_audio']))
{
	//escape variables for security reasons
	$audio_name = $mysqli->real_escape_string($_POST['audio_name']);
	$description = $mysqli->real_escape_string($_POST['description']);
	$tempo = $mysqli->real_escape_string( $_POST['tempo']);
	$genre = $mysqli->real_escape_string($_POST['genre']);
	$copyright = $mysqli->real_escape_string($_POST['copyright']);
	$price = $mysqli->real_escape_string($_POST['price']);
	$member_id = $_SESSION['id'];


	//allowed extensions
	$allowedExts = array("mp3", "acc");
	$temp = explode(".", $_FILES["audiofile"]["name"]);
	$extension = end($temp); //stores the extension retrieved from the array
	$size = $_FILES["audiofile"]["size"];
	$bitrate='';
	/** 
	* Ensure the file is an mp3 file or acc
	* and the file is less than 7 mb 
	*/
	if (($_FILES["audiofile"]["type"] == "audio/mpeg") || ($_FILES["audiofile"]["type"] == "audiofile/acc")
		&& ($size < 70000)
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

			$fileLocation = UPLOAD_DIR . $name;
			print_r($fileLocation);
			
			// try to move the file to the proper directory
			$success = move_uploaded_file($audioFile["tmp_name"], UPLOAD_DIR . $name);

			// f unsucessful print error and exit
			if (!$success){
				echo "<p> unable to save file. </p>";
				exit;
			}
			else
			{
				// set permissions on the new file
				chmod(UPLOAD_DIR . $name, 0644);

				// add user's audio to db
				$query ='CALL audio_add("'.
							$audio_name . '","' .
							$extension . '","' . 
							$bitrate . '","' .
							$tempo . '","' .
							$size . '","' .
							$genre . '","' .
							$price . '","' . 
							$member_id	 . '"' .
							')';
				$result = $mysqli->query($query);
			
				if ($mysqli->error) 
				{
	    		printf("Errormessage: %s\n", $mysqli->error);
				}
				else
				{
					
				}
				//require_once("includes/audio_insert.php");
			}

			
    } // no error found
	} 
	else // file is greater than 7 mb or type
	{
		$error_flag++;
		echo "<p> Wrong file </p>";
		echo $_FILES["audiofile"]["error"] . $_FILES["audiofile"]["type"] ;
	}
}