<?php 

session_start();
if (!isset($_SESSION['tour_by_local_guid_id'])) {
  header("location: sign_in.php");
} else {

  $img_src = "image/ture/DSC_2581.JPG";
  include_once('connection.php');  

  $message = "";

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
    <?php  include_once('control/update_profile.php');  ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php  include_once('sub_tem/left_side_menu.php');  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Update Profile</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Update Profile</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <h1><?php echo $message; ?></h1>
            </div>
            <?php 

             $quary = "SELECT * FROM `guide` where guide_id  = ".$_SESSION['tour_by_local_guid_id'] ;
             $result = mysqli_query($conn, $quary);

             while ($row = mysqli_fetch_array($result)) { 

              ?>

              <!-- /.box-header -->
              <div class="box-body">
                <form  method="POST" action="<?php echo $_SERVER["PHP_SELF"] ;?>"  enctype="multipart/form-data" role="form">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Fast Name *</label>
                    <input type="text" class="form-control" id="form_fast_name" name="form_fast_name" placeholder="Enter Title..." value="<?php echo $row['first_name'] ?>"  required="required">
                  </div>


                  <div class="form-group">
                    <label>Last Name *</label>
                    <input type="text" class="form-control" id="form_last_name" name="form_last_name" placeholder="Enter Title..." value="<?php echo $row['last_name'] ?>"  required="required">
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
                    <label> Birthday Date * </label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control pull-right" id="form_birth_date" name="form_birth_date" required="required" value="<?php echo $row['birth_date']; ?>">
                    </div>


                    <div class="form-group">
                      <label>Age *</label>
                      <input type="text" class="form-control" id="form_age" name="form_age" placeholder="Enter Title..." value="<?php echo $row['age'] ?>"  required="required">
                    </div>



                    <div class="form-group">
                      <label>Permanent Address Location * </label>
                      <textarea class="form-control" rows="6" id="form_permanent_address" name="form_permanent_address" placeholder="Enter Location..." required="required"><?php echo $row['parmanent_address'] ?></textarea>
                    </div>

                  </div>

                  <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="text" class="form-control" id="form_phone_number" name="form_phone_number" placeholder="Enter Phone Number..." value="<?php echo $row['phone_number'] ?>"  required="required">
                  </div>

                  <div class="form-group">
                    <label>Skype Name</label>
                    <input type="text" class="form-control" id="form_phone_number" name="form_skype_number" placeholder="Enter Skype ID ..." value="<?php echo $row['skype_name'] ?>">
                  </div>


                 <!--  <div class="form-group">
                   <label for="form_image">Image</label>
                   <input type="file" name="image" id="form_image" onchange="changeModalImage()">
                 </div> -->

                 <input type="submit" class="btn btn-primary" value="Update Profile">


               </form>

             <?php } ?>
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

<!--  <script type="text/javascript">

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


   </script> -->

 </body>
 </html>

<?php } ?>
