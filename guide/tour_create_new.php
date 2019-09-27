<?php 

  session_start();
  if (!isset($_SESSION['tour_by_local_guid_id'])) {
    header("location: sign_in.php");

  } else if($_SESSION['status'] != "active"){ 
    header("Location: index.php");
  } else {

    $img_src = "image/ture/DSC_2581.JPG";

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
    <?php  include_once('control/create_post.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Create Tour</small>
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

          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Create Tour</h3>
              <h1><?php echo $message; ?></h1>
            </div>

            <div style="float: right; margin-right: 10px; margin-bottom: 2px">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-preview" onclick="preview()">
                Preview
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ;?>"  enctype="multipart/form-data" role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Title * </label>
                  <input type="text" class="form-control" id="form_title" name="form_title" placeholder="Enter Title..." value="<?php echo $title; ?>"  required="required">
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $title_error; ?></p>
                </div>

                 <!-- select -->
                <div class="form-group">
                  <label>District * </label>
                  <select class="form-control" id="from_district" name="form_district" required="required">
                    <option>dhaka</option>
                    <option>comilla</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Describe Location * </label>
                  <textarea class="form-control" rows="6" id="form_location_describe" name="form_location_describe" placeholder="Enter Location..." required="required"><?php echo $describe_location; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $describe_location_error; ?></p>
                </div>

                <div class="form-group">
                <label>Start Date * </label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="form_start_date" name="form_start_date" min="<?php echo date("Y-m-d"); ?>" required="required" value="<?php echo $start_date; ?>">
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
                  <input type="date"  class="form-control pull-right" id="form_end_date" name="form_end_date" min="<?php echo date("Y-m-d"); ?>" required="required" value="<?php echo $end_date; ?>">
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $end_date_error; ?></p>
                </div>
                <!-- /.input group -->
              </div>

                <!-- textarea -->
                <div class="form-group">
                  <label>Describe The Tour * </label>
                  <textarea class="form-control" id="form_tour_description" rows="10" placeholder="Enter ..." name="form_tour_description" required="required" ><?php echo $tour_description; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $tour_description_error; ?></p>
                </div>


                 <!-- textarea -->
                 <div class="form-group">
                  <label>Describe The Transport System and who carry the cost * </label>
                  <textarea class="form-control" rows="3" id="form_transport_description" placeholder="Enter ..." name="form_transport_description" required="required"><?php echo $transport_description; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $transport_description_error; ?></p>
                </div>


                <div class="form-group">
                  <label>Describe Extra Facilities</label>
                  <textarea class="form-control" id="extra_facility" rows="6" placeholder="If you Carry this Cost ..." name="form_extra_facility" ><?php echo $extra_facility; ?></textarea>
                  <p style="color: <?php echo $error_text_color; ?>"><?php echo $extra_facility_error; ?></p>
                </div>

                 <div class="form-group">
                  <label>Max People * </label>
                  <select class="form-control" id="form_max_people" name="form_max_people" required="required">
                    <option selected>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>4</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>10</option>
                  </select>
                </div>

                <div class="form-group">
                 <label for="form_image">Tour Cover Image</label>
                  <input type="file" name="image" id="form_image" onchange="changeModalImage()">
                   <p style="color: <?php echo $error_text_color; ?>"><?php echo $image_error; ?></p>
                </div>

                

                <div class="form-group">
                  <label>Budget (taka) * </label>
                   <input type="number" id="form_budget" class="form-control"  min="300" max="40000" name="form_budget" placeholder="Enter Title..." required="required" value="<?php echo $budget; ?>">
                   <p style="color: <?php echo $error_text_color; ?>"><?php echo $budget_error; ?></p>
                </div>

                <div class="form-group">
                  <label>Offer Budget</label>
                  <textarea class="form-control" rows="3" name="form_offer_budget" placeholder="Enter ..."><?php echo $offer_budget; ?></textarea>
                  <?php echo $offer_budget_error; ?>
                </div>

                <input type="submit" class="btn btn-primary" value="POST">
             

              </form>
            </div>
            <!-- /.box-body -->
          </div>


        </div>
      </section>

      <!-- right col -->
    </div>
  </div>


  <div class="modal fade" id="modal-preview">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">TourByLocal (Post Preview)</h4>
              </div>
              <div class="modal-body">
                 <h4 id="district_modal" style="height: 25px; background-color: red ; text-align: center; padding-top: 5; color: white" >Dhaka</h4>
                 <img src="image/ture/DSC_2581.JPG" id= "modal_img" style="height: 250px; width: 570px">
                 <h3 id="title_modal" style="text-align: center; color: red" ></h3>

                 <p style="color: red">Details:</p>
                 <p id="tour_area_details_modal" style="margin-top: 5px"></p>

                 <p id="tour_details_modal"></p>

                 <p style="color: red">WHat's Included:</p>
                 <p id="what_include_modal"></p>

                 <p style="color: red">WHat's Extra:</p>
                 <p id="what_extra_modal"></p>

                 <p style="color: red; margin-top: 5px">Tourist Capacity: <span id="capacity_modal" style="color: black; margin-left: 10px"></span></p>

                 <p style="color: red; margin-top: 5px">Tourist Enroll: <span  style="color: black;  margin-left: 28px">0</span></p>

                 <p style="color: red; margin-top: 5px">Start Tour: <span id="start_date_modal" style="color: black;  margin-left: 30px; margin-right: 60px">0</span> End Tour: <span id="end_date_modal" style="color: black;  margin-left: 10px;"></span></p>

                 <p style="color: red; margin-top: 5px">Budget: <span  id="budget_modal" style="color: black;  margin-left: 28px"></span></p>
                 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
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

 <script type="text/javascript">
   function preview(){

    document.getElementById("district_modal").innerHTML = document.getElementById("from_district").value;
    document.getElementById("title_modal").innerHTML = document.getElementById("form_title").value;
    document.getElementById("tour_details_modal").innerHTML = document.getElementById("form_tour_description").value;
    document.getElementById("tour_area_details_modal").innerHTML = document.getElementById("form_location_describe").value;
    document.getElementById("what_include_modal").innerHTML = document.getElementById("form_transport_description").value;
    document.getElementById("what_extra_modal").innerHTML = document.getElementById("extra_facility").value;
    document.getElementById("capacity_modal").innerHTML = document.getElementById("form_max_people").value;
    document.getElementById("start_date_modal").innerHTML = document.getElementById("form_start_date").value;
    document.getElementById("end_date_modal").innerHTML = document.getElementById("form_end_date").value;
    document.getElementById("budget_modal").innerHTML = document.getElementById("form_budget").value;
    
   }

   function changeModalImage(){
       var preview = document.getElementById('modal_img'); //selects the query named img
       var file    = document.querySelector('input[type=file]').files[0]; //sames as here
       var reader  = new FileReader();

       reader.onloadend = function () {
           preview.src = reader.result;
       }

       if (file) {
           reader.readAsDataURL(file);
       } else {
           preview.src = "image/ture/DSC_2581.JPG";
       }
  }


 </script>

</body>
</html>

<?php } ?>
