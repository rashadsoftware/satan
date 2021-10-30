<?php
	if(isset($_POST)){

		$data=array();
        include("../include/connectDB.php");

        $postId=mysqli_real_escape_string($connect, trim($_POST["hiddenCancel"]));
        $textareaCancel=mysqli_real_escape_string($connect, trim($_POST["textareaCancel"]));

        if(empty($textareaCancel)){
            $data["text"]="Zəhmət olmasa ləğv etmə səbəbinizi qeyd edin";
                    
            echo json_encode($data);
        } else {
            $elan_detail=mysqli_query($connect, "DELETE FROM elan_detail WHERE elan_id='$postId'");
        
            if($elan_detail){
                $elanlarImg_list = mysqli_query($connect, "SELECT * FROM img WHERE elan_id='$postId'");

                while($elanlarImg=mysqli_fetch_array($elanlarImg_list)){
                    unlink("../../img/advert/".$elanlarImg["img_path"]);
                }
                
                $elan_img=mysqli_query($connect, "DELETE FROM img WHERE elan_id='$postId'");

                if($elan_img){
                    
                    $elanlar_list = mysqli_query($connect, "SELECT * FROM elan WHERE elan_id='$postId'");
                    $elanlar=mysqli_fetch_array($elanlar_list);
                    $customer_id=$elanlar["customer_id"];

                    $customerElan=mysqli_query($connect, "DELETE FROM customers WHERE customer_id='$customer_id'");

                    if($customerElan){
                        $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                        if($allElan){

                            $data["ok"]="ok";
                            $data["text"]=$textareaCancel;
                    
                            echo json_encode($data);
                        } else {
                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                        
                            echo json_encode($data);
                        }
                    } else {
                        $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                        
                        echo json_encode($data);
                    }
                } else {
                    $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                    echo json_encode($data);
                }
                
            } else {
                $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                echo json_encode($data);
            }
        }

        mysqli_close($connect);

	}
	
	
?>