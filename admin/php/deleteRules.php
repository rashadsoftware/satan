<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();
        
        $rules_del = mysqli_query($connect, "DELETE FROM parametres WHERE parametres_id='".$_POST["category_id"]."'");

        if($rules_del){
            $data["ok"]="ok";
            $data["text"]="Qayda başarılı şəkildə verilənlər bazasından silindi";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                        
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>