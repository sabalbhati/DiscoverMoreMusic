<?php
  $config = new config();
  $db = new db($config);
  
  $db->openConnection();

  if ($db->pingServer())
  {
  	//get all users with a promo advert passing promotion id
		$result = $db->query('CALL promo_users(1)');

		// if there are rows promo users get their songs
		if ($db->hasRows($result))
		{
			
			$numRows=$db->countRows($result);

			$promo_users = array();

			//store promo users in array
			$i = 0;
			while($row = $db->fetchArray($result))
			{	
				$promo_users[$i][0] = $row['id'];
				$promo_users[$i][1] = $row['username'];
				$promo_users[$i][2] = $row['bio'];
				$i++;
			}	

			//$db->closeConnection();
			
			// fetch 3 promo songs for 3 selected promo user accounts
			for($i=0; $i<$numRows; $i++)
			{
				$db->openConnection();
				$query = "CALL promo_user_audio(" . $promo_users[$i][0] . ")" ;
				$result = $db->query($query);

				//store picture directory
				$picture = "image_temp/" . $promo_users[$i][1] . "/image1.png";

				echo "<section class= \"main_promo_user color-primary-0\">";
				echo "<img src= '" . $picture . "'/>";
				echo "<section id=\"promoSongSect\">";
				while($row = $db->fetchArray($result))
				{
					$audioLocation = "audio_temp/". $promo_users[$i][1] . "/" . $row['name'] . "." . $row['extension'];
					echo "<section>";
					echo "<div class=\"smallPlayButton\"> <img src= \"images/play_button.png\"></div>";

					echo  "<div class= \"smallTitle\" >" . $row['name'] . "</div>";
					echo "</section>";
				}
				echo "</section>"; // end song section
				echo "<div class= \"bio\">". $promo_users[$i][2]  . "</div>";
				
				echo "</section>"; //end promo_user section
			}
		}
  }
?>
