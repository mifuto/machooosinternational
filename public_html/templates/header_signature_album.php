<?php 

if (isset($_COOKIE['user_state_val']) && isset($_COOKIE['user_county_val'])) {

    $user_state_val = $_COOKIE['user_state_val'];
    $user_county_val = $_COOKIE['user_county_val'];
    
  

} else {
    
    $user_state_val = "";
    $user_county_val = "";
  
    setcookie('user_state_val', $user_state_val, time() + (86400 * 30), "/");
    setcookie('user_county_val', $user_county_val, time() + (86400 * 30), "/");

   
}


include("config.php");
// echo $contact_user_id;
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!--=============== basic  ===============-->
    	
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Machooos International</title>
        <!--<meta name="robots" content="index, follow"/>-->
        <!--<meta name="keywords" content=""/>-->
        <meta name="description" content="Machooos International"/>
        <?php if(isset($setOg) && $setOg) { ?>
            <meta property="og:locale" content="en_US">
            <meta property="og:type" content="article">
            <meta property="og:title" content="Signature Album">
            <meta property="og:description" content="Machooos International">
            <meta property="og:url" content="<?= $ogurl ?>">
            <meta property="og:image" content="<?= $ogimage ?>">
            <meta property="og:site_name" content="machooosinternational.com">
        <?php } ?>
    	<meta property="article:published_time" content="2023-05-04T05:15:29+00:00">
    	<meta property="article:modified_time" content="2023-05-04T05:15:30+00:00">
    	<meta name="twitter:card" content="summary_large_image">
    	<meta name="twitter:label1" content="Written by">
    	<meta name="twitter:data1" content="en24tv">
    	
    	
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">


    	
    	
        <!--=============== css  ===============-->	
        <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="./css/plugins.css">
        <link type="text/css" rel="stylesheet" href="./css/style.css">
        <link type="text/css" rel="stylesheet" href="./css/color.css">
        <link type="text/css" rel="stylesheet" href="./css/lc_lightbox.css" />
        <!--<link type="text/css" rel="stylesheet" href="./css/reset.css">-->
        <!--<link rel="stylesheet" href="./skins/minimal.css" />-->
        <link type="text/css" rel="stylesheet" href="./admin/assets/css/select2.css">
        <link rel="stylesheet" href="./css/justifiedGallery.min.css" />
        <link rel="stylesheet" href="./css/datepicker.css" />
        <link rel="stylesheet" href="./css/bootstrap-select.min.css" />
        <link href="./css/emoji.css" rel="stylesheet">
        
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.ico">
        <script  src="./js/jquery.min.js"></script>
        <script  src="./js/inputEmoji.js"></script>
        <script  src="./js/config.js"></script>
        <script  src="./js/util.js"></script>
        <script  src="./js/jquery.emojiarea.js"></script>
        <script  src="./js/emoji-picker.js"></script>
        <!-- <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/css/bootstrap-select.min.css"> -->
        
        <!-- <script  src="js/bootstrap-select.min.js"></script> -->
       
       


    </head>
     <style>
        #signatureAlbumTabs .nav-link.active {
          /* Add your desired styles here */
          color: black !important;
          background: #D3D3D3 !important;
        }
        
        /* Default styles for the button (website view) */
        #saveCommentsButton {
          padding: 10px;
          width: 25%;
          margin: 0;
        }
        
        /* Media query for mobile devices with a maximum width of 767px */
        @media (max-width: 767px) {
          #saveCommentsButton {
            width: 50%;
          }
        }
        
         /* Default styles for the button (website view) */
        #updateCommentsButton {
          padding: 10px;
          width: 25%;
          margin: 0;
        }
        
        /* Media query for mobile devices with a maximum width of 767px */
        @media (max-width: 767px) {
          #updateCommentsButton {
            width: 50%;
          }
        }
        
        /* Add a class to style the sticky header */
        .sticky-header {
            position: sticky;
            top: 0%;
            background-color: #f1f1f1; /* Add your preferred background color */
            z-index: 100; /* Make sure the header appears above other content */
        }
        
      

        /* Add some styling to the nav tabs for demonstration purposes */
        .nav-tabs {
            background-color: #ffffff; /* Add your preferred background color */
            border-bottom: 1px solid #ccc; /* Add a border to separate the header from the content */
        }

        /* Add some styling to the tab items for demonstration purposes */
        .nav-item {
            margin-right: 10px;
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
                                        <a class="link_simple-link__2vG_Y undefined" href="https://goo.gl/maps/km7x4HZX95afZSxW6" target="_blank" rel="noopener noreferrer">
                                            <span class="icon_icon__3-fTT icon_icon--size-sm__1JLG6">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" stroke-miterlimit="10" style="width: 20px; margin-right: 3px;">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                            </span>ERNAKULAM | KOCHI</a>
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
                                        <h2 class="new-text-sub-fond" style="padding-bottom: 0px;">Trivandrum</h2>
                                    </div>
                                    <div class="contact-details edafl-wrap">
                                        <ul>
                                            <li><a href="#" target="_blank">TC24/1474 BISMI HEIGHTS<br> kowdiar,Trivandrum,kerala<br><span>Ring us:<br> +91-9961117777,+91-9895095694</span></a></li>
                                        </ul>
                                    </div>
    								<div class="contact-details-title fl-wrap">
                                        <h2 class="new-text-sub-fond" style="padding-bottom: 0px;">Ernakulam</h2>
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
                                                        <label class="form-check-label new-text-sub-fond-small" style="margin-bottom: 10px;">Tell me more about this event(Any details you want to let us know)</label>
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
                    <h4 class="p-t-20 mb-4 text-dark">Please register as a guest if you would like to view the information on the website without interruption!</h4>
                    
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

        
        
        
<div class="modal" id="PopupModal" backdrop="static" keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body p-4 px-5">

                <div class="main-content text-center " style="margin-top: 20px;">
                    <div style="margin-bottom: 20px;">
                        <img src="images/machooseLogo.png" alt="" style="width: 110px;">
                    </div>
                    <!--<h2 style="font-size: 22px;margin-bottom: 20px;">Machooos International</h2>-->
                    <h5 class="p-t-20 mb-4 text-dark">Please enter the PIN number to view this album!</h5>
                    
                    <div >
                        
                     
                        
                        <div class="form-group mb-4">
                            <input class="form-control " type="password" id="viewCode" name="viewCode" value="" placeholder="Enter PIN number" >
                        </div>
                        
                      
                        <span id="viewCodeErr" class="d-none text-danger mb-4" style="font-weight: 500;"></span>
                        
                        <div class="d-flex">
                            <div class="mx-auto">
                                <a href="#" onclick="checkCode();">
                                    <div class="sb-button" style="height: 33px; line-height: 32px; margin-bottom: 20px;">Submit</div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        
        
        <!--  Comments replay Modal start  -->
        <div class="modal" id="commentReplayModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <!-- <h3 style="font-size: 2em;"></h3> -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="contact-details-title fl-wrap" style="margin-top: 30px;">
                            <h2>Reply to comment</h2>
                        </div>
                        <div id="replyCommentErrormessage" class="text-danger" style="text-align: left;"></div>
                        <form  class="custom-form" style="margin-top: 15px;">
                            <input type="hidden" value="" id="commentHiddenId">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: left;">
                                        <!-- <label class="form-check-label" for="comments" style="text-align: left; font-size: 14px; font-weight: 600; margin-bottom: 10px;">Your Name *</label> -->
                                        <input type="text" name="commentReplyUser" id="commentReplyUser" placeholder="Your name ? *" value="<?=$logginUserName?>"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" style="text-align: left;">
                                        <!-- <label class="form-check-label" for="comments" style="text-align: left; font-size: 14px; font-weight: 600; margin-bottom: 10px;">Tell me more about this event(Any details you want to let us know)</label> -->
                                        <textarea name="commentsReplay"  id="commentsReply" cols="40" rows="3" placeholder="Your reply:" class="cnt-anim"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" onclick="saveCommentReply();"><span>Reply</span> </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Comments replay Modal start -->
        
        
        
        
        
        
        
        
        <!--  main start  -->
        <div id="main" class="bg-white">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="right: 10px; z-index: 99999; position: absolute; bottom: 10px;">
                <div class="toast-header">
                    <!-- <img src="..." class="rounded me-2" alt="..."> -->
                    <!-- <strong class="me-auto">Bootstrap</strong> -->
                    <small style="width: 100%"></small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-success">
                    Url coppied to clipboard.
                </div>
            </div>
            <input type="hidden" value="<?php echo $contact_user_id; ?>" id="loggedUserId">
            
         
            
            <!-- wrapper -->
            <div id="wrapper">
            		