<?php
	$serviceUrl = "https://e-commerce.kapitalbank.az:5443/exec";
	$cert = __DIR__."/testmerchant.crt";
	$key = __DIR__."/merchant_name.key";
	$merchant_id = 'E1230012';
	$language = 'AZ';

    $order_data = array(
      'merchant' => $merchant_id,
      'amount' => 1,
      'currency' => 944,
      'description' => 'Templateplanet Purchase',
      'lang' => 'AZ'
    );

	$xml = '<?xml version="1.0" encoding="UTF-8"?>
               <TKKPG>
                 <Request>
                    <Operation>CreateOrder</Operation>
                    <Language>'.$order_data['lang'].'</Language>
                    <Order>
                       <OrderType>Purchase</OrderType>
                       <Merchant>'.$order_data['merchant'].'</Merchant>
                       <Amount>'.$order_data['amount'].'</Amount>
                       <Currency>'.$order_data['currency'].'</Currency>
                       <Description>'.$order_data['description'].'</Description>
					<ApproveURL>https://satan.az/include/payment/kapitalbank/success</ApproveURL>
                  	<CancelURL>https://satan.az/include/payment/kapitalbank/error</CancelURL>
                    <DeclineURL>https://satan.az/include/payment/kapitalbank/decline</DeclineURL>
                   </Order>
                 </Request>
             </TKKPG>
           ';

		$url = $serviceUrl;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PORT, 5443);
        curl_setopt($ch, CURLOPT_URL, $url);    //post atılacak adres 
        curl_setopt ($ch, CURLOPT_POST, 1);     //yukarıdaki adrese post atacağımızı belirtiyoruz 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // sayfanın kaynak kodundan aldığımız form değerlerini post etmek için gerekli değerleri yazıyoruz 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
     
        // SSL yi devre dışı bırakmak
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
     
        curl_setopt($ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($ch, CURLOPT_SSLKEY, $key);
     
        //Error handling and return result
        $data = curl_exec($ch);     //posttan sonra gelen sayfayı alıp değişkene kaydettik
        if ($data === false) {
            $result = curl_error($ch);
        } else {
            $result = $data;
        }
     
        // Close handle
        curl_close($ch);
     
        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);

		    $OrderID = $array_data['Response']['Order']['OrderID'];
        $SessionID = $array_data['Response']['Order']['SessionID'];
        $paymentBaseUrl = $array_data['Response']['Order']['URL'];

        $redirectUrl = $paymentBaseUrl."?ORDERID=".$OrderID."&SESSIONID=".$SessionID."&";

        header("Location: ".$redirectUrl);
?>