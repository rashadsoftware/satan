<?php
    if(isset($_POST)){
        include("../include/connectDB.php");
        include("../include/function.php");

        $data=array();

        // get value
        $inputName=mysqli_real_escape_string($connect, trim($_POST["inputName"]));
        $selectUser=mysqli_real_escape_string($connect, trim($_POST["selectUser"]));
        $inputEmail=mysqli_real_escape_string($connect, trim($_POST["inputEmail"]));
        $inputPhone=mysqli_real_escape_string($connect, trim($_POST["inputPhone"]));
        $selectsubCategory=mysqli_real_escape_string($connect, trim($_POST["selectsubCategory"]));        
        $selectCity=mysqli_real_escape_string($connect, trim($_POST["selectCity"]));
        $inputTitleElan=mysqli_real_escape_string($connect, trim($_POST["inputElanTitle"]));
        $inputPrice=mysqli_real_escape_string($connect, trim($_POST["inputPrice"]));
        $textareaAdd=mysqli_real_escape_string($connect, trim($_POST["textareaAdd"]));

		$allImages=mysqli_real_escape_string($connect, trim($_POST["allImages"]));

        // default value
        $customer_rand_id=rand(100,99999999);
        $elan_rand_id=rand(10000000,99999999);

        $raiting="simple";
        $elan_status="waiting";
        $elan_ok="ok";
        $elan_no="no";

        // check value
        $controlName=controlTitle($inputName, "İstifadəçinin adı", 1);
        if($controlName==true){
            $controlSelectUser=controlSelect($selectUser, "Elan verən");
            if($controlSelectUser==true){
                $controlEmail=controlEmail($inputEmail, "Email");
                if($controlEmail==true){
                    $controlPhone=controlPhone($inputPhone, "Əlaqə telefonu", 10);
                    if($controlPhone==true){
                        $controlSelectsubCategory=controlSelect($selectsubCategory, "Kateqoriya sahəsi");
                        if($controlSelectsubCategory==true){
                            if($selectsubCategory == 34){
                                $controlInputTitleElan=controlElanTitle($inputTitleElan, "Elanın adı", 1);
                                if($controlInputTitleElan==true){
                                    $controlInputPrice=controlPrice($inputPrice, "Qiymət sahəsi");
									if($controlInputPrice==true){
										$controlTextareaAdd=controlText($textareaAdd, "Məzmun sahəsi", 14);
										if($controlTextareaAdd==true){
											// create customers profile
											$addProfil = "INSERT IGNORE INTO customers (customer_id, customer_name, customer_email, customer_phone, customer_okno) VALUES ('$customer_rand_id', '$inputName', '$inputEmail', '$inputPhone', '$elan_ok')";

											if(mysqli_query($connect, $addProfil)){
												$customers2=mysqli_query($connect, "SELECT * FROM customers WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");
												$customer=mysqli_fetch_array($customers2);
												$customer_id=$customer["customer_id"];

												// create elan details
												$addElan = "INSERT IGNORE INTO elan (elan_id, elan_veren, elan_kateqoriya, elan_seher, elan_qiymet, elan_mezmun, customer_id, elan_raiting, elan_status, elan_name, elan_okno) VALUES ('$elan_rand_id', '$selectUser', '$selectsubCategory', '$selectCity', '$inputPrice', '$textareaAdd', '$customer_id', '$raiting', '$elan_status', '$inputTitleElan', '$elan_ok')";

												if(mysqli_query($connect, $addElan)){
													mysqli_query($connect,"UPDATE customers SET customer_okno='$elan_no' WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");

													$elanlar=mysqli_query($connect, "SELECT * FROM elan WHERE customer_id ='$customer_id' AND elan_okno='ok'");
													$elan_item=mysqli_fetch_array($elanlar);
													$elan_id=$elan_item["elan_id"];
													$elan_kateqoriya=$elan_item["elan_kateqoriya"];

													// veri parcalama islemi ve arraya atama islemi
													$arrayForm=[];
													$optionsQuery=mysqli_query($connect, "SELECT * FROM options WHERE subcategory_id ='$elan_kateqoriya' ");
													while($options_item15=mysqli_fetch_array($optionsQuery)){
														array_push($arrayForm, $options_item15["options_id"]);
													}

													// formdan gelen dizi
													$optionss15=$_POST["optionsAdd"];

													// insert elan_details                                                    
													for($m=0; $m<count($optionss15); $m++){
														mysqli_query($connect, "INSERT IGNORE INTO elan_detail (elan_id, options_id, elanDetail_value) VALUES ('$elan_id', '$arrayForm[$m]', '$optionss15[$m]')");
													}


													// upload multi images 
													foreach ($_FILES['files']['name'] as $name => $valueFiles) { 
																									
														$file_name = explode(".", $_FILES['files']['name'][$name]);
														$new_name = md5(rand()) . '.' . end($file_name); 
														$max_size="10000000"; 
														$location='../img/advert/'.$new_name; 
											
														if($_FILES['files']['size'][$name] < $max_size){
															if($_FILES['files']['type'][$name]=="image/png" || $_FILES['files']['type'][$name]=="image/jpeg" || $_FILES['files']['type'][$name]=="image/gif" || $_FILES['files']['type'][$name]=="image/jpg"){
																if(is_uploaded_file($_FILES['files']["tmp_name"][$name])){
																	$uploadMove=move_uploaded_file($_FILES['files']["tmp_name"][$name],$location);
											
																	if($uploadMove){
																		$newImage = mysqli_query($connect, "INSERT IGNORE INTO img (img_path, elan_id) VALUES ('$new_name', '$elan_id')");
																	} else {
																		$data["text"]="Şəkilin daşınması zamanı xəta yarandı. Yenidən cəhd edin!";
												
																		echo json_encode($data);
																	}
																} else {
																	$data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";
												
																	echo json_encode($data);
																}
															}
														}
													}                   
													
													mysqli_query($connect,"UPDATE elan SET elan_okno='$elan_no' WHERE elan_id ='$elan_id' AND elan_okno='ok' ");
													
													$data["ok"]="confirmation.php?id=".$elan_id."&action=confirm";
												
													echo json_encode($data);
												} else {
													$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
													echo json_encode($data);
												}
											}else {
												$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
												echo json_encode($data);
											}
										}
									}
                                } 
                            } else if($selectsubCategory == 67 || $selectsubCategory == 90){
								$controlSelectCity=controlSelect($selectCity, "Şəhər sahəsi");
                                if($controlSelectCity==true){
                                    $controlInputTitleElan=controlElanTitle($inputTitleElan, "Elanın adı", 2);
                                    if($controlInputTitleElan==true){
                                        $controlTextareaAdd=controlText($textareaAdd, "Məzmun sahəsi", 14);
                                        if($controlTextareaAdd==true){
                                            // create customers profile
                                            $addProfil = "INSERT IGNORE INTO customers (customer_id, customer_name, customer_email, customer_phone, customer_okno) VALUES ('$customer_rand_id', '$inputName', '$inputEmail', '$inputPhone', '$elan_ok')";

                                            if(mysqli_query($connect, $addProfil)){
                                                $customers2=mysqli_query($connect, "SELECT * FROM customers WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");
                                                $customer=mysqli_fetch_array($customers2);
                                                $customer_id=$customer["customer_id"];

                                                // create elan details
                                                $addElan = "INSERT IGNORE INTO elan (elan_id, elan_veren, elan_kateqoriya, elan_seher, elan_qiymet, elan_mezmun, customer_id, elan_raiting, elan_status, elan_name, elan_okno) VALUES ('$elan_rand_id', '$selectUser', '$selectsubCategory', '$selectCity', '$inputPrice', '$textareaAdd', '$customer_id', '$raiting', '$elan_status', '$inputTitleElan', '$elan_ok')";

                                                if(mysqli_query($connect, $addElan)){
                                                    mysqli_query($connect,"UPDATE customers SET customer_okno='$elan_no' WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");

                                                    $elanlar=mysqli_query($connect, "SELECT * FROM elan WHERE customer_id ='$customer_id' AND elan_okno='ok'");
                                                    $elan_item=mysqli_fetch_array($elanlar);
                                                    $elan_id=$elan_item["elan_id"];
                                                    $elan_kateqoriya=$elan_item["elan_kateqoriya"];

                                                    // veri parcalama islemi ve arraya atama islemi
                                                    $arrayForm=[];
                                                    $optionsQuery=mysqli_query($connect, "SELECT * FROM options WHERE subcategory_id ='$elan_kateqoriya' ");
                                                    while($options_item15=mysqli_fetch_array($optionsQuery)){
                                                        array_push($arrayForm, $options_item15["options_id"]);
                                                    }

                                                    // formdan gelen dizi
                                                    $optionss15=$_POST["optionsAdd"];

                                                    // insert elan_details                                                    
                                                    for($m=0; $m<count($optionss15); $m++){
                                                        mysqli_query($connect, "INSERT IGNORE INTO elan_detail (elan_id, options_id, elanDetail_value) VALUES ('$elan_id', '$arrayForm[$m]', '$optionss15[$m]')");
                                                    }


                                                    // upload multi images 
                                                    foreach ($_FILES['files']['name'] as $name => $valueFiles) { 
                                                                                                    
                                                        $file_name = explode(".", $_FILES['files']['name'][$name]);
                                                        $new_name = md5(rand()) . '.' . end($file_name); 
                                                        $max_size="10000000"; 
                                                        $location='../img/advert/'.$new_name; 
                                            
                                                        if($_FILES['files']['size'][$name] < $max_size){
                                                            if($_FILES['files']['type'][$name]=="image/png" || $_FILES['files']['type'][$name]=="image/jpeg" || $_FILES['files']['type'][$name]=="image/gif" || $_FILES['files']['type'][$name]=="image/jpg"){
                                                                if(is_uploaded_file($_FILES['files']["tmp_name"][$name])){
                                                                    $uploadMove=move_uploaded_file($_FILES['files']["tmp_name"][$name],$location);
                                            
                                                                    if($uploadMove){
                                                                        $newImage = mysqli_query($connect, "INSERT IGNORE INTO img (img_path, elan_id) VALUES ('$new_name', '$elan_id')");
                                                                    } else {
                                                                        $data["text"]="Şəkilin daşınması zamanı xəta yarandı. Yenidən cəhd edin!";
                                                
                                                                        echo json_encode($data);
                                                                    }
                                                                } else {
                                                                    $data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";
                                                
                                                                    echo json_encode($data);
                                                                }
                                                            }
                                                        }
                                                    }                   
                                                    
                                                    mysqli_query($connect,"UPDATE elan SET elan_okno='$elan_no' WHERE elan_id ='$elan_id' AND elan_okno='ok' ");
                                                    
                                                    $data["ok"]="confirmation.php?id=".$elan_id."&action=confirm";
                                                
                                                    echo json_encode($data);
                                                } else {
                                                    $data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
                                                    echo json_encode($data);
                                                }
                                            }else {
                                                $data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
                                                echo json_encode($data);
                                            }
                                        }
                                    }                                
                                }
							} else if($selectsubCategory == 80 || $selectsubCategory == 81 || $selectsubCategory == 82 || $selectsubCategory == 96 || $selectsubCategory == 114){
                                $controlSelectCity=controlSelect($selectCity, "Şəhər sahəsi");
                                if($controlSelectCity==true){
                                    $controlInputTitleElan=controlElanTitle($inputTitleElan, "Elanın adı", 2);
                                    if($controlInputTitleElan==true){
                                        $controlInputPrice=controlPrice($inputPrice, "Qiymət sahəsi");
										if($controlInputPrice==true){
											$controlTextareaAdd=controlText($textareaAdd, "Məzmun sahəsi", 14);
											if($controlTextareaAdd==true){
												// create customers profile
												$addProfil = "INSERT IGNORE INTO customers (customer_id, customer_name, customer_email, customer_phone, customer_okno) VALUES ('$customer_rand_id', '$inputName', '$inputEmail', '$inputPhone', '$elan_ok')";

												if(mysqli_query($connect, $addProfil)){
													$customers2=mysqli_query($connect, "SELECT * FROM customers WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");
													$customer=mysqli_fetch_array($customers2);
													$customer_id=$customer["customer_id"];

													// create elan details
													$addElan = "INSERT IGNORE INTO elan (elan_id, elan_veren, elan_kateqoriya, elan_seher, elan_qiymet, elan_mezmun, customer_id, elan_raiting, elan_status, elan_name, elan_okno) VALUES ('$elan_rand_id', '$selectUser', '$selectsubCategory', '$selectCity', '$inputPrice', '$textareaAdd', '$customer_id', '$raiting', '$elan_status', '$inputTitleElan', '$elan_ok')";

													if(mysqli_query($connect, $addElan)){
														mysqli_query($connect,"UPDATE customers SET customer_okno='$elan_no' WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");

														$elanlar=mysqli_query($connect, "SELECT * FROM elan WHERE customer_id ='$customer_id' AND elan_okno='ok'");
														$elan_item=mysqli_fetch_array($elanlar);
														$elan_id=$elan_item["elan_id"];


														// upload multi images 
														foreach ($_FILES['files']['name'] as $name => $valueFiles) { 
																										
															$file_name = explode(".", $_FILES['files']['name'][$name]);
															$new_name = md5(rand()) . '.' . end($file_name); 
															$max_size="10000000"; 
															$location='../img/advert/'.$new_name; 
												
															if($_FILES['files']['size'][$name] < $max_size){
																if($_FILES['files']['type'][$name]=="image/png" || $_FILES['files']['type'][$name]=="image/jpeg" || $_FILES['files']['type'][$name]=="image/gif" || $_FILES['files']['type'][$name]=="image/jpg"){
																	if(is_uploaded_file($_FILES['files']["tmp_name"][$name])){
																		$uploadMove=move_uploaded_file($_FILES['files']["tmp_name"][$name],$location);
												
																		if($uploadMove){
																			$newImage = mysqli_query($connect, "INSERT IGNORE INTO img (img_path, elan_id) VALUES ('$new_name', '$elan_id')");
																		} else {
																			$data["text"]="Şəkilin daşınması zamanı xəta yarandı. Yenidən cəhd edin!";
													
																			echo json_encode($data);
																		}
																	} else {
																		$data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";
													
																		echo json_encode($data);
																	}
																}
															}
														}                   
														
														mysqli_query($connect,"UPDATE elan SET elan_okno='$elan_no' WHERE elan_id ='$elan_id' AND elan_okno='ok' ");
														
														$data["ok"]="confirmation.php?id=".$elan_id."&action=confirm";
													
														echo json_encode($data);
													} else {
														$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
														echo json_encode($data);
													}
												}else {
													$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
													echo json_encode($data);
												}
											}
										}
                                    }                                
                                }
                            } else {
                                $controlSelectCity=controlSelect($selectCity, "Şəhər sahəsi");
                                if($controlSelectCity==true){
                                    $controlInputTitleElan=controlElanTitle($inputTitleElan, "Elanın adı", 2);
                                    if($controlInputTitleElan==true){
                                        $controlInputPrice=controlPrice($inputPrice, "Qiymət sahəsi");
										if($controlInputPrice==true){
											$controlTextareaAdd=controlText($textareaAdd, "Məzmun sahəsi", 14);
											if($controlTextareaAdd==true){
												// create customers profile
												$addProfil = "INSERT IGNORE INTO customers (customer_id, customer_name, customer_email, customer_phone, customer_okno) VALUES ('$customer_rand_id', '$inputName', '$inputEmail', '$inputPhone', '$elan_ok')";

												if(mysqli_query($connect, $addProfil)){
													$customers2=mysqli_query($connect, "SELECT * FROM customers WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");
													$customer=mysqli_fetch_array($customers2);
													$customer_id=$customer["customer_id"];

													// create elan details
													$addElan = "INSERT IGNORE INTO elan (elan_id, elan_veren, elan_kateqoriya, elan_seher, elan_qiymet, elan_mezmun, customer_id, elan_raiting, elan_status, elan_name, elan_okno) VALUES ('$elan_rand_id', '$selectUser', '$selectsubCategory', '$selectCity', '$inputPrice', '$textareaAdd', '$customer_id', '$raiting', '$elan_status', '$inputTitleElan', '$elan_ok')";

													if(mysqli_query($connect, $addElan)){
														mysqli_query($connect,"UPDATE customers SET customer_okno='$elan_no' WHERE customer_email ='$inputEmail' AND customer_okno='ok' ");

														$elanlar=mysqli_query($connect, "SELECT * FROM elan WHERE customer_id ='$customer_id' AND elan_okno='ok'");
														$elan_item=mysqli_fetch_array($elanlar);
														$elan_id=$elan_item["elan_id"];
														$elan_kateqoriya=$elan_item["elan_kateqoriya"];

														// veri parcalama islemi ve arraya atama islemi
														$arrayForm=[];
														$optionsQuery=mysqli_query($connect, "SELECT * FROM options WHERE subcategory_id ='$elan_kateqoriya' ");
														while($options_item15=mysqli_fetch_array($optionsQuery)){
															array_push($arrayForm, $options_item15["options_id"]);
														}

														// formdan gelen dizi
														$optionss15=$_POST["optionsAdd"];

														// insert elan_details                                                    
														for($m=0; $m<count($optionss15); $m++){
															mysqli_query($connect, "INSERT IGNORE INTO elan_detail (elan_id, options_id, elanDetail_value) VALUES ('$elan_id', '$arrayForm[$m]', '$optionss15[$m]')");
														}


														// upload multi images 
														foreach ($_FILES['files']['name'] as $name => $valueFiles) { 
																										
															$file_name = explode(".", $_FILES['files']['name'][$name]);
															$new_name = md5(rand()) . '.' . end($file_name); 
															$max_size="10000000"; 
															$location='../img/advert/'.$new_name; 
												
															if($_FILES['files']['size'][$name] < $max_size){
																if($_FILES['files']['type'][$name]=="image/png" || $_FILES['files']['type'][$name]=="image/jpeg" || $_FILES['files']['type'][$name]=="image/gif" || $_FILES['files']['type'][$name]=="image/jpg"){
																	if(is_uploaded_file($_FILES['files']["tmp_name"][$name])){
																		$uploadMove=move_uploaded_file($_FILES['files']["tmp_name"][$name],$location);
												
																		if($uploadMove){
																			$newImage = mysqli_query($connect, "INSERT IGNORE INTO img (img_path, elan_id) VALUES ('$new_name', '$elan_id')");
																		} else {
																			$data["text"]="Şəkilin daşınması zamanı xəta yarandı. Yenidən cəhd edin!";
													
																			echo json_encode($data);
																		}
																	} else {
																		$data["text"]="Yüklənmə zamanı xəta yarandı. Yenidən cəhd edin!";
													
																		echo json_encode($data);
																	}
																}
															}
														}                   
														
														mysqli_query($connect,"UPDATE elan SET elan_okno='$elan_no' WHERE elan_id ='$elan_id' AND elan_okno='ok' ");
														
														$data["ok"]="confirmation.php?id=".$elan_id."&action=confirm";
													
														echo json_encode($data);
													} else {
														$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
														echo json_encode($data);
													}
												}else {
													$data["text"]="Yükləmə zamanı xəta yarandı. Yenidən cəhd edin!";											
													echo json_encode($data);
												}
											}
										}
                                    }                                
                                }
                            }
                        }
                    }
                }
            }
        }

        mysqli_close($connect);
    }
?>