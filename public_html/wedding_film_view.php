<?php 
include("get_session.php");
require_once('admin/config.php');
// print_r($_COOKIE['guestLoginId']);
$user_data = get_session();
$guestLoginId ="0";
$logginUserName = "";
$userIdVal = "";
$userphonenumber = "";
$useremail = "";
$isDisComment = false;
$isCmtCnfrmMes = true;

$user_type_val = "";
$user_id_like = "";

$albums = [];
$selAlbums = [];
$Storiesalbums = [];
$Blogsalbums = [];




// $guestLoginId = $_COOKIE['guestLoginId'];
if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $logginUserName = $user_data['firstname']." ".$user_data['lastname'];
    $userIdVal = $user_data['contact_user_id'];
    $userphonenumber = $user_data['phonenumber'];
    $useremail = $user_data['email'];
     setcookie('guestLoginId', 0, time() + (86400 * 30), "/");
     $isDisComment = true;
     
     $isCmtCnfrmMes = false;
     $user_type_val = 1;
     $user_id_like = $user_data['contact_user_id'];
 

}else if($_COOKIE['guestLoginId'] != 0){
    if(!isset($_COOKIE['guestLoginId'])) $guestLoginId ="";
    else { $guestLoginId =$_COOKIE['guestLoginId'];
    $isDisComment = true; }
    
    if(!isset($_COOKIE['guestLoginName'])) $logginUserName ="";
    else  $logginUserName =$_COOKIE['guestLoginName'];
    
     if(!isset($_COOKIE['guestLoginPhone'])) $userphonenumber ="";
    else  $userphonenumber =$_COOKIE['guestLoginPhone'];

    if(!isset($_COOKIE['guestLoginEmail'])) $useremail ="";
    else  $useremail =$_COOKIE['guestLoginEmail'];
    
    $user_type_val = 2;
    $user_id_like = $guestLoginId;
}
else {

    if(!isset($_COOKIE['commentUserName'])) $logginUserName ="";
    else  { $logginUserName =$_COOKIE['commentUserName'];
    $isDisComment = true; }

    if(!isset($_COOKIE['commentUserPhone'])) $userphonenumber ="";
    else  $userphonenumber =$_COOKIE['commentUserPhone'];

    if(!isset($_COOKIE['commentUserEmail'])) $useremail ="";
    else  $useremail =$_COOKIE['commentUserEmail'];
      
    $userIdVal = '';
}

$projIdString = base64_decode($_REQUEST['pId']);
$arr = explode('_', $projIdString);
$projId = $arr[1];
$likeCounts = 0;

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$wSql = "SELECT *,(SELECT COUNT(*) FROM wedding_film_shares
        WHERE project_id = wedding_films.id) AS shareCounts,(SELECT COUNT(*) FROM wedding_film_views
        WHERE project_id = wedding_films.id) AS viewsCounts,(SELECT COUNT(*) FROM films_comments
        WHERE project_id = wedding_films.id AND status = 1 AND deleted = 0 ) AS commentCounts,(SELECT COUNT(*) FROM wedding_film_like
    WHERE project_id = wedding_films.id AND status=1 AND active=0 ) AS likeCounts FROM `wedding_films` WHERE `id`=$projId ";
$Wresult = $DBC->query($wSql);
$Wcount = mysqli_num_rows($Wresult);
if($Wcount > 0) {
    while ($row = mysqli_fetch_assoc($Wresult)) {
        array_push($selAlbums,$row);
        
    }
    
}else{
    header("location: index.php");
}

$user_id = $selAlbums[0]['user_id'];
$likeCounts = $selAlbums[0]['likeCounts'];

$sql = "SELECT * FROM `wedding_films` WHERE `user_id`=$user_id AND `active`=0 ORDER BY id DESC";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

if($count > 0) {	
    
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albums,$row);
        
    }
}


    $sql3 = "SELECT * FROM `stories` WHERE `deleted`=0 AND `active`=1 ORDER BY id DESC LIMIT 8";

    $result3 = $DBC->query($sql3);

    $count3 = mysqli_num_rows($result3);

    if($count3 > 0) {	
        
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($Storiesalbums,$row3);
            
        }
    }
    
    $sql4 = "SELECT a.*,b.firstname, b.lastname FROM blogs a left join tblstaff b on a.author=b.staffid WHERE a.deleted=0 AND a.active=1 ORDER BY a.id DESC LIMIT 8";

    $result4 = $DBC->query($sql4);

    $count4 = mysqli_num_rows($result4);

    if($count4 > 0) {	
        
        while ($row4 = mysqli_fetch_assoc($result4)) {
            array_push($Blogsalbums,$row4);
            
        }
    }
    
    
$totalCmt = 0;
$cmtsql = "SELECT COUNT(*) as totalCmt FROM `films_comments` WHERE status = 1 AND deleted = 0 AND project_id = '$projId' ";
$cmtresult = $DBC->query($cmtsql);
$cmtcount = mysqli_num_rows($cmtresult);
if($cmtcount > 0) {		
    while ($row = mysqli_fetch_assoc($cmtresult)) {
        $totalCmt = $row['totalCmt'] ;
    }
}




$like_status = false;

$notfy = [];
$notifi_count = 0;

if($isDisComment){
    
    
  $signatureAlbymLikeSql = "SELECT * FROM wedding_film_like WHERE project_id='$projId' AND user_id='$user_id_like' AND user_type='$user_type_val' AND active=0 ";
    $signatureAlbymLikeresult = $DBC->query($signatureAlbymLikeSql);
    $signatureAlbymLikecount = mysqli_num_rows($signatureAlbymLikeresult);
    if($signatureAlbymLikecount > 0) {		
        while ($row = mysqli_fetch_assoc($signatureAlbymLikeresult)) {
            $like_statusS = $row['status'] ;
            if($like_statusS == 1) $like_status = true;
           
        }
    }
    
    
    
    
    
   
    $sqlf = "SELECT * , CURRENT_TIMESTAMP as nowtime FROM tblrecent_activity_user
  WHERE user_id = $user_id_like AND `read`=0 AND user_type='$user_type_val' ORDER BY `created_in` desc ";
  $resultf = $DBC->query($sqlf);

  $countf = mysqli_num_rows($resultf);

  if($countf > 0) {		
      while ($rowf = mysqli_fetch_assoc($resultf)) {
          array_push($notfy,$rowf);
      }
  }

  $sqlc = "SELECT id FROM tblrecent_activity_user
  WHERE user_id = $user_id_like AND `read`=0 AND user_type='$user_type_val' ";
  $resultc = $DBC->query($sqlc);

  $notificationCount = mysqli_num_rows($resultc);
  
  if($notificationCount > 0) {		
      while ($row = mysqli_fetch_assoc($resultc)) {
          $notifi_count = $notifi_count + 1;
      }
  }
  
}









// echo $ogimage; die;
include("templates/header_signature_album.php");

?>

<style>
        /* Set equal height for columns */
        .equal-height-cols {
            display: flex;
            flex-wrap: wrap;
        }
        .equal-height-cols .col {
            display: flex;
            flex-direction: column;
        }
        .equal-height-cols .col iframe {
            flex: 1;
            width: 100%;
            height: 100%;
        }
        
        .iframe-container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%; /* 16:9 aspect ratio (height / width) */
        }
        
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>


<style>
 @media (min-width: 0) {
    .g-mr-15 {
        margin-right: 1.07143rem !important;
    }
}
@media (min-width: 0){
    .g-mt-3 {
        margin-top: 0.21429rem !important;
    }
}

.g-height-50 {
    height: 50px;
}

.g-width-50 {
    width: 50px !important;
}

@media (min-width: 0){
    .g-pa-30 {
        padding: 2.14286rem !important;
    }
}

.g-bg-secondary {
    background-color: #fff !important;
}

.u-shadow-v18 {
    box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
}

.g-color-gray-dark-v4 {
    color: #777 !important;
}

.g-font-size-12 {
    font-size: 0.85714rem !important;
}

.media-comment {
    margin-top:5px
}

.progress-bar-wrap {
    display:none;
}

#btn-back-to-bottom {
  position: fixed;
  top: 80px;
  right: 20px;
  display: none;
   z-index: 1000; /* Ensure it's above other elements */
   background-color: #804bd8;
    color: white;
}

#btn-back-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: none;
   z-index: 1000; /* Ensure it's above other elements */
   background-color: #804bd8;
    color: white;
}


