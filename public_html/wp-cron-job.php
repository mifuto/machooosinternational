<?php 

require_once("admin/config.php");

require_once('admin/classes/sendMailChkClass.php');


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$send = new sendMails(true);

//$send = new sendMails(true);

echo "Today date = ".date("Y-m-d");
$today = date("Y-m-d");

$updateSQL = "INSERT INTO `cron_job_2_status`(`status`,`created_date`) VALUES ('Started','$today')";
$DBC->query($updateSQL);

$date = new DateTime($today);

// Add one day to the date
$date->add(new DateInterval('P1D'));

// Format the next date as 'Y-m-d'
$nextDate = $date->format('Y-m-d');

echo "<br><br>";

echo "Next date: " . $nextDate;

// Convert the date string to a timestamp
$timestamp = strtotime($nextDate);

// Extract the day and month
$day = date('d', $timestamp);
$month = date('m', $timestamp);
$cyr = date('Y', $timestamp);




if (mysqli_connect_error()) {
    echo "Database not connected!";
    $updateSQL = "UPDATE `cron_job_2_status` SET `status`='Error',`error`='Database not connected' WHERE `created_date`='$today'";
    $DBC->query($updateSQL);
} else {

  
    echo "<br><br>Checking all events....<br><br><br>";

  
    $sql = "SELECT a.name, a.start_date, a.clientid ,b.firstname , b.lastname, b.email, b.phonenumber FROM tblprojects a left join tblcontacts b on a.clientid = b.userid where MONTH(a.start_date) = $month AND DAY(a.start_date) = $day ";
    
    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);
    if($count > 0) {		
        while ($row = mysqli_fetch_assoc($result)) {
           
            $name = $row['name'];
            $start_date = $row['start_date'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            
            $eventUser = $firstname." ".$lastname;
            $eventUserEmail = $email;
            
            $isSendMail = true;
            echo $firstname." ".$lastname."  => ".$name."  ".$start_date;
            echo " <br>";
            
            // Convert the date string to a timestamp
            $timestamp1 = strtotime($start_date);
            $pyr = date('Y', $timestamp1);
            
            $yearAgo = intval($cyr) - intval($pyr);
            
            
            if($yearAgo > 0){
                
            
    
                if (stripos($name, "Architect photography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=24 AND `active`=1 ";
                } else if (stripos($name, "Baptism") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=25 AND `active`=1 ";
                }else if (stripos($name, "Betrothal") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=26 AND `active`=1 ";
                }else if (stripos($name, "Birthday") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=27 AND `active`=1 ";
                }else if (stripos($name, "Bride to be") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=28 AND `active`=1 ";
                }else if (stripos($name, "Childhoodphotography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=29 AND `active`=1 ";
                }else if (stripos($name, "Christening") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=30 AND `active`=1 ";
                }else if (stripos($name, "Corporate events") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=31 AND `active`=1 ";
                }else if (stripos($name, "Corporate Photography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=32 AND `active`=1 ";
                }else if (stripos($name, "Dhakshina") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=33 AND `active`=1 ";
                }else if (stripos($name, "Engagement") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=34 AND `active`=1 ";
                }else if (stripos($name, "Exterior") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=35 AND `active`=1 ";
                }else if (stripos($name, "Haldi") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=36 AND `active`=1 ";
                }else if (stripos($name, "Interior") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=37 AND `active`=1 ";
                }else if (stripos($name, "Maternityshoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=38 AND `active`=1 ";
                }else if (stripos($name, "Mehandi") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=39 AND `active`=1 ";
                }else if (stripos($name, "Newborn baby shoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=40 AND `active`=1 ";
                }else if (stripos($name, "Postwedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=41 AND `active`=1 ";
                }else if (stripos($name, "Prewedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=42 AND `active`=1 ";
                }else if (stripos($name, "ProductPhotography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=43 AND `active`=1 ";
                }else if (stripos($name, "Reception") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=44 AND `active`=1 ";
                }else if (stripos($name, "Wedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=45 AND `active`=1 ";
                }else if (stripos($name, "Fashion") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=46 AND `active`=1 ";
                }else if (stripos($name, "modeling") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=47 AND `active`=1 ";
                }else if (stripos($name, "addshoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=48 AND `active`=1 ";
                }else if (stripos($name, "Album song and documentary shoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=49 AND `active`=1 ";
                }else if (stripos($name, "house warming") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=7 AND mail_template=50 AND `active`=1 ";
                }
                
                else{
                    $isSendMail = false;
                    echo "no mail template";
                }
                
                if($isSendMail){
                    $mailTemplate = $dbc->get_rows($sqlM);
    
                    //send mail here
                    $subject = $mailTemplate[0]['subject'];
    
                    $html = $mailTemplate[0]['mail_body'];
                   
                    $html = str_replace("--username",$eventUser,$html);
                    $html = str_replace("--project_name",$name,$html);
                    $html = str_replace("--passed_year_count",$yearAgo,$html);
                    $html = str_replace("--actual_event_date",$start_date,$html);
                  
                    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
                    echo "mail send";
                }
            }else{
                echo "event date is today <br>";
                
                
                if (stripos($name, "Architect photography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=51 AND `active`=1 ";
                } else if (stripos($name, "Baptism") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=52 AND `active`=1 ";
                }else if (stripos($name, "Betrothal") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=53 AND `active`=1 ";
                }else if (stripos($name, "Birthday") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=54 AND `active`=1 ";
                }else if (stripos($name, "Bride to be") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=55 AND `active`=1 ";
                }else if (stripos($name, "Childhoodphotography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=56 AND `active`=1 ";
                }else if (stripos($name, "Christening") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=57 AND `active`=1 ";
                }else if (stripos($name, "Corporate events") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=58 AND `active`=1 ";
                }else if (stripos($name, "Corporate Photography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=59 AND `active`=1 ";
                }else if (stripos($name, "Dhakshina") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=60 AND `active`=1 ";
                }else if (stripos($name, "Engagement") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=61 AND `active`=1 ";
                }else if (stripos($name, "Exterior") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=62 AND `active`=1 ";
                }else if (stripos($name, "Haldi") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=63 AND `active`=1 ";
                }else if (stripos($name, "Interior") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=64 AND `active`=1 ";
                }else if (stripos($name, "Maternityshoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=65 AND `active`=1 ";
                }else if (stripos($name, "Mehandi") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=66 AND `active`=1 ";
                }else if (stripos($name, "Newborn baby shoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=67 AND `active`=1 ";
                }else if (stripos($name, "Postwedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=68 AND `active`=1 ";
                }else if (stripos($name, "Prewedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=69 AND `active`=1 ";
                }else if (stripos($name, "ProductPhotography") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=70 AND `active`=1 ";
                }else if (stripos($name, "Reception") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=71 AND `active`=1 ";
                }else if (stripos($name, "Wedding") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=72 AND `active`=1 ";
                }else if (stripos($name, "Fashion") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=73 AND `active`=1 ";
                }else if (stripos($name, "modeling") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=74 AND `active`=1 ";
                }else if (stripos($name, "addshoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=75 AND `active`=1 ";
                }else if (stripos($name, "Album song and documentary shoot") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=76 AND `active`=1 ";
                }else if (stripos($name, "house warming") !== false) {
                    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=8 AND mail_template=77 AND `active`=1 ";
                }
                
                else{
                    $isSendMail = false;
                    echo "no mail template";
                }
                
                if($isSendMail){
                    $mailTemplate = $dbc->get_rows($sqlM);
    
                    //send mail here
                    $subject = $mailTemplate[0]['subject'];
    
                    $html = $mailTemplate[0]['mail_body'];
                   
                    $html = str_replace("--username",$eventUser,$html);
                    $html = str_replace("--project_name",$name,$html);
                    $html = str_replace("--actual_event_date",$start_date,$html);
                  
                    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
                    echo "mail send";
                }
                
                
                
                
                
                
                
                
            }
            
            
            
            echo "     \n   <br> <br><br>";
            

          
        }
    }
    
   
    
    $updateSQL = "UPDATE `cron_job_2_status` SET `status`='Success' WHERE `created_date`='$today'";
    $DBC->query($updateSQL);


    






}




?>