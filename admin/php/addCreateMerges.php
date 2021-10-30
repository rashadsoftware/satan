<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$selectCategory=mysqli_real_escape_string($connect, trim($_POST["selectCategory"]));
        $selectSubCategory=mysqli_real_escape_string($connect, trim($_POST["selectSubCategory"]));
        
        $controlSelectCategory=controlSelect($selectCategory, "Üst Kateqoriyanın adı");
		if($controlSelectCategory==true){
            $controlSelectSubCategory=controlSelect($selectSubCategory, "Alt Kateqoriyanın adı");
		    if($controlSelectSubCategory==true){
                $query=mysqli_query($connect, "SELECT *  FROM merges WHERE merge_key='$selectCategory' AND merge_value='$selectSubCategory' ");
                if(mysqli_num_rows($query) > 0){
                    $data["text"]="Verilənlər bazasında bu adda birləşmə var!";
                    
                    echo json_encode($data);
                } else {
                    $newCity = "INSERT IGNORE INTO merges (merge_key, merge_value) VALUES ('$selectCategory', '$selectSubCategory')";

                    if(mysqli_query($connect, $newCity)){

                        $data["ok"]="ok";
                        $data["text"]="Kateqoriyalar başarılı şəkildə birləşdirildi.";
                
                        echo json_encode($data);
                    } else {
                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                    
                        echo json_encode($data);
                    }
                }
            }
        }
		
		mysqli_close($connect);
	}
	
	
?>