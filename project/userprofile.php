<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<?php
session_start();
	require 'authentication.inc';
	sessionAuthenticate();

$connection = $conn =mysqli_connect("localhost","root","","project_demo")
or die("Connection failed: " . mysqli_connect_error());

$userid=$_SESSION["userid"];



$newusername= mysqli_real_escape_string($connection,$_POST["username"]);
$newpassword= mysqli_real_escape_string($connection,$_POST["password"]);
$newloginname=mysqli_real_escape_string($connection, $_POST["loginname"]);
$newuseremail=mysqli_real_escape_string($connection,$_POST["useremail"]);
$newuserstate=mysqli_real_escape_string($connection,$_POST["userstate"]);
$newusercity=mysqli_real_escape_string($connection,$_POST["usercity"]);
$newuseraddress=mysqli_real_escape_string($connection,$_POST["useraddress"]);
$newusercard=mysqli_real_escape_string($connection,$_POST["usercard"]);

if(!empty($newusername)){
	mysqli_query($conn,"update `user` set username='{$newusername}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newpassword)){
	mysqli_query($conn,"update `user` set password='{$newpassword}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newloginname)){
	mysqli_query($conn,"update `user` set loginname='{$newloginname}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newuseremail)){
	mysqli_query($conn,"update `user` set useremail='{$newuseremail}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newuserstate)){
	mysqli_query($conn,"update `user` set userstate='{$newuserstate}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newusercity)){
	mysqli_query($conn,"update `user` set usercity='{$newusercity}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newuseraddress)){
	mysqli_query($conn,"update `user` set useraddress='{$newuseraddress}' where userid='{$userid}'")
	or die("SQL Failed");
}
if(!empty($newusercard)){
	mysqli_query($conn,"update `user` set usercard='{$newusercard}' where userid='{$userid}'")
	or die("SQL Failed");
}


$userprofile=mysqli_query($conn,"select * from user where userid='{$userid}'")
or die("SQL Failed");
$row=mysqli_fetch_assoc($userprofile);


?>


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
						<li class="active">
							 <a href="#">Profile</a>
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
							 <a href="#">New Project</a>
						</li>
						<li>
							 <a href="logout.php">Logout</a>
						</li>
					</ul>
				</div>

				
			</nav>


			<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>
					Attention!
				</h4> <strong>Warning!</strong>Best log out before you leave your computer.<a href="logout.php" class="alert-link">Log out!</a>
			</div>


			
			<?php
				//first part
				$number=32;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>UserID</label>";
				echo "<table>";
				echo "<tr><td>";
				$number=45;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".$row["userid"]."</font></td></tr>";
	     	 	echo "</table>";

				$number=26;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Username</label>";
				echo "<table>";
				echo "<tr><td>";
				$number=45;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["username"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>
			<br>
			<form class="form-horizontal" action="userprofile.php" role="form" method="post"> 

				<div class="form-group">
				 	
					 <label for="inputPassword3" class="col-sm-2 control-label">New Username</label>
					 
					<div class="col-sm-10">
						<input type="text" class="form-control" name="username" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
				</div>

			<?php
				$number=30;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Password</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=48;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".$row["password"]."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>

				</div>
				<div class="form-group">
					 <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="password" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
					</div>
				</div>

			</form>



			<?php
				//second part

				$number=24;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Loginname</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=45;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["loginname"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>
			<br>
			<form class="form-horizontal" role="form" method="post" action="userprofile.php"> 

				<div class="form-group">
				 	
					 <label for="inputEmail3" class="col-sm-2 control-label">New Loginname</label>
					 
					<div class="col-sm-10">
						<input type="text" class="form-control" name="loginname" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
				</div>
			<?php
				$number=37;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Email</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=48;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["useremail"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>

				</div>
				<div class="form-group">
					 <label for="inputPassword3" class="col-sm-2 control-label">New Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="useremail" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
					</div>
				</div>

			</form>


			<?php
				//third part

				$number=34;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>State</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=45;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["userstate"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>
			<br>
			<form class="form-horizontal" role="form" method="post" action="userprofile.php"> 

				<div class="form-group">
				 	
					 <label for="inputEmail3" class="col-sm-2 control-label">New State</label>
					 
					<div class="col-sm-10">
						<input type="text" class="form-control" name="userstate" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
				</div>
			<?php
				$number=40;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>City</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=48;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["usercity"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>

				</div>
				<div class="form-group">
					 <label for="inputPassword3" class="col-sm-2 control-label">New City</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="usercity" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
					</div>
				</div>

			</form>


			<?php
				//forth part

				$number=29;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Address</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=45;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["useraddress"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>
			<br>
			<form class="form-horizontal" role="form" method="post" action="userprofile.php"> 

				<div class="form-group">
				 	
					 <label for="inputEmail3" class="col-sm-2 control-label">New Address</label>
					 
					<div class="col-sm-10">
						<input type="text" class="form-control" name="useraddress" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
				</div>
			<?php
				$number=39;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
				echo "<label>Card</label>";
				echo "<table>";
				echo "<tr><td>";
				
				$number=48;
	     	 	while($number>1){
	     	 		echo "&nbsp;";
	     	 		$number-=1;
	     	 	}
	     	 	echo "<font size=4 color='#606060'>".htmlspecialchars($row["usercard"])."</font></td></tr>";
	     	 	echo "</table>";

	     	 ?>

				</div>
				<div class="form-group">
					 <label for="inputPassword3" class="col-sm-2 control-label">New Card</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="usercard" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						 <button type="submit" class="btn btn-default">Save</button>
					</div>
				</div>

			</form>


		
		</div>
	</div>
</div>