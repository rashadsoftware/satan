<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectSocialType=mysqli_real_escape_string($connect, trim($_POST["selectSocialType"]));
        $selectSocialHiperlink=mysqli_real_escape_string($connect, trim($_POST["selectSocialHiperlink"]));
        
        $controlSocialNetworks=controlSelect($selectSocialType, "Sosial seçim");
		if($controlSocialNetworks==true){
            $controlInputSocialAddress=controlURL($selectSocialHiperlink, "URL");
            if($controlInputSocialAddress==true){
                $updateRules=mysqli_query($connect,"UPDATE configs SET configs_value='$selectSocialHiperlink' WHERE configs_key = '$selectSocialType'");
				
				if($updateRules){

					$data["ok"]="ok";
					$data["text"]="Sosial şəbəkənin URL-si başarılı şəkildə dəyişdirildi.";
			
					echo json_encode($data);
				} else {
					$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
				
					echo json_encode($data);
				}
            }
        }
		
		mysqli_close($connect);
	}
	
	
?>