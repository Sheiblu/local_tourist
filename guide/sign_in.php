<?php
    // define variables and set to empty values
session_start();

if (isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: index.php");
} else {


$email = $password = "";
$id = 0;
$message = "";


require_once('connection.php');  



if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // $email = test_input($_POST["email"]);
  // $password = test_input($_POST["password"]);

  $email = ($_POST["email"]);
  $password = ($_POST["password"]);

  $sql = "SELECT * FROM guide  where email = '$email' and password = '$password'";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_array($result)) {
    $id = $row['guide_id'];
    $name = $row['first_name']." ".$row['last_name'];
    $email = $row['email'];
    $status = $row['account_status'];
    $image = $row['image'];
    break;
  }

  if (mysqli_num_rows($result) == 1){
     $_SESSION['tour_by_local_guid_id'] = $id ;
     $_SESSION['tour_by_local_guid_name'] = $name;
     $_SESSION['status'] = $status;
     $_SESSION['image'] = $image;
     header("Location: index.php");
  } else {
     $message = "Login Fail ";
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
<html>
<head>
  <?php  include_once('sub_tem/head.php');  ?>
</head>
<body class="hold-transition login-page" style="background-image: url('image/ture/DSC_2581.JPG');">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Local Tourist</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Local Tourist</p>

      <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-" style="text-align: center;">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      
    </div>
    <!-- /.social-auth-links -->

   <!--  <a href="#">I forgot my password</a><br>-->
    <a href="register.php" class="text-center">Register a new membership</a> 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>

<?php } ?>
