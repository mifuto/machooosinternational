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
    
    if (strpos($userPermissionsList, 'User-management') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?> 
<div class="pagetitle">
  <h1>Users details by event type</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
</div>
<!-- End Page Title -->
<section class="section">
  <div class="row">
       
    <div class="col-lg-12">
      <div class="card">
          
                <div class="row " style="padding:10px;">
                  
                    <div class="col-6">
                        
                        
                         <div class="row " style="padding:10px;">
                            <label for="" class="col-12 col-form-label">Event Type</label>
                           
                            <div class="col-12">
                                
                                 <input class="form-control" type="text" id="EventType" name="EventType" value="Hospital newborn baby shoot">
                                
                                <div class="invalid-feedback">
                                Please enter the Event Type!.
                                </div>
                            </div>
                            
                        </div>
                        
                         
                    </div>
                    
                    <div class="col-6">
                        
                        
                         <div class="row " style="padding:10px;">
                            <label for="" class="col-12 col-form-label">&nbsp;</label>
                           
                            <div class="col-12">
                                
                               <input type="button" value="Search" class="btn btn-primary" onclick="getEventTypeUserData();">
                            </div>
                            
                        </div>
                        
                         
                    </div>
                    
                </div>
                
                
                
                <div class="d-none" id="displayUserDetails">
                    
                    <hr>
                    
                   
          
                    <div class="card-body table-responsive ">
                        
                      <!-- <h5 class="card-title"></h5> -->
                      <!-- Default Table -->
                      <table class="table table-striped mt-4" id="userListTable" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                             
                            <th scope="col">User</th>
                             <th scope="col">Mail id</th>
                             <th scope="col">UserId</th>
                              <th scope="col">Cont Num</th>
                              
                              <th scope="col">County</th>
                             <th scope="col">State</th>
                              <th scope="col">District</th>
                              
                             
                            
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

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      getEventTypeUserData();

  });
  
  function getEventTypeUserData(){
      var EventType = $('#EventType').val();
      if(EventType == ""){
          $('#displayUserDetails').addClass('d-none');
          $('#EventType').addClass('is-invalid');
            return false;
      }
      
      getuUersList(EventType);
      
      
  }
  
  
  getuUersList = (EventType) => {
    
      
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
                    console.log(data);
                    return data['firstname']+" "+data['lastname'];
                }
              },
             
               { "data": "email" },
                { "data": "userid" },
                 { "data": "phonenumber" },
                  { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
              
          
            ]
        });
        
        $('#displayUserDetails').removeClass('d-none');

    }
    data = { "function": 'User',"method": "getEventTypeUserList",'EventType':EventType };
    
    apiCall(data,successFn);
}

</script>