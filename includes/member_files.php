<?php

	$user_id = $_SESSION['id'];
		// call procedure to get all user's audio
		$query = 'CALL get_user_audio(' . $user_id . ')';

		$db = new db($config);
    $db->openConnection();

		$result = $db->query($query);	
?>
	<ul id="headerInfo">
		<li>Title</li>
		<li>Genre</li>
		<li>Price</li>
		<li>Tempo</li>
		<li>Size</li>
		<li>Plays</li>
		<li>Likes</li>
		<li>Ratings</li>
	</ul>
<?php while ($row = $db->fetchArray($result)){ ?>
	<!-- create container for audio file -->
	<div class=" eachTrack text-primary-3 color-primary-5">
		<!-- audio details -->
<?php
	// $audiofile = "audio_temp/" . $row['username'] . "/" . $row['name'] . "." . $row['extension'];

	// $mp3Info = new mp3file($audiofile);
	// $mp3Data = $mp3Info->get_metadata();
	// var_dump($mp3Data);
	// $mp3Duration = $mp3Info->getDuration($mp3Data,0);
	

	// if ($mp3Data['Encoding'] == 'Unknown')
	// 	echo "?";
	// else if ($mp3Data['Encoding'] == 'VBR')
	// 	print_r($mp3Data);
	// else if ($mp3Data['Encoding']=='CBR')
	// 	print_r($mp3Data);
	// unset($mp3Data);
?>

		<div id="title"><?php echo $row['name'] ?> </div>
		<div id ="genre"><?php echo $row['genre'] ?> </div>
		<div id="price">$<?php echo $row['price'] ?> </div>
		<div id="tempo"><?php echo $row['tempo'] ?> </div>

		<!-- audio album details -->
		<div id="size"><?php echo $row['size'] ?></div>
		<!-- <div id="length"><?php echo $mp3Data['Length mm:ss'] ?></div> -->

		<!-- stats detail -->
		<div id="plays"><?php echo $row['plays'] ?></div>
		<div id="likes"><?php echo $row['likes'] ?></div>
		<div id="ratings"><?php echo $row['rating'] ?> </div>
		<div id="play_button"><img src="images/play_button.png"></div>
<?php	
	} 
	?>
