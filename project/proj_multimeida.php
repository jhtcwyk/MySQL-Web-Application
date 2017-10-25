<?php
	$projid = $_GET["projid"];
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>Upload Multimmedia Files</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body >
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="loginpage.php">HOME</a>


				</div>
				

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active">
							 <a >Account</a>
						</li>
						<li>
							 <a href="userprofile.php">Profile</a>
						</li>
						<li>
							 <a href="history.php">History</a>
						</li>
					</ul>
				<div>

					<form class="navbar-form navbar-left" role="search" action="searchresult.php" method="post">
						<div class="form-group">
							<input type="text" class="form-control" name="keyword" placeholder="Search project you like"/>
						</div> <button type="submit"  class="btn btn-default"><font color="grey">search</font></button>
					</form>
					
					<ul class="nav navbar-nav navbar-right">
						<li>
							 <a href="rate.php">Rate</a>
						</li>
						<li>
							 <a href="create_project.html">New Project</a>
						</li>
						<li>
							 <a href="logout.php">Logout</a>
						</li>
					</ul>
				</div>

				
			</nav>
			<center><h3>
				Add To Your Project And Upload Multimedia Files
			</center></h3>
			<div class="jumbotron" style="font-size:110%;">
			<center>
			<form method="POST" action="insert_multimedia.php" enctype="multipart/form-data">
			
			<?php echo '<input type="hidden" name = "projid" value='. "'{$projid}'". '>'; ?>
			
			<table>
			<tr><td>Enter the project tag:</td></tr>
			<tr><td><input type="text" size="20" name="label"></td></tr>
			<tr><td>You can add image to show your idea (*.jpg, *.png)</tr></td>
			<tr><td><input type="file" name="proj_image"></tr></td>
			<tr><td>You can add video to show your idea (*.mp4)</tr></td>
			<tr><td><input type="file" name="proj_video"></tr></td>
			</table>
			
			<br></br>
			<button class="btn btn-info btn-lg" type="submit">Upload</button>
			<button class="btn btn-info btn-lg" type="reset">Reset</button>
			</form>
			<br></br>
			<?php
				echo '<a href="projectProfile.php?projid='.$projid.'" class="btn btn-info btn-lg" role="button">View Your New Project</a>';
			?>
			</center>
			</div>
		</div>
	</div>
</div>
</body>
</html>
			
			
			
			
			