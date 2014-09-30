<?php
	include("includes/config.class.php");
	include("includes/db.class.php");

	$config = new config();
	$db = new db($config);
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>New Audio</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type=" text/css" href="css/forms.css">
<link rel="stylesheet" type=" text/css" href="css/index.css">
<link rel="stylesheet" type=" text/css" href="css/new_audio.css">
<link rel="stylesheet" type=" text/css" href="css/color.css">

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/functions.js"></script>
</head>
<body>
	<?php
		require_once("includes/header.php");

		$db->openConnection();
		if ($db->pingServer())
		{
			$genre_query = "SELECT id, name FROM genres";
			$genre_results = $db->query($genre_query);
		}
	?>
	<main id="wrapper"> 
    <h2 class="text-primary-5">New Upload</h2>
    <form method="post" action="new_audio_validation.php" id="new_audio" class="input_forms color-primary-4" enctype="multipart/form-data">
	    <section>
	        <label for= "audio_name" class="text-primary-5">Title: </label>
	        <input type="text" name="audio_name" id="audio_name" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "tempo" class="text-primary-5">Tempo: </label>
	        <input type="number" name="tempo" id="tempo" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "description" class="text-primary-0" >Description: </label>
	        <textarea rows="4" cols="30" id ="description" name="description"></textarea>
	    </section>
	    <section>
        <label for= "genre">Genre: </label>
        <?php
        	echo "<select name=\"genre\">";
        	echo "<option value =\"\">--- Select Genre ---</option>";
        	while ($row = mysqli_fetch_array($genre_results))
					{	 
						echo "<option value =\"".$row['id']."\">" . $row['name'] . "</option>";
					}
					echo "</select>";
        ?>
  		</section>
	    <section>
	        <label for= "copyright" class="text-primary-5">Copyright: </label>
	        <select name="copyright">
	        	<option value="1">Exclusive</option>
	        	<option value="2"> Non-Exclusive</option>
	        </select>
	    </section>
	    <section>
	        <label for= "price" class="text-primary-5">Price(USD): </label>
	        <input type="number" name="price" id="price" step="5" value="20.00" min="$20.00" max="1000.00" autocomplete="off">
	    </section
	    <section>
	    	<label for ="audiofile" class="text-primary-5">Audio: </label>
	    	<input type="file" name="audiofile" id="audiofile" accept="audio/*">
	    </section>
	    <section>
	        <input type="submit" name="add_new_audio" id="submit" value="Add Track" autocomplete="off">
	    </section>
    </form>
	</main>
</body>
</html>