<?php
    error_reporting(0);

	include("include/connectDB.php"); 
	include("include/function.php");
	
	$company_list=mysqli_query($connect, "SELECT *  FROM companies WHERE company_status='main' ");
	$company=mysqli_fetch_array($company_list);

	// count deadline ===================================> 
	date_default_timezone_set("Asia/Baku");
	$nowTime=time();  // current time
	$arrayTimePUsh=[];
	 
	$deadline_list_one=mysqli_query($connect, "SELECT *  FROM deadline "); // change timestamp to unix time
	while($deadline_one=mysqli_fetch_array($deadline_list_one)){

		$unixElanTime=strtotime($deadline_one["deadline_time"]);
		$idDeadlineElan=$deadline_one["elan_id"];

		if($nowTime > $unixElanTime){
			array_push($arrayTimePUsh, $idDeadlineElan); 
		}
	} 
	$countDeadlineHeader=count($arrayTimePUsh);

	foreach($arrayTimePUsh as $idElan){
		$itemElanTImeOut=mysqli_query($connect,"UPDATE elan SET elan_status='deactive' WHERE elan_id = '$idElan'");

		if($itemElanTImeOut){
			mysqli_query($connect,"UPDATE forward SET forward_status='passive' WHERE elanID = '$idElan'");
		}
	}

	// zaman bitibse vip elanlari viplikden cixarma
	$all_vip_elan_header=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='vip' AND forward_status='active' ");
    while($elan_vip_header=mysqli_fetch_array($all_vip_elan_header)){
        $elanID_header=$elan_vip_header["elanID"];
		$elanTime_header=$elan_vip_header["forward_time"];
		$elan_forwardValue_header=$elan_vip_header["forward_value"];

		$now=date("d", strtotime($nowTime));
		$elanTime=date("d", strtotime($elanTime_header));
		
		$diff=$now-$elanTime;
		
		if($diff == $elan_forwardValue_header){
			mysqli_query($connect,"UPDATE forward SET forward_status='passive' WHERE elanID = '$elanID_header' AND forward_key='vip' ");	
		}		
    }

	// zaman bitibse forward elanlari forwarddan cixarma
	$timeWeb=date('Y-m-d H:i:s', $nowTime);
    $TimeNowHours=date("H", $nowTime);
    $TimeNowMinute=date("i", $nowTime);

	$all_forward_elan_header=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='forward' AND forward_status='active' ");
	while($elan_forward_header=mysqli_fetch_array($all_forward_elan_header)){
        $elanID_Forward=$elan_forward_header["elanID"];
        $elanID_Forward_repeat=$elan_forward_header["forward_value"];

        for($g=1; $g < $elanID_Forward_repeat; $g++){
            $elanTime_Forward=strtotime($elan_forward_header["forward_start_time"])+$g*(6*3600);
			$NewTimeHours=date("H", $elanTime_Forward);
            $NewTimeMinute=date("i", $elanTime_Forward);
        
            if(($TimeNowHours == $NewTimeHours) && ($TimeNowMinute == $NewTimeMinute)){
                mysqli_query($connect,"UPDATE forward SET forward_time='$timeWeb' WHERE elanID = '$elanID_Forward' AND forward_key='forward' ");
            }
        }

		$finishTimeElan=strtotime($elan_forward_header["forward_start_time"])+($elanID_Forward_repeat+1)*6*3600;
		$NewFinishHours=date("H", $finishTimeElan);
        $NewFinishMinute=date("i", $finishTimeElan);

		if(($TimeNowHours == $NewFinishHours) && ($TimeNowMinute == $NewFinishMinute)){
			mysqli_query($connect,"UPDATE forward SET forward_status='passive' WHERE elanID = '$elanID_Forward' AND forward_key='forward' ");
		}
		
    }
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
		<link rel="stylesheet" href="css/bootstrap.css" />
		<!-- Fontawesome -->
		<link rel="stylesheet" href="plugin/fontawesome-free-5.15.2/css/all.css" />
		<!-- Montserrat fonts include -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<!-- OwlCarousel2-2.3.4 CSS -->
		<link rel="stylesheet" href="plugin/OwlCarousel2-2.3.4/owl.carousel.css" />
		<link rel="stylesheet" href="plugin/OwlCarousel2-2.3.4/owl.theme.default.css" />
		<!-- Swiper CSS -->
		<link rel="stylesheet" href="plugin/swiper/swiper-bundle.css"/>
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="plugin/fancybox/jquery.fancybox.css"/>
		<!-- summernote css -->
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
		<!-- main CSS -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/style2.php">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/style6.css">
		<link rel="stylesheet" type="text/css" media="screen" href="assets/css/responsive.css">

		<!-- Title & Logo -->
		<title><?php echo $company['company_name']; ?> | Pulsuz Elanlar Saytı</title>
		<link rel="shortcut icon" type="image/jpg" href="img/<?php echo $company['company_favicon']; ?>" />

		<!-- Jquery JS -->
		<script src="js/jquery-3.6.0.js"></script>
		<!-- Bootstrap JS -->
		<script src="js/bootstrap.js"></script>
    </head>
    <body class="position-relative">
		<div class="scrollUp">
			<i class="fas fa-arrow-up"></i>
		</div>
		<div class="container mb-2" style="height:100px" title="elan sahibi">
			<a href="#"><img src="assets/img/advertisement/top.png" alt="" class="w-100 h-100"></a>			
		</div>
		<div class="advert-right" title="elan sahibi">
			<a href=""><img src="assets/img/advertisement/left_right.png" alt="" class="w-100 h-100"></a>			
		</div>
		<div class="advert-left" title="elan sahibi">
			<a href=""><img src="assets/img/advertisement/left_right.png" alt="" class="w-100 h-100"></a>			
		</div>
		<header id="headerID">
            <div class="container">
                <div class="navbar-container">
					<div class="menu-bars"><i class="fas fa-bars"></i></div>
					<a href="index" class="brand">
						<img src="img/<?php echo $company['company_logo']; ?>" alt="<?php echo $company['company_name']; ?>">
					</a>
					<div class="button-container">						
						<a href="bookmark" class="heart"><i class="far fa-heart"></i></a>
						<a href="profile/index" class="heart"><i class="fas fa-user-circle"></i></a>
						<a href="add" class="btn btn-success ctmBorder" style="background:var(--main-color); border:1px solid var(--main-color)">
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
		<section id="head-section" style="padding-bottom:10px">
			<div class="container">
				<div class="category-container">
					<?php
						$categorieslist=mysqli_query($connect, "SELECT *  FROM categories");
						while($categories=mysqli_fetch_array($categorieslist)){ ?>
							<div class="cat-item">
								<a href="category/<?php echo $categories['category_seflink'] ?>">
									<img src="img/categories/<?php echo $categories['category_image'] ?>" alt="">
									<?php echo $categories['category_title'] ?>
								</a>
							</div>
					<?php }
					?>
				</div>
			</div>
		</section>

		