<?php
    if(isset($_POST["radioPriceSimple"])){
        include("../connectDB.php");
        session_start();

        $data=array();

        $value_simple=$_POST["radioPriceSimple"];
        $hiddenId=mysqli_real_escape_string($connect, trim($_POST["elanID"]));

        $query=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$hiddenId' AND elan_status = 'active'");
        if(mysqli_num_rows($query) > 0){
            $query_value=mysqli_query($connect, "SELECT *  FROM earnings WHERE earnings_retry='$value_simple' AND earnings_state='simple' ");
            if(mysqli_num_rows($query_value) > 0){
                $data_query=mysqli_fetch_array($query_value);

                $_SESSION["merchant_price"]=$data_query["earnings_price"];
                $_SESSION["merchant_path"]="kart";
                $_SESSION["merchant_status"]="simple";
                $_SESSION["merchant_elan_id"]=$hiddenId;

                $data["ok"]="ok";										
                echo json_encode($data);

            } else {
                $data["text"]="Xəta baş verdi. Yenidən cəhd edin!";									
		        echo json_encode($data);
            }
        } else {
            $data["text"]="Bu id-yə bağlı bir elan yoxdur";									
		    echo json_encode($data);
        }

        mysqli_close($connect);
        
    } else if(isset($_POST["radioPriceVIP"])){
        include("../connectDB.php");
        session_start();

        $data=array();

        $value_vip=$_POST["radioPriceVIP"];
        $hiddenId=mysqli_real_escape_string($connect, trim($_POST["elanID"]));

        $query=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$hiddenId' AND elan_status = 'active'");
        if(mysqli_num_rows($query) > 0){
            $query_value=mysqli_query($connect, "SELECT *  FROM earnings WHERE earnings_time='$value_vip' AND earnings_state='vip' ");
            if(mysqli_num_rows($query_value) > 0){
                $data_query=mysqli_fetch_array($query_value);

                $_SESSION["merchant_price"]=$data_query["earnings_price"];
                $_SESSION["merchant_path"]="kart";
                $_SESSION["merchant_status"]="vip";
                $_SESSION["merchant_elan_id"]=$hiddenId;

                $data["ok"]="ok";										
                echo json_encode($data);
                
            } else {
                $data["text"]="Xəta baş verdi. Yenidən cəhd edin!";									
		        echo json_encode($data);
            }
        } else {
            $data["text"]="Bu id-yə bağlı bir elan yoxdur";									
		    echo json_encode($data);
        }

        mysqli_close($connect);
    } else {
        header("Location: ../../index.php");
    }
?>