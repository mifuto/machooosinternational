
<?php


 
 include("header.php");
 
 if (!isset($_REQUEST['purchaseID'])) {
    
   echo "<script type='text/javascript'>
    // Your JavaScript code here
    window.location.href = '/dashboard';
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


$sql1 = "SELECT * FROM place_order_card WHERE id=$purchaseID ";
$AlbumListArr = $DBC->query($sql1);
$AlbumList = mysqli_fetch_assoc($AlbumListArr);

$dateTime = new DateTime($AlbumList['created_date']);
$dateInv = $dateTime->format("Y-m-d");



$itm = '<table width="100%" border="1" >';

$itm .='<tr>';
$itm .='<th>#</th>';
$itm .='<th>Item</th>';
$itm .='<th>Year</th>';
$itm .='<th>Expiry Date</th>';
$itm .='<th>Price</th>';
$itm .='<th>Discount</th>';
$itm .='<th>Total</th>';
$itm .='</tr>';

$user_id = $AlbumList['user_id'];

$card_id = $AlbumList['card_id'];
$sqlcard = "SELECT a.*,b.CardName  FROM tblsubcards a left join tbl_cards b on a.card_id=b.id WHERE a.id='$card_id' ";
$resultcart = $DBC->query($sqlcard);
$cartItemsArr = mysqli_fetch_assoc($resultcart);

$itm .='<tr>';
$itm .='<td>1</td>';
$itm .='<td>'.$cartItemsArr['CardName'].' card</td>';
$itm .='<td>'.$cartItemsArr['exp'].'</td>';
$itm .='<td>'.$AlbumList['exp_date'].'</td>';
$itm .='<td>₹'.$AlbumList['numberOfItemsPrice'].'</td>';

$itm .='<td>₹'.$AlbumList['numberOfItemsDiscount'].'</td>';

$itm .='<th>₹'.$AlbumList['numberOfItemsTotalAmount'].'</th>';
$itm .='</tr>';




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

$servicesIDS = $AlbumList['card_services'];
$sqlcardService = "SELECT *  FROM tbl_card_services WHERE id IN ($servicesIDS) ";
$resultcartService = $DBC->query($sqlcardService);
$serviceDatas = '';
$i = 1;
foreach ($resultcartService as $serviceItem) {
    $serviceDatas = $serviceDatas .$i.". ".$serviceItem['CardService']."<br>";
    $i++;
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


<div style="padding:20px;padding-top:0px !important;">
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
      <div class="col-sm-12"><span style="color: rgb(206, 212, 217);"><strong>SERVICE MI PRIVILLAGE CARD</strong></span></div>
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
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Service Charge</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#8377;0</span></strong></div>
       <div class="col-sm-12"><span style="font-family: -apple-system, BlinkMacSystemFont,;">Coupon&nbsp;</span><strong><span style="font-family: -apple-system, BlinkMacSystemFont,;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &#8377;0</span></strong></div>
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

<br><br><br><br><br>

<div style="padding:20px;">
    
     <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <h3>Offer card-related services</h3>
    </div>
    
    <hr>
    
    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <?php print_r($serviceDatas); ?>
    </div>
    
    <br><br>
    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <h3>Benfits of cards</h3>
    </div>
    
    <hr>
    
    <div class="col-sm-12 text-center text-sm-start mb-3 mb-sm-0">
       <?php echo $cartItemsArr['description']?>
    </div>
    
    
    
    
</div>

<br><br>