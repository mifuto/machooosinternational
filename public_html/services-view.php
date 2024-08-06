<?php 
include("admin/config.php");
include("get_session.php");

$albums = [];
$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$encoded_string = $_GET['id'];
$decoded_string = base64_decode($encoded_string);
$array = explode('_', $decoded_string);
$idUrl = $array[1];
$selAlbums = [];

$Servicesalbums = [];

$user_state_vals = $_COOKIE["user_state_val"];



$sql = "SELECT file_path FROM tbeservices_folderfiles WHERE services_id=".(int)$idUrl." AND `hide`=0 ";

    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);

    $tmpData = [];

    if($count > 0) {        
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($albums,$row);
        }
    }
    
$sql1 = "SELECT *, (SELECT COUNT(*) FROM service_views
        WHERE service_id = tbl_services.id) AS viewCounts , (SELECT COUNT(*) FROM service_shares
        WHERE service_id = tbl_services.id) AS shareCounts FROM tbl_services WHERE id=".(int)$idUrl;

$result1 = $DBC->query($sql1);

$count1 = mysqli_num_rows($result1);

if($count1 > 0) {	
    
    while ($row1 = mysqli_fetch_assoc($result1)) {
        array_push($selAlbums,$row1);
       
    }
}  



$where = '';
if($user_state_vals != "")$where = " and state_id ='$user_state_vals' ";


  $sql4 = "SELECT * FROM tbl_services WHERE deleted=0 $where AND id !=".(int)$idUrl;
  

    $result4 = $DBC->query($sql4);

    $count4 = mysqli_num_rows($result4);

    if($count4 > 0) {	
        
        while ($row4 = mysqli_fetch_assoc($result4)) {
            array_push($Servicesalbums,$row4);
            
        }
    }
    
    
 $projId =   (int)$idUrl;
    

$user_data = get_session();
if(isset($user_data['userID']) && $user_data['userID'] > 0) {
  
    $user_type_val = 1;
    $user_id_like = $user_data['contact_user_id'];
 

}else if($_COOKIE['guestLoginId'] != 0){
    
    
    if(!isset($_COOKIE['guestLoginId'])) $guestLoginId ="";
    else { $guestLoginId =$_COOKIE['guestLoginId']; }
  
 
    $user_type_val = 2;
    $user_id_like = $guestLoginId;
}
else {
   
    $user_type_val = '';
    $user_id_like = '';
    
}


$likeCounts = 0;
$like_status = false;
if($user_id_like != ""){
  $LikeSql = "SELECT * FROM services_album_like WHERE project_id='$projId' AND user_id='$user_id_like' AND user_type='$user_type_val' AND active=0 ";
    $Likeresult = $DBC->query($LikeSql);
    $AlbymLikecount = mysqli_num_rows($Likeresult);
    if($AlbymLikecount > 0) {		
        while ($row = mysqli_fetch_assoc($Likeresult)) {
            $like_statusS = $row['status'] ;
            if($like_statusS == 1) $like_status = true;
        }
    }
  
}

$likecountsql = "SELECT COUNT(*) as likeCount FROM services_album_like WHERE project_id = '$projId' AND status=1 AND active=0 ";
$Likecountresult = $DBC->query($likecountsql);
$Likecountresultcount = mysqli_num_rows($Likecountresult);
if($Likecountresultcount > 0){
     while ($row = mysqli_fetch_assoc($Likecountresult)) {
            $likeCounts = $row['likeCount'] ;
        }
}




include("templates/header.php");

?>
<style>
    .descont{
        padding-right:45px;padding-left:45px;
    }
    
    @media (max-width: 767px) {
         .descont{
            padding-right:20px;padding-left:20px;
        }
    }
</style>

