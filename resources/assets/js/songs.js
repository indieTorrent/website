require('./my-account/digital-catalog/edit.js');

$(".audio-preview-play").on("click", function() {
	var soundId = $(this).data('player-id');
	
	var mySMSound = soundManager.getSoundById(soundId);
	
	var index;
	
	//Pause all players, except the player upon which the user clicked.
	
	for (index = 0; index < previewPlayers.length; ++index) {
		if (soundId !== previewPlayers[index]) {
			pausePreviewPlayer(previewPlayers[index], soundManager.getSoundById(previewPlayers[index]));
		}
	}
	
	//Toggle the pause state on the clicked player.
	
	mySMSound.togglePause();
	
	if (mySMSound.playState == 1) {
		$(this).addClass('playing');
	}
	else {
		$(this).removeClass('playing');
	}
	
	if (mySMSound.paused === false) {
		$(this).removeClass('fa-play-circle-o').addClass('fa-pause');
	}
	else {
		$(this).removeClass('fa-pause').addClass('fa-play-circle-o');
	}
});

function pausePreviewPlayer(elementId, soundManagerInstance)
{
	$('#' + elementId).removeClass('fa-pause').addClass('fa-play-circle-o');
	soundManagerInstance.pause();
}

function pauseAllPreviewPlayers()
{
	soundManager.pauseAll();
	
	$('.audio-preview-play').removeClass('fa-pause').addClass('fa-play-circle-o');
}
