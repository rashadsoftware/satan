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
			dynamic_title("İdarəetmə Paneli | Alt Parametrlər");
		?>
		<script>
            $(function(){
                $(".page-title").html("Alt Parametrlər");
                $("#opt_list_options").addClass("menu-open");
				$("#options").addClass("active");
				$("#list_suboptions").addClass("active");
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
									dynamic_alert_notification("alertListSubOptions");
								?>
							</div>
							<div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Alt Parametr</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-suboptions-form" autocomplete="off">
										<div class="card-body">
                                            <div class="form-group">
                                                <label>Əsas Parametr</label>
                                                <select class="form-control" name="selectSubOptions">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $options_list=mysqli_query($connect, "SELECT *  FROM options WHERE options_type='select'");
                                                        while($options=mysqli_fetch_array($options_list)){ 
															$optionsSubCategory=$options["subcategory_id"]; 
															$optionsSubCategory_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='$optionsSubCategory'");
															$SubCategoryName=mysqli_fetch_array($optionsSubCategory_list); ?>
                                                            <option value="<?php echo $options["options_id"] ?>"><?php echo $SubCategoryName['subcategory_title']." > ".$options["options_title"] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputsubOptions">Alt kateqoriya adı</label>
                                                <input type="text" class="form-control" id="inputsubOptions" placeholder="Alt parametrin adını daxil edin" name="inputsubOptions">
											</div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Alt Parametr Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
							<?php
                                $suboptions_list=mysqli_query($connect, "SELECT *  FROM suboptions ");
                                if(mysqli_num_rows($suboptions_list) > 0){  ?>
								<div class="col-12">
									<div class="card">
										<!-- /.card-header -->
										<div class="card-body table-responsive">
											<table class="table table-head-fixed table-bordered table-hover" id="example1">
												<thead>
													<tr>
														<th>ID</th>
														<th>Əsas Parametrlər</th>
														<th>Köməkçi Parametrlər</th>
                                                        <th>Alt Parametr adları</th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php
                                                    while($suboptions=mysqli_fetch_array($suboptions_list)){ ?>
														<tr>
															<td><?php echo $suboptions["suboptions_id"] ?></td>
                                                            <?php
                                                                $id=$suboptions["options_id"];
                                                                $options_list=mysqli_query($connect, "SELECT *  FROM options WHERE options_id=$id ");
                                                                $options=mysqli_fetch_array($options_list);
																$optionsSubcat_id=$options["subcategory_id"];
																$optionsSubcat_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id=$optionsSubcat_id ");
                                                                $optionsSubcat=mysqli_fetch_array($optionsSubcat_list);
                                                            ?>
                                                            <td><?php echo $optionsSubcat['subcategory_title']; ?></td>
															<td><?php echo $options["options_title"] ?></td>
															<td><?php echo $suboptions["suboptions_title"] ?></td>
															<td>
																<a href="update-suboptions?id=<?php echo $suboptions["suboptions_id"] ?>&action=update" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $suboptions['suboptions_id'] ?>, 'php/deleteSubOptions', 'alertListSubOptions')"><i class="fa fa-trash-alt"></i></button>
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