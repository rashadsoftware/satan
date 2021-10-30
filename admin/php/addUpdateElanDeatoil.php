<?php
    if(isset($_POST)){
        include("../include/connectDB.php");

        $data=array();
		
        // get value
        $inputHiddenID=mysqli_real_escape_string($connect, trim($_POST["inputHiddenID"]));

        $subdel = mysqli_query($connect, "DELETE FROM elan_detail WHERE elan_id='$inputHiddenID' ");

        if($subdel){
            $optionsQuery=mysqli_query($connect, "SELECT * FROM elan WHERE elan_id ='$inputHiddenID' ");
            $optionsQuery_fetch=mysqli_fetch_array($optionsQuery);
            $queryCategory=$optionsQuery_fetch['elan_kateqoriya'];

            $arrayForm=[];
            $optionsQuery=mysqli_query($connect, "SELECT * FROM options WHERE subcategory_id ='$queryCategory' ");
            while($options_item15=mysqli_fetch_array($optionsQuery)){
                array_push($arrayForm, $options_item15["options_id"]);
            }

            // formdan gelen dizi
            $optionss15=$_POST["optionsAdd"];
            
            $arrayOptions=[];

            // insert elan_details                                                    
            for($m=0; $m<count($optionss15); $m++){
                $insertElanId=mysqli_query($connect, "INSERT IGNORE INTO elan_detail (elan_id, options_id, elanDetail_value) VALUES ('$inputHiddenID', '$arrayForm[$m]', '$optionss15[$m]')");
                
                if($insertElanId){
                    array_push($arrayOptions, "OK");
                }
            }
            
            if(count($arrayOptions) == count($optionss15)){
                $data["ok"]="ok";           
                $data["text"]="Elan detalları başarılı şəkildə yenilənmişdir";                                     
                echo json_encode($data);
            } else {
                $data["text"]="Yenilənmə zamanı xəta yarandı. Yenidən cəhd edin!";                                            
                echo json_encode($data);
            }
        } else {
            $data["text"]="Silinmə zamanı xəta yarandı. Yenidən cəhd edin!";                                            
            echo json_encode($data);
        }
		
        mysqli_close($connect);
    }
?>