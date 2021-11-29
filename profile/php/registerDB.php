<?php
	if(isset($_POST)){

		session_start();

		include("../../assets/include/connectDB.php");
		include("../../assets/include/function.php");

		$data=array();

		$inputEmail=mysqli_real_escape_string($connect, trim($_POST["email"]));
		$inputPassword=mysqli_real_escape_string($connect, trim($_POST["password"]));
		
		$controlEmail=controlEmail($inputEmail, "Email");
		if($controlEmail==true){
			$controlPassword=controlPassword($inputPassword, 5, "Şifrə");
			if($controlPassword==true){
				$query=mysqli_query($connect,"SELECT * FROM users WHERE user_email='$inputEmail' AND user_status='user' ");
				
				if(mysqli_num_rows($query) > 0){
                    $data["text"]="Bu hesaba aid istifadəçi artıq qeydiyyatdan keçib. Yenidən cəhd edin!";
					
					echo json_encode($data);
					
				} else {
					$newUser = "INSERT IGNORE INTO users (user_email, user_password, user_status) VALUES ('$inputEmail', '$inputPassword', 'user')";

                    if(mysqli_query($connect, $newUser)){
                        $_SESSION["ProfilEmail"]=$inputEmail;

                        $data["ok"]="ok";                
                        echo json_encode($data);
                    } else {
                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                    
                        echo json_encode($data);
                    }
				}
			}
		}
		mysqli_close($connect);
	}
?>