function audioLoader(){
  //target the play buttons
  $(".playButton img").click(function(event){
  	var $songName = $(this).parent().siblings(".title").text();
  	var $user = $(this).parent().siblings(".username").text();

  	var $audioPath = 'audio_temp' + '/' + $.trim($user).toLowerCase() + '/' + $.trim($songName).replace(/\s+/g, '_').toLowerCase() + '.mp3';
    
    //creates a new src attribute for toggling play and pause image
		var origsrc = $(this).attr('src');
    var src = '';

    if (origsrc == "images/play_button.png"){ 
      //plays track and shows pause button
    	src = 'images/stop_button.png';
      loadSong($audioPath);

      $("footer p").html("<p>Now Playing: " + $songName).hide().slideDown(1200);
    }
    else{ 	
      // pauses track and shows play button
    	src = 'images/play_button.png';	
      pauseAudio();
    }
		$(this).attr('src', src);
  });
}


