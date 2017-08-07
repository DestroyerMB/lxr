//import gmap from './gmap.js';

//require('http://maps.google.com/maps/api/js?key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ');
//var events = require('./events.js');
//import $ from 'jquery';

//alert('z');
import GoogleMapsLoader from 'google-maps';
;;console.log('2', GoogleMapsLoader);

GoogleMapsLoader.KEY = 'AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ';
GoogleMapsLoader.load(function(google) {

    //new google.maps.Map(el, options);

    var locations = [
      [1, 'Apartments in Wormeldange', 49.609660, 6.404947, false, '2 rooms<br>1 floor'],
	  [2, 'Room in Garer Quarter', 49.601546, 6.128540, false, '13m2<br>available from June'],
	  [3, 'Apartments in Kirchberg', 49.625571, 6.148109, false, 'with 2 bedrooms and garage'],
	  [4, 'House in Senningen', 49.648917, 6.241149, false, '2 floors<br>2 bedrooms<br>parking lots inside'],
	  [5, 'Room in Trier', 49.739971, 6.644210, false, '11m2<br>available from May 15th']
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(49.604689, 6.133518),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
        map: map
      });

	  google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
			infowindow.setContent('<h3>'+locations[i][1]+'</h3>'+locations[i][5]);
			infowindow.open(map, this);
        }
      })(marker, i));

	  // assuming you also want to hide the infowindow when user mouses-out
	  google.maps.event.addListener(marker, 'mouseout', function() {
      	infowindow.close();
	  });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
		  var selected = !locations[i][4];
		  locations[i][4] = selected;
		  if(selected)
		  	marker.setAnimation(google.maps.Animation.BOUNCE);
		  else marker.setAnimation(null);
        }
      })(marker, i));
    }
});

;;console.log('2');

//;;console.log(gmap.showMapLocation);
;;console.log('zzzmainz!!!');

//onclick="showMapLocation(49.609660, 6.404947)"



/*var id = events.gId('test');
console.log(id);*/

// Get the modal
/*var $modal = $('#myModal');

// Get the button that opens the modal
var $btn = $("#myBtn");

// Get the <span> element that closes the modal
var $span = $(".close:eq(0)");

console.log($btn);

// When the user clicks the button, open the modal
$btn.on('click', function() {
    console.log(86868);
    $modal.show();
});

// When the user clicks on <span> (x), close the modal
$span.on('click', function() {
    $modal.hide();
});

// When the user clicks anywhere outside of the modal, close it
$(window).on('click', function(event) {
    if (event.target == $modal.get(0)) {
        $modal.hide();
    }
});
*/
