<?php
	session_start();

	if(isset($_SESSION['id']))
	{	 
		$username = $_SESSION['id'];
		require_once("includes/db_con.php");

		// call procedure to get all user's audio
		$query = 'CALL get_user_audio(' . $username . ')';

		$result = $mysqli->query($query);
		if ($mysqli->error) { printf("Errormessage: %s\n", $mysqli->error); }
?>
		<div id="eachTrack">
		<?php while ($row = mysqli_fetch_array($result)){ ?>
			<ul>
				<!-- audio details -->
				<li><div>Title:</div> <div><?php echo $row['name'] ?></div> </li>
				<li><div>Genre:</div> <div><?php echo $row['genre_id'] ?></div> </li>
				<li><div>Price:</div> <div><?php echo $row['price'] ?></div> </li>
				<li><div>Tempo:</div> <div><?php echo $row['tempo'] ?></div> </li>

				<!-- audio album details -->
				<li><div>Album Name:</div> <div><?php echo $row['album_name'] ?></div> </li>
				<li><div>Audio Size:</div> <div><?php echo $row['audio_tempo'] ?></div> </li>

				<!-- stats detail -->
				<li><div>Plays:</div> <div><?php echo $row['plays'] ?></div> </li>
				<li><div>Likes:</div> <div><?php echo $row['likes'] ?></div> </li>
				<li><div>Rating:</div> <div><?php echo $row['rating'] ?></div> </li>
			</ul> 
		<?php	} 
	}?>
	
</div>