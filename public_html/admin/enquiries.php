<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Enquiries') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?>



<section >
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10">
                  <h5 class="card-title">Enquiries</h5>
                </div>
               
              </div> 
              <table class="table table-striped mt-4" id="enquiriesListTable" width="100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer name</th>
                    <th scope="col">Customer email</th>
                    <th scope="col">Event type</th>
                    <th scope="col">Event date</th>
                    <th scope="col">Event place</th>
                    <!-- <th scope="col">Occasion type</th> -->
                    <th scope="col">Comments</th>
                    
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
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
      listEnquiries();



 });

 function listEnquiries(){
    
    successFn = function(resp)  {
        $('#enquiriesListTable').DataTable().destroy();
        var eventList = resp.data;
      
        $('#enquiriesListTable').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
               { "data": "id",
              
                    "render": function ( data, type, full, meta ) {
                        return  meta.row + 1;
                    }
               },
               { "data": "customer_name" },
               { "data": "customer_email" },
               { "data": "event_type" },
               { "data": "event_date" },
               { "data": "event_place" },
               { "data": "comments" },
              // { "data": "occasion_type" },
              
             
            ]
        });
    }
    data = { "function": 'Enquiries',"method": "getEnquiriesList" };
    
    apiCall(data,successFn);
 }


 </script>
