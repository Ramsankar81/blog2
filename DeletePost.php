<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
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
	$Admin = "Ramsankar Hazra";
	$Image  = $_FILES["Image"]['name'];
	$Title=$_POST['Title'];
	$Category=$_POST['Category'];
	$Post=$_POST['Post'];
	$Target = "Upload/".basename($_FILES["Image"]["name"]);
		$DeleteFromURL = $_GET['Delete'];
		$Query = "Delete FROM admin_panel WHERE id = '$DeleteFromURL'";
		$Execute = mysqli_query($Connection,$Query);
		move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		 if($Execute){
		 $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
		 Redirect_to("Dashboard.php");
		 }else{
		$_SESSION['ErrorMessage'] = "Something went wrong.Try again !";
	    Redirect_to("Dashboard.php");
		 }

	}


 ?>

<html>
	<head>
		<title>Delete Post</title>
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
						<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
						<li><a href="#">
							<span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
					</ul>
				</div>
				<div class="col-sm-10">
					<h1>Delete Post</h1>
					<div><?php echo Message(); 
					           echo SuccessMessage()
					     ?>	
					</div>
					<div>
						<?php
						$SearchQueryParameter= $_GET['Delete'];
                         $Query = "SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
                         $ExecuteQuery = mysqli_query($Connection,$Query);
                         while ($DataRows = mysqli_fetch_array($ExecuteQuery)) {
                         	$TitleToBeUpdated = $DataRows['title'];
                         	$CategoryToBeUpdated = $DataRows['category'];
                         	$ImageToBeUpdated = $DataRows['image'];
                         	$PostToBeUpdated = $DataRows['post'];
                         }
						 ?>
						<form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
								<label for="title"><span class="FieldInfo">Title:</span></label>
								<input disabled value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
								</div>
								<div class="form-group">
									<span class="FieldInfo">Existing Category:</span>
									<?php echo $CategoryToBeUpdated; ?><br>
								<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
								<select disabled name="Category" id="categoryselect" class="form-control">
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
								<span class="Fieldinfo">Existing Image:</span>
								<img src="Upload/<?php echo $ImageToBeUpdated; ?>" width="150px" height="50px"><br>
								<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
								<input disabled type="file" class="form-control" id="imageselect" name="Image">
							</div>
							<div class="form-group">
								<label for="postarea"><span class="FieldInfo">Post:</span></label>
								<textarea disabled  name="Post" id="postarea" cols="30" rows="10" class="form-control">
									<?php echo $PostToBeUpdated; ?>
								</textarea>
							</div>
								<input class="btn btn-danger form-control" type="Submit" value="Delete Post"name="Submit">
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