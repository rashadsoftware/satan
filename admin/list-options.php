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
			dynamic_title("İdarəetmə Paneli | Əsas Parametrlər");
		?>
		<script>
            $(function(){
                $(".page-title").html("Əsas Parametrlər");
                $("#opt_list_options").addClass("menu-open");
				$("#options").addClass("active");
				$("#list_options").addClass("active");
            });
        </script>
		<style>
			#areaSecurity{
				display:none
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
									dynamic_alert_notification("alertListOptions");
								?>
							</div>
							<div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Parametr</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-options-form" autocomplete="off">
										<div class="card-body">
											<div class="form-group">
                                                <label>Üst Kateqoriya</label>
                                                <select class="form-control" name="selectCategory">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $categories_list=mysqli_query($connect, "SELECT *  FROM categories");
                                                        while($categories=mysqli_fetch_array($categories_list)){ ?>
                                                            <option value="<?php echo $categories["category_id"] ?>"><?php echo $categories["category_title"] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
											<div class="form-group">
                                                <label>Alt Kateqoriya</label>
                                                <select class="form-control" name="selectSubCategory">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $subcategories_list=mysqli_query($connect, "SELECT *  FROM subcategories");
                                                        while($subcategories=mysqli_fetch_array($subcategories_list)){ ?>
                                                            <option value="<?php echo $subcategories["subcategory_id"] ?>"><?php echo $subcategories["subcategory_title"] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
											<div class="form-group">
                                                <label for="inputOptions">Parametr adı</label>
                                                <input type="text" class="form-control" id="inputOptions" placeholder="Parametrin adını daxil edin" name="inputOptions">
											</div>
											<div class="form-group">
                                                <label for="selectOptionsType">Kateqoriyanın tipi</label>
                                                <select class="form-control" name="selectOptionsType" id="selectOptionsType">
                                                    <option value="">Siyahıdan seçin</option>
													<option value="select">Seçim sahəsi</option>
													<option value="text">Mətn sahəsi</option>
                                                </select>
                                            </div>
											<div class="form-group" id="areaSecurity">
                                                <label>Kateqoriyanın mühafizəsi</label>
                                                <select class="form-control" name="selectOptionsSecurity">
                                                    <option value="">Siyahıdan seçin</option>
													<option value="text">Mətn</option>
													<option value="number">Rəqəm</option>
                                                </select>
                                            </div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Parametr Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $options_list=mysqli_query($connect, "SELECT *  FROM options ");
                                if(mysqli_num_rows($options_list) > 0){  ?>
								<div class="col-12">
									<div class="card">
										<!-- /.card-header -->
										<div class="card-body table-responsive">
											<table class="table table-head-fixed table-bordered table-hover" id="example1">
												<thead>
													<tr>
														<th>ID</th>
														<th>Üst kateqoriyalar</th>
														<th>Alt kateqoriyalar</th>
														<th>Parametr adları</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($options=mysqli_fetch_array($options_list)){ ?>
														<tr>
															<td><?php echo $options["options_id"] ?></td>
															<?php
																$catId=$options["category_id"];
																$categories_list=mysqli_query($connect, "SELECT *  FROM categories WHERE category_id='$catId' ");
                                                        		$categories=mysqli_fetch_array($categories_list);
															?>
															<td><?php echo $categories["category_title"] ?></td>
															<?php
																$subcatId=$options["subcategory_id"];
																$subcategories_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='$subcatId' ");
                                                        		$subcategories=mysqli_fetch_array($subcategories_list);
															?>
															<td><?php echo $subcategories["subcategory_title"] ?></td>
															<td><?php echo $options["options_title"] ?></td>
															<td>
																<a href="update-options?id=<?php echo $options["options_id"] ?>&action=update" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $options['options_id'] ?>, 'php/deleteOptions', 'alertListOptions')"><i class="fa fa-trash-alt"></i></button>
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