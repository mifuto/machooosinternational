<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['user_id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}
include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Reports') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?> 
<div class="pagetitle">
  <h1>Online albums</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Online album</li>
    </ol>
  </nav>
</div>
<!-- End Page Title -->
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title"></h5>
           
              
               <div class="row mb-3">
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select User</label>
                    <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList" onchange="getUserData();">
                          
                            </select>
                            <div class="invalid-feedback">
                            Please select a user!.
                            </div>
                  </div>
                  
                  
                     <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select Album Type</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumTypeList" name="albumTypeList" onchange="getUserData();">
                                <option value="">All albums</option>
                                <option value="1">Active albums</option>
                                <option value="2">Expired albums</option> 
                                <option value="3">Expiring albums</option> 
                            </select>
                            <div class="invalid-feedback">
                            Please select a album!.
                            </div>
                  </div>
                  
                    <div class="col-6 d-none" align="right" id="DBTN1">
                      <label for="inputText" class=" col-form-label">&nbsp;</label>
                      <a class=" text-primary" onclick="downloadMailPhone();"> <h5>Download <i class="bi bi-cloud-arrow-down-fill"></i></h5></a>
                      
                  </div>
                 
                 
                
                <div class="col-sm-12 table-responsive" >
            
            
            
                     <table class="table table-striped mt-4" id="userListTable" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">User</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Expiry Date</th>
                            
                            
                             <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                             
                              
                              
                              <th scope="col">County</th>
                             <th scope="col">State</th>
                              <th scope="col">District</th>
                              
                              
                              <th scope="col">Create Date</th>
                              <th scope="col">Status</th>

                            
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
  </div>
</section>

<div class="modal fade" id="ViewUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  >
      <div class="modal-header">
        <h5 class="modal-title">Price details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addImgForm" >
          <div class="modal-body" >

          
            <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                
                <div class="col-6">
                    <label for="inputText" class=" col-form-label">How much year</label>
                    <select class="form-control select2" aria-label="Default select example" id="selYear" name="selYear" onchange="getPriceDetails();">
                            <option value="1" selected>One year</option>
                            <option value="3" >Three year</option>
                             <option value="5">Five year</option>
                            <option value="10" >Ten year</option>
                            </select>
                           
                  </div>
                  
                   <div class="col-6 " >
                   <label  class=" col-form-label">&nbsp;</label>
                       <h5 id="orginalPrice"></h5>
                    </div>
                  
                  
                  <br>
                  
                  <div class="col-12 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;margin-top: 20px;">
                       <label for="inputText" class="col-form-label text-muted"> Renew now your price is</label>
                       <h5 id="offer_Price"></h5>
                       <h2 id="disPrice"></h2>
                    </div>
                    
                    <div class="col-12 " style="margin-top: 20px;">
                       <label id="expMeg" class="col-form-label text-danger"></label>
                    </div>
                  
                  
          
          </div>
          <div class="modal-footer">
          
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           
          </div>
      </form>
    </div>
  </div>
</div> 


<?php 

include("templates/footer.php")

?>
<script>

var priceImageCount = 1;
var priceExpDate = '';


  $( document ).ready(function() {
    getusers("usersList");
    $('#usersList').select2();
    getUserData();
  });
  
  
   function downloadMailPhone(){
       
       
        var dataTable = $('#userListTable').DataTable();
      
      var columnData = dataTable.column(1).data().toArray();
    
        var mailArr = [];
        var mailChkArr = [];
    
        columnData.forEach(function(element) {
            
            var inserD = [ element['email'] , element['firstname']+ " "+ element['lastname'] , element['phonenumber'] , element['expiry_date'] ];
            var inserCD = element['email'];
            
            if (mailChkArr.indexOf(inserCD) === -1) {
                mailArr.push(inserD);
                mailChkArr.push(inserCD);
            }
         
            
        });
        
        
        successFn = function(resp)  {
            window.location.href = resp.data;
        }
        data = { "function": 'SignatureAlbum',"method": "DwdOAlbumExcelList" ,'data':mailArr};
            
        apiCall(data,successFn);
        
    
       
       
       return false;
       
       
       
       
    var dataTable = $('#userListTable').DataTable();
    
    var columnData = dataTable.column(1).data().toArray();
    
    var mailArr = [];

    columnData.forEach(function(element) {
        var inserD = element['email'] + " - "+ element['firstname']+ " "+ element['lastname'] + " - "+element['phonenumber'];
        if (mailArr.indexOf(inserD) === -1) {
            mailArr.push(inserD);
        }
        
      
        
    });
    
 
    // Convert array to text
    var arrayText = mailArr.join('\n');

    // Create a Blob containing the text
    var blob = new Blob([arrayText], { type: 'text/plain' });

    // Create a download link
    var downloadLink = document.createElement('a');
    downloadLink.href = window.URL.createObjectURL(blob);
    downloadLink.download = 'online-album-user-info.txt';

    // Append the link to the document
    document.body.appendChild(downloadLink);

    // Trigger a click on the link to start the download
    downloadLink.click();

    // Remove the link from the document
    document.body.removeChild(downloadLink);
        
        
   
   
   
  }
  
  
  function getUserData(){
      
       $('#DBTN1').addClass('d-none');

      var userId = $('#usersList').val();
       var albumDisType = $('#albumTypeList').val();
     
      var d1 = new Date();

    var year1 = d1.getFullYear();
    var month1 = String(d1.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with '0' if needed.
    var day1 = String(d1.getDate()).padStart(2, '0');
    
    var todayDate = `${year1}-${month1}-${day1}`;
      
      
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
      
      
      
       successFn = function(resp)  {
        $('#userListTable').DataTable().destroy();
        var eventList = resp.data;
        console.log(resp);
        // $('#eventListTable').DataTable( { } );
        $('#userListTable').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
            { "data": null,
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              
              { "data": null,
                render: function ( data ) {
                    return data['firstname']+" "+data['lastname'];
                }
              },
               { "data": "event_name" },
               
                      
                  { "data": null,
                        render: function ( data ) {
                             var expiry_date = data['expiry_date'];
                           return '<a class="text-primary"  style="cursor:pointer" onclick="showPrice(`'+expiry_date+'`);">View</a>';
                            
                        }
                      },
                      
                      
                  { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['expiry_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
              
               { "data": null,
                render: function ( data ) {
                    return data['email'];
                }
              },
               { "data": null,
                render: function ( data ) {
                    return data['phonenumber'];
                }
              },
              
              
              
               { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
                 
               
               
                  
              
              
              
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
              
              
            { "data": null,
                render: function ( data ) {
                    
                    // Create a Date object for the current date (today)
                    var today = new Date();
                    
                    // Create a Date object for the date you want to compare (2023-09-05)
                    var targetDate = new Date(data['expiry_date']);
                    
                    // Compare the two dates
                    if (targetDate.toDateString() === today.toDateString()) {
                      return '<span class="badge bg-info text-white"  style="cursor:pointer">Expiring today</span>';
                    } else if (targetDate > today) {
                        
                        var timeDifference = targetDate.getTime() - today.getTime();

                        // Calculate the number of days by dividing the time difference by the number of milliseconds in a day
                        var numberOfDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                        if(numberOfDays <= 30 ){
                            return '<span class="badge bg-warning text-white"  style="cursor:pointer">Expiring in '+numberOfDays+' days</span>';
                        }else{
                            return '<span class="badge bg-success text-white"  style="cursor:pointer">Active</span>';
                        }
                        
                      
                      
                    } else {
                      return '<span class="badge bg-danger text-white"  style="cursor:pointer">Expired</span>';
                    }
                    
                }
              }
                  
                  
                
               
              
              
          
            ]
        });
        
         $('#DBTN1').removeClass('d-none');

    }
    data = { "function": 'OnlineAlbum',"method": "getOAlbumList","userId":userId ,"albumDisType":albumDisType,"todayDate":todayDate };
    
    apiCall(data,successFn);
      
      
  }
  
  function showPrice(expiry_date){
      priceExpDate = expiry_date;
      
      $('#offer_Price').html('');
    $('#disPrice').html('');
    $('#expMeg').html('');
    $('#orginalPrice').html('');
      
      
      getPriceDetails();
      $("#ViewUserModal").modal('show');
      
  }
  
  function getPriceDetails(){
      var selYear = $('#selYear').val();
        var photo_count = 1;
       
        successFn = function(resp)  {
            if(resp.status == 1){
              
               var plan = resp.data;
                    // console.log(plan);
                    
                var newAmt = ( parseInt(plan['amount']) - ( ( parseInt(plan['amount']) / 100 ) * parseInt(plan['pamount']) ) ).toFixed(2) ;
                $('#offer_Price').html(plan['pamount']+'% off');
                $('#disPrice').html('&#8377; ' + newAmt + ' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>'+ '&#8377; ' + plan['amount'] + '</del>' );
                
                var finalPrice = newAmt;
                var expiryDateToCompare = new Date(Date.parse(priceExpDate));
                var currentDate = new Date();
                var today = new Date().toISOString().split('T')[0];
                
                var isExtra = false;
                var isExtraVal = 0;
                var extraAmt = 0;
                

                if (expiryDateToCompare <= currentDate) { 
                 
                    var startDate = new Date(expiryDateToCompare);
                    var endDate = currentDate;
                 
                    var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                    var numberOfDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    
                    if (numberOfDays >= 36524) {
                        extraAmt = ((finalPrice / 100) * 40).toFixed(2) ;

                        var dis = "An additional 40% fee (₹" + extraAmt + ") will be incurred post the expiration of the validity period.";
                        isExtra = true;
                    } else if (numberOfDays >= 1825) {
                        extraAmt = ((finalPrice / 100) * 30).toFixed(2) ;

                        var dis = "An additional 30% fee (₹" + extraAmt + ") will be incurred post the expiration of the validity period.";
                        isExtra = true;
                    } else if (numberOfDays >= 1095) {
                        extraAmt = ((finalPrice / 100) * 30).toFixed(2) ;

                        var dis = "An additional 30% fee (₹" + extraAmt + ") will be incurred post the expiration of the validity period.";
                        isExtra = true;
                    } else if (numberOfDays >= 365) {
                        extraAmt = ((finalPrice / 100) * 10).toFixed(2) ;

                        var dis = "An additional 10% fee (₹" + extraAmt + ") will be incurred post the expiration of the validity period.";
                        isExtra = true;
                    }
                } 
                    
                if(isExtra){
                    $('#expMeg').html(dis);
                    $('#orginalPrice').html('Actual price is &#8377; ' + newAmt );
                    var totalExtraPrice =( parseFloat(finalPrice) + parseFloat(extraAmt)).toFixed(2) ;
                    $('#disPrice').html('&#8377; ' + totalExtraPrice + ' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>'+ '&#8377; ' + plan['amount'] + '</del>' );
                }
                
               

            }
           
            
          
        }
        data = { "function": 'OnlineAlbum',"method": "getPriceDetails" ,"selYear":selYear ,"photo_count":photo_count };
        
        apiCall(data,successFn);
                                                        
        
      
      
  }
  
  

</script>