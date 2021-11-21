<?php
    if(isset($_POST["radioPriceSimple"])){
        include("../connectDB.php");        

        $price=$_POST["radioPriceSimple"];
        $card=$_POST["radioBank"];
        $elanID=$_POST["elanID"];

        $data=array();

        $query=mysqli_query($connect, "SELECT * FROM elan WHERE elan_id = '$elanID' AND elan_status = 'active' ");

        if(mysqli_num_rows($query) > 0){
            $forward=mysqli_query($connect, "SELECT * FROM forward WHERE elanID = '$elanID' AND forward_key = 'forward' ");

            if(mysqli_num_rows($forward) > 0){
                $forwardFetch=mysqli_fetch_array($forward);

                if($forwardFetch["forward_status"] == 'active'){
                    $data["text"]="Bu elan üçün status aktivləşdirilib. Yenidən cəhd edin!";        
                    echo json_encode($data);
                } else {
                    
                    $data["ok"]="ok";        
                    echo json_encode($data);

                    /*
                    $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='forward', forward_value='$price', forward_status='active' WHERE elanID = '$elanID' ");

                    if($updateForward){
                        $insertPayment=mysqli_query($connect, "INSERT IGNORE INTO payment (elanID, payment_price, payment_status, payment_place) VALUES ('$elanID', '$price', 'forward', '$card')");

                        if($insertPayment){
                            $data["ok"]="ok";       
                            $data["text"]="Elanınız başarılı şəkildə irəli çəkildi";  
                            echo json_encode($data);
                        } else {
                            $data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";        
                            echo json_encode($data);
                        }
                    } else {
                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                    
                        echo json_encode($data);
                    }
                    */
                }
            } else {
                $addForward = mysqli_query($connect,"INSERT IGNORE INTO forward (elanID, forward_key, forward_value, forward_status) VALUES ('$elanID', 'forward', '$price', 'active')" );

                if($addForward){
                    $insertPayment=mysqli_query($connect, "INSERT IGNORE INTO payment (elanID, payment_price, payment_status, payment_place) VALUES ('$elanID', '$price', 'forward', '$card')");

                    if($insertPayment){                            
                        $data["ok"]="ok";       
                        $data["text"]="Elanınız başarılı şəkildə irəli çəkildi";  
                        echo json_encode($data);
                    } else {
                        $data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";        
                        echo json_encode($data);
                    }
                } else {
                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";        
                    echo json_encode($data);
                }
            }
            
        } else {
            $data["text"]="Bu id addressə bağlı olan elan yoxdur. Yenidən cəhd edin!";
        
            echo json_encode($data);
        }

        mysqli_close($connect);
    } else {
        include("../connectDB.php");        

        $price=$_POST["radioPriceVIP"];
        $card=$_POST["radioBank"];
        $elanID=$_POST["elanID"];

        $data=array();

        $query=mysqli_query($connect, "SELECT * FROM elan WHERE elan_id = '$elanID' AND elan_status = 'active' ");

        if(mysqli_num_rows($query) > 0){
            $forward=mysqli_query($connect, "SELECT * FROM forward WHERE elanID = '$elanID' AND forward_key = 'vip' ");

            if(mysqli_num_rows($forward) > 0){
                $forwardFetch=mysqli_fetch_array($forward);

                if($forwardFetch["forward_status"] == 'active'){
                    $data["text"]="Bu elan üçün status aktivləşdirilib. Yenidən cəhd edin!";        
                    echo json_encode($data);
                } else {
                    $updateForward=mysqli_query($connect,"UPDATE forward SET forward_key='vip', forward_value='$price', forward_status='active' WHERE elanID = '$elanID' ");

                    if($updateForward){
                        $insertPayment=mysqli_query($connect, "INSERT IGNORE INTO payment (elanID, payment_price, payment_status, payment_place) VALUES ('$elanID', '$price', 'vip', '$card')");

                        if($insertPayment){
                            $data["ok"]="ok";       
                            $data["text"]="Elanınız başarılı şəkildə VIP oldu";  
                            echo json_encode($data);
                        } else {
                            $data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";        
                            echo json_encode($data);
                        }
                    } else {
                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                    
                        echo json_encode($data);
                    }
                }
            } else {
                $addForward = mysqli_query($connect,"INSERT IGNORE INTO forward (elanID, forward_key, forward_value, forward_status) VALUES ('$elanID', 'vip', '$price', 'active')" );

                if($addForward){
                    $insertPayment=mysqli_query($connect, "INSERT IGNORE INTO payment (elanID, payment_price, payment_status, payment_place) VALUES ('$elanID', '$price', 'vip', '$card')");

                    if($insertPayment){                            
                        $data["ok"]="ok";       
                        $data["text"]="Elanınız başarılı şəkildə VIP oldu";  
                        echo json_encode($data);
                    } else {
                        $data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";        
                        echo json_encode($data);
                    }
                } else {
                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";        
                    echo json_encode($data);
                }
            }
            
        } else {
            $data["text"]="Bu id addressə bağlı olan elan yoxdur. Yenidən cəhd edin!";
        
            echo json_encode($data);
        }

        mysqli_close($connect);
    }
?>