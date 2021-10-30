<?php
    include("include/header.php");
?>
<section class="header-margin">
    <div class="container">
        <div class="row">
            <h1 class="text-uppercase mb-3 pageTitle">Ödənişlər</h1>
            <div>
                <h3 class="text-capitalize mb-4">Ödəniş etmə qaydaları</h3>
                <?php
                    $rules_list=mysqli_query($connect, "SELECT *  FROM parametres WHERE parametres_key='payment' ");
                    while($subparametres=mysqli_fetch_array($rules_list)){ ?>
                        <p><?php echo $subparametres["parametres_value"] ?></p>
                <?php   }
                ?>
                <div>
                    <?php
                        $selectUsers=mysqli_query($connect,"SELECT * FROM users WHERE user_status='admin'");
                        $fetchUser=mysqli_fetch_array($selectUsers)
                    ?>
                    <p><b>Tel: </b><?php echo $fetchUser['user_phone'] ?></br>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    include("include/footer.php");
?>