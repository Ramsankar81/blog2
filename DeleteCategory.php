<?php require_once("include/DB.php") ?>
<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php 
if(isset($_GET['id'])){
	$IdFromURL = $_GET['id'];
	$Query = "DELETE FROM category WHERE id= '$IdFromURL'";
	$Execute = mysqli_query($Connection,$Query);
	if($Execute){
		$_SESSION['SuccessMessage']="Comment Deleted Successfully";
		Redirect_to("Catagories.php");
	}else{
		$_SESSION['ErrorMessage']="Something Went Wrong.Try Again";
		Redirect_to("Catagories.php");
	}
}
 ?>

