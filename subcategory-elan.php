<?php
    include("include/headerExtra.php");

    $IDSubCategorySEF=$_GET["id"];

    $arraySubCategory=[];

    $subcatgory_list=mysqli_query($connect, "SELECT *  FROM subcategories WHERE subcategory_seflink='$IDSubCategorySEF' "); 
    $subcatgory_all=mysqli_fetch_array($subcatgory_list);
    $IDSubCategory=$subcatgory_all["subcategory_id"];

    $elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_kateqoriya='$IDSubCategory' "); ?>

<section class="mt-3">
    <div class="container">
        <div class="row mb-3">
            <h5 class="card-title text-uppercase position-relative rulers" style="margin-left:7px"><?php echo $subcatgory_all['subcategory_title'] ?></h5>
        </div>
        <div class="row">
            <?php
                while($elan_allNew=mysqli_fetch_array($elan_list)){ 
                    array_push($arraySubCategory, $elan_allNew['elan_time']); 
                }

                function compareDates($date1, $date2){
                    return strtotime($date2) - strtotime($date1) ;
                }
                usort($arraySubCategory, "compareDates");

                for($g=0; $g < count($arraySubCategory); $g++){
                    $all_elan_list2=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_status='active' AND elan_time='$arraySubCategory[$g]' ");
                    $elan_all=mysqli_fetch_array($all_elan_list2); 

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

                    addItemExtra($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $elan_all['elan_raiting'], $favorites);
                }
            ?>
        </div>
    </div>
</section>    
<?php
    include("include/footerExtra.php");
?>