window.AudioContext = window.AudioContext ||
                        window.webkitAudioContext;
var aContext = new AudioContext();
var source="";

function loadSong(url){
  var request = new XMLHttpRequest();
  request.open('GET', url ,true);
   
    request.responseType='arraybuffer';

    //Decode asyncronously
    request.onload = function(){
      aContext.decodeAudioData(request.response, function(buffer){
        var songBuffer = buffer;

        playAudio(songBuffer);
      }, function(){alert("unable to load song")});
    }
    request.send();
}

function playAudio(buffer){
  source = aContext.createBufferSource();
  source.buffer = buffer;
  source.connect(aContext.destination);
  source.start(0);
}

function pauseAudio(){
  source.stop(0);
}