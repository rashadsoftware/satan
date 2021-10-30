<?php
	
	if(isset($_POST["action"])){
		
		include("../include/connectDB.php");

        $elanStatus="simple";
		
        $data=array();
        
        $updateCity=mysqli_query($connect,"UPDATE elan SET elan_raiting='$elanStatus' WHERE elan_id = '".$_POST["idElan"]."' AND elan_status='active' ");

        if($updateCity){
            $data["ok"]="ok";
            $data["text"]="Elanınız başarılı şəkildə sadə oldu";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Çevrilmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>