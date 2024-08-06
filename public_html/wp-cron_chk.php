<?php 

require_once("admin/config.php");

require_once('admin/classes/sendMailChkClass.php');


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$send = new sendMails(true);

//$send = new sendMails(true);

echo "Today date = ".date("Y-m-d");
$today = date("Y-m-d");

// $updateSQL = "INSERT INTO `cron_job_status`(`status`,`created_date`) VALUES ('Started','$today')";
// $DBC->query($updateSQL);




if (mysqli_connect_error()) {
    echo "Database not connected!";
    // $updateSQL = "UPDATE `cron_job_status` SET `status`='Error',`error`='Database not connected' WHERE `created_date`='$today'";
    // $DBC->query($updateSQL);
} else {

  
    echo "<br><br>Checking all online albums....<br>";

    //Online album

    $sql = "SELECT ev.*, ct.firstname, ct.lastname , ct.email FROM tbevents_data as ev 
		LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id
		WHERE ev.deleted=0 ORDER BY ev.id DESC";
    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);
    if($count > 0) {		
        while ($row = mysqli_fetch_assoc($result)) {
           
            $user_id = $row['user_id'];
            $expiry_date=date_create($row['expiry_date']);
            $diff=date_diff(date_create($today),$expiry_date);
            $R = $diff->format("%R");
            $a = $diff->format("%a"); //no of day
            $expiry_day = $a;
            $sntMail = false;
          
            if($R == '+'){
                if($a == 0){
                    $expiry_day = "today";
                    $sntMail = true;
                }else{
                    
                    $abc = array(1, 3, 6, 10, 20 , 28);
                    if( in_array($a, $abc) ) $sntMail = true;
                }
               
                $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=1 AND mail_template=3 AND `active`=1 ";
                
            }else{
                $abc = array(1, 3, 6, 10, 20 , 28);
                if( in_array($a, $abc) ) $sntMail = true;
             
               $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=1 AND mail_template=2 AND `active`=1 ";
            }
            
            // $sntMail = true;

            if($sntMail){
                $mailTemplate = $dbc->get_rows($sqlM);

                //send mail here
                $subject = $mailTemplate[0]['subject'];

                $sql1 = "SELECT firstname, lastname, email FROM `tblcontacts` WHERE id=$user_id ";
                $userList = $dbc->get_rows($sql1);
                $eventUser = $userList[0]['firstname']." ".$userList[0]['lastname'];
                $eventUserEmail = $userList[0]['email'];

                $html = $mailTemplate[0]['mail_body'];
                if($row['album_type'] == 1) $atv = "Portraits Album";
                else $atv = "Landscape album";

                $html = str_replace("--username",$eventUser,$html);
                $html = str_replace("--event_name",$row['event_name'],$html);
                $html = str_replace("--venue",$row['venue'],$html);
                $html = str_replace("--event_dt",$row['event_date'],$html);
                $html = str_replace("--description",$row['description'],$html);
                $html = str_replace("--album_type",$atv,$html);
                $html = str_replace("--upload_dt",$row['upload_date'],$html);
                $html = str_replace("--expiry_dt",$row['expiry_date'],$html);
                $html = str_replace("--days",$expiry_day,$html);
                
                
                print_r($html);
                echo '<br>';

                // $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );

            }

          
        }
    }
    
    echo "<br>Online albums checking completed....<br>";

    echo "<br>Checking all Signature albums....<br>";
    // // Signature album
    $sql1 = "SELECT ev.*, ct.firstname, ct.lastname , ct.email FROM tbesignaturealbum_projects as ev 
    LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id
    WHERE ev.deleted=0 ORDER BY ev.id DESC";
    $result1 = $DBC->query($sql1);
    $count1 = mysqli_num_rows($result1);
    if($count1 > 0) {		
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $user_id1 = $row1['user_id'];
          
            $expiry_date=date_create($row1['expiry_date']);
            $diff=date_diff(date_create($today),$expiry_date);

            $R = $diff->format("%R");
            $a = $diff->format("%a"); //no of day
            $expiry_day1 = $a;
            $sntMail1 = false;

            if($R == '+'){
                // Expiring
                if($a == 0){
                    $expiry_day1 = "today";
                    $sntMail1 = true;
                }else{
                    
                    $abc = array(1, 3, 6, 10, 20 , 28);
                    if( in_array($a, $abc) ) $sntMail1 = true;
                }
               
                $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=2 AND mail_template=7 AND `active`=1 ";


                
            }else{
                // Expired
                $abc = array(1, 3, 6, 10, 20 , 28);
                if( in_array($a, $abc) ) $sntMail1 = true;
             
               $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=2 AND mail_template=6 AND `active`=1 ";
            }




            if($sntMail1){
                $mailTemplate1 = $dbc->get_rows($sqlM);

                //send mail here
                $subject = $mailTemplate1[0]['subject'];

                $sqlU = "SELECT firstname, lastname, email FROM `tblcontacts` WHERE id=$user_id1 ";
                $userList = $dbc->get_rows($sqlU);
                $eventUser = $userList[0]['firstname']." ".$userList[0]['lastname'];
                $eventUserEmail = $userList[0]['email'];

                $html = $mailTemplate1[0]['mail_body'];

                $html = str_replace("--username",$eventUser,$html);
                $html = str_replace("--project_name",$row1['project_name'],$html);
                $html = str_replace("--token",$row1['token'],$html);
                $html = str_replace("--expiry_dt",$row1['expiry_date'],$html);
                $html = str_replace("--days",$expiry_day1,$html);
                
                print_r($html);
                echo '<br>';

                // $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );

            }

          

        }
    }
    
    echo "<br>Signature albums checking completed....<br>";
    
    
    
    
    
    // $updateSQL = "UPDATE `cron_job_status` SET `status`='Success' WHERE `created_date`='$today'";
    // $DBC->query($updateSQL);


    






}




?>