<?php
	session_start();
	error_reporting(0);

	include("include/connectDB.php");
	
	if($_SESSION["entry_status"] =="admin"){
		mysqli_query($connect,"UPDATE users SET user_login='close' WHERE user_login ='open' AND user_email='".$_SESSION['user_email']."' ");

		session_destroy();
		header("Location:index");
	} else {
		header("Location:index");
	}
	
	mysqli_close($connect);
?>