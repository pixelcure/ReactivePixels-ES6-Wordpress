// Depdendencies

// jQuery Instance
import $ from 'jquery';
// React Instance
import React from 'react';
// React Render
import { render } from 'react-dom';
// React Class Names
import classNames from 'classnames';
		
// Website Components

// Parallax
import { Parallax } from './Parallax/Parallax.main';
// Sticky Header
import StickyHeader from './StickyHeader/StickyHeader.main';
// Nav Functionality
import Nav from './ResponsiveNav/ResponsiveNav.main';
// Video Player
// import { VideoPlayer } from './VideoPlayer/VideoPlayer.main';
// Office Google Map
import OfficeMap from './OfficeMap/OfficeMap.main';

// Video Volume Control
class VolumeControl extends React.Component {
	constructor(props){
		super(props);
		
		this.state = {
			videoAudio : false
		};

		this.volumeControl = this.volumeControl.bind(this);
	};

	volumeControl() {
		this.setState({
			videoAudio : this.state.videoAudio ? false : true
		});
	};

	render() {
	
	    var iconClass = classNames({
	      'icon': true,
	      'icon-volume-mute': !this.state.videoAudio,
	      'icon-volume': this.state.videoAudio
	    });

		return  <div onClick={this.volumeControl} className="control">          
			          <span className={iconClass}></span>
			    </div>;
	};

} // End Volume Control

// Video Play / Pause
class PlayBackControl extends React.Component {

	constructor (props) {
		super(props);
		
		this.playBackControl = this.playBackControl.bind(this);
		
		this.state = {
			videoPaused : false,
			videoPlaying : true
		};
	};

	playBackControl() {
		this.setState({
			videoPlaying : this.state.videoPlaying ? false : true
		});
	};

	ComponentDidMount() {

	};

	render() {
	    
	    var iconClass = classNames({
	      'icon' : true,
	      'icon-pause' : this.state.videoPlaying,
	      'icon-play' : !this.state.videoPlaying
	    });

		return  <div onClick={this.playBackControl} className="control">
			        <span className={iconClass}></span>            
				</div>;
	};	

}; // End PlayBackControl


// Video Controller
class VideoController extends React.Component {

	constructor(props){
		super(props);
	};

	render() {
		return  <aside className="video-control">
					<PlayBackControl />
					<VolumeControl />
				</aside>
	};

}; // End Video Controller

// Video Player
class VideoPlayer extends React.Component {
	constructor(props){
		super(props);
	
		this.state = {
			videoUrl : 'https://player.vimeo.com/external/117804497.hd.mp4?s=8aef53600c22e1063dcb665629d5cbe4cb8ad88c&profile_id=119',
			videoPoster : 'http://imgur.com/foo.jpg'
		};	

	};

	render() {
		return  <div>
					<video src={this.state.videoUrl} autoPlay muted loop id="videoPlayer">
						<p>Sorry, you need an HTML5 browser to view this full experience.</p>
					</video>
					<VideoController />
				</div>;
	}
}; // End Video Player

// Document Ready
$(function(){

    // Enable Parallax
    var parallax = new Parallax('parallax');

    // Sticky Header
    var stickyHeader = new StickyHeader('header', 'top');

    // Navigation
    var nav = new Nav('nav', 'menu-trigger');


    render(<VideoPlayer />, document.getElementById('heroVideoPlayer'));
	

});