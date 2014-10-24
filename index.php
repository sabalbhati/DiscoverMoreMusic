<?php
	include("includes/db.class.php");
	include("includes/config.class.php");
  include("functions/ep_function.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>DMM Login</title>
	<link rel="stylesheet" type="text/css" href="css/color.css">
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="	text/css" href="css/index.css">
	<script src="jQuery/jquery-1.11.1.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/player.js"></script>
	<script src="js/audioloader.js"></script>	
	<script src="js/search.js"></script>
</head>

<body>
<?php
  require("includes/header.php");
?>
	<main id="wrapper">
     
		<!-- Search functionality -->
		<section id="search">
			<form> 
				<input type="text" id="filter" />
				<input type="button" value="Search" />
			</form>
		</section>

		<section id="audio_containter">
			<!--Users audio files-->
		</section>
		
		<!-- <section id="promo">
			<?php require("includes/load_promo_users.php"); ?>
		</section> -->
  </main>
		<?php require("includes/footer.php"); ?>
</body>
</html>