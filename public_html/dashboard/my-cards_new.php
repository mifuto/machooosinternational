 <?php
 include("header.php");
 
 if(!$isWeddingUser){
      echo "<script type='text/javascript'>
        // Your JavaScript code here
        window.location.href = '/dashboard';
    </script>";

die;
}
 
 $sql1 = "SELECT b.country,c.id as state_id,d.id as city_id,a.firstname,a.lastname FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblstate c on b.state = c.state left join tblcity d on d.city = b.city WHERE a.id='$user_id' "; 

    
$result1 = $DBC->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

$userCountry = $row1['country'];
$userState = $row1['state_id'];
$userCity = $row1['city_id'];
$userName = strtoupper($row1['firstname']." ".$row1['lastname']);

    
$Cards = [];

 
$sql3 = "SELECT a.*,b.CardName  FROM tblsubcards a left join tbl_cards b on a.card_id=b.id WHERE a.state_id='$userState' AND FIND_IN_SET($userCity, a.city_id) AND a.active=0 AND b.delete=0 order by amount asc ";

$result3 = $DBC->query($sql3);

$count3 = mysqli_num_rows($result3);

if($count3 > 0) {		
    while ($row3 = mysqli_fetch_assoc($result3)) {
        array_push($Cards,$row3);
      
    }
}



$ordersData = [];
 
 $sqlcart = "SELECT * FROM place_order_card WHERE user_id=".$user_id." and newpurchaseID !='' order by id desc";


$resultcart = $DBC->query($sqlcart);
$countcart = mysqli_num_rows($resultcart);

if($countcart > 0) {		
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        array_push($ordersData,$rowcart);
    }
}


$isCardReqSnt = false;
$cardReqStatus = 4;


$sqlcartreq = "SELECT * FROM card_request WHERE user_id=".$user_id." AND created_date >= CURDATE() - INTERVAL 3 MONTH order by id desc";


$resultcartreq = $DBC->query($sqlcartreq);
$countcartreq = mysqli_num_rows($resultcartreq);

if($countcartreq > 0) {	
    $rowcart = mysqli_fetch_assoc($resultcartreq);
    $isCardReqSnt = true;
    $cardReqStatus = $rowcart['status'];
    
}

$ordersServiceData = [];
 
 $sqlscart = "SELECT ccr.*,z.short_name as country,cct.city,cct.state,tc.CardName,poc.card_number,tcs.CardService FROM card_service_used ccr left join place_order_card poc on poc.id=ccr.order_id left join tblsubcards tsc on tsc.id=poc.card_id left join tbl_cards tc on tc.id=tsc.card_id left join tbl_card_services tcs on tcs.id=ccr.service_id left join tblcontacts a on ccr.user_id = a.id left join tblclients cct on cct.userid = a.userid left join tblcountries z on z.country_id = cct.country where a.id='$user_id' ORDER BY ccr.id desc";


$resultscart = $DBC->query($sqlscart);
$countscart = mysqli_num_rows($resultscart);

