 <?php
 include("header.php");
 
 
 
 $sql1 = "SELECT b.country,c.id as state_id,d.id as city_id,a.firstname,a.lastname,c.state as stateName FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblstate c on b.state = c.state left join tblcity d on d.city = b.city WHERE a.id='$user_id' "; 

    
$result1 = $DBC->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

$userCountry = $row1['country'];
$userState = $row1['state_id'];
$userCity = $row1['city_id'];
$userName = strtoupper($row1['firstname']." ".$row1['lastname']);

$stateName = $row1['stateName'];

    
$Cards = [];

 
$sql3 = "SELECT a.* FROM tbluser_cards a WHERE a.active=0 order by a.amount desc ";

$result3 = $DBC->query($sql3);

$count3 = mysqli_num_rows($result3);

if($count3 > 0) {		
    while ($row3 = mysqli_fetch_assoc($result3)) {
        array_push($Cards,$row3);
      
    }
}


$ordersData = [];
 
 $sqlcart = "SELECT * FROM place_order_usercard WHERE user_id=".$user_id." and newpurchaseID !='' order by id desc";


$resultcart = $DBC->query($sqlcart);
$countcart = mysqli_num_rows($resultcart);

if($countcart > 0) {		
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        array_push($ordersData,$rowcart);
    }
}




 

?>

<style>

.displayCardNumber {
    padding-top: 3px;
    padding-left: 50px;
}

.displayExpDate {
    padding-top: 0px;
    padding-left: 131px;
    font-size: smaller;
}

.displayCardNumber1 {
    padding-top: 10px;
    padding-left: 100px;
}

.displayExpDate1 {
    padding-top: 7px;
    padding-left: 170px;
    font-size: smaller;
}

