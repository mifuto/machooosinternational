<?php 

include("config.php");

// include("admin/config.php");
// echo $contact_user_id;
$notfy = [];
$notifi_count = 0;
$cmtUserIdVal = "";
$cmtrUserTypeVal = "";
$cartData = [];
$countcart = 0;

$home_vedio_url = "";
$home_vedio_dec = "";
$state_name = "";

$isShotMenu = false;
$isUserConvertBtn = false;

$guestUserName = '';
$guestUserEmail = '';
$guestUserPhone = '';


if(isset($_COOKIE['user_sel_account_type'])){
    $user_sel_account_type = $_COOKIE['user_sel_account_type'];
}else{
    $user_sel_account_type = '';
}

if(isset($_COOKIE['popup_show_id'])){
    $popup_show_id = $_COOKIE['popup_show_id'];
}else{
    $popup_show_id = '';
}


if (isset($_COOKIE['user_state_val']) && isset($_COOKIE['user_county_val'])) {

    $user_state_val = $_COOKIE['user_state_val'];
    $user_county_val = $_COOKIE['user_county_val'];
    
  

} else {
    
    $user_state_val = "";
    $user_county_val = "";
  
    setcookie('user_state_val', $user_state_val, time() + (86400 * 30), "/");
    setcookie('user_county_val', $user_county_val, time() + (86400 * 30), "/");

   
}


  $DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);



if($contact_user_id){
  
  
     
       $sql3 = "SELECT c.id as user_state_val,c.county_id,b.state as state_name FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblstate c on c.state = b.state WHERE a.id=".$contact_user_id;
        $result3 = $DBC->query($sql3);
        $row3 = mysqli_fetch_assoc($result3);
      
    $user_state_val = $row3['user_state_val'];
    $user_county_val = $row3['county_id'];
    $state_name = $row3['state_name'];
    
    setcookie('user_state_val', $user_state_val, time() + (86400 * 30), "/");
    setcookie('user_county_val', $user_county_val, time() + (86400 * 30), "/");
    setcookie('user_sel_account_type', "Customer", time() + (86400 * 30), "/");
    
    $isShotMenu = true;
    
  
    
    
    
  
  $sql = "SELECT * , CURRENT_TIMESTAMP as nowtime FROM tblrecent_activity_user
  WHERE user_id = $contact_user_id AND `read`=0 AND user_type=1 ORDER BY `created_in` desc ";
  $result = $DBC->query($sql);

  $count = mysqli_num_rows($result);

  if($count > 0) {		
      while ($row = mysqli_fetch_assoc($result)) {
          array_push($notfy,$row);
      }
  }

  $sqlc = "SELECT id FROM tblrecent_activity_user
  WHERE user_id = $contact_user_id AND `read`=0 AND user_type=1 ";
  $resultc = $DBC->query($sqlc);

  $notificationCount = mysqli_num_rows($resultc);
  
  if($notificationCount > 0) {		
      while ($row = mysqli_fetch_assoc($resultc)) {
          $notifi_count = $notifi_count + 1;
      }
  }
  
  $cmtUserIdVal = $contact_user_id;
    $cmtrUserTypeVal = 1;
    
    
    
    
$sqlcart = "SELECT * FROM cart WHERE user_id=".$contact_user_id." AND active=0 ";


$resultcart = $DBC->query($sqlcart);
$countcart = mysqli_num_rows($resultcart);

if($countcart > 0) {		
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        array_push($cartData,$rowcart);
    }
}

  
  
  
}else{
    if($_COOKIE['guestLoginId'] != 0){
        
        $guestLoginId = $_COOKIE['guestLoginId'];
          
             $DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
          $sql = "SELECT * , CURRENT_TIMESTAMP as nowtime FROM tblrecent_activity_user
          WHERE user_id = $guestLoginId AND `read`=0 AND user_type=2 ORDER BY `created_in` desc ";
          $result = $DBC->query($sql);
        
          $count = mysqli_num_rows($result);
        
          if($count > 0) {		
              while ($row = mysqli_fetch_assoc($result)) {
                  array_push($notfy,$row);
              }
          }
        
          $sqlc = "SELECT id FROM tblrecent_activity_user
          WHERE user_id = $guestLoginId AND `read`=0 AND user_type=2 ";
          $resultc = $DBC->query($sqlc);
        
          $notificationCount = mysqli_num_rows($resultc);
          
          if($notificationCount > 0) {		
              while ($row = mysqli_fetch_assoc($resultc)) {
                  $notifi_count = $notifi_count + 1;
              }
          }
          
           $cmtUserIdVal = $guestLoginId;
    $cmtrUserTypeVal = 2;
    
    $state_name = $_COOKIE['user_state_name'];
    
    $guestUserName = $_COOKIE['guestLoginName'];
    $guestUserEmail = $_COOKIE['guestLoginEmail'];
    $guestUserPhone = $_COOKIE['guestLoginPhone'];
    
    $isUserConvertBtn = true;
    
    
    
        
    
    
    }
}

if($user_state_val !=""){
    $sql4 = "SELECT a.vedio as home_vedio_url,a.description FROM tblhome_vedio a WHERE ( ( a.exp IS NOT NULL AND a.exp > CURDATE())
   OR ( a.exp IS NULL OR a.exp='' ) ) AND a.active=0 and FIND_IN_SET($user_state_val, a.state_id) order by id desc";
    $result4 = $DBC->query($sql4);
    $row4 = mysqli_fetch_assoc($result4);
    // print_r($row4);die;
    if(isset($row4)){
        $home_vedio_url = "admin/".$row4['home_vedio_url'];
        $home_vedio_dec = $row4['description'];
    }
   
}



?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Machooos International</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
            <meta name="MachooosInterational" content="Kerala wedding photography,Best wedding photographers in Kerala,Professional wedding photography Kerala,Kerala destination wedding photographers
Candid wedding photographers Kerala,Traditional wedding photography Kerala,Kerala wedding photography packages,Top wedding photographers in Kerala,Kerala wedding photojournalists,Wedding videography Kerala,Pre-wedding photoshoot Kerala,Kerala bridal photoshoot,Outdoor wedding photography Kerala,Creative wedding photographers in Kerala,Kerala wedding photography prices,Kerala wedding album design,Kerala wedding cinematography,South Indian wedding photography Kerala,Best wedding venues in Kerala for photography,Kerala wedding photography ti, Kerala kids photography,ernakulam kids phtography,trivandrum kids photography,trivandrum baby photographer,trivandrum birthday photographer,trivandrum newborn baby photographer,trivandrum kids props rent, trivandrum newborn baby props rent,kochi birthday photographer,kochi birthday event planner,birthday photographer,kids only,premium wedding photographer ernakulam,premium wedding photographer kochi, premium wedding photographer trivandrum,No1 wedding photographer ernakulam,No1 wedding photographer kochi,No1 wedding photographer kerala,No1 wedding photographer trivandrum,No1 wedding photographer india,Online album wedding company,india's first fully digitalised wedding photography company,india top wedding photographer now,Today top wedding photographer,india best wedding photographer, india top smart wedding photographyy,india first smart wedding company, india top smart wedding company, india best wedding company, india most expensive wedding photography, india most expensive wedding company, india most expensive photographer, india most talented wedding photographer, india most experienced wedding photographer ">
        <!--=============== css  ===============-->	
        <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="./css/plugins.css">
        <link type="text/css" rel="stylesheet" href="./css/style.css">
        <link type="text/css" rel="stylesheet" href="./css/color.css">
        <link rel="stylesheet" href="./css/lc_lightbox.css" />
        <!--<link rel="stylesheet" href="./skins/minimal.css" />-->
        <link type="text/css" rel="stylesheet" href="./admin/assets/css/select2.css">
        <link rel="stylesheet" href="./css/justifiedGallery.min.css" />
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.ico">
        <script  src="./js/jquery.min.js"></script>
        

    </head>
    <style>
       
        #crm_link:hover {
          color: darkgrey ;
          cursor: pointer;
        }
        
        #dashboard_link:hover {
          color: darkgrey ;
          cursor: pointer;
        }



