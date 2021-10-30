<?php
	session_start();
	error_reporting(0);
	
	if($_SESSION["entry_status"] =="admin"){
        include("include/connectDB.php"); 

        if($_GET["action"]=="update"){

			$id=$_GET["id"];
			
			$selectId=mysqli_query($connect,"SELECT * FROM elan WHERE elan_id='$id'");
			$fetchArray=mysqli_fetch_array($selectId);
?>
<!DOCTYPE html>
<html lang="az">
	<head>
		<?php
			include("include/head_tag.php");
			dynamic_title("İdarəetmə Paneli | Elan Yeniləmə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Elan Yeniləmə");
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
								dynamic_alert_notification("alertElanYenileme");
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-xl-6">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Ümumi Məlumatlar</a></li>
										<li class="nav-item"><a class="nav-link" href="#elanDetails" data-toggle="tab">Elan Detayları</a></li>
										<li class="nav-item"><a class="nav-link" href="#imgline" data-toggle="tab">Şəkillər</a></li>
										<li class="nav-item"><a class="nav-link" href="#personLine" data-toggle="tab">İstifadəçi Məlumatları</a></li>
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
														<!-- form start -->
														<form class="update-optInfor-form" autocomplete="off">
															<div class="form-group">
																<label for="inputOptionsName">Elanın adı</label>
																<input type="text" class="form-control" id="inputOptionsName" placeholder="Elanın adını daxil edin" name="inputOptionsName" value="<?php echo $fetchArray["elan_name"] ?>">
															</div>
															<div class="form-group">
																<label>Elan Verən</label>
																<select class="form-control" name="selectElanVeren">
																	<option value="">Siyahıdan seçin</option>
																	<option value="own" <?php if($fetchArray["elan_veren"] == "own"){ echo "selected"; } ?>>Şəxsi</option>
																	<option value="company" <?php if($fetchArray["elan_veren"] == "company"){ echo "selected"; } ?>>Şirkət</option>
																</select>
															</div>
															<div class="form-group">
																<label for="selectsubCategory">Kateqoriya</label>
																<select class="form-control" id="selectsubCategory" name="selectsubCategory">
																	<option value="">Siyahıdan seçin</option>
																	<?php
																		$elan_kateqoriya=$fetchArray["elan_kateqoriya"];
																		$subcategory_list=mysqli_query($connect, "SELECT *  FROM subcategories ");
																		while($subcategory=mysqli_fetch_array($subcategory_list)){ ?>
																			<option value="<?php echo $subcategory['subcategory_id'] ?>" <?php if($subcategory['subcategory_id'] == $elan_kateqoriya){ echo "selected"; } ?>><?php echo $subcategory['subcategory_title'] ?></option>
																	<?php    }
																	?>                                         
																</select>
															</div>
															<div class="form-group">
																<label for="selectCity">Şəhər</label>
																<select class="form-control" id="selectCity" name="selectCity">
																	<option value="">Siyahıdan seçin</option>
																	<?php
																		$elan_seher=$fetchArray["elan_seher"];
																		$city_list=mysqli_query($connect, "SELECT *  FROM cities ");
																		while($city=mysqli_fetch_array($city_list)){ ?>
																			<option value="<?php echo $city['city_id'] ?>" <?php if($city['city_id'] == $elan_seher){ echo "selected"; } ?>><?php echo $city['city_title'] ?></option>
																	<?php    }
																	?>                                         
																</select>
															</div>
															<div class="form-group">
																<label for="inputPrice">Qiymət, AZN</label>
																<input type="text" class="form-control" id="inputPrice" placeholder="Elanın qiymətini daxil edin" name="inputPrice" value="<?php echo $fetchArray["elan_qiymet"] ?>">
															</div>
															<div class="form-group">
																<label for="textareaAdd">Məzmun</label>
																<textarea name="textareaAdd" class="form-control" id="textareaAdd" rows="7" placeholder="Satdığınız məhsulu vəya göstərdiyiniz xidməti ətraflı şəkildə burada qeyd edin"><?php echo $fetchArray["elan_mezmun"] ?></textarea>
															</div>
															<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["elan_id"] ?>">
															<button type="submit" class="btn btn-primary float-right mt-4">Məlumatları Yenilə</button>
														</form>
													</div>
												<?php	} else {
                                                    echo '
                                                    <div class="callout callout-info w-100">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Elana aid heç bir məlumat yoxdur</p>
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
														<!-- form start -->
														<form class="update-elanDetail-form" autocomplete="off">
															<?php
																while($elan_detail_item=mysqli_fetch_array($elandetail_list)){ 
																	$idOptions=$elan_detail_item["options_id"];
																	$selectOptions=mysqli_query($connect,"SELECT * FROM options WHERE options_id='$idOptions'");
																	$fetchArrayOptions=mysqli_fetch_array($selectOptions);
																	?>
																	<div class="form-group">
																		<label><?php echo $fetchArrayOptions['options_title']; ?></label>
																		<?php
																			if($fetchArrayOptions["options_type"] =="select"){ ?>
																				<select class="form-control" name="optionsAdd[]" required>
																					<option value="">Siyahıdan seçin</option>
																					<?php
																						$elanDetail_value=$elan_detail_item['elanDetail_value'];
																						$city_list=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id='$elanDetail_value' ");
																						$city=mysqli_fetch_array($city_list);

																						$suboptions_list=mysqli_query($connect, "SELECT *  FROM suboptions");
																						while($suboptions_list_item=mysqli_fetch_array($suboptions_list)){ ?>
																						<option value="<?php echo $suboptions_list_item["suboptions_id"] ?>" <?php if($suboptions_list_item["suboptions_id"] == $city['suboptions_id']){ echo "selected"; } ?>><?php echo $suboptions_list_item["suboptions_title"] ?></option>
																					<?php  }
																					?>
																				</select>
																		<?php } else { ?>
																			<input type="text" class="form-control" placeholder="Bu sahəni doldurun" name="optionsAdd[]" value="<?php echo $fetchArray["elan_name"] ?>" required>
																		<?php }
																		?>
																	</div>
															<?php }
															?>
															<input type="hidden" name="inputHiddenID" value="<?php echo $fetchArray["elan_id"] ?>">
															<button type="submit" class="btn btn-primary float-right mt-4">Elan Detaylarını Yenilə</button>
														</form>
													</div>
											<?php } else {
                                                    echo '
                                                    <div class="callout callout-info w-100">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Elana aid heç bir əlavə məlumat yerləşdirilməyib</p>
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
												<?php if(mysqli_num_rows($elanImg_list) > 0){ 
													while($elalarImages=mysqli_fetch_array($elanImg_list)){ ?>
														<div style="width:200px; height:200px; position:relative">
															<img src="../img/advert/<?php echo $elalarImages['img_path'] ?>" alt="<?php echo $elalarImages['img_id'] ?>" class="elanImgItems" width="200px" height="200px">
															<i class="fas fa-times position-absolute text-danger jsCloseIcon" style="top:10px; right:10px; cursor:pointer;font-size:20px" id="<?php echo $elalarImages['img_id'] ?>"></i>
														</div>
												<?php	}
												} else {
                                                    echo '
                                                    <div class="callout callout-info w-100">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Elanda heç bir şəkil paylaşılmamışdır</p>
                                                    </div>
                                                    ';
                                                }
												?>
											</div>
										</div>
										<!-- /.tab-pane -->

										<!-- ============ [elan istifadeci tab section] ================= -->
										<?php   
										$idCustomer_id=$fetchArray["customer_id"];
										$customer_list=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id='$idCustomer_id' "); 
										$idCustomer=mysqli_fetch_array($customer_list); ?>
											
										<div class="tab-pane" id="personLine">
											<div class="row">
												<?php if(mysqli_num_rows($customer_list) > 0){ ?>
													<div class="col-12">
														<!-- form start -->
														<form class="update-elanIstifad-form" autocomplete="off">
															<div class="form-group">
																<label for="inputCustomersName">Elan verənin adı</label>
																<input type="text" class="form-control" id="inputCustomersName" placeholder="Elan verənin adını daxil edin" name="inputCustomersName" value="<?php echo $idCustomer["customer_name"] ?>">
															</div>
															<div class="form-group">
																<label for="inputCustomersEmailAddress">Email address</label>
																<input type="text" class="form-control" id="inputCustomersEmailAddress" placeholder="Elan verənin email addressini daxil edin" name="inputCustomersEmailAddress" value="<?php echo $idCustomer["customer_email"] ?>">
															</div>
															<div class="form-group">
																<label for="inputCustomersPhone">Əlaqə Nömrəsi</label>
																<input type="text" class="form-control" id="inputCustomersPhone" placeholder="Elan verənin əlaqə nömrəsini daxil edin" name="inputCustomersPhone" value="<?php echo $idCustomer["customer_phone"] ?>">
															</div>
															<input type="hidden" name="inputHiddenID" value="<?php echo $idCustomer["customer_id"] ?>">
															<button type="submit" class="btn btn-primary float-right mt-4">İstifadəçini Yenilə</button>
														</form>
													</div>
											<?php } else {
                                                    echo '
                                                    <div class="callout callout-info w-100">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>İstifadəçi haqqında heç bir məlumat yoxdur</p>
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