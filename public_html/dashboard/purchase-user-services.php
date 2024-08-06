 <?php
 
 include("../admin/config.php");
include("../get_session.php");

 $DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);
 
 
$projIdString = str_rot13($_REQUEST['purchaseID']);
$projIdString = base64_decode($projIdString);

$arr = explode('_', $projIdString);
$purchaseID = $arr[1];

$timestamp = time();
$setT = 'MI'.$timestamp.'C'.$purchaseID;

$newpurchaseID = str_rot13($setT);

$sql1 = "SELECT a.*,c.short_name FROM mifuto_users a left join place_order_userservices b on a.id = b.user_id LEFT JOIN tblcountries c on a.country = c.country_id WHERE b.id='$purchaseID' ";


// $sql1 = "SELECT b.*,c.short_name,a.firstname,a.lastname,a.email,a.phonenumber FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 

    
$result1 = $DBC->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT country_id,short_name FROM tblcountries "; 
$countryData = [];

    
$result2 = $DBC->query($sql2);
 $count2 = mysqli_num_rows($result2);


    if($count2 > 0) {		
        while ($row = mysqli_fetch_assoc($result2)) {
            array_push($countryData,$row);
        }
    }
    
  $sql4 = "SELECT * FROM place_order_userservices WHERE id='$purchaseID' AND completed=0 "; 

    
$result4 = $DBC->query($sql4);
$Cunt = mysqli_num_rows($result4);
if($Cunt <= 0){
    echo "<script type='text/javascript'>
    window.location.href = 'https://mifuto.com/services.php';
</script>";

die;
}



$row4 = mysqli_fetch_assoc($result4);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
   <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MIfuto-online photographer booking</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
            <meta name="MachooosInterational" content="Kerala wedding photography,Best wedding photographers in Kerala,Professional wedding photography Kerala,Kerala destination wedding photographers
Candid wedding photographers Kerala,Traditional wedding photography Kerala,Kerala wedding photography packages,Top wedding photographers in Kerala,Kerala wedding photojournalists,Wedding videography Kerala,Pre-wedding photoshoot Kerala,Kerala bridal photoshoot,Outdoor wedding photography Kerala,Creative wedding photographers in Kerala,Kerala wedding photography prices,Kerala wedding album design,Kerala wedding cinematography,South Indian wedding photography Kerala,Best wedding venues in Kerala for photography,Kerala wedding photography ti, Kerala kids photography,ernakulam kids phtography,trivandrum kids photography,trivandrum baby photographer,trivandrum birthday photographer,trivandrum newborn baby photographer,trivandrum kids props rent, trivandrum newborn baby props rent,kochi birthday photographer,kochi birthday event planner,birthday photographer,kids only,premium wedding photographer ernakulam,premium wedding photographer kochi, premium wedding photographer trivandrum,No1 wedding photographer ernakulam,No1 wedding photographer kochi,No1 wedding photographer kerala,No1 wedding photographer trivandrum,No1 wedding photographer india,Online album wedding company,">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" href="/images/favicon1.ico">
  
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  
    <!--=============== css  ===============-->	
        <!--<link href="/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <!--<link type="text/css" rel="stylesheet" href="/css/plugins.css">-->
        <!--<link type="text/css" rel="stylesheet" href="/css/style.css">-->
        <link type="text/css" rel="stylesheet" href="/css/color.css">
        <!--<link rel="stylesheet" href="/css/lc_lightbox.css" />-->
        <!--=============== favicons ===============-->

</head>

<style>

