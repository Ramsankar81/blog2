<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>

<html>
	<head>
		<title>CMS</title>
		<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/adminStyle.css">
		<style>
			.navbar-nav li{
				font-weight: bold;
				font-family: Bitter.Georgia,Times,"Times New Roman",serif;
				font-size: 1.2em;
			}
			.line{
			 margin-top: -20px;
			}
		</style>
	</head>
	<body>
		<div style="height: 10px; background: #27AAA1"></div>
		<nav class="navbar navbar-inverse " role="navigating">
			<div class="container">
				<div class="navbar-header ">
					<button class="navbar-toggle collapsed" data-toggle="collapse" data-target ="#collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="Blog.php">
						<img src="IMG/logo.png"  width="200" height="20">
					</a>
				</div>
				<div class="collapse navbar-collapse" id="collapse">
				<ul class="nav navbar-nav">
					<li ><a href="#">Home</a></li>
					<li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Services</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Feature</a></li>
				</ul>
				<form action="Blog.php" class="navbar-form navbar-right">
					 <div class="form-group">
					 	<input type="text" class="form-control" placeholder="Search" name="Search">
					 </div>
					 <button class="btn btn-default" name="SearchButton">Go</button>
				</form>
				</div>
			</div>
		</nav>
		<div class="line" style="height: 10px; background: #27AAA1"></div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<br><br>
					<ul class="nav nav-pills nav-stacked">
						<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
						<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
						<li><a href="Catagories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
						<li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<div><?php echo Message(); 
					echo  SuccessMessage()
					?></div>
					<h1>Un-Approved Comments</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Date</th>
								<th>Comment</th>
								<th>Approve</th>
								<th>Delete Comment</th>
								<th>Details</th>
							</tr>
							<?php 
                            $Query  = "SELECT * FROM comments WHERE status='OFF' ORDER BY  datetime desc";
                            $Execute =mysqli_query($Connection,$Query);
                            $SrNo = 0;
                            while($DataRows = mysqli_fetch_array($Execute)){
                            	$CommentId = $DataRows['id'];
                            	$DateTimeOfComment = $DataRows['datetime'];
                            	$PersonName = $DataRows['name'];
                            	$PersonComment=$DataRows['comment'];
                            	$CommentedPostId = $DataRows['admin_panel_id'];
                            $SrNo++;
							 ?>
							 <tr>
							 	<td><?php echo  $SrNo; ?></td>
							 	<td style="color: #5e5eff;"><?php 
							 	if(strlen($PersonName)>10){$PersonName = substr($PersonName, 0,10).'..';}
							 	echo $PersonName; ?></td>
							 	<td><?php echo $DateTimeOfComment; ?></td>
							 	<td><?php
							 	if(strlen($PersonComment)>18){$PersonComment = substr($PersonComment, 0,18).'..';} 
							 	echo $PersonComment; ?></td>
							 	<td><a href="ApproveComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
							 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-danger">Delete Comment</span></a></td>
							 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
							 </tr>
<?php } ?>
						</table>
					</div>
<hr><br>
					<h1>Approved Comments</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No.</th>
								<th>Name</th>
								<th>Date</th>
								<th>Comment</th>
								<th>Approved By </th>
								<th>Revert Approve</th>
								<th>Delete Comment</th>
								<th>Details</th>
							</tr>
							<?php 
							// $Admin = $_SESSION["Username"];
                            $Query  = "SELECT * FROM comments WHERE status='ON' ORDER BY datetime desc";
                            $Execute =mysqli_query($Connection,$Query);
                            $SrNo = 0;
                            while($DataRows = mysqli_fetch_array($Execute)){
                            	$CommentId = $DataRows['id'];
                            	$DateTimeOfComment = $DataRows['datetime'];
                            	$PersonName = $DataRows['name'];
                            	$PersonComment=$DataRows['comment'];
                            	$Approvedby=$DataRows['approvedby'];
                            	$CommentedPostId = $DataRows['admin_panel_id'];
                            $SrNo++;
							 ?>
							 <tr>
							 	<td><?php echo  $SrNo; ?></td>
							 	<td style="color: #5e5eff;"><?php 
							 	if(strlen($PersonName)>10){$PersonName = substr($PersonName, 0,10).'..';}
							 	echo $PersonName; ?></td>
							 	<td><?php echo $DateTimeOfComment; ?></td>
							 	<td><?php
							 	if(strlen($PersonComment)>18){$PersonComment = substr($PersonComment, 0,18).'..';} 
							 	echo $PersonComment; ?></td>
							 	<td><?php echo $Approvedby; ?></td>
							 	<td><a href="DisApproveComment.php?id=<?php echo $CommentId; ?>"><span class="btn btn-warning">
							 	Dis-Approve</span></a></td>
							 	<td><a href="DeleteComments.php?id=<?php echo $CommentId; ?>" ><span class="btn btn-danger">Delete Comment</span></a></td>
							 	<td><a href="FullPost.php?id=<?php echo $CommentedPostId ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
							 </tr>
<?php } ?>
						</table>
					</div>
				</div>
			</div>
		</div>
     <div class="Footer">
     	<hr><p>Teme By | Ramsankar Hazra|&copy;2018-2020 --All Right Resorved.
      <a style="color: white; text-decoration: none; cursor: pointer; font-weight:bold;" href="http://jazebakram.com/coupons/" target="_blank">
		<p>This site is only used for Study purpose jazebakram.com have all the rights. no one is allow to distribute
		copies other then <br>&trade; jazebakram.com &trade;  Udemy ; &trade; Skillshare ; &trade; StackSkills</p><hr>
		</a>
     </div>
	</body>
</html>