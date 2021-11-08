<?php
    include("include/header.php"); ?>

<?php
    $vipArray=array();    
    $vipElanArray=array();

    $all_elan_listVIP=mysqli_query($connect, "SELECT *  FROM forward WHERE forward_key='vip' AND forward_status='active' ");
    while($elan_VIP=mysqli_fetch_array($all_elan_listVIP)){
        $elanID=$elan_VIP["elanID"];
        array_push($vipArray,$elanID);
    }

    shuffle($vipArray);

    $newCountVip=array_rand($vipArray, count($vipArray));

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

<section class="mt-3">
    <div class="container">
        <div class="row mb-3">
            <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px">Bütün Elanlar</h5>
        </div>
    </div>
    <div class="container" id="pagination_data"></div>
</section>

<?php
    include("include/footer.php");
    
?>