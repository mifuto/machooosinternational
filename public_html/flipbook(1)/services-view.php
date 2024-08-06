<?php 

include("templates/header.php");

?>
                <!-- content-holder -->
                <div class="content-holder ch-fw vis-dec-anim">
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
                    <!-- single_project_carousel   -->	
                    <div class="single_project_carousel fl-wrap">
                        <!-- fw-carousel-wrap -->
                        <div class="fw-carousel-wrap fsc-holder single_project_carousel fl-wrap">
                            <!-- fw-carousel  -->
                            <div class="fw-carousel  fs-gallery-wrap fl-wrap full-height lightgallery thumb-contr  ">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper" id="ImageList">
                                        
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
                    <div class="content pad-content">
                        <section class="single-content-section" id="secdet">
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
                                        <a href="contacts.php" class=" single-btn fl-wrap"><span>Start a Project</span></a>				
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
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    mainId = arr[1];
   



$( document ).ready(function() {
   
    getServicesRec();
    getNxtPrv();
    getServicesImgFiles();
     

 });

 function getNxtPrv(){
    successFn = function(resp)  {
       console.log(resp.data);

       var prvName = resp.data['prvName'].split( /(?<=^(?:.{15})+)(?!$)/ )
       var nxtName = resp.data['nxtName'].split( /(?<=^(?:.{15})+)(?!$)/ )

       $('#pageView').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');

       $('#pageViewTop').html('<ul><li><a onclick="goPage('+ resp.data['prv']+')" href="#" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ prvName[0]+'...</strong></span></a></li>     <li><a href="#" onclick="goPage('+ resp.data['nxt']+')" class="rn "><span >Next -<strong>  '+ nxtName[0]+'...</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');
        
      
   }
   data = {"function": 'Services', "method": "getNxtPrv", "id": mainId };
   apiCall(data,successFn);

 }

 function goPage(id){
    var currentdate = Base64.encode(Date.now()+"_"+id);
    window.location.assign('services-view.php?id='+ currentdate );

 }

 function getServicesImgFiles(){
        successFn = function(resp) {
        var html1 = '';

        for(var i=0;i<resp.data.SRV.length;i++){
            html1 +='<div class="swiper-slide hov_zoom"><img  src="admin/'+resp.data.SRV[i]['file_path']+'"   alt=""><a href="admin/'+resp.data.SRV[i]['file_path']+'" class="box-media-zoom   popup-image" style="padding: 0px;"><i class="fal fa-search"></i></a></div>';

        }


        // setTimeout(function () {
            html1 +='<div class="swiper-slide folio-slider-link"><a class="folio-slider-link_item custom-scroll-link" href="#secdet"><div class="grid-icon"></div><span>Project Details</span> </a></div>';
            $("#ImageList").html(html1);
        // }, 1000);
     

        }
        data = { "function": 'Services',"method": "getServicesIdfiles","id":mainId };
        apiCall(data,successFn);
 }



 function getServicesRec(){
   
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
   data = {"function": 'Services', "method": "getServicesRec", "id": mainId };
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


