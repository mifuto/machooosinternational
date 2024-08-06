<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Cards') === false) {
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
    <h1>Card service used</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="#" role="button" >Card service used</a></li>
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
                            <label for="inputText" class=" col-form-label">Select user</label>
                            <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList" onchange="getAllUserDetails();">
                                   
                            </select>
                              <div class="invalid-feedback">
                                        Please select the user!.
                                        </div>
                                   
                          </div>
                          
                           <div class="col-3">
                           
                                   
                          </div>
                          
                           <div class="col-6 pt-4 " align="right">
                              <button class="btn btn-primary " onclick="addUserUseService();">Add user use service</button>
                            </div>
                     
                  
                    </div>
                    
                    
                    <div class="col-sm-12 table-responsive mt-4" align="center" id="noUserMessage">
                        <h3 class="text-secondary">Please select user</h3>
                     </div>
                    
                    
                    
                    <div class="col-sm-12 table-responsive d-none" id="listUserDiv">
                        <table class="table table-striped mt-4 " width="100%" id="userListTable">
                          <thead>
                             <tr>
                                 <th scope="col">#</th> 
                                <th scope="col">Card</th>
                                 <th scope="col">Card Number</th>
                                  <th scope="col">Service</th>
                                  <th scope="col">Description</th>
                                  
                                  <th scope="col">County</th>
                                 <th scope="col">State</th>
                                  <th scope="col">District</th>
                                  
                                  <th scope="col">Date</th>

                                
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

<!-- Modal body -->
<div class="d-none"  id="registerModalBody">
    
</div>




<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Add user use service</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
              
            <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Selected main user</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpMainUser" name="inpMainUser" disabled>
                   
                </div>
             </div>
             
          
             
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Active card</label>
                <div class="col-12">
                    
                    <select class="form-control select2" aria-label="Default select example" id="inpUserActiveCardNumber" name="inpUserActiveCardNumber" onchange="changeActiveCard();">
                        </select>
                    <div class="invalid-feedback">
                      Please select active card!.
                   </div>
                </div>
             </div>
          
             
              <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Card Expire</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpUserActiveCardExpire" name="inpUserActiveCardExpire" disabled>
                   
                </div>
             </div>
             
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Select active service</label>
                <div class="col-12">
                        <select class="form-control select2" aria-label="Default select example" id="inpUserActiveService" name="inpUserActiveService">
                        </select>
                   <div class="invalid-feedback">
                      Please select the service!.
                   </div>
                </div>
             </div>
             
              <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter description</label>
                <div class="col-12">
                   <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>
                   <div class="invalid-feedback">
                      Please enter the description!.
                   </div>
                </div>
             </div>
             
             
             
             
             <div class="row mb-3">
                <label  class="col-12 col-form-label text-danger d-none" id="errMeg"></label>
                <label  class="col-12 col-form-label text-success d-none" id="succssMeg"></label>
             </div>
          </div>
       </div>
       <div class="modal-footer">
          <div class="row mb-3" align="right">
             <div class="float-right">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
                </button>
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="createServiceUsed();">Save</button>
             </div>
          </div>
       </div>
    </div>
</div>
</div>






<?php 

include("templates/footer.php")

?>

