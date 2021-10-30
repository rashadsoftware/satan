<?php
    // Create Dynamic Title tags
    function dynamic_title($title){
        $output= ob_get_contents();
        if(ob_get_length() > 0){
            ob_end_clean();
        }
        $patterns=array("/<title>(.*?)<\/title>/");
        $replacements=array("<title>$title</title>");
        $output=preg_replace($patterns, $replacements, $output);
        echo $output;
    }

    // Create Dynamic Alert Notification
    function dynamic_alert_notification($id){
        echo '<div class="alert alert-danger" role="alert" style="display:none" id="'.$id.'"></div>';
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

    // Control Email
    function controlEmail($valueEmail, $nameEmail){
        if(empty($valueEmail)){
			$data["text"]=$nameEmail. " boş buraxılmamalıdır";
			
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

    // Control Only Text and Number
    function controlTextNumber($valueTextNumber, $nameTextNumber, $countTextNumber){
        if(empty($valueTextNumber)){
			$data["text"]=$nameTextNumber." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueTextNumber) > $countTextNumber){
                return true;
            } else {
                $result=$countTextNumber+1;
                $data["text"]=$nameTextNumber." minimum ".$result." karakter olmalıdır.";
						
				echo json_encode($data);
            }
        }
    }

    // Control Name
    function controlTitle($valueTitle, $nameTitle, $count){
        if(empty($valueTitle)){
			$data["text"]=$nameTitle." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueTitle) > $count){
                // only enter aphabetical letters
				if(preg_replace("/[A-Za-zĞğÖöIıƏəŞşÇçÜüIıİi,. ]/", "",$valueTitle)==true){
					$data["text"]=$nameTitle." ancaq hərflərdən ibarət olmalıdır.";

					echo json_encode($data);
				} else {
                    return true;
                }
            } else {
                $summary=$count+1;
                $data["text"]=$nameTitle." minimum ".$summary." karakter olmalıdır.";
						
				echo json_encode($data);
            }
        }
    }

    // Control Name
    function controlTitleExtra($valueTitle, $nameTitle, $count){
        if(empty($valueTitle)){
			$data["text"]=$nameTitle." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueTitle) > $count){
                // only enter aphabetical letters
				if(preg_replace("/[0-9A-Za-zĞğÖöIıƏəŞşÇçÜüIıİi,.\/\- ]/", "",$valueTitle)==true){
					$data["text"]=$nameTitle." ancaq hərflərdən ibarət olmalıdır.";

					echo json_encode($data);
				} else {
                    return true;
                }
            } else {
                $summary=$count+1;
                $data["text"]=$nameTitle." minimum ".$summary." karakter olmalıdır.";
						
				echo json_encode($data);
            }
        }
    }

    // Control Select
    function controlSelect($valueSelect, $nameSelect){
        if(empty($valueSelect)){
			$data["text"]=$nameSelect." sahəsi boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            return true;
        }
    }

    // Control Ikon
    function controlIkon($valueTitle, $nameTitle){
        if(empty($valueTitle)){
			$data["text"]=$nameTitle." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            return true;
        }
    }

    // Control color
    function controlColor($valueTitle, $nameTitle){
        if(empty($valueTitle)){
			$data["text"]=$nameTitle." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            return true;
        }
    }

    // Control URL
    function controlURL($valueURL, $nameURL){
        if(empty($valueURL)){
			$data["text"]=$nameURL. " boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(filter_var($valueURL,FILTER_VALIDATE_URL)){
                return true;
            } else {
                $data["text"]=$nameURL." etibarlı deyil. Yenidən cəhd edin!";
				
				echo json_encode($data);
            }
        }
    }

    // Control Price
    function controlPrice($valuePrice, $namePrice){
        if(empty($valuePrice)){
			$data["text"]=$namePrice." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(preg_replace("/[0-9]/", "",$valuePrice)==true){
                $data["text"]=$namePrice." ancaq rəqəmlərdən ibarət olmalıdır.";

                echo json_encode($data);
            } else {
                return true;
            }
        }
    }

    // Control Name / Surname / Title
    function controlText($valueText, $nameText, $startcount, $endcount){
        if(empty($valueText)){
			$data["text"]=$nameText." boş qalmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueText) > $startcount){
                $sumEndCount=$endcount+1;
                if(strlen($valueText) < $sumEndCount){
                    return true;
                } else {
                    $data["text"]=$nameText." maksimum ".$endcount." karakter olmalıdır";
						
				    echo json_encode($data);
                }
                
            } else {
                $summary=$startcount+1;
                $data["text"]=$nameText." minimum ".$summary." karakter olmalıdır";
						
				echo json_encode($data);
            }
        }
    }

    // Control Phone
    function controlPhone($valuePhone, $namePhone, $countPhone){
        if(empty($valuePhone)){
			$data["text"]=$namePhone." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valuePhone) == $countPhone){
                // only enter aphabetical letters
				if(preg_replace("/0[0-9]{9}/", "",$valuePhone)==true){
					$data["text"]=$namePhone." ancaq rəqəmlərdən ibarət olmalıdır və göstərilən standartlara cavab verməlidir.";

					echo json_encode($data);
				} else {
                    return true;
                }
            } else {
                $data["text"]=$namePhone." minimum ".$countPhone." karakter olmalıdır.";
						
				echo json_encode($data);
            }
        }
    }

    // Control Image
    function controlImage($valueImage, $nameImage, $sizeImage){
        if($valueImage["name"]){
            if($valueImage["size"] > $sizeImage){
                $kb=$sizeImage/1000;
                $data["text"]="Şəkil çox böyükdür. İcazə verilən maxsimum ölçü ".$kb."KB-dır.";
            
                echo json_encode($data);
            } else {
                $fileType=$valueImage["type"];

                if($fileType=="image/png" || $fileType=="image/jpeg" || $fileType=="image/gif" || $fileType=="image/jpg"){
                    return true;
                } else {
                    $data["text"]="Şəklin formatı təyin olunmayıb. Şəkilin formatı ancaq PNG, JPEG, GIF və JPG ola bilər.";
            
                    echo json_encode($data);
                }
            }
        } else {
            $data["text"]=$nameImage." boş buraxılmamalıdır";
            
            echo json_encode($data);
        }
    }
?>