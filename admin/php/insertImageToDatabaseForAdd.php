<?php
	if(isset($_POST)){

        include("../include/connectDB.php");
        include("../include/function.php");

		$data=array();

        $itemImage=$_FILES["itemImage"];
        $hiddenImage=$_POST["hiddenImage"];

        $query=mysqli_query($connect,"SELECT * FROM img WHERE elan_id='$hiddenImage'");

        if(mysqli_num_rows($query) > 0){
			$maxSize=700000; 
            $extension=explode(".", $itemImage["name"]);
			$nameIcon=md5(rand()).".".end($extension);
			$location='../../img/advert/'.$nameIcon; 

			$controlIconImage=controlImage($itemImage, "Elan şəkli", $maxSize);
			if($controlIconImage==true){
				if(is_uploaded_file($itemImage["tmp_name"])){
					$uploadMove=move_uploaded_file($itemImage["tmp_name"], $location);

					if($uploadMove){
						$insertAddIcon= "INSERT IGNORE INTO img (img_path, elan_id) VALUES ('$nameIcon', '$hiddenImage')";

						if (mysqli_query($connect, $insertAddIcon)) {
							$data["ok"]="ok";
							$data["text"]="Elan şəkli başarılı şəkildə bazaya yükləndi. !";
							
							echo json_encode($data);
						} else {
							$data["text"]="Elan şəklinin bazaya yüklənməsi zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
							echo json_encode($data);
						}
					} else {
						$data["text"]="Elan şəklinin digər fayla daşınması zamanı nöqsan yarandı. Yenidən cəhd edin.";
											
						echo json_encode($data);
					}
				} else {
					$data["text"]="Əməliyyat zamanı xəta yarandı. Yenidən cəhd edin.";
		
					echo json_encode($data);
				}
			}
        } else {
            $data["text"]="Elan mövcud deyil. Yenidən cəhd edin.";
												
			echo json_encode($data);
        }
		
		mysqli_close($connect);
	}
	
	
?>