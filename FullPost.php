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
	$PostId = $_GET['id'];
	$Name=$_POST['Name'];
	$Email=$_POST['Email'];
	$Comment=$_POST['Comment'];
	if(empty($Name)||empty($Email)||empty($Comment)){
		$_SESSION["ErrorMessage"] = "All Fields are required";
	}elseif(strlen($Comment)>500){
	   $_SESSION['ErrorMessage'] = "Only 500 character are allowed";
		
	}else{
		$PostIDFromUrl =$_GET['id'];
		$Query = "INSERT INTO comments (datetime,name,email,comment,approvedby,status,admin_panel_id)
		VALUES ('$DateTime','$Name','$Email','$Comment','pending','OFF','$PostIDFromUrl')";
		$Execute = mysqli_query($Connection,$Query);
		
		 if($Execute){
		 $_SESSION["SuccessMessage"] = "Comment Submitted Successfully";
		 Redirect_to("FullPost.php?id={$PostId}");
		 }else{
		$_SESSION['ErrorMessage'] = "Something went wrong.Try again !";
	     Redirect_to("FullPost.php?id={$PostId}");
		 }

	}

}
 ?>
<html>
	<head>
		<title>Full Blog Post</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicStyle.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
		<link rel="stylesheet" href="css/social.css">
		<!-- <link rel="stylesheet" href="css/style.css"> -->
		<style>
			/*.col-sm-8{
				background-color: #39B1D9;
			}*/
			/*.col-sm-3{
				background-color: #F73A66;
			}*/
              .fieldInfo{
				color: rgb(251,174,44);
				font-family: Bitter,Georgia,"Times New Roman",Times,serif;
				font-size: 1.2em;
			}
			.CommentBlock{
				background-color: #F6F7F9;

			}
			.Comment-Info{
				color: #365899;
				font-family: sans-serif;
				font-size: 1.1em;
				font-weight: bold;
				padding-top: 10px;
			}
			.description{
				color: #868686;
				font-weight: bold;
				margin-top: -2px;
			}
			.Comment{
				margin-top: -2px;
				padding-bottom: 10px;
				font-size: 1.1em;
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
					<li class="active"><a href="#">Blog</a></li>
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
		<div class="container">
			<div class="blog-header">
				<h1>The Complete Responsive CMS Blog </h1>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo eligendi voluptate, itaque rerum sunt. Aliquam dolorem pariatur ut officiis corporis quos vel deleniti nesciunt, dolorum voluptatibus. Voluptatibus illum velit, consequuntur.</p>
			</div>
			 <div><?php echo Message(); 
					           echo SuccessMessage()
					     ?>	
					</div>
			<div class="row">
				<div class="col-sm-8">
					<?php 
					if(isset($_GET["SearchButton"])){
						$Search = $_GET["Search"];
						$ViewQuery = "SELECT *FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ORDER BY datetime desc";
					}else{
                    $PostIDFromURL = $_GET["id"];
					$ViewQuery = "SELECT * FROM admin_panel WHERE id='$PostIDFromURL' ORDER BY datetime desc";}
					$Execute = mysqli_query($Connection,$ViewQuery);
					while($DataRows = mysqli_fetch_array($Execute)) {
						$PostId = $DataRows["id"];
						$DateTime = $DataRows["datetime"];
						$Title = $DataRows["title"];
						$Category = $DataRows["category"];
						$Admin = $DataRows["auther"];
						$Image = $DataRows["image"];
						$Post = $DataRows["post"];

				

					 ?>
					 <div class="blogpost thumbnail">
					 	<img class= "img-responsive img-rounded" src="Upload/<?php echo $Image; ?> ">
					 	<div class="caption">
					 		<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
					 		<p id="description">Category:<?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime); ?></p>
					 		<p id="post"><?php 
					 		// if(strlen($Post)>150){$Post =substr($Post,0,150).'...';}
					 		echo nl2br($Post); 
					 		?></p>
					 	</div>
					 	<!-- <a href="FullPost.php?id= <?php echo $PostId; ?>"><span class="btn btn-info" id="info">Read More &rsaquo;&rsaquo;</span></a> -->
					 </div>
					<?php } ?>
					<br><br>
					<div>
						<ul class="social-icons icon-rounded list-unstyled list-inline"> 
					      <li> <a href="http://www.facebook.com/sharer.php?u=http://munu.ga" target="_blank"><i class="fa fa-facebook"></i></a></li>  
					      <li> <a href="http://twitter.com/share?text=An intersting blog&url=http://localhost/php%20cms/FullPost.php?id=10" target="_blank"><i class="fa fa-twitter"></i></a></li> 
					      <li> <a href=""><i class="fa fa-linkedin"></i></a></li>
					      <li> <a href="https://plus.google.com/share?url=http://localhost/php%20cms/FullPost.php?id=10"><i class="fa fa-google-plus"></i></a></li>
					       <li> <a href="#"><i class="fa fa-pinterest"></i></a></li> 

					  	</ul>
					</div>
					<br><br>
                   <span class="FieldInfo">Comments</span>
                   <?php 
                $PostIdForComment = $_GET['id'];
                $ExtractingCommentQuery = "SELECT * FROM comments WHERE admin_panel_id= '$PostIdForComment' AND status = 'ON' ORDER BY datetime desc ";
                $Execute= mysqli_query($Connection,$ExtractingCommentQuery);
                while($DataRows = mysqli_fetch_array($Execute)){
                	$CommentDate = $DataRows['datetime'];
                	$CommenterName= $DataRows['name'];
                	$CommentByUsers = $DataRows['comment'];
            

                    ?>
                    <div class="CommentBlock">
                    	<img style="margin-left: 10px;margin-top: 10px;" class="pull-left" src="IMG/comment.png" height="100px" width="100px">
                    	<p style="margin-left: 90px;" class="Comment-Info"><?php echo $CommenterName; ?></p>
                    	<p style="margin-left: 90px;"  class="description"><?php echo $CommentDate; ?></p>
                    	<p style="margin-left: 90px;"  class="Comment"><?php echo nl2br($CommentByUsers); ?></p>
                    	<br>
                    </div>
                    <hr>
                <?php } ?>
                   <br>
                   <span class="FieldInfo">Share your thought about this Post</span>
					<div>
						<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="form-group">
								<label for="name"><span class="FieldInfo">Name:</span></label>
								<input class="form-control" type="text" name="Name" id="name" placeholder="Name">
								</div>
								<div class="form-group">
								<label for="email"><span class="FieldInfo">Email:</span></label>
								<input class="form-control" type="text" name="Email" id="email" placeholder="Email">
								</div>
							<div class="form-group">
								<label for="commentarea"><span class="FieldInfo">Comment:</span></label>
								<textarea name="Comment" id="commentarea" cols="10" rows="10" class="form-control"></textarea>
							</div>
								<input class="btn btn-primary " type="Submit" value="Submit"name="Submit">
							</fieldset>
						</form>
					</div>
				</div>
				<div class="col-sm-offset-1 col-sm-3">
					<h2>About Me</h2>
					<img class="img img-responsive img-circle imgicon" src="IMG/comment.png" alt="" >
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi ex ducimus omnis, repellendus molestias, fugit dolores harum accusantium provident voluptates recusandae corrupti deleniti! Architecto dolore qui dolores magnam nulla accusantium?</p>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h2 class="panel-title">Categories</h2>
						</div>
						<div class="panle-body">
							<?php 
							$ViewCategoryQuery= "SELECT * FROM category ORDER BY datetime desc";
							$ExecuteCategory = mysqli_query($Connection,$ViewCategoryQuery);
							while($CategoryDataRows = mysqli_fetch_array($ExecuteCategory)){
								$CategoryId = $CategoryDataRows['id'];
								$ViewCategory = $CategoryDataRows['name'];
							
							 ?>
							 <a href="Blog.php?Category=<?php echo $ViewCategory; ?>"><span id="heading"><?php echo $ViewCategory."<br>"; ?></span></a>
							<?php } ?>
						</div>
						<div class="panel-footer">
							

						</div>
					</div>
					<hr>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h2 class="panel-title">Recent Post</h2>
						</div>
						<div class="panle-body">
							<?php 
							$Query = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,8";
							$Execute = mysqli_query($Connection,$Query);
							while($DataRows = mysqli_fetch_array($Execute)) {
								$Id = $DataRows['id'];
								$Title = $DataRows['title'];
								$DateTime = $DataRows['datetime'];
								$Image = $DataRows['image'];
								// if(strlen($DateTime)>11){$DateTime = substr($DateTime, 0,11);}
							 ?>
                          <div >
                          	<img class="pull-left" style="margin-top: 10px; margin-left: 10px;" src="Upload/<?php echo $Image;?>" width=70px; height=50px; >
                          	<a style="text-decoration: none;" href="FullPost.php?id=<?php echo $Id; ?>">
                          	<p  style="margin-left: 90px; margin-top: 5px;"><?php echo htmlentities($Title); ?></p>
                          	</a>
                          	<!-- <p style="margin-left: 90px;"><?php echo htmlentities($DateTime); ?></p> -->
                          	<br><br>
                          </div>

						<?php } ?>
						</div>
						<div class="panel-footer">
							

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>