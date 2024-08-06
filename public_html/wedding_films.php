<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$albums = [];
$SAalbums = [];
$OLalbums = [];
$Storiesalbums = [];
$Blogsalbums = [];
$projId = '';

$isData = false;


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $user_id = $user_data['contact_user_id'];
    $main_user_id = $user_data['main_user_id'];
    
    
    $logginUserName = $user_data['firstname']." ".$user_data['lastname'];
    $userIdVal = $user_data['contact_user_id'];
    $userphonenumber = $user_data['phonenumber'];
    $useremail = $user_data['email'];
     setcookie('guestLoginId', 0, time() + (86400 * 30), "/");
     $isDisComment = true;
     
     $isCmtCnfrmMes = false;
     $user_type_val = 1;
     $user_id_like = $user_data['contact_user_id'];
    
    
    
    
    
	$sql = "SELECT * FROM `wedding_films` WHERE (`user_id`='$user_id' or `user_id`='$main_user_id') AND `active`=0 ORDER BY id DESC";

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
        $projId = $frstPId;
    }
    
    
    $sql1 = "SELECT * FROM `tbesignaturealbum_projects` WHERE (`user_id`='$user_id' or `user_id`='$main_user_id') AND `deleted`=0 ORDER BY id DESC ";

    $result1 = $DBC->query($sql1);

    $count1 = mysqli_num_rows($result1);

    if($count1 > 0) {	
        
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push($SAalbums,$row1);
            
        }
    }
    
      $sql2 = "SELECT *, E.id album_id , (SELECT COUNT(*) FROM tbevents_views
    WHERE project_id = E.id) AS viewCounts 
        FROM tbevents_data E
        JOIN tbeevent_files F ON(F.event_id = E.id)
        WHERE (E.user_id = '$user_id' or E.user_id = '$main_user_id') and E.deleted = 0 ORDER BY E.id DESC ";

    $result2 = $DBC->query($sql2);

    $count2 = mysqli_num_rows($result2);

    if($count2 > 0) {	
        
        while ($row2 = mysqli_fetch_assoc($result2)) {
            array_push($OLalbums,$row2);
            
        }
    }
    
      $sql3 = "SELECT * FROM `stories` WHERE `deleted`=0 AND `active`=1 ORDER BY id DESC LIMIT 5";

    $result3 = $DBC->query($sql3);

    $count3 = mysqli_num_rows($result3);

    if($count3 > 0) {	
        
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($Storiesalbums,$row3);
            
        }
    }
    
    $sql4 = "SELECT a.*,b.firstname, b.lastname FROM blogs a left join tblstaff b on a.author=b.staffid WHERE a.deleted=0 AND a.active=1 ORDER BY a.id DESC LIMIT 5";

    $result4 = $DBC->query($sql4);

    $count4 = mysqli_num_rows($result4);

    if($count4 > 0) {	
        
        while ($row4 = mysqli_fetch_assoc($result4)) {
            array_push($Blogsalbums,$row4);
            
        }
    }
    
    
    
    
    
} else {
    header("location: index.php");
}

