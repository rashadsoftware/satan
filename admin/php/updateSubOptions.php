<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$selectSubOptions=mysqli_real_escape_string($connect, trim($_POST["selectSubOptions"]));
		$inputsubOptions=mysqli_real_escape_string($connect, trim($_POST["inputsubOptions"]));
		$inputsubOptionsSeflink=seflink($inputsubOptions);

		$controlselectSubOptions=controlSelect($selectSubOptions, "Əsas Parametr");
		if($controlselectSubOptions==true){
			$controlInputsubOptions=controlTitleExtra($inputsubOptions, "Alt parametr adı", 1);
			if($controlInputsubOptions==true){
				$querySelect=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id = '$inputHiddenID' ");
				if(mysqli_num_rows($querySelect) > 0){
					$query=mysqli_query($connect, "SELECT *  FROM suboptions WHERE options_id='$selectSubOptions' AND suboptions_seflink='$inputsubOptionsSeflink' ");

					if(mysqli_num_rows($query) > 0){
						$data["text"]="Verilənlər bazasında bu adda alt parametr var. Yenidən cəhd edin!";
						
						echo json_encode($data);
					} else {
						$updateSubOptions=mysqli_query($connect, "UPDATE suboptions SET suboptions_title='$inputsubOptions', suboptions_seflink='$inputsubOptionsSeflink', options_id='$selectSubOptions' WHERE suboptions_id = '$inputHiddenID'");

						if($updateSubOptions){

							$data["ok"]="ok";
							$data["text"]="Alt parametr başarılı şəkildə yeniləndi.";
					
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