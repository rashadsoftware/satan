<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

        if($_GET["action"]=="view"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM elan WHERE elan_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Elan Detayları");
		?>
		<script>
            $(function(){
                $(".page-title").html("Elan Detayları");
                $("#opt_list_adverts").addClass("menu-open");
				$("#adverts").addClass("active");
                $("#list_elanlar").addClass("active");
            });
        </script>
		<style>
			.elanImgItems{
				margin-right:10px;
				margin-bottom:10px
			}
			.elanImgItems:hover{
				box-shadow:0 0 15px rgba(0,0,0,0.5)
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
                                    <li class="breadcrumb-item"><a href="elanlar">Elanlar</a></li>
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
									dynamic_alert_notification("alertElanDetaylar");
								?>
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Bildiriş:</h5>
                                    Burada paylaşılan informasiyalar məlumat xarakterlidir
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7 col-xl-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="img/users/user2.png" alt="User profile picture" style="width:120px">
                                        </div>

										<?php
											$customer_id=$fetchArray["customer_id"];
											$customers_list=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id='$customer_id' ");
											$customers=mysqli_fetch_array($customers_list);
										?>
                                        <h3 class="profile-username text-center mb-3"><?php echo $customers['customer_name'] ?></h3>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>ID</b> <a class="float-right"><?php echo $customers['customer_id'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Email</b> <a class="float-right"><?php echo $customers['customer_email'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Telefon</b> <a class="float-right"><?php echo $customers['customer_phone'] ?></a>
                                            </li>
                                        </ul>
										<?php
											if($fetchArray["elan_status"] == "waiting"){ ?>
												<button class="btn btn-success" onclick="goAjax(<?php echo $fetchArray['elan_id']; ?>, 'php/changeOptionsElan', 'alertElanDetaylar')"><b>Təsdiqlə</b></button>
												<button type="button" class="btn btn-danger cancelBtn" data-id="<?php echo $fetchArray['elan_id'] ?>"> Ləğv et</button>
										<?php }
										?>
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>   
							<div class="col-xl-9">
								<div class="card">
									<div class="card-header p-2">
										<ul class="nav nav-pills">
											<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Ümumi Məlumatlar</a></li>
											<li class="nav-item"><a class="nav-link" href="#elanDetails" data-toggle="tab">Elan Detayları</a></li>
											<li class="nav-item"><a class="nav-link" href="#imgline" data-toggle="tab">Şəkillər</a></li>
										</ul>
									</div><!-- /.card-header -->
									<div class="card-body">
										<div class="tab-content">
											<!-- ============ [home tab section] ================= -->
											<div class="active tab-pane" id="activity">
												<div class="row">
													<?php
														if(mysqli_num_rows($selectId) > 0){ ?>
															<div class="col-12">
																<div class="card">
																<!-- ./card-body -->
																	<div class="card-body">
																		<table class="table table-bordered table-hover">
																			<tbody>
																				<tr>
																					<td>ID</td>
																					<td><?php echo $fetchArray["elan_id"]; ?></td>
																				</tr>
																				<tr>
																					<td>Elan verən</td>
																					<td><?php if($fetchArray["elan_veren"] =="own"){ echo "Şəxsi"; } else{ echo "Şirkət";} ?></td>
																				</tr>
																				<tr>
																					<td>Kateqoriya</td>
																					<?php	
																						$kateqoriya_list=$fetchArray["elan_kateqoriya"];
																						$kateqoriyalar=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='$kateqoriya_list' ");
																						$kateqoriya=mysqli_fetch_array($kateqoriyalar);
																					?>
																					<td><?php echo $kateqoriya["subcategory_title"]; ?></td>
																				</tr>
																				<tr>
																					<td>Şəhər</td>
																					<?php	
																						$idCity_list=$fetchArray["elan_seher"];
																						$cities=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$idCity_list' ");
																						$city=mysqli_fetch_array($cities);
																					?>
																					<td><?php echo $city["city_title"]; ?></td>
																				</tr>
																				<tr>
																					<td>Elanın adı</td>
																					<td><?php echo $fetchArray["elan_name"]; ?></td>
																				</tr>
																				<tr>
																					<td>Qiymət</td>
																					<td><?php echo $fetchArray["elan_qiymet"]; ?></td>
																				</tr>
																				<tr>
																					<td>Elan məzmunu</td>
																					<td><?php echo $fetchArray["elan_mezmun"]; ?></td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																	<!-- /.card-body -->
																</div>
																<!-- /.card -->
															</div>
													<?php	}  else {
															echo '
															<div class="callout callout-info w-100">
																<h5>Bildiriş!</h5>
											
																<p>Bu elana ümumi məlumat yerləşdirilməmişdir</p>
															</div>
															';
														}
													?>
												</div>
											</div>
											<!-- /.tab-pane -->

											<!-- ============ [elan details tab section] ================= -->
											<?php   
											$idElan_id=$fetchArray["elan_id"];
											$elandetail_list=mysqli_query($connect, "SELECT *  FROM elan_detail WHERE elan_id='$idElan_id' "); ?>
												
											<div class="tab-pane" id="elanDetails">
												<div class="row">
													<?php if(mysqli_num_rows($elandetail_list) > 0){ ?>
														<div class="col-12">
															<div class="card">
															<!-- ./card-body -->
																<div class="card-body">
																	<table class="table table-bordered table-hover">
																		<tbody>
																			<?php
																				while($elalarDetails=mysqli_fetch_array($elandetail_list)){ ?>
																				<tr>
																					<?php
																					$elanlarID=$elalarDetails["options_id"];
																					$elandetailOptions_list=mysqli_query($connect, "SELECT *  FROM options WHERE options_id='$elanlarID' ");
																					$elandetailOptions=mysqli_fetch_array($elandetailOptions_list);
																					?>
																					<td><?php echo $elandetailOptions["options_title"] ?></td>
																					<?php
																						if($elandetailOptions["options_type"] == "select"){ 
																							$idSelectElanDetailsValue=$elalarDetails["elanDetail_value"];
																							$subOptionsElanDetailValue_list=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id='$idSelectElanDetailsValue' ");
																							$subOptionsElanDetailValue=mysqli_fetch_array($subOptionsElanDetailValue_list);
																							?>
																							<td><?php echo $subOptionsElanDetailValue["suboptions_title"]; ?></td>
																					<?php	} else { ?>
																							<td><?php echo $elalarDetails["elanDetail_value"]; ?></td>
																					<?php	}
																					?>
																				</tr>
																			<?php	}
																			?>
																		</tbody>
																	</table>
																</div>
																<!-- /.card-body -->
															</div>
															<!-- /.card -->
														</div>
												<?php } else {
														echo '
														<div class="callout callout-info w-100">
															<h5>Bildiriş!</h5>
										
															<p>Bu elanın elan detayları sahəsində heç bir məlumat yoxdur</p>
														</div>
														';
													}
													?>
												</div>
											</div>
											<!-- /.tab-pane -->

											<!-- ============ [image tab section] ================= -->
											<?php   
											$idImages=$fetchArray["elan_id"];
											$elanImg_list=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idImages' "); ?>
												
											<div class="tab-pane" id="imgline">
												<div class="row">
													<div class="col-12 mb-3">
														<form id="upload_form_image">
															<label for="itemImage" class="mr-2">Şəkil Əlavə Et</label>
															<input type="file" id="itemImage" name="itemImage">
															<input type="hidden" name="hiddenImage" value="<?php echo $idImages; ?>">
														</form>
													</div>
													<?php if(mysqli_num_rows($elanImg_list) > 0){ 
														while($elalarImages=mysqli_fetch_array($elanImg_list)){ ?>
															<div class="mr-3 mb-3">
																<a href="../img/advert/<?php echo $elalarImages['img_path'] ?>">
																	<img src="../img/advert/<?php echo $elalarImages['img_path'] ?>" alt="<?php echo $elalarImages['img_id'] ?>" class="elanImgItems mr-0" width="200" height="200">
																</a>
																<button class="btn btn-danger btn-block delImage" id="<?php echo $elalarImages['img_id'] ?>">Şəkil silmək</button>
															</div>															
													<?php	}
													} else {
														echo '
														<div class="callout callout-info w-100">
															<h5>Bildiriş!</h5>
										
															<p>Bu elana məxsus heç bir şəkil tapılmadı</p>
														</div>
														';
													}
													?>
												</div>
											</div>
											<!-- /.tab-pane -->
										</div>
										<!-- /.tab-content -->
									</div><!-- /.card-body -->
								</div>
								<!-- /.card -->
							</div>                         
                        </div><!-- /.row -->
					</div>
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->

			<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="legv-etme-form2">
							<div class="modal-header">
								<h4 class="modal-title text-capitalize">Elanı ləğv et</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label>Səbəb</label>
									<textarea class="form-control" rows="7" placeholder="Elanı ləğv etmənizin səbəbini qeyd edin" name="textareaCancel"></textarea>
									<input type="hidden" name="hiddenCancel" id="hiddenCancel">
								</div>
							</div>
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Göndər</button>
							</div>
						</form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

	<?php
		include("include/footer.php");
	?>
</html>
<?php 
        } else {
			header("Location:elanlar");
		}

        mysqli_close($connect);
    } else {
		header("Location:index");
	}
?>