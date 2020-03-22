<?php require_once("include/Session.php") ?>
<?php require_once("include/Functions.php") ?>
<?php 
$_SESSION["User_Id"]=null;
session_destroy();
// $_SESSION["SuccessMessage"]="Logout Successfully, Visit Again";
Redirect_to("Login.php");



 ?>