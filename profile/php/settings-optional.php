<?php
	if(isset($_POST)){

		session_start();

		include("../../assets/include/connectDB.php");
		include("../../assets/include/function.php");

		$data=array();

		$inputFullName=mysqli_real_escape_string($connect, trim($_POST["username"]));
		$inputUserEmail=mysqli_real_escape_string($connect, trim($_POST["email"]));
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));
		
		$controlFullName=controlTitle($inputFullName, "İstifadəçi adı", 2);
		if($controlFullName==true){
			$controlUserEmail=controlEmail($inputUserEmail, "Email");
			if($controlUserEmail==true){
				$query=mysqli_query($connect,"SELECT * FROM users WHERE user_id='$inputHiddenID' AND user_status='user'");
				if(mysqli_num_rows($query) > 0){
					
					$updateGeneralSettings=mysqli_query($connect,"UPDATE users SET user_name='$inputFullName', user_email='$inputUserEmail' WHERE user_id='$inputHiddenID'");
					
					if($updateGeneralSettings){

						$data["ok"]="ok";
						$data["text"]="Təbriklər! Məlumatlar başarılı şəkildə dəyişdirildi.";
					
						echo json_encode($data);
					} else {
						$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
					
						echo json_encode($data);
					}					
				} else {
					session_destroy();
					$data["logout"]="logout";
					
					echo json_encode($data);
				}
			}
		}
		mysqli_close($connect);
	}
?>