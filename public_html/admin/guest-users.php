<?php 

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
    <h1> Guest Users</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="guest-users.php" role="button" >Guest Users</a></li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"></h5>


                <table class="table table-striped mt-4" id="UsersListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Create From</th>
                        <th scope="col">Created In</th>
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
</section>





<?php 

include("templates/footer.php")

?>

<script>
    $( document ).ready(function() {
        getGuestUsers();
    
    });

    function getGuestUsers(){
       
        successFn = function(resp)  {
            $('#UsersListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#UsersListTable').DataTable({
                "language": {
                    "emptyTable": "No users available"
                },
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
                { "data": "phone" },
                { "data": "callFrom" },
                { "data": "created_in" },
                // { "data": "created_in",
                //     "render": function ( data, type, full, meta ) {

                //          // Specify the target date and time
                //         var targetDate = new Date(data);

                //         // Calculate the time difference in milliseconds
                //         var timeDifference = new Date(full.nowtime) - targetDate.getTime();

                //         // Convert milliseconds to minutes
                //         var minutesAgo = Math.floor(timeDifference / (1000 * 60));

                //         if(minutesAgo < 1440){
                //             var hours = Math.floor(minutesAgo / 60);
                //             if(hours == 0) var activityTime = minutesAgo +" min" ;
                //             else var activityTime = hours +" hrs" ;
                            
                            
                        
                //         }else{
                //         var daysAgo = Math.floor(minutesAgo / (60 * 24));
                //         var activityTime = daysAgo +" day" ;
                //         }
                //         return  activityTime ;
                //     }
                // },
                
                 
              {"data":null,"render":function(item){
                  
                  if(item.deleted == 1){
                      var str = '<span class="badge bg-primary text-white" onclick="deactivateUser('+item.id+',0);" style="cursor:pointer">Activate</span>';
                  }else{
                      var str = '<span class="badge bg-danger text-white" onclick="deactivateUser('+item.id+',1);" style="cursor:pointer">Deactivate</span>';
                  }
                  
                  
                return str;
                    
                    }
                },
             
              
                
                ]
            });
        }
        data = {"function": 'Dashboard', "method": "getGuestUsers"  };
        
        apiCall(data,successFn);

    }
    
    
    function deactivateUser(id,val){
        if(val == 1) var dis = 'deactivate';
        else var dis = 'activate';
     
         return new swal({
                 title: "Are you sure?",
                 text: "You want to "+dis+" this user",
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
                                     title: "Successfully "+dis+" this user",
                                     showConfirmButton: false,
                                     timer: 1500
                                 });
                                 getGuestUsers();
                                 
                             }else{
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'Failed to deactivate user',
                                     showConfirmButton: false,
                                     timer: 1500
                                 });
                             }
                         }
                         data = { "function": 'Dashboard',"method": "deactivateGuestUser" ,"sel_id":id ,'val':val };
                         apiCall(data,successFn);
                     }
             });
    }
     


 </script>
