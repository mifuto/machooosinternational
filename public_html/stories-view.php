

<?php 
include("admin/config.php");
include("get_session.php");

$albums = [];

$projIdString = base64_decode($_REQUEST['id']);
$arr = explode('_', $projIdString);
$projId = $arr[1];

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
$sql = "SELECT * FROM story_imgfiles WHERE hide=0 AND story_id =$projId ";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

$tmpData = [];

if($count > 0) {		
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albums,$row);
    }
}

$user_data = get_session();
$imageURL = baseurl();
$baseURL = baseurl();
$token = "";

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


           
            <!-- wrapper -->
            <div id="wrapper">
                <!-- content-holder -->
                <div class="content-holder ch-fw vis-dec-anim" >
                    <div class="container" style="width: 100%; margin: 0px; max-width: 100%;">
                    <a href="stories.php" class=" single-btn fl-wrap" style="margin-top: 0px; padding: 10px 10px;width: auto; float: right; margin-bottom: 15px;position:fixed;left: 7%; top: 20%; z-index: 23;"><span>Back to list</span></a>
                        <!--<div class="row">-->
                           
                        <!--    <div class="col-md-2">-->
                                
                        <!--    </div>-->
                        <!--    <div class="col-md-10"></div>-->
                        <!--</div>-->

                        <div class="row">
                           
                                <!-- fs-slider-wrap-->	
                            <!-- <div class="fs-slider-wrap full-height fl-wrap">
                                <div class="fs-slider   full-height fl-wrap">
                                    <div class="swiper-container">
                                        <div class="" id="StoriesImage" >
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="content-nav" id="pageViewTop" ></div>

                                
                            </div> -->
                            <!-- fs-slider-wrap end -->


                            <div class="content ">
                                <section class="single-content-section" >
                                    <div class="container">
                                        <div class="row">


                                    
                                            <div class="col-md-12">

                                                <div class="article padding-v-60 text-center">
                                                    <div class="w-9-12">
                                                        <h1 id="StoriesTitle" class="black h1 padding-10 font-playfair">
                                                        </h1>
                                                    </div>
                                                    <p class="text-center grey-dark margin-t-30 font-helvetica">
                                                        <span class="margin-r-10 inline-block"><a href="#" id="StoriesEventPlace"></a></span>
                                                        <span class="inline-block margin-r-10"> | </span>
                                                        <span class="inline-block"><a href="#" id="StoriesDate"></a> </span>
                                                        <span class="inline-block margin-r-10"> | </span>
                                                        <span class="inline-block"><a href="#" id="StoriesviewCounts"></a> </span>
                                                    </p>
                                                    <div class="margin-t-60 content font-playfair ">
                                                <h5 id="StoriesSmallDescription" class="black h5 padding-10 font-playfair " >
                                                </h5>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                    <div class="col-md-9">
                                        <div class="article padding-v-60 text-center">
                                            
                                        </div>

                                        <div class="article padding-v-60 text-center">
                                            <div class="margin-t-10 content font-playfair"  style="width: 100%; overflow:hidden">

                                            <?php if(count($albums) > 0) { ?>

                                                    <div class="row">
                                                        
                                                        <div class="col-md-12 mt-4 ">
                                                            <!-- portfolio start -->
                                                            <div class="gallery-items no-padding three-column fl-wrap lightgallery">
                                                                <!-- gallery-item-->

                                                                <?php  foreach ($albums as $key => $album) { ?>

                                                                    <div class="gallery-item nature">
                                                                        <div class="grid-item-holder">
                                                                            <a href="admin/<?= $album['file_path'] ?>" class=" popup-image">
                                                                            <img  src="admin/<?= $album['file_path'] ?>"    alt="">
                                                                            </a>
                                                                        </div>
                                                                    </div>

<!--                                                             
                                                                    <div class="gallery-item ">
                                                                        <div class="grid-item-holder">
                                                                            <img  src="admin/<?= $album['file_path'] ?>" alt="">
                                                                           
                                                                        </div>
                                                                    </div> -->
                                                                

                                                                <?php } ?>


                                                            </div>
                                                       
                                                        </div>
                                                    </div>
                                                    <!-- content-holder end -->


                                                    <?php     
                                                    }
                                                    ?>





                                                <!-- <p id="displayImgHere" ></p> -->
                                            </div>


                                        </div>



                                       
                                                
                                       			
                                    </div>


                                    

                                    <div class="col-md-3">

                                        <div style="padding-top: 30px;">
                                                <div class="fl-wrap content-item sec-anim">
                                                    <div class="row fl-wrap" >
                                                         <div class="col-sm-12 ">
                                                            <div class="post-item_wrap fl-wrap">
                                                                <div class="post-item_media fl-wrap border-bottom"> 
                                                                    <b class="text-danger">TRENDING NOW</b>
                                                                </div>
                                                            
                                                            </div>
                                                          
                                                        </div>

                                                    </div>

                                                    
                                                    <div class="row fl-wrap" id="listTreading">

                                                        
                                                      
                                                        
                                                    </div>
                                                    
                                                </div>
                                                <!-- section end-->
                                            </div>

                                    
                                    </div>

                                    <div class="col-md-12">

                                    <div class="hero-title align-title" style="padding: 20px;">
                                            <div >
                                                <span class="bold-text">Share : </span> 
                                                <button type="button" onclick="addShareCount()" id="share-fb" xmlns="http://www.w3.org/2000/svg"  class="btn position-relative" data-mdb-ripple-unbound="true" style="margin-right: 20px;" >
                                                    <i class="fab fa-facebook-f fa-1x" style="color: #3b5998;"></i>
                                                </button>
                                                <button type="button" onclick="addShareCount()" id="share-tw" class="btn position-relative" data-mdb-ripple-unbound="true" style="margin-right: 20px;" >
                                                    <i class="fab fa-twitter fa-1x" style="color: #55acee;"></i>
                                                </button>
                                                <button type="button" onclick="addShareCount()" id="share-em" class="btn position-relative" data-mdb-ripple-unbound="true" style="margin-right: 20px;" >
                                                    <i class="fab fa-google fa-1x" style="color: #dd4b39;"></i>
                                                </button>
                                                <button type="button" onclick="addShareCount()" id="share-wh" class="btn position-relative" data-mdb-ripple-unbound="true" style="margin-right: 20px;" >
                                                    <i class="fab fa-whatsapp fa-1x" style="color: #25d366;"></i>
                                                </button>  
                                                
                                              

                                            </div>
                                        </div>


                                    </div>

                                    
                                  


                                   
                                </div>



                            
                        </div>
                    </div>
                 
                    <!--content-nav_holder-->            
                    <div class="content-nav_holder fl-wrap sec-anim">
                        <div class="content-nav" id="pageView" >
                           
                        </div>
                    </div>
                    <!--content-nav_holder end -->							
                    <div class="clearfix"></div>
                    <?php  include("templates/footer-tpl.php"); ?>
                </div>
            </div>
            <!-- wrapper end -->
           

