<?php
	require_once("includes/db_con.php");
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>DDM:Registration Form</title>
	<link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/registration.css">
    <link rel="stylesheet" type="text/css" href="css/account.css">
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/functions.js"></script>
</head>

<body>
<?php
	require("includes/header.php");
    // gets the username that matches the record
    
    // gets the username that matches the record
	$query = "SELECT username, avatar, bio, email, registered_on, account_type, modified_on, avatar_ext " .
						   	"FROM members " .
							"WHERE username = " . "'" .$username. "'";
    
    //queries the db 						
	$result = $mysqli->query($query);
    
	while ($row = mysqli_fetch_array($result))
	{	 
    
?>
	<main id="wrapper">
        <section id="accountAvatar">
            <div>
                <?php
                    $avatar = $row['avatar'];
                    $extension = $row['avatar_ext'];
                    //header("Content-type: image/gif");
                    echo '<img src="data:image/'.$extension.';base64,' . $avatar . '" />';  
                ?>
            </div>
        </section>
        
        <section id="miniPics">
        	<ul>
                <li><a href="#"><img src="images/image.jpg" /></a></li>
                <li><a href="#"><img src="images/image.jpg" /></a></li>
                <li><a href="#"><img src="images/image.jpg" /></a></li>
                <li><a href="#"><img src="images/image.jpg" /></a></li>
                <li><a href="#"><img src="images/image.jpg" /></a></li>
            </ul>
        </section>
        
        <section id="userInfo">
            <?php
                echo "<h2>" . strtoupper($row['username']) . "</h2>";
                echo "<h3><strong>Fans: </strong></h3>";
                echo "<p><strong> Email: </strong> " . $row['email'] . "</p>";
                echo "<p><strong> Biography: </strong>" . $row['bio'] . "</p>";
                echo "<p> <strong>Member Since: </strong> " . date("F, jS, Y", strtotime($row['registered_on'])) . "</p>";    
            ?>
        </section>
        <section id="sub_menu">
            <ul>
                <li> <a href="new_audio.php">[+] Add Track </a></li>
                <li> <a href="bundle_audio.php">[+] New Bundle </a></li>
                <li> <a href="#">[+] Account Settings </a></li>
                <li> <a href="#">[+] Balance </a></li>
                <li> <a href="#">[+] Statistics </a></li>
                <li> <a href="#">[+] Adverts </a></li>
                <li> <a href="#">[+] Messages </a></li>
                <li> <a href="#">[+] Custom Work </a></li>
            </ul>
        </section>
        <section id="track">
        	<div id="eachTrack">
                <p> Audio Info</p>  
                <p> Wav Length</p> 
                <p> actions</p>       
        	</div>
        </section>

    </main>

<?php
    }
?>

</body>
</html>