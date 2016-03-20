// Dependencies

// Jquery
import $ from 'jquery';
// React
import React from 'react';
// React Render
import { render } from 'react-dom';
// React Class Names
import classNames from 'classnames';


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

export default VolumeControl;