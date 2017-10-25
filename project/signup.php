<?php

require 'authentication.inc';

if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
  die("Cannot connect");

// Clean the data collected in the <form>
$username = getInput($_POST, "username", 40, $connection);
$loginname = getInput($_POST, "loginname", 40, $connection);
$useremail = getInput($_POST, "useremail", 40, $connection);
$userstate = getInput($_POST, "userstate", 40, $connection);
$usercity = getInput($_POST, "usercity", 40, $connection);
$useraddress = getInput($_POST, "useraddress", 40, $connection);
$usercard = getInput($_POST, "usercard", 40, $connection);
$password = getInput($_POST, "password", 40, $connection);

$error = 0;

if (authenticateSignUp($connection, $loginname, $useremail))
{
	
	$query = "SELECT max(userid) FROM user";
	$result = mysqli_query ($connection, $query);
	$row=mysqli_fetch_array($result);
	$userid = $row[0] + 1;
	$insertUser = "INSERT INTO user VALUES ({$userid}, '{$username}', '{$password}', '${loginname}','{$useremail}','${userstate}','{$usercity}','{$useraddress}','{$usercard}');";
	
	if (mysqli_query($con, $insertUser)) {
		$message = "Congratulate! Please go back to sign in.";
	} else {
		$message =  "Error: " . $sql . "<br>" . mysqli_error($conn);
		$error = 1;
	}
	$_POST=array();
	mysqli_close($con);
}
else
{
	$message = "sorry, you can not sign up because your username or email has been used or not in right format. Please change another one.";
	$error = 1;
	$_POST=array();
	mysqli_close($con);
}

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>sign up</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body >
<div class="jumbotron" style="font-size:110%;">
<?php
	echo $message;
	echo '<br></br>';
	if($error == 0)
		echo '<a href="login.html" class="btn btn-info btn-lg" role="button">Sign In Now</a>';
	else 
		echo '<a href="signup.html" class="btn btn-info btn-lg" role="button">Sign Up Again</a>';
?>


</div>
</body>
</html>