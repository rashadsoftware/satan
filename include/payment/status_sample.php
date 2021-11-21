<?php
include("../connectDB.php");     
$getReference=$_GET["reference"];

$merchant_list=mysqli_query($connect, "SELECT *  FROM merchant WHERE merchant_reference='$getReference' ");
$merchant_item=mysqli_fetch_array($merchant_list);


$url = 'https://sandbox.api.pay.yigim.az/payment/status?reference='.$merchant_item['merchant_reference'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Merchant: STN0001',
    'X-Signature:'.$merchant_item['merchant_signature'],
    'X-Type: json'
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$response = json_decode($response);

curl_close($ch);
//echo $response;

header("Location: ".$response->url);