<?php
    session_start();

    if(isset($_SESSION["merchant_elan_id"])){
        include("../../connectDB.php");

        $elan_id=$_SESSION["merchant_elan_id"];
        $status=$_SESSION["merchant_status"];
        $price=$_SESSION["merchant_price"];
        $order=$_SESSION["merchant_order"];

        $ip=$_SESSION["merchant_ip"];

        $result=mysqli_query($connect,"UPDATE merchant SET merchant_state=3 WHERE merchant_state = 1 AND merchant_ip='$ip' ");

        if($result){
            $forward=mysqli_query($connect, "SELECT * FROM forward WHERE elanID = '$elan_id' AND user_ip = '$ip' ");
            if(mysqli_num_rows($forward) > 0){
                $forwardFetch=mysqli_fetch_array($forward);

                if($status == 'simple'){
                    if($forwardFetch["forward_key"] == 'simple'){
                        if($forwardFetch["forward_status"] != 'active'){
                            $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='simple', forward_value='$price', forward_status='active' WHERE elanID = '$elan_id' AND user_ip='$ip' ");

                            $_SESSION["merchant_state"]="success";
                            $_SESSION["merchant_text"]="Elanınız başarılı şəkildə VIP olaraq aktivləşdirildi";

                            header("Location:../../../result.php");
                        } else {
                            $_SESSION["merchant_state"]="danger";
                            $_SESSION["merchant_text"]="Elanınız zatən sadə olaraq aktivdir"; 

                            header("Location:../../../result.php");
                        }
                    } else {
                        if($forwardFetch["forward_status"] != 'active'){
                            $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='simple', forward_value='$price', forward_status='active' WHERE elanID = '$elan_id' AND user_ip='$ip' ");

                            $_SESSION["merchant_state"]="success";
                            $_SESSION["merchant_text"]="Elanınız başarılı şəkildə VIP olaraq aktivləşdirildi";

                            header("Location:../../../result.php");
                        }
                    }
                } else {
                    if($forwardFetch["forward_key"] == 'simple'){
                        $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='vip', forward_value='$price', forward_status='active' WHERE elanID = '$elan_id' AND user_ip='$ip' ");

                        $_SESSION["merchant_state"]="success";
                        $_SESSION["merchant_text"]="Elanınız başarılı şəkildə VIP olaraq aktivləşdirildi";

                        header("Location:../../../result.php");
                    } else {
                        if($forwardFetch["forward_status"] == 'active'){
                            $_SESSION["merchant_state"]="danger";
                            $_SESSION["merchant_text"]="Elanınız zatən VIP olaraq aktivdir";

                            header("Location:../../../result.php");
                        } else {
                            $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='vip', forward_value='$price', forward_status='active' WHERE elanID = '$elan_id' AND user_ip='$ip' ");

                            $_SESSION["merchant_state"]="success";
                            $_SESSION["merchant_text"]="Elanınız başarılı şəkildə VIP olaraq aktivləşdirildi";

                            header("Location:../../../result.php");
                        }
                        
                    }                    
                }
            } else {
                $addForward = mysqli_query($connect,"INSERT IGNORE INTO forward (elanID, forward_key, forward_value, forward_status, user_ip) VALUES ('$elan_id', '$status', '$price', 'active', '$ip' )" );

                if($addForward){
                    $_SESSION["merchant_state"]="success";
                    $_SESSION["merchant_text"]="Elanınız başarılı şəkildə aktivləşdirildi";

                    header("Location:../../../result.php");
                } else {
                    $_SESSION["merchant_state"]="danger";
                    $_SESSION["merchant_text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";

                    header("Location:../../../result.php");
                }
            }
        }

        mysqli_close($connect);
    } else { 
        header("Location:../../../index.php");
   }
?>