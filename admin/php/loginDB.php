<?php
	if(isset($_POST)){

		session_start();

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputEmail=mysqli_real_escape_string($connect, trim($_POST["email"]));
		$inputPassword=mysqli_real_escape_string($connect, trim($_POST["password"]));
		
		$controlEmail=controlEmail($inputEmail, "Email");
		if($controlEmail==true){
			$controlPassword=controlPassword($inputPassword, 5, "Şifrə");
			if($controlPassword==true){
				$query=mysqli_query($connect,"SELECT * FROM users WHERE user_email='$inputEmail'");
				
				if(mysqli_num_rows($query) > 0){

					$user_data=mysqli_fetch_array($query);
					
					$user_password=$user_data["user_password"];
					$user_email=$user_data["user_email"];
					$user_status=$user_data["user_status"];
					$user_id=$user_data["user_id"];
					$user_login=$user_data["user_login"];
					
					if($user_status=="admin"){
						if($user_email==$inputEmail && $user_password==$inputPassword){

							if($user_login == "close"){
								$_SESSION["user_email"]=$user_email;
								$_SESSION["entry_status"]=$user_status;
								$_SESSION["id"]=$user_id;

								mysqli_query($connect,"UPDATE users SET user_login='open' WHERE user_status ='admin' AND user_email='$inputEmail' ");

								$data["ok"]="ok";
								
								echo json_encode($data);
							} else if($user_login == "open"){
								$_SESSION["entry_status"]=$user_status;
								$_SESSION["user_email"]=$user_email;
								$_SESSION["id"]=$user_id;

								$data["err"]="error";
								
								echo json_encode($data);
							}
						} else {
							$data["text"]="Email address vəya şifrə yalnışdır. Yenidən cəhd edin!";
							
							echo json_encode($data);
						}
					}else {
						$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
						
						echo json_encode($data);
					}
					
				} else {
					$data["text"]="Bu hesaba aid istifadəçi tapılmadı. Yenidən cəhd edin!";
					
					echo json_encode($data);
				}
			}
		}
		mysqli_close($connect);
	}
?>