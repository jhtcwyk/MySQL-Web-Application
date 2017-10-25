<?php

$conn = mysqli_connect("localhost","root","","project_demo")
or die("Connection failed: " . mysqli_connect_error());
session_start();
$keyword=mysqli_real_escape_string($conn, $_POST["keyword"]);
$userid=$_SESSION["userid"];
date_default_timezone_set('America/New_York');
$time = date('Y-m-d H:i:s');

if(!empty($label)){
	mysqli_query($conn,"insert into history_tag values ('{$userid}','{$label}','{$time}')")
	or die("SQL Failed");
}
if(!empty($keyword)){
	mysqli_query($conn,"insert into history_keyword values ('{$userid}','{$keyword}','{$time}')")
	or die("SQL Failed");
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
						<h2>
							<font color="grey">search by name</font>
						</h2>
						<p>
							


							<table class="table">

							<?php
							$searchByName=mysqli_query($conn,"select * from project natural join user where projname like '%{$keyword}%'")
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
							if(mysqli_num_rows($searchByName)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($searchByName)){
										break;
									}
									echo "<tr class='warning'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByName)){
										break;
									}
									echo "<tr class='success'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByName)){
										break;
									}
									echo "<tr class='info'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByName)){
										break;
									}
									echo "<tr class='error'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
								}
							}else{
								echo "No results.";
							}

							?>
							</table>

						</p>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<div class="jumbotron">
						<h2>
							<font color="grey">search by tag</font>
						</h2>
						<p>
							<table class="table">
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
							$searchByTag=mysqli_query($conn,"select * from project natural join user where projid in (select projid from tag where label like '%{$keyword}%')")
							or die("SQL Failed");
							if(mysqli_num_rows($searchByTag)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($searchByTag)){
										break;
									}
									echo "<tr class='success'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByTag)){
										break;
									}
									echo "<tr class='info'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";

									if(!$row=mysqli_fetch_assoc($searchByTag)){
										break;
									}
									echo "<tr class='warning'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";

									if(!$row=mysqli_fetch_assoc($searchByTag)){
										break;
									}
									echo "<tr class='error'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
								}
							}else{
								echo "No results.";
							}

							?>
							</table>
						</p>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<div class="jumbotron">
						<h2>
							<font color="grey">search by description</font>
						</h2>
						<p>
							<table class="table">
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
							$searchByDescription=mysqli_query($conn,"select * from project natural join user where description like '%{$keyword}%'")
							or die("SQL Failed");
							if(mysqli_num_rows($searchByDescription)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($searchByDescription)){
										break;
									}
									echo "<tr class='info'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByDescription)){
										break;
									}
									echo "<tr class='success'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByDescription)){
										break;
									}
									echo "<tr class='warning'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
									if(!$row=mysqli_fetch_assoc($searchByDescription)){
										break;
									}
									echo "<tr class='error'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></a></td><td><font size=3 color='grey'>".htmlspecialchars($row['description'])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["status"]."</tr>";
								}
							}else{
								echo "No results.";
							}
							?>
							</table>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>