
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

$sqlM = "SELECT * FROM mail_templates WHERE deleted=0 AND mail_type=10 AND mail_template=82 AND `active`=1 ";
$mailTemplate = $DBC->query($sqlM);
$MailTem = mysqli_fetch_assoc($mailTemplate);

$subject = $MailTem['subject'];
	
$html = $MailTem['mail_body'];


$sql1 = "SELECT * FROM place_order WHERE id=$purchaseID ";
$AlbumListArr = $DBC->query($sql1);
$AlbumList = mysqli_fetch_assoc($AlbumListArr);

$dateTime = new DateTime($AlbumList['created_date']);
$dateInv = $dateTime->format("Y-m-d");

$html = str_replace("--invoice_no",$AlbumList['newpurchaseID'],$html);
$html = str_replace("--invoice_date",$dateInv,$html);
$html = str_replace("--sub_total",$AlbumList['numberOfItemsTotalAmount'],$html);
$html = str_replace("--total",$AlbumList['numberOfItemsTotalAmount'],$html);
$html = str_replace("--amt_total_paid",$AlbumList['numberOfItemsTotalAmount'],$html);
$html = str_replace("--amount_due",0,$html);
$html = str_replace("--price",$AlbumList['numberOfItemsPrice'],$html);
$html = str_replace("--discount",$AlbumList['numberOfItemsDiscount'],$html);
$html = str_replace("--no_items",$AlbumList['numberOfItems'],$html);
$html = str_replace("--service_charge",$AlbumList['numberOfItemsExtraCharge'],$html);
$html = str_replace("--coupon",$AlbumList['couponApplyDiscount'],$html);
$html = str_replace("--save_amt",$AlbumList['numberOfItemssave'],$html);


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


$html = str_replace("--amount_with_words",$inWrd,$html);

$html = str_replace("--items",$itm,$html);
$html = str_replace("tinymceuploads/","https://machooosinternational.com/admin/tinymceuploads/",$html);


$html = str_replace("₹",'&#8377;',$html);




$sqlU = "SELECT b.*,c.short_name,a.firstname,a.lastname,a.email FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 
$UserList = $DBC->query($sqlU);
$UserList = mysqli_fetch_assoc($UserList);

$eventUser = $UserList['firstname']." ".$UserList['lastname'];
$eventUserEmail = $UserList['email'];


$html = str_replace("--username",$eventUser,$html);
$html = str_replace("--address",$UserList['address'],$html);
$html = str_replace("--city",$UserList['city'],$html);
$html = str_replace("--state",$UserList['state'],$html);
$html = str_replace("--country",$UserList['short_name'],$html);
$html = str_replace("--zip",$UserList['zip'],$html);

print_r($html);



// // Convert the HTML to a PDF
// $pdf->writeHTML($html, true, false, true, false, '');

// // Output the PDF as a download
// $pdf->Output('invoice.pdf', 'D');



// print_r($html);

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
