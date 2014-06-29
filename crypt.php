<?php 
include("functions/ep_function.php");
$user_input = "password";

$crypt_password = password_encrypt($user_input);

if (crypt($user_input, $crypt_password) == $crypt_password)
{
	echo $crypt_password;
	echo "<br >";
	echo strlen($crypt_password);
}
else
{
	echo "No";
}
	

?>