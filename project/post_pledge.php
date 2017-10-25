<?php
	session_start();
	$userid = $_SESSION["userid"];
	$projid = $_POST["projid"];
	$pledge_amount = $_POST["pledge_amount"];
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	
	$get_pledgeid = "select max(pledgeid) from pledge";
	$result = mysqli_query ($connection, $get_pledgeid);
	$row=mysqli_fetch_array($result);
	$pledgeid = $row[0] + 1;
	
	$insert_pledge =  "insert into pledge values ({$pledgeid}, {$userid}, {$projid}, NOW(), '{$pledge_amount}')";
	mysqli_query($con, $insert_pledge);
	
	$_POST=array();
	mysqli_close($con);
	header('location: '.$_SERVER['HTTP_REFERER']);
?>
