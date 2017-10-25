<?php
	session_start();
	//require 'authentication.inc';
	//$userid = $_SESSION["userid"];
	
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
		
	$projid = $_POST["projid"];

	$error = 0;
	if(!empty($_POST["label"])){
		$label = mysqli_real_escape_string($connection, $_POST["label"]);
		$insert_tag = "insert into tag values ('{$projid}','{$label}')";
		if(!mysqli_query($con, $insert_tag)){
			$error = 1;
			$message .= "Error: " . "<br>" . mysqli_error($con);
		}
	}

		
		
		
		if(!empty($_FILES['proj_image']['tmp_name'])){
			$imagecontent=addslashes(file_get_contents($_FILES['proj_image']['tmp_name']));
			
			$select_imageid = "select max(imageid) from proj_image where projid = '{$projid}'";
			$result = mysqli_query($connection, $select_imageid);
			
			if(empty($result)) $imageid = 0;
			else{
				$row=mysqli_fetch_array($result);
				$imageid = $row[0] + 1;
			}
			
			
			$insert_image = "insert into proj_image values ('{$projid}', '{$imageid}', '{$imagecontent}')";
			if(mysqli_query($con, $insert_image)){
				echo  "Congratulate! Please go back to see it.";
			} else {
				$error = 1;
				echo "Error: " . "<br>" . mysqli_error($con);
			}
		}
		
		if(!empty($_FILES['proj_video']['name'])){
			$videoname=mysqli_real_escape_string($connection, $_FILES['proj_video']['name']);
			$insert_video = "insert into proj_video values ('{$projid}', '{$videoname}')";
			if(mysqli_query($con, $insert_video)){
				echo  "Congratulate! Please go back to see it.";
			} else {
				$error = 1;
				echo "Error: " . "<br>" . mysqli_error($con);
			}
		}


	$_POST=array();

	mysqli_close($con);
	if($error == 0) header('location: '.$_SERVER['HTTP_REFERER']);;
?>