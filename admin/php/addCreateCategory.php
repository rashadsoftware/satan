<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputCategory=mysqli_real_escape_string($connect, trim($_POST["inputCategory"]));
		$inputInputCategorySeflink=seflink($inputCategory);
		$inputCategoryIcon=$_FILES["inputCategoryIcon"];
        
        $controlInputCategory=controlTitle($inputCategory, "Kateqoriya adı", 2);
		if($controlInputCategory==true){	
			$maxSize=3000000; 
			$extension=explode(".", $inputCategoryIcon["name"]);
			$name=md5(rand()).".".end($extension);
			$location='../../img/categories/'.$name; 

			$controlImage=controlImage($inputCategoryIcon, "Kateqoriya şəkli", $maxSize);
            if($controlImage==true){
				$query=mysqli_query($connect, "SELECT *  FROM categories WHERE category_seflink='$inputInputCategorySeflink'");
				if(mysqli_num_rows($query) > 0){
					$data["text"]="Verilənlər bazasında bu adda kateqoriya var!";
					
					echo json_encode($data);
				} else {
					if(is_uploaded_file($inputCategoryIcon["tmp_name"])){
						$uploadMove=move_uploaded_file($inputCategoryIcon["tmp_name"],$location);
	
						if($uploadMove){
							$newCategory = "INSERT IGNORE INTO categories (category_title, category_seflink, category_image) VALUES ('$inputCategory', '$inputInputCategorySeflink', '$name')";
	
							if (mysqli_query($connect, $newCategory)) {
								$data["ok"]="ok";
								$data["text"]="Yeni kateqoriya başarılı şəkildə yaradıldı.";
						
								echo json_encode($data);
							} else {
								$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
												
								echo json_encode($data);
							}
						} else {
							$data["text"]="Şəkilin digər fayla daşınması zamanı nöqsan yarandı. Yenidən cəhd edin.";
												
							echo json_encode($data);
						}
					} else {
						$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
			
						echo json_encode($data);
					}
				}
            }
        }
		
		mysqli_close($connect);
	}
	
	
?>