<?php
    include("include/header.php");
?>
<script>
    $(function(){
        $("#rules").addClass("active");
    });
</script>
<section class="header-margin">
    <div class="container">
        <div class="row">
            <h1 class="text-uppercase mb-3 pageTitle">Ümumi QAYDALAR</h1>
            <div>
                <p><b><?php echo $company["company_name"] ?></b> - saytında elan yerləşdirilməsi İstifadəçinin qaydalarla razılaşması ilə tənzimlənir.</p>

                <h3 class="text-capitalize">Saytın tam qaydaları</h3>
                <?php
                    $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='rules' ");
                    while($subparametres=mysqli_fetch_array($rules_list)){ ?>
                        <p <?php if($subparametres["parametres_raiting"] == "title"){ echo 'style="font-weight:bold"'; } ?>><?php echo $subparametres["parametres_value"] ?></p>
                <?php   }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/footer.php");
?>