@media only screen and (max-width: 480px) {
    .displayCardNumber1 {
        padding-top: 0px;
        padding-left: 55px;
    }
    
    .displayExpDate1 {
        padding-top: 0px;
        padding-left: 135px;
        font-size: smaller;
    }
}


 .black-dot {
      width: 10px;
      height: 10px;
      background-color: #a0a2a4;
      border-radius: 50%;
      display: inline-block;
    }
    
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>


        <!-- partial -->
        <div class="content-wrapper">
          <h3 class="page-heading mb-4" id="main-card-div">My cards</h3>
          
          
          <div class="row mb-2 d-none" id="viewCards">
                <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-4">Card Details</h5>
                          <hr>
                          
                            <div class="row">
                                
                                <div class="col-12">
                                    <h4>
                                      <span class="badge bg-primary" id="cardName"></span>
                                    </h4>
                                
                                </div>
                                
                                
                            </div>
                          
                                    <div >
                                      <div class="d-flex justify-content-center align-items-center my-3">
                                        
                                        
                                        <p class="pt-3 mx-4" id="cardNameBenfits">
                                        </p>
                                        
                                      </div>
                                      
                                      <div class="d-flex justify-content-center align-items-center my-3">
                                          
                                     
                                          
                                        <button type="button" class="btn btn-info btn mr-2" onclick="closeCardBenfits();" data-mdb-ripple-init="" data-mdb-dismiss="modal" style="">
                                          Cancel
                                        </button>
                                        
                                        <button type="button" class="btn btn-success btn " onclick="purchaseNow();" id="purchaseBtn">
                                          Purchase now
                                        </button>
                                      
                                       
                                      </div>
                                      
                                      
                                      
                                    </div>
                          
                          
                        </div>
                    </div>
                 </div>
              
            </div>
          
           
            <div class="row mb-2 " id="listCards">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Available cards</h5>
                          
                        <?php if(count($Cards) > 0) { ?>
                            <div class="row">
                               <?php
                                  $isPurchaseable = false;
                                  $purchaseCardNumber = '';
                                  
                                  
                                  foreach ($Cards as $key => $card) { 
                                  
                                  $id = $card['id'];
                                  $exp = $card['exp']." year";
                                  
                                  $timestamp = time();
                                  $decodeId = base64_encode($timestamp . "_".$id);
                                  $decodeId = str_rot13($decodeId);
                                  
                                  
                                  $psql = "SELECT * FROM place_order_usercard WHERE razorpay_payment_status=1 AND completed=1 AND isNew=1 AND card_id='$id' AND user_id='$user_id' ";
                        		    $presult = $DBC->query($psql);
                        		    $presult1 = $DBC->query($psql);

                                    $pcount = mysqli_num_rows($presult);
                                    if($pcount > 0){ 
                                        $isPurchaseable = true;
                                        $prow2 = mysqli_fetch_assoc($presult1);
                                        $purchaseCardNumber = $prow2['card_number'];
                                    }
                                  
                                  
                                  
                                  
                                      
                                  
                                  
                                  ?>
                                  
                                  
                                       <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 mb-4" style="height: 208px;width: 100%;" id="card_<?=$id?>">
                                           
                                           <?php if($isPurchaseable > 0){ ?>
                                           
                                           
                                               <?php if($pcount > 0){ 
                                                                        
                                                    $prow1 = mysqli_fetch_assoc($presult);
                                                    $cardNumber = $prow1['card_number'];
                                                    $cardExp = $prow1['exp_date'];
                                                    $cardNumber = chunk_split($cardNumber, 4, ' ');
                                                    
                                                    $dateTime = new DateTime($cardExp);
    
                                                    // Format the date
                                                    $formattedDate = $dateTime->format('d/m/Y');
                                                    
                                                    
                                                    
                                                    $cardExp = $formattedDate;
                                                    
                                                    $cardExpDate = $prow1['exp_date'];
                                                   // Convert the given date string to a DateTime object
                                                    $givenDate = new DateTime($cardExpDate);
                                                    
                                                    // Get today's date as a DateTime object
                                                    $today = new DateTime();
                                                    
                                                    $isExp = false;
                                                    
                                                    if ($givenDate >= $today) {
                                                        $isExp = false;
                                                    } else {
                                                        $isExp = true;
                                                        $purchaseCardExp = true;
                                                    }
                                                    
                                                    $activeImageUrl = "/admin/".$card['image'];
                                                    $activeName = strtoupper($card['CardName']);
                                                    $activeExp = $cardExp;
                                                    $activeNumber = $cardNumber;
                                                    $activeUserName = $userName;
                                                    
                                                    $userPurchasedOrderId = $prow1['id'];
                                                    
                                                   
                                                  
    
                                                ?>
                                                
                                                
                                                    <?php if($isExp){ ?>
                                                                                            
                                                    <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;" >
                                                    
                                                    <?php }else{ ?>
                                                    

                                                    
                                                    <div onclick="showCardDetails(`<?=strtoupper($card['CardName'])?>`,<?=$id?>,'<?=$userPurchasedServices?>',`<?=$userPurchasedOrderId?>`,`<?=$activeImageUrl?>`,`<?=$activeUserName?>`,`<?=$activeName?>`,`<?=$activeNumber?>`,`<?=$activeExp?>`)" class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;" >
                                                    
                                                    <?php } ?>
                                                    
                                                    
                                                        <div class="card-body" style="padding-top: 20px; !important">
                                                               <div class="clearfix" >
                                                                       <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                              </div>
                                                              <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['card_name'])?></h4>
                                                              <h5 class="card-title font-weight-normal text-white displayCardNumber" ><?=$cardNumber?></h5>
                                                              <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=$cardExp?></h6>
                                                              
                                                              
                                                              
                                                         
                                                        </div>
                                                  
                                                    </div>
                                                    
                                                     <?php if($isExp){ ?>
                                                                                            
                                                      <!-- Add a centered button -->
                                                        <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                            <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                        </div>
                                                        <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                            <button class="btn btn-light " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['card_name'])?>`,<?=$id?>,`<?=$decodeId?>`,1);">activate card</button>
                                                        </div>
                                                        
                                                    <?php } ?>
                                                
                                                
                                                
                                                
                                                
                                                <?php }else{ ?>
                                                                                
                                                                                
                                                                                
                                                    <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;">
                                                        <!--opacity: .3;-->
                                                        
                                                        <div class="card-body" style="padding-top: 20px; !important">
                                                               <div class="clearfix" >
                                                                       <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                              </div>
                                                              <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['card_name'])?></h4>
                                                              <h5 class="card-title font-weight-normal text-white displayCardNumber" >0000 0000 0000 0000</h5>
                                                              <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=strtoupper($exp)?></h6>
                                                              
                                                              
                                                              
                                                         
                                                        </div>
                                                  
                                                    </div>
                                                    <!-- Add a centered button -->
                                                        <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                            <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                        </div>
                                                        <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                            <button class="btn btn-dark " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['card_name'])?>`,<?=$id?>,`<?=$decodeId?>`,2,`<?=$purchaseCardNumber?>`);">upgrade card</button>
                                                        </div>
                                                        
                                                <?php } ?>
           
                                           
                                           
                                           
                                           
                                           
                                           
                                           
                                           <?php }else{ ?>
                                           
                                                  <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;">
                                                     <!--opacity: .3;-->
                                                     <div class="card-body" style="padding-top: 20px; !important">
                                                        <div class="clearfix" >
                                                           <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                        </div>
                                                        <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['card_name'])?></h4>
                                                        <h5 class="card-title font-weight-normal text-white displayCardNumber" >0000 0000 0000 0000</h5>
                                                        <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=strtoupper($exp)?></h6>
                                                     </div>
                                                  </div>
                                                  <!-- Add a centered button -->
                                                  <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                     <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                  </div>
                                                  <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                     <button class="btn btn-light " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['card_name'])?>`,<?=$id?>,`<?=$decodeId?>`,0);">view details</button>
                                                  </div>
                                          
                                          <?php } ?>
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                       </div>
                               
                               <?php } ?>
                            </div>
                            
                        <?php }else{ ?>
                        
                            <div class="row d-flex align-items-center justify-items-center flex-column">
                               <h3 class="card-title text-muted">There is no cards yet</h3>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center flex-column">
                               <label class="card-title text-muted text-center">
                               No cards found! Available cards are based on your state and district. Please ensure that you have added your complete address, including state and district. 
                               <a href='/dashboard/address.php'>Click here</a> to update your address.
                               </label>
                            </div>
                            
                        <?php } ?>
                          
                      
                     
                      
                      
                      
                      
                    </div>
                  </div>
                </div>
             </div>
             
             
             
             
             
              <?php if(count($ordersData) > 0) { ?>
             
             
                <div class="row mb-2">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-4">Transactions</h5>
                          <div class="table-responsive mb-2" style="overflow-x: auto;">
                            <table class="table center-aligned-table" >
                                
                              <thead>
                                <tr class="text-primary">
                                  <th>No</th>
                                  <th>Transaction ID</th>
                                  <th>Card Name</th>
                                  <th>Card Number</th>
                                  <th>Utilize</th>
                                  
                                  <th>Card Validity</th>
                                 
                                
                                  <th>Orginal Price</th>
                                  <th>Discount</th>
                                   <th>Coupon</th>
                                  <th>Created</th>
                                    <th>Expire</th>
                                    
                                  <th>Status</th>
                                  <th>Price</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              
                              <tbody>
                                  
                                  <?php 
                                      $i =0;
                                                foreach ($ordersData as $key => $album) { 
                                                    $i++;
                                                    $id = $album['id'];
                                                    $numberOfItemsPrice = $album['numberOfItemsPrice'];
                                                    $numberOfItemsDiscount = $album['numberOfItemsDiscount'];
                                                    $numberOfItemsTotalAmount = $album['numberOfItemsTotalAmount'];
                                                    $razorpay_payment_status = $album['razorpay_payment_status'];
                                                    
                                                    $couponApplyDiscount = $album['couponApplyDiscount'];
                                                    
                                                    $card_number = $album['card_number'];
                                                    $exp_date = $album['exp_date'];
                                                    
                                                    $num_services = $album['num_services'];
                                                    
                                                    
                                                    $card_type = $album['card_type'];
                                                    
                                                    if($card_type == 2) $crdtyd = '<label class="badge badge-success">upgraded</label>';
                                                    else if($card_type == 1) $crdtyd = '<label class="badge badge-primary">activated</label>';
                                                    else $crdtyd = '';
                                                    
                                                    
                                                    
                                                                 $planExpDate1 = new DateTime($exp_date);
            
                                                                // Get year, month, and day part from the date
                                                                $year1 = $planExpDate1->format('Y');
                                                                $month1 = $planExpDate1->format('n');
                                                                $day1 = $planExpDate1->format('d');
                                                                
                                                                // Assuming $monthNames is an array with month names
                                                                $monthNames1 = array(
                                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                );
                                                                
                                                                $exp_date = $day1 . ' ' . $monthNames1[$month1 - 1] . ' ' . $year1;
                                                    
                                                    $newpurchaseID = $album['newpurchaseID'];
                                                    
                                                    $created_date = $album['created_date'];
                                                    
                                                    
                                                                 $planExpDate = new DateTime($created_date);
            
                                                                // Get year, month, and day part from the date
                                                                $year = $planExpDate->format('Y');
                                                                $month = $planExpDate->format('n');
                                                                $day = $planExpDate->format('d');
                                                                
                                                                // Assuming $monthNames is an array with month names
                                                                $monthNames = array(
                                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                                );
                                                                
                                                                $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                                
                                                                
                                                                $timestamp = time();
                                                    		    $decodeId = base64_encode($timestamp . "_".$id);
                                                    		    $decodeId = str_rot13($decodeId);
                                                    		    
                                                    		    
                                                    		    $card_id = $album['card_id'];
                                                        		$sqlcard = "SELECT a.* FROM tbluser_cards a WHERE a.id='$card_id' ";
                                                        		$resultcard = $DBC->query($sqlcard);
                                                        		$rowcard = mysqli_fetch_assoc($resultcard);
                                                        		
                                                        		
                                                        		 $cardExpDate1 = $album['exp_date'];
                                                        		 $isNew = $album['isNew'];
                                                               // Convert the given date string to a DateTime object
                                                                $givenDate1 = new DateTime($cardExpDate1);
                                                                
                                                                // Get today's date as a DateTime object
                                                                $today1 = new DateTime();
                                                                
                                                                $isExpDay = '';
                                                                if($isNew == 1){
                                                                    if ($givenDate1 >= $today1) {
                                                                        
                                                                        // Define the target date (e.g., 2025-01-19)
                                                                        $targetDate = new DateTime($cardExpDate1);
                                                                        
                                                                        // Get the current date
                                                                        $currentDate = new DateTime();
                                                                        
                                                                        // Calculate the difference in days
                                                                        $interval = $currentDate->diff($targetDate);
                                                                        $numberOfDays = $interval->days;
                                                                        
                                                                        $isExpDay = '<label class=" text-success">'.$numberOfDays.' days</label>';
                                                                    } else {
                                                                        $isExpDay = '<label class=" text-danger">Expired</label>';
                                                                    }
                                                                }else{
                                                                    $isExpDay = '<label class=" text-danger">Deactivated</label>';
                                                                }
                                                                
                                                                
                                                        		
                                                        		
                                                    		    
                                                    		    
                                                    		    
                                                    		    
                                                                
                                            ?>
                                  
                                  
                                                <tr class="">
                                                  <td><?=$i?></td>
                                                  <td>#<?=$newpurchaseID?></td>
                                                  
                                                  <td><?=$rowcard['card_name']?> <?=$crdtyd?></td>
                                                  <td><?=$card_number?></td>
                                                  <td><?=$num_services?> Services</td>
                                                  <td><?=$isExpDay?></td>
                                                  
                                                 
                                                  
                                                  
                                                  <td>₹<?=$numberOfItemsPrice?></td>
                                                  <td>-₹<?=$numberOfItemsDiscount?></td>
                                                  <td>-₹<?=$couponApplyDiscount?></td>
                                                  <td><?=$formattedExpDate?></td>
                                                   <td><?=$exp_date?></td>
                                                   
                                                  
                                                  
                                                  <?php if($razorpay_payment_status == 1){ ?>
                                                        <td><label class="badge badge-success">Success</label></td>
                                                          <td>₹<?=$numberOfItemsTotalAmount?></td>
                                                          <td><a onclick="printNow(<?=$id?>);" role="button" class="text-primary">
                                                             <i class="bi bi-printer-fill"></i>
                                                          </a></td>
                                                          <td><a onclick="downloadNow(<?=$id?>,`<?=$newpurchaseID?>`);" role="button" class="text-primary">
                                                              <i class="bi bi-download"></i>
                                                          </a></td>
                                                      
                                                  <?php }else{ ?>
                                                        <td><label class="badge badge-danger">Failed</label></td>
                                                          <td>₹<?=$numberOfItemsTotalAmount?></td>
                                                          <td></td>
                                                          <td></td>
                                                  <?php } ?>
                                                  
                                                
                                                </tr>
                                            
                                            <?php } 
                                        
                                     ?>
                                       
                               
                              </tbody>
                            </table>
                          </div>
                          
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>
             
             
             
             
             
             <?php } else { ?>
             
             
                 <div class="row mb-2">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-4">Transactions</h5>
                 
             
             
                            <div class="row d-flex align-items-center justify-items-center flex-column">
                                 <h3 class="card-title text-muted">There is no transactions yet</h3>
                                </div>
                                
                               <div class="row d-flex align-items-center justify-content-center flex-column">
                                    <label class="card-title text-muted text-center">
                                        You have not purchased any cards.
                                    </label>
                                </div>
             
             
                        </div>
                      </div>
                    </div>
                  </div>
             
             

                
            <?php } ?>
             
             
             
                             
             
        </div>
        
        
        
        
        
           
        
        
          
        
        
        
       <iframe id="printFrame" style="display: none;" title="CustomFileName"></iframe> 
      
           <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 mb-4 d-none" style="height: 208px;width: 100%;background-color:transparent" id="dwdCard">
               <div class="card" id="activeImageUrl" style=" background-size: cover; background-position: center;width: 100% !important;height: 100% !important;">
                  <div class="card-body" style="padding-top: 20px; !important">
                     <div class="clearfix"><b class=" float-right text-white" style="padding-right: 27px;padding-top: 0px;" id="activeUserName"></b></div>
                     <h4 class="card-title font-weight-normal text-warning" style="padding-top: 66px;padding-left: 75px;" id="activeName"></h4>
                     <h5 class="card-title font-weight-normal text-white displayCardNumber1" id="activeNumber"></h5>
                     <h6 class="card-title font-weight-normal text-white displayExpDate1" id="activeExp"></h6>
                  </div>
               </div>
            </div>
                            
       
<?php
   
include("footer.php");
?>



 <script>
    document.getElementById("menu1").classList.remove("active");
    document.getElementById("menu2").classList.remove("active");
    document.getElementById("menu3").classList.remove("active");
    document.getElementById("menu4").classList.add("active");
    document.getElementById("menu5").classList.remove("active");
    document.getElementById("menu8").classList.remove("active");
    
    
    var purchaseNowId = '';
    var purchaseCardType = 0;
    var purchaseCardNumber = '';
    
    var totalItemPrice = 0;
    var ItemDiscount = 0;
    var ItemTotalAmount = 0;
    var Itemsave = 0;
    var cardValid = 0;
    
    var numberOfServicesUse = 0;
    
    
    function purchaseNow(){
        
        var user_id = '<?=$user_id?>';
        var stateName = '<?=$stateName?>';
        var isSte = 0;
        if(stateName == 'Kerala' || stateName == 'kerala') isSte = 1;
        
      
   
        var postData = {
            function: 'AlbumSubscription',
            method: "userCardPlaceOrderNow",
            'purchaseNowId': purchaseNowId,
            'user_id':user_id,
            'totalItemPrice': totalItemPrice,
            'ItemDiscount': ItemDiscount,
            'ItemTotalAmount': ItemTotalAmount,
            'Itemsave': Itemsave,
            'exp':cardValid,
            'CN':purchaseCardNumber,
            'purchaseCardType':purchaseCardType,
            'CardServices':numberOfServicesUse,
            'isSte':isSte,
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
                window.location.href = 'purchase-card.php?purchaseID='+data.data;
           
            }
           
        },
        error: function (x,h,r) {
        //called when there is an error
            console.log(x);
            console.log(h);
            console.log(r);
           
        }
    });
        
        
        
        
        
        
        // window.location.href = 'place-order.php?purchaseID='+purchaseNowId;
    }
    
    
    
    
    function showCardBenfits(cardName,cardId,purchaseId,isUpdate,cardNumber="" ){
        
        var userHaveEvent = '<?=$userHaveEvent?>';
        
        
        $('#cardName').html(cardName);
        $('#cardNameBenfits').html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getCardServicesList",
            cardId: cardId,
           
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                    
                    purchaseNowId = purchaseId;
                    purchaseCardType = isUpdate;
                    purchaseCardNumber = cardNumber;
                    
                    
                    if(isUpdate == 0){
                        
                        if(userHaveEvent == 0){
                            
                            var exp = data.data[0]['exp'];
                            var amount = 0;
                            var discout = 0;
                            var discout_type = 1;
                            
                            
                            var act_amount = data.data[0]['amount'];
                            var act_discout = data.data[0]['discout'];
                            var act_discout_type = data.data[0]['discout_type'];
                            if(act_discout_type == 1) act_amount = parseInt(act_amount) - parseInt(act_discout);
                            else {
                                var dctat1 = ( parseInt(act_amount) / 100 ) * parseInt(act_discout);
                                act_amount = (parseInt(act_amount) - dctat1).toFixed(2);
                            }
                            
                            
                            var guestuser_additional_amt = data.data[0]['guestuser_additional_amt'];
                            var guestuser_additional_amt_type = data.data[0]['guestuser_additional_amt_type'];
                            
                            if(guestuser_additional_amt_type == 1) act_amount = parseInt(guestuser_additional_amt) + parseInt(act_amount) ;
                            else {
                                var dctat = (( parseInt(act_amount) / 100 ) * parseInt(guestuser_additional_amt)).toFixed(2);
                                act_amount = parseInt(act_amount) + parseInt(dctat);
                            }
                            
                            
                            amount = parseInt(data.data[0]['amount']) + parseInt(data.data[0]['guestuser_additional_amt']) ;
                            discout = parseInt(amount) - parseInt(act_amount);
                         
                            
                            
                        }else{
                            var amount = data.data[0]['amount'];
                            var discout = data.data[0]['discout'];
                            var discout_type = data.data[0]['discout_type'];
                            var exp = data.data[0]['exp'];
                        }
                        
                       
                        
                        cardValid = exp;
                        
                        totalItemPrice = amount;
                        
                        var displayData = '';
                        displayData +='Card valid for <b>'+exp+' year</b><hr>';
                        
                        displayData +='<h5>Benfits of cards</h5>';
                        displayData +='You can use <b>'+data.data[0]['number_of_service']+' services</b><br>';
                        
                        
                        
                        displayData +=data.data[0]['description'];
                        displayData +='<hr>';
                        displayData +='<h5>Price details</h5>';
                        
                        
                        if(discout_type == 1) displayData +='<h6 class="card-subtitle text-success" >You save ₹'+discout+' on this card </h6>';
                        else displayData +='<label class="card-subtitle text-success" >You save '+discout+'% off on this card</label>';
                        var payablePrice = 0;
                        if(discout_type == 1){
                            ItemDiscount = parseInt(discout);
                            payablePrice = parseInt(amount) - parseInt(discout);
                        }else{
                            ItemDiscount = ( ( parseInt(amount) / 100 ) * parseInt(discout) ).toFixed(2) ;
                            payablePrice = (parseInt(amount) - ( ( parseInt(amount) / 100 ) * parseInt(discout) )).toFixed(2) ;
                        }
                        
                        ItemTotalAmount = payablePrice;
                        Itemsave = ItemDiscount;
                        
                        displayData +='<h4 class="text-black " style="text-align: left !important;margin-bottom: 0.3rem !important;">';
                        displayData +='<span class="mr-3" >₹ '+payablePrice+' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ '+amount+'</del></span>';
                        displayData +='</h4>';
                        
                        
                        numberOfServicesUse = data.data[0]['number_of_service'];
                        
                        
                        
                    }else if(isUpdate == 2){
                        
                        
                        if(userHaveEvent == 0){
                            
                            var exp = data.data[0]['exp'];
                            var amount = 0;
                            var discout = 0;
                            var discout_type = 1;
                            
                            
                            var act_amount = data.data[0]['amount'];
                            var act_discout = data.data[0]['discout'];
                            var act_discout_type = data.data[0]['discout_type'];
                            if(act_discout_type == 1) act_amount = parseInt(act_amount) - parseInt(act_discout);
                            else {
                                var dctat1 = ( parseInt(act_amount) / 100 ) * parseInt(act_discout);
                                act_amount = (parseInt(act_amount) - dctat1).toFixed(2);
                            }
                            
                            
                            var guestuser_additional_amt = data.data[0]['guestuser_additional_amt'];
                            var guestuser_additional_amt_type = data.data[0]['guestuser_additional_amt_type'];
                            
                            if(guestuser_additional_amt_type == 1) act_amount = parseInt(guestuser_additional_amt) + parseInt(act_amount) ;
                            else {
                                var dctat = (( parseInt(act_amount) / 100 ) * parseInt(guestuser_additional_amt)).toFixed(2);
                                act_amount = parseInt(act_amount) + parseInt(dctat);
                            }
                            
                            
                            amount = parseInt(data.data[0]['amount']) + parseInt(data.data[0]['guestuser_additional_amt']) ;
                            discout = parseInt(amount) - parseInt(act_amount);
                         
                            
                            
                        }else{
                            var amount = data.data[0]['amount'];
                            var discout = data.data[0]['discout'];
                            var discout_type = data.data[0]['discout_type'];
                            var exp = data.data[0]['exp'];
                        }
                        
                       
                        
                        cardValid = exp;
                        
                        totalItemPrice = amount;
                        
                        var displayData = '';
                        displayData +='Card valid for <b>'+exp+' year</b><hr>';
                        
                        displayData +='<h5>Benfits of cards</h5>';
                        displayData +='You can use <b>'+data.data[0]['number_of_service']+' services</b><br>';
                        
                        
                        
                        displayData +=data.data[0]['description'];
                        displayData +='<hr>';
                        displayData +='<h5>Price details</h5>';
                        
                        
                        if(discout_type == 1) displayData +='<h6 class="card-subtitle text-success" >You save ₹'+discout+' on this card </h6>';
                        else displayData +='<label class="card-subtitle text-success" >You save '+discout+'% off on this card</label>';
                        var payablePrice = 0;
                        if(discout_type == 1){
                            ItemDiscount = parseInt(discout);
                            payablePrice = parseInt(amount) - parseInt(discout);
                        }else{
                            ItemDiscount = ( ( parseInt(amount) / 100 ) * parseInt(discout) ).toFixed(2) ;
                            payablePrice = (parseInt(amount) - ( ( parseInt(amount) / 100 ) * parseInt(discout) )).toFixed(2) ;
                        }
                        
                        ItemTotalAmount = payablePrice;
                        Itemsave = ItemDiscount;
                        
                        displayData +='<h4 class="text-black " style="text-align: left !important;margin-bottom: 0.3rem !important;">';
                        displayData +='<span class="mr-3" >₹ '+payablePrice+' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ '+amount+'</del></span>';
                        displayData +='</h4>';
                        
                        
                        numberOfServicesUse = data.data[0]['number_of_service'];
                        
                        
                        
                        
                        
                    }
                    
                    $('#cardNameBenfits').html(displayData);
                    
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        

        $('#viewCards').removeClass('d-none');
        $('#listCards').addClass('d-none');

         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
   
    }
    
    
    function closeCardBenfits(){

        $('#viewCards').addClass('d-none');
        $('#listCards').removeClass('d-none');

         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'auto', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'start' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
    
        
    }
    
    
     function printNow(id){
        const iframe = document.getElementById("printFrame");
        iframe.src = "/dwd-card-invoice.php?purchaseID="+id;
     
        iframe.onload = function() {
            // Wait for the iframe to load, then trigger the print dialog
            iframe.contentWindow.print();
        };
    }
    
    function downloadNow(id,newpurchaseID){
         const iframe = document.getElementById("printFrame");
            iframe.src = "/dwd-card-invoice-pdf.php?purchaseID="+id;

            iframe.onload = function() {
                const content = iframe.contentDocument.body;
                const options = {
                    margin: 1,
                    filename: 'Invoice_'+newpurchaseID+'.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                };
                
               
                // // New Promise-based usage:
                // html2pdf().set(options).from(content).save();
                
                // Old monolithic-style usage:
                html2pdf(content, options);
               
             
            };
    }
    
    
    
     
  

    </script>