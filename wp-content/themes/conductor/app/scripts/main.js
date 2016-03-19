// Depdendencies

// jQuery Instance
import $ from 'jquery';
// React Instance
import React from 'react';
// React Render
import { render } from 'react-dom';


// Website Components

// Parallax
import { Parallax } from './parallax/Parallax.main';
// Sticky Header
import StickyHeader from './stickyHeader/StickyHeader.main';
// Nav Functionality
import Nav from './responsiveNav/ResponsiveNav.main';
// Video Player
import VideoPlayer from './videoPlayer/VideoPlayer.main';
// Office Google Map
import OfficeMap from './officeMap/officeMap.main';


// Document Ready
$(function(){

    // Enable Parallax
    var parallax = new Parallax('parallax');

    // Sticky Header
    var stickyHeader = new StickyHeader('header', 'top');

    // Navigation
    var nav = new Nav('nav', 'menu-trigger');

    // Video Player
    var videoPlayer = new VideoPlayer();

});