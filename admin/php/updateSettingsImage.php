<?php
	if(isset($_POST)){

        include("../include/connectDB.php");
        include("../include/function.php");

		$data=array();

        $inputImage=$_FILES["inputUserImage"];
        $inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));
        
        $query=mysqli_query($connect,"SELECT * FROM users WHERE user_id='$inputHiddenID'");

        if(mysqli_num_rows($query) > 0){
            $maxSize=7000000; 
            $extension=explode(".", $inputImage["name"]);
			$name=md5(rand()).".".end($extension);
            $location='../img/users/'.$name; 

            $controlImage=controlImage($inputImage, "Profil şəkli", $maxSize);
            if($controlImage==true){
                if(is_uploaded_file($inputImage["tmp_name"])){
                    $uploadMove=move_uploaded_file($inputImage["tmp_name"],$location);

                    if($uploadMove){
                        // Remove image from Folder
                        $deleteFolder=mysqli_fetch_array($query);
                        $imageFolder=$deleteFolder["user_img"];
                        unlink("../img/users/".$imageFolder);

                        $updateUserImage= "UPDATE users SET user_img='$name' WHERE user_id='$inputHiddenID'";

                        if (mysqli_query($connect, $updateUserImage)) {
                            $data["ok"]="ok";
                            $data["text"]="Şəkil başarılı şəkildə bazaya yükləndi. !";
                            
                            echo json_encode($data);
                        } else {
                            $data["text"]="Şəkilin bazaya yüklənməsi zamanı nöqsan yarandı. Yenidən cəhd edin.";
                                            
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
        } else {
            $data["text"]="Bu hesaba aid istifadəçi tapılmadı. Yenidən cəhd edin.";
												
			echo json_encode($data);
        }
		
		mysqli_close($connect);
	}
	
	
?>