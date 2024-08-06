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
                <div class="col-12">
                  <h5 class="card-title">Select event</h5>
                </div>
                
                 <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select display image</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumDisList" name="albumDisList" onchange="getEventUserList('albumUserList');">
                            <option value="1" selected>User complete selection</option>
                            <option value="2" >Finished</option>
                            </select>
                           
                  </div>

                <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select User</label>
                    <select class="form-control select2" aria-label="Default select example" id="albumUserList" name="albumUserList" onchange="getEventUserProjectList();">
                            
                            </select>
                            <div class="invalid-feedback">
                            Please select a user!.
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
                     <div class="col-12 pt-3 d-none" id="finishDiv" align="right">
                      <button class="btn btn-success " onclick="setSelImgsAsFinished();">Finished</button>
                    </div>
                </div>
                
                 <div class="row" id="resetMess">
                     <div class="col-12 pt-3 d-none" id="resetDiv" align="right">
                      <button class="btn btn-success " onclick="setSelImgsAsreset();">Release</button>
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

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      
      getEventUserList("albumUserList");
      
      
    //   getSelImgs();
    
  });
  
  function getEventUserList(selectId) {
      var albumDisList = $('#albumDisList').val();
      
        $('#tableDiv').addClass('d-none');
        $('#frstMess').removeClass('d-none');
        $('#finishDiv').addClass('d-none');
        $('#resetDiv').addClass('d-none');
        
        
         $('#eventListTab').html('');

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select User</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.firstname+" "+ value.lastname +"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#albumUserProjectList").html("<option selected value=''>Select Event</option>");

    }
    data = { "function": 'SignatureAlbum',"method": "getEventUserList",'albumDisList':albumDisList };
    
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
    data = { "function": 'SignatureAlbum',"method": "getEventUserProjectList",'albumUserList':albumUserList ,'albumDisList':albumDisList};
    
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
    data = { "function": 'SignatureAlbum',"method": "getEventUserEventList",'albumUserList':albumUserList ,'albumDisList':albumDisList ,'albumUserProjectList':albumUserProjectList};
    
    apiCall(data,successFn);
    
}
  
  
  function setSelImgsAsFinished(){
      var albumId =  $('#albumUserEventList').val();
    
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
                        
                        getEventUserList('albumUserList');

                        
               
            }
        }
        data = { "function": 'SignatureAlbum',"method": "setSelImgsAsFinished" ,"albumId":albumId};
        apiCall(data,successFn);
        
        
        }else{
            return false;
        }
    });
   
        
      
  }
  
  
  
   function setSelImgsAsreset(){
      var albumId =  $('#albumUserEventList').val();
    
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
                        
                        getEventUserList('albumUserList');

                        
               
            }
        }
        data = { "function": 'SignatureAlbum',"method": "setSelImgsAsreset" ,"albumId":albumId};
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
    data = { "function": 'SignatureAlbum',"method": "getSelImgs" ,"albumId":albumId,'albumDisList':albumDisList };
    
    apiCall(data,successFn);
}

</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>