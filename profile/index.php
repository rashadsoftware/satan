<?php
	error_reporting(0);
    session_start();

    if(isset($_SESSION["ProfilEmail"])){
		header("Location:dashboard");
	}

	include('include/header.php');

	header_title("header", "Giriş");
?>
    <body>
		<div class="d-flex align-items-center justify-content-center w-100" style="height:70vh">
			<div class="card" style="width:400px">
				<div class="card-body">
					<img src="../img/<?php echo $data['company_logo'] ?>" alt="" style="width:50%; margin:1px auto 25px; display:block">
					<div class="alert alert-danger login-text alert_hide"></div>
					<p class="text-center" style="color:#a6abb4; font-size:17px">Öz elanlarınıza baxmağın, onları redaktə və bərpa etməyin rahat yolu</p>
					<form class="mb-3 login-form" autocomplete="off">
						<div class="form-group">
							<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email ünvanınızı daxil edin" name="email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>">
							<small id="emailHelp" class="form-text text-muted">E-poçt ünvanınız heç bir halda paylaşılmayacaqdır</small>
						</div>
						<div class="form-group position-relative">
							<input type="password" class="form-control" id="password" placeholder="Şifrənizi daxil edin" name="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>">
							<span class="fas fa-eye icon-eye" id="password_show_hide"></span>
						</div>
						<div class="custom-control custom-checkbox mb-3">
							<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
							<label class="custom-control-label" for="customCheck1">Məni yadda saxla</label>
						</div>
						<button type="submit" class="btn btn-primary">Hesaba Daxil Olmaq</button>
					</form>
					<p class="mb-0 mt-4">Sizin hesabınız yoxdur? <br><a href="register">Qeydiyyatdan Keç</a></p>
				</div>
			</div>
		</div>		
    </body>
</html>
<?php
	error_reporting(0);
	include_once 'include/footer.php'
?> 