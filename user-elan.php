<?php
    include("include/headerExtra.php");

    $IDCustomer=$_GET["id"];

    $arrayCustomerID=[];
    $arrayElan=[];

    $customer_list=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_id='$IDCustomer' ");
    $customer_data=mysqli_fetch_array($customer_list);
    $customer_email=$customer_data['customer_email'];

    $customer_list_top=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_email='$customer_email' "); ?>

    <section class="mt-3">
        <div class="container">
            <div class="row mb-3">
                <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px"><?php echo $customer_data['customer_name'] ?></h5>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <ul class="filters text-center">
                        <li class="active" data-filter="*"><a href="#">Hamısı</a></li>
                        <?php  
                            while($customer_data_top_ust=mysqli_fetch_array($customer_list_top)){
                                $customer_item_ust=$customer_data_top_ust['customer_id'];

                                $elan_customer_list_top=mysqli_query($connect, "SELECT *  FROM elan WHERE customer_id='$customer_item_ust' ");
                                $fetch_data_top_ust=mysqli_fetch_array($elan_customer_list_top);

                                array_push($arrayCustomerID, $fetch_data_top_ust['elan_kateqoriya']);
                            }

                            // dizide tekrarlanan deyerleri silir
                            $newArrayCustomerID=array_unique($arrayCustomerID);

                            // array_unique zamani sira ardicilligi dagilir. Bu funksiya yeni bir ardicilliq yaradir
                            $valueCatString=array_values($newArrayCustomerID);

                            for($m=0; $m < count($valueCatString); $m++){ 
                                $subcategory_list_top=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_id='$valueCatString[$m]' "); 
                                $fetch_subcategory_data_top_ust=mysqli_fetch_array($subcategory_list_top); ?>
                                <li data-filter=".cat<?php echo $fetch_subcategory_data_top_ust['subcategory_id']; ?>"><a href="#"><?php echo $fetch_subcategory_data_top_ust['subcategory_title']; ?></a></li>
                        <?php  }    
                        ?>
                    </ul>
                </div>
            </div>
            <div class="projects">
                <div class="row">
                    <?php
                        $customer_list_top_second=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_email='$customer_email' ");
                        while($customer_data_top=mysqli_fetch_array($customer_list_top_second)){
                            $customer_item=$customer_data_top['customer_id'];

                            $all_elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='active' AND customer_id='$customer_item' ORDER BY elan_time DESC "); 

                            while($elan_all=mysqli_fetch_array($all_elan_list)){
                                array_push($arrayElan, $elan_all['elan_time']);
                            }
                        }

                        function compareDates($date1, $date2){
                            return strtotime($date2) - strtotime($date1) ;
                        }
                        usort($arrayElan, "compareDates");
                        
                        for($g=0; $g < count($arrayElan); $g++){
                            $all_elan_list2=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='active' AND elan_time='$arrayElan[$g]' ");
                            $elan_all2=mysqli_fetch_array($all_elan_list2); 
                            
                            // city create
                            $cityElan=$elan_all2["elan_seher"];
                            $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                            $city_all=mysqli_fetch_array($all_city_list);
    
                            // create time
                            $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_all2['elan_time'])));
    
                            // create img
                            $idElan=$elan_all2['elan_id'];
                            $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                            $prem_img=mysqli_fetch_array($prem_elan_img);

                            $ipAddressPremium=$_SERVER['REMOTE_ADDR'];
                            $favorites_listPremium=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElanPremium' AND favorites_ip='$ipAddressPremium' ");
                            $favoritesPremium=mysqli_num_rows($favorites_listPremium);
                            
                            ?>

                            <div class="col-6 col-lg-4 col-xl-3 item cat<?php echo $elan_all2["elan_kateqoriya"]; ?>">
                                <div class="item-container">
                                    <div class="item-image">
                                        <a target="_blank" href="../preview/<?php echo $elan_all2['elan_name']; ?>-<?php echo $elan_all2['elan_id']; ?>"><img src="../img/advert/<?php  echo $prem_img['img_path']; ?>"/></a>
                                        <?php
                                        if($elan_all2['elan_qiymet'] != ""){
                                            echo '<span class="price">'.$elan_all2['elan_qiymet'].' AZN</span>';
                                        }
                                        ?>
                                        <ul class="item-status">
                                        <?php
                                            if($elan_all2['elan_raiting'] == "premium"){ ?>
                                            <li><i class="far fa-gem"></i></li>
                                        <?php   }
                                            if($elan_all2['elan_raiting'] == "vip"){ ?>
                                                <li><i class="fas fa-crown"></i></li>;
                                        <?php   }
                                        ?>
                                        </ul>
                                        <span class="item-love">
                                            <?php
                                            if($favoritesPremium > 0){
                                                echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$elan_all2['elan_id'].'">';
                                            } else {
                                                echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$elan_all2['elan_id'].'">';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <div class="item-content">
                                        <h2>
                                            <a href="../preview/<?php echo $elan_all2['elan_name']; ?>-<?php echo $elan_all2['elan_id']; ?>" target="_blank"><?php echo substr($elan_all2['elan_name'], 0, 28); ?>...</a>
                                        </h2> 
                                        <?php
                                        if($city_all["city_title"] == ""){
                                            echo'   <p>'.$timeElan.'</p>';
                                        } else {
                                            echo'   <p>'.$city_all["city_title"].', '.$timeElan.'</p>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php   }
                    ?>
                </div>
            </div>
        </div>
    </section>
<?php
    include("include/footerExtra.php");
    
?>