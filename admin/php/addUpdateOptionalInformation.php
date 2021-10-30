<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$inputOptionsName=mysqli_real_escape_string($connect, trim($_POST["inputOptionsName"]));
		$selectElanVeren=mysqli_real_escape_string($connect, trim($_POST["selectElanVeren"]));
        $selectsubCategory=mysqli_real_escape_string($connect, trim($_POST["selectsubCategory"]));
        $selectCity=mysqli_real_escape_string($connect, trim($_POST["selectCity"]));
        $inputPrice=mysqli_real_escape_string($connect, trim($_POST["inputPrice"]));
        $textareaAdd=mysqli_real_escape_string($connect, trim($_POST["textareaAdd"]));
        
        $controlInputOptionsName=controlTitleExtra($inputOptionsName, "Elanın adı", 2);
		if($controlInputOptionsName==true){
			$controlSelectElanVeren=controlSelect($selectElanVeren, "Elan verən");
			if($controlSelectElanVeren==true){
                $controlSelectsubCategory=controlSelect($selectsubCategory, "Kateqoriya sahəsi");
                if($controlSelectsubCategory==true){
                    $controlSelectCity=controlSelect($selectCity, "Şəhər sahəsi");
                    if($controlSelectCity==true){
                        $controlInputPrice=controlPrice($inputPrice, "Qiymət sahəsi");
                        if($controlInputPrice==true){
                            $controlTextareaAdd=controlText($textareaAdd, "Məzmun sahəsi", 14, 3000);
                            if($controlTextareaAdd==true){
                                $query=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id = '$inputHiddenID' ");
                                if(mysqli_num_rows($query) > 0){
                                    $updateElan=mysqli_query($connect,"UPDATE elan SET elan_name='$inputOptionsName', elan_veren='$selectElanVeren', elan_kateqoriya='$selectsubCategory', elan_seher='$selectCity', elan_qiymet='$inputPrice', elan_mezmun='$textareaAdd' WHERE elan_id = '$inputHiddenID'");

                                    if($updateElan){

                                        $data["ok"]="ok";
                                        $data["text"]="Elan başarılı şəkildə yeniləndi.";
                                
                                        echo json_encode($data);
                                    } else {
                                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                                    
                                        echo json_encode($data);
                                    }
                                } else {
                                    $data["text"]="Verilənlər bazasında bu adda elan yoxdur!";
                                    
                                    echo json_encode($data);
                                }
                            }
                        }
                    }
                }
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>