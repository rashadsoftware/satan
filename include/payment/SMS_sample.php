<?php
    if(isset($_POST)){
        include("../connectDB.php"); 

        echo $_POST["radioBank"]."</br>";
        echo $_POST["radioPriceSimple"];

        // elanin adi alinir
        $elanID=$_POST["elanID"];
        $elan_list=mysqli_query($connect, "SELECT * FROM elan WHERE elan_id='$elanID' AND elan_status='active' ");
        $elan_data=mysqli_fetch_array($elan_list);

        // forward price
        $forward_simple=$_POST["radioPriceSimple"];
        $order_list_simple=mysqli_query($connect, "SELECT * FROM order WHERE order_amount='$forward_simple' AND order_status='forward' ");
        $order_data=mysqli_fetch_array($order_list_simple);

        if (!$order_list_simple) {
            printf("Error: %s\n", mysqli_error($connect));
            exit();
        }
        
        echo $order_data["order_price"];

        

        
        

        /*

        $reference = rand(1000000000000000, 10000000000000000);
        $type = 'SMS';
        //$token = rand(100000000, 1000000000);
        $save = 'n';
        $amount = '1';
        $currency = '944';
        $biller = 'BLR0001';
        $description = $elan_data["elan_name"];
        $template = 'TPL0001';
        $language = 'az';
        //$callback = 'https://localhost/elan/4d7b3627-2d63-4820-9e92-c174c41cb6cc';
        $callback = 'https://satan.az/include/payment/status_sample.php?'.$reference;
        $extra = 'user_id='. 1;
        $secretKey = '55542542B9318FB4A7FD6F7DD8F1A506';

        $signature = base64_encode(md5("$reference"."$type"."$save"."$amount"."$currency"."$biller"."$description"."$template"."$language".$callback."$secretKey", true));
        $url = "https://sandbox.api.pay.yigim.az/payment/create?reference=$reference&type=$type&save=$save&amount=$amount&currency=$currency&biller=$biller&description=$description&template=$template&language=$language&callback=$callback";

        mysqli_query($connect, "INSERT IGNORE INTO merchant (merchant_reference, merchant_signature) VALUES ('$reference', '$signature') ");

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

        header("Location: ".$response->url);

        */
    }
?>