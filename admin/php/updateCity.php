<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$inputCity=mysqli_real_escape_string($connect, trim($_POST["inputCity"]));
		$inputCitySeflink=seflink($inputCity);
        
        $controlInputCity=controlTitle($inputCity, "Şəhərin adı", 2);
		if($controlInputCity==true){
			$query=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id = '$inputHiddenID' ");
			if(mysqli_num_rows($query) > 0){
				$updateCity=mysqli_query($connect,"UPDATE cities SET city_title='$inputCity', city_seflink='$inputCitySeflink' WHERE city_id = '$inputHiddenID'");

				if($updateCity){

					$data["ok"]="ok";
					$data["text"]="Şəhər başarılı şəkildə yeniləndi.";
			
					echo json_encode($data);
				} else {
					$data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
				
					echo json_encode($data);
				}
			} else {
				$data["text"]="Verilənlər bazasında bu adda şəhər yoxdur!";
				
				echo json_encode($data);
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>