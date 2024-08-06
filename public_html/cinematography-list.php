


<?php 


include("admin/config.php");
include("get_session.php");

$albums = [];
$projId = '';

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$isData = false;

$user_state_vals = $_COOKIE["user_state_val"];


$where = '';
if($user_state_vals != "")$where = " and FIND_IN_SET($user_state_vals, state_id) ";

$sql = "SELECT *, (SELECT COUNT(*) FROM cinematography_views
        WHERE cinematography_id = tbl_cinematography.id) AS viewCounts FROM tbl_cinematography WHERE `deleted` = 0 AND `active` = 1 $where order by id desc";
     

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

if($count > 0) {	
    
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albums,$row);
        if(!$isData)$frstPId = $row['id'];
        $isData = true;
        
    }
}

if($isData){
    $projIdString = base64_decode($_REQUEST['pId']);
    if($projIdString == ""){
        $projId = $frstPId;
    }else{
         $arr = explode('_', $projIdString);
        $projId = $arr[1];
    }
}


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




include("templates/header.php");


?>
<style>
.iframecontainer {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 56.25%; /* 16:9 Aspect Ratio */
}

.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}
</style>
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
        
          .testi-item:after {
            font-family: none !important;
            content: none !important;
          
        }
        
        .tc-pagination {
            display: none !important;
        }
        
        .fw_cb {
            width: 30px !important;
            height: 30px !important;
            line-height: 30px !important;
            
        }
        
        
    </style>
    
    <style type="text/css">
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
    /*padding: 1em;*/
    /*margin: 0 0 1.5em;*/
    width: 100%;
	-webkit-transition:1s ease all;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    /*box-shadow: 2px 2px 4px 0 #ccc;*/
}

