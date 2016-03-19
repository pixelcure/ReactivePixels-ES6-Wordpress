// Jquery
import $ from 'jquery';
// Google Maps
import GoogleMapsLoader from 'google-maps';

// Google Maps API Key
GoogleMapsLoader.KEY = 'AIzaSyDe5DYJZUSe9nw6NjyrYnxMAD3rH4khQY4';
// Language
GoogleMapsLoader.LANGUAGE = 'en';
// Region
GoogleMapsLoader.REGION = 'US'

		
var OfficeMap = GoogleMapsLoader.load(function(google){

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
});



export { OfficeMap }