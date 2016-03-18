var $ = require('jquery');

export default class {

	constructor(header) {
		
		// Header
		this.header = document.getElementById(header);

		// Init 
		this.init = function () {
			// Scroll Check To Toggle Header
			this.onScroll();
			// On Scroll
			$(window).on('scroll', this.onScroll);
		};
		
		// On Scroll
		this.onScroll = function() {

			// Scroll Top
	        var scrollTop = $(window).scrollTop();
	        
	        // Header Scroll
	        if(scrollTop <= 115){
	            $('header').removeClass('top');
	        } else if (scrollTop => 115) {
	            $('header').addClass('top');
	        }
		}

	} // End Constructor
};
