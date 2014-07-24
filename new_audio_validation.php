<!-- Stores images into a dababase table converts to binary -->
<?php
	session_start();
	$username = $_SESSION['user'];
	echo "<p>" . $username . "</p>";
?>
<?php
$error_flag = 0;
require_once("includes/db_con.php");
require_once("functions/ep_function.php");

if(isset($_POST['add_new_audio']))
{
	//allowed extensions
	$allowedExts = array("mp3", "acc");
	$temp = explode(".", $_FILES["audiofile"]["name"]);
	$extension = end($temp); //stores the extension retrieved from the array
	
	/** 
	* Ensure the file is an mp3 file or acc
	* and the file is less than 7 mb 
	*/
	if (($_FILES["audiofile"]["type"] == "audio/mp3") || ($_FILES["audiofile"]["type"] == "audiofile/acc")
		&& ($_FILES["audiofile"]["size"] < 70000)
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
			$name = preg_replace("/[^A-Z0-9._-]/i", "_", $audioFile["name"]);

			// don't overwrite an existing file
			$i = 0;
			$parts = pathinfo($name);
			while(file_exists(UPLOAD_DIR . $name)) {
				$i++;
				$name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
			}

			// if directory doesn't exist attempt to create it
			if (!file_exists(UPLOAD_DIR))
			{
				mkdir(UPLOAD_DIR, 0700);
			}

			// try to move the file to the proper directory
			$success = move_uploaded_file($audioFile["tmp_name"], UPLOAD_DIR . $name);

			// f unsucessful print error and exit
			if (!$success){
				echo "<p> unable to save file. </p>";

				exit;
			}

			// set permissions on the new file
			chmod(UPLOAD_DIR . $name, 0644);
    } // no error found
	} 
	else // file is greater than 7 mb or type
	{
		$error_flag++;
		echo "<p> Wrong file </p>";
		echo $_FILES["audiofile"]["error"];
	}
}