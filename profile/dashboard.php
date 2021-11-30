<?php
    error_reporting(0);
    session_start();

    if(!isset($_SESSION["ProfilEmail"])){
      header("Location:index");
    }

    include_once 'include/header.php';

    $session_email=$_SESSION["ProfilEmail"];

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

    // var_dump($active_array[0]['elan_seher']);
?>

<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-5 text-muted" style="font-size:18px">
        <span>İstifadəçi Kabineti</span>  
        <a href="logout" class="text-muted" style="font-size:18px"><i class="fas fa-sign-out-alt"></i></a>
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

                                      addItem($prem_img['img_path'], $active_array[$ac]['elan_qiymet'], $active_array[$ac]['elan_id'], $active_array[$ac]['elan_name'], $city_all["city_title"], $timeElan, $raiting['forward_key'], $favorites);
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

                                      addItem($prem_img['img_path'], $waiting_array[$ac]['elan_qiymet'], $waiting_array[$ac]['elan_id'], $waiting_array[$ac]['elan_name'], $city_all["city_title"], $timeElan, $raiting['forward_key'], $favorites);
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

                                      addItem($prem_img['img_path'], $deactive_array[$ac]['elan_qiymet'], $deactive_array[$ac]['elan_id'], $deactive_array[$ac]['elan_name'], $city_all["city_title"], $timeElan, $raiting['forward_key'], $favorites);
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

                                    addItem($prem_img['img_path'], $blocked_array[$ac]['elan_qiymet'], $blocked_array[$ac]['elan_id'], $blocked_array[$ac]['elan_name'], $city_all["city_title"], $timeElan, $raiting['forward_key'], $favorites);
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
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Parametr</div>
    </div>
</div>

<?php
	error_reporting(0);
	include_once 'include/footer.php'
?> 