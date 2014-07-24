<?php session_start(); ?>
<section id="quickLogin">
	<?php
		if(isset($_SESSION['user']))
		{	 
			$username = $_SESSION['user'];
			echo "<ul> ".
                    "<li><a href=\"includes/logout.php\">SignOut</a></li> " .
                    "<li><h4>Hi ". $username . "!</h4></li> " .
                "</ul";
		} 
		else
		{
		   echo "<ul>" .
				    "<li><a href=\"login.php\">Login</a></li> " .
				    "<li><a href=\"registration.php\"> Register</a></li> ".	
			    "</ul>";
		}
	?>
</section>
<nav id="main_nav" class="text-primary-1 color-primary-2">
    <table> 
        <tr>
            <td><img src="images/logo2.png" alt="logo" /> </td>
            <td> 
                <ul>
                    <li>Categories</li>
                    <li>New</li>
                    <li>Discover</li>
                    <li>Random</li>
                    <li>Trending</li>
                    <li>Favorites</li>
                    <?php
                    	if(isset($_SESSION['user']))
                        {
                            echo "<li><a href=\"account.php\"> MyAccount</a></li>"; 
						}
					?>	
                </ul>	
            </td>
            <td> </td>
        </tr>
    </table>
</nav>