var $ = require('jquery');

export default class {

	constructor(nav, menuTrigger) {
		
		this.nav = document.getElementsByTagName(nav)[0];
		this.menuTrigger = document.getElementsByClassName(menuTrigger);

		// Init 
		this.init = function () {
			console.log('init nav');
			$(window).resize(function() {
				if( $(this).width() <= 800 ){
					$(this.nav).show();
				}
			});
			
			$('.menu-trigger').on('click', this.menuToggle);
		
		};
		
		// Menu Toggle
		this.menuToggle = function (event) {
			console.log('menu toggle');
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


			
			

