<?php
	include("../include/connectDB.php");
    include("../include/function.php");

    echo '<link rel="stylesheet" href="./css/bootstrap.css">';
    echo '<link rel="stylesheet" type="text/css" media="screen" href="css/style2.php">';

    $record_per_page=48;
    $page='';
    $output='';

    if(isset($_POST['page'])){
        $page=$_POST['page'];
    } else{
        $page=1;
    }

    $start_from=($page-1)*$record_per_page;
    $result=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' ORDER BY elan_time DESC LIMIT $start_from, $record_per_page");

    if(mysqli_num_rows($result) > 0){
        echo '<div class="row"> ';
            while($elan_all=mysqli_fetch_array($result)){	
                // city create
                $cityElan=$elan_all["elan_seher"];
                $all_city_list=mysqli_query($connect, "SELECT *  FROM cities WHERE city_id='$cityElan' ");
                $city_all=mysqli_fetch_array($all_city_list);

                // create time
                $timeElan=str_replace($aylar_EN,$aylar_TR,date("d M Y", strtotime($elan_all['elan_time'])));

                // create img
                $idElan=$elan_all['elan_id'];
                $prem_elan_img=mysqli_query($connect, "SELECT *  FROM img WHERE elan_id='$idElan' ");
                $prem_img=mysqli_fetch_array($prem_elan_img);

                $ipAddress=$_SERVER['REMOTE_ADDR'];
                $favorites_list=mysqli_query($connect, "SELECT *  FROM favorites WHERE elan_id='$idElan' AND favorites_ip='$ipAddress' ");
                $favorites=mysqli_num_rows($favorites_list);

                addItem($prem_img['img_path'], $elan_all['elan_qiymet'], $elan_all['elan_id'], $elan_all['elan_name'], $city_all["city_title"], $timeElan, $elan_all['elan_raiting'], $favorites);
            }
        echo '</div>';

        $output.='
            <div class="row">
                <div class="w-100 text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center"> ';
                        $page_result=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='active' ORDER BY elan_time DESC");
                        $total_records=mysqli_num_rows($page_result);
                        $total_pages=ceil($total_records/$record_per_page);
                        for($i=1; $i <= $total_pages; $i++){
                            $output.='<li class="page-item"><span class="page-link next_link" href="#" id="'.$i.'">'.$i.'</span></li>';
                        }
                $output.='
                        </ul>
                    </nav>
                </div>
            </div>
        ';

        echo $output; 
    }

    echo '<script src="./js/jquery-3.6.0.js" ></script>
		<script src="./js/bootstrap.js" ></script>
		<script>            
			$(function(){
				// favorites
                $(".heart").click(function () {
                    var idImgFavorites = $(this).attr("id");

                    $.ajax({
                        method: "POST",
                        url: "php/addtoBookmark.php",
                        data: { idImgFavorites: idImgFavorites },
                        dataType: "json",
                        success: function (data) {
                            if (data.ok == "ok") {
                                document.getElementById(data.id).src = "img/icons/heart_full.png";
                            } else {
                                document.getElementById(data.id).src = "img/icons/heart_empty.png";
                            }
                        },
                    });
                });
			});
		</script>';
    
    mysqli_close($connect);
?>