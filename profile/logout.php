<?php
	session_start();
	error_reporting(0);

	include("../assets/include/connectDB.php");
	
	session_destroy();
	header("Location:index");
	
	mysqli_close($connect);
?>