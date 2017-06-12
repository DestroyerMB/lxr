<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>Google Maps Multiple Markers</title>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ"
          type="text/javascript"></script>
</head>
<body>

  <button type="button" name="button" onclick="showMapLocation(49.609660, 6.404947)">Show Location</button>
  <br><br>
  <div id="map" style="width: 600px; height: 500px;"></div>

  <script type="text/javascript">

  function showMapLocation(lont,long) { //49.609660, 6.404947
    var locations = [
      [1, 'Apartments in Wormeldange', lont, long , false, '2 rooms<br>1 floor']
    ];

    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: new google.maps.LatLng(lont, long),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
        map: map
      });

      google.maps.event.addListener(map, 'idle', function() {
        showViewport();
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
		  /*if(selected)
		  	marker.setAnimation(google.maps.Animation.BOUNCE);
		  else marker.setAnimation(null);*/
        }
      })(marker, i));
    }
  }

  function showViewport() {
    var lat0 = map.getBounds().getNorthEast().lat();
    var lng0 = map.getBounds().getNorthEast().lng();
    var lat1 = map.getBounds().getSouthWest().lat();
    var lng1 = map.getBounds().getSouthWest().lng();
    ;;console.log(lat0+', '+lng0+'  '+lat1+', '+lng1);
  }



  </script>
</body>
</html>
