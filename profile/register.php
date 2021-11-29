<?php
	error_reporting(0);
    session_start();

    if(isset($_SESSION["ProfilEmail"])){
		header("Location:dashboard");
	}

	include_once 'include/header.php'
?>
    <div class="d-flex align-items-center justify-content-center w-100" style="height:100vh; background:#f1f3f7">
        <div class="card" style="width:400px">
            <div class="card-body">
                <img src="../img/<?php echo $data['company_logo'] ?>" alt="" style="width:50%; margin:1px auto 25px; display:block">
                <div class="alert alert-danger register-text" id="alert_hide"></div>
                <form class="mb-3 register-form" autocomplete="off">
                    <div class="form-group">
                        <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email ünvanınızı daxil edin" name="email">
                        <small id="emailHelp" class="form-text text-muted">E-poçt ünvanınız heç bir halda paylaşılmayacaqdır</small>
                    </div>
                    <div class="form-group position-relative">
                        <input type="password" class="form-control" id="password" placeholder="Şifrənizi daxil edin" name="password">
                        <span class="fas fa-eye icon-eye" id="password_show_hide"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Qeydiyyatdan Keç</button>
                </form>
                <p class="mb-0 mt-4">Siz artıq qeydiyyatdan keçmisiniz? <br><a href="index">Hesaba daxil olun</a></p>
            </div>
        </div>
    </div>
<?php
	error_reporting(0);
	include_once 'include/footer.php'
?>  