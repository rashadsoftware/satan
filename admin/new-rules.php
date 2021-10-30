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
			dynamic_title("İdarəetmə Paneli | Mətn Tənzimləmələri");
		?>
		<script>
            $(function(){
                $(".page-title").html("Mətn Tənzimləmələri");
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
						</div>
                        <div class="row">
                            <div class="col-7 col-md-7">
								<!-- general form elements -->
								<div class="card card-primary">
									<div class="card-header">
										<h3 class="card-title">Yeni Mətn Tənzimləmələri</h3>
									</div>
									<!-- /.card-header -->
									<!-- form start -->
									<form class="create-rules-form" autocomplete="off">
										<div class="card-body">
											<div class="form-group">
                                                <label>Ana kateqoriya</label>
                                                <select class="form-control" name="selectCategory" id="selectCategory">
                                                    <option value="">Siyahıdan seçin</option>
													<option value="about">Haqqımızda</option>
													<option value="rules">Qaydalar</option>
													<option value="services">Xidmətlər</option>
													<option value="payment">Ödəniş</option>
													<option value="contact">Əlaqə</option>
												</select>
                                            </div>
											<div class="form-group" id="services">
                                                <label for="inputServices">Xidmət Başlığı</label>
                                                <input type="text" class="form-control" id="inputServices" placeholder="Xidmətin başlığını daxil edin" name="inputServices">
                                            </div>
											<div class="form-group">
												<textarea class="form-control" rows="7" placeholder="Yeni qaydanı buraya daxil edin..." name="textareaRules"></textarea>
											</div>
										</div>
										<!-- /.card-body -->

										<div class="card-footer">
										<button type="submit" class="btn btn-primary float-right">Yarat</button>
										</div>
									</form>
								</div>
								<!-- /.card -->
							</div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary card-outline card-tabs">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Haqqımızda</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Qaydalar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Xidmətlər</a>
                                            </li>
											<li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-payment-tab" data-toggle="pill" href="#custom-tabs-three-payment" role="tab" aria-controls="custom-tabs-three-payment" aria-selected="false">Ödəniş</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-contact-tab" data-toggle="pill" href="#custom-tabs-three-contact" role="tab" aria-controls="custom-tabs-three-contact" aria-selected="false">Əlaqə</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-three-tabContent">

                                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <?php
												$categories_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='about' ");
												if(mysqli_num_rows($categories_list) > 0){  ?>
												<div class="col-12">
													<div class="card">
														<!-- /.card-header -->
														<div class="card-body">
															<table class="table table-head-fixed table-bordered table-hover table-responsive" id="example1">
																<thead>
																	<tr>
																		<th class="text-center">Mətn</th>
																		<th width="7%" class="text-center">Əməliyyatlar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	while($category=mysqli_fetch_array($categories_list)){ ?>
																		<tr>
																			<td><?php echo $category["parametres_value"] ?></td>
																			<td class="text-center">
																				<a href="update-parametres?id=<?php echo $category["parametres_id"] ?>&action=update" class="btn btn-primary">
																					<i class="fa fa-edit"></i>
																				</a>
																				<button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['parametres_id'] ?>, 'php/deleteRules', 'alertListRules')"><i class="fa fa-trash-alt"></i></button>
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

                                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <?php
												$categories_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='rules' ");
												if(mysqli_num_rows($categories_list) > 0){  ?>
												<div class="col-12">
													<div class="card">
														<!-- /.card-header -->
														<div class="card-body">
															<table class="table table-head-fixed table-bordered table-hover table-responsive " id="example2">
																<thead>
																	<tr>
																		<th class="text-center">Mətn</th>
																		<th width="7%" class="text-center">Əməliyyatlar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	while($category=mysqli_fetch_array($categories_list)){ ?>
																		<tr>
																			<td><?php echo $category["parametres_value"] ?></td>
																			<td class="text-center">
																				<a href="update-parametres?id=<?php echo $category["parametres_id"] ?>&action=update" class="btn btn-primary">
																					<i class="fa fa-edit"></i>
																				</a>
																				<button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['parametres_id'] ?>, 'php/deleteRules', 'alertListRules')"><i class="fa fa-trash-alt"></i></button>
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

                                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                            <?php
												$categories_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='services' ");
												if(mysqli_num_rows($categories_list) > 0){  ?>
												<div class="col-12">
													<div class="card">
														<!-- /.card-header -->
														<div class="card-body">
															<table class="table table-head-fixed table-bordered table-hover table-responsive" id="example3">
																<thead>
																	<tr>
																		<th class="text-center">Mətn</th>
																		<th width="7%" class="text-center">Əməliyyatlar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	while($category=mysqli_fetch_array($categories_list)){ ?>
																		<tr>
																			<td><?php echo $category["parametres_value"] ?></td>
																			<td class="text-center">
																				<a href="update-parametres?id=<?php echo $category["parametres_id"] ?>&action=update" class="btn btn-primary">
																					<i class="fa fa-edit"></i>
																				</a>
																				<button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['parametres_id'] ?>, 'php/deleteRules', 'alertListRules')"><i class="fa fa-trash-alt"></i></button>
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
											<div class="tab-pane fade" id="custom-tabs-three-payment" role="tabpanel" aria-labelledby="custom-tabs-three-payment-tab">
                                            <?php
												$categories_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='payment' ");
												if(mysqli_num_rows($categories_list) > 0){  ?>
												<div class="col-12">
													<div class="card">
														<!-- /.card-header -->
														<div class="card-body">
															<table class="table table-head-fixed table-bordered table-hover table-responsive" id="example4">
																<thead>
																	<tr>
																		<th class="text-center">Mətn</th>
																		<th width="7%" class="text-center">Əməliyyatlar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	while($category=mysqli_fetch_array($categories_list)){ ?>
																		<tr>
																			<td><?php echo $category["parametres_value"] ?></td>
																			<td class="text-center">
																				<a href="update-parametres?id=<?php echo $category["parametres_id"] ?>&action=update" class="btn btn-primary">
																					<i class="fa fa-edit"></i>
																				</a>
																				<button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['parametres_id'] ?>, 'php/deleteRules', 'alertListRules')"><i class="fa fa-trash-alt"></i></button>
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
											<div class="tab-pane fade" id="custom-tabs-three-contact" role="tabpanel" aria-labelledby="custom-tabs-three-contact-tab">
                                            <?php
												$categories_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='contact' ");
												if(mysqli_num_rows($categories_list) > 0){  ?>
												<div class="col-12">
													<div class="card">
														<!-- /.card-header -->
														<div class="card-body">
															<table class="table table-head-fixed table-bordered table-hover table-responsive"  id="example5">
																<thead>
																	<tr>
																		<th class="text-center">Mətn</th>
																		<th width="7%" class="text-center">Əməliyyatlar</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	while($category=mysqli_fetch_array($categories_list)){ ?>
																		<tr>
																			<td><?php echo $category["parametres_value"] ?></td>
																			<td class="text-center">
																				<a href="update-parametres?id=<?php echo $category["parametres_id"] ?>&action=update" class="btn btn-primary">
																					<i class="fa fa-edit"></i>
																				</a>
																				<button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $category['parametres_id'] ?>, 'php/deleteRules', 'alertListRules')"><i class="fa fa-trash-alt"></i></button>
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
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
					</div>
				</section>
				<!-- /.content -->

                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="legv-etme-form">
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