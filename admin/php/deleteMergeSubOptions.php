<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();
        
        $categories=mysqli_query($connect, "DELETE FROM merges WHERE merge_id='".$_POST["category_id"]."'");

        if($categories){
            $data["ok"]="ok";
            $data["text"]="Birləşən parametrlər başarılı şəkildə verilənlər bazasından silindi";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>