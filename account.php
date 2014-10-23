<?php
    require("includes/header.php");
    include("includes/utility.class.php");
    include("includes/config.class.php");
    include("includes/db.class.php");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" >
  <title>DDM::My Account</title>
  <link rel="stylesheet" type="text/css" href="css/account.css">
  <link rel="stylesheet" type="text/css" href="css/base.css">
  <link rel="stylesheet" type="text/css" href="css/color.css">
  <script src="jQuery/jquery-1.11.1.min.js"></script>
  <script src="js/functions.js"></script>
  <script src="js/jQuery.modal_box.js"></script>
  <script src="js/account.js"></script> 
</head>
    
<body>
<?php

  $config = new config();
  $db = new db($config);

  $db->openConnection();

  //check to see if the connection is open
  $connectionStatus = $db->pingServer();

  if($connectionStatus)
  {
  	$query = "CALL get_user('" . $username . "')";   				
  	$result = $db->query($query);
    $rowsFound = $db->hasRows($result);
    if($rowsFound)
    { 
    	while ($row = $db->fetchArray($result))
    	{	  
?>
      	<main id="wrapper">
          <section id="accountAvatar" style="background-image='$row[\"avatar"\]'">
            <div>
              <?php
                $avatar = $row['avatar'];
                $extension = $row['avatar_ext'];
                echo "<img src=\"" . "image_temp/" . $username . "/$avatar." . $extension. "\" />";  
                echo "<a href=\"#\" class=\"edit_avatar\" id=\"$username\">Edit</a>";
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
              
              echo "<p>Member Since: " . date("F, jS, Y", strtotime($row['registered_on'])) . "</p>"; 
              echo "<p> Biography: " . $row['bio'] . "</p>";   
              echo "<a href=\"#\" class=\"edit_avatar\" id=\"$username\">Edit</a>";
            ?>
          </section>
          <section id="sub_menu" class="color-primary-4 ">
            <ul>
              <li> <a href="new_audio.php">[+] Add Track </a></li>
              <li> <a href="bundle_audio.php">[+] New Bundle </a></li>
              <li> <a href="#">[+] Account Settings </a></li>
              <li> <a href="#" id ="balance">[+] Balance </a></li>
              <li> <a href="#">[+] Statistics </a></li>
              <li> <a href="#">[+] Adverts </a></li>
              <li> <a href="#">[+] Messages </a></li>
              <li> <a href="#">[+] Custom Work </a></li>
            </ul>
          </section>
          <div id="show_content">
            <ul>
              <li><a href="#Audio" id="show_audio">Audio</a></li>
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
