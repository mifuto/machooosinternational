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
    
    if (strpos($userPermissionsList, 'Signature-Album') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?> 
<div class="pagetitle">
  <h1>Signature albums</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Signature album</li>
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
              
               <div class="  m-0 " align="right">
                <a class="btn btn-primary m-0 " href="signatureAbum.php" role="button" >Create new album</a>
              </div>
              
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
                 
                 
                
                <div class="col-12 " >
            
            
            
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
                              <th scope="col">Responses</th>

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
                 
                 
                 
                 
                  {"data":null,"render":function(item){
                   var $ds = item.commentCount+" Cmts";
                   $ds += "<br>"+item.shareCounts+" Shares";
                   $ds += "<br>"+item.viewCounts+" Views";
                   $ds += "<br>"+item.eventsCount+" Events";
                   $ds += "<br>"+item.imageCount+" Images";
                return $ds;
                    
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

    }
    data = { "function": 'SignatureAlbum',"method": "getSAlbumList","userId":userId ,"albumDisType":albumDisType,"todayDate":todayDate };
    
    apiCall(data,successFn);
      
      
  }
  
  
  

</script>