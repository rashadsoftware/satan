<?php
    include("include/header.php");

    $arrayElan=[];

    $ipAddress=$_SERVER['REMOTE_ADDR'];
    $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE favorites_ip='$ipAddress' ");
    while($favorites=mysqli_fetch_array($favorites_list)){
        array_push($arrayElan, $favorites['elan_id']);
    }    
?>

<section class="mt-3">
    <div class="container">
        <div class="row mb-3">
            <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Seçilənlər (<?php echo count($arrayElan); ?>)</h5>
        </div>
        <div class="row">
            <?php
                if(count($arrayElan) > 0){
                    for($m=0; $m<count($arrayElan);$m++){
                        $all_city_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$arrayElan[$m]' AND elan_status='active' ");
                
                        while($elan_all=mysqli_fetch_array($all_city_list)){ 
                            // city create
                            $cityElan=$elan_all["elan_seher"];
                            $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                            $city_all=mysqli_fetch_array($all_city_list);
                
                            // create time
                            $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_all['elan_time'])));
                
                            // create img
                            $idElan=$elan_all['elan_id'];
                            $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                            $prem_img=mysqli_fetch_array($prem_elan_img);
                
                            $ipAddress=$_SERVER['REMOTE_ADDR'];
                            $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                            $favorites=mysqli_num_rows($favorites_list);
                
                            addItem($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $elan_all['elan_raiting'], $favorites);
                        }
                    }
                } else {
                    echo '<div style="height:50vh" class="w-100">
                    <p class="text-danger">Sizin sorğunuza uyğun heçnə tapılmadı</p>
                </div> ';
                }
            ?>
        </div>
    </div>
</section>    
<?php
    include("include/footer.php");    
?>