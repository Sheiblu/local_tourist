<?php 

include_once('./connection.php'); 



$isGetData = false;

$title = $district = $describe_location = $start_date = $end_date = $tour_description = $meeting_point = $transport_description = $extra_facility = $budget = $offer_budget = "";

$max_people = 0;
$budget = 0;
$message = "";


	$quary = "SELECT * FROM `tour` WHERE tour_id = ". $_GET['id']." and guide_guide_id = ". $_SESSION['tour_by_local_guid_id'] ." and start_date < now() and end_date < now()" ;
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


	$quary = "SELECT * from tour_has_traveler where tour_tour_id = '".$_GET['id']."' and tour_request_status = 'accept' " ;
	$participat_traveler = mysqli_query($conn, $quary);

?>