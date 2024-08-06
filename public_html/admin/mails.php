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
  <h1>Mails</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Mails</li>
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
                 
                 
                <div class="col-12 " >
            
            
            
                     <table class="table table-striped mt-4" id="userListTable" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">Username</th>
                             <th scope="col">Subject</th>
                             <th scope="col">Mail ID</th>
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
  </div>
</section>

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
   
    getUserData();
  });
  
  function getUserData(){
      
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
            
               { "data": "usermane" },
                 { "data": "subject" },
                 { "data": "mailID" },
                 
                    { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['created_in']);

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
    data = { "function": 'User',"method": "getUserMailAlbumList" };
    
    apiCall(data,successFn);
      
      
  }
  
 

</script>