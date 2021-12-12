<?php
	if(isset($_POST)){

		include("../../assets/include/connectDB.php");

		$data=array();

		$inputHiddenID=$_POST["getID"];

        date_default_timezone_set("Asia/Baku");
        $nowTime=time();
        $timeWeb=date('Y-m-d H:i:s', $nowTime);
        $deadline=date('Y-m-d H:i:s', strtotime("+1 month", $nowTime));
		
		$updateElan=mysqli_query($connect,"UPDATE elan SET elan_status='active', elan_time='$timeWeb' WHERE elan_id = '$inputHiddenID'");

        if($updateElan){
            // remove deadline
            $allDeadlineElan=mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$inputHiddenID'");
            if(mysqli_num_rows($allDeadlineElan) > 0){
                mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$inputHiddenID'");
            }

            mysqli_query($connect,"INSERT IGNORE INTO deadline (elan_id, deadline_time) VALUES ('$inputHiddenID', '$deadline')");

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