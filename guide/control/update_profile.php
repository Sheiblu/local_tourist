<?php 

include_once('./connection.php'); 

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

$isGetData = false;

$title_error = $district_error = $describe_location_error = $start_date_error = $end_date_error = $tour_description_error = $transport_description_error = $extra_facility_error = $budget_error = $offer_budget_error = "";

$error_text_color = "red";

$error_point = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Fast Name 
	if (empty($_POST["form_fast_name"])) {
		$error_point++;
	} else {
		$fast_name = test_input($_POST["form_fast_name"]);
	}

// last Name 
	if (empty($_POST["form_last_name"])) {
		$error_point++;
	} else {
		$last_name = test_input($_POST["form_last_name"]);
	}


// District
	if (empty($_POST["form_district"])) {
		$error_point++;
	} else {
		$district = test_input($_POST["form_district"]);
	}


// Birth Date
	if (empty($_POST["form_birth_date"])) {
		$error_point++;
	} else {
		$birth_date = test_input($_POST["form_birth_date"]);
	} 


// Age
	if (empty($_POST["form_age"])) {
		$error_point++;
	} else {
		$age = test_input($_POST["form_age"]);
	}


// address
	if (empty($_POST["form_permanent_address"])) {
		$error_point++;
	} else {
		$permanent_address = test_input($_POST["form_permanent_address"]);
	}


// phone_number
	if (empty($_POST["form_phone_number"])) {
		$error_point++;
	} else {
		$phone_number = test_input($_POST["form_phone_number"]);
	}

// Skype name
	$skype_name = test_input($_POST["form_skype_number"]);


// Check Data

	if($error_point > 0){
		$error_point = 0;
		$message = "Error found";
	} else {
		$quary = "UPDATE `guide` set first_name = '$fast_name', last_name = '$last_name', birth_date =  '$birth_date', district = '$district', parmanent_address = '$permanent_address', phone_number = '$phone_number', skype_name = '$skype_name', age = '$age'  where guide_id = ".$_SESSION['tour_by_local_guid_id'];

		if ($conn->query($quary) === TRUE){

			if($_SESSION['status'] != 'active'){

				$quary = "UPDATE `guide` set account_status = 'resubmit' where guide_id = " . $_SESSION['tour_by_local_guid_id'];
				$result = mysqli_query($conn, $quary);

				$message = '<p style="color: green"> Your Profile is Successfully update. And Wait for admin approvel. </p>';
				$_SESSION['status'] = 'resubmit';

			} else {
				$message = '<p style="color: green"> Successfully update </p>';
			}
		} else {
			$message = 'Fail as : '.$conn->error ;
		}
	}
} else {
	$message  = "";

}

?>