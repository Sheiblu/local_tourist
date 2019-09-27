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

  if(strcmp($action,"accept") == 0 ){
    $sql = "update hire_guide set status = 'accept' where hire_guide_id = '$id' and status = 'pending';";
  } else if(strcmp($action,"reject") == 0){
    $sql = "update hire_guide set status = 'reject' where hire_guide_id = '$id' and status = 'pending';";
  } else {
    $sql = "update hire_guide set status = 'accept' where hire_guide_id = 0";
  }

  if ($conn->query($sql) === false) {
    header("Location: guide_hiring_request_details.php?id='$id'");
  } else {
    header("Location: guide_hiring_request.php");
  }
} else {

  $quary = "SELECT * FROM hire_guide join traveler ON traveler.traveler_Id = hire_guide.traveler_traveler_Id where hire_guide_id = ". $_GET['id'] ." and guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and status = 'pending'" ;

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

    <?php  
    include_once('sub_tem/header.php');  
    include_once('sub_tem/left_side_menu.php');
    ?>

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <?php 

      while ($row = mysqli_fetch_array($result)) { 

        ?>
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">

           <!-- /.col -->
           <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Hiring Request</h3>

                <div class="box-tools pull-right">

                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-info">
                  <h3>From: <?php echo $row['first_name'] ." ". $row['last_name']?>
                  <span class="mailbox-read-time pull-right"> <?php echo $row['request_date'] ?></span></h3>
                </div>
                <!-- /.mailbox-read-info -->

                <br>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">  
                 <h2> Message: </h2> 
                 <h4><?php echo $row['hire_details'] ?></h4>
               </div>
               <!-- /.mailbox-read-message -->
             </div>

             <hr>

             <div class="box-body no-padding">
               <div class="mailbox-read-info">
                <h2> <b><u>  Another Info </u></b></h2>
                <h4><b>Start Date:</b> <?php echo $row['start_date'] ?></h4>
                <h4><b>End Date:</b> <?php echo $row['end_date'] ?></h4>
                <h4><b>Number Of People:</b> <?php echo $row['number_of_tourist'] ?></h4>
                <h4><b>Budget (not fixed):</b> <?php echo $row['budget'] ?></h4>
              </div>
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <!--   <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button> -->

                <?php

                $full_name = $row['first_name'] ." ". $row['last_name'];

                  ?>

              <form class="form-signin" method="POST" action="tourist_profile.php">
                <input type="hidden" name="id" value="<?php echo $row['traveler_traveler_Id']; ?>">
                <input type="submit" class="btn btn-default" style="float: left; margin-left: 10px" value="<?php echo $full_name.' Profile'?>">
              </form>

              </div>

              <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                <input type="hidden" name="action" value="accept">
                <input type="submit" class="btn btn-success" style="float: left;" value="accept" >
              </form>

              <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                <input type="hidden"  name="action" value="reject">
                <input type="submit" class="btn btn-danger" style="float: left; margin-left: 10px" value="reject" >
              </form>

             <!--  <button type="button" class="btn btn-default"><i class="fa fa-trash"></i> Reject </button>
              <button type="button" class="btn btn-default"><i class="fa "></i> Acccept</button> -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->



      </div>
    </section>

    <?php break;  }  ?>

    <!-- right col -->
  </div>
</div>


<!-- -- footer Start here -->
<?php  include_once('sub_tem/footer.php');  ?>


<?php  include_once('sub_tem/setting.php');  ?>

<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<?php  include_once('js_script_link/default.php');  ?>


</body>
</html>

<?php } ?>