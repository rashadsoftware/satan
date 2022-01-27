<?php
    if(isset($_GET)){
        $data=$_GET['data'];
        $price=$_GET['price'];
        $day=$_GET['day'];

        include("../connectDB.php");

        $reference = rand(1000000000000000, 10000000000000000);
        $type = 'SMS';
        //$token = rand(100000000, 1000000000);
        $save = 'n';
        $amount = $price.'00';
        $currency = '944';
        $biller = 'BLR0001';
        
        if($data == 'simple'){
            $description='elani_ireli_cek';
        } else {
            $description='VIP_'.$day.'_gun';
        }

        $template = 'TPL0001';
        $language = 'az';
        //$callback = 'https://localhost/elan/4d7b3627-2d63-4820-9e92-c174c41cb6cc';
        $callback = 'https://satan.az/include/payment/status_sample.php?';
        $extra = 'user_id='. 1;
        $secretKey = '55542542B9318FB4A7FD6F7DD8F1A506';

        $signature = base64_encode(md5("$reference"."$type"."$save"."$amount"."$currency"."$biller"."$description"."$template"."$language"."$callback"."$secretKey", true));
        $url = "https://sandbox.api.pay.yigim.az/payment/create?reference=$reference&type=$type&save=$save&amount=$amount&currency=$currency&biller=$biller&description=$description&template=$template&language=$language&callback=$callback";

        mysqli_query($connect,"INSERT IGNORE INTO merchant (merchant_reference, merchant_signature) VALUES ('$reference', '$signature')");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Merchant: STN0001',
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

        //echo $response->url."?reference=".$reference;

        mysqli_close($connect);

        header("Location: ".$response->url);
    }    
?>