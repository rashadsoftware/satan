<?php
    if(isset($_POST['idAdd'])){
        include("../include/connectDB.php");

        $data=array();
        
        $subparametres=mysqli_query($connect, "SELECT * FROM parametres WHERE parametres_raiting ='".$_POST['idAdd']."' ");
        $subparametresItem=mysqli_fetch_array($subparametres);

        $data["text"]=substr($subparametresItem['parametres_value'], 0, 202)."<a href='../services' style='color:var(--main-color)'> ... Ətraflı oxu</a>";      
        $data["title"]=$subparametresItem['parametres_title'];                             
        echo json_encode($data);

        mysqli_close($connect);
    }
?>