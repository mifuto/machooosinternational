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
    
    if (strpos($userPermissionsList, 'Service-Provider') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>Service Providers</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Providers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   
    
    
    <section id="userListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Service Providers</h5>
                </div>
                
                 <div class="col-3 pt-4">
                    <select class="form-control select2" aria-label="Default select example" id="disType" name="disType" onchange="getUserListData();">
                                
                            </select>
                           
                  </div>
                
              
            
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Logo</th>
                      <th scope="col">Service Provider</th>
                      <th scope="col">Service Center</th>
                     
                      <th scope="col">Name</th>
                        <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>

                      <th scope="col">Created on</th>
                      <th scope="col">Status</th>
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
      </div>
    </section>
    
    
    
     <div class="modal fade" id="showFullSummaryView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Company details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendSAEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body">
                
                <div id="displayCompanyDetailsDiv"></div>
                  <div id="displayCompanyPhotographsDiv"></div>
                  
                   <br><hr>
                    
                     <h5 class="card-title">Legal Documents</h5>
                    
                     <div id="displayCompanyDocumentsDiv" class="pb-4"></div>
                    <div id="displayCompanyBrucherEditDiv" class="pb-4"></div>
                
                
                
            </div>
            <div class="modal-footer">
            
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </form>
      </div>
    </div>
  </div>
    
    
    
    <div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Accept company</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
              
              
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">County</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selCounty" name="selCounty" onchange="getState('selState');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the County!.
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">State</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" onchange="getCity('selCity');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the State!.
                        </div>
                    </div>
                    
                </div>
                
                
                   <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">District</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selCity" name="selCity" onchange="getAssaignedMachooosPerson('selAssaignedMachooosPerson');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the District!.
                        </div>
                    </div>
                    
                </div>
              
              
              
              
              
              
         
             
              <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selAssaignedMachooosPerson" name="selAssaignedMachooosPerson" onchange="getCompanyNumber();">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Assaigned machooos person!.
                                </div>
                            </div>
                            
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person contact number</label>
                            <div class="col-12">
                                
                                <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="text" class="form-control" id="inpMachooosPersonPhone" name="inpMachooosPersonPhone" placeholder="Enter contact number" aria-label="Enter contact number" aria-describedby="basic-addon1">
                                      <div class="invalid-feedback">
                                    Please enter the Assaigned machooos person contact number!.
                                    </div>
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
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="acptRequest();">Accept</button>
             </div>
          </div>
       </div>
    </div>
</div>
</div>


  
  
   
    <div class="modal fade" id="addUserModal1" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Change staff</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
              
              
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">County</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selCounty1" name="selCounty1" onchange="getState1('selState1');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the County!.
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">State</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selState1" name="selState1" onchange="getCity1('selCity1');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the State!.
                        </div>
                    </div>
                    
                </div>
                
                
                  <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">District</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selCity1" name="selCity1" onchange="getAssaignedMachooosPerson1('selAssaignedMachooosPerson1');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the District!.
                        </div>
                    </div>
                    
                </div>
              
         
             
              <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selAssaignedMachooosPerson1" name="selAssaignedMachooosPerson1" onchange="getCompanyNumber1();">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Assaigned machooos person!.
                                </div>
                            </div>
                            
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person contact number</label>
                            <div class="col-12">
                                
                                <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="text" class="form-control" id="inpMachooosPersonPhone1" name="inpMachooosPersonPhone1" placeholder="Enter contact number" aria-label="Enter contact number" aria-describedby="basic-addon1">
                                      <div class="invalid-feedback">
                                    Please enter the Assaigned machooos person contact number!.
                                    </div>
                                </div>
                                
                                
                           
                            </div>
                           
                        </div>
             
             
            
          </div>
       </div>
       <div class="modal-footer">
          <div class="row mb-3" align="right">
             <div class="float-right">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary d-none" type="button" id="submitLoadingButton1" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
                </button>
                <button type="button" id="submitButton1" class="btn btn-primary float-right" onclick="cheStff();">Change</button>
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

var rejectId = '';
var isStateEdt = false;
var isUserEdt = false;
var isNumberEdt = false;
var isCityEdt = false;

  $( document ).ready(function() {
     
      getUserListData();
      
      
      getAssaignedMachooosPerson('selAssaignedMachooosPerson');
      getAssaignedMachooosPerson1('selAssaignedMachooosPerson1');
      
      getActiveProvidersList('disType');
      
        getCounty("selCounty");
       getState('selState');
       
         getCounty("selCounty1");
       getState1('selState1');
       
       getCity('selCity');
       getCity1('selCity1');
      
     

  });
  
  
  function getCity1(selectId,val="",user="" ) {
      
      if(isCityEdt && val == ""){
          isCityEdt = false;
          return false;
      }
  
      
      selState = $('#selState1').val();
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select District</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.city+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
      if(val !="")$("#selCity1").val(val).trigger('change');
      
      getAssaignedMachooosPerson1('selAssaignedMachooosPerson1',user);
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}
  
  
  function getCity(selectId,val="",selState="") {
  
      
      if(selState == "") selState = $('#selState').val();
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select District</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.city+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
      if(val !="")$("#selCity").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}


  
  function getCompanyNumber(){
      var selAssaignedMachooosPerson = $('#selAssaignedMachooosPerson').val();
      $('#inpMachooosPersonPhone').removeClass('is-invalid');
      if(selAssaignedMachooosPerson == ""){
          
          
            $("#inpMachooosPersonPhone").val('');
          
      }else{
          
            successFn = function(resp)  {
                $("#inpMachooosPersonPhone").val(resp.data['office_number']);
              
            }
            data = { "function": 'SystemManage',"method": "getCompanyNumber",'selAssaignedMachooosPerson':selAssaignedMachooosPerson};
            
            apiCall(data,successFn);
          
      }
      
  }
  
  
   function getCounty(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Country</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.country_id+"'>"+value.short_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getCountries"};
    
    apiCall(data,successFn);
    
}


  function getState(selectId,val="") {
      
     
      var selCounty = $('#selCounty').val();
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.state+"</option>";
        else options += "<option value='"+value.id+"'>"+value.state+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}

function getState1(selectId,val="",user="",d_id="") {
      
      if(isStateEdt && val == ""){
          isStateEdt = false;
          return false;
      }
      
      var selCounty = $('#selCounty1').val();
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.state+"</option>";
        else options += "<option value='"+value.id+"'>"+value.state+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
    
    getCity1('selCity1',d_id,user);
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}

  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    function getActiveProvidersList(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select provider</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getActiveProvidersList" };
    
    apiCall(data,successFn);
    
}
    
    
    
    
    
function getAssaignedMachooosPerson(selectId,val="") {
    
    var selCity = $('#selCity').val();
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Assaigned machooos person</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getAssaignedMachooosPersonActiveList",'selCity':selCity };
    
    apiCall(data,successFn);
    
}


function getAssaignedMachooosPerson1(selectId,val="") {
    
    
    if(isUserEdt && val == ""){
          isUserEdt = false;
          return false;
      }
    
    var selCity = $('#selCity1').val();
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Assaigned machooos person</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getAssaignedMachooosPersonActiveList",'selCity':selCity };
    
    apiCall(data,successFn);
    
}



function changeStaff(id,user,number,c_is,s_id,d_id){
    
     rejectId = id;
     isStateEdt = true;
     isUserEdt = true;
     isNumberEdt = true;
     isCityEdt = true;
    
    
      $('#submitLoadingButton1').addClass('d-none');
            $("#submitButton1").removeClass("d-none");
            
            $('#selCounty1').removeClass('is-invalid');
            $('#selState1').removeClass('is-invalid');
            
            
            $("#selCounty1").val(c_is).trigger('change');
            
            getState1('selState1',s_id,user,d_id);
            
            
          
            $('#inpMachooosPersonPhone1').removeClass('is-invalid');
            $("#inpMachooosPersonPhone1").val(number);
            
            $('#selAssaignedMachooosPerson1').removeClass('is-invalid');
            $("#selAssaignedMachooosPerson1").val(user).trigger('change');
            
            
            
            
    $("#addUserModal1").modal('show');
    
}


function getCompanyNumber1(){
    
        if(isNumberEdt){
            isNumberEdt = false;
            return false;
        }
    
    
    
      var selAssaignedMachooosPerson = $('#selAssaignedMachooosPerson1').val();
      $('#inpMachooosPersonPhone1').removeClass('is-invalid');
      if(selAssaignedMachooosPerson == ""){
          
          
            $("#inpMachooosPersonPhone1").val('');
          
      }else{
          
            successFn = function(resp)  {
                $("#inpMachooosPersonPhone1").val(resp.data['office_number']);
              
            }
            data = { "function": 'SystemManage',"method": "getCompanyNumber",'selAssaignedMachooosPerson':selAssaignedMachooosPerson};
            
            apiCall(data,successFn);
          
      }
      
  }


function cheStff(){
    
    $('#inpMachooosPersonPhone1').removeClass('is-invalid');
    $('#selAssaignedMachooosPerson1').removeClass('is-invalid');
    
    
     $('#selCounty1').removeClass('is-invalid');
    $('#selState1').removeClass('is-invalid');
     $('#selCity1').removeClass('is-invalid');
    
     var selCounty = $('#selCounty1').val();
    
     if(selCounty == ""){
        $('#selCounty1').addClass('is-invalid');
        return false;
    }
    
     var selState = $('#selState1').val();
    
     if(selState == ""){
        $('#selState1').addClass('is-invalid');
        return false;
    }
    
    var selCity = $('#selCity1').val();
     if(selCity == ""){
        $('#selCity1').addClass('is-invalid');
        return false;
    }
    
    
    
    
    
    var selAssaignedMachooosPerson = $('#selAssaignedMachooosPerson1').val();
    
     if(selAssaignedMachooosPerson == ""){
        $('#selAssaignedMachooosPerson1').addClass('is-invalid');
        return false;
    }
    
     var inpMachooosPersonPhone = $('#inpMachooosPersonPhone1').val();
    
     if(inpMachooosPersonPhone == ""){
        $('#inpMachooosPersonPhone1').addClass('is-invalid');
        return false;
    }
    
    $('#submitLoadingButton1').removeClass('d-none');
    $("#submitButton1").addClass("d-none");
    

     postData = {
      function: 'SystemManage',
      method: "changeProviderStaff",
      sel_id: rejectId,
      'inpMachooosPersonPhone':inpMachooosPersonPhone,
      'selAssaignedMachooosPerson':selAssaignedMachooosPerson,
       'selCounty':selCounty,
      'selState':selState,
      'selCity':selCity,
    }

    console.log(postData);

    successFn = function(resp) {
     if(resp.status == 1){
                             Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
      
      $('#submitLoadingButton1').addClass('d-none');
    $("#submitButton1").removeClass("d-none");
    $("#addUserModal1").modal('hide');
      
      
      
    }

    apiCall(postData,successFn);

    return false;

      
  }




function acceptCompany(id){
    rejectId = id;
    
    
      $('#submitLoadingButton').addClass('d-none');
            $("#submitButton").removeClass("d-none");
          
            $('#inpMachooosPersonPhone').removeClass('is-invalid');
            $("#inpMachooosPersonPhone").val("");
            
            $('#selAssaignedMachooosPerson').removeClass('is-invalid');
            $("#selAssaignedMachooosPerson").val('').trigger('change');
            
            
            
            
    $("#addUserModal").modal('show');
    
    
    
}



function acptRequest(){
    
    $('#inpMachooosPersonPhone').removeClass('is-invalid');
    $('#selAssaignedMachooosPerson').removeClass('is-invalid');
    
    $('#selCounty').removeClass('is-invalid');
    $('#selState').removeClass('is-invalid');
    $('#selCity').removeClass('is-invalid');
    
     var selCounty = $('#selCounty').val();
    
     if(selCounty == ""){
        $('#selCounty').addClass('is-invalid');
        return false;
    }
    
     var selState = $('#selState').val();
    
     if(selState == ""){
        $('#selState').addClass('is-invalid');
        return false;
    }
    
    var selCity = $('#selCity').val();
       if(selCity == ""){
        $('#selCity').addClass('is-invalid');
        return false;
    }
    
    
    var selAssaignedMachooosPerson = $('#selAssaignedMachooosPerson').val();
    
     if(selAssaignedMachooosPerson == ""){
        $('#selAssaignedMachooosPerson').addClass('is-invalid');
        return false;
    }
    
     var inpMachooosPersonPhone = $('#inpMachooosPersonPhone').val();
    
     if(inpMachooosPersonPhone == ""){
        $('#inpMachooosPersonPhone').addClass('is-invalid');
        return false;
    }
    
    
    
    
    
    $('#submitLoadingButton').removeClass('d-none');
    $("#submitButton").addClass("d-none");
    

     postData = {
      function: 'SystemManage',
      method: "acceptCompany",
      sel_id: rejectId,
      'inpMachooosPersonPhone':inpMachooosPersonPhone,
      'selAssaignedMachooosPerson':selAssaignedMachooosPerson,
      'selCounty':selCounty,
      'selState':selState,
      'selCity':selCity
    }

    console.log(postData);

    successFn = function(resp) {
     if(resp.status == 1){
                             Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
      
      $('#submitLoadingButton').addClass('d-none');
    $("#submitButton").removeClass("d-none");
    $("#addUserModal").modal('hide');
      
      
      
    }

    apiCall(postData,successFn);

    return false;

      
  }


   
  
  
  function getUserListData(){
      
      var disType = $('#disType').val();
    
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
              
               {"data":null,"render":function(item){
                 if(item.company_logo_url == '' || item.company_logo_url == null) return '<p class="text-danger">Logo not uploaded</p>';
                 else return '<img src="'+item.company_logo_url+'" alt="" style="width: 100%;height:  60%;">';
                  

                    }
                },
              
              
              {"data":null,"render":function(item){
                  var tbl = '';
                  
                   tbl +='<p>'+item.company_address+'</p>';
                        tbl +='<p>'+item.city_id+','+item.state_id+','+item.county_id+'</p>';
                        tbl +='<b class="text-primary"><a href="'+item.company_link+'" target="_blank">'+item.company_link+'</a></b><br>';
                  
                return tbl;
                    
                    }
                },
              
             { "data": "center_name" },
              
              
              { "data": "name" },
              
              
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
              
              
                {"data":null,"render":function(item){
                  if( item.is_accept_company == 0){
                      var str = '<span class=" text-danger" style="cursor:pointer">Company not accepted</span>';
                  }else{
                      var str = '<span class=" text-success" style="cursor:pointer">Company accepted</span>';
                  }
                  
                
                  
                return str;
                    
                    }
                },
              
              
                {"data":null,"render":function(item){
                  var str = '<span class="badge bg-info text-dark" onclick="viewDetails('+item.id+');" style="cursor:pointer">Company details</span>';
                  
                  if( item.is_company_add == 1 && item.is_accept_company == 0 && item.is_propert_instructions_add == 1 && item.is_account_add == 1 ){
                      str += '<span class="badge bg-success text-white" onclick="acceptCompany('+item.id+');" style="cursor:pointer">Accept company</span>';
                  }else if(item.is_accept_company == 1){
                      str += '<span class="badge bg-primary text-white" onclick="changeStaff('+item.id+',`'+item.machoose_user_id+'`,`'+item.machoose_user_phone+'`,`'+item.staff_county_id+'`,`'+item.staff_state_id+'`,`'+item.staff_city_id+'`);" style="cursor:pointer">Change staff</span>';
                      
                      if(item.is_add_service == 0){
                          str += '<span class="badge bg-danger text-white" onclick="setactiveeventtype('+item.id+','+item.is_add_service+');" style="cursor:pointer">Deactivate company</span>';
                      }else{
                          str += '<span class="badge bg-warning text-white" onclick="setactiveeventtype('+item.id+','+item.is_add_service+');" style="cursor:pointer">Activate company</span>';
                      }
                      
                      
                      
                  }
                  
                
                  
                return str;
                    
                    }
                },
              
             
          
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getservicesprovidersUserListData" ,'provider_id':disType };
    
    apiCall(data,successFn);
}



function setactiveeventtype(id,val){
    if(val == 0){
        var dis = 'deactive';
        var setVal = 1;
    } 
    else {
        var dis = 'active';
        var setVal = 0;
    }
     return new swal({
             title: "Are you sure?",
             text: "You want to "+dis+" this company",
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
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "setsetactiveevCompanytype" ,"sel_id":id,"setVal":setVal,"dis":dis };
                     apiCall(data,successFn);
                 }
         });
}






 function acceptCompany11(id){
  
     return new swal({
             title: "Are you sure?",
             text: "You want to accept this Company",
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
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                            getUserListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "acceptCompany" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}


    function getAllPhotographs(id){
    
        successFn = function(resp)  {
            // resp = JSON.parse(resp);
          
            if(resp.status == 1){
                var images = resp.data;
                if(images.length > 0){
                    
                    var disD = '';
                    disD +='<h5 class="card-title">Company Photographs</h5>';
                    
                    for(var i=0;i<images.length;i++){
                        
                        var filepath = images[i]['file_path'];
                        disD +='<img src="'+filepath+'" alt="" style="width: 10%;height: 10%;">';

                    }
                    
                    
                }else{
                    
                    var disD = '';
                    disD +='<h5 class="card-title">Company Photographs</h5>';
                    disD +='<p class="text-muted">Company photographs not uploaded, Please update your company photographs</p>';
                    
                  
                }
                
                $('#displayCompanyPhotographsDiv').html(disD);

                
            }
            
        }
        data = { "function": 'SystemManage',"method": "getNewAllPhotographs",'selectedCompanyId':id };
        
        apiCall(data,successFn);
 }
 
 

  function viewDetails(id){
      
      $('#displayCompanyDetailsDiv').html('');
      $('#displayCompanyPhotographsDiv').html('');
      
      getAllPhotographs(id);
      getAllBrucher(id);
      
        $('#displayCompanyDocumentsDiv').html('');
     $('#displayCompanyBrucherEditDiv').html('');
      
      
      successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            
             var disD2 = '';
            if(resp.data.company_document_url == '' || resp.data.company_document_url == null) disD2 +='<p class="text-muted">Document not uploaded, Please update document</p>';
            else{
                disD2 +='<a href="'+resp.data.company_document_url+'" target="_blank">'+resp.data.company_document_name+'</a>';
            }
            
            $('#displayCompanyDocumentsDiv').html(disD2);
            
            
            
            
            var disD = '';
            disD +='<h5 class="card-title">Company Logo</h5>';
            if(resp.data.company_logo_url == '' || resp.data.company_logo_url == null) disD +='<p class="text-muted">Logo not uploaded, Please update your company logo</p>';
            else{
                disD +='<img src="'+resp.data.company_logo_url+'" alt="" style="width: 10%;height: 10%;">';
            }
            
            
            
            
            
            disD +='<h5 class="card-title">Company Details</h5>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Company name</div><div class="col-lg-9 col-md-8">'+resp.data.company_name+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Company email</div><div class="col-lg-9 col-md-8">'+resp.data.company_mail+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Company address</div><div class="col-lg-9 col-md-8">'+resp.data.company_address+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">County</div><div class="col-lg-9 col-md-8">'+resp.data.short_name+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">State</div><div class="col-lg-9 col-md-8">'+resp.data.state+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">District</div><div class="col-lg-9 col-md-8">'+resp.data.city+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Location</div><div class="col-lg-9 col-md-8">'+resp.data.company_location+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Website link</div><div class="col-lg-9 col-md-8"><a href="'+resp.data.company_link+'" target="_blank" >'+resp.data.company_link+'</a></div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Contact number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_phone+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Whatsapp number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_wa_number+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Assaigned Hotel person</div><div class="col-lg-9 col-md-8">'+resp.data.company_assistant+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Assaigned hotel person contact number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_assistant_number+'</div></div>';
            
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Assaigned machooos person</div><div class="col-lg-9 col-md-8">'+resp.data.staff+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Assaigned machooos person contact number</div><div class="col-lg-9 col-md-8">'+resp.data.machoose_user_phone+'</div></div>';
            
            
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">ServiceHours</div><div class="col-lg-9 col-md-8">'+resp.data.service_hrs+' '+resp.data.service_hrs_type+'</div></div>';
            
            var provideS = '';
            if(resp.data.provide_welcome_drink == 1) provideS += 'Provide welcome drink <br>';

            if(resp.data.provide_food == 1) provideS += 'Provide food <br>';
    
            if(resp.data.provide_seperate_cabin == 1) provideS += 'Provide seperate cabin <br>';
    
            if(resp.data.provide_common_restaurant == 1) provideS += 'Provide common restaurant <br>';
            
            if(resp.data.provide_wifi == 1) provideS += 'Provide wifi <br>';
            if(resp.data.provide_parking == 1) provideS += 'Provide parking <br>';
            if(resp.data.provide_ac == 1) provideS += 'Provide air condition <br>';
            if(resp.data.provide_rooftop == 1) provideS += 'Provide rooftop <br>';
            if(resp.data.provide_bathroom == 1) provideS += 'Provide bathroom <br>';
            
             disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Company provide</div><div class="col-lg-9 col-md-8">'+provideS+'</div></div>';
            
            if(resp.data.provide_extra_service == 1){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Provide extra services</div><div class="col-lg-9 col-md-8">'+resp.data.extra_services+'</div></div>';
            }
            
            
            

            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Working days</div><div class="col-lg-9 col-md-8">'+resp.data.working_days+'</div></div>';
            
            
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Working time</div><div class="col-lg-9 col-md-8">'+convertTo12HourFormat(resp.data.working_start)+' - '+convertTo12HourFormat(resp.data.working_end)+'</div></div>';
            
            
             disD +='<h5 class="card-title">Social media links</h5>';
            var ifnotlink = true;
            if(resp.data.facebook_link != '' && resp.data.facebook_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Facebook</div><div class="col-lg-9 col-md-8">'+resp.data.facebook_link+'</div></div>';
                ifnotlink = false;
            }
            
            if(resp.data.instagram_link != '' && resp.data.instagram_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Instagram</div><div class="col-lg-9 col-md-8">'+resp.data.instagram_link+'</div></div>';
                ifnotlink = false;
            }
            
            if(resp.data.twitter_link != '' && resp.data.twitter_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Twitter</div><div class="col-lg-9 col-md-8">'+resp.data.twitter_link+'</div></div>';
                ifnotlink = false;
            }
            
             if(resp.data.linkedin_link != '' && resp.data.linkedin_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Linkedin</div><div class="col-lg-9 col-md-8">'+resp.data.linkedin_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.pinterest_link != '' && resp.data.pinterest_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Pinterest</div><div class="col-lg-9 col-md-8">'+resp.data.pinterest_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.youtube_link != '' && resp.data.youtube_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Youtube</div><div class="col-lg-9 col-md-8">'+resp.data.youtube_link+'</div></div>';
                ifnotlink = false;
            }
            
               if(resp.data.reddit_link != '' && resp.data.reddit_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Reddit</div><div class="col-lg-9 col-md-8">'+resp.data.reddit_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.tumbler_link != '' && resp.data.tumbler_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Tumbler</div><div class="col-lg-9 col-md-8">'+resp.data.tumbler_link+'</div></div>';
                ifnotlink = false;
            }
            
            
            
            if(ifnotlink) disD +='<p class="text-muted">No social media links available.</p>';
            
            
            
            
            
            
            
            disD +='<h5 class="card-title">Property instructions</h5>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Property instructions</div><div class="col-lg-9 col-md-8">'+resp.data.propert_instructions+'</div></div>';
             disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Property use Time period</div><div class="col-lg-9 col-md-8">'+convertTo12HourFormat(resp.data.start_use_time)+' - '+convertTo12HourFormat(resp.data.end_use_time)+'</div></div>';
            //  disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Allowed maximum numbers of family members</div><div class="col-lg-9 col-md-8">'+resp.data.number_of_members+'</div></div>';
            // disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Extra price per head</div><div class="col-lg-9 col-md-8">₹'+resp.data.extra_price_per_head+'</div></div>';
            
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Additional informations</div><div class="col-lg-9 col-md-8">'+resp.data.additional_info+'</div></div>';
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Property location link</div><div class="col-lg-9 col-md-8">'+resp.data.property_location_link+'</div></div>';
            
            disD +='<h5 class="card-title">Bank account</h5>';
            
                 
                  disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank name</div><div class="col-lg-9 col-md-8">'+resp.data.bank_name+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank holder name</div><div class="col-lg-9 col-md-8">'+resp.data.bank_holder_name+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Account number</div><div class="col-lg-9 col-md-8">'+resp.data.account_number+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">IFSC code</div><div class="col-lg-9 col-md-8">'+resp.data.ifsc_code+'</div></div>';
                 
       
               disD +='<h5 class="card-title">Terms and Conditions</h5>';
              if(resp.data.terms_and_conditions == '' || resp.data.terms_and_conditions == null) disD +='<p class="text-muted">Terms and Conditions not uploaded, Please update your company Terms and Conditions</p>';
            else{
                disD +=resp.data.terms_and_conditions;
            }
             
            
            
            $('#displayCompanyDetailsDiv').html(disD);
            
          
            
        }
    
      
    }
    data = { "function": 'SystemManage',"method": "getAllCompanyEditDetails",'selectedCompanyId':id };
    
    apiCall(data,successFn);
     
      
     $("#showFullSummaryView").modal('show');
  }
  
  
  function getAllBrucher(selectedCompanyId){
     
     $('#displayCompanyBrucherEditDiv').html('');

     
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            var images = resp.data;
            if(images.length > 0){
                
                var disD = '';
                var disD1 = '';
                disD +='<h5 class="card-title">Brochures</h5>';
                
                for(var i=0;i<images.length;i++){
                    
                    var filepath = images[i]['file_path'];
                    disD +='<a href="'+filepath+'" target="_blank">'+images[i]['file_name']+' - '+images[i]['created_date']+' </a> <br>';

                }
                
                
            }else{
                
                var disD = '';
                disD +='<h5 class="card-title">Brochures</h5>';
                disD +='<p class="text-muted">Brochures not uploaded, Please update your Brochures</p>';
                
             
                
                
            }
            
            $('#displayCompanyBrucherEditDiv').html(disD);
            
            
        }
        
    }
    data = { "function": 'SystemManage',"method": "getAllBruchers",'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
 }
  
  function convertTo12HourFormat(time24) {
     if(time24 == '' || time24 == null) return '';
    // Split the time string into hours and minutes
    var [hours, minutes] = time24.split(':');

    // Convert hours to 12-hour format
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (00:00)

    // Add leading zeros if needed
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '' + minutes : minutes;

    // Return the time in 12-hour format with AM/PM
    return hours + ':' + minutes + ' ' + ampm;
}
  
 


</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>