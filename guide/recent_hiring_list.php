<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");
  } else {

include_once('connection.php');  
 $quary = "SELECT tour_id, tour_title, start_date, end_date, budget FROM `tour` WHERE guide_guide_id = ".$_SESSION['tour_by_local_guid_id'] ." and start_date > now()" ;

 $quary = "SELECT * FROM `hire_guide` where guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and status = 'accept' and start_date > now()" ;


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
          <title id="pageTitle">Local Tourist</title>  
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
                <h3 class="box-title">Recent Hiring List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <?php 

                if (mysqli_num_rows($result) < 1 ) { ?>

                 <h2 style="margin-left: 10px">You Have No hiring Event</h2>

               <?php } else {  ?>

                <table class="table table-condensed">
                  <tr>
                    <th style="width: 30px">#</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Number of Tourist</th>
                    <th>Budget</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                   <?php 

                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {  ?>

                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                    <td><?php echo $row['number_of_tourist']; ?></td>
                    <td><?php echo $row['budget']; ?> </td>
                    <td> <a href="guide_hiring_details.php?id=<?php echo $row['hire_guide_id']; ?>"> <button type="button" class="btn btn-block btn-success btn-sm">View</button></td>
                  </tr>

                   <?php   }  ?>
                  
                </table>

                 <?php   }  ?>
              </div>
              <!-- /.box-body -->
            </div>
            
          </div>
          <!-- ./col -->


          <!-- ./col -->
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
