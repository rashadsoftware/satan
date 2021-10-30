<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

		if($_GET["action"]=="update"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM options WHERE options_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Əsas Parametrləri Yenilə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Əsas Parametrləri Yenilə");
                $("#opt_list_options").addClass("menu-open");
				$("#options").addClass("active");
				$("#list_options").addClass("active");
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
									<li class="breadcrumb-item"><a href="list-options">Əsas Parametrlər</a></li>
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
										<h3 class="card-title">Əsas Parametrləri Yenilə</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="update-options-form" autocomplete="off">
										<div class="card-body">
											<div class="form-group">
                                                <label>Üst Kateqoriya</label>
                                                <select class="form-control" name="selectCategory">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $categories_list=mysqli_query($connect, "SELECT *  FROM categories");
                                                        while($categories=mysqli_fetch_array($categories_list)){ ?>
                                                            <option 
																value="<?php echo $categories["category_id"] ?>"
																<?php
																	if($categories["category_id"] == $fetchArray["category_id"]){ 
																		echo "selected";
																}
																?>
																>
																<?php echo $categories["category_title"] ?>
															</option>
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
                                                            <option 
																value="<?php echo $subcategories["subcategory_id"] ?>"
																<?php
																	if($subcategories["subcategory_id"] == $fetchArray["subcategory_id"]){ 
																		echo "selected";
																}
																?>
																>
																<?php echo $subcategories["subcategory_title"] ?>
															</option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputOptions">Parametr adı</label>
                                                <input type="text" class="form-control" id="inputOptions" placeholder="Parametrin adını daxil edin" name="inputOptions" value="<?php echo $fetchArray["options_title"] ?>">
											</div>
											<div class="form-group">
                                                <label for="selectOptionsType">Kateqoriyanın tipi</label>
                                                <select class="form-control" name="selectOptionsType" id="selectOptionsType">
                                                    <option value="">Siyahıdan seçin</option>
													<option 
													value="select"
													<?php if($fetchArray["options_type"] == "select"){ echo "selected";} ?>
													>
														Seçim sahəsi
													</option>
													<option value="text" <?php if($fetchArray["options_type"] == "text"){ echo "selected";} ?> >Mətn sahəsi</option>
                                                </select>
                                            </div>
											<div class="form-group" id="areaSecurity">
												<label>Kateqoriyanın mühafizəsi</label>
												<select class="form-control" name="selectOptionsSecurity">
													<option value="">Siyahıdan seçin</option>
													<option value="text" <?php if($fetchArray["options_security"] == "text"){ echo "selected";} ?>>Mətn</option>
													<option value="number" <?php if($fetchArray["options_security"] == "number"){ echo "selected";} ?>>Rəqəm</option>
												</select>
											</div>
											<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["options_id"] ?>">
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Əsas Parametri Yenilə</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
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
		} else {
			header("Location:list-options");
		}

        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>