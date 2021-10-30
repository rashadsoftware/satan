<?php
	if(isset($_POST)){

		session_start();

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputOldPassword=mysqli_real_escape_string($connect, trim($_POST["inputOldPassword"]));
		$inputNewPassword=mysqli_real_escape_string($connect, trim($_POST["inputNewPassword"]));
		$inputConfirmPassword=mysqli_real_escape_string($connect, trim($_POST["inputConfirmPassword"]));
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));
		
		$controlOldPassword=controlPassword($inputOldPassword, 5, "Cari şifrə");
		if($controlOldPassword==true){
			$controlNewPassword=controlPassword($inputNewPassword, 5, "Yeni şifrə");
			if($controlNewPassword==true){
				$controlConfirmPassword=controlPassword($inputConfirmPassword, 5, "Təkrar şifrə");
				if($controlConfirmPassword==true){
					$query=mysqli_query($connect,"SELECT * FROM users WHERE user_id='$inputHiddenID'");
								
					if(mysqli_num_rows($query) > 0){
						$user_password_data=mysqli_fetch_array($query);

						$user_password=$user_password_data["user_password"];
					
						if($inputOldPassword==$user_password){
							if($inputNewPassword==$user_password){
								$data["text"]="Yeni şifrə kimi cari şifrəni təkrar istifadə olmaz.";
									
								echo json_encode($data);
							} else {
								if($inputNewPassword==$inputConfirmPassword){
									$updatePasswordSettings=mysqli_query($connect,"UPDATE users SET user_password='$inputNewPassword' WHERE user_id='$inputHiddenID'");
									
									if($updatePasswordSettings){
										session_destroy();

										$data["ok"]="ok";
										$data["text"]="Şifrə başarılı şəkildə dəyişdirildi. !";
									
										echo json_encode($data);
									} else {
										$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
									
										echo json_encode($data);
									}
								} else {
									$data["text"]="Təkrar şifrə yeni şifrə ilə uyğunlaşmır. Yenidən cəhd edin.";
									
									echo json_encode($data);
								}
							}
						} else {
							$data["text"]="Cari şifrə düzgün deyil. Yenidən cəhd edin.";
								
							echo json_encode($data);
						}
					} else {
						$data["text"]="Bu hesaba aid istifadəçi tapılmadı. Yenidən cəhd edin.";
									
						echo json_encode($data);
					}
				}
			}
		}
		
		mysqli_close($connect);
	}
	
	
?>