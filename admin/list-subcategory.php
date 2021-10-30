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
			dynamic_title("İdarəetmə Paneli | Alt Kateqoriyalar");
		?>
		<script>
            $(function(){
                $(".page-title").html("Alt Kateqoriyalar");
                $("#opt_list_categories").addClass("menu-open");
				$("#categories").addClass("active");
				$("#list_subcategory").addClass("active");
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
									dynamic_alert_notification("alertListSubCategory");
								?>
							</div>
							<div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Alt Kateqoriya</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-subcategories-form" autocomplete="off">
										<div class="card-body">
                                            <div class="form-group">
                                                <label>Ana kateqoriya</label>
                                                <select class="form-control" name="selectSubCategory">
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
                                                <label for="inputsubCategory">Alt kateqoriya adı</label>
                                                <input type="text" class="form-control" id="inputsubCategory" placeholder="Alt kateqoriya adını daxil edin" name="inputsubCategory">
											</div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Alt Kateqoriya Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $subcategories_list=mysqli_query($connect, "SELECT *  FROM subcategories ");
                                if(mysqli_num_rows($subcategories_list) > 0){  ?>
								<div class="col-12">
									<div class="card">
										<!-- /.card-header -->
										<div class="card-body table-responsive">
											<table class="table table-head-fixed table-bordered table-hover" id="example1">
												<thead>
													<tr>
														<th>ID</th>
														<th>Ana kateqoriya</th>
                                                        <th>Alt kateqoriya adları</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($subcategory=mysqli_fetch_array($subcategories_list)){ ?>
														<tr>
															<td><?php echo $subcategory["subcategory_id"] ?></td>
                                                            <?php
                                                                $id=$subcategory["category_id"];
                                                                $categories_list=mysqli_query($connect, "SELECT *  FROM categories WHERE category_id=$id ");
                                                                $categories=mysqli_fetch_array($categories_list);
                                                            ?>
                                                            <td><?php echo $categories["category_title"] ?></td>
															<td><?php echo $subcategory["subcategory_title"] ?></td>
															<td>
																<a href="update-subcategory?id=<?php echo $subcategory["subcategory_id"] ?>&action=update" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $subcategory['subcategory_id'] ?>, 'php/deleteSubCategory', 'alertListSubCategory')"><i class="fa fa-trash-alt"></i></button>
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