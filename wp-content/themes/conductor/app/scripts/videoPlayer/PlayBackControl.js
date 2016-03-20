// Dependencies

// Jquery
import $ from 'jquery';
// React
import React from 'react';
// React Render
import { render } from 'react-dom';
// React Class Names
import classNames from 'classnames';



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

export default PlayBackControl;