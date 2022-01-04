<?php
if($_GET["action"]=="preview"){
    include("include/headerExtra.php");

    $uri=$_SERVER['REQUEST_URI']; // get http uri
    $explodeUri=end(explode("/", $uri));  // convert from string to array

    $newExplode=strstr($explodeUri, "width=174?");
    $newExplode2=strstr($explodeUri, "?fbclid=");

    if($newExplode){
        $newExplodeNew=strstr($explodeUri, "width=174?", true);
        $IDElan=end(explode("-", $newExplodeNew));
    } else if($newExplode2){
        $newExplodeNew=strstr($explodeUri, "?fbclid=", true);
        $IDElan=end(explode("-", $newExplodeNew));
    } else {
        $IDElan=end(explode("-", $explodeUri));
    }    

    $selectId=mysqli_query($connect,"SELECT * FROM elan WHERE elan_id='$IDElan'");
	$fetchArray=mysqli_fetch_array($selectId);  
    
    // visitors system
    $visitor_ip=$_SERVER["REMOTE_ADDR"];
    $selectIPVisitor=mysqli_query($connect,"SELECT * FROM visitors WHERE visitor_ip='$visitor_ip' AND elan_id='$IDElan' ");

    if(mysqli_num_rows($selectIPVisitor) < 1){
        mysqli_query($connect, "INSERT IGNORE INTO visitors (visitor_ip, elan_id) VALUES ('$visitor_ip', '$IDElan')");
    }

    // fetch image
    $selectIdImg=mysqli_query($connect,"SELECT * FROM img WHERE elan_id='$IDElan'");

    // fetch customer
    $customerID=$fetchArray["customer_id"];
    $selectIdCustomer=mysqli_query($connect,"SELECT * FROM customers WHERE customer_id='$customerID'");
	$fetchArrayCustomer=mysqli_fetch_array($selectIdCustomer);

    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<script>
    $(function(){
        $("#head-section").remove();
        $("header").css("top", "0");
        $(".breadcrumb").css("padding-top", "100px");
        $(document).prop('title', 'satan.az | <?php echo $explodeUri ?>');
    })
</script>

<style>
    .btn-success:focus{
        border:1px solid transparent !important
    }
</style>
<section style="margin:100px 0 50px 0">
    <div class="container" style="padding-right:2.6rem; padding-left:2rem">
        <div class="row mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="background:transparent">
                    <li class="breadcrumb-item"><a href="../index" class="text-capitalize"><i class="fas fa-home"></i></a></li>
                    <?php
                        $subcategoriesItem2=$fetchArray['elan_kateqoriya'];
                        $selectSubcategoriesItem2=mysqli_query($connect,"SELECT * FROM subcategories WHERE subcategory_id='$subcategoriesItem2' ");
                        $fetchSubcategoriesItem2=mysqli_fetch_array($selectSubcategoriesItem2);
                        $categoriesItem2=$fetchSubcategoriesItem2['category_id'];
                        $selectCategoriesItem2=mysqli_query($connect,"SELECT * FROM categories WHERE category_id='$categoriesItem2' ");
                        $fetchCategoriesItem2=mysqli_fetch_array($selectCategoriesItem2);
                    ?>
                    <li class="breadcrumb-item"><a href="../category/<?php echo $fetchCategoriesItem2['category_seflink'] ?>" class="text-capitalize"> <?php echo $fetchCategoriesItem2['category_title'] ?></a></li>
                    <?php
                        $subcategoriesItem=$fetchArray['elan_kateqoriya'];
                        $selectSubcategoriesItem=mysqli_query($connect,"SELECT * FROM subcategories WHERE subcategory_id='$subcategoriesItem' ");
                        $fetchSubcategoriesItem=mysqli_fetch_array($selectSubcategoriesItem);
                    ?>
                    <li class="breadcrumb-item"><a href="../subcatgory/<?php echo $fetchSubcategoriesItem['subcategory_seflink'] ?>" class="text-capitalize"><?php echo $fetchSubcategoriesItem['subcategory_title'] ?></a></li>
                    <li class="breadcrumb-item active text-capitalize" aria-current="page"><?php echo $fetchArray['elan_name'] ?></li>
                </ol>
            </nav>
        </div>
        <div class="row pageTitle">
            <div class="col-12 col-md-8 col-lg-9">
                <h1><?php echo $fetchArray["elan_name"] ?></h1>
            </div>
            <div class="col-12 col-md-4 col-lg-3 position-relative">
                <div class="count-adddetail">
                    <p class="mb-0">Elanın kodu: #<span><?php echo $fetchArray["elan_id"] ?></span></p>
                    <?php
                        $countVisitors=mysqli_query($connect,"SELECT * FROM visitors WHERE elan_id='$IDElan'");
                        $visitor=mysqli_num_rows($countVisitors);
                    ?>
                    <p class="mb-0">Baxış sayı: <span><?php echo $visitor; ?></span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="photo-container">
                <?php  $itemImgElan2=mysqli_fetch_array($selectIdImg);
                if(mysqli_num_rows($selectIdImg) > 1){ ?>
                    <div class="large-photo">
                        <a class="w-100 h-100" data-width="500" data-height="500" data-fancybox="gallery" href="../img/advert/<?php echo $itemImgElan2['img_path'] ?>">
                            <img style="object-fit: cover;" src="../img/advert/<?php echo $itemImgElan2['img_path'] ?>" alt="<?php echo $fetchArray["elan_name"] ?>" class="w-100 h-100 center_watermark">
                        </a>
                    </div>
                    <div class="thumbnails">
                        <ul id="bigthumb">
                            <?php
                                while($itemImgElan=mysqli_fetch_array($selectIdImg)){ ?>
                                    <li><a  data-width="500" data-height="500" data-fancybox="gallery" href="../img/advert/<?php echo $itemImgElan['img_path'] ?>">
                                        <img style="object-fit: cover;" src="../img/advert/<?php echo $itemImgElan['img_path'] ?>" alt="<?php echo $fetchArray["elan_name"] ?>" class="center_watermark">
                                    </a></li>
                            <?php    }
                            ?>
                        </ul>
                    </div>
                <?php }else { ?>
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                        <img src="../img/advert/<?php echo $itemImgElan2['img_path'] ?>" alt="<?php echo $fetchArray["elan_name"] ?>" class="h-75 center_watermark_once" >
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row price-container">
            <?php $catId2=$fetchArray['elan_kateqoriya']; 
                if($fetchArray["elan_qiymet"] != ""){ ?>
                    <div class="price">                    
                        <p><?php echo str_replace(",", " ", number_format($fetchArray["elan_qiymet"])) ?> AZN</p>
                    </div>
            <?php    }
                ?>
            
            <div class="services">
                <?php
                    $elanForward=mysqli_query($connect,"SELECT * FROM forward WHERE elanID='$IDElan' AND forward_key='forward' ");
                    if(mysqli_num_rows($elanForward) > 0){ ?>
                        <div class="services-item-active">
                            Elanı irəli çək
                            <span>aktivdir</span>
                        </div>
                <?php } else { ?>
                    <button id="simple" class="services-item view-data">Elanı irəli çək</button>
                <?php  }
                ?>

                <?php
                    $elanVIP=mysqli_query($connect,"SELECT * FROM forward WHERE elanID='$IDElan' AND forward_key='vip' ");
                    if(mysqli_num_rows($elanVIP) > 0){ ?>
                        <div class="services-item-active">
                            Elanı VIP et
                            <span>aktivdir</span>
                        </div>
                <?php } else { ?>
                    <button id="vip" class="services-item view-data">Elanı VIP et</button>
                <?php  }
                ?> 
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="person-container">
                    <div class="person-content">
                        <h5><?php echo $fetchArrayCustomer["customer_name"] ?> <span>(<?php if($fetchArray["elan_veren"]== "own" ){ echo "Şəxsi"; }else{ echo "Şirkət"; } ?>)</span></h5>								
                        <p>
                            <?php 
                                $fetchPhone=$fetchArrayCustomer["customer_phone"]; 
                                $prefix = substr($fetchPhone, 1, 2);
                                $suffix3 = substr($fetchPhone, 3, 3);
                                $suffix2 = substr($fetchPhone, 6, 2);
                                $suffix = substr($fetchPhone, 8, 2);
                            
                                echo "(0{$prefix}) {$suffix3}-{$suffix2}-{$suffix}"; 
                            ?>
                        </p>
                        <?php
                            $customer_email=$fetchArrayCustomer["customer_email"];
                            $customer_email_list=mysqli_query($connect,"SELECT * FROM customers WHERE customer_email='$customer_email'");

                            if(mysqli_num_rows($customer_email_list) > 1){ ?>
                                <p class="all-adds"><a href="../user/<?php echo $fetchArrayCustomer["customer_id"] ?>">İstifadəçinin bütün elanları</a></p>
                        <?php  }
                        ?>								
                        
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9 mt-3 mt-md-0">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="table-parametres">
                            <table class="parameters">
                                <tbody>
                                    <tr>
                                        <td class="table-title">Kateqoriya</td>
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
                                                <td class="table-title">Şəhər</td>
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
                                        <td class="table-title"><?php echo $fetchArrayOptions["options_title"] ?></td>
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
                                                <td class="table-title">Qiymət</td>
                                                <td><?php echo $fetchArray["elan_qiymet"] ?> AZN</td>
                                            </tr>
                                    <?php   }
                                    ?>
                                    										
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                        <p class="mt-2 pl-2"><?php echo $fetchArray["elan_mezmun"] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo $actual_link ?>width=174&layout=button_count&action=like&size=large&share=true&height=46&appId" width="174" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div>
        <hr class="mt-1">
    </div>
</section>

<?php
    $prem_elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_raiting='vip' AND elan_status='active' LIMIT 12");
    if(mysqli_num_rows($prem_elan_list) > 0){ ?>
    <section class="mt-4">
        <div class="container">
            <div class="row mb-3">
                <h5 class="card-title text-uppercase position-relative rulers font-weight-bold" style="margin-left:7px">VIP Elanlar</h5>
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

                        $ipAddress=$_SERVER['REMOTE_ADDR'];
                        $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                        $favorites=mysqli_num_rows($favorites_list);

                        addItemExtra($prem_imgPremium['img_path'], $elan_premium['elan_qiymet'], $elan_premium['elan_id'], $elan_premium['elan_name'], $city_allPremium["city_title"], $timeElan, $elan_premium['elan_raiting'], $favorites);
                    }
                ?>
            </div>
        </div>
    </section>
<?php   }
?>