.page-loader{ background: black none repeat scroll 0 0;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9998;}
.loader {
    height: 8px;
    margin: 0 auto;
    position: relative;
    text-align: center;
    top: 50%;
    width: 44px;
}
.dot {
    background: #ccc none repeat scroll 0 0;
    border-radius: 50%;
    display: inline-block;
    height: 10px;
    position: absolute;
    width: 10px;
}
.dot_1 {
    animation: 1.5s linear 0s normal none infinite running animateDot1;
    background: #804bd8 none repeat scroll 0 0;
    left: 12px;
}.dot_2 {
    animation: 1.5s linear 0.5s normal none infinite running animateDot2;
    left: 24px;
}.dot_3 {
    animation: 1.5s linear 0s normal none infinite running animateDot3;
    left: 12px;
}.dot_4 {
    animation: 1.5s linear 0.5s normal none infinite running animateDot4;
    left: 24px;
}
 @keyframes animateDot1 {
0% {
    transform: rotate(0deg) translateX(-12px);
}
25% {
    transform: rotate(180deg) translateX(-12px);
}
75% {
    transform: rotate(180deg) translateX(-12px);
}
100% {
    transform: rotate(360deg) translateX(-12px);
}
}
@keyframes animateDot2 {
0% {
    transform: rotate(0deg) translateX(-12px);
}
25% {
    transform: rotate(-180deg) translateX(-12px);
}
75% {
    transform: rotate(-180deg) translateX(-12px);
}
100% {
    transform: rotate(-360deg) translateX(-12px);
}
}
@keyframes animateDot3 {
0% {
    transform: rotate(0deg) translateX(12px);
}
25% {
    transform: rotate(180deg) translateX(12px);
}
75% {
    transform: rotate(180deg) translateX(12px);
}
100% {
    transform: rotate(360deg) translateX(12px);
}
}
@keyframes animateDot4 {
0% {
    transform: rotate(0deg) translateX(12px);
}
25% {
    transform: rotate(-180deg) translateX(12px);
}
75% {
    transform: rotate(-180deg) translateX(12px);
}
100% {
    transform: rotate(-360deg) translateX(12px);
}
}


     

