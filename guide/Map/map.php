<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
	<link href="styles.min.css" rel="stylesheet">
	<title>Google Maps: Latitude-Longitude Finder Tool</title>
	<!-- <style>
		#map-search { position: absolute; top: 10px; left: 10px; right: 10px; }
		#search-txt { float: left; width: 60%; }
		#search-btn { float: left; width: 19%; }
		#detect-btn { float: right; width: 19%; }
		#map-canvas { position: absolute; top: 40px; bottom: 65px; left: 10px; right: 10px; }
		#map-output { position: absolute; bottom: 10px; left: 10px; right: 10px; }
		#map-output a { float: right; }
	</style> -->
</head>
<body>

	<div id="map-search">
		<input id="search-txt" type="text" value="Diu Main campus" maxlength="100">
		<input id="search-btn" type="button" value="Locate Address">

		<form>

			<input type="submit" name="">
		</form>

	</div>
	
	<div id="map-canvas" style="height: 300px; width: 500px"></div>
	<div id="map-output"></div>

	<div style="height: 300px; width:300px" >
		
	</div>
	<script type="text/javascript">
		
		function loadmap() {
			// initialize map
			var map = new google.maps.Map(document.getElementById("map-canvas"), {
				center: new google.maps.LatLng(23.6850, 90.3563),
				zoom: 7,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			// initialize marker
			var marker = new google.maps.Marker({
				position: map.getCenter(),
				draggable: true,
				map: map
			});
			// intercept map and marker movements
			google.maps.event.addListener(map, "idle", function() {
				marker.setPosition(map.getCenter());
				document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>Go to maps.google.com</a>";

				setLatLong(map.getCenter().lat().toFixed(6) ,  map.getCenter().lng().toFixed(6));
			});
			google.maps.event.addListener(marker, "dragend", function(mapEvent) {
				map.panTo(mapEvent.latLng);
			});
			// initialize geocoder
			var geocoder = new google.maps.Geocoder();
			google.maps.event.addDomListener(document.getElementById("search-btn"), "click", function() {
				geocoder.geocode({ address: document.getElementById("search-txt").value }, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						var result = results[0];
						document.getElementById("search-txt").value = result.formatted_address;
						if (result.geometry.viewport) {
							map.fitBounds(result.geometry.viewport);
						} else {
							map.setCenter(result.geometry.location);
						}
					} else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
						alert("Sorry, geocoder API failed to locate the address.");
					} else {
						alert("Sorry, geocoder API failed with an error.");
					}
				});
			});
			google.maps.event.addDomListener(document.getElementById("search-txt"), "keydown", function(domEvent) {
				if (domEvent.which === 13 || domEvent.keyCode === 13) {
					google.maps.event.trigger(document.getElementById("search-btn"), "click");
				}
			});
			// initialize geolocation
			if (navigator.geolocation) {
				google.maps.event.addDomListener(document.getElementById("detect-btn"), "click", function() {
					navigator.geolocation.getCurrentPosition(function(position) {
						map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
					}, function() {
						alert("Sorry, geolocation API failed to detect your location.");
					});
				});
				document.getElementById("detect-btn").disabled = false;
			}
		}

		function setLatLong(lat, lng){
			document.getElementById("lat").innerHTML = lat;
			document.getElementById("lng").innerHTML = lng;
		}
	</script>


	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4TSJ3TNXAQdNR49PWUgLtjQMuJYiZKtU&callback=loadmap" type="text/javascript"></script>

	<style>
		#map-search { position: absolute; top: 10px; left: 10px; right: 10px; }
		#search-txt { float: left; width: 60%; }
		#search-btn { float: left; width: 19%; }
		#detect-btn { float: right; width: 19%; }
		#map-canvas { position: absolute; top: 40px; bottom: 65px; left: 10px; right: 10px; }
		#map-output { position: absolute; bottom: 10px; left: 10px; right: 10px; }
		#map-output a { float: right; }
	</style>

</body>
</html>
