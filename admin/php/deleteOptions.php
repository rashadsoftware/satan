<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();
        
        $suboptions_list = mysqli_query($connect, "SELECT * FROM suboptions WHERE options_id='".$_POST["category_id"]."'");
        if(mysqli_num_rows($suboptions_list) > 0){
            $data["text"]="Bu parametrin alt parametri var. Silinmə yalnız alt parametr silinən zaman baş verəcəkdir.";
                            
            echo json_encode($data);
        } else {
            $options=mysqli_query($connect, "DELETE FROM options WHERE options_id='".$_POST["category_id"]."'");

            if($options){
                $data["ok"]="ok";
                $data["text"]="Parametr başarılı şəkildə verilənlər bazasından silindi";
                        
                echo json_encode($data);
            } else {
                $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                echo json_encode($data);
            }
        }
        
        mysqli_close($connect);
	}
	
?>