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
    
    if (strpos($userPermissionsList, 'Provider-management') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>Providers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Providers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   
    
    
    <section id="userListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Providers</h5>
                </div>
                
            
            
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                   <th scope="col">Provider name</th>
                   <th scope="col">Email</th>
                      <th scope="col">Service Center</th>
                     
                     
                        <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>

                      <th scope="col">Created on</th>
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

var rejectId = '';
var isStateEdt = false;
var isUserEdt = false;
var isNumberEdt = false;
var isCityEdt = false;

  $( document ).ready(function() {
     
      getUserListData();
      
   
     

  });
  
     var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
  
   
  
  function getUserListData(){
      

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
            { "data": "email" },
            
            
            
              
             { "data": "center_name" },
              
              
             
              
              
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
           
              
          
             
          
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getloginprovidersUserListData"  };
    
    apiCall(data,successFn);
}



</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>