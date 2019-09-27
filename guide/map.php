<?php 

session_start();
if (!isset($_SESSION['tour_by_local_guid_id'])) {
  header("location: sign_in.php");
} else {
  $message = "";
include_once('control/setTourMeetPoint.php'); 
 ?>

 
 <!DOCTYPE html>
 <html>
 <head>
  <?php  include_once('sub_tem/head.php');  ?>
 </head>
 <body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <!---  header --> 

    <?php  include_once('sub_tem/header.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Set search Point</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">


          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <div id="map-search">
                <input id="search-txt" type="text" value="Diu Main campus" maxlength="100">
                <input id="search-btn" type="button" value="Locate Address">

                

              </div>
            </div>

            <div class="box-body">
              <h1> Lat: <span id="lat"></span></h1>
              <h1> Lng: <span id="lng"></span></h1>
              <h3><?php echo $message; ?></h3>

              <form method="post" action="map.php?id=<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="tourId" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="lat" id="latvalu">
                  <input type="hidden" name="lng" id="lngvalu">
                  <input type="submit" name="map_link" value="Save The Point">
              </form>

           </div>
         </div>
       </section>


       <section class="footer">
        <div class="row">
          <div class="box box-warning">
            <div class="box-body">

              <div id="map-canvas" style="height: 600px;"></div>
              <div id="map-output"></div>

            </div>
          </div>
        </section>

        <!-- right col -->
      </div>
    </div>


    <!-- -- footer Start here -->
    <?php  include_once('sub_tem/footer.php');  ?>


    <!-- Sitting will add here -->
    <?php  include_once('sub_tem/setting.php');  ?>
    <!-- /.control-sidebar -->

  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <?php  include_once('js_script_link/default.php');  ?>


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
        // document.getElementById("map-output").innerHTML = "Latitude:  " + map.getCenter().lat().toFixed(6) + "<br>Longitude: " + map.getCenter().lng().toFixed(6) + "<a href='https://www.google.com/maps?q=" + encodeURIComponent(map.getCenter().toUrlValue()) + "' target='_blank'>Go to maps.google.com</a>";

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

      document.getElementById("latvalu").value = lat;
      document.getElementById("lngvalu").value = lng;

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

<?php } ?>