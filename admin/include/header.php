<div class="preloader">
    <img src="img/loading.gif" alt="loading">
</div>
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"
                    ><i class="fas fa-bars"></i
                ></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block mr-1">
                <a href="dashboard" class="nav-link" id="settings_page_main">Ana Səhifə</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block mr-1">
                <a href="profile" class="nav-link" id="settings_page_profile">Profil Tənzimləmələri</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <?php
                // count waiting =======================> 
                $elanlar_listeHeader=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='waiting' ");
                $countElanlarHeader=mysqli_num_rows($elanlar_listeHeader);

                // count deadline ===================================> 
                $nowTime=time();  // current time
                $arrayTimePUsh=[];
                // change timestamp to unix time 
                $deadline_list_one=mysqli_query($connect, "SELECT *  FROM deadline ");
                while($deadline_one=mysqli_fetch_array($deadline_list_one)){

                    $unixElanTime=strtotime($deadline_one["deadline_time"]);
                    $idDeadlineElan=$deadline_one["elan_id"];

                    if($nowTime > $unixElanTime){
                        array_push($arrayTimePUsh, $idDeadlineElan); 
                    }
                } 
                $countDeadlineHeader=count($arrayTimePUsh);

                $toplamBildiris=$countElanlarHeader+$countDeadlineHeader // burada bildirisler toplanir
            ?>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <?php
                        if($toplamBildiris > 0){ ?>
                            <span class="badge badge-warning navbar-badge"><?php echo $toplamBildiris ?></span>
                    <?php   }
                    ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <?php
                        if($toplamBildiris > 0){ ?>
                            <span class="dropdown-item dropdown-header"><?php echo $toplamBildiris ?> Bildiriş</span>
                    <?php    } else { ?>
                        <span class="dropdown-item dropdown-header">Heç bir bildirişiniz yoxdur</span>
                    <?php }
                    ?>
                    
                    <div class="dropdown-divider"></div>
                    <?php
                    if($countElanlarHeader > 0){ ?>
                        <!-- elanlar -->
                        <a href="elanlar" class="dropdown-item">
                            <i class="fas fa-copy mr-2"></i> <?php echo $countElanlarHeader ?> yeni elanınız var
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php }
                    ?>

                    <!-- deadline ===============> -->
                    <?php 
                        // current time
                        $nowTime=time();

                        $arrayTimePUsh=[];

                        // change timestamp to unix time 
                        $deadline_list_one=mysqli_query($connect, "SELECT *  FROM deadline ");
                        while($deadline_one=mysqli_fetch_array($deadline_list_one)){

                            $unixElanTime=strtotime($deadline_one["deadline_time"]);
                            $idDeadlineElan=$deadline_one["elan_id"];

                            if($nowTime > $unixElanTime){
                                array_push($arrayTimePUsh, $idDeadlineElan); 
                            }
                        }  
                    ?>

                    <?php
                        if(count($arrayTimePUsh) > 0){ ?>
                            <!-- deadline -->
                            <a href="elanlar" class="dropdown-item">
                                <i class="fas fa-calendar-times mr-2"></i></i> <?php echo count($arrayTimePUsh); ?> elanın vaxtı bitib
                            </a>
                            <div class="dropdown-divider"></div>
                    <?php  }
                    ?>
                    
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard" class="brand-link">
            <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8"/>
            <span class="brand-text font-weight-light">İdarəetmə Paneli</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <?php
                        if($user['user_img'] == ""){ ?>
                            <img src="img/users/user2.png" class="img-circle elevation-2" alt="User Image" />
                    <?php  } else { ?>
                            <img src="img/users/<?php echo $user['user_img'] ?>" class="img-circle elevation-2" alt="User Image" />
                    <?php  }
                    ?>
                </div>
                <div class="info">
                    <?php
                        if($user['user_name'] == ""){ ?>
                            <a href="profile" class="d-block">Administrator</a>
                    <?php  } else { ?>
                            <a href="profile" class="d-block"><?php echo $user['user_name'] ?></a>
                    <?php  }
                    ?>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    
                    <li class="nav-item">
                        <a href="dashboard" class="nav-link" id="dashboard">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Ana Səhifə
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="opt_list_adverts">
                        <a href="#" class="nav-link" id="adverts">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Elanlar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="elanlar" class="nav-link" id="list_elanlar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Elanları Listələ</p>
                                    <?php
                                        $elanlar_liste=mysqli_query($connect, "SELECT * FROM elan WHERE elan_status='waiting' ");
                                        $countElanlar=mysqli_num_rows($elanlar_liste);
                                        if($countElanlar > 0){ ?>
                                            <span class="badge badge-info right"><?php echo $countElanlar ?></span>
                                    <?php   }
                                    ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="elanlar-status" class="nav-link" id="list_elanlar_status">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Status dəyişmə</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="opt_list_categories">
                        <a href="#" class="nav-link" id="categories">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Kateqoriyalar
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="list-category" class="nav-link" id="list_category">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Kateqoriya Listələ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="list-subcategory" class="nav-link" id="list_subcategory">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Alt Kateqoriya Listələ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="opt_list_options">
                        <a href="#" class="nav-link" id="options">
                            <i class="nav-icon fas fa-filter"></i>
                            <p>
                                Parametrlər
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="list-options" class="nav-link" id="list_options">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Əsas parametrlər</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="list-suboptions" class="nav-link" id="list_suboptions">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Köməkçi parametrlər</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="merge-suboptions" class="nav-link" id="list_merge_suboptions">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p class="text-capitalize">Parametr Birləşdirmə</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="list-cities" class="nav-link" id="list_cities">
                            <i class="nav-icon fas fa-city"></i>
                            <p>
                                Şəhərlər
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="new-rules" class="nav-link" id="list_rules">
                            <i class="nav-icon fas fa-text-width"></i>
                            <p>
                                Mətn ayarları
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="company-settings" class="nav-link" id="company_settings">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Şirkət ayarları
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="site-settings" class="nav-link" id="site_settings">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>
                                Sayt ayarları 
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout" class="nav-link bg-danger text-center">
                            <p class="text-uppercase">
                                sistemdən çıxış
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>