<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>New Album</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type=" text/css" href="css/index.css">
<link rel="stylesheet" type=" text/css" href="css/bundle_audio.css">
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
    <h2 id="bundle_audio_title">New Album</h2>
    <form method="post" action="bundle_audio_validation.php" id="bundle_audio" enctype="multipart/form-data">
	    <section>
	        <label for= "bundle_name"> Title: </label>
	        <input type="text" name="bundle_name" id="bundle_name" value="" autocomplete="off">
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
	        <label for= "producer">Producer(s)</label>
	        <input type="text" name="producer" id="producer" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "price">Price(USD): </label>
	        <input type="number" name="price" id="price" value="20.00" min="$20.00" max="1000.00" autocomplete="off">
	    </section>
	     <section>
	        <label for= "discount">Discount: </label>
	        <input type="number" name="discount" id="discount" value="" autocomplete="off">
	    </section>
	     <section>
	        <label for= "discount_length">Discount Length: </label>
	        <input type="us-date" name="discount_length" id="discount_length" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "release_date">Release Date: </label>
	        <input type="date" name="release_date" id="release_date" value="" autocomplete="off">
	    </section>
	    <section>
	        <input type="submit" name="submit" id="submit" value="Add Bundle" autocomplete="off">
	    </section>
    </form>
</body>
</html>