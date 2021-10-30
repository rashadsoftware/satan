<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
		include("include/connectDB.php"); 

        $configsMain_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='mainColor' ");
	    $configsMain=mysqli_fetch_array($configsMain_list);

        $configsSecond_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='secondColor' ");
	    $configsSecond=mysqli_fetch_array($configsSecond_list);

		$configsThird_list=mysqli_query($connect, "SELECT *  FROM configs WHERE configs_key='thirdColor' ");
	    $configsThird=mysqli_fetch_array($configsThird_list);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Sayt Tənzimləmələri");
        ?>
        <script>
            $(function(){
                $(".page-title").html("Sayt Tənzimləmələri");
                $("#site_settings").addClass("active");
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
									dynamic_alert_notification("alertSiteSettings");
								?>
							
							</div>
							<div class="col-12">
								<div class="card">
									<div class="card-header p-2">
										<ul class="nav nav-pills">
											<li class="nav-item">
												<a class="nav-link active" href="#activity" data-toggle="tab">Rəng ayarları</a>
											</li>
											<!--
											<li class="nav-item">
												<a class="nav-link" href="#profile_image" data-toggle="tab">Şəkil ayarları</a>
											</li>
											-->
										</ul>
									</div><!-- /.card-header -->
									
									<div class="card-body">
										<div class="tab-content">
											<div class="active tab-pane" id="activity">
												<form class="form-horizontal color-site-settings-form" autocomplete="off">
													<div class="form-group row">
														<label for="mainColor" class="col-sm-3 col-form-label">Əsas rəng</label>
														<div class="col-sm-9 d-flex">
															<input type="text" class="form-control mr-1" id="mainColor" placeholder="Əsas rəng" value="<?php echo $configsMain['configs_value'] ?>" name="mainColor">
															<div style="height:38px; width:40px; background:<?php echo $configsMain['configs_value'] ?>"></div>
														</div>														
													</div>
                                                    <div class="form-group row">
														<label for="secondColor" class="col-sm-3 col-form-label">İkinci rəng</label>
														<div class="col-sm-9 d-flex">
															<input type="text" class="form-control mr-1" id="secondColor" placeholder="İkinci rəng" value="<?php echo $configsSecond['configs_value'] ?>" name="secondColor">
															<div style="height:38px; width:40px; background:<?php echo $configsSecond['configs_value'] ?>"></div>
														</div>
													</div>
													<div class="form-group row">
														<label for="thirdColor" class="col-sm-3 col-form-label">Üçüncü rəng</label>
														<div class="col-sm-9 d-flex">
															<input type="text" class="form-control mr-1" id="thirdColor" placeholder="Üçüncü rəng" value="<?php echo $configsThird['configs_value'] ?>" name="thirdColor">
															<div style="height:38px; width:40px; background:<?php echo $configsThird['configs_value'] ?>"></div>
														</div>
													</div>
													<div class="form-group row">
														<div class="offset-sm-2 col-sm-10">
															<button type="submit" class="btn btn-success float-right text-capitalize">Dəyişiklikləri Yadda saxla</button>
														</div>
													</div>
												</form>
											</div>

											<!--
											<div class="tab-pane" id="profile_image">												
												
											</div>
											-->
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