<?php
include 'db_config.php';
$target_dir = "uploads/";
$scale = $_POST["scale"];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(!isset($_POST["submit"]) || empty($_FILES["fileToUpload"]["name"])) {    
    echo "Image failed to load.</br>";
    echo "<a href='main.php'>Return to main page</a>";
    exit;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.</br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] == 0) {
    echo "Sorry, your file is too large.</br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
    $uploadOk = 0;
}


function resize_image($file, $w, $h, $path) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    
    $newwidth = $h*$r;
    $newheight = $h;
    
    $type = strtolower(pathinfo($file,PATHINFO_EXTENSION));
    switch ($type) {
            case 'jpeg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    break;
        
            case 'jpg':
                    $image_create_func = 'imagecreatefromjpeg';
                    $image_save_func = 'imagejpeg';
                    break;

            case 'png':
                    $image_create_func = 'imagecreatefrompng';
                    $image_save_func = 'imagepng';
                    break;

            default:
                    throw new Exception('Unknown image type.');
    }

    $src = $image_create_func($file);

    
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    $old_file = $path . pathinfo($file, PATHINFO_FILENAME);
    rename($file, $old_file."-full.".pathinfo($file, PATHINFO_EXTENSION));
    $image_save_func($dst, $file);
}


function resize_gif($file, $w, $h, $path) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    
    $newwidth = $h*$r;
    $newheight = $h;    

    $image = new Imagick($file);

    $image = $image->coalesceImages();

    foreach ($image as $frame) {    
        $frame->thumbnailImage($newwidth, $newheight);
        $frame->setImagePage($newwidth, $newheight, 0, 0);
    }

    $old_file = $path . pathinfo($file, PATHINFO_FILENAME);
    rename($file, $old_file."-full.gif");
    $image = $image->deconstructImages();
    $image->writeImages($file, true);
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.</br>";
// if everything is ok, try to upload file
} else {    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        if($imageFileType == 'gif') {
            resize_gif($target_file, $scale, $scale, $target_dir);
        } else {
            resize_image($target_file, $scale, $scale, $target_dir);
        }        
        
        $stmt = $mysqli->prepare("INSERT INTO images (id, image) VALUES (NULL, ?)");
        $stmt->bind_param("s", $target_file);

        $stmt->execute();
        $stmt->close();

        echo "The file ".basename( $_FILES["fileToUpload"]["name"])." has been uploaded successfully.";	
    } else {
        echo "Sorry, there was an error uploading your file.</br>";
    }
}
?>

<a href="main.php">Return to main page</a>
