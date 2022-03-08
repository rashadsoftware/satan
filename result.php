<?php
    session_start();

    if(isset($_SESSION["merchant_elan_id"])){
        include("include/header.php"); 

        if($_SESSION["merchant_state"] == "success"){
            $header_title="Təbriklər";
        } else {
            $header_title="Oops";
        }

        $text=$_SESSION["merchant_text"];

        unset($_SESSION['merchant_state']);
        unset($_SESSION['merchant_price']);
        unset($_SESSION['merchant_path']);
        unset($_SESSION['merchant_status']);
        unset($_SESSION['merchant_ip']);
        unset($_SESSION['merchant_order']);
        unset($_SESSION['merchant_text']);
    
    ?>

        <section>
            <div class="container">
                <div class="row">
                    <div class="d-flex align-items-center justify-content-center w-100" style="height:500px">
                        <div class="card p-4" style="width:550px">
                            <h2 class="text-center"><?php echo $header_title; ?></h2>
                            <p class="mt-5"><?php echo $text; ?></p>
                            <a href="index" class="btn btn-success mt-5 text-uppercase">Ana səhifəyə get</a>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>

<?php   include("include/footer.php");
    } else {
        header("Location: index.php");
    }
?>