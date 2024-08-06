<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']);
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
    
    if (strpos($userPermissionsList, 'Staff-management') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <div class="pagetitle">
      <h1>Insentive Requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Insentive Requests</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   
    
    
    <section id="userListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Insentive Requests</h5>
                </div>
                
                 <div class="col-3 pt-4">
                    <label for="inputText" class=" col-form-label">Select date range</label>
                   <input class="form-control select2" type="text" id="date-range-picker">
                           
                  </div>
                  
                     <div class="col-3 pt-4">
                          <label for="inputText" class=" col-form-label">Select staff</label>
                    <select class="form-control select2" aria-label="Default select example" id="disType" name="disType" onchange="getUserListData();">
                                
                            </select>
                           
                  </div>
                
              
               
              </div> 
              
              
               <div class="row mb-3 pt-2">
                        <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Price</label>
                           <h5 id="disPrice"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Accepted</label>
                           <h5 id="disAccepted"></h5>
                        </div>
                        
                         <div class="col-3 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Paid</label>
                           <h5 id="disPaid"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Total Pending</label>
                           <h5 id="disPending"></h5>
                        </div>
                        
                      

                       
                   </div>
              
              
              
              
              
              
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                     
                      
                      <th scope="col">Project Name</th>
                      <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Role</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    
                     <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>
                      
                      <th scope="col">Created on</th>
                       <th scope="col">Status</th>
                      
                      
                      <th scope="col">Action</th>
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
    
   <div class="modal fade" id="showFullSummaryView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Detailed view</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendSAEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" id="disApplicationSummaryDetails">
                
            </div>
            <div class="modal-footer">
            
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </form>
      </div>
    </div>
  </div>
  
  
  
  



<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Reject Insentive</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
         
             
              <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter description</label>
                <div class="col-12">
                   <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>
                   <div class="invalid-feedback">
                      Please enter the description!.
                   </div>
                </div>
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
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="declineRequest();">Save</button>
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

 // Calculate the end date (today)
      var endDate = moment(); // Use the "moment.js" library for date manipulation
      // Calculate the start date (one month above today)
      var startDate = moment().subtract(1, 'months');
      
      var rejectId = '';
      
  $( document ).ready(function() {
      getUserListData();
      
      getStaff("disType");
      
        $('#date-range-picker').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            opens: 'left',
            locale: {
              format: 'YYYY-MM-DD',
            },
          });
     

  });
  
  
   function getStaff(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select staff</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getAllStaffsData"};
    
    apiCall(data,successFn);
    
}
  
  
  
  
    $('#date-range-picker').on('apply.daterangepicker', function (ev, picker) {
        endDate = picker.endDate;
        startDate = picker.startDate;
      // Handle the selected date range here
      console.log('Start Date: ' + picker.startDate.format('MM/DD/YYYY'));
      console.log('End Date: ' + picker.endDate.format('MM/DD/YYYY'));
      
      getUserListData();
    });
  
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
     function getTotalCount(){
         var disType = $('#disType').val();
      
         
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        var inputDate = new Date(ed); // Create a Date object for the input date
        var nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        var nextDayFormatted = nextDay.toISOString().split('T')[0];
        
        
        successFn = function(resp)  {
             var eventList = resp.data;
             if(eventList['sumOfTotal'] == null) $('#disPrice').html("₹0");
             else $('#disPrice').html("₹"+eventList['sumOfTotal']);
             
             if(eventList['sumOfTotalAccepted'] == null) $('#disAccepted').html("₹0");
             else $('#disAccepted').html("₹"+eventList['sumOfTotalAccepted']);
             
             if(eventList['sumOfTotalPaid'] == null) $('#disPaid').html("₹0");
             else $('#disPaid').html("₹"+eventList['sumOfTotalPaid']);
             
              if(eventList['sumOfTotalPending'] == null) $('#disPending').html("₹0");
             else $('#disPending').html("₹"+eventList['sumOfTotalPending']);
           

            
        }
        data = {"function": 'SystemManage', "method": "getTotalCount" ,'startDate':sd,'endDate':nextDayFormatted ,"disType":disType  };
        
        apiCall(data,successFn);
        
        
        
    }
   
 
  
  function getUserListData(){
      
      var disType = $('#disType').val();
      
         
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        var inputDate = new Date(ed); // Create a Date object for the input date
        var nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        var nextDayFormatted = nextDay.toISOString().split('T')[0];
        
        
        getTotalCount()
   
    
    successFn = function(resp)  {
        $('#eventListTable').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable').DataTable( { } );
        $('#eventListTable').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              
               { "data": "name" },
              
               { "data": "selected_project" },
              
                { "data": null,
                render: function ( data ) {
                    
                  
                    var date = new Date(data['start_date']);

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
                    
                  
                    var date = new Date(data['end_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
                  
                { "data": "description" },
                
              { "data": "role" },
               {"data":null,"render":function(item){
                  
                return '₹'+item.total_paid_amt;
                
                    
                    }
                },
              
               {"data":null,"render":function(item){
                  
                return '<img src="'+item.vedio+'" width="150px" script="max-height:100px" />';
                
                    
                    }
                },
              
             
                
                    { "data": "county_id" },
              { "data": "state_id" },
              { "data": "city_id" },
             
              
              
             
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
              
              
               {"data":null,"render":function(item){
                  
                        if(item.status == 0) return '<b class="text-warning">Pending</b>';
                        else if(item.status == 1){
                            if(item.is_paid == 0){
                                return '<b class="text-success">Accepted</b><hr><b class="text-danger">Cash not paid</b>';
                            }else{
                                return '<b class="text-success">Accepted</b><hr><b class="text-success">Cash paid</b>';
                            }
                            
                            
                            
                        } 
                        else if(item.status == 2) return '<b class="text-danger">Rejected</b>';
                        
                        
                        
                
                    
                    }
                },
             
              
              
              {"data":null,"render":function(item){
                  var str = '<span class="badge bg-info text-dark" onclick="viewDetails('+item.id+');" style="cursor:pointer">View</span>';
                  
                  if( item.status == 0){
                      
                       str +='<span class="badge bg-success" onclick="acceptNow('+item.id+');" style="cursor:pointer">Accept</span>';
                        str +='<span class="badge bg-danger" onclick="rejectNow('+item.id+');" style="cursor:pointer">Reject</span>';
                  
                      
                  }else{
                      
                     if(item.is_paid == 0 && item.status == 1){
                        str +='<span class="badge bg-success" onclick="cashPaid('+item.id+');" style="cursor:pointer">Pay ₹'+item.total_paid_amt+'</span>';
                    }
                      
                  }
                  
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getinsentiveUserListData" ,'startDate':sd,'endDate':nextDayFormatted ,"disType":disType };
    
    apiCall(data,successFn);
}

function viewDetails(id){
    
    $("#disApplicationSummaryDetails").html('');
    
     successFn = function(resp)  {
            if(resp.status == 1){
                
                 $("#showFullSummaryView").modal('show');
              
                var eventList = resp.data;
                
                var disData ='';
                
                disData +='<div class="row ">';
                if(eventList['status'] == 0) disData +='<b class="text-warning">Pending</b>';
                else if(eventList['status'] == 1){
                     disData += '<b class="text-success">Accepted</b><br>';
                     if(eventList['is_paid'] == 0 ) disData += '<label class="text-danger">Cash not paid</label>';
                     else disData += '<label class="text-success">Cash paid</label>';
                    
                }
                else if(eventList['status'] == 2){
                    disData += '<b class="text-danger">Rejected</b><br>';
                    disData += '<label class="text-dark">'+eventList['reject_description']+'</label><br>';
                    
                } 
                disData +='</div><hr>';
                
                disData +='<div class="row ">';
                disData += '<b class="text-success">Insentive amount : ₹'+eventList['total_paid_amt']+'</b><br>';
                
                disData +='</div><hr>';
                
                
                
                disData +='<div class="row ">';
                disData +='<label><b>Full Name : </b>'+eventList['name']+'</label><br>';
                disData +='<label><b>Employee ID/Code : </b>'+eventList['code']+'</label><br>';
                disData +='<label><b>Project Name : </b>'+eventList['selected_project']+'</label><br>';
                disData +='<label><b>Start Date : </b>'+eventList['start_date']+'</label><br>';
                disData +='<label><b>End Date : </b>'+eventList['end_date']+'</label><br>';
                disData +='<label><b>Project Description : </b>'+eventList['description']+'</label><br>';
                disData +='<label><b>Your Role in the Project : </b>'+eventList['role']+'</label><br>';
                disData +='<label><b>Total amount the product : </b>₹'+eventList['total_amt']+'</label><br>';
                disData +='<label><b>Discounted amount : </b>₹'+eventList['discount_amt']+'</label><br>';
                disData +='<label><b>Key Achievements or Contributions to the Project : </b>'+eventList['achievements']+'</label><br>';
                disData +='<label><b>Challenges Faced and How They Were Overcom : </b>'+eventList['challenges']+'</label><br>';
                disData +='<label><b>Share Any Suggestions for Future Project Improvement : </b>'+eventList['suggestions']+'</label><br>';
                disData +='</div><br>';
                
                if(eventList['sel_services_names'] != "" && eventList['sel_services_names'] != null){
                      
                     disData +='<div class="row ">';
                   disData +='<label><b>Staff jobs for Insentive : </b>'+eventList['sel_services_names']+'</label><br>';
                    disData +='</div><br>';
                
                }
              
                
                
                
                disData +='<div class="row ">';
                disData +='<img src="'+eventList['vedio']+'" style="width: 40%;" script="max-height:100px" />';
                disData +='</div>';
                
        
                
                $("#disApplicationSummaryDetails").html(disData);
            

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditInsentiveList" ,"sel_id":id };
        
        apiCall(data,successFn);
    
}


 
  function cashPaid(id){
  
     return new swal({
             title: "Are you sure?",
             text: "To pay cash for this incentive",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                         if(resp.status == 1){
                             Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "payInsentive" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 function rejectNow(id){
    rejectId = id;
    
    
      $('#submitLoadingButton').addClass('d-none');
            $("#submitButton").removeClass("d-none");
          
            $('#inpDescription').removeClass('is-invalid');
            $("#inpDescription").val("");
    $("#addUserModal").modal('show');
    
    
    
}



function declineRequest(){
    
    $('#inpDescription').removeClass('is-invalid');
    
    var inpDescription = $('#inpDescription').val();
    
     if(inpDescription == ""){
        $('#inpDescription').addClass('is-invalid');
        return false;
    }
    
    $('#submitLoadingButton').removeClass('d-none');
    $("#submitButton").addClass("d-none");
    

     postData = {
      function: 'SystemManage',
      method: "rejectInsentive",
      sel_id: rejectId,
      'description':inpDescription,
    }

    console.log(postData);

    successFn = function(resp) {
       if(resp.status==1){
                            Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
      }else{
        Swal.fire({
             icon: 'error',
             title: resp.data,
             showConfirmButton: false,
             timer: 1500
         });
      }
      getUserListData();
      
      $('#submitLoadingButton').addClass('d-none');
    $("#submitButton").removeClass("d-none");
    $("#addUserModal").modal('hide');
      
      
      
    }

    apiCall(postData,successFn);

    return false;

      
  }





//  function rejectNow(id){
  
//      return new swal({
//              title: "Are you sure?",
//              text: "You want to reject this Insentive",
//              icon: false,
//              // buttons: true,
//              // dangerMode: true,
//              showCancelButton: true,
//              confirmButtonText: 'Yes'
//              }).then((confirm) => {
//                  // console.log(confirm.isConfirmed);
//                  if (confirm.isConfirmed) {
//                      successFn = function(resp)  {
//                          if(resp.status == 1){
//                              Swal.fire({
//                                  icon: 'success',
//                                  title: resp.data,
//                                  showConfirmButton: false,
//                                  timer: 1500
//                              });
//                             getUserListData();
                             
//                          }else{
//                              Swal.fire({
//                                  icon: 'error',
//                                  title: resp.data,
//                                  showConfirmButton: false,
//                                  timer: 1500
//                              });
//                          }
//                      }
//                      data = { "function": 'SystemManage',"method": "rejectInsentive" ,"sel_id":id };
//                      apiCall(data,successFn);
//                  }
//          });
// }
 
 

  
  function acceptNow(id){
  
     return new swal({
             title: "Are you sure?",
             text: "You want to accept this Insentive",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                         if(resp.status == 1){
                             Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "acceptInsentive" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
  


</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>