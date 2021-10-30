<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectSubCategory=mysqli_real_escape_string($connect, trim($_POST["selectSubCategory"]));
		$inputsubCategory=mysqli_real_escape_string($connect, trim($_POST["inputsubCategory"]));
		$inputInputsubCategorySeflink=seflink($inputsubCategory);

		$controlSelectSubCategory=controlSelect($selectSubCategory, "Ana kateqoriya");
		if($controlSelectSubCategory==true){
			$controlInputsubCategory=controlTitle($inputsubCategory, "Alt kateqoriya adı", 2);
			if($controlInputsubCategory==true){
				$query=mysqli_query($connect, "SELECT *  FROM subcategories WHERE category_id='$selectSubCategory' AND subcategory_seflink='$inputInputsubCategorySeflink' ");
				if(mysqli_num_rows($query) > 0){
					$data["text"]="Verilənlər bazasında bu adda alt kateqoriya var. Yenidən cəhd edin!";
					
					echo json_encode($data);
				} else {
					$newsubCategory = "INSERT IGNORE INTO subcategories (category_id, subcategory_title, subcategory_seflink) VALUES ('$selectSubCategory', '$inputsubCategory', '$inputInputsubCategorySeflink')";

					if(mysqli_query($connect, $newsubCategory)){

						$data["ok"]="ok";
						$data["text"]="Yeni alt kateqoriya başarılı şəkildə yaradıldı.";
				
						echo json_encode($data);
					} else {
						$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
					
						echo json_encode($data);
					}
				}
			}
		}
		
		mysqli_close($connect);
	}
	
	
?>