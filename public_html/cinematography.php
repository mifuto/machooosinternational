



<?php 

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



<div id="wrapper">
                <!-- content-holder -->
                <div class="content-holder vis-dec-anim  ch-fw">
                    <div class="container">
                        <a href="cinematography-list.php" class=" single-btn fl-wrap" style="margin-top: 0px; padding: 10px 10px;width: auto; float: right; margin-bottom: 15px;position:fixed;left: 7%; top: 20%; z-index: 23;"><span>Back to list</span></a>
                        <!--<div class="row">-->
                        <!--    <div class="col-md-10"></div>-->
                        <!--    <div class="col-md-2">-->
                        <!--        <a href="cinematography-list.php" class=" single-btn fl-wrap" style="margin-top: 0px;padding: 10px 10px;width: auto;float: right;"><span>Back to list</span></a>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="hero-title alighn-title">
                                    <h4>My Portfolio</h4>
                                    <h2 id="Title"></h2>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="caption-wrap fl-wrap  ">
                                    <ul>
                                       
                                       
                                        <li>
                                            <span>01. Client</span>
                                            <a href="#" id="Client"></a>
                                        </li>
                                        <li>
                                            <span>02. Category</span>
                                            <a href="#" id="Category"></a>
                                        </li>
                                        <li>
                                            <span>03. Camera</span>
                                            <a href="#" id="Camera"></a>
                                        </li>
                                        <li>
                                            <span>04. Location</span>
                                            <a href="#" id="Location"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        

                                <!--fs-slider-wrap-->	
                            <div class="full-height fl-wrap">
                                <div class="full-height fl-wrap">
                                    <div class="swiper-container">
                                        <div class="" id="vedioDis" >
                                        
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="fs-slider_dec fs-slider_dec_left"></div>
                                <div class="fs-slider_dec fs-slider_dec_right"></div>
                            </div>
                            <!-- fs-slider-wrap end-->
                        </div>
                    </div>


                     

                   



                    <!-- content -->
                    <div class="content pad-content">
                        <section class="single-content-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="colmn-section-title">
                                            <h4>Project Details</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="bold-text" id="SmallDescription"></h4>
                                        <p id="Description"></p>
                                        
                                        Share 
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
                                        <a onclick="showEnquiryform()" class=" single-btn fl-wrap"><span>Start a Project</span></a>				
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">
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
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="dec-title"><span></span></div>
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
    var mainId = '';

    var currentUrl = getUrlParameter('id');
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    mainId = arr[1];
   



$( document ).ready(function() {
    setTimeout( function() {
        if(mainId !=""){
            getCinematographyRec();
            getNxtPrv();
        }
       
    }, 1000); 


 });
 

 function getNxtPrv(){
    successFn = function(resp)  {
       console.log(resp.data);

       var prvName = resp.data['prvName'].split( /(?<=^(?:.{15})+)(?!$)/ )
       var nxtName = resp.data['nxtName'].split( /(?<=^(?:.{15})+)(?!$)/ )

       $('#pageView').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');

       $('#pageViewTop').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');
        
      
   }
   data = {"function": 'Cinematography', "method": "getNxtPrv", "id": mainId };
   apiCall(data,successFn);

 }

 function goPage(id){
    var currentdate = Base64.encode(Date.now()+"_"+id);
    window.location.assign('cinematography.php?id='+ currentdate );

 }



 function getCinematographyRec(){
   
   successFn = function(resp)  {
       console.log(resp.data);
       var Recs = resp.data['res'];
       let originalString = Recs[0]['description'];
        let searchString = "tinymceuploads";
        let replacementString = "admin/tinymceuploads";
        let newString = originalString.replace(new RegExp(searchString, "g"), replacementString);

        $('#Description').html(newString);
        $('#SmallDescription').html(Recs[0]['small_description']);
        $('#Title').html(Recs[0]['main_tittle']);

        

        if(Recs[0]['video'] == ""){
            $('#vedioDis').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <img width="100%" src="./admin/'+ Recs[0]['image_story']+'">  </div>  </div>');
        }else{

            var trimmedString = Recs[0]['video'].substring(0, 19);
            if(trimmedString == 'cinematographyImage'){


                $('#vedioDis').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="./admin/'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }else{
                $('#vedioDis').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <div class="iframecontainer"> <iframe class="responsive-iframe"  src="'+ Recs[0]['video']+'"></iframe></div> </div>  </div>');

            }



        }

        $('#Location').html(Recs[0]['event_place']);
        $('#Category').html(Recs[0]['category']);
        $('#Client').html(Recs[0]['client']);
        $('#Camera').html(Recs[0]['camera']);
     
      
   }
   data = {"function": 'Cinematography', "method": "getCinematographyRec", "id": mainId };
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



 </script>