/*------ footer------------------------------------------------------*/
.main-footer {
	background: #151515;
	padding: 90px 0;
	position: relative;
	width: 100%;
}
.main-footer:before {
	content: '';
	position: absolute;
	top: 0;
	left: 50%;
	height: 80px;
	width: 1px;
	background: rgba(255,255,255,0.1);
}
.policy-box {
	float: left;
	color: #fff;
	text-transform: uppercase;
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 2px;
}
.footer-social {
	float: right;
}
.footer-social li   {
	float: left;
	margin-left: 20px;
}
.footer-social li a   {
 	position: relative;
	color: #fff;
	font-size: 13px;
}
.to-top-btn {
	position: absolute;
	bottom: 0;
	left: 50%;
	width: 40px;
	height: 60px;
	line-height: 60px;
	color: #fff;
	z-index: 10;
	margin-left: -20px;
	cursor: pointer;
}
.to-top i {
    position:relative;
    top: 0;
    transition: all 200ms linear;
}
.to-top:hover i {
     top:-8px;
}


#footer-twiit div.user {
	margin-bottom:10px;
	font-size:11px;
	font-style:italic;
}
#footer-twiit div.user a {
	color:#666;
}
#footer-twiit div.user img {
	display:none;
}
#footer-twiit {
	text-align:left;
}
#footer-twiit p.interact {
	 float:left;
	 width:100%;
	 margin:0 0 5px;
}
#footer-twiit p.interact a {
	float:left;
	color:#fff;
	margin-right:10px;
	background:#292929;
	padding:3px 10px;
	font-size:10px;
	font-weight:500;
}
#footer-twiit p.interact a:hover {
	color:#888;
}
#footer-twiit ul li {
	margin-bottom:20px;
	float:left;
	width:100%;
	padding-bottom:10px;
	border-bottom:1px solid #eee;
}
#footer-twiit ul li:last-child {
	border-bottom:none;
	padding-bottom:0;
	margin-bottom:0;
}
#footer-twiit p.tweet {
	text-align:left;
	font-size: 12px;
	padding: 15px 25px;
	background: #f9f9f9;
	font-family: Montserrat,sans-serif;
}
#footer-twiit p.tweet a:hover {
	color:#888;
}
#footer-twiit  .timePosted a {
	color:#999;
	font-style:italic;
	text-align:left;
	margin-top: 10px;
	display: block;
}
</style>







