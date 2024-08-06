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
    
    if (strpos($userPermissionsList, 'Signature-Album') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

<style>
      
        .eventactive{
            color: #6b6b6b !important;
            background:transparent !important;
            border-color: var(--bs-nav-tabs-link-active-border-color);
        }
        
        .eventinactive{
            color:#6b6b6b !important;
            background: transparent !important;
        }
</style>

    <div class="pagetitle">
      <h1>Selected Images</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Selected images</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
   

    <section class="hide" >
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="card-title">Select event</h5>
                 
                </div>
                 <div class="col-4 pt-3">
                 
                  <div align="right ">
                    <button class="btn btn-primary " onclick="showSelectedUserModel();">Find selected users</button>
                   
                  </div>
                  
                  
                </div>
                
                
                
                
                 <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select display image</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumDisList" name="albumDisList" onchange="getuserssimage('albumUserList');">
                            <option value="1" selected>User complete selection</option>
                            <option value="2" >Finished</option>
                            </select>
                           
                  </div>

                <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select User</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumUserList" name="albumUserList" onchange="getEventSubUserList('albumSubUserList');getEventUserProjectList();">
                            
                            </select>
                            <div class="invalid-feedback">
                            Please select a user!.
                            </div>
                  </div>
                  
                  
                  <div class="col-3 d-none" id="subuserDisDiv">
                    <label for="inputText" class=" col-form-label">Select Sub User</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumSubUserList" name="albumSubUserList" onchange="getEventUserProjectList();" >
                            
                            </select>
                            <div class="invalid-feedback">
                            Please select a sub user!.
                            </div>
                  </div>
                  
                  
                    <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select Event</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumUserProjectList" name="albumUserProjectList" onchange="getEventUserEventList();" >
                             
                            </select>
                            <div class="invalid-feedback">
                            Please select a event!.
                            </div>
                  </div>
                  
                  <input type="hidden" id="albumUserEventList" value="" >
                  
              
              
                
                
                
                <div class="col-12 pt-3 " >
                   <ul class="nav nav-tabs" role="tablist" style="border-radius: 5px;" id="eventListTab"></ul>
                </div>
                
                
                
                
                
                
               
                
                
              </div> 
             
              <div class="row" id="frstMess">
                    <div class="col-12 " align="center"><br><br>
                        <h4>Select user & project</h4>
                    </div>
                </div>
                
                 <div class="row" >
                    <div class="col-12 pt-3 "  align="right">
                      <button class="btn btn-success d-none" id="finishDiv" onclick="setSelImgsAsFinished();">Finished</button>
                   
                      <button class="btn btn-primary d-none" id="resetDiv" onclick="setSelImgsAsreset();">Release</button>
                    </div>
                </div>
                
               
              
              
               
              
              <div class="col-12 d-none" id="tableDiv">
                <table class="table table-striped mt-4 " width="50%" id="eventListTable">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th >Image</th>
                      <th >Name</th>
                     
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
    
    
    
    
    
    
    
    
 

<div class="modal fade" id="ViewUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  >
      <div class="modal-header">
        <h5 class="modal-title">Selected users</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addImgForm" >
          <div class="modal-body" >

          
            <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                
                <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select display image</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumDisList1" name="albumDisList1" onchange="fetchUserLists();">
                            <option value="1" selected>Completed</option>
                            <option value="2" >Finished</option>
                            </select>
                           
                  </div>
                  
                  
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select selected user</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumUserDisList" name="albumUserDisList" onchange="fetchUserLists();">
                            <option value="1" selected>Main user</option>
                            <option value="2" >Sub user</option>
                            </select>
                           
                  </div>
                  
                  
                   <div class="col-sm-12 table-responsive">
                     <table class="table table-striped mt-4" id="userListTable" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">Main User</th>
                           
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
          <div class="modal-footer">
          
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           
          </div>
      </form>
    </div>
  </div>
</div> 
    
    
    
    
    
    
    
    
    
    
    

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      
      getuserssimage("albumUserList");
        $('#albumUserList').select2();
        
        getEventSubUserList("albumSubUserList");
    
  });
  
  function showSelectedUserModel(){
      $("#ViewUserModal").modal('show');
      fetchUserLists();
      
  }
  
  function fetchUserLists(){
      
      var albumDisList = $('#albumDisList1').val();
      var albumUserDisList = $('#albumUserDisList').val();
      
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
              
                  { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
                
              
          
            ]
        });

    }
    
    if(albumUserDisList == 1) data = { "function": 'SignatureAlbum',"method": "fetchUserLists" ,"albumDisList":albumDisList };
    else data = { "function": 'SignatureAlbum',"method": "fetchSubUserLists" ,"albumDisList":albumDisList };
    
    
    apiCall(data,successFn);
      
      
      
  }
  
  function getEventSubUserList(selectId) {
      var albumUserList = $('#albumUserList').val();
      if(albumUserList == null) albumUserList ="";
       $('#subuserDisDiv').addClass('d-none');
       
       var albumDisList = $('#albumDisList').val();
    
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Sub User</option>";
      $.each(users, function(key,value) {
          $('#subuserDisDiv').removeClass('d-none');
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.firstname+" "+ value.lastname +"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
    

    }
    data = { "function": 'SignatureAlbum',"method": "getEventSubUserList",'albumUserList':albumUserList ,'albumDisList':albumDisList };
    
    apiCall(data,successFn);
    
}

  
function getEventUserProjectList() {
    
    $('#eventListTab').html('');
    
    var albumDisList = $('#albumDisList').val();
    
      $('#tableDiv').addClass('d-none');
        $('#frstMess').removeClass('d-none');
        $('#finishDiv').addClass('d-none');
        $('#resetDiv').addClass('d-none');
    
    var albumUserList = $('#albumUserList').val();
    if (albumUserList == ""){
        $("#"+selectId).html('');
        return false;
    }
    
    selectId = 'albumUserProjectList';
    
    var albumSubUserList = $('#albumSubUserList').val();

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
     
      
      
      var options = "<option selected value=''>Select Event</option>";
      $.each(users, function(key,value) {
          
       
          
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.project_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      
      

    }
    data = { "function": 'SignatureAlbum',"method": "getEventUserProjectList",'albumUserList':albumUserList ,'albumDisList':albumDisList,'albumSubUserList':albumSubUserList };
    
    apiCall(data,successFn);
    
}
  
  
  

function getEventUserEventList() {
    
    $('#eventListTab').html('');
    
    var albumDisList = $('#albumDisList').val();
    
      $('#tableDiv').addClass('d-none');
        $('#frstMess').removeClass('d-none');
        $('#finishDiv').addClass('d-none');
        $('#resetDiv').addClass('d-none');
    
    var albumUserList = $('#albumUserList').val();
    if (albumUserList == ""){
        return false;
    }
    
    var albumUserProjectList = $('#albumUserProjectList').val();
    if (albumUserProjectList == ""){
        return false;
    }
    
    
    var albumSubUserList = $('#albumSubUserList').val();
    

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var tabC = "";
      var II = true;
      
      
      
      $.each(users, function(key,value) {
          
          if(II){
              
              tabC +='<li class="nav-item" role="presentation" style="margin-right: 0px !important;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;"><button class="sa-tab-text nav-link eventactive active" name="nameActiveInactiveId" id="setActiveInactiveId_'+value.id+'" data-bs-toggle="tab" type="button" role="tab" aria-selected="true" onclick="getSelImgs('+value.id+')" style=" color: white;padding-right:30px;padding-left:30px;">'+value.folder_name+'</button></li>';
              
              getSelImgs(value.id);
              II = false;
              
          }else{
              tabC +='<li class="nav-item" role="presentation" style="margin-right: 0px !important;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;"><button class="sa-tab-text nav-link eventinactive " name="nameActiveInactiveId" id="setActiveInactiveId_'+value.id+'" data-bs-toggle="tab" type="button" role="tab" aria-selected="true" onclick="getSelImgs('+value.id+')" style=" color: white;padding-right:30px;padding-left:30px;">'+value.folder_name+'</button></li>';
          }
          
      
      });
    //   alert("#"+selectId);


      $('#eventListTab').html(tabC);

    }
    data = { "function": 'SignatureAlbum',"method": "getEventUserEventList",'albumUserList':albumUserList ,'albumDisList':albumDisList ,'albumUserProjectList':albumUserProjectList ,'albumSubUserList':albumSubUserList };
    
    apiCall(data,successFn);
    
}
  
  
  function setSelImgsAsFinished(){
      var albumId =  $('#albumUserEventList').val();
      var albumSubUserList = $('#albumSubUserList').val();
      
    
    return new swal({
    title: "Are you sure?",
    text: "You want to finish this event image selection",
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
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Successfully finish image selecting",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        getuserssimage('albumUserList');

                        
               
            }
        }
        data = { "function": 'SignatureAlbum',"method": "setSelImgsAsFinished" ,"albumId":albumId ,'albumSubUserList':albumSubUserList };
        apiCall(data,successFn);
        
        
        }else{
            return false;
        }
    });
   
        
      
  }
  
  
  
   function setSelImgsAsreset(){
      var albumId =  $('#albumUserEventList').val();
      var albumSubUserList = $('#albumSubUserList').val();
    
    return new swal({
    title: "Are you sure?",
    text: "You want to release this event image selection",
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
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Successfully release image selecting",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        getuserssimage('albumUserList');

                        
               
            }
        }
        data = { "function": 'SignatureAlbum',"method": "setSelImgsAsreset" ,"albumId":albumId ,'albumSubUserList':albumSubUserList  };
        apiCall(data,successFn);
        
        
        }else{
            return false;
        }
    });
   
        
      
  }
  
  