if($countscart > 0) {		
    while ($rowscart = mysqli_fetch_assoc($resultscart)) {
        array_push($ordersServiceData,$rowscart);
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
                                        
                                        <button type="button" class="btn btn-success btn d-none" onclick="purchaseNow();" id="purchaseBtn">
                                          Purchase now
                                        </button>
                                        
                                        <button type="button" class="btn btn-success btn d-none" onclick="requestNow();" id="requestBtn">
                                          Request now
                                        </button>
                                        
                                       
                                      </div>
                                      
                                      
                                      
                                    </div>
                          
                          
                        </div>
                    </div>
                 </div>
              
            </div>
            
            <div class="row mb-2 d-none" id="viewCard">
                <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-4">Card Details</h5>
                          <hr>
                          
                            <div class="row">
                                
                                <div class="col-12">
                                    <h4>
                                      <span class="badge bg-primary" id="disCardName"></span>
                                    </h4>
                                
                                </div>
                                
                                
                            </div>
                          
                                    <div >
                                      <div class="d-flex justify-content-center align-items-center my-3">
                                        
                                        
                                        <p class="pt-3 mx-4" id="disCardNameBenfits">
                                        </p>
                                        
                                      </div>
                                      
                                      <div class="d-flex justify-content-center align-items-center my-3">
                                          
                                     
                                          
                                        <button type="button" class="btn btn-info btn mr-2" onclick="closeCardBenfits();" data-mdb-ripple-init="" data-mdb-dismiss="modal" style="">
                                          Cancel
                                        </button>
                                        
                                        <button type="button" class="btn btn-success btn " onclick="downloadCard();" >
                                          Download card
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
                      <h5 class="card-title mb-4">Active cards</h5>
                      
                      
                                <?php if(count($userWeddingDatas) > 0) { ?>
                                
                                
                                    <div >
                                
                                        <?php
                                            foreach ($userWeddingDatas as $key => $userWed) { 
                                                $userEventStartDate = $userWed['start_date'];
                                                $userEventName = $userWed['name'];
                                                $userEventID = $userWed['id'];

                                                // Create a DateTime object from the input string
                                                $userEventdate = new DateTime($userEventStartDate);
                                                
                                                // Format the date as 'd M Y'
                                                $formatteduserEventDate = $userEventdate->format('d M Y');
                                                
                                                
                                                
                                                $isCardPurchase = false;
                                                $purchaseCardNumber = '';
                                                $purchaseTotalAmount = '';
                                                $purchaseCardExp = false;
                                                
                                                
                                                $sqlPc = "SELECT a.id,a.numberOfItemsTotalAmount,a.card_number FROM place_order_card a left join tblsubcards b on a.card_id=b.id left join tbl_cards c on b.card_id = c.id WHERE a.razorpay_payment_status=1 AND a.completed=1 AND a.isNew=1 AND a.user_id='$user_id' AND a.prj_event_id='$userEventID' AND b.state_id='$userState' AND FIND_IN_SET($userCity, b.city_id) AND c.delete=0 ";
                                                $resultPc = $DBC->query($sqlPc);
                                                $countPc = mysqli_num_rows($resultPc);
                                                if($countPc > 0) {	
                                                    $isCardPurchase = true;
                                                    $rowPc = mysqli_fetch_assoc($resultPc);
                                                    $purchaseCardNumber = $rowPc['card_number'];
                                                    $purchaseTotalAmount = $rowPc['numberOfItemsTotalAmount'];
                                                    
                                                }
                                                
                                                
                                                
                                                $userPurchasedServices ='';
                                                $userPurchasedOrderId = '';
                                                $activeCardPurchaseServiceRec = '';
                                                $numberOfServicesDigits = 0;


                                                
                                           
                                                
                                        ?>
                                        <hr>
                                        
                                        <div class="row" style="padding-bottom: 12px;">
                                            
                                            <div class="col-12" >
                                                <b class="card-title mb-4"><?=$userEventName?> - <?=$formatteduserEventDate?></b>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                                <?php if(count($Cards) > 0) { ?>
                                                  
                                                    <div class="row">
                                                        
                                                            <?php
                                                            
                                                                $isPurchaseable = false;
                                                            
                                                            
                                                                foreach ($Cards as $key => $card) { 
                                                                
                                                        			$id = $card['id'];
                                                        			$exp = $card['exp']." year";
                                                        			
                                                        			$timestamp = time();
                                                        		    $decodeId = base64_encode($timestamp . "_".$id);
                                                        		    $decodeId = str_rot13($decodeId);
                                                        		    
                                                        		    $psql = "SELECT * FROM place_order_card WHERE razorpay_payment_status=1 AND completed=1 AND isNew=1 AND card_id='$id' AND user_id='$user_id' AND prj_event_id='$userEventID' ";
                                                        		    $presult = $DBC->query($psql);

                                                                    $pcount = mysqli_num_rows($presult);
                                                                    if($pcount > 0){ 
                                                                        $isPurchaseable = true;
                                                                    }
                                                                    
                                                                
                                                                
                                                                ?>
                                                                
                                                                
                                                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 mb-4" style="height: 208px;width: 100%;" id="card_<?=$id?>">
                                                                    
                                                                    
                                                                    <?php if($isCardPurchase > 0){ ?>
                                                                    
                                                                    
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
                                                                                    
                                                                                    $userPurchasedServices = $prow1['card_services'];
                                                                                    $userPurchasedOrderId = $prow1['id'];
                                                                                    
                                                                                    $numberSArray = explode(',', $userPurchasedServices);
                            
                                                                                    $numberOfServicesDigits = count($numberSArray);
                                                                                    
                                                                                    
                                                                                    $sql412 ="SELECT * FROM `card_service_used` WHERE active=0 and order_id='$userPurchasedOrderId' ";
                                                                                    $presult412 = $DBC->query($sql412);
                            
                                                                                    $activeCardPurchaseServiceRec = mysqli_num_rows($presult412);
                                                                                    
                                                                                    $invoice_snt = $prow1['invoice_snt'];
                                                                                    $invoice_snt_id = $prow1['id'];
                                                                                    if ($invoice_snt == 0) {
                                
                                                                                       echo "<script type='text/javascript'>
                                                                                       setTimeout(function() {
                                                                                            sendInvoice($invoice_snt_id);
                                                                                        }, 20000);
                            
                                                                                    </script>";
                                                                                    
                                                                                    }
                            
                                                                                ?>
                                                                                
                                                                                
                                                                                
                                                                                        <?php if($activeCardPurchaseServiceRec == $numberOfServicesDigits){ ?>
                                                                                            <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;" >
                                                                                        
                                                                                        <?php }else{ ?>
                                                                                        
                                                                                           
                                                                                            <?php if($isExp){ ?>
                                                                                            
                                                                                            <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;" >
                                                                                            
                                                                                            <?php }else{ ?>
                                                                                            
     
                                                                                            
                                                                                            <div onclick="showCardDetails(`<?=strtoupper($card['CardName'])?>`,<?=$id?>,'<?=$userPurchasedServices?>',`<?=$userPurchasedOrderId?>`,`<?=$activeImageUrl?>`,`<?=$activeUserName?>`,`<?=$activeName?>`,`<?=$activeNumber?>`,`<?=$activeExp?>`)" class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;" >
                                                                                            
                                                                                            <?php } ?>
                                                                                            
                                                                                        <?php } ?>
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                            
                                                                                            <div class="card-body" style="padding-top: 20px; !important">
                                                                                                   <div class="clearfix" >
                                                                                                           <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                                                                  </div>
                                                                                                  <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['CardName'])?></h4>
                                                                                                  <h5 class="card-title font-weight-normal text-white displayCardNumber" ><?=$cardNumber?></h5>
                                                                                                  <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=$cardExp?></h6>
                                                                                                  
                                                                                                  
                                                                                                  
                                                                                             
                                                                                            </div>
                                                                                      
                                                                                        </div>
                                                                                        
                                                                                        
                                                                                        
                                                                                        <?php if($activeCardPurchaseServiceRec == $numberOfServicesDigits){ ?>
                                                                                            <div style="position: absolute; top: 50%; left: 62%; transform: translate(-50%, -50%);">
                                                                                                <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                                                            </div>
                                                                                        
                                                                                        <?php }else{ ?>
                                                                                        
                                                                                            <?php if($isExp){ ?>
                                                                                            
                                                                                              <!-- Add a centered button -->
                                                                                                <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                                                                    <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                                                                </div>
                                                                                                <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                                                                    <button class="btn btn-light " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['CardName'])?>`,<?=$id?>,`<?=$decodeId?>`,1,`<?=$userEventID?>`,`<?=$userEventStartDate?>`,`<?=$purchaseCardNumber?>`,`<?=$userPurchasedServices?>`,`<?=$userPurchasedOrderId?>`,`<?=$activeCardPurchaseServiceRec?>`);">activate card</button>
                                                                                                </div>
                                                                                                
                                                                                            <?php } ?>
                                                                                            
                                                                                        <?php } ?>
                                                                                
                                                                                
                                                                                
                                                                                    
                                                                                <?php }else{ ?>
                                                                                
                                                                                
                                                                                
                                                                                    <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;">
                                                                                        <!--opacity: .3;-->
                                                                                        
                                                                                        <div class="card-body" style="padding-top: 20px; !important">
                                                                                               <div class="clearfix" >
                                                                                                       <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                                                              </div>
                                                                                              <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['CardName'])?></h4>
                                                                                              <h5 class="card-title font-weight-normal text-white displayCardNumber" >0000 0000 0000 0000</h5>
                                                                                              <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=strtoupper($exp)?></h6>
                                                                                              
                                                                                              
                                                                                              
                                                                                         
                                                                                        </div>
                                                                                  
                                                                                    </div>
                                                                                    <!-- Add a centered button -->
                                                                                        <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                                                            <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                                                        </div>
                                                                                        <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                                                            <button class="btn btn-dark " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['CardName'])?>`,<?=$id?>,`<?=$decodeId?>`,2,`<?=$userEventID?>`,`<?=$userEventStartDate?>`,`<?=$purchaseCardNumber?>`,`<?=$userPurchasedServices?>`,`<?=$userPurchasedOrderId?>`,`<?=$activeCardPurchaseServiceRec?>`,`<?=$purchaseTotalAmount?>`,`<?=$purchaseCardExp?>`);">upgrade card</button>
                                                                                        </div>
                                                                                        
                                                                                     
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                    
                                                                                <?php } ?>
                                                                                    
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        <?php }else{ ?>
                                                                        
                                                                             <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;">
                                                                                    <!--opacity: .3;-->
                                                                                    
                                                                                    <div class="card-body" style="padding-top: 20px; !important">
                                                                                           <div class="clearfix" >
                                                                                                   <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                                                          </div>
                                                                                          <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['CardName'])?></h4>
                                                                                          <h5 class="card-title font-weight-normal text-white displayCardNumber" >0000 0000 0000 0000</h5>
                                                                                          <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=strtoupper($exp)?></h6>
                                                                                          
                                                                                          
                                                                                          
                                                                                     
                                                                                    </div>
                                                                              
                                                                                </div>
                                                                                <!-- Add a centered button -->
                                                                                    <div style="position: absolute; top: 50%; left: 62%; transform: translate(-50%, -50%);">
                                                                                        <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                                                    </div>
                                                                                   
                                                                                   
                                                                        <?php } ?>
                                                                        
                                                                    
                                                                    
                                                                    
                                                                    <?php }else{ ?>
                                                                    
                                                                    
                                                                         <div class="card" style="background-image: url('/admin/<?= $card['image'] ?>'); background-size: cover; background-position: center;width: 100% !important;height: 100% !important;opacity: .3;">
                                                                                <!--opacity: .3;-->
                                                                                
                                                                                <div class="card-body" style="padding-top: 20px; !important">
                                                                                       <div class="clearfix" >
                                                                                               <b class=" float-right text-white"  style="padding-right: 27px;padding-top: 0px;"><?=$userName?></b>
                                                                                      </div>
                                                                                      <h4 class="card-title font-weight-normal text-warning" style="padding-top: 62px;padding-left: 65px;"><?=strtoupper($card['CardName'])?></h4>
                                                                                      <h5 class="card-title font-weight-normal text-white displayCardNumber" >0000 0000 0000 0000</h5>
                                                                                      <h6 class="card-title font-weight-normal text-white displayExpDate" ><?=strtoupper($exp)?></h6>
                                                                                      
                                                                                      
                                                                                      
                                                                                 
                                                                                </div>
                                                                          
                                                                            </div>
                                                                            <!-- Add a centered button -->
                                                                                <div style="position: absolute; top: 45%; left: 62%; transform: translate(-50%, -50%);">
                                                                                    <img class="text-white" src="images/icons/lock-white.png" alt="" style="width: 30%;height: 30%;">
                                                                                </div>
                                                                                <div style="position: absolute; bottom: 20%; left: 50%; transform: translateX(-50%);">
                                                                                    <button class="btn btn-light " style="border-radius: 30%;" onclick="showCardBenfits(`<?=strtoupper($card['CardName'])?>`,<?=$id?>,`<?=$decodeId?>`,0,`<?=$userEventID?>`,`<?=$userEventStartDate?>`,`<?=$purchaseCardNumber?>`,`<?=$userPurchasedServices?>`,`<?=$userPurchasedOrderId?>`,`<?=$activeCardPurchaseServiceRec?>`);">view details</button>
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
                            
                                                                       
                                                  
                                                  
                                                  
                                                  <?php }?>
                                        
                                        
                                        
                                        
                                        
                                        <?php } ?>
                                        
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
                          <div class="table-responsive mb-2">
                            <table class="table center-aligned-table" >
                                
                              <thead>
                                <tr class="text-primary">
                                  <th>No</th>
                                  <th>Transaction ID</th>
                                  <th>Card Name</th>
                                  <th>Card Number</th>
                                  <th>Card Validity</th>
                                  <th>Benfits</th>
                                
                                  <th>Orginal Price</th>
                                  <th>Discount</th>
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
                                                    
                                                    $card_number = $album['card_number'];
                                                    $exp_date = $album['exp_date'];
                                                    
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
                                                        		$sqlcard = "SELECT a.*,b.CardName  FROM tblsubcards a left join tbl_cards b on a.card_id=b.id WHERE a.id='$card_id' ";
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
                                                  
                                                  <td><?=$rowcard['CardName']?> <?=$crdtyd?></td>
                                                  <td><?=$card_number?></td>
                                                  <td><?=$isExpDay?></td>
                                                  
                                                  <td><a onclick="showTableCardDetails(`<?=strtoupper($rowcard['CardName'])?>`,<?=$rowcard['id']?>,<?=$album['id']?>);" role="button" class="text-primary">
                                                             View
                                                          </a></td>
                                                 
                                                  
                                                  
                                                  <td>₹<?=$numberOfItemsPrice?></td>
                                                  <td>-₹<?=$numberOfItemsDiscount?></td>
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
                          
                          
                          
                           <div class="mb-2 d-none mt-4" id="viewTableCard">
                                  <h5 class="card-title mb-4">Card Details</h5>
                                 
                                  
                                            <div >
                                              <div class="d-flex justify-content-center align-items-center my-3">
                                                
                                                
                                                <p class="pt-3 mx-4" id="disCardNameBenfits2">
                                                </p>
                                                
                                              </div>
                                              
                                              <div class="d-flex justify-content-center align-items-center my-3" >
                                                  
                                             
                                                  
                                                <button type="button" class="btn btn-info btn mr-2" id="main-card-div2" onclick="closeTableCardBenfits();" data-mdb-ripple-init="" data-mdb-dismiss="modal" style="">
                                                  Cancel
                                                </button>
                                                
                                            
                                               
                                              </div>
                                              
                                              
                                              
                                            </div>
                                  
                                  
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
            
            
            
            
            
            
            <?php if(count($ordersServiceData) > 0) { ?>
            
            
            
            
             <div class="row mb-2">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title mb-4">Used services</h5>
                          <div class="table-responsive mb-2">
                            <table class="table center-aligned-table" >
                                
                              <thead>
                                <tr class="text-primary">
                                  <th>No</th>
                                  <th>Card Name</th>
                                  <th>Card Number</th>
                                  <th>Service</th>
                                  <th>Description</th>
                                  <th>Created</th>
                                </tr>
                              </thead>
                              
                              <tbody>
                                  
                                  <?php 
                                      $i =0;
                                                foreach ($ordersServiceData as $key => $album) { 
                                                    $i++;
                                                    
                                                    $CardName = $album['CardName'];
                                                    $card_number = $album['card_number'];
                                                    $CardService = $album['CardService'];
                                                    $description = $album['description'];
                                                    
                                                  
                                                     $planExpDate1 = new DateTime($album['created_date']);

                                                    // Get year, month, and day part from the date
                                                    $year1 = $planExpDate1->format('Y');
                                                    $month1 = $planExpDate1->format('n');
                                                    $day1 = $planExpDate1->format('d');
                                                    
                                                    // Assuming $monthNames is an array with month names
                                                    $monthNames1 = array(
                                                        "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                    );
                                                    
                                                    $created_date = $day1 . ' ' . $monthNames1[$month1 - 1] . ' ' . $year1;
                                               
                                                                
                                            ?>
                                  
                                  
                                                <tr class="">
                                                  <td><?=$i?></td>
                                                  <td><?=$CardName?></td>
                                                  <td><?=$card_number?></td>
                                                  <td><?=$CardService?></td>
                                                  <td><?=$description?></td>
                                                  <td><?=$created_date?></td>
                                                  
                                                
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
                          <h5 class="card-title mb-4">Used services</h5>
                 
             
             
                            <div class="row d-flex align-items-center justify-items-center flex-column">
                                 <h3 class="card-title text-muted">There is no services used yet</h3>
                                </div>
                                
                               <div class="row d-flex align-items-center justify-content-center flex-column">
                                    <label class="card-title text-muted text-center">
                                        You have not used any services.
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
     var purchaseUserEventID = '';
     var purchaseCardNumber = '';
    
    var totalItemPrice = 0;
    var ItemDiscount = 0;
    var ItemTotalAmount = 0;
    var Itemsave = 0;
    var cardValid = 0;
    
    
    var purchaseValidNumber = 0;
    var purchaseValidNumberType = 0;
    var isNotPurchaseable = true;
    
    var purchaseCardServicesIds = '';
    var availableServices = '';
    
    
    
      var activeImageUrl = '';
        var activeUserName = '';
        var activeName = '';
        var activeNumber = '';
        var activeExp = '';
   
    
   
    
    function sendInvoice(purchaseID){
            var user_id = '<?=$user_id?>';
         
             var postData = {
                function: 'AlbumSubscription',
                method: "sendCardInvoice",
                'purchaseID': purchaseID,
                'user_id': user_id,
               
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
                        // alert('mail send');
    
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
    
    
   
    function downloadCard(){
        
        
      
        
        $('#dwdCard').removeClass('d-none');
        
      
        $('#activeUserName').html(activeUserName);
        $('#activeName').html(activeName);
        $('#activeNumber').html(activeNumber);
        $('#activeExp').html(activeExp);
        $('#activeImageUrl').css('background-image', 'url("' + activeImageUrl + '")');
        

        
        var content = document.getElementById('dwdCard');

        html2canvas(content, { useCORS: true, scale: 2 }).then(function(canvas) {
            // Convert canvas to data URL with higher quality JPEG format
            var dataUrl = canvas.toDataURL("image/png", 1.0);
        
            // Create a link element for download
            var downloadLink = document.createElement("a");
            downloadLink.href = dataUrl;
            downloadLink.download = "Mi_privilege_card.png";  // Change the file name if needed
        
            // Append the link to the document and trigger a click
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        });

        
        $('#dwdCard').addClass('d-none');

      
        
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
    
    
    function requestNow(){
        if(!isNotPurchaseable) return false;
        
        var user_id = '<?=$user_id?>';
        
         var postData = {
            function: 'AlbumSubscription',
            method: "sendCardRequest",
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
                    location.reload();
               
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
    
    function purchaseNow(){
        
        if(isNotPurchaseable) return false;
        
        var user_id = '<?=$user_id?>';

   
        var postData = {
            function: 'AlbumSubscription',
            method: "cardPlaceOrderNow",
            'purchaseNowId': purchaseNowId,
            'user_id':user_id,
            'totalItemPrice': totalItemPrice,
            'ItemDiscount': ItemDiscount,
            'ItemTotalAmount': ItemTotalAmount,
            'Itemsave': Itemsave,
            'exp':cardValid,
            'CN':purchaseCardNumber,
            'purchaseCardType':purchaseCardType,
            'CardServices':availableServices,
            'purchaseUserEventID':purchaseUserEventID,
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
    
    
    
    function closeTableCardBenfits(){

        $('#viewTableCard').addClass('d-none');
       
        
         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'auto', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'start' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
    
        
    }
    
    function closeCardBenfits(){

        $('#viewCards').addClass('d-none');
        $('#listCards').removeClass('d-none');
        $('#viewCard').addClass('d-none');
        
        $('#dwdCard').addClass('d-none');
        
        
        
         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'auto', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'start' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
    
        
    }
    
    
    
    function showTableCardDetails(cardName,cardId,order_id){
        
        $('#disCardNameBenfits2').html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getCardBenfits",
            cardId: cardId,
           
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
                    
                    var exp = data.data[0]['exp'];
                    var displayData = '';
                    displayData +='Card valid for <b>'+exp+' year</b><hr>';
                    
                     displayData +='<h5>Offer card-related services.</h5>';
                     displayData +='<div id="displayAllCardServices3"></div>';
                     
                     
                    getDisplayAllCardServicesForCard3(order_id,'displayAllCardServices3');

                    
                    displayData +='<hr>';
                    
                    
                    
                    
                    displayData +='<h5>Benfits of cards</h5>';
                    displayData +=data.data[0]['description'];
                   
                    $('#disCardNameBenfits2').html(displayData);
                  
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        

        $('#viewTableCard').removeClass('d-none');
        $('#main-card-div2').focus();
        
        
    }
    
    function showCardDetails(cardName,cardId,userPurchasedServices,userPurchasedOrderId,activeImageUrlVal,activeUserNameVal,activeNameVal,activeNumberVal,activeExpVal){
        
        
        
        activeImageUrl = activeImageUrlVal;
        activeUserName = activeUserNameVal;
        activeName = activeNameVal;
        activeNumber = activeNumberVal;
        activeExp = activeExpVal;
        
        
        
        
        
        
        
          $('#disCardName').html(cardName);
        $('#disCardNameBenfits').html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getCardBenfits",
            cardId: cardId,
           
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
                    
                    var exp = data.data[0]['exp'];
                    var displayData = '';
                    displayData +='Card valid for <b>'+exp+' year</b><hr>';
                    
                    displayData +='<h5>Offer card-related services.</h5>';
                    displayData +='<div id="displayAllCardServices1"></div>';
                         
                    getDisplayAllCardServicesForCard(userPurchasedServices,'displayAllCardServices1',userPurchasedOrderId);

                        
                    displayData +='<hr>';
                    
                    displayData +='<h5>Benfits of cards</h5>';
                    displayData +=data.data[0]['description'];
                   
                    $('#disCardNameBenfits').html(displayData);
                  
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        

        $('#viewCards').addClass('d-none');
        $('#listCards').addClass('d-none');
        $('#viewCard').removeClass('d-none');
        
         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
        
    }
    
    function showCardBenfits(cardName,cardId,purchaseId,isUpdate,userEvtID,isWeddingUserDate,purchaseCardNumber,userPurchasedServices,userPurchasedOrderId,activeCardPurchaseServiceRec,purchaseTotalAmount='',purchaseCardExp=''){
        
        $('#purchaseBtn').addClass('d-none');
        $('#requestBtn').addClass('d-none');
       
        
        $('#cardName').html(cardName);
        $('#cardNameBenfits').html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getCardBenfits",
            cardId: cardId,
           
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
                    
                    purchaseNowId = purchaseId;
                    purchaseCardType = isUpdate;
                    availableServices = '';
                    purchaseUserEventID = userEvtID;
                    purchaseCardNumber = purchaseCardNumber;
                    
                    purchaseValidNumber = parseInt(data.data[0]['CardPurchase']);
                    purchaseValidNumberType = data.data[0]['CardPurchaseType'];
                    
                    var cardServicesIds = data.data[0]['sel_services'];
                    purchaseCardServicesIds = data.data[0]['sel_services'];
                    
                    if(isUpdate == 2){
                      
                        
                        var amount = data.data[0]['amount'];
                        var discout = data.data[0]['discout'];
                        var discout_type = data.data[0]['discout_type'];
                        var exp = data.data[0]['exp'];
                        
                        cardValid = exp;
                        
                        totalItemPrice = amount;
                        
                        var displayData = '';
                        displayData +='Card valid for <b>'+exp+' year</b><hr>';
                        displayData +='<h5>Offer card-related services.</h5>';
                        displayData +='<div id="displayAllCardServices"></div>';
                        getDisplayAllCardServices(cardServicesIds,'displayAllCardServices');
                        availableServices = cardServicesIds;
                        
                        
                        displayData +='<hr>';
                        displayData +='<h5>Benfits of cards</h5>';
                        displayData +=data.data[0]['description'];
                        displayData +='<hr>';
                        displayData +='<h5>Price details</h5>';
                        

                         if(purchaseCardExp == 1 || activeCardPurchaseServiceRec > 0 ){
                            if(discout_type == 1) displayData +='<h6 class="card-subtitle text-success" >You save ₹'+discout+' on this card </h6>';
                            else displayData +='<label class="card-subtitle text-success" >You save '+discout+'% off on this card</label>';
                        }else{
                            if(discout_type == 1) displayData +='<h6 class="card-subtitle text-success" >You save ₹'+discout+' on this card, plus an additional ₹'+purchaseTotalAmount+' for using a non-expired purchased old card.</h6>';
                            else displayData +='<label class="card-subtitle text-success" >You save '+discout+'% off on this card, plus an additional ₹'+purchaseTotalAmount+' for using a non-expired purchased old card.</label>';
                        }
                        
                        
                        
                        var payablePrice = 0;
                        if(discout_type == 1){
                            ItemDiscount = parseInt(discout);
                            payablePrice = parseInt(amount) - parseInt(discout);
                        }else{
                            ItemDiscount = ( ( parseInt(amount) / 100 ) * parseInt(discout) ).toFixed(2) ;
                            payablePrice = (parseInt(amount) - ( ( parseInt(amount) / 100 ) * parseInt(discout) )).toFixed(2) ;
                        }
                        
                        if(purchaseCardExp == 1 || activeCardPurchaseServiceRec > 0){
                            ItemTotalAmount = payablePrice;
                            Itemsave = ItemDiscount;
                        }else{
                            payablePrice = (payablePrice - parseFloat(purchaseTotalAmount)).toFixed(2);
                            ItemDiscount = (ItemDiscount + parseFloat(purchaseTotalAmount)).toFixed(2);
                            
                            ItemTotalAmount = payablePrice;
                            Itemsave = ItemDiscount;
                            
                        }
                        
                        
                        
                        displayData +='<h4 class="text-black " style="text-align: left !important;margin-bottom: 0.3rem !important;">';
                        displayData +='<span class="mr-3" >₹ '+payablePrice+' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ '+amount+'</del></span>';
                        displayData +='</h4>';
                        
                        
                    }else if(isUpdate == 0){
                        
                        var amount = data.data[0]['amount'];
                        var discout = data.data[0]['discout'];
                        var discout_type = data.data[0]['discout_type'];
                        var exp = data.data[0]['exp'];
                        
                        cardValid = exp;
                        
                        totalItemPrice = amount;
                        
                        var displayData = '';
                        displayData +='Card valid for <b>'+exp+' year</b><hr>';
                        displayData +='<h5>Offer card-related services.</h5>';
                        displayData +='<div id="displayAllCardServices"></div>';
                        getDisplayAllCardServices(cardServicesIds,'displayAllCardServices');
                        availableServices = cardServicesIds;
                         
                         
                        displayData +='<hr>';
                        displayData +='<h5>Benfits of cards</h5>';
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
                        
                        
                    
                        
                    }else{
                        
                        var amount = data.data[0]['amount'];
                        var discout = data.data[0]['exp_discout'];
                        var discout_type = data.data[0]['exp_discout_type'];
                        var exp = data.data[0]['exp'];
                        
                        cardValid = exp;
                        
                        totalItemPrice = amount;
                        
                        var displayData = '';
                        displayData +='Card valid for <b>'+exp+' year</b><hr>';
                        displayData +='<h5>Offer card-related services.</h5>';
                         displayData +='<div id="displayAllCardServices"></div>';
                         
                         
                        getDisplayAllCardServicesForCard(userPurchasedServices,'displayAllCardServices',userPurchasedOrderId);
                        availableServices = '';

                        
                        displayData +='<hr>';
                        displayData +='<h5>Benfits of cards</h5>';
                        displayData +=data.data[0]['description'];
                        displayData +='<hr>';
                        displayData +='<h5>Price details</h5>';
                        
                       
                        var payablePrice = 0;
                        if(discout_type == 1){
                            payablePrice = parseInt(discout);
                            ItemDiscount = parseInt(amount) - parseInt(discout);
                            
                        }else{
                            ItemDiscount = ( ( parseInt(amount) / 100 ) * parseInt(discout) ).toFixed(2) ;
                            payablePrice = ItemDiscount ;
                            ItemDiscount = parseInt(amount) - parseInt(payablePrice);
                        }
                        
                        ItemTotalAmount = payablePrice;
                        Itemsave = ItemDiscount;
                        
                        displayData +='<h6 class="card-subtitle text-success" >You save ₹'+Itemsave+' on this card </h6>';
                        
                        displayData +='<h4 class="text-black " style="text-align: left !important;margin-bottom: 0.3rem !important;">';
                        displayData +='<span class="mr-3" >₹ '+payablePrice+' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ '+amount+'</del></span>';
                        displayData +='</h4>';
                        
                        
                         isNotPurchaseable = false;
                        
                        $('#purchaseBtn').removeClass('d-none');
                        $('#requestBtn').addClass('d-none');
                        
                        $('#cardNameBenfits').html(displayData);
                        
                        return false;
                        
                        
                        
                    }
                    

                    if(purchaseValidNumberType == 'months'){
                        
                         var evntLastDate = new Date(isWeddingUserDate);
                        var afterMonthsDate = getDateAfterMonths(evntLastDate, purchaseValidNumber);
                        
                        // Format the result date (optional)
                        var formattedAfterFinalResultDate = afterMonthsDate.toISOString().slice(0, 10);
                    
                        
                    }else{
                        var calmonth = purchaseValidNumber * 12;

                         var evntLastDate = new Date(isWeddingUserDate);
                        var afterMonthsDate = getDateAfterMonths(evntLastDate, calmonth);
                        
                        // Format the result date (optional)
                        var formattedAfterFinalResultDate = afterMonthsDate.toISOString().slice(0, 10);
                    
                    }
                    
                    
                  
                    // Create a Date object for the specified date (2024-07-02)
                    var targetAFRDate = new Date(formattedAfterFinalResultDate);
                    
                    // Get the current date
                    var currentDate = new Date();
                    // Compare the two dates
                    if (targetAFRDate <= currentDate) {
                        isNotPurchaseable = true;
                        
                        var isCardReqSnt = '<?=$isCardReqSnt?>';
                        var cardReqStatus = '<?=$cardReqStatus?>';
                        
                        if(isCardReqSnt == 1){
                            
                            if(cardReqStatus == 1){
                                isNotPurchaseable = false;
                        
                                $('#purchaseBtn').removeClass('d-none');
                                $('#requestBtn').addClass('d-none');
                            }else{
                                
                                displayData +='<br><h6 class="card-subtitle text-primary" >* You cannot purchase this card. The card purchase validity is set to '+purchaseValidNumber+' '+purchaseValidNumberType+' from your event date. Please submit a request and wait for approval. </h6>';
                                
                                if(cardReqStatus == 0){
                                    displayData +='<br><h6 class="card-subtitle text-warning" > Your request is pending; please wait a few days until your request is accepted. </h6>';
                                }else{
                                    displayData +='<br><h6 class="card-subtitle text-danger" > Your request has been rejected by the Machooose International , and you are not allowed to purchase cards. You can apply again after a period of 3 months.</h6>';
                                }
                                
                                
                                
                                $('#purchaseBtn').addClass('d-none');
                                $('#requestBtn').addClass('d-none');
                            
                            }
                            
                        }else{
                            
                             displayData +='<br><h6 class="card-subtitle text-primary" >* You cannot purchase this card. The card purchase validity is set to '+purchaseValidNumber+' '+purchaseValidNumberType+' from your event date. Please submit a request and wait for approval. </h6>';
                            
                            
                            
                            $('#purchaseBtn').addClass('d-none');
                            $('#requestBtn').removeClass('d-none');
                        }
                        
                        
                        
                    } else {
                        isNotPurchaseable = false;
                        
                        $('#purchaseBtn').removeClass('d-none');
                        $('#requestBtn').addClass('d-none');
                        
                        
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
        $('#viewCard').addClass('d-none');
        
         var element = document.getElementById('main-card-div');
          if (element) {
            element.scrollIntoView({
              behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
              block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
              inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
            });
          }
   
    }
    
    function getDateAfterMonths(originalDate, monthsToAdd) {
      var date = new Date(originalDate);
      date.setMonth(date.getMonth() + monthsToAdd);
      return date;
    }
    
    
    
    function getDisplayAllCardServicesForCard(cardServicesIds,disName,userPurchasedOrderId){
        

        
        $('#'+disName).html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getAllUserActiveCardServices",
            cardServicesIds: cardServicesIds,
            order_id:userPurchasedOrderId,
           
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
                    
                    // console.log(data.data['service']);
                    // console.log(data.data['service_used']);
                    
                    var tbls ='';
                    var dataS = data.data['service'];
                    
                    var used_data = data.data['service_used'];
                    var used_data_length = used_data.length;
                    if(used_data_length > 0 ){
                        
                        for (var i = 0; i < dataS.length; i++) {
                            isServiceNotAvl = 0;
                            
                            var CardService = dataS[i]['CardService'];
                            var CardServiceID = dataS[i]['id'];
                            
                            var isAvl = false;
                            var isAvldescription = '';
                            
                            for (var j = 0; j < used_data.length; j++) {
                                var service_id = used_data[j]['service_id'];
                                if(service_id == CardServiceID){
                                    isAvl = true;
                                    isAvldescription = used_data[j]['description'];
                                   
                                }
                            }
                            
                            
                            if(isAvl){
                                isAvl = true;
                                
                                tbls += '<div class="row mb-2">';
                                tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                tbls += '<img src="images/icons/red-x-png.png" alt="" width="25px" height="25px" >';
                                tbls += '</div>';
                                tbls += '<div class="col-10">';
                                tbls += '<span class="menu-title">  '+CardService+'<span class="text-danger">   *The service has already been redeemed</span></span><br><span class="text-muted">- '+isAvldescription+'</span>';
                                tbls += '</div>';
                                
                                tbls += '</div>';

                          
                                
                            }else{
                                
                                if(availableServices == '') availableServices = CardServiceID;
                                else availableServices = availableServices+","+CardServiceID; 
                                
                                tbls += '<div class="row mb-2">';
                                tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                tbls += '<img src="images/icons/tick01.png" alt="" width="25px" height="25px" >';
                                tbls += '</div>';
                                tbls += '<div class="col-10">';
                                tbls += '<span class="menu-title">  '+CardService+'</span>';
                                tbls += '</div>';
                                
                                tbls += '</div>';

                            }
                            
                            
                       
                        }
                        
                    }else{
                        for (var i = 0; i < dataS.length; i++) {
                            isServiceNotAvl = 0;
                            
                            var CardService = dataS[i]['CardService'];
                            
                       
                            
                                    tbls += '<div class="row mb-2">';
                                    tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                    tbls += '<img src="images/icons/tick01.png" alt="" width="25px" height="25px" >';
                                    tbls += '</div>';
                                    tbls += '<div class="col-10">';
                                    tbls += '<span class="menu-title">  '+CardService+'</span>';
                                    tbls += '</div>';
                                    
                                    tbls += '</div>';
                        }
                    }
                    
                    
                    
                   
                    
                   
                    $('#'+disName).html(tbls);
                   
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
    
    
    
    
    
    
    
    function getDisplayAllCardServices(cardServicesIds,disName){
        
        
        $('#'+disName).html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getAllUserCardServices",
            cardServicesIds: cardServicesIds,
           
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
                    
                    var tbls ='';
                    var data = data.data;
                    for (var i = 0; i < data.length; i++) {
                        isServiceNotAvl = 0;
                        
                        var CardService = data[i]['CardService'];
                        
                   
                         
                                    tbls += '<div class="row mb-2">';
                                    tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                    tbls += '<img src="images/icons/tick01.png" alt="" width="25px" height="25px" >';
                                    tbls += '</div>';
                                    tbls += '<div class="col-10">';
                                    tbls += '<span class="menu-title">  '+CardService+'</span>';
                                    tbls += '</div>';
                                    
                                    tbls += '</div>';
                    }
                    
                   
                    $('#'+disName).html(tbls);
                   
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
    
    
     function getDisplayAllCardServicesForCard3(order_id,disName){
        
        
        $('#'+disName).html('');
        
         var postData = {
            function: 'AlbumSubscription',
            method: "getAllUserActiveCardServicesUsingOrder",
            order_id:order_id,
           
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
                    
                    // console.log(data.data['service']);
                    // console.log(data.data['service_used']);
                    
                    var tbls ='';
                    var dataS = data.data['service'];
                    
                    var used_data = data.data['service_used'];
                    var used_data_length = used_data.length;
                    if(used_data_length > 0 ){
                        
                        for (var i = 0; i < dataS.length; i++) {
                            isServiceNotAvl = 0;
                            
                            var CardService = dataS[i]['CardService'];
                            var CardServiceID = dataS[i]['id'];
                            
                            var isAvl = false;
                            var isAvldescription = '';
                            
                            for (var j = 0; j < used_data.length; j++) {
                                var service_id = used_data[j]['service_id'];
                                if(service_id == CardServiceID){
                                    isAvl = true;
                                    isAvldescription = used_data[j]['description'];
                                   
                                }
                            }
                            
                            
                            if(isAvl){
                                isAvl = true;
                                
                                tbls += '<div class="row mb-2">';
                                tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                tbls += '<img src="images/icons/red-x-png.png" alt="" width="25px" height="25px" >';
                                tbls += '</div>';
                                tbls += '<div class="col-10">';
                                tbls += '<span class="menu-title">  '+CardService+'<span class="text-danger">   *The service has already been redeemed</span></span><br><span class="text-muted">- '+isAvldescription+'</span>';
                                tbls += '</div>';
                                
                                tbls += '</div>';

                          
                                
                            }else{
                                
                                if(availableServices == '') availableServices = CardServiceID;
                                else availableServices = availableServices+","+CardServiceID; 
                                
                                tbls += '<div class="row mb-2">';
                                tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                tbls += '<img src="images/icons/tick01.png" alt="" width="25px" height="25px" >';
                                tbls += '</div>';
                                tbls += '<div class="col-10">';
                                tbls += '<span class="menu-title">  '+CardService+'</span>';
                                tbls += '</div>';
                                
                                tbls += '</div>';

                            }
                            
                            
                            
                       
                        }
                        
                    }else{
                        for (var i = 0; i < dataS.length; i++) {
                            isServiceNotAvl = 0;
                            
                            var CardService = dataS[i]['CardService'];
                            
                       
                            
                                    tbls += '<div class="row mb-2">';
                                    tbls += '<div class="col-2" style="max-width: 4.66667% !important;">';
                                    tbls += '<img src="images/icons/tick01.png" alt="" width="25px" height="25px" >';
                                    tbls += '</div>';
                                    tbls += '<div class="col-10">';
                                    tbls += '<span class="menu-title">  '+CardService+'</span>';
                                    tbls += '</div>';
                                    
                                    tbls += '</div>';
                        }
                    }
                    
                    
                    
                   
                    
                   
                    $('#'+disName).html(tbls);
                   
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