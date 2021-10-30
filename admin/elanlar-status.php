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
			dynamic_title("İdarəetmə Paneli | Status Dəyişmə");
		?>
		<script>
            $(function(){
                $(".page-title").html("Status Dəyişmə");
                $("#opt_list_adverts").addClass("menu-open");
				$("#adverts").addClass("active");
                $("#list_elanlar_status").addClass("active");
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
									dynamic_alert_notification("alertElanlarStatus");
								?>
							</div>
						</div>

                        <div class="row">
                            <div class="col-md-4 col-lg-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Elan Axtarma</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="">
                                            <div class="form-group">
                                                <label for="elanID">Elan ID</label>
                                                <input type="text" class="form-control" id="elanID" placeholder="Elanın ID-sini daxil edin">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Axtar</button>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-8 col-lg-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <p>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Elanı irəli çək
                                            </a>
                                            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                                                VIP et
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <a href="#" class="btn btn-default">1 AZN</a>
                                                <a href="#" class="btn btn-default">2 AZN</a>
                                                <a href="#" class="btn btn-default">3 AZN</a>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseExample2">
                                            <div class="card card-body">
                                                <a href="#" class="btn btn-default">5 AZN</a>
                                                <a href="#" class="btn btn-default">8 AZN</a>
                                                <a href="#" class="btn btn-default">12 AZN</a>
                                            </div>
                                        </div>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Email</b> <a class="float-right">rashadalakbarov2020@gmail.com</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Telefon</b> <a class="float-right text-capitalize">055 5356565</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Status</b> <a class="float-right text-capitalize">Administrator</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-12">
                            <?php
                                $elan_list=mysqli_query($connect, "SELECT *  FROM elan ");
                                if(mysqli_num_rows($elan_list) > 0){  ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-head-fixed table-bordered table-hover" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ID</th>
                                                        <th class="text-center">Kateqoriya</th>
                                                        <th class="text-center" width="260px">Elanın adı</th>
                                                        <th class="text-center">İstifadəçinin adı</th>
                                                        <th class="text-center">Əlaqə nömrəsi</th>
                                                        <th class="text-center">E-Poçt</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Köçürmələr</th>
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
                                                            <td class="text-center">Rəşad Ələkbərov</td>
                                                            <td class="text-center">0558215673</td>
                                                            <td class="text-center">rashadal@gmail.com</td>
                                                            <?php
                                                                if($elan["elan_status"]=="active"){ ?>
                                                                    <td class="text-center text-success">VIP sistemə qoşulub</td>
                                                            <?php   } else if($elan["elan_status"]=="deactive"){ ?>
                                                                    <td class="text-center text-danger">Müddəti bitmişdir</td>
                                                            <?php   } else { ?>
                                                                <td class="text-center text-primary">Gözləmə rejimindədir</td>
                                                            <?php }
                                                            ?>
                                                            <td class="text-center">
                                                                <button id="<?php echo $elan["elan_id"] ?>" class="btn btn-info simple">
                                                                    <i class="fas fa-vial"></i>
                                                                </button>
                                                                <button id="<?php echo $elan["elan_id"] ?>" class="btn btn-secondary prmium">
                                                                    <i class="far fa-gem"></i>
                                                                </button>
                                                                <button id="<?php echo $elan["elan_id"] ?>" class="btn btn-warning vp">
                                                                <i class="fas fa-crown"></i>
                                                                </button>
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