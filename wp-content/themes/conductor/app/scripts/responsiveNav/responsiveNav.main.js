var $ = require('jquery');

export default class {

	constructor(nav, menuTrigger) {

		// Navigation
		this.nav = document.getElementsByTagName(nav)[0];
		
		// Nav Menu Trigger
		this.menuTrigger = document.getElementsByClassName(menuTrigger);

		// On Resize Hide or show nav depending on viewport
		$(window).resize(function() {
			if( $(this).width() <= 800 ){
				$(this.nav).show();
			}
		});

		// On click, show or hide the menu
		$('.menu-trigger').on('click', this.menuToggle);
		
		// Menu Toggle
		this.menuToggle = function (event) {

			var $menuBtn = $(this);

			if( $( this.nav ).hasClass('open') ){
				// default menu icon
				$menuBtn.removeClass('open');
				// Transition Fast
				$('main').addClass('transition-fast')
				// remove body translate 3d nav open effect
				$(document.body).removeClass('with-nav-open');
				// remove open class, hide nav
				$( this.nav ).removeClass('open');
			} else {	
				// remove tranaslate fast 
				$('main').removeClass('transition-fast');
				// add open class, show nav
				$( this.nav ).addClass('open');
				// add body translate 3d effect
				$(document.body).addClass('with-nav-open');	
				// default menu icon
				$menuBtn.addClass('open');					
			
			}
		};

	} // End Constructor
};


			
			

