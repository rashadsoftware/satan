<?php
    error_reporting(0);
    session_start();

    if(!isset($_SESSION["ProfilEmail"])){
      header("Location:index");
    }

    include_once 'include/header.php';

	// fetch all elanlar
    $active_array=array();
    $deactive_array=array();
    $waiting_array=array();
    $blocked_array=array();

    $profile_datas=mysqli_query($connect, "SELECT *  FROM customers WHERE customer_email='$session_email' ");
    while($profile_data=mysqli_fetch_array($profile_datas)){
        $profile_id=$profile_data["customer_id"];

        $active_elanlar=mysqli_query($connect, "SELECT *  FROM elan WHERE customer_id='$profile_id' AND elan_status='active' ");
        $active_elan_data=mysqli_fetch_array($active_elanlar);
        if(mysqli_num_rows($active_elanlar) > 0){
            array_push($active_array, $active_elan_data);
        }         

        $expired_elanlar=mysqli_query($connect, "SELECT *  FROM elan WHERE customer_id='$profile_id' AND elan_status='deactive' ");
        $expired_elan_data=mysqli_fetch_array($expired_elanlar);        
        if(mysqli_num_rows($expired_elanlar) > 0){
            array_push($deactive_array, $expired_elan_data);
        } 

        $waiting_elanlar=mysqli_query($connect, "SELECT *  FROM elan WHERE customer_id='$profile_id' AND elan_status='waiting' ");
        $waiting_elan_data=mysqli_fetch_array($waiting_elanlar); 
        if(mysqli_num_rows($waiting_elanlar) > 0){
            array_push($waiting_array, $waiting_elan_data);
        }         

        $blocked_elanlar=mysqli_query($connect, "SELECT *  FROM elan WHERE customer_id='$profile_id' AND elan_status='blocked' ");  
        $blocked_elan_data=mysqli_fetch_array($blocked_elanlar);       
        if(mysqli_num_rows($blocked_elanlar) > 0){
            array_push($blocked_array, $blocked_elan_data);
        } 
    }   

    header_title("header", "İstifadəçi Profili");
?>

