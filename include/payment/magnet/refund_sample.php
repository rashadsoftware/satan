<?php

$reference = 'REF2911821';
$amount = '1';
$secretKey = '55542542B9318FB4A7FD6F7DD8F1A506';

$signature = base64_encode(md5("$reference"."$amount"."$secretKey", true));
$url = "https://sandbox.api.pay.yigim.az/payment/refund?reference=$reference&amount=$amount";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Merchant: STN0001',
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