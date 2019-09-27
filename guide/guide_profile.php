
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

    $quary = "SELECT * FROM `guide` WHERE guide_id = " . $_SESSION['tour_by_local_guid_id'] ;

    $result = mysqli_query($conn, $quary);

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
          Profile
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
                <img class="profile-user-img img-responsive img-circle" src="image/guide/<?php echo $row['image']; ?>" alt="User profile picture">

                <h3 class="profile-username text-center"><?php echo $row['first_name'] ." ". $row['last_name']?></h3>

                <p class="text-muted text-center"><?php echo $row['email']; ?></p>


                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.box-body -->
            </div>
            <a href="update_profile.php"> Edit Profile</a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-change-image" onclick="f()">
                Preview
            </button>
          </div>



          <div class="col-md-9"> 

           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Guide</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Age</strong>

              <p class="text-muted">
                <?php echo $row['age']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Birthday </strong>
              <p class="text-muted"><?php echo $row['birth_date']; ?></p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Country</strong>
              <p class="text-muted"><?php echo $row['country']; ?></p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> District </strong>
              <p class="text-muted"><?php echo $row['district']; ?></p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Phone Number </strong>
              <p class="text-muted"><?php echo $row['phone_number']; ?></p>
              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Permanent Addrerss</strong>
              <p class="text-muted"><?php echo $row['parmanent_address']; ?></p>


            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

      <div class="row"> 
        <div class="col-md-12" > 
         <div class="box box-primary">

          <input type="file" onchange="previewFile()"><br>
          <img src="" height="200" alt="Image preview...">


         </div>
       </div>

     </section>
     <?php break;  }  ?>
     <!-- right col -->
   </div>
 </div>


 <div class="modal fade" id="modal-change-image">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Image</h4>
              </div>

                <form method="POST">
              <div class="modal-body">

                 <div class="form-group">
                   <label for="form_image">Image</label>
                   <input type="file" name="image" id="form_image" onchange="previewFile()">
                   <img src="" height="200" alt="">
                 </div>
                 
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Save</button>
           <!--      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
              </div>

            </form>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
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
