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

	ComponentDidMount() {

	};

	playBackControl() {
		this.setState({
			videoPlaying : this.state.videoPlaying ? false : true
		});
	};

	render() {
		return 	<div onClick={this.playBackControl} className="control">
			          <span className='icon-pause icon'></span>            
				</div>;
	};	

}; // End PlayBackControl