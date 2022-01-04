<?php

$reference = rand(1000000000000000, 10000000000000000);
$type = 'SMS';
$token = rand(100000000, 1000000000);
$save = 'n';
$amount = '1';
$currency = '944';
$biller = 'BLR0001';
$description = 'test_payment';
$template = 'TPL0001';
$language = 'ru';
$callback = 'https://webhook.site/4d7b3627-2d63-4820-9e92-c174c41cb6cc';
$extra = 'user_id='. 1;
$secretKey = '52447AED0DF0306054ABF17EE9E74F53';

$signature = base64_encode(md5("$reference"."$type"."$token"."$save"."$amount"."$currency"."$biller"."$description"."$template"."$language".$callback."$secretKey", true));
$url = "https://sandbox.api.pay.yigim.az/payment/create?reference=$reference&type=$type&token=$token&save=$save&amount=$amount&currency=$currency&biller=$biller&description=$description&template=$template&language=$language&callback=$callback";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Merchant: MRC0001',
    'X-Signature: '.$signature,
    'X-Type: XML'
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);											
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
echo $response = curl_exec($ch);
if (curl_errno($ch)) {
    echo curl_error($ch);
}					  
curl_close($ch);
var_dump($response);