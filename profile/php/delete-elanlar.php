<?php
    $postId=$_GET["id"];
    session_start();

    include("../../assets/include/connectDB.php");

    // remove elan detail
    mysqli_query($connect, "DELETE FROM elan_detail WHERE elan_id='$postId'");

    // remove all img
    $elanlarImg_list = mysqli_query($connect, "SELECT * FROM img WHERE elan_id='$postId'");
    while($elanlarImg=mysqli_fetch_array($elanlarImg_list)){
        unlink("../../img/advert/".$elanlarImg["img_path"]);
    }    
    mysqli_query($connect, "DELETE FROM img WHERE elan_id='$postId'");

    // remove customer
    $elanlar_list = mysqli_query($connect, "SELECT * FROM elan WHERE elan_id='$postId'");
    $elanlar=mysqli_fetch_array($elanlar_list);
    $customer_id=$elanlar["customer_id"];
    mysqli_query($connect, "DELETE FROM customers WHERE customer_id='$customer_id'");

    // remove forward
    $allForwardsElan=mysqli_query($connect, "SELECT * FROM forward WHERE elanID='$postId'");
    if(mysqli_num_rows($allForwardsElan) > 0){
        mysqli_query($connect, "DELETE FROM forward WHERE elanID='$postId'");
    }

    // remove payment
    $allPaymentElan=mysqli_query($connect, "SELECT * FROM payment WHERE elanID='$postId'");
    if(mysqli_num_rows($allPaymentElan) > 0){
        mysqli_query($connect, "DELETE FROM payment WHERE elanID='$postId'");
    }

    // remove deadline
    $allDeadlineElan=mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$postId'");
    if(mysqli_num_rows($allDeadlineElan) > 0){
        mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$postId'");
    }

    // favorites deadline
    $allFavoritesElan=mysqli_query($connect, "SELECT * FROM favorites WHERE elan_id='$postId'");
    if(mysqli_num_rows($allFavoritesElan) > 0){
        mysqli_query($connect, "DELETE FROM favorites WHERE elan_id='$postId'");
    }

    // visitors deadline
    $allVisitorsElan=mysqli_query($connect, "SELECT * FROM visitors WHERE elan_id='$postId'");
    if(mysqli_num_rows($allVisitorsElan) > 0){
        mysqli_query($connect, "DELETE FROM visitors WHERE elan_id='$postId'");
    }

    // remove elanlar
    $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");    
    if($allElan){
        header('Location: ../dashboard');
    }

    mysqli_close($connect);
?>