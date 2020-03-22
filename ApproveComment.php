<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php 
if(isset($_GET['id'])){
	$IdFromURL = $_GET['id'];
	$Admin = $_SESSION["Username"];
	$Query = "UPDATE comments SET status = 'ON' ,approvedby='$Admin' WHERE id= '$IdFromURL'";
	$Execute = mysqli_query($Connection,$Query);
	if($Execute){
		$_SESSION['SuccessMessage']="Comment Approved Successfully";
		Redirect_to("Comments.php");
	}else{
		$_SESSION['ErrorMessage']="Something Went Wrong.Try Again";
		Redirect_to("Comments.php");
	}
}
 ?>

