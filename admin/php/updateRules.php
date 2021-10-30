<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$textareaRules=mysqli_real_escape_string($connect, trim($_POST["textareaRules"]));
        $inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));
        
        $controlTextareaRules=controlTextNumber($textareaRules, "Yeni qaydalar alanı", 11);
		if($controlTextareaRules==true){
			$rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_id = '$inputHiddenID'");

            if(mysqli_num_rows($rules_list) > 0){
                $updateRules=mysqli_query($connect,"UPDATE parametres SET parametres_value='$textareaRules' WHERE parametres_id = '$inputHiddenID'");
				
				if($updateRules){

					$data["ok"]="ok";
					$data["text"]="Qaydanın veriləri başarılı şəkildə dəyişdirildi.";
			
					echo json_encode($data);
				} else {
					$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
				
					echo json_encode($data);
				}
            } else {
                $data["text"]="Verilənlər bazasında bu id addresə uyğun qayda yoxdur";
				
				echo json_encode($data);
            }
        }
		
		mysqli_close($connect);
	}
	
	
?>