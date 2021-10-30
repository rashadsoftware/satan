<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();

        $subcat_opt_list = mysqli_query($connect, "SELECT * FROM subcat_opt WHERE subcategory_id='".$_POST["category_id"]."'");
        if(mysqli_num_rows($subcat_opt_list) > 0){
            $data["text"]="Bu alt kateqoriya başqa bir kateqoriya ilə birləşdirilib. Silinmə yalnız iki parametr arasında əlaqə kəsildiyi zaman olacaqdır";
                            
            echo json_encode($data);
        } else {
            $subdel = mysqli_query($connect, "DELETE FROM subcategories WHERE subcategory_id='".$_POST["category_id"]."'");

            if($subdel){
                $data["ok"]="ok";
                $data["text"]="Alt kateqoriya başarılı şəkildə verilənlər bazasından silindi";
                        
                echo json_encode($data);
            } else {
                $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                echo json_encode($data);
            }
        }
        
        
        
        mysqli_close($connect);
	}
	
?>