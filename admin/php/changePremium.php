<?php
	
	if(isset($_POST["action"])){
		
		include("../include/connectDB.php");

        $elanStatus="premium";
		
        $data=array();

        $elanTime=date('Y-m-d H:i:s');
        $deadlineTime=strtotime("+1 month");
        $dealdline=date('Y-m-d H:i:s', $deadlineTime);
        
        $updateCity=mysqli_query($connect,"UPDATE elan SET elan_raiting='$elanStatus', elan_time='$elanTime' WHERE elan_id = '".$_POST["idElan"]."' AND elan_status='active' ");

        if($updateCity){
            $updateDeadlineCreate=mysqli_query($connect,"UPDATE deadline SET deadline_time='$dealdline' WHERE elan_id = '".$_POST["idElan"]."' ");

            if($updateDeadlineCreate){

                $data["ok"]="ok";
                $data["text"]="Elanınız başarılı şəkildə Premium oldu";
                        
                echo json_encode($data);
            } else {
                $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
            
                echo json_encode($data);
            }
        } else {
            $data["text"]="Çevrilmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>