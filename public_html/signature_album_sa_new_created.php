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
    
     if(!isset($_COOKIE['guestLoginEmail'])) $userphonenumber ="";
    else  $userphonenumber =$_COOKIE['guestLoginEmail'];

    if(!isset($_COOKIE['guestLoginPhone'])) $useremail ="";
    else  $useremail =$_COOKIE['guestLoginPhone'];
    
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


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
// $projId = 14;
$sql = "SELECT sa.*, cvi.image_path, ct.firstname, ct.lastname FROM tbesignaturealbum_data as sa LEFT JOIN tblcontacts as ct ON ct.id = sa.user_id LEFT JOIN tbesignaturealbum_coverimage as cvi ON cvi.folder_Id=sa.id WHERE sa.project_folder_id=".$projId." AND sa.deleted=0 ORDER BY sa.id DESC";

// $sql = "SELECT * FROM tbesignaturealbum_data";
// print_r($this->dbc->get_rows($sql));
// var_dump($arr);
// echo $sql; die;

$result = $DBC->query($sql);
$count = mysqli_num_rows($result);

$tmpData = [];

if($count > 0) {		
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tmpData,$row);
    }
}

$result = $tmpData[0];

$ogurl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ogimage = "";
$setOg = true;
$ogTitle = "";
$ogDesc = "";

if($result){
    // var_dump($result);
    $ogimage = "https://$_SERVER[HTTP_HOST]/admin/" . $result['cover_image_path'];
}

$totalCmt = 0;
$cmtsql = "SELECT COUNT(*) as totalCmt FROM `tbeproject_comments` WHERE status = 1 AND deleted = 0 AND project_id = '$projId' ";
$cmtresult = $DBC->query($cmtsql);
$cmtcount = mysqli_num_rows($cmtresult);
if($cmtcount > 0) {		
    while ($row = mysqli_fetch_assoc($cmtresult)) {
        $totalCmt = $row['totalCmt'] ;
    }
}

$cover_img_path = "";
$plan_expiry_date = "";
$album_name_from_prjt = "";
$signatureAlbymGetSql = "SELECT * FROM tbesignaturealbum_projects WHERE id='$projId' ";
$signatureAlbymresult = $DBC->query($signatureAlbymGetSql);
$signatureAlbymcount = mysqli_num_rows($signatureAlbymresult);
if($signatureAlbymcount > 0) {		
    while ($row = mysqli_fetch_assoc($signatureAlbymresult)) {
        $cover_img_path = $row['cover_img_path'] ;
        $plan_expiry_date = $row['expiry_date'] ;
        $album_name_from_prjt = $row['project_name'] ;
    }
}

$currentDate = date('Y-m-d');
$isExpiry = false;

if ($plan_expiry_date > $currentDate) {
    $isExpiry = true;
} else {
    $isExpiry = false;
}


$planExpDate = new DateTime($plan_expiry_date);

// Get year, month, and day part from the date
$year = $planExpDate->format('Y');
$month = $planExpDate->format('n');
$day = $planExpDate->format('d');

// Assuming $monthNames is an array with month names
$monthNames = array(
    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
);

$formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;

$like_status = false;

if($isDisComment){
    
    
  $signatureAlbymLikeSql = "SELECT * FROM signature_album_like WHERE project_id='$projId' AND user_id='$user_id_like' AND user_type='$user_type_val' AND active=0 ";
    $signatureAlbymLikeresult = $DBC->query($signatureAlbymLikeSql);
    $signatureAlbymLikecount = mysqli_num_rows($signatureAlbymLikeresult);
    if($signatureAlbymLikecount > 0) {		
        while ($row = mysqli_fetch_assoc($signatureAlbymLikeresult)) {
            $like_statusS = $row['status'] ;
            if($like_statusS == 1) $like_status = true;
           
        }
    }
  
}


// echo $ogimage; die;
include("templates/headerShare_sa.php");

?>


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
    background-color: #fafafa !important;
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
    margin-top:20px
}


