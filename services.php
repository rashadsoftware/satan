<?php
    include("include/header.php");
?>
<section class="header-margin">
    <div class="container">
        <div class="row">
            <h1 class="text-uppercase mb-3 pageTitle">Xidmətlər</h1>
            <div>
                <h3 class="text-capitalize mb-4">Xidmətlər barədə ətraflı:</h3>
                <?php
                    $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='services' ");
                    while($subparametres=mysqli_fetch_array($rules_list)){ ?>
                        <h5><?php echo $subparametres["parametres_title"] ?></h5>
                        <p><?php echo $subparametres["parametres_value"] ?></p>
                <?php   }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/footer.php");
?>