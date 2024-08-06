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
  <h1>Manage user albums</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Manage user albums</li>
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
                    <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList">
                          
                            </select>
                            <div class="invalid-feedback">
                            Please select a user!.
                            </div>
                  </div>
                  
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select Album</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumList" name="albumList">
                            
                                <option value="OA">Online album</option>
                                <option value="SA">Signature album</option> 
                            </select>
                            <div class="invalid-feedback">
                            Please select a album!.
                            </div>
                  </div>
                  
                    <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select Album Type</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumTypeList" name="albumTypeList">
                                <option value="">All albums</option>
                                <option value="1">Active albums</option>
                                <option value="2">Expired albums</option> 
                                <option value="3">Expiring albums</option> 
                            </select>
                            <div class="invalid-feedback">
                            Please select a album!.
                            </div>
                  </div>
                  
                <div class="col-3 pt-3 " >
                    <br>
                  <button class="btn btn-primary " onclick="getUserData();">Search</button>
                </div>
                
                
                
                <div class="col-sm-12 table-responsive" >
            
            
            
                     <table class="table table-striped mt-4" id="userListTable" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">User</th>
                             <th scope="col">Event Name</th>
                              <th scope="col">Expiry Date</th>
                              
                              <th scope="col">County</th>
                             <th scope="col">State</th>
                              <th scope="col">District</th>

                              <th scope="col">Create Date</th>
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
  </div>
</section>








<?php 

include("templates/footer.php")

?>
<script>



  $( document ).ready(function() {
    getusers("usersList");
    $('#usersList').select2();
    getUserData();
  });
  
 
  function getUserData(){
      var userId = $('#usersList').val();
      var albumType = $('#albumList').val();
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
                    
                    var date = new Date(data['expiry_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
              
               { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
           
              
              
                  { "data": "created_date" },
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
              },
                  
                  
                  
                   { "data": null,
                render: function ( data ) {
                    
                    // Create a Date object for the current date (today)
                    var today = new Date();
                    
                    // Create a Date object for the date you want to compare (2023-09-05)
                    var targetDate = new Date(data['expiry_date']);
                    
                    // Compare the two dates
                    if (targetDate.toDateString() === today.toDateString()) {
                      return '<span class="badge bg-primary text-white"  style="cursor:pointer" onclick="sendAlbumMail(`'+albumType+'`,'+data['id']+',1,0);">Send mail</span>';
                    } else if (targetDate > today) {
                        
                        var timeDifference = targetDate.getTime() - today.getTime();

                        // Calculate the number of days by dividing the time difference by the number of milliseconds in a day
                        var numberOfDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                        if(numberOfDays <= 30 ){
                            return '<span class="badge bg-primary text-white"  style="cursor:pointer" onclick="sendAlbumMail(`'+albumType+'`,'+data['id']+',1,'+numberOfDays+');">Send mail</span>';
                        }else{
                            return '';
                        }
                        
                      
                      
                    } else {
                         var timeDifference =  today.getTime() - targetDate.getTime();

                        // Calculate the number of days by dividing the time difference by the number of milliseconds in a day
                        var numberOfDays = Math.ceil(timeDifference / (1000 * 60 * 60 * 24));
                        
                      return '<span class="badge bg-primary text-white"  style="cursor:pointer" onclick="sendAlbumMail(`'+albumType+'`,'+data['id']+',2,'+numberOfDays+');">Send mail</span>';
                    }
                    
                }
              },
               
              
              
          
            ]
        });

    }
    data = { "function": 'User',"method": "getUserAlbumList","userId":userId,"albumType":albumType,"albumDisType":albumDisType,"todayDate":todayDate };
    
    apiCall(data,successFn);
      
      
  }
  
  
  function sendAlbumMail(type,albumId,mail,days){
     
       return new swal({
        title: "Are you sure?",
        text: "You want to send mail",
        icon: false,
        buttons: true,
        // dangerMode: true,
        confirmButtonText: 'Yes',
        showCancelButton: true
        
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp)  {
                    // console.log("rrerere");
                    if(resp.status == 1){
                       
                        swal.fire({
                            icon: 'success',
                            title: 'success',
                            text: "Successfully send mail",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                    }else{
                         swal.fire({
                            icon: 'error',
                            title: 'error',
                            text: "Failed to send mail",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                    }
                }
                data = { "function": 'User',"method": "sendAlbumMail", "type" : type ,"albumId": albumId, "mail" : mail,"days":days };
                apiCall(data,successFn);
            }else{
                console.log("sdsds");
      
            }
    });
      
      
      
      
  }
  


</script>