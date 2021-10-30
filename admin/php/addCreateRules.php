<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectCategory=mysqli_real_escape_string($connect, trim($_POST["selectCategory"]));
        $inputServices=mysqli_real_escape_string($connect, trim($_POST["inputServices"]));
        $textareaRules=mysqli_real_escape_string($connect, trim($_POST["textareaRules"]));
        
        $controlSelectCategory=controlSelect($selectCategory, "Ana Kateqoriya");
		if($controlSelectCategory==true){
            if($selectCategory == "services"){
                $controlInputServices=controlTitle($inputServices, "Xidmətin Başlığı", 2);
                if($controlInputServices==true){
                    $controlTextareaRules=controlTextNumber($textareaRules, "Yeni qaydalar sahəsi", 11);
                    if($controlTextareaRules==true){
                        $newRules = "INSERT IGNORE INTO parametres (parametres_key, parametres_title, parametres_value) VALUES ('$selectCategory', '$inputServices', '$textareaRules')";

                        if(mysqli_query($connect, $newRules)){

                            $data["ok"]="ok";
                            $data["text"]="Yeni qayda başarılı şəkildə yaradıldı";
                    
                            echo json_encode($data);
                        } else {
                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                        
                            echo json_encode($data);
                        }
                    }
                }
            } else {
                $controlTextareaRules=controlTextNumber($textareaRules, "Yeni qaydalar sahəsi", 11);
                if($controlTextareaRules==true){
                    $newRules = "INSERT IGNORE INTO parametres (parametres_key, parametres_value) VALUES ('$selectCategory', '$textareaRules')";

                    if(mysqli_query($connect, $newRules)){

                        $data["ok"]="ok";
                        $data["text"]="Yeni qayda başarılı şəkildə yaradıldı";
                
                        echo json_encode($data);
                    } else {
                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                    
                        echo json_encode($data);
                    }
                }
            }
        }
        
		
		mysqli_close($connect);
	}
	
	
?>