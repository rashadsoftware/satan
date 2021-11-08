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
                                        <form action="#" id="formElanID" autocomplete="off">
                                            <!-- 76234276 -->
                                            <div class="form-group">
                                                <label for="elanID">Elan ID</label>
                                                <input type="text" class="form-control" id="elanID" placeholder="Elanın ID-sini daxil edin" name="elanID">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Axtar</button>
                                        </form>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-8 col-lg-6">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h6 class="mb-2 font-weight-bold">VIP et</h6>
                                        <div class="vipData mb-3">
                                            <button data-id="5" class="btn btn-default btnVip">5 AZN</button>
                                            <button data-id="8" class="btn btn-default btnVip">8 AZN</button>
                                            <button data-id="12" class="btn btn-default btnVip">12 AZN</button>
                                        </div>   
                                        
                                        <h6 class="mb-2 font-weight-bold">Elanı irəli çək</h6>
                                        <div class="simpleData mb-3">
                                            <button data-id="1" class="btn btn-default btnSimple">1 AZN</button>
                                            <button data-id="2" class="btn btn-default btnSimple">2 AZN</button>
                                            <button data-id="3" class="btn btn-default btnSimple">3 AZN</button>
                                        </div>

                                        <ul class="list-group list-group-unbordered mb-3" id="listData"></ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-12">
                            <?php
                                $elan_list=mysqli_query($connect, "SELECT *  FROM forward ");
                                if(mysqli_num_rows($elan_list) > 0){  ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-head-fixed table-bordered table-hover" id="example1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Kateqoriya</th>
                                                        <th class="text-center" width="260px">Elanın adı</th>
                                                        <th class="text-center">İstifadəçinin adı</th>
                                                        <th class="text-center">Əlaqə nömrəsi</th>
                                                        <th class="text-center">E-Poçt</th>
                                                        <th class="text-center">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while($elan=mysqli_fetch_array($elan_list)){ ?>
                                                        <tr>
                                                            <?php
                                                                $elan_fetch=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='".$elan['elanID']."' ");
                                                                $elanData=mysqli_fetch_array($elan_fetch);

                                                                $elan_subcategory=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='".$elanData['elan_kateqoriya']."' ");
                                                                $elanSubCat=mysqli_fetch_array($elan_subcategory);

                                                                $elan_customer=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id='".$elanData['customer_id']."' ");
                                                                $customerItem=mysqli_fetch_array($elan_customer);
                                                            ?>
                                                            <td class="text-center"><?php echo $elanSubCat["subcategory_title"] ?></td>
                                                            <td class="text-center"><?php echo $elanData["elan_name"] ?></td>
                                                            <td class="text-center"><?php echo $customerItem["customer_name"] ?></td>
                                                            <td class="text-center"><?php echo $customerItem["customer_phone"] ?></td>
                                                            <td class="text-center"><?php echo $customerItem["customer_email"] ?></td>
                                                            <?php
                                                                if($elan["forward_status"]=="active"){ ?>
                                                                    <td class="text-center text-success">Aktivdir</td>
                                                            <?php   } else { ?>
                                                                    <td class="text-center text-danger">Aktivlik müddəti bitmişdir</td>
                                                            <?php   }  ?>
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

            <script>
                $(function(){
                    // Update Optional Information Form
                    $("#formElanID").on("submit", function (e) {
                        e.preventDefault();

                        $.ajax({
                            url: "php/searchIDData.php",
                            type: "post",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (data) {
                                if (data.ok) {                                    
                                    $(".btnSimple").attr("id", data.id);
                                    $(".btnVip").attr("id", data.id);
                                }

                                $("#listData").html(data.text);
                            },
                        });
                    });

                    // Update Optional Information Form
                    $(".btnSimple").on("click", function () {

                        var dataID=$(this).attr("data-id");
                        var elanID=$(this).attr("id");
                        var action="simple";

                        if (typeof elanID !== 'undefined' && elanID !== false) {                        
                            $.ajax({
                                url: "php/changeSimple.php",
                                type: "post",
                                data: {dataID:dataID, action:action, elanID:elanID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.ok) {
                                        $("#alertElanlarStatus").removeClass("alert-danger");
                                        $("#alertElanlarStatus").addClass("alert-success");

                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        $("#alertElanlarStatus").removeClass("alert-success");
                                        $("#alertElanlarStatus").addClass("alert-danger");
                                    }

                                    $("#alertElanlarStatus").css("display", "block");
                                    $("#alertElanlarStatus").html(data.text);
                                },
                            });
                        }
                        
                    });

                    // Update Optional Information Form
                    $(".btnVip").on("click", function () {

                        var dataID=$(this).attr("data-id");
                        var elanID=$(this).attr("id");
                        var action="vip";

                        if (typeof elanID !== 'undefined' && elanID !== false) {
                            $.ajax({
                                url: "php/changeVip.php",
                                type: "post",
                                data: {dataID:dataID, action:action, elanID:elanID},
                                dataType: "json",
                                success: function (data) {
                                    if (data.ok) {
                                        $("#alertElanlarStatus").removeClass("alert-danger");
                                        $("#alertElanlarStatus").addClass("alert-success");

                                        setTimeout(function () {
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        $("#alertElanlarStatus").removeClass("alert-success");
                                        $("#alertElanlarStatus").addClass("alert-danger");
                                    }

                                    $("#alertElanlarStatus").css("display", "block");
                                    $("#alertElanlarStatus").html(data.text);
                                },
                            });
                        }                   

                    });
                });
            </script>

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