<?php
session_start();
$conn =mysqli_connect("localhost","root","","project_demo")
or die("Connection failed: " . mysqli_connect_error());


$userid=$_SESSION["userid"];
$publicuserid=$_GET["userid"];

$result=mysqli_query($conn,"select * from user where userid='{$publicuserid}'");
$row=mysqli_fetch_assoc($result);

?>




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
							 <a>Account</a>
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
							<input type="text" class="form-control" size="50" name="keyword" placeholder="Search project you like"/>
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
			<dl>
				<dt>
					<font size=4 color='#404040'>Name</font>
				</dt>
				<dd>
					<?php
						echo $row["username"];
					?>
				</dd>
				<dt>
					<font size=4 color='#404040'>Loginname</font>
				</dt>
				<dd>
					<?php
						echo $row["loginname"];
					?>
				</dd>
				<dt>
					<font size=4 color='#404040'>Email</font>
				</dt>
				<dd>
					<?php
						echo $row["useremail"];
					?>
				</dd>
				<dt>
					<font size=4 color='#404040'>Address</font>
				</dt>
				<dd>
					<?php
						echo $row["usercity"]."<br>".$row["userstate"];
					?>
				</dd>
			</dl>

			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-4 column">
			<h2>
				<font color="grey">Follows</font>
			</h2>
			<p>
			<?php


				$userfollows=mysqli_query($conn,"select userid,username from user natural join (select followedid as userid from follow natural join user where userid='{$userid}')as followed");
				if(mysqli_num_rows($userfollows)>0){
					
					echo"<table  width=300>";
					while($row=mysqli_fetch_assoc($userfollows)){
						echo "<tr><td><a href=publicprofile.php?userid={$row['userid']}>"."<font size=4 color='#404040'>".$row['username']."</font></a><td></tr>";
					}
					echo"</table>";
     			}else{
     				echo "You have no follow.";
     			}


			?>
			</p>
		</div>
		<div class="col-md-4 column">
			<h2>
				<font color="grey">Likes</font>
			</h2>
			<p>
			<?php
				
				$userid=1;

				$userlikes=mysqli_query($conn,"select projid,projname,userid,username from user natural join (select projid,projname,project.userid from project join `likes` using (projid) where `likes`.userid='{$userid}')as likess");
				if(mysqli_num_rows($userlikes)>0){
					
					echo"<table  width=300>";
					while($row=mysqli_fetch_assoc($userlikes)){
						echo "<tr><td><a href=projectProfile.php?userid={$row['projid']}>"."<font size=4 color='#404040'>".$row['projname']."</font></a>"."&nbsp;<a href=publicprofile.php?userid={$row['userid']}><font size=2 color='#606060'>".$row['username']."</font></a>"."<td></tr>";
					}
					echo"</table>";
     			}else{
     				echo "You have no like.";
     			}
				
			?>
			</p>
		</div>
		<div class="col-md-4 column">
			<h2>
				<font color="grey">Projects</font>
			</h2>
			<p>
			<?php
			$userprojects=mysqli_query($conn,"select projid, projname from project where userid='{$publicuserid}'");
				if(mysqli_num_rows($userprojects)>0){
					
					echo"<table  width=300>";
					while($row=mysqli_fetch_assoc($userprojects)){
						echo "<tr><td><a href=projectProfile.php?projid={$row['projid']}>"."<font size=4 color='#404040'>".$row['projname']."</font></a>"."<td></tr>";
					}
					echo"</table>";
     			}else{
     				echo "You have no like.";
     			}



			?>
			
		</div>
	</div>
</div>