include("templates/header.php");

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
    
        function fristLoad(id){
//             window.onload = function() {
//               // Get all <video> elements on the page
// const videoElements = document.querySelectorAll('video');

// // Loop through each <video> element and add the attributes
// videoElements.forEach((video) => {
//   video.controlsList.add('nodownload');
//   video.disablePictureInPicture = true;
// });
//             };
        }
        
        function handleIframeClick(id) {
            
            
            var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
            successFn = function(resp)  {
                if(resp.status == 1){

                    var eventList = resp.data;
                    var vdType = eventList['video_type'];
                    
                    if(vdType == 'url') var video_upload = eventList['video_upload'];
                    else var video_upload = 'admin/'+eventList['video_upload'];
                    
                    var date = new Date(eventList['created_date']);
                    
                      // Get year, month, and day part from the date
                    var year = date.toLocaleString("default", { year: "numeric" });
                    var month = date.toLocaleString("default", { month: "numeric" });
                    var day = date.toLocaleString("default", { day: "2-digit" });
    
                    var dt = day+ ' '+ monthNames[month-1] + ' '+ year;
                    

                    var vedHtml = '<div class="col-md-12 col-sm-12"><div class="iframe-container"><iframe id="videoFrame" src="'+video_upload+'" frameborder="0" allowfullscreen sandbox="allow-same-origin allow-scripts"></iframe></div></div>';
                    
                    vedHtml +='<div class="col-md-12 col-sm-12" style="padding-top:20px;padding-left:20px;padding-right:20px;"><div class="row"><div class="col-12" style="text-align: left;"><h1 class="text-black new-text-sub-fond ">'+eventList['tittle']+'</h1></div>';
                    vedHtml +='<div class="col-12" style="text-align: left;"><h4>'+eventList['sub_tittle']+' </h4></div>';
                    vedHtml +='<div class="col-12" style="text-align: left;"><h4 style="color:#757373;text-align: left;margin-bottom: 0.3rem !important;font-size: 0.7em !important;">Published on '+dt+'</h4></div>';
                                        
                    vedHtml +='<div class="col-6" style="text-align: left;padding-top:10px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: #999;">'+eventList['likeCounts']+' likes '+eventList['viewsCounts']+' views '+eventList['shareCounts']+' share</span> </div>';
                                        
                    vedHtml +='<div class="col-6" style="text-align: right;padding-top:0px;"><span class="bold-text new-text-sub-fond-1 mobile-disply-none" style="padding-left: 0px !important;">Share : </span><button onclick="addSAShareCount('+id+')" type="button" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i> </button>  <button type="button" onclick="addSAShareCount('+id+')" id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>    </button>   <button type="button" onclick="addSAShareCount('+id+')" id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;"> <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>   </button>    <button type="button" onclick="addSAShareCount('+id+')" id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true" style="padding-right: 0px !important;">    <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>  </button> <button type="button" class="btn position-relative" onclick="copyFilmUrl('+id+');addSAShareCount('+id+')" style="padding-right: 0px !important;">  <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i> </button></div> </div>  </div>';
                    
                      var vedCHtml ='<div class="col-1" style="text-align: center;padding-top:0px;" id="hideshowCmt" ><i onclick="hideCmt();" class="fas fa-chevron-down fa-1x" style="color: #ccc;"></i> </div>';
                    
                     vedCHtml +='<div class="col-4" style="text-align: left;padding-top:5px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: black;">'+eventList['commentCounts']+' comments</span> </div>';
                    
                    vedCHtml +='<div class="col-7" style="text-align: right;padding-top:5px;"><span class="bold-text new-text-sub-fond-1 " style="padding-left: 0px !important;letter-spacing: 1px !important;color: black;"><a class=" new-text-sub-fond-link" href="javascript:void(0)" onclick="waitingforFilmAprovalModal();" style="color:red;" ><i class="bi bi-exclamation-triangle-fill" style="margin-right: 5px;"></i>Comments for approval</a></span> </div>';
                    
                   
                    
                    
                   $('#vedioDis').html(vedHtml);
                   $('#vedioCommentDis').html(vedCHtml);
                   
                   
                   $('#projId_id_like').val(id);
                    $('#numberOfDisedCmt').val(5);
                    $('#totalCmt').val(eventList['commentCounts']);
            
                   
                   
                   updateShareUrl(id);
                   getFilmProjectComments();
                  
                   
                     var element = document.getElementById('vedioDis');
                      if (element) {
                        element.scrollIntoView({
                          behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
                          block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
                          inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
                        });
                      }
                      
                      
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
                      video.controlsList = 'nodownload';
                      video.disablePictureInPicture = true;
                    });
                  };
                  
                  
                  // Get the <div> element containing the iframe
const iframeContainer = document.querySelector('.iframe-container');

