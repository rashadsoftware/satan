<?php
	error_reporting(0);
	session_start();

	include("include/connectDB.php"); 

	if($_SESSION["entry_status"] =="admin"){
		header("Location:dashboard");
	} else { ?>
		<!DOCTYPE html>
		<html lang="az">
			<head>
				<?php
					include("include/head_tag.php");
					dynamic_title("İdarəetmə Paneli | Giriş");
				?>
			</head>
			<body class="hold-transition login-page">
				<div class="login-box">
					<div class="login-logo">
						<span><b>İdarəetmə Paneli</b></span>
					</div>
					<!-- /.login-logo -->
					<div class="card">
						<div class="card-body login-card-body">
							<p class="login-box-msg">Sistemə giriş üçün oturum açın</p>

							<?php
								dynamic_alert_notification("alertLogin");
							?>

							<form class="login-form" autocomplete="off">
								<div class="form-group mb-3">
									<input type="email" class="form-control" placeholder="Email" name="email" required/>
								</div>
								<div class="form-group mb-3 position-relative">
									<input type="password" class="form-control" placeholder="Şifrə" name="password" id="password" required/>
									<span class="fas fa-eye passw-eye" id="password_show_hide"></span>
								</div>
								<div class="row">
									<div class="col-12">
										<button type="submit" class="btn btn-primary btn-block">
											Sign In
										</button>
									</div>
									<!-- /.col -->
								</div>
							</form>
						</div>
						<!-- /.login-card-body -->
					</div>
				</div>
				<!-- /.login-box -->

				<!-- AdminLTE App -->
				<script src="js/adminlte.min.js"></script>
				<script src="js/main19.js"></script>
			</body>
		</html>
<?php	}

	mysqli_close($connect);
?>
