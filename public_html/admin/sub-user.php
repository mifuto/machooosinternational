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

<style>
  @keyframes blink {
    0%, 100% {
      visibility: hidden;
    }
    50% {
      visibility: visible;
    }
  }

  .blink-text {
    animation: blink 1s steps(1) infinite;
  }
  
 
</style>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="pagetitle">
    <h1>Create sub user</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="#" role="button" >Create sub user</a></li>
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
                            <label for="inputText" class=" col-form-label">Select main user</label>
                            <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList" onchange="getAllUserDetails();">
                                   
                            </select>
                              <div class="invalid-feedback">
                                        Please select the user!.
                                        </div>
                                   
                          </div>
                          
                           <div class="col-3">
                            <label for="inputText" class=" col-form-label">&nbsp;</label>
                            <select class="form-control select2" aria-label="Default select example" id="usersCreate" name="usersCreate">
                                <option value="new" selected>Create</option>
                                <option value="existing">Existing user</option>
                                   
                            </select>
                                   
                          </div>
                          
                           <div class="col-6 pt-4 " align="right">
                              <button class="btn btn-primary " onclick="addSubUser();">Add sub user</button>
                            </div>
                     
                  
                    </div>
                    
                    
                    <div class="col-sm-12 table-responsive mt-4" align="center" id="noUserMessage">
                        <h3 class="text-secondary">Please select user</h3>
                     </div>
                    
                    
                    
                    <div class="col-sm-12 table-responsive d-none" id="listUserDiv">
                        <table class="table table-striped mt-4 " width="100%" id="userListTable">
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

<!-- Modal body -->
<div class="d-none"  id="registerModalBody">
    
</div>


<div class="modal fade" id="linkUserModal" tabindex="-1" style="z-index: 1051 !important;">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">link user</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" >
              
               <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Selected main user</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpLinkMainUser" name="inpLinkMainUser" disabled>
                   
                </div>
             </div>
              
               <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter the mail id of the person to be added here</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="selLinkEmail" name="selLinkEmail">
                   <div class="invalid-feedback">
                      Please enter the Email!.
                   </div>
                </div>
             </div>
              
              
             
             <div class="row mb-3">
                <label  class="col-12 col-form-label text-danger d-none" id="errMegLink"></label>
                <label  class="col-12 col-form-label text-success d-none" id="succssMegLink"></label>
             </div>
          </div>
       </div>
       <div class="modal-footer">
          <div class="row mb-3" align="right">
             <div class="float-right">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary d-none" type="button" id="submitLoadingButtonLink" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
                </button>
                <button type="button" id="submitFindButtonLink" class="btn btn-primary float-right d-none" onclick="findUser();">Find user</button>
                <button type="button" id="submitButtonLink" class="btn btn-primary float-right d-none" onclick="linkUser();">Link user</button>
             </div>
          </div>
       </div>
    </div>
</div>
</div>



