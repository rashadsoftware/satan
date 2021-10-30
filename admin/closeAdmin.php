<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("include/head_tag.php");
            dynamic_title("İdarəetmə Paneli | Çıxış Paneli");
        ?>
    </head>
    <body class="hold-transition lockscreen">
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="index"><b>İdarəetmə Paneli</b></a>
            </div>
            <!-- User name -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image" style="top:18px; left:3px">
                    <?php 
                        if($user['user_img'] == ""){ ?>
                            <img src="img/users/user2.png" alt="User Image" style="width:65px; height:65px">
                    <?php   } else { ?>
                        <img src="img/users/<?php echo $user['user_img'] ?>" alt="<?php echo $user['user_name'] ?>" style="width:65px; height:65px">
                    <?php   }
                    ?>
                </div>
                <!-- /.lockscreen-image -->
            </div>
          <div class="lockscreen-name"><?php echo $user['user_name'] ?></div>

          <div class="w-100 text-center mt-2">
              <a href="logout" class="text-uppercase font-weight-bold btn btn-danger">Sistemdən çıxış</a>
          </div>

          <p class="text-muted mt-4 text-center">Yenidən idarəetmə panelinə girmək üçün ilk öncə oturumu bağlamalısınız</p>
          
        </div>
        <!-- /.center -->
    </body>
</html>
