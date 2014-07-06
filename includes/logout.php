<?php 
	session_start();
	require("../functions/ep_function.php");
	session_destroy();
	$SESSION = array();
	
	redirect("../index.php");
?>
