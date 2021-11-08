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