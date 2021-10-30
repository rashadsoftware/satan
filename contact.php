<?php
    include("include/header.php");

    $config_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametre_key='config' ");
    $config=mysqli_fetch_array($config_list);
    $config_id=$config['parametre_id'];
?>
<script>
    $(function(){
        $("#contact").addClass("active");
    });
</script>
<section class="header-margin">
    <div class="container">
        <div class="row">
            <h1 class="text-uppercase mb-3 pageTitle">Əlaqə</h1>
            <?php
                $e_address_list=mysqli_query($connect, "SELECT *  FROM subparametres WHERE parametre_id='$config_id' AND subparametre_key='e_address' ");
                $e_address=mysqli_fetch_array($e_address_list);

                $worktime_list=mysqli_query($connect, "SELECT *  FROM subparametres WHERE parametre_id='$config_id' AND subparametre_key='worktime' ");
                $worktime=mysqli_fetch_array($worktime_list);
            ?>
            <div>
                <?php
                    $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='contact' ");
                    while($subparametres=mysqli_fetch_array($rules_list)){ ?>
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