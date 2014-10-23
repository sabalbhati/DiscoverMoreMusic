$(document).ready(function(){
	$.ajax({
		url: "load_audio.php",
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: $(this).serialize(),
		success: function(data){
			var audio_container = document.getElementById("audio_containter");
			$(data.audiofiles).each(function(index, value){
				var image = imageBuilder(value.username);
				var username = textBuilder(value.username.toUpperCase(),'username');
				var trackTitle = textBuilder(value.title, 'title');
				var trackGenre = textBuilder(value.genre, 'genre');
				var buttonDiv = document.createElement('div');
				buttonDiv.setAttribute('class', 'buttonContainer');

				var playButton = imageButton('play_button','playButton', 'images','png');
				var likeButton = imageButton('heart','likeButton','images', 'png');
				var cartButton = imageButton('cart','cartButton','images', 'png');
				var starButton = imageButton('star','starButton','images', 'png');
				var groupButton = imageButton('group', 'groupButton','images','png');
				var commentButton = imageButton('comment','commentButton', 'images', 'png');

				var trackAudioSection = document.createElement("section");
				trackAudioSection.setAttribute("class","track color-primary-0");

				
				buttonDiv.appendChild(likeButton);
				buttonDiv.appendChild(cartButton);
				buttonDiv.appendChild(starButton);
				buttonDiv.appendChild(groupButton);
				buttonDiv.appendChild(commentButton);

				trackAudioSection.appendChild(image);
				trackAudioSection.appendChild(username);
				trackAudioSection.appendChild(trackTitle);
				trackAudioSection.appendChild(trackGenre);
				trackAudioSection.appendChild(playButton);
				
				trackAudioSection.appendChild(buttonDiv);


				audio_container.appendChild(trackAudioSection);
			});
				//call to load audio attribute and funcionality
				audioLoader();
		}

	});

	//builds the user image for each audio track
	function imageBuilder(memberName){
		var trackMemberDiv = document.createElement('div');
		trackMemberDiv.setAttribute("class", "userimage");
		var trackMember = document.createElement("img");
		trackMember.src = 'image_temp/' + memberName + '/image1.png';
		trackMember.alt = memberName;
		trackMemberDiv.appendChild(trackMember);
		return trackMemberDiv;
	}

	// builds the information of the audio track
	function textBuilder(info, className)
	{
		var trackInfoDiv = document.createElement('div');
		trackInfoDiv.setAttribute("class", className);
		var infoText = document.createTextNode(info);
		trackInfoDiv.appendChild(infoText);
		return trackInfoDiv;
	}
	
	function imageButton(imageName,className, img_dir,extension)
	{
		var trackButtonDiv = document.createElement('div');
		trackButtonDiv.setAttribute("class", className);

		if (imageName == 'heart')
		{
			trackButtonDiv.setAttribute("class", className);
		}

		var trackButtonImage = document.createElement("img");
		trackButtonImage.src = img_dir + "/" + imageName + "." + extension;
		trackButtonImage.alt= className;
		trackButtonDiv.appendChild(trackButtonImage);
		return trackButtonDiv;
	}

});