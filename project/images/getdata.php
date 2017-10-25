<?php
require 'authentication.inc';

if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
  die("Cannot connect");

$imagename=$_FILES["myimage"]["name"]; 

//Get the content of the image and then add slashes to it 
$imagetmp=addslashes (file_get_contents($_FILES['myimage']['tmp_name']));

//Insert the image name and image content in image_table
$insert_image="INSERT INTO image_table VALUES('$imagename','$imagetmp')";

mysqli_query($con, $insert_image);

?>