<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1\
T" crossorigin="anonymous">

    <style>

    body {
        background-image: url("yosemite-wallpaper-8.jpg");
        //background-color: #cccccc;
    }

    .btn-primary {
        color: #fff;
        background-color: #00ccff;
        border-color: #00ccff;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075); }
    .btn-primary:hover {
        color: #fff;
        background-color: #008fb3;
        border-color: #008fb3; }

    </style>


</head>
</br></br>
<div class = "container">
<div class = "jumbotron w-50 mx-auto">
        <h1 class="display-4">Login</h1>
        </br>
<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_config.php";

$username = $_POST["username"];
$password = $_POST["password"];

echo "You attempted to login<br>";

$stmt = $mysqli->prepare("SELECT id, username, password FROM users where username = ?");
$stmt->bind_param("s", $username);

$stmt->execute();
$stmt->store_result();

$stmt->bind_result($userid, $uname, $pw);

if ($stmt->num_rows == 1) {
   echo "Username found<br>";
   $stmt->fetch();
   if(password_verify($password, $pw)) {
      echo "Password matches<br>";
      echo "Login sucess<br>";
      $_SESSION['username'] = $uname;
      $_SESSION['userid'] = $userid;
      echo "<br><a href='main.php'>return to main page</a>";
      exit;
   }
   else {
   	$_SESSION = [];
        session_destroy();
	echo "Password is incorrect<br>";
   }
}
else {
     echo "User does not exist<br>";
     $_SESSION = [];
     session_destroy();
}
echo "Login failed<br>";

echo "<br><a href='login.php'>return</a>";

?>
</div>
</div>        

</html>