</style>

                <input type="hidden" value="<?php echo $user_type_val; ?>" id="user_type_val">
                <input type="hidden" value="<?php echo $user_id_like; ?>" id="user_id_like">
                <input type="hidden" value="<?php echo $projId; ?>" id="projId_id_like">
                
                <input type="hidden" value="<?php echo $logginUserName; ?>" id="logginUserName">
                <input type="hidden" value="<?php echo $userphonenumber; ?>" id="userphonenumber">
                <input type="hidden" value="<?php echo $useremail; ?>" id="useremail">
                
                <input type="hidden" value="<?php echo $user_id; ?>" id="prjtUserId">
                
                <input type="hidden" value="<?php echo $isCmtCnfrmMes; ?>" id="isCmtCnfrmMes">
                
                <input type="hidden" value="" id="setPrjIdForCmt">
                <input type="hidden" value="3" id="numberOfDisedCmt">
                <input type="hidden" value="<?php echo $totalCmt; ?>" id="totalCmt">


            
                <div class="content-holder vis-dec-anim" style="position: unset !important;padding: 0px !important;">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container-fluid" style="max-width: 100%; padding: 0px; width: 100%;">
                                
                                
                                <div class="row" style="margin-right:0px; padding: 0px;">
                                    
                                    
                                    
                                     <section style="padding: 0px 0px;">
                                         <div class="container-fluid custom-container" > 
                                                <div  style="padding: 0px; padding-right: 0px; margin-left: 0px;">
                                                    
                                                    <div class="sticky-header">
                                                        
                                                        
                                                        
                                                        <div class="row" style="padding: 10px;">
                                                            <div class="col-lg-8 col-md-5 col-5 " >
                                                                <div class="row" style="padding-top:5px;">
                                                                    
                                                                    
                                                                     <?php if($userIdVal != ""){ ?>
                                                                     
                                                                     
                                                                        <div class="col-12 d-block d-md-none d-flex justify-content-start align-items-start" >
                                                                            
                                                                            <div class="row">
                                                                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                                                                        <h1 class="text-black new-text-sub-fond new-sa-project-name" style="text-align: start;">Wedding Films</h1>
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-start align-items-start">
                                                                                        <span class="bold-text new-text-sub-fond-1 new-sa-project-name2" >Machooos international</span>
                                                                                    </div>
                                                                    
                                                                             </div>
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="col-lg-12 col-md-12 d-none d-md-block d-flex justify-content-start align-items-start" >
                                                                            
                                                                            <div class="row">
                                                                                 <div class="col-sm-1 col-md-1 d-flex justify-content-center align-items-center">
                                                                                     
                                                                                     <a href="wedding_films.php" ><i class="bi bi-arrow-left-circle" style="font-size: 30px;"></i></a>
                                                                                     
                                                                                 </div>
                                                                                 <div class="col-sm-11 col-md-11">
                                                                                     
                                                                                     <div class="row">
                                                                                            <div class="col-12 d-flex justify-content-start align-items-start">
                                                                                                <h1 class="text-black new-text-sub-fond new-sa-project-name" style="text-align: start;">Wedding Films</h1>
                                                                                            </div>
                                                                                            <div class="col-12 d-flex justify-content-start align-items-start">
                                                                                                <span class="bold-text new-text-sub-fond-1 new-sa-project-name2" >Machooos international</span>
                                                                                            </div>
                                                                            
                                                                                     </div>
                                                                                     
                                                                                 </div>
                                                                            </div>
                                                                            
                                                                            
                                                                        </div>
                                                                     
                                                                     
                                                                     
                                                                       
                                                                    <?php }else{ ?>
                                                                    
                                                                       <div class="col-12 d-flex justify-content-start align-items-start">
                                                                            <h1 class="text-black new-text-sub-fond new-sa-project-name" style="text-align: start;">Wedding Films</h1>
                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-start align-items-start">
                                                                            <span class="bold-text new-text-sub-fond-1 new-sa-project-name2" >Machooos international</span>
                                                                        </div>
                                                                    
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                  
                                                                </div>

                                                                
                                                                
                                                            </div>
                                                            
                                                            <div class="col-7 d-block d-md-none d-flex justify-content-end align-items-end" >
                                                                <ul class="list-inline d-sm-flex my-0">
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;" id="disLikeButton">
                                                                        
                                                                        <?php if($isDisComment){ ?>
                                                             
                                                             
                                                                         <? if( $like_status ){ ?>
                                                                         
                                                                          
                                                                            <a class="btn position-relative" href="#" onclick="dislikeWeddingFilm()" style="border-color: transparent;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;">
                                                                                    
                                                                                <h3 class="" style="line-height: 1.5 !important;">
                                                                                    <i class="fa fa-heart fa-1x"></i><span style="margin-left: 5px;"><?=$likeCounts?></span>
                                                                            
                                                                                </h3> 
                                                                            </a>

                                                                         <?php }else{ ?>
                                                                         
                                                                           
                                                                            <a class="btn position-relative" href="#" onclick="likeWeddingFilm()" style="border-color: transparent;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;">
                                                                                    
                                                                                <h3 class="" style="line-height: 1.5 !important;">
                                                                                    <i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;"><?=$likeCounts?></span>
                                                                            
                                                                                </h3> 
                                                                            </a>

                                                                         <?php } ?>
                                                                         
                                                                         
                                                                           
                                                                         
                                                                         
                                                                        <?php }else{ ?>
                                                                        
                                                                            <a class="btn position-relative" href="#" onclick="showGuestUserModal()" style="border-color: transparent;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;">
                                                                                    
                                                                                <h3 class="" style="line-height: 1.5 !important;">
                                                                                    <i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;"><?=$likeCounts?></span>
                                                                            
                                                                                </h3> 
                                                                            </a>
                                                                
                                                                         

                                                                        <?php } ?>
                                                                        
                                                                    </li>
                                                                    
                                                                 
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;">
                                                                        
                                                                        <!--<button onclick="" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;">-->
                                                                        <!--    <i class="far fa-share-square fa-1x"></i>-->
                                                                        <!--</button>-->
                                                                        
                                                                        <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;">
                                                                                
                                                                            <h3 class="" style="line-height: 1.5 !important;">
                                                                                <i class="far fa-share-square fa-1x"></i><span style="margin-left: 5px;"><?=$selAlbums[0]['shareCounts']?></span>
                                                                        
                                                                            </h3> 
                                                                        </a>
                                                                        
                                                                   
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:10px;">
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <div class="row" style="padding: 15px;">
                                                                                        <div class="col-12" style="text-align: left;">
                                                                                            <span class="bold-text new-text-sub-fond-1 mobile-disply-none" style="padding-left: 15px !important;">Share : </span> 
                                                                                            <button onclick="addSAShareCount()" type="button" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>
                                                                                            </button>
                                                                                            <button type="button" class="btn position-relative" onclick="copyUrl();addSAShareCount()" style="padding-right: 0px !important;">
                                                                                                <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                        </ul>

                                                                    </li>
                                                                    
                                                                    
                                                                    
                                                                     <?php if($isDisComment){ ?>
                                                                     
                                                                     <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;">
                                                                        
                                                                     
                                                                        <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;">
                                                                                
                                                                            <h3 class="" style="line-height: 1.5 !important;">
                                                                                <i class="bi bi-bell"></i><span class="badge bg-primary badge-number" style="font-size: 9px;"><?=$notifi_count?></span>
                                                                        
                                                                            </h3> 
                                                                        </a>
                                                                                
                                                                             
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;
                                                                        overflow-y: scroll; max-height: 550px;overflow-x: hidden;background: white;padding:10px;">
                                                                            
                                                                                                                  
                                                                                                                         
                                       <li class="notification-item d-flex justify-content-end align-items-end" >
   <div class="d-flex justify-content-end align-items-end" >
                                                                             <a href="#" onclick="setAllNotificationRead(<?= $user_id_like ?>, <?= $user_type_val ?>);" style="font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;padding-bottom: 10px;
    ">Mark all as read</a>
                                                                        </div>
</li>
                                        
                                                                          <?php foreach ($notfy as $key => $notfys) { 
                                                                              
                                                                                $targetDate = new DateTime($notfys['created_in']);
                                        
                                                                                // Get the current date and time
                                                                                $currentDate = new DateTime($notfys['nowtime']);
                                                                                
                                                                                // Calculate the time difference
                                                                                $timeDifference = $currentDate->diff($targetDate);
                                                                                
                                                                                // Convert the time difference to minutes
                                                                                $minutesAgo = ($timeDifference->days * 24 * 60) +
                                                                                    ($timeDifference->h * 60) +
                                                                                    $timeDifference->i;
                                                                                    
                                                                                if($minutesAgo < 1440 ){
                                                                                    
                                                                                    $hours = floor($minutesAgo / 60);
                                                                                    if($hours == 0) $nttime = $minutesAgo . " minutes ago";
                                                                                    else $nttime = $hours . " hours ago";
                                                                                    
                                                                                    
                                                                                    
                                                                                }else{
                                                                                    $nudats = floor($minutesAgo / 1440 );
                                                                                    $nttime = $nudats . " days ago";
                                                                                    
                                                                                }
                                                                                
                                                                                
                                                                              
                                                                              
                                                                               ?>
                                        
                                                                            <li class="notification-item" >
                                                                                    <div>
                                                                                    <h4 class="text-light"><a style="letter-spacing: 2px !important;font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;letter-spacing: 2px !important;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;
    " href="<?= $notfys['url'] ?>" onclick="setNotificationRead(<?= $notfys['id'] ?>);"><?= $notfys['task'] ?></a></h4>
                                                                                    <p style="text-align: right;margin-bottom: 0rem !important;padding-bottom: 0px !important;"><?= $nttime ?></p>
                                                                                    </div>
                                                                            </li>
                                                                
                                                                            <li>
                                                                                <hr class="dropdown-divider" style="border-color: #454443;">
                                                                            </li>
                                                                            
                                                                                 
                                                                             
                                                                          <? } ?>
                                                                          
                                                                          
                                                                     
                                                                      
                                                                        <li class="dropdown-footer" >
                                                                            <a href="notifications.php" style="font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;padding-bottom:20px;
    ">Show all notifications</a>
                                                                        </li>
                                                            
                                                                        </ul><!-- End Notification Dropdown Items -->
                                                            
                                                                  </li>
                                                                    
                                                                    
                                                                 
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;">
                                                                        
                                                                        <?php if($userIdVal == ""){  
                                                                            if(!isset($_COOKIE['guestLoginId'])) $isGuestLoginId ="";
                                                                            else  $isGuestLoginId =$_COOKIE['guestLoginId'];
                                                                            
                                                                            if(!isset($_COOKIE['guestLoginName'])) $islogginUserName ="";
                                                                            else  $islogginUserName =$_COOKIE['guestLoginName'];
                                                                            
                                                                            if($isGuestLoginId != "" && $islogginUserName != "" ) $isGuestUserLoginStatus = true ;
                                                                            else $isGuestUserLoginStatus = false ;
                                                
                                                                        ?>
                                                                        
                                                                            <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;--bs-btn-padding-x: 0.25rem !important;">
                                                                                    
                                                                                <h3 class="" style="line-height: 1.5 !important;">
                                                                                    <i class="fas fa-list-ul fa-1x"></i>
                                                                            
                                                                                </h3> 
                                                                            </a>
                                                                            
                                                                           
                                                                        
                                                                      
                                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:20px;">
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="#!" style="font-size: 1rem !important;
    font-weight: 600 !important;"><?php if($isGuestUserLoginStatus )
                                                                                    { echo $islogginUserName; }else{ echo 'Guest User'; } ?></a>
                                                                                </li>
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="showEnquiryform();" ><i class="bi bi-calendar-month" style="margin-right: 5px;"></i></span>Enquire</a>
                                                                                </li>
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="viewcomments();" ><i class="far fa-comment-dots" style="margin-right: 5px;"></i></span>Comments</a>
                                                                                </li>
                                                                                
                                                                             
                                                                              
                                                                                
                                                                                <?php if($isGuestUserLoginStatus ){ ?>
                                                                                
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="logoutGuestUser();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <i class="bi bi-box-arrow-right"></i>
                                                                                    <span> Sign Out</span>
                                                                                  </a>
                                                                                </li>
                                                                                
                                                                                <?php }else{ ?>
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="showGuestUserModal();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <span> Sign In</span>
                                                                                  </a>
                                                                                </li>
                                                                                
                                                                                <?php } ?>
                                                                                
                                                                            
                                                                    
                                                                            </ul><!-- End Profile Dropdown Items -->
                                                                              
                                                                        <?php } ?>
                                                                        
                                                                        
                                                                        <?php
                                                                            if($contact_user_id){
                                                                        ?> 
                                                                        
                                                                            <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;">
                                                                                    
                                                                                <h3 class="" style="line-height: 1.5 !important;">
                                                                                    <i class="fas fa-list-ul fa-1x"></i>
                                                                            
                                                                                </h3> 
                                                                            </a>
                                                                        
                                                                          
                                                                            
                                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:20px;">
                                                                                
                                                                                 <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="#!" style="font-size: 1rem !important;
    font-weight: 600 !important;"><?=$logedUser?></a>
                                                                                </li>
                                                                                
                                                                                
                                                                                <?php if($userIdVal != ""){ ?>
                                                                                    <li style="margin-right: 10px;">
                                                                                        <a class=" new-text-sub-fond-link" href="wedding_films.php" ><i class="bi bi-arrow-left-circle" style="margin-right: 5px;"></i>Back to projects</a>
                                                                                    </li>
                                                                                <?php } ?>
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="showEnquiryform();" ><i class="bi bi-calendar-month" style="margin-right: 5px;"></i>Enquire</a>
                                                                                </li>
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="viewcomments();" ><i class="far fa-comment-dots" style="margin-right: 5px;"></i></span>Comments</a>
                                                                                </li>
                                                                                
                                                                                <?php if($userIdVal != ""){ ?>
                                                                                    <li style="margin-right: 10px;">
                                                                                        <a class=" new-text-sub-fond-link" href="javascript:void(0)" onclick="waitingforFilmAprovalModal();" style="color:red;" ><i class="bi bi-exclamation-triangle-fill" style="margin-right: 5px;"></i>Comments for approval</a>
                                                                                    </li>
                                                                                <?php } ?>
                                                                                
                                                                                
                                                                                 <li style="margin-right: 10px;" >
                                                                                     <a href="crm" id="crm_link" target="_blank" class=" new-text-sub-fond-link"><span>CRM</span> </a>
                                                                                </li>
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="logout();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <i class="bi bi-box-arrow-right"></i>
                                                                                    <span> Sign Out</span>
                                                                                  </a>
                                                                                </li>
                                   
                                 
                                                                                
                                                                                
                                                                            </ul><!-- End Profile Dropdown Items -->
                                                                        
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                        

                                                                    </li>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                     
                                                                </ul>
                                                                
                                                                
                                                                
                                                            </div>
                                                            
                                                           
                                                            
                                                            <div class="col-lg-4 col-md-4 d-none d-md-block d-flex justify-content-start align-items-start" style="padding-top:10px;">
                                                                <ul class="list-inline d-sm-flex my-0">
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;" id="disLikeButton1">
                                                                        
                                                                        <?php if($isDisComment){ ?>
                                                             
                                                             
                                                                         <? if( $like_status ){ ?>
                                                                         
                                                                             <button onclick="dislikeWeddingFilm()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;white-space: nowrap;">
                                                                                    <i class="fa fa-heart fa-1x"></i> <?=$likeCounts?>
                                                                                </button>

                                                                         <?php }else{ ?>
                                                                         
                                                                             <button onclick="likeWeddingFilm()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;white-space: nowrap;">
                                                                                    <i class="far fa-heart fa-1x"></i> <?=$likeCounts?>
                                                                            </button>

                                                                         <?php } ?>
                                                                         
                                                                         
                                                                           
                                                                         
                                                                         
                                                                        <?php }else{ ?>
                                                                        
                                                                             <button onclick="showGuestUserModal()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;white-space: nowrap;">
                                                                                <i class="far fa-heart fa-1x"></i> <?=$likeCounts?>
                                                                            </button>
                                                                            

                                                                        <?php } ?>
                                                                        
                                                                    </li>
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;">
                                                                        
                                                                         <button onclick="viewcomments();" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;white-space: nowrap;">
                                                                            <i class="far fa-comment-dots fa-1x"></i><span style="margin-left: 5px;"><?=$selAlbums[0]['commentCounts']?></span>
                                                                        </button>

                                                                    </li>
                                                                    
                                                                    
                                                                    <li class="list-inline-item g-mr-20" style="margin-right: 0rem !important;">
                                                                        
                                                                        <!--<button onclick="" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="border-color: transparent;">-->
                                                                        <!--    <i class="far fa-share-square fa-1x"></i>-->
                                                                        <!--</button>-->
                                                                        
                                                                        <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;white-space: nowrap;">
                                                                                
                                                                            <h3 class="" style="line-height: 1.5 !important;">
                                                                                <i class="far fa-share-square fa-1x"></i><span style="margin-left: 5px;"><?=$selAlbums[0]['shareCounts']?></span>
                                                                        
                                                                            </h3> 
                                                                        </a>
                                                                        
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:10px;">
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <div class="row" style="padding: 15px;">
                                                                                        <div class="col-12" style="text-align: left;">
                                                                                            <span class="bold-text new-text-sub-fond-1 mobile-disply-none" style="padding-left: 15px !important;">Share : </span> 
                                                                                            <button onclick="addSAShareCount()" type="button" id="share-fb1" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-tw1" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-em1" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>
                                                                                            </button>
                                                                                            <button type="button" onclick="addSAShareCount()" id="share-wh1" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">
                                                                                                <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>
                                                                                            </button>
                                                                                            <button type="button" class="btn position-relative" onclick="copyUrl();addSAShareCount()" style="padding-right: 0px !important;">
                                                                                                <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                        </ul>

                                                                    </li>
                                                                    
                                                                    <li class="list-inline-item g-mr-20 d-flex justify-content-end align-items-end" style="width:100%">
                                                                        
                                                                        <?php if($userIdVal == ""){  
                                                                            if(!isset($_COOKIE['guestLoginId'])) $isGuestLoginId ="";
                                                                            else  $isGuestLoginId =$_COOKIE['guestLoginId'];
                                                                            
                                                                            if(!isset($_COOKIE['guestLoginName'])) $islogginUserName ="";
                                                                            else  $islogginUserName =$_COOKIE['guestLoginName'];
                                                                            
                                                                            if($isGuestLoginId != "" && $islogginUserName != "" ) $isGuestUserLoginStatus = true ;
                                                                            else $isGuestUserLoginStatus = false ;
                                                                            
                                                                            if (strlen($islogginUserName) > 8) {
                                                                                $trimmedWord = substr($islogginUserName, 0, 8) . '..';
                                                                            } else {
                                                                                $trimmedWord = $islogginUserName;
                                                                            }
                                                
                                                                        ?>
                                                                        
                                                                            <a class="btn position-relative text-primary" href="#" data-bs-toggle="dropdown" style="border-color: transparent;">
                                                                                
                                                                                <h3 class="dropdown-toggle" style="line-height: 1.5 !important;">
                                                                                
                                                                                <i class="bi bi-person-circle fa-1x"></i>
                                                                                <span class="bold-text new-text-sub-fond-1">
                                                                                    <?php if($isGuestUserLoginStatus )
                                                                                    { echo $trimmedWord; }else{ echo 'Guest User'; } ?>
                                                                                </span> 
                                                                            
                                                                               
                                                                                
                                                                                </h3> 
                                                                                
                                                                            </a>
                                    
                                
                                    
                                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:20px;">
                                                                                
                                                                                
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="showEnquiryform();" ><i class="bi bi-calendar-month" style="margin-right: 5px;"></i></span>Enquire</a>
                                                                                </li>
                                                                                
                                                                              
                                                                                
                                                                                <?php if($isGuestUserLoginStatus ){ ?>
                                                                                
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="logoutGuestUser();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <i class="bi bi-box-arrow-right"></i>
                                                                                    <span> Sign Out</span>
                                                                                  </a>
                                                                                </li>
                                                                                
                                                                                <?php }else{ ?>
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="showGuestUserModal();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <span> Sign In</span>
                                                                                  </a>
                                                                                </li>
                                                                                
                                                                                <?php } ?>
                                                                                
                                                                            
                                                                    
                                                                            </ul><!-- End Profile Dropdown Items -->
                                                                              
                                                                        <?php } ?>
                                                                        
                                                                        
                                                                        <?php
                                                                            if($contact_user_id){
                                                                        ?> 
                                                                        
                                                                            <a class="btn position-relative text-primary" href="#" data-bs-toggle="dropdown" style="border-color: transparent;">
                                                                                
                                                                                <h3 class="dropdown-toggle" style="line-height: 1.5 !important;">
                                                                                
                                                                                <i class="bi bi-person-circle fa-1x"></i>
                                                                                <span class="bold-text new-text-sub-fond-1">
                                                                                    <?=$logedUser?>
                                                                                </span> 
                                                                            
                                                                               
                                                                                
                                                                                </h3> 
                                                                                
                                                                            </a>
                                                                            
                                                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: white;padding:20px;">
                                                                                
                                                                                <?php if($userIdVal != ""){ ?>
                                                                                    <li style="margin-right: 10px;">
                                                                                        <a class=" new-text-sub-fond-link" href="wedding_films.php" ><i class="bi bi-arrow-left-circle" style="margin-right: 5px;"></i>Back to projects</a>
                                                                                    </li>
                                                                                <?php } ?>
                                                                                
                                                                                <li style="margin-right: 10px;">
                                                                                    <a class=" new-text-sub-fond-link" href="javascript:void(0);" onclick="showEnquiryform();" ><i class="bi bi-calendar-month" style="margin-right: 5px;"></i>Enquire</a>
                                                                                </li>
                                                                                
                                                                                <?php if($userIdVal != ""){ ?>
                                                                                    <li style="margin-right: 10px;">
                                                                                        <a class=" new-text-sub-fond-link" href="javascript:void(0)" onclick="waitingforFilmAprovalModal();" style="color:red;" ><i class="bi bi-exclamation-triangle-fill" style="margin-right: 5px;"></i>Comments for approval</a>
                                                                                    </li>
                                                                                <?php } ?>
                                                                                
                                                                                
                                                                                 <li style="margin-right: 10px;" >
                                                                                     <a href="crm" id="crm_link" target="_blank" class=" new-text-sub-fond-link"><span>CRM</span> </a>
                                                                                </li>
                                                                                
                                                                                <li style="margin-top: 10px;margin-right: 20px;">
                                                                                  <a class="dropdown-item d-flex align-items-center new-text-sub-fond-link" href="#" onclick="logout();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8;color:white;">
                                                                                    <i class="bi bi-box-arrow-right"></i>
                                                                                    <span> Sign Out</span>
                                                                                  </a>
                                                                                </li>
                                   
                                 
                                                                                
                                                                                
                                                                            </ul><!-- End Profile Dropdown Items -->
                                                                        
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                        

                                                                    </li>
                                                                    
                                                                    
                                                                    
                                                                    <?php if($isDisComment){ ?>
                                                                    <li class="nav-item dropdown">
                                                                        
                                                                        <a class="btn position-relative" href="#" data-bs-toggle="dropdown" style="border-color: transparent;white-space: nowrap;">
                                                                                
                                                                            <h3 class="" style="line-height: 1.5 !important;">
                                                                                <i class="bi bi-bell "></i><span class="badge bg-primary badge-number" style="margin-left: 5px;"><?=$notifi_count?></span>
                                                                        
                                                                            </h3> 
                                                                        </a>

                                                                     
                                                          
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;
                                                                        overflow-y: scroll; max-height: 550px;overflow-x: hidden;background: white;padding:10px;">
                                                                            
                                                                                                                  
                                                                                                                         
                                       <li class="notification-item d-flex justify-content-end align-items-end" >
   <div class="d-flex justify-content-end align-items-end" >
                                                                             <a href="#" onclick="setAllNotificationRead(<?= $user_id_like ?>, <?= $user_type_val ?>);" style="font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;padding-bottom: 10px;
    ">Mark all as read</a>
                                                                        </div>
</li>
                                        
                                                                          <?php foreach ($notfy as $key => $notfys) { 
                                                                              
                                                                                $targetDate = new DateTime($notfys['created_in']);
                                        
                                                                                // Get the current date and time
                                                                                $currentDate = new DateTime($notfys['nowtime']);
                                                                                
                                                                                // Calculate the time difference
                                                                                $timeDifference = $currentDate->diff($targetDate);
                                                                                
                                                                                // Convert the time difference to minutes
                                                                                $minutesAgo = ($timeDifference->days * 24 * 60) +
                                                                                    ($timeDifference->h * 60) +
                                                                                    $timeDifference->i;
                                                                                    
                                                                                if($minutesAgo < 1440 ){
                                                                                    
                                                                                    $hours = floor($minutesAgo / 60);
                                                                                    if($hours == 0) $nttime = $minutesAgo . " minutes ago";
                                                                                    else $nttime = $hours . " hours ago";
                                                                                    
                                                                                    
                                                                                    
                                                                                }else{
                                                                                    $nudats = floor($minutesAgo / 1440 );
                                                                                    $nttime = $nudats . " days ago";
                                                                                    
                                                                                }
                                                                                
                                                                                
                                                                              
                                                                              
                                                                               ?>
                                        
                                                                            <li class="notification-item" >
                                                                                    <div>
                                                                                    <h4 class="text-light"><a style="letter-spacing: 2px !important;font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;letter-spacing: 2px !important;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;
    " href="<?= $notfys['url'] ?>" onclick="setNotificationRead(<?= $notfys['id'] ?>);"><?= $notfys['task'] ?></a></h4>
                                                                                    <p style="text-align: right;margin-bottom: 0rem !important;padding-bottom: 0px !important;"><?= $nttime ?></p>
                                                                                    </div>
                                                                            </li>
                                                                
                                                                            <li>
                                                                                <hr class="dropdown-divider" style="border-color: #454443;">
                                                                            </li>
                                                                            
                                                                                 
                                                                             
                                                                          <? } ?>
                                                                          
                                                                          
                                                                     
                                                                      
                                                                        <li class="dropdown-footer" >
                                                                            <a href="notifications.php" style="font-weight: 100 !important;margin-bottom:0rem !important;font-family: Montserrat,sans-serif !important;
    font-size: .688rem;
    font-weight: 100 !important;
    margin-bottom: 0rem !important;line-height: 1.63;
    text-transform: uppercase;padding-bottom:20px;
    ">Show all notifications</a>
                                                                        </li>
                                                            
                                                                        </ul><!-- End Notification Dropdown Items -->
                                                            
                                                                  </li>
                                                                    <?php } ?>
                                                                    
                                                                </ul>
                                                                    
                                                                    
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                    
                                                    </div>
                                                    
                                                    
                                                                                                                            
                <button
                        type="button"
                        class="btn "
                        id="btn-back-to-bottom"
                        >
                  <i class="fas fa-arrow-down"></i>
                </button>

                <button
                        type="button"
                        class="btn "
                        id="btn-back-to-top"
                        >
                  <i class="fas fa-arrow-up"></i>
                </button>
                                                    
                                                    
                                                    <div style="height: auto; background-color: #f9f9f9;">
                                                       
                                                       
                                                        <div style=" background-color: #f9f9f9;">
                                                            
                                                            <div class="row" style="padding:20px;">
                                                                
                                                                <div class="col-md-9 col-sm-12" style="padding-top: 0px;" >
                                                                    
                                                                    <div class="row">
                                                                       <div class="col-md-12 col-sm-12">
                                                                           
                                                                           <?php 
                                                                           
                                                                             $video_type1 = $selAlbums[0]['video_type'];
                                                                            if($video_type1 == 'url') $video_upload1 = $selAlbums[0]['video_upload'];
                                                                            else $video_upload1 = 'admin/'.$selAlbums[0]['video_upload'];
                                                                           
                                                                           ?>
                                                                           
                                                                           
                                                                           
                                                                          <div class="iframe-container"><iframe id="videoFrame" src="<?=$video_upload1?>" frameborder="0" allowfullscreen sandbox="allow-same-origin allow-scripts"></iframe></div>
                                                                       </div>
                                                                       <div class="col-md-12 col-sm-12" style="padding-top:20px;padding-left:20px;padding-right:20px;">
                                                                          <div class="row">
                                                                             <div class="col-12" style="text-align: left;">
                                                                                <h1 class="text-black new-text-sub-fond "><?=$selAlbums[0]['tittle']?></h1>
                                                                             </div>
                                                                             <div class="col-12" style="text-align: left;">
                                                                                <h4><?=$selAlbums[0]['sub_tittle']?></h4>
                                                                             </div>
                                                                             <?php 
                                                                          
                                                                            // $currentDate = date('Y-m-d');
                                                                            $created_date = $selAlbums[0]['created_date'];
                                                                            
                                                                            $plancreated_date = new DateTime($created_date);
                            
                                                                            // Get year, month, and day part from the date
                                                                            $year = $plancreated_date->format('Y');
                                                                            $month = $plancreated_date->format('n');
                                                                            $day = $plancreated_date->format('d');
                                                                            
                                                                            // Assuming $monthNames is an array with month names
                                                                            $monthNames = array(
                                                                                "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                            );
                                                                            
                                                                            $filmCDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                                             
                                                                             
                                                                             
                                                                             
                                                                             ?>
                                                                             <div class="col-12" style="text-align: left;">
                                                                                 <h4 style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;">Published on <?=$filmCDate?></h4>
                                                                               
                                                                             </div>
                                                                             
                                                                             
                                                                             <div class="col-12" style="text-align: left;padding-top:5px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: #999;"><?=$selAlbums[0]['viewsCounts']?> views <?=$selAlbums[0]['shareCounts']?> share <?=$selAlbums[0]['commentCounts']?> Comments</span> </div>
                                                                            
                                                                          </div>
                                                                       </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <hr>
                                                                    <div class="row" id="comentsDiv">
                                                                        
                                                                     
                                                                        <?php if($isDisComment){ ?>
                                                                            <div class="col-12">
                                                                                
                                                                                <div>
                                                                                          
                                                                                            <div class="comment-reply-form clearfix">
                                                                                                <div id="message" class="text-danger" style="padding:10px;"></div>
                                                                                                <form id="addComment" class="add-comment custom-form" style="margin-top: 0px;margin-bottom: 20px;">
                                                                                                    <fieldset>
                                                                                                        <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                                                            <div class="col-md-12 mainCommentFormTextarea" id="mainCommentFormTextarea">
                                                                                                                <textarea name="imogiText" id="imogiText" placeholder="type comments here..." data-emojiable="true" class="" style="height: 75px;"></textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                       
                                                                                                        
                                                                                                    </fieldset>
                                                                                                    
                                                                                                     <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                                                         <input type="hidden" id="projId" name="projId">
                                                                                                            <input type="hidden" id="commentId" name="commentId">
                                                                                                            
                                                                                                            
                                                                                                             <div class="col-md-12" style="font-size: 14px; text-align: right; padding-top: 10px;">
                                                                <a href="javascript:void(0)" onclick="saveFilmComments();" style="margin-right: 20px;"><span><b>Post Comment</b></span></a>
                                                                </div>
                                                                                                            
                                                                                                        <!--<div class="col-md-12" style="padding-top: 10px; ">-->
                                                                                                            
                                                                                                        <!--    <button type="button"  onclick="saveFilmComments();" id="saveCommentsButton" ><span>Submit Comment</span></button>-->
                                                                                                            
                                                                                                        <!--    <button type="button" onclick="saveFilmComments();" class=" d-none" id="updateCommentsButton"><span>Update Comment</span></button>-->
                                                                                                            
                                                                                                      
                                                                                                        <!--</div>-->
                                                                                                    </div>
                                                                                                    
                                                                                                    
                                                                                                    
                                                                                              
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                      
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                            </div>
                                                                            
                                                                         <?php }else{ ?>
                                                                                
                                                                            <div class="col-12" >
                                                                                <div class="pr-subtitle text-center new-text-sub-fond-1" style="color: #5e646a; margin-left: 0px; margin-right: 0px;"> If you are not able to comment <a href="#" onclick="showGuestUserModal();" style="color: #5e646a;text-decoration: underline;">CLICK HERE</a> </div>
                                                                                <div class="section-separator fl-wrap sp2"><span></span></div>
                                                                               
                                                                            </div>
                                                                        
                                                                        <?php } ?>
                                                                        
                                                                          
                                                                        <div class="row" id="approvedCommentListUl">
                                                                        </div>
                                                                    
                                                                    
                                                                        <div class="pagination hide" style="width: 100%;padding-top:0px;text-align: center;display: flex; justify-content: center; align-items: center;margin: 0px;" id="loadMoreBtn">
                                                                            <!--<button onclick="loadMoreFilmComments()" style="width: 40%;height: 30px;color: #fff; background: #111;" >Load more comments... <i class="bi bi-download"></i></button>-->
                                                                            
                                                                            <button onclick="loadMoreFilmComments()" id="loadMore" >Load more comments</button>
                                                                          
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                </div>
                                                                
                                                                <div class="col-md-3 col-sm-12" style="padding-top: 0px;" >
                                                                    
                                                                    <div class="row">
                                                                        
                                                                         <div class="col-12" align="left">
                                                                            <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: #0d6efd;">Wedding films</h3>
                                                                        </div>
                                                                        
                                                                    
                                                                        
                                                                        
                                                                        
                                                                                <?php
                                                                                    foreach ($albums as $key => $album) { 
                                                                                        $id = $album['id'];
                                                                                       
                                                                                       
                                                                                        // $currentDate = date('Y-m-d');
                                                                                        $created_date = $album['created_date'];
                                                                                        
                                                                                        $plancreated_date = new DateTime($created_date);
                                        
                                                                                        // Get year, month, and day part from the date
                                                                                        $year = $plancreated_date->format('Y');
                                                                                        $month = $plancreated_date->format('n');
                                                                                        $day = $plancreated_date->format('d');
                                                                                        
                                                                                        // Assuming $monthNames is an array with month names
                                                                                        $monthNames = array(
                                                                                            "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                                        );
                                                                                        
                                                                                        $filmCDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                                       
                                                                            
                                                                                        $video_type = $album['video_type'];
                                                                                        if($video_type == 'url') $video_upload = $album['video_upload'];
                                                                                        else $video_upload = 'admin/'.$album['video_upload'];
                                                                                        
                                                                                        $tittle = $album['video_type'];
                                                                                        $sub_tittle = $album['sub_tittle'];
                                                                                        
                                                                                     
                                                                                        
                                                                                          $timestamp = time(); // Get the current timestamp
                                                          
                                                                            			$id = $album['id'];
                                                                            			
                                                                            			$decodeId = base64_encode($timestamp . "_".$id);
                                                                            			
                                                                            			
                                                                            				$originalWord1 = $album['tittle'];
                                                                                        $maxLength1 = 30;
                                                                                        
                                                                                        if (strlen($originalWord1) > $maxLength1) {
                                                                                            $trimmedWord1 = substr($originalWord1, 0, $maxLength1) . '...';
                                                                                        } else {
                                                                                            $trimmedWord1 = $originalWord1;
                                                                                        }
                                                                                        
                                                                                        $originalWord2 = $album['sub_tittle'];
                                                                                         if (strlen($originalWord2) > $maxLength1) {
                                                                                            $trimmedWord2 = substr($originalWord2, 0, $maxLength1) . '...';
                                                                                        } else {
                                                                                            $trimmedWord2 = $originalWord2;
                                                                                        }
                                                                            
                                                                                        
                                                                                        
                                                                                        
                                                                                        
                                        
                                                                                    
                                                                                ?>
                                                                                
                                                                                
                                                                                 <a style="position: unset !important;" href="wedding_film_view.php?pId=<?=$decodeId?>" >
                                                                                    <div class="row " style="padding-bottom:10px;">
                                                                                        
                                                                                        
                                                                                        <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                                            
                                                                                            
                                                                                            
                                                                                            <div class="gallery-item" style="position: relative; width: 100% !important;">
                                                                                                <div class="grid-item-holder">
                                                                                                    <div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">
                                                                                                        
                                                                                                        
                                                                                                         <?php if( $album['cover_image'] == ""){ ?>
                                                                            
                                                                           
                                                                                                        <div class="image-container justify-content-center align-items-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                                                                                            
                                                                                                            
                                                                                                             <?php if($video_type == 'url'){ 
                                                                                    $embedUrl = $album['video_upload'];
                                                                                     preg_match('/embed\/([a-zA-Z0-9_-]+)/', $embedUrl, $matches);
                                                                                      if (count($matches) > 1) { ?>
                                                                                          
                                                                                          <img style="width: 100%;" src="https://img.youtube.com/vi/<?=$matches[1]?>/maxresdefault.jpg" alt="">
                                                                                    <?php  }else{ ?>
                                                                                          
                                                                                          <img style="width: 100%;" src="images/no-cov.jpg" alt="">
                                                                                    <?php  }
                                                                                
                                                                                }else{ ?>
                                                                                
                                                                                    <img style="width: 100%;" src="images/no-cov.jpg" alt="">
                                                                                    
                                                                                <?php } ?>
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                            
                                                                                                            
                                                                <!--<img style="width: 100%;" src="images/no-cov.jpg" alt="">-->
                                                            </div>
                                                                                
                                                                            <?php }else{ ?>
                                                                            
                                                                            
                                                                                                        <div class="image-container justify-content-center align-items-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                                                <img style="width: 100%;" src="admin/<?=$album['cover_image']?>" alt="">
                                                            </div>
                                                                                
                                                                            <?php } ?>
                                                                                                        
                                                                                                       
                                                            
                                                            
                                                            
                                                            
                                                                                                        
                                                                               <div class="grid-item-holder_title " style="bottom: 35% !important;">
                                                                                   
                                                                                    <img src="images/play button.svg" alt="" style="background: transparent;width: 30%;height: 30%;">
                                                                                </div>

                                                                                                        
                                                                                                        
                                                                                                        
                                                                                                        <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="wedding_film_view.php?pId=<?=$decodeId?>" ></div>

                                                                                                    </div>
                                                                                                </div>
                                                                                                 
                                                                                            </div>
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                       
                                                                                     
                                                                                            
                                                                                              <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                                                                                
                                                                                               <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord1?></h4>
                                                                                                    <h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$trimmedWord2?></h4>
                            
                                                                                               <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$filmCDate?></h4>
                                                                                                
                                
                                                                                               
                                                                                            </div>
                                                                                        
                                                                                        
                                                                                        
                                                                                       
                                                                                    
                                                                                
                                                                                    </div>
                                                                                </a>
                                                                                
                                                                                
                                                                                
                                                                                   
                                                                                    
                                                                                <?php } ?>
                                                                           
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                     <?php if(count($Storiesalbums) > 0) { ?>
                                                                     <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" align="left">
                                                                                <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: #0d6efd;">Recent Stories</h3>
                                                                            </div>
                                                                                        
                                                                                     
                                                                                
                                                                                        <?php
                                                                                            foreach ($Storiesalbums as $key => $album) { 
                                                                                                $event_date = $album['event_date'];
                                                                                                
                                                                                                $event_date1 = new DateTime($event_date);
                                                
                                                                                                // Get year, month, and day part from the date
                                                                                                $year = $event_date1->format('Y');
                                                                                                $month = $event_date1->format('n');
                                                                                                $day = $event_date1->format('d');
                                                                                                
                                                                                                // Assuming $monthNames is an array with month names
                                                                                                $monthNames = array(
                                                                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                                                );
                                                                                                
                                                                                                $formattedDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                                                                
                                                                                                $timestamp = time(); // Get the current timestamp
                                                                                              
                                                                                    			$id = $album['id'];
                                                                                    			
                                                                                    			$decodeId = base64_encode($timestamp . "_".$id);
                                                                                    			
                                                                                    			$originalWord = $album['main_tittle'];
                                                                                                $maxLength = 30;
                                                                                                
                                                                                                if (strlen($originalWord) > $maxLength) {
                                                                                                    $trimmedWord = substr($originalWord, 0, $maxLength) . '...';
                                                                                                } else {
                                                                                                    $trimmedWord = $originalWord;
                                                                                                }
                                                                                           
                                                                                        ?>
                                                                                        <a style="position: unset !important;" href="stories.php?id=<?=$decodeId?>" >
                                                                                            <div class="row " >
                                                                                                
                                                                                                <?php if($album['video'] == ""){ ?>
                                                                                                
                                                                                                    <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 5px;">
                                                                                                        <div class="gallery-item" style="width: 100% !important;">
                                                                                                            
                                                                                                            <div class="grid-item-holder">
                                                                                                                <div class="image-container justify-content-center align-items-center" style="width: 100%; max-height: 160px; overflow: hidden;">
                                                                                                                <img style="width: 100%;" src="admin/<?=$album['image_story']?>" alt="">
                                                                                                            </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                     <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                                                                                        
                                                                                                       <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                            <h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['event_place']?></h4>
                                    
                                                                                                       <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                                                                                        
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                    
                                                                                                <?php }else{ 
                                                                                                    $vdolink = $album['video'];
                                                                                                    $trimmedString1 = substr($vdolink, 0, 11);
                                                                                                if($trimmedString1 == 'storyImages'){ ?>
                                                                                                
                                                                                                     <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                                                        <div class="gallery-item" style="position: relative; width: 100% !important;">
                                                                                                            <div class="grid-item-holder">
                                                                                                                <div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">
                                                                                                                    <iframe src="./admin/<?=$vdolink?>" frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" sandbox="allow-same-origin allow-scripts"></iframe>
                                                                                                                    
                                                                                                                    <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="stories.php?id=<?=$decodeId?>" ></div>
            
                                                                                                                </div>
                                                                                                            </div>
                                                                                                             
                                                                                                        </div>
                                                                                                    </div>
                                                                                                
                                                                                                
                                                                                                
                                                                                                    
                                                                                                      <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                                                                                        
                                                                                                       <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                            <h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['event_place']?></h4>
                                    
                                                                                                       <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                                                                                        
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                
                                                                                                
                                                                                                
                                                                                               
                                                                                                    
                                                                                                <?php }else{ ?>
                                                                                                
                                                                                                
                                                                                                   <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                                                    <div class="gallery-item" style="position: relative; width: 100% !important;">
                                                                                                        <div class="grid-item-holder">
                                                                                                            <div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">
                                                                                                                <iframe src="<?=$vdolink?>"  frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" sandbox="allow-same-origin allow-scripts"></iframe>
                                                                                                                
                                                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="stories.php?id=<?=$decodeId?>" ></div>
        
                                                                                                            </div>
                                                                                                        </div>
                                                                                                         
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                                    
                                                                                                    <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                                                                                        
                                                                                                       <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                            <h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['event_place']?></h4>
                                    
                                                                                                       <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                                                                                        
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                    
                                                                                                <?php } } ?>
                                                                                        
                                                                                              
                                                                                                
                                                                                                
                                                                                       
                                                                                            
                                                                                        
                                                                                            </div>
                                                                                        </a>
                                                                                            
                                                                                        <?php } ?>
                                                                                   
                                                                                
                                                                        </div>
                                                                        
                                                                        
                                                                    <? } ?>
                                                                    
                                                                    
                                                                    
                                                                    <?php if(count($Blogsalbums) > 0) { ?>
                                                                    <hr>
                                                                        <div class="row">
                                                                            <div class="col-12" align="left">
                                                                                <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: #0d6efd;">Recent Blogs</h3>
                                                                            </div>
                                                                                        
                                                                                     
                                                                                
                                                                                        <?php
                                                                                            foreach ($Blogsalbums as $key => $album) { 
                                                                                                $event_date = $album['posted_date'];
                                                                                                
                                                                                                $event_date1 = new DateTime($event_date);
                                                
                                                                                                // Get year, month, and day part from the date
                                                                                                $year = $event_date1->format('Y');
                                                                                                $month = $event_date1->format('n');
                                                                                                $day = $event_date1->format('d');
                                                                                                
                                                                                                // Assuming $monthNames is an array with month names
                                                                                                $monthNames = array(
                                                                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                                                );
                                                                                                
                                                                                                $formattedDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                                                                
                                                                                                $timestamp = time(); // Get the current timestamp
                                                                                              
                                                                                    			$id = $album['id'];
                                                                                    			
                                                                                    			$decodeId = base64_encode($timestamp . "_".$id);
                                                                                    			
                                                                                    			$originalWord = $album['tittle'];
                                                                                                $maxLength = 30;
                                                                                                
                                                                                                if (strlen($originalWord) > $maxLength) {
                                                                                                    $trimmedWord = substr($originalWord, 0, $maxLength) . '...';
                                                                                                } else {
                                                                                                    $trimmedWord = $originalWord;
                                                                                                }
                                                                                           
                                                                                        ?>
                                                                                        <a style="position: unset !important;" href="blogs.php?pId=<?=$decodeId?>" >
                                                                                            
                                                                                            <div class="row " >
                                                                                        
                                                                                              
                                                                                                
                                                                                                
                                                                                                <?php if($album['video'] == ""){ ?>
                                                                                                
                                                                                                    <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 5px;">
                                                                                                        <div class="gallery-item" style="width: 100% !important;">
                                                                                                            
                                                                                                            <div class="grid-item-holder">
                                                                                                                <div class="image-container justify-content-center align-items-center" style="width: 100%; max-height: 160px; overflow: hidden;">
                                                                                                                <img style="width: 100%;" src="admin/<?=$album['image']?>" alt="">
                                                                                                            </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                     <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                    
                                                                                                        <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                                <h4  style="text-align: left;color:#757373;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['firstname']?> <?=$album['lastname']?></h4>
                                    
                                        
                                                                                                        <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                    
                                                                                                <?php }else{ 
                                                                                                    $vdolink = $album['video'];
                                                                                                    $trimmedString1 = substr($vdolink, 0, 10);
                                                                                                if($trimmedString1 == 'blogImages'){ ?>
                                                                                                
                                                                                                
                                                                                                   <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                                                    <div class="gallery-item" style="position: relative; width: 100% !important;">
                                                                                                        <div class="grid-item-holder">
                                                                                                            <div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">
                                                                                                                <iframe src="./admin/<?=$vdolink?>"  frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" sandbox="allow-same-origin allow-scripts"></iframe>
                                                                                                                
                                                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="blogs.php?pId=<?=$decodeId?>" ></div>
        
                                                                                                            </div>
                                                                                                        </div>
                                                                                                         
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                                 
                                                                                                    
                                                                                                     <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                    
                                                                                                        <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                                <h4  style="text-align: left;color:#757373;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['firstname']?> <?=$album['lastname']?></h4>
                                    
                                        
                                                                                                        <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                
                                                                                              
                                                                                                    
                                                                                                <?php }else{ ?>
                                                                                                
                                                                                                <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                                                    <div class="gallery-item" style="position: relative; width: 100% !important;">
                                                                                                        <div class="grid-item-holder">
                                                                                                            <div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">
                                                                                                                <iframe src="<?=$vdolink?>"  frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" sandbox="allow-same-origin allow-scripts"></iframe>
                                                                                                                
                                                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="blogs.php?pId=<?=$decodeId?>" ></div>
        
                                                                                                            </div>
                                                                                                        </div>
                                                                                                         
                                                                                                    </div>
                                                                                                </div>
                                                                                                
                                                                                                
                                                                                                
                                                                                              
                                                                                                    
                                                                                                    <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">
                                    
                                                                                                        <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                                                                <h4  style="text-align: left;color:#757373;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['firstname']?> <?=$album['lastname']?></h4>
                                    
                                        
                                                                                                        <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$formattedDate?></h4>
                                        
                                                                                                       
                                                                                                    </div>
                                                                                                    
                                                                                                <?php } } ?>
                                                                                       
                                                                                            
                                                                                        
                                                                                            </div>
                                                                                           
                                                                                        </a>
                                                                                            
                                                                                        <?php } ?>
                                                                                   
                                                                                
                                                                        </div>
                                                                        
                                                                    <? } ?>
                                                                     
                                 
                                                                    
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            
                                                            
                                                            
                                                            
                                                         
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                  
                                                </div>
                                         </div> 
                                    </section>
                                    
                                    
                                 
                                    
                                  
                                </div>
                                
                                
                                   
                         
                                
                                
                            </div>
                            <!-- content end -->
                            <div class="clearfix"></div>
                            <?php  include("templates/footer-tpl-sa-new.php"); ?>
                        </div>
                    </div>
                </div>
                <!-- content-holder end -->
                

    
 <?php 
 
 include("templates/footer.php");
 
 ?>


<style type="text/css">


.swal2-input {
  color: white;
}

    .elem
    { 
        display: inline-block;
        background: #fff;
        padding-left: 1.5%;
        padding-right: 1.5%;
        padding-top: 3%; 
        margin: 0; 
        width: 100%;
        -webkit-transition:1s ease all;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        /* box-shadow: 2px 2px 4px 0 #ccc; */
    }

    .masonry { /* Masonry container */
        -webkit-column-count: 5;
    -moz-column-count:5;
    column-count: 5;
    -webkit-column-gap: 1em;
    -moz-column-gap: 1em;
    column-gap: 1em;
    margin: 0em;
        padding: 15px;
        -moz-column-gap: 1.5em;
        -webkit-column-gap: 1.5em;
        column-gap: 1.5em;
        font-size: .85em;
    }
    .elem img{max-width:100%; height: auto;}
    .lcl_txt{
        display: none !important;
    }

    element.style {
        /* background: #804bd8; */
        /* color: #fff; */
        /* font-size: 16px; */
    }
    .image figcaption{
position: absolute;
top: 50%;
bottom: 50%;
left: 40%;
}
    .nav-tabs .nav-link {
        font-size: 14px;
        color: #000000;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background: #000000;
        color: #ffffff;
        font-size: 16px;
    }
    @media (min-width:320px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid #ccc;
            padding: 0px 3px;
            position: absolute;
            top: 10px;
            right: 10px;
            background: #fff;
            cursor: pointer;
            z-index: 9;
            font-size: 16px;
            color: #8c8585;
            height: 22px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:480px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid #ccc;
            padding: 0px 3px;
            position: absolute;
            top: 10px;
            right: 10px;
            background: #fff;
            cursor: pointer;
            z-index: 9;
            font-size: 16px;
            color: #8c8585;
            height: 22px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:600px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid #ccc;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: #fff;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #8c8585;
            height: 32px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:801px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid #ccc;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: #fff;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #8c8585;
            height: 32px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:1025px) {
        .btPpop{
            border-radius: 50%;
            border: 1px solid #ccc;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: #fff;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #8c8585;
            height: 32px;
        }
        .commentsListDiv{
            width: 60%;
        }
    }
    .subMenu{
        font-size: 16px;
        color: #8391a1;
        /* border-right: 1px solid #ccc; */
        padding: 10px;
    }
    .mainCommentFormTextarea .emoji-picker-icon{
        left: 20px !important;
    }
    
    
    
    

#loadMore {
  width: 200px;
  color: #6b6b6b;
  display: block;
  text-align: center;
  margin: 10px auto;
  padding: 2px;
  border-radius: 10px;
  border: 1px solid #6b6b6b;
  background-color: #fff;
  transition: .3s;
  text-decoration: none;
}
#loadMore:hover {
  color: #fff;
  background-color: #6b6b6b;
  border: 1px solid #6b6b6b;
  text-decoration: none;
}

.lightbox .lb-image {
   
    border: 0px solid #fff !important;
}
</style>

<script>


// Get the iframe element
  const iframe = document.getElementById('videoFrame');

  // Add an event listener for when the iframe is loaded
  iframe.onload = function () {
    // Access the contentDocument of the iframe
    const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;

    // Find all video elements within the iframe's content
    const videoElements = iframeDocument.querySelectorAll('video');
    
     // Add an event listener to disable the contextmenu event within the iframe
                        iframeDocument.addEventListener('contextmenu', function (e) {
                          e.preventDefault(); // Prevent the context menu from appearing
                        });

    // Loop through each video element and disable download
    videoElements.forEach((video) => {
      video.controlsList.add('nodownload');
      video.disablePictureInPicture = true;
    });
  };




  var mybutton = document.getElementById("btn-back-to-bottom");
        var mybutton1 = document.getElementById("btn-back-to-top");
        
        scrollFunction();
        scrollFunction1();
        
        
        window.onscroll = function () {
          scrollFunction();
          scrollFunction1();
        };
        
        function scrollFunction() {
          if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
          ) {
            mybutton.style.display = "none";
          } else {
            mybutton.style.display = "block";
          }
        }
        
        function scrollFunction1() {
          if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
          ) {
            mybutton1.style.display = "block";
          } else {
            mybutton1.style.display = "none";
          }
        }
        
        
        mybutton.addEventListener("click", backToBottom);
        mybutton1.addEventListener("click", backToTop);

        function backToBottom() {
                var element = document.getElementById('footerDiv');
              if (element) {
                element.scrollIntoView({
                  behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
                  block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
                  inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
                });
              }
        }
        
        function backToTop() {
         document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        





   
    document.addEventListener("DOMContentLoaded", function(event) { 

        // Uses sharer.js 
        //  https://ellisonleao.github.io/sharer.js/#twitter  
        var shareUrl = window.location.href;
        var shareTitle = document.title;
        var shareSubject = "Read this good article";
        var shareImage = "yourTwitterUsername";
        var shareDescription = "yourTwitterUsername";


        //facebook
        $('#share-fb').attr('data-url', shareUrl).attr('data-sharer', 'facebook');
        //twitter
        $('#share-tw').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'twitter');
        //linkedin
        $('#share-li').attr('data-url', shareUrl).attr('data-sharer', 'linkedin');
        // google plus
        $('#share-wh').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'whatsapp');
        // email
        $('#share-em').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-subject', shareSubject).attr('data-sharer', 'email');
        
        //facebook
        $('#share-fb1').attr('data-url', shareUrl).attr('data-sharer', 'facebook');
        //twitter
        $('#share-tw1').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'twitter');
        //linkedin
        $('#share-li1').attr('data-url', shareUrl).attr('data-sharer', 'linkedin');
        // google plus
        $('#share-wh1').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'whatsapp');
        // email
        $('#share-em1').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-subject', shareSubject).attr('data-sharer', 'email');
        window.Sharer.init();


    });
  $( document ).ready(function() {
    
        var url      = window.location.href;
        var currentUrl = getUrlParameter('pId');
     
        lc_lightbox('.elem', {
            wrap_class: 'lcl_fade_oc',
            gallery : true,	
            thumb_attr: 'data-lcl-thumb',
            skin: 'minimal',
            radius: 0,
            padding	: 0,
            border_w: 0,
            deeplink: true,
            img_zoom: true,
        });
        
        getFilmProjectComments();
        addViewCount();
    
  });

  function getUrlParameter(sParam){
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

function addViewCount(){
     
    var url      = window.location.href;
    var currentUrl = getUrlParameter('pId');
    var projIdString = Base64.decode(currentUrl);
    var arr = projIdString.split('_');
    var projId = arr[1];
         
    successFn = function(resp)  {
    }
    data = { "function": 'WeddingFilms',"method": "addView" ,"projId":projId};
    apiCall(data,successFn);



}


function addSAShareCount(){
     
    var url      = window.location.href;
    var currentUrl = getUrlParameter('pId');
    var projIdString = Base64.decode(currentUrl);
    var arr = projIdString.split('_');
    var projId = arr[1];
         
    successFn = function(resp)  {
    }
    data = { "function": 'WeddingFilms',"method": "addShare" ,"projId":projId};
    apiCall(data,successFn);



}
        


function showGustRegister() {
    var commentUserName = $("#commentUserName").val();
    var commentUserEmail = $("#commentUserEmail").val();
    var commentUserPhone = $("#commentUserPhone").val();


    var formData2 = new FormData();
    formData2.append('function', 'Comments');
    formData2.append('method', 'getGuestUserDetails');
    formData2.append('UserEmail', commentUserEmail );    
    
    successFn = function(resp)  {
        if(resp.status == 1){
            var name = resp.data.name;
            var email = resp.data.email;
            var phone = resp.data.phone;
            $('#firstname').val(name);
            $('#email').val(email);
            $('#contact_phonenumber').val(phone);
        }
    }
    errorFn = function(resp){
        console.log(resp);
    }
    apiCallForm(formData2,successFn,errorFn);

}

function saveFilmComments(){
    var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    
    var projId_id_like = $("#projId_id_like").val();
    
    var logginUserName = $("#logginUserName").val();
    var userphonenumber = $("#userphonenumber").val();
    var useremail = $("#useremail").val();
    
    var prjtUserId = $("#prjtUserId").val();
    
    var commentId = $("#commentId").val();
    
    var imogiText = $("#imogiText").val();
    var confmMsg = "You want to post this comment";
    var successMsg = "Comment posted successfully";
    if(commentId !=""){
        confmMsg = "You want to update this comment";
        successMsg = "Comment updated successfully";
    }

    if(imogiText == ""){
        $("#message").html("Comment could not be empty !");
        $("#imogiText").focus();
        return false;
    }else{
        $("#message").html("");
    }
    
    var isCmtCnfrmMes = $("#isCmtCnfrmMes").val();
    
    var form = $("#addComment");
    var formData = new FormData(form[0]);
    formData.append('function', 'Comments');
    formData.append('method', 'saveFilmComments');
    formData.append('save', "add");
    formData.append('user_type_val', user_type_val);
    formData.append('user_id_like', user_id_like);
    formData.append('projId_id_like', projId_id_like);
    formData.append('logginUserName', logginUserName);
    formData.append('userphonenumber', userphonenumber);
    formData.append('useremail', useremail);
    formData.append('prjtUserId', prjtUserId);
    
     return new swal({
            title: "Are you sure?",
            text: confmMsg,
            icon: false,
            // buttons: true,
            // dangerMode: true,
            confirmButtonText: 'Yes',
            showCancelButton: true
            }).then((confirm) => {
                if (confirm.isConfirmed) {
                    
                    successFn = function(resp)  {
                        if(resp.status == 1){
                            getFilmWaitingApprovalComments();
                            getFilmProjectComments();
                            
                            if(commentId !=""){
                                 swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: successMsg,
                                    showConfirmButton: false,
                                    timer: 2000

                                });
                            }else{
                                if(isCmtCnfrmMes == 1 && resp.data.approval_status == 0){
                                    

                                    swal.fire({
                                        icon: 'success',
                                        title: 'Need the permission of Admin ',
                                        text:'The comment will be shown in the wedding film when the admin will approve',
                                        showCancelButton: true,
                                        showConfirmButton: false,
                                        cancelButtonText: 'Ok',
                                        

                                    });
                                    
                                }else{
                                     swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: successMsg,
                                        showConfirmButton: false,
                                        timer: 2000

                                    });
                                    
                                }
                                
                                
                            }
                            
                            
                           
                            
                            
                            
                            if(commentId !=""){
                                $("#commentId").val("");
                            }
                            
                            $("#imogiText").val("");
    
                        }
                    }
                    errorFn = function(resp){
                        console.log(resp);
                    }
        
                    apiCallForm(formData,successFn,errorFn);
                }else{
                    console.log("sdsds");
                }
        });
    
    
    
 
    
}



