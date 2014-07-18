<?php
	session_start();
?>

<?php
require_once("includes/db_con.php");
require_once("functions/ep_function.php");

if (isset($_POST['submit']))
{
	//escape variables for security reasons
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
	
	// gets the username that matches the record
	$query = "SELECT id, username, password " .
						   	"FROM members " .
							"WHERE username = " . "'" .$username. "'";
	
	//queries the db 						
	$result = $mysqli->query($query);
	
	while ($row = mysqli_fetch_array($result))
	{	 
		if(crypt($password, $row['password']) == $row['password'])
		{
			$_SESSION['user']= $username;
			$_SESSION['id'] = $row['id'];
			header('Location:account.php'); 
		}
		else
		{
			echo "Invalid username/password";
			session_destroy();
		}
	}
}
	
?>