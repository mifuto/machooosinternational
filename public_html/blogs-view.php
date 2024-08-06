

<?php 
include("admin/config.php");
include("get_session.php");

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
                    <div class="container">
                        <a href="blogs.php" class=" single-btn fl-wrap" style="margin-top: 0px; padding: 10px 10px;width: auto; float: right; margin-bottom: 15px;position:fixed;left: 7%; top: 20%; z-index: 23;"><span>Back to list</span>
                        </a>
                        
                        <div class="row">
                           
                             <!--fs-slider-wrap-->	
                                <div class="fs-slider-wrap full-height fl-wrap">
                                    <div class="fs-slider   full-height fl-wrap">
                                        <div class="swiper-container">
                                            <div class="" id="blogImage" >
                                            
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="content-nav" id="pageViewTop" ></div>


                                </div>
                                <!-- fs-slider-wrap end-->
                                
                                <div class="content ">
                                    <section class="single-content-section" >
                                        <div class="container">
                                            <div class="row">


                                        
                                                <div class="col-md-12">

                                                    <div class="article padding-v-60 text-center">
                                                        <div class="w-9-12">
                                                            <h1 id="blogTitle" class="black h1 padding-10 font-playfair">
                                                            </h1>
                                                        </div>
                                                        <p class="text-center grey-dark margin-t-30 font-helvetica">
                                                        <span class="margin-r-10 inline-block"><a href="#" id="blogAuthor"></a></span>
                                                            <span class="inline-block margin-r-10"> | </span>
                                                            <span class="inline-block"><a href="#" id="blogDate"></a> </span>
                                                            <span class="inline-block margin-r-10"> | </span>
                                                            <span class="inline-block"><a href="#" id="blogviewCounts"></a> </span>

                                                            
                                                        
                                                        </p>
                                                    


                                                    </div>
                                                            
                                                            
                                                </div>


                                            </div>
                                        </div>
                                    </section>
                                </div>



                                <div class="row">

                                 
                                    <div class="col-md-8">

                                        <div class="article padding-v-60 text-center">

                                                <div class="margin-t-60 content font-playfair ">
                                                    <h5 id="blogSmallDescription" class="black h5 padding-10 font-playfair " >
                                                    </h5>
                                                </div>
                                        </div>

                                        <div class="article padding-v-60 text-center">
                                            
                                            

                                            <div class="margin-t-60 content font-playfair"  style="width: 100%; overflow:hidden">
                                                <p id="blogLongDescription" ></p>
                                            </div>


                                        </div>
                                                
                                       			
                                    </div>


                                    

                                    <div class="col-md-4">

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
var shareUrl = "<?= $baseURL ?>/blogs-view.php?id="+currentUrl;
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

     getBlogRec();
     getNxtPrv();
     getTrendingStories();

 });

 function addShareCount(){
    successFn = function(resp)  {
    }
    data = { "function": 'Blogs',"method": "addShareCount" , 'Id':mainId};
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
                itemLists +='<a href="blogs-view.php?id='+ currentdate +'" >';

                if(Recs[i]['video'] == "") {
                    itemLists += '<img src="./admin/'+ Recs[i]['image']+'" width="100%" >';
                }
                else{
                    var trimmedString = Recs[i]['video'].substring(0, 10);
                    if(trimmedString == 'blogImages'){
                        itemLists += '<div class="iframecontainer"> <iframe class="responsive-iframe"  src="./admin/'+ Recs[i]['video']+'"></iframe></div>';

                    }else{
                        itemLists += '<div class="iframecontainer"> <iframe class="responsive-iframe"  src="'+ Recs[i]['video']+'"></iframe></div>';

                    }
                    
                }


                itemLists +='</a>';
                itemLists +='</div></div></div> ';
              
                var newDate = new Date(Recs[i]['posted_date']);
                // Get year, month, and day part from the date
                var year = newDate.toLocaleString("default", { year: "numeric" });
                var month = newDate.toLocaleString("default", { month: "numeric" });
                var day = newDate.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;

                itemLists +='<div class="col-sm-6" align="left"><div class="post-item_content fl-wrap"><div class="post-header fl-wrap"><a href="#">'+ Recs[i]['author']+'</a></div><h4 style="font-weight: bold;font-size: 12px;">'+ Recs[i]['tittle']+'</h4><div class="post-header fl-wrap"><a href="#">'+ formattedDate +'</a></div></div></div>';

            }
        }else{
            itemLists +='<div class="col-sm-12 "><div class="post-item_wrap fl-wrap"><div class="post-item_media fl-wrap mt-4">    <label style="color:#666666">No stories available!</label> </div>  </div> </div> ';
        }

    
        $('#listTreading').html(itemLists);
        
      
   }
   data = {"function": 'Blogs', "method": "getTrendingStories", 'Id':mainId };
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

        var prvName = resp.data['prvName'].split( /(?<=^(?:.{15})+)(?!$)/ )
       var nxtName = resp.data['nxtName'].split( /(?<=^(?:.{15})+)(?!$)/ )

       console.log(resp.data);
       $('#pageView').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');

       $('#pageViewTop').html('<div class="fw_cb   fs-slider-button-prev" tabindex="0" role="button" aria-label="Prev slide"><a onclick="goPage('+ resp.data['prv']+')" ><i class="fal fa-long-arrow-left"></i></a> </div><div class="fw_cb   fs-slider-button-next" tabindex="0" role="button" aria-label="Next slide"><a onclick="goPage('+ resp.data['nxt']+')"> <i class="fal fa-long-arrow-right"></i></a></div>');

       
       
       
      
   }
   data = {"function": 'Blogs', "method": "getNxtPrv", "id": mainId };
   apiCall(data,successFn);

 }

 function goPage(id){
    var currentdate = Base64.encode(Date.now()+"_"+id);
    window.location.assign('blogs-view.php?id='+ currentdate );

 }

 function getBlogRec(){
   
   successFn = function(resp)  {
       console.log(resp.data);
       var Recs = resp.data['res'];
       let originalString = Recs[0]['long_description'];
        let searchString = "tinymceuploads";
        let replacementString = "admin/tinymceuploads";
        let newString = originalString.replace(new RegExp(searchString, "g"), replacementString);
        $('#blogLongDescription').html(newString);
        $('#blogSmallDescription').html(Recs[0]['small_description']);
        $('#blogTitle').html(Recs[0]['tittle']);
        $('#blogSubTitle').html(Recs[0]['sub_tittle']);
        $('#blogviewCounts').html(Recs[0]['viewCounts']+" Views");




        
        // $('#blogImage').html('<div class="bg"  data-bg="./admin/'+ Recs[0]['image']+'" data-swiper-parallax="20%"></div> <div class="overlay"></div> <div class="fs-slider_align_title"> <h5>'+ Recs[0]['sub_tittle']+'</h5><h2><a href="#" class="ajax">'+ Recs[0]['tittle']+'</a></h2> <div class="clearfix"></div> </div>');

        if(Recs[0]['video'] == ""){
            $('#blogImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <img width="100%" src="./admin/'+ Recs[0]['image']+'">  </div>  </div>');
        }else{

            var trimmedString = Recs[0]['video'].substring(0, 10);
            if(trimmedString == 'blogImages'){


                $('#blogImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="./admin/'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }else{
                $('#blogImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }




           
        }

       

        $('#blogAuthor').html(Recs[0]['author']);
        var newDate = new Date(Recs[0]['posted_date']);

          // Get year, month, and day part from the date
          var year = newDate.toLocaleString("default", { year: "numeric" });
        var month = newDate.toLocaleString("default", { month: "numeric" });
        var day = newDate.toLocaleString("default", { day: "2-digit" });

        var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;

        $('#blogDate').html(formattedDate);
        
      
   }
   data = {"function": 'Blogs', "method": "getBlogRec", "id": mainId };
   apiCall(data,successFn);
}



 </script>


