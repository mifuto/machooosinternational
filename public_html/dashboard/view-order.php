 <?php
 
include("header.php");

 if (!isset($_REQUEST['purchaseID'])) {
    
   echo "<script type='text/javascript'>
    window.location.href = 'cart.php';
</script>";

die;
}
 
$projIdString = str_rot13($_REQUEST['purchaseID']);
$projIdString = base64_decode($projIdString);

$arr = explode('_', $projIdString);
$purchaseID = $arr[1];

$user_id = '';


$sql1 = "SELECT * FROM place_order WHERE id=$purchaseID ";
$AlbumListArr = $DBC->query($sql1);
$AlbumList = mysqli_fetch_assoc($AlbumListArr);

$dateTime = new DateTime($AlbumList['created_date']);
$dateInv = $dateTime->format("Y-m-d");

$razorpay_payment_status = $AlbumList['razorpay_payment_status'];





$itm = '<table width="100%" border="1" class="table center-aligned-table" >';

$itm .='<tr>';
$itm .='<th>#</th>';
$itm .='<th>Item</th>';
$itm .='<th>Year</th>';
$itm .='<th>Price</th>';
$itm .='<th>Discount</th>';
$itm .='<th>Service Charge</th>';
$itm .='<th>Total</th>';
$itm .='</tr>';

$cart = $AlbumList['mainArray'];
$cartArray = json_decode($cart, true);


// Loop through the array
$i = 1;
foreach ($cartArray as $cartItem) {
    $cartID = $cartItem['cartID'];
    $newExpPackDate = $cartItem['newExpPackDate'];
    $isExtra = $cartItem['isExtra'];
    $extraAmt = $cartItem['extraAmt'];
    
    $sqlcart = "SELECT * FROM `cart` WHERE id = $cartID ";
    $resultcart = $DBC->query($sqlcart);
    $cartItemsArr = mysqli_fetch_assoc($resultcart);
    
    $album_type = $cartItemsArr['album_type'];
    $album_id = $cartItemsArr['album_id'];
    
    $user_id = $cartItemsArr['user_id'];
    
    if($album_type == 'SA'){
        $sql5 = "SELECT * FROM tbesignaturealbum_projects WHERE id = $album_id ";
        $result5 = $DBC->query($sql5);
        $result5 = mysqli_fetch_assoc($result5);
        $disItem = $result5['project_name']." (Signature album)";
        
        
    }else{
        $sql5 = "SELECT * FROM tbevents_data WHERE id = $album_id ";
        $result5 = $DBC->query($sql5);
        $result5 = mysqli_fetch_assoc($result5);
        $disItem = $result5['event_name']." (Online album)";
        
        
    }
    
    
    $itm .='<tr>';
	$itm .='<td>'.$i.'</td>';
	$itm .='<td>'.$disItem.'</td>';
	$itm .='<td>'.$cartItemsArr['quantity'].'</td>';
	$itm .='<td>₹'.$cartItemsArr['amount'].'</td>';
	
	$disct = floatval($cartItemsArr['amount']) - floatval($cartItemsArr['final_amount']) ;
	$disct = number_format($disct, 2);
	
	$itm .='<td>₹'.$disct.'</td>';
	$itm .='<td>₹'.$cartItemsArr['extraAmt'].'</td>';
	$cartItemTotal = floatval($cartItemsArr['final_amount']) + floatval($cartItemsArr['extraAmt']);
	$cartItemTotal = number_format($cartItemTotal, 2);
	
	
	$itm .='<th>₹'.$cartItemTotal.'</th>';
	$itm .='</tr>';
    
    
    $i++;
    
    
    
}




$itm .='</table>';

$decimalValue = $AlbumList['numberOfItemsTotalAmount']; // Replace with your decimal value
$integerPart = (int) $decimalValue;
$fractionalPart = round(($decimalValue - $integerPart) * 100);

$integerWords = numberToWords($integerPart);
$fractionalWords = numberToWords($fractionalPart);

if ($fractionalPart == 0) {
    $inWrd = ucfirst($integerWords) . ' Rupees';
} else {
    $inWrd = ucfirst($integerWords) . ' Rupees and ' . $fractionalWords . ' Paise';
}


function numberToWords($number) {
        $ones = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        );
    
        $tens = array(
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        );
    
        if ($number < 10) {
            return $ones[$number];
        } elseif ($number < 20) {
            return $tens[$number];
        } elseif ($number < 100) {
            $tens_digit = (int) ($number / 10) * 10;
            $ones_digit = $number % 10;
            return $tens[$tens_digit] . ($ones_digit ? ' ' . $ones[$ones_digit] : '');
        } elseif ($number < 1000) {
            $hundreds_digit = (int) ($number / 100);
            $remainder = $number % 100;
            return $ones[$hundreds_digit] . ' Hundred' . ($remainder ? ' and ' . numberToWords($remainder) : '');
        } else {
            return 'Number too large to convert';
        }
    }



