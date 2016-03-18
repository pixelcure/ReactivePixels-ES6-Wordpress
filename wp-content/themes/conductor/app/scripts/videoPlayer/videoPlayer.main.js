var $ = require('jquery');

export default class {

	constructor (video, volumeControlEl, videoControlEl) {

		this.video = document.getElementById(video);
		this.volumeControlEl = document.getElementById(volumeControlEl);
		this.videoControlEl = document.getElementById(videoControlEl);
		
		this.init = function () {
			console.log('video init');
			this.volumeControlEl.addEventListener('click', this.volumeControl);
			this.videoControlEl.addEventListener('click', this.videoControl);
		};		
		
		this.volumeControl = function(event) {
			console.log('click volume control');
			
			console.log(this.video);

			if(this.video.muted){
				this.video.muted = false;
				$(this.video).find('.icon-volume-mute').addClass('hidden');
				$(this.video).find('.icon-volume').removeClass('hidden');
			} else if (!video.muted) {
				this.video.muted = true;
				$(this.video).find('.icon-volume').addClass('hidden');
				$(this.video).find('.icon-volume-mute').removeClass('hidden');    		
			}
		};
		
		this.videoControl = function(event) {
			console.log('click video control');
			if(this.video.paused){
				this.video.play();
				$(this.video).find('.icon-play').addClass('hidden');
				$(this.video).find('.icon-pause').removeClass('hidden');
			} else if (!this.video.paused) {
				this.video.pause();
				$(this.video).find('.icon-pause').addClass('hidden');
				$(this.video).find('.icon-play').removeClass('hidden');    		
			}				
		};
	};

}; // End Video Player



