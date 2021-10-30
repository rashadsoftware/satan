<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$selectCategory=mysqli_real_escape_string($connect, trim($_POST["selectCategory"]));
		$selectSubCategory=mysqli_real_escape_string($connect, trim($_POST["selectSubCategory"]));
		$inputOptions=mysqli_real_escape_string($connect, trim($_POST["inputOptions"]));
		$selectOptionsType=mysqli_real_escape_string($connect, trim($_POST["selectOptionsType"]));
		$selectOptionsSecurity=mysqli_real_escape_string($connect, trim($_POST["selectOptionsSecurity"]));
		$inputOptionsSeflink=seflink($inputOptions);

		$controlSelectCategory=controlSelect($selectCategory, "Üst Kateqoriya");
		if($controlSelectCategory==true){
			$controlselectSubCategory=controlSelect($selectSubCategory, "Alt Kateqoriya");
			if($controlselectSubCategory==true){
				$controlinputOptions=controlTitle($inputOptions, "Parametr adı", 2);
				if($controlinputOptions==true){
					$controlselectOptionsType=controlSelect($selectOptionsType, "Kateqoriya tipi");
					if($controlselectOptionsType==true){
						if($selectOptionsType != "select"){
							$controlselectOptionsSecurity=controlSelect($selectOptionsSecurity, "Kateqoriya mühafizəsi");
							if($controlselectOptionsSecurity==true){
								$querySelect=mysqli_query($connect, "SELECT *  FROM options WHERE options_id = '$inputHiddenID' ");
								if(mysqli_num_rows($querySelect) > 0){
									$query=mysqli_query($connect, "SELECT *  FROM options WHERE subcategory_id='$selectSubCategory' AND options_seflink='$inputOptionsSeflink' ");

									if(mysqli_num_rows($query) > 0){
										$data["text"]="Verilənlər bazasında bu adda parametr var. Yenidən cəhd edin!";
										
										echo json_encode($data);
									} else {
										$updateOptions=mysqli_query($connect, "UPDATE options SET category_id='$selectCategory', subcategory_id='$selectSubCategory', options_title='$inputOptions', options_seflink='$inputOptionsSeflink', options_type='$selectOptionsType', options_security='$selectOptionsSecurity' WHERE options_id = '$inputHiddenID'");

										if($updateOptions){

											$data["ok"]="ok";
											$data["text"]="Parametr başarılı şəkildə yeniləndi.";
									
											echo json_encode($data);
										} else {
											$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
										
											echo json_encode($data);
										}
									}
								} else {
									$data["text"]="Verilənlər bazası ilə bağlantı qurulamadı. Yenidən cəhd edin!";
									
									echo json_encode($data);
								}
							}
						} else {
							$selectOptionsSecurity =" ";
							$querySelect=mysqli_query($connect, "SELECT *  FROM options WHERE options_id = '$inputHiddenID' ");
							if(mysqli_num_rows($querySelect) > 0){
								$query=mysqli_query($connect, "SELECT *  FROM options WHERE subcategory_id='$selectSubCategory' AND options_seflink='$inputOptionsSeflink' ");

								if(mysqli_num_rows($query) > 0){
									$data["text"]="Verilənlər bazasında bu adda parametr var. Yenidən cəhd edin!";
									
									echo json_encode($data);
								} else {
									$updateOptions=mysqli_query($connect, "UPDATE options SET category_id='$selectCategory', subcategory_id='$selectSubCategory', options_title='$inputOptions', options_seflink='$inputOptionsSeflink', options_type='$selectOptionsType', options_security='$selectOptionsSecurity' WHERE options_id = '$inputHiddenID'");

									if($updateOptions){

										$data["ok"]="ok";
										$data["text"]="Parametr başarılı şəkildə yeniləndi.";
								
										echo json_encode($data);
									} else {
										$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
									
										echo json_encode($data);
									}
								}
							} else {
								$data["text"]="Verilənlər bazası ilə bağlantı qurulamadı. Yenidən cəhd edin!";
								
								echo json_encode($data);
							}
						}
					}

					
				}
			}
		}
		
		
		mysqli_close($connect);
	}
	
	
?>