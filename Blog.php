<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<html>
	<head>
		<title>CMS</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/publicStyle.css">
		<style>
			/*.col-sm-8{
				background-color: #39B1D9;
			}*/
			/*.col-sm-3{
				background-color: #F73A66;
			}*/
			.imgicon{
				max-width: 150px;
				margin: 0 auto;
				display: block;
			}
			#heading{
				font-family: Bitter,Georgia,"Times New Roman",Times,serif;
				font-weight: bold;
				color: #005E90;
				font-size: 18px;
			}
			#heading:hover{
				color: #0090DB;
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
			<div class="row">
				<div class="col-sm-8">
					<?php 
					if(isset($_GET["SearchButton"])){
						$Search = $_GET["Search"];
						$ViewQuery = "SELECT *FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%' ORDER BY datetime desc";
					}
					//category is active
					elseif (isset($_GET["Category"])) {
						$Category = $_GET["Category"];
						$ViewQuery = "SELECT * FROM admin_panel WHERE category = '$Category' ORDER BY id desc";

					}
					elseif (isset($_GET['page'])) {
						# Pagination
						$Page=$_GET['page'];
						if($Page==0||$Page<1){
							$ShowPostFrom=0;

						}else{
						$ShowPostFrom=($Page*5)-5;
						// echo $ShowPostFrom;
						}
						$ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom,5";

					}
					else{
					$ViewQuery = "SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";}
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
					 		<p id="description">Category:<?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime); ?>
					 			
					 			<?php 
							 		$QueryApproved = "SELECT COUNT(*) FROM comments WHERE admin_panel_id ='$PostId' AND status = 'ON'";
							 		$ExecuteApprove = mysqli_query($Connection,$QueryApproved);
							 		$RowsApprove = mysqli_fetch_array($ExecuteApprove);
							 		$TotalApprove=array_shift($RowsApprove);
							 		if($TotalApprove>0){
							 		?>
							 		<span class="badge pull-right ">Comments:
							 		<?php echo $TotalApprove;?>
							 		</span>
							 	<?php } ?>

					 		</p>
					 		<p id="post"><?php 
					 		if(strlen($Post)>150){$Post =substr($Post,0,150).'...';}
					 		echo $Post; 
					 		?></p>
					 	</div>
					 	<a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info" id="info">Read More &rsaquo;&rsaquo;</span></a>
					 </div>
					<?php } ?>
					 <nav>
					 	<ul class="pagination pull-left pagination-lg">

					 		<?php
					 		if(isset($Page)){
					 		 if($Page>1){
					 			?>
					 			<li><a href="Blog.php?page=<?php echo $Page-1 ?>">&laquo;</a></li>
					 		<?php } }?>

					 		
					<?php 
					$QueryPagination = "SELECT COUNT(*) FROM admin_panel";
					$ExecutePagination = mysqli_query($Connection,$QueryPagination);
					$RowPagnation = mysqli_fetch_array($ExecutePagination);
					$TotalPost = array_shift($RowPagnation);
					// echo $TotalPost;
					$PostPerPage =ceil( $TotalPost/5);
					// echo $PostPerPage;
					for($i=1;$i<=$PostPerPage;$i++){
						if(isset($Page)){
						if($i==$Page){
							?>
								<li class="active"><a href="Blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
							<?php
						}else{?>
							<li><a href="Blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
						<?php
					}

							} } ?>
							<?php
					 		if(isset($Page)){
					 		 if($Page<$PostPerPage){
					 			?>
					 			<li><a href="Blog.php?page=<?php echo $Page+1 ?>">&raquo;</a></li>
					 		<?php } }?>

						</ul>
					</nav>
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
							$ViewCategoryQuery= "SELECT * FROM category ORDER BY datetime desc ";
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