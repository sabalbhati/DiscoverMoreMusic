<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>New Audio</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type=" text/css" href="css/index.css">
<link rel="stylesheet" type=" text/css" href="css/new_audio.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/functions.js"></script>
</head>
<body>
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
    <h2 id="new_audio_title">New Audio</h2>
    <form method="post" action="new_audio_validation.php" id="new_audio" enctype="multipart/form-data">
	    <section>
	        <label for= "audio_name">Title: </label>
	        <input type="text" name="audio_name" id="audio_name" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "tempo">Tempo: </label>
	        <input type="text" name="tempo" id="tempo" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "description">Description: </label>
	        <textarea rows="4" cols="30"></textarea>
	    </section>
	    <section>
	        <label for= "genre">Genre: </label>
	        <?php
	        	echo "<select name='genre'>";
	        	
	        	while ($row = mysqli_fetch_array($result))
				{	 
					echo "<option value'".$row['id']."'>" . $row['name'] . "</option>";
				}
				echo "</select>";
	        ?>
	    </section>
	    <section>
	        <label for= "copyright">Copyright: </label>
	        <input type="text" name="copyright" id="copyright" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "price">Price: </label>
	        <input type="text" name="price" id="price" value="" autocomplete="off">
	    </section>
	    <section>
	        <input type="submit" name="submit" id="submit" value="Add Track" autocomplete="off">
	    </section>
    </form>
</body>
</html>