<body>
    

        <div style="padding:20px;background: #18458B;">
            
           <div class="logo-holder">
                <a href="#"><img src="https://mifuto.com/images/logo.png" width="10%" height="10%" alt=""></a>
            </div>                 
        </div>







        <!-- partial -->
        <div class="content-wrapper" style="margin-left: 0px;width: 100%;">
          <h3 class="page-heading mb-4">Order Summary</h3>
          
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 mb-4">
                    
                    <div class="card-deck">
                        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                          <div class="card-body">
                              
                                <div class="row ">
                                  
                                    
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-start justify-items-start " >
                                        <p class="text-dark ">Date:<b> <?=date("Y-m-d")?></b></p><br>

                                    </div>
                                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-start justify-items-start " >
                                        <p class="text-dark ">Transaction ID:<b> #<?=$newpurchaseID?></b></p><br>

                                    </div>
                                 
                                </div>
                            
                            
                            
                          </div>
                        </div>
                    
                    </div>
                    
                    <div class="card-deck" id='viewAddress'>
                        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                          <div class="card-body">
                            <h5 class="card-title mb-2">Your billing address</h5><hr>
                            <div class="row d-flex align-items-left justify-items-left flex-column" style="padding-left:20px;">
                             
                            <h6 class="text-left bolder"><?=$row1['name'];?></h6>
                              <p class="text-muted text-left">
                                <?=$row1['address'];?>
                              </p>
                              
                              
                              <h6 class="text-left text-muted"><?=$row1['city'];?>, <?=$row1['state'];?>, <?=$row1['short_name'];?></h6>
                              <h6 class="text-left bolder text-muted"><?=$row1['zip'];?></h6>
                              
                              <h6 class="text-left bolder text-muted">Contact Number: <?=$row1['phone'];?></h6>
                              
                              <div class="text-right ">
                                <button type="button" onclick="return editAddress();" class="btn btn-primary mr-2">Change</button>
                              </div>
                              
                             
                              
                            </div>
                          </div>
                        </div>
                    
                    </div>
                    
                    <div class="row mb-2 d-none" id="editForm">
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title mb-4">Edit address</h5>
                              <form class="forms-sample" >
                                  
                                <div class="form-group">
                                  <label for="InputCountry">Select country</label>
        
                                    <select class="form-control p-input" id="InputCountry" onchange="changeCountry();">
                                      <option value="" selected>-- Select country -- </option>
                                      <?php
                                        foreach ($countryData as $key => $ctry ) { 
                                        
                                            $country_id = $ctry['country_id'];
                                            $short_name = $ctry['short_name'];
                                            if($country_id == $row1['country']) $select = 'selected';
                                            else $select = '';
                                            
                                            
                                        ?>
                                        
                                        <option value="<?=$country_id;?>" <?=$select?> ><?=$short_name;?> </option>
                                        <?php } ?>
                                    </select>
                                    <div id="countryError" class="error-message text-danger"></div>
                                  
                                  
                                  
                                </div>
                                
                               <div class="form-group">
                                  <label for="exampleInputEmail1">Select state</label>
                                  <select class="form-control p-input" id="InputState" onchange="changeState();" value="<?=$row1['state'];?>" >
                                    </select>
                                  
                                  <div id="stateError" class="error-message text-danger"></div>
                                </div>
                                
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Select district</label>
                                  <select class="form-control p-input" id="InputCity" value="<?=$row1['city'];?>" >
                                    </select>
                                  
                                  
                                  <div id="cityError" class="error-message text-danger"></div>
                                </div>
                        
                                
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Zip </label>
                                  <input type="text" class="form-control p-input" id="InputZip" value="<?=$row1['zip'];?>"  placeholder="Enter zip">
                                  <div id="zipError" class="error-message text-danger"></div>
                                </div>
                                
                                 <div class="form-group">
                                  <label for="exampleInputEmail1">Contact number </label>
                                  <input type="text" class="form-control p-input" id="InputPhone" value="<?=$row1['phone'];?>"  placeholder="Enter contact number">
                                  <div id="phoneError" class="error-message text-danger"></div>
                                </div>
                                
                                <div class="form-group" style="flex: 0 0 100% ;max-width: 100%;">
                                  <label for="exampleTextarea">Enter full address</label>
                                  <textarea class="form-control p-input" id="TextAddress" rows="5" placeholder="Enter full address...."><?=$row1['address'];?></textarea>
                                  <div id="addressError" class="error-message text-danger"></div>
                                </div>
                                
                               
                                
                              
                                
                                <div class="form-group">
                                  <button class="btn btn-primary" id="updateButton" onclick="return validateAddress();">Update</button>
                                  <button onclick="return showAddress();" class="btn btn-danger">Cancel</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
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
                                                <b>Total Amount </b> (*GST Inclusive)
                                                
                                              </p>
                                            
                                        </div>
                                        
                                        <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                            <p class="text-dark " id="totalDisAmt"><b>₹<?=$row4['numberOfItemsPrice'];?></b></p>
                                            
                                        </div>
                                     
                                     
                                    </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Discount
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>- ₹<?=$row4['numberOfItemsDiscount'];?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Coupon
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>- ₹<?=$row4['couponApplyDiscount'];?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                
                                
                                
                                
                                <!--<div class="row ">-->
                                <!--    <div class="col-6 d-flex align-items-left justify-items-left ">-->
                                <!--        <p class="text-dark">-->
                                <!--            Total service amount payable-->
                                <!--          </p>-->
                                        
                                <!--    </div>-->
                                    
                                   
                                    
                                <!--    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">-->
                                <!--        <p class="text-dark "><b>₹<?=$row4['numberOfItemsPrice'];?></b></p>-->
                                        
                                <!--    </div>-->
                                 
                                <!--</div>-->
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Now amount payable
                                          </p>
                                        
                                    </div>
                                    
                                   
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>₹<?=$row4['numberOfItemsTotalAmount'];?></b></p>
                                        
                                    </div>
                                 
                                </div>
                                
                                
                                  <hr>
                                
                                   
                                    
                                     <div class="row ">
                                        <div class="col-12 d-flex align-items-left justify-items-left ">
                                            <p class="text-info">
                                                <b>GST Details</b> 
                                              </p>
                                            
                                        </div>
                                        
                                       
                                     
                                    </div>
                                    
                                    
                                     <?php 
                                     
                                     $gstPercentage = $row4['gstVal'];
                                     $halfgstPercentage = $row4['gstVal'] / 2;
                                    
                                        $IGST = floatval($row4['finalGstVal']) ;
                                        
                                        $CGST = floatval($row4['finalGstVal']) / 2 ;
                                        $SGST = floatval($row4['finalGstVal']) / 2 ;
                                        
                                        
                                    if($row4['isSte'] == 1){
                                        
                                        $Taxablevalue = number_format( (floatval($row4['numberOfItemsPrice']) - ( $IGST ) ), 2 );
                                        
                                    ?>
                                    
                                    
                                         <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    Taxable value 
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark " id="totalDisTaxablevalue1"><b>₹<?=$Taxablevalue;?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                        <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    CGST
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark "><b id="disCGST"> ₹<?=$CGST;?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                        
                                         <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    SGST
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark "><b id="disSGST"> ₹<?=$SGST;?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                        
                                         <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    <b>Total GST</b>
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark " id="totalDisAmt3"><b>₹<?=$row4['finalGstVal'];?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <!--<div class="row ">-->
                                        <!--    <div class="col-6 d-flex align-items-left justify-items-left ">-->
                                        <!--        <p class="text-dark">-->
                                        <!--            Total invoice value-->
                                        <!--          </p>-->
                                                
                                        <!--    </div>-->
                                            
                                        <!--    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">-->
                                        <!--        <p class="text-dark " id="totalDisAmt3"><b>₹<?=$row4['numberOfItemsPrice'];?></b></p>-->
                                                
                                        <!--    </div>-->
                                         
                                         
                                        <!--</div>-->
                                        
                                      
                                        
                                  <?php  }else{ 
                                  
                                  $Taxablevalue = number_format( (floatval($row4['numberOfItemsPrice']) - ( $IGST ) ), 2 );
                                  
                                  ?>
                                  
                                        <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    Taxable value 
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark " id="totalDisTaxablevalue2"><b>₹<?=$Taxablevalue;?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                  
                                        <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    IGST
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark "><b id="disIGST"> ₹<?=$IGST;?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                        
                                           <div class="row ">
                                            <div class="col-6 d-flex align-items-left justify-items-left ">
                                                <p class="text-dark">
                                                    <b>Total GST</b>
                                                  </p>
                                                
                                            </div>
                                            
                                            <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                                <p class="text-dark " id="totalDisAmt3"><b>₹<?=$row4['finalGstVal'];?></b></p>
                                                
                                            </div>
                                         
                                         
                                        </div>
                                        
                                        
                                        <!--<div class="row ">-->
                                        <!--    <div class="col-6 d-flex align-items-left justify-items-left ">-->
                                        <!--        <p class="text-dark">-->
                                        <!--            Total invoice value-->
                                        <!--          </p>-->
                                                
                                        <!--    </div>-->
                                            
                                        <!--    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">-->
                                        <!--        <p class="text-dark " id="totalDisAmt2"><b>₹<?=$row4['numberOfItemsPrice'];?></b></p>-->
                                                
                                        <!--    </div>-->
                                         
                                         
                                        <!--</div>-->
                                        
                                        
                                        
                                      
                                 <?php } ?>
                                 
                                
                                
                              
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <hr>
                                
                                <div class="row">
                                   
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <input type="checkbox" id="acceptTerms" name="acceptTerms" >&nbsp;&nbsp;
                                        <p class="text-dark">
                                            I read these <a href="https://mifuto.com/CancellationandRefundpolicy.php" target="_blank">Terms & Conditions</a>, <a href="/privacy-policy.php" target="_blank">Privacy Policy </a> and <a href="/Cancellation&Refund_Policy.php" target="_blank">Cancellation & Refund Policy </a> carefully before using the website
                                         </p>
                                        
                                    </div>
                                  
                                </div>
                                <div class="row">
                                   
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                       
                                         <p class="text-danger d-none" id="acceptTermsError">
                                            *Please accept the terms and conditions.
                                         </p>

                                    </div>
                                  
                                </div>
                               
                                
                                <div class="row mb-4">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <button class="btn btn-success text-white" style="width: 100%;" onclick="payNow();" >Pay ₹<span id="totalDisAmt1"><?=$row4['numberOfItemsTotalAmount'];?></span></button>
                                        
                                    </div>
                                  
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-success" id="saveDisAmt">
                                            <b>You will save ₹<?=$row4['numberOfItemssave'];?> on this order</b>
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
          
          
          
          
          
          
            
            
            
            
        </div>
        
        
        
