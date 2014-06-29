<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>DMM Login</title>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="	text/css" href="css/index.css">
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/functions.js"></script>
</head>
</head>

<body>
<?php
	require("includes/header.php");
?>
	<main id="wrapper">
    	<section class="track">
        	<aside class="profile_avatar">
        		<img src="images/image.jpg" alt="artist image" class="user_image"/>
      		</aside>
           <section class="track_content">
           	<h1> Artist Name - Audio Name </h1>
            	<ul>
              		<li> Length </li>
                	<li> Genre </li>
                  <li> Description </li>  
            	</ul>
           </section>
            
    	</section>
    </main>
<?php
	require("includes/footer.php");
?>
</body>

</html>
