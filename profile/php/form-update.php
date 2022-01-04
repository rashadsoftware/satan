<?php
    if(isset($_POST)){
        include("../../assets/include/connectDB.php");
		include("../../assets/include/function.php");

        $data=array();

        // get value
        $inputName=mysqli_real_escape_string($connect, trim($_POST["inputName"]));
        $selectUser=mysqli_real_escape_string($connect, trim($_POST["selectUser"]));
        $inputEmail=mysqli_real_escape_string($connect, trim($_POST["inputEmail"]));
        $inputPhone=mysqli_real_escape_string($connect, trim($_POST["inputPhone"]));
        $selectsubCategory=mysqli_real_escape_string($connect, trim($_POST["selectsubCategory"]));        
        $selectCity=mysqli_real_escape_string($connect, trim($_POST["selectCity"]));
        $inputTitleElan=mysqli_real_escape_string($connect, trim($_POST["inputElanTitle"]));
        $inputPrice=mysqli_real_escape_string($connect, trim($_POST["inputPrice"]));
        $textareaAdd=mysqli_real_escape_string($connect, trim($_POST["textareaAdd"]));

        $hiddenInput=mysqli_real_escape_string($connect, trim($_POST["hiddenInput"]));
        $allImages=mysqli_real_escape_string($connect, trim($_POST["allImages"]));

        $elan_status="waiting";

        $controlName=controlTitle($inputName, "İstifadəçinin adı", 1);
        if($controlName==true){
            $controlSelectUser=controlSelect($selectUser, "Elan verən");
            if($controlSelectUser==true){
                $controlEmail=controlEmail($inputEmail, "Email");
                if($controlEmail==true){
                    $controlPhone=controlPhone($inputPhone, "Əlaqə telefonu", 10);
                    if($controlPhone==true){
                        $controlSelectsubCategory=controlSelect($selectsubCategory, "Kateqoriya sahəsi");
                        if($controlSelectsubCategory==true){
                            
                        }
                    }
                }
            }
        }

        mysqli_close($connect);
    }
?>