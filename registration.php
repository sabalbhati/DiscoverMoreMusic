<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>DDM:Registration Form</title>
	<link rel="stylesheet" type="text/css" href="css/base.css">
	<link rel="stylesheet" type="text/css" href="css/registration.css">
    <link rel="stylesheet" type="text/css" href="css/forms.css">
	<script src="jQuery/jquery-1.11.1.min.js"></script>
	<script src="js/functions.js"></script>
	<script src="js/registration.js"></script>
</head>

<body>
	<form method="post" action="registration_validation.php" id="registration" enctype="multipart/form-data">

     	<h2> Registration Form </h2>

    	<section class="field">
        	<label for= "username">Username: </label>
        	<input type="text" name="username" id="username" value="" autocomplete="off">
        </section>
        
         <section class="field">
        	<label for ="email">Email: </label>
           <input type="text" name="email" id="email">
        </section>
        
        <section class="field">
        	<label for ="password">Choose Password: </label>
           <input type="password" name="password" id="password">
        </section>
        
        <section class="field">
        	<label for ="password_again">Confirm Password: </label>
           <input type="password" name="password_again" id="password_again">
        </section>
        
         <section class="field">
        	<label for ="file">Avatar: </label>
           <input type="file" name="avatar" id="avatar" accept="image/*">
           <img id="file_close" src="images/close.png"  alt="close"/>
        </section>
        
        <section id="img_sample">
       		<img id="sample_img" src="#" alt="image" />
    	</section>
        
        <section class="field">
           <input type="submit" name="register" value="Sign Up!">
        </section>
    </form>
	
</body>
</html>