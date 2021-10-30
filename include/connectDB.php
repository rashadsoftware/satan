<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db="elanlar";
	
	// Create connection
	$connect = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Change character set to utf8
	mysqli_set_charset($connect,"utf8");
?>