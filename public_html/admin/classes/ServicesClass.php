<?php

class Services {
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

    
	public function getaddServices(){
		$sql = "SELECT * FROM tbl_services WHERE id=".$_REQUEST['id'];
		$result = $this->dbc->get_rows($sql);
    	$data=array("Services"=>$result[0]);
		self::sendResponse("1", $data);
	}
	
	
	 public function addImages(){
	     
        $StoryImgFiles = $_FILES['StoryImgFiles']['name'];
        $uploadDidectory = $_REQUEST['uploadDidectory']."/";
        $main_id = $_REQUEST['id'];
        
         $t=time();
		$event_folder_name = $main_id."_".$t;
		$eventDirectory = $uploadDidectory.$event_folder_name;
        mkdir($eventDirectory, 0777);
        
        
        $countfiles = count($StoryImgFiles);
            
        for($i=0;$i<$countfiles;$i++){
			
			$filename = $_FILES['StoryImgFiles']['name'][$i];
			$filesize = $_FILES['StoryImgFiles']['size'][$i];
			$fileType = $_FILES['StoryImgFiles']['type'][$i];
			$fileTempName = $_FILES['StoryImgFiles']['tmp_name'][$i];
			
			if($fileType == "application/zip"){

				$targetFilePath = $eventDirectory."/".$filename;
				
				move_uploaded_file($fileTempName, $targetFilePath);
				$zip = new ZipArchive;
				$res = $zip->open($targetFilePath);
				if ($res === TRUE) {
					$zip->extractTo($eventDirectory);
					$zip->close();
					unlink($targetFilePath);
				} else {
					echo 'Unable to extract zip !';
				}	
			}else{
				
					$str_to_arry = explode('.',$filename);
					$ext   = end($str_to_arry);
					$fileActName = $str_to_arry[0]."_".$t.'.'.$ext;
					$targetFilePath = $eventDirectory."/".$fileActName;
					move_uploaded_file($fileTempName, $targetFilePath);
			}
		}
		
		$result = "";
            
            
        $handle = opendir($eventDirectory);
			if ($handle) {
				while (($entry = readdir($handle)) !== FALSE) {
					if($entry != '.' && $entry != '..'){
						$str_to_arry = explode('.',$entry);
						$extension   = end($str_to_arry);

						if($extension == 'jpg' || $extension == 'jpeg'){
							$pth = $eventDirectory.'/'.$entry;
							$thmPth = $eventThumpDirectory."/";
							$filesize = filesize($pth);
							$thump_pth = $eventThumpDirectory.'/'.$entry;
							// print_r($eventThumpDirectory);
							//$this->cwUpload($pth, $entry, TRUE, $thmPth,'400');
							// imagejpeg($image, $destination_url, $quality);
							$qry1 = "INSERT INTO `tbeservices_folderfiles`(`file_name`, `file_size`, `services_id`, `file_path`, `thumb_image_path`) VALUES ('$entry','$filesize','$main_id', '$pth', '$thump_pth')";
				// 			echo $qry1; die;
							$result = $this->dbc->insert_row($qry1);
						}
						
					}
					
				}
			}
		closedir($handle);
		// print_r($countfiles);die;
        
		if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "Not inserted data");


		
	}




	public function addServices(){

        $category=$_REQUEST['category'];
		$event_place=$_REQUEST['event_place'];
		$main_tittle=$_REQUEST['main_tittle'];

		$description = str_replace("'", '"', $_REQUEST['description']);
		// $description=$_REQUEST['description'];
		$small_description=str_replace("'", '"', $_REQUEST['small_description']);
        $client=$_REQUEST['client'];
		$camera=$_REQUEST['camera'];

        $client = $_REQUEST['client'];
        
     
        $county_id=$_REQUEST['selCounty'];
		$state_id=$_REQUEST['selState'];
		$city_id=$_REQUEST['selCity'];
		
		$save = $_REQUEST['save'];
		
		if($save == 'update'){
		    
		    $data=array();
            $data["category"]=$_REQUEST['category'];
            $data["event_place"]=$_REQUEST['event_place'];
            $data["camera"]=$_REQUEST['camera'];
            $data["client"]=$_REQUEST['client'];
            $data["main_tittle"]=$_REQUEST['main_tittle'];
            $data["small_description"]=str_replace("'", '"', $_REQUEST['small_description']);
            $data["description"]=$description;
            $data["county_id"]=$_REQUEST['selCounty'];
            $data["state_id"]=$_REQUEST['selState'];
            $data["city_id"]=$_REQUEST['selCity'];
            
            if(isset($_FILES['ServiceCoverImgFile']['name'][0]) && $_FILES['ServiceCoverImgFile']['name'][0]!=''){
                
                $uploadDidectory = "serviceAlbumUploads/";
            
                $t=time();
        		$event_folder_name = $client."_".$t;
        		$eventDirectory = $uploadDidectory.$event_folder_name;
        		mkdir($eventDirectory, 0777);
        		$coverImgDirectory = $eventDirectory.'/coverImages';
        		mkdir($coverImgDirectory, 0777);
                $target_1 = $coverImgDirectory."_".$_FILES['ServiceCoverImgFile']['name'][0];
                move_uploaded_file($_FILES['ServiceCoverImgFile']['tmp_name'][0], $target_1);
                $data['cover_image_path']=$target_1;
            }
		    
		    $data_id=array(); $data_id["id"]=$_REQUEST['id'];
			$result=$this->dbc->update_query($data, 'tbl_services', $data_id);
			
			if($result != "")self::sendResponse("1", $result);
            else self::sendResponse("2", "Error in saving data");
		    
		}else{
		    
		
		
                    $ServiceEventFiles = $_FILES['ServiceEventFiles']['name'];
                    $coverImage = $_FILES['ServiceCoverImgFile'];
                    $uploadDidectory = "serviceAlbumUploads/";
            
                    $t=time();
            		$event_folder_name = $client."_".$t;
            		$eventDirectory = $uploadDidectory.$event_folder_name;
            
                    mkdir($eventDirectory, 0777);
            
                    $coverImgDirectory = $eventDirectory.'/coverImages';
            		$coverImgDirectoryImagePath = $coverImgDirectory.'/'.$coverImage['name'][0];
            		mkdir($coverImgDirectory, 0777);
            		move_uploaded_file($coverImage['tmp_name'][0], $coverImgDirectoryImagePath);
            
                    $eventThumpDirectory = $eventDirectory.'/'.'thumbnails';
            		mkdir($eventThumpDirectory, 0777);
            
                    $evntQry = "INSERT INTO `tbl_services`( `category`, `event_place`, `camera`, `client`, `main_tittle`, `small_description`, `description`, `file_folder`, `cover_image_path`,`county_id`,`state_id`,`city_id`) VALUES ('$category','$event_place','$camera','$client','$main_tittle','$small_description','$description','$eventDirectory','$coverImgDirectoryImagePath','$county_id','$state_id','$city_id' )";
            
            		$userFolderInsertedId = $this->dbc->insert_row($evntQry);
            
                    $countfiles = count($ServiceEventFiles);
            
                    for($i=0;$i<$countfiles;$i++){
            			
            			$filename = $_FILES['ServiceEventFiles']['name'][$i];
            			$filesize = $_FILES['ServiceEventFiles']['size'][$i];
            			$fileType = $_FILES['ServiceEventFiles']['type'][$i];
            			$fileTempName = $_FILES['ServiceEventFiles']['tmp_name'][$i];
            			
            			if($fileType == "application/zip"){
            
            				$targetFilePath = $eventDirectory."/".$filename;
            				
            				move_uploaded_file($fileTempName, $targetFilePath);
            				$zip = new ZipArchive;
            				$res = $zip->open($targetFilePath);
            				if ($res === TRUE) {
            					$zip->extractTo($eventDirectory);
            					$zip->close();
            					unlink($targetFilePath);
            				} else {
            					echo 'Unable to extract zip !';
            				}	
            			}else{
            				
            					$str_to_arry = explode('.',$filename);
            					$ext   = end($str_to_arry);
            					$fileActName = $str_to_arry[0]."_".$t.'.'.$ext;
            					$targetFilePath = $eventDirectory."/".$fileActName;
            					move_uploaded_file($fileTempName, $targetFilePath);
            			}
            		}
            		
            		$result = "";
            
            
                    $handle = opendir($eventDirectory);
            			if ($handle) {
            				while (($entry = readdir($handle)) !== FALSE) {
            					if($entry != '.' && $entry != '..'){
            						$str_to_arry = explode('.',$entry);
            						$extension   = end($str_to_arry);
            
            						if($extension == 'jpg' || $extension == 'jpeg'){
            							$pth = $eventDirectory.'/'.$entry;
            							$thmPth = $eventThumpDirectory."/";
            							$filesize = filesize($pth);
            							$thump_pth = $eventThumpDirectory.'/'.$entry;
            							// print_r($eventThumpDirectory);
            							//$this->cwUpload($pth, $entry, TRUE, $thmPth,'400');
            							// imagejpeg($image, $destination_url, $quality);
            							$qry1 = "INSERT INTO `tbeservices_folderfiles`(`file_name`, `file_size`, `services_id`, `file_path`, `thumb_image_path`) VALUES ('$entry','$filesize','$userFolderInsertedId', '$pth', '$thump_pth')";
            				// 			echo $qry1; die;
            							$result = $this->dbc->insert_row($qry1);
            						}
            						
            					}
            					
            				}
            			}
            		closedir($handle);
            		// print_r($countfiles);die;
            		
            		$isAdmin = $_SESSION['isAdmin'];
                       $isCounty_id = $_SESSION['county_id'];
                       $isState_id = $_SESSION['state_id'];
                       $isCity_id = $_SESSION['city_id'];
                       $isUsername = $_SESSION['Username'];
            
            		
                    if($_REQUEST['id']=='' ){
            			$recentActivity = new Dashboard(true);
            			$main_tittle = $_REQUEST['main_tittle'];
            			
            			
                       
                        $activityMeg =  "Services That I Provide ".$main_tittle." is created by ".$isUsername;
	
		                $recentActivity->addRecentActivity($this->dbc , $activityMeg , "create",$isCounty_id,$isState_id,$isCity_id);
            			
            			
            		
            		}else{
            			$recentActivity = new Dashboard(true);
            			$main_tittle = $_REQUEST['main_tittle'];
            			$activityMeg = "Services That I Provide ".$main_tittle." is updated by ".$isUsername;
            			$recentActivity->addRecentActivity($this->dbc , $activityMeg , "update",$isCounty_id,$isState_id,$isCity_id);
            		}
            
            
            
            
            		if($userFolderInsertedId != "")self::sendResponse("1", $evntQry);
                    else self::sendResponse("2", "Not inserted data");
                    
                    
                    
                    
		}
		


		
	}

    public function getServices(){
		$sql = "SELECT * FROM tbl_services WHERE deleted=0 ORDER BY id DESC";
		$result = $this->dbc->get_rows($sql);
    	$data=array("Services"=>$result);
		self::sendResponse("1", $data);
	}
	
	public function getServicesListData(){
	    
	    	 $isAdmin = $_SESSION['isAdmin'];
        $manage_type = $_SESSION['manage_type'];
       $city = $_SESSION['city'];
       $state = $_SESSION['state'];
       $county_id = $_SESSION['county_id'];
       $state_id = $_SESSION['state_id'];
		
		if($isAdmin){
		    
		     $sql = "SELECT a.*,b.short_name as short_name,c.state as state , s.name AS categoryD ,(SELECT GROUP_CONCAT(c.state) FROM tblstate c WHERE FIND_IN_SET(c.id, s.state_id) > 0) AS stateNames  FROM tbl_services a left join tblcountries b on a.county_id = b.country_id left join tblstate c on a.state_id = c.id LEFT JOIN tblservice_type s ON a.category = s.id
			WHERE a.deleted=0 ORDER BY a.id DESC";
			

// 			$sql = "SELECT a.*, s.name AS categoryD , b.short_name as short_name,(SELECT GROUP_CONCAT(c.state) FROM tblstate c WHERE FIND_IN_SET(c.id, s.state_id) > 0) AS state  FROM tbl_services a LEFT JOIN tblservice_type s ON a.category = s.id left join tblcountries b on s.county_id = b.country_id left join tblstate c on s.state_id = c.id 
// 			WHERE a.deleted=0 ORDER BY a.id DESC";
	
		    
		}else{
		    
		    
		      if($manage_type == 'County'){
               // user type County
               
               $sql = "SELECT a.*, s.name AS categoryD , b.short_name as short_name,(SELECT GROUP_CONCAT(c.state) FROM tblstate c WHERE FIND_IN_SET(c.id, s.state_id) > 0) AS state  FROM tbl_services a LEFT JOIN tblservice_type s ON a.category = s.id left join tblcountries b on s.county_id = b.country_id left join tblstate c on s.state_id = c.id 
			WHERE a.deleted=0 and b.country_id='$county_id' ORDER BY a.id DESC";
			
		  
           }else {
               // user type City
              
			
			$sql = "SELECT a.*, s.name AS categoryD , b.short_name as short_name,(SELECT GROUP_CONCAT(c.state) FROM tblstate c WHERE FIND_IN_SET(c.id, s.state_id) > 0) AS state  FROM tbl_services a LEFT JOIN tblservice_type s ON a.category = s.id left join tblcountries b on s.county_id = b.country_id left join tblstate c on s.state_id = c.id 
			WHERE a.deleted=0 and FIND_IN_SET($state_id, s.state_id) ORDER BY a.id DESC";
		 
               
           }
		    
		    
		    
		    
		}
	   
	     

	   
		
	

		$result = $this->dbc->get_rows($sql);
      
        if($result != "")self::sendResponse("1", $result);
        else self::sendResponse("2", "No data found");
	
	}




    public function setServicesActiveInactive(){
		$data=array();
		$data["active"]=$_REQUEST['active'];

      	$data_id=array(); $data_id["id"]=(int)$_REQUEST['id'];
		$Update=$this->dbc->update_query($data, 'tbl_Services', $data_id);

		// print_r($Deleted['AffectedRows']);
		if($Update['AffectedRows']>0){
			self::sendResponse("1", 'Record Deleted Successfully');
		}else{
			self::sendResponse("0", 'Failed in Deleting Record');
		}
	}

    public function deleteServices(){
		$data=array();
		$data["deleted"]=1;
		$data["deleted_date"]=date('Y-m-d H:i:s');

      	$data_id=array(); $data_id["id"]=(int)$_REQUEST['id'];
      	
		$Deleted=$this->dbc->update_query($data, 'tbl_services', $data_id);
		

		// print_r($Deleted['AffectedRows']);
		if($Deleted['AffectedRows']>0){

			$dlt_id = $_REQUEST['id'];
            $sql1 = "SELECT * FROM `tbl_services` WHERE id=$dlt_id ";
            $cneList = $this->dbc->get_rows($sql1);
            $tittle = $cneList[0]['main_tittle'];
            
            $isAdmin = $_SESSION['isAdmin'];
           $isCounty_id = $_SESSION['county_id'];
           $isState_id = $_SESSION['state_id'];
           $isCity_id = $_SESSION['city_id'];
           $isUsername = $_SESSION['Username'];
           
           $activityMeg = "Services That I Provide ".$tittle." is deleted by ".$isUsername;
    	$recentActivity = new Dashboard(true);
    		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "delete",$isCounty_id,$isState_id,$isCity_id);
        

			self::sendResponse("1", 'Record Deleted Successfully');
		}else{
			self::sendResponse("0", 'Failed in Deleting Record');
		}
	}

    public function deleteServicesfile(){
		
        $id=(int)$_REQUEST['id'];

        $query = "UPDATE `tbeservices_folderfiles` SET `hide`=1 WHERE `id`=$id";
        $result = $this->dbc->update_row($query);

		$dlt_id = $_REQUEST['id'];
		$sql1 = "SELECT a.* FROM `tbl_services` a left join tbeservices_folderfiles b on a.id = b.services_id WHERE b.id=$dlt_id ";
		$cneList = $this->dbc->get_rows($sql1);
		$tittle = $cneList[0]['main_tittle'];
		$recentActivity = new Dashboard(true);
		$activityMeg = "Image from Services That I Provide ".$tittle." is deleted";
		$recentActivity->addRecentActivity($this->dbc , $activityMeg , "delete");

        if(isset($result))self::sendResponse("1", "Record deleted Successfully");
        else self::sendResponse("2", "Failed In deleting Data");

		
	}

    public function getServicesId(){
		$sql = "SELECT a.*,b.short_name as county_id,c.state as state_id,d.city as city_id , s.name AS categoryD FROM tbl_services a left join tblcountries b on a.county_id = b.country_id left join tblstate c on a.state_id = c.id left join tblcity d on a.city_id = d.id LEFT JOIN tblservice_type s ON a.category = s.id WHERE a.id=".(int)$_REQUEST['id'];
		$result = $this->dbc->get_rows($sql);
    	$data=array("CMA"=>$result[0]);
		self::sendResponse("1", $data);
	}

    public function getServicesIdfiles(){
		$sql = "SELECT * FROM tbeservices_folderfiles WHERE services_id=".(int)$_REQUEST['id']." AND `hide`=0 ";
		$result = $this->dbc->get_rows($sql);
    	$data=array("SRV"=>$result);
		self::sendResponse("1", $data);
	}


    public function getServicesRec(){
        $id = (int)$_REQUEST['id'];
        $data =array();
        $sql = "SELECT * FROM tbl_services WHERE id = $id "; 
 
        $result = $this->dbc->get_rows($sql);
        
        $data["res"]=$result;
  
        self::sendResponse("1",$data);
     }

     public function getNxtPrv(){
        $id = (int)$_REQUEST['id'];
        $data =array();
        $sql = "SELECT id,main_tittle FROM tbl_services WHERE `deleted` = 0 order by id desc "; 
        $result = $this->dbc->get_rows($sql);
        $prv ='';
        $nxt ='';
        $prvName ='';
        $nxtName ='';

        if( sizeof($result) == 1){
            $prv =$result[0]['id'];
            $nxt =$result[0]['id'];
            $prvName =$result[0]['main_tittle'];
            $nxtName =$result[0]['main_tittle'];
        }else if( sizeof($result) == 2){
            $prv =$result[0]['id'];
            $nxt =$result[1]['id'];
            $prvName =$result[0]['main_tittle'];
            $nxtName =$result[1]['main_tittle'];
        }else{
            for($i=0;$i<sizeof($result);$i++){
                if( $id == $result[$i]['id'] ){
                    if($i == 0){
                        $prv =$result[0]['id'];
                        $nxt =$result[1]['id'];
                        $prvName =$result[0]['main_tittle'];
                        $nxtName =$result[1]['main_tittle'];
                    }else if($i == (sizeof($result)-1) ){
                        $prv =$result[$i-1]['id'];
                        $nxt =$result[$i]['id'];
                        $prvName =$result[$i-1]['main_tittle'];
                        $nxtName =$result[$i]['main_tittle'];
                    }else{
                        $prv =$result[$i-1]['id'];
                        $nxt =$result[$i+1]['id'];
                        $prvName =$result[$i-1]['main_tittle'];
                        $nxtName =$result[$i+1]['main_tittle'];
                    }
                }
            }


        }
        
     

        
        $data["prv"]=$prv;
        $data["prvName"]=$prvName;
        $data["nxt"]=$nxt;
        $data["nxtName"]=$nxtName;
  
        self::sendResponse("1",$data);
     }


   
     public function addShare(){
		$projId=(int)$_REQUEST['projId'];
		$name=$_REQUEST['name'];
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

	
		$recentActivity = new Dashboard(true);
        $activityMeg = "Share services that i provide ".$name;
        $recentActivity->addRecentActivity($this->dbc , $activityMeg , "share");

		$vs = "INSERT INTO `service_shares`(`service_id`, `IP` ) VALUES ('$projId','$ip')";
		$this->dbc->insert_row($vs);
	}
	
	public function addViewCount(){
	    $projId=(int)$_REQUEST['projId'];
	     if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$vs = "INSERT INTO `service_views`(`service_id`, `IP` ) VALUES ('$projId','$ip')";
		$this->dbc->insert_row($vs);

	}
	
	
	public function likeServices(){
		$user_type_val = (int) $_REQUEST["user_type_val"];
		$user_id_like = (int) $_REQUEST["user_id_like"];
		$status = (int)$_REQUEST["status"];
		$projId_id_like = (int)$_REQUEST["projId_id_like"];
		
		$sts = "";
	
		if( $status == 1 ){

		    $sql1 = "SELECT * FROM services_album_like WHERE project_id='$projId_id_like' AND user_id='$user_id_like' AND user_type='$user_type_val' ";
		    $AlbumList = $this->dbc->get_rows($sql1);
		    
		    if(sizeof($AlbumList) > 0 ){
		        $vs = "UPDATE `services_album_like` SET `active`=0 , `status`=1  WHERE `project_id`='$projId_id_like' AND `user_id`='$user_id_like' AND `user_type`='$user_type_val'  ";
		        $result = $this->dbc->update_row($vs);
		    }else{
		        $vs = "INSERT INTO `services_album_like`(`project_id`, `user_id` , `user_type`,`active`,`status` ) VALUES ('$projId_id_like','$user_id_like','$user_type_val',0,1)";
		        $result = $this->dbc->insert_row($vs);
		    }
		    
		    $sts = "liked";
		
		}else{

		    $vs = "UPDATE `services_album_like` SET `active`=0 , `status`=0  WHERE `project_id`='$projId_id_like' AND `user_id`='$user_id_like' AND `user_type`='$user_type_val'  ";
		    $result = $this->dbc->update_row($vs);
		    $sts = "dislike";
		}
		

		$sql1 = "SELECT main_tittle FROM tbl_services WHERE id=$projId_id_like ";

		$AlbumList = $this->dbc->get_rows($sql1);
		$prjName = $AlbumList[0]['main_tittle'];

		if($user_type_val == 2){
		    $chkemail = "SELECT * FROM tbeguest_users WHERE id= '$user_id_like' ";
    		$reslArr = $this->dbc->get_rows($chkemail);
    		$guestName = $reslArr[0]['name'];
		}else{
		    $chkemail = "SELECT * FROM tblcontacts WHERE id= '$user_id_like' ";
    		$reslArr = $this->dbc->get_rows($chkemail);
    		$firstname = $reslArr[0]['firstname'];
    		$lastname = $reslArr[0]['lastname'];
    		$guestName = $firstname." ".$lastname;
		}

		$recentActivity = new Dashboard(true);
        $activityMeg = "Services ".$prjName." ".$sts." by ".$guestName;
        $recentActivity->addRecentActivity($this->dbc , $activityMeg , "update");

		
		$sqlCount ="SELECT COUNT(*) as likeCount FROM services_album_like WHERE project_id = '$projId_id_like' AND status=1 AND active=0 ";
		$CountList = $this->dbc->get_rows($sqlCount);
		$likeCount = $CountList[0]['likeCount'];
		

		if($result != "")self::sendResponse("1", $likeCount);
        else self::sendResponse("2", "Error");
	}



   

}

?>