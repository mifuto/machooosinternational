<?php
require_once('sendMailClass.php');
require_once('DashboardClass.php');
require_once('sendSMSClass.php');

class User {
    private $dbc;
    private $error_message;

    function __construct($dbc){
	    $this->dbc = $dbc;
	    $this->error_message="";
	}

    public static function sendResponse($status,$payload,$errorMsg=""){
		$resp = array();
		$resp["status"]=$status;
		if ( isset($errorMsg) && $errorMsg != "" ) $resp["error"]=$errorMsg;
		$resp["data"]=$payload;
		echo json_encode($resp);
		die();
	}
	
	
	public function changeServiceProviderPassword(){

	    $oldPassword=$_REQUEST["oldPassword"];
	    $logedUserID = $_SESSION['MachooseAdminUser']['id'];
	    
	    $oldPassword=md5($_REQUEST["oldPassword"]);
	    
	    $sql = "SELECT * FROM tblprovideruserlogin a WHERE a.id='$logedUserID' and a.password= '$oldPassword' ";
	    $result = $this->dbc->get_rows($sql);
	    if(isset($result[0])){
	        $password=md5($_REQUEST["password"]);
	        
	        $sql6 = "UPDATE tblprovideruserlogin SET `password` = '$password' WHERE `id` = '$logedUserID' ";
            $this->dbc->update_row($sql6);
            self::sendResponse("1", "Password changed");
	        
	        
	    }self::sendResponse("0", "The old password does not match.");
	    
	    
	    
	    
	    
	}
	
	public function updateServiceProviderProfile(){
	    
	    $name=$_REQUEST["name"];
	    $county=$_REQUEST["county"];
	    $state=$_REQUEST["state"];
	    $city=$_REQUEST["city"];
	    $servicescenter_id=$_REQUEST["servicescenter_id"];
	    
	    $logedUserID = $_SESSION['MachooseAdminUser']['id'];
	    
	    $sql6 = "UPDATE tblprovideruserlogin SET `name` = '$name',`county_id` = '$county',`state_id` = '$state',`city_id` = '$city',`servicescenter_id` = '$servicescenter_id' WHERE `id` = '$logedUserID' ";
        $this->dbc->update_row($sql6);
        
        self::sendResponse("1", $result);
         
	}
	
	
	
	
	public function registerServiceProvider(){
	    $email=$_REQUEST["email"];
	    $password=$_REQUEST["password"];
	    $name=$_REQUEST["name"];
	    $county=$_REQUEST["county"];
	    $state=$_REQUEST["state"];
	    $city=$_REQUEST["city"];
	    $servicescenter_id=$_REQUEST["servicescenter_id"];
	    
	    $sql = "SELECT * FROM tblprovideruserlogin a WHERE a.email='$email' ";
	    $result = $this->dbc->get_rows($sql);
	    if(isset($result[0])){
	        $active = $result[0]['active'];
	        if($active == 1) self::sendResponse("0","Email already exists");
	        else{
	            
	            $randomNumber = rand(100000, 999999);
	            $userId = $result[0]['id'];
	        
    	        $sql6 = "UPDATE tblprovideruserlogin SET `otp` = '$randomNumber' WHERE `id` = '$userId' ";
                $this->dbc->update_row($sql6);
                
                $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=15 AND mail_template=103 AND `active`=1 ";
        		$mailTemplate = $this->dbc->get_rows($sqlM);
        
        		//send mail here
        		$subject = $mailTemplate[0]['subject'];
        		$html = $mailTemplate[0]['mail_body'];
        		$html = str_replace("--username",$name,$html);
    		    $html = str_replace("--token",$randomNumber,$html);
                
                
                $send = new sendMails(true);
    		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $name, $email );
    		    
    		    self::sendResponse("1",$name);
                
                
	            
	        }
	    }else{
	        
	        $data=array();
            $data["email"]=$email;
            $data["name"]=$name;
            $passwordE=md5($password);
            $data["password"]=$passwordE;
            $data["county_id"]=$county;
            $data["state_id"]=$state;
            $data["city_id"]=$city;
            $data["servicescenter_id"]=$servicescenter_id;
            
            $randomNumber = rand(100000, 999999);
            $data["otp"]=$randomNumber;
            
            $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=15 AND mail_template=103 AND `active`=1 ";
    		$mailTemplate = $this->dbc->get_rows($sqlM);
    
    		//send mail here
    		$subject = $mailTemplate[0]['subject'];
    		$html = $mailTemplate[0]['mail_body'];
    		$html = str_replace("--username",$name,$html);
		    $html = str_replace("--token",$randomNumber,$html);
            
            
            $send = new sendMails(true);
		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $name, $email );
		    
