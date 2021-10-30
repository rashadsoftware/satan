<?php
    include("include/header.php");
?>
<script>
    $(function(){
        $("#about").addClass("active");
    });
</script>
<section class="header-margin" style="height:50vh">
    <div class="container">
        <div class="row">
            <h1 class="text-uppercase mb-3 pageTitle">Haqqımızda</h1>
            <div>
                <?php
                    $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='about' ");
                    while($parametres=mysqli_fetch_array($rules_list)){ ?>
                        <p><?php echo $parametres["parametres_value"] ?></p>
                <?php   }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/footer.php");
?>