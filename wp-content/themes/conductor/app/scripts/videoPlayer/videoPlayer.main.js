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
import { VideoController } from './VideoController';


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
					<video src={this.state.videoUrl} autoPlay muted loop id={this.props.videoId}>
						<p>Sorry, you need an HTML5 browser to view this full experience.</p>
					</video>
					<VideoController data-videoid={this.props.videoId}/>
				</div>;
	}
}; // End Video Player

export default VideoPlayer;


