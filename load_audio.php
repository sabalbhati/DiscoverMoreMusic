<?php
	include("includes/config.class.php");
  include("includes/db.class.php");

	$config = new config();
	$db = new db($config);
	
	$db->openConnection();
	
	// call procedure to get all user's audio
	$query = 'CALL all_audiofiles()';

	$result = $db->query($query);
	while ($row = $db->fetchArray($result))
	{ 
		//holds all the audiofiles from the tables 
		$all_audio[] = $row;	
	}

	$jsonAudiofile = "{\"audiofiles\":". json_encode($all_audio) . "}";	
	echo $jsonAudiofile;
?>	