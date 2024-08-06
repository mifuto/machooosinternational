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
    
    if (strpos($userPermissionsList, 'Cards') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?> 
<div class="pagetitle">
  <h1>Card Requests</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item active">Card Requests</li>
    </ol>
  </nav>
</div>
<!-- End Page Title -->
<section class="section">
  <div class="row">
       
    <div class="col-lg-12">
      <div class="card">
          
        
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
                  
                   <th scope="col"></th>
                  
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
</section>







<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Decline request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
         
             
              <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter description</label>
                <div class="col-12">
                   <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>
                   <div class="invalid-feedback">
                      Please enter the description!.
                   </div>
                </div>
             </div>
             
             
            
          </div>
       </div>
       <div class="modal-footer">
          <div class="row mb-3" align="right">
             <div class="float-right">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
                </button>
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="declineRequest();">Save</button>
             </div>
          </div>
       </div>
    </div>
</div>
</div>












<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      getuUersList();

  });
  
  var rejectId = '';
  
 
  
  getuUersList = () => {
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
                 
                 
                   { "data": null,
                    render: function ( data ) {
                        var Rstatus = data['Rstatus'];
                        if(Rstatus == 0){

                            return  '<a class="btn btn-success btn-sm" href="javascript:void(0);" onclick="acceptRequest('+data['Rid']+')">Accept</a><a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="rejectNow('+data['Rid']+')">Decline</a>';
                            
                            
                            
                            
                        }else if(Rstatus == 1) return '<label class="text-success">Accepted</label>';
                        else return '<label class="text-danger">Declined</label>';
                        
                        
                        
                    }
                  },
                  
                   { "data": "description" },
               
              
              
          
            ]
        });
        

    }
    data = { "function": 'AlbumSubscription',"method": "getCardRequestUserList" };
    
    apiCall(data,successFn);
}

function rejectNow(id){
    rejectId = id;
    
    
      $('#submitLoadingButton').addClass('d-none');
            $("#submitButton").removeClass("d-none");
          
            $('#inpDescription').removeClass('is-invalid');
            $("#inpDescription").val("");
    $("#addUserModal").modal('show');
    
    
    
}


function declineRequest(){
    
    $('#inpDescription').removeClass('is-invalid');
    
    var inpDescription = $('#inpDescription').val();
    
     if(inpDescription == ""){
        $('#inpDescription').addClass('is-invalid');
        return false;
    }
    
    $('#submitLoadingButton').removeClass('d-none');
    $("#submitButton").addClass("d-none");
    

     postData = {
      function: 'AlbumSubscription',
      method: "declineCardRequest",
      id: rejectId,
      'description':inpDescription,
    }

    console.log(postData);

    successFn = function(resp) {
      if(resp.status==1){
        Swal.fire(
          'Success',
          resp.data,
          'success'
        )
      }else{
        Swal.fire(
          'Error',
          resp.data,
          'error'
        )
      }
      getuUersList();
      
      $('#submitLoadingButton').addClass('d-none');
    $("#submitButton").removeClass("d-none");
    $("#addUserModal").modal('hide');
      
      
      
    }

    apiCall(postData,successFn);

    return false;

      
  }




 function acceptRequest(id){

    Swal.fire({
      title: 'Are you sure to accept this request?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Accept'
    }).then((result) => {
      if (result.isConfirmed) {

        postData = {
          function: 'AlbumSubscription',
          method: "acceptCardRequest",
          id: id,
        }

        console.log(postData);

        successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Success',
              resp.data,
              'success'
            )
          }else{
            Swal.fire(
              'Error',
              resp.data,
              'error'
            )
          }
          getuUersList();
        }

        apiCall(postData,successFn);
       



      }
    })

    return false;

      
  }




</script>