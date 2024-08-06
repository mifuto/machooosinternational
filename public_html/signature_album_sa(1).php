<?php 
include("get_session.php");
require_once('admin/config.php');

$user_data = get_session();
if(isset($user_data['userID']) && $user_data['userID'] > 0) {
$logginUserName = $user_data['firstname']." ".$user_data['lastname'];
$userIdVal = $user_data['contact_user_id'];
$userphonenumber = $user_data['phonenumber'];
$useremail = $user_data['email'];
}else {

    if(!isset($_COOKIE['commentUserName'])) $logginUserName ="";
    else  $logginUserName =$_COOKIE['commentUserName'];

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
// echo $ogimage; die;

include("templates/headerShare_sa.php");

?>
                <!-- content-holder -->
                <input type="hidden" value="<?php echo $lsignatureAlbumUserId; ?>" id="lsignatureAlbumUserId">
                <input type="hidden" value="<?php echo $userIdVal; ?>" id="userIdVal">
                <input type="hidden" value="<?php echo $logginUserName; ?>" id="logginUserName">
                <input type="hidden" value="<?php echo $userphonenumber; ?>" id="userphonenumber">
                <input type="hidden" value="<?php echo $useremail; ?>" id="useremail">
                <input type="hidden" value="<?php echo $contact_user_id; ?>" id="loggedUserId">
                <input type="hidden" id="viewProjId">
            
                <div class="content-holder vis-dec-anim" style="top: 20px;">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container" style="max-width: 1500px; padding: 0px; width: 100%;">
                                <div class="row" style="margin-right:0px; padding: 0px">
                                    <div class="col-md-12" style="padding-top: 40px;">
                                        <img id="eventCoverImage" src="" style="width: 60%">
                                    </div>
                                    <!-- <div class="col-md-8">
                                        <div class="hero-title alighn-title" style="padding: 10px;">
                                            <h4>The Studio</h4>
                                            <h2>Signature Album</h2>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12" style="padding-top: 40px;">
                                        <div class="hero-title alighn-title" style="padding: 10px;">
                                            <div class="row" style="margin-right:0px; padding: 0px">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <span class="bold-text">Share : </span> 
                                                    <button onclick="addSAShareCount()" type="button" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true">
                                                        <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i>
                                                    </button>
                                                    <button type="button" onclick="addSAShareCount()" id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" >
                                                        <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>
                                                    </button>
                                                    <button type="button" onclick="addSAShareCount()" id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true">
                                                        <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>
                                                    </button>
                                                    <button type="button" onclick="addSAShareCount()" id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true">
                                                        <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>
                                                    </button>
                                                    <button type="button" class="btn position-relative" onclick="copyUrl();addSAShareCount()">
                                                        <i class="fa fa-link fa-1x" style="color: #7e7e7e;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-sm-7" style="padding-top: 7px;">
                                                    <a class="subMenu" href="#" style="border-right: 0px;">
                                                        <i class="bi bi-arrow-left-circle" style="color: #8391a1;font-size: 17px;"></i>
                                                        Back to projects
                                                    </a>
                                                </div>
                                                <div class="col-sm-5 pt-2">
                                                    <div class="float-end">
                                                        <a class="subMenu" href="#"><i class="bi bi-question-square" style="margin-right: 5px;"></i></span>Enquire</a>

                                                        <a class="subMenu" href="javascript:void(0);" onclick="viewcomments();"><i class="bi bi-chat-text" style="margin-right: 5px;"></i></span>Comments (12)</a>

                                                        <a class="subMenu" href="#" style="border-right: 0px;"><i class="bi bi-box-arrow-down" style="margin-right: 5px;"></i></span>Download Album</a>
                                                    </div>
                                                </div>  
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                <section style="padding: 0px 0px;">
                                    <!-- <div class="container"> -->
                                        <div class="card" style="border: 0px;">
                                            <div class="card-body" style="padding: 0px; padding-right: 7px; margin-left: 0px;">
                                                <!-- <h5 class="card-title">Folders</h5> -->
                                                <!-- Default Tabs -->
                                                    <ul class="nav nav-tabs" id="signatureAlbumTabs" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Folder1</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Folder2</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Folder3</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="Photo-tab" data-bs-toggle="tab" data-bs-target="#photo" type="button" role="tab" aria-controls="contact" aria-selected="false">Folder4</button>
                                                        </li>
                                                    </ul>
                                                    <div class="pt-4 pb-4" id="signatureAlbumEmptyData">
                                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                            <div>
                                                            Not selected the user to view the albums!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-4 pb-4 d-none" id="signatureAlbumEmptyDataForUser">
                                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                            <div>
                                                            Not created the folder to view !
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-content pt-2" id="signatureAlbumTabContent">
                                                    </div>
                                                <!-- End Default Tabs -->
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </section>
                                <section class="mb-4" style="padding: 0px 0px;" id="comentsDiv">
                                        <div class="pr-subtitle prs_dec" style="margin: 8px; padding: 20px 30px; text-align: center;">
                                         Comments
                                         <?php if($contact_user_id){ ?>
                                            <a href="javascript:void(0)" onclick="waitingforAprovalModal();" style="padding-left: 10px; border-left: 1px solid #ccc;">Waiting for approval</a>
                                         <?php } ?>
                                        </div>
                                        <div id="comments" class="single-post-comm commentsListDiv" style="margin: auto;">
                                            <ul class="commentlist clearafix" id="approvedCommentListUl" style="padding-left: 0px;">
                                            </ul>
                                            <div class="clearfix"></div>
                                            <div id="respond">
                                                <div class="pr-subtitle text-center"> Leave A Review</div>
                                                <div class="section-separator fl-wrap sp2"><span></span></div>
                                                <div class="comment-reply-form clearfix">
                                                    <div id="message" class="text-danger"></div>
                                                    <form id="addComment" class="add-comment custom-form">
                                                        <fieldset>
                                                            <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                <div class="col-md-4">
                                                                    <input name="commentUserName" id="commentUserName" type="text" placeholder="Your Name *" value="<?=$logginUserName?>"/>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input name="commentUserEmail" id="commentUserEmail" type="text" placeholder="Email Address*" value="<?=$useremail?>"/>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" name="commentUserPhone" id="commentUserPhone" placeholder="Phone*" value="<?=$userphonenumber?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                                <div class="col-md-12 mainCommentFormTextarea" id="mainCommentFormTextarea">
                                                                    <textarea name="imogiText" id="imogiText" placeholder="type comments here..." data-emojiable="true" class=""></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- <div data-emojiarea data-type="unicode" data-global-picker="false">
                                                                <div class="emoji-button">&#x1f604;</div>
                                                                <textarea id="input1" rows="5">You can insert unicode emojis here &#x1f604;</textarea>
                                                            </div> -->
                                                            
                                                        </fieldset>
                                                        <div class="row" style="padding: 0px; padding-right: 7px; margin-left: 0px; margin-right: 0px;">
                                                            <div class="col-md-12">
                                                                <input type="hidden" id="projId" name="projId">
                                                                <input type="hidden" id="commentId" name="commentId">
                                                                <button type="button" onclick="saveComments();" class="btn" id="saveCommentsButton"><span>Submit Comment</span></button>
                                                                <button type="button" onclick="saveComments();" class="btn d-none" id="updateCommentsButton"><span>Update Comment</span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end respond-->
                                        </div>
                                    <!-- </div> -->
                                </section>
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