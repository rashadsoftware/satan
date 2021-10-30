<?php
if($_GET["action"]=="confirm"){
    include("include/header.php");

    $IDElan=$_GET["id"];

    // fetch ID
    $selectId=mysqli_query($connect,"SELECT * FROM elan WHERE elan_id='$IDElan'");
	$fetchArray=mysqli_fetch_array($selectId);

    // fetch customer
    $customerID=$fetchArray["customer_id"];
    $selectIdCustomer=mysqli_query($connect,"SELECT * FROM customers WHERE customer_id='$customerID'");
	$fetchArrayCustomer=mysqli_fetch_array($selectIdCustomer);

    // fetch image
    $selectIdImg=mysqli_query($connect,"SELECT * FROM img WHERE elan_id='$IDElan'");
	$fetchArrayImg=mysqli_fetch_array($selectIdImg);
?>
<section class="header-margin">
    <div class="container">
        <div class="row">
            <div class="w-100 text-center">
                <h1 class="text-success font-weight-bold">Təşəkkür edirik bizi seçdiyiniz üçün!</h1>
                <h5>Son 24 saat ərzində elanınıza baxılacaq və elan saytın qaydalarına uyğun olduğu halda moderator tərəfindən dərhal dərc ediləcəkdir.</h5>
            </div>
        </div>
        <h3 style="margin-top:60px !important; margin-bottom:1.7rem"><?php echo $fetchArray["elan_name"] ?></h3>
        <div class="row">
            <div class="col-12 col-lg-6 order-2 order-lg-1 mt-2 mt-lg-0">
                <div class="box-container">
                    <h5 class="box-title-h5 text-capitalize">İstifadəçi məlumatları</h5>
                    <p class="mb-0"><?php echo $fetchArrayCustomer["customer_name"] ?> <span>(<?php if($fetchArray["elan_veren"]== "own" ){ echo "Şəxsi"; }else{ echo "Şirkət"; } ?>)</span></p>
                    <p class="mob"><?php echo $fetchArrayCustomer["customer_phone"] ?></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 order-1 order-lg-2">
                <div class="box-container float-left float-lg-right mt-0 mt-lg-2" style="background:transparent; box-shadow:none">
                    <p class="mb-0 text-left text-lg-right">Elanın nömrəsi: <span>#<?php echo $fetchArray["elan_id"] ?></span></p>
                    <p class="mb-0 text-left text-lg-right">Baxış sayı: <span>0</span></p>
                    <?php $elanTime=date('Y-m-d H:i:s'); ?>
                    <p class="mb-0 text-left text-lg-right">Tərtib edildi: <span><?php echo str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elanTime))) ?></span></p>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="box-container">
                    <h5 class="box-title-h5">Elanın Detayları</h5>
                    <div class="row" style="margin: 1.5rem 0px;">
                        <div class="col-12 col-lg-6 order-2 order-lg-1 mt-5 mt-lg-0">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="font-weight-bold">Kateqoriya</td>
                                    <?php
                                        $catId=$fetchArray['elan_kateqoriya'];
                                        $selectSubCategory=mysqli_query($connect,"SELECT * FROM subcategories WHERE subcategory_id='$catId'");
                                        $fetchArraySubCategory=mysqli_fetch_array($selectSubCategory);
                                    ?>
                                    <td><?php echo $fetchArraySubCategory["subcategory_title"] ?></td>
                                </tr>
                                <?php
                                    if($catId != 34){ ?>
                                        <tr>
                                            <td class="font-weight-bold">Şəhər</td>
                                            <?php
                                                $cityId=$fetchArray['elan_seher'];
                                                $selectCity=mysqli_query($connect,"SELECT * FROM cities WHERE city_id='$cityId'");
                                                $fetchArrayCity=mysqli_fetch_array($selectCity);
                                            ?>
                                            <td><?php echo $fetchArrayCity["city_title"] ?></td>
                                        </tr>
                                    <?php   }
                                    ?>
                                <?php
                                    $selectElan_Detail=mysqli_query($connect,"SELECT * FROM elan_detail WHERE elan_id='$IDElan'");
                                    while($fetchArrayElan_Detail=mysqli_fetch_array($selectElan_Detail)){
                                        $idOptions=$fetchArrayElan_Detail["options_id"];
                                        $selectOptions=mysqli_query($connect,"SELECT * FROM options WHERE options_id='$idOptions'");
                                        $fetchArrayOptions=mysqli_fetch_array($selectOptions); ?>

                                <tr>
                                    <td class="font-weight-bold"><?php echo $fetchArrayOptions["options_title"] ?></td>
                                    <?php
                                        if($fetchArrayOptions["options_type"] =="select"){
                                            $idelanDetail_value=$fetchArrayElan_Detail["elanDetail_value"];
                                            $selectSuboptions=mysqli_query($connect,"SELECT * FROM suboptions WHERE suboptions_id='$idelanDetail_value'");
                                            $fetchArraySubOptions=mysqli_fetch_array($selectSuboptions); ?>
                                            <td><?php echo $fetchArraySubOptions["suboptions_title"] ?></td>
                                    <?php   } else { ?>
                                            <td><?php echo $fetchArrayElan_Detail["elanDetail_value"] ?></td>
                                    <?php    }
                                    ?>
                                </tr>

                                <?php    }
                                ?>    
                                <?php
                                    if($fetchArray["elan_qiymet"] != ""){ ?>
                                        <tr>
                                            <td class="font-weight-bold">Qiymət</td>
                                            <td><?php echo $fetchArray["elan_qiymet"] ?> AZN</td>
                                        </tr>
                                <?php   }
                                ?>   
                            </table>
                            <p class="mt-2"><?php echo $fetchArray["elan_mezmun"] ?></p>
                        </div>
                        
                        <?php
                            if(mysqli_num_rows($selectIdImg) > 1){ ?>
                            <div class="col-12 col-lg-6 order-1 order-lg-2 mt-4 mt-lg-0">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php
                                            while($fetchArrayImg2=mysqli_fetch_array($selectIdImg)){ ?>
                                                <div class="swiper-slide">
                                                    <?php $imgPath2=$fetchArrayImg2["img_path"]; ?>
                                                    <img src="img/advert/<?php echo $imgPath2; ?>" alt="" class="center_watermark_all">
                                                </div>
                                        <?php    }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php    } else if(mysqli_num_rows($selectIdImg) == 1){ ?>
                            <div class="col-12 col-lg-6 order-1 order-lg-2 mt-4 mt-lg-0">
                                <div class="w-100 d-block">
                                    <?php $imgPath=$fetchArrayImg["img_path"]; ?>
                                    <img src="img/advert/<?php echo $imgPath; ?>" alt="" class="w-100 center_watermark">
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-12 col-lg-6 order-1 order-lg-2 mt-4 mt-lg-0">
                                <div class="w-100 d-block">
                                    <img src="img/icons/empty_img.png" class="w-100">
                                </div>
                            </div>
                        <?php }
                        ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6"></div>
        </div>
    </div>
</section>

<?php
include("include/footer.php");
}
?>