<div class="modal fade" id="addUserModal" tabindex="-1">
<div class="modal-dialog modal-lg">
    <div class="modal-content"  >
       <div class="modal-header">
          <h5 class="modal-title">Create sub user</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body" >
          <div class="card-body" id="addEventFormDiv">
              
            <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Selected main user</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpMainUser" name="inpMainUser" disabled>
                   
                </div>
             </div>
              
              
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter sub user first name</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpFName" name="inpFName">
                   <div class="invalid-feedback">
                      Please enter the Frist name!.
                   </div>
                </div>
             </div>
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter sub user last name</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpLName" name="inpLName">
                   <div class="invalid-feedback">
                      Please enter the Last name!.
                   </div>
                </div>
             </div>
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter the mail id of the person to be added here</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpEmail" name="inpEmail">
                   <div class="invalid-feedback">
                      Please enter the Name!.
                   </div>
                </div>
             </div>
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Enter sub user phone number</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpPhone" name="inpPhone">
                   <div class="invalid-feedback">
                      Please enter the Phone!.
                   </div>
                </div>
             </div>
             <div class="row mb-3">
                <label for="" class="col-12 col-form-label">Password</label>
                <div class="col-12">
                   <input type="text" class="form-control" id="inpPassword" name="inpPassword" disabled>
                   <span class="text-secondary">*Auto generated password</span>
                   <div class="invalid-feedback">
                      Please enter the Name!.
                   </div>
                </div>
             </div>
             <div class="row mb-3">
                <label  class="col-12 col-form-label text-danger d-none" id="errMeg"></label>
                <label  class="col-12 col-form-label text-success d-none" id="succssMeg"></label>
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
                <button type="button" id="submitButton" class="btn btn-primary float-right" onclick="createUser();">Create user</button>
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

    var genPassword = "";

     
    $( document ).ready(function() {
        getusers("usersList");
        $('#usersList').select2();
        
        logoutAndGetTem();
        
        
    
    });
    
     $('#linkUserModal').on('shown.bs.modal', function () {
            $('#selLinkEmail').select2();
        });
    
    function logoutAndGetTem(){
        
         var data1 = {action: 'logout',ajax:true};
        $.ajax({
            url: '/crm/authentication/logout/api',
            type: 'POST',
            data: data1,
            dataType: "json",
            success: function (data) {
                  setCookie('user_state_val', '', 30);
                    setCookie('user_county_val', '', 30);
                    setCookie('user_sel_account_type', '', 30);
                    
                    
                     var data = {ajax: "true"};
        
                        $.ajax({
                            url: '/crm/authentication/register/api',
                            type: 'GET',
                            data: data,
                            // dataType: "json",
                            success: function (data) {
                                // console.log(data);
                                var html = $.parseHTML(data);
                                
                                var formcontent = $(html).find('#register-form');
                
                                $("#registerModalBody").html(formcontent);
                
                                $('#registerModalBody select').select2({
                                    dropdownParent: $("#registerModalBody")
                                });
                
                                $('#registerModalBody .register-company-custom-fields input.datepicker').attr('type', 'date');
                                $('#registerModalBody button').attr('type', 'button');
                                $('#registerModalBody button').attr('id', 'btn-register');
                                $('#registerModalBody button').attr('onclick', 'return registerUser()');
                                
                                changeCountry();
                            },
                            error: function (x,h,r) {
                                //called when there is an error
                                // console.log(x);
                                // console.log(h);
                                // console.log(r);
                                // alert("invalid user name or password");
                            }
                        });
                        
                    
                    
                    
                    
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
            }
        });
        
        
    }
    
    
    
    
    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    
    
    
    function changeCountry(val1="",val2="",selET=""){
        var selCounty = $('#country').val();
        
         successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.state+"'>"+value.state+"</option>";
      });
    //   alert("#"+selectId);

      $("#state").html(options);
      $("#state").select2();
      if(val1 !="") $("#state").val(val1).trigger('change');
      
         
      changeState(val2,selET);
      
     
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
        
        
        
        
    }
    
    function changeState(val2="",val3=""){
        
        
        var selState = 'Kerala';
        
          successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select District</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.city+"'>"+value.city+"</option>";
      });
    //   alert("#"+selectId);

      $("#city").html(options);
      $("#city").select2();
      
      if(val2 !="")$("#city").val(val2).trigger('change');
      
      
      getEventType(selState,val3);
      
     
      
    }
    data = { "function": 'SystemManage',"method": "getCity" , "selState":selState};
    
    apiCall(data,successFn);
        
        
      
        
    }
    
     function getEventType(selState='Kerala',val2=""){
        
      
          successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Event type</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.name+"' selected>"+value.name+"</option>";
      });
    //   alert("#"+selectId);

      $("[name='custom_fields[customers][2]']").html(options);
      $("[name='custom_fields[customers][2]']").select2();
      
      if(val2 !="")$("[name='custom_fields[customers][2]']").val(val2).trigger('change');
      
   
      
    }
    data = { "function": 'SystemManage',"method": "getET" , "selState":selState};
    
    apiCall(data,successFn);
        
        
      
        
    }
    
     function setCookie(name, value, expirationDays) {
        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + expirationDate.toUTCString();
        document.cookie = name + "=" + value + "; " + expires + "; path=/";
    }
    
    
 
     function registerUser(country,state,city,inpEmail,selUser,inpFName,inpLName,Password) {
       
        
        
        data = $("#register-form").serialize() + "&ajax=true";
       
        $.ajax({
            url: '/crm/authentication/register/api',
            type: 'POST',
            data: data,
            // dataType: "json",
            success: function (data) {
                
                successFn = function(resp)  {
                if(resp.status == 1){
                    
                    $('#submitLoadingButton').addClass('d-none');
                    $("#submitButton").removeClass("d-none");
                    
                    $('#succssMeg').removeClass('d-none');
                    $('#succssMeg').html('Successfully create user and password send to '+inpEmail);
                    
                    getSubUserListData();
                    $("#addUserModal").modal('hide');
                    
                     Swal.fire({
                        icon: 'success',
                        title: 'Successfully create user and password send to '+inpEmail,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    
                    
    
                }else{
                    $('#errMeg').removeClass('d-none');
                    $('#errMeg').html('Failed to create user, Please reload page and try again.');
                    
                    $('#submitLoadingButton').addClass('d-none');
                    $("#submitButton").removeClass("d-none");
                }
           
            
          
        }
        data = { "function": 'User',"method": "checkAndUpdateSubUser" ,"country":country , "state":state, 'city':city, 'inpEmail':inpEmail, 'selUser':selUser, 'inpFName':inpFName, 'inpLName':inpLName, 'Password':Password };
        
        apiCall(data,successFn);
                
                
                
                
            },
            error: function (x,h,r) {
                $('#errMeg').removeClass('d-none');
                $('#errMeg').html('Something went wrong please try again');
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
            }
        });
    }
    
    function createUser(){
        var selUser = $('#usersList').val();
        var inpFName = $('#inpFName').val();
        var inpEmail = $('#inpEmail').val();
        var inpPhone = $('#inpPhone').val();
        var inpLName = $('#inpLName').val();
        $('#errMeg').addClass('d-none');
        $('#succssMeg').addClass('d-none');
        
         $('#inpFName').removeClass('is-invalid');
        $('#inpEmail').removeClass('is-invalid');
        $('#inpLName').removeClass('is-invalid');
        $('#inpPhone').removeClass('is-invalid');
        
        if(inpFName == ""){
            $('#inpFName').addClass('is-invalid');
            return false;
        }
        
          if(inpLName == ""){
            $('#inpLName').addClass('is-invalid');
            return false;
        }
        
        if(inpEmail == ""){
            $('#inpEmail').addClass('is-invalid');
            return false;
        }
        
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(inpEmail)) {
            $('#errMeg').removeClass('d-none');
            $('#errMeg').html('Invalid email');
            return false;
        }
        
         if(inpPhone == ""){
            $('#inpPhone').addClass('is-invalid');
            return false;
        }
        
        $('#submitLoadingButton').removeClass('d-none');
        $("#submitButton").addClass("d-none");
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
                
                
                 return new swal({
                    title: "Are you sure?",
                    text: "You want to create a user?",
                    icon: false,
                    // buttons: true,
                    // dangerMode: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                    }).then((confirm) => {
                        // console.log(confirm.isConfirmed);
                        if (confirm.isConfirmed) {
                            var userListData = resp.data;
                            var country = userListData['country'];
                            var state = userListData['state'];
                            var city = userListData['city'];
                            var zip = userListData['zip'];
                            var groupid = userListData['groupid'];
                            var currentDate = new Date();
                            var formattedDate = currentDate.toISOString().split('T')[0];
                            
                            $("#firstname").val(inpFName);
                            $("#lastname").val(inpLName);
                            $("#email").val(inpEmail);
                            $("#password").val(genPassword);
                            $("#passwordr").val(genPassword);
                            $("#contact_phonenumber").val(inpPhone);
                            
                            
                            getEventType(state);
                            
                            $("#zip").val(zip);
                            $("[name='custom_fields[customers][1]']").val(formattedDate);
                           
                            $('#submitLoadingButton').removeClass('d-none');
                            $("#submitButton").addClass("d-none");
                            
                            registerUser(country,state,city,inpEmail,selUser,inpFName,inpLName,genPassword);
                            
                            
                            
                           
                        }
                });
                
                
                
              

            }else if(resp.status == 2){
                $('#errMeg').removeClass('d-none');
                var out = 'Email already exists <a onclick="linkUserUsingEmail(`'+inpEmail+'`);" ><label class="text-primary">Click to link user</label></a> ';
                $('#errMeg').html(out);
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
                
            }else{
                $('#errMeg').removeClass('d-none');
                $('#errMeg').html('Something went wrong please try again');
                
                $('#submitLoadingButton').addClass('d-none');
                $("#submitButton").removeClass("d-none");
            }
           
            
          
        }
        data = { "function": 'User',"method": "getUserFullDetailsusingId" ,"sel_id":selUser , "inpEmail":inpEmail };
        
        apiCall(data,successFn);
        
        
        
        
        
        
        
        
        
        
    }
    
    function getAllUserDetails(){
         var selUser = $('#usersList').val();
         
         if(selUser == ""){
             $('#listUserDiv').addClass('d-none');
             $('#noUserMessage').removeClass('d-none');
         }else{
             $('#listUserDiv').removeClass('d-none');
             $('#noUserMessage').addClass('d-none');
             getSubUserListData();
             $('#usersList').removeClass('is-invalid');
             
         }
         
         
         
         
         
         return false;
         
         
      
    }
    
    
    function getSubUserListData(){
        
                var selUser = $('#usersList').val();
             
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
                              
                                {"data":null,"render":function(item){
                                  var str = '<span class="btn bg-primary text-white" onclick="unlinkUserUsingId('+item.id+');" style="cursor:pointer">Remove</span>';
                                  
                                
                                  
                                return str;
                                    
                                    }
                                },
                           
                          
                          
                      
                        ],
                        "language": {
                            "zeroRecords": "No sub user available"
                        }
                    });
            
                }
                data = { "function": 'User',"method": "getSubUserListData","selUser":selUser };
                
                apiCall(data,successFn);
        }
        
        
        function unlinkUserUsingId(id){
            return new swal({
                title: "Are you sure?",
                text: "You want to remove this user",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        successFn = function(resp) {
                        if(resp.status==1){
                            // alert('Blog Deleted Successfully');
                            Swal.fire({
                            title: 'User removed successfully',
                            timer: 1500
                            });
                            getSubUserListData();
                        }else{
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to remove user',
                            });
                            // alert('Failed in deleting record');
                        }
                        // alert(resp.data);
                        }
                        data = { "function": 'User',"method": "unlinkUser" ,"sel_id": id };
                        apiCall(data,successFn);
                                
                    }
                });
          }

        
        
        
        
        
        
    function linkUserUsingEmail(inpEmail){
        
         var selUser = $('#usersList').val();
        var selUserName = $('#usersList option:selected').text();
        
        $("#inpLinkMainUser").val(selUserName);
        
        $("#addUserModal").modal('hide');
        $('#submitLoadingButton').addClass('d-none');
        $("#submitButton").removeClass("d-none");
        
        $("#linkUserModal").modal('show');
        
        $('#usersList').removeClass('is-invalid');
                    
        $('#submitLoadingButtonLink').addClass('d-none');
        $("#submitButtonLink").addClass("d-none");
        $("#submitFindButtonLink").removeClass("d-none");
            
            
        
        $("#selLinkEmail").val(inpEmail);
        $('#selLinkEmail').removeClass('is-invalid');
        
        $('#errMegLink').addClass('d-none');
        $('#succssMegLink').addClass('d-none');
        
        
        findUser();
        
        
    }



    
    function addSubUser(){
        var selUser = $('#usersList').val();
        var selUserName = $('#usersList option:selected').text();
        
        
        if(selUser == ""){
            $('#usersList').addClass('is-invalid');
             genPassword = "";
             return false;
         }else{
             
             var usersCreate = $('#usersCreate').val();
             
                if(usersCreate == 'new'){
                 
                  
                      $("#addUserModal").modal('show');

                     $('#usersList').removeClass('is-invalid');
                     
                     logoutAndGetTem();
                     
                     $("#inpMainUser").val(selUserName);
                     
        
                      $('#submitLoadingButton').addClass('d-none');
                        $("#submitButton").removeClass("d-none");
                        
                        var randomPassword = generateRandomPassword(12);
                        genPassword = randomPassword;
                        
                        $('#inpFName').removeClass('is-invalid');
                        $('#inpLName').removeClass('is-invalid');
                        $('#inpEmail').removeClass('is-invalid');
                        $('#inpPhone').removeClass('is-invalid');
                        
                        $("#inpFName").val("");
                        $("#inpLName").val("");
                       $("#inpEmail").val("");
                       $("#inpPhone").val("");
                        $("#inpPassword").val(randomPassword);
                        
                        $('#errMeg').addClass('d-none');
                        $('#succssMeg').addClass('d-none');
                        
                 
                }else{
                    
                  
                    $("#linkUserModal").modal('show');
                    $("#inpLinkMainUser").val(selUserName);

                    $('#usersList').removeClass('is-invalid');
                    
                    $('#submitLoadingButtonLink').addClass('d-none');
                        $("#submitButtonLink").addClass("d-none");
                        $("#submitFindButtonLink").removeClass("d-none");
                        
                        
                    
                    $("#selLinkEmail").val('');
                    $('#selLinkEmail').removeClass('is-invalid');
                    
                     $('#errMegLink').addClass('d-none');
                        $('#succssMegLink').addClass('d-none');
                     
                }
             
            
       
         }
        
    }
    
    function linkUser(){
        
         var selLinkEmail = $('#selLinkEmail').val();
        var selUser = $('#usersList').val();
        
        
                return new swal({
                    title: "Are you sure?",
                    text: "You want to link this user?",
                    icon: false,
                    // buttons: true,
                    // dangerMode: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                    }).then((confirm) => {
                        // console.log(confirm.isConfirmed);
                        if (confirm.isConfirmed) {
                            
                             
                             $('#submitLoadingButtonLink').removeClass('d-none');
                            $("#submitButtonLink").addClass("d-none");
                            $("#submitFindButtonLink").addClass("d-none");
                                                
                            
                            successFn = function(resp)  {
                            if(resp.status == 1){
                                
                                
                                
                                    $("#linkUserModal").modal('hide');
                                    getSubUserListData();
                                    
                                     Swal.fire({
                                        icon: 'success',
                                        title: 'Successfully link user',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    
                                    $('#succssMegLink').removeClass('d-none');
                                    $('#succssMegLink').html('Successfully link user');
                                    
                                   $('#submitLoadingButtonLink').addClass('d-none');
                                    $("#submitButtonLink").removeClass("d-none");
                                    $("#submitFindButtonLink").addClass("d-none");
                    
                                
                
                            }else{
                                
                                $('#submitLoadingButtonLink').addClass('d-none');
                                $("#submitButtonLink").removeClass("d-none");
                                $("#submitFindButtonLink").addClass("d-none");
                                
                                 $('#errMegLink').removeClass('d-none');
                                    $('#errMegLink').html('Failed to link user');
                    
                                
                            }
                        
                        
                        
                        }
                        data = { "function": 'User',"method": "linkUser" ,"sel_id":selUser , "inpEmail":selLinkEmail };
                        
                        apiCall(data,successFn);
                            
                            
                            
                            
                          
                           
                        }
                });
        
        
        
    }
    
    function findUser(){
        var selLinkEmail = $('#selLinkEmail').val();
        var selUser = $('#usersList').val();
        
        $('#errMegLink').addClass('d-none');
        $('#succssMegLink').addClass('d-none');
        $('#selLinkEmail').removeClass('is-invalid');
        
          if(selLinkEmail == ""){
            $('#selLinkEmail').addClass('is-invalid');
            return false;
        }
        
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(selLinkEmail)) {
            $('#errMegLink').removeClass('d-none');
            $('#errMegLink').html('Invalid email');
            return false;
        }
        
        
         $('#submitLoadingButtonLink').removeClass('d-none');
        $("#submitButtonLink").addClass("d-none");
        $("#submitFindButtonLink").addClass("d-none");
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
                
                $('#submitLoadingButtonLink').addClass('d-none');
                $("#submitButtonLink").removeClass("d-none");
                
                var userListData = resp.data;
                var firstname = userListData['firstname'];
                var lastname = userListData['lastname'];
                
                $('#succssMegLink').removeClass('d-none');
                $('#succssMegLink').html(selLinkEmail+" is available for user "+firstname+" "+lastname);
                
                 $('#submitLoadingButtonLink').addClass('d-none');
                $("#submitButtonLink").removeClass("d-none");
                $("#submitFindButtonLink").addClass("d-none");
                        
                

            }else{
                
                $('#submitLoadingButtonLink').addClass('d-none');
                $("#submitButtonLink").addClass("d-none");
                $("#submitFindButtonLink").removeClass("d-none");

                $('#errMegLink').removeClass('d-none');
                $('#errMegLink').html('No user found.');
                return false;
                
            }
        
        
        
        }
        data = { "function": 'User',"method": "findUser" ,"sel_id":selUser , "inpEmail":selLinkEmail };
        
        apiCall(data,successFn);
        
        
    }
    
    
    
    
    function generateRandomPassword(length) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
    
        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
        }
    
        return password;
    }
    
  

 </script>
