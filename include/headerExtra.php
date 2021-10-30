<?php
    error_reporting(0);
	include("include/connectDB.php"); 
	include("include/function.php");
	$company_list=mysqli_query($connect, "SELECT *  FROM companies WHERE company_status='main' ");
	$company=mysqli_fetch_array($company_list);

	$configs_list=mysqli_query($connect, "SELECT *  FROM configs ");
	$configs=mysqli_fetch_array($configs_list);
?>
<!DOCTYPE html>
<html lang="az">
    <head>
        <!-- Meta tags -->
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="author" content="Rashad Alakbarov, 0558215673">
		<meta name="google-site-verification" content="0Or9agMpN1VESn6-jhxSJIyKkMHDFmIyQndYzJSUBR8" />
		<meta name="description" content="Pulsuz elanlar saytı">
		<meta name="keywords" content="pulsuz elanlar, elanlar, bedava, pulsuz, elan, elanlar, yeni elanlar, avtomobil, daşınmaz əmlak">
		<meta http-equiv="refresh" content="1800">
		<meta name="revisit-after" content="1 days">
		<meta data-rh=”true” id=”meta-description” name=”description” content="Pulsuz Elan Yerləşdir - Maşın, Mənzil, Telefon, Geyim, Məişət texnikası...">
      
      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9366558760713626"
     crossorigin="anonymous"></script>
      
		<!-- Facebook Tags -->
		<?php
			$uri10=$_SERVER['REQUEST_URI']; // get http uri
			$explodeUri10=end(explode("/", $uri10));  // convert from string to array

			$newExplode10=strstr($explodeUri10, "width=174?");
			$newExplode210=strstr($explodeUri10, "?fbclid=");

			if($newExplode10){
				$newExplodeNew10=strstr($explodeUri10, "width=174?", true);
				$IDElan2=end(explode("-", $newExplodeNew10));
			} else if($newExplode210){
				$newExplodeNew10=strstr($explodeUri10, "?fbclid=", true);
				$IDElan2=end(explode("-", $newExplodeNew10));
			} else {
				$IDElan2=end(explode("-", $explodeUri10));
			} 

			$selectId=mysqli_query($connect,"SELECT * FROM img WHERE elan_id='".$IDElan2."'");
			$fetchArrayFacebook=mysqli_fetch_array($selectId);  
		?>

		<!-- Open Graph -->	
		<meta property="og:image" content="https://satan.az/img/advert/<?php  echo $fetchArrayFacebook['img_path']; ?>" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="../plugin/fontawesome-free-5.15.2/css/all.css" />
		<!-- OwlCarousel2-2.3.4 CSS -->
		<link rel="stylesheet" href="../plugin/OwlCarousel2-2.3.4/owl.carousel.css" />
		<link rel="stylesheet" href="../plugin/OwlCarousel2-2.3.4/owl.theme.default.css" />
		<!-- Swiper CSS -->
		<link rel="stylesheet" href="../plugin/swiper/swiper-bundle.css"/>
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="../plugin/fancybox/jquery.fancybox.css"/>
		<!-- summernote css -->
		<link rel="stylesheet" href="../plugin/summernote/summernote-lite.css"/>
		<!-- main CSS -->
		<link rel="stylesheet" type="text/css" media="screen" href="../css/style2.php">

		<!-- Title & Logo -->
		<title><?php echo $company['company_name']; ?> | Pulsuz Elanlar Saytı</title>
		<link rel="shortcut icon" type="image/jpg" href="../img/<?php echo $company['company_favicon']; ?>" />

		<!-- Jquery JS -->
		<script src="../js/jquery-3.6.0.js"></script>
		<!-- Bootstrap JS -->
		<script src="../js/bootstrap.js"></script>
    </head>
    <body class="position-relative">
		<div class="scrollUp">
			<i class="fas fa-arrow-up"></i>
		</div>
		<header id="headerID">
            <div class="container">
                <div class="navbar-container">
					<div class="menu-bars"><i class="fas fa-bars"></i></div>
					<a href="../index" class="brand">
						<img src="../img/<?php echo $company['company_logo']; ?>" alt="<?php echo $company['company_name']; ?>">
					</a>
					<div class="button-container">						
						<a href="../bookmark" class="heart"><i class="far fa-heart"></i></a>
						<a href="../add" class="btn btn-success ctmBorder" style="background:var(--main-color); border:1px solid var(--main-color)">
							<i class="fas fa-plus"></i>
							<span class="add-button mr-2">Elan yarat</span>
						</a>
					</div>
				</div>
				<div class="search-container">
					<form class="d-flex" action="../search" method="post" autocomplete="off">
						<div class="form-group search-form">
							<input type="text" class="form-control" placeholder="Nümunə, Samsung A7" name="search" value="<?php echo $search_text; ?>"/>
							<i class="fas fa-search"></i>	
						</div>						
					</form>
				</div>				
            </div>
        </header>
		<section id="head-section" style="padding-bottom:10px">
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