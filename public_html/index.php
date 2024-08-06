<?php 

// include 'get_session.php';

// var_dump(get_session());
// die("asdasdads");
include("templates/header.php");

if($home_vedio_url =="") $home_vedio_url = 'MachooosInternationalOnlineAlbum2023.mp4';

if($home_vedio_dec =="") $home_vedio_dec = 'Machooos International Wedding Company has been established as photography company  in Kerala India.';

// Set the time zone to Indian Standard Time
date_default_timezone_set('Asia/Kolkata');

$currentHour = date("G");

if ($currentHour >= 5 && $currentHour < 12) {
    $greeting = "Good Morning";
} elseif ($currentHour >= 12 && $currentHour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}



?>

       
       
          
                <!-- content-holder -->
                <div class="content-holder fw-ch hide-dec">
                    <!-- hero-wrap -->
                    <div class="hero-wrap">
                        <!--fs-slider-wrap-->
                        <div class="content-holder fw-ch hide-dec">
                    <div class="hero-wrap">
                        <div class="bg-wrap">
                            <div class="video-holder-wrap">
                                <div class="video-container">
                                     <video autoplay playsinline loop muted class="bgvid" id="myVideo">
                                      <source src="<?=$home_vedio_url?>" type="video/mp4">
                                    </video>



                                </div>
                            </div>
                            <div class="overlay"></div>
                        </div>
                        <div class="hero-item">
                            <div class="hero-item_title">
                                
                                <h2 >Machooos<br>International</h2>
                                <h4 ><?=$home_vedio_dec?> </h4>
                                <?php if($state_name != "" && $contact_user_id) { ?> 
                                <h4 ><?=$greeting?> <?=$logedUser?>, You are a coustomer in <?=$state_name?> </h4>
                                <?php }else if($state_name != "" && $logginUserName != ""){ ?>
                                <h4 ><?=$greeting?> <?=$logginUserName?>, You are a guest user in <?=$state_name?> </h4>
                                <?php }?>
                                <div class="clearfix"></div>
                                <a href="about.php" class="hero-link ajax"><span>View Our Portfolio</span> <i class="fal fa-long-arrow-right"></i></a>
                                
                                
                            </div>
                        </div>
                        <!--follow-wrap-->
                        <div class="follow-wrap">
                            <div class="follow-wrap_title">
                                <span>Follow:</span>
                            </div>
                            <ul>
                                <li><a href="https://www.facebook.com/machooos/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://instagram.com/machooosinternational?igshid=NTc4MTIwNjQ2YQ==" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="https://twitter.com/Machooos_wed" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="https://www.google.com/search?cs=0&output=search&q=Machooos+International+Wedding+company&ludocid=9691727453199083548&gsas=1&client=ms-android-oppo&lsig=AB86z5VU75DHYCIVgiaKzliM8DGJ&kgs=2de5142a0f968d11&shndl=-1&source=sh/x/kp/local/2&entrypoint=sh/x/kp/local" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                
                            </ul>
                        </div>
                        <!-- fs-slider-wrap end-->						
                        <div class="fs-slider-controls">
                            
                            <div class="hc-pag-wrap">
                                <div class="hc-pag"></div>
                            </div>
                            <div class="hc_counter"><span class="current_c">1</span><span class="total_c"></span> </div>
                            <div class="play-pause_slider2 hsc_pp2 auto_actslider2"><i class="fal fa-play"></i></div>
                        </div>
                        <a onclick="showEnquiryform()"  class="hero-contact_btn color-bg ajax"><span>Get In Touch</span></a>
                        <div class="header-contacts">
                            <ul>
                                 <li><a href="https://machooosinternational.com/mi_kids/" target="_blank">Machooos Kids</a></li>
                                 <?php if($user_state_val != ""){ ?>
                                    <li><a href="LatestNews.php" target="_blank">Latest News</a></li>
                                <?php } ?>
                                <li><a href="career.php" target="_blank">Career</a></li>
                                <li><a href="mi_online_broucher.pdf" onclick="addDownloadCount();" download>Download</a></li> 
                                <li><a href="privacy-policy.php" target="_blank">Privacy&Policy </a></li>
                                <li><a href="terms-and-conditions.php" target="_blank">Terms&Conditions</a></li>
                                <!-- <li><a href="https://machooosinternational.com/mi_online/" target="_blank">Mi_Online</a></li> -->
                                <li><a href="Cancellation&Refund_Policy.php" target="_blank">Cancellation&Refund Policy</a></li>
                                
                                
                                
                                 
             
                            </ul>
                        </div>
                    </div>
                    <div class="hero-video-btn" id="html5-videos"   data-html="#video1"><span><i class="fas fa-play"></i></span><strong>Story Video</strong></div>
                    <!-- Hidden video div -->
                    <div style="display:none;" id="video1">
                        
                        <video class="lg-video-object lg-html5" controls preload="none">
                            <source src="<?=$home_vedio_url?>" type="video/mp4">
                        </video>
                    </div>
                    <!--hero dec-->
                    <div class="hero-dec_top"></div>
                    <div class="hero-dec_top2"></div>
                    <div class="hero-dec_top"></div>
                    <div class="hero-dec_top2"></div>
                </div>
                <!-- content-holder end -->
            </div>
            <!-- wrapper end -->
            <!-- sidebar-->
            <?php 

                include("templates/footer.php");
            
            ?>

        
    </body>
    <script>
        $('#navLinkMenuHome').addClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
        
       // Get all elements with the class "lg-video-object"
const videoObjects = document.querySelectorAll('.lg-video-object');

// Loop through each element and remove the controls property
videoObjects.forEach((videoObject) => {
  videoObject.removeAttribute('controls');
});

        
        function addDownloadCount(){
            successFn = function(resp)  {
            }
            data = { "function": 'Dashboard',"method": "addDownloadCount"};
            apiCall(data,successFn);
        }
        
        
        
    </script>
</html>