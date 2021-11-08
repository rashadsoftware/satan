<?php
    include("include/header.php");
?>

<script>
    $(function(){
        $("#index").addClass("active");
    });
</script>

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
    <section class="mt-3">
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

                        $raiting_list=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                        $raiting=mysqli_fetch_array($raiting_list);

                        addItem($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $raiting['forward_key'], $favorites);
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

<?php
    include("include/footer.php");
?>