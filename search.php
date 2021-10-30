<?php
if(isset($_POST['search'])){
    $search_text=$_POST['search'];

    include("include/header.php");

    if($search_text == ""){ ?>

        <?php
            $all_elan_listVIP=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_raiting='vip' AND elan_status='active' ORDER BY elan_time DESC");
            if(mysqli_num_rows($all_elan_listVIP) > 0){ ?>
            <section class="mt-3">
                <div class="container">
                    <div class="row mb-3">
                        <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">VIP Elanlar</h5>
                    </div>
                    <div class="row">
                        <?php
                            while($elan_allVIP=mysqli_fetch_array($all_elan_listVIP)){ 
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

                                addItem($prem_imgVIP['img_path'], $elan_allVIP['elan_qiymet'], $elan_allVIP['elan_id'], $elan_allVIP['elan_name'], $city_allVIP["city_title"], $timeElanVIP, $elan_allVIP['elan_raiting'], $favorites);
                            }
                        ?>
                    </div>
                </div>
            </section>
        <?php   }
        ?>

        <?php
            $prem_elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_raiting='premium' AND elan_status='active' ORDER BY elan_time DESC ");
            if(mysqli_num_rows($prem_elan_list) > 0){ ?>
            <section class="mt-5">
                <div class="container">
                    <div class="row mb-3">
                        <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Premium Elanlar</h5>
                    </div>
                    <div class="row">
                        <?php
                            while($elan_premium=mysqli_fetch_array($prem_elan_list)){ 
                                // city create
                                $cityElanPremium=$elan_premium["elan_seher"];
                                $all_city_listPremium=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElanPremium' ");
                                $city_allPremium=mysqli_fetch_array($all_city_listPremium);

                                // create time
                                $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_premium['elan_time'])));

                                // create img
                                $idElanPremium=$elan_premium['elan_id'];
                                $prem_elan_imgPremium=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElanPremium' ");
                                $prem_imgPremium=mysqli_fetch_array($prem_elan_imgPremium);

                                $ipAddressPremium=$_SERVER['REMOTE_ADDR'];
                                $favorites_listPremium=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElanPremium' AND favorites_ip='$ipAddressPremium' ");
                                $favoritesPremium=mysqli_num_rows($favorites_listPremium);

                                addItem($prem_imgPremium['img_path'], $elan_premium['elan_qiymet'], $elan_premium['elan_id'], $elan_premium['elan_name'], $city_allPremium["city_title"], $timeElan, $elan_premium['elan_raiting'], $favoritesPremium);
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
        if(mysqli_num_rows($all_elan_list) > 0){ ?>
            <section class="mt-5">
                <div class="container">
                    <?php $countSearch=mysqli_num_rows($all_elan_list); ?>
                    <p class="text-muted mt-4 mb-5">Sizin sorğunuza uyğun <span><?php echo $countSearch ?></span> elan tapıldı</p>
                    <div class="row">
                        <?php
                            while($elan_all=mysqli_fetch_array($all_elan_list)){ 
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
                </div>
            </section>
<?php   } else { 
            $all_elan_listID=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' AND elan_id LIKE '%$search_text%' ORDER BY elan_time DESC");
            if(mysqli_num_rows($all_elan_listID) > 0){ ?>
                <section class="mt-5">
                    <div class="container">
                        <?php $countSearch=mysqli_num_rows($all_elan_listID); ?>
                        <p class="text-muted mt-4 mb-5">Sizin sorğunuza uyğun <span><?php echo $countSearch ?></span> elan tapıldı</p>
                        <div class="row">
                            <?php
                                while($elan_all=mysqli_fetch_array($all_elan_listID)){ 
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
                    </div>
                </section>
<?php       } else { ?>
                <section class="mt-5">
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