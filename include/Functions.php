

<?php 
function Redirect_to($New_Location){
	header('Location:'.$New_Location);
	exit;
}
function Login_Attempt($UserName,$Password){
	 $Connection = mysqli_connect('localhost','root','','cms') ;
	$ViewQuery = "SELECT *FROM registration WHERE username='$UserName' AND 
	password = '$Password'";
	$Execute = mysqli_query($Connection,$ViewQuery);
	if($admin=mysqli_fetch_assoc($Execute)){
		return $admin;
	}
	else{
		return null;
	}
}
function Login(){
	if(isset($_SESSION["User_Id"])){
		return true;
	}
}
function Conform_Login(){
	if(!Login()){
		$_SESSION["ErrorMessage"]="Login Required";
		Redirect_to("Login.php");
	}
}


?>
