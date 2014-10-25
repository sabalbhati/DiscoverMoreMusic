function audioLoader(){
  //target the play buttons
  $(".track").click(function(event){

    var songName = $(this).children(".title").text();
    var user = $(this).children(".username").text();

    var audioPath = 'audio_temp' + '/' + $.trim(user).toLowerCase() + '/' + $.trim(songName).replace(/\s+/g, '_').toLowerCase() + '.mp3';  
    
    //remove play indicator on all audio blocks
    $(this).siblings().removeClass("playing");

    //set play indicator on selected audio block
    $(this).toggleClass("playing");    

    loadSong(audioPath);
  });
}

