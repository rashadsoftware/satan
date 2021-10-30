<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();
        
        $subdel = mysqli_query($connect, "DELETE FROM cities WHERE city_id='".$_POST["category_id"]."'");

        if($subdel){
            $data["ok"]="ok";
            $data["text"]="Şəhər başarılı şəkildə verilənlər bazasından silindi";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>