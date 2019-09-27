<?php 

include_once('connection.php');

if (isset($_POST["rate_traveler"])) {
	$no = $_POST['idNo'];
	$id = $_POST['tour_id'];
	$rating = $_POST['rating'];
	// $comment = $_POST['idNo'];

	if (empty($_POST["comment"])) {
		$sql = "UPDATE `tour_has_traveler` set guide_rating = ".$rating." where id = ".$no;
	} else {
		$sql = "UPDATE `tour_has_traveler` set guide_rating = ".$rating.", guide_comment = '".$_POST["comment"]."' where id = ".$no;
	}

	echo $sql;

	if ($conn->query($sql) === false) {
	     header("Location: view_tour_history.php?id=$id");
		//echo "Fail" ;
	} else {
		header("Location: view_tour_history.php?id=$id");
		//echo "Pass" ;
	}

}

?>