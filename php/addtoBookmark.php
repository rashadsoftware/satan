<?php
    // added to bookmark
    if(isset($_POST['idImgFavorites'])){
        include("../include/connectDB.php");

        $data=array();

        $idImgFavorites=$_POST['idImgFavorites'];

        $ipAddress=$_SERVER['REMOTE_ADDR'];

        $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idImgFavorites' AND favorites_ip='$ipAddress' ");

        if(mysqli_num_rows($favorites_list) > 0){
            $updateCategory=mysqli_query($connect, "DELETE FROM favorites WHERE elan_id='$idImgFavorites' AND favorites_ip='$ipAddress' ");

            if($updateCategory){

                $data["ok"]="no";
                $data["id"]=$idImgFavorites;
        
                echo json_encode($data);
            }
            
        } else {
            $newsubOptions = mysqli_query($connect, "INSERT IGNORE INTO favorites (elan_id, favorites_ip) VALUES ('$idImgFavorites', '$ipAddress')" );

            if($newsubOptions){

                $data["ok"]="ok";
                $data["id"]=$idImgFavorites;
        
                echo json_encode($data);
            }
        }

        mysqli_close($connect);
    }
?>