<?php

	session_start();
	require 'authentication.inc';
	sessionAuthenticate();
	if (!$connection = $con = mysqli_connect("localhost","root","","project_demo"))
	die("Cannot connect");
	$userid = $_SESSION["userid"];
	$projid = $_GET["projid"];
	
	date_default_timezone_set('America/New_York');
	$time = date('Y-m-d H:i:s');
	if(!empty($projid)){
		mysqli_query($con,"insert into history_proj values ('{$userid}','{$projid}','{$time}')")
		or die("SQL Failed");
	}
	
	
	
	
	
	$query = "select * from project where projid = {$projid}";
	$result = mysqli_query ($connection, $query);
	$row=mysqli_fetch_assoc($result);
	$projname = htmlspecialchars($row["projname"]);
	$description = htmlspecialchars($row["description"]);
	$status = $row["status"];
	$max = $row["max"];
	$min = $row["min"];
	$createtime = $row["createtime"]; 
	$endtime = $row["endtime"];
	$planned_finished_time = $row["planned_finished_time"];
	$projownerid = $row["userid"];
	
	$check_like = "select * from likes where userid = '{$userid}' and projid = '{$projid}'";
	$result = mysqli_query($connection, $check_like);
	if(mysqli_num_rows($result)>0)
		$liked = 1;
	else
		$liked = 0;
	
	if($status == "finished"){
		$select_rate = "select avg(rate) from rate where projid = '{$projid}'";
		$result = mysqli_query($connection, $select_rate);
		$row=mysqli_fetch_array($result);
		$rate = $row[0];
		if(empty($rate)) $rate = 5;
	}
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8"> 
   <title>project profile</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
			<div class="jumbotron">
			<h1>
				<?php
					echo $projname;
				?>
			</h1>
			<h3>
			Tag:&nbsp;
				<?php
					$select_tag = "select label from tag where projid = '{$projid}'";
					$result = mysqli_query($connection, $select_tag);
					while($row=mysqli_fetch_array($result)){
						echo '<a href="taglink.php?label='.$row[0].'">'.$row[0].'</a>&nbsp;&nbsp;';
					}
				?>
			</h3>
			<?php
			if($status == "finished"){
				echo '<h2> Rate: ';
				echo $rate;
				echo '</h2>';
			}
				
			?>
			
			<?php 
				echo '<form method="get" action="project_like.php">';
				echo '<input type="hidden" name = "projid" value='. "'{$projid}'". '>';
				echo '<input type="hidden" name = "liked" value='. "'{$liked}'". '>';
				if($liked < 1) echo '<button class="btn btn-info btn-lg" type="submit">like</button>';
				if($liked >= 1) echo '<button class="btn btn-info btn-lg" type="submit">dislike</button>';
				echo '</form>';
			
			?>
			<br></br>
			</div>

			<div class="tabbable" id="tabs-111111">
				<ul class="nav nav-tabs">
					<li class="active">
						 <a href="#panel-111111" data-toggle="tab">Project Description</a>
					</li>
					<li>
						 <a href="#panel-222222" data-toggle="tab">Project Updates</a>
					</li>
					<li>
						 <a href="#panel-333333" data-toggle="tab">User Comments</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-111111">
						<ul style="font-family:verdana; font-size:120%;" >
							<li>
								<p>
									<strong>Project Owner: </strong>
									<?php 
										$get_username = "select * from user where userid  = {$projownerid}";
										$result = mysqli_query ($connection, $get_username);
										$row=mysqli_fetch_assoc($result);
										$projownername = htmlspecialchars($row["username"]);
										echo '<a href="publicprofile.php?userid='.$projownerid.'">'.$projownername.'</a> ';
										
									?>
								</p>
							</li>

							<li>
								<strong>Project Process: </strong>
								<p><ul>
									<li>
										Project Create Time: <?php echo " ".$createtime;?> 
									</li>
									<li>
										Funding End Time: <?php echo " ".$endtime;?> 
									</li>
									<li>
										Planned Finished Time: <?php echo " ".$planned_finished_time;?> 
									</li>
								</ul></p>
							</li>
							<li>
								<p>
								<strong>Project Status: </strong>
								<?php echo " ".$status;?>
								</p>
							</li>
							<li>
								<strong>Funding Status: </strong>
								<p><ul>
									<li>
										Max:<?php echo " ".$max?>
									</li>
									<li>
										Min:<?php echo " ".$min?>
									</li>
									<li>
										Current Amount:
										<?php 
											$get_pledge_amount = "select sum(amount) as amount from pledge where projid = {$projid}";
											$result = mysqli_query ($connection, $get_pledge_amount);
											$row=mysqli_fetch_assoc($result);
											$currentamount = $row["amount"];
											echo " ".$currentamount
										?>
									</li>
								</ul></p>
								
							</li>
							<li>
								<p>
									<strong>Project Description: </strong>
									<?php echo " ".$description; ?>
								</p>
							</li>
							<li>
								<p>
									<strong>Project Images: </strong>
									<br></br>
									<?php 
										$select_image="select * from proj_image where projid='{$projid}' order by imageid asc";
										$result = mysqli_query($connection, $select_image);
										while($row = mysqli_fetch_array($result)){
											echo '<img src="data:image/jpeg;base64,' . base64_encode($row["imagecontent"]) . '"style="width:300px;height:256px;" />';
											echo '<br></br>';
										}
									?>
								</p>
							</li>
							
							<li>
								<p>
									<strong>Project Videos: </strong>
									<br></br>
									<?php 
										$select_video="select * from proj_video where projid='{$projid}'";
										$result = mysqli_query($connection, $select_video);
										$path = 'video\\';
										while($row = mysqli_fetch_array($result)){
											echo '<video width="400" controls><source src="' . $path.$row["videoname"] . '"type="video/mp4">Your browser does not support HTML5 video.</video>';
											echo '<br></br>';
										}
									?>
								</p>
							</li>

						</ul>
						<?php
							if($status == "funding"){
							echo '<form method="POST" action="post_pledge.php">
								<input type="number" size="20" name="pledge_amount" min="1" required> 
								<input type="hidden" name = "projid" value='. "'{$projid}'". '>
								<br></br>
								
								<button class="btn btn-info btn-lg" type="submit">Pledge!!!</button>
								<button class="btn btn-info btn-lg" type="reset">Reset</button>
								
							</form>';
							}
						?>
						
					</div>
					<div class="tab-pane" id="panel-222222">
							<?php 
								$count = 0;	
								$select_update="select * from proj_update where projid='{$projid}' order by updatetime desc";
								$result = mysqli_query($connection, $select_update);
								while($row = mysqli_fetch_array($result)){
									if($count % 2 == 0)
										echo '<div style="background-color:#B6B7C8;padding:20px;font-size:130%;width:1145px;">';
									else
										echo '<div style="background-color:white;padding:20px;font-size:130%;width:1145px;">';	
									
									
									echo 'Update Time: '.$row["updatetime"];
									echo '</br>'.'<hr style=" height:2px;border:none;border-top:2px dotted black;" />'.'</br>';
									echo htmlspecialchars($row["context"]);
									echo '<br></br>';
									if(!empty($row["image"]))
									echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '"style="width:150px;height:128px;" />';
									echo '</div>';
									$count++;
								}
								
							?>
							<?php 
							if($userid == $projownerid){
								echo '<br></br>';
								echo '<form method="POST" action="post_update.php" enctype="multipart/form-data">';
								echo '<input type="hidden" name = "projid" value= ' ."'{$projid}'".'>';
								echo'<textarea name="update_text" rows="10" cols="100" required></textarea></br>
									You can add one image here (*.jpg, *png)</br>
									<input type="file" name="update_image">
									<br></br>
									<button class="btn btn-info btn-lg" type="submit">Update</button>
									<button class="btn btn-info btn-lg" type="reset">Reset</button>
								</form>';
							}
							?>
					</div>
					<div class="tab-pane" id="panel-333333">

							<?php 
								$count = 0;	
								$select_comment="select * from comment where projid='{$projid}' order by commenttime desc";
								$result = mysqli_query($connection, $select_comment);
								while($row = mysqli_fetch_array($result)){
									if($count % 2 == 0)
										echo '<div style="background-color:#B6B7C8;padding:20px;font-size:130%;width:1145px;">';
									else
										echo '<div style="background-color:white;padding:20px;font-size:130%;width:1145px;">';	
									
									$select_username="select username from user where userid='{$row["userid"]}'";
									$var = mysqli_query($connection, $select_username);
									$r = mysqli_fetch_array($var);
									$poster = htmlspecialchars($r["username"]);
									
									echo 'User: '.'<a href="publicprofile.php?userid='.$row["userid"].'">'.$poster.'</a> '.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.' Comment Time: '.$row["commenttime"];
									echo '</br>'.'<hr style=" height:2px;border:none;border-top:2px dotted black;" />'.'</br>';
									echo htmlspecialchars($row["context"]);
									echo '<br></br>';
									
									echo '</div>';
									$count++;
								}
								
							?>
							<br></br>
							<form method="POST" action="post_comment.php">
								<input type="hidden" name = "projid" value= <?php echo "'{$projid}'"; ?>>
								<textarea name="comment_message" rows="10" cols="100" required></textarea> 
								<br></br>
								<button class="btn btn-info btn-lg" type="submit">Post Comment</button>
								<button class="btn btn-info btn-lg" type="reset">Reset</button>
							</form>
							

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>