</style>


                <!-- content-holder -->
                <input type="hidden" value="<?php echo $lsignatureAlbumUserId; ?>" id="lsignatureAlbumUserId">
                <input type="hidden" value="<?php echo $userIdVal; ?>" id="userIdVal">
                <input type="hidden" value="<?php echo $logginUserName; ?>" id="logginUserName">
                <input type="hidden" value="<?php echo $userphonenumber; ?>" id="userphonenumber">
                <input type="hidden" value="<?php echo $useremail; ?>" id="useremail">
                <input type="hidden" value="<?php echo $contact_user_id; ?>" id="loggedUserId">
                <input type="hidden" value="<?php echo $guestLoginId; ?>" id="guestUserId">
                <input type="hidden" id="viewProjId">
                <input type="hidden" value="<?php echo $isDisComment; ?>" id="isDisComment">
                <input type="hidden" value="5" id="numberOfDisedCmt">
                <input type="hidden" value="<?php echo $totalCmt; ?>" id="totalCmt">
                <input type="hidden" value="" id="setPrjIdForCmt">
                <input type="hidden" value="<?php echo $isCmtCnfrmMes; ?>" id="isCmtCnfrmMes">
                <input type="hidden" value="<?php echo $user_type_val; ?>" id="user_type_val">
                <input type="hidden" value="<?php echo $user_id_like; ?>" id="user_id_like">
                <input type="hidden" value="<?php echo $projId; ?>" id="projId_id_like">
            
                <div class="content-holder vis-dec-anim" style="top: 10px;">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container" style="max-width: 100%; padding: 0px; width: 100%;">
                                
                                
                                <div class="row" style="margin-right:0px; padding: 0px;">
                                    <div class="col-md-12" style="padding-top: 0px; padding-right: 0px; position: relative;">
                                        <img id="eventCoverImage" src="admin/<?=$cover_img_path?>" style="width: 100%; padding: 0px;">
                                    
                                        <!-- Add text inside the image using a div with absolute positioning -->
                                        <div class="sa-list-img-d1">
                                            <h1 class="text-white new-text-sub-fond sa-list-img-d2" ><?=$album_name_from_prjt;?></h1>
                                            
                                            <div class="sa-list-img-d3" >
                                                <a onclick="gotoViewGallery();" class="single-btn fl-wrap sa-list-img-h1" >
                                                    <span class="bold-text new-text-sub-fond-1" style="letter-spacing: 1px !important;">View Gallery</span>
                                                </a>
                                            </div>
                                            
                                            
                                        
                                        </div>
                                        
                                        <div class="sa-list-img-d4">
                                            
                                            <div class="" style="">
                                                <img src="images/machooos-img-dis-logo.png" alt="" class="sa-list-img-h2"><br>
                                                <span class="bold-text text-white new-text-sub-fond-1 " >Machoos international</span>
                                            </div>
                                            
                                        </div>
                                        
                                      
                                        
                                     
                                        
                                    </div>
                                   
                                    <div class="col-md-12" >
                                        <div class="hero-title alighn-title" style="padding: 0px;">
                                            <div class="row" style="margin-right:0px; padding: 0px; ">
                                                
                                                
                                                <?php if($isExpiry){ ?>
                                                
                                                <div class="col-sm-12" style="text-align: left;">
                                                
                                                    <div class="row" style="padding: 15px;">
                                                    
                                                       
                                                        
                                                        <div class="col-8" style="text-align: left;">
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
                                                        
                                                         <div class="col-4" style="text-align: right;" id="disLikeButton">
                                                             
                                                             <?php if($isDisComment){ ?>
                                                             
                                                             
                                                             <? if( $like_status ){ ?>
                                                             
                                                                 <button onclick="dislikeSignaturealbum()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true">
                                                                        <i class='fa fa-heart'></i>
                                                                    </button>
                                                                     <span class="bold-text new-text-sub-fond-1">LIKE</span> 
                                                             
                                                             <?php }else{ ?>
                                                             
                                                                 <button onclick="likeSignaturealbum()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true">
                                                                        <i class="far fa-heart fa-1x"></i>
                                                                    </button>
                                                                     <span class="bold-text new-text-sub-fond-1">LIKE</span> 
                                                             
                                                             <?php } ?>
                                                             
                                                             
                                                               
                                                             
                                                             
                                                            <?php }else{ ?>
                                                    
                                                             
                                                                
                                                                 <button onclick="showGuestUserModal()" type="button" class="btn position-relative" data-mdb-ripple-unbound="true">
                                                                    <i class="far fa-heart fa-1x"></i>
                                                                </button>
                                                                 <span class="bold-text new-text-sub-fond-1">LIKE</span> 
                                                            
                                                            <?php } ?>
                                                             
                                                             
                                                             
                                                             
                                                             
                                                             
                                                           
                                                           
                                                           
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                
                                                </div>
                                                
                                                <?php }else{ ?>
                                                
                                                <div class="col-sm-12" style="text-align: center;padding: 15px;">
                                                    <span class="bold-text text-danger new-text-sub-fond-1"><b style="letter-spacing: .05rem;">This album expired on <?=$formattedExpDate?></b></span> 
                                                   
                                                </div>
                                                
                                                
                                                <?php } ?>
                                                
                                                
                                                
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                   
                                
                                
                                <?php if($isExpiry){ ?>
                                    
                                    <div class="clearfix"></div>
                                    <section style="padding: 0px 0px;">
                                        <!-- <div class="container"> -->
                                            <div class="card" style="border: 0px;">
                                                <div class="card-body" style="padding: 0px; padding-right: 7px; margin-left: 0px;">
                                                    
                                                     <div class="sticky-header">
                                                        <!-- Add your ul element with class="nav nav-tabs" -->
                                                        <ul class="nav nav-tabs" id="signatureAlbumTabs" role="tablist" ></ul>
                                                    </div>
                                        
                                                    <!-- Add some content below the sticky header for demonstration purposes -->
                                                    <div style=" background-color: #f9f9f9;">
                                                        <div class="tab-content pt-2" id="signatureAlbumTabContent" >
                                                        </div>
                                                    </div>
                                                  
                                                
                                                        <div class="pt-4 pb-4" id="signatureAlbumEmptyData">
                                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                                <div>
                                                                Not selected the user to view the albums!
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="d-none" id="signatureAlbumEmptyDataForUser" style="padding: 20px;">
                                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                                <div>
                                                                    Not created the folder to view !
                                                                </div>
                                                            </div>
                                                        </div>
                                  
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </section>
                                    
                                    
                                    <section class="mb-4" style="padding: 0px 0px;" id="comentsDiv">
                                           
                                                <div id="comments" class="single-post-comm commentsListDiv" style="margin: auto;">
                                                    <?php if($isDisComment){ ?>
                                                        <div id="respond">
                                                            <div class="pr-subtitle text-center"> Write Your Comment Here <i class="bi bi-arrow-down-square"></i></div>
                                                            <div class="section-separator fl-wrap sp2"><span></span></div>
                                                            <div class="comment-reply-form clearfix">
                                                                <div id="message" class="text-danger" style="padding:10px;"></div>
                                                                <form id="addComment" class="add-comment custom-form" style="margin-top: 0px;margin-bottom: 20px;">
                                                                    <fieldset>
                                                                        <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                            <div class="col-md-12 mainCommentFormTextarea" id="mainCommentFormTextarea">
                                                                                <textarea name="imogiText" id="imogiText" placeholder="type comments here..." data-emojiable="true" class="" style="height: 75px;"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div data-emojiarea data-type="unicode" data-global-picker="false">
                                                                            <div class="emoji-button">&#x1f604;</div>
                                                                            <textarea id="input1" rows="5">You can insert unicode emojis here &#x1f604;</textarea>
                                                                        </div> -->
                                                                        
                                                                    </fieldset>
                                                                    
                                                                     <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                         <input type="hidden" id="projId" name="projId">
                                                                            <input type="hidden" id="commentId" name="commentId">
                                                                            
                                                                        <div class="col-md-12" style="padding-top: 10px; ">
                                                                            
                                                                            <button type="button"  onclick="saveComments();" id="saveCommentsButton" ><span>Submit Comment</span></button>
                                                                            
                                                                            <button type="button" onclick="saveComments();" class=" d-none" id="updateCommentsButton"><span>Update Comment</span></button>
                                                                            
                                                                      
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                              
                                                                </form>
                                                            </div>
                                                        </div>
                                                    <?php }else{ ?>
                                                    
                                                        <div >
                                                            <div class="pr-subtitle text-center new-text-sub-fond-1" style="color: #5e646a; padding: 25px; margin-left: 0px; margin-right: 0px;"> If you are not able to comment <a href="#" onclick="showGuestUserModal();" style="color: #5e646a;text-decoration: underline;">CLICK HERE</a> </div>
                                                            <div class="section-separator fl-wrap sp2"><span></span></div>
                                                           
                                                        </div>
                                                    
                                                    <?php } ?>
                                                    <div class="clearfix"></div><br>
                                                    
                                                    
                                                    
                                                    
                                                    <div class="row" id="approvedCommentListUl">
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <!--<ul class="commentlist clearafix" id="approvedCommentListUl" style="padding-left: 20px;padding-right: 20px; ">-->
                                                    <!--</ul>-->
                                                    
                                                    <div class="pagination hide" style="width: 100%;padding-top:30px;text-align: center;display: flex; justify-content: center; align-items: center;margin: 0px;" id="loadMoreBtn">
                                                        <button onclick="loadMoreComments()" style="width: 40%;height: 30px;color: #fff; background: #111;" >Load more comments... <i class="bi bi-download"></i></button>
                                                      
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <!--end respond-->
                                                </div>
                                            
                                            
                                            
                                            
                                        <!-- </div> -->
                                    </section>
                                    
                                    
                                    
                                <?php } ?>
                                
                                
                                
                                
                            </div>
                            <!-- content end -->
                            <div class="clearfix"></div>
                            <?php  include("templates/footer-tpl.php"); ?>
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

    /*! normalize.css v2.1.2 | MIT License | git.io/normalize */article,aside,details,figcaption,figure,footer,

    /* .elem, .elem * {
        box-sizing: border-box;
        margin: 0 !important;	
    }
    .elem {
        display: inline-block;
        font-size: 0;
        width: 33%;
        border: 20px solid transparent;
        border-bottom: none;
        background: #fff;
        padding: 10px;
        height: auto;
        background-clip: padding-box;
    }
    .elem > span {
        display: block;
        cursor: pointer;
        height: 0;
        padding-bottom:	70%;
        background-size: cover;	
        background-position: center center;
    } */
    
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
        /* background: #E75A34; */
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
</style>

