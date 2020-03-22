<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php Conform_Login(); ?>
<?php 
if(isset($_POST["Submit"])){
	 // $Category = mysqli_real_escape_string($_POST["Category"]);
	date_default_timezone_set('Asia/Kolkata');
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	$DateTime;
	// if(empty($Category)){
	// 	$_SESSION["ErrorMessage"] = "All Fields must be filled out by admin";
	// 	Redirect_to("Catagories.php");

	// }
	// if(strlen($Category)>3){
	// 	$_SESSION["ErrorMessage"] = "name "
	// 	Redirect_to("Dashboard.php");
	// }
	$Admin = $_SESSION['Username'];
	$UserName=$_POST['UserName'];
	$Password=$_POST['Password'];
	$ConformPassword=$_POST['ConformPassword'];
	if(empty($UserName)||empty($Password)||empty($ConformPassword)){
		$_SESSION["ErrorMessage"] = "All field must be filled out";
		Redirect_to("Admins.php");
	}elseif($Password!==$ConformPassword){
	   $_SESSION['ErrorMessage'] = "Password / ConformPassword does not match ";
	   Redirect_to("Admins.php");
		
	}else{
		$Query = "INSERT INTO registration(datetime,username,password,addedby) 
		VALUES ('$DateTime','$UserName','$Password','$Admin')";
		$Execute = mysqli_query($Connection,$Query);
		 if($Execute){
		 $_SESSION["SuccessMessage"] = "Admin Added Successfully";
		 Redirect_to("Admins.php");
		 }else{
		$_SESSION['ErrorMessage'] = "Admin failed to add";
	    Redirect_to("Admins.php");
		 }

	}

}
 ?>

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
			.fieldInfo{
				color: rgb(251,174,44);
				font-family: Bitter,Georgia,"Times New Roman",Times,serif;
				font-size: 1.2em;
}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
					<h1>Ram</h1>
					<ul class="nav nav-pills nav-stacked">
						<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
						<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
						<li ><a href="Catagories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
						<li class="active"><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
						<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<h1>Manage Admin Access</h1>
					<div><?php echo Message(); 
					           echo SuccessMessage()
					     ?>	
					</div>
					<div>
						<form action="Admins.php" method="post">
							<fieldset>
								<div class="form-group">
								<label for="username"><span class="FieldInfo">UserName:</span></label>
								<input class="form-control" type="text" name="UserName" id="username" placeholder="UserName">
								</div>
								<div class="form-group">
								<label for="password"><span class="FieldInfo">Password:</span></label>
								<input class="form-control" type="Password" name="Password" id="password" placeholder="Password">
								</div>
								<div class="form-group">
								<label for="conformpassword"><span class="FieldInfo">Conform Password:</span></label>
								<input class="form-control" type="Password" name="ConformPassword" id="conformpassword" placeholder="Conform Password">
								</div>
								<input class="btn btn-success form-control" type="Submit" value="Add New Admin"name="Submit">
							</fieldset>
						</form>
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tr>
								<th>Sr. No</th>
								<th>Date & Time</th>
								<th>Username</th>
								<th>Password</th>
								<th>Created By</th>
								<th>Action</th>
							</tr>
							<?php
                            $ViewQuery = "SELECT *FROM registration ORDER BY datetime desc";
                            $Execut = mysqli_query($Connection,$ViewQuery);
                            $SrNo = 0;
                            while ($DataRows = mysqli_fetch_array($Execut)) {
                            	$Id = $DataRows["id"];
                            	$DateTime = $DataRows["datetime"];
                            	$Username = $DataRows["username"];
                            	$Password = $DataRows["password"];
                            	$Addedby=$DataRows["addedby"];
                            	$SrNo++;

                            

							 ?>
							 <tr>
							 	<td><?php echo $SrNo; ?></td>
							 	<td><?php echo $DateTime; ?></td>
							 	<td><?php echo $Username; ?></td>
							 	<td><?php echo $Password; ?></td>
							 	<td><?php echo $Addedby?></td>
							 	<td><a href="DeleteAdmin.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a></td>
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