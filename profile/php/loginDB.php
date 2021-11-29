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

					$user_data=mysqli_fetch_array($query);
					
					$user_password=$user_data["user_password"];
					$user_email=$user_data["user_email"];
					
					if($user_email==$inputEmail && $user_password==$inputPassword){
                        $_SESSION["ProfilEmail"]=$inputEmail;

                        $data["ok"]="ok";								
                        echo json_encode($data);
                    } else {
                        $data["text"]="Email address vəya şifrə yalnışdır. Yenidən cəhd edin!";
                        
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