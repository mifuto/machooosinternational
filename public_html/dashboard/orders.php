 <?php
 
 include("header.php");
 $ordersData = [];
 
 $sqlcart = "SELECT * FROM place_order WHERE user_id=".$user_id." and newpurchaseID !='' order by id desc";


$resultcart = $DBC->query($sqlcart);
$countcart = mysqli_num_rows($resultcart);

if($countcart > 0) {		
    while ($rowcart = mysqli_fetch_assoc($resultcart)) {
        array_push($ordersData,$rowcart);
    }
}
 

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- partial -->


<?php if(count($ordersData) > 0) { ?>



 




        <div class="content-wrapper">
          <h5 class="page-heading ">Orders</h5>
          
          
          <div class="row mb-2">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">My Orders</h5>
                  <div class="table-responsive">
                    <table class="table center-aligned-table">
                        
                      <thead>
                        <tr class="text-primary">
                          <th>No</th>
                          <th>Transaction ID</th>
                          <th>Orginal Price</th>
                          <th>Discount</th>
                          <th>Extra Charge</th>
                          <th>Coupon</th>
                          <th>Created</th>
                          <th>Status</th>
                          <th>Price</th>
                          <th></th>
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
                                            $numberOfItemsExtraCharge = $album['numberOfItemsExtraCharge'];
                                            $couponApplyDiscount = $album['couponApplyDiscount'];
                                            $numberOfItemsTotalAmount = $album['numberOfItemsTotalAmount'];
                                            $razorpay_payment_status = $album['razorpay_payment_status'];
                                            
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
                                                        
                                    ?>
                          
                          
                                        <tr class="">
                                          <td><?=$i?></td>
                                          <td>#<?=$newpurchaseID?></td>
                                          <td>₹<?=$numberOfItemsPrice?></td>
                                          <td>-₹<?=$numberOfItemsDiscount?></td>
                                          <td>₹<?=$numberOfItemsExtraCharge?></td>
                                          <td>-₹<?=$couponApplyDiscount?></td>
                                          <td><?=$formattedExpDate?></td>
                                          
                                          <?php if($razorpay_payment_status == 1){ ?>
                                                <td><label class="badge badge-success">Success</label></td>
                                                  <td>₹<?=$numberOfItemsTotalAmount?></td>
                                                  <td><a href="view-order.php?purchaseID=<?=$decodeId?>" class="btn btn-primary btn-sm">View</a></td>
                                                  <td><a onclick="printNow(<?=$id?>);" role="button" class="text-primary">
                                                     <i class="bi bi-printer-fill"></i>
                                                  </a></td>
                                                  <td><a onclick="downloadNow(<?=$id?>,`<?=$newpurchaseID?>`);" role="button" class="text-primary">
                                                      <i class="bi bi-download"></i>
                                                  </a></td>
                                              
                                          <?php }else{ ?>
                                                <td><label class="badge badge-danger">Failed</label></td>
                                                  <td>₹<?=$numberOfItemsTotalAmount?></td>
                                                  <td><a href="view-order.php?purchaseID=<?=$decodeId?>" class="btn btn-primary btn-sm">View</a></td>
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
          
          
          
                
                
        </div>
        
        
        
<?php } else { ?>

 <div class="content-wrapper">

     <div class="card-deck" id='viewAddress'>
                    <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4" style="min-height:295px;background-color: transparent;">
                      <div class="card-body">
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <h3 class="card-title ">There is no order yet</h3>
                        </div>
                       
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column " >
                            <img src="/images/no-order.JPG" style="background-size: cover; background-position: center;height:auto;width:30%;"></img>
                         
                        </div>
                        
                        <div class="row d-flex align-items-center justify-items-center flex-column">
                         <label class="card-title text-muted">No order found! Kindly check your check out page or try to order something.</label>
                        </div>
                        
                     
                        
                        
                      </div>
                    </div>
                
                </div>
                
    </div>

<?php } ?>
        
      
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