<?php 

include("templates/footer.php");

?>


<script>

$('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').addClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');

var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];

    var currentUrl = getUrlParameter('id');
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    var mainId = arr[1];


document.addEventListener("DOMContentLoaded", function(event) { 

// Uses sharer.js 
//  https://ellisonleao.github.io/sharer.js/#twitter  
var shareUrl = "<?= $baseURL ?>/stories-view.php?id="+currentUrl;
var shareTitle = document.title;
var shareSubject = "Read this good article";
var shareImage = "<?= $imageURL ?>";
var shareDescription = "Shared wonderful memories with you.";

console.log(shareImage);


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
     getStoriesRec();
     getNxtPrv();
     getTrendingStories();

 });

 function addShareCount(){
    successFn = function(resp)  {
    }
    data = { "function": 'Stories',"method": "addShareCount" , 'Id':mainId};
    apiCall(data,successFn);
}


 function getTrendingStories(){
    successFn = function(resp)  {
        var Recs = resp.data['res'];
        var itemLists = "";
        if(Recs.length > 0){

       
            for(var i=0;i<Recs.length;i++){

                var currentdate = Base64.encode(Date.now()+"_"+Recs[i]['id']);

                itemLists +='<div class="col-sm-6 mt-4"><div class="post-item_wrap fl-wrap"><div class="post-item_media fl-wrap">';
                itemLists +='<a href="stories-view.php?id='+ currentdate +'" >';
                
                if(Recs[i]['video'] == "") {
                    itemLists += '<img src="./admin/'+ Recs[i]['image_story']+'" width="100%" >';
                }
                else{
                    var trimmedString = Recs[i]['video'].substring(0, 10);
                    if(trimmedString == 'storyImage'){
                        itemLists += '<div class="iframecontainer"> <iframe class="responsive-iframe"  src="./admin/'+ Recs[i]['video']+'"></iframe></div>';

                    }else{
                        itemLists += '<div class="iframecontainer"> <iframe class="responsive-iframe"  src="'+ Recs[i]['video']+'"></iframe></div>';

                    }
                    
                }
                
                itemLists +='</a>';
                itemLists +='</div></div></div> ';

                var newDate = new Date(Recs[i]['event_date']);
                // Get year, month, and day part from the date
                var year = newDate.toLocaleString("default", { year: "numeric" });
                var month = newDate.toLocaleString("default", { month: "numeric" });
                var day = newDate.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;

                itemLists +='<div class="col-sm-6" align="left"><div class="post-item_content fl-wrap"><div class="post-header fl-wrap"><a href="#">'+ Recs[i]['event_place']+'</a></div><h4 style="font-weight: bold;font-size: 12px;">'+ Recs[i]['main_tittle']+'</h4><div class="post-header fl-wrap"><a href="#">'+ formattedDate +'</a></div></div></div>';

            }
        }else{
            itemLists +='<div class="col-sm-12 "><div class="post-item_wrap fl-wrap"><div class="post-item_media fl-wrap mt-4">    <label style="color:#666666">No stories available!</label> </div>  </div> </div> ';
        }

    
       $('#listTreading').html(itemLists);
        
      
   }
   data = {"function": 'Stories', "method": "getTrendingStories", 'Id':mainId };
   apiCall(data,successFn);

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

 function getNxtPrv(){
    successFn = function(resp)  {
       console.log(resp.data);

       var prvName = resp.data['prvName'].split( /(?<=^(?:.{15})+)(?!$)/ )
       var nxtName = resp.data['nxtName'].split( /(?<=^(?:.{15})+)(?!$)/ )

       $('#pageView').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');

       $('#pageViewTop').html('<div class="fw_cb   fs-slider-button-prev" tabindex="0" role="button" aria-label="Prev slide"><a onclick="goPage('+ resp.data['prv']+')" ><i class="fal fa-long-arrow-left"></i></a> </div><div class="fw_cb   fs-slider-button-next" tabindex="0" role="button" aria-label="Next slide"><a onclick="goPage('+ resp.data['nxt']+')"> <i class="fal fa-long-arrow-right"></i></a></div>');

       
        
      
   }
   data = {"function": 'Stories', "method": "getNxtPrv", "id": mainId };
   apiCall(data,successFn);

 }

 function goPage(id){
    var currentdate = Base64.encode(Date.now()+"_"+id);
    window.location.assign('stories-view.php?id='+ currentdate );

 }

 function getStoriesRec(){
   
   successFn = function(resp)  {
       console.log(resp.data);
       var Recs = resp.data['res'];

      

        $('#displayImgHere').html("");


        $('#StoriesSmallDescription').html(Recs[0]['small_description']);
        $('#StoriesTitle').html(Recs[0]['main_tittle']);
        $('#StoriesviewCounts').html(Recs[0]['viewCounts']+" Views");

        

        if(Recs[0]['video'] == ""){
            $('#StoriesImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <img width="100%" src="./admin/'+ Recs[0]['image_story']+'">  </div>  </div>');
        }else{

            var trimmedString = Recs[0]['video'].substring(0, 10);
            if(trimmedString == 'storyImage'){


                $('#StoriesImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="./admin/'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }else{
                $('#StoriesImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }



        }


        
       
        // $('#StoriesImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <img width="100%" src="./admin/'+ Recs[0]['image_story']+'"> <div class="overlay"></div> <div class="fs-slider_align_title"> <h2><a href="#" class="ajax">'+Recs[0]['main_tittle']+'</a></h2> <div class="clearfix"></div> </div> </div>  </div>');

        $('#StoriesEventPlace').html(Recs[0]['event_place']);
        var newDate = new Date(Recs[0]['event_date']);
          // Get year, month, and day part from the date
          var year = newDate.toLocaleString("default", { year: "numeric" });
        var month = newDate.toLocaleString("default", { month: "numeric" });
        var day = newDate.toLocaleString("default", { day: "2-digit" });

        var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
        $('#StoriesDate').html(formattedDate);
        
      
   }
   data = {"function": 'Stories', "method": "getStoriesRec", "id": mainId };
   apiCall(data,successFn);
}



 </script>