function getFilmProjectComments(){
    
    var projId = $("#projId_id_like").val();
    
    var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    
    
    var isDisComment = $("#isDisComment").val();

    $("#setPrjIdForCmt").val(projId);
    
    var numberOfDisedCmt = $("#numberOfDisedCmt").val();
     var totalCmt = $("#totalCmt").val();
     
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            $.each(data, function(key,value) {
                
                
                
                html += '<div class="col-12">';
                html += '<div class="media g-mb-30 media-comment">';
                html += '<div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">';
                                        
                html += '<div class="row no-padding">';
                
                
                                        
                html += '<div class="col-1 align-items-center justify-content-center">';
                                            
                html += '<img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="images/comment-dp-img.png" >';
                                            
                                        
                html += '</div>';
                                        
                html += '<div class="col-8 align-items-left justify-content-left no-padding comment-heading">';
                
                                           
                html += '<cite class="fn" style="margin-bottom: 0px"><a>'+value.name+'</a><br> <a class="new-text-sub-fond-small" style="font-size: 0.7rem !important;color: #777 !important;">'+dateFormat(value.created_in)+'</a></cite>';
                                        
                html += '</div>';
                
                html += '<div class="col-3 d-flex justify-content-end align-items-end" >';
                
                if(user_id_like == ""){
                     html += '<a href="javascript:void(0)" onclick="showGuestUserModal();" style="margin-right: 15px;"><i class="fas fa-reply" style="font-size:12px"></i></a>';
                    
                }else{
                     html += '<a href="javascript:void(0)" onclick="replyFilmComment('+value.id+',`'+value.name+'`);" style="margin-right: 15px;"><i class="fas fa-reply" style="font-size:12px"></i></a>';
                }
                
               
                
                if( ( value.user_type == user_type_val && value.commented_user_id == user_id_like ) || value.user_id == user_id_like )  {
                    
                    
                    html += '<a href="javascript:void(0)" onclick="editFilmMainComment('+value.id+');" style="margin-right: 15px;"><i class="fas fa-pen" style="font-size:12px"></i></a>';

                    html += '<a href="javascript:void(0)" onclick="deleteFilmMainComment('+value.id+');" style="margin-right: 15px;"><i class="fas fa-trash" style="font-size:12px"></i></a>';

                    
                }                         
                                   
                html += '</div>';
                
                
                
                html += '<div class="col-1 align-items-center justify-content-center">';
                html += '</div>';
                
                
                html += '<div class="col-11 d-flex justify-content-start align-items-start comment-row-img-set" >';
                
                
                
                html += '<p id="commentDisplayDiv_'+value.id+'" class="comment-new-img-p-front" style="padding-bottom: 4px !important;margin-bottom: 0rem !important;">'+value.comment+'</p>';
                
                html += '</div>';
                                    
                
                
                html += '<div id="commentEditDiv_'+value.id+'" class="row d-none" style="padding: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">';
                html += '<div class="col-12 mainCommentFormTextarea" >';
                
                
                html += '<textarea name="commentsEditText_'+value.id+'" id="commentsEditText_'+value.id+'" placeholder="Your reply:" data-emojiable="true" class="" style="height: 75px;width: 90%;">'+value.comment+'</textarea>';
             
                
                html += '</div>';
                
              
                html += '<div class="col-12" style="font-size: 14px; text-align: right; padding-top: 10px;">';
                html += '  <a href="javascript:void(0)" onclick="cancelCommentsUpdate('+value.id+');" style="margin-right: 20px;"><span><b>Cancel</b></span></a>';
                html += '  <a href="javascript:void(0)" onclick="updateFilmComment('+value.id+', '+value.project_id+');" style="margin-right: 20px;"><span><b>Update</b></span></a>';
                html += '  </div>';

                
                html += '</div>';
                
                
        
                                     
                html += '<div class="row no-padding">';
                
                html += '<div class="col-1 align-items-center justify-content-center">';
                html += '</div>';
                
                
                                        
                html += '<div class="col-7 d-flex align-items-left justify-content-left comment-row-img-set">';
                                              
                html += '<ul class="list-inline d-sm-flex my-0" style="padding-left:18px;">';
                
                
                
                if(user_id_like == ""){

                    html += '<li class="list-inline-item g-mr-20">';
                                                      
                    html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="showGuestUserModal();" style="border-color: transparent;">';
                                                       
                    html += ' <i class="far fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i> '+value.commentLikeCount;
                                                      
                    html += '</a>';
                                                    
                    html += '</li>';
                    
                    html += '<li class="list-inline-item g-mr-20">';
                                                      
                    html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="showGuestUserModal();" style="border-color: transparent;">';
                                                       
                    html += ' <i class="far fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i> '+value.commentDislikeCount;
                                                      
                    html += '</a>';
                                                    
                    html += '</li>';
                    
                    
                    
                }else{
                     
             
                    if(value.commentLikeStatus == 1){
                        
                        html += '<li class="list-inline-item g-mr-20">';
                                                      
                        html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="addFilmLikeDislikeComment('+value.id+',0,'+ parseInt(projId) +');" style="border-color: transparent;">';
                                                           
                        html += ' <i class="fas fa-thumbs-up g-pos-rel g-top-1 g-mr-3" ></i> '+value.commentLikeCount;
                                                          
                        html += '</a>';
                                                        
                        html += '</li>';
                        
                        
                        
                    }else{
                        
                        html += '<li class="list-inline-item g-mr-20">';
                                                      
                        html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="addFilmLikeDislikeComment('+value.id+',1,'+ parseInt(projId) +');" style="border-color: transparent;">';
                                                           
                        html += ' <i class="far fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i> '+value.commentLikeCount;
                                                          
                        html += '</a>';
                                                        
                        html += '</li>';
                        
                    }
                    
                    if(value.commentLikeStatus == 2){
                        
                        html += '<li class="list-inline-item g-mr-20">';
                                                      
                        html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="addFilmLikeDislikeComment('+value.id+',0,'+parseInt(projId)+');" style="border-color: transparent;">';
                                                           
                        html += ' <i class="fas fa-thumbs-down g-pos-rel g-top-1 g-mr-3" ></i> '+value.commentDislikeCount;
                                                          
                        html += '</a>';
                                                        
                        html += '</li>';
                        
                    }else{
                        
                        html += '<li class="list-inline-item g-mr-20">';
                                                      
                        html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="addFilmLikeDislikeComment('+value.id+',2,'+parseInt(projId)+');" style="border-color: transparent;">';
                                                           
                        html += ' <i class="far fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i> '+value.commentDislikeCount;
                                                          
                        html += '</a>';
                                                        
                        html += '</li>';
                    
                        
                    }
                }
                
                
                                               
                html += ' <li class="list-inline-item ml-auto">';
                                                 
                html += ' <a style="border-color: transparent;" class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="showViewReplyComment('+value.id+');" >';
                                                   
                html += ' <i class="far fa-comment g-pos-rel g-top-1 g-mr-3"></i> '+value.commentCount+' ';
                                                 
                html += ' </a>';
                                           
                html += '     </li>';
                                              
                html += '</ul>';
                                            
                                        
                html += '</div>';
                
                html += '<div class="col-4 d-flex justify-content-end align-items-end" id="commentReplyShowDiv_'+value.id+'" >';
                
                if(value.commentCount > 0){
                
                    html += '<ul class="list-inline d-sm-flex my-0">';
                                                    
                    html += '<li class="list-inline-item g-mr-20">';
                                                      
                    html += '<a class="u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" href="javascript:void(0)" onclick="showViewReplyComment('+value.id+');" >';
                                                       
                    html += ' Show replyes';
                                                      
                    html += '</a>';
                                                    
                    html += '</li>';
                    
                    html += '</ul>';
                }
                
                
                
                html += '</div>';
                                        
               
                                    
                html += '</div>';
                
                
                html += '<div id="replyCommentDiv_'+value.id+'" ></div>';

                html += '<div class="no-padding" id="commentReplyDiv_'+value.id+'">';
                
                
                
                html += '<div class="row no-padding">'; 
                html += '<div class="col-1 align-items-left justify-content-left"></div>';
                html += '<div class="col-10 align-items-left justify-content-left">'; 
                
                html += '<div class="row hide" id=commentReplyUl_'+value.id+'></div>';
                
                // html += '<ul class="no-padding hide" id=commentReplyUl_'+value.id+'></ul>';
                
                html += '</div><div class="col-1 align-items-left justify-content-left"></div></div>';
                html += '</div>';
                
                
                
                
                                  
                                    
                html += '</div>';
                                
                html += '</div>';
                            
                html += '</div>';

              
                getFilmCommentReplys(value.id);
                
            });
        }else{
            html += '<div class="col-md-12"><div class="alert alert-danger" role="alert">No comments for view </div></div>';
        }
        $("#approvedCommentListUl").html(html);
        if( parseInt(numberOfDisedCmt) <= parseInt(totalCmt) ){
            $("#loadMoreBtn").removeClass('hide');
        }else{
            $("#loadMoreBtn").addClass('hide');
        }
        
        
        setTimeout(function () {
            window.emojiPicker = new EmojiPicker({
              emojiable_selector: '[data-emojiable=true]',
              assetsPath: './img/',
              popupButtonClasses: 'fa fa-smile-o'
            });
            window.emojiPicker.discover();
        },500);
        
    }
    data = { "function": 'Comments',"method": "getFilmsProjectComments", 'projId': projId ,'numberOfDisedCmt':numberOfDisedCmt , "user_type_val" : user_type_val , "user_id_like" : user_id_like };
    
    apiCall(data,successFn);
}

