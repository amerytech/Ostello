<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps</title>
    <!-- <script src="http://maps.google.com/maps/api/js"
            type="text/javascript"></script> -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl1rNofcC6QptwfF32dPb-RGAikHFNETM" ></script>

	<script type="text/javascript">
		function strip_tags(str)
		{
			str = str.toString();
			return str.replace(/<\/?[^>]+>/gi, '');
		}
	</script>




    <script type="text/javascript">
    //<![CDATA[
    var customIcons = {
      restaurant: {
        icon: 'http://amerytech.net/ostello/img/map-icon2.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
	  hotel: {
        icon: 'http://amerytech.net/ostello/img/map-icon2.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://amerytech.net/ostello/img/map-icon2.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };
    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(17.443600, 78.445801),
        zoom: 13,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;
      // Change this depending on the name of your PHP file
      downloadUrl("maps_xml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }
    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function(e) {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
		
		/* GET LATITUDE AND LONGITUDE OF SELECTED LOCATION
		alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng()); */
		
		var lats = e.latLng.lat();
		var lngs = e.latLng.lng();
		
		var address = infoWindow.getContent();
		address = address.replace("<br/>",",");
		var addr = address.split("<br/>");
		
		//window.location.href = "clicked_address.php?lat="+lats+"&lng="+lngs+"&name="+encodeURI(strip_tags(addr[0]))+"&address="+encodeURI(strip_tags(addr[1]));
		
		$.ajax({
			type:"POST",
			url:"clicked_address.php",
			data:{"address":address},
			success:function(response)
			{
				alert("You have selected: "+response);
			}
		});
      });

	  google.maps.event.addListener(marker, 'mouseover', function(e) {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };
      request.open('GET', url, true);
      request.send(null);
    }
    function doNothing() {}
    //]]>
  </script>
  </head>

  <body onLoad="load()">
    <div id="map" style="width: 500px; height: 300px"></div>
  </body>
</html>