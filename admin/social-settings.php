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
			dynamic_title("İdarəetmə Paneli | Sosial Şəbəkələr");
		?>
		<script>
            $(function(){
                $(".page-title").html("Sosial Şəbəkələr");
                $("#list_rules").addClass("menu-open");
				$("#rules").addClass("active");
				$("#social_settings").addClass("active");
            });
        </script>
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
									<li class="breadcrumb-item"><a href="dashboard">Ana Səhifə</a></li>
									<li class="breadcrumb-item"><a href="new-rules">Tənzimləmələr</a></li>
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
									dynamic_alert_notification("alertSocialNetworks");
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Sosial Şəbəkələr Formu</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="update-social-form">
										<div class="card-body">
											<div class="form-group">
												<label>Sosial Şəbəkələr</label>
												<select class="form-control" name="socialNetworks">
													<option value="">Şəbəkələrdən birini seçin</option>
													<option value="facebook">Facebook</option>
													<option value="instagram">İnstagram</option>
													<option value="youtube">Youtube</option>
												</select>
											</div>
											<div class="form-group">
												<label for="exampleInputSocialAddress">Şəbəkə addresi</label>
												<input type="text" class="form-control" id="exampleInputSocialAddress" placeholder="Sosial şəbəkə addresinizi daxil edin" name="exampleInputSocialAddress">
											</div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
											<button type="submit" class="btn btn-primary">Yenilə</button>
										</div>
									</form>
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