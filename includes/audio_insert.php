<?php

	$tag_found = "../audio_temp/test/11_Interlude_Holiday.mp3"; 
	$tag = id3_get_tag($tag_found);
	print_r($tag);
?>