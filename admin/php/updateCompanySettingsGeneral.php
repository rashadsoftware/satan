<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputCompanyName=mysqli_real_escape_string($connect, trim($_POST["inputCompanyName"]));
		
		$controlCompanyName=controlTitle($inputCompanyName, "Şirkətin Adı", 5);
		if($controlCompanyName==true){
            $query=mysqli_query($connect,"SELECT * FROM companies WHERE company_status='main'");
			if(mysqli_num_rows($query) > 0){				
				$updateGeneralSettings=mysqli_query($connect,"UPDATE companies SET company_name='$inputCompanyName' WHERE company_status='main'");
				if($updateGeneralSettings){
					$data["ok"]="ok";
					$data["text"]="Şirkətin veriləri başarılı şəkildə dəyişdirildi !";
				
					echo json_encode($data);
				} else {
					$data["text"]="Xəta yarandı. Yenidən cəhd edin.";
				
					echo json_encode($data);
				}
			} else {
				$data["text"]="Şirkət mövcud deyil. Yenidən cəhd edin.";
				
				echo json_encode($data);
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>