<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");

  } else if($_SESSION['status'] != "active"){ 
    header("Location: index.php");
  } else {


include_once('connection.php');  

$quary = "SELECT tour_id, tour_title, start_date, end_date, budget FROM `tour` WHERE guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and start_date <= CURDATE() + INTERVAL 7 DAY and start_date > CURDATE() " ;


$result = mysqli_query($conn, $quary);

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
          <small>Upcoming Tour</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <?php 

              $i = 0;
              while ($row = mysqli_fetch_array($result)) { 
                  $quary =  "SELECT SUM(number_of_tourist) as enroll_touriest_no FROM `tour_has_traveler` where tour_tour_id = ".$row['tour_id']." and tour_request_status = 'accept'";
                  $_result = mysqli_query($conn, $quary);
                  $total_enroll_turiest = mysqli_fetch_array($_result);

                  $total_enroll_turiest[0] = ($total_enroll_turiest[0] < 1) ? 0 :  $total_enroll_turiest[0];
           ?>
         
          <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-yellow">
               <!--  <div class="widget-user-image">
                  <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="Tour Pic">
                </div> -->
                <!-- /.widget-user-image -->
                <h4 class="widget-user" style="text-align: center;"><?php echo $row['tour_title']; ?></h4>
                <h5 class="widget-user-desc"></h5>  <!-- Chittagong -->
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a href="#">Start Date<span class="pull-right badge bg-blue"><?php echo $row['start_date']; ?></span></a></li>
                  <li><a href="#">End Date <span class="pull-right badge bg-red"><?php echo $row['end_date']; ?></span></a></li>
                  <li><a href="#">Budget <span class="pull-right badge bg-green"><?php echo $row['budget']; ?></span></a></li>
                  <li><a href="#">Enroll People <span class="pull-right badge bg-aqua"><?php echo $total_enroll_turiest[0]; ?></span></a></li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>


          <?php   }  ?>
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


</body>
</html>

<?php } ?>
