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

</head>

<body>
<?php
	require("includes/header.php");
  require("functions/ep_function.php");
?>
	<main id="wrapper">

		<?php
				// call procedure to get all user's audio
				$query = 'CALL individual_audio()';
		?>

	</main>
		<?php require("includes/footer.php"); ?>
</body>

</html>