#loadMore {
  width: 200px;
  color: #fff;
  display: block;
  text-align: center;
  margin: 10px auto;
  padding: 2px;
  border-radius: 10px;
  border: 1px solid #6b6b6b;
  background-color: #6b6b6b;
  transition: .3s;
  text-decoration: none;
}
#loadMore:hover {
  color: #6b6b6b;
  background-color: #fff;
  border: 1px solid #6b6b6b;
  text-decoration: none;
}



 .image-container-pop {
            height: 60vh; /* 80% of the viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-container-pop img {
             max-width: 100%;
            max-height: 100%;
        }
        
        .close-pop {
        color: #804bd8
        }
        
        .close-pop:hover {
        color: #fff
        }

    </style>
    
    <style>
        #bubble_menu {
                bottom: 30px;
                width: 60px;
                height: 60px;
                color: #fff;
                position: fixed;
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
                right: 30px;
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
                z-index: 9998;
            }
            
            #bubble_menu > .menu {
                display: block;
                position: absolute;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                text-align: center;
                box-shadow: 0 3px 10px rgba(0, 0, 0, 0.23), 0 3px 10px rgba(0, 0, 0, 0.16);
                color: #fff;
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
            }
            
            #bubble_menu > .menu .share {
                width: 100%;
                height: 100%;
                position: absolute;
                left: 0px;
                top: 0px;
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
            }
            
            #bubble_menu > .menu .share .circle {
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
                position: absolute;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: #fff;
                top: 50%;
                margin-top: -6px;
                left: 12px;
                opacity: 1;
            }
            
            #bubble_menu > .menu .share .circle:after, #bubble_menu > .menu .share .circle:before {
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
                content: '';
                opacity: 1;
                display: block;
                position: absolute;
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: #fff;
            }
            
            #bubble_menu > .menu .share .circle:after {
                left: 20.78461px;
                top: 12.0px;
            }
            
            #bubble_menu > .menu .share .circle:before {
                left: 20.78461px;
                top: -12.0px;
            }
            
            .menu-icon-main {
                position: absolute;
                top: 20%;
                margin-top: -3.5px;
                left: 15px;
            }
            
            #bubble_menu > .menu .share .bar {
                /*-webkit-transition: all 1s ease;*/
                /*-moz-transition: all 1s ease;*/
                /*transition: all 1s ease;*/
                /*width: 24px;*/
                /*height: 3px;*/
                /*background: #fff;*/
                position: absolute;
                top: 50%;
                margin-top: -1.5px;
                left: 18px;
                -webkit-transform-origin: 0% 50%;
                -moz-transform-origin: 0% 50%;
                -ms-transform-origin: 0% 50%;
                -o-transform-origin: 0% 50%;
                transform-origin: 0% 50%;
                -webkit-transform: rotate(30deg);
                -moz-transform: rotate(30deg);
                -ms-transform: rotate(30deg);
                -o-transform: rotate(30deg);
                transform: rotate(30deg);
            }
            
            #bubble_menu > .menu .share .bar:before {
                /*-webkit-transition: all 1s ease;*/
                /*-moz-transition: all 1s ease;*/
                /*transition: all 1s ease;*/
                /*content: '';*/
                /*width: 24px;*/
                /*height: 3px;*/
                /*background: #fff;*/
                position: absolute;
                left: 0px;
                -webkit-transform-origin: 0% 50%;
                -moz-transform-origin: 0% 50%;
                -ms-transform-origin: 0% 50%;
                -o-transform-origin: 0% 50%;
                transform-origin: 0% 50%;
                -webkit-transform: rotate(-60deg);
                -moz-transform: rotate(-60deg);
                -ms-transform: rotate(-60deg);
                -o-transform: rotate(-60deg);
                transform: rotate(-60deg);
            }
            
            #bubble_menu > .menu .share.close .circle {
                opacity: 0;
            }
            
            #bubble_menu > .menu .share.close .bar {
                top: 50%;
                margin-top: -1.5px;
                left: 50%;
                margin-left: -12px;
                -webkit-transform-origin: 50% 50%;
                -moz-transform-origin: 50% 50%;
                -ms-transform-origin: 50% 50%;
                -o-transform-origin: 50% 50%;
                transform-origin: 50% 50%;
                -webkit-transform: rotate(405deg);
                -moz-transform: rotate(405deg);
                -ms-transform: rotate(405deg);
                -o-transform: rotate(405deg);
                transform: rotate(405deg);
                
            }
            
            #bubble_menu > .menu .share.close .bar:before {
                -webkit-transform-origin: 50% 50%;
                -moz-transform-origin: 50% 50%;
                -ms-transform-origin: 50% 50%;
                -o-transform-origin: 50% 50%;
                transform-origin: 50% 50%;
                -webkit-transform: rotate(-450deg);
                -moz-transform: rotate(-450deg);
                -ms-transform: rotate(-450deg);
                -o-transform: rotate(-450deg);
                transform: rotate(-450deg);
            }
            
            #bubble_menu > .menu.ss_active {
                background: #804bd8;
                -webkit-transform: scale(0.7);
                -moz-transform: scale(0.7);
                -ms-transform: scale(0.7);
                -o-transform: scale(0.7);
                transform: scale(0.7);
            }
            
            #bubble_menu > div {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                position: absolute;
                width: 60px;
                height: 60px;
                font-size: 30px;
                text-align: center;
                background: #804bd8;
                border-radius: 50%;
                display: table;
            }
            
            #bubble_menu > div:hover {
                background: #804bd8;
                cursor: pointer;
            }
            
            #bubble_menu div:nth-child(1) {
                top: 0px;
                left: -160px;
            }
            
            #bubble_menu div:nth-child(2) {
                top: -80.0px;
                left: -138.56406px;
            }
            
            #bubble_menu div:nth-child(3) {
                top: -138.56406px;
                left: -80.0px;
            }
            
            #bubble_menu div:nth-child(4) {
                top: -160px;
                left: 0.0px;
            }
            
          
            #bubble_menu > div a {
                display: table-cell;
                vertical-align: middle;
                color: inherit;
            }
            
            @keyframes
            
            rebote {
            
                0%, 100% {
                -webkit-transform: translateY(0px);
                -moz-transform: translateY(0px);
                -ms-transform: translateY(0px);
                -o-transform: translateY(0px);
                transform: translateY(0px);
                }
            
                10% {
                    -webkit-transform: translateY(6px);
                    -moz-transform: translateY(6px);
                    -ms-transform: translateY(6px);
                    -o-transform: translateY(6px);
                    transform: translateY(6px);
                }
            
                30% {
                    -webkit-transform: translateY(-4px);
                    -moz-transform: translateY(-4px);
                    -ms-transform: translateY(-4px);
                    -o-transform: translateY(-4px);
                    transform: translateY(-4px);
                }
            
                70% {
                    -webkit-transform: translateY(3px);
                    -moz-transform: translateY(3px);
                    -ms-transform: translateY(3px);
                    -o-transform: translateY(3px);
                    transform: translateY(3px);
                }
            
                90% {
                    -webkit-transform: translateY(-2px);
                    -moz-transform: translateY(-2px);
                    -ms-transform: translateY(-2px);
                    -o-transform: translateY(-2px);
                    transform: translateY(-2px);
                }
            }
            
            .ss_animate {
                -webkit-animation: rebote 1s linear;
                -moz-animation: rebote 1s linear;
                animation: rebote 1s linear;
            }
            
            
            
            
            
            #mydiv-draggable {
              position: absolute;
              text-align: center;
                color: white;
                 z-index: 1000;
                 cursor: pointer;
               
            }
            
            #mydivheader-draggable {
              padding: 10px;
              cursor: move;
              z-index: 1000;
              background-color: #804bd8;
              color: #fff;
              top: 10%;
              
              left: 10px;
              border-radius: 5px;
              position: fixed;
               /*position: sticky !important;*/
                        cursor: pointer;
            }
    </style>
    
    
    
    <body>
        
        
        
        <!--loader-->
        <div class="main-loader-wrap">
              <div class="page-loader" style="">
                   <div class="loader">
                       <span class="dot dot_1"></span>
                       <span class="dot dot_2"></span>
                       <span class="dot dot_3"></span>
                       <span class="dot dot_4"></span>
                   </div>
               </div>
        </div>
        <!--loader end-->
        
        <?php if($isShotMenu){ ?>
        
         <div id='bubble_menu'>
                  <div><a href="/signature_album.php"><i class="bi bi-images"></i></a></div>
                    <div><a href="/wedding_films.php"><i class="bi bi-camera-reels"></i></a></div>
                    <div><a href="/online-album.php"><i class="bi bi-book"></i></a></div>
                    <div><a href="/crm" target="_blank"><i class="bi bi-journal-richtext"></i></a></div>
                  <div class='menu'>
                    <div class='share' id='bubble_lever' data-rot='180'>
                      <i class="bi bi-window-plus menu-icon-main" id="shortMainMenu"></i>
                      <i class="bi bi-x-lg menu-icon-main hide" id="shortMainSubMenu"></i>
                    </div>
                  </div>
                </div>
            
        <?php } ?>
        
        
        <?php if($isUserConvertBtn){ ?>
        
            <div id="mydiv-draggable">
                  <div id="mydivheader-draggable">
                        <div class="d-flex justify-content-end">
                            <a onclick="closeConvertBtn();">
                                <b><i class="bi bi-x-lg text-white"></i></b>
                            </a>
                        </div>
                        <b style="padding: 25px;">Transform into a customer?</b><br>
                        <a class="btn position-relative" href="#" onclick="convertToCustomer();" style="border-color: transparent;white-space: nowrap;">
                            <span class="badge bg-light badge-number text-dark" style="margin-left: 5px;">Convert now</span>
                        </a>
                  </div>
               
                </div>
            
        <?php } ?>
        
        
        
        
          
        
        
        <div class="modal" id="loginGuestUser" data-bs-focus="false">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" style="min-height: 490px;">
                        <div class="content-inner" style="margin-top: 0px; position: revert; width: 100%;">    
                            <div class="content-front guest-user-log-div">
                                
                                <div class="cf-inner remove-gust-user-log-padding">
                                    <div>
                                        <img src="images/machooseLogo.png" alt="" style="width: 68px;">
                                    </div>
                                    <div class="hidden-contact_form-wrap_inner" style="position: revert;     padding: 0px 0px; padding-bottom: 20px;">
                                        <div class="contact-details-title fl-wrap d-flex justify-content-center align-items-center">
                                            <h2 class="new-text-sub-fond">Guest Login</h2>
                                        </div>
                                        <div style="text-align: center;"><h4 class="new-text-sub-fond-link" style="">If you are a registered</h4></div>
                                        <div id="">
                                            <div id="guestLogErrmessage" class="text-danger" style="text-align: left;"></div>
                                            
                                            <form id="addGuestUser" class="add-comment custom-form" style="margin-top: 15px;margin-bottom: 0px;">
                                                <fieldset>
                                                    <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                        <div class="col-md-12" style="padding: 0px;">
                                                            <input name="loginGuestUserEmail" id="loginGuestUserEmail" type="text" placeholder="Enter email id*" value=""/>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                    <div class="col-md-12" style="padding: 0px;">
                                                        <button type="button" onclick="loginGuestUser();" style="padding: 10px !important;width: 60% !important;margin: 0px !important;" id="loginGuestUserButton"><span>Login</span></button>
                                                        <!--<button type="button" onclick="saveComments();" class="btn d-none" id="updateCommentsButton"><span>Update Comment</span></button>-->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    <div style="text-align: center; margin-top: 20px !important;"><h4 class="new-text-sub-fond-link">If you are not able to login</h4></div>
                                    
                                    <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                        <div class="col-md-12" style="padding: 0px;display: flex; flex-direction: column; align-items: center;">
                                            <a href="#" class="single-btn fl-wrap show_contact-form" style="padding: 10px; !important;width: 60% !important;margin: 0px "><span>Click here</span></a>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
						
                            <div class="content-back remove-padding-to-reg" style="height: auto;">
                                <div class="close-contact_form cnt-anim" id="guestUsrregBack"><i class="fal fa-long-arrow-left"></i></div>
                                <div class="hidden-contact_form-wrap_inner remove-padding-to-zero" >
                                    <div class="contact-details-title fl-wrap ">
                                        <h2 class="new-text-sub-fond">Guest Registration</h2>
                                    </div>
                                    <div id="contact-form" class="fl-wrap">
                                            <div id="guestRegErrmessage" class="text-danger" style="text-align: left;"></div>
                                            <form id="addGuestUser1" class="add-comment custom-form" style="margin-top: 15px;margin-bottom: 20px;">
                                                <fieldset>
                                                    <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                        <div class="col-md-12" style="padding: 0px;">
                                                            <input name="guestUserName" id="guestUserName" type="text" placeholder="Your Name *" value=""/>
                                                        </div>
                                                        <div class="col-md-12" style="padding: 0px;">
                                                            <input name="guestUserEmail" id="guestUserEmail" type="text" placeholder="Email Address*" value=""/>
                                                        </div>
                                                        <div class="col-md-12" style="padding: 0px;">
                                                            <input type="text" name="guestUserPhone" id="guestUserPhone" placeholder="Phone*" value=""/>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                
                                                <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                    <div class="col-md-12" style="padding: 0px;">
                                                        <button type="button" onclick="saveGuestUser();" style="padding: 10px !important;width: 60% !important;margin: 0px !important;" id="saveGuestUserButton"><span>Register</span></button>
                                                      
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <!--<div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">-->
                                                <!--    <div class="col-md-12" style="padding: 0px;">-->
                                                <!--        <button type="button" onclick="saveGuestUser();" class="btn" id="saveGuestUserButton"><span>Register</span></button>-->
                                                        <!--<button type="button" onclick="saveComments();" class="btn d-none" id="updateCommentsButton"><span>Update Comment</span></button>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer  -->
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div> -->

                </div>
            </div>
        </div>
        
     
        
          <!--  Comments Modal start  -->
        <div class="modal" id="viewCommentsModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 style="font-size: 2em;">Comments</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="commentsListDiv">
                        
                        <div class="row" id="commentListUl">
                        </div>
                        
                        
                        
                        <!--<ul class="commentlist clearafix" id="commentListUl" style="padding-left: 0px"></ul>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Comments Modal start -->
                
        <div class="modal" id="registerModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3>Customer Registration</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="registerModalBody">
                        
                    </div>

                    <!-- Modal footer 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>-->

                </div>
            </div>
        </div>
        <!-- Start Enquiry form modal -->
        <div class="modal" id="enquiryModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="content-inner" style="margin-top: 0px; position: revert; width: 100%;">    
                            <div class="content-front" style="margin-bottom: 0px;">
                                
                                <div class="cf-inner-new">
                                    <div>
                                        <img src="images/machooseLogo.png" alt="" style="width: 68px;">
                                    </div>
                                    <div>
                                        <h2 style="font-size: 22px;">Machooos International</h2>
                                        <a class="link_simple-link__2vG_Y undefined" href=" https://maps.app.goo.gl/NZapzrBcK9DrW1z49" target="_blank" rel="noopener noreferrer">
                                            <span class="icon_icon__3-fTT icon_icon--size-sm__1JLG6">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" stroke-miterlimit="10" style="width: 20px; margin-right: 3px;">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </span>KERALA </a>|
                                            
                                            <a class="link_simple-link__2vG_Y undefined" href="https://maps.app.goo.gl/vkKdx4UBram66y9Q8" target="_blank" rel="noopener noreferrer">
                                            <span >
                                            </span> TAMILNADU </a>|
                                            
                                            <a class="link_simple-link__2vG_Y undefined" href="https://maps.app.goo.gl/D5mi2BiASJeF3SK77" target="_blank" rel="noopener noreferrer">
                                            <span >
                                            </span> HYDERABAD </a>|
                                            
                                            <a class="link_simple-link__2vG_Y undefined" href="https://maps.app.goo.gl/JkpBYAB3wHgtzwVz6" target="_blank" rel="noopener noreferrer">
                                            <span >
                                            </span> BANGLORE </a>
                                    </div>
                                    <div class="contact-details-title fl-wrap" style="padding:0px;">
                                        <!-- <h2>Trivandrum</h2> -->
                                        <div class="row" style="margin-top: 20px;">
                                            
                                            
                                            <div class="col-sm-6" style="margin-top: 10px;">
                                                
                                                <div class="grid_row__2Ynwz grid_row--position-relative__21aAJ">
                                                    <div class="grid_col__13p8Y grid_col--5__zagq7">
                                                        <div class="grid_row__2Ynwz grid_row--vcenter__3pA74 grid_row--position-relative__21aAJ">
                                                            <div class="grid_col__13p8Y">
                                                                <span class="color_color__724I3 color_color--shade-blue__9lTbQ">
                                                                    <span class="icon_icon__3-fTT icon_icon--size-sm__1JLG6">
                                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" stroke-miterlimit="10">
                                                                        <path class="icon-path-fill" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                    </svg>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                            <div class="grid_col__13p8Y grid_col--9__153gG">
                                                                <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-bold__ePKsm text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">PHONE</span>
                                                                <a href="tel:+919961117777" target="_blank" rel="noopener noreferrer" data-channel="phone">
                                                                    <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-normal__7xJtf text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">+919961117777</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="margin-top: 10px;">
                                                <div class="grid_col__13p8Y grid_col--6__1g0nn">
                                                    <div class="grid_row__2Ynwz grid_row--vcenter__3pA74 grid_row--position-relative__21aAJ">
                                                        <div class="grid_col__13p8Y">
                                                            <span class="color_color__724I3 color_color--shade-blue__9lTbQ">
                                                                <span class="icon_icon__3-fTT icon_icon--size-sm__1JLG6">
                                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" stroke-miterlimit="10">
                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                    <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                                                </svg>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <div class="grid_col__13p8Y grid_col--9__153gG">
                                                            <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-bold__ePKsm text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">WEBSITE</span>
                                                            <a href="https://machooosinternational.com/" target="_blank" rel="noopener noreferrer" data-channel="website">
                                                                <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-normal__7xJtf text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">https://machooosinternational.com/</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" style="margin-top: 10px;">
                                                <div class="grid_row__2Ynwz grid_row--vcenter__3pA74 grid_row--position-relative__21aAJ">
                                                    <div class="grid_col__13p8Y">
                                                        <span class="color_color__724I3 color_color--shade-blue__9lTbQ">
                                                            <span class="icon_icon__3-fTT icon_icon--size-sm__1JLG6">
                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" stroke-miterlimit="10">
                                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" class="icon-path-fill"></path>
                                                                <path d="M22 6l-10 7L2 6"></path>
                                                            </svg>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="grid_col__13p8Y grid_col--9__153gG">
                                                        <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-bold__ePKsm text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">EMAIL</span>
                                                        <a href="mailto:machooos522@gmail.com" target="_blank" rel="noopener noreferrer" data-channel="email">
                                                            <span class="text_text__1RBPx text_text--size-5__JFPBK text_text--boldness-normal__7xJtf text_text--display-block__35429 color_color__724I3 color_color--shade-dark__2DZUJ">machooos522@gmail.com</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="page_section__GLohA page_section--style-default__xQRb4 page_section--padding__wFEd4">
                                          <div tabindex="0" role="button">
                                            <div class="grid_space__AEDhR grid_space--10px__23KJZ grid_space--vertical__143zu"></div>
                                            <div>
                                              <span class="text_text__1RBPx text_text--size-4__1ORz_ text_text--boldness-semibold__2eOdh text_text--display-block__35429 color_color__724I3 color_color--shade-darker__DfAFV new-text-sub-fond" >Follow us on</span>
                                              <div class="grid_space__AEDhR grid_space--4px__23yHd grid_space--vertical__143zu"></div>
                                              <div class="buttons_grouped-btns__32QS2 buttons_grouped-btns--style-default__33LXf">
                                                <button type="button" class="buttons_grouped-btns__btn___oEeK">
                                                  <a href="https://wa.me/+919961117777?text=eg. Let us know when is the event and event details...&amp;source=Premagic" target="_blank" rel="noopener noreferrer" data-channel="whatsapp" style="color: rgb(100, 177, 97);">
                                                    <i class="bi bi-whatsapp" ></i>
                                                  </a>
                                                </button>
                                                <button type="button" class="buttons_grouped-btns__btn___oEeK">
                                                  <a href="https://www.facebook.com//machooos/?text=eg. Let us know when is the event and event details...&amp;source=Premagic" target="_blank" rel="noopener noreferrer" data-channel="facebook" style="color: rgb(71, 89, 147);">
                                                    <i class="bi bi-facebook"></i>
                                                  </a>
                                                </button>
                                                <button type="button" class="buttons_grouped-btns__btn___oEeK">
                                                  <a href="https://www.instagram.com//machooosinternational/?text=eg. Let us know when is the event and event details...&amp;source=Premagic" target="_blank" rel="noopener noreferrer" data-channel="instagram" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                                    <i class="bi bi-instagram"></i>
                                                  </a>
                                                </button>
                                                <button type="button" class="buttons_grouped-btns__btn___oEeK">
                                                  <a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?text=eg. Let us know when is the event and event details...&amp;source=Premagic" target="_blank" rel="noopener noreferrer" data-channel="youtube" style="color: rgb(255, 0, 0);">
                                                    <i class="bi bi-youtube"></i>
                                                  </a>
                                                </button>
                                              </div>
                                            </div>
                                            <div class="grid_space__AEDhR grid_space--4px__23yHd grid_space--vertical__143zu"></div>
                                          </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="contact-details-title fl-wrap">
                                        <h2 class="new-text-sub-fond" style="padding-bottom: 0px;">Trivandrum <label class="text-secondary">(Regional Office)</label></h2>
                                    </div>
                                    <div class="contact-details edafl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank">TC24/1474 BISMI HEIGHTS<br> kowdiar,Trivandrum,kerala<br><span>Ring us:<br> +91-9961117777,+91-9895095694</span></a></li>
                                        </ul>
                                    </div>
    								<div class="contact-details-title fl-wrap">
                                        <h2 class="new-text-sub-fond" style="padding-bottom: 0px;">Ernakulam <label class="text-secondary">(Head office)</label></h2>
                                    </div>
                                    <div class="contact-details fl-wrap" style="margin-top: 0px;">
                                        <ul>
                                            <li><a href="#" target="_blank">Incuspaze <br> Oberon mall <br>NH Bye Pass,Padivattom Edappally, Ernakulam,<span>Ring us:<br> +91-9961117777,+91-9809995333</span></a></li>
                                        </ul>
                                    </div>
                                    
                                    <a href="#" class="single-btn fl-wrap show_contact-form" style="margin-top: 0px"><span>Enquire</span></a>
                                </div>
                            </div>
						
                            <div class="content-back " style="height: auto">
                                <div class="close-contact_form cnt-anim"><i class="fal fa-long-arrow-left"></i></div>
                                <div class="hidden-contact_form-wrap_inner set-padding-desktop" style="position: revert;">
                                    <div class="contact-details-title fl-wrap">
                                        <h2 class="new-text-sub-fond-1">Enquire for your special day?</h2>
                                    </div>
                                    <div id="contact-form" class="fl-wrap">
                                        <div id="enquireErrmessage" class="text-danger" style="text-align: left;"></div>
                                        <form  class="custom-form" action="php/contact.php" name="contactform" id="contactform" style="margin-top: 15px;">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" name="eventUser" id="eventUser" placeholder="Your name ? *" value=""/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text"  name="eventUserEmail" id="eventUserEmail" placeholder="Your email ? *" value=""/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select class="form-select" id="eventType" data-show-content="true" >
                                                            <option value="">Whats the event? *</option>
                                                            <option value="Birthday">Birthday</option>
                                                            <option value="Corporate">Corporate</option>
                                                            <option value="Couple Shoot">Couple Shoot</option>
                                                            <option value="Family Photoshoot">Family Photoshoot</option>
                                                            <option value="Maternity Photoshoot">Maternity Photoshoot</option>
                                                            <option value="FashionModel Photoshoot">Fashion Model Photoshoot</option>
                                                            <option value="NewBornBabyPhotoshoot">New Born Baby Photoshoot</option>
                                                            <option value="Product Photoshoot">Product Photoshoot</option>
                                                            <option value="Real-estate Photoshoot">Real-estate Photoshoot</option>
                                                            <option value="Restaurant Photoshoot">Restaurant Photoshoot</option>
                                                            <option value="Theme Photoshoot">Theme Photoshoot</option>
                                                            <option value="Wedding">Wedding</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                                            <input class="span2" type="text" id="eventDate" id="eventDate" value="" style="margin-bottom: 0px;" placeholder="Select event date *">
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                                
                                                 <div class="row set-adjest-top" >
                                                    <div class="col-sm-6">
                                                        <input type="text" name="eventWhere" id="eventWhere" placeholder="Where is the event? *" value=""/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text"  name="guestsCount" id="guestsCount" placeholder="How many guests are you expecting? *" value=""/>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                <!-- <div class="row">
                                                    <div class="col-sm-12" style="text-align: left; font-size: 14px; font-weight: 600; margin-bottom: 10px;">What are the occasion you want us to cover?</div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Engagement" name="occasionType[]" value="Engagement">
                                                            <label class="form-check-label" for="Engagement">Engagement</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="preWedding" name="occasionType[]"  value="preWedding">
                                                            <label class="form-check-label" for="inlineCheckbox2">Pre Wedding</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Pellikuthuru" name="occasionType[]" value="Pellikuthuru">
                                                            <label class="form-check-label" for="inlineCheckbox3">Pellikuthuru</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Vradham" value="Vradham" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Vradham</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Mehndi" value="Mehndi" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Mehndi</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Cocktail" value="Cocktail" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Cocktail</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="PostWedding" value="PostWedding" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Post Wedding</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Coupleshoot" value="Coupleshoot" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox1">Couple shoot</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Pellikoduku" value="Pellikoduku" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox2">Pellikoduku</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Sangeeth" value="Sangeeth" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Sangeeth</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Haldi" value="Haldi" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Haldi</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="TempleShoot" value="TempleShoot" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Temple Shoot</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input occasionType" type="checkbox" id="Reception" value="Reception" name="occasionType[]">
                                                            <label class="form-check-label" for="inlineCheckbox3">Reception</label>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="row">
                                                    <div class="col-sm-12" style="text-align: left;">
                                                        <label class="form-check-label new-text-sub-fond-small" for="comments" style="margin-bottom: 10px;">Tell me more about this event(Any details you want to let us know)</label>
                                                        <textarea name="comments"  id="comments" cols="40" rows="3" placeholder="Your Message:" class="cnt-anim"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button type="button" id="" onclick="sendEnquiry();"><span>Confirm</span> </button>
                                                        <!-- <button type="button" style="" onclick="sendEnquiry();"><span>Confirm</span> </button> -->
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer  -->
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div> -->

                </div>
            </div>
        </div>
        <!--End Enquiry form modal -->
        
        
        
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background-color: transparent;border-color: transparent;">
            <div class="modal-body" style="background-color: transparent;border-color: transparent;padding: 0px;">
                <!--<div class="text-right" align="right"> <i class="fa fa-window-close fa-2x close-pop" data-dismiss="modal" onclick="closePopup();"></i> </div>-->
                <div class="row" style="background-color: transparent;border-color: transparent;padding: 0px;">
                    <div class="col-md-12" id="popupWindow">
                        
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>      
        
        
        
        
        
        
        
        
<div class="modal" id="SCModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body p-4 px-5">

                <div class="main-content text-center " style="margin-top: 20px;">
                    <!--<div>-->
                    <!--    <img src="images/machooseLogo.png" alt="" style="width: 110px;">-->
                    <!--</div>-->
                    <h2 style="font-size: 22px;margin-bottom: 20px;">Machooos International</h2>
                    <h4 class="p-t-10 mb-4 text-dark">Please register as a guest if you would like to view the information on the website without interruption!</h4>
                    
                    
                    <div id="page1" class="d-none">
                        
                        
                         <div class="form-group mb-4">
                            <input class="form-control " type="text" id="SCemail" name="SCemail" value="" placeholder="Enter your email" >
                        </div>
                        
                       
                        <span id="frstSCErr" class="d-none text-danger mb-4" style="font-weight: 500;"></span>
                        
                        <div class="d-flex">
                            <div class="mx-auto">
                                <a href="#" onclick="applySCNew();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">Submit</div>
                                </a>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                    </div>
                    
                    <div id="page11" class="d-none">
                        
                        <div class="form-group mb-4 p-t-20">
                            <select class="form-control select2" id="selSCCounty" name="selCounty" onchange="getSCState('selSCState');">
                                <option selected value=''>-- Select your country -- </option>
                            </select>
                        </div>
    
                        <div class="form-group mb-4">
                            <select class="form-control select2" id="selSCState" name="selState">
                                <option selected value=''>-- Select your state --</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-4">
                            <input class="form-control " type="text" id="SCname" name="SCname" value="" placeholder="Enter your name" >
                        </div>
                        
                      
                        
                        <div class="form-group mb-4">
                            <input class="form-control " type="text" id="SCphone" name="SCphone" value="" placeholder="Enter your phone" >
                        </div>
                        <span id="frst1SCErr" class="d-none text-danger mb-4" style="font-weight: 500;"></span>
                        
                        <div class="d-flex">
                            <div class="mx-auto">
                                <a href="#" onclick="applySC();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">Submit</div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div id="page2" class="d-none">
                        <div class="form-group mb-2">
                            <input class="form-control " type="password" id="SCpassword" name="SCpassword" value="" placeholder="Enter password" >
                        </div>
                        <span id="loginSCErr" class="d-none text-danger mb-4" style="font-weight: 500;"></span>
                        
                        <div class="d-flex">
                            <div class="mx-auto">
                                <a href="#" onclick="loginSC();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">Login</div>
                                </a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                    <div id="page3" class="d-none">
                        
                        <span id="otpInfo" class="mb-4"></span>
                        <div class="form-group mb-2">
                            <input class="form-control " type="text" id="SCotp" name="SCotp" value="" placeholder="Enter login otp" >
                        </div>
                        
                        <span id="otpSCErr" class="d-none text-danger mb-4" style="font-weight: 500;"></span>
                        
                        <div class="d-flex">
                            <div class="mx-auto">
                                <a href="#" onclick="validateSC();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">Login</div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

        
        
        
        
        
              
        
