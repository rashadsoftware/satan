<?php
    require "include/function.php";
    require "include/connectDB.php";
    session_start();

    $idUser=$_SESSION["id"];
    $user_list=mysqli_query($connect, "SELECT *  FROM users WHERE user_id='$idUser' ");
    $user=mysqli_fetch_array($user_list);
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Title & Favicon -->
<title>AdminLTE 3 | Log in</title>
<link rel="icon" type="image/png" href="img/AdminLTELogo.png"/>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
<!-- DataTables -->
<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="plugins/datatables/responsive.bootstrap4.css">
<!-- Theme style -->
<link rel="stylesheet" href="css/adminlte.min.css" />
<link rel="stylesheet" href="css/style1.css">

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>

<style>
    .preloader {
	width: 100%;
	height: 100vh;
	background-color: #fff;
	position: fixed;
	left: 0;
	top: 0;
	z-index: 10;
	opacity: 0.8;
	display: none;
    }
    .preloader img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -webkit-transform: translate(-50%, -50%);
        -moz-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
    }
    .overhidden {
        overflow: hidden;
    }
</style>