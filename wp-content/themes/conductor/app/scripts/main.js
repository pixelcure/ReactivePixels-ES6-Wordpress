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
import VideoPlayer from './VideoPlayer/VideoPlayer.main';
// Office Google Map
import OfficeMap from './OfficeMap/OfficeMap.main';


// Document Ready
$(function(){

    // Enable Parallax
    var parallax = new Parallax('parallax');

    // Sticky Header
    var stickyHeader = new StickyHeader('header', 'top');

    // Navigation
    var nav = new Nav('nav', 'menu-trigger');

    // render(<VideoPlayer videoId="heroVideo"/>, document.getElementById('heroVideoPlayer'));
	
});