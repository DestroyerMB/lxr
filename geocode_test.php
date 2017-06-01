<html>
<head>
<title>Google Maps API v3 Example : Geocoding Simple</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ"></script>
<script type="text/javascript">
</script>
</head>
<body onload="initialize()">
<div align="center" style="height: 30px; width: 530px">
<input id="address" type="textbox">
<input type="button" value="Geocode" onclick="codeAddress()">
</div>
<div id="map" style="height:200px; width: 530px"></div>
<div id="coords">Coords</div>

<script type="text/javascript">
var geocoder;
var map;
function initialize()
{
  geocoder = new google.maps.Geocoder();
  map = new google.maps.Map(document.getElementById("map"),
  {
      zoom: 8,
      center: new google.maps.LatLng(22.7964,79.5410),
      mapTypeId: google.maps.MapTypeId.ROADMAP
  });
}

function codeAddress()
{
  var address = document.getElementById("address").value;
  geocoder.geocode( { 'address': address}, function(results, status)
  {
      if (status == google.maps.GeocoderStatus.OK)
      {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker(
          {
              map: map,
              position: results[0].geometry.location
          });
          document.getElementById("coords").innerHTML = "lat: " + results[0].geometry.location.lat() +
              ", lng: " + results[0].geometry.location.lng();
      }
      else
      {
          alert("Geocode was not successful for the following reason: " + status);
      }
  });
}
</script>
</body>
</html>
