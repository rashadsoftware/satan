<?php	
	if(isset($_POST)){
        include("../include/connectDB.php");

        $data=array();
		
        $elanID=$_POST["elanID"];
        $action=$_POST["action"];
        $dataID=$_POST["dataID"];

        $query=mysqli_query($connect, "SELECT * FROM forward WHERE elanID = '".$_POST["elanID"]."' AND forward_key = 'vip' ");

        if(mysqli_num_rows($query) > 0){
            $dataElan=mysqli_fetch_array($query);

            if($dataElan["forward_status"] == "active"){
                $data["text"]="Elan ".$dataElan["forward_key"]." statusu olaraq aktivdir. Başqa zaman üçün yenidən yoxlayın";
            
                echo json_encode($data);
            } else {
                $updateForward=mysqli_query($connect,"UPDATE forward SET forward_value='$dataID', forward_status='active' WHERE elanID = '$elanID' AND forward_key = 'vip' ");

                if($updateForward){
                    $data["ok"]="ok";
                    $data["text"]="Elanınız başarılı şəkildə vip elan oldu";
                            
                    echo json_encode($data);
                } else {
                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                
                    echo json_encode($data);
                }
            }            
        } else {
            $addForward = mysqli_query($connect,"INSERT IGNORE INTO forward (elanID, forward_key, forward_value, forward_status) VALUES ('$elanID', '$action', '$dataID', 'active')" );

            if($addForward){
                $data["ok"]="ok";
                $data["text"]="Elanınız başarılı şəkildə vip elan oldu";
                        
                echo json_encode($data);
            } else {
                $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
            
                echo json_encode($data);
            }
        }
        
        mysqli_close($connect);

	}
	
?>