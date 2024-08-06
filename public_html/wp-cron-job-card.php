<?php 

require_once("admin/config.php");

require_once('admin/classes/sendMailChkClass.php');


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$send = new sendMails(true);

//$send = new sendMails(true);

echo "Today date = ".date("Y-m-d");
$today = date("Y-m-d");


$updateSQL = "INSERT INTO `cron_job_3_status`(`status`,`created_date`) VALUES ('Started','$today')";
$DBC->query($updateSQL);

if (mysqli_connect_error()) {
    echo "Database not connected!";
    $updateSQL = "UPDATE `cron_job_3_status` SET `status`='Error',`error`='Database not connected' WHERE `created_date`='$today'";
    $DBC->query($updateSQL);
} else {
    
    echo "<br><br>Checking all cards....<br>";
     
    $sql = "SELECT * FROM place_order_card WHERE razorpay_payment_status=1 AND completed=1 AND isNew=1 ";
    
    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);
    
    if($count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
             
            $created_date = $row['created_date'];
            $dateTimePuc = new DateTime($created_date);
            $purchaseData = $dateTimePuc->format("Y-m-d");
            $exp_date = $row['exp_date'];
            $currentDate = date("Y-m-d");
            $purchaseID = $row['id'];
            $user_id = $row['user_id'];
            $card_id = $row['card_id'];
            $sqlcard = "SELECT a.*,b.CardName  FROM tblsubcards a left join tbl_cards b on a.card_id=b.id WHERE a.id='$card_id' ";
            $resultcart = $DBC->query($sqlcard);
            $cartItemsArr = mysqli_fetch_assoc($resultcart);
            
            $sqlU = "SELECT b.*,c.short_name,a.firstname,a.lastname,a.email FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 
            $UserList = $DBC->query($sqlU);
            $UserList = mysqli_fetch_assoc($UserList);
            
            $eventUser = $UserList['firstname']." ".$UserList['lastname'];
            $eventUserEmail = $UserList['email'];
            
             // Define the target date (e.g., 2025-01-19)
            $targetDate = new DateTime($exp_date);
            
            // Get the current date
            $currentDateExp = new DateTime();
            
            // Calculate the difference in days
            $interval = $currentDateExp->diff($targetDate);
            $numberOfDays = $interval->days;
            $numberOfDays = $numberOfDays + 1;
            $cardNumber = $row['card_number'];
            $cardNumber = chunk_split($cardNumber, 4, ' ');
          
            
            
            $loopStop = true;
            $loopStopCount = 0;
            for($i=1;$loopStop;$i++){
                
                $getMonth = $i*3;
                
                // Convert to DateTime object
                $dateCTime = new DateTime($created_date);
                
                $dateCTime->add(new DateInterval("P".$getMonth."M"));
                // Get the result in the desired format
                $aftermonthDate = $dateCTime->format('Y-m-d');
              
                if (strtotime($exp_date) <= strtotime($aftermonthDate)) {
                    //For expired mail
                    
                    
                    if ($aftermonthDate === $currentDate) {
                        
                        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=13 AND mail_template=95 AND `active`=1 ";
                        
                        $mailTemplate = $dbc->get_rows($sqlM);
    
                        //send mail here
                        $subject = $mailTemplate[0]['subject'];
                     
                        $html = $mailTemplate[0]['mail_body'];
                       
                        $html = str_replace("--username",$eventUser,$html);
                        $html = str_replace("--card_number",$cardNumber,$html);
                        $html = str_replace("--exp_date",$row['exp_date'],$html);
                        $html = str_replace("--purchase_date",$purchaseData,$html);
                        $html = str_replace("--card_validity",$cartItemsArr['exp'],$html);
                        $html = str_replace("--card_benfits",$cartItemsArr['description'],$html);
                        $html = str_replace("--card_name",$cartItemsArr['CardName'],$html);
                       
                        $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
                        echo "mail send";
                        
                      
                        
                    }
                    
                    
                    
                    
                    
                    $loopStopCount++;
                    if($loopStopCount == 12)$loopStop = false;
                    
                } else {
                    //For expiring mail
                    
                    if ($aftermonthDate === $currentDate) {
                        echo $aftermonthDate . ' is equal to today.';
                        echo "<br>";
                        
                        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=13 AND mail_template=94 AND `active`=1 ";
                        
                        $mailTemplate = $dbc->get_rows($sqlM);
    
                        //send mail here
                        $subject = $mailTemplate[0]['subject'];
                     
                        $html = $mailTemplate[0]['mail_body'];
                       
                        $html = str_replace("--username",$eventUser,$html);
                        $html = str_replace("--card_number",$cardNumber,$html);
                        $html = str_replace("--exp_date",$row['exp_date'],$html);
                        $html = str_replace("--purchase_date",$purchaseData,$html);
                        $html = str_replace("--card_validity",$cartItemsArr['exp'],$html);
                        $html = str_replace("--card_benfits",$cartItemsArr['description'],$html);
                        $html = str_replace("--card_name",$cartItemsArr['CardName'],$html);
                        $html = str_replace("--number_of_day",$numberOfDays,$html);
                        $html = str_replace("--more_info",'',$html);
                      
                        $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
                        echo "mail send";
                       
                        
                    }
                }
                
                
             
                
            }
            
            
            //sent 20,10,5 days expiring mail
            $sendMail=false;
            
            $dateTimePrv5 = new DateTime($exp_date);
            // Subtract 5 days
            $dateTimePrv5->modify('-5 days');
            $previousDate = $dateTimePrv5->format('Y-m-d');
            if ($previousDate === $currentDate) {
                $sendMail=true;
            }
            
            $dateTimePrv10 = new DateTime($exp_date);
            // Subtract 10 days
            $dateTimePrv10->modify('-10 days');
            $previousDate1 = $dateTimePrv10->format('Y-m-d');
            if ($previousDate1 === $currentDate) {
                $sendMail=true;
            }
            
            $dateTimePrv20 = new DateTime($exp_date);
            // Subtract 20 days
            $dateTimePrv20->modify('-20 days');
            $previousDate2 = $dateTimePrv20->format('Y-m-d');
            if ($previousDate2 === $currentDate) {
                $sendMail=true;
            }
            
            if($sendMail){
                
                $moreInfo = '';
                
                
                $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=13 AND mail_template=94 AND `active`=1 ";
                        
                $mailTemplate = $dbc->get_rows($sqlM);

                //send mail here
                $subject = $mailTemplate[0]['subject'];
             
                $html = $mailTemplate[0]['mail_body'];
               
                $html = str_replace("--username",$eventUser,$html);
                $html = str_replace("--card_number",$cardNumber,$html);
                $html = str_replace("--exp_date",$row['exp_date'],$html);
                $html = str_replace("--purchase_date",$purchaseData,$html);
                $html = str_replace("--card_validity",$cartItemsArr['exp'],$html);
                $html = str_replace("--card_benfits",$cartItemsArr['description'],$html);
                $html = str_replace("--card_name",$cartItemsArr['CardName'],$html);
                $html = str_replace("--number_of_day",$numberOfDays,$html);
                $html = str_replace("--more_info",$moreInfo,$html);
              
                $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
                echo "mail send";
                
               
                
            }
            
          
        }
    
        
    }
    
    $updateSQL = "UPDATE `cron_job_3_status` SET `status`='Success' WHERE `created_date`='$today'";
    $DBC->query($updateSQL);
    

}




?>