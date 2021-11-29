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
?>