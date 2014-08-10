$(document).ready(function(){
  $(".track ul").click(function(){
  	var $songName = $(this).children(":first").text();
  	var $user = $(this).children(":first").next().text();
  	
  	var $audioPath = 'audio_temp' + '/' + $.trim($user) + '/' + $.trim($songName).replace(' ','_') + '.mp3';
  	$("#player").add( "audio" ).addClass( "play_audio" ).attr("src", $audioPath).appendTo(audio);
	});
});