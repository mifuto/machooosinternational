<?php 
include('admin/config.php');
include("templates/header.php");

?>

<style>
    .price-col {
      padding: 10px;
      text-align: center;
      border: 1px solid #e8e8e8;
      background: #fff;
      padding-top: 15px;
    }

    .price-col .card-action {
      text-align: right;
      padding-bottom: 15px;
      height: 20px;
      margin: 10px -3px;
    }

    .price-col .card-action i {
      float: right;
    }

    .price-col.feature {
      border: 1px solid #222;
      background: #222;
      color: #fff;
    }

    .price-col.feature1 {
      border: 1px solid #222;
      background:  #4d0000;
      color: #fff;
    }

    .price-col h1 {
      margin-bottom: 15px;
      text-transform: uppercase;
      font-size: 16px;
    }

    .price-col.feature h1 {
      color: #cc0000;
    }
    .price-col.feature1 h1 {
      color: #fff;
    }

    .price-col .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid #e5e5e5;
      border-bottom: 1px solid #e5e5e5;
    }

    .price-col.feature .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid rgba(255, 255, 255, .2);
      border-bottom: 1px solid rgba(255, 255, 255, .2);
    }
    .price-col.feature1 .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid rgba(255, 255, 255, .2);
      border-bottom: 1px solid rgba(255, 255, 255, .2);
    }
    .price-col .dollar {
      font-size: 30px;
      font-weight: normal;
    }

    .price-col .dollar span {
      margin-left: -10px;
      font-size: 16px;
    }

    .price-col .duration {
      text-transform: uppercase;
      font-size: 12px;
    }

    .price-col ul {
      display: block;
      margin-bottom: 10px;
      padding: 0;
      list-style: none;
    }

    .price-col.feature ul li {
      color: #7d7d7d;
    }
    .price-col.feature1 ul li {
      color: #ffcccc;
    }
    .price-col ul li {
      margin-bottom: 3px;
      color: #222;
    }

    .price-col .p-btn {
      display: inline-block;
      display: inherit;
      padding: 15px 20px;
      text-transform: uppercase;
      color: #222;
      border: 1px solid #e8e8e8;
      font-family: 'Abel', sans-serif;
      font-weight: normal;
      letter-spacing: 2px;
      background: #fff;
    }

    .price-col.feature .p-btn, .price-col.feature .p-btn:hover {
      color: #fff;
      background: #222;
    }
    .price-col.feature1 .p-btn, .price-col.feature1 .p-btn:hover {
      color: #222;
      background: #fff;
    }
  </style>

   <!-- content-holder -->
   <div class="content-holder vis-dec-anim" style="top: 75px;">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-title alighn-title" style="padding-bottom: 35px;">
                                            <h4>let's enjoy</h4>
                                            <h2>Subscription plans</h2>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <h2 style="font-size: 28px;">Only Online Album</h2>
                        <!-- container-->
                        <div class="container">
                            <div class="fl-wrap content-item sec-anim"   >


                                <div class="row fl-wrap" id="itemList"></div>
                              

                            </div>
                            <!-- section end-->
                        </div>
                        <!-- container end--> 

                        <h2 style="font-size: 28px;">Signature Album & Online Album </h2>

                         <!-- container-->
                         <div class="container">
                            <div class="fl-wrap content-item sec-anim"   >


                                <div class="row fl-wrap" id="itemList1"></div>
                              

                            </div>
                            <!-- section end-->
                        </div>
                        <!-- container end--> 

                    </div>
                    <!-- content end -->
                    <div class="clearfix"></div>
                    <footer class="main-footer" >
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
                <!-- content-holder end -->

          
           

<?php 

include("templates/footer.php");

?>


<script>

    var currentUrl1 = getUrlParameter('state');
    var IdString1 = Base64.decode(currentUrl1);
    var arr1 = IdString1.split('_');
    var state = arr1[1];
   
    var currentUrl = getUrlParameter('id');
    var IdString = Base64.decode(currentUrl);
    var arr = IdString.split('_');
    var album_id = arr[1];

    var planFeatures = <?= json_encode($planFeatures) ?>;

    console.log(planFeatures)

$( document ).ready(function() {

    getPlans();
    getBothPlans();

});



