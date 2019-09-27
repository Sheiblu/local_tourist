<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_admin_id'])) {
    header("location: login.php");
  } else {

 ?>

<!DOCTYPE html>
<html>

  <?php 

  include_once('sub_tem/head.php');  

  include_once('connection.php');  

  $quary = "SELECT * FROM `guide` WHERE  account_status = 'inactive' or account_status = 'resubmit'" ;
  $result = mysqli_query($conn, $quary);

  ?>

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
          <small>New Guide</small>
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
                <h3 class="box-title">New Guide request List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-condensed">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="width: 40px">Action</th>
                  </tr>

                  <?php 

                  $i = 1;
                  while ($row = mysqli_fetch_array($result)) {   ?>

                  <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo $row['first_name'] ?></td>
                    <td><?php echo $row['country'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['phone_number'] ?></td>
                    <td><a href="guid_account_request_details.php?id=<?php echo $row['guide_id'] ?>"> <button type="button" class="btn btn-success"><i class="fa "></i> View Profile</button></a></td>
                  </tr>
                <?php   }  ?>
                </table>
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
