// Depdendencies

// jQuery Instance
import $ from 'jquery';
// React Instance
import React from 'react';
// React Render
import { render } from 'react-dom';
// React Class Names
import classNames from 'classnames';


// Video Controller Components
import VideoController from './VideoController';


// Video Player
class VideoPlayer extends React.Component {
	constructor(props){
		super(props);
	
		this.state = {
			videoUrl : 'https://player.vimeo.com/external/117804497.hd.mp4?s=8aef53600c22e1063dcb665629d5cbe4cb8ad88c&profile_id=119',
			videoPoster : ''
		};	

	};

	render() {
		return
			<div>
				<video poster={this.state.videoPoster} className="span_12" src={this.state.videoUrl} autoplay muted loop id="HeroVideo">
					<p>Sorry, you need an HTML5 browser to view this full experience.</p>
				</video>
				<VideoController />
			</div>;
	};
	
}; // End Video Player
	



