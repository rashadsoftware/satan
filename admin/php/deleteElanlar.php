<?php
	
	if($_POST["action"]=="delete"){
		
		include("../include/connectDB.php");
		
        $data=array();

        $postId=$_POST["category_id"];
        
        $elan_detail=mysqli_query($connect, "DELETE FROM elan_detail WHERE elan_id='$postId'");
        
        if($elan_detail){
            $elanlarImg_list = mysqli_query($connect, "SELECT * FROM img WHERE elan_id='$postId'");

            while($elanlarImg=mysqli_fetch_array($elanlarImg_list)){
                unlink("../../img/advert/".$elanlarImg["img_path"]);
            }
            
            $elan_img=mysqli_query($connect, "DELETE FROM img WHERE elan_id='$postId'");

            if($elan_img){
                
                $elanlar_list = mysqli_query($connect, "SELECT * FROM elan WHERE elan_id='$postId'");
                $elanlar=mysqli_fetch_array($elanlar_list);
                $customer_id=$elanlar["customer_id"];

                $customerElan=mysqli_query($connect, "DELETE FROM customers WHERE customer_id='$customer_id'");

                if($customerElan){
                    $elanlarVisitors_list = mysqli_query($connect, "SELECT * FROM visitors WHERE elan_id='$postId'");

                    if(mysqli_num_rows($elanlarVisitors_list) > 0){
                        $allVisitorsElan=mysqli_query($connect, "DELETE FROM visitors WHERE elan_id='$postId'");
                        if($allVisitorsElan){
                            $elanlarFavorites_list = mysqli_query($connect, "SELECT * FROM favorites WHERE elan_id='$postId'");
                            if(mysqli_num_rows($elanlarFavorites_list) > 0){
                                $allFavoritesElan=mysqli_query($connect, "DELETE FROM favorites WHERE elan_id='$postId'");
                                if($allFavoritesElan){
                                    $elanlarDeadlines_list = mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$postId'");
                                    if(mysqli_num_rows($elanlarDeadlines_list) > 0){
                                        $allDeadlinesElan=mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$postId'");
    
                                        if($allDeadlinesElan){
                                            $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");
    
                                            if($allElan){
    
                                                $data["ok"]="ok";
                                                $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                        
                                                echo json_encode($data);
                                            } else {
                                                $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                            
                                                echo json_encode($data);
                                            }
                                        } else {
                                            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                                            echo json_encode($data);
                                        }
                                    } else {
                                        $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");
    
                                        if($allElan){
    
                                            $data["ok"]="ok";
                                            $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                    
                                            echo json_encode($data);
                                        } else {
                                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                        
                                            echo json_encode($data);
                                        }
                                    }
                                } else {
                                    $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                                    echo json_encode($data);
                                }
                            } else {
                                $elanlarDeadlines_list = mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$postId'");
                                if(mysqli_num_rows($elanlarDeadlines_list) > 0){
                                    $allDeadlinesElan=mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$postId'");

                                    if($allDeadlinesElan){
                                        $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                        if($allElan){

                                            $data["ok"]="ok";
                                            $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                    
                                            echo json_encode($data);
                                        } else {
                                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                        
                                            echo json_encode($data);
                                        }
                                    } else {
                                        $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                                        echo json_encode($data);
                                    }
                                } else {
                                    $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                    if($allElan){

                                        $data["ok"]="ok";
                                        $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                
                                        echo json_encode($data);
                                    } else {
                                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                                        echo json_encode($data);
                                    }
                                }
                            }
                        } else {
                            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                            echo json_encode($data);
                        }
                    } else {
                        $elanlarFavorites_list = mysqli_query($connect, "SELECT * FROM favorites WHERE elan_id='$postId'");
                        if(mysqli_num_rows($elanlarFavorites_list) > 0){
                            $allFavoritesElan=mysqli_query($connect, "DELETE FROM favorites WHERE elan_id='$postId'");
                            if($allFavoritesElan){
                                $elanlarDeadlines_list = mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$postId'");
                                if(mysqli_num_rows($elanlarDeadlines_list) > 0){
                                    $allDeadlinesElan=mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$postId'");

                                    if($allDeadlinesElan){
                                        $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                        if($allElan){

                                            $data["ok"]="ok";
                                            $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                    
                                            echo json_encode($data);
                                        } else {
                                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                        
                                            echo json_encode($data);
                                        }
                                    } else {
                                        $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                                        echo json_encode($data);
                                    }
                                } else {
                                    $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                    if($allElan){

                                        $data["ok"]="ok";
                                        $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                
                                        echo json_encode($data);
                                    } else {
                                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                                        echo json_encode($data);
                                    }
                                }
                            } else {
                                $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                                echo json_encode($data);
                            }
                        } else {
                            $elanlarDeadlines_list = mysqli_query($connect, "SELECT * FROM deadline WHERE elan_id='$postId'");
                            if(mysqli_num_rows($elanlarDeadlines_list) > 0){
                                $allDeadlinesElan=mysqli_query($connect, "DELETE FROM deadline WHERE elan_id='$postId'");

                                if($allDeadlinesElan){
                                    $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                    if($allElan){

                                        $data["ok"]="ok";
                                        $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                                
                                        echo json_encode($data);
                                    } else {
                                        $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                                        echo json_encode($data);
                                    }
                                } else {
                                    $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
                                    echo json_encode($data);
                                }
                            } else {
                                $allElan=mysqli_query($connect, "DELETE FROM elan WHERE elan_id='$postId'");

                                if($allElan){

                                    $data["ok"]="ok";
                                    $data["text"]="Elan başarılı şəkildə verilənlər bazasından silindi";
                            
                                    echo json_encode($data);
                                } else {
                                    $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                                    echo json_encode($data);
                                }
                            }
                        }
                    }
                } else {
                    $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                    
                    echo json_encode($data);
                }
            } else {
                $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                
                echo json_encode($data);
            }
            
        } else {
            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>