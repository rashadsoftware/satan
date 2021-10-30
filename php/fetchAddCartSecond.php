<?php
    if(isset($_POST['idAdd'])){
        include("../include/connectDB.php");

        $data=array();
        
        $subparametres=mysqli_query($connect, "SELECT * FROM parametres WHERE parametres_raiting ='".$_POST['idAdd']."' ");
        $subparametresItem=mysqli_fetch_array($subparametres);

        if($_POST['idAdd'] == 'simple'){
            $data["text"]="Elanınız son elanlar bölməsində və axtarış nəticələrində birinci yerə qalxacaq "; 

            $data["price"]='
            <div class="custom-control custom-radio">
                <input type="radio" id="radioPriceSimple1" name="radioPriceSimple" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceSimple1">8 dəfə (6 saatdan bir) - 1 AZN</label>
            </div>
            <div class="custom-control custom-radio mt-2">
                <input type="radio" id="radioPriceSimple2" name="radioPriceSimple" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceSimple2">20 dəfə (6 saatdan bir) - 2 AZN</label>
            </div>
            <div class="custom-control custom-radio mt-2">
                <input type="radio" id="radioPriceSimple3" name="radioPriceSimple" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceSimple3">40 dəfə (6 saatdan bir) - 3 AZN</label>
            </div>
            '; 
        } else {
            $data["text"]="Elanınız ana səhifədə vip elan bölməsində təsadüfi qaydada göstəriləcək və hər 6 saatdan bir axtarış və son elanlar bölməsində birinci yerə qalxacaq"; 

            $data["price"]='
            <div class="custom-control custom-radio">
                <input type="radio" id="radioPriceVIP1" name="radioPriceVIP" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceVIP1">10 gün - 5 AZN</label>
            </div>
            <div class="custom-control custom-radio mt-2">
                <input type="radio" id="radioPriceVIP2" name="radioPriceVIP" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceVIP2">20 gün - 8 AZN</label>
            </div>
            <div class="custom-control custom-radio mt-2">
                <input type="radio" id="radioPriceVIP3" name="radioPriceVIP" class="custom-control-input">
                <label class="custom-control-label" for="radioPriceVIP3">30 gün - 12 AZN</label>
            </div>
            '; 
        }
             
        $data["title"]=$subparametresItem['parametres_title'];                             
        echo json_encode($data);

        mysqli_close($connect);
    }
?>