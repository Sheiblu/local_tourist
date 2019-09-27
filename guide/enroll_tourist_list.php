<?php 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



session_start();
if (!isset($_SESSION['tour_by_local_guid_id'])) {
  header("location: sign_in.php");
} else {


  include_once('connection.php');  

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = test_input($_POST["id"]);
    $action = test_input($_POST["action"]);
    $tour_id = test_input($_POST["tour_id"]);

    if(strcmp($action,"accept") == 0 ){
      $sql = "update tour_has_traveler set tour_request_status = 'accept' where id = '$id' and tour_request_status = 'pending';";
    } else if(strcmp($action,"reject") == 0){
      $sql = "update tour_has_traveler set tour_request_status = 'reject' where id = '$id' and tour_request_status = 'pending';";
    } else {
      $sql = "update guide set account_status = 'active' where guide_id = 0";
    }

    if ($conn->query($sql) === false) {
      header("Location: guid_account_request_details.php?id='$id'&error=$a");
    } else {
      header("Location: enroll_tourist_list.php?id=".$tour_id);
    }
  } else {

    $quary = "SELECT * FROM `traveler` where traveler_Id = any (SELECT traveler_traveler_Id FROM `tour_has_traveler` where tour_tour_id = ".$_GET['id']." and tour_request_status = 'pending' ) ";

    $result = mysqli_query($conn, $quary);
  }


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
          <small>Tour Enroll Request List</small>
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
          if (mysqli_num_rows($result) < 1 ) {  ?>

                 <h2 style="margin-left: 10px">You Have No Enroll Request </h2>

           <?php

            } else {  

          while ($row = mysqli_fetch_array($result)) { 

          // total Seat Enroll request
            $quary =  "SELECT number_of_tourist, id FROM `tour_has_traveler` where tour_tour_id = ".$_GET['id']." and traveler_traveler_Id = ". $row['traveler_Id'];
            $_result = mysqli_query($conn, $quary);
            $total_seat_enroll_request = mysqli_fetch_array($_result);
            $total_seat_enroll_request[0] = ($total_seat_enroll_request[0] < 1) ? 5 :  $total_seat_enroll_request[0];


         // Search Rating
            $quary =  "SELECT AVG(guide_rating) FROM tour_has_traveler WHERE traveler_traveler_Id = ". $row['traveler_Id']. " and guide_rating > 0 ";
            $_result = mysqli_query($conn, $quary);
            $total_traveler_rating = mysqli_fetch_array($_result);
            $total_traveler_rating[0] = ($total_traveler_rating[0] < 1) ? 5 :  $total_traveler_rating[0];


            ?>


            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('dist/img/photo1.png') center center;">
                  <h3 class="widget-user-username"><?php echo $row['first_name'] .' '. $row['last_name']; ?></h3>
                  <h5 class="widget-user-desc"><?php echo $row['country']; ?></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="dist/img/user8-128x128.jpg" alt="User Avatar">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <form class="form-signin" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <input type="hidden" name="id" value="<?php echo $total_seat_enroll_request[1]?>"> 
                          <input type="hidden" name="tour_id" value="<?php echo $_GET['id']?>">
                          <input type="hidden" name="action" value="accept">
                          <input type="submit" class="btn btn-success" value="accept" >
                        </form>

                        <form class="form-signin" style="padding-top: 5px" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <input type="hidden" name="id" value="<?php echo $total_seat_enroll_request[1]?>">
                          <input type="hidden" name="tour_id" value="<?php echo $_GET['id']?>">
                          <input type="hidden"  name="action" value="reject">
                          <input type="submit" class="btn btn-danger" value="reject" >
                        </form>
                      </div>
                    </div>


                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo  $total_seat_enroll_request[0]; ?></h5>
                        <span class="description-text">Seat enroll request</span>
                      </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <!--     <br> -->
                        <h5 class="description-header"><?php echo  number_format((float) $total_traveler_rating[0], 2, '.', '') ?></h5>
                        <span class="description-text">Ratting</span>

                        <form method="post" action="tourist_profile.php">
                          <input type="hidden" name="id" value="<?php echo $row['traveler_Id']; ?>">
                          <input type="submit" class="btn-group-vertical" value="View Profile">
                        </form>

                        
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>

          <?php } } ?>

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