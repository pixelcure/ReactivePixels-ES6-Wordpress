// jQuery Instance
var $ = require('jquery');
// React Instance
var React = require('react');

// Google Maps
var GoogleMapsLoader = require('google-maps');
    GoogleMapsLoader.KEY = 'AIzaSyDe5DYJZUSe9nw6NjyrYnxMAD3rH4khQY4';

// Scroll Experience
import HomeExperience from './homeExperience/homeExperience.main';
// Nav Functionality
import Nav from './responsiveNav/responsiveNav.main';
// Video Player
import VideoPlayer from './videoPlayer/videoPlayer.main';

console.log(GoogleMapsLoader);

GoogleMapsLoader.load(function(google) {

    var map = new google.maps.Map(document.getElementById('homeMap'), {
          center: {lat: 42.348714, lng: -71.072282},
          zoom: 19
        });

    var marker = new google.maps.Marker({
        position : {
            lat: 42.348714, 
            lng: -71.072282
        },
        map: map,
        title: document.getElementById('homeMap').dataset.markertitle,
        icon: document.getElementById('homeMap').dataset.markericon
    });

    map.set('styles', [
    {
        "featureType": "all",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#000000"
            },
            {
                "lightness": 13
            }
        ]
    },
    {
        featureType: "poi",
            stylers: [
                { visibility: "off" }
            ]
    },
    {
        featureType: "poi.business",
            stylers: [
                { visibility: "off" }
            ]
    },    
    {
        "featureType": "administrative",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#144b53"
            },
            {
                "lightness": 14
            },
            {
                "weight": 1.4
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "color": "#08304b"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#0c4152"
            },
            {
                "lightness": 5
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#0b434f"
            },
            {
                "lightness": 25
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#0b3d51"
            },
            {
                "lightness": 16
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#000000"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "color": "#146474"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#021019"
            }
        ]
    }
]);

    console.log(map)
});

// Document Ready
$(function(){
    

    /**
        Get the height of the passed element's background image.
        @param {element} element - An element.
        @returns {int} The height of the background.
    ***************************************************************************/
    function getBackgroundHeight(element){
        return 600;
    }

    /**
        Parallax scroll the passed element's background relative to the element.
        @param {element} element - An element.
    ***************************************************************************/
    function parallaxScrollElement(element){
        var hV=window.innerHeight;
        var hE=element.clientHeight;
        var hB=getBackgroundHeight(element);
        var yV=window.pageYOffset; //Relative to document.
        var yE=element.getBoundingClientRect().top; //Relative to view-port.
        var yB=((hB-hE)*yE)/(hE-hV); //Relative to element.
        element.style.backgroundPositionY=yB+"px";
    }
    
    /**
        Parallax scroll all elements with CSS class 'parallax'. This function
        should be called onScroll.
    ***************************************************************************/
    function parallaxScroll(){
        var parallaxScrollElements=document.getElementsByClassName("parallax");
        for(var i=0;i<parallaxScrollElements.length;i++)
            parallaxScrollElement(parallaxScrollElements[i]);
    };
    
    window.onscroll=function(){
        parallaxScroll();
    }
    
    window.onresize=function(){
        parallaxScroll();
    }


    // Scroll Experience
    var homeExperience = new HomeExperience('header').init();

    // Navigation
    var nav = new Nav('nav', 'menu-trigger').init();

    // Video Player
    var videoPlayer = new VideoPlayer('heroVideo', 'volumeControl','videoControl').init();

});