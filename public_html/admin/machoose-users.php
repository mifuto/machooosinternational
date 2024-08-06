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
    
    if (strpos($userPermissionsList, 'Staff-management') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>Staffs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Staffs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="UserFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT"></h5>

             
              <form id="addCountyForm"  >
               
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Staff</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selUser" name="selUser" onchange="changeUser();">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Staff!.
                        </div>
                    </div>
                    
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter email</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpEmail" name="inpEmail">

                        <div class="invalid-feedback">
                        Please enter the Email!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter Name</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpName" name="inpName">

                        <div class="invalid-feedback">
                        Please enter the Name!.
                        </div>
                    </div>
                </div>
                
                
                
                
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Role</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selRole" name="selRole" >
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Role!.
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label text-dark">Office number</label>
                    <div class="col-12">
                        
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="basic-addon1">+91</span>
                          <input type="text" class="form-control" id="inpOfficePhone" name="inpOfficePhone" placeholder="Enter office number" aria-label="Enter office number" aria-describedby="basic-addon1">
                              <div class="invalid-feedback">
                            Please enter the Office number!.
                            </div>
                        </div>
                        
                        
                   
                    </div>
                   
                </div>
                
              
              
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter Password</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpPassword" name="inpPassword">

                        <div class="invalid-feedback">
                        Please enter the Password!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter Re-Password</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpRePassword" name="inpRePassword">

                        <div class="invalid-feedback">
                        Please enter the Re-Password!.
                        </div>
                    </div>
                </div>
                
                
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
                        
                         <select class="form-control select2" aria-label="Default select example" id="selCity" name="selCity">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the District!.
                        </div>
                    </div>
                    
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Manage Type</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="manageType" name="manageType" >
                             <option value="" selected>Select manage type</option>
                             <option value="County" >County</option>
                             <option value="State" >State</option>
                             <option value="City" >District</option>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Manage Type!.
                        </div>
                    </div>
                    
                </div>
                
                
               
                <div class="row mb-3 mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                      <div class="float-right">
                        <input type="hidden" id="hiddenEventId" name="hiddenEventId" value="">
                        <input type="hidden" id="save" name="save" value="add">
                        <input type="hidden" id="oldType" name="oldType" value="">
                        <button type="submit" id="submitButton" class="btn btn-primary float-right">SAVE</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="cancelUserForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="userListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Staffs</h5>
                </div>
                
              
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddUserSection();">Add New Staff</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Email</th>
                      <th scope="col">Password</th>
                      <th scope="col">Name</th>
                      <th scope="col">Role</th>
                      <th scope="col">Office Number</th>
                      
                      <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>
                      <th scope="col">Manage Type</th>
                     
                      <th scope="col">Created on</th>
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
      </div>
    </section>
    
  
    

<?php 

include("templates/footer.php")

?>
<script>

var isStateEdt = false;
var isCityEdt = false;



  $( document ).ready(function() {
      getStaff("selUser");
      getUserListData();
      getRole("selRole");
      
       getCounty("selCounty");
       getState('selState');
       getCity('selCity');


  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
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
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getCountries"};
    
    apiCall(data,successFn);
    
}


  function getState(selectId,val="") {
      
      if(isStateEdt && val == ""){
          isStateEdt = false;
          return false;
      }
      
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
      $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}


function getCity(selectId,val="",selState="") {
    
    if(isCityEdt && val == ""){
      isCityEdt = false;
      return false;
    }
      
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
      $("#"+selectId).select2();
      
      if(val !="")$("#selCity").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}



    
    function changeUser(){
        var selUser = $('#selUser').val();
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

               $("#inpEmail").val(eventList['email']);
               $("#inpName").val(eventList['firstname']+" "+eventList['lastname']);
              
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "changeUserStaff" ,"sel_id":selUser };
        
        apiCall(data,successFn);
        
        
    }
    
     function getRole(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Role</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.role+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getRoleData"};
    
    apiCall(data,successFn);
    
}
    
 
  function getStaff(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Staff</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.staffid+"'>"+value.firstname+" "+value.lastname+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getStaff"};
    
    apiCall(data,successFn);
    
}
  
  
  function showAddUserSection(){
      
      emptyForm();
      

     
    $("#userListSection").addClass("d-none");
        $('#addEVT').html('Add Staffs');
        
       
        $('#UserFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       $("#selUser").val("").trigger('change');
       $("#inpEmail").val("");
       $("#inpName").val("");
       $("#selRole").val("").trigger('change');
       
       $("#inpPassword").val("");
       $("#inpRePassword").val("");
       
       $("#inpOfficePhone").val("");
       
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#selCity").val("").trigger('change');
       
       $("#manageType").val("").trigger('change');
       
       
       
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  function getUserListData(){
      
    
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
            
              
              { "data": "email" },
              { "data": "password" },
              { "data": "name" },
              { "data": "role_id" },
               { "data": "office_number" },
              
                  { "data": "county_id" },
              { "data": "state_id" },
              { "data": "city_id" },
              { "data": "manage_type" },
             
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
                  var str = '<span class="badge bg-info text-dark" onclick="editUserEList('+item.id+');" style="cursor:pointer">edit</span>';
                  
                  if( item.active == 0){
                      str +='<span class="badge bg-success" onclick="activeUser('+item.id+','+item.active+');" style="cursor:pointer">active</span>';
                  }else{
                      str +='<span class="badge bg-danger" onclick="activeUser('+item.id+','+item.active+');" style="cursor:pointer">deactive</span>';
                  }
                  
                  
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getUserListData" };
    
    apiCall(data,successFn);
}

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function editUserEList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

    
        $('#addEVT').html('Update Staffs');
          $('#UserFormSection').removeClass("d-none");
                $("#userListSection").addClass("d-none");
                
                
                isStateEdt = true;
                isCityEdt = true;
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $("#selUser").val(eventList['user_id']).trigger('change');
               $("#inpState").val(eventList['state']);
               
               
                $("#selUser").val(eventList['user_id']).trigger('change');
               $("#inpEmail").val(eventList['email']);
               $("#inpName").val(eventList['name']);
               $("#selRole").val(eventList['role_id']).trigger('change');
               
               $("#inpPassword").val(eventList['password']);
               $("#inpRePassword").val(eventList['password']);
               
               $("#inpOfficePhone").val(eventList['office_number']);
               
                $("#selCounty").val(eventList['county_id']).trigger('change');
                getState('selState',eventList['state_id']);
                getCity('selCity',eventList['city_id'],eventList['state_id']);
                
                $("#manageType").val(eventList['manage_type']).trigger('change');
                
            
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditUserEList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelUserForm(){
      emptyForm();
      $('#UserFormSection').addClass("d-none");
      $("#userListSection").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var inpPassword = $('#inpPassword').val();
        var inpRePassword = $('#inpRePassword').val();
        if(inpPassword != inpRePassword){
             Swal.fire({
                title: "Password not match",
                showConfirmButton: true,
            });
            return false;
        }
        
      
      
        var save = $("#save").val();
       
        
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveStaffData');
        
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this staff",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton').removeClass('d-none');
                        $("#submitButton").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton").removeClass("d-none");
                                $("#submitLoadingButton").addClass("d-none");
                                // $("#hiddenEventId").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Staff "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getUserListData();
                                    
                                    cancelUserForm();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton").removeClass("d-none");
                                        $("#submitLoadingButton").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton").removeClass("d-none");
                        $("#submitLoadingButton").addClass("d-none");
                        // $("#hiddenEventId").val("");
                    }
            });
            
         
      
    },
    rules: {
        selUser: {
            required: true
        },
        inpEmail: {
            required: true
        },
        inpName: {
            required: true
        },
        selRole: {
            required: true
        },
        inpPassword: {
            required: true
        },
        inpRePassword: {
            required: true
        },
         selCounty: {
            required: true
        },
        selState: {
            required: true
        },
        selCity: {
            required: true
        },
        manageType: {
            required: true
        },
        inpOfficePhone: {
            required: true
        },
       
    },
    messages: {
        selUser: {
            required: "Please select the Staff"
        },
         inpEmail: {
            required: "Please enter the Email"
        },
       
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
    }
});



function activeUser(id,val){
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
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                             emptyForm();
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
                     data = { "function": 'SystemManage',"method": "setactiveUser" ,"sel_id":id,"setVal":setVal,"dis":dis };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 


</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>