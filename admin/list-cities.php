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
			dynamic_title("İdarəetmə Paneli | Şəhərlər");
		?>
		<script>
            $(function(){
                $(".page-title").html("Şəhərlər");
				$("#list_cities").addClass("active");
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
									dynamic_alert_notification("alertListCities");
								?>
							</div>
                            <div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
                                        <h3 class="card-title">Yeni Şəhər</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-city-form" autocomplete="off">
										<div class="card-body">
                                            <div class="form-group">
                                                <label for="inputCity">Şəhər adı</label>
                                                <input type="text" class="form-control" id="inputCity" placeholder="Şəhər adını daxil edin" name="inputCity">
                                            </div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Şəhər Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $cities_list=mysqli_query($connect, "SELECT *  FROM cities ");
                                if(mysqli_num_rows($cities_list) > 0){  ?>
								<div class="col-12">
									<div class="card">
										<!-- /.card-header -->
										<div class="card-body table-responsive">
											<table class="table table-head-fixed table-bordered table-hover" id="example1">
												<thead>
													<tr>
														<th>ID</th>
														<th style="width:60%">Şəhər adları</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($cities=mysqli_fetch_array($cities_list)){ ?>
														<tr>
															<td><?php echo $cities["city_id"] ?></td>
															<td><?php echo $cities["city_title"] ?></td>
															<td>
																<a href="update-city?id=<?php echo $cities["city_id"] ?>&action=update" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $cities['city_id'] ?>, 'php/deleteCity', 'alertListCities')"><i class="fa fa-trash-alt"></i></button>
															</td>
														</tr>
													<?php   }                                                    
                                                	?>
												</tbody>
											</table>
										</div>
										<!-- /.card-body -->
									</div>
									<!-- /.card -->
								</div>
							<?php   }
                            ?>
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