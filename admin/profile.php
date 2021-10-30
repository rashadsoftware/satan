<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
		include("include/connectDB.php"); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Tənzimləmələr");
		?>
        <script>
            $(function(){
                $(".page-title").html("Profil Tənzimləmələr");
                $("#settings_page_profile").addClass("active");
            });
        </script>
		<style>
			#settings_page_profile{
				color:#000;
			}
		</style>
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
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
								<li class="breadcrumb-item active page-title"></li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<?php
								dynamic_alert_notification("alertSettings");
							?>
						
						</div>

						<div class="col-md-4">
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center mb-4">
									<?php
										if($user['user_img']==""){ ?>
											<img src="img/users/user2.png" class="profile-user-img img-fluid img-circle" alt="Administrator" style="height:100px">
									<?php   } else { ?>
		<img src="img/users/<?php echo $user['user_img'] ?>" class="profile-user-img img-fluid img-circle" alt="<?php echo $user['user_name'] ?>" style="height:100px">
									<?php   }
									?>  
									</div>

									<?php
										$user_email=$user["user_email"];
										$user_status=$user["user_status"];
										$user_phone=$user["user_phone"];
									?>

									<h3 class="profile-username text-center"><?php echo $user['user_name'] ?></h3>
									<p class="text-muted text-center">
										<span class="text-capitalize">Administrator</span> 
									</p>

									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b>ID</b> <a class="float-right"><?php echo $user['user_id'] ?></a>
										</li>
										<li class="list-group-item">
											<b>Email</b> <a class="float-right"><?php echo $user_email ?></a>
										</li>
										<li class="list-group-item">
											<b>Telefon</b> <a class="float-right text-capitalize"><?php echo $user_phone ?></a>
										</li>
										<li class="list-group-item">
											<b>Status</b> <a class="float-right text-capitalize">Administrator</a>
										</li>
									</ul>
								</div>
								<!-- /.card-body -->
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item">
											<a class="nav-link active" href="#activity" data-toggle="tab">Əsas Məlumatlar</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#profile_image" data-toggle="tab">Profil Şəkli</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#settings" data-toggle="tab">Şifrə Tənzimləmələri</a>
										</li>
									</ul>
								</div><!-- /.card-header -->
								
								<div class="card-body">
									<div class="tab-content">
										<div class="active tab-pane" id="activity">
											<form class="form-horizontal general-settings-form" autocomplete="off">
												<div class="form-group row">
													<label for="inputFullName" class="col-sm-3 col-form-label">Tam Adınız</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="inputFullName" placeholder="Adınızı və Soyadınızı daxil edin" value="<?php echo $user['user_name'] ?>" name="inputFullName">
													</div>
												</div>
												<div class="form-group row">
													<label for="inputUserEmail" class="col-sm-3 col-form-label">Email</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="inputUserEmail" placeholder="Email" value="<?php echo $user_email ?>" name="inputUserEmail">
													</div>
												</div>
												<div class="form-group row mb-5">
													<label for="inputUserPhone" class="col-sm-3 col-form-label">Telefon</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="inputUserPhone" placeholder="Nümunə: 0501234567" value="<?php echo $user['user_phone']; ?>" name="inputUserPhone">
													</div>
												</div>
												<input type="hidden" name="inputHiddenID" value="<?php echo $user['user_id']?>">
												<div class="form-group row">
													<div class="offset-sm-2 col-sm-10">
														<button type="submit" class="btn btn-success float-right">Dəyişiklikləri Yadda Saxla</button>
													</div>
												</div>
											</form>
										</div>

										<div class="tab-pane" id="profile_image">
											<form class="form-horizontal image-settings-form" enctype="multipart/form-data" autocomplete="off">
												<div class="form-group row">
													<label for="inputUserImage" class="col-sm-3 col-form-label">Şəkil</label>
													<div class="col-sm-9">
														<input type="file" id="inputUserImage" class="form-control" style="line-height:1" name="inputUserImage">
													</div>
												</div>
												<input type="hidden" name="inputHiddenID" value="<?php echo $user['user_id']?>">
												<div class="form-group row mt-5">
													<div class="offset-sm-2 col-sm-10">
														<button type="submit" class="btn btn-success float-right">Dəyişiklikləri Yadda Saxla</button>
													</div>
												</div>
											</form>
										</div>

										<div class="tab-pane" id="settings">
											<form class="form-horizontal password-settings-form" autocomplete="off">
												<div class="form-group row">
													<label for="inputOldPassword" class="col-sm-3 col-form-label">Cari Şifrə</label>
													<div class="col-sm-9">
														<input type="password" class="form-control" id="inputOldPassword" placeholder="Cari Şifrə" name="inputOldPassword">
													</div>
												</div>
												<div class="form-group row">
													<label for="inputNewPassword" class="col-sm-3 col-form-label">Yeni Şifrə</label>
													<div class="col-sm-9">
														<input type="password" class="form-control" id="inputNewPassword" placeholder="Yeni Şifrə" name="inputNewPassword">
													</div>
												</div>
												<div class="form-group row">
													<label for="inputConfirmPassword" class="col-sm-3 col-form-label">Təkrar Şifrə</label>
													<div class="col-sm-9">
														<input type="password" class="form-control" id="inputConfirmPassword" placeholder="Təkrar Şifrə" name="inputConfirmPassword">
													</div>
												</div>
												<input type="hidden" name="inputHiddenID" value="<?php echo $user['user_id']?>">
												<div class="form-group row">
													<div class="offset-sm-2 col-sm-10">
														<button type="submit" class="btn btn-success float-right">Dəyişiklikləri Yadda Saxla</button>
													</div>
												</div>
											</form>
										</div>
										<!-- /.tab-pane -->
									</div>
									<!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		
		<?php
			include("include/footer.php");
        ?>
	
	</body>
</html>

<?php 
        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>