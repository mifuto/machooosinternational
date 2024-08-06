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
  <h1>Users Details</h1>
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
          
          <div class="d-none" align="right" id="DBTN1" style="padding:10px;">
              <a class=" text-primary" onclick="downloadMainUserDatas();"> <h5>Download <i class="bi bi-cloud-arrow-down-fill"></i></h5></a>
          </div>
          
          
        <div class="card-body table-responsive mt-4">
            
          <!-- <h5 class="card-title"></h5> -->
          <!-- Default Table -->
          <table class="table table-striped mt-4" id="userListTable" width="100%">
            <thead>
              <tr>
                 <th scope="col">#</th> 
                <th scope="col">User</th>
                 <th scope="col">Mail id</th>
                  <th scope="col">Cont Num</th>
                  
                  <th scope="col">County</th>
                 <th scope="col">State</th>
                  <th scope="col">District</th>
                  
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
</section>

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      getuUersList();

  });
  
  function downloadMainUserDatas(){
      
      var dataTable = $('#userListTable').DataTable();
      
      var columnData = dataTable.column(1).data().toArray();
    
        var mailArr = [];
        var mailChkArr = [];
    
        columnData.forEach(function(element) {
            
            var inserD = [ element['email'] , element['firstname']+ " "+ element['lastname'] , element['phonenumber'] , element['expiry_date'] ];
            var inserCD = element['email'];
            
            if (mailChkArr.indexOf(inserCD) === -1) {
                mailArr.push(inserD);
                mailChkArr.push(inserCD);
            }
         
            
        });
        
        
        successFn = function(resp)  {
            window.location.href = resp.data;
        }
        data = { "function": 'SignatureAlbum',"method": "DwdMainUserExcelList" ,'data':mailArr};
            
        apiCall(data,successFn);
        
    
      
      
      return false;
      
  }
  
  
  getuUersList = () => {
      $('#DBTN1').addClass('d-none');
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
                 { "data": "phonenumber" },
                  { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
                  { "data": "datecreated" },
               
              
              
          
            ]
        });
        
        $('#DBTN1').removeClass('d-none');

    }
    data = { "function": 'User',"method": "getUserList" };
    
    apiCall(data,successFn);
}

</script>