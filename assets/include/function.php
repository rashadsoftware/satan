<?php
    // data crypted / decrypted
    define('CIPHER', 'AES-128-CBC');
    define('KEY', 'qasimov');

    function encrypted($data){
        return base64_encode(openssl_encrypt($data, CIPHER, KEY));
    }

    function decrypted($data){
        return openssl_decrypt($data, CIPHER, KEY);
    }

    // Create Seflink
    function seflink($text){
        $find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/","/Ə/","/ə/");
        $degis = array("G","U","S","I","O","C","g","u","s","i","o","c","E","e");
        $text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöçƏə]/"," ",$text);
        $text = preg_replace($find,$degis,$text);
        $text = preg_replace("/ +/"," ",$text);
        $text = preg_replace("/ /","-",$text);
        $text = preg_replace("/\s/","",$text);
        $text = strtolower($text);
        $text = preg_replace("/^-/","",$text);
        $text = preg_replace("/-$/","",$text);
        return $text;
    }
	
	// Create Dynamic Alert Notification
    function dynamic_alert_notification($id){
        echo '<div class="alert alert-danger alert_hide" role="alert" style="display:none" id="'.$id.'"></div>';
    }
	
	// Control Name / Surname / Title
    function controlTitle($valueTitle, $nameTitle, $count){
        if(empty($valueTitle)){
			$data["text"]=$nameTitle." boş qalmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueTitle) > $count){
                return true;
                /*
                // only enter aphabetical letters
				if(preg_replace("/[A-ZƏəIıÖöĞğÇçŞşüÜİi а-яА-Яa-z]/", "",$valueTitle)==true){
					$data["text"]=$nameTitle." ancaq hərflərdən ibarət olmalıdır";

					echo json_encode($data);
				} else {
                    return true;
                }
                */
            } else {
                $summary=$count+1;
                $data["text"]=$nameTitle." minimum ".$summary." karakter olmalıdır";
						
				echo json_encode($data);
            }
        }
    }

    // Control Email
    function controlEmail($valueEmail, $nameEmail){
        if(empty($valueEmail)){
			$data["text"]=$nameEmail. " boş buraxılmamalıdır.";
			
			echo json_encode($data);
		} else {
            if(filter_var($valueEmail,FILTER_VALIDATE_EMAIL)){
                return true;
            } else {
                $data["text"]=$nameEmail." etibarlı deyil. Yenidən cəhd edin!";
				
				echo json_encode($data);
            }
        }
    }

    // Control Password
    function controlPassword($valuePassword, $count, $namePassword){
        if(empty($valuePassword)){
            $data["text"]=$namePassword." boş buraxılmamalıdır";
            
            echo json_encode($data);
        } else {
            if(strlen($valuePassword) > $count){
                // only enter number and aphabetical letters
				if(preg_replace("/[A-Za-z0-9]/", "",$valuePassword)==true){
					$data["text"]=$namePassword." ancaq rəqəmlər və hərflərdən ibarət olmalıdır";

					echo json_encode($data);
				} else {
                    return true;
                }
            } else {
                $summary=$count+1;
                $data["text"]=$namePassword." minimum ".$summary." karakter olmalıdır";
					
				echo json_encode($data);
            }
        }
    }

    // Create Time 
    $aylar_TR = array("Yanvar","Fevral","Mart","Aprel","May","İyun","İyul","Avqust","Sentyabr","Oktyabr","Noyabr","Dekabr");
    $aylar_EN = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

    // create add item
    function addItem($img, $price, $idElan, $mezmun, $city, $time, $raiting, $favorites){
echo'   <div class="col-6 col-lg-4 col-xl-3">
            <div class="item-container">
                <div class="item-image"> ';
            echo'   <a href="preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                        <img src="../img/advert/'.$img.'" alt="'.seflink($mezmun).'"/>
                    </a>';
                    if($price != ""){
                        echo '<span class="price">'.str_replace(",", " ", number_format($price)).' AZN</span>';
                    }
                    
            echo'   <ul class="item-status">';
                            if($raiting == "premium"){ 
                    echo'       <li><i class="far fa-gem"></i></li> ';
                                }
                            if($raiting == "vip"){ 
                    echo'       <li style="line-height:24px"><i class="fas fa-crown"></i></li>';
                            }
            echo'   </ul>
                    <span class="item-love">';
                    if($favorites > 0){
                        echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$idElan.'">';
                    } else {
                        echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$idElan.'">';
                    }
            echo'    </span>
                </div>
                <div class="item-content">
                    <h2>
                            <a href="preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">'.substr($mezmun, 0, 28).'...</a>
                    </h2> ';
                    if($city == ""){
                        echo'   <p>'.$time.'</p>';
                    } else {
                        echo'   <p>'.$city.', '.$time.'</p>';
                    }
            echo'    </div>
            </div>
        </div>';
    }
?>