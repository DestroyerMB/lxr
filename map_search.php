<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=drawing&key=AIzaSyBOcOOHnZXo1mFVAmeyg2CFX1gjQ7UtjVQ"></script>

    <style type="text/css">
      html, body, #map-canvas {
      height: 95%;
      margin: 0px;
      padding: 0px
    }
    </style>

  </head>
  <body>
    <div id="map-canvas"></div>
    <form method="post" accept-charset="utf-8" id="map_form">
      <input type="text" name="vertices" value="" id="vertices" />
      <input type="button" name="save" value="Save!" id="save" />
    </form>

    <script type="text/javascript">
    var map; // Global declaration of the map
var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
var lat_longs = new Array();
var markers = new Array();
var drawingManager;

function initialize() {
  var myLatlng = new google.maps.LatLng(49.689960, 6.404947);
  var myOptions = {
      zoom: 9,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
  drawingManager = new google.maps.drawing.DrawingManager({
      drawingMode: google.maps.drawing.OverlayType.POLYGON,
      drawingControl: true,
      drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: [google.maps.drawing.OverlayType.POLYGON]
      },
      polygonOptions: {
          editable: true
      }
  });
  drawingManager.setMap(map);

  google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
      var newShape = event.overlay;
      newShape.type = event.type;
  });

  google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
      overlayClickListener(event.overlay);
      var points = event.overlay.getPath().getArray()
      for (var i = 0; i < points.length; i++) {
        ;;console.log(points[i].lat(),points[i].lng());
      }
      //$('#vertices').val(event.overlay.getPath().getArray());
  });
}

function overlayClickListener(overlay) {
  google.maps.event.addListener(overlay, "mouseup", function (event) {
    //;;console.log(event.overlay.getPath().getArray());
      //$('#vertices').val(overlay.getPath().getArray());
  });
}
initialize();


    </script>

  </body>
</html>
