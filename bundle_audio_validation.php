<?php
	session_start();
?>
<?php
	require_once("includes/db_con.php");
	require_once("functions/ep_function.php");

	if (isset($_POST['submit']))
	{
		//escape variables for security reasons
		$bundle_name = $mysqli->real_escape_string($_POST['bundle_name']);
		$description = $mysqli->real_escape_string($_POST['description']);
		$genre = $mysqli->real_escape_string( $_POST['genre']);
		$producer = $mysqli->real_escape_string($_POST['producer']);
		$price = $mysqli->real_escape_string($_POST['price']);
		$discount = $mysqli->real_escape_string($_POST['discount']);
		$discount_placement = $mysqli->real_escape_string($_POST['discount_placement']);
		$release_date = $mysqli->real_escape_string($_POST['release_date']);
		$copy = $mysqli->real_escape_string($_POST['copyright']);

		//bundle name, genre and price must be given are required
		if(isset($bundle_name) && isset($genre) && isset($price)) 
		{
			$query ='CALL bundle_add("'.
							$bundle_name . '","' .
							$description . '","' . 
							$genre . '","' .
							$producer . '","' .
							$price . '","' .
							$discount . '","' .
							$discount_placement . '","' . 
							$release_date . '","' .
							$copy . '"' .
							')';
			$result = $mysqli->query($query);
			
			if ($mysqli->error) 
			{
    		printf("Errormessage: %s\n", $mysqli->error);
			}
			else
			{
				
			}
  		 
     	
		} 	
	}
?>