function loadMoreFilmComments(){
    var numberOfDisedCmt = $("#numberOfDisedCmt").val();
     var totalCmt = $("#totalCmt").val();
     $("#numberOfDisedCmt").val(parseInt(numberOfDisedCmt)+3);
     
     var setPrjIdForCmt = $("#setPrjIdForCmt").val();
     getFilmProjectComments();
    
}

function editFilmMainComment(commentId){
    successFn = function(resp)  {
        // console.log(resp.data);
        var data = resp.data;
        // var html = "";
        if(data != "" && data != null){
            console.log(data[0]);
            $("#commentDisplayDiv_"+commentId).addClass("d-none");
            $("#commentEditDiv_"+commentId).removeClass("d-none");
            $("#commentActions_"+commentId).addClass("d-none");
            
        }
       
    }
    data = { "function": 'Comments',"method": "editFilmComments", 'commentId': commentId };
    
    apiCall(data,successFn);
}

function updateFilmComment(commentId, viewProjId){
    
    var commentId = commentId;
    
    confmMsg = "You want to update this comment";
    successMsg = "Comment updated successfully";
    
    var imogiText = $("#commentsEditText_"+commentId).val();
  
    if(imogiText == ""){
        // $("#message").html("Comment could not be empty !");
        $("#commentsEditText_"+commentId).focus();
        return false;
    }else{
        // $("#message").html("");
    }

    

    return new swal({
        title: "Are you sure?",
        text: confmMsg,
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getFilmWaitingApprovalComments();
                        getFilmProjectComments();
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: successMsg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        if(commentId !=""){
                            $("#commentDisplayDiv_"+commentId).removeClass("d-none");
                            $("#commentActions_"+commentId).removeClass("d-none");
                            $("#commentEditDiv_"+commentId).addClass("d-none");
                        }

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }
    
                data = { "function": 'Comments',"method": "updateFilmMainComment", 'commentId': commentId, 'imogiText': imogiText };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function deleteFilmMainComment(commentId){
    return new swal({
        title: "Are you sure?",
        text: "Do you wish to delete this comment.",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getFilmWaitingApprovalComments();
                       getFilmProjectComments();
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Comment deleted successfully",
                            showConfirmButton: false,
                            timer: 2000
                        });

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                    
                }
                data = { "function": 'Comments',"method": "deleteFilmProjectComment", 'commentId': commentId };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function addFilmLikeDislikeComment(commentId,status,projId){
    
    var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    
     successFn = function(resp)  {
        console.log(resp.data);
        if(resp.status == 1){
            getFilmProjectComments();
        }
       
    }
    errorFn = function(resp){
        console.log(resp);
    }
    data = { "function": 'Comments',"method": "addFilmLikeDislikeComment", "user_type_val" : user_type_val , "user_id_like" : user_id_like , 'status':status ,'commentId':commentId};
    apiCall(data,successFn,errorFn);
    
    
    
    
}

function replyFilmComment(commentId,commentedUserName){
    
    $("#commentReplyUl_"+commentId).addClass('d-none');

    $("#replyCommentbtnDiv_"+commentId).addClass('d-none');

    html = '<input type="hidden" value="'+commentId+'" id="commentHiddenId_'+commentId+'">';
    html = '<input type="hidden" value="'+commentedUserName+'" id="commentedUserName_'+commentId+'">';
    html += '<div class="single-post-comm">';
    html += '<div class="clearfix"></div>';
    html += '<div >';
    html += '<div class="pr-subtitle"> Reply to comment</div>';
    html += '<div class="section-separator fl-wrap sp2"><span></span></div>';
    html += '<div class="comment-reply-form clearfix">';
    html += '<div id="replyCommentErrormessage_'+commentId+'" class="text-danger" style="text-align: left;"></div>';
    html += '<form  class="custom-form" style="margin-top: 15px;">';
    html += '<fieldset>';
    html += '<div class="row">';
   
    html += '<div class="col-md-12 mainCommentFormTextarea">';
    html += '<textarea style="height: 100px; text-align: left;" name="commentsReplay_'+commentId+'" id="commentsReplay_'+commentId+'" rows="2" placeholder="Your reply:" data-emojiable="true"></textarea>';
    html += ' </div>';
   
    html += '<div class="col-md-12" style="font-size: 14px; text-align: right; padding-top: 10px;">';
    html += '  <a href="javascript:void(0)" onclick="cancelCommentReplyCopy('+commentId+');" style="margin-right: 20px;"><span><b>Cancel</b></span></a>';
    html += '  <a href="javascript:void(0)" onclick="saveFilCommentReplyCopy('+commentId+');" style="margin-right: 20px;"><span><b>Post</b></span></a>';
    html += '  </div>';
    html += '</div>';
    html += '  </fieldset>';               
    html += ' </form>';
    html += ' </div>';
    html += '</div>';
    html += ' </div>';

    $("#replyCommentDiv_"+commentId).html(html);
    
    var element = document.getElementById("replyCommentDiv_"+commentId);
      if (element) {
        element.scrollIntoView({
          behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
          block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
          inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
        });
      }
      
      var textareaElement = document.getElementById("commentsReplay_"+commentId);
    if (textareaElement) {
        textareaElement.focus();
    }
      
    setTimeout(function () {
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: './img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();

    },200);
        
    
}


function saveFilCommentReplyCopy(commentId){
    var commentsReply = $("#commentsReplay_"+commentId).val();
    var commentedUserName = $("#commentedUserName_"+commentId).val();
   
     var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    
   
    var commentReplyUser = user_id_like;
    var userType = user_type_val;
    
    
    if(commentsReply == ""){
        $("#replyCommentErrormessage_"+commentId).html("Reply comment could not be empty !");
        $("#commentsReplay_"+commentId).focus();
        return false;
    }else{
        $("#replyCommentErrormessage_"+commentId).html("");
    }
    
    var commentsReplyText = commentsReply;
    

    return new swal({
        title: "Are you sure?",
        text: "You want to post this comment",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                
                
                
                
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        
                        // getFilmProjectComments();
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Comment posted successfully ",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $("#commentsReply_"+commentId).val("");
                        $("#commentReplyUser_"+commentId).val("");
                        $("#commentHiddenId_"+commentId).val("");
                        $("#commentReplyEmail_"+commentId).val("");
                        $("#commentReplyPhonenumber_"+commentId).val("");
                       // $('#commentReplayModal').modal('hide');
                       $("#replyCommentbtnDiv_"+commentId).removeClass('d-none');
                       $("#replyCommentDiv_"+commentId).html("");
                       $("#commentReplyUl_"+commentId).removeClass('d-none');
                       
                       getFilmProjectComments();
                       
                       getFilmCommentReplys(commentId);
                       
                       setTimeout(function() {
                           showViewReplyComment(commentId);
                        }, 1000);
                       
                       

                    }
                }
                data = { "function": 'Comments',"method": "saveFilmCommentsReply", 'commentId': commentId, "commentsReply": commentsReplyText, "created_by": commentReplyUser,"userType":userType,"user_type_val" : user_type_val , "user_id_like" : user_id_like ,'commentedUserName':commentedUserName };
                
                // console.log(data)
    
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
    
}

function getFilmCommentReplys(commentId){

     
    var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    
    
    
    
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            $.each(data, function(key,value) {
                
                
                html += '<div class="col-12">';
                html += '<div class="media g-mb-30 media-comment" >';
                html += '<div class="media-body u-shadow-v18 g-bg-secondary g-pa-30" style="padding: 15px !important;">';
                html += '<div class="row no-padding">';
                
                html += '<div class="col-1 align-items-center justify-content-center">';
                html += '<img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="images/comment-dp-img.png" >';
                html += '</div>';
                
                html += '<div class="col-10 col-sm-11 align-items-left justify-content-left no-padding comment-heading">';
                html += '<cite class="fn" style="margin-bottom: 0px"><a>'+value.created_by+'</a><br> <a class="new-text-sub-fond-small" style="font-size: 0.7rem !important;color: #777 !important;">'+dateFormat(value.created_in)+'</a></cite>';
                html += '<p id="commentReplyDisplayDiv_'+value.id+'" class="comment-new-img-p-front" style="padding-bottom: 4px !important;margin-bottom: 0rem !important;"><label style="color:#ccc;">'+value.commentedUserName+'</label> '+value.comment_reply+'</p>';
                html += '</div>';
                
                html += '<div class="col-12 d-flex justify-content-end align-items-end" >';
                
                if(user_id_like == ""){

                     html += '<a href="javascript:void(0)" onclick="showGuestUserModal();" style="margin-right: 15px;"><i class="fas fa-reply" style="font-size:12px"></i></a>';
                    
                }else{
                     html += '<a href="javascript:void(0)" onclick="replyFilmComment('+commentId+',`'+value.created_by+'`);" style="margin-right: 15px;"><i class="fas fa-reply" style="font-size:12px"></i></a>';
                }
                
                 
                
                if( ( value.user_type == user_type_val && value.commented_user_id == user_id_like ) || value.prj_user_id == user_id_like )  {
                    
                    html += '<a href="javascript:void(0)" onclick="editReplyComment('+value.id+');" style="margin-right: 15px;"><i class="fas fa-pen" style="font-size:12px"></i></a>';

                    html += '<a href="javascript:void(0)" onclick="deleteFilmCommentReply('+value.id+', '+commentId+');" style="margin-right: 15px;"><i class="fas fa-trash" style="font-size:12px"></i></a>';

                    
                }                         
                                   
                html += '</div>';
                
                html += '</div>';
                
           
                
                
                html += '<div id="commentReplyEditDiv_'+value.id+'" class="row d-none" style="padding: 10px; padding-right: 0px; margin-left: 0px; margin-right: 0px;">';
                html += '<div class="col-12 mainCommentFormTextarea" >';
                
                
                html += '<textarea name="commentsReplyEditText_'+value.id+'" id="commentsReplyEditText_'+value.id+'" placeholder="Your reply:" data-emojiable="true" class="" style="height: 75px;width: 90%;">'+value.comment_reply+'</textarea>';
             
                
                html += '</div>';
                
              
                html += '<div class="col-12" style="font-size: 14px; text-align: right; padding-top: 10px;">';
                html += '  <a href="javascript:void(0)" onclick="cancelReplyCommentsUpdate('+value.id+');" style="margin-right: 20px;"><span><b>Cancel</b></span></a>';
                html += '  <a href="javascript:void(0)" onclick="updateFilmReplyComment('+value.id+','+commentId+');" style="margin-right: 20px;"><span><b>Update</b></span></a>';
                html += '  </div>';

                
                html += '</div>';
                
                html += '</div>';
                html += '</div>';
                html += '</div>';
                
          
                
                
            });
        }
      
        $("#commentReplyUl_"+commentId).html(html);
    }
    data = { "function": 'Comments',"method": "getFilmCommentsReply", 'commentId': commentId };
    
    apiCall(data,successFn);
}


