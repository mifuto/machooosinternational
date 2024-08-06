<?php 
include('admin/config.php');
include("templates/header.php");

require_once("admin/razorpay/Razorpay.php");

use Razorpay\Api\Api;


$IdString = base64_decode($_REQUEST['album_id']);
$arr = explode('_', $IdString);
$album_id = $arr[1];

$IdString1 = base64_decode($_REQUEST['pId']);
$arr1 = explode('_', $IdString1);
$plan_id = $arr1[1];

$IdString2 = base64_decode($_REQUEST['state']);
$arr2 = explode('_', $IdString2);
$state = $arr2[1];


$api = new Api(RZRP_KEY, RZRP_PASS);

$plan_id = (int)$plan_id;
$album_id =(int)$album_id;
$planSql = "SELECT * FROM tblalbumsubscription WHERE id=$plan_id";

$planArr = $dbc->get_rows($planSql);

var_dump($planArr);

if(count($planArr) > 0) {
  $plan = $planArr[0];
  $amount = $plan['pamount'] * 100;
  $currency = "INR";
  $receipt = str_replace('.', '', microtime(true)). "__" .rand(1,10000) . "__". $album_id;
  $order = $api->order->create(array('receipt'=>$receipt, 'amount'=>$amount, 'currency'=>$currency));

  var_dump($order);
  $order_id = $order['id'];
  $_SESSION['razorpay_order_id'] = $order_id;
}
?>

<style>
  .price-col {
      padding: 30px;
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
      background: #4d0000;
      color: #fff;
  }

  .price-col h1 {
      margin-bottom: 30px;
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
      font-size: 42px;
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
      margin-bottom: 20px;
      padding: 0;
      list-style: none;
  }

  .price-col ul {
      display: block;
      margin-bottom: 20px;
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
      margin-bottom: 15px;
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

  .price-col.feature .p-btn,
  .price-col.feature .p-btn:hover {
      color: #fff;
      background: #222;
  }

  .price-col.feature1 .p-btn,
  .price-col.feature1 .p-btn:hover {
      color: #222;
      background: #fff;
  }
</style>

<!-- content-holder -->
<div class="content-holder vis-dec-anim">
    <!-- content -->
    <div class="content">
        <div class="post_header fl-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-title alighn-title">
                            <h2>Purchase Plan</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- container-->
        <div class="container">
            <div class="fl-wrap content-item sec-anim">


                <div class="row fl-wrap" id="itemList">



                </div>
                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                var options = {
                    "key": "<?= RZRP_KEY ?>",
                    "amount": "<?= $amount ?>",
                    "currency": "<?= $currency ?>",
                    "name": "Machoos International",
                    "description": "Album purchase",
                    "image": "https://machooosinternational.com/images/logo.png",
                    "order_id": "<?= $order_id ?>",
                    "handler": function(response) {
                        // alert(response.razorpay_payment_id);
                        // alert(response.razorpay_order_id);
                        // alert(response.razorpay_signature)
                        purchaseNow(1,response.razorpay_payment_id,response.razorpay_order_id,response.razorpay_signature,'','');
                    },
                    "prefill": {},
                    "notes": {
                        "address": "Machoos International"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function(response) {
                    // alert(response.error.code);
                    // alert(response.error.description);
                    // alert(response.error.source);
                    // alert(response.error.step);
                    // alert(response.error.reason);
                    // alert(response.error.metadata.order_id);
                    // alert(response.error.metadata.payment_id);
                    purchaseNow(0,response.error.metadata.payment_id,response.error.metadata.order_id,'',response.error.code,response.error.reason);
                });

                
                </script>

            </div>
            <!-- section end-->
        </div>
        <!-- container end-->
    </div>
    <!-- content end -->
    <div class="clearfix"></div>
    <footer class="main-footer">
        <div class="policy-box">
            <span>&#169; MI 2022 . All rights reserved. </span>
        </div>
        <div class="footer-social ">
            <ul>
                <li style="margin-right: 20px;margin-left: 0px;"><a href="privacy-policy.php" target="_blank">Privacy
                        Policy </a></li>
                <li style="margin-right: 20px;margin-left: 0px;"><a href="terms-and-conditions.php"
                        target="_blank">Terms & Conditions</a></li>

            </ul>
        </div>
        <div class="footer-social">
            <ul>
                <li><a href="https://www.facebook.com/machooos" target="_blank">Facebook</a></li>
                <li><a href="https://www.instagram.com/machooosinternational/" target="_blank">Instagram</a></li>
                <li><a href="https://twitter.com/Machooos_wed" target="_blank">Twitter</a></li>
                <li><a href="https://g.co/kgs/Mmpk9z" target="_blank">Google</a></li>
                <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?view_as=subscriber"
                        target="_blank">Youtube</a></li>
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
var currentUrl = getUrlParameter('album_id');
var IdString = Base64.decode(currentUrl);
var arr = IdString.split('_');
var album_id = arr[1];

var currentUrl1 = getUrlParameter('pId');
var IdString1 = Base64.decode(currentUrl1);
var arr1 = IdString1.split('_');
var plan_id = arr1[1];

var currentUrl2 = getUrlParameter('state');
var IdString2 = Base64.decode(currentUrl2);
var arr2 = IdString2.split('_');
var state = arr2[1];

var planFeatures = <?= json_encode($planFeatures) ?>;

console.log(planFeatures);


$(document).ready(function() {
    getPlansDetails(plan_id);

});



function getPlansDetails() {
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
                            '<div class="price-col feature1 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    } else if (v.is_primary == 1) {
                        html +=
                            '<div class="price-col feature wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
                    } else {
                        html +=
                            '<div class="price-col  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
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



            $("#itemList").html(html);

            document.getElementById('rzp-button1').onclick = function(e) {
                rzp1.open();
                e.preventDefault();
            }
        }
    }

    apiCall(postData, successFn);
}


function purchaseNow(payment_status,payment_id,order_id,razorpay_signature,error_code,error_reason) {

    postData = {
      function: 'AlbumSubscription',
      method: "purchaseSA",
      plan_id: plan_id,
      album_id: album_id,
      state: state,
      payment_status:payment_status,
      payment_id:payment_id,
      order_id:order_id,
      razorpay_signature:razorpay_signature,
      error_code: error_code,
      error_reason: error_reason
    }

    console.log(postData);

    successFn = function(resp) {
        if (resp.status == 1) {
            if(payment_status) {
                Swal.fire({
                    title: 'Success',
                    text: resp.data,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (state == 1) window.location.assign("signature_album.php")
                        else window.location.assign("online-album.php")
                    }
                })

                setTimeout(function() {
                    if (state == 1) window.location.assign("signature_album.php")
                    else window.location.assign("online-album.php")
                }, 1500);
            } else {
                Swal.fire( 'Error', resp.data, 'error' );
            }
        } else {
            Swal.fire( 'Error', resp.data, 'error' );
        }

    }

    apiCall(postData, successFn);
}


function getUrlParameter(sParam) {
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