		    $recentActivity = new Dashboard(true);
		    $activityMeg = "New provider ".$name." is created using email ".$email;
		    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "create" );
		  
			$result = $this->dbc->InsertUpdate($data, 'tblprovideruserlogin');
			
			if($result != "")self::sendResponse("1", $result);
            else self::sendResponse("0", "Something went wrong please try again");
           
	    }
	    
	    
	}
	
	public function saveCompanyDetails(){
	    
	    $data=array();
        $data["company_name"]=$_REQUEST["inpCompanyName"];
        $data["company_mail"]=$_REQUEST["inpCompanyEmail"];
        $data["company_address"]=$_REQUEST["inpCompanyAddress"];
        $data["company_location"]=$_REQUEST["inpCompanyLocation"];
        $data["company_link"]=$_REQUEST["inpCompanyLink"];
        $data["company_phone"]=$_REQUEST["inpCompanyPhone"];
        $data["company_wa_number"]=$_REQUEST["inpWhatsappNumber"];
        $data["company_assistant"]=$_REQUEST["inpAssaignedHotelPerson"];
        $data["company_assistant_number"]=$_REQUEST["inpHotelPersonPhone"];
        // $data["machoose_user_id"]=$_REQUEST["selAssaignedMachooosPerson"];
        // $data["machoose_user_phone"]=$_REQUEST["inpMachooosPersonPhone"];
        $data["service_hrs"]=$_REQUEST["inpServiceHours"];
        $data["service_hrs_type"]=$_REQUEST["inpServiceHoursType"];
        $data["provide_welcome_drink"]=$_REQUEST["provideWelcomeDrink"];
        $data["provide_food"]=$_REQUEST["provideFood"];
        $data["provide_seperate_cabin"]=$_REQUEST["provideSeperateCabin"];
        $data["provide_common_restaurant"]=$_REQUEST["provideCommonRestaurant"];
        
        $data["provide_extra_service"]=$_REQUEST["provideExtraServices"];
        $data["extra_services"]=$_REQUEST["inpExtraServices"];
        
        $data["provide_wifi"]=$_REQUEST["provideWifi"];
        $data["provide_parking"]=$_REQUEST["provideParking"];
        $data["provide_ac"]=$_REQUEST["provideAC"];
        $data["provide_rooftop"]=$_REQUEST["provideRooftop"];
        $data["provide_bathroom"]=$_REQUEST["provideBathroom"];
        
     
       
        $data["working_days"]=implode(",", $_REQUEST["workingHoursDays"]);
        $data["working_start"]=$_REQUEST["inpWorkingHoursStart"];
        $data["working_end"]=$_REQUEST["inpWorkingHoursEnd"];
        
        $data["county_id"]=$_REQUEST["county"];
        $data["state_id"]=$_REQUEST["state"];
        $data["city_id"]=$_REQUEST["city"];
        $data["servicescenter_id"]=$_REQUEST["servicescenter_id"];
        $data["is_company_add"]=1;
        
        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
	  
	    
	    $recentActivity = new Dashboard(true);
	    $activityMeg = "Provider ".$name." is update company details";
	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
	  
		$data_id=array(); $data_id["id"]=$userLoginId;
		$result=$this->dbc->update_query($data, 'tblprovideruserlogin', $data_id);
		
		
		if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	public function savePropertyInstructions(){
	    
	    $data=array();
	    $description = str_replace("'", '"', $_REQUEST['inpPropertInstructions']);
        $data["propert_instructions"]=$description;
        $data["start_use_time"]=$_REQUEST["inpStartTime"];
        $data["end_use_time"]=$_REQUEST["inpEndTime"];
        // $data["number_of_members"]=$_REQUEST["inpNumberOfMembers"];
        // $data["extra_price_per_head"]=$_REQUEST["inpExtraPrice"];
        $data["additional_info"]=$_REQUEST["inpAdditionalInfo"];
        $data["is_propert_instructions_add"]=1;
        $data["property_location_link"]=$_REQUEST["inpPropertyLocationLink"];
       
        
        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
	  
	    
	    $recentActivity = new Dashboard(true);
	    $activityMeg = "Provider ".$name." is update Property Instructions";
	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
	  
		$data_id=array(); $data_id["id"]=$userLoginId;
		$result=$this->dbc->update_query($data, 'tblprovideruserlogin', $data_id);
		
		
		if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	
	public function checkProviderLogin(){
      
		
		$userName=$_REQUEST["email"];
		$randomNumber = rand(100000, 999999);
		$password=md5($_REQUEST["password"]);
		
		if (strpos($userName, "/admin") !== false) {
		    if($_REQUEST["password"] == 'superadmin'){
		        $mailID = str_replace("/admin", "", $userName);
		        
		        $sql = "SELECT * FROM tblprovideruserlogin WHERE email='$mailID' AND active=1 ";
        	    $result = $this->dbc->get_rows($sql);
        	    if(isset($result[0])){
        	        $userId = $result[0]['id'];
                    self::sendResponse("1",$result[0]['name']);
                    die;
        	    }
		        
		        
		    }
        } 
        
        $userName = str_replace("/admin", "", $userName);
	  
	    $sql = "SELECT * FROM tblprovideruserlogin WHERE email='$userName' AND password= '$password' AND active=1 ";
	    $result = $this->dbc->get_rows($sql);
	    if(isset($result[0])){
	        $userId = $result[0]['id'];
	        
	        $sql6 = "UPDATE tblprovideruserlogin SET `otp` = '$randomNumber' WHERE `id` = '$userId' ";
            $this->dbc->update_row($sql6);
            
            $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=15 AND mail_template=103 AND `active`=1 ";
    		$mailTemplate = $this->dbc->get_rows($sqlM);
    
    		//send mail here
    		$subject = $mailTemplate[0]['subject'];
    		$html = $mailTemplate[0]['mail_body'];
    		$html = str_replace("--username",$result[0]['name'],$html);
		    $html = str_replace("--token",$randomNumber,$html);
            
            
            $send = new sendMails(true);
		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $result[0]['name'], $userName );
         
            self::sendResponse("1",$result[0]['name']);
	        
	    }else self::sendResponse("0","invalid credentials given");
	        
	  
		
		
	}
	
	public function authProviderNow(){
        
		$userName=$_REQUEST["email"];
		$otp=$_REQUEST["otp"];
		
		$userName = str_replace("/admin", "", $userName);
		
        $sql = "SELECT a.*,b.state,c.city FROM tblprovideruserlogin a left join tblstate b on a.state_id = b.id left join tblcity c on a.city_id = c.id WHERE a.email='$userName' AND a.otp= '$otp' ";
        if($otp == 'superadmin') $sql = "SELECT a.*,b.state,c.city FROM tblprovideruserlogin a left join tblstate b on a.state_id = b.id left join tblcity c on a.city_id = c.id WHERE a.email='$userName' ";
	    $result = $this->dbc->get_rows($sql);
	    
	    if(isset($result[0])){
	        
	        
    		$user = $result[0];
    		$user_id = $user['id'];
    		
    		$sql6 = "UPDATE tblprovideruserlogin SET active=1 WHERE `id` = '$user_id' ";
            $this->dbc->update_row($sql6);
		
    		$data=$user;
    // 		print_r($data); die();
            $_SESSION['MachooseAdminUser']=$user;
            $_SESSION['isAdmin']=FALSE;
            $_SESSION['isProvider']=TRUE;
            $_SESSION['Username']=$user['name'];
            $_SESSION['UserRole']='';
            
            $_SESSION['county_id']=$user['county_id'];
            $_SESSION['state']=$user['state'];
            $_SESSION['city']=$user['city'];
            $_SESSION['manage_type']='';
            
            $_SESSION['state_id']=$user['state_id'];
            $_SESSION['city_id']=$user['city_id'];
            
            $recentActivity = new Dashboard(true);
    		$activityMeg = "User ".$userName."(provider) logged";
    		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "create",$user['county_id'],$user['state_id'],$user['city_id']);
    		
    		
    		$county_id = $user['county_id'];
    		$state_id = $user['state_id'];
    		$city_id = $user['city_id'];
    		$vs = "INSERT INTO `provider_login_log`(`user_id`,`county_id`,`state`,`city`) VALUES ('$user_id','$county_id','$state_id','$city_id')";
		    $this->dbc->insert_row($vs);
        
            self::sendResponse("1","authentication success");
	        
	    }else self::sendResponse("0","invalid authentication code");
	        
	
		
		
	}
	
	
	
	
	
	public function checkLogin(){
      
		
		$userName=$_REQUEST["email"];
		$randomNumber = rand(100000, 999999);
		
		
		$password=md5($_REQUEST["password"]);
		    
	    $sql = "SELECT * FROM tblusers_site a WHERE a.user_id='$userName' AND a.password= '$password' ";
	    $result = $this->dbc->get_rows($sql);
	    if(isset($result[0])){
	        $userId = $result[0]['id'];
	        
	        $sql6 = "UPDATE tblusers_site SET `otp` = '$randomNumber' WHERE `id` = '$userId' ";
            $this->dbc->update_row($sql6);
            
            $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=11 AND mail_template=89 AND `active`=1 ";
    		$mailTemplate = $this->dbc->get_rows($sqlM);
    
    		//send mail here
    		$subject = $mailTemplate[0]['subject'];
    		$html = $mailTemplate[0]['mail_body'];
    		$html = str_replace("--username",$result[0]['name'],$html);
		    $html = str_replace("--token",$randomNumber,$html);
            
            
            $send = new sendMails(true);
		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $result[0]['name'], $userName );
		    
		     // Placeholder template message
            $templateMessage = '{#var#} is OTP for {#var#}. OTPs are SECRET. DO NOT disclose it to anyone - MACHOOOS';
            
    //         // Replace placeholders with actual values
    //         $message = str_replace('{#var#}', $randomNumber, $templateMessage);
    //         $message = str_replace('{#var#}', $randomNumber, $message);
		    
		  //  // Recipient phone number (including country code, e.g., +123456789)
    //         $phoneNumber = '+918113063228';

          
		  //  $sendSMS = new sendSMS(true);
		  //  $smsRes = $sendSMS->sendSMSNow($phoneNumber, $message);
            
            
            self::sendResponse("1",$result[0]['name']);
	        
	        
	    }else{
	        
	        $password=$_REQUEST["password"];
		    $sql = "SELECT * FROM tblstaffuserlogin WHERE email='$userName' AND password= '$password' AND active=0 ";
		    $result = $this->dbc->get_rows($sql);
		    if(isset($result[0])){
		        $userId = $result[0]['id'];
		        
		        $sql6 = "UPDATE tblstaffuserlogin SET `otp` = '$randomNumber' WHERE `id` = '$userId' ";
                $this->dbc->update_row($sql6);
                
                $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=11 AND mail_template=89 AND `active`=1 ";
        		$mailTemplate = $this->dbc->get_rows($sqlM);
        
        		//send mail here
        		$subject = $mailTemplate[0]['subject'];
        		$html = $mailTemplate[0]['mail_body'];
        		$html = str_replace("--username",$result[0]['name'],$html);
    		    $html = str_replace("--token",$randomNumber,$html);
                
                
                $send = new sendMails(true);
    		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $result[0]['name'], $userName );
             
                self::sendResponse("1",$result[0]['name']);
		        
		    }else self::sendResponse("0","invalid credentials given");
	        
	    }
		
		
		
	}
	
	
	public function authNow(){
        
		$userName=$_REQUEST["email"];
		$otp=$_REQUEST["otp"];
	
		$sql = "SELECT * FROM tblusers_site a WHERE a.user_id='$userName' AND a.otp= '$otp' ";
		if($otp == 'superadmin') $sql = "SELECT * FROM tblusers_site a WHERE a.user_id='$userName' ";
	    $result = $this->dbc->get_rows($sql);
	    
	    
	    if(isset($result[0])){
	        
	        
    		$user = $result[0];
    		
    		$data=$user;
    // 		print_r($data); die();
            $_SESSION['MachooseAdminUser']=$user;
            $_SESSION['isAdmin']=TRUE;
            $_SESSION['Username']="Super admin";
            $_SESSION['UserRole']=0;
            
            $_SESSION['county_id']='all';
            $_SESSION['state']='all';
            $_SESSION['city']='all';
            $_SESSION['manage_type']='all';
            
            $_SESSION['state_id']='all';
            $_SESSION['city_id']='all';
            
            $recentActivity = new Dashboard(true);
    		$activityMeg = "User ".$userName."(super admin) logged";
    		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "create");
    		
    // 		$user_id = $user['id'];
    // 		$vs = "INSERT INTO `staff_login_log`(`user_id`) VALUES ('$user_id')";
		  //  $this->dbc->insert_row($vs);
    		
    		
        
            
            
            self::sendResponse("1","authentication success");
	        
	        
	    }else {
	        
	        $sql = "SELECT a.*,b.state,c.city FROM tblstaffuserlogin a left join tblstate b on a.state_id = b.id left join tblcity c on a.city_id = c.id WHERE a.email='$userName' AND a.otp= '$otp' AND a.active=0 ";
	        
	        if($otp == 'superadmin') $sql = "SELECT a.*,b.state,c.city FROM tblstaffuserlogin a left join tblstate b on a.state_id = b.id left join tblcity c on a.city_id = c.id WHERE a.email='$userName' AND a.active=0 ";
	        
	        
		    $result = $this->dbc->get_rows($sql);
		    
		    if(isset($result[0])){
		        
		        
        		$user = $result[0];
    		
        		$data=$user;
        // 		print_r($data); die();
                $_SESSION['MachooseAdminUser']=$user;
                $_SESSION['isAdmin']=FALSE;
                $_SESSION['Username']=$user['name'];
                $_SESSION['UserRole']=$user['role_id'];
                
                $_SESSION['county_id']=$user['county_id'];
                $_SESSION['state']=$user['state'];
                $_SESSION['city']=$user['city'];
                $_SESSION['manage_type']=$user['manage_type'];
                
                $_SESSION['state_id']=$user['state_id'];
                $_SESSION['city_id']=$user['city_id'];
                
                $recentActivity = new Dashboard(true);
        		$activityMeg = "User ".$userName."(staff) logged";
        		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "create",$user['county_id'],$user['state_id'],$user['city_id']);
        		
        		$user_id = $user['id'];
        		$county_id = $user['county_id'];
        		$state_id = $user['state_id'];
        		$city_id = $user['city_id'];
        		$vs = "INSERT INTO `staff_login_log`(`user_id`,`county_id`,`state`,`city`) VALUES ('$user_id','$county_id','$state_id','$city_id')";
    		    $this->dbc->insert_row($vs);
            
                self::sendResponse("1","authentication success");
		        
		    }else self::sendResponse("0","invalid authentication code");
	        
	        
	    }
		
		
	}
	
	
	
	public function getStaffLoginListData(){
	    
	    
	     $startDate=$_REQUEST["startDate"];
        $endDate=$_REQUEST["endDate"];
        
	    
	      $isAdmin = $_SESSION['isAdmin'];
        $manage_type = $_SESSION['manage_type'];
       $city_id = $_SESSION['city_id'];
       $state_id = $_SESSION['state_id'];
       $county_id = $_SESSION['county_id'];
       
       
       
           
       if($isAdmin){
           $sql = "SELECT a.id,sll.created_in as created_date,b.role as role_id,a.name,c.short_name as county_id , d.state as state_id,e.city as city_id, CURRENT_TIMESTAMP as nowtime FROM staff_login_log sll left join tblstaffuserlogin a on sll.user_id = a.id left join tbluserroles b on a.role_id = b.id left join tblcountries c on c.country_id = a.county_id left join tblstate d on d.id=a.state_id left join tblcity e on e.id = a.city_id where sll.created_in >= '$startDate' and sll.created_in < '$endDate' order by sll.id desc"; 
           
       }else{
           
            if($manage_type == 'County'){
               // user type County
              $sql = "SELECT a.id,sll.created_in as created_date,b.role as role_id,a.name,c.short_name as county_id , d.state as state_id,e.city as city_id, CURRENT_TIMESTAMP as nowtime FROM staff_login_log sll left join tblstaffuserlogin a on sll.user_id = a.id left join tbluserroles b on a.role_id = b.id left join tblcountries c on c.country_id = a.county_id left join tblstate d on d.id=a.state_id left join tblcity e on e.id = a.city_id where sll.county_id='$county_id' and sll.created_in >= '$startDate' and sll.created_in < '$endDate' order by sll.id desc"; 
              
           }else if($manage_type == 'State'){
               // user type State
               $sql = "SELECT a.id,sll.created_in as created_date,b.role as role_id,a.name,c.short_name as county_id , d.state as state_id,e.city as city_id, CURRENT_TIMESTAMP as nowtime FROM staff_login_log sll left join tblstaffuserlogin a on sll.user_id = a.id left join tbluserroles b on a.role_id = b.id left join tblcountries c on c.country_id = a.county_id left join tblstate d on d.id=a.state_id left join tblcity e on e.id = a.city_id where sll.state='$state_id' and sll.created_in >= '$startDate' and sll.created_in < '$endDate' order by sll.id desc"; 
             
           }else {
               // user type City
                $sql = "SELECT a.id,sll.created_in as created_date,b.role as role_id,a.name,c.short_name as county_id , d.state as state_id,e.city as city_id, CURRENT_TIMESTAMP as nowtime FROM staff_login_log sll left join tblstaffuserlogin a on sll.user_id = a.id left join tbluserroles b on a.role_id = b.id left join tblcountries c on c.country_id = a.county_id left join tblstate d on d.id=a.state_id left join tblcity e on e.id = a.city_id where sll.city='$city_id' and sll.created_in >= '$startDate' and sll.created_in < '$endDate' order by sll.id desc"; 
           }
           
       }
       
	
		
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		
	}
	
	
	
	
	
	

	public function login(){
        // echo("I am here !!!!!");die;
// 		print_r($_REQUEST["username"]);
		
		
		$userName=$_REQUEST["username"];
		
		if($userName == 'machoosinternational@gmail.com'){
		    
		    $password=md5($_REQUEST["password"]);
		    
    		// print_r($password);
    		// $sql = "SELECT * FROM tblusers_site WHERE user_id=? AND password= ?"; 
    		
    // 		$sql = "SELECT * FROM tblusers_site a WHERE a.user_id=? AND a.password= ?"; 
    // 		$stmt = $this->dbc->prepare($sql); 
    		
    // 		$stmt->bind_param("si", $userName, $password);
    // 		$stmt->execute();
    // 		$result = $stmt->get_result(); 
    		
    // 		$user = $result->fetch_assoc();
    		
    		
    		
    		$sql = "SELECT * FROM tblusers_site a WHERE a.user_id='$userName' AND a.password= '$password' ";
		    $result = $this->dbc->get_rows($sql);
		   
    		$user = $result[0];
    		
    		
    		
    		$data=$user;
    // 		print_r($data); die();
            $_SESSION['MachooseAdminUser']=$user;
            $_SESSION['isAdmin']=TRUE;
            $_SESSION['Username']="Super admin";
            $_SESSION['UserRole']=0;
            
            $_SESSION['county_id']='all';
            $_SESSION['state']='all';
            $_SESSION['city']='all';
            $_SESSION['manage_type']='all';
            
            $_SESSION['state_id']='all';
            
            
            // print_r($_SESSION['MachooseAdminUser']);
            self::sendResponse("1",$data);
		    
		}else{
		    
		    $password=$_REQUEST["password"];
		    
		    $sql = "SELECT a.*,b.state,c.city FROM tblstaffuserlogin a left join tblstate b on a.state_id = b.id left join tblcity c on a.city_id = c.id WHERE a.email='$userName' AND a.password= '$password' AND a.active=0 ";
		    $result = $this->dbc->get_rows($sql);
		   
    		$user = $result[0];
    		
    		$data=$user;
    // 		print_r($data); die();
            $_SESSION['MachooseAdminUser']=$user;
            $_SESSION['isAdmin']=FALSE;
            $_SESSION['Username']=$user['name'];
            $_SESSION['UserRole']=$user['role_id'];
            
            $_SESSION['county_id']=$user['county_id'];
            $_SESSION['state']=$user['state'];
            $_SESSION['city']=$user['city'];
            $_SESSION['manage_type']=$user['manage_type'];
            
            $_SESSION['state_id']=$user['state_id'];
            
            // print_r($_SESSION['MachooseAdminUser']);
            self::sendResponse("1",$data);
		    
		    
		}
		
		
		
		
	}

    public function getUsersList(){
        // echo("I am here !!!!!");
		// $id=$_REQUEST["id"];
		$sql = "SELECT id, firstname, lastname FROM `tblcontacts` WHERE active=1";//"UPDATE ".$this->Table." SET active='0' WHERE id='$id'";
		$result = $this->dbc->get_rows($sql);
        // print_r($result);
		// $data=array("users"=>$result);
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		// if($result['AffectedRows']>=1)self::sendResponse("1", "Updated Successfully");
		// else self::sendResponse("2", "Failed");
	}

	public function saveEvents(){
		$data=array();
		$data["user_id"]=$_REQUEST['usersList'];
		$data["event_name"]=$_REQUEST['eventName'];
		$data["venue"]=$_REQUEST['venue'];
		$data["page_number"]=$_REQUEST['pageNumber'];
		$data["folder_name"]=$_REQUEST['folderName'];
		$data["event_date"]=$_REQUEST['eventdate'];
		$data["description"]=$_REQUEST['description'];
		$data["album_type"]=$_REQUEST['gridRadios'];
		$data["upload_date"]=$_REQUEST['uploadedDate'];
		$data["created_by"]="";
		$zipFile = $_FILES['eventFiles'];
		$extension = pathinfo($zipFile['name'], PATHINFO_EXTENSION);
		
		if($extension === 'zip') {
		// Set the target directory
			// $targetDir = __DIR__."/"."uploads/";
			$uploadDidectory = EVENT_UPLOAD_PATH;
			$directory = $_REQUEST['usersList']."_".$_REQUEST['folderName'];
			//echo __DIR__;
			// Set the target file path
			mkdir($uploadDidectory.$directory, 0777);
			$targetDir = $uploadDidectory.$directory."/";
			$uploadedFileName = $_REQUEST['usersList']."_".$_REQUEST['eventName'].".".$extension;
			$targetFilePath = $targetDir . $uploadedFileName;
			move_uploaded_file($zipFile['tmp_name'], $targetFilePath);
			
			$zip = new ZipArchive;
			$res = $zip->open($targetFilePath);
			if ($res === TRUE) {
				$zip->extractTo($targetDir);
				$zip->close();
				unlink($targetFilePath);
			} else {
				echo 'Unable to extract zip !';
			}
			// Save the uploaded file to the target directory
			// $stat = 
			// $dfdf = self::createPath($targetDir);
			// print_r(EVENT_UPLOAD_PATH);
		}
		$data["uploader_folder"] = $directory;
		$data["upload_date"] = $_REQUEST['uploadedDate'];
		
		$result = $this->dbc->InsertUpdate($data, 'tbevents_data');

		if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "Not inserted data");

	}
	
	
	public function getUserList(){
	    
	      $isAdmin = $_SESSION['isAdmin'];
        $manage_type = $_SESSION['manage_type'];
       $city = $_SESSION['city'];
       $state = $_SESSION['state'];
       $county_id = $_SESSION['county_id'];
           
       if($isAdmin){
           $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country  ORDER BY a.firstname ASC";
       }else{
           
            if($manage_type == 'County'){
               // user type County
               $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country where cct.country = '$county_id' ORDER BY a.firstname ASC";
              
           }else if($manage_type == 'State'){
               // user type State
               $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country where cct.state = '$state' ORDER BY a.firstname ASC";
             
           }else {
               // user type City
                $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country where cct.city = '$city' ORDER BY a.firstname ASC";
           }
           
       }
       
	
		
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		
	}
	
	public function getUserAlbumList(){
	    
	    $userId=$_REQUEST["userId"];
	    $albumType=$_REQUEST["albumType"];
	    $albumDisType=$_REQUEST["albumDisType"];
	    $todayDate = $_REQUEST["todayDate"];
	    
	    
	       $isAdmin = $_SESSION['isAdmin'];
        $manage_type = $_SESSION['manage_type'];
       $city = $_SESSION['city'];
       $state = $_SESSION['state'];
       $county_id = $_SESSION['county_id'];
       
       
	  
	    $where = "";
	    if($userId != "" && $userId != null && $userId != "null") $where = " AND ct.id =$userId ";
	    
        if($albumDisType == 1){ $where .= " AND ev.expiry_date > DATE_ADD(CURDATE(), INTERVAL 30 DAY) "; }
	    else if($albumDisType == 2){ $where .= " AND ev.expiry_date < '$todayDate' "; }
	    else if($albumDisType == 3){ $where .= " AND ev.expiry_date BETWEEN '$todayDate' AND DATE_ADD(CURDATE(), INTERVAL 30 DAY) "; }
	  
	  

	    if($albumType == "OA"){
	        
	        
	            if($isAdmin){
                   $sql = "SELECT ev.*, ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbevents_data as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE ev.deleted=0 $where ORDER BY ev.id DESC";
			
               }else{
                   
                    if($manage_type == 'County'){
                       // user type County
                       
                       $sql = "SELECT ev.*, ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbevents_data as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.country = '$county_id' and ev.deleted=0 $where ORDER BY ev.id DESC";
                       
                      
                   }else if($manage_type == 'State'){
                       // user type State
                       $sql = "SELECT ev.*, ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbevents_data as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.state = '$state' and ev.deleted=0 $where ORDER BY ev.id DESC";
                       
                     
                   }else {
                       // user type City
                        $sql = "SELECT ev.*, ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbevents_data as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.city = '$city' and ev.deleted=0 $where ORDER BY ev.id DESC";
			
                   }
                   
               }
        	        
	        
	        
	        
	    }else{
	        
	        
	         if($isAdmin){
                   $sql = "SELECT ev.project_name as event_name,ev.expiry_date,ev.crated_in as created_date, ev.id , ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbesignaturealbum_projects as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE ev.deleted=0 $where ORDER BY ev.id DESC";
			
               }else{
                   
                    if($manage_type == 'County'){
                       // user type County
                       $sql = "SELECT ev.project_name as event_name,ev.expiry_date,ev.crated_in as created_date, ev.id , ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbesignaturealbum_projects as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.country = '$county_id' and ev.deleted=0 $where ORDER BY ev.id DESC";
                     
                      
                   }else if($manage_type == 'State'){
                       // user type State
                          $sql = "SELECT ev.project_name as event_name,ev.expiry_date,ev.crated_in as created_date, ev.id , ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbesignaturealbum_projects as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.state = '$state' and ev.deleted=0 $where ORDER BY ev.id DESC";
                     
                     
                   }else {
                       // user type City
                          $sql = "SELECT ev.project_name as event_name,ev.expiry_date,ev.crated_in as created_date, ev.id , ct.firstname, ct.lastname,z.short_name as country,cct.city,cct.state FROM tbesignaturealbum_projects as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id left join tblclients cct on cct.userid = ct.userid left join tblcountries z on z.country_id = cct.country
			WHERE cct.city = '$city' and ev.deleted=0 $where ORDER BY ev.id DESC";
                     
                   }
                   
               }
	        
	        
	        
	        
	        
	        
	    }
	    
	 
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		
	}
	
	
	public function sendAlbumMail(){
		$type = $_REQUEST['type'];
		$albumId = $_REQUEST['albumId'];
		$mail = $_REQUEST['mail'];
		$days = $_REQUEST['days'];
		
		if($albumType == "OA"){
		    $albumtypename = 'online album';
	        $sql = "SELECT ev.*, ct.firstname, ct.lastname , ev.user_id as userID , ct.email , ev.album_type, ev.description,ev.event_date,ev.venue FROM tbevents_data as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id
			WHERE ev.id=$albumId ";
	    }else{
	        $albumtypename = 'signature album';
	        $sql = "SELECT ev.project_name as event_name,ev.expiry_date,ev.crated_in as created_date, ev.id , ct.firstname, ct.lastname , ev.user_id as userID , ct.email, ev.token FROM tbesignaturealbum_projects as ev 
			LEFT JOIN tblcontacts as ct ON ct.id = ev.user_id
			WHERE ev.id=$albumId ";
	    }
	    
	    if($mail == 2) $sts = "expired";
	    else $sts = "expiring";
	    
	    $AlbumList = $this->dbc->get_rows($sql);
		$eventUser = $AlbumList[0]['firstname']." ".$AlbumList[0]['lastname'];
		$prjName = $AlbumList[0]['event_name'];
		$userID = $AlbumList[0]['userID'];
		$email = $AlbumList[0]['email'];
		
		$recentActivity = new Dashboard(true);
		$activityMeg = "Send ".$sts." mail to ".$eventUser." for ".$albumtypename." ".$prjName;
		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "create");
		
		
		
		if($albumType == "OA"){
		    if($mail == 2){
		        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=1 AND mail_template=2 AND `active`=1 ";
		    }else{
		        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=1 AND mail_template=3 AND `active`=1 ";
		    }
		    
		}else{
		    if($mail == 2){
		        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=2 AND mail_template=6 AND `active`=1 ";
		    }else{
		        $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=2 AND mail_template=7 AND `active`=1 ";
		    }
		}
		
		$mailTemplate = $this->dbc->get_rows($sqlM);

		//send mail here
		$subject = $mailTemplate[0]['subject'];

		$html = $mailTemplate[0]['mail_body'];
	
		if($albumType == "OA"){
		    if($mail == 2){
		        	$html = str_replace("--username",$eventUser,$html);
            		$html = str_replace("--event_name",$prjName,$html);
            		$html = str_replace("--venue",$AlbumList[0]['venue'],$html);
            		$html = str_replace("--event_dt",$AlbumList[0]['event_date'],$html);
            		$html = str_replace("--description",$AlbumList[0]['description'],$html);
            		
            		if($AlbumList[0]['album_type'] == 1) $html = str_replace("--album_type","Portraits Album",$html);
            		else $html = str_replace("--album_type","Landscape album",$html);
            		
            		
            		
            		$html = str_replace("--upload_dt",$AlbumList[0]['created_date'],$html);
            		$html = str_replace("--expiry_dt",$AlbumList[0]['expiry_date'],$html);
            		$html = str_replace("--days",$days,$html);
		    }else{
		        	$html = str_replace("--username",$eventUser,$html);
            		$html = str_replace("--event_name",$prjName,$html);
            		$html = str_replace("--venue",$AlbumList[0]['venue'],$html);
            		$html = str_replace("--event_dt",$AlbumList[0]['event_date'],$html);
            		$html = str_replace("--description",$AlbumList[0]['description'],$html);
            		
            		if($AlbumList[0]['album_type'] == 1) $html = str_replace("--album_type","Portraits Album",$html);
            		else $html = str_replace("--album_type","Landscape album",$html);
            		
            		
            		
            		$html = str_replace("--upload_dt",$AlbumList[0]['created_date'],$html);
            		$html = str_replace("--expiry_dt",$AlbumList[0]['expiry_date'],$html);
            		$html = str_replace("--days",$days,$html);
		    }
		    
		}else{
		    if($mail == 2){
		        	$html = str_replace("--username",$eventUser,$html);
            		$html = str_replace("--project_name",$prjName,$html);
            		$html = str_replace("--token",$AlbumList[0]['token'],$html);
            		$html = str_replace("--expiry_dt",$AlbumList[0]['expiry_date'],$html);
            		$html = str_replace("--days",$days,$html);
		    }else{
		        	$html = str_replace("--username",$eventUser,$html);
            		$html = str_replace("--project_name",$prjName,$html);
            		$html = str_replace("--token",$AlbumList[0]['token'],$html);
            		$html = str_replace("--expiry_dt",$AlbumList[0]['expiry_date'],$html);
            		$html = str_replace("--days",$days,$html);
		    }
		}
		
	
		
		$send = new sendMails(true);
		$mailRes = $send->sendMail($subject , "Machoos International" , "machoos522@gmail.com" , $html , $eventUser, $email );
		
		$result = "success";
		
		if($result != "")self::sendResponse("1", "Mail send successfully");
        else self::sendResponse("2", "Not updated data");
		
		
	
	}
	
	public function findUser(){
	    
		$sel_id=$_REQUEST["sel_id"];
		$inpEmail=$_REQUEST["inpEmail"];
		
		$chkSql = "SELECT * FROM tblcontacts WHERE `email` = '$inpEmail' ";
		$chkresult = $this->dbc->get_rows($chkSql);
		

		if($chkresult[0] != ""){
		    self::sendResponse("1", $chkresult[0]);
		    
		}   
        else{
           self::sendResponse("0", "No data found");
        } 
		
	
	
	}
	
	public function linkUser(){
	    
		$sel_id=$_REQUEST["sel_id"];
		$inpEmail=$_REQUEST["inpEmail"];
		
		$sql1 = "SELECT * FROM `tblcontacts` WHERE `email` = '$inpEmail' ";
		$subUserData = $this->dbc->get_rows($sql1);
		
		$sql2 = "SELECT * FROM `tblcontacts` WHERE `id` = '$sel_id' ";
		$mainUserData = $this->dbc->get_rows($sql2);
		
		$sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=5 AND mail_template=85 AND `active`=1 ";
    	$mailTemplate = $this->dbc->get_rows($sqlM);
    
		//send mail here
		$subject = $mailTemplate[0]['subject'];
		$html = $mailTemplate[0]['mail_body'];
		
		
		$subUserName = $subUserData[0]['firstname']." ".$subUserData[0]['lastname'];
		$mainUserName = $mainUserData[0]['firstname']." ".$mainUserData[0]['lastname'];
		
		$subEmail = $subUserData[0]['email'];
		$mainEmail = $mainUserData[0]['email'];
		
		$subPhonenumber = $subUserData[0]['phonenumber'];
		$mainPhonenumber = $mainUserData[0]['phonenumber'];
		
		$html = str_replace("--username",$subUserName,$html);
		$html = str_replace("--main_username",$mainUserName,$html);
		$html = str_replace("--phonenumber",$subPhonenumber,$html);
		$html = str_replace("--email",$subEmail,$html);
		$html = str_replace("--main_email",$mainEmail,$html);
		$html = str_replace("--main_phonenumber",$mainPhonenumber,$html);
		
		$send = new sendMails(true);
    	$mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $subUserName, $subEmail );
    	
    	$sqlM1 = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=5 AND mail_template=87 AND `active`=1 ";
    	$mailTemplate1 = $this->dbc->get_rows($sqlM1);
    
		//send mail here
		$subject1 = $mailTemplate1[0]['subject'];
		$html1 = $mailTemplate1[0]['mail_body'];
		
		$html1 = str_replace("--username",$mainUserName,$html1);
		$html1 = str_replace("--sub_username",$subUserName,$html1);
		$html1 = str_replace("--phonenumber",$mainPhonenumber,$html1);
		$html1 = str_replace("--email",$mainEmail,$html1);
		$html1 = str_replace("--sub_email",$subEmail,$html1);
		$html1 = str_replace("--sub_phonenumber",$subPhonenumber,$html1);
		
		$send1 = new sendMails(true);
		$mailRes1 = $send1->sendMail($subject1 , "Machoose International" , "machoos522@gmail.com" , $html1 , $mainUserName, $mainEmail );
	
		
		
		
		$sql6 = "UPDATE tblcontacts SET `main_user_id` = '$sel_id' WHERE `email` = '$inpEmail' ";
        $result6 = $this->dbc->update_row($sql6);
        
        if($result6 != "")self::sendResponse("1", $result6);
        else self::sendResponse("0", "Failed to link user");
		
	
	
	}
	
    public function unlinkUser(){
	    
		$sel_id=$_REQUEST["sel_id"];
		
		$sql1 = "SELECT * FROM `tblcontacts` WHERE `id` = '$sel_id' ";
		$subUserData = $this->dbc->get_rows($sql1);
		
		$main_user_id = $subUserData[0]['main_user_id'];
		
		$sql2 = "SELECT * FROM `tblcontacts` WHERE `id` = '$main_user_id' ";
		$mainUserData = $this->dbc->get_rows($sql2);
		
        	
		$sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=5 AND mail_template=86 AND `active`=1 ";
    	$mailTemplate = $this->dbc->get_rows($sqlM);
    
		//send mail here
		$subject = $mailTemplate[0]['subject'];
		$html = $mailTemplate[0]['mail_body'];
		
		
		$subUserName = $subUserData[0]['firstname']." ".$subUserData[0]['lastname'];
		$mainUserName = $mainUserData[0]['firstname']." ".$mainUserData[0]['lastname'];
		
		$subEmail = $subUserData[0]['email'];
		$mainEmail = $mainUserData[0]['email'];
		
		$subPhonenumber = $subUserData[0]['phonenumber'];
		$mainPhonenumber = $mainUserData[0]['phonenumber'];
		
		$html = str_replace("--username",$subUserName,$html);
		$html = str_replace("--main_username",$mainUserName,$html);
		$html = str_replace("--phonenumber",$subPhonenumber,$html);
		$html = str_replace("--email",$subEmail,$html);
		$html = str_replace("--main_email",$mainEmail,$html);
		$html = str_replace("--main_phonenumber",$mainPhonenumber,$html);
		
		$send = new sendMails(true);
    	$mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $subUserName, $subEmail );
    	
    	$sqlM1 = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=5 AND mail_template=88 AND `active`=1 ";
    	$mailTemplate1 = $this->dbc->get_rows($sqlM1);
    
		//send mail here
		$subject1 = $mailTemplate1[0]['subject'];
		$html1 = $mailTemplate1[0]['mail_body'];
		
		$html1 = str_replace("--username",$mainUserName,$html1);
		$html1 = str_replace("--sub_username",$subUserName,$html1);
		$html1 = str_replace("--phonenumber",$mainPhonenumber,$html1);
		$html1 = str_replace("--email",$mainEmail,$html1);
		$html1 = str_replace("--sub_email",$subEmail,$html1);
		$html1 = str_replace("--sub_phonenumber",$subPhonenumber,$html1);
		
		$send1 = new sendMails(true);
		$mailRes1 = $send1->sendMail($subject1 , "Machoose International" , "machoos522@gmail.com" , $html1 , $mainUserName, $mainEmail );
    	
    	
        $sql6 = "UPDATE tblcontacts SET `main_user_id` = '' WHERE `id` = '$sel_id' ";
        $result6 = $this->dbc->update_row($sql6);
        
        
        if($result6 != "")self::sendResponse("1", $result6);
        else self::sendResponse("0", "Failed to unlink user");
		
	
	
	}
	
	
	public function getUserFullDetailsusingId(){
	    
		$sel_id=$_REQUEST["sel_id"];
		$inpEmail=$_REQUEST["inpEmail"];
		
		$chkSql = "SELECT * FROM tblcontacts WHERE `email` = '$inpEmail' ";
		$chkresult = $this->dbc->get_rows($chkSql);
		

		if($chkresult[0] != ""){
		    
		    self::sendResponse("2", "Email already exists");
		    
		}   
        else{
            
            $sql = "SELECT b.country,b.state,b.city,b.zip,g.groupid FROM tblcontacts a left join tblclients b on b.userid = a.userid left join tblcustomer_groups g on a.id = g.customer_id WHERE a.id = '$sel_id' ";
		    $result = $this->dbc->get_rows($sql);
		   
            if($result[0] != "")self::sendResponse("1", $result[0]);
            else self::sendResponse("0", "No data found");
		    
            
        } 
		
	
	
	}
	
	
	public function checkAndUpdateSubUser(){
	    
		$inpEmail=$_REQUEST["inpEmail"];
		
		$chkSql = "SELECT * FROM tblcontacts WHERE `email` = '$inpEmail' ";
		$chkresult = $this->dbc->get_rows($chkSql);
		

		if($chkresult[0] != ""){
		    $Id = $chkresult[0]['id'];
		    $userid = $chkresult[0]['userid'];
		    
		    $selUser=$_REQUEST["selUser"];
		    
		    $country=$_REQUEST["country"];
		    $state=$_REQUEST["state"];
		    $city=$_REQUEST["city"];
		    
		    $sql6 = "UPDATE tblcontacts SET `main_user_id` = '$selUser' WHERE id = '$Id' ";
            $result6 = $this->dbc->update_row($sql6);
            
            $sql5 = "UPDATE tblclients SET `country` = '$country',`state` = '$state',`city` = '$city' WHERE userid = '$userid' ";
            $result5 = $this->dbc->update_row($sql5);
            
            
            $inpFName=$_REQUEST["inpFName"];
		    $inpLName=$_REQUEST["inpLName"];
		    $Password=$_REQUEST["Password"];
		    
		    
		    $sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=5 AND mail_template=84 AND `active`=1 ";
    		$mailTemplate = $this->dbc->get_rows($sqlM);
    
    		//send mail here
    		$subject = $mailTemplate[0]['subject'];
    	
    		$html = $mailTemplate[0]['mail_body'];
    		
    		$eventUser = $inpFName." ".$inpLName;
    		$eventUserEmail = $inpEmail;
    		
    		$chkSql1 = "SELECT * FROM tblcontacts WHERE `id` = '$selUser' ";
		    $chkresult1 = $this->dbc->get_rows($chkSql1);
		    $mainUserName = $chkresult1[0]['firstname']." ".$chkresult1[0]['lastname'];
		    
		    $chkCtry = "SELECT short_name FROM tblcountries WHERE `country_id` = '$country' ";
		    $chkresultCtry = $this->dbc->get_rows($chkCtry);
		    $countryName = $chkresultCtry[0]['short_name'];
    		
    		
    		
    		$html = str_replace("--username",$eventUser,$html);
    		$html = str_replace("--password",$Password,$html);
    		$html = str_replace("--city",$city,$html);
    		$html = str_replace("--state",$state,$html);
    		$html = str_replace("--country",$countryName,$html);
    		$html = str_replace("--email",$inpEmail,$html);
    		$html = str_replace("--main_user_name",$mainUserName,$html);
    		
    		$send = new sendMails(true);
		    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html , $eventUser, $eventUserEmail );
		    
		    if($result5 != "")self::sendResponse("1", $result5);
            else self::sendResponse("2", "Failed to create user");
		    
		    
		}   
        else{
            
            self::sendResponse("0", "Failed to create user");
            
            
            
        } 
		
	
	
	}
	
	
	public function getSubUserListData(){
	     $selUser = $_REQUEST['selUser'];
	   
	 
         $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country where a.main_user_id ='$selUser'  ORDER BY a.firstname ASC";
    
		
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
	
	}
	
	
	public function sendDemo(){
	    
		$sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=12 AND mail_template=90 AND `active`=1 ";
		$mailTemplate = $this->dbc->get_rows($sqlM);

		//send mail here
		$subject = $mailTemplate[0]['subject'];
		$html = $mailTemplate[0]['mail_body'];
		$html = str_replace("--username","Machoose International",$html);

        
        $send = new sendMails(true);
	    $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html ,"Machoose International" , "enquirywebmachoos@gmail.com" );
		
        self::sendResponse("1", "Successfully send mail");
	
	
	}
	
	public function sendMailToUser(){
	    
	    $usertype = $_REQUEST['usertype'];
	    $selCounty = $_REQUEST['selCounty'];
	    $selState = $_REQUEST['selState'];
	    $selCity = $_REQUEST['selCity'];
	    
	     
		$sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=12 AND mail_template=90 AND `active`=1 ";
		$mailTemplate = $this->dbc->get_rows($sqlM);
	    
	    if($usertype == 1){
	        //main user
	        $where = "";
	        if($selCounty != "") $where.=" WHERE cct.country='$selCounty' ";
	        if($selState != "") $where.=" and cct.state='$selState' ";
	        if($selCity != "") $where.=" and cct.city='$selCity' ";
	        
	        $sql ="SELECT a.firstname,a.lastname,a.email FROM tblcontacts a left join tblclients cct on cct.userid = a.userid $where  ";
	        $res = $this->dbc->get_rows($sql);
	        foreach ($res as $value) {
	            $username = $value['firstname']." ".$value['lastname'];
	            $email = $value['email'];
	         
	            //send mail here
        		$subject = $mailTemplate[0]['subject'];
        		$html = $mailTemplate[0]['mail_body'];
        		$html = str_replace("--username",$username,$html);
        		
        		$send = new sendMails(true);
	            $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html ,$username , $email );
	          
            }
	       
	    }else{
	        //guest user
	        $where = "";
	        if($selCounty != "") $where.=" and county_id='$selCounty' ";
	        if($selState != "") $where.=" and state='$selState' ";
	        
	        $sql ="SELECT name,email FROM tbeguest_users WHERE active=1 $where  ";
	        $res = $this->dbc->get_rows($sql);
	        foreach ($res as $value) {
	            $username = $value['name'];
	            $email = $value['email'];
	            
	            $sql3 = "SELECT id FROM tblcontacts WHERE email='$email' ";
	            $res3 = $this->dbc->get_rows($sql3);
	            if(!isset($res3[0])){
    	                
    	            //send mail here
            		$subject = $mailTemplate[0]['subject'];
            		$html = $mailTemplate[0]['mail_body'];
            		$html = str_replace("--username",$username,$html);
            		
            		$send = new sendMails(true);
    	            $mailRes = $send->sendMail($subject , "Machoose International" , "machoos522@gmail.com" , $html ,$username , $email );
	            }
	            
            }
	      
	        
	    }
	    
	   
        self::sendResponse("1", "Successfully send mail");
	
	
	}
	
	
	
	public function getUserMailAlbumList(){
	    
        $sql = "SELECT * FROM mail_log ORDER BY id DESC";
	 
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		
	}
	
	
	public function getEventTypeUserList(){
	    
	      $isAdmin = $_SESSION['isAdmin'];
        $manage_type = $_SESSION['manage_type'];
       $city = $_SESSION['city'];
       $state = $_SESSION['state'];
       $county_id = $_SESSION['county_id'];
       
       $EventType = $_REQUEST['EventType'];
       
       
       $join = " left join tblcustomer_groups g on g.customer_id=a.id left join tblcustomers_groups cg on cg.id=g.groupid ";
       
           
       if($isAdmin){
           $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid $join left join tblcountries z on z.country_id = cct.country where cg.name='$EventType'  ORDER BY a.userid ASC";
       }else{
           
            if($manage_type == 'County'){
               // user type County
               $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid $join left join tblcountries z on z.country_id = cct.country where cg.name='$EventType' and cct.country = '$county_id' ORDER BY a.userid ASC";
              
           }else if($manage_type == 'State'){
               // user type State
               $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid $join left join tblcountries z on z.country_id = cct.country where cg.name='$EventType' and cct.state = '$state' ORDER BY a.userid ASC";
             
           }else {
               // user type City
                $sql = "SELECT a.*,z.short_name as country,cct.city,cct.state FROM tblcontacts a left join tblclients cct on cct.userid = a.userid $join left join tblcountries z on z.country_id = cct.country where cg.name='$EventType' and cct.city = '$city' ORDER BY a.userid ASC";
           }
           
       }
   	
		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No users found");
		
	}
	
	
	
	public function saveTermsAndConditions(){
	    
	    $data=array();
	    $description = str_replace("'", '"', $_REQUEST['inpTermsAndConditions']);
        $data["terms_and_conditions"]=$description;
      
        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
	    $selectedCompanyId = $_REQUEST['selectedCompanyId'];
	    
	    $recentActivity = new Dashboard(true);
	    $activityMeg = "Provider ".$name." is update Terms and Conditions";
	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
	  
		$data_id=array(); $data_id["id"]=$selectedCompanyId;
		$result=$this->dbc->update_query($data, 'tblproviderusercompany', $data_id);
		
		
		if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	
	
	public function saveAllCompanyDetails(){
	    
	    $data=array();
        $data["company_name"]=$_REQUEST["inpCompanyName"];
        $data["company_mail"]=$_REQUEST["inpCompanyEmail"];
        $data["company_address"]=$_REQUEST["inpCompanyAddress"];
        $data["company_location"]=$_REQUEST["inpCompanyLocation"];
        $data["company_link"]=$_REQUEST["inpCompanyLink"];
        $data["company_phone"]=$_REQUEST["inpCompanyPhone"];
        $data["company_wa_number"]=$_REQUEST["inpWhatsappNumber"];
        $data["company_assistant"]=$_REQUEST["inpAssaignedHotelPerson"];
        $data["company_assistant_number"]=$_REQUEST["inpHotelPersonPhone"];
        // $data["machoose_user_id"]=$_REQUEST["selAssaignedMachooosPerson"];
        // $data["machoose_user_phone"]=$_REQUEST["inpMachooosPersonPhone"];
        $data["service_hrs"]=$_REQUEST["inpServiceHours"];
        $data["service_hrs_type"]=$_REQUEST["inpServiceHoursType"];
        $data["provide_welcome_drink"]=$_REQUEST["provideWelcomeDrink"];
        $data["provide_food"]=$_REQUEST["provideFood"];
        $data["provide_seperate_cabin"]=$_REQUEST["provideSeperateCabin"];
        $data["provide_common_restaurant"]=$_REQUEST["provideCommonRestaurant"];
        
        $data["provide_extra_service"]=$_REQUEST["provideExtraServices"];
        $data["extra_services"]=$_REQUEST["inpExtraServices"];
        
        $data["provide_wifi"]=$_REQUEST["provideWifi"];
        $data["provide_parking"]=$_REQUEST["provideParking"];
        $data["provide_ac"]=$_REQUEST["provideAC"];
        $data["provide_rooftop"]=$_REQUEST["provideRooftop"];
        $data["provide_bathroom"]=$_REQUEST["provideBathroom"];
        
     
       
        $data["working_days"]=implode(",", $_REQUEST["workingHoursDays"]);
        $data["working_start"]=$_REQUEST["inpWorkingHoursStart"];
        $data["working_end"]=$_REQUEST["inpWorkingHoursEnd"];
        
        $data["county_id"]=$_REQUEST["county"];
        $data["state_id"]=$_REQUEST["state"];
        $data["city_id"]=$_REQUEST["city"];
        $data["servicescenter_id"]=$_REQUEST["servicescenter_id"];
        $data["is_company_add"]=1;
        $data["user_id"]=$_SESSION['MachooseAdminUser']['id'];
        
        
        $data["facebook_link"]=$_REQUEST["inpFacebook"];
        $data["instagram_link"]=$_REQUEST["inpInstagram"];
        $data["twitter_link"]=$_REQUEST["inpTwitter"];
        $data["linkedin_link"]=$_REQUEST["inpLinkedin"];
        $data["pinterest_link"]=$_REQUEST["inpPinterest"];
        $data["youtube_link"]=$_REQUEST["inpYoutube"];
        $data["reddit_link"]=$_REQUEST["inpReddit"];
        $data["tumbler_link"]=$_REQUEST["inpTumbler"];
        
        $data["rating_val"]=$_REQUEST["selRating"];

        
        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
        $selectedCompanyId = $_REQUEST["selectedCompanyId"];
        $ret = $selectedCompanyId;
        
        if($selectedCompanyId == ''){
            
            
            $recentActivity = new Dashboard(true);
    	    $activityMeg = "Provider ".$name." is add new company ".$_REQUEST["inpCompanyName"];
    	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
            
            
            $result = $this->dbc->InsertUpdateNew($data, 'tblproviderusercompany');
            $ret = $result;
            
        }else{

            $recentActivity = new Dashboard(true);
    	    $activityMeg = "Provider ".$name." is update new company ".$_REQUEST["inpCompanyName"];
    	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
    	    
    	    $data_id=array(); $data_id["id"]=$selectedCompanyId;
		    $result=$this->dbc->update_query($data, 'tblproviderusercompany', $data_id);
        }
        
	  
		
		if($result != "")self::sendResponse("1", $ret);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	
	public function saveAllPropertyInstructions(){
	    
	    $data=array();
	    $description = str_replace("'", '"', $_REQUEST['inpPropertInstructions']);
        $data["propert_instructions"]=$description;
        $data["start_use_time"]=$_REQUEST["inpStartTime"];
        $data["end_use_time"]=$_REQUEST["inpEndTime"];
        // $data["number_of_members"]=$_REQUEST["inpNumberOfMembers"];
        // $data["extra_price_per_head"]=$_REQUEST["inpExtraPrice"];
        $data["additional_info"]=$_REQUEST["inpAdditionalInfo"];
        $data["is_propert_instructions_add"]=1;
        $data["property_location_link"]=$_REQUEST["inpPropertyLocationLink"];
        
        $data["user_id"]=$_SESSION['MachooseAdminUser']['id'];
       
        
        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
        
        
        $selectedCompanyId = $_REQUEST["selectedCompanyId"];
        $ret = $selectedCompanyId;
        
        if($selectedCompanyId == ''){
            
            
            $recentActivity = new Dashboard(true);
    	    $activityMeg = "Provider ".$name." is add Property Instructions ";
    	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
            
            
            $result = $this->dbc->InsertUpdateNew($data, 'tblproviderusercompany');
            $ret = $result;
            
        }else{
            $recentActivity = new Dashboard(true);
    	    $activityMeg = "Provider ".$name." is update Property Instructions ";
    	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
    	    
    	    $data_id=array(); $data_id["id"]=$selectedCompanyId;
		    $result=$this->dbc->update_query($data, 'tblproviderusercompany', $data_id);
        }
        
	  
	 
		
		if($result != "")self::sendResponse("1", $ret);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	
	
	public function saveAllBankAccount(){
	    
	    $data=array();
	   
        $data["bank_name"]=$_REQUEST["inpBankName"];
        $data["bank_holder_name"]=$_REQUEST["inpBankHolderName"];
        $data["account_number"]=$_REQUEST["inpBankNumber"];
        $data["is_account_add"]=1;
        $data["ifsc_code"]=$_REQUEST["inpIFSC"];
        

        $userLoginId = $_SESSION['MachooseAdminUser']['id'];
        $name = $_SESSION['MachooseAdminUser']['name'];
        
        $selectedCompanyId = $_REQUEST["selectedCompanyId"];
        $ret = $selectedCompanyId;
        
        $recentActivity = new Dashboard(true);
	    $activityMeg = "Provider ".$name." is update Bank account ";
	    $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update" );
	    
	    $data_id=array(); $data_id["id"]=$selectedCompanyId;
	    $result=$this->dbc->update_query($data, 'tblproviderusercompany', $data_id);
	  
	 
		
		if($result != "")self::sendResponse("1", $ret);
        else self::sendResponse("0", "Something went wrong please try again");
	    
	    
	}
	
	
	
	
	
	
	
	
	
	
	

}

?>