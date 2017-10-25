<?php
	session_start();

	$userid = $_SESSION["userid"];
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	
	$projname = mysqli_real_escape_string($connection, $_POST["projname"]);
	$description = mysqli_real_escape_string($connection, $_POST["description"]);
	$max = $_POST["max"]; $min = $_POST["min"];
	$endtime = $_POST["endtime"];
	$planned_finished_time = $_POST["planned_finished_time"];
	$now = date("Y-m-d H:i:s");
	//if(!empty($_FILES['proj_image']['tmp_name']))
		
	
	
	$get_projid = "select max(projid) from project";
	$result = mysqli_query($con, $get_projid);
	$row=mysqli_fetch_array($result);
	$projid = $row[0] + 1;
	
	
	
	//$get_imageid = "select max(imageid) from proj_image where projid = '{$projid}'";
	$error = 0;
	$message = "";
	if($max > $min && $now   <  $endtime  && $endtime  < $planned_finished_time){
		
		$create_profile = "insert into project values ('{$projid}', '{$projname}', '{$description}', '{$min}', '{$max}', '{$endtime}', '{$planned_finished_time}', '{$now}', '{$userid}', 'funding')";	
		if(!mysqli_query($con, $create_profile)){
			$error = 1;
			$message .= "Error: " . "<br>" . mysqli_error($con);
		}
		
		
	}
	else {
		$error = 1;
		$message .= "Please check your input";
	}
	$_POST=array();

	mysqli_close($con);
	if($error == 0) header("location:http://localhost/project/proj_multimeida.php?projid={$projid}");
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>New Project</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="jumbotron" style="font-size:110%;">
<?php
	echo $message;
	echo '<br></br>';

	echo '<a href="create_project.html" class="btn btn-info btn-lg" role="button">Create Again</a>';

?>
</div>
</body>
</html>