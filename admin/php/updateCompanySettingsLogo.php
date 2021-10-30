<?php
	if(isset($_POST)){

        include("../include/connectDB.php");
        include("../include/function.php");

		$data=array();

        $inputLogoImage=$_FILES["inputLogoImage"];
        
        $query=mysqli_query($connect,"SELECT * FROM companies WHERE company_status='main'");

        if(mysqli_num_rows($query) > 0){
			$maxSize=700000; 
			$extension=explode(".", $inputLogoImage["name"]);
			$nameLogo=md5(rand()).".".end($extension);
			$location='../../img/'.$nameLogo; 

			$controlLogoImage=controlImage($inputLogoImage, "Şirkət logosu", $maxSize);
			if($controlLogoImage==true){
				if(is_uploaded_file($inputLogoImage["tmp_name"])){
					$uploadMove=move_uploaded_file($inputLogoImage["tmp_name"],$location);

					if($uploadMove){
						// Remove image from Folder
						$deleteFolder=mysqli_fetch_array($query);
						$imageFolder=$deleteFolder["company_logo"];
						unlink("../../img/".$imageFolder);

						$updateCompanyLogo= "UPDATE companies SET company_logo='$nameLogo' WHERE company_status='main'";

						if (mysqli_query($connect, $updateCompanyLogo)) {
							$data["ok"]="ok";
							$data["text"]="Logo başarılı şəkildə bazaya yükləndi. !";
							
							echo json_encode($data);
						} else {
							$data["text"]="Logonun bazaya yüklənməsi zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
							echo json_encode($data);
						}
					} else {
						$data["text"]="Logonun digər fayla daşınması zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
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