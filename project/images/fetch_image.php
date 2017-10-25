<?php

header("content-type:image/jpeg");

if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
  die("Cannot connect");

$id=$_GET['id'];

$select_image="select * from image_table where id='{$id}'";

$var=mysqli_query($con, $select_image);

if($row=mysqli_fetch_array($var))
{
 //$image_name=$row["imagename"];
 $image_content=$row["imagecontent"];
}
echo $image_content;

?>