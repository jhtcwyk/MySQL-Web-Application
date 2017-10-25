<?php
session_start();
$conn = mysqli_connect("localhost","root","","project_demo")
or die("Connection failed: " . mysqli_connect_error());
$userid=$_SESSION["userid"];
date_default_timezone_set('America/New_York');

$projname=$_POST["projname"];
$rate=$_POST["rate"];
$time = date('Y-m-d H:i:s');
if(!empty($rate)&&!empty($projname)){    
	$findprojid=mysqli_query($conn,"select projid from project where projname='{$projname}'")
	or die("SQL Failed");
	if(mysqli_num_rows($findprojid)>0){
		//update
		$row=mysqli_fetch_assoc($findprojid);
		$projid=$row["projid"];
		mysqli_query($conn,"INSERT INTO rate VALUES ('$userid', '{$projid}', '{$time}','{$rate}')") or die("SQL Failed");;
	}else{  // wrong projname
		echo "Failed to rate.No corresponding project name.";
	}
}
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
			<div class="row clearfix">
				<div class="col-md-12 column">
					<div class="jumbotron">
						<p>
							


							<table class="table">

							<?php
							$ratable=mysqli_query($conn,"select * from project natural join (select projid from pledge natural join charge where userid='{$userid}')as temp natural join user where status='finished' and projid not in (select projid from rate where rate.userid='{$userid}')")
							or die("SQL Failed");

							?>
								<thead>
									<tr>
										<th>
											Project name
										</th>
										<th>
											Description
										</th>
										<th>
											Creator
										</th>
										<th>
											Status
										</th>
									</tr>
								</thead>
							<?php
							if(mysqli_num_rows($ratable)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($ratable)){
										break;
									}
									echo "<tr class='warning'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</td>";
									if(!$row=mysqli_fetch_assoc($ratable)){
										break;
									}
									echo "<tr class='success'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</td>";
									if(!$row=mysqli_fetch_assoc($ratable)){
										break;
									}
									echo "<tr class='info'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</td>";
									if(!$row=mysqli_fetch_assoc($ratable)){
										break;
									}
									echo "<tr class='error'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</td>";
								}
							}else{
								echo "No results.";
							}

							?>
							</table>

							<form class="form-horizontal" role="form" action="rate.php" method="post">
								<div class="form-group">
									 <label for="inputPassword3" class="col-sm-2 control-label">Project name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="projname"/>
									</div>
								</div>
								<div class="form-group">
									 <label for="inputPassword3" class="col-sm-2 control-label">Your rate</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" name="rate" min = "1"/>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										 <button type="submit" class="btn btn-default">Rate</button>
									</div>
								</div>
							</form>




						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>