<div class="modal" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content will be dynamically added here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        
        
      
        
<?php
   
include("mifutofooter.php");
?>

 <script>
  
    
    var ifCouponApply = 0;
    var DiscountType = 0;
    var CouponDiscount = 0;
    
    var numberOfItemsTotalAmount = 0;
    var numberOfItemssave = 0;
    
    var IGSTval = '<?=$IGST?>';
    var CGSTval = '<?=$CGST?>';
    var SGSTval = '<?=$SGST?>';
    
    
    function applyCouponcode(){
         var Couponcode = $('#Couponcode').val();
         $('#couponcodeErr').addClass('d-none');
         $('#couponcodeErr').html('');
         $('#applyCouponPrice').html('<b>-₹0</b>');
         
         $('#totalDisAmt').html('<b>₹<?=$row4['numberOfItemsTotalAmount']?></b>');
         $('#saveDisAmt').html('<b>You will save ₹<?=$row4['numberOfItemssave']?> on this order</b>');
         $('#totalDisAmt1').html(<?=$row4['numberOfItemsTotalAmount']?>);
         
         $('#totalDisAmt2').html('<b>₹<?=$row4['numberOfItemsTotalAmount']?></b>');
         $('#totalDisAmt3').html('<b>₹<?=$row4['numberOfItemsTotalAmount']?></b>');
         
         ifCouponApply = 0;
            DiscountType = 0;
            CouponDiscount = 0;
            
            $('#disIGST').html('₹<?=$IGST?>');
            $('#disCGST').html('₹<?=$CGST?>');
            $('#disSGST').html('₹<?=$SGST?>');
            
            $('#totalDisTaxablevalue1').html('<b>₹<?=$Taxablevalue?></b>');
            $('#totalDisTaxablevalue2').html('<b>₹<?=$Taxablevalue?></b>');
            
            
         if(Couponcode == ""){
             $('#couponcodeErr').removeClass('d-none');
             $('#couponcodeErr').html('<p class="text-danger" >Please enter coupon code</p>');
             return false;
         }
         

          var postData = {
            function: 'AlbumSubscription',
            method: "applyCardServiceCouponcode",
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
                          var tlAmt = '<?=$row4['numberOfItemsTotalAmount']?>';
                          var newTlamt = (tlAmt - minusAmt).toFixed(2) ;
                          
                          var savtlAmt = '<?=$row4['numberOfItemssave']?>';
                          savtlAmt = parseInt(savtlAmt) + parseInt(minusAmt) ;
                          
                          
                          $('#applyCouponPrice').html('<b>-₹'+minusAmt+'</b>');
                          $('#totalDisAmt').html('<b>₹'+newTlamt+'</b>');
                          $('#totalDisAmt1').html(newTlamt);
                          
                          $('#totalDisAmt2').html('<b>₹'+newTlamt+'</b>');
                          $('#totalDisAmt3').html('<b>₹'+newTlamt+'</b>');
                          
                          
                          $('#saveDisAmt').html('<b>You will save ₹'+savtlAmt+' on this order</b>');
                          
                          couponApplyDiscount = minusAmt;
                          
                          
                      }else{
                          //offer
                          var minusAmt = coupon['CouponDiscount'] ;
                          var tlAmt = '<?=$row4['numberOfItemsTotalAmount']?>';
                          var oftlAmt = ( (tlAmt / 100 ) * minusAmt ).toFixed(2) ;
                          
                          var newTlamt = (tlAmt - oftlAmt).toFixed(2) ;
                          
                          var savtlAmt = '<?=$row4['numberOfItemssave']?>';
                          savtlAmt = parseInt(savtlAmt) + parseInt(oftlAmt) ;
                          
                          $('#applyCouponPrice').html('<b>-₹'+oftlAmt+'</b>');
                          $('#totalDisAmt').html('<b>₹'+newTlamt+'</b>');
                          $('#totalDisAmt1').html(newTlamt);
                          $('#saveDisAmt').html('<b>You will save ₹'+savtlAmt+' on this order</b>');
                          
                          $('#totalDisAmt2').html('<b>₹'+newTlamt+'</b>');
                          $('#totalDisAmt3').html('<b>₹'+newTlamt+'</b>');
                          
                          couponApplyDiscount = oftlAmt;
                      }
                      
                      
                      ifCouponApply = 1;
                      numberOfItemsTotalAmount = newTlamt;
                      numberOfItemssave = savtlAmt;
                      
                      DiscountType = coupon['DiscountType'];
                        CouponDiscount = coupon['CouponDiscount'];
                        
                        $('#couponcodeErr').html('<p class="text-success" >Coupon applied successfully</p>');
                        
                        
                        IGSTval = ((numberOfItemsTotalAmount * 18) / 118).toFixed(2);
                        CGSTval = ((numberOfItemsTotalAmount * 9) / 118).toFixed(2);
                        SGSTval = ((numberOfItemsTotalAmount * 9) / 118).toFixed(2);
                                                
                                                
                        $('#disIGST').html('₹'+IGSTval);
                        $('#disCGST').html('₹'+CGSTval);
                        $('#disSGST').html('₹'+SGSTval);
                        
                        var isSteVal = '<?=$row4['isSte']?>';
                        var newTaxablevalue = 0;
                        
                        if(isSteVal == 1) newTaxablevalue = ( parseFloat(numberOfItemsTotalAmount) - (parseFloat(CGSTval) + parseFloat(SGSTval))).toFixed(2);
                        else newTaxablevalue = (parseFloat(numberOfItemsTotalAmount) - parseFloat(IGSTval) ).toFixed(2);
                        
                        
                        $('#totalDisTaxablevalue1').html('<b>₹'+newTaxablevalue+'</b>');
                        $('#totalDisTaxablevalue2').html('<b>₹'+newTaxablevalue+'</b>');
                   
                     
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
    
    
    function payNow(){
        
        const acceptTermsCheckbox = document.getElementById('acceptTerms');

        if (!acceptTermsCheckbox.checked) {
            $('#acceptTermsError').removeClass('d-none');
            return false;
        }
        $('#acceptTermsError').addClass('d-none');
        
        
        var InputCountry = document.getElementById("InputCountry").value;
        var InputState = '<?=$row1['state'];?>';
        var InputCity = '<?=$row1['city'];?>';
        var InputZip = document.getElementById("InputZip").value;
        var TextAddress = document.getElementById("TextAddress").value;
        var InputPhone = document.getElementById("InputPhone").value;
        

        if(InputCountry =="" || InputState=="" || InputCity ==""|| InputZip=="" || TextAddress =="" || InputPhone == ""){
            editAddress();
            validateAddress();
            return false;
        }
       
        var newpurchaseID = '<?=$newpurchaseID?>';
        var purchaseID = '<?=$purchaseID?>';
        
        var name = 'Machooos International';
        var email = 'machoosinternationa@gmail.com';
        var phone = '9809996333';
        

        if(ifCouponApply == 0){
            var amount = '<?=$row4['numberOfItemsTotalAmount'];?>';
        }else{
            var amount = numberOfItemsTotalAmount;
        }
        
     
     
        updatePayment('razorpay_payment_id',1,'razorpay_signature');
        return false;
    
        var options = {
            key: 'rzp_live_FnyhwKTKBnpnir',
            amount: amount * 100, // Amount must be in paise
            currency: "INR", // Change to your currency code
            name: name,
            description: "Payment for Machooos International",
            image: "https://machooosinternational.com/images/machooos-img-dis-logo.png",
            handler: function (response) {
                // Handle the payment response
                console.log('response');
                console.log(response);
                if (response.razorpay_payment_id) {
                    // Payment was successful
                    // console.log("Payment successful! Payment ID: " + response.razorpay_payment_id);
                    // alert("Payment successful! Payment ID: " + response.razorpay_payment_id);
                    
                    var razorpay_signature = response.razorpay_payment_id;
                    var razorpay_payment_id = response.razorpay_payment_id;
                    
                    updatePayment(razorpay_payment_id,1,razorpay_signature);
                    
                    
                } else {
                    // Payment failed or was canceled
                    // console.log("Payment failed or canceled.");
                    // alert("Payment failed or canceled.");
                    
                    var razorpay_signature = 'Failed';
                    var razorpay_payment_id = 'Failed';
                    updatePayment(razorpay_payment_id,0,razorpay_signature);
                }
            },
        };
        
        var rzp = new Razorpay(options);
        rzp.open();
        
        
        
        return false;
        
           $.ajax({
            url: "/phonepe_server_endpoint.php", // Replace with your server endpoint
            method: "POST",
            data: { amount: amount },
            dataType: "json",
            success: function(response) {
                handlePaymentResponse(response);
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
        
        
        
        
        
       return false;
        
        
        
        
    }
    
    function handlePaymentResponse(response) {
        if (response.success) {
            // Open the paymentUrl in a Bootstrap modal
            $('#paymentModal').modal('show').find('.modal-body').html('<iframe src="https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay" style="width:100%; height:500px;"></iframe>');
        } else {
            // Handle error scenario
            alert("Error: " + response.message);
        }
    }
    
    function updatePayment(razorpay_payment_id,razorpay_payment_status,razorpay_signature){
        var newpurchaseID = '<?=$newpurchaseID?>';
        var purchaseID = '<?=$purchaseID?>';
        
        
        if(ifCouponApply == 0){
            var ItemsTotalPrice	 = '<?=$row4['numberOfItemsTotalAmount'];?>';
            var TotalSave = '<?=$row4['numberOfItemssave'];?>';
            var couponApply = 0;
        }else{
            var ItemsTotalPrice = numberOfItemsTotalAmount;
            var TotalSave = numberOfItemssave;
            var couponApply = couponApplyDiscount;
        }
        
    
        
        var postData = {
            function: 'AlbumSubscription',
            method: "updateMifutoUserCardServicePayment",
            'newpurchaseID': newpurchaseID,
            'purchaseID': purchaseID,
            'razorpay_payment_id': razorpay_payment_id,
            'razorpay_payment_status': razorpay_payment_status,
            'razorpay_signature':razorpay_signature,
            'ItemsTotalPrice': ItemsTotalPrice,
            'TotalSave':TotalSave,
            'couponApply':couponApply,
            
            'IGST': IGSTval,
            'CGST':CGSTval,
            'SGST':SGSTval,
            
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
                    window.location.href = 'https://mifuto.com/dashboard-bookings.php';

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
    
    
    
    
    
    
    
    function editAddress(){
        document.getElementById("editForm").classList.remove("d-none");
        document.getElementById("viewAddress").classList.add("d-none");
        changeCountry();
        return false;
    }
    
    function showAddress(){
        document.getElementById("editForm").classList.add("d-none");
        document.getElementById("viewAddress").classList.remove("d-none");
        return false;
    }
    
    
     function changeCountry(){
        var selCounty = $('#InputCountry').val();
        var stateVal = '<?=$row1['state'];?>';
     
        
         var postData = {
            function: 'SystemManage',
            method: "getState",
            selCounty: selCounty,
          
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                
                 var users = data.data;
                  var options = "<option value=''>Select State</option>";
                  $.each(users, function(key,value) {
                    // console.log(value.id);
                    if(stateVal == value.state) options += "<option value='"+value.state+"' selected>"+value.state+"</option>";
                    else options += "<option value='"+value.state+"'>"+value.state+"</option>";
                  });
                //   alert("#"+selectId);
            
                  $("#InputState").html(options);

                  changeState();
                    
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
    }
    
    
     function changeState(){
        var selState = $('#InputState').val();
        var cityVal = '<?=$row1['city'];?>';

          var postData = {
            function: 'SystemManage',
            method: "getCity",
            selState: selState,
          
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                
                 var users = data.data;
                  var options = "<option selected value=''>Select District</option>";
                  $.each(users, function(key,value) {
                    // console.log(value.id);
                    if(cityVal == value.city) options += "<option value='"+value.city+"' selected>"+value.city+"</option>";
                    else options += "<option value='"+value.city+"'>"+value.city+"</option>";
                  });
                //   alert("#"+selectId);
            
                  $("#InputCity").html(options);

            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
        
    }
    
    
    
    
    
    function validateAddress(){
        var InputCountry = document.getElementById("InputCountry").value;
        var InputState = document.getElementById("InputState").value;
        var InputCity = document.getElementById("InputCity").value;
        var InputZip = document.getElementById("InputZip").value;
        var TextAddress = document.getElementById("TextAddress").value;
        var InputPhone = document.getElementById("InputPhone").value;
        
        if(InputCountry == ""){
            showError("countryError", "Please select a country.");
            $("#InputCountry").focus();
            return false;
        }
        showError("countryError", "");
        
        if(InputState == ""){
            showError("stateError", "Please select a state.");
            $("#InputState").focus();
            return false;
        }
        showError("stateError", "");
        
        if(InputCity == ""){
            showError("cityError", "Please select a district.");
            $("#InputCity").focus();
            return false;
        }
        showError("cityError", "");
        
        if(InputZip == ""){
            showError("zipError", "Please enter a zip.");
            $("#InputZip").focus();
            return false;
        }
        showError("zipError", "");
        
        if(InputPhone == ""){
            showError("phoneError", "Please enter a contact number.");
            $("#InputPhone").focus();
            return false;
        }
        showError("phoneError", "");
        
        if(TextAddress == ""){
            showError("addressError", "Please enter a address.");
            $("#TextAddress").focus();
            return false;
        }
        showError("addressError", "");
        
        document.getElementById("updateButton").disabled = true;
        document.getElementById("updateButton").innerHTML = 'Please wait...';
        
         var postData = {
            function: 'AlbumSubscription',
            method: "validateMifutoAddressNew",
            InputCountry: InputCountry,
            InputState: InputState,
            InputCity: InputCity,
            InputZip: InputZip,
            TextAddress: TextAddress,
            userid:'<?=$row1['id'];?>',
            InputPhone:InputPhone
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                console.log(data.status);
                //called when successful
                if (data.status == 1) {
                // Reload the current page
                    location.reload();

                }
                document.getElementById("updateButton").disabled = false;
                document.getElementById("updateButton").innerHTML = 'Update';
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
                document.getElementById("updateButton").disabled = false;
                document.getElementById("updateButton").innerHTML = 'Update';
            }
        });
        
       return false;
        
    }
    
    // Function to display an error message
    function showError(elementId, message) {
        var errorContainer = document.getElementById(elementId);
        if (errorContainer) {
            errorContainer.innerHTML = message;
        }
    }
   
  
  

</script>