<?php

session_start();

if (isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: index.php");
} else {
  include_once('control/register_action.php'); 

?>



<!DOCTYPE html>
<html>
  <head>
   <?php  include_once('sub_tem/head.php');  ?>
 </head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Local Tourist</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new Guide</p>

    <?php echo $massage; ?>

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control"  placeholder="First Name" name="name" value="<?php echo $name ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" name="name" value="<?php echo $email ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" name="name" value="<?php echo $password ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         <!--  <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="register_guide">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="sign_in.php" class="text-center">Login</a>
  </div>
  <!-- /.form-box -->
</div>

 <?php  include_once('js_script_link/default.php');  ?>
</body>
</html>

<?php } ?>