// Add a contextmenu event listener to the <div> element
iframeContainer.addEventListener('contextmenu', (e) => {
  // Prevent the default context menu from appearing
  e.preventDefault();
});
                      
                      
    
                }
               
                
              
            }
            data = { "function": 'WeddingFilms',"method": "getEditWeddingFilm" ,"sel_id":id };
            
            apiCall(data,successFn);
        }
        
        function hideCmt(){
            $('#comentsDiv').addClass('hide');
            $('#hideshowCmt').html('<i onclick="removehideCmt();" class="fas fa-chevron-right fa-1x" style="color: #ccc;"></i> ');
        }
        
        function removehideCmt(){
            $('#comentsDiv').removeClass('hide');
            $('#hideshowCmt').html('<i onclick="hideCmt();" class="fas fa-chevron-down fa-1x" style="color: #ccc;"></i> ');
        }
        
        
        function copyFilmUrl(id){
            text = window.location.href;
            var dummy = document.createElement('input'),
            text = window.location.href;
            
            var currentdate = Base64.encode(Date.now()+"_"+id );  
            var reUrl = "wedding_film_view.php?pId="+currentdate;
            
            text = text.replace("wedding_films.php", reUrl);
         
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
            var reUrl = "wedding_film_view.php?pId="+currentdate1;

            shareUrl = shareUrl.replace("wedding_films.php", reUrl);
           
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

        function addSAShareCount(id){
         
            successFn = function(resp)  {
            }
            data = { "function": 'WeddingFilms',"method": "addShare" ,"projId":id};
            apiCall(data,successFn);
        
        
        
        }
        
       
        
    </script>
    
    <input type="hidden" id="projIdVal" value="<?=$projId?>" >
    
                <input type="hidden" value="1" id="user_type_val">
                <input type="hidden" value="<?php echo $user_id; ?>" id="user_id_like">
                <input type="hidden" value="" id="projId_id_like">
                
                <input type="hidden" value="<?php echo $logginUserName; ?>" id="logginUserName">
                <input type="hidden" value="<?php echo $userphonenumber; ?>" id="userphonenumber">
                <input type="hidden" value="<?php echo $useremail; ?>" id="useremail">
                
                <input type="hidden" value="<?php echo $user_id; ?>" id="prjtUserId">
                
                <input type="hidden" value="<?php echo $isCmtCnfrmMes; ?>" id="isCmtCnfrmMes">
                
                <input type="hidden" value="" id="setPrjIdForCmt">
                <input type="hidden" value="3" id="numberOfDisedCmt">
                <input type="hidden" value="" id="totalCmt">
    
     
    
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
                                <!--<div class="row">-->
                                <!--    <div class="col-md-12">-->
                                <!--        <div class="hero-title alighn-title" style="padding: 0px;">-->
                                <!--            <h4>The Studio</h4>-->
                                <!--            <h2>Wedding Films</h2>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                
                                
                        <div class="clearfix"></div>
                       
                        
                        <div class="row">
                        
                        
                        
                            <div class="col-md-9 col-sm-12" style="padding-top: 0px;padding-bottom: 30px;" >
                                
                                
                                <?php if(count($albums) > 0) { ?>
                                
                                
                                    <div class="row" id="vedioDis">
                                        
                                    </div>
                                    
                                    <hr>
                                    <div class="row" id="vedioCommentDis">
                                        
                                    </div>
                                    
                                    <div class="row" id="comentsDiv">
                                                                            
                                                                         
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
                                                    
                                                    
                                            <div class="row" id="approvedCommentListUl">
                                            </div>
                                        
                                        
                                            <div class="pagination hide" style="width: 100%;padding-top:0px;text-align: center;display: flex; justify-content: center; align-items: center;margin: 0px;" id="loadMoreBtn">
                                                <!--<button onclick="loadMoreFilmComments()" style="width: 40%;height: 30px;color: #fff; background: #111;" >Load more comments... <i class="bi bi-download"></i></button>-->
                                                
                                                <button onclick="loadMoreFilmComments()" id="loadMore" >Load more comments</button>
                                              
                                            </div>
                                            
                                        </div>
                                  
                                    </div>
                                    
                                
                                <?php } ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <hr>
                                
                                <div class="row">
                                    <div class="col-12" align="left">
                                        <h3 class="img-heading" style="padding-top:5px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;">Your wedding films</h3>
                                    </div>
                                    
                                    
                                    <?php if(count($albums) > 0) { ?>
                                        <div class="row equal-height-cols d-flex align-items-center" style="padding-right:0px;padding-top:0px;padding-bottom:30px ;">
                                    
                                            <?php
                                            $callFn = true;
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
                                                    
                                                    $tittle = $album['tittle'];
                                                    $sub_tittle = $album['sub_tittle'];
                                                    
                                                    // if($callFn) { 
                                                    //     echo '<script>';
                                                    //     echo 'fristLoad(' . $id . ');';
                                                    //     echo '</script>';
                                                    //     $callFn = false;
                                                    // }
                                                    
                                                    $originalWord = $tittle;
                                                    $maxLength = 30;
                                                    
                                                    if (strlen($originalWord) > $maxLength) {
                                                        $trimmedWord = substr($originalWord, 0, $maxLength) . '...';
                                                    } else {
                                                        $trimmedWord = $originalWord;
                                                    }
                                                    
                                                    
                                                    
    
                                                
                                            ?>
                                            
                                                <!--<div class="col-md-4 col-sm-12">-->
                                                <!--    <div style="position: relative;">-->
                                                      
                                                <!--          <div class="image-container justify-content-center align-items-center"  style="width: 100%; height: 160px; overflow: hidden;">-->
                                                <!--                <img style="width: 100%;" src="admin/<?=$album['cover_image']?>" alt="">-->
                                                <!--            </div>-->
                                                <!--            <div class="grid-item-holder_title " style="bottom: 20% !important;">-->
                                                                           
                                                <!--                            <img src="images/machooos-img-dis-logo.png" alt="" style="background: transparent;width: 10%;height: 10%;">-->
                                                <!--                        </div>-->
                                                          
                                                        
                                                <!--        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: transparent;" onclick="handleIframeClick(<?=$id?>)"></div>-->
                                                <!--    </div>-->
                                                    
                                                <!--    <div class="col-md-12 col-sm-12 " style="padding-top:5px;" style="text-align: left !important;">-->
                                                                    
                                                <!--       <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>-->
                                                           
                                                     
                                                <!--    </div>-->
                                                    
                                                    
                                                  
                                                <!--</div>-->
                                                
                                                
                                                
                                                        <div class="col-md-4 col-sm-12">
                                                            
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    
                                                                    <div class="gallery-item  " style="width: 100% !important;">
                                                                        <div class="grid-item-holder ">
                                                                                   
                                                                                <a style="position: unset !important;" onclick="handleIframeClick(<?=$id?>)" >
                                                                          
                                                                            
                                                                            <?php if( $album['cover_image'] == ""){ ?>
                                                                            
                                                                            <div class="image-container justify-content-center align-items-center" style="width: 100%; height: 140px; overflow: hidden;">
                                                                                
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
                                                                                    
                                                                                    
                                                                                    
                                                                                    
                                                                                </div>
                                                                                
                                                                            <?php }else{ ?>
                                                                            
                                                                            <div class="image-container justify-content-center align-items-center" style="width: 100%; height: 140px; overflow: hidden;">
                                                                                    <img style="width: 100%;" src="admin/<?=$album['cover_image']?>" alt="">
                                                                                </div>
                                                                                
                                                                            <?php } ?>
                                                                               
                                                                            
                                                                            
                                                                            
                                                                                <div class="grid-item-holder_title " style="bottom: 35% !important;">
                                                                                   
                                                                                    <img src="images/play button.svg" alt="" style="background: transparent;width: 30%;height: 30%;">
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                     </div>
                                                                    
                                                                </div>
                                                                <div class="col-12" style="padding-top:10px;">
                                                                    <h4 class="text-black d-flex align-items-start" style="font-size: .8rem !important; font-weight: 400 !important; text-align: left !important;align-self: flex-start;margin-bottom: 0.3rem !important;"><?=$trimmedWord?></h4>
                                                                   
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                       
                                                    </div>
                                            
                                               
                                                
                                            <?php } ?>
                                        </div>
                                    
                                    
                                    
                                    <? } else { ?>
                                    
                                         <div class="col-md-12 " id="signatureAlbumEmptyDataForUser" style="padding: 20px;text-align: center;" id="errExpiry">
                                                                        
                                            <span class="bold-text text-danger new-text-sub-fond-1"><b style="letter-spacing: .05rem;">No wedding films available!</b></span> 
                                           
                                        </div>
                                    
                                    <?php } ?>
                                    
                                   
                                    
                                 
                                </div>
                                
                                <hr>
                                
                                
                                <?php if(count($SAalbums) > 0) { ?>
                                    <div class="row">
                                        <div class="col-12" align="left">
                                            <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;">Your Signature albums</h3>
                                        </div>
                                        
                                        
                                        
                                         <div class="testilider fl-wrap">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    
                                                    
                                                    
                                                     <?php
                                                        foreach ($SAalbums as $key => $album) { 
                                                            $currentDate = date('Y-m-d');
                                                            $planExpDate = $album['expiry_date'];
                                                            
                                                            $planExpDate1 = new DateTime($planExpDate);
            
                                                            // Get year, month, and day part from the date
                                                            $year = $planExpDate1->format('Y');
                                                            $month = $planExpDate1->format('n');
                                                            $day = $planExpDate1->format('d');
                                                            
                                                            // Assuming $monthNames is an array with month names
                                                            $monthNames = array(
                                                                "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                            );
                                                            
                                                            $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                            
                                                            $timestamp = time(); // Get the current timestamp
                                                            $vl = 1;
                                                			$state = base64_encode($timestamp . "_".$vl);
                                                			
                                                			$id = $album['id'];
                                                			
                                                			$decodeId = base64_encode($timestamp . "_".$id);
                                                       
                                                    ?>
                                                    
                                                    
                                                     <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="">
                                                            
                                                            <div class="gallery-item  " style="width: 100% !important;">
                                                                <div class="grid-item-holder ">
                                                                    <?php if($planExpDate > $currentDate){ ?>
                                                                                   
                                                                        <a style="position: unset !important;" href="signature_album_sa.php?pId=<?=$decodeId?>" >
                                                                    <?php }else{ ?>
                                                                       
                                                                        <a style="position: unset !important;" href="subscription_plans.php?id=<?=$decodeId?>&state=<?=$state?>" >
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                       <div class="image-container justify-content-center align-items-center" style="width: 100%; height: 160px; overflow: hidden;">
                                                                           
                                                                           <?php if($album['upload_server'] == 1 ){ ?>
                                                                            <img style="width: 100%;" src="<?=$album['cover_img_path']?>" alt="">
                                                                        <?php }else{ ?>
                                                                            <img style="width: 100%;" src="admin/<?=$album['cover_img_path']?>" alt="">
                                                                        <?php } ?>
                                                                           
                                                                           
                                                                           
    
</div>
                                                                    
                                                                    
                                                                    
                                                                        <div class="grid-item-holder_title " style="bottom: 20% !important;">
                                                                            <!--<h1 class="text-white new-text-sub-fond" style="font-size: 1.2rem !important;font-weight: 600 !important;"><?=$album['project_name']?></h1>-->
                                                                            <img src="images/machooos-img-dis-logo.png" alt="" style="background: transparent;width: 10%;height: 10%;">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                             </div>
                                                           
                                                           
                                                           
                                                           
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                  
                                                    
                                                    
                                                        
                                                    <?php } ?>
                                                    
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="tc-pagination fl-wrap"></div>
                                            <div class="fw_cb ts-button-prev"><i class="fal fa-long-arrow-left"></i></div>
                                            <div class="fw_cb ts-button-next"><i class="fal fa-long-arrow-right"></i></div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                <? } ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                  <?php if(count($OLalbums) > 0) { ?>
                                  <hr>
                                    <div class="row">
                                        <div class="col-12" align="left">
                                            <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;">Your Online albums</h3>
                                        </div>
                                        
                                        
                                        
                                        
                                         <div class="your-new-swiper-container fl-wrap">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    
                                                    
                                                    
                                                      <?php
                                                        foreach ($OLalbums as $key => $album) { 
                                                            $currentDate = date('Y-m-d');
                                                            $planExpDate = $album['expiry_date'];
                                                            
                                                            $planExpDate1 = new DateTime($planExpDate);
            
                                                            // Get year, month, and day part from the date
                                                            $year = $planExpDate1->format('Y');
                                                            $month = $planExpDate1->format('n');
                                                            $day = $planExpDate1->format('d');
                                                            
                                                            // Assuming $monthNames is an array with month names
                                                            $monthNames = array(
                                                                "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                            );
                                                            
                                                            $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                            
                                                            $timestamp = time(); // Get the current timestamp
                                                            $vl = 2;
                                                			$state = base64_encode($timestamp . "_".$vl);
                                                			
                                                			$id = $album['album_id'];
                                                			
                                                			$decodeId = base64_encode($timestamp . "_".$id);
                                                       
                                                    ?>
                                                    
                                                    
                                                     <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="">
                                                            
                                                            <div class="gallery-item  " style="width: 100% !important;">
                                                                <div class="grid-item-holder ">
                                                                    <?php if($planExpDate > $currentDate){ ?>
                                                                                   
                                                                        <a style="position: unset !important;" href="online_album_sa.php?pId=<?=$decodeId?>" >
                                                                    <?php }else{ ?>
                                                                       
                                                                        <a style="position: unset !important;" href="subscription_plans.php?id=<?=$decodeId?>&state=<?=$state?>" >
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                       <div class="image-container justify-content-center align-items-center" style="width: 100%; height: 160px; overflow: hidden;">
                                                                          
                                                                          
                                                                           <?php if($album['upload_server'] == 1 ){ ?>
                                                                            <img style="width:100%"  src="<?=$album['covering_name']?>" alt="">
                                                                <?php }else{ ?>
                                                                    <img style="width:100%"  src="admin/<?= EVENT_UPLOAD_PATH. $album['uploader_folder'].'/'.$album['covering_name'] ?>" alt="">
                                                                <?php } ?> 
                                                                           
                                                                           
</div>
                                                                    
                                                                    
                                                                    
                                                                        <div class="grid-item-holder_title " style="bottom: 20% !important;">
                                                                           
                                                                            <img src="images/machooos-img-dis-logo.png" alt="" style="background: transparent;width: 10%;height: 10%;">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                             </div>
                                                           
                                                           
                                                           
                                                           
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                  
                                                    
                                                    
                                                        
                                                    <?php } ?>
                                                    
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="tc-pagination fl-wrap"></div>
                                            <div class="fw_cb swiper-button-prev"><i class="fal fa-long-arrow-left"></i></div>
                                            <div class="fw_cb swiper-button-next"><i class="fal fa-long-arrow-right"></i></div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                <? } ?>
                                
                                
                        
                                
                                
                                
                                
                                
                             
                                
                            </div>
                            
                            
                            
                            <!--right side-->
                            

                            <div class="col-md-3 col-sm-12" style="padding-top: 0px;padding-bottom: 20px;">
                                
                                
                                <?php if(count($Storiesalbums) > 0) { ?>
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
                                                                                <iframe src="./admin/<?=$vdolink?>"  frameborder="0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" sandbox="allow-same-origin allow-scripts"></iframe>
                                                                                
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
                                                                                
                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="stories.php?id=<?=$decodeId?>"  ></div>

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
                                                                                
                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="blogs.php?pId=<?=$decodeId?>"   ></div>

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
                                                                                
                                                                                <div style="position: absolute;top: 0; left: 0; width: 100%; height: 100%; background: transparent;" href="blogs.php?pId=<?=$decodeId?>"   ></div>

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
                                 
                                 
                               
                                 
                                    
    
                                 
                                 
                                 
                                
                                <!-- section end-->
                            </div>
                            
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
    /* background: #804bd8; */
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

$('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').addClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
   

  $( document ).ready(function() {

      lc_lightbox('.elem', {
		wrap_class: 'lcl_fade_oc',
		gallery : true,	
		thumb_attr: 'data-lcl-thumb', 
		
		skin: 'minimal',
		radius: 0,
		padding	: 0,
		border_w: 0,
	});	
	
	
	   var loadId = $('#projIdVal').val();
        handleIframeClick(loadId);
      
  });
  
   
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
                            text: "Comment posted successfully",
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
        
        
  
    </script>