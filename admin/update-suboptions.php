<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

		if($_GET["action"]=="update"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM suboptions WHERE suboptions_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Alt Parametri Yenilə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Alt Parametri Yenilə");
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
									<li class="breadcrumb-item"><a href="list-suboptions">Köməkçi Parametrlər</a></li>
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
										<h3 class="card-title">Alt Parametr Yenilə</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="update-suboptions-form" autocomplete="off">
										<div class="card-body">
                                            <div class="form-group">
                                                <label>Əsas Parametr</label>
                                                <select class="form-control" name="selectSubOptions">
                                                    <option value="">Siyahıdan seçin</option>
                                                    <?php
                                                        $options_list=mysqli_query($connect, "SELECT *  FROM options");
                                                        while($options=mysqli_fetch_array($options_list)){ ?>
                                                            <option 
																value="<?php echo $options["options_id"] ?>"
																<?php
																	if($options["options_id"] == $fetchArray["options_id"]){ 
																		echo "selected";
																	}
																	$optionsSubCategory=$options["subcategory_id"]; 
																	$optionsSubCategory_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='$optionsSubCategory'");
																	$SubCategoryName=mysqli_fetch_array($optionsSubCategory_list);
																?>
																>
																<?php echo $SubCategoryName['subcategory_title']." > ".$options["options_title"] ?>
															</option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputsubOptions">Alt parametr adı</label>
                                                <input type="text" class="form-control" id="inputsubOptions" placeholder="Alt parametr adını daxil edin" name="inputsubOptions" value="<?php echo $fetchArray["suboptions_title"] ?>">
											</div>
											<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["suboptions_id"] ?>">
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Alt Parametri Yenilə</button>
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
			header("Location:list-suboptions");
		}

        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>