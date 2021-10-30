<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

		if($_GET["action"]=="update"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM subcategories WHERE subcategory_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Alt Kateqoriyaları Yenilə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Alt Kateqoriyaları Yenilə");
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
									<li class="breadcrumb-item"><a href="list-subcategory">Alt Kateqoriya Listələ</a></li>
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
										<h3 class="card-title">Alt Kateqoriya Yenilə</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="update-subcategory-form" autocomplete="off">
										<div class="card-body">
                                            <div class="form-group">
                                                <label>Ana kateqoriya</label>
                                                <select class="form-control" name="selectSubCategory">
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
                                                <label for="inputsubCategory">Alt kateqoriya adı</label>
                                                <input type="text" class="form-control" id="inputsubCategory" placeholder="Alt kateqoriya adını daxil edin" name="inputsubCategory" value="<?php echo $fetchArray["subcategory_title"] ?>">
											</div>
											<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["subcategory_id"] ?>">
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Alt Kateqoriya Yenilə</button>
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
			header("Location:list-subcategory");
		}

        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>