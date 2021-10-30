<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();
        
        $subcategories_list = mysqli_query($connect, "SELECT * FROM subcategories WHERE category_id='".$_POST["category_id"]."'");
        $options_list = mysqli_query($connect, "SELECT * FROM options WHERE category_id='".$_POST["category_id"]."'");
        
        if(mysqli_num_rows($subcategories_list) > 0){
            $data["text"]="Bu kateqoriyanın alt kateqoriyası var. Silinmə yalnız alt kateqoriya silinən zaman baş verəcəkdir.";
                            
            echo json_encode($data);
        } else {
            if(mysqli_num_rows($options_list) > 0){
                $data["text"]="Bu kateqoriya parametrlər sahəsində isifadə olunur.";
                                
                echo json_encode($data);
            } else {
                $query=mysqli_query($connect, "SELECT *  FROM categories WHERE category_id = '".$_POST["category_id"]."' ");

                // Remove image from Folder
                $deleteFolder=mysqli_fetch_array($query);
                $imageFolder=$deleteFolder["category_image"];
                unlink("../../img/categories/".$imageFolder);

                $categories=mysqli_query($connect, "DELETE FROM categories WHERE category_id='".$_POST["category_id"]."'");

                if($categories){
                    $data["ok"]="ok";
                    $data["text"]="Kateqoriya başarılı şəkildə verilənlər bazasından silindi";
                            
                    echo json_encode($data);
                } else {
                    $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                    echo json_encode($data);
                }
            }
            
        }
        
        mysqli_close($connect);
	}
	
?>