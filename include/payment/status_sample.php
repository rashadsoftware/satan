<?php
if(isset($_GET)){
    include("../connectDB.php");     
    $getReference=$_GET["reference"];

    $merchant_list=mysqli_query($connect, "SELECT *  FROM merchant WHERE merchant_reference='$getReference' ");
    $merchant_item=mysqli_fetch_array($merchant_list);


    $url = 'https://sandbox.api.pay.yigim.az/payment/status?reference='.$getReference;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Merchant: STN0001',
        'X-Signature: '.$merchant_item['merchant_signature'],
        'X-Type: JSON'
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $response = curl_exec($ch);
    //$response = json_decode($response);
    
    echo $response;
    curl_close($ch);
   
    var_dump($response);

    mysqli_close($connect);

    //header("Location: ".$response->url);
}
/*
4724921526700780
01/25
123

$url = "https://sandbox.api.pay.yigim.az/payment/status?reference=5695171321894062";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'X-Merchant: MRC0001',
    'X-Signature: 0lLSgt/3Egaxg3ALGESeWg==',
    'X-Type: json'
));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
echo $response = curl_exec($ch);
curl_close($ch);
var_dump($response);
*/