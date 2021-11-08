<?php
if(isset($_POST['search'])){
    $search_text=trim($_POST['search']);

    include("include/header.php");

    if($search_text == ""){ ?>

        <?php
            $vipArray=array();    
            $vipElanArray=array();

            $all_elan_listVIP=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='vip' AND forward_status='active' ");
            while($elan_VIP=mysqli_fetch_array($all_elan_listVIP)){
                $elanID=$elan_VIP["elanID"];
                array_push($vipArray,$elanID);
            }

            shuffle($vipArray);

            if(count($vipArray) > 12){
                $newCountVip=array_rand($vipArray, 12);
                // eger eleman sayi 12-den cox olarsa ancaq 12 ededini gosterir
            } else {
                $newCountVip=array_rand($vipArray, count($vipArray));
                // random deyer donderir
            }

            foreach ($newCountVip as $key => $value) {
                $all_elan_VIP=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$vipArray[$value]' AND elan_status='active' ");
                array_push($vipElanArray,mysqli_fetch_array($all_elan_VIP));    
            }

            if($newCountVip > 0){ ?>
            <section class="mt-3">
                <div class="container">
                    <div class="row mb-3">
                        <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">VIP Elanlar</h5>
                    </div>
                    <div class="row">
                        <?php
                            foreach($vipElanArray as $elan_allVIP){ 
                                // city create
                                $cityElanVIP=$elan_allVIP["elan_seher"];
                                $all_city_listVIP=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElanVIP' ");
                                $city_allVIP=mysqli_fetch_array($all_city_listVIP);

                                // create time
                                $timeElanVIP=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_allVIP['elan_time'])));

                                // create img
                                $idElanVIP=$elan_allVIP['elan_id'];
                                $prem_elan_imgVIP=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElanVIP' ");
                                $prem_imgVIP=mysqli_fetch_array($prem_elan_imgVIP);

                                $ipAddressVIP=$_SERVER['REMOTE_ADDR'];
                                $favorites_listVIP=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElanVIP' AND favorites_ip='$ipAddressVIP' ");
                                $favoritesVIP=mysqli_num_rows($favorites_listVIP);

                                $raiting_listVIP=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElanVIP' AND forward_status='active' ");
                                $raitingVIP=mysqli_fetch_array($raiting_listVIP);

                                addItem($prem_imgVIP['img_path'], $elan_allVIP['elan_qiymet'], $elan_allVIP['elan_id'], $elan_allVIP['elan_name'], $city_allVIP["city_title"], $timeElanVIP, $raitingVIP['forward_key'], $favorites);
                            }
                        ?>
                    </div>
                </div>
            </section>
        <?php   }
        ?>

        <?php
            $all_elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='active' ORDER BY elan_time DESC LIMIT 36");
            if(mysqli_num_rows($all_elan_list) > 0){ ?>
            <section class="mt-5">
                <div class="container">
                    <div class="row mb-3">
                        <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Bütün Elanlar</h5>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <?php
                            while($elan_all=mysqli_fetch_array($all_elan_list)){ 
                                $timeElan=$elan_all["elan_time"];

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
                        ?>
                    </div>
                    <div class="row">
                        <a href="elanlar" style="background:var(--main-color); border:1px solid var(--main-color)" class="btn btn-primary py-3 px-4 mx-auto my-3">Hamısını göstər</a>
                    </div>
                </div>
            </section>
        <?php   }
        ?>

<?php } else {
        $all_elan_list=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' AND elan_name LIKE '%$search_text%' ORDER BY elan_time DESC");
        $countSearch=mysqli_num_rows($all_elan_list);

        if($countSearch > 0){  
            $vipArrayText=array();
            $vipArraySearchText=array();
            $vipElanArray=array();

            // vip-deki elanlari alma
            $all_elan_listVIP_text=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='vip' AND forward_status='active' ");
            while($elan_VIP_Text=mysqli_fetch_array($all_elan_listVIP_text)){
                $elanID_Text=$elan_VIP_Text["elanID"];
                array_push($vipArrayText,$elanID_Text);
            }

            // axtarisdaki elemanlari almaq
            while($elan_all=mysqli_fetch_array($all_elan_list)){
                array_push($vipArraySearchText,$elan_all["elan_id"]);
            }

            $result_text=array_intersect($vipArrayText,$vipArraySearchText);
            
            shuffle($result_text);

            if(count($result_text) > 8){
                $newCountVip=array_rand($result_text, 8);
                // eger eleman sayi 8-den cox olarsa ancaq 8 ededini gosterir
            } else {
                $newCountVip=array_rand($result_text, count($result_text));
                // random deyer donderir
            }
        
            foreach ($newCountVip as $key => $value) {
                $all_elan_VIP=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$result_text[$value]' AND elan_status='active' ");
                array_push($vipElanArray,mysqli_fetch_array($all_elan_VIP));    
            } ?>

			<div class="container">
				<div class="row">
				<p class="text-muted mt-5">Sizin sorğunuza uyğun <span><?php echo $countSearch ?></span> elan tapıldı</p>
				</div>
			</div>
			
			<?php
            if($newCountVip > 0){ ?>
                <section class="mt-4">
                    <div class="container">						
                        <div class="row mb-3">
                            <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">VIP Elanlar</h5>
                        </div>
                        <div class="row">
                            <?php
                                foreach($vipElanArray as $elan_all){ 
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

                                    $raiting_listVIP=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                    $raitingVIP=mysqli_fetch_array($raiting_listVIP);

                                    addItem($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $raitingVIP['forward_key'], $favorites);
                                }
                            ?>
                        </div>
                    </div>
                </section>
      <?php }
            ?>
            <?php
                $all_elan_list2=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' AND elan_name LIKE '%$search_text%' ORDER BY elan_time DESC");
            ?>
            <section class="mt-4">
                <div class="container">
                    <div class="row mb-3">
                        <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Bütün Elanlar</h5>
                    </div>
                    <div class="row">
                        <?php
                            while($elan_all2=mysqli_fetch_array($all_elan_list2)){ 
                                // city create
                                $cityElan2=$elan_all2["elan_seher"];
                                $all_city_list2=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan2' ");
                                $city_all2=mysqli_fetch_array($all_city_list2);

                                // create time
                                $timeElan2=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_all2['elan_time'])));

                                // create img
                                $idElan2=$elan_all2['elan_id'];
                                $prem_elan_img2=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan2' ");
                                $prem_img2=mysqli_fetch_array($prem_elan_img2);

                                $ipAddress2=$_SERVER['REMOTE_ADDR'];
                                $favorites_list2=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan2' AND favorites_ip='$ipAddress2' ");
                                $favorites2=mysqli_num_rows($favorites_list2);

                                $raiting_listVIP2=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan2' AND forward_status='active' ");
                                $raitingVIP2=mysqli_fetch_array($raiting_listVIP2);

                                addItem($prem_img2['img_path'], $elan_all2['elan_qiymet'], $elan_all2['elan_id'], $elan_all2['elan_name'], $city_all2["city_title"], $timeElan2, $raitingVIP2['forward_key'], $favorites2);
                            }
                        ?>
                    </div>
                </div>
            </section>
