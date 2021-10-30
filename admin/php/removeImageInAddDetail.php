<?php
	
	if(isset($_POST["action"])){
		
		include("../include/connectDB.php");
		
        $data=array();

        $getId=$_POST['getId'];
        
        $getData=mysqli_query($connect,"SELECT * FROM img WHERE img_id='$getId' ");
        $result=mysqli_fetch_array($getData);

        $elan_img=$result["img_path"];

        // Remove image from Folder
        unlink("../../img/advert/".$elan_img);

        $delImg=mysqli_query($connect, "DELETE FROM img WHERE img_id='$getId' ");

        if($delImg){
            $data["ok"]="ok";
            $data["text"]="Elanın şəkili başarılı şəkildə silindi";
                    
            echo json_encode($data);
        } else {
            $data["text"]="Çevrilmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>