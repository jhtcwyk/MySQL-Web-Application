<?php
	session_start();
	require 'authentication.inc';
	$projid = $_POST["projid"];
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	if(!empty($_POST["update_text"]) && isset($_POST["update_text"])){
		$update_text = mysqli_real_escape_string($connection, $_POST["update_text"]);
		
		if(isset($_FILES['update_image']['tmp_name']) && !empty($_FILES['update_image']['tmp_name']))
			$update_image=addslashes(file_get_contents($_FILES['update_image']['tmp_name']));
		else
			$update_image = null;
		
		
		
		
		
		$post_update = "insert into proj_update values ({$projid}, NOW(), '{$update_text}', '{$update_image}')";
		mysqli_query($con, $post_update);
	}
	$_POST=array();
	unset($_POST["update_text"]);
	unset($update_text);
	mysqli_close($con);
	//header("location:http://localhost/project/projectProfile.php");
	header('location: '.$_SERVER['HTTP_REFERER']);
?>
