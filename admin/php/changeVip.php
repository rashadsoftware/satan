<?php
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

    require 'vendor/phpmailer/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
		
	require "vendor/autoload.php";
	
	if(isset($_POST["action"])){
        		
		include("../include/connectDB.php");

        $elanStatus="vip";
		
        $data=array();

        $elanTime=date('Y-m-d H:i:s');
        $deadlineTime=strtotime("+1 month");
        $dealdline=date('Y-m-d H:i:s', $deadlineTime);
        
        $updateCity=mysqli_query($connect,"UPDATE elan SET elan_raiting='$elanStatus', elan_time='$elanTime' WHERE elan_id = '".$_POST["idElan"]."' AND elan_status='active' ");        

        if($updateCity){    
            $updateDeadlineCreate=mysqli_query($connect,"UPDATE deadline SET deadline_time='$dealdline' WHERE elan_id = '".$_POST["idElan"]."' ");
            
            if($updateDeadlineCreate){

                $elanlar_list = mysqli_query($connect, "SELECT * FROM elan WHERE elan_id='".$_POST["idElan"]."'" );
                $elanlar=mysqli_fetch_array($elanlar_list);
                $customerID=$elanlar['customer_id'];

                $company_list = mysqli_query($connect, "SELECT * FROM companies WHERE company_status='main' " );
                $company=mysqli_fetch_array($company_list);

                $customer_list = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id='$customerID' " );
                $customer=mysqli_fetch_array($customer_list);

                $customer_email=$customer['customer_email'];
                $customer_name=$customer['customer_name'];

                $subject=$elanlar['elan_name']." - elanınız VIP oldu";

                $mail_body="Hörmətli ".$customer_name.", <br>";
                $mail_body.="Sizin <a href='satan.az'>".$company['company_name']."</a> saytında yerləşdirdiyiniz <b>".$elanlar['elan_name']."</b> elanı VIP oldu <br>";
                $mail_body.="Hörmətlə, ".$company['company_name']." komandası"; 

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();                                         
                    $mail->Host       		= 'smtp.gmail.com';  				
                    $mail->SMTPAuth  		= true;                             
                    $mail->Username   		= 'rashadalalakbarov@gmail.com';    
                    $mail->Password   		= 'seadet123';                   
                    $mail->CharSet   		= 'utf8';                           
                    $mail->SMTPSecure 		= 'tls';                           
                    $mail->Port       		= 587;                              
        
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );

                    //Recipients
                    $mail->setFrom("rashadalalakbarov@gmail.com", "Rashad");
                    $mail->addAddress($customer_email, $customer_name);     // Add a recipient
        
                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $mail_body;
        
                    if($mail->send()){
                        $data["ok"]="ok";
                        $data["text"]="Elanınınz VİP oldu və mesaj başarılı şəkildə istifadəçiyə göndərildi";
                        
                        echo json_encode($data);
                    } else {
                        $data["type"]="alert-danger";
                        $data["text"]=$mail->ErrorInfo;
                        
                        echo json_encode($data);
                    }
                } catch (Exception $e) {
                    $data["type"]="alert-danger";
                    $data["text"]=$mail->ErrorInfo;
                    
                    echo json_encode($data);
                }
            } else {
                $data["text"]="Bağlantı zamanı xəta yarandı. Yenidən cəhd edin.";
            
                echo json_encode($data);
            }
        } else {
            $data["text"]="Çevrilmə zamanı xəta yarandı. Yenidən cəhd edin!";
                            
            echo json_encode($data);
        }
        
        mysqli_close($connect);
	}
	
?>