<?php
    $prem_elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_raiting='premium' AND elan_status='active' LIMIT 12");
    if(mysqli_num_rows($prem_elan_list) > 0){ ?>
    <section class="mt-4">
        <div class="container">
            <div class="row mb-3">
                <h5 class="card-title text-uppercase position-relative rulers font-weight-bold" style="margin-left:7px">Premium Elanlar</h5>
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

                        $ipAddress=$_SERVER['REMOTE_ADDR'];
                        $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                        $favorites=mysqli_num_rows($favorites_list);

                        addItemExtra($prem_imgPremium['img_path'], $elan_premium['elan_qiymet'], $elan_premium['elan_id'], $elan_premium['elan_name'], $city_allPremium["city_title"], $timeElan, $elan_premium['elan_raiting'], $favorites);
                    }
                ?>
            </div>
        </div>
    </section>
<?php   }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="textAdd"></p>

        <form id="formPayment">            
            <h6>Xidmət Növü</h6>            
            <div id="priceAdvert"></div>
            <h6 class="mt-4">Ödəniş Üsulu</h6>
            <div class="custom-control custom-radio">
                <input type="radio" id="radioBank" name="radioBank" class="custom-control-input" value="card">
                <label class="custom-control-label" for="radioBank">Bank kartı</label>
            </div>
            <input type="hidden" name="elanID" value="<?php echo $fetchArray["elan_id"] ?>">  
            <button type="submit" class="btn btn-success mt-4 w-100">
                <span id="btnText">Ödə</span>
                <img src="../img/loading.gif" alt="loading" width="30" style="display:none" class="loading mx-auto">
            </button>
            <div class="alert alert-danger mt-2 text-center" id="errorText" style="display:none"></div>
            <p class="text-muted mt-2 text-center mb-0" style="font-size:14px">Ödə düyməsini sıxmaqla siz saytın istifadəçi razılaşması qaydalarını qəbul etdiyinizi təsdiqləmiş olursunuz</p>
        </form>
        
      </div>
    </div>
  </div>
