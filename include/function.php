<?php
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

    // Control Select
    function controlSelect($valueSelect, $nameSelect){
        if(empty($valueSelect)){
			$data["text"]=$nameSelect." mütləq seçilməlidir";
			
			echo json_encode($data);
		} else {
            return true;
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

    // Control Elan Title
    function controlElanTitle($valueElanTitle, $nameElanTitle, $count){
        if(empty($valueElanTitle)){
			$data["text"]=$nameElanTitle." boş buraxılmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueElanTitle) > $count){
                return true;
                /*
                // only enter aphabetical letters
				if(preg_replace("/[а-яА-Яa-zA-ZƏəIıÖöĞğÇçŞşüÜİi\s0-9]/", "",$valueElanTitle)==true){
					$data["text"]=$nameElanTitle." ancaq hərflərdən və rəqəmlərdən ibarət olmalıdır";

					echo json_encode($data);
				} else {
                    return true;
                }
                */
            } else {
                $summary=$count+1;
                $data["text"]=$nameElanTitle." minimum ".$summary." karakter olmalıdır";
						
				echo json_encode($data);
            }
        }
    }

    // Control Name / Surname / Title
    function controlText($valueText, $nameText, $startcount){
        if(empty($valueText)){
			$data["text"]=$nameText." boş qalmamalıdır";
			
			echo json_encode($data);
		} else {
            if(strlen($valueText) > $startcount){
                return true;                
            } else {
                $summary=$startcount+1;
                $data["text"]=$nameText." minimum ".$summary." karakter olmalıdır";
						
				echo json_encode($data);
            }
        }
    }

    // multi options check
    function checkMultiOptions($value){
        for($i=0; $i < count($value); $i++) {
            if($value[$i] == "") {
                $data["text"]="Zəhmət olmasa bütün xanaları doldurun";
                echo json_encode($data);
            } else {
                return true;
            }
        }
    }

    // multi files check
    function checkMultiFiles($value){
        $enaz=1;
        $encok=10;

        if(count($value['size']) > $enaz){
            if(count($value['size']) < $encok){
                return true;
            } else {
                $data["text"]="Maksimum ən çoxu ".$encok." şəkil yerləşdirilməlidir";
                echo json_encode($data);
            }
        } else {
            $data["text"]="Minimum ən azı ".$enaz." şəkil yerləşdirilməlidir";
            echo json_encode($data);
        }
    }

    // create time 
    $aylar_TR = array("Yanvar","Fevral","Mart","Aprel","May","İyun","İyul","Avqust","Sentyabr","Oktyabr","Noyabr","Dekabr");
    $aylar_EN = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

    // create add item
    function addItem($img, $price, $idElan, $mezmun, $city, $time, $raiting, $favorites){
echo'   <div class="col-6 col-lg-4 col-xl-3">
            <div class="item-container">
                <div class="item-image"> ';
            echo'   <a href="preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                        <img src="img/advert/'.$img.'" alt="'.seflink($mezmun).'"/>
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
                        echo '<img src="img/icons/heart_full.png" alt="heart" class="heart" id="'.$idElan.'">';
                    } else {
                        echo '<img src="img/icons/heart_empty.png" alt="heart" class="heart" id="'.$idElan.'">';
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

    // create add item
    function addItemExtra($img, $price, $idElan, $mezmun, $city, $time, $raiting, $favorites){
    echo'   <div class="col-6 col-lg-4 col-xl-3">
                <div class="item-container">
                    <div class="item-image"> ';
                echo'   <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
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
                            <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">'.substr($mezmun, 0, 28).'...</a>
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