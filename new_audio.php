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
<body class="color-primary-0">
	
		<?php
			
			require("includes/header.php");
			
			require("includes/db_con.php");
			$genre_query = "SELECT id, name FROM genres";
			$result = $mysqli->query($genre_query);
			
			if (!$result) {
		    printf("Error: %s\n", mysqli_error($mysqli));
		    exit();
		}
		?>
	<main id="wrapper"> 
		    <h2 class="text-primary-1">New Audio</h2>
		    <form method="post" action="new_audio_validation.php" id="new_audio" class="input_forms color-primary-1" enctype="multipart/form-data">
			    <section>
			        <label for= "audio_name" class="text-primary-1">Title: </label>
			        <input type="text" name="audio_name" id="audio_name" class="color-primary-3" value="" autocomplete="off">
			    </section>
			    <section>
			        <label for= "tempo" class="text-primary-1">Tempo: </label>
			        <input type="text" name="tempo" id="tempo" class="color-primary-3" value="" autocomplete="off">
			    </section>
			    <section>
			        <label for= "description" class="text-primary-1" >Description: </label>
			        <textarea rows="4" cols="30" class="color-primary-3"></textarea>
			    </section>
			    <section>
			        <label for= "genre" class="text-primary-1">Genre: </label>
			        <?php
			        	echo "<select name='genre' class='color-primary-3'>";
			        	
			        	while ($row = mysqli_fetch_array($result))
						{	 
							echo "<option value'".$row['id']."'>" . $row['name'] . "</option>";
						}
						echo "</select>";
			        ?>
			    </section>
			    <section>
			        <label for= "copyright" class="text-primary-1">Copyright: </label>
			        <select name="copyright" class="color-primary-3">
			        	<option value="1">Exclusive</option>
			        	<option value="2"> Non-Exclusive</option>
			        </select>
			    </section>
			    <section>
			        <label for= "price" class="text-primary-1">Price(USD): </label>
			        <input type="number" name="price" id="price" class="color-primary-3" value="20.00" min="$20.00" max="1000.00" autocomplete="off">
			    </section>
			    <section>
			    	<label for ="audiofile" class="text-primary-1">Audio: </label>
			    	<input type="file" name="audiofile" id="audiofile" class="color-primary-3" accept="audio/*">
			    </section>
			    <section>
			        <input type="submit" name="add_new_audio" id="submit" class="color-primary-3" value="Add Track" autocomplete="off">
			    </section>
		    </form>
	</main>
</body>
</html>