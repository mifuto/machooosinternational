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
    <h1> Countries</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="countries.php" role="button" >Countries</a></li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"></h5>
                
               

                <table class="table table-striped mt-4" id="ListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Short name</th>
                        <th scope="col">Long name</th>
                       

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
        getCountries();
    
    });

    function getCountries(){
        
      
       
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
                 
              
                { "data": "short_name" },
                { "data": "long_name" },
              
                
                ]
            });
        }
        data = {"function": 'SystemManage', "method": "getCountries"  };
        
        apiCall(data,successFn);

    }


 </script>
