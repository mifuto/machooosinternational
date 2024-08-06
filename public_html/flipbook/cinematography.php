

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
                        <div class="row">
                            <div class="col-md-10">
                                <div class="hero-title alighn-title">
                                    <h4>My Portfolio</h4>
                                    <h2 id="Title"></h2>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="caption-wrap fl-wrap  ">
                                    <ul>
                                       
                                       
                                        <li>
                                            <span>03. Client</span>
                                            <a href="#" id="Client"></a>
                                        </li>
                                        <li>
                                            <span>02. Category</span>
                                            <a href="#" id="Category"></a>
                                        </li>
                                        <li>
                                            <span>04. Camera</span>
                                            <a href="#" id="Camera"></a>
                                        </li>
                                        <li>
                                            <span>01. Location</span>
                                            <a href="#" id="Location"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>


                      <!--fs-slider-wrap-->	
                      <div class="fs-slider-wrap full-height fl-wrap">
                            <div class="fs-slider   full-height fl-wrap">
                                <div class="swiper-container">
                                    <div class="" id="vedioDis" >
                                      
                                    </div>
                                </div>
                            </div>
                           
                            <div class="fs-slider_dec fs-slider_dec_left"></div>
                            <div class="fs-slider_dec fs-slider_dec_right"></div>
                        </div>
                        <!-- fs-slider-wrap end-->

                   



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
                                        <a onclick="showEnquiryform()" class=" single-btn fl-wrap"><span>Start a Project</span></a>				
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2">
                                        <div class="single-post-content_column">
                                            <div class="share-holder ver-share fl-wrap">
                                                <div class="share-title">Share This <br> Article:</div>
                                                <div class="share-container  isShare"></div>
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
                    <footer class="main-footer">
                        <div class="policy-box">
                            <span>&#169; MI 2022 . All rights reserved. </span>
                        </div>
                        <div class="footer-social ">
                            <ul >
                                <li style="margin-right: 20px;margin-left: 0px;"><a href="privacy-policy.php" target="_blank">Privacy Policy </a></li>
                                <li style="margin-right: 20px;margin-left: 0px;"><a href="terms-and-conditions.php" target="_blank">Terms & Conditions</a></li>
                               
                            </ul>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a href="https://www.facebook.com/machooos" target="_blank">Facebook</a></li>
                                <li><a href="https://www.instagram.com/machooosinternational/" target="_blank">Instagram</a></li>
                                <li><a href="https://twitter.com/Machooos_wed" target="_blank">Twitter</a></li>
                                <li><a href="https://g.co/kgs/Mmpk9z" target="_blank">Google</a></li>
                                <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?view_as=subscriber" target="_blank">Youtube</a></li>
                            </ul>
                        </div>
                        <div class="to-top-btn color-bg to-top"><i class="fal fa-long-arrow-up"></i></div>
                    </footer>
                </div>
            </div>
            <!-- wrapper end -->


           
          
           

<?php 

include("templates/footer.php");

?>


<script>

var monthNames = [ "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December" ];
    var mainId = '';

    var currentUrl = getUrlParameter('id');
    if(currentUrl==false){
        successFn = function(resp)  {
            if(resp.data.Cinematography.length > 0){
                mainId = resp.data.Cinematography[0]['id'];
            }
        }
        data = {"function": 'Cinematography', "method": "getLastRec" };
        apiCall(data,successFn);

    }else{
        var IdString = Base64.decode(currentUrl);
        var arr = IdString.split('_');
        mainId = arr[1];
    }

    



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
        $('#Description').html(Recs[0]['description']);
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


