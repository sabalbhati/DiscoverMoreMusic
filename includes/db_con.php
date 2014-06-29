<?php
define("DB_HOST", "localhost");
define("DB_USER", "ddm_admin");
define("DB_PASS", "CrouchingTigress1101");
define("DB_NAME", "DiscoverMoreMusic");
//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_errno)
{
	echo "Failed to connect to MYSQL (" . $mysqli->connect_errno . ")" . 	$mysqli->connect_error;
}

//Test Connection
if(mysqli_connect_errno())
{
	die("Database connection error: " . mysqli_connect_error() .
		" {" .mysqli_connect_errno() . "}"
		);
}

?>