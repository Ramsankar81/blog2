<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php Conform_Login(); ?>

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
						<li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
						<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
						<li><a href="Catagories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
						<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
						<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments
							<?php 
							 		$QueryTotalUnApproved = "SELECT COUNT(*) FROM comments WHERE  status = 'OFF'";
							 		$ExecuteTotalUnApproved = mysqli_query($Connection,$QueryTotalUnApproved);
							 		$RowsTotalUnApproved = mysqli_fetch_array($ExecuteTotalUnApproved);
							 		$TotalTotalUnApproved=array_shift($RowsTotalUnApproved);
							 		if($TotalTotalUnApproved>0){
							 		?>
							 		<span class="label pull-right label-Warning">
							 		<?php echo $TotalTotalUnApproved;?>
							 		</span>
							 	<?php } ?>
						</a></li>
						<li><a href="Blog.php?page=1" target="_blank">
							<span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<div><?php echo Message(); 
					echo  SuccessMessage()
					?></div>
					<h1>Admin Dashboard</h1>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>No</th>
								<th>Post Title</th>
								<th>Date  & TIme</th>
								<th>Auther</th>
								<th>Category</th>
								<th>Banner</th>
								<th>Comments</th>
								<th>Action</th>
								<th colspan="2">Details</th>
							</tr>
							<?php 
							$ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc";
							$Execute  = mysqli_query($Connection,$ViewQuery);
							$SrNo = 0;
							while($DataRows = mysqli_fetch_array($Execute)) {
								$Id  = $DataRows["id"];
								$DateTime  = $DataRows["datetime"];
								$Title  = $DataRows["title"];
								$Category  = $DataRows["category"];
								$Admin  = $DataRows["auther"];
								$Image  = $DataRows["image"];
								$Post  = $DataRows["post"];
								$SrNo++;


							 ?>
							 <tr>
							 	<td><?php echo $SrNo; ?></td>
							 	<td style="color: #5e5eff;"><?php
                                if(strlen($Title)>20){$Title = substr($Title,0,20)."..";}
							 	 echo $Title; ?></td>
							 	<td><?php 
                                 if(strlen($DateTime)>11){$DateTime = substr($DateTime,0,11)."..";}
							 	echo $DateTime; ?></td>
							 	<td><?php 
                                 if(strlen($Admin)>6){$Admin = substr($Admin,0,6)."..";}
							 	echo $Admin; ?></td>
							 	<td><?php 
							 	if(strlen($Category)>10){$Category = substr($Category,0,10)."..";}
							 	echo $Category; ?></td>
							 	<td><?php echo $Title; ?></td>
							 	<td><img src="Upload/<?php echo $Image; ?>" width="150px" height="50px"></td>
							 	<td>
							 		<?php 
							 		$QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id ='$Id' AND status = 'ON'";
							 		$ExecuteApprove = mysqli_query($Connection,$QueryApproved);
							 		$RowsApprove = mysqli_fetch_array($ExecuteApprove);
							 		$TotalApprove=array_shift($RowsApprove);
							 		if($TotalApprove>0){
							 		?>
							 		<span class="label pull-right label-success">
							 		<?php echo $TotalApprove;?>
							 		</span>
							 	<?php } ?>

							 	<?php 
							 		$QueryUnApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id ='$Id' AND status = 'OFF'";
							 		$ExecuteUnApprove = mysqli_query($Connection,$QueryUnApproved);
							 		$RowsUnApprove = mysqli_fetch_array($ExecuteUnApprove);
							 		$TotalUnApprove=array_shift($RowsUnApprove);
							 		if($TotalUnApprove>0){
							 		?>
							 		<span class="label  label-warning">
							 		<?php echo $TotalUnApprove;?>
							 		</span>
							 	<?php } ?>
							 	</td>
							 	<td><a href="EditPost.php?Edit=<?php echo $Id ?>"><span class="btn btn-warning">Edit</span></a>&nbsp;<a href="DeletePost.php?Delete=<?php echo $Id ?>"><span class="btn btn-danger">Delete</span></a></td>
							 	<td><a href="FullPost.php?id=<?php echo $Id; ?>" target ="_blank"><span class="btn btn-primary">Live Preview</span></a></td>

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