function getBothPlans() {
    postData = {
      function: 'AlbumSubscription',
        method: "getSA",
        signature:1,
        online:1,
    }

    console.log(postData);

    successFn = function(resp) {
      console.log(resp);

        if(resp.status == 1) {
            var html = '';
            if( resp.data.length > 0){
                $.each(resp.data, function(k,v){

                    html +='<div class="col-md-4 pt-2 pb-4">';

                    if(v.delete == 1){
                    html +='<div class="price-col feature1 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }else if(v.is_primary == 1){
                    html +='<div class="price-col feature wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }else{
                    html +='<div class="price-col  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }
                    
                    html +='<h1 class="mt-2">' + v.name + '</h1>';
                    html +='<div class="p-value">';
                    html +='<div style="font-size: 18px;font-weight: normal;"><del>'+ '&#8377; ' + v.amount + ' </del></div>';
                    html +='<div class="dollar">'+ '&#8377; ' + v.pamount + ' <span>.00</span></div>';
                    html +='<div class="duration">'+ v.period + (v.period == 1 ?' Year' : ' Years') + '</div>';

                    if(v.delete == 1){
                      var divclr = "bg-dark mt-2 text-white";
                    }else if(v.is_primary == 1){
                      var divclr = "bg-secondary mt-2 text-white";
                    }else{
                      var divclr = "bg-success mt-2 text-white";
                      
                    }
                    

                    if(v.signature == 1 && v.online == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px;padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;" >Signature Album <br> Online Album</div>';
                    }else if(v.signature == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px; padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;" >Signature Album  </div>';
                    }else if(v.online == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px; padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;">Online Album  </div>';
                    }

                    

                    html +='</div>';

                    html +='</div>';
                    html +='<ul>';
                    var fet = v.featurs.split(',');
                
                    $.each(fet, function(i, f) {
                        //console.log(f)
                    html +=  '<li>' + planFeatures[f] + '</li>';
                    });
                    
                    html += '</ul>';
                        
                    html += '<a href="#" onclick="purchaseNow('+ v.id +')" class="p-btn">purchase this plan</a>';
                    html += '</div>';
                    html += '</div>';


                });

            }else{
            html += '<div class="col-md-12 text-center mb-4">No plans available</div>';

            }

              $("#itemList1").html(html);

      
        }
    }

    apiCall(postData,successFn);
}




function getPlans() {
    if(state == 1){
      postData = {
        function: 'AlbumSubscription',
          method: "getSA",
          signature:1,
          online:0,
      }
    }else{
      postData = {
        function: 'AlbumSubscription',
          method: "getSA",
          signature:0,
          online:1,
      }
    }
   

    console.log(postData);

    successFn = function(resp) {
      console.log(resp);

        if(resp.status == 1) {
            var html = '';
            if( resp.data.length > 0){
                $.each(resp.data, function(k,v){

                    html +='<div class="col-md-4 pt-2 pb-4">';

                    if(v.delete == 1){
                    html +='<div class="price-col feature1 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }else if(v.is_primary == 1){
                    html +='<div class="price-col feature wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }else{
                    html +='<div class="price-col  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    }
                    
                    html +='<h1 class="mt-2">' + v.name + '</h1>';
                    html +='<div class="p-value">';
                    html +='<div style="font-size: 18px;font-weight: normal;"><del>'+ '&#8377; ' + v.amount + ' </del></div>';
                    html +='<div class="dollar">'+ '&#8377; ' + v.pamount + ' <span>.00</span></div>';
                    html +='<div class="duration">'+ v.period + (v.period == 1 ?' Year' : ' Years') + '</div>';

                    if(v.delete == 1){
                      var divclr = "bg-dark mt-2 text-white";
                    }else if(v.is_primary == 1){
                      var divclr = "bg-secondary mt-2 text-white";
                    }else{
                      var divclr = "bg-success mt-2 text-white";
                      
                    }
                    

                    if(v.signature == 1 && v.online == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px; padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;" >Signature Album <br> Online Album</div>';
                    }else if(v.signature == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px; padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;" >Signature Album  </div>';
                    }else if(v.online == 1){
                      html +='<div class="'+divclr+'" style="padding-top: 5px; padding-bottom: 5px;">';
                      html +='<div class="duration p-2" style="font-size: 14px;">Online Album  </div>';
                    }

                    

                    html +='</div>';

                    html +='</div>';
                    html +='<ul>';
                    var fet = v.featurs.split(',');
                
                    $.each(fet, function(i, f) {
                        //console.log(f)
                    html +=  '<li>' + planFeatures[f] + '</li>';
                    });
                    
                    html += '</ul>';
                        
                    html += '<a href="#" onclick="purchaseNow('+ v.id +')" class="p-btn">purchase this plan</a>';
                    html += '</div>';
                    html += '</div>';


                });

            }else{
            html += '<div class="col-md-12 text-center mb-4">No plans available</div>';

            }

            

            $("#itemList").html(html);

      
        }
    }

    apiCall(postData,successFn);
}


function purchaseNow(plan_id){

  var currentdateplan_id = Base64.encode(Date.now()+"_"+plan_id ); 
  var currentdatealbum_id = Base64.encode(Date.now()+"_"+album_id ); 
  var currentdatestate = Base64.encode(Date.now()+"_"+state ); 
  getPlansDetails(plan_id)
    $("#confirmSubscriptionModal").show();
//   window.location.assign("purchase_album.php?pId="+currentdateplan_id+"&album_id="+currentdatealbum_id+"&state="+currentdatestate);

 
}

function getPlansDetails(plan_id) {
    postData = {
        function: 'AlbumSubscription',
        method: "getOne",
        id: plan_id,
    }

    console.log(postData);

    successFn = function(resp) {
        console.log(resp);

        if (resp.status == 1) {
            var html = '';
            if (resp.data.length > 0) {
                $.each(resp.data, function(k, v) {

                    html += '<div class="col-md-12 pt-2 pb-4">';

                    if (v.delete == 1) {
                        html +=
                            '<div class="price-col feature1 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; width: 50%; margin: auto;">';
                    } else if (v.is_primary == 1) {
                        html +=
                            '<div class="price-col feature wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; width: 50%; margin: auto;">';
                    } else {
                        html +=
                            '<div class="price-col  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; width: 50%; margin: auto;">';
                    }

                    html += '<h1 class="mt-2">' + v.name + '</h1>';
                    html += '<div class="p-value">';
                    html += '<div style="font-size: 22px;font-weight: normal;"><del>' + '&#8377; ' + v
                        .amount + ' </del></div>';
                    html += '<div class="dollar">' + '&#8377; ' + v.pamount + ' <span>.00</span></div>';
                    html += '<div class="duration">' + v.period + (v.period == 1 ? ' Year' : ' Years') +
                        '</div>';

                    if (v.delete == 1) {
                        var divclr = "bg-dark mt-2 text-white";
                    } else if (v.is_primary == 1) {
                        var divclr = "bg-secondary mt-2 text-white";
                    } else {
                        var divclr = "bg-success mt-2 text-white";

                    }


                    if (v.signature == 1 && v.online == 1) {
                        html += '<div class="' + divclr + '">';
                        html +=
                            '<div class="duration p-2" style="font-size: 16px;" >Signature Album <br> Online Album</div>';
                    } else if (v.signature == 1) {
                        html += '<div class="' + divclr +
                            '" style="padding-top: 11px; padding-bottom: 11px;">';
                        html +=
                            '<div class="duration p-2" style="font-size: 16px;" >Signature Album  </div>';
                    } else if (v.online == 1) {
                        html += '<div class="' + divclr +
                            '" style="padding-top: 11px; padding-bottom: 11px;">';
                        html += '<div class="duration p-2" style="font-size: 16px;">Online Album  </div>';
                    }



                    html += '</div>';

                    html += '</div>';
                    html += '<ul>';
                    var fet = v.featurs.split(',');

                    $.each(fet, function(i, f) {
                        //console.log(f)
                        html += '<li>' + planFeatures[f] + '</li>';
                    });

                    html += '</ul>';

                    html += '<a href="javascript:void(0);" id="rzp-button1" class="p-btn">Pay</a>';
                    html += '</div>';
                    html += '</div>';


                });

            } else {
                html += '<div class="col-md-12 text-center mb-4">No subscription plans available</div>';

            }



            $("#confirmSubscriptionContent").html(html);

            document.getElementById('rzp-button1').onclick = function(e) {
                rzp1.open();
                e.preventDefault();
            }
        }
    }

    apiCall(postData, successFn);
}

function closeModaldiv(){
    $("#confirmSubscriptionModal").hide();
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


