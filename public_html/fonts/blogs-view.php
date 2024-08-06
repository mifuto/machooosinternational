

<?php 

include("templates/header.php");

?>


           
            <!-- wrapper -->
            <div id="wrapper">
                <!-- content-holder -->
                <div class="content-holder ch-fw vis-dec-anim">
                    <div class="container">
                        <div class="row">
                           
                            <div class="col-md-1"></div>
                            
                        </div>
                    </div>


                     <!--fs-slider-wrap-->	
                     <div class="fs-slider-wrap full-height fl-wrap">
                            <div class="fs-slider   full-height fl-wrap">
                                <div class="swiper-container">
                                    <div class="" id="blogImage" >
                                      
                                    </div>
                                </div>
                            </div>
                           
                            <div class="fs-slider_dec fs-slider_dec_left"></div>
                            <div class="fs-slider_dec fs-slider_dec_right"></div>
                        </div>
                        <!-- fs-slider-wrap end-->	






                  
                    <!-- content -->
                    <div class="content pad-content">
                        <section class="single-content-section" id="secdet">
                            <div class="container">
                                <div class="row">

                              
                                    <div class="col-md-3">
                                        <div class="colmn-section-title">
                                            <h4>Post Details</h4>
                                        </div>
                                        <div class="single-post_opt">
                                                    <ul>
                                                        <li><span>Date :</span> </li>
                                                        <li><a href="#" id="blogDate"></a> </li>

                                                        <li><span>Author :</span> </li>
                                                        <li><a href="#" id="blogAuthor"></a> </li>
                                                        
                                                    </ul>
                                                </div>
                                               
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="bold-text" id="blogSmallDescription"></h4>

                                        <p id="blogLongDescription"></p>
                                      
                                       			
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
                        <div class="footer-social">
                            <ul>
                                <li><a href="#" target="_blank">Facebook</a></li>
                                <li><a href="#" target="_blank">Instagram</a></li>
                                <li><a href="#" target="_blank">Twitter</a></li>
                                <li><a href="#" target="_blank">Vkontakte</a></li>
                                <li><a href="#" target="_blank">Behance</a></li>
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

    var currentUrl = getUrlParameter('id');
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    var mainId = arr[1];


$( document ).ready(function() {

     getBlogRec();
     getNxtPrv();

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

 function getNxtPrv(){
    successFn = function(resp)  {
       console.log(resp.data);
       $('#pageView').html('<ul><li><a href="blogs-view.php?id='+ resp.data['prv']+'" class="ln "><i class="fal fa-long-arrow-left"></i><span>Prev -<strong> '+ resp.data['prvName']+'</strong></span></a></li>     <li><a href="blogs-view.php?id='+ resp.data['nxt']+'" class="rn "><span >Next -<strong>  '+ resp.data['nxtName']+'</strong></span> <i class="fal fa-long-arrow-right"></i></a></li>  </ul>');

       
        
      
   }
   data = {"function": 'Blogs', "method": "getNxtPrv", "id": mainId };
   apiCall(data,successFn);

 }

 function getBlogRec(){
   
   successFn = function(resp)  {
       console.log(resp.data);
       var Recs = resp.data['res'];
        $('#blogLongDescription').html(Recs[0]['long_description']);
        $('#blogSmallDescription').html(Recs[0]['small_description']);
        // $('#blogImage').html('<div class="bg"  data-bg="./admin/'+ Recs[0]['image']+'" data-swiper-parallax="20%"></div> <div class="overlay"></div> <div class="fs-slider_align_title"> <h5>'+ Recs[0]['sub_tittle']+'</h5><h2><a href="#" class="ajax">'+ Recs[0]['tittle']+'</a></h2> <div class="clearfix"></div> </div>');

        $('#blogImage').html('<div class="swiper-slide" >   <div class="fs-slider-item fl-wrap" > <img width="100%" src="./admin/'+ Recs[0]['image']+'"> <div class="overlay"></div> <div class="fs-slider_align_title"> <h5>'+Recs[0]['sub_tittle']+'</h5><h2><a href="#" class="ajax">'+Recs[0]['tittle']+'</a></h2> <div class="clearfix"></div> </div> </div>  </div>');

        $('#blogAuthor').html(Recs[0]['author']);
        var newDate = new Date(Recs[0]['posted_date']);
        var formattedDate = newDate.getDay()+ ' '+ monthNames[newDate.getMonth()] + ' '+ newDate.getFullYear();
        $('#blogDate').html(formattedDate);
        
      
   }
   data = {"function": 'Blogs', "method": "getBlogRec", "id": mainId };
   apiCall(data,successFn);
}



 </script>


