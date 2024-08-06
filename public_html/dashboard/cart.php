 <?php
 
 include("header.php");
 
 $cartData = [];
$countcart = 0;
$totalPrice = 0;
$totalOfferPrice = 0;
$finalOfferPrice = 0;
$totalExtraPrice = 0;

$sqlcart = "SELECT * FROM cart WHERE user_id=".$user_id." AND active=0 ";


$resultcart = $DBC->query($sqlcart);
$countcart = mysqli_num_rows($resultcart);

if($countcart > 0) {		
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        array_push($cartData,$rowcart);
    }
}

$mainArray = array();



?>

<style>
    .btn {
   
    --bs-btn-line-height: 0.1;
  
    --bs-btn-border-width: .1px;
  
}

.form-control {
    width: 100%;
    padding: 0.1rem 0.2rem;
   
    line-height: .1;
  
}

.input-group>.form-control, .input-group>.form-floating, .input-group>.form-select {
    flex: .3 1 auto;
  
}

.imageDiv {
   
}


@media only screen and (max-width: 480px) {
    .imageDiv {
        width: 100%;
        height: 160px;
    }

}
</style>

        <!-- partial -->
        <div class="content-wrapper">
          <h3 class="page-heading mb-4">MI SHOPPING CART (<?=$countcart?> item)</h3>
          
          
            
            <?php if(count($cartData) > 0) { ?>
            
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 mb-4">
            
            
            
                                    <div class="row" style="padding-left: 20px;padding-right: 0px;">
                                            <?php
                                            foreach ($cartData as $key => $album) { 
                                                        $album_type = $album['album_type'];
                                                        $album_id = $album['album_id'];
                                                        $quantity = $album['quantity'];
                                                        $finalPrice = $album['final_amount'];
                                                        $actualPrice = $album['amount'];
                                                        $offerPriceP = $album['offer'];
                                                        $id=$album['album_id'];
                                                        $imageCount = $album['imageCount'];
                                                        $cartID = $album['id'];
                                                        
                                                        $totalPrice = floatval($totalPrice) + floatval($actualPrice) ;
                                                        $totalOfferPrice = floatval($totalOfferPrice) + (floatval($actualPrice) - floatval($finalPrice) );
                                                        $finalOfferPrice = floatval($finalOfferPrice) + floatval($finalPrice);
                                                        
                                                        
                                                        if($album_type == 'SA'){
                                                            
                                                            $fet = "SELECT * FROM `tbesignaturealbum_projects` WHERE `id`=$album_id ";
                                                            $resultf = $DBC->query($fet);
                                                            $rowf = mysqli_fetch_assoc($resultf);
                                                            
                                                            if($rowf['upload_server'] == 1) $imagePath = $rowf['cover_img_path'];
                                                            else $imagePath = "/admin/".$rowf['cover_img_path'];
                                                            
                                                            $heading = $rowf['project_name'];
                                                            
                                                            $albumTypeName = "Signature Album ($imageCount images)";
                                                            
                                                            $expiry_date = $rowf['expiry_date'];

                                                        }else{
                                                            $fet = "SELECT *, E.id album_id FROM tbevents_data E JOIN tbeevent_files F ON(F.event_id = E.id) WHERE E.id = $album_id";
                                                            $resultf = $DBC->query($fet);
                                                            $rowf = mysqli_fetch_assoc($resultf);
                                                            
                                                             
                                                            if($rowf['upload_server'] == 1) $imagePath = $rowf['covering_name'];
                                                            else $imagePath = "/admin/eventUploads/".$rowf['uploader_folder']."/".$rowf['covering_name'];
                                                            
                                                            $heading = $rowf['event_name'];
                                                            
                                                            $albumTypeName = "Online Album";
                                                            
                                                            $expiry_date = $rowf['expiry_date'];
                                                        }
                                                        
                                                        $dateToCompare = strtotime($expiry_date);
                                                        $currentDate = time();
                                                        $today = date("Y-m-d");
                                                        
                                                        $isExtra = false;
                                                        $isExtraVal = 0;
                                                        $extraAmt = 0;
                                                        
                                                        if ($dateToCompare <= $currentDate) {
                                                            
                                                            
                                                            $newPackDate = date("Y-m-d", strtotime("+$quantity years", strtotime($today)));
                                                            
                                                            $startDate = new DateTime($expiry_date);
                                                            $endDate = new DateTime(); // Current date
                                                            
                                                            $interval = $startDate->diff($endDate);
                                                            $numberOfDays = $interval->format('%a');
                                                          
                                                            if($numberOfDays >= 36524){
                                                                
                                                                $extraAmt = ($finalPrice / 100) * 40 ;
                                                                $totalExtraPrice = floatval($totalExtraPrice) + $extraAmt;
                                                                
                                                                $dis =  "An additional 40% fee (₹$extraAmt) will be incurred post the expiration of the validity period.";
                                                                $isExtra = true;
                                                                $isExtraVal = 1;
                                                            }else if($numberOfDays >= 1825){
                                                                
                                                                $extraAmt = ($finalPrice / 100) * 30 ;
                                                                $totalExtraPrice = floatval($totalExtraPrice) + $extraAmt;
                                                                
                                                                $dis =  "An additional 30% fee (₹$extraAmt) will be incurred post the expiration of the validity period.";
                                                                $isExtra = true;
                                                                $isExtraVal = 1;
                                                            }else if($numberOfDays >= 1095){
                                                                
                                                                $extraAmt = ($finalPrice / 100) * 30 ;
                                                                $totalExtraPrice = floatval($totalExtraPrice) + $extraAmt;
                                                                
                                                                $dis =  "An additional 30% fee (₹$extraAmt) will be incurred post the expiration of the validity period.";
                                                                $isExtra = true;
                                                                $isExtraVal = 1;
                                                            }else if($numberOfDays >= 365){
                                                                
                                                                $extraAmt = ($finalPrice / 100) * 10 ;
                                                                $totalExtraPrice = floatval($totalExtraPrice) + $extraAmt;
                                                                
                                                                $dis =  "An additional 10% fee (₹$extraAmt) will be incurred post the expiration of the validity period.";
                                                                $isExtra = true;
                                                                $isExtraVal = 1;
                                                            }
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        } else {
                                                            $newPackDate = date("Y-m-d", strtotime($expiry_date . " +$quantity years"));
                                                            
                                                        }
                                                        
                                                       
                                                         $planExpDate = new DateTime($newPackDate);
    
                                                        // Get year, month, and day part from the date
                                                        $year = $planExpDate->format('Y');
                                                        $month = $planExpDate->format('n');
                                                        $day = $planExpDate->format('d');
                                                        
                                                        // Assuming $monthNames is an array with month names
                                                        $monthNames = array(
                                                            "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                        );
                                                        
                                                        $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                        
                                                        
                                                        $keyArray = array(
                                                            'cartID' => $cartID,
                                                            'newExpPackDate' => $newPackDate,
                                                            'isExtra' => $isExtraVal,
                                                            'extraAmt'=> $extraAmt,
                                                        );
                                                        
                                                        $mainArray[] = $keyArray;
                                                       
                                                        
                                            ?>
                                            
                                           
                                            
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 imageDiv">
                                                
                                                    <div class="card" style="background-image: url('<?=$imagePath?>'); background-size: cover; background-position: center;height: 100%;
    width: auto;">
                                                        <div class="card-body">
                                                         
                                                        </div>
                                                      </div>
                                                
                                            </div>
                                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 ">
                                                <div class="row" style="padding-top:5px;">
                                                    
                                                
                                            
                                            
                                            
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                                                        
                                                        <h4 class="card-title font-weight-normal text-primary"><?=$heading?></h4>
                                                        <h6 class="card-subtitle text-danger" ><?=$offerPriceP?>% off </h6>
                                                        
                                                       <h4 class="text-black " style="text-align: left !important;margin-bottom: 0.3rem !important;">
                                                           <span class="mr-3" >₹ <?=$finalPrice?> / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ <?=$actualPrice?></del></span>
                                                       </h4>
                                                       
                                                      <p class="text-dark"><?=$albumTypeName?></p>
                                                      
                                                      
                                                        
                                                    </div>
                                                    
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 ">
                                                        <div class="row">
                                                            
                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                                                                    
                                                                        <div class="row d-flex justify-content-left" style="padding-left:3px;padding-right:10px;">
                                                                          
                                                                                       
                                                                             <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 d-flex justify-content-center">
                                                                                <div class="d-flex justify-content-center" style="padding-top:5px;">
                                                                                    <span class="mr-3 " ><b>Validity&nbsp;&nbsp;</b></span>
                                                                                     <div class="input-group">
                                                                                        <span class="input-group-btn">
                                                                                            <button onclick="quantityChange(1,<?=$id?>,`<?=$album_type?>`,<?=$imageCount?>,<?=$cartID?>)" type="button" class="btn btn-secondary btn-number" data-type="minus" data-field="quantity">
                                                                                                <i class="fa fa-minus"></i>
                                                                                            </button>
                                                                                        </span>
                                                                                        <input type="text" onchange="quantityChange(3,<?=$id?>,`<?=$album_type?>`,<?=$imageCount?>,<?=$cartID?>)" name="quantity" id="quantity_<?=$id?>" class="form-control input-number" value="<?=$quantity?>" min="1" max="10">
                                                                                        <span class="input-group-btn">
                                                                                            <button type="button" onclick="quantityChange(2,<?=$id?>,`<?=$album_type?>`,<?=$imageCount?>,<?=$cartID?>)" class="btn btn-secondary btn-number" data-type="plus" data-field="quantity">
                                                                                                <i class="fa fa-plus"></i>
                                                                                            </button>
                                                                                        </span>
                                                                                    </div>
                                                                                   
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 d-flex justify-content-right">
                                                                    
                                                                               <a class=" text-danger float-right text-white" onclick="deleteItem(`<?=$cartID?>`);" ><i class="fa fa-trash fa-2x"></i></a>
                                                                                    
                                                                                
                                                                            </div>
                                                                            
                                                                        
                                                                          
                                                                          
                                                                        </div>
                                                                        
                                                                    
                                                                </div>
                                                                
                                                                 
                                                                
                                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
                                                                    <p class="text-dark">The album's validity will exprie in <?=$formattedExpDate?></p>
                                                                </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
                                                    
                                            
                                                </div>
                                                
                                            </div>
                                            <?php if($isExtra){ ?>
                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 "></div>
                                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 ">
                                                    
                                                              <p class="text-danger"><?=$dis?>   </p>
                                                          
                                                </div>
                                            <?php }?>
                                            
                                           
                                            <hr style="width: 100%;">
                                          
                                            
                                             <?php } 
                                             $mainArrayJSON = json_encode($mainArray); ?>
                                         </div>
                                         
                                         
                                         
                                         
                                         
                                         
            
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 mb-4">
                        
                        
                        <div class="card-deck" >
                            <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" style="min-height:295px;">
                              <div class="card-body">
                                <h5 class="card-title mb-4">PRICE DETAILS</h5><hr>
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Price (<?=$countcart?> item)
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>₹<?=$totalPrice?></b></p>
                                        
                                    </div>
                                 
                                </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Discount
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>- ₹<?=$totalOfferPrice?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Service charge
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>₹<?=$totalExtraPrice?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                <hr>
                                <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 d-flex align-items-center justify-items-center ">
                                        
                                        <div class="form-group" style="width: 100%;"> <label>Have coupon?</label>
                                                        <div class="input-group"> <input type="text" class="form-control coupon" name="Couponcode" id="Couponcode" placeholder="Coupon code" style="width: 100%;"> <span class="input-group-append"> <button onclick="applyCouponcode();" class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                                                    </div>
                                                    
                                        
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 d-flex align-items-center justify-items-center d-none" id="couponcodeErr">
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Coupon
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " id="applyCouponPrice"><b>-₹0</b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                <hr>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            <b>Total Amount</b>
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " id="totalDisAmt"><b>₹<?=$finalOfferPrice+$totalExtraPrice?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                <hr>
                               
                                
                                <div class="row mb-4">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <button class="btn btn-success text-white" style="width: 100%;" onclick="placeOrderNow();" >Confirm to check out</button>
                                        
                                    </div>
                                  
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-success" id="saveDisAmt">
                                            <b>You will save ₹<?=$totalPrice-$finalOfferPrice?> on this order</b>
                                          </p>
                                        
                                    </div>
                                  
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark" >
                                            Need help cal us <a href="tel:+919961117777">+919961117777</a>  | <a href="tel:+919809996333">+919809996333</a>
                                          </p>
                                        
                                    </div>
                                  
                                </div>
                                
                                
                                
                                
                                
                              </div>
                            </div>
                        
                        </div>
                        
                        
                    </div> 
                        
                </div>
            
            
            
            
            <? } else { ?>
                                    
                <div class="card-deck" id='viewAddress'>
                    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" style="min-height:295px;background-color: transparent;">
                      <div class="card-body">
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <h5 class="card-title ">SHOPPING CART</h5>
                        </div>
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <label class="card-title mb-4 text-muted">Home \ Shopping Cart</label>
                        
                        </div>
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column " >
                            <img src="images/360_F_560176615_cUua21qgzxDiLiiyiVGYjUnLSGnVLIi6-removebg-preview.png" style="background-size: cover; background-position: center;height:auto;width:10%;"></img>
                         
                        </div>
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <h5 class="card-title ">Your Cart Is Currently Empty!</h5>
                        </div>
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <label class="card-title mb-4 text-muted align-items-center justify-items-center">Before proceed to checkout you must add some products to your shopping cart.You will find a lot of Interesting products on our "Shop" page.</label>
                        
                        </div>
                        
                       <div class="row d-flex align-items-center justify-content-center">
                            <button type="button" onclick="gotoOAAlbum();" class="btn btn-primary mr-2">Return To Online Album</button>
                            <button type="button" onclick="gotoSAAlbum();" class="btn btn-primary mr-2">Return To Signature Album</button>
                        </div>

                        
                        
                      </div>
                    </div>
                
                </div>
            
            <?php } ?>
            
            
            
            
          
          
        </div>
        
        
      
        
<?php
   
include("footer.php");
                                                      
?>

 <script>
 
    var numberOfItems = 0;
    var numberOfItemsPrice = 0;
    var numberOfItemsDiscount = 0;
    var numberOfItemsExtraCharge = 0;
    
    var ifCouponApply = 0;
    var couponApplyDiscount = 0;
    
    var numberOfItemsTotalAmount = 0;
    var numberOfItemssave = 0;
    
    var DiscountType = 0;
    var CouponDiscount = 0;
  
    document.getElementById("menu1").classList.remove("active");
    document.getElementById("menu2").classList.remove("active");
    document.getElementById("menu3").classList.remove("active");
    document.getElementById("menu5").classList.add("active");
    document.getElementById("menu4").classList.remove("active");
    document.getElementById("menu8").classList.remove("active");
    
    function placeOrderNow(){
        var mainArray = '<?php echo $mainArrayJSON; ?>';
        // console.log(mainArray);
        
        numberOfItems = '<?=$countcart?>';
        numberOfItemsPrice = '<?=$totalPrice?>';
        numberOfItemsDiscount = '<?=$totalOfferPrice?>';
        numberOfItemsExtraCharge = '<?=$totalExtraPrice?>';
        
        if(ifCouponApply == 0){
            couponApplyDiscount = 0;
            
            numberOfItemsTotalAmount = '<?=$finalOfferPrice+$totalExtraPrice?>';
            numberOfItemssave = '<?=$totalPrice-$finalOfferPrice?>';
        }
        
        var Couponcode = $('#Couponcode').val();
        var user_id = '<?=$user_id?>';
        
        
        // console.log('numberOfItems. '+numberOfItems);
        // console.log('numberOfItemsPrice. '+numberOfItemsPrice);
        // console.log('numberOfItemsDiscount. '+numberOfItemsDiscount);
        // console.log('numberOfItemsExtraCharge. '+numberOfItemsExtraCharge);
        // console.log('ifCouponApply. '+ifCouponApply);
        // console.log('couponApplyDiscount. '+couponApplyDiscount);
        // console.log('numberOfItemsTotalAmount. '+numberOfItemsTotalAmount);
        // console.log('numberOfItemssave. '+numberOfItemssave);
        
         var postData = {
            function: 'AlbumSubscription',
            method: "placeOrderNow",
            'mainArray': mainArray,
            'numberOfItems': numberOfItems,
            'numberOfItemsPrice': numberOfItemsPrice,
            'numberOfItemsDiscount': numberOfItemsDiscount,
            'numberOfItemsExtraCharge': numberOfItemsExtraCharge,
            'ifCouponApply': ifCouponApply,
            'couponApplyDiscount': couponApplyDiscount,
            'numberOfItemsTotalAmount': numberOfItemsTotalAmount,
            'numberOfItemssave': numberOfItemssave,
            'Couponcode': Couponcode,
            'DiscountType' : DiscountType,
            'CouponDiscount': CouponDiscount,
            'user_id':user_id,
           
           
          }
          
          $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                    window.location.href = 'place-order.php?purchaseID='+data.data;
               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        
        
        
    }
    
    
    
    
    function gotoOAAlbum(){
         window.location.href = '/online-album.php';
    }
    
    function gotoSAAlbum(){
         window.location.href = '/signature_album.php';
    }
    
    function applyCouponcode(){
         var Couponcode = $('#Couponcode').val();
         $('#couponcodeErr').addClass('d-none');
         $('#couponcodeErr').html('');
         $('#applyCouponPrice').html('<b>-₹0</b>');
         
         $('#totalDisAmt').html('<b>₹<?=$finalOfferPrice+$totalExtraPrice?></b>');
         $('#saveDisAmt').html('<b>You will save ₹<?=$totalPrice-$finalOfferPrice?> on this order</b>');
         
         ifCouponApply = 0;
            DiscountType = 0;
            CouponDiscount = 0;
         
         
         
         if(Couponcode == ""){
             $('#couponcodeErr').removeClass('d-none');
             $('#couponcodeErr').html('<p class="text-danger" >Please enter coupon code</p>');
             return false;
         }
         
          var postData = {
            function: 'AlbumSubscription',
            method: "applyCouponcode",
            'Couponcode': Couponcode,
           
           
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                  var arrayLength = data.data.length;
                  if(arrayLength == 0){
                      $('#couponcodeErr').removeClass('d-none');
                         $('#couponcodeErr').html('<p class="text-danger" >Invalid coupon code</p>');
                         return false;
                  }else{
                      var coupon = data.data[0] ;
                      if(coupon['DiscountType'] == 1){
                          //amt
                          var minusAmt = coupon['CouponDiscount'] ;
                          var tlAmt = '<?=$finalOfferPrice+$totalExtraPrice?>';
                          var newTlamt = (tlAmt - minusAmt).toFixed(2) ;
                          
                          var savtlAmt = '<?=$totalPrice-$finalOfferPrice?>';
                          savtlAmt = parseInt(savtlAmt) + parseInt(minusAmt) ;
                          
                          
                          $('#applyCouponPrice').html('<b>-₹'+minusAmt+'</b>');
                          $('#totalDisAmt').html('<b>₹'+newTlamt+'</b>');
                          
                          $('#saveDisAmt').html('<b>You will save ₹'+savtlAmt+' on this order</b>');
                          
                          couponApplyDiscount = minusAmt;
                          
                          
                      }else{
                          //offer
                          var minusAmt = coupon['CouponDiscount'] ;
                          var tlAmt = '<?=$finalOfferPrice+$totalExtraPrice?>';
                          var oftlAmt = ( (tlAmt / 100 ) * minusAmt ).toFixed(2) ;
                          
                          var newTlamt = (tlAmt - oftlAmt).toFixed(2) ;
                          
                          var savtlAmt = '<?=$totalPrice-$finalOfferPrice?>';
                          savtlAmt = parseInt(savtlAmt) + parseInt(oftlAmt) ;
                          
                          $('#applyCouponPrice').html('<b>-₹'+oftlAmt+'</b>');
                          $('#totalDisAmt').html('<b>₹'+newTlamt+'</b>');
                          $('#saveDisAmt').html('<b>You will save ₹'+savtlAmt+' on this order</b>');
                          
                          couponApplyDiscount = oftlAmt;
                      }
                      
                      
                      ifCouponApply = 1;
                      numberOfItemsTotalAmount = newTlamt;
                      numberOfItemssave = savtlAmt;
                      
                      DiscountType = coupon['DiscountType'];
                        CouponDiscount = coupon['CouponDiscount'];
                        
                        $('#couponcodeErr').html('<p class="text-success" >Coupon applied successfully</p>');
                      
                      
                     
                  }
                  
               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
         
    }
    
    
    function quantityChange(btn,id,album_type,imageCount,cartID){
	    var quantity = $('#quantity_'+id).val();
	    if(btn ==1){
	        
	        quantity = parseInt(quantity);
	        if(quantity == 1 ) $('#quantity_'+id).val(1);
	        else if(quantity == 3 ) $('#quantity_'+id).val(1);
	        else if(quantity == 5 ) $('#quantity_'+id).val(3);
	        else if(quantity == 10 ) $('#quantity_'+id).val(5);
	        
	        
	        quantityValSet(id,album_type,imageCount,cartID);
	        
	    }else if(btn ==2){
	        quantity = parseInt(quantity);
	        if(quantity == 1 ) $('#quantity_'+id).val(3);
	        else if(quantity == 3 ) $('#quantity_'+id).val(5);
	        else if(quantity == 5 ) $('#quantity_'+id).val(10);
	        else if(quantity == 10 ) $('#quantity_'+id).val(10);
	        
	        quantityValSet(id,album_type,imageCount,cartID);
	    }else{
	        var newquantity = parseInt(quantity);
	        
	        if(newquantity <= 10 && newquantity >= 1 ) {
	            quantity = parseInt(quantity);
	            
    	        if(quantity == 1 ) $('#quantity_'+id).val(1);
    	        else if(quantity == 3 || quantity == 2 ) $('#quantity_'+id).val(3);
    	        else if(quantity == 5 || quantity == 4  ) $('#quantity_'+id).val(5);
    	        else if(quantity == 10 || quantity == 9 || quantity == 8 || quantity == 7 || quantity == 6 ) $('#quantity_'+id).val(10);
	            
	        }
	        else $('#quantity_'+id).val(1);
	        
	        quantityValSet(id,album_type,imageCount,cartID);
	    }
	    
	}
	
	function quantityValSet(id,album_type,imageCount,cartID){
        var quantity = $('#quantity_'+id).val();
        
         var postData = {
            function: 'AlbumSubscription',
            method: "quantityValSetCart",
            quantity: quantity,
            albumType: album_type,
            imageCount:imageCount,
            'cartID':cartID,
           
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                   location.reload(); // This will refresh the page.

               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        
    }
    
    function deleteItem(cartID){
          var postData = {
            function: 'AlbumSubscription',
            method: "deleteItem",
            'cartID':cartID,
           
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                   location.reload(); // This will refresh the page.

               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        
    }
  
  

</script>