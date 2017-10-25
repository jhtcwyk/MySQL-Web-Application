
<?php
	session_start();
	$userid = $_SESSION["userid"];
	$projid = $_POST["projid"];
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	if(isset($_POST["comment_message"]) && !empty($_POST["comment_message"])){
		$comment_message = mysqli_real_escape_string($connection, $_POST["comment_message"]);
		$post_comment = "insert into comment values ({$projid}, {$userid}, NOW(), '{$comment_message}')";
		mysqli_query($con, $post_comment);
	}
	$_POST=array();
	unset($_POST["comment_message"]);
	unset($comment_message);
	mysqli_close($con);
	//header("location:http://localhost/project/projectProfile.php");
	header('location: '.$_SERVER['HTTP_REFERER']);
?>
