<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1\T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="style.css">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="\anonymous"></script>
   </head>
<body>
      <nav class="navbar navbar-expand-lg navbar-light bg-info border rounded border-primary sticky-top navbar-light">
         <div class="container-fluid">
            <a class="navbar-brand text-primary" href="main.php">
            <b> MarPhotoShare</b>
            </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar5" style="">
            <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-primary pr-auto dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseUpload" aria-expanded="false" aria-controls="collapseUpload">
            Upload an Image
            </button>
            <div class = "navbar-text mx-auto">
               <?php
                  session_start();
                  $username = $_SESSION['username'];
                  if ($username != NULL)
                      echo '<h4>' . "Welcome! " . $username . '</h4>';
                  ?>
            </div>
            <a class="btn btn-outline-primary navbar-btn pl-auto" href="login.php">Login</a>
            <a class="btn btn-outline-primary navbar-btn ml-md-2" href="register.php">Register</a>
            <a class="btn btn-outline-primary navbar-btn ml-md-2" href="logout.php">Logout</a>
         </div>
      </nav>
      <div class="collapse" id="collapseUpload">
         <div class="jumbotron border">
            <form class="container" action="upload.php" method="post" enctype="multipart/form-data">
               <fieldset>
                  <!-- Form Name -->
                  <legend>Upload an Image</legend>
                  </br>
                  <!-- File Button -->
                  <div class="form-group">
                     <div class="row">
                        <label class="col-md-2 control-label" for="fileToUpload">Select image to upload:</label>
                        <div class="col-md-4">
                           <input id="fileToUpload" name="fileToUpload" class="input-file" type="file">
                        </div>
                        <label class="col-md-2 control-label" for="textinput">Image Scale</label>
                        <div class="col-md-2">
                           <input id="scale" name="scale" type="text" placeholder="e.g. 200" class="form-control input-md" required="">
                        </div>
                     </div>
                  </div>
                  <!-- Button -->
                  <div class="form-group">
                     <label class="col-md-4 control-label" for="submit"></label>
                     <div class="col-md-4 ml-auto">
                        <?php
                           if ($username != NULL) {
                           ?>
                        <button id="submit" name="submit" class="btn btn-primary">Upload</button>
                        <?php
                           } else {
                           ?> 
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload</button>
                        <?php } ?>
                     </div>
                  </div>
               </fieldset>
            </form>
         </div>
      </div>
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title">Warning!</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">
                  <p>You must log in to upload an image.</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
<div class="parallax"></div>
</br></br>
</div>
      <div class="gallery">
                               <div class="img_box">
         <?php
            // Include the database configuration file
            include 'db_config.php';
            
            $sql = "SELECT * FROM images ORDER BY id DESC";
            $result = $mysqli->query($sql);
            
            if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()){
            		$imageURL = $row["image"];
                       $fullImage = pathInfo($imageURL, PATHINFO_DIRNAME)."/".pathInfo($imageURL, PATHINFO_FILENAME)."-full.".pathInfo($imageURL, PATHINFO_EXTENSION);
            
            ?>
         <a href="<?php echo $fullImage; ?>"><img src="<?php echo $imageURL; ?>" alt="" class="display_img"/></a>
         <?php }
            }else{ ?>
         <p>No image(s) found...</p>
         <?php } ?>
      </div>
            </div>
   </body>
</html>