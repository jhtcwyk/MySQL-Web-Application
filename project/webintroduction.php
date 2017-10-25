<?php


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
							 <a href="create_project.php">New Project</a>
						</li>
						<li>
							 <a href="logout.php">Logout</a>
						</li>
					</ul>
				</div>

				
			</nav>
			<dl>
				<dt>
					Posting Project and Tag 
				</dt>
				<dd>
					Every user can post project, and they should supply several necessary information. What is optional for project owner is that they can choose whether to post some samples and tags for their project when they first create it. In this design, schema has a tag table, so it allows multi-tag.  
				</dd>
				<dd><br>
					Every project has a status attribute, which can be “funding”, “doing”, “failed” or “finished”. When the project is first posted, its status is set to “funding”. What happens next is that once either the maximum amount of funds is raised or the end date of the campaign arrives, the fundraising campaign is over and the status needs to be changed. In the first case, we set status to “doing”, which means that the project owner will start doing their project, even though in fact they might have already started. In the second case, if the minimum amount of funds is raised, then we set status to “doing”, otherwise “failed”, which literally means that funding campaign for this project has failed.
				</dd>
				<dt><br>
					Pledge and Charge 
				</dt>
				<dd>
					Only when the fundraising campaign succeeds, the pledges will be charged from sponsor the release them to project owner. If the campaign fails, the sponsors keep the pledged money. When the pledge is charged, am transaction will be insert into the charge table with the pledgeid and charge time. 
				</dd>
				<dt><br>
					Updating Project and Commenting 
				</dt>
				<dd>
					After successfully funding their project, project owner will then work (off-line) on the project. During this process, they may periodically post updates and new materials to the project page. In this application, only the project owner can post multimedia materials to server. So, the proj_update is a separated table. Users can keep discussing the project by using comment which just support storage of text. 
				</dd>
				<dt><br>
					Project Completion and Rating 
				</dt>
				<dd>
					At some point, owners will declare the project to be completed. At this point, the sponsors will be asked to rate the project, based on the posted materials or other information and of course they can delay rating to the future or simply choose not to rate. 
				</dd>
			</dl>
		</div>
	</div>
</div>