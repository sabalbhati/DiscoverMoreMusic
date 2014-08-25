<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>DMM Login</title>
	<link rel="stylesheet" type="text/css" href="css/color.css">
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="	text/css" href="css/index.css">
	<script src="jQuery/jquery-1.11.1.min.js"></script>
	<script src="js/player.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/audioloader.js"></script>
	<script src="js/index.js"></script>
</head>

<body>
<?php
	require("includes/header.php");
  require("functions/ep_function.php");
?>
	<main id="wrapper">
     
		<?php
			// check if the current session has an id
			if(isset($_SESSION['id']))
			{	 
				$username = $_SESSION['id'];
				require_once("includes/db_con.php");

				// call procedure to get all user's audio
				$query = 'CALL all_audiofiles()';

				$result = $mysqli->query($query);
				if ($mysqli->error) { printf("Errormessage: %s\n", $mysqli->error); }				
		?>
		<!-- Search form for audio -->
		<section id="search">
			<form> 
				<input type="text" />
				<input type="button" value="search" />
			</form>
		</section>

		<?php require("includes/audio_header.php"); ?>
		<section class="track">
		</section>
		<?php 
				// get json data and encode it 
				while ($row = mysqli_fetch_array($result))
				{ 
					//holds all the audiofiles from the tables 
					$all_audio[] = $row;
					$jsonAudiofile = "{\"audiofiles\":". json_encode($all_audio) . "}";
				} 
				file_put_contents('./JSON/json_allAudio.txt' , $jsonAudiofile);

			} // if(isset($_SESSION['id'])) END OF IF STATEMENT

		?> 
			<!-- modal dialog for user to change ratings -->
    	<section id="openModal" class="modalDialog">
				<?php require("includes/rating_modal.php"); ?>
			</section>
  </main>

		<?php require("includes/footer.php"); ?>
</body>
</html>