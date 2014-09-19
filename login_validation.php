<?php
	session_start();
?>

<?php
include("includes/utility.class.php");
include("includes/config.class.php");
include("includes/db.class.php");

//initialize query variable
$query = '';

$config = new config();

//new database object
$db = new db($config);

$db->openConnection();

//check to see if the connection is open
$connectionStatus = $db->pingServer();

require_once("functions/ep_function.php");

if (isset($_POST['submit']))
{
	$util = new Utility();

	//escape variables for security reasons
	$username = $db->stringEscape($_POST['username']);
	$password = $db->stringEscape($_POST['password']);
	
	if($connectionStatus)
	{
		$query = $db->query(" SELECT " .
			                  	"id, " .
			                  	"username, " .
			                  	"password " .
							   				"FROM " .
							   					"members " .
												"WHERE " . 
													"username = '" . $username . "'");

		//queries the db 	
		$result =  $db->hasRows($query);	


		$rowsFound = $db->hasRows($result);

		if($rowsFound)
		{
			$db->fetchArray($query);
		}
			

		while ($row = $db->fetchArray($result))
		{	 
			if(crypt($password, $row['password']) == $row['password'])
			{
				echo "You are in Welcome";
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
	} //END if($connectionStatus) 
}
	
?>