<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

		if($_GET["action"]=="update"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM parametres WHERE parametres_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Qaydanı Yenilə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Qaydanı Yenilə");
				$("#list_rules").addClass("active");
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
									<li class="breadcrumb-item"><a href="new-rules">Mətn Tənzimləmələri</a></li>
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
									dynamic_alert_notification("alertListRules");
								?>
							</div>
                            <div class="col-md-5">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
                                        <h3 class="card-title">Qayda Yenilə</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="update-rules-form" autocomplete="off">
										<div class="card-body">
											<div class="form-group">
												<textarea class="form-control" rows="7" placeholder="Yeni qaydanı buraya daxil edin..." name="textareaRules"><?php echo $fetchArray["parametres_value"] ?></textarea>
											</div>
											<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["parametres_id"] ?>">
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Yenilə</button>
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
			header("Location:list-cities");
		}

        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>