.masonry { /* Masonry container */
    -webkit-column-count: 8;
  -moz-column-count:8;
  column-count: 8;
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
.nav-tabs .nav-link {
    font-size: 14px;
    color: #000000;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
    background: #000000;
    color: #ffffff;
    font-size: 16px;
}
</style>

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


</style>

<script>
       function fristLoad(id){
         

            window.onload = function() {
                
                var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
                
                if(sPageURL != ""){
                    getIdCallFn();
                }else{
                    handleIframeClick(id);
                    
                }
                
                
            };
        }
        
      
        
        
         
        
</script>


<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<input type="hidden" id="projIdVal" value="<?=$projId?>" >

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
    
    
    <div class="content-holder vis-dec-anim">
        <!-- content -->
        <div class="content" >
            <div class="post_header fl-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-title alighn-title" style="padding: 0px;">
                                <!--<h4>Our Cinematography</h4>-->
                                <h2>The Secret Cinematography</h2>
                            </div>
                        </div>
                    </div>
                    
                    
                    
            <div class="clearfix"></div>
           
            
            <div class="row">
                
                <?php if(count($albums) > 0) { ?>
                
                    <div class="col-md-9 col-sm-12" style="padding-top: 0px;padding-bottom: 20px;" >
                        
                        <div class="row" id="vedioDis">
                                    
                        </div>
                        
                        
                        
                    </div>
                    
                    <div class="col-md-3 col-sm-12" style="padding-top: 0px;">
                        
                        
                        <div class="row" style="padding-bottom: 20px;">
                            <div class="col-11" align="left">
                                <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: #0d6efd;">Recent Cinematography</h3>
                            </div>
                            
                             <div class="col-1" align="left" id="reportrange">
                                 <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: black"><i class="glyphicon glyphicon-calendar fas fa-sliders-h"></i></h3>
                                 
                                
                            </div>
                           
                            </div>
                            
                            
                            <div id="listAllCinematography"></div>
                                                    
                                                 
                                            
                                                   
                                            
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                
                <? } else { ?>
                                    
                     <div class="col-md-12 "  style="padding: 40px;text-align: center;" id="errExpiry">
                                                    
                        <span class="bold-text text-danger new-text-sub-fond-1"><b style="letter-spacing: .05rem;">No cinematography available!</b></span> 
                       
                    </div>
                
                <?php } ?>
            
            </div>
            
            <div class="row " style="margin-bottom: 30px;">
                <hr>
                                    
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
                    
                 
        </div>
        <!-- content end -->
        <div class="clearfix"></div>
         
        <?php  include("templates/footer-tpl.php"); ?>
    </div>
    <!-- content-holder end -->






<?php 

include("templates/footer.php");

?>

<script>

$('#navLinkMenuHome').removeClass('act-link');
$('#navLinkMenuAbout').removeClass('act-link');
$('#navLinkMenuPortfolio').addClass('act-link');
$('#navLinkMenuDA').removeClass('act-link');
$('#navLinkMenuContact').removeClass('act-link');

var fristfetchRec = true;


    var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];

    $( document ).ready(function() {
        
             var loadId = $('#projIdVal').val();
             handleIframeClick(loadId);
             getAllCinematographyRecs("","");
             
              $('#dispayImg img').css({
                        'width': '60%',   // Set your desired width
                        'height': 'auto'   // Set your desired height
                    });


     });
     
     function getAllCinematographyRecs(selStart,selStop){
         
         
         successFn = function(resp)  {
            if(resp.status == 1){
                var eventLists = resp.data['res'];
                var len = eventLists.length;
                var htmlC = "";
                var callFn = true;
                for(var i=0;i<len;i++){
                  
                    var date = new Date(eventLists[i]['created_date']);
                    
                      // Get year, month, and day part from the date
                    var year = date.toLocaleString("default", { year: "numeric" });
                    var month = date.toLocaleString("default", { month: "numeric" });
                    var day = date.toLocaleString("default", { day: "2-digit" });
    
                    var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                 
        			var id = eventLists[i]['id'];
        		
        			var decodeId = Base64.encode(Date.now()+"_"+id);
        			
        			
        			
        			var originalWord = eventLists[i]['main_tittle'];
                    var maxLength = 30;
                    
                    var trimmedWord;

                    if (originalWord.length > maxLength) {
                        trimmedWord = originalWord.substring(0, maxLength) + '...';
                    } else {
                        trimmedWord = originalWord;
                    }
                    
                    
                    // if(callFn) { 
                    //   fristLoad(id);
                    //     callFn = false;
                    // }
                    
                    var trimmedString = eventLists[i]['video'].substring(0, 19);
                    
                    if(trimmedString == 'cinematographyImage') var video_upload = 'admin/'+eventLists[i]['video'];
                    else  var video_upload = eventLists[i]['video'];
                    
                    
                   htmlC += '';
                   
                    htmlC += '<a style="position: unset !important;" onclick="handleIframeClick('+id+')" >';
                    htmlC += '<div class="row " >';
                    
                    htmlC += '<div class="col-md-6 col-sm-6 d-flex align-items-center" style="padding-bottom: 0px;">';
                    htmlC += '<div class="gallery-item" style="position: relative; width: 100% !important;">';
                    htmlC += '<div class="grid-item-holder">';
                    htmlC += '<div class="image-container" style="padding-bottom: 56.25%; position: relative; overflow: hidden;">';
                    
                    if(getYouTubeVideoId(video_upload) == null){
                         htmlC += '<div class="image-container justify-content-center align-items-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">';
                    htmlC += '<img style="width: 100%;" src="images/no-cov.jpg" alt="">';
                    htmlC += '</div>';
                    }else{
                         htmlC += '<div class="image-container justify-content-center align-items-center" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">';
                    htmlC += '<img style="width: 100%;" src="https://img.youtube.com/vi/'+getYouTubeVideoId(video_upload)+'/maxresdefault.jpg" alt="">';
                    htmlC += '</div>';
                        
                    }
                    
                    
                   
                    
                    htmlC += '<div class="grid-item-holder_title " style="bottom: 35% !important;">';
                     htmlC += '<img src="images/play button.svg" alt="" style="background: transparent;width: 30%;height: 30%;">';
                       htmlC += ' </div>';
                    
                    
                    // htmlC += '<video controls poster="https://img.youtube.com/vi/'+getYouTubeVideoId(video_upload)+'/maxresdefault.jpg" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">';
                    // htmlC += '<source src="'+video_upload+'" type="video/mp4">';
                    // htmlC += '</video>';

                   
                    
                    
                    // htmlC += '<iframe src="'+video_upload+'"  frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>';
                                    
                    htmlC += '<div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" onclick="handleIframeClick('+id+')" ></div>';

                    htmlC += '</div>';
                    htmlC += '</div>';
                             
                    htmlC += '</div>';
                    htmlC += '</div>';
                
                    
                    htmlC += '<div class="col-md-6 col-sm-6 " style="padding-top:5px;" style="text-align: left !important;">';
                        
                    htmlC += '<h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;">'+trimmedWord+'</h4>';
                    htmlC += '<h4  style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;">'+eventLists[i]['category']+'</h4>';

                    htmlC += '<h4 class="text-black " style="color:#ccc !important;text-align: left !important;margin-bottom: 0.3rem !important;">'+formattedDate+'</h4>';
                        

                       
                    htmlC += '</div>';
                    
                    htmlC += '</div>';
                    htmlC += '</a>';
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                }
                
                
                
                $('#listAllCinematography').html(htmlC);
                fristfetchRec = false;
                
            }
         }
        data = { "function": 'Cinematography',"method": "getAllCinematographyRecs" ,'selStart':selStart,'selStop':selStop,'user_state_val':'<?=$user_state_val?>' };
        
        apiCall(data,successFn);
     }
     
     function getYouTubeVideoId(embedUrl) {
      // Extract the video ID from the embed URL
      const matches = embedUrl.match(/embed\/([a-zA-Z0-9_-]+)/);
      if (matches && matches.length > 1) {
        return matches[1];
      }
      return null;
    }
    
    
     function handleIframeClick(id) {
         
                  var user_id_like = $('#user_id_like').val();
                    var user_type_val = $("#user_type_val").val();
                    $("#projId_id_like").val(id);

         
            successFn = function(resp)  {
                if(resp.status == 1){

                     var eventList = resp.data['res'][0];
                    
                    var trimmedString = eventList['video'].substring(0, 19);
                    
                    if(trimmedString == 'cinematographyImage') var video_upload = 'admin/'+eventList['video'];
                    else  var video_upload = eventList['video'];
                 
                    
                    var date = new Date(eventList['created_date']);
                    
                      // Get year, month, and day part from the date
                    var year = date.toLocaleString("default", { year: "numeric" });
                    var month = date.toLocaleString("default", { month: "numeric" });
                    var day = date.toLocaleString("default", { day: "2-digit" });
    
                    var dt = day+ ' '+ monthNames[month-1] + ' '+ year;
                    

                    var vedHtml = '<div class="col-md-12 col-sm-12"><div class="iframe-container"><iframe src="'+video_upload+'" frameborder="0" allowfullscreen></iframe></div></div>';
                    
                    vedHtml +='<div class="col-md-12 col-sm-12" style="padding-top:20px;padding-left:20px;padding-right:20px;"><div class="row"><div class="col-12" style="text-align: left;"><h1 class="text-black new-text-sub-fond ">'+eventList['main_tittle']+'</h1></div>';
                    
                    if(user_id_like == ""){
                        
                        
                         vedHtml +='<div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="showGuestUserModal()" style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="far fa-heart fa-1x"></i><span style="margin-left: 5px;">'+eventList['likeCount']+' </span></h3></a></div>';
                         
                         
                    }else{
                        
                        if(eventList['like_status'] == 1){
                               vedHtml +='<div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="likeAlbum(0)"   style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="fa fa-heart fa-1x"></i><span style="margin-left: 5px;">'+eventList['likeCount']+'</span></h3></a></div>';
                        }else{
                               vedHtml +='<div class="col-12" style="text-align: right;padding-top:0px;" id="likeButton"><a class="btn position-relative" href="#" onclick="likeAlbum(1)"   style="border-color: transparent;white-space: nowrap;"><h3 class="" style="line-height: 1.5 !important;">LIKE <i class="far fa-heart fa-1x "></i><span style="margin-left: 5px;">'+eventList['likeCount']+'</span></h3></a></div>';
                        }
                        
                        
                     
                    }
                    
                        vedHtml +='<div class="col-12" style="text-align: left;"><h4>'+eventList['small_description']+' </h4></div>';
                    vedHtml +='<div class="col-12" style="text-align: left;"><h4 style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;">Published on '+dt+'</h4></div>';
                    
                    
                        vedHtml +='<div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">';
                                vedHtml +='<h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Category: '+eventList['category']+'</h4>';
                            vedHtml +='</div>';
                            vedHtml +='<div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">';
                                vedHtml +='<h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Location: '+eventList['event_place']+'</h4>';
                            vedHtml +='</div>';
                            vedHtml +='<div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">';
                                vedHtml +='<h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Camera: '+eventList['camera']+'</h4>';
                            vedHtml +='</div>';
                            vedHtml +='<div class="col-sm-12 col-md-12 " style="text-align: left;padding-left: 12px !important;">';
                                vedHtml +='<h4 style="color:#2e2e2e;text-align: left;margin-bottom: 0.3rem !important;font-size: 1em !important;">Client: '+eventList['client']+'</h4>';
                           vedHtml +=' </div>';
                   
                   
                                        
                    vedHtml +='<div class="col-6" style="text-align: left;padding-top:10px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: #999;">'+eventList['viewCounts']+' views '+eventList['shareCounts']+' share</span> </div>';
                                        
                    vedHtml +='<div class="col-6" style="text-align: right;padding-top:0px;"><span class="bold-text new-text-sub-fond-1 mobile-disply-none" style="padding-left: 0px !important;">Share : </span><button onclick="addCShareCount('+id+',`'+eventList['main_tittle']+'`)" type="button" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i> </button>  <button type="button" onclick="addCShareCount('+id+',`'+eventList['main_tittle']+'`)" id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>    </button>   <button type="button" onclick="addCShareCount('+id+',`'+eventList['main_tittle']+'`)" id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>   </button>    <button type="button" onclick="addCShareCount('+id+',`'+eventList['main_tittle']+'`)" id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">    <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>  </button> <button type="button" class="btn position-relative" onclick="copyFilmUrl('+id+');addCShareCount('+id+',`'+eventList['main_tittle']+'`)" style="padding-right: 0px !important;">  <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i> </button></div> </div>  </div>';
                    
                    
                         var originalString = eventList['description'];
                    var searchString = "tinymceuploads";
                    var replacementString = "admin/tinymceuploads";
                    var newString = originalString.replace(new RegExp(searchString, "g"), replacementString);
                    
                  vedHtml +='<hr ><div class="row" id="dispayImg"><div class="col-12" style="text-align: left;padding-left: 15px;padding-right: 15px;"><label>'+newString+' </label></div></div>';
                  
                  $('#vedioDis').html(vedHtml);
                  
                   $('#dispayImg img').css({
                        'width': '60%',   // Set your desired width
                        'height': 'auto'   // Set your desired height
                    });


              
                  updateShareUrl(id);

                   
                     var element = document.getElementById('vedioDis');
                      if (element) {
                        element.scrollIntoView({
                          behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
                          block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
                          inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
                        });
                      }
    
                }
               
                
              
            }
            data = { "function": 'Cinematography',"method": "getCinematographyRec" ,"id":id ,"user_type_val" : user_type_val , "user_id_like" : user_id_like ,'projId_id_like':id};
            
            apiCall(data,successFn);
        }
        
         function addCShareCount(id,name){
         
            successFn = function(resp)  {
            }
            data = { "function": 'Cinematography',"method": "addShare" ,"projId":id,"name":name};
            apiCall(data,successFn);
        
        
        
        }
        
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
            data = { "function": 'Cinematography',"method": "likeCinematography", "user_type_val" : user_type_val , "user_id_like" : user_id_like , 'status':statusV ,'projId_id_like':projId_id_like};
            apiCall(data,successFn,errorFn);
        }
                
        
        
        
        
        
        
        function copyFilmUrl(id){
            var dummy = document.createElement('input'),
            text = window.location.href;
            
            var currentdate = Base64.encode(Date.now()+"_"+id );  
          
            var parts = text.split('?');
            
            console.log(parts[0])
            
            text = parts[0]+"?pId="+currentdate;
        
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand('copy');
            document.body.removeChild(dummy);
            $('.toast').toast('show');
            // alert("Url coppied to clipboard. ")
        }
        
        
         function updateShareUrl(id) {
             
            var shareUrl = window.location.href;
            
            var currentdate1 = Base64.encode(Date.now()+"_"+id );  
            var parts = shareUrl.split('?');
            
            shareUrl = parts[0]+"?pId="+currentdate1;
            
        
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
        
        function getIdCallFn(){
              
                var currentUrl = getUrlParameter('pId');
                var IdString = Base64.decode(currentUrl);
                var arr = IdString.split('_');
                mainId = arr[1];
                
                handleIframeClick(parseInt(mainId));
           
        }
        
        
          
              
           
   
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
       var selStart = start.format('YYYY-MM-DD');
       var selStop = end.format('YYYY-MM-DD');
       
       if(fristfetchRec) return false;
        getAllCinematographyRecs(selStart,selStop);

    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});
</script>

