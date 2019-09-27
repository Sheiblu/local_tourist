<?php
  session_start();
 if (!isset($_SESSION['tour_by_local_admin_id'])) {
    header("location: login.php");
  } else {

$email = $password = "";
$id = 0;


require_once('connection.php');  


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id = test_input($_POST["id"]);
  $action = test_input($_POST["action"]);

  if(strcmp($action,"accept") == 0 ){
    $sql = "update guide set account_status = 'active' where guide_id = '$id' and account_status = 'inactive' or  account_status = 'resubmit';";
  } else if(strcmp($action,"reject") == 0){
    $sql = "update guide set account_status = 'reject' where guide_id = '$id' and account_status = 'inactive' or  account_status = 'resubmit' ;";
  } else {
    $sql = "update guide set account_status = 'active' where guide_id = 0";
  }


  if ($conn->query($sql) === false) {
    header("Location: guid_account_request_details.php?id='$id'&error=$a");
  } else {
    header("Location: guid_account_request.php");
  }
}

$message = "";

if($_GET){
  if(isset($_GET['error']) && $_GET['error'] == true){
    $message = "Something wrong <br> <br> <br>";
  } 
  $id = $_GET['id'];
} else {
 $id = 0;
}

if($id == null or !is_numeric($id)){
  $id=0;
}

$quary = "SELECT * FROM `guide` WHERE  account_status = 'inactive' or  account_status = 'resubmit' and guide_id = ".$id ;
$result = mysqli_query($conn, $quary);



?>



<!DOCTYPE html>
<html>

<?php  require_once('sub_tem/head.php');  ?>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <!---  header --> 

    <?php  require_once('sub_tem/header.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  require_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard 
          <small>Request Guid Profile</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <h1> <?php  echo $message ?></h1>

      <!-- Main content -->

      <?php 

      while ($row = mysqli_fetch_array($result)) {  

        ?>



        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive" src="dist/img/user1-128x128.jpg" alt="User profile picture">

                  <h3 class="profile-username text-center"><?php echo $row['first_name'].' '.$row['last_name'] ?></h3>

                </div>
                <!-- /.box-body -->
              </div>

              <div class="col-md-6"> 

                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="id" value="<?php echo $row['guide_id']?>">
                  <input type="hidden" name="action" value="accept">
                  <input type="submit" class="btn btn-success" value="accept" >
                </form>

              </div>

              <div class="col-md-6"> 
                <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <input type="hidden" name="id" value="<?php echo $row['guide_id']?>">
                  <input type="hidden"  name="action" value="reject">
                  <input type="submit" class="btn btn-danger" value="reject" >
                </form>
              </div>




            </div>

            <div class="col-md-9"> 

             <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                

                <strong><i class="fa fa-map-marker margin-r-5"></i> Age</strong>

                <p class="text-muted"><?php echo $row['age'] ?></p>

                <hr>


                <strong><i class="fa fa-map-marker margin-r-5"></i> Country</strong>
                <p class="text-muted"><?php echo $row['country'] ?></p>
                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>
                <p class="text-muted"><?php echo $row['email'] ?></p>
                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Phone</strong>
                <p class="text-muted"><?php echo $row['phone_number'] ?></p>
                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                <p class="text-muted"><?php echo $row['parmanent_address'] ?></p>
                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Skype</strong>
                <p class="text-muted"><?php echo $row['skype_name'] ?></p>
                <hr>

              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>

      </section>

    <?php   }  ?>

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