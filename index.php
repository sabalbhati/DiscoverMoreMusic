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
				if ($mysqli->error) { 
					printf("Errormessage: %s\n", $mysqli->error); 
				}
		?>
		<?php require("includes/audio_header.php"); ?>
		<?php while ($row = mysqli_fetch_array($result)){ ?>
			<!-- create container for audio file -->
			<section class="track">
				<!-- audio details -->
				<ul>
					<li><?php echo pretify($row['title']) ?> </li>
					<li><?php echo $row['username'] ?> </li>
					<li><?php echo $row['genre'] ?> </li>
					<li>3:05</li>
					<li><?php echo '$' . $row['price'] ?> </li>
					<li><?php echo $row['play count'] ?> </li>
					<li><?php echo $row['likes'] ?> </li>	
					<li><?php echo $row['rating'] ?> </li>
					<li><img src="images/up_arrow.png" /></li>
					<li><img src="images/cart.png" /></li>
					<li><img src="images/heart.png" /></li>
					<li><img src="images/star.png" /></li>
					<li><img src="images/play_small.png" /></li>
				</ul>
			</section>
			<?php	} 
		} ?> 
    	</section>
    </main>
		<?php require("includes/footer.php"); ?>
</body>

</html>
