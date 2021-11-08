<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();

		$elanID=mysqli_real_escape_string($connect, trim($_POST["elanID"]));
        
        $query=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id = '$elanID' ");
        
        if(mysqli_num_rows($query) > 0){
            $elan_data=mysqli_fetch_array($query);

            $customerID=$elan_data["customer_id"];

            $customer=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id = '$customerID' ");
            $customer_data=mysqli_fetch_array($customer);

            $data['ok']='ok';
            $data['id']=$elan_data["elan_id"];
            $data['text']='
                <li class="list-group-item">
                    <b>Elan başlığı</b> <a class="float-right">'.$elan_data["elan_name"].'</a>
                </li>
                <li class="list-group-item">
                    <b>Elan sahibi</b> <a class="float-right">'.$customer_data["customer_name"].'</a>
                </li>
                <li class="list-group-item">
                    <b>Email</b> <a class="float-right">'.$customer_data["customer_email"].'</a>
                </li>
                <li class="list-group-item">
                    <b>Əlaqə nömrəsi</b> <a class="float-right">'.$customer_data["customer_phone"].'</a>
                </li>
            ';

            echo json_encode($data);
        } else {
            $data["text"]="Verilənlər bazasında bu id-e uyğun elan yoxdur!";
            
            echo json_encode($data);
        }
		
		mysqli_close($connect);
	}
	
	
?>