function updateFilmReplyComment(commentId,Prj_id){
    confmMsg = "You want to update this comment";
    successMsg = "Comment updated successfully";
    
    var imogiText = $("#commentsReplyEditText_"+commentId).val();
  
    if(imogiText == ""){
        $("#commentsReplyEditText_"+commentId).focus();
        return false;
    }
    
    return new swal({
        title: "Are you sure?",
        text: confmMsg,
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        
                        getFilmCommentReplys(Prj_id);
                      
                        
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: successMsg,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        if(commentId !=""){
                            $("#commentReplyDisplayDiv_"+commentId).removeClass('d-none');
                            $("#commentReplyEditDiv_"+commentId).addClass('d-none');
                        }

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                }
    
                data = { "function": 'Comments',"method": "updateFilmReplyComment", 'commentId': commentId, 'imogiText': imogiText };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
    
    
}

function deleteFilmCommentReply(commentId, mainCommentId){

    return new swal({
        title: "Are you sure?",
        text: "Do you wish to delete this reply.",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        
                        getFilmWaitingApprovalComments();
                        
                        getFilmCommentReplys(mainCommentId);

                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Reply deleted successfully",
                            showConfirmButton: false,
                            timer: 2000
                        });

                    }
                }
                errorFn = function(resp){
                    console.log(resp);
                    
                }
                data = { "function": 'Comments',"method": "deleteFilmCommentReply", 'commentId': commentId };
                apiCall(data,successFn,errorFn);
            }else{
                console.log("sdsds");
            }
    });
}

