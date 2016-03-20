// Sticky Headers
export default class {

	constructor(header, fixedClass) {
		
		// Header
		this.header = document.getElementById(header);

		// Fixed Class
		this.fixedClass = fixedClass;

		// Window Y Offset Trigger
		this.offset = typeof offset !== 'number' ? parseInt(this.offset) : this.offset;

		// On Scroll
		this.onScroll = function() {

			// Scroll Top
	        var scrollTop = window.scrollY;
	        
	        // Header Scroll
	        if(scrollTop <= 115){
	            this.header.classList.remove('top');
	        } else if (scrollTop => 115) {
	            this.header.classList.add('top');
	        };
		};

		// On Scroll
		window.addEventListener('scroll', this.onScroll);		

	} // End Constructor
};