function getSelImgs(albumId){
    $('#albumUserEventList').val('');
   
    var albumDisList = $('#albumDisList').val();
    var albumUserList = $('#albumUserList').val();
    
    var albumSubUserList = $('#albumSubUserList').val();
    
    
    
    if(albumUserList == ""){
        $('#albumUserList').addClass('is-invalid');
         $('#tableDiv').addClass('d-none');
        $('#frstMess').removeClass('d-none');
        $('#finishDiv').addClass('d-none');
        $('#resetDiv').addClass('d-none');
         $('#eventListTab').html('');
        
        return false;
    }
    
    $('#albumUserList').removeClass('is-invalid');

     if(albumId == ""){
         $('#albumUserEventList').addClass('is-invalid');
          $('#tableDiv').addClass('d-none');
    $('#frstMess').removeClass('d-none');
    $('#finishDiv').addClass('d-none');
    $('#resetDiv').addClass('d-none');
     $('#eventListTab').html('');
         return false;
     }
     $('#albumUserEventList').removeClass('is-invalid');

    successFn = function(resp)  {
        
         $('#tableDiv').removeClass('d-none');
    $('#frstMess').addClass('d-none');
    
    if(albumDisList == 1){
         $('#finishDiv').removeClass('d-none');
         $('#resetDiv').removeClass('d-none');
         
         $('#albumUserEventList').val(albumId);
      
    }else{
        $('#resetDiv').removeClass('d-none');
        $('#albumUserEventList').val(albumId);
    }
     
        
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
             
             
              { "data": "thumb_image_path", 
                  render: function ( data ) {
                    return '<img height="50px" width="75px" src="'+data+'"></img>';
                }
              },
               { "data": "file_name" },
             
             
            ],
            "language": {
                "emptyTable": "No image selected."
            }
        });
    }
    data = { "function": 'SignatureAlbum',"method": "getSelImgs" ,"albumId":albumId,'albumDisList':albumDisList , 'albumSubUserList':albumSubUserList };
    
    apiCall(data,successFn);
}

</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>