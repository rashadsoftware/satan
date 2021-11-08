<?php
    if(isset($_POST["radioPriceSimple"])){
        include("../connectDB.php");        

        $price=$_POST["radioPriceSimple"];
        $card=$_POST["radioBank"];
        $elanID=$_POST["elanID"];

        $data=array();

        $reference = rand(1000000000000000, 10000000000000000);
        $type = 'SMS';
        //$token = rand(100000000, 1000000000);
        $save = 'n';
        $amount = '1';
        $currency = '944';
        $biller = 'BLR0001';
        $description = 'test_payment';
        $template = 'TPL0001';
        $language = 'ru';
        $callback = 'https://localhost/elan/4d7b3627-2d63-4820-9e92-c174c41cb6cc';
        $extra = 'user_id='. 1;
        $secretKey = '52447AED0DF0306054ABF17EE9E74F53';

        $signature = base64_encode(md5("$reference"."$type"."$save"."$amount"."$currency"."$biller"."$description"."$template"."$language".$callback."$secretKey", true));
        $url = "https://sandbox.api.pay.yigim.az/payment/create?reference=$reference&type=$type&save=$save&amount=$amount&currency=$currency&biller=$biller&description=$description&template=$template&language=$language&callback=$callback";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Merchant: MRC0001',
            'X-Signature: '.$signature,
            'X-Type: JSON'
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);											
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // echo $response = curl_exec($ch);

        $response = curl_exec($ch);
        $response = json_decode($response);

        if (curl_errno($ch)) {
            echo curl_error($ch);
        }					  
        curl_close($ch);

        if($response->code == 0){
            $query=mysqli_query($connect, "SELECT * FROM elan WHERE elan_id = '$elanID' AND elan_status = 'active' ");

            if(mysqli_num_rows($query) > 0){
                $forward=mysqli_query($connect, "SELECT * FROM forward WHERE elanID = '$elanID' AND forward_key = 'forward' ");
    
                if(mysqli_num_rows($forward) > 0){
                    $forwardFetch=mysqli_fetch_array($forward);
    
                    if($forwardFetch["forward_status"] == 'active'){
                        $data["text"]="Bu elan üçün status aktivləşdirilib. Yenidən cəhd edin!";        
                        echo json_encode($data);
                    } else {
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
        } else {
            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";                    
            echo json_encode($data);
        }

        mysqli_close($connect);
    } else {
        include("../connectDB.php");        

        $price=$_POST["radioPriceVIP"];
        $card=$_POST["radioBank"];
        $elanID=$_POST["elanID"];

        $data=array();

        $reference = rand(1000000000000000, 10000000000000000);
        $type = 'SMS';
        //$token = rand(100000000, 1000000000);
        $save = 'n';
        $amount = '1';
        $currency = '944';
        $biller = 'BLR0001';
        $description = 'test_payment';
        $template = 'TPL0001';
        $language = 'ru';
        $callback = 'https://localhost/elan/4d7b3627-2d63-4820-9e92-c174c41cb6cc';
        $extra = 'user_id='. 1;
        $secretKey = '52447AED0DF0306054ABF17EE9E74F53';

        $signature = base64_encode(md5("$reference"."$type"."$save"."$amount"."$currency"."$biller"."$description"."$template"."$language".$callback."$secretKey", true));
        $url = "https://sandbox.api.pay.yigim.az/payment/create?reference=$reference&type=$type&save=$save&amount=$amount&currency=$currency&biller=$biller&description=$description&template=$template&language=$language&callback=$callback";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Merchant: MRC0001',
            'X-Signature: '.$signature,
            'X-Type: JSON'
        ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);											
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // echo $response = curl_exec($ch);

        $response = curl_exec($ch);
        $response = json_decode($response);

        if (curl_errno($ch)) {
            echo curl_error($ch);
        }					  
        curl_close($ch);

        if($response->code == 0){
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
        } else {
            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";                    
            echo json_encode($data);
        }

        mysqli_close($connect);
    }
?>