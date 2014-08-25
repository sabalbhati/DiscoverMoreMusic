<?php session_start(); ?>
<section id="quickLogin">
	<?php
		if(isset($_SESSION['user']))
		{	 
			$username = $_SESSION['user'];
			echo "<ul>" .
                    "<li id=\"quickLogin_first\" class=\"login_info\" > " .
                        "Logo goes here" . "
                    </li>" .
                    "<li class= \"login_info\" id= \"quickLogin_second\"> " .
                        "Hi " . $username . "!" .
                    "</li> " .
                    "<li class= \"login_info\" id=\"quickLogin_third\">" .
                        "<a href=\"includes/logout.php\">SignOut</a>" .
                    "</li> " .    
                "</ul>";
		} 
		else
		{
		   echo "<ul>" .
				    "<li class=\"login_info\"><a href=\"login.php\">Login</a></li> " .
				    "<li class= \"login_info\"><a href=\"registration.php\"> Register</a></li> " .	
			    "</ul>";
		}
	?>
</section>  
<nav id="main_nav">
    <table> 
        <tr>
            <td><!--<img src="images/ddm_logo.png" alt="logo" />-->  </td>
            <td> 
                <ul>
                    <li><a href="index.php">Discover</a></li>
                    <?php
                    	if(isset($_SESSION['user'])) {
                            echo "<li><a href=\"account.php\"> MyAccount</a></li>"; 
						}
					?>	
                </ul>	
            </td>
            <td> </td>
        </tr>
    </table>
</nav>