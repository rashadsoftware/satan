<?php
	if(isset($_POST)){

		include("../include/connectDB.php");
		include("../include/function.php");

		$data=array();
		$inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

		$inputCustomersName=mysqli_real_escape_string($connect, trim($_POST["inputCustomersName"]));
		$inputCustomersEmailAddress=mysqli_real_escape_string($connect, trim($_POST["inputCustomersEmailAddress"]));
        $inputCustomersPhone=mysqli_real_escape_string($connect, trim($_POST["inputCustomersPhone"]));
        
        $controlInputCustomersName=controlTitle($inputCustomersName, "İstifadəçinin adı", 1);
		if($controlInputCustomersName==true){
			$controlInputCustomersEmailAddress=controlEmail($inputCustomersEmailAddress, "Email");
			if($controlInputCustomersEmailAddress==true){
                $controlInputCustomersPhone=controlPhone($inputCustomersPhone, "Əlaqə telefonu", 10);
                if($controlInputCustomersPhone==true){
                    $query=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id = '$inputHiddenID' ");
                    if(mysqli_num_rows($query) > 0){
                        $updateCustomer=mysqli_query($connect,"UPDATE customers SET customer_name='$inputCustomersName', customer_email='$inputCustomersEmailAddress', customer_phone='$inputCustomersPhone' WHERE customer_id = '$inputHiddenID'");

                        if($updateCustomer){

                            $data["ok"]="ok";
                            $data["text"]="İstifadəçi başarılı şəkildə yeniləndi.";
                    
                            echo json_encode($data);
                        } else {
                            $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
                        
                            echo json_encode($data);
                        }
                    } else {
                        $data["text"]="Verilənlər bazasında bu istifadəçi elan yoxdur!";
                        
                        echo json_encode($data);
                    }
                }
			}
        }
		
		mysqli_close($connect);
	}
	
	
?>