function waitingforFilmAprovalModal(){
    getFilmWaitingApprovalComments();
    $('#viewCommentsModal').modal('toggle');
    
}

function getFilmWaitingApprovalComments(){
    var viewProjId = $("#projId_id_like").val();
    
    successFn = function(resp)  {
        console.log(resp.data);
        var data = resp.data;
        var html = "";
        if(data != "" && data != null){
            
            $.each(data, function(key,value) {
                
                html += '<div class="col-12">';
                html += '<div class="media g-mb-30 media-comment" >';
                html += '<div class="media-body u-shadow-v18 g-bg-secondary g-pa-30" style="padding: 15px !important;">';
                html += '<div class="row no-padding">';
                
                html += '<div class="col-1 align-items-center justify-content-center">';
                html += '<img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="images/comment-dp-img.png" >';
                html += '</div>';
                
                html += '<div class="col-7 align-items-left justify-content-left no-padding comment-heading">';
                html += '<cite class="fn" style="margin-bottom: 0px"><a>'+value.name+'</a><br> <a class="new-text-sub-fond-small" style="font-size: 0.7rem !important;color: #777 !important;">'+dateFormat(value.created_in)+'</a></cite>';
                html += '<p id="commentDisplayDiv_'+value.id+'" class="comment-new-img-p-front" style="padding-bottom: 4px !important;margin-bottom: 0rem !important;">'+value.comment+'</p>';
                html += '</div>';
                
                html += '<div class="col-4 align-items-right justify-content-right no-padding" style="padding-top: 25px !important;" >';
                
                  html += '<a href="javascript:void(0)" onclick="deleteFileComment('+value.id+')" style="margin-right: 15px;"><i class="fas fa-trash" style="color:red;font-size:16px"></i></a>';
                    html += '<a href="javascript:void(0)" onclick="approveFilmComments('+value.id+')" style="margin-right: 15px;"><i class="fas fa-check" style="color:green;font-size:16px"></i></a>';
                
                
                html += '</div>';
                
                html += '</div>';
             

                html += '</div>';
                html += '</div>';
                html += '</div>';
                
         
                
            });

            
        }else{
            html += '<div class="col-md-12"><div class="alert alert-danger" role="alert">No comments for approval </div></div>';
            // $("#commentListUl").html(html);
        }
        $("#commentListUl").html(html);

    }
    errorFn = function(resp){
        console.log(resp);
    }
    data = { "function": 'Comments',"method": "getFilmPendingComments", "projId" : viewProjId };
    apiCall(data,successFn,errorFn);
}

