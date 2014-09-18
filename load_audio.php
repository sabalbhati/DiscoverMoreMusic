<?php
	require_once("includes/db_con.php");
	
	// call procedure to get all user's audio
	$query = 'CALL all_audiofiles()';

	$result = $mysqli->query($query);
	
	if ($mysqli->error) { printf("Errormessage: %s\n", $mysqli->error); }				
	// get json data and encode it 
	while ($row = mysqli_fetch_array($result))
	{ 
		//holds all the audiofiles from the tables 
		$all_audio[] = $row;	
	}
	$jsonAudiofile = "{\"audiofiles\":". json_encode($all_audio) . "}";
		echo $jsonAudiofile;

?>	