<?php
	session_start();

	if(isset($_SESSION['id']))
	{	 
		$username = $_SESSION['id'];
		require_once("includes/db_con.php");

		// call procedure to get all user's audio
		$query = 'CALL get_user_audio(' . $username . ')';

		$result = $mysqli->query($query);
		if ($mysqli->error) { 
			printf("Errormessage: %s\n", $mysqli->error); 
		}
?>
	<?php while ($row = mysqli_fetch_array($result)){ ?>
		<div id="eachTrack" class="text-primary-1">
			<!-- audio details -->
			<div id="title"><?php echo $row['name'] ?> </div>
				
				<div id ="genre">Genre: <?php echo $row['genre_id'] ?> </div>
				<div id="price">Price: $<?php echo $row['price'] ?> </div>
				<div id="tempo">Tempo: <?php echo $row['tempo'] ?> </div>

				<!-- audio album details -->
				<div id="album">Album Name:<?php echo $row['album_name'] ?></div>
				<div>Audio Size: <?php echo $row['tempo'] ?></div>

				<!-- stats detail -->
				<div id="plays">Plays: <?php echo $row['plays'] ?></div>
				<div id="likes">Likes: <?php echo $row['likes'] ?></div>
				<div id="ratings">Rating: <?php echo $row['rating'] ?> </div>
		<?php	} 
	} ?>
	
</div>