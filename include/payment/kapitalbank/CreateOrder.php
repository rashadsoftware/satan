<?php
  session_start();

  if(isset($_SESSION["merchant_elan_id"])){
    include("../../connectDB.php");
    $ip=$_SERVER["REMOTE_ADDR"];

		$price=$_SESSION["merchant_price"];
    $path=$_SESSION["merchant_path"];
    $elan_id=$_SESSION["merchant_elan_id"];
    $status=$_SESSION["merchant_status"];

    $query=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$elan_id' AND elan_status = 'active'");
    if(mysqli_num_rows($query) > 0){
      $query_value_simple=mysqli_query($connect, "SELECT *  FROM earnings WHERE earnings_price='$price' AND earnings_state='$status' ");
      if(mysqli_num_rows($query_value_simple) > 0){

        $query_forward=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$elan_id' AND user_ip = '$ip'");
        $fetch_forward=mysqli_fetch_array($query_forward);

        if($fetch_forward["forward_status"] == "active" && $fetch_forward["forward_key"] == "vip"){
          $_SESSION["merchant_state"]="danger";
          $_SESSION["merchant_text"]="Elanınız zatən aktivdir"; 

          header("Location:../../../result.php");
        } else {
          $newOrder = "INSERT IGNORE INTO merchant (merchant_path, merchant_status, merchant_elan, merchant_price, merchant_ip) VALUES ('$path', '$status', '$elan_id', '$price', '$ip')";
          if(mysqli_query($connect, $newOrder)){
            // kapital bank payment start
            
            $serviceUrl = "https://e-commerce.kapitalbank.az:5443/exec";
            $cert = __DIR__."/testmerchant.crt";
            $key = __DIR__."/merchant_name.key";
            $merchant_id = 'E1230012';
            $language = 'AZ';

              $order_data = array(
                'merchant' => $merchant_id,
                'amount' => $price.'00',
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

                  mysqli_query($connect,"UPDATE merchant SET merchant_order='$OrderID' WHERE merchant_ip='$ip' AND merchant_state=1 ");

                  $_SESSION["merchant_order"]="$OrderID";
                  $_SESSION["merchant_ip"]="$ip";

                  $redirectUrl = $paymentBaseUrl."?ORDERID=".$OrderID."&SESSIONID=".$SessionID."&";

                  header("Location: ".$redirectUrl);

            // kapital bank payment end
          }
        }
      } else {
        header("Location:../../../index.php");
      }
    } else {
      header("Location:../../../index.php");
    }

    mysqli_close($connect);
	} else {
    header("Location:../../../index.php");
  }
?>