<input type="hidden" value="<?php echo $user_type_val; ?>" id="user_type_val">
<input type="hidden" value="<?php echo $user_id_like; ?>" id="user_id_like">
<input type="hidden" value="<?php echo $projId; ?>" id="projId_id_like">





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
                <!-- content-holder -->
                <div class="content-holder ch-fw vis-dec-anim">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="hero-title alighn-title" style="padding-bottom: 20px !important;">
                                    <h4>Services</h4>
                                    <h2 ><?=$selAlbums[0]['main_tittle']?></h2>
                                </div>
                            </div>
                        


                        </div>
                    </div>
                    
                    
                    
                    <!-- single_project_carousel   -->  
                    <div class="single_project_carousel fl-wrap">
                        <!-- fw-carousel-wrap -->
                        <div class="fw-carousel-wrap fsc-holder single_project_carousel fl-wrap">
                            <!-- fw-carousel  -->
                            <div class="fw-carousel  fs-gallery-wrap fl-wrap full-height lightgallery thumb-contr  ">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper" id="ImageList">

                                        <?php if(count($albums) > 0) { 
                                            foreach ($albums as $key => $album) { ?>

                                             <!-- swiper-slide-->  
                                             <div class="swiper-slide hov_zoom"><img  src="admin/<?= $album['file_path']?>"   alt=""><a href="admin/<?= $album['file_path']?>" class="box-media-zoom   popup-image" style="padding: 0px;"><i class="fal fa-search"></i></a></div>
                                            <!-- swiper-slide end-->  

                                            <?php } ?>


                                            <div class="swiper-slide folio-slider-link">
                                                <a class="folio-slider-link_item custom-scroll-link" href="#secdet">
                                                    <div class="grid-icon"></div>
                                                    <span>Project Details</span>                       
                                                </a>
                                            </div>

                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- fw-carousel end -->
                            <!--thumbnail-container-->  
                            <div class="thumbnail-container">
                                <div class="thumbnail-wrap fl-wrap">
                                </div>
                            </div>
                            <!--thumbnail-container end-->                          
                        </div>
                        <!-- single_project_carousel end -->    
                        <div class="fw_cb fw-carousel-button-prev"><i class="fal fa-long-arrow-left"></i></div>
                        <div class="fw_cb fw-carousel-button-next"><i class="fal fa-long-arrow-right"></i></div>
                        <div class="slider-controls fl-wrap">
                            <div class="swiper-counter hs_counter">
                                <div class="sw_title">Showing</div>
                                <div class="current"> </div>
                            </div>
                            <div class="hs_init hid-mob"></div>
                            <div class="tumbnail-button show_thumbnails unvisthum">
                                <div class="list">
                                    <div   class="list-btn">                            
                                        <span>
                                        <i class="b1 c1"></i><i class="b1 c2"></i><i class="b1 c3"></i>
                                        <i class="b2 c1"></i><i class="b2 c2"></i><i class="b2 c3"></i>
                                        <i class="b3 c1"></i><i class="b3 c2"></i><i class="b3 c3"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="thumbnail-tooltip">Thumbnails</span>                       
                            </div>
                        </div>
                    </div>
                    <!-- fw-carousel-wrap end -->
                    
                    
                    
                    
               
                    
                     <!-- content -->
                    <div class="content descont" id="secdet" >
                         <!--<section class="single-content-section" >-->
                         <!--   <div class="container">-->
                                <div class="row" id="secdet">
                                    
                                    <div class="col-md-9 col-sm-12" style="padding-top: 0px;padding-bottom: 20px;" >
                                        
                                        <div class="row" >
                                        
                                            
                                             <div class="col-12" style="text-align: left;">
                                                <h1 class="text-black new-text-sub-fond " ><?=$selAlbums[0]['main_tittle']?></h1>
                                            </div>
                                            
                                             
                                        <?php if($user_id_like == ""){ ?>
                        
                        
                                            <div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="showGuestUserModal()" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;"><?=$likeCounts?></span></h3></a></div>
                                             
                                             
                                        <?php }else{ 
                                            
                                            if($like_status == 1){ ?>
                                                  <div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="likeAlbum(0)"   style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="fa fa-heart fa-1x"></i><span style="margin-left: 5px;"><?=$likeCounts?></span></h3></a></div>
                                            <?php }else{ ?>
                                                  <div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="likeAlbum(1)"   style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="far fa-heart fa-1x "></i><span style="margin-left: 5px;"><?=$likeCounts?></span></h3></a></div>
                                            <?php }
                                            
                                            
                                         
                                        }?>
                                            
                                             <div class="col-12" style="text-align: left;">
                                                <h4 ><?=$selAlbums[0]['small_description']?></h4>
                                            </div>
                                            
                                            <div class="col-12 " style="text-align: left;padding-left: 12px !important;">
                                                <h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Client: <?=$selAlbums[0]['client']?></h4>
                                            </div>
                                            
                                             <div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">
                                                <h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Category: <?=$selAlbums[0]['category']?></h4>
                                            </div>
                                            
                                             <div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">
                                                <h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Camera: <?=$selAlbums[0]['camera']?></h4>
                                            </div>
                                            
                                              <div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">
                                                <h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Location: <?=$selAlbums[0]['event_place']?></h4>
                                            </div>
                                            
                                             <div class="col-6" style="text-align: left;padding-top:5px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: #999;"><?=$selAlbums[0]['viewCounts']?> views <?=$selAlbums[0]['shareCounts']?> share </span> 
                                        </div>
                                            
                                            
                                            <div class="col-6" style="text-align: right;padding-top:0px;"><span class="bold-text new-text-sub-fond-1 mobile-disply-none" style="padding-left: 0px !important;">Share : </span><button  type="button" onclick="addServiceShareCount(<?=$selAlbums[0]['id']?>,`<?=$selAlbums[0]['main_tittle']?>`);" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i> </button>  <button type="button" onclick="addServiceShareCount(<?=$selAlbums[0]['id']?>,`<?=$selAlbums[0]['main_tittle']?>`);"  id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>    </button>   <button type="button" onclick="addServiceShareCount(<?=$selAlbums[0]['id']?>,`<?=$selAlbums[0]['main_tittle']?>`);"  id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>   </button>    <button type="button" onclick="addServiceShareCount(<?=$selAlbums[0]['id']?>,`<?=$selAlbums[0]['main_tittle']?>`);"  id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">    <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>  </button> <button type="button" class="btn position-relative" onclick="copyServiceUrl();addServiceShareCount(<?=$selAlbums[0]['id']?>,`<?=$selAlbums[0]['main_tittle']?>`);" style="padding-right: 0px !important;">  <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i> </button></div> 
                                            
                                            <hr ><div class="col-12" style="text-align: left;padding-left: 15px;padding-right: 15px;"><label ><?=$selAlbums[0]['description']?></label></div>
                                            
                                            
                                
                                            
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-12" style="padding-top: 0px;">
                                    
                                    
                                        <div class="row" style="padding-bottom: 20px;">
                                            <div class="col-12" align="left">
                                                <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: #0d6efd;">Services that i provide</h3>
                                            </div>
                                            <div >
                                                
                                                
                                                 <?php
                                                        foreach ($Servicesalbums as $key => $album) { 
                                                          
                                                            
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
                                                    <a style="position: unset !important;" href="services-view.php?id=<?=$decodeId?>" >
                                                        
                                                        <div class="row " >
                                                    
                                                          
                                                            
                                                                <div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">
                                                                    <div class="gallery-item" style="width: 100% !important;">
                                                                        
                                                                        <div class="grid-item-holder">
                                                                            <div class="image-container justify-content-center align-items-center" style="width: 100%; max-height: 70px; overflow: hidden;">
                                                                            <img style="width: 100%;" src="admin/<?=$album['cover_image_path']?>" alt="">
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">

                                                                    <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                            <h4  style="text-align: left;color:#757373;margin-bottom: 0.3rem !important;font-size: 0.7em !important;"><?=$album['category']?></h4>

    
                                                                    <h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;"><?=$album['event_place']?></h4>
    
                                                                   
                                                                </div>
                                                                
                                                           
                                                        
                                                        </div>
                                                       
                                                    </a>
                                                        
                                                    <?php } ?>
                                                
                                                
                                                
                                                
                                                
                                                
                                            </div>
                                                                  
                                                            
                                        </div>
                                        
                                        
                                    </div>
                                        
                                    
                                    
                                </div>
                                
                                
                                  <div class="row " style="margin-bottom: 30px;">
                                                    
                                        <div class="col-sm-4 " ></div>
                        
                                        <div class="col-sm-4 border rounded" >
                                            <div class="post-item_wrap fl-wrap " style="padding: 0px !important;">
                                               
                                                <div class="post-item_content fl-wrap" style="padding-bottom: 0px !important;padding: 10px !important;">
                                                
                                                </div>
                                                
                                                <div class="post-item_content fl-wrap d-flex justify-content-center" style="padding-top: 0px !important">
                                                <a href="javascript:void(0);" onclick="showEnquiryform();" class="single-btn fl-wrap" style="margin-top: 0px;padding-top: 10px;
                        padding-bottom: 10px;"><span>Talk to us</span></a>
                                                </div>
                        
                                            </div>
                                        </div>
                                        <div class="col-sm-4 " ></div>   
                        
                                    </div>
                       <!--     </div>-->
                                             
                       <!--</section>-->
                    </div>
                    
                    
                  
                            
                  
                    <!--content-nav_holder end -->                              
                    <div class="clearfix"></div>
                    <?php  include("templates/footer-tpl.php"); ?>
                </div>
            </div>
            <!-- wrapper end -->

           

        
<?php 

include("templates/footer-sub.php");

?>

























<script>


    
     document.addEventListener("DOMContentLoaded", function(event) { 

        // Uses sharer.js 
        //  https://ellisonleao.github.io/sharer.js/#twitter  
        var shareUrl = window.location.href;
        var shareTitle = document.title;
        var shareSubject = "Read this good article";
        var shareImage = "yourTwitterUsername";
        var shareDescription = "yourTwitterUsername";
        
        shareUrl = shareUrl.replace('#secdet', '');



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
    
    $('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').addClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');

    
    
    var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
    var mainId = '';

    var currentUrl = getUrlParameter('id');
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    mainId = arr[1];
    addViewCount(mainId);
    
   



$( document ).ready(function() {
  
   
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
 
  function likeAlbum(statusV){
             var user_type_val = $("#user_type_val").val();
            var user_id_like = $("#user_id_like").val();
            var projId_id_like = $("#projId_id_like").val();
            
            
            successFn = function(resp)  {
                console.log(resp.data);
                if(resp.status == 1){
                    if(statusV == 0){
                         $('#likeButton').html('<a class="btn position-relative" href="#" onclick="likeAlbum(1)" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></h3></a>');
                    }else{
                         $('#likeButton').html('<a class="btn position-relative" href="#" onclick="likeAlbum(0)" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="fa fa-heart fa-1x fa-1x"></i><span style="margin-left: 5px;">'+resp.data+'</span></h3></a>');
                    }
                   
                   
                    
                }
               
            }
            errorFn = function(resp){
                console.log(resp);
            }
            data = { "function": 'Services',"method": "likeServices", "user_type_val" : user_type_val , "user_id_like" : user_id_like , 'status':statusV ,'projId_id_like':projId_id_like};
            apiCall(data,successFn,errorFn);
        }
           
 
 
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
 
  function copyServiceUrl(){
        var dummy = document.createElement('input'),
        text = window.location.href;
        
       text = text.replace('#secdet', '');


    
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        $('.toast').toast('show');
        // alert("Url coppied to clipboard. ")
    }
    
    function addViewCount(id){
        
      
        successFn = function(resp)  {
        }
        data = { "function": 'Services',"method": "addViewCount" ,"projId":id};
        apiCall(data,successFn);
    
    
    
    }
    
      function addServiceShareCount(id,name){
       
        successFn = function(resp)  {
        }
        data = { "function": 'Services',"method": "addShare" ,"projId":id,"name":name};
        apiCall(data,successFn);
    
    
    
    }
    


 </script>

