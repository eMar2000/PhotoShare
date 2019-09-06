<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1\
\
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
        <h1 class="display-4">Register</h1>
        </br>
<?php

include "db_config.php";

$new_username = $_POST['username'];
$new_password1 = $_POST['password1'];
$new_password2 = $_POST['password2'];

$hashed_password = password_hash($new_password1, PASSWORD_DEFAULT);

echo "Attempting to add user...</br>";

// check if passwords match
if ($new_password1 != $new_password2) {
   echo "Passwords do not match. Try again.<br>";
   echo "</br><a href= 'register.php'>Return</a>";
   exit;
}

if (strlen($new_password1) < 8){
   echo "Password must be atleast 8 characters long.<br>";
   echo "</br><a href= 'register.php'>Return</a>";
   exit;
}

$stmt = $mysqli->prepare($sql = "SELECT * FROM users where username = ?");
$stmt->bind_param("s", $new_username);

$stmt->execute();
$stmt->store_result();
$stmt->bind_result($u_id, $name, $pw);

if ($stmt->num_rows > 0) {
   echo "This username " . $new_username . " already exists.<br>";
   echo "<br><a href= 'register.php'>Return</a>";
   exit;
}

$stmt = $mysqli->prepare("INSERT INTO users (id, username, password) VALUES (null, ?, ?)");
$stmt->bind_param("ss", $new_username, $hashed_password);

$result = $stmt->execute();
$stmt->close();

if($result) {
   echo "Registration success<br>";
}
else {
   echo "Something went wrong. Please try again.<br>";
}

echo "</br><a href= 'main.php'>Return to main</a>";


?>
</div>
</div>

</html>