<?php 

include_once('./connection.php'); 

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

$isGetData = false;

$title = $district = $describe_location = $start_date = $end_date = $tour_description = $meeting_point = $transport_description = $extra_facility = $budget = $offer_budget = "";

$max_people = 0;
$budget = 0;
$message = "";
$error_point = 0;

$title_error = $district_error = $describe_location_error = $start_date_error = $end_date_error = $tour_description_error = $transport_description_error = $extra_facility_error = $budget_error = $offer_budget_error = "";

$error_text_color = "red";

$ture_id = 0;

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
	$offer_budget = ""; // test_input($_POST["form_offer_budget"]);

// max turiest
	$max_people = test_input($_POST["form_max_people"]);

// tour id

	$ture_id = $_POST["id"];


// Check Date 
	if($error_point > 0){
		$error_point = 0;
		$message = "Error found";
	} else {
	

		$quary = "UPDATE  `tour` set  tour_title = '$title', tour_area_details = '$describe_location', tour_details = '$tour_description', meeting_point = '$meeting_point', transportation = '$transport_description', tour_facilities = '$extra_facility', start_date = '$start_date', end_date = '$end_date', tourist_limitation = '$max_people', budget =  '$budget' where tour_id = ".$ture_id;

		if ($conn->query($quary) === TRUE){

			// $title = $district = $describe_location = $start_date = $end_date = $tour_description = $meeting_point = $transport_description = $extra_facility = $budget = $offer_budget = "";

			//$message  = "success";
			$message = '<p style="color: green"> Successfully update </p>';

			$quary = "SELECT * FROM `tour` WHERE tour_id = ". $ture_id ." and guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and start_date > now()" ;
			$result = mysqli_query($conn, $quary);

			$i = 0;
			while ($row = mysqli_fetch_array($result)) {  

				$title = $row['tour_title'];
				$describe_location = $row['tour_area_details'];
				$tour_description = $row['tour_details'];
				$start_date = $row['start_date'];
				$end_date = $row['end_date'];
				$meeting_point = $row['meeting_point'];
				$transport_description =$row['transportation'];
				$extra_facility = $row['tour_facilities'];
				$budget = $row['budget'];
				$max_people = $row['tourist_limitation'];
				$isGetData = true;
			}


		} else {
			$message = 'Fail as : '.$conn->error ;
			// $message  = '<p style"color: red" > $message </p>';
		}

	}

} else {


	$quary = "SELECT * FROM `tour` WHERE tour_id = ". $_GET['id']." and guide_guide_id = ".$_SESSION['tour_by_local_guid_id']." and start_date > now()" ;
	$result = mysqli_query($conn, $quary);

	$i = 0;
	while ($row = mysqli_fetch_array($result)) {  

		$title = $row['tour_title'];
		$describe_location = $row['tour_area_details'];
		$tour_description = $row['tour_details'];
		$start_date = $row['start_date'];
		$end_date = $row['end_date'];
		$meeting_point = $row['meeting_point'];
		$transport_description =$row['transportation'];
		$extra_facility = $row['tour_facilities'];
		$budget = $row['budget'];
		$max_people = $row['tourist_limitation'];
		$isGetData = true;
		$ture_id = $_GET['id'];
	}
}

?>