</div>

<script>
    $(function(){
        $("#formPayment").submit(function(e){
            e.preventDefault();

            var card=$('input[name=radioBank]:checked');
            var textError=$("#errorText");

            if(card.length > 0){
                textError.css("display", "none");
                textError.text("");  

                var radioName=$("#priceAdvert input:radio").attr("name");     
                
                if(radioName == "radioPriceSimple"){
                    var priceSimple=$('input[name=radioPriceSimple]:checked');

                    if(priceSimple.length > 0){
                        textError.css("display", "none");
                        textError.text("");  

                        $.ajax({
                            url: "../include/payment/fetch_data.php",
                            type: "post",
                            data: $(this).serialize(),
                            dataType: "json",
                            beforeSend: function () {
                                $(".loading").css("display", "block");
                                $("#btnText").css("display", "none");
                            },
                            success: function (data) {
                                if (data.ok) {
                                    window.location.href = '../include/payment/sms_sample.php?price='+data.price+'&data=simple';
                                    $("#errorText").css("display", "none");
                                } else {
                                    $("#errorText").css("display", "block");
                                    $("#errorText").html(data.text);
                                }

                                $(".loading").css("display", "none");
                                $("#btnText").css("display", "block");
                            },
                        });
                    } else {
                        textError.css("display", "block");
                        textError.text("Elanı irəli çəkmək üçün hər hansı bir xidmət növü seçin");
                    }
                } else {
                    var priceVip=$('input[name=radioPriceVIP]:checked');

                    if(priceVip.length > 0){
                        textError.css("display", "none");
                        textError.text("");  

                        $.ajax({
                            url: "../include/payment/fetch_data.php",
                            type: "post",
                            data: $(this).serialize(),
                            dataType: "json",
                            beforeSend: function () {
                                $(".loading").css("display", "block");
                                $("#btnText").css("display", "none");
                            },
                            success: function (data) {
                                if (data.ok) {
                                    window.location.href = '../include/payment/sms_sample.php?price='+data.price+'&data=vip';
                                    $("#errorText").css("display", "none");
                                } else {
                                    $("#errorText").removeClass("alert-success");
                                    $("#errorText").addClass("alert-danger");

                                    $("#errorText").css("display", "block");
                                    $("#errorText").html(data.text);
                                }                                

                                $(".loading").css("display", "none");
                                $("#btnText").css("display", "block");
                            },
                        });
                    } else {
                        textError.css("display", "block");
                        textError.text("Elanı vip etmək üçün hər hansı bir xidmət növü seçin");
                    }
                }
            } else {
                textError.css("display", "block");
                textError.text("Ödəniş üçün kart seçməlisiniz");
            }
            
        });
    })
</script>

<?php
    include("include/footerExtra.php");
}
?>