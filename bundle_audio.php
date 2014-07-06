<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>New Album</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type=" text/css" href="css/bundle_audio.css">
<link rel="stylesheet" type=" text/css" href="css/forms.css">
<link rel="stylesheet" type="text/css" href="jQuery/jquery-ui.css">
<script src="jQuery/jquery-1.11.1.min.js"></script>
<script src="jQuery/jquery-ui.js"></script>
<script src="js/functions.js"></script>
<script src="js/audio_bundle_validation.js"></script>
<script src="js/date_picker.js"></script>
</head>
<body>
<?php
	//connection to db and header inclusion
	require("includes/header.php");
	require("includes/db_con.php");
	
	//query for genre and promo dropdown
	$genre_query = "SELECT id, name FROM genres";
	$promo_query = "SELECT id, name FROM promotions WHERE id IN (2,4)";
	
	//result set fore promo and genre dropdown
	$result_genre = $mysqli->query($genre_query);
	$result_promotion = $mysqli->query($promo_query);
	
	// error messages for genre and promo drop down
	if (!$result_promotion) {
	    printf("Error: %s\n", mysqli_error($mysqli));
	    exit();
	}
	
	if (!$result_genre) {
	    printf("Error: %s\n", mysqli_error($mysqli));
	    exit();
	}
?>
    <h2>New Album</h2>
    <form method="post" action="bundle_audio_validation.php" id="bundle_audio" class="input_forms" enctype="multipart/form-data">
	    <section>
	        <label for= "bundle_name"> Title: </label>
	        <input type="text" name="bundle_name" id="bundle_name" value="" autocomplete="off">
	    </section>
	    <section>
	        <label for= "description">Description: </label>
	        <textarea id="description" name="description" rows="4" cols="30"></textarea>
	    </section>
	    <section>
	        <label for= "genre">Genre: </label>
	        <?php
	        	echo "<select name=\"genre\">";
	        	echo "<option value =\"\">--- Select Genre ---</option>";
	        	while ($row = mysqli_fetch_array($result_genre))
						{	 
							echo "<option value =\"".$row['id']."\">" . $row['name'] . "</option>";
						}
						echo "</select>";
	        ?>
	    </section>
	     <section>
	        <label for= "producer">Producer(s)</label>
	        <input type="text" name="producer" id="producer" autocomplete="off">
	    </section>
	    <section>
	        <label for= "price">Price(USD): </label>
	        <input type="number" name="price" id="price" value="20.00" min="20.00" max="1000.00" autocomplete="off">
	    </section>
	     <section>
	        <label for= "discount">Discount(%): </label>
	        <input type="number" name="discount" id="discount" value="" min='5' max='90'>
	    </section>
	 		<section>
	        <label for= "discount_placement">Discount Placement: </label>
	        <?php
	        	echo "<select name=\"discount_placement\" id=\"discount_placement\">";
	        	
	        	while ($row = mysqli_fetch_array($result_promotion))
						{	
							echo "<option value =\"".$row['id']."\">" . ucfirst(str_replace('single_', '', $row['name'])) .  "</option>";
						}
						echo "</select>";
	        ?>
	    </section>
	    <section>
	        <label for= "release_date">Release Date: </label>
	        <input type="text" class="jq_date" name="release_date" id="release_date">
	    </section>
	    <section>
	        <input type="submit" name="submit" id="submit" value="Add Bundle" autocomplete="off">
	    </section>
	    <section>
	    	<input type="hidden" name="copyright" value="1">
	    </section>
    </form>
</body>
</html>