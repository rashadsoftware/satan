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
			dynamic_title("İdarəetmə Paneli | Parametr Birləşdirmə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Parametr Birləşdirmə");
                $("#opt_list_options").addClass("menu-open");
				$("#options").addClass("active");
				$("#list_merge_suboptions").addClass("active");
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
									dynamic_alert_notification("alertListMergeSubOptions");
								?>
							</div>
							<div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Parametr Birləşdirici</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="merge-suboptions-form" autocomplete="off">
										<div class="card-body">
											<div class="form-group">
                                                <label>Üst Kateqoriya</label>
                                                <select class="form-control" name="selectCategory">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $categories_list=mysqli_query($connect, "SELECT *  FROM suboptions");
                                                        while($categories=mysqli_fetch_array($categories_list)){ 
                                                            $subcategory=$categories["options_id"];
                                                            $subcategories_list=mysqli_query($connect, "SELECT *  FROM options WHERE options_id='$subcategory' ");
                                                        	$subcategories=mysqli_fetch_array($subcategories_list); ?>
                                                            <option value="<?php echo $categories["suboptions_id"] ?>"><?php echo $subcategories['options_title'] ?> > <?php echo $categories["suboptions_title"] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
											<div class="form-group">
                                                <label>Alt Kateqoriya</label>
                                                <select class="form-control" name="selectSubCategory">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $categories_list2=mysqli_query($connect, "SELECT *  FROM suboptions");
                                                        while($categories2=mysqli_fetch_array($categories_list2)){ 
                                                            $subcategory2=$categories2["options_id"];
                                                            $subcategories_list2=mysqli_query($connect, "SELECT *  FROM options WHERE options_id='$subcategory2' ");
                                                        	$subcategories2=mysqli_fetch_array($subcategories_list2); ?>
                                                            <option value="<?php echo $categories2["suboptions_id"] ?>"><?php echo $subcategories2['options_title'] ?> > <?php echo $categories2["suboptions_title"] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Parametr Birləşdir</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $merges_list=mysqli_query($connect, "SELECT *  FROM merges ");
                                if(mysqli_num_rows($merges_list) > 0){  ?>
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
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($merges=mysqli_fetch_array($merges_list)){ ?>
														<tr>
															<td><?php echo $merges["merge_id"] ?></td>
															<?php
																$catId=$merges["merge_key"];
																$categories_list=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id='$catId' ");
                                                        		$categories=mysqli_fetch_array($categories_list);
															?>
															<td><?php echo $categories["suboptions_title"] ?></td>
															<?php
																$catId2=$merges["merge_value"];
																$categories_list2=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id='$catId2' ");
                                                        		$categories2=mysqli_fetch_array($categories_list2);
															?>
															<td><?php echo $categories2["suboptions_title"] ?></td>
															<td> 
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $merges['merge_id'] ?>, 'php/deleteMergeSubOptions', 'alertListMergeSubOptions')"><i class="fa fa-trash-alt"></i></button>
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