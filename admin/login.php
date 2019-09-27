<?php
    // define variables and set to empty values
session_start();

if (isset($_SESSION['tour_by_local_admin_id'])) {
    header("location: index.php");
} else {


$email = $password = "";
$id = 0;


require_once('connection.php');  



if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // $email = test_input($_POST["email"]);
  // $password = test_input($_POST["password"]);

  $email = ($_POST["email"]);
  $password = ($_POST["password"]);

  $sql = "SELECT * FROM admin  where email = '$email' and password = '$password'";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_array($result)) {
    $id = $row['admin_id'];
    $name = $row['name'];
    $email = $row['email'];
    break;

    // $_SESSION['admin_id'] = $row['admin_id'];
    // $_SESSION['admin_name'] = $row['admin_name'];

  }

  if (mysqli_num_rows($result) != 1){
    header("Location: login.php?error=true");
  } else {
    $_SESSION['tour_by_local_admin_id'] = $id ;
    $_SESSION['tour_by_local_admin_name'] = $name;
    header("Location: guid_account_request.php");
  }
}


if($_GET){

  if(isset($_GET['error']) && $_GET['error'] == true){
    $message = "Wrong password or email or both <br> <br> <br>";
  } 

} else {
 $message = "";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!doctype html>
<html lang="en">

<head>


 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 <link href="style/style.css" rel="stylesheet">

</head> 



<body class="text-center">
  <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <!--  <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="102"> -->
    <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
    <div class="checkbox mb-3">

    </div>

    <?php echo $message; ?> 
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
  </form>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

<?php } ?>
