<?php
    session_start();

    if(isset($_SESSION["merchant_elan_id"])){
        include("../../connectDB.php");
        $order=$_SESSION["merchant_order"];

        $result=mysqli_query($connect,"UPDATE merchant SET merchant_state=4 WHERE merchant_order = '$order' ");

        $_SESSION["merchant_state"]="danger";
        $_SESSION["merchant_text"]="Ödənişiniz hər hansı səbəbdən alınmadı. Yenidən cəhd edin!"; 

        header("Location:../../../result.php");

        mysqli_close($connect);
    } else {
        header("Location:../../../index.php");
    }
?>