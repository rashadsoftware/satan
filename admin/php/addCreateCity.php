<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$inputCity=mysqli_real_escape_string($connect, trim($_POST["inputCity"]));
		$inputCitySeflink=seflink($inputCity);
        
        $controlInputCity=controlTitle($inputCity, "Şəhərin adı", 2);
		if($controlInputCity==true){
			$query=mysqli_query($connect, "SELECT *  FROM cities WHERE city_seflink='$inputCitySeflink'");
			if(mysqli_num_rows($query) > 0){
				$data["text"]="Verilənlər bazasında bu adda şəhər var!";
				
				echo json_encode($data);
			} else {
				$newCity = "INSERT IGNORE INTO cities (city_title, city_seflink) VALUES ('$inputCity', '$inputCitySeflink')";

				if(mysqli_query($connect, $newCity)){

					$data["ok"]="ok";
					$data["text"]="Yeni şəhər başarılı şəkildə yaradıldı.";
			
					echo json_encode($data);
				} else {
					$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
				
					echo json_encode($data);
				}
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>