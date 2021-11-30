<?php
	include("../assets/include/connectDB.php");
	include("../assets/include/function.php");
	$query=mysqli_query($connect,"SELECT * FROM companies WHERE company_id='1' ");
	$data=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="az">
    <head>
        <!-- Meta tags -->
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Rashad Alakbarov, 0558215673">
		<meta name="google-site-verification" content="0Or9agMpN1VESn6-jhxSJIyKkMHDFmIyQndYzJSUBR8" />
		<meta name="description" content="Pulsuz elanlar saytı">
		<meta name="keywords" content="pulsuz elanlar, elanlar, bedava, pulsuz, elan, elanlar, yeni elanlar, avtomobil, daşınmaz əmlak">
		<meta http-equiv="refresh" content="1800">
		<meta name="revisit-after" content="1 days">
		<meta data-rh="true" id="meta-description" name="description" content="Pulsuz Elan Yerləşdir - Maşın, Mənzil, Telefon, Geyim, Məişət texnikası...">
		

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="../assets/plugin/fontawesome-free-5.15.2/css/all.css" />
		<!-- Montserrat fonts include -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- main CSS -->
		<link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style1.css">

		<!-- Title & Logo -->
		<title><?php echo $data['company_name'] ?> | qeydiyyat</title>
		<link rel="shortcut icon" type="image/jpg" href="../img/<?php echo $data['company_favicon'] ?>" />

		<!-- Jquery JS -->
		<script src="../assets/js/jquery-3.6.0.js"></script>
		<!-- Bootstrap JS -->
		<script src="../assets/js/bootstrap.js"></script>

        <style>
            .form-control:focus {
                box-shadow: none;
            }
        </style>
    </head>
    <body>