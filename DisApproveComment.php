<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php 
if(isset($_GET['id'])){
	$IdFromURL = $_GET['id'];
	$Query = "UPDATE comments SET status = 'OFF' WHERE id= '$IdFromURL'";
	$Execute = mysqli_query($Connection,$Query);
	if($Execute){
		$_SESSION['SuccessMessage']="Comment Dis-Approved Successfully";
		Redirect_to("Comments.php");
	}else{
		$_SESSION['ErrorMessage']="Something Went Wrong.Try Again";
		Redirect_to("Comments.php");
	}
}
 ?>

