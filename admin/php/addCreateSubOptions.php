<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectSubOptions=mysqli_real_escape_string($connect, trim($_POST["selectSubOptions"]));
		$inputsubOptions=mysqli_real_escape_string($connect, trim($_POST["inputsubOptions"]));
		$inputsubOptionsSeflink=seflink($inputsubOptions);

		$controlSelectSubOptions=controlSelect($selectSubOptions, "Əsas parametr");
		if($controlSelectSubOptions==true){
			$controlInputsubOptions=controlTitleExtra($inputsubOptions, "Alt parametr adı", 1);
			if($controlInputsubOptions==true){
				$query=mysqli_query($connect, "SELECT *  FROM suboptions WHERE options_id='$selectSubOptions' AND suboptions_seflink='$inputsubOptionsSeflink' ");
				if(mysqli_num_rows($query) > 0){
					$data["text"]="Verilənlər bazasında bu adda alt parametr var. Yenidən cəhd edin!";
					
					echo json_encode($data);
				} else {
					$newsuboptions = "INSERT IGNORE INTO suboptions (options_id, suboptions_title, suboptions_seflink) VALUES ('$selectSubOptions', '$inputsubOptions', '$inputsubOptionsSeflink')";

					if(mysqli_query($connect, $newsuboptions)){

						$data["ok"]="ok";
						$data["text"]="Yeni alt parametr başarılı şəkildə yaradıldı.";
				
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