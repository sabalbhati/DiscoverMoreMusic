function audioLoader(){
  //target the play buttons
  $(".track").click(function(event){
    alert("clicked");
  // 	var songName = $(this).parent().siblings(".title").text();
  // 	var user = $(this).parent().siblings(".username").text();

  // 	var audioPath = 'audio_temp' + '/' + $.trim(user).toLowerCase() + '/' + $.trim(songName).replace(/\s+/g, '_').toLowerCase() + '.mp3';  
  //   //creates a new src attribute for toggling play and pause image
		// var origsrc = $(this).attr('src');

  //   var newSource = playToggle(origsrc, audioPath, songName, user);

  //   $(this).attr('src', newSource);
  });
}

/*
* Controls the toggle of the play and stop button and the play 
* stop function
*
* @params origsrc The current image source of the button
* @params audiopath The audio path of the song being played
* @params The song name 
* @params The name of the song owner
*/
function playToggle(origsrc, audioPath, songName, user)
{
  if (origsrc == "images/play_button.png")
  { 
    var src = '';
    //plays track and shows pause button
    src = 'images/stop_button.png';
    loadSong(audioPath);

    $("footer p").html("<p>Now Playing: " + songName).hide().slideDown(1200);
  }
  else if(origsrc == "images/stop_button.png") 
  {   
    // pauses track and shows play button
    src = 'images/play_button.png'; 
    pauseAudio();
    $("footer p").html("<p>Stopped Playing: " + songName).hide().slideDown(1200);
  }
  return src; 
}
