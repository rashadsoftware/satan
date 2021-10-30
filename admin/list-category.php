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
			dynamic_title("İdarəetmə Paneli | Kateqoriyalar");
		?>
		<script>
            $(function(){
                $(".page-title").html("Kateqoriyalar");
                $("#opt_list_categories").addClass("menu-open");
				$("#categories").addClass("active");
				$("#list_category").addClass("active");
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
									dynamic_alert_notification("alertListCategories");
								?>
							</div>
							<div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Kateqoriya</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-category-form" autocomplete="off" enctype="multipart/form-data">
										<div class="card-body">
											<div class="form-group">
                                                <label for="inputCategory">Kateqoriya adı</label>
                                                <input type="text" class="form-control" id="inputCategory" placeholder="Kateqoriya adını daxil edin" name="inputCategory">
											</div>
											<div class="form-group">
                                                <label for="inputCategoryIcon">Kateqoriya ikonu</label>
                                                <input type="file" class="form-control" id="inputCategoryIcon" name="inputCategoryIcon">
											</div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Kateqoriya Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $categories_list=mysqli_query($connect, "SELECT *  FROM categories ");
                                if(mysqli_num_rows($categories_list) > 0){  ?>
								<div class="col-12">
									<div class="card">
										<!-- /.card-header -->
										<div class="card-body table-responsive">
											<table class="table table-head-fixed table-bordered table-hover" id="example1">
												<thead>
													<tr>
														<th width="7%" class="text-center">ID</th>
														<th width="7%" class="text-center">Şəkil</th>
														<th style="width:60%">Kateqoriya adları</th>
														<th width="7%" class="text-center">Əməliyyatlar</th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($category=mysqli_fetch_array($categories_list)){ ?>
														<tr>
															<td class="text-center"><?php echo $category["category_id"] ?></td>
															<td class="text-center"><img src="../img/categories/<?php echo $category["category_image"] ?>" alt="<?php echo $category["category_title"] ?>" width="70"></td>
															<td><?php echo $category["category_title"] ?></td>
															<td class="text-center">
																<a href="update-category?id=<?php echo $category["category_id"] ?>&action=update" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['category_id'] ?>, 'php/deleteCategory', 'alertListCategories')"><i class="fa fa-trash-alt"></i></button>
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