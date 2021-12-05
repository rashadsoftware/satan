<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Ana Səhifə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Ana Səhifə");
                $("#dashboard").addClass("active");
            });
        </script>
		<style>
			#settings_page_main{
				color:#000;
			}
		</style>
	</head>
	<body class="hold-transition sidebar-mini">
		<?php
			include("include/header.php");
		?>
		

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="page-title"></h1>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item active page-title"></li>
								</ol>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<?php
									dynamic_alert_notification("alertDashboard");
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box mb-3">
									<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-glasses text-white"></i></span>

									<div class="info-box-content">
										<span class="info-box-text text-capitalize">Ziyarətçi sayı</span>
										<?php
											$arrayVisitor=[];
											$elanlar_list=mysqli_query($connect, "SELECT *  FROM visitors");

											while($elanlar=mysqli_fetch_array($elanlar_list)){
												array_push($arrayVisitor, $elanlar["visitor_ip"]);
											}
											// dizide tekrarlanan deyerleri silir
											$newArrayVisitor=array_unique($arrayVisitor);
										?>
										<span class="info-box-number"><?php echo count($newArrayVisitor); ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box mb-3">
								<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

								<div class="info-box-content">
									<span class="info-box-text">Bəyənmə Sayı</span>
									<?php
										$favorites_list=mysqli_query($connect, "SELECT *  FROM favorites");
									?>
									<span class="info-box-number"><?php echo mysqli_num_rows($favorites_list); ?></span>
								</div>
								<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>

							<div class="col-12 col-sm-6 col-md-3">
								<div class="info-box mb-3">
									<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users text-white"></i></span>

									<div class="info-box-content">
										<span class="info-box-text text-capitalize">İstifadəçi sayı</span>
										<?php
											$users_list=mysqli_query($connect, "SELECT *  FROM users WHERE user_status='user' ");
										?>
										<span class="info-box-number"><?php echo mysqli_num_rows($users_list); ?></span>
									</div>
									<!-- /.info-box-content -->
								</div>
								<!-- /.info-box -->
							</div>
							<!-- /.col -->
						</div>
						<div class="row">
							<div class="col-lg-3 col-6">
								<?php
									$elanlar_list=mysqli_query($connect, "SELECT *  FROM elan");
								?>
								<!-- small box -->
								<div class="small-box bg-info">
									<div class="inner">
										<h3><?php echo mysqli_num_rows($elanlar_list); ?></h3>

										<p>Bütün Elanlar</p>
									</div>
									<div class="icon">
										<i class="fas fa-copy"></i>
									</div>
									<a href="elanlar" class="small-box-footer">Daha Ətraflı <i class="fas fa-arrow-circle-right ml-2"></i></a>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

	<?php
		include("include/footer.php");
	?>
</html>
<?php 
        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>