<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$mainColor=mysqli_real_escape_string($connect, trim($_POST["mainColor"]));
        $secondColor=mysqli_real_escape_string($connect, trim($_POST["secondColor"]));
        $thirdColor=mysqli_real_escape_string($connect, trim($_POST["thirdColor"]));
		
		$controlmainColor=controlColor($mainColor, "Əsas rəng");
		if($controlmainColor==true){
            $controlsecondColor=controlColor($secondColor, "İkkinci rəng");
            if($controlsecondColor==true){
                $controlthirdColor=controlColor($thirdColor, "Üçüncü rəng");
                if($controlthirdColor==true){
                    $updateMainColorSettings=mysqli_query($connect,"UPDATE configs SET configs_value='$mainColor' WHERE configs_key='mainColor'");
                    if($updateMainColorSettings){
                        $updateSecondColorSettings=mysqli_query($connect,"UPDATE configs SET configs_value='$secondColor' WHERE configs_key='secondColor'");
                        if($updateSecondColorSettings){
                            $updateThirdColorSettings=mysqli_query($connect,"UPDATE configs SET configs_value='$thirdColor' WHERE configs_key='thirdColor'");
                            if($updateThirdColorSettings){
                                $data["ok"]="ok";
                                $data["text"]="Saytın şəkilləri başarılı şəkildə dəyişdirildi !";
                            
                                echo json_encode($data);
                            } else {
                                $data["text"]="Xəta yarandı. Yenidən cəhd edin.";
                            
                                echo json_encode($data);
                            }
                        } else {
                            $data["text"]="Xəta yarandı. Yenidən cəhd edin.";
                        
                            echo json_encode($data);
                        }
                    } else {
                        $data["text"]="Xəta yarandı. Yenidən cəhd edin.";
                    
                        echo json_encode($data);
                    }
                }                
            }            
        }
		
		mysqli_close($connect);
	}
	
	
?>