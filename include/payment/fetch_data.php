<?php
    if(isset($_POST["radioPriceSimple"])){
        $data=array();

        $value_simple=$_POST["radioPriceSimple"];

        if($value_simple == 8){
            $price="1";
        } else if($value_simple == 20){
            $price="2";
        } else {
            $price="3";
        }

        $data["ok"]="ok";		
        $data["price"]=$price;	
        $data["day"]=$value_simple;									
		echo json_encode($data);
        
    } else if(isset($_POST["radioPriceVIP"])){
        $data=array();

        $value_vip=$_POST["radioPriceVIP"];

        if($value_vip == 10){
            $price="5";
        } else if($value_vip == 20){
            $price="8";
        } else {
            $price="12";
        }
        
        $data["ok"]="ok";
        $data["price"]=$price;	
        $data["day"]=$value_vip;								
		echo json_encode($data);
    }
?>