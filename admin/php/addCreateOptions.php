<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectCategory=mysqli_real_escape_string($connect, trim($_POST["selectCategory"]));
		$selectSubCategory=mysqli_real_escape_string($connect, trim($_POST["selectSubCategory"]));
		$inputOptions=mysqli_real_escape_string($connect, trim($_POST["inputOptions"]));
		$selectOptionsType=mysqli_real_escape_string($connect, trim($_POST["selectOptionsType"]));
		$selectOptionsSecurity=mysqli_real_escape_string($connect, trim($_POST["selectOptionsSecurity"]));
		$inputOptionsSeflink=seflink($inputOptions);

		$controlSelectCategory=controlSelect($selectCategory, "Üst Kateqoriya");
		if($controlSelectCategory==true){
			$controlSelectSubCategory=controlSelect($selectSubCategory, "Alt Kateqoriya");
			if($controlSelectSubCategory==true){
				$controlInputOptions=controlTitleExtra($inputOptions, "Parametr adı", 2);
				if($controlInputOptions==true){
					$controlselectOptionsType=controlSelect($selectOptionsType, "Kateqoriya tipi");
					if($controlselectOptionsType==true){
						if($selectOptionsType == "text"){
							$controlselectOptionsSecurity=controlSelect($selectOptionsSecurity, "Kateqoriya mühafizəsi");
							if($controlselectOptionsSecurity==true){
								$query=mysqli_query($connect, "SELECT *  FROM options WHERE subcategory_id='$selectSubCategory' AND options_seflink='$inputOptionsSeflink' ");
								if(mysqli_num_rows($query) > 0){
									$data["text"]="Verilənlər bazasında bu adda parametr var. Yenidən cəhd edin!";
									
									echo json_encode($data);
								} else {
									$newsubOptions = "INSERT IGNORE INTO options (category_id, subcategory_id, options_title, options_seflink, options_type, options_security) VALUES ('$selectCategory', '$selectSubCategory', '$inputOptions', '$inputOptionsSeflink', '$selectOptionsType', '$selectOptionsSecurity')";

									if(mysqli_query($connect, $newsubOptions)){

										$data["ok"]="ok";
										$data["text"]="Yeni parametr başarılı şəkildə yaradıldı.";
								
										echo json_encode($data);
									} else {
										$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
									
										echo json_encode($data);
									}
								}
							}
						} else {
							$query=mysqli_query($connect, "SELECT *  FROM options WHERE subcategory_id='$selectSubCategory' AND options_seflink='$inputOptionsSeflink' ");
							if(mysqli_num_rows($query) > 0){
								$data["text"]="Verilənlər bazasında bu adda parametr var. Yenidən cəhd edin!";
								
								echo json_encode($data);
							} else {
								$newsubOptions = "INSERT IGNORE INTO options (category_id, subcategory_id, options_title, options_seflink, options_type) VALUES ('$selectCategory', '$selectSubCategory', '$inputOptions', '$inputOptionsSeflink', '$selectOptionsType')";

								if(mysqli_query($connect, $newsubOptions)){

									$data["ok"]="ok";
									$data["text"]="Yeni parametr başarılı şəkildə yaradıldı.";
							
									echo json_encode($data);
								} else {
									$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
								
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