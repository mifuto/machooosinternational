<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'System-settings') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?>

<div class="pagetitle">
    <h1> Manage Cron Job</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="#" role="button" >Manage Cron Job</a></li>
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
                    <label for="inputText" class=" col-form-label">Select Album</label>
                    <select class="form-control select2" aria-label="Default select example" id="disType" name="disType" onchange="getCronJobs();">
                            
                                <option value="1">Expiring & Expired</option>
                                <option value="2">Wishes & events</option> 
                                <option value="3">Cards</option> 
                            </select>
                           
                  </div>
                  </div>
                  
                   
                  
                
                
                  


                <table class="table table-striped mt-4" id="ListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Error</th>

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
        getCronJobs();
    
    });

    function getCronJobs(){
        
        var disType = $('#disType').val();

          
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
      
       
        successFn = function(resp)  {
            $('#ListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ListTable').DataTable({
                "language": {
                    "emptyTable": "No data available"
                },
                "data": eventList,
                "aaSorting": [],
                "columns": [
                 { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  meta.row + 1;
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
                    
                  
                    if (data['status'] =="Started") {
                      return '<span class="badge bg-primary text-white"  style="cursor:pointer">Started</span>';
                    } else if (data['status'] =="Error") {
                        
                       return '<span class="badge bg-danger text-white"  style="cursor:pointer">Error</span>';
                      
                    } else {
                      return '<span class="badge bg-success text-white"  style="cursor:pointer">Success</span>';
                    }
                    
                }
              },
              
              
              
              
                { "data": "error" },
              
                
                ]
            });
        }
        data = {"function": 'Dashboard', "method": "getCronJobs" ,"disType":disType };
        
        apiCall(data,successFn);

    }


 </script>
