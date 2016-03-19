// Class / Prototype for Parallax Feature
// Pass in className of items that should be parallax

class Parallax {
	// Constructor
	constructor (elClassName) {
		// Is Watching Boolean, toggles whether to init after setup
		this.isWatching = false,

		// Elements to Parallax, default is parallax
		this.className = typeof className === 'string' && className !== 'undefined' ? elClassName : 'parallax';

	    /**
        Get the height of the passed element's background image.
        @param {element} element - An element.
        @returns {int} The height of the background.
        */
	    this.getBackgroundHeight = function (element){
	        return 600;
	    };

	    /**
        Parallax scroll the passed element's background relative to the element.
        @param {element} element - An element.
	    */
	    this.parallaxScrollElement = function (element){
	        	// Window Inner Height
	        var hV = window.innerHeight,
	        	// El Height
	        	hE = element.clientHeight,
	        	// Image Background Height
	        	hB = this.getBackgroundHeight(element),
	        	// Scroll Y Offset, Relative to Document
	        	yV = window.pageYOffset,
	        	// Element Offset From top of page, Relative to viewport
	        	yE = element.getBoundingClientRect().top,
	        	// ((Background Height - Element Height) * Element Offset) / (ElementHeight - Window Height)
	        	yB = ((hB-hE)*yE)/(hE-hV); //Relative to element.
	        
	        // Change Element Background Position
	        element.style.backgroundPositionY=yB+"px";
	    };
	    
	    /**
        Parallax scroll all elements with CSS class 'parallax'. This function
        should be called onScroll.
	    */
	    this.parallaxScroll = function (){
	    	var that = this;
	        var parallaxScrollElements=document.getElementsByClassName(this.className);
	        for(let i=0;i<parallaxScrollElements.length;i++)
	            that.parallaxScrollElement(parallaxScrollElements[i]);
	    };
	    
	    /**
        Init all event methods, looking for scroll and resize of window
	    */
	    var that = this;
	    
	    // On Window Scroll
	    window.onscroll = function (){
	        that.parallaxScroll();
	    }
	    
	    // On Window Resize
	    window.onresize = function (){
	        that.parallaxScroll();
	    }	
	} // End Constructor
	
}; // End Parallax


// Export as Parallax
export { Parallax }