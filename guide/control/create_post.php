<?php 

 include_once('./connection.php'); 

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}


$title = $district = $describe_location = $start_date = $end_date = $tour_description = $meeting_point = $transport_description = $extra_facility = $budget = $offer_budget = $district = $image_error = "";

$max_people = 2;
$budget = 0;
$message = "";
$error_point = 0;

$title_error = $district_error = $describe_location_error = $start_date_error = $end_date_error = $tour_description_error = $transport_description_error = $extra_facility_error = $budget_error = $offer_budget_error = "";

$error_text_color = "red";



if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Title 
	if (empty($_POST["form_title"])) {
		$title_error =  "Title is required";
		$error_point++;
	} else {
		$title = test_input($_POST["form_title"]);
	}


// District
	if (empty($_POST["form_district"])) {
		$district_error =  "District is required";
		$error_point++;
	} else {
		$district = test_input($_POST["form_district"]);
	}


// Describe location	
	if (empty($_POST["form_location_describe"])) {
		$describe_location_error =  "Describe location is required";
		$error_point++;
	} else {
		$describe_location = test_input($_POST["form_location_describe"]);
	} 


// start_date
	if (empty($_POST["form_start_date"])) {
		$start_date_error =  " Tour Start date is required";
		$error_point++;
	} else {
		$start_date = test_input($_POST["form_start_date"]);
	}


// end_date
	if (empty($_POST["form_end_date"])) {
		$end_date_error =  " Tour End date is required";
		$error_point++;
	} else {
		$end_date = test_input($_POST["form_end_date"]);
	}

// compare start and end date

	if ($start_date > $end_date){
		$end_date_error =  "Tour End Date must getter then Start Date";
		$error_point++;
	}  


// tour_description

	if (empty($_POST["form_tour_description"])) {
		$tour_description_error =  "Tour describe is required";
		$error_point++;
	} else {
		$tour_description = test_input($_POST["form_tour_description"]);
	}

// transport_description
	if (empty($_POST["form_transport_description"])) {
		$transport_description_error =  "Transport Description is required";
		$error_point++;
	} else {
		$transport_description = test_input($_POST["form_transport_description"]);
	}

//  Guide id 

	$guide_id = $_SESSION['tour_by_local_guid_id'];

// image

	$image = $_POST['image'];

	$fileName = $_FILES['image']['name'];
 	$fileType = $_FILES['image']['type'];
 	$file_Tmp_path_name = $_FILES['image']['tmp_name'];
 	$fileError = $_FILES['image']['error'];

 	$fileExt = explode( '.' , $fileName);
 	$fileActualExt = strtolower((end($fileExt)));

 	$allowed = array('jpg', 'jpeg', 'png');

 	if(in_array($fileActualExt, $allowed)){

 		$fileNewName = uniqid('', true)."_".$guide_id.".".$fileActualExt;
 		$fileDestination = 'image/ture/'.$fileNewName;
 		move_uploaded_file($file_Tmp_path_name, $fileDestination);

 	} else {
 		$image_error = "Please select a image (jpg / jpeg / png)";
 		$error_point++;
 	}


// extra_facility
	$extra_facility = test_input($_POST["form_extra_facility"]);


// budget
	if (empty($_POST["form_budget"])) {
		$budget_error =  "Budget is required";
		$error_point++;
	} else {
		if (is_numeric($_POST["form_budget"] && $_POST["form_budget"] < 349 )) {
			$budget_error = "Budget must be a number and getter then 349";
			$error_point++;
		} else {
			$budget = test_input($_POST["form_budget"]);
		}
	}

// offer_budget
	$offer_budget = test_input($_POST["form_offer_budget"]);

// max turiest
	$max_people = test_input($_POST["form_max_people"]);


// Check Date 
	if($error_point > 0){
		$error_point = 0;
		$message = "Upload fail as some input field required";
	} else {
		$quary = "insert into `tour` (tour_title, tour_area_details, ture_district, tour_details, cover_image, meeting_point, transportation, tour_facilities, start_date, end_date, tourist_limitation, budget, guide_guide_id) VALUES ('$title', '$describe_location', '$district' , '$tour_description', '$fileNewName' ,'$meeting_point', '$transport_description', '$extra_facility', '$start_date', '$end_date', '$max_people', '$budget', '$guide_id')";

		if ($conn->query($quary) === TRUE){

			$title = $district = $describe_location = $start_date = $end_date = $tour_description = $meeting_point = $transport_description = $extra_facility = $budget = $offer_budget = "";

			$max_people = 2;
			$budget = 0;
			//$message  = "success";
			 $message = '<p style="color: green"> Successfully Create New Ture </p>';


		} else {
			$message = 'Fail as : '.$conn->error ;
			// $message = $quary;
			 $message  = '<p style"color: red"> $message </p>';
		}

	}

}

?>