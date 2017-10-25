<?php

session_start();
require 'authentication.inc';
sessionAuthenticate();
$conn = mysqli_connect("localhost","root","","project_demo")
or die("Connection failed: " . mysqli_connect_error());

$userid=$_SESSION["userid"];

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
						<li>
							 <a >Account</a>
						</li>
						<li>
							 <a href="userprofile.php">Profile</a>
						</li>
						<li class="active">
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
							<font color="grey">Project</font>
						</h2>
						<p>
							


							<table class="table">

							<?php
							$projhistory=mysqli_query($conn,"select projname,projid,username,userid,viewtime from user natural join (select projid,project.userid,projname,viewtime from project join (select * from history_proj where userid='{$userid}')as temp using (projid))as temp1")
							or die("SQL Failed");

							?>
								<thead>
									<tr>
										<th>
											Project name
										</th>
										<th>
											Creator
										</th>
										<th>
											Time
										</th>
									</tr>
								</thead>
							<?php
							if(mysqli_num_rows($projhistory)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($projhistory)){
										break;
									}
									echo "<tr class='warning'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["viewtime"]."</tr>";
									if(!$row=mysqli_fetch_assoc($projhistory)){
										break;
									}
									echo "<tr class='success'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["viewtime"]."</tr>";
									if(!$row=mysqli_fetch_assoc($projhistory)){
										break;
									}
									echo "<tr class='info'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["viewtime"]."</tr>";
									if(!$row=mysqli_fetch_assoc($projhistory)){
										break;
									}
									echo "<tr class='error'><td><a href='projectProfile.php?projid={$row['projid']}'><font size=5 color=#606060>".htmlspecialchars($row["projname"])."</font></td><td><a href='publicprofile.php?userid={$row['userid']}'><font size=4 color=#606060>".htmlspecialchars($row["username"])."</font></a></td><td>".$row["viewtime"]."</tr>";
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
							<font color="grey">Tag</font>
						</h2>
						<p>
							<table class="table">
								<thead>
									<tr>
										<th>
											Tag
										</th>
										<th>
											Time
										</th>
									</tr>
								</thead>
							

							<?php
							$taghistory=mysqli_query($conn,"select * from history_tag where userid='{$userid}'")
							or die("SQL Failed");
							if(mysqli_num_rows($taghistory)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($taghistory)){
										break;
									}
									echo "<tr class='success'><td><a href='#'><font size=5 color=#606060>".htmlspecialchars($row["label"])."</font></a></td><td><font size=3 color='grey'>".$row['viewtime']."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($taghistory)){
										break;
									}
									echo "<tr class='info'><td><a href='#'><font size=5 color=#606060>".htmlspecialchars($row["label"])."</font></a></td><td><font size=3 color='grey'>".$row['viewtime']."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($taghistory)){
										break;
									}
									echo "<tr class='warning'><td><a href='#'><font size=5 color=#606060>".htmlspecialchars($row["label"])."</font></a></td><td><font size=3 color='grey'>".$row['viewtime']."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($taghistory)){
										break;
									}
									echo "<tr class='error'><td><a href='#'><font size=5 color=#606060>".htmlspecialchars($row["label"])."</font></a></td><td><font size=3 color='grey'>".$row['viewtime']."</font></td></tr>";
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
							<font color="grey">Keyword</font>
						</h2>
						<p>
							<table class="table">
								<thead>
									<tr>
										<th>
											keywork
										</th>
										<th>
											Time
										</th>
									</tr>
								</thead>
							<?php
							$keywordhistory=mysqli_query($conn,"select * from history_keyword where userid='{$userid}'")
							or die("SQL Failed");
							if(mysqli_num_rows($keywordhistory)>0){
								while(true){
									if(!$row=mysqli_fetch_assoc($keywordhistory)){
										break;
									}
									echo "<tr class='info'><td><a href='searchresult1.php?keyword={$row['keyword']}'><font size=5 color=#606060>".htmlspecialchars($row["keyword"])."</font></a></td><td><font size=4 color=#606060>".$row["viewtime"]."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($keywordhistory)){
										break;
									}
									echo "<tr class='success'><td><a href='searchresult1.php?keyword={$row['keyword']}'><font size=5 color=#606060>".htmlspecialchars($row["keyword"])."</font></a></td><td><font size=4 color=#606060>".$row["viewtime"]."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($keywordhistory)){
										break;
									}
									echo "<tr class='warning'><td><a href='searchresult1.php?keyword={$row['keyword']}'><font size=5 color=#606060>".htmlspecialchars($row["keyword"])."</font></a></td><td><font size=4 color=#606060>".$row["viewtime"]."</font></td></tr>";
									if(!$row=mysqli_fetch_assoc($keywordhistory)){
										break;
									}
									echo "<tr class='error'><td><a href='searchresult1.php?keyword={$row['keyword']}'><font size=5 color=#606060>".htmlspecialchars($row["keyword"])."</font></a></td><td><font size=4 color=#606060>".$row["viewtime"]."</font></td></tr>";
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