<script>
    // $(function() {
    //     // Initializes and creates emoji set from sprite sheet
    //     window.emojiPicker = new EmojiPicker({
    //       emojiable_selector: '[data-emojiable=true]',
    //       assetsPath: './img/',
    //       popupButtonClasses: 'fa fa-smile-o'
    //     });
    //     // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
    //     // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
    //     // It can be called as many times as necessary; previously converted input fields will not be converted again
    //     window.emojiPicker.discover();
    //   });
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
        window.Sharer.init();


    });
  $( document ).ready(function() {
      
   
    // $('#mySelect').selectpicker();
    // $('#imogiText').emoji({place: 'before'});
    // $('#commentsReply').emoji({place: 'before'});
    // $('#mySelect').selectpicker();
    // EmojiArea.DEFAULTS.assetPath = 'machoosintl/images';
    // console.log(EmojiArea.DEFAULTS);
    // $("#mygallery").justifiedGallery();
        var url      = window.location.href;
        var currentUrl = getUrlParameter('pId');
        // alert(currentUrl);
        getuSignatureAlbums(currentUrl);

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

function addSAShareCount(){
    var url      = window.location.href;
    var currentUrl = getUrlParameter('pId');
    var projIdString = Base64.decode(currentUrl);
    var arr = projIdString.split('_');
    var projId = arr[1];
    successFn = function(resp)  {
    }
    data = { "function": 'SignatureAlbum',"method": "addShare" ,"projId":projId};
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


  
</script>