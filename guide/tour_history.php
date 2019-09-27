<?php 

session_start();
if (!isset($_SESSION['tour_by_local_guid_id'])) {
  header("location: sign_in.php");
} else {
  include_once('connection.php');  

  $quary = "SELECT tour_id, tour_title, start_date, end_date, budget FROM `tour` WHERE guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and start_date < now() and end_date < now()" ;

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
          <small>History</small>
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

          <!-- ./col -->
          <div class="col-lg-12 col-xs-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Previous Tour History</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-condensed">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Budget</th>
                    <th>Total Participate</th>
                    <th>Rating</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                  <?php 

                  $i = 0;
                  while ($row = mysqli_fetch_array($result)) {  


                    $quary =  "SELECT AVG(traveler_rating) as rating FROM tour_has_traveler WHERE tour_tour_id = ".$row['tour_id']."  and traveler_rating > 0";

                    $_result = mysqli_query($conn, $quary);
                    $total_tour_rating = mysqli_fetch_array($_result);
                    $total_tour_rating[0] = ($total_tour_rating[0] < 1) ? 5 :  $total_tour_rating[0];


                    $quary =  "SELECT SUM(number_of_tourist) as enroll_touriest_no FROM `tour_has_traveler` where tour_tour_id = ".$row['tour_id'] . " and tour_request_status = 'accept'";
                    $_result = mysqli_query($conn, $quary);
                    $total_visite_turiest = mysqli_fetch_array($_result);
                    $total_visite_turiest[0] = ($total_visite_turiest[0] < 1) ? 0 :  $total_visite_turiest[0];

                    // ech


                    ?>

                    <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo $row['tour_title']; ?></td>
                      <td><?php echo $row['start_date']; ?></td>
                      <td><?php echo $row['end_date']; ?></td>
                      <td><?php echo $row['budget']; ?> </td>
                      <td><?php echo $total_visite_turiest[0] ?> </td>
                      <td> <span class="badge bg-red"><?php echo number_format((float) $total_tour_rating[0], 2, '.', ''); ?></span></td>
                      <td> <a href="view_tour_history.php?id=<?php echo $row['tour_id']; ?>"> <button type="button" class="btn btn-block btn-success btn-sm">View</button></td>
                      </tr>

                    <?php   }  ?>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>

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


</body>
</html>

<?php } ?>
