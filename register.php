<html>

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

<body>
<?php

include "db_config.php";

// include "search_all_jokes.php";

?>
<form class="form-horizontal" action = "process_new_user.php" method="post">
<fieldset>
</br></br>
<div class="container">
<div class="jumbotron w-50 mx-auto">
<h1 class="display-4">Register</h1>
</br>
<!-- text entry -->
<div class="form-group">
  <label class="col-md-4 control-label" for="username">Username</label>
  <div class="col-md-12">
    <input id="username" type="text" name="username" placeholder="username" class="form-control input-md" required="">
  </div>
</div>

<!-- text entry -->
<div class="form-group">
  <label class="col-md-4 control-label" for="password1">Password</label>
  <div class="col-md-12">
    <input id="password1" type="password" name="password1" placeholder="password" class="form-control input-md" required="">
  </div>
</div>

<!-- text entry -->
<div class="form-group">
  <label class="col-md-4 control-label" for="password2">Confirm Password</label>
  <div class="col-md-12">
    <input id="password2" type="password" name="password2" placeholder="password" class="form-control input-md" required="">
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-8">
    <button id="submit" name="submit" class="btn btn-primary">Create new user</button>
  </div>
</div>
</div>
</div>
     
</fieldset>
</form>

<?php

$mysqli->close();

?>

</body>

</html>
