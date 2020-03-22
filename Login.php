<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php 
if(isset($_POST["Submit"])){
	 // $Category = mysqli_real_escape_string($_POST["Category"]);
	// date_default_timezone_set('Asia/Kolkata');
	// $CurrentTime = time();
	// $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
	// $DateTime;
	// if(empty($Category)){
	// 	$_SESSION["ErrorMessage"] = "All Fields must be filled out by admin";
	// 	Redirect_to("Catagories.php");

	// }
	// if(strlen($Category)>3){
	// 	$_SESSION["ErrorMessage"] = "name "
	// 	Redirect_to("Dashboard.php");
	// }
	// $Admin = "Ramsankar Hazra";
	$UserName=$_POST['UserName'];
	$Password=$_POST['Password'];
	if(empty($UserName)||empty($Password)){
		$_SESSION["ErrorMessage"] = "All field must be filled out";
		Redirect_to("Login.php");
	}else{
		 $Found_Account=Login_Attempt($UserName,$Password);
		 
		 if($Found_Account){
		 	$_SESSION["User_Id"]=$Found_Account['id'];
		 $_SESSION["Username"]=$Found_Account['username'];
         $_SESSION["SuccessMessage"] ="Welcome Back {$_SESSION['Username'] } :)";
         Redirect_to("Dashboard.php");
		 }else{
		 	$_SESSION["ErrorMessage"]="Invalid Email / Passoword";
		 	Redirect_to("Login.php");

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
body
{
	background-color: #ffffff;
}		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-sm-offset-4 col-sm-4">
					<br><br><br><br><br><br><br><br><br>
					<h2>Welcome Back !</h2>
					<div><?php echo Message(); 
					           echo SuccessMessage()
					     ?>	
					</div>
					<div>
						<form action="Login.php" method="post">
							<fieldset>
								<div class="form-group">
								<label for="username"><span class="FieldInfo">UserName:</span></label>
								<div class="input-group input-group-lg">
										<span class="input-group-addon ">
											<span class="glyphicon glyphicon-envelope text-primary"></span>
										</span>
								<input class="form-control" type="text" name="UserName" id="username" placeholder="UserName">
								</div>
								</div>
								<div class="form-group">
								<label for="password"><span class="FieldInfo">Password:</span></label>
								<div class="input-group input-group-lg">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-lock text-primary"></span>
										</span>
								<input class="form-control" type="Password" name="Password" id="password" placeholder="Password">
							</div>
								</div>
								<input class="btn btn-info form-control" type="Submit" value="Login"name="Submit">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
     
	</body>
</html>