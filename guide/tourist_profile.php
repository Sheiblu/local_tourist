
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
    <?php 
 

    include_once('connection.php');  

    $quary = "SELECT first_name, last_name, email, country, age FROM `traveler` WHERE traveler_Id = ". $_POST['id'] ;
    $result = mysqli_query($conn, $quary);

// count total hire
    // $quary =  "SELECT COUNT(hire_guide_id) as total_tour FROM hire_guide WHERE traveler_traveler_Id = ".$_POST['id']." and status = 'complete' or status = 'accept' and end_date < now()";
    $quary =  "SELECT COUNT(hire_guide_id) as total_tour FROM hire_guide WHERE traveler_traveler_Id = ".$_POST['id']." and  status = 'accept' and end_date < now()";
    $_result = mysqli_query($conn, $quary);
    $total_hiring = mysqli_fetch_array($_result);


// count total tour
    // $quary =  "SELECT COUNT(id) as total_tour FROM tour_has_traveler WHERE traveler_traveler_Id = ".$_POST['id']." and tour_request_status = 'complete' or tour_request_status = 'accept' ";

     $quary =  "SELECT COUNT(id) as total_tour FROM tour_has_traveler WHERE traveler_traveler_Id = ".$_POST['id']." and  tour_request_status = 'accept' ";
    $_result = mysqli_query($conn, $quary);
    $total_tour_attend = mysqli_fetch_array($_result);
    $total_tour_attend[0] = ($total_tour_attend[0] < 1) ? 0 :  $total_tour_attend[0];

// rating

     $quary =  "SELECT AVG(guide_rating) FROM tour_has_traveler WHERE traveler_traveler_Id = ". $_POST['id'] . " and guide_rating > -1 ";
     $_result = mysqli_query($conn, $quary);
     $total_traveler_rating = mysqli_fetch_array($_result);
     $total_traveler_rating[0] = ($total_traveler_rating[0] < 1) ? 5 :  $total_traveler_rating[0];
   

    ?>

    <?php  include_once('sub_tem/header.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
       <?php 

      while ($row = mysqli_fetch_array($result)) { 

        ?>

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Traveler Profile</small>
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

          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
              <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="dist/img/user8-128x128.jpg" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $row['first_name'] ." ". $row['last_name']?></h3>

                <p class="text-muted text-center"><?php echo $row['email']; ?></p>

                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Attend Tour: </b> <a class="pull-right"><?php echo $total_tour_attend[0]; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Booking Guide</b> <a class="pull-right"><?php echo $total_hiring[0]; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Rating</b> <a class="pull-right "> <?php echo  number_format((float) $total_traveler_rating[0], 2, '.', '') ?> </a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-9"> 

           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Traveler</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Age</strong>

              <p class="text-muted">
                <?php echo $row['age']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Country</strong>

              <p class="text-muted"><?php echo $row['country']; ?></p>

            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12" > 
         <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Comment</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <div class="box-header with-border">

         <?php 
            $quary = "SELECT * FROM `tour_has_traveler` where guide_rating > -1 and guide_comment IS NOT NULL and traveler_traveler_Id = " .$_POST['id']; 
            $result = mysqli_query($conn, $quary);
            while ($row = mysqli_fetch_array($result)) { 

              $quary = "SELECT * FROM `guide` where guide_id = (SELECT guide_guide_id FROM `tour` where tour_id = '".$row['tour_tour_id']."')"; 
              $result1 = mysqli_query($conn, $quary);

              $guide_name = "";
              $area = "";

              while ($row1 = mysqli_fetch_array($result1)) { 

                $guide_name = $row1['first_name'] . " ". $row1['last_name']; 
                $email = $row1['email']; 
                $img = "image/guide/".$row1['image'];

              }

          ?> 

             <hr>

              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="<?php echo $img ?>" alt="user image">
                <span class="username">
                  <a href="#"><?php echo $guide_name; ?></a>
                  <a href="#" class="pull-right btn-box-tool"></i></a>
                </span>
                <span class="description" style="size: 5px"> <?php echo $email; ?> </span>
              </div>
              <!-- /.user-block -->
              <p style="margin-left: 60px; margin-top: 5px"> <?php echo $row['guide_comment']; ?></p>
           

          <?php  } ?>
          

           </div>
         </div>

       </div>
     </div>

   </section>
 <?php break;  }  ?>
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
