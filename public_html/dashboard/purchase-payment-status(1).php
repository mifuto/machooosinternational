 <?php
 
 include("header.php");
 
 if (!isset($_REQUEST['purchaseID'])) {
    
   echo "<script type='text/javascript'>
    // Your JavaScript code here
    window.location.href = 'my-cards.php';
</script>";

die;
}
 
$projIdString = str_rot13($_REQUEST['purchaseID']);
$projIdString = base64_decode($projIdString);

$arr = explode('_', $projIdString);
$purchaseID = $arr[1];

$timestamp = time();
$setT = 'MI'.$timestamp.'C'.$purchaseID;

$newpurchaseID = str_rot13($setT);


 
$sql1 = "SELECT b.*,c.short_name,a.firstname,a.lastname,a.email FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 

    
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
    
  $sql4 = "SELECT * FROM place_order_card WHERE id='$purchaseID' "; 

    
$result4 = $DBC->query($sql4);
$row4 = mysqli_fetch_assoc($result4);

$invoice_snt = $row4['invoice_snt'];
$razorpay_payment_status = $row4['razorpay_payment_status'];

?>

<!-- partial -->
        <div class="content-wrapper">
          <h5 class="page-heading ">Complete Order</h5>
          
                <div class="card-deck">
                    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 " style="background-color: transparent;">
                      <div class="card-body">
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <h1 class="card-title ">Thank you for your order</h1>
                        </div>
                        
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                            
                            <?php if($row4['razorpay_payment_status'] == 1){ ?>
                                <label class="card-title mb-4 text-muted">Your order #<?=$row4['newpurchaseID'];?> <b class="text-success">SUCCESS</b> , Invoice sent an email <b><?=$row1['email']?></b> </label>
    
                            <?php }else if($row4['razorpay_payment_status'] == 0){ ?>
                            
                                <label class="card-title mb-4 text-muted">Your order #<?=$row4['newpurchaseID'];?> <b class="text-danger">FAILED</b> , Invoice sent an email <b><?=$row1['email']?></b> </label>
                            
                            <?php }else{ ?>
                                <label class="card-title mb-4 text-muted">Your order #<?=$row4['newpurchaseID'];?> PENDING </label>
                            <?php } ?>
                         
                        </div>
                        
                     
                       
                        
                        
                      </div>
                    </div>
                
                </div>
                
                
                
                <div class="row">
                    
                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 mb-4">
                        
                        
                        
                        
                        
                        
                    </div>
                
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-4">
                        
                        
                        <div class="card-deck" >
                            <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" >
                              <div class="card-body">
                                <h5 class="card-title mb-4">Have a Question?</h5>
                                <div class="row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                           <i class="fa fa-phone"></i> &nbsp;&nbsp;<a href="tel:+919809996333">+91 9809996333</a>
                                         </p>
                                        
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                           <i class="fa fa-envelope"></i> &nbsp;&nbsp;<a href="mailto:machooosinternational@gmail.com">machooosinternational@gmail.com</a>
                                         </p>
                                        
                                    </div>
                                    
                                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-flex align-items-left justify-items-left ">
                                        <p class="text-dark">
                                           <i class="fa fa-comment-o"></i> &nbsp;&nbsp;<a href="https://api.whatsapp.com/send?phone=9809996333" target="_blank">Chat with us</a>

                                         </p>
                                        
                                    </div>
                                    
                                  
                                 
                                </div>
                                
                               
                                
                              </div>
                            </div>
                        
                        </div>
                        
                        
                        
                        
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
    document.getElementById("menu5").classList.remove("active");
    document.getElementById("menu4").classList.add("active");
    document.getElementById("menu8").classList.remove("active");
    
    $(document).ready(function() {
        var invoice_snt = '<?=$invoice_snt?>';
        var razorpay_payment_status = '<?=$razorpay_payment_status?>';
        if(invoice_snt == 0 && razorpay_payment_status == 1) sendInvoice();
    });
    
    function sendInvoice(){
        var purchaseID = '<?=$purchaseID?>';
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
   

</script>