<div class="modal" id="AccountTypeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body p-4 px-5">

                <div class="main-content text-center " style="margin-top: 20px;">
                    <!--<div>-->
                    <!--    <img src="images/machooseLogo.png" alt="" style="width: 110px;">-->
                    <!--</div>-->
                    <h2 style="font-size: 22px;margin-bottom: 20px;">Machooos International</h2>
                    <!--<h5 class="p-t-20 mb-4 text-dark">Machooos International Wedding Company has been established as a photography company in Kerala, India.</h5>-->
                    
                   
                    
                    <div>
                        <div class="form-group mb-2">
                            <h5 style="font-size: 16px;">Are you our guest user? Or is it the customer?</h5>
                        </div>

                        <div class="d-flex">
                            <div style="margin-left: auto!important;margin-right: 5px; !important;">
                                <a href="#" onclick="setGuestUser();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">GUEST USER</div>
                                </a>
                               
                            </div>
                             <div style="margin-right: auto!important;margin-left: 5px; !important;">
                              
                                 <a href="#" onclick="setCustomerUser();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">CUSTOMER</div>
                                </a>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- Start subscription form modal -->
        <div class="modal" id="confirmSubscriptionModal" style="background: #000000b5;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h2 style="font-size: 28px;">Purchase Plan</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeModaldiv();"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="confirmSubscriptionContent">
                        
                    </div>

                    <!-- Modal footer 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>-->

                </div>
            </div>
        </div>
         <!--End subscription form modal -->
         
         
        <!--  main start  -->
        <div id="main" >
            
            <input type="hidden" value="<?php echo $contact_user_id; ?>" id="loggedUserId">
            
            <!--  header main-header  -->
            <header class="main-header">
                <a href="index.php" class="ajax logo-holder"><img src="images/logo.png" alt=""></a>
                <?php
                // echo basename($_SERVER['PHP_SELF']);
                    if($contact_user_id || $_COOKIE['guestLoginId'] != 0){
                      
                        //echo '<div class="hero-title" style="position: absolute; right: 3%; color: #0e0e0e;top: 9%;"><h4>Loged in as '.$logedUser.'</h4></div><div class="sb-button" style="height: 33px; line-height: 32px; margin-top: 9px;" onclick="logout();">Sign Out</div>';

                    }else{
                        
                        
                        echo '<div id="btn-sign-in" class="sb-button c_sb" style="height: 33px; line-height: 32px; margin-top: 9px;">Sign In</div>';
                    
                        
                    }
                ?>
             	
                 <?php 
                                // $top = 'top: 5%';
                                // if(basename($_SERVER['PHP_SELF']) == "index.php"){
                                //     $top = 'top: 18%';
                                // }
                                // if($contact_user_id){
                                    
                                //     echo '<div class="hero-title" style="position: absolute; z-index: 999; right: 4.2%; color: #804bd8; '.$top.';"><h4>Loged in as '.$logedUser.'</h4></div>';
                                // }else{
                                //     echo '<div class="hero-title" style="position: absolute; z-index: 999; right: 4.2%; color: #804bd8; '.$top.';"><h4>Loged in as '.$logedUser.'</h4></div>';
                                // }
                            ?>
                <!-- <div class="sb-button c_sb"><span></span></div> -->
                <!-- <div class="sb-button showLogin"><span></span></div> -->
                <div class="nav-button-wrap">
                    <div class="nav-button"><span></span><span></span><span></span></div>
                </div>
                <!--  navigation -->
                <div class="nav-holder main-menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php" class="act-link" name="navLinkMenu" id="navLinkMenuHome">Home </a>
                            </li>
                            
                           
                            
                            <li>
                                <a href="about.php" class="" name="navLinkMenu" id="navLinkMenuAbout">About</a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="stories.php" class="ajax">Stories</a>-->
                            <!--</li>-->
                           
                            <li>
                                 <a href="javascript:void(0)" class="dropdown-toggle" style="display: block !important;" name="navLinkMenu" id="navLinkMenuPortfolio">Portfolio</a>
                                <ul>
									<li><a href="cinematography-list.php" class=""> Cinematography</a></li>
                                     <!--<li><a href="blog_01.php" class="ajax">Blog Details</a></li> -->
                                    <li><a href="stories.php">Stories</a></li>
                                    <li><a href="blogs.php" >Blogs</a></li>
                                </ul>
                            </li>
                            
                            <li>
                                <ul>
									
                                </ul>
                            </li>
                            
                           
                            
                            
                             
                           
                            
                            <?php
                                if($contact_user_id){
                            ?>
                           
                            <li>
                                 <a href="javascript:void(0)" class="dropdown-toggle" style="display: block !important;" name="navLinkMenu" id="navLinkMenuDA">Digital Albums</a>
                                <ul>
                                    	<li><a href="online-album.php" class=""> Portable Photo Book</a></li>
									
                                    <li><a href="signature_album.php" class="" >Signature Album</a></li>
                                   
									
									<?php 
									
									    $sqlIMG = "SELECT id FROM tbesignaturealbum_data WHERE completeImgSel=5 and user_id='$contact_user_id'";

                                        $resultImg = $DBC->query($sqlIMG);
                                        
                                        $countImg = mysqli_num_rows($resultImg);
                                        
                                        $sqlIMG1 = "SELECT id FROM tbesignaturealbum_subuser_data WHERE completeImgSel=5 and user_id='$contact_user_id'";

                                        $resultImg1 = $DBC->query($sqlIMG1);
                                        
                                        $countImg1 = mysqli_num_rows($resultImg1);
                                        
                                        if($countImg > 0 || $countImg1 > 0) {	
                                            
                                    ?>
                                            
                                            <li><a href="selected-images.php" class=""> Selected images </a></li>
                                            
                                    <?php
                                            
                                           
                                        }
									
									
									?>
									
									 <li><a href="wedding_films.php" class=""> Wedding Films</a></li>
								
									
									
									
									
									
									
									
									
                                    <!--<li><a href="signature_album.php?uid=<?php echo base64_encode($contact_user_id); ?>" class="" >Signature Album</a></li>-->
                                    
                                    
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="crm" class="" target="_blank" style="top: 0;background: #000;color: #fff;line-height: 20px; padding-right: 20px;padding-left: 20px;">CRM </a>
                            </li>
                             --> 
                            <?php    
                                }
                            ?>
                            


                            <li>
                                <a href="contacts.php" class="" name="navLinkMenu" id="navLinkMenuContact" >Contact</a>
                            </li>
                        <?php
                            // echo basename($_SERVER['PHP_SELF']);
                            if($contact_user_id){

                        ?> 




                            <li>
                                <a class="text-primary" href="#" data-bs-toggle="dropdown" style="top: 5%;"><h3 class="dropdown-toggle"> <b class="text-uppercase "><?=$logedUser?></b></h3> </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: rgba(0,0,0,.8);">
                                    
                                
                                    
                                    <li class="dropdown-header " >
                                     <a href="crm" id="crm_link" class="" target="_blank" style="top: 0;line-height: 20px;margin-left: 0px;margin-right: 9px;margin-bottom: 5px; ">CRM </a>
                                    </li>
                                  
                                    <li class="dropdown-header " >
                                     <a href="dashboard/index.php" class="" id="dashboard_link" target="_blank" style="top: 0;line-height: 20px;margin-left: 0px;margin-right: 9px;margin-bottom: 5px;">Dashboard </a>
                                    </li>
                                   
                                    <li style="margin-right: 20px;">
                                      <a class="dropdown-item d-flex align-items-center" href="#" onclick="logout();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                      </a>
                                    </li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                        
                                  </ul><!-- End Profile Dropdown Items -->
                           </li>

                           <li class="nav-item dropdown">

                                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="badge bg-primary badge-number"><?=$notifi_count?></span>
                                </a><!-- End Notification Icon -->
                  
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;
                                overflow-y: scroll; max-height: 550px;overflow-x: hidden;background: black">
                                    
                                      <li class="notification-item d-flex justify-content-end align-items-end" >
   <div class="bg-black d-flex justify-content-end align-items-end" style="background: black">
                                                                             <a href="#" onclick="setAllNotificationRead(<?= $cmtUserIdVal ?>, <?= $cmtrUserTypeVal ?>);" style="padding-bottom: 10px; background: black !important;">Mark all as read</a>
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
                                            <h4 class="text-light"><a style="letter-spacing: 2px !important;font-weight: 100 !important;margin-bottom:0rem !important;" href="<?= $notfys['url'] ?>" onclick="setNotificationRead(<?= $notfys['id'] ?>);"><?= $notfys['task'] ?></a></h4>
                                            <p style="text-align: right;margin-bottom: 0rem !important;"><?= $nttime ?></p>
                                            </div>
                                    </li>
                        
                                    <li>
                                        <hr class="dropdown-divider" style="border-color: #454443;">
                                    </li>
                                    
                                         
                                     
                                  <? } ?>
                                  
                                  
                             
                              
                                <li class="dropdown-footer" >
                                    <a href="notifications.php" style="padding-bottom:20px;">Show all notifications</a>
                                </li>
                    
                                </ul><!-- End Notification Dropdown Items -->
                    
                          </li>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          <li class="nav-item dropdown">

                                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <b>Cart <i class="bi bi-cart"></i></b>
                                <span class="badge bg-success badge-number"><?=$countcart?></span>
                                </a><!-- End Notification Icon -->
                  
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;
                                background: black">
                                    
                                <li class="dropdown-header" >
                                    <span style="padding: 10px; color: white !important;font-size: 20px;"><b>My cart,</b> <small class="text-muted"><?=$countcart?> item</small></span>
                                </li>
                                
                                <li>
                                    <hr class="dropdown-divider" style="border-color: #454443;">
                                </li>
                                
                                
                                <?php if(count($cartData) > 0) { ?>
                                
                                    
                                
                                    <li>
                                        <div class="row" style="padding-left: 20px;padding-right: 20px;overflow-y: scroll; max-height: 350px;overflow-x: hidden;">
                                            <?php
                                            $frst = false;
                                            foreach ($cartData as $key => $album) { 
                                                        $album_type = $album['album_type'];
                                                        $album_id = $album['album_id'];
                                                        $quantity = $album['quantity'];
                                                        $finalPrice = $album['final_amount'];
                                                        $actualPrice = $album['amount'];
                                                        $offerPriceP = $album['offer'];
                                                        
                                                        
                                                        if($album_type == 'SA'){
                                                            
                                                            $fet = "SELECT * FROM `tbesignaturealbum_projects` WHERE `id`=$album_id ";
                                                            $resultf = $DBC->query($fet);
                                                            $rowf = mysqli_fetch_assoc($resultf);
                                                            
                                                            if($rowf['upload_server'] == 1) $imagePath = $rowf['cover_img_path'];
                                                            else $imagePath = "/admin/".$rowf['cover_img_path'];
                                                            
                                                            
                                                            $heading = $rowf['project_name'];
                                                            
                                                        }else{
                                                            $fet = "SELECT *, E.id album_id FROM tbevents_data E JOIN tbeevent_files F ON(F.event_id = E.id) WHERE E.id = $album_id";
                                                            $resultf = $DBC->query($fet);
                                                            $rowf = mysqli_fetch_assoc($resultf);
                                                            
                                                            if($rowf['upload_server'] == 1) $imagePath = $rowf['covering_name'];
                                                            else $imagePath = "/admin/eventUploads/".$rowf['uploader_folder']."/".$rowf['covering_name'];
                                                            
                                                            $heading = $rowf['event_name'];
                                                            
                                                            
                                                        }
                                                        
                                                        
                                                        
                                            ?>
                                            
                                            <?php if($frst){ ?>
                                            <hr class="text-muted">
                                               <?php 
                                            }else{$frst = true;} ?> 
                                    
                                                <div class="col-md-4 col-sm-4 d-flex align-items-center" style="padding-bottom: 3px;">
                                                    <div class="gallery-item" style="width: 100% !important;">
                                                        
                                                        <div class="grid-item-holder">
                                                            <div class="image-container justify-content-center align-items-center" style="width: 100%; max-height: 160px; overflow: hidden;">
                                                            <img style="width: 100%;" src="<?=$imagePath?>" alt="">
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                                
                                                 <div class="col-md-8 col-sm-8 " style="padding-top:5px;text-align: left !important;" >
                                                    
                                                   <h4 class="text-white d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$heading?></h4>
                                                        <h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;">
                                                            <?=$quantity?> year &nbsp;&nbsp; <b class="text-danger"><?=$offerPriceP?>% off</b>
                                                        
                                                        </h4>

                                                   <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;">
                                                       <b><span class="mr-3" >₹ <?=$finalPrice?> / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ <?=$actualPrice?></del></span></b>
                                                   </h4>
                                                    

                                                   
                                                </div>
                                            
                                           
                                            
                                             <?php } ?>
                                         </div>
                                         
                                    </li>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <li>
                                        <hr class="dropdown-divider" style="border-color: #454443;">
                                    </li>
                                    <li class="dropdown-footer" align="center" >
                                        <button onclick="gotoCart()" id="loadMore">View cart</button>
                                    </li>
                                
                                <? } else { ?>
                                    
                                    <li>
                                
                                        <div class="col-md-12 " style="padding: 20px;text-align: center;" >
                                                                        
                                            <span class="bold-text text-danger new-text-sub-fond-1"><b style="letter-spacing: .05rem;">Cart is empty!</b></span> 
                                           
                                        </div>
                                    </li>
                                
                                <?php } ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                    
                              
                    
                                </ul><!-- End Notification Dropdown Items -->
                    
                          </li>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          

                         
                        <?php }else{ 
                        
                         if($_COOKIE['guestLoginId'] != 0){
                            if(!isset($_COOKIE['guestLoginName'])) $logginUserName ="";
                            else  $logginUserName =$_COOKIE['guestLoginName'];

                        }
                        
                        if($logginUserName != ""){
                        
                        
                        ?>
                            
                            
                            <li>
                                <a class="text-primary" href="#" data-bs-toggle="dropdown" style="top: 5%;"><h3 class="dropdown-toggle"> <b class="text-uppercase"><?=$logginUserName?></b></h3> </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" style="background: rgba(0,0,0,.8);">
                                   
                                    <li style="margin-right: 20px;">
                                      <a class="dropdown-item d-flex align-items-center" href="#" onclick="logoutGuestUser();" style=" margin-bottom: 9px;margin-left: 9px;margin-right: 9px;background: #804bd8">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                      </a>
                                    </li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                        
                                  </ul><!-- End Profile Dropdown Items -->
                           </li>
                           
                           
                            <li class="nav-item dropdown">

                                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="badge bg-primary badge-number"><?=$notifi_count?></span>
                                </a><!-- End Notification Icon -->
                  
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" style="width: 300px;
                                overflow-y: scroll; max-height: 550px;overflow-x: hidden;background: black">
                                    
                                       <li class="notification-item d-flex justify-content-end align-items-end" >
   <div class="bg-black d-flex justify-content-end align-items-end" style="background: black">
                                                                             <a href="#" onclick="setAllNotificationRead(<?= $cmtUserIdVal ?>, <?= $cmtrUserTypeVal ?>);" style="padding-bottom: 10px; background: black !important;">Mark all as read</a>
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
                                            <h4 class="text-light"><a style="letter-spacing: 2px !important;font-weight: 100 !important;margin-bottom:0rem !important;" href="<?= $notfys['url'] ?>" onclick="setNotificationRead(<?= $notfys['id'] ?>);"><?= $notfys['task'] ?></a></h4>
                                            <p style="text-align: right;margin-bottom: 0rem !important;"><?= $nttime ?></p>
                                            </div>
                                    </li>
                        
                                    <li>
                                        <hr class="dropdown-divider" style="border-color: #454443;">
                                    </li>
                                    
                                         
                                     
                                  <? } ?>
                                  
                                  
                             
                              
                                <li class="dropdown-footer" >
                                    <a href="notifications.php" style="padding-bottom:20px;">Show all notifications</a>
                                </li>
                    
                                </ul><!-- End Notification Dropdown Items -->
                    
                          </li>

                            
                            
                            
                            
                            
                     
                        
                        
                        
                        
                        
                        
                        <?php } } ?>




                        </ul>
                    </nav>
                </div>
                <!-- navigation  end --> 
                
            </header>
            <!-- Header   end-->
            
            <!-- wrapper -->
            <div id="wrapper">
                
              