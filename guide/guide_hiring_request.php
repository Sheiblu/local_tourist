<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");
  } else if($_SESSION['status'] != "active"){ 
    header("Location: index.php");
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

// $quary = "SELECT * FROM hire_guide join traveler ON traveler.traveler_Id = hire_guide.traveler_traveler_Id where guide_guide_id = 2 and status = 'pending' " ;
  $quary = "SELECT * FROM `hire_guide` where guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and status = 'pending'" ;
  $result = mysqli_query($conn, $quary);
          
?>

    <?php  include_once('sub_tem/header.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Guide Request Panel</small>
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


          <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
              
                <div class="pull-right">
                  
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                 <?php 

                if (mysqli_num_rows($result) < 1 ) { ?>

                 <h2 style="margin-left: 10px">You Have No hiring Event</h2>

               <?php } else {  ?>

                <table class="table table-hover table-striped">
                  <tbody>
                      
                    <?php 

                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {  ?>

                  <tr>
                    <td><?php echo ++$i ?></td>
                    <td class="mailbox-name">  <?php echo " "; ?></td>
                     <td class="mailbox-subject"><a href="guide_hiring_request_details.php?id=<?php echo $row['hire_guide_id']; ?>"><?php echo "hant to hiring From ( ".  $row['end_date'] . "  --  ". $row['start_date']. ")"?></a></td>
                    <td class="mailbox-attachment"><?php echo $row['budget'] ." tk" ?></td>
                    <td class="mailbox-date"><?php echo $row['request_date']; ?></td>
                  </tr>

                  <?php   }  ?>
                   
                  </tbody>
                </table>

              <?php   }  ?>
          
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
           
            </div>
          </div>
          <!-- /. box -->
        </div>
     
  
    
        </div>
      </section>

      <!-- right col -->
    </div>
  </div>


  <!-- -- footer Start here -->
  <?php  include_once('sub_tem/footer.php');  ?>


  <!-- Sitting will add here -->
  <?php  //include_once('sub_tem/setting.php');  ?>
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