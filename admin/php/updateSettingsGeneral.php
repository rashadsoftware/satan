<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputFullName=mysqli_real_escape_string($connect, trim($_POST["inputFullName"]));
		$inputUserEmail=mysqli_real_escape_string($connect, trim($_POST["inputUserEmail"]));
		$inputUserPhone=mysqli_real_escape_string($connect, trim($_POST["inputUserPhone"]));
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));
		
		$controlFullName=controlTitle($inputFullName, "İstifadəçi adı", 7);
		if($controlFullName==true){
			$controlUserEmail=controlEmail($inputUserEmail, "Email");
			if($controlUserEmail==true){
				$controlUserPhone=controlPhone($inputUserPhone, "Telefon", 10);
				if($controlUserPhone==true){
					$query=mysqli_query($connect,"SELECT * FROM users WHERE user_id='$inputHiddenID'");
					if(mysqli_num_rows($query) > 0){
						
						$updateGeneralSettings=mysqli_query($connect,"UPDATE users SET user_name='$inputFullName', user_email='$inputUserEmail', user_phone='$inputUserPhone' WHERE user_id='$inputHiddenID'");
						
						if($updateGeneralSettings){

							$data["ok"]="ok";
							$data["text"]="Verilər başarılı şəkildə dəyişildi. !";
						
							echo json_encode($data);
						} else {
							$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
						
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