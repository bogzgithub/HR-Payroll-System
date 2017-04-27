<?php
session_start();
include "../class/connect.php";
include "../class/log_in.php";

// for security purpose
// if set success 
if (isset($_POST["username"]) && isset($_POST["password"])){
	
	$username = $_POST["username"];
	$password = $_POST["password"];

	// class for log in
	$log_in = new Login;
	$exist = $log_in->setLogin($username,$password);


	
	// failed
	if ($exist == 0){
		$_SESSION["failed_log_in"] = "Invalid Username or Password";
		header("Location:../index.php");
	}

	// success
	else {
		$user_id = $log_in->LoginDetails($username,$password);
		$_SESSION["id"] = $user_id;
		$_SESSION["role"] = $log_in->getRole($user_id);
		echo $_SESSION["role"];
		header("Location:../MainForm.php");
	}

}
// if not set failed
else {
	$_SESSION["failed_log_in"] = "Invalid Username or Password";
	header("Location:../index.php");
}


?>