function deleteFileComment(commentId){
    return new swal({
        title: "Are you sure?",
        text: "You want to delete this comment",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    console.log("rrerere");
                    if(resp.status == 1){
                         getFilmWaitingApprovalComments();
                       getFilmProjectComments();
                        swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: resp.data,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                    }
                }
                data = { "function": 'Comments',"method": "deleteFilmComment", "commentId" : commentId };
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
}

function approveFilmComments(commentId){
  
    return new swal({
        title: "Are you sure?",
        text: "You want to approve this comment",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                        getFilmWaitingApprovalComments();
                       getFilmProjectComments();
                        swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: resp.data,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                    }
                }
                data = { "function": 'Comments',"method": "approveFilmComments", "commentId" : commentId };
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
            }
    });
}

function likeWeddingFilm(){
    var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    var projId_id_like = $("#projId_id_like").val();
    
    
    successFn = function(resp)  {
        console.log(resp.data);
        if(resp.status == 1){

            $('#disLikeButton').html('<a class="btn position-relative" href="#" onclick="dislikeWeddingFilm()" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;"><i class="fa fa-heart fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></h3></a>');
            
            $('#disLikeButton1').html('<button onclick="dislikeWeddingFilm()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true" style="white-space: nowrap;"><i class="fa fa-heart fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></button>');
        }
       
    }
    errorFn = function(resp){
        console.log(resp);
    }
    data = { "function": 'WeddingFilms',"method": "likeWeddingFilm", "user_type_val" : user_type_val , "user_id_like" : user_id_like , 'status':1 ,'projId_id_like':projId_id_like};
    apiCall(data,successFn,errorFn);
    
    
    
    
}


function dislikeWeddingFilm(){
     var user_type_val = $("#user_type_val").val();
    var user_id_like = $("#user_id_like").val();
    var projId_id_like = $("#projId_id_like").val();
    
    
    successFn = function(resp)  {
        console.log(resp.data);
        if(resp.status == 1){
            $('#disLikeButton').html('<a class="btn position-relative" href="#" onclick="likeWeddingFilm()" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;"><i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></h3></a>');
            $('#disLikeButton1').html('<button style="white-space: nowrap;" onclick="likeWeddingFilm()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true"><i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></button> ');
            
            
        }
       
    }
    errorFn = function(resp){
        console.log(resp);
    }
    data = { "function": 'WeddingFilms',"method": "likeWeddingFilm", "user_type_val" : user_type_val , "user_id_like" : user_id_like , 'status':0 ,'projId_id_like':projId_id_like};
    apiCall(data,successFn,errorFn);
}
  
</script>