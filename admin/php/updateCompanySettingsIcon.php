<?php
	if(isset($_POST)){

        include("../include/connectDB.php");
        include("../include/function.php");

		$data=array();

        $inputIconImage=$_FILES["inputIconImage"];
        
        $query=mysqli_query($connect,"SELECT * FROM companies WHERE company_status='main'");

        if(mysqli_num_rows($query) > 0){
			$maxSize=700000; 
			$extension=explode(".", $inputIconImage["name"]);
			$nameIcon=md5(rand()).".".end($extension);
			$location='../../img/'.$nameIcon; 

			$controlIconImage=controlImage($inputIconImage, "Şirkət faviconu", $maxSize);
			if($controlIconImage==true){
				if(is_uploaded_file($inputIconImage["tmp_name"])){
					$uploadMove=move_uploaded_file($inputIconImage["tmp_name"],$location);

					if($uploadMove){
						// Remove image from Folder
						$deleteFolder=mysqli_fetch_array($query);
						$imageFolder=$deleteFolder["company_favicon"];
						unlink("../../img/".$imageFolder);

						$updateCompanyIcon= "UPDATE companies SET company_favicon='$nameIcon' WHERE company_status='main'";

						if (mysqli_query($connect, $updateCompanyIcon)) {
							$data["ok"]="ok";
							$data["text"]="Favicon başarılı şəkildə bazaya yükləndi. !";
							
							echo json_encode($data);
						} else {
							$data["text"]="Faviconun bazaya yüklənməsi zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
							echo json_encode($data);
						}
					} else {
						$data["text"]="Faviconun digər fayla daşınması zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
						echo json_encode($data);
					}
				} else {
					$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
		
					echo json_encode($data);
				}
			}
        } else {
            $data["text"]="Şirkət mövcud deyil. Yenidən cəhd edin.";
												
			echo json_encode($data);
        }
		
		mysqli_close($connect);
	}
	
	
?>