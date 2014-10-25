<?php session_start(); ?>
<section id="quickLogin" class="color-primary-3">
    <?php
        if(isset($_SESSION['user']))
        {    
          $username = $_SESSION['user'];
          echo "<ul>" .
                  "<li> " .
                    "<img src=\"images/dmm_logo.png\" id=\"logo\"/>" .
                  "</li>" .
                  "<li> " .
                    "Hi " . $username . "!" .
                    "<a href=\"account.php\"><img id=\"myaccountImg\" src=\"images/myaccount.png\" /></a>" .
                    "<a href=\"includes/logout.php\">SignOut</a>" .
                  "</li> " .    
                "</ul>";
        } 
        else
        {
          echo  "<ul>" .
                  "<li class= \"login_info\"> " .
                    "<img src=\"images/dmm_logo.png\" id=\"logo\" />" .
                  "</li> " .   
                  "<li class=\"login_info\">" . 
                    "<a href=\"registration.php\"> Register</a> &nbsp;" .
                    "<a href=\"login.php\">Login</a>" .
                  "</li> " .              
                "</ul>";
        }
    ?>
</section>