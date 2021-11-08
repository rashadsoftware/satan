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
			dynamic_title("İdarəetmə Paneli | Elanlar");
		?>
		<script>
            $(function(){
                $(".page-title").html("Elanlar");
                $("#opt_list_adverts").addClass("menu-open");
				$("#adverts").addClass("active");
                $("#list_elanlar").addClass("active");
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
									dynamic_alert_notification("alertElanlar");
								?>
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary card-outline card-tabs">
                                    <div class="card-header p-0 pt-1 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Bütün əməliyyatlar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Təstiq Gözləyənlər</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Deaktiv olanlar</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-deadline-tab" data-toggle="pill" href="#custom-tabs-three-deadline" role="tab" aria-controls="custom-tabs-three-deadline" aria-selected="false">Müddəti Bitənlər</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-three-tabContent">
                                            <!-- all -->
                                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <?php
                                                $elan_list=mysqli_query($connect, "SELECT *  FROM elan ");
                                                if(mysqli_num_rows($elan_list) > 0){  ?>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="table table-head-fixed table-bordered table-hover" id="example1">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">ID</th>
                                                                        <th class="text-center">Kateqoriya</th>
                                                                        <th class="text-center" width="260px">Elanın adı</th>
                                                                        <th class="text-center">İcra vaxtı</th>
                                                                        <th class="text-center">Bitmə vaxtı</th>
                                                                        <th class="text-center">Status</th>
                                                                        <th class="text-center">Əməliyyatlar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while($elan=mysqli_fetch_array($elan_list)){ ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $elan["elan_id"] ?></td>
                                                                            <?php
                                                                                $elan_subcategory=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='".$elan['elan_kateqoriya']."' ");
                                                                                $elanSubCat=mysqli_fetch_array($elan_subcategory);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $elanSubCat["subcategory_title"] ?></td>
                                                                            <td class="text-center"><?php echo $elan["elan_name"] ?></td>
                                                                            <?php 
                                                                                $elan_time=$elan["elan_time"];
                                                                                list($date, $time)=explode(" ",$elan_time);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $date; ?></td>
                                                                            <?php 
                                                                                $elanIdTime=$elan["elan_id"];
                                                                                $elan_deadline=mysqli_query($connect, "SELECT *  FROM deadline WHERE elan_id='$elanIdTime' ");
                                                                                $elan_deadline_fetch=mysqli_fetch_array($elan_deadline);
                                                                                $elan_deadline_item=$elan_deadline_fetch['deadline_time'];

                                                                                list($date, $time)=explode(" ",$elan_deadline_item);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $date; ?></td>
                                                                            <?php
                                                                                if($elan["elan_status"]=="active"){ ?>
                                                                                    <td class="text-center text-success">Aktivdir</td>
                                                                            <?php   } else if($elan["elan_status"]=="deactive"){ ?>
                                                                                    <td class="text-center text-danger">Müddəti bitmişdir</td>
                                                                            <?php   } else { ?>
                                                                                <td class="text-center text-primary">Gözləmə rejimindədir</td>
                                                                            <?php }
                                                                            ?>
                                                                            <td class="text-center">
                                                                                <a href="view-elan?id=<?php echo $elan["elan_id"] ?>&action=view" class="btn btn-secondary">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <a href="update-elan?id=<?php echo $elan["elan_id"] ?>&action=update" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $elan['elan_id']; ?>, 'php/deleteElanlar', 'alertElanlar')"><i class="fa fa-trash-alt"></i></button>
                                                                                <?php
                                                                                if($elan["elan_status"] != "deactive"){ ?>
                                                                                    <button type="button" class="btn btn-info" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changePowerOffElan', 'alertElanlar')"><i class="fas fa-power-off"></i></button>
                                                                                <?php }
                                                                                ?>
                                                                                <button type="button" class="btn btn-success" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changeSadeElan', 'alertElanlar')"><i class="fab fa-stack-exchange"></i></button>
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
                                            <?php   } else {
                                                    echo '
                                                    <div class="callout callout-info">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Səhifədə heç bir elan paylaşılmamışdır</p>
                                                    </div>
                                                    ';
                                                }
                                            ?>
                                            </div>

                                            <!-- waiting -->
                                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <?php
                                                $elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='waiting' ");
                                                if(mysqli_num_rows($elan_list) > 0){  ?>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-head-fixed table-bordered table-hover" id="example2">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">ID</th>
                                                                        <th class="text-center">Kateqoriya</th>
                                                                        <th class="text-center">Elanın adı</th>
                                                                        <th class="text-center">Elanın vaxtı</th>
                                                                        <th class="text-center">Əməliyyatlar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while($elan=mysqli_fetch_array($elan_list)){ ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $elan["elan_id"] ?></td>
                                                                            <?php
                                                                                $elan_subcategory=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='".$elan['elan_kateqoriya']."' ");
                                                                                $elanSubCat=mysqli_fetch_array($elan_subcategory);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $elanSubCat["subcategory_title"] ?></td>
                                                                            <td class="text-center"><?php echo $elan["elan_name"] ?></td>
                                                                            <?php 
                                                                                $elan_time=$elan["elan_time"];
                                                                                list($date, $time)=explode(" ",$elan_time);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $date; ?></td>
                                                                            <td class="text-center">
                                                                                <a href="view-elan?id=<?php echo $elan["elan_id"] ?>&action=view" class="btn btn-secondary">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <button type="button" class="btn btn-success" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changeOptionsElan', 'alertElanlar')"><i class="fa fa-check"></i></button>
                                                                                <button type="button" class="btn btn-danger cancelBtn" data-id="<?php echo $elan['elan_id'] ?>"><i class="fa fa-times"></i></button>
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
                                            <?php   } else {
                                                echo '
                                                <div class="callout callout-info">
                                                    <h5>Bildiriş!</h5>
                                
                                                    <p>Hal hazırda təstiq gözləyən elanınız yoxdur</p>
                                                </div>
                                                ';
                                            }
                                            ?>
                                            </div>

                                            <!-- deactive -->
                                            <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                            <?php
                                                $elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='deactive' ");
                                                if(mysqli_num_rows($elan_list) > 0){  ?>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-head-fixed table-bordered table-hover" id="example3">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">ID</th>
                                                                        <th class="text-center">Kateqoriya</th>
                                                                        <th class="text-center">Elanın adı</th>
                                                                        <th class="text-center">Elanın vaxtı</th>
                                                                        <th class="text-center">Əməliyyatlar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    while($elan=mysqli_fetch_array($elan_list)){ ?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $elan["elan_id"] ?></td>
                                                                            <?php
                                                                                $elan_subcategory=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='".$elan['elan_kateqoriya']."' ");
                                                                                $elanSubCat=mysqli_fetch_array($elan_subcategory);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $elanSubCat["subcategory_title"] ?></td>
                                                                            <td class="text-center"><?php echo $elan["elan_name"] ?></td>
                                                                            <?php 
                                                                                $elan_time=$elan["elan_time"];
                                                                                list($date, $time)=explode(" ",$elan_time);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $date; ?></td>
                                                                            <td class="text-center">
                                                                                <a href="view-elan?id=<?php echo $elan["elan_id"] ?>&action=view" class="btn btn-secondary">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <button type="button" class="btn btn-success" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changeOptionsElan', 'alertElanlar')"><i class="fa fa-check"></i> &nbsp;Aktivləşdir</button>
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
                                            <?php   } else {
                                                echo '
                                                    <div class="callout callout-info">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Hal hazırda deaktiv elanınız yoxdur</p>
                                                    </div>
                                                ';
                                            }
                                            ?>
                                            </div>

                                            <!-- deadline -->
                                            <div class="tab-pane fade" id="custom-tabs-three-deadline" role="tabpanel" aria-labelledby="custom-tabs-three-deadline-tab">
                                            <?php
                                                // current time
                                                $nowTimeNew=time();

                                                $arrayTimeNew=[];

                                                // change timestamp to unix time 
                                                $deadline_list_one_new=mysqli_query($connect, "SELECT *  FROM deadline ");
                                                while($deadline_one_new=mysqli_fetch_array($deadline_list_one_new)){

                                                    $unixElanTimeNew=strtotime($deadline_one_new["deadline_time"]);
                                                    $idDeadlineElanNew=$deadline_one_new["elan_id"];

                                                    if($nowTimeNew > $unixElanTimeNew){
                                                        array_push($arrayTimeNew, $idDeadlineElanNew); 
                                                    }
                                                }                                          

                                                if(count($arrayTimeNew) > 0){  ?>                                                     
                                                <div class="col-12">
                                                    <div class="card">
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                            <table class="table table-head-fixed table-bordered table-hover" id="example4">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">ID</th>
                                                                        <th class="text-center">Kateqoriya</th>
                                                                        <th class="text-center">Elanın adı</th>
                                                                        <th class="text-center">Elanın vaxtı</th>
                                                                        <th class="text-center">Əməliyyatlar</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        for($d=0; $d < count($arrayTimeNew); $d++){ 
                                                                            $elan_list_deadline_elan=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$arrayTimeNew[$d]' "); 
                                                                            $elan=mysqli_fetch_array($elan_list_deadline_elan);?>
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $elan["elan_id"] ?></td>
                                                                            <?php
                                                                                $elan_subcategory=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='".$elan['elan_kateqoriya']."' ");
                                                                                $elanSubCat=mysqli_fetch_array($elan_subcategory);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $elanSubCat["subcategory_title"] ?></td>
                                                                            <td class="text-center"><?php echo $elan["elan_name"] ?></td>
                                                                            <?php 
                                                                                $elan_time=$elan["elan_time"];
                                                                                list($date, $time)=explode(" ",$elan_time);
                                                                            ?>
                                                                            <td class="text-center"><?php echo $date; ?></td>
                                                                            <td class="text-center">
                                                                                <a href="view-elan?id=<?php echo $elan["elan_id"] ?>&action=view" class="btn btn-secondary">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                                <button type="button" class="btn btn-success" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changeOptionsElan', 'alertElanlar')"><i class="fa fa-check"></i></button>
                                                                                <button type="button" class="btn btn-danger" onclick="deleteAjax(<?php echo $elan['elan_id']; ?>, 'php/deleteElanlar', 'alertElanlar')"><i class="fa fa-trash-alt"></i></button>
                                                                                <button type="button" class="btn btn-info" onclick="goAjax(<?php echo $elan['elan_id']; ?>, 'php/changePowerOffElan', 'alertElanlar')"><i class="fas fa-power-off"></i> &nbsp;Deaktiv et</button>
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
                                          <?php } else {
                                                echo '
                                                    <div class="callout callout-info">
                                                        <h5>Bildiriş!</h5>
                                    
                                                        <p>Müddəti bitmiş elan yoxdur</p>
                                                    </div>
                                                ';
                                                }
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