<div class="container mt-3" style="margin-bottom:300px">
    <div class="d-flex align-items-center justify-content-between mb-5 text-muted" style="font-size:18px">
        <span class="text-dark font-weight-bold">İstifadəçi Kabineti</span>  
        <a href="logout" class="text-muted" style="font-size:24px"><i class="fas fa-power-off"></i></a>
    </div>   
	<div class="row">
		<div class="col-12">
			<?php
				dynamic_alert_notification("alertDashboard");
			?>
		</div>
	</div>	
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Elanlar</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Parametrlər</a>
        </div>
    </nav>
    <div class="tab-content mt-4" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Aktiv (<?php echo count($active_array); ?>)</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Yoxlanışda (<?php echo count($waiting_array); ?>)</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Müddəti başa çatmış (<?php echo count($deactive_array); ?>)</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="pills-block-tab" data-toggle="pill" href="#pills-block" role="tab" aria-controls="pills-block" aria-selected="false">Bloka salınanlar (<?php echo count($blocked_array); ?>)</a>
                </li>
            </ul>
            <div class="tab-content mt-4" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <!-- aktiv elanlar -->
                    <div class="container-fluid">
                      <div class="row">
                          <?php  
                              if(count($active_array) > 0){
                                  for($ac=0; $ac < count($active_array); $ac++){ 
                                      // city create
                                      $cityElan=$active_array[$ac]["elan_seher"];
                                      $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                                      $city_all=mysqli_fetch_array($all_city_list);

                                      // create time
                                      $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($active_array[$ac]['elan_time'])));

                                      // create img
                                      $idElan=$active_array[$ac]['elan_id'];
                                      $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                                      $prem_img=mysqli_fetch_array($prem_elan_img);

                                      $ipAddress=$_SERVER['REMOTE_ADDR'];
                                      $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                                      $favorites=mysqli_num_rows($favorites_list);

                                      $raiting_list=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                      $raiting=mysqli_fetch_array($raiting_list);

                                      echo'   <div class="col-6 col-lg-4 col-xl-3">
                                                <div class="item-container">
                                                    <div class="item-image"> ';
                                                echo'   <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                                                            <img src="../img/advert/'.$prem_img['img_path'].'" alt="'.seflink($mezmun).'"/>
                                                        </a>';
                                                        if($price != ""){
                                                            echo '<span class="price">'.str_replace(",", " ", number_format($active_array[$ac]['elan_qiymet'])).' AZN</span>';
                                                        }
                                                        
                                                echo'   <ul class="item-status">';
                                                                if($raiting['forward_key'] == "premium"){ 
                                                        echo'       <li><i class="far fa-gem"></i></li> ';
                                                                    }
                                                                if($raiting['forward_key'] == "vip"){ 
                                                        echo'       <li style="line-height:24px"><i class="fas fa-crown"></i></li>';
                                                                }
                                                echo'   </ul>
                                                        <span class="item-love">';
                                                        if($favorites > 0){
                                                            echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$active_array[$ac]['elan_id'].'">';
                                                        } else {
                                                            echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$active_array[$ac]['elan_id'].'">';
                                                        }
                                                echo'    </span>
                                                    </div>
                                                    <div class="item-content">
                                                        <h2>
                                                                <a href="../preview/'.seflink($active_array[$ac]['elan_name']).'-'.$active_array[$ac]['elan_id'].'" target="_blank">'.substr($active_array[$ac]['elan_name'], 0, 28).'...</a>
                                                        </h2> ';
                                                        if($city_all["city_title"] == ""){
                                                            echo'   <p>'.$timeElan.'</p>';
                                                        } else {
                                                            echo'   <p>'.$city_all["city_title"].', '.$timeElan.'</p>';
                                                        }
                                            echo'    </div>
                                                    <div class="item-bottom-content">
                                                        <a href="add?id='.$active_array[$ac]['elan_id'].'" style="color:var(--main-color)"><i class="fas fa-pencil-alt"></i> Düzəliş et</a>
                                                        <div style="color:var(--main-color); cursor:pointer" class="delete" data-id="'.$active_array[$ac]['elan_id'].'"><i class="fas fa-trash-alt"></i> Elanı sil</div>
                                                    </div>
                                                </div>
                                            </div>';
                                  }
                              } else {
                                  echo '<div class="alert alert-info mt-5 mx-auto">Bu bölmədə elan yoxdur</div>';
                              }                             
                          ?>
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <!-- aktiv elanlar -->
                    <div class="container-fluid">
                      <div class="row">
                          <?php  
                              if(count($waiting_array) > 0){
                                  for($ac=0; $ac < count($waiting_array); $ac++){ 
                                      // city create
                                      $cityElan=$waiting_array[$ac]["elan_seher"];
                                      $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                                      $city_all=mysqli_fetch_array($all_city_list);

                                      // create time
                                      $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($waiting_array[$ac]['elan_time'])));

                                      // create img
                                      $idElan=$waiting_array[$ac]['elan_id'];
                                      $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                                      $prem_img=mysqli_fetch_array($prem_elan_img);

                                      $ipAddress=$_SERVER['REMOTE_ADDR'];
                                      $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                                      $favorites=mysqli_num_rows($favorites_list);

                                      $raiting_list=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                      $raiting=mysqli_fetch_array($raiting_list);

                                      echo'   <div class="col-6 col-lg-4 col-xl-3">
                                                <div class="item-container">
                                                    <div class="item-image"> ';
                                                echo'   <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                                                            <img src="../img/advert/'.$prem_img['img_path'].'" alt="'.seflink($mezmun).'"/>
                                                        </a>';
                                                        if($price != ""){
                                                            echo '<span class="price">'.str_replace(",", " ", number_format($waiting_array[$ac]['elan_qiymet'])).' AZN</span>';
                                                        }
                                                        
                                                echo'   <ul class="item-status">';
                                                                if($raiting['forward_key'] == "premium"){ 
                                                        echo'       <li><i class="far fa-gem"></i></li> ';
                                                                    }
                                                                if($raiting['forward_key'] == "vip"){ 
                                                        echo'       <li style="line-height:24px"><i class="fas fa-crown"></i></li>';
                                                                }
                                                echo'   </ul>
                                                        <span class="item-love">';
                                                        if($favorites > 0){
                                                            echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$waiting_array[$ac]['elan_id'].'">';
                                                        } else {
                                                            echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$waiting_array[$ac]['elan_id'].'">';
                                                        }
                                                echo'    </span>
                                                    </div>
                                                    <div class="item-content">
                                                        <h2>
                                                                <a href="../preview/'.seflink($waiting_array[$ac]['elan_name']).'-'.$waiting_array[$ac]['elan_id'].'" target="_blank">'.substr($waiting_array[$ac]['elan_name'], 0, 28).'...</a>
                                                        </h2> ';
                                                        if($city_all["city_title"] == ""){
                                                            echo'   <p>'.$timeElan.'</p>';
                                                        } else {
                                                            echo'   <p>'.$city_all["city_title"].', '.$timeElan.'</p>';
                                                        }
                                            echo'    </div>
                                                    <div class="item-bottom-content">
                                                        <p class="mb-0" style="color:var(--main-color)">Elan təsdiqlənmə rejimindədir</p>
                                                    </div>
                                                </div>
                                            </div>';
                                  }
                              } else {
                                  echo '<div class="alert alert-info mt-5 mx-auto">Bu bölmədə elan yoxdur</div>';
                              }                             
                          ?>
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <!-- muddeti bitmis elanlar -->
                    <div class="container-fluid">
                      <div class="row">
                          <?php  
                              if(count($deactive_array) > 0){
                                  for($ac=0; $ac < count($deactive_array); $ac++){ 
                                      // city create
                                      $cityElan=$deactive_array[$ac]["elan_seher"];
                                      $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                                      $city_all=mysqli_fetch_array($all_city_list);

                                      // create time
                                      $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($deactive_array[$ac]['elan_time'])));

                                      // create img
                                      $idElan=$deactive_array[$ac]['elan_id'];
                                      $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                                      $prem_img=mysqli_fetch_array($prem_elan_img);

                                      $ipAddress=$_SERVER['REMOTE_ADDR'];
                                      $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                                      $favorites=mysqli_num_rows($favorites_list);

                                      $raiting_list=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                      $raiting=mysqli_fetch_array($raiting_list);

                                      echo'   <div class="col-6 col-lg-4 col-xl-3">
                                                <div class="item-container">
                                                    <div class="item-image"> ';
                                                echo'   <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                                                            <img src="../img/advert/'.$prem_img['img_path'].'" alt="'.seflink($mezmun).'"/>
                                                        </a>';
                                                        if($price != ""){
                                                            echo '<span class="price">'.str_replace(",", " ", number_format($deactive_array[$ac]['elan_qiymet'])).' AZN</span>';
                                                        }
                                                        
                                                echo'   <ul class="item-status">';
                                                                if($raiting['forward_key'] == "premium"){ 
                                                        echo'       <li><i class="far fa-gem"></i></li> ';
                                                                    }
                                                                if($raiting['forward_key'] == "vip"){ 
                                                        echo'       <li style="line-height:24px"><i class="fas fa-crown"></i></li>';
                                                                }
                                                echo'   </ul>
                                                        <span class="item-love">';
                                                        if($favorites > 0){
                                                            echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$deactive_array[$ac]['elan_id'].'">';
                                                        } else {
                                                            echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$deactive_array[$ac]['elan_id'].'">';
                                                        }
                                                echo'    </span>
                                                    </div>
                                                    <div class="item-content">
                                                        <h2>
                                                                <a href="../preview/'.seflink($deactive_array[$ac]['elan_name']).'-'.$deactive_array[$ac]['elan_id'].'" target="_blank">'.substr($deactive_array[$ac]['elan_name'], 0, 28).'...</a>
                                                        </h2> ';
                                                        if($city_all["city_title"] == ""){
                                                            echo'   <p>'.$timeElan.'</p>';
                                                        } else {
                                                            echo'   <p>'.$city_all["city_title"].', '.$timeElan.'</p>';
                                                        }
                                            echo'    </div>
                                                        <div class="item-bottom-content">
                                                            <div style="color:var(--main-color); cursor:pointer" class="activate" data-id="'.$deactive_array[$ac]['elan_id'].'"><i class="fas fa-sync"></i> Aktivləşdir</div>
                                                        </div>
                                                </div>
                                            </div>';
                                  }
                              } else {
                                  echo '<div class="alert alert-info mt-5 mx-auto">Bu bölmədə elan yoxdur</div>';
                              }                            
                          ?>
                      </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-block" role="tabpanel" aria-labelledby="pills-block-tab">
                    <!-- aktiv elanlar -->
                    <div class="container-fluid">
                      <div class="row">
                          <?php  
                              if(count($blocked_array) > 0){
                                for($ac=0; $ac < count($blocked_array); $ac++){ 
                                    // city create
                                    $cityElan=$blocked_array[$ac]["elan_seher"];
                                    $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                                    $city_all=mysqli_fetch_array($all_city_list);

                                    // create time
                                    $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($blocked_array[$ac]['elan_time'])));

                                    // create img
                                    $idElan=$blocked_array[$ac]['elan_id'];
                                    $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                                    $prem_img=mysqli_fetch_array($prem_elan_img);

                                    $ipAddress=$_SERVER['REMOTE_ADDR'];
                                    $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                                    $favorites=mysqli_num_rows($favorites_list);

                                    $raiting_list=mysqli_query($connect, "SELECT *  FROM forward WHERE elanID='$idElan' AND forward_status='active' ");
                                    $raiting=mysqli_fetch_array($raiting_list);

                                    echo'   <div class="col-6 col-lg-4 col-xl-3">
                                                <div class="item-container">
                                                    <div class="item-image"> ';
                                                echo'   <a href="../preview/'.seflink($mezmun).'-'.$idElan.'" target="_blank">
                                                            <img src="../img/advert/'.$prem_img['img_path'].'" alt="'.seflink($mezmun).'"/>
                                                        </a>';
                                                        if($price != ""){
                                                            echo '<span class="price">'.str_replace(",", " ", number_format($blocked_array[$ac]['elan_qiymet'])).' AZN</span>';
                                                        }
                                                        
                                                echo'   <ul class="item-status">';
                                                                if($raiting['forward_key'] == "premium"){ 
                                                        echo'       <li><i class="far fa-gem"></i></li> ';
                                                                    }
                                                                if($raiting['forward_key'] == "vip"){ 
                                                        echo'       <li style="line-height:24px"><i class="fas fa-crown"></i></li>';
                                                                }
                                                echo'   </ul>
                                                        <span class="item-love">';
                                                        if($favorites > 0){
                                                            echo '<img src="../img/icons/heart_full.png" alt="heart" class="heart" id="'.$blocked_array[$ac]['elan_id'].'">';
                                                        } else {
                                                            echo '<img src="../img/icons/heart_empty.png" alt="heart" class="heart" id="'.$blocked_array[$ac]['elan_id'].'">';
                                                        }
                                                echo'    </span>
                                                    </div>
                                                    <div class="item-content">
                                                        <h2>
                                                                <a href="../preview/'.seflink($blocked_array[$ac]['elan_name']).'-'.$blocked_array[$ac]['elan_id'].'" target="_blank">'.substr($blocked_array[$ac]['elan_name'], 0, 28).'...</a>
                                                        </h2> ';
                                                        if($city_all["city_title"] == ""){
                                                            echo'   <p>'.$timeElan.'</p>';
                                                        } else {
                                                            echo'   <p>'.$city_all["city_title"].', '.$timeElan.'</p>';
                                                        }
                                            echo'    </div>
                                                    <div class="item-bottom-content">
                                                        <a href="#" style="color:var(--main-color)"><i class="fas fa-pencil-alt"></i> Düzəliş et</a>
                                                        <a href="#" style="color:var(--main-color)"><i class="fas fa-trash-alt"></i> Sil</a>
                                                    </div>
                                                </div>
                                            </div>';
                                }
                            } else {
                                echo '<div class="alert alert-info mt-5 mx-auto">Bu bölmədə elan yoxdur</div>';
                            }                             
                          ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne" style="padding:0.5rem 1rem">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Əlaqə Vasitələri
                            </button>
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form id="password-optional" autocomplete="off">
                                <div class="form-group">
                                    <label for="username">İstifadəçi adı</label>
                                    <input type="text" class="form-control" id="username" placeholder="İstifadəçi adınızı daxil edin" name="username" value="<?php echo $user_data["user_name"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="E-poçt ünvanınızı daxil edin" name="email" value="<?php echo $user_data["user_email"] ?>">
                                </div>
								<input type="hidden" name="inputHiddenID" value="<?php echo $user_data["user_id"] ?>">
                                <button type="submit" class="btn btn-primary site-button">Məlumatları Yenilə</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo" style="padding:0.5rem 1rem">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Şifrəni Dəyişmək
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <form id="password-change" autocomplete="off">
                                <div class="form-group">
                                    <label for="current_password">Cari şifrə</label>
                                    <input type="password" class="form-control" id="current_password" placeholder="Password" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Yeni şifrə</label>
                                    <input type="password" class="form-control" id="new_password" placeholder="Password" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Təkrar şifrə</label>
                                    <input type="password" class="form-control" id="confirm_password" placeholder="Password" name="confirm_password">
                                </div>
								<input type="hidden" name="inputHiddenID" value="<?php echo $user_data["user_id"] ?>">
                                <button type="submit" class="btn btn-primary site-button">Şifrəni Dəyiş</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	error_reporting(0);
	include_once 'include/footer.php'
?> 