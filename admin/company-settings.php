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
			dynamic_title("İdarəetmə Paneli | Şirkət Tənzimləmələri");
        ?>
        <script>
            $(function(){
                $(".page-title").html("Şirkət Tənzimləmələri");
                $("#company_settings").addClass("active");
            });
        </script>
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
									dynamic_alert_notification("alertCompanySettings");
								?>
							
							</div>

                            <?php
								$query=mysqli_query($connect,"SELECT * FROM companies WHERE company_status='main'");
								$company_data=mysqli_fetch_array($query);
												
								$company_name=$company_data["company_name"];
								$company_logo=$company_data["company_logo"];
								$company_favicon=$company_data["company_favicon"];
								$company_id=$company_data["company_id"];
								$company_status=$company_data["company_status"];
							?>
							<div class="col-md-4">
								<div class="card card-primary card-outline">
									<div class="card-body box-profile">
										<div class="text-center mb-4">
											<?php
												if($company_logo==""){ ?>
				<img src="img/AdminLTELogo.png" class="profile-user-img img-fluid img-circle" alt="Company" style="height:100px">
											<?php   } else { ?>
				<img src="../img/<?php echo $company_logo ?>" class="img-fluid" alt="<?php echo $company_name ?>" style="margin:0 auto; padding:4px; width:auto; height:75px">
											<?php   }
											?>  
										</div>

										<h3 class="profile-username text-center"><?php echo $company_name ?></h3>
										<p class="text-muted text-center">Şirkət Məlumatları</p>

										<ul class="list-group list-group-unbordered mb-3">
											<li class="list-group-item">
												<b>ID</b> <a class="float-right"><?php echo $company_id ?></a>
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
												<a class="nav-link active" href="#activity" data-toggle="tab">Ümumi Məlumat</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#profile_image" data-toggle="tab">Favicon & Logo</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#social_account" data-toggle="tab">Sosial Şəbəkələr</a>
											</li>
										</ul>
									</div><!-- /.card-header -->
									
									<div class="card-body">
										<div class="tab-content">
											<div class="active tab-pane" id="activity">
												<form class="form-horizontal general-company-settings-form" autocomplete="off">
													<div class="form-group row">
														<label for="inputCompanyName" class="col-sm-3 col-form-label">Şirkətin Adı</label>
														<div class="col-sm-9">
															<input type="text" class="form-control" id="inputCompanyName" placeholder="Şirkətin Adı" value="<?php echo $company_name ?>" name="inputCompanyName">
														</div>
													</div>
													<div class="form-group row">
														<div class="offset-sm-2 col-sm-10">
															<button type="submit" class="btn btn-success float-right text-capitalize">Dəyişiklikləri Yadda saxla</button>
														</div>
													</div>
												</form>
											</div>

											<div class="tab-pane" id="profile_image">
												<form class="form-horizontal company-logo-settings-form" enctype="multipart/form-data">
													<div class="form-group row">
														<label for="inputLogoImage" class="col-sm-3 col-form-label">Logo</label>
														<div class="col-sm-6">
															<input type="file" id="inputLogoImage" class="form-control" style="line-height:1" name="inputLogoImage">
														</div>
														<div class="col-sm-3">
															<button type="submit" class="btn btn-success float-right text-capitalize">Dəyişiklikləri yadda saxla</button>
														</div>
													</div>
												</form>
												<form class="form-horizontal company-icon-settings-form" enctype="multipart/form-data">
													<div class="form-group row">
														<label for="inputIconImage" class="col-sm-3 col-form-label">Favicon</label>
														<div class="col-sm-6">
															<input type="file" id="inputIconImage" class="form-control" style="line-height:1" name="inputIconImage">
														</div>
														<div class="col-sm-3">
															<button type="submit" class="btn btn-success float-right text-capitalize">Dəyişiklikləri yadda saxla</button>
														</div>
													</div>
												</form>
											</div>

											<div class="tab-pane" id="social_account">
												<form class="form-horizontal update-social-form">
													<div class="form-group row">
														<label for="selectSocialType" class="col-sm-3 col-form-label">Sosial şəbəkə tipi</label>
														<div class="col-sm-6">
															<select class="form-control" name="selectSocialType" id="selectSocialType">
																<option value="">Siyahıdan seçin</option>
																<option value="facebook">Facebook</option>
																<option value="instagram">Instagram</option>
																<option value="youtube">Youtube</option>
																<option value="pinterest">Pinterest</option>
																<option value="telegram">Telegram</option>
															</select>
														</div>														
													</div>
													<div class="form-group row">
														<label for="selectSocialHiperlink" class="col-sm-3 col-form-label">Hiperlink</label>
														<div class="col-sm-6">
															<input type="text" id="selectSocialHiperlink" class="form-control" name="selectSocialHiperlink">
														</div>
													</div>
													<button type="submit" class="btn btn-success float-right text-capitalize">Dəyişiklikləri yadda saxla</button>
												</form>
											</div>
										</div>
										<!-- /.tab-content -->
									</div><!-- /.card-body -->
								</div>
							</div>
						</div> <!-- /.row (main row) -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
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