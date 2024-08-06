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
    
    if (strpos($userPermissionsList, 'Service-Provider') === false) {
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
      <h1>Service Requests</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Requests</li>
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
                  <h5 class="card-title">Service Requests</h5>
                </div>
                
                 <div class="col-3 pt-4">
                    <label for="inputText" class=" col-form-label">Select date range</label>
                   <input class="form-control select2" type="text" id="date-range-picker">
                           
                  </div>
                  
                     <div class="col-3 pt-4">
                          <label for="inputText" class=" col-form-label">Select provider</label>
                    <select class="form-control select2" aria-label="Default select example" id="disType" name="disType" onchange="getUserListData();">
                                
                            </select>
                           
                  </div>
                
              
               
              </div> 
              
              
              
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Company Name</th>
                      
                      <th scope="col">Service Name</th>
                    <th scope="col">Description</th>
                    <!--<th scope="col">Price</th>-->
                    
                    <!-- <th scope="col">Number of members</th>-->
                    <!--      <th scope="col">Extra price per head</th>-->
                          
                    
                    
                    <th scope="col">Images</th>
                    <th scope="col">Service adding</th>
                    
                       <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>
                    
                    
                    
                      <th scope="col">Created on</th>
                       <th scope="col">Status</th>
                      
                      
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
    
 

<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Reject Service</h5>
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
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="declineRequest();">Reject</button>
             </div>
          </div>
       </div>
    </div>
</div>
</div>






<!--Create new project modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Service images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
          <div class="modal-body">
              
              <div id="displayCompanyDocumentsDiv" class="pb-4"></div>
              
          
          </div>
          <div class="modal-footer" >
          
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
          </div>
      </form>
    </div>
  </div>
</div>
<!--Create new project modal end-->




    
    

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
  
  
  
  function getAllDoc(id){
     
     $('#displayCompanyDocumentsDiv').html('');

     
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            var images = resp.data;
            imgCount = images.length;
            
            if(images.length > 0){
                
                var disD = '';
                var disD1 = '';

                
               
                
                for(var i=0;i<images.length;i++){
                    
                    var filepath = images[i]['file_path'];
                    disD +='<img src="'+filepath+'" width="100" height="auto"></img> ';

                }
                
              
            }else{
                
               disD +='<p class="text-muted">Service image not uploaded</p>';
             
                
                
            }
            
            $('#displayCompanyDocumentsDiv').html(disD);
            $('#createProjectModal').modal('show');
            
            
            
        }
        
    }
    data = { "function": 'SystemManage',"method": "getAllServiceImages",'selectedServiceId':id };
    
    apiCallForProvider(data,successFn);
 }
  
  
   function getStaff(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select provider</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.company_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getServiceProvider"};
    
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
    
    
 
  
  function getUserListData(){
      

      var disType = $('#disType').val();
      
         
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        var inputDate = new Date(ed); // Create a Date object for the input date
        var nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        var nextDayFormatted = nextDay.toISOString().split('T')[0];
        
      
    
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
              

               { "data": "company_name" },
               { "data": "name" },
               
                  {"data":null,"render":function(item){
                  
                   var description = item.description;
    
                    // Set the maximum length for the text
                    var maxLength = 60;
                
                    // Trim the text and add ellipsis if needed
                    var trimmedText = description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
              
                  return trimmedText;
                
                    
                    }
                },

            //   {"data":null,"render":function(item){
                  
            //     return '₹'+item.price;
                
                    
            //         }
            //     },
                
            //       { "data": "number_of_members" },
              

            //      {"data":null,"render":function(item){
                  
            //         return '₹'+item.additional_member_price;
                    
            //         }
            //     },
                
                
                
              
               {"data":null,"render":function(item){
                  
                return '<span class="text-primary" onclick="getAllDoc('+item.id+');" style="cursor:pointer">View images</span>';
                
                    
                    }
                },
                
                  {"data":null,"render":function(item){
                      
                      return item.service_add;
                      
                  
                    
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
                  
                        if(item.is_accept == 0){
                            return '<b class="text-warning">Pending</b>';
                        }if(item.is_accept == 2){
                            return '<b class="text-danger">Service rejected</b>';
                        }else{
                            return '<b class="text-success">Service accepted</b>';
                        }
                    
                    }
                },
             
              
              
              {"data":null,"render":function(item){
                  var str = '';
                  
                  if( item.is_accept == 0){
                      
                       str +='<span class="badge bg-success" onclick="acceptNow('+item.id+');" style="cursor:pointer">Accept</span>';
                        str +='<span class="badge bg-danger" onclick="rejectNow('+item.id+');" style="cursor:pointer">Reject</span>';
                  
                      
                  }else if(item.is_accept == 2) str += item.reject_description ;
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getProviderServiceUserListData" ,'startDate':sd,'endDate':nextDayFormatted ,"disType":disType };
    
    apiCall(data,successFn);
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
      method: "rejectProviderService",
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
             text: "You want to accept this Service",
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
                     data = { "function": 'SystemManage',"method": "acceptProviderService" ,"sel_id":id };
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