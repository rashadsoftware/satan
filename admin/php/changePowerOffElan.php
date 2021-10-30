<?php
	
	if($_POST["action"]=="update"){
		
		include("../include/connectDB.php");

        $stateElan="deactive";

        $elan_pswd=md5(rand());
		
        $data=array();
        
        $updateCity=mysqli_query($connect,"UPDATE elan SET elan_status='$stateElan' WHERE elan_id = '".$_POST["category_id"]."'");

        if($updateCity){
            $data["ok"]="ok";
            $data["text"]="Elanınız başarılı şəkildə aktivdən çıxarıldı";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Deaktivləşmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>