<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");
  } else {

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
          <title>Local Tourist</title>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <?php if($_SESSION['status'] == "active"){ ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>15</h3>

                <p>Total Tour</p>
              </div>
              <div class="icon">
                <i class="ion "></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>5<sup style="font-size: 20px"></sup></h3>

                <p>Total Hiring</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>44</h3>

                <p>Upcoming Tour or Hiring Request</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>65</h3>

                <p>Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>


      <?php  } elseif ($_SESSION['status'] == "reject") {  ?>
        <h3> <marquee> Hello Dear Guide, Your account request is <span style="color: red">Reject</span>. Please update your Profile and Again sent request.</marquee></h3>
        
      <?php } else { ?>
       <h3> <marquee> Hello Dear Guide, Your account request is now <span style="color: red">Pending</span> Position. Please wait for Confirmation</marquee> </h3>
       
       <?php } ?>
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

 <script>
   function previewFile(){
       var preview = document.querySelector('img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file); //reads the data as a URL
       } else {
           preview.src = "";
       }
  }

  previewFile();  //calls the function named previewFile()
  </script>


</body>
</html>

<?php } ?>