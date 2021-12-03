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
		<link rel="stylesheet" type="text/css" media="screen" href="../css/style2.php">
		<link rel="stylesheet" type="text/css" media="screen" href="../assets/css/style4.css">
		<link rel="stylesheet" type="text/css" media="screen" href="../assets/css/responsive.css">

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
    <body class="position-relative">
		<div class="scrollUp">
			<i class="fas fa-arrow-up"></i>
		</div>
		<header id="headerID" style="top:0px">
            <div class="container">
                <div class="navbar-container">
					<div class="menu-bars"><i class="fas fa-bars"></i></div>
					<a href="index" class="brand">
						<img src="../img/<?php echo $data['company_logo']; ?>" alt="<?php echo $data['company_name']; ?>">
					</a>
					<div class="button-container">						
						<a href="../bookmark" class="heart"><i class="far fa-heart"></i></a>
						<a href="../profile/index" class="heart"><i class="fas fa-user-circle"></i></a>
						<a href="../add" class="btn btn-success ctmBorder" style="background:var(--main-color); border:1px solid var(--main-color)">
							<i class="fas fa-plus"></i>
							<span class="add-button mr-2">Elan yarat</span>
						</a>
					</div>
				</div>
				<div class="search-container">
					<form class="d-flex" action="search" method="post" autocomplete="off">
						<div class="form-group search-form">
							<input type="text" class="form-control" placeholder="Nümunə, Samsung A7" name="search" value="<?php echo $search_text; ?>"/>
							<i class="fas fa-search"></i>	
						</div>						
					</form>
				</div>				
            </div>
        </header>
		<section id="head-section" style="padding-bottom:10px; padding-top:160px">
			<div class="container">
				<div class="category-container">
					<?php
						$categorieslist=mysqli_query($connect, "SELECT *  FROM categories");
						while($categories=mysqli_fetch_array($categorieslist)){ ?>
							<div class="cat-item">
								<a href="../category/<?php echo $categories['category_seflink'] ?>">
									<img src="../img/categories/<?php echo $categories['category_image'] ?>" alt="">
									<?php echo $categories['category_title'] ?>
								</a>
							</div>
					<?php }
					?>
				</div>
			</div>
		</section>