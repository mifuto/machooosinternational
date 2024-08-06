
<?php


 
 include("header.php");
 
 if (!isset($_REQUEST['purchaseID'])) {
    
   echo "<script type='text/javascript'>
    // Your JavaScript code here
    window.location.href = '/dashboard/cart.php';
</script>";

die;
}

require_once('pdfdwd/tcpdf/tcpdf.php');

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('HTML to PDF Example');

// Add a page
$pdf->AddPage();

$purchaseID = $_REQUEST['purchaseID'];
$user_id = '';

include("admin/config.php");

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);


$sql1 = "SELECT * FROM place_order WHERE id=$purchaseID ";
$AlbumListArr = $DBC->query($sql1);
$AlbumList = mysqli_fetch_assoc($AlbumListArr);

$dateTime = new DateTime($AlbumList['created_date']);
$dateInv = $dateTime->format("Y-m-d");



$itm = '<table width="100%" border="1" >';

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


$sqlU = "SELECT b.*,c.short_name,a.firstname,a.lastname,a.email FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 
$UserList = $DBC->query($sqlU);
$UserList = mysqli_fetch_assoc($UserList);

$eventUser = $UserList['firstname']." ".$UserList['lastname'];
$eventUserEmail = $UserList['email'];





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


<div style="padding:20px;">
   <hr>
   <div class="row align-items-center">
      <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0"><span style="background-color: rgb(236, 240, 241);"><img style="float: right;" src="https://machooosinternational.com/admin/tinymceuploads/653d47d244aaa_mi_logo.webp" alt="" width="205" height="52"></span></div>
      <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
         <div><strong>INVOICE</strong></div>
         <div>INVOICE NUMBER: <strong><?=$AlbumList['newpurchaseID']?></strong></div>
         <div>STATUS: <span style="color: rgb(45, 194, 107);"><strong>PAID</strong></span></div>
         <div>
            <hr>
         </div>
      </div>
      <div class="col-sm-12"><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">Bill To:</span></strong></div>
      <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;"><?=$eventUser?></span></div>
      <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;"><?=$UserList['address']?></span></div>
      <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;"><?=$UserList['city']?>, <?=$UserList['state']?>, <?=$UserList['short_name']?></span></div>
      <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;"><?=$UserList['zip']?></span></div>
      <div class="col-sm-12"><span style="color: rgb(206, 212, 217);"><strong>SERVICE SA/OA</strong></span></div>
      <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Invoice Date: <?=$dateInv?></span></div>
      <div>
         <hr>
      </div>
   </div>
   <div class="col-sm-12"><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">Machooos International Wedding Company</span></strong></div>
   <div>TRIVANDRUM : Tc 24/1474 Opposite Kowdiar Palace,&nbsp;</div>
   <div>Bismi heights Kowdiar,Trivandrum&nbsp;Kerala</div>
   <div>India - 695003</div>
   <div>GST 32ABMFM3961F1Z9&nbsp;</div>
   <div>
      <hr>
   </div>

    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <?=$itm?>
    </div>
    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">&nbsp;</div>
    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Price ( <?=$AlbumList['numberOfItems']?> items )</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &#8377;<?=$AlbumList['numberOfItemsPrice']?></span></strong></div>
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Discount&nbsp; </span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#8377;<?=$AlbumList['numberOfItemsDiscount']?></span></strong></div>
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Service Charge</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#8377;<?=$AlbumList['numberOfItemsExtraCharge']?></span></strong></div>
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Coupon&nbsp;</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#8377;<?=$AlbumList['couponApplyDiscount']?></span></strong></div>
       <div class="col-sm-12">
          <main>
             <div class="row">
                <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Sub Total (inclusing gst) </span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp;&#8377;<?=$AlbumList['numberOfItemsTotalAmount']?></span></strong></div>
                <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Total Paid</span><span style="font-family: -apple-system, BlinkMacSystemFont,;"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </strong>&nbsp; </span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&#8377;<?=$AlbumList['numberOfItemsTotalAmount']?></span></strong></div>
                <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Amount Due&nbsp;</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&#8377;0</span></strong></div>
                <div class="col-sm-12">&nbsp;</div>
                <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">With words:</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;"> <?=$inWrd?></span></strong></div>
                <div class="col-sm-12">
                   <hr>
                </div>
                <div class="col-sm-12"><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">Note:</span></strong></div>
                <div>Thanks for doing business with Machooos International&nbsp;</div>
                <div><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">Terms &amp; Conditions:</span></strong></div>
                <div>Visit our website for more details&nbsp;</div>
                <div>
                   machooosinternational.com
                </div>
             </div>
          </main>
       </div>
    </div>
    </div>
</div>