?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- partial -->
        <div class="content-wrapper">
          <h3 class="page-heading mb-4">Order Details </h3>
          
          
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                    <div class="card-deck" >
                        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" style="min-height:80px;">
                            <div class="card-body">
                                
                                
                                 <div class="row ">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex align-items-left justify-items-left ">
                                        <h5 class="text-dark">
                                            Transaction ID:<b> #<?=$AlbumList['newpurchaseID']?></b>
                                          </h5>
                                          

                                    </div>
                                    
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " >
                                            <label class="card-title ">Status:
                                             <?php if($razorpay_payment_status == 1){ ?>
                                                <b class="text-success ">SUCCESS</b>
                                                <?php }else{ ?>
                                                    <b class="text-danger">FAILED</b>
                                                <?php } ?>
                                                </label>
                                        </p>
                                        
                                         
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                       <label class="card-title ">
                                            Date:<b> <?=$dateInv?></b>
                                          </label>
                                          

                                    </div>
                                    
                                   
                                 
                                </div>
                                
                                
                                
                             
                                
                            </div>
                        </div>
                        
                        
                    </div>
                  
                </div>
              
             
            </div>
            
             <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                  <div class="card-deck" >
                        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" style="min-height:80px;">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Items</h5>
                                
                                <div class="table-responsive mb-4">
                                    <?=$itm?>
                                    
                                </div>
                                
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Price (<?=$AlbumList['numberOfItems']?> item)
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>₹<?=$AlbumList['numberOfItemsPrice']?></b></p>
                                        
                                    </div>
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Discount
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>- ₹<?=$AlbumList['numberOfItemsDiscount']?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Service charge
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark "><b>₹<?=$AlbumList['numberOfItemsExtraCharge']?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                  <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            Coupon
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " id="applyCouponPrice"><b>-₹<?=$AlbumList['couponApplyDiscount']?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            <b>Total Amount</b>
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " id="totalDisAmt"><b>₹<?=$AlbumList['numberOfItemsTotalAmount']?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-success" id="saveDisAmt">
                                            <b>You will save ₹<?=$AlbumList['numberOfItemssave']?> on this order</b>
                                          </p>
                                        
                                    </div>
                                  
                                </div>
                                
                                <hr>
                                
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            <b>Sub Total (inclusing gst) </b>
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        <p class="text-dark " id="totalDisAmt"><b>₹<?=$AlbumList['numberOfItemsTotalAmount']?></b></p>
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            <b>Total Paid  </b>
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                        
                                         <?php if($razorpay_payment_status == 1){ ?>
                                            <p class="text-dark " id="totalDisAmt"><b>₹<?=$AlbumList['numberOfItemsTotalAmount']?></b></p>
                                            <?php }else{ ?>
                                                <p class="text-dark " id="totalDisAmt"><b>₹0</b></p>
                                            <?php } ?>
                                        
                                        
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-6 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                            <b>Amount Due     </b>
                                          </p>
                                        
                                    </div>
                                    
                                    <div class="col-6 d-flex align-items-end justify-items-end " style="justify-content: end;">
                                         <?php if($razorpay_payment_status == 1){ ?>
                                            <p class="text-dark " id="totalDisAmt"><b>₹0</b></p>
                                            <?php }else{ ?>
                                                <p class="text-dark " id="totalDisAmt"><b>₹<?=$AlbumList['numberOfItemsTotalAmount']?></b></p>
                                            <?php } ?>
                                        
                                        
                                    </div>
                                 
                                 
                                </div>
                                
                                 <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-muted" >
                                            With words: <b class="text-dark"> <?=$inWrd?></b>
                                          </p>
                                        
                                    </div>
                                  
                                </div>
                                
                                
                            </div>
                        </div>
                        
                        
                    </div>
                  
              </div>
              
             
            </div>
            
            
            <?php if($razorpay_payment_status == 1){ ?>
                                
                                
                                 <div class="row">
                                        <div class="col-6 mb-4">
                                            
                                             <div class="row d-flex align-items-end justify-items-end flex-column">
                                                 <button type="button" onclick="printNow(<?=$purchaseID?>);" class="btn btn-primary mr-2">Print Invoice</button>
                                                </div>
                                            
                                        </div>
                                        <div class="col-6 mb-4">
                                            
                                             <div class="row d-flex align-items-start justify-items-start flex-column">
                                                 <button type="button" onclick="downloadNow(<?=$purchaseID?>,`<?=$AlbumList['newpurchaseID']?>`);"  class="btn btn-primary mr-2">Download Invoice</button>
                                                </div>
                                            
                                        </div>
                                    </div>
          
          
                                <?php } ?>
            
            
          
          
          
         
            
            
            
            
        </div>
        
        
      <iframe id="printFrame" style="display: none;" title="CustomFileName"></iframe>
        
<?php
   
include("footer.php");
?>

 <script>
  
    document.getElementById("menu1").classList.remove("active");
    document.getElementById("menu2").classList.add("active");
    document.getElementById("menu3").classList.remove("active");
    document.getElementById("menu5").classList.remove("active");
    document.getElementById("menu4").classList.remove("active");
    document.getElementById("menu8").classList.remove("active");
    
  
    function printNow(id){
        const iframe = document.getElementById("printFrame");
        iframe.src = "/dwd-invoice.php?purchaseID="+id;

        iframe.onload = function() {
            // Wait for the iframe to load, then trigger the print dialog
            iframe.contentWindow.print();
        };
    }
    
    function downloadNow(id,newpurchaseID){
         const iframe = document.getElementById("printFrame");
            iframe.src = "/dwd-invoice-pdf.php?purchaseID="+id;

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