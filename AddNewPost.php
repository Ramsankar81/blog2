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
	$Admin = $_SESSION["Username"];
	$Image  = $_FILES["Image"]['name'];
	$Title=$_POST['Title'];
	$Category=$_POST['Category'];
	$Post=$_POST['Post'];
	$Target = "Upload/".basename($_FILES["Image"]["name"]);
	if(empty($Title)){
		$_SESSION["ErrorMessage"] = "Title can't be empty";
		Redirect_to("AddNewPost.php");
	}elseif(strlen($Title)<2){
	   $_SESSION['ErrorMessage'] = "Title should be at-least 2 Character";
	   Redirect_to("AddNewPost.php");
		
	}else{
		$Query = "INSERT INTO admin_panel(datetime,title,category,auther,image,post) 
		VALUES ('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
		$Execute = mysqli_query($Connection,$Query);
		move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		 if($Execute){
		 $_SESSION["SuccessMessage"] = "Post Added Successfully";
		 Redirect_to("AddNewPost.php");
		 }else{
		$_SESSION['ErrorMessage'] = "Something went wrong.Try again !";
	    Redirect_to("AddNewPost.php");
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
						<li class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
						<li ><a href="Catagories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
						<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
						<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
						<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<h1>Add New Post</h1>
					<div><?php echo Message(); 
					           echo SuccessMessage()
					     ?>	
					</div>
					<div>
						<form action="AddNewPost.php" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
								</div>
								<div class="form-group">
								<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
								<select name="Category" id="categoryselect" class="form-control">
						<?php
                            $ViewQuery = "SELECT *FROM category ORDER BY datetime desc";
                            $Execut = mysqli_query($Connection,$ViewQuery);
                            while ($DataRows = mysqli_fetch_array($Execut)) {
                            	$Id = $DataRows["id"];
                            	$Categoryname = $DataRows["name"];
                            	 ?>
                            	 <option><?php echo $Categoryname; ?></option>
                            	<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
								<input type="file" class="form-control" id="imageselect" name="Image">
							</div>
							<div class="form-group">
								<label for="postarea"><span class="FieldInfo">Post:</span></label>
								<textarea name="Post" id="postarea" cols="30" rows="10" class="form-control"></textarea>
							</div>
								<input class="btn btn-primary form-control" type="Submit" value="Add New Post"name="Submit">
							</fieldset>
						</form>
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