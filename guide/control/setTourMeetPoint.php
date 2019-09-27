<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="tours";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$quary;


if (isset($_POST["map_link"])) {

	if (!empty($_POST["tourId"])) {
		$tourId = $_POST['tourId'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];

		$quary = "UPDATE tour set meeting_point_lat = $lat , meeting_point_lng = $lng where tour_id = $tourId";
		$result = mysqli_query($conn, $quary);
		$affected = mysqli_affected_rows($conn);

		if ($affected > 0){
           // echo "Pass";
	      // header("Location: ../view_edit_tour.php?id=$tourId");
			$message = "Tour Meet Point added";
		} else {
			// echo "Fail";
	      // header("Location: ../view_edit_tour.php?id=$tourId");
			$message = "Tour Meet Point not added";
		} 
	}

}  else {
	$message = "";
}


?>