<?php   } else { 
            $all_elan_listID=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' AND elan_id LIKE '%$search_text%' ORDER BY elan_time DESC");
            $countSearch=mysqli_num_rows($all_elan_listID);
            if($countSearch > 0){ 

                $vipArrayText=array();
                $vipArraySearchText=array();
                $vipElanArray=array();

                // vip-deki elanlari alma
                $all_elan_listVIP_text=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='vip' AND forward_status='active' ");
                while($elan_VIP_Text=mysqli_fetch_array($all_elan_listVIP_text)){
                    $elanID_Text=$elan_VIP_Text["elanID"];
                    array_push($vipArrayText,$elanID_Text);
                }

                // axtarisdaki elemanlari almaq
                while($elan_all=mysqli_fetch_array($all_elan_listID)){
                    array_push($vipArraySearchText,$elan_all["elan_id"]);
                }

                $result_text=array_intersect($vipArrayText,$vipArraySearchText);
                
                shuffle($result_text);

                if(count($result_text) > 8){
                    $newCountVip=array_rand($result_text, 8);
                    // eger eleman sayi 8-den cox olarsa ancaq 8 ededini gosterir
                } else {
                    $newCountVip=array_rand($result_text, count($result_text));
                    // random deyer donderir
                }
            
                foreach ($newCountVip as $key => $value) {
                    $all_elan_VIP=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$result_text[$value]' AND elan_status='active' ");
                    array_push($vipElanArray,mysqli_fetch_array($all_elan_VIP));    
                }
                ?>

                <div class="container">
                    <div class="row">
                        <p class="text-muted mt-5">Sizin sorğunuza uyğun <span><?php echo $countSearch ?></span> elan tapıldı</p>
                    </div>
                </div>

                <?php
                if($newCountVip > 0){ ?>
                    <section class="mt-4">
                        <div class="container">						
                            <div class="row mb-3">
                                <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">VIP Elanlar</h5>
                            </div>
                            <div class="row">
                                <?php
                                    foreach($vipElanArray as $elan_all){ 
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

                                        $raiting_listVIP=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                        $raitingVIP=mysqli_fetch_array($raiting_listVIP);

                                        addItem($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $raitingVIP['forward_key'], $favorites);
                                    }
                                ?>
                            </div>
                        </div>
                    </section>
                <?php } ?>

                <?php
                    $all_elan_listID2=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' AND elan_id LIKE '%$search_text%' ORDER BY elan_time DESC");
                ?>
                <section class="mt-4">
                    <div class="container">
                        <div class="row mb-3">
                            <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Bütün Elanlar</h5>
                        </div>
                        <div class="row">
                            <?php
                                while($elan_all2=mysqli_fetch_array($all_elan_listID2)){ 
                                    // city create
                                    $cityElan2=$elan_all2["elan_seher"];
                                    $all_city_list2=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan2' ");
                                    $city_all2=mysqli_fetch_array($all_city_list2);
    
                                    // create time
                                    $timeElan2=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_all2['elan_time'])));
    
                                    // create img
                                    $idElan2=$elan_all2['elan_id'];
                                    $prem_elan_img2=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan2' ");
                                    $prem_img2=mysqli_fetch_array($prem_elan_img2);
    
                                    $ipAddress2=$_SERVER['REMOTE_ADDR'];
                                    $favorites_list2=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan2' AND favorites_ip='$ipAddress2' ");
                                    $favorites2=mysqli_num_rows($favorites_list2);
    
                                    $raiting_listVIP5=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan2' AND forward_status='active' ");
                                    $raitingVIP5=mysqli_fetch_array($raiting_listVIP5);
    
                                    addItem($prem_img2['img_path'], $elan_all2['elan_qiymet'], $elan_all2['elan_id'], $elan_all2['elan_name'], $city_all2["city_title"], $timeElan2, $raitingVIP5['forward_key'], $favorites2);
                                }
                            ?>
                        </div>
                    </div>
                </section>
<?php       } else { ?>
                <section class="mt-4">
                    <div class="container">
                        <hr>
                        <div class="row mt-4">
                            <div style="height:50vh; padding:0 15px" class="w-100">
                                <p class="text-danger">Sizin sorğunuza uyğun heçnə tapılmadı</p>
                            </div>
                        </div>
                    </div>
                </section>
    <?php   }
        }
    }

    include("include/footer.php");
}
?>