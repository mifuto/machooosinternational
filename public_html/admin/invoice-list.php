<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Sales') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}

?>

<style>
  @keyframes blink {
    0%, 100% {
      visibility: hidden;
    }
    50% {
      visibility: visible;
    }
  }

  .blink-text {
    animation: blink 1s steps(1) infinite;
  }
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="pagetitle">
    <h1> Invoices for albums</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="#" role="button" >Invoice</a></li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"></h5>
                
                
                 <div class="row mb-3">
                  
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select User</label>
                    <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList" onchange="getInvoiceList();">
                            <!-- <option selected>Select User</option>
                            <option value="1">User1</option>
                                        <option value="2">User2</option> -->
                            </select>
                           
                  </div>
                 
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select date range</label>
                   <input class="form-control select2" type="text" id="date-range-picker">
                           
                  </div>
                  
                   <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select invoice type</label>
                   <select class="form-control select2" aria-label="Default select example" id="invoiceType" name="invoiceType" onchange="getInvoiceList();">
                             <option selected value="">---- All ----</option>
                                <option value="1">Success</option>
                                <option value="0">Failed</option> -->
                            </select>
                           
                  </div>
                  
                  
                   </div>
                  

                  
                   
                   <div class="row mb-3">
                        <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Price</label>
                           <h5 id="disPrice"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Discount</label>
                           <h5 id="disDiscount"></h5>
                        </div>
                        
                         <div class="col-3 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Service Charge</label>
                           <h5 id="disService"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Coupon</label>
                           <h5 id="disCoupon"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted">Sub Total</label>
                           <h5 id="disSubPrice"></h5>
                        </div>

                       
                   </div>
                   
                   
                   <div class="col-sm-12 table-responsive">
                       
                       
                         <table class="table table-striped mt-4" id="ListTable" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Service Charge</th>
                                <th scope="col">Coupon</th>
                                
                                <th scope="col">County</th>
                                <th scope="col">State</th>
                                <th scope="col">District</th>
                                
                                <th scope="col">Created</th>
                                <th scope="col">Status</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
        
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                   </div>
                
                
                  


              

                


                </div>
            </div>
        </div>
    </div>
</section>


<iframe id="printFrame" style="display: none;" title="CustomFileName"></iframe>


<?php 

include("templates/footer.php")

?>

