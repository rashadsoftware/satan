<?php
	if(isset($_POST)){

		include("../../assets/include/connectDB.php");

		$data=array();

		$inputHiddenID=$_POST["getID"];
		
		$updateElan=mysqli_query($connect,"UPDATE elan SET elan_status='active' WHERE elan_id = '$inputHiddenID'");

        if($updateElan){
            $data["ok"]="ok";  
            $data["text"]="Təbriklər! Elanı aktivləşdirdiniz";              
            echo json_encode($data);
        } else {
            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
        
            echo json_encode($data);
        }
        
		mysqli_close($connect);
	}
?>