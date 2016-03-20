// Dependencies

// Jquery
import $ from 'jquery';
// React
import React from 'react';
// React Render
import { render } from 'react-dom';
// React Class Names
import classNames from 'classnames';


// PlayBack and Volume Control Components
import { PlayBackControl } from './PlayBackControl';
import { VolumeControl } from './VolumeControl';


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

export default VideoController;