<script>

    var selUserId = "";
    var selUserCardId = "";
    var selUserExpDate = '';
    var selUserOrderId = '';
    
     var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    

     
    $( document ).ready(function() {
        getcardusers("usersList");
        $('#usersList').select2();
    
    });
    
    
    function getAllUserDetails(){
         var selUser = $('#usersList').val();
         
         if(selUser == ""){
             $('#listUserDiv').addClass('d-none');
             $('#noUserMessage').removeClass('d-none');
         }else{
             $('#listUserDiv').removeClass('d-none');
             $('#noUserMessage').addClass('d-none');
             $('#usersList').removeClass('is-invalid');
             
             getUserServiceUsedData();
             
         }
         
         
         return false;
         
         
      
    }
    
    function changeActiveCard(){
        var selUser = $('#usersList').val();
        var inpUserActiveCard = $('#inpUserActiveCardNumber').val();
        $("#inpUserActiveCardExpire").val('');
         $('#inpUserActiveCardNumber').removeClass('is-invalid');
        
        
        $('#errMeg').addClass('d-none');
        $('#errMeg').html('');
        
         successFn = function(resp)  {
                // resp = JSON.parse(resp);
                
                if(resp["status"] == 1){
                    
                    var users = resp["data"]['card'];
                    
              
                    $("#inpUserActiveCardExpire").val(users['exp_date']);
                    
                    selUserCardId = users['card_id'];
                    
                    
                    selUserExpDate = users['exp_date'];
                    selUserOrderId = users['order_id'];
                    
                    var serviceD = resp["data"]['service'];
                    var options = "<option selected value=''>Select service</option>";
                    
                    var isRun = true;
                    
                      $.each(serviceD, function(key,value) {
                          isRun = false;
                        options += "<option value='"+value.id+"'>"+value.CardService+"</option>";
                      });
                      
                      
                      $("#inpUserActiveService").html(options);
                    //   $("#inpUserActiveService").select2();
                    
                    if(isRun){
                        $('#errMeg').removeClass('d-none');
                        $('#errMeg').html('No active services are currently available.');
                    }
                    
                   
                    
                }else{
                    
                     Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No active cards available for selected user',
                    });
                    
                    
                    
                }
                
               

              
            }
            data = { "function": 'AlbumSubscription',"method": "getUserCardDetailsNew" , "order_id":inpUserActiveCard, "selUser":selUser };
            
            apiCall(data,successFn);
        
        
        
        
        
    }
    
    
    
    
    function addUserUseService(){
        var selUser = $('#usersList').val();
        var selUserName = $('#usersList option:selected').text();
        
        
        if(selUser == ""){
            $('#usersList').addClass('is-invalid');
             return false;
         }else{
             
            $('#usersList').removeClass('is-invalid');
            selUserId = selUser;
            $("#inpMainUser").val(selUserName);
            
            
              successFn = function(resp)  {
                // resp = JSON.parse(resp);
                
                if(resp["status"] == 1){
                    
                    var users = resp["data"]['card'];
                    
                    var options = "<option selected value=''>Select active card</option>";
                    
                      $.each(users, function(key,value) {
                        options += "<option value='"+value.order_id+"'>"+value.card_number+" ("+value.CardName+")</option>";
                      });
                      
                      
                      $("#inpUserActiveCardNumber").html(options);
                      
                      $("#inpUserActiveCardExpire").val('');
                      $("#inpUserActiveService").html('');
                    
                    
                    
                }else{
                    
                     Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No active cards available for selected user',
                    });
                    
                    
                    
                }
                
               

              
            }
            data = { "function": 'AlbumSubscription',"method": "getUserCardDetails" , "selUser":selUser};
            
            apiCall(data,successFn);
            
            
            
            $('#submitLoadingButton').addClass('d-none');
            $("#submitButton").removeClass("d-none");
            
            $('#inpUserActiveService').removeClass('is-invalid');
            $("#inpUserActiveService").val('').trigger('change');
            
            $('#inpDescription').removeClass('is-invalid');
            $("#inpDescription").val("");
            
            
            $('#errMeg').addClass('d-none');
            $('#succssMeg').addClass('d-none');
            $("#addUserModal").modal('show');
                        
              
            
       
         }
        
    }
    
    
    
     
    function createServiceUsed(){
        
        $('#errMeg').addClass('d-none');
        $('#succssMeg').addClass('d-none');
        
        $('#inpUserActiveService').removeClass('is-invalid');
        $('#inpDescription').removeClass('is-invalid');
        $('#inpUserActiveCardNumber').removeClass('is-invalid');
        
        
        
    
        // Convert the given date string to a Date object
        var parsedDate = new Date(selUserExpDate);
        
        // Get today's date
        var today = new Date();
        

        // Check if the given date is less than or equal to today's date
        if (parsedDate <= today) {
            // alert("The given date is less than or equal to today.");
            $('#errMeg').removeClass('d-none');
            $('#errMeg').html('Card is expired');
            return false;
        } 

        
        var inpUserActiveService = $('#inpUserActiveService').val();
        var inpDescription = $('#inpDescription').val();
         var inpUserActiveCardNumber = $('#inpUserActiveCardNumber').val();
         
          
        if(inpUserActiveCardNumber == ""){
            $('#inpUserActiveCardNumber').addClass('is-invalid');
            return false;
        }
        
        if(inpUserActiveService == ""){
            $('#inpUserActiveService').addClass('is-invalid');
            return false;
        }
        
          if(inpDescription == ""){
            $('#inpDescription').addClass('is-invalid');
            return false;
        }
      
        
        $('#submitLoadingButton').removeClass('d-none');
        $("#submitButton").addClass("d-none");
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
                
                $("#addUserModal").modal('hide');
                getUserServiceUsedData();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully create record ',
                    showConfirmButton: false,
                    timer: 1500
                });
                

            }else{
                $('#errMeg').removeClass('d-none');
                $('#errMeg').html('Something went wrong please try again');
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
            }
           
            
          
        }
        data = { "function": 'AlbumSubscription',"method": "createServiceUsed" ,"user_id":selUserId , "card_id":selUserCardId,'service_id':inpUserActiveService , 'description':inpDescription,'order_id':selUserOrderId };
        
        apiCall(data,successFn);
 
        
        
        
    }
    
    
     function getUserServiceUsedData(){
        
            var selUser = $('#usersList').val();
         
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
                    { "data": "CardName" },
                       { "data": "card_number" },
                         { "data": "CardService" },
                         { "data": "description" },
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
                     
                    ],
                    "language": {
                        "zeroRecords": "No services used"
                    }
                });
        
            }
            data = { "function": 'AlbumSubscription',"method": "getUserServiceUsedData","user_id":selUser };
            
            apiCall(data,successFn);
    }

    
    
    
    
    
  

 </script>
