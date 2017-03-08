<!DOCTYPE html>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ" 
          type="text/javascript"></script>
</head> 
<body>
  <div id="map" style="width: 600px; height: 500px;"></div>

  <script type="text/javascript">
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
  </script>
</body>
</html>