<?php
	
	if($_POST["action"]=="update"){
		
		include("../include/connectDB.php");

        $stateElan="active";

        $elan_pswd=md5(rand());
		
        $data=array();

        $elanTime=date('Y-m-d H:i:s');
        $deadlineTime=strtotime("+1 month");
        $dealdline=date('Y-m-d H:i:s', $deadlineTime);
        
        $updateCity=mysqli_query($connect,"UPDATE elan SET elan_status='$stateElan', elan_pswd='$elan_pswd', elan_time='$elanTime' WHERE elan_id = '".$_POST["category_id"]."' ");

        if($updateCity){
            $elan_subcategory=mysqli_query($connect, "SELECT *  FROM deadline WHERE elan_id='".$_POST["category_id"]."' ");
            if(mysqli_num_rows($elan_subcategory) > 0){
                $updateDeadlineCreate=mysqli_query($connect,"UPDATE deadline SET deadline_time='$dealdline' WHERE elan_id = '".$_POST["category_id"]."' ");

                if($updateDeadlineCreate){

                    $data["ok"]="ok";
                    $data["text"]="Elanınız başarılı şəkildə aktivləşdirildi";
                            
                    echo json_encode($data);
                } else {
                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin. cssdsd";
                
                    echo json_encode($data);
                }
            } else {
                $deadlineCreate = "INSERT IGNORE INTO deadline (elan_id, deadline_time) VALUES ('".$_POST["category_id"]."', '$dealdline')";

                if(mysqli_query($connect, $deadlineCreate)){

                    $data["ok"]="ok";
                    $data["text"]="Elanınız başarılı şəkildə aktivləşdirildi";
                            
                    echo json_encode($data);
                } else {
                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                
                    echo json_encode($data);
                }
            }
            
        } else {
            $data["text"]="Aktivləşmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>