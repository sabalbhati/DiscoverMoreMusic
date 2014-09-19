<!doctype html>
<html>
<head>
	<meta charset="UTF-8" >
	<title>DDM:Registration Form</title>
	<link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/registration.css">
    <link rel="stylesheet" type="text/css" href="css/account.css">
    <link rel="stylesheet" type="text/css" href="css/player.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
	<script src="jQuery/jquery-1.11.1.min.js"></script>
	<script src="js/functions.js"></script>
    <script src="js/account.js"></script>
</head>
    
<body>
<?php
	require("includes/header.php");
    include("includes/utility.class.php");
    include("includes/config.class.php");
    include("includes/db.class.php");

    $config = new config();
    //new database object
    $db = new db($config);

    $db->openConnection();

    //check to see if the connection is open
    $connectionStatus = $db->pingServer();

    if($connectionStatus)
    {
        // gets the username that matches the record
    	$query = "SELECT username, avatar, bio, email, registered_on, account_type, modified_on, avatar_ext " .
    						   	"FROM members " .
    							"WHERE username = " . "'" .$username. "'";    
        //queries the db 						
    	$result = $db->query($query);

        $rowsFound = $db->hasRows($result);

        if($rowsFound)
        { 
        	while ($row = $db->fetchArray($result))
        	{	  
            ?>
            	<main id="wrapper">
                    <section id="accountAvatar">
                        <div>
                            <?php
                                $avatar = $row['avatar'];
                                $extension = $row['avatar_ext'];
                                
                                echo "<img src=\"" . "image_temp/" . $username . "/image1." . $extension. "\" />";  
                            ?>
                        </div>
                    </section>
                    <section id="miniPics" >
                    	<ul>
                            <li><a href="#"><img src="images/image.jpg" /></a></li>
                            <li><a href="#"><img src="images/image.jpg" /></a></li>
                            <li><a href="#"><img src="images/image.jpg" /></a></li>
                            <li><a href="#"><img src="images/image.jpg" /></a></li>
                            <li><a href="#"><img src="images/image.jpg" /></a></li>
                        </ul>
                    </section>
                    <section id="userInfo" class="text-primary-1">
                        <?php
                            echo "<h2>" . strtoupper($row['username']) . "</h2>";
                            echo "<h3>Fans: </h3>";
                            echo "<p>Email: " . $row['email'] . "</p>";
                            echo "<p> Biography: " . $row['bio'] . "</p>";
                            echo "<p>Member Since: " . date("F, jS, Y", strtotime($row['registered_on'])) . "</p>";    
                        ?>
                    </section>
                    <section id="sub_menu" class="color-primary-4 ">
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
                    <div id="show_content">
                        <ul>
                            <li><a href="#Audio" id="show_audio">Audio</a></li>
                            <li><a href="#Album" id="show_bundle">Album</a></li>
                        </ul>
                    </div>
                    <section id="track" >
                        <!-- holds audio and bundle content dynamically -->   	
                    </section>
                </main>
            <?php
            } //while($row = mysqli_fetch_array($result))
        } // if($rowsFound)
    } // if($connectionStatus) END
?>
<?php require("includes/footer.php"); ?>
</body>
</html>