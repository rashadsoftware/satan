<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$inputCategory=mysqli_real_escape_string($connect, trim($_POST["inputCategory"]));
		$inputCategorySeflink=seflink($inputCategory);
		$inputCategoryIcon=$_FILES["inputCategoryIcon"];
        
        $controlInputCategory=controlTitle($inputCategory, "Kateqoriya adı", 2);
		if($controlInputCategory==true){
			$maxSize=3000000; 
			$extension=explode(".", $inputCategoryIcon["name"]);
			$name=md5(rand()).".".end($extension);
			$location='../../img/categories/'.$name;

			$controlInputCategoryIcon=controlImage($inputCategoryIcon, "Kateqoriya şəkli", $maxSize);
			if($controlInputCategoryIcon==true){
				$query=mysqli_query($connect, "SELECT *  FROM categories WHERE category_id = '$inputHiddenID' ");
				if(mysqli_num_rows($query) > 0){
					if(is_uploaded_file($inputCategoryIcon["tmp_name"])){
						$uploadMove=move_uploaded_file($inputCategoryIcon["tmp_name"],$location);
	
						if($uploadMove){
							// Remove image from Folder
							$deleteFolder=mysqli_fetch_array($query);
							$imageFolder=$deleteFolder["category_image"];
							unlink("../../img/categories/".$imageFolder);

							$updateCategory=mysqli_query($connect,"UPDATE categories SET category_title='$inputCategory', category_seflink='$inputCategorySeflink', category_image='$name' WHERE category_id = '$inputHiddenID'");

							if($updateCategory){

								$data["ok"]="ok";
								$data["text"]="Kateqoriya başarılı şəkildə yeniləndi.";
						
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
				} else {
					$data["text"]="Verilənlər bazasında bu adda kateqoriya yoxdur!";
					
					echo json_encode($data);
				}
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>