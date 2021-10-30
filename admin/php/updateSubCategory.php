<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$selectSubCategory=mysqli_real_escape_string($connect, trim($_POST["selectSubCategory"]));
		$inputsubCategory=mysqli_real_escape_string($connect, trim($_POST["inputsubCategory"]));
		$inputInputsubCategorySeflink=seflink($inputsubCategory);

		$controlSelectSubCategory=controlSelect($selectSubCategory, "Ana kateqoriya");
		if($controlSelectSubCategory==true){
			$controlInputsubCategory=controlTitle($inputsubCategory, "Alt kateqoriya adı", 2);
			if($controlInputsubCategory==true){
				$querySelect=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id = '$inputHiddenID' ");
				if(mysqli_num_rows($querySelect) > 0){
					$query=mysqli_query($connect, "SELECT *  FROM subcategories WHERE category_id='$selectSubCategory' AND subcategory_seflink='$inputInputsubCategorySeflink' ");

					if(mysqli_num_rows($query) > 0){
						$data["text"]="Verilənlər bazasında bu adda alt kateqoriya var. Yenidən cəhd edin!";
						
						echo json_encode($data);
					} else {
						$updateSubCategory=mysqli_query($connect, "UPDATE subcategories SET subcategory_title='$inputsubCategory', subcategory_seflink='$inputInputsubCategorySeflink', category_id='$selectSubCategory' WHERE subcategory_id = '$inputHiddenID'");

						if($updateSubCategory){

							$data["ok"]="ok";
							$data["text"]="Alt kateqoriya başarılı şəkildə yeniləndi.";
					
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
		
		mysqli_close($connect);
	}
	
	
?>