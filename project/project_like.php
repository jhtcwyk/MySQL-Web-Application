<?php
	session_start();
	$userid = $_SESSION["userid"];
	$projid = $_GET["projid"];
	$liked = $_GET["liked"];
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	
	if($liked == 0)
		$query_like =  "insert into likes values ('{$userid}', '{$projid}')";
	else 
		$query_like =  "DELETE FROM likes WHERE userid ='{$userid}' and projid = '{$projid}'";
	
	mysqli_query($con, $query_like);
	
	$_POST=array();
	mysqli_close($con);
	//header("location:http://localhost/project/projectProfile.php");
	//header("location:{$_SERVER["HTTP_REFERER"]}");
	header('location: '.$_SERVER['HTTP_REFERER']);
?>
