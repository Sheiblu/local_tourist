<?php 

include_once('connection.php');


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	return $data;
}

$name = $email = $password = $massage ="" ;
$error = 0;

if (isset($_POST["register_guide"])) {

	if (empty($_POST["name"])) {
		$massage = $massage ."Plaase Give Name";
		$error++;
	} else {
		$name = test_input($_POST["name"]);
	}

	if (empty($_POST["email"])) {
		$massage = $massage ."<br>Plaase Give Email";
		$error++;
	} else {
		$email = test_input($_POST["email"]);
	}

	if (empty($_POST["password"])) {
		$massage = $massage ."<br>Plaase Give Password";
		$error++;
	} else {
		$password = test_input($_POST["password"]);
	}

	if ($error < 1) {

		$sql = "SELECT * FROM `guide` where email = '$email'";

		$result = mysqli_query($conn, $sql);
		$total = mysqli_num_rows($result);


		if($total > 0){
			$massage = "<br>Email number already Register";
		} else {

			$sql = "insert into guide (first_name, email, password) VALUES ('$name','$email','$password')";
			

			if ($conn->query($sql) === false) {
				$massage = "<br>Registration Fail, Try again";
			} else {
				$massage = "<br>Registration Successfully Complete";
				$name = $email = $password = "" ;
			}
		}
	} 

	$error = 0;

  }

?>