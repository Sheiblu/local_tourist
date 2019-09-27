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

    <?php  include_once('sub_tem/header.php');  ?>
    <?php  include_once('control/update_post.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>View and Edit Tour</small>
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
              <h3 class="box-title"></h3>
              <h1><?php echo $message; ?></h1>
            </div>

            <div style="float: right; margin-right: 10px; margin-bottom: 2px">      
               <a href="map.php?id=<?php echo $_GET['id'] ?>"><button type="button" class="btn btn-success">Set Meet Point</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ;?>"  enctype="multipart/form-data" role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Title * </label>
                  <input type="text" class="form-control" name="form_title" placeholder="Enter Title..." value="<?php echo $title; ?>"  required="required">
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $title_error; ?></p>
                </div>

                <!-- select -->
                <div class="form-group">
                  <label>District * </label>
                  <select class="form-control" name="form_district" required="required">
                    <option>Dhaka</option>
                    <option>Comilla</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Describe Location * </label>
                  <textarea class="form-control" rows="6" name="form_location_describe" placeholder="Enter Location..." required="required"><?php echo $describe_location; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $describe_location_error; ?></p>
                </div>

                <div class="form-group">
                  <label>Start Date * </label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control pull-right" id="reservation" name="form_start_date" required="required" value="<?php echo $start_date; ?>">
                    <p style="color: <?php echo $error_text_color; ?>"><?php echo $start_date_error; ?></p>
                  </div>
                  <!-- /.input group -->
                </div>


                <div class="form-group">
                  <label>End Date * </label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date"  class="form-control pull-right" id="reservation" name="form_end_date" required="required" value="<?php echo $end_date; ?>">
                    <p style="color: <?php echo $error_text_color; ?>"><?php echo $end_date_error; ?></p>
                  </div>
                  <!-- /.input group -->
                </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Describe The Tour * </label>
                  <textarea class="form-control" rows="10" placeholder="Enter ..." name="form_tour_description" required="required" ><?php echo $tour_description; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $tour_description_error; ?></p>
                </div>


                <!-- textarea -->
                <div class="form-group">
                  <label>Describe The Transport System and who carry the cost * </label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="form_transport_description" required="required"><?php echo $transport_description; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $transport_description_error; ?></p>
                </div>

                <input type="hidden" name="id" value="<?php echo $ture_id ?>">


                <div class="form-group">
                  <label>Describe Extra Facilities</label>
                  <textarea class="form-control" rows="6" placeholder="If you Carry this Cost ..." name="form_extra_facility" ><?php echo $extra_facility; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $extra_facility_error; ?></p>
                </div>

                <div class="form-group">
                  <label>Max People * </label>
                   <select class="form-control" name="form_max_people" required="required">
                    <?php  for($i=2; $i<11; $i++) { 

                    if($i == $max_people){   ?>
                       <option selected><?php echo $i ?></option>
                   <?php   } else {  ?>
                    <option><?php echo $i ?></option>
                  <?php }}  ?>

                </select>
                </div>

                <div class="form-group">
                  <label>Budget (taka) * </label>
                  <input type="number" class="form-control"  min="349" max="40000" name="form_budget" placeholder="Enter Title..." required="required" value="<?php echo $budget; ?>">
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $budget_error; ?></p>
                </div>

            <!--       <div class="form-group">
                    <label>Offer Budget</label>
                    <textarea class="form-control" rows="3" name="form_offer_budget" placeholder="Enter ..."><?php // echo $offer_budget; ?></textarea>
                    <?php //echo $offer_budget_error; ?>
                  </div>
                -->


                <input type="submit" value="Update">

              <?php } else { ?> 
              <h2> Sorry No Data Found</h2>

              <?php } ?>


            </form>
          </div>
          <!-- /.box-body -->
        </div>


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