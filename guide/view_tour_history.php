<?php 

session_start();
if (!isset($_SESSION['tour_by_local_guid_id'])) {
  header("location: sign_in.php");
} else {
 include_once('control/rating_traveler_tour.php'); 
  ?>

<!DOCTYPE html>
<html>
<head
<?php  include_once('sub_tem/head.php');  ?>
<link rel="stylesheet" href="dist/css/star.css">
</head>
 <body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <!---  header --> 

    <?php  include_once('sub_tem/header.php');  ?>
    <?php  include_once('control/tour_history.php');  ?>
    

    
    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>View Tour History</small>
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
         <?php if($isGetData == true) { ?>

          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Previous Tour</h3>
              <h1><?php echo $message; ?></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ;?>"  enctype="multipart/form-data" role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Title </label>
                  <input type="text" class="form-control" name="form_title" placeholder="Enter Title..." value="<?php echo $title; ?>" Disabled>
                </div>

                <div class="form-group">
                  <label>Describe Location  </label>
                  <textarea class="form-control" rows="6" name="form_location_describe" placeholder="Enter Location..." Disabled><?php echo $describe_location; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Start Date  </label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="form_start_date" Disabled value="<?php echo $start_date; ?>">
                  </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>End Date </label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control" name="form_end_date" Disabled value="<?php echo $end_date; ?>">
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Describe The Tour </label>
                  <textarea class="form-control" rows="10" placeholder="Enter ..." name="form_tour_description" Disabled ><?php echo $tour_description; ?></textarea>
                </div>


                <!-- textarea -->
                <div class="form-group">
                  <label>Describe The Transport System and who carry the cost * </label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="form_transport_description" Disabled><?php echo $transport_description; ?></textarea>
                </div>

                <input type="hidden" name="id" value="<?php echo $ture_id ?>">


                <div class="form-group">
                  <label>Describe Extra Facilities</label>
                  <textarea class="form-control" rows="6" placeholder="If you Carry this Cost ..." name="form_extra_facility" Disabled><?php echo $extra_facility; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Max People </label>
                  <input type="text" class="form-control" Disabled value="<?php echo $max_people ?>">
                </div>

                <div class="form-group">
                  <label>Budget (taka) </label>
                  <input type="text" class="form-control" placeholder="Enter Title..." Disabled value="<?php echo $budget; ?>">
                </div>

              <?php } else { ?> 
                <h2> Sorry No Data Found</h2>

              <?php } ?>


            </form>
          </div>
          <!-- /.box-body -->
        </div>
      </div>


      <!--  ------ table ---- -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Participate Traveler List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Name</th>
                  <th>Participate person</th>
                  <th>Traveler Comment</th>
                  <th>Action</th>
                </tr>

                <?php  

                while ($row = mysqli_fetch_array($participat_traveler)) {   

              // get traveler name;  
                  $traveler_name = "Unkonwn";

                  $quary = "SELECT first_name, last_name FROM `traveler` where traveler_Id = ".$row['traveler_traveler_Id'] ;
                  $traveler_name_quary = mysqli_query($conn, $quary);

                  while ($row2 = mysqli_fetch_array($traveler_name_quary)) {
                   $traveler_name = $row2['first_name'] . " " . $row2['last_name'];
                 }  

                 ?>

                 <tr>
                  <td><?php echo $traveler_name ?></td>
                  <td><?php echo $row['number_of_tourist']; ?></td>
                  <td><?php echo $row['traveler_comment'] ?: "No Comment"; ?></td>
                  <td>

                    <?php 

                    if($row['guide_rating']<1){ ?>

                       <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-rating" onclick="setValue(<?php echo $_GET['id']; ?>, <?php echo $row['id']; ?>)">
                      Rate
                    </button>


                      <?php } else { ?>

                         <button type="button" class="btn btn-success">
                      <?php echo $row['guide_rating']; ?>
                    </button>

                    

                    <?php } ?>

             
                   <!--  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-rating" onclick="setValue(<?php //echo $_GET['id']; ?>, <?php //echo $row['id']; ?>)">
                      Rate
                    </button> -->

                  </td>
                </tr>

              <?php   } ?>

            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>

  <!-- right col -->
</div>
</div>


<!-- Modal Rating -->
<div class="modal fade" id="modal-rating">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="view_tour_history.php?id=<?php echo $_GET['id']; ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Rating Your Traveler</h4>
          </div>
          <div class="modal-body">

            <div class="rating" style="padding-right: 300px">
             <span style="margin-right: 20px"> Rate: </span>
             <input type="radio" id="star10" name="rating" value="5" /><label for="star10" title="Rocks!">5 stars</label>
             <input type="radio" id="star9" name="rating" value="4" /><label for="star9" title="Rocks!">4 stars</label>
             <input type="radio" id="star8" name="rating" value="3" /><label for="star8" title="Pretty good">3 stars</label>
             <input type="radio" id="star7" name="rating" value="2" /><label for="star7" title="Pretty good">2 stars</label>
             <input type="radio" id="star6" name="rating" value="1" checked/><label for="star6" title="Meh">1 star</label>
           </div>
           <br> <br>

           <div class="rating">
            <span style="margin-right: 20px"> Comment: </span>
          </div>

          <input type="hidden" name="idNo" id="idNo" value="0">
          <input type="hidden" name="tour_id" id="tour_id" value="0">

          <textarea rows="4" cols="50" placeholder="Comment" name="comment" id="comment"> </textarea> 
          <div style="padding-top: 40px">
          </div>
          <br>
        </div>
        <div class="modal-footer">
          <input type="Submit" class="btn btn-default pull-left" name="rate_traveler" value="Rate" >
          <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<!-- Modal Rating End-->


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


<script type="text/javascript">
  function setValue(tourid, idNo) {
   document.getElementById("tour_id").value = tourid;
   document.getElementById("idNo").value = idNo;
 }
</script>


</body>
</html>

<?php } ?>
