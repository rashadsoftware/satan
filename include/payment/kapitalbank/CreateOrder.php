<?php
    class CreateOrder{
        protected $serviceUrl = "https://e-commerce.kapitalbank.az:5443/exec";
        protected $cert = "testmerchant.crt";
        protected $key = "merchant_name.key";
        protected $merchant_id = 'E1000010';
        protected $language = 'AZ';
        const PORT = 5443;

        public function __construct(){
            if(file_exists($this->cert)){
                $this->cert=__DIR__."/testmerchant.crt";
            } else {
                echo 'sertifikat yoxdur';
            }

            if(file_exists($this->key)){
                $this->key=__DIR__."/merchant_name.key";
            } else {
                echo 'key yoxdur';
            }
        }

        public function curl($xml){
            $url = $this->serviceUrl;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_PORT, self::PORT);
            curl_setopt($ch, CURLOPT_URL, $url);    //post atılacak adres 
            curl_setopt ($ch, CURLOPT_POST, 1);     //yukarıdaki adrese post atacağımızı belirtiyoruz 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // sayfanın kaynak kodundan aldığımız form değerlerini post etmek için gerekli değerleri yazıyoruz 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
     
            // SSL yi devre dışı bırakmak
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
     
            curl_setopt($ch, CURLOPT_SSLCERT, $this->cert);
            curl_setopt($ch, CURLOPT_SSLKEY, $this->key);
     
            
     
            //Error handling and return result
            $data = curl_exec($ch);     //posttan sonra gelen sayfayı alıp değişkene kaydettik
            if ($data === false) {
                $result = curl_error($ch);
            } else {
                $result = $data;
            }
     
            // Close handle
            curl_close($ch);
     
            //return $result;
            $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
            return $array_data;
        }

        public function createTestOrder(){     
            $order_data = array(
                'merchant' => $this->merchant_id,
                'amount' => 1,
                'currency' => 944,
                'description' => 'Templateplanet Purchase',
                'lang' => 'RU'
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
                            <ApproveURL>/testshopPageReturn.jsp</ApproveURL>
                            <CancelURL>/testshopPageReturn.jsp</CancelURL>
                            <DeclineURL>/testshopPageReturn.jsp</DeclineURL>
                        </Order>
                    </Request>
                </TKKPG>
             ';
     
            $result = $this->curl($xml);

            return $this->handleCurlResponse($order_data,$result);
        }

        public function handleCurlResponse($inital_data, $data){

            $OrderID = $data['Response']['Order']['OrderID'];
            $SessionID = $data['Response']['Order']['SessionID'];
            $paymentBaseUrl = $data['Response']['Order']['URL'];

            $redirectUrl = $paymentBaseUrl."?ORDERID=".$OrderID."&SESSIONID=".$SessionID."&";

            return header("Location: ".$redirectUrl);
        }
    }

    $create=new CreateOrder();
    $create->createTestOrder();
?>