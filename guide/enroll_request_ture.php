<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");
  } else {




include_once('connection.php');  

$quary = "SELECT tour_id, tour_title, start_date, end_date, budget FROM `tour` WHERE guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and start_date > now()" ;

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
          <small>Request List</small>
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

          while ($row = mysqli_fetch_array($result)) { 

            $quary =  "SELECT SUM(number_of_tourist) as enroll_touriest_no FROM `tour_has_traveler` where tour_tour_id = ".$row['tour_id'] . " and tour_request_status = 'pending'";
            $_result = mysqli_query($conn, $quary);
            $total_enroll_turiest = mysqli_fetch_array($_result);

            $total_enroll_turiest[0] = ($total_enroll_turiest[0] < 1) ? 0 :  $total_enroll_turiest[0];
            ?>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3 style="padding-top: 6px"><?php echo $total_enroll_turiest[0]; ?></h3>

                  <h5 style="padding-top: 20px"><?php echo $row['tour_title']; ?></h5>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="enroll_tourist_list.php?id=<?php echo $row['tour_id']; ?>" class="small-box-footer">See tourist list <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

          <?php } ?>
          
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