<script>

        // Calculate the end date (today)
      var endDate = moment(); // Use the "moment.js" library for date manipulation
      // Calculate the start date (one month above today)
      var startDate = moment().subtract(1, 'months');

    $( document ).ready(function() {
        
        getusers("usersList");
        $('#usersList').select2();
        
        
          $('#date-range-picker').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            opens: 'left',
            locale: {
              format: 'YYYY-MM-DD',
            },
          });
          
          getInvoiceList();
    
    });
    
  
    $('#date-range-picker').on('apply.daterangepicker', function (ev, picker) {
        endDate = picker.endDate;
        startDate = picker.startDate;
      // Handle the selected date range here
      console.log('Start Date: ' + picker.startDate.format('MM/DD/YYYY'));
      console.log('End Date: ' + picker.endDate.format('MM/DD/YYYY'));
      
      getInvoiceList();
    });
    
    function getTotalCount(){
         var usersList = $('#usersList').val();
        var invoiceType = $('#invoiceType').val();
        
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        const inputDate = new Date(ed); // Create a Date object for the input date
        const nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        const nextDayFormatted = nextDay.toISOString().split('T')[0];
        
        successFn = function(resp)  {
             var eventList = resp.data;
             if(eventList[0]['sumOfTotal'] == null) $('#disPrice').html("₹0");
             else $('#disPrice').html("₹"+eventList[0]['sumOfTotal']);
             
             if(eventList[0]['sumOfDiscount'] == null) $('#disDiscount').html("₹0");
             else $('#disDiscount').html("₹"+eventList[0]['sumOfDiscount']);
             
             if(eventList[0]['sumOfExtraCharge'] == null) $('#disService').html("₹0");
             else $('#disService').html("₹"+eventList[0]['sumOfExtraCharge']);
             
              if(eventList[0]['sumOfCoupon'] == null) $('#disCoupon').html("₹0");
             else $('#disCoupon').html("₹"+eventList[0]['sumOfCoupon']);
             
             if(eventList[0]['sumItemTotal'] == null) $('#disSubPrice').html("₹0");
             else $('#disSubPrice').html("₹"+eventList[0]['sumItemTotal']);
             

            
        }
        data = {"function": 'AlbumSubscription', "method": "getTotalCount" ,"usersList":usersList,'startDate':sd,'endDate':nextDayFormatted,'invoiceType':invoiceType };
        
        apiCall(data,successFn);
        
        
        
    }

  

    function getInvoiceList(){
        
        var usersList = $('#usersList').val();
        var invoiceType = $('#invoiceType').val();
        
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        const inputDate = new Date(ed); // Create a Date object for the input date
        const nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        const nextDayFormatted = nextDay.toISOString().split('T')[0];
        
        getTotalCount();
        

      
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
      
       
        successFn = function(resp)  {
            $('#ListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ListTable').DataTable({
                "language": {
                    "emptyTable": "No invoice available"
                },
                "data": eventList,
                "aaSorting": [],
                "columns": [
                 { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  meta.row + 1;
                    }
                  },
                  { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  full['firstname']+" "+full['lastname'];
                    }
                  },
                  { "data": 'newpurchaseID',
                    render: function ( data ) {
                        return "#"+data;
                    }
                  },
                  { "data": 'numberOfItemsPrice',
                    render: function ( data ) {
                        return "₹"+data;
                    }
                  },
                  { "data": 'numberOfItemsDiscount',
                    render: function ( data ) {
                        return "-₹"+data;
                    }
                  },
                  { "data": 'numberOfItemsExtraCharge',
                    render: function ( data ) {
                        return "₹"+data;
                    }
                  },
                  { "data": 'couponApplyDiscount',
                    render: function ( data ) {
                        return "-₹"+data;
                    }
                  },
                  
                  
                   { "data": 'country',
                    render: function ( data ) {
                        return data;
                    }
                  },
                   { "data": 'state',
                    render: function ( data ) {
                        return data;
                    }
                  },
                   { "data": 'city',
                    render: function ( data ) {
                        return data;
                    }
                  },
                  
                  
                  { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['created_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
               { "data": 'razorpay_payment_status',
                    render: function ( data ) {
                        if(data == 1) return '<span class="text-success"><b>Success</b></span>';
                        else return '<span class=" text-danger"><b>Failed</b></span>';
                        
                        
                    }
                  },
               { "data": 'numberOfItemsTotalAmount',
                    render: function ( data ) {
                        return "₹"+data;
                    }
                  },
             
              
              
                { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        
                        if(full['razorpay_payment_status'] == 1){
                            return '<a role="button" class="text-primary" onclick="printNow('+full['id']+');"><i class="bi bi-printer-fill"></i></a>';
                        } 
                        else return '';
                        
                    }
                  },
                 { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        
                        if(full['razorpay_payment_status'] == 1){
                            return '<a role="button" class="text-primary" onclick="downloadNow('+full['id']+',`'+full['newpurchaseID']+'`);"><i class="bi bi-download"></i></a>';
                        } 
                        else return '';
                        
                    }
                  },
                  
                  { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        
                        if(full['razorpay_payment_status'] == 1){
                            if(full['is_apply_cart'] == 0){
                                return '<a role="button" class="text-primary " onclick="ExtendAlbumNow('+full['id']+');"><i class="bi bi-exclamation-diamond-fill blink-text text-warning"></i> Extend</a>';
                            }else return '';
                            
                        } 
                        else return '';
                        
                    }
                  },
              
                
                ]
            });
        }
        data = {"function": 'AlbumSubscription', "method": "getInvoiceList" ,"usersList":usersList,'startDate':sd,'endDate':nextDayFormatted,'invoiceType':invoiceType };
        
        apiCall(data,successFn);

    }
    
    function ExtendAlbumNow(id){
        successFn = function(resp)  {
            getInvoiceList();
        }
        data = {"function": 'AlbumSubscription', "method": "ExtendAlbumNow" ,"purchaseID":id };
        
        apiCall(data,successFn);
    }
    
    
       
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
