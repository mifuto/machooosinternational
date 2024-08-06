
<?php 
session_start();

if(isset($_SESSION['MachooseAdminUser']['user_id']) && $_SESSION['MachooseAdminUser']['user_id']!=""){
  header("Location: dashboard.php");
  // print_r($_SESSION['Sdsds']);
}else if(isset($_SESSION['MachooseAdminUser']['id']) && $_SESSION['MachooseAdminUser']['id']!=""){
  header("Location: provider-dashboard.php");
  // print_r($_SESSION['Sdsds']);
}

include("templates/login-header.php")

?> 

<style>
    #main, #footer {
    margin-left: 0px !important;
}
</style>


<div class="container">
    <section class="section d-flex flex-column align-items-center justify-content-center ">
        
        
        
        <div class="container">
            
            <div class="row d-flex flex-column align-items-center justify-content-center ">
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    
                    <div class="d-flex justify-content-center">
                        <!-- <!-- <a href="index.html" class="logo d-flex align-items-center w-auto">-->
                          <!-- <img src="../images/logo.png" alt="">-->
                          <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                        </a>
                         <IMG SRC="Photos/machooos_.gif" style="width:350px;height:200px;">.
                    </div><!-- End Logo -->
                    
                    
                    <div class="card mb-3 d-none" id="registerUserDiv">

                        <div class="card-body">
        
                              <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Provider Register</h5>
                                <p class="text-center small">Website for Provider Activities</p>
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
                                            Please enter the matched re-password.
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
                                        <label for="" class="col-12 col-form-label">Service Center Type</label>
                                       
                                        <div class="col-12">
                                            
                                             <select class="form-control select2" aria-label="Default select example" id="selServiceCenter" name="selServiceCenter">
                                                </select>
                                            
                                            
                                            
                                            <div class="invalid-feedback">
                                            Please select the Service Center Type!.
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                     <div class="text-danger d-none" id="registrationFailedErr" ></div>
                                    
                                    
        
                                  
                                    <div class="col-12 mt-4 ">
                                      <button id="submitButton11" class="btn btn-primary w-100" type="button" onclick="registerNow();">Register</button>
                                      <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton11" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Please wait...
                                        </button>
                                    </div>
                                    
                                     <div class="col-12 mt-2 ">
                                       <button class="btn btn-primary w-100" type="button" onclick="LoginUser();" >Login </button>
                                     
                                    </div>
                                   
                          
                          
                          
        
                        </div>
                       
                        
                     </div>
                    
                    
                    <div class="card mb-3" id="loginDiv">

                        <div class="card-body">
        
                              <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Provider Login</h5>
                                <p class="text-center small">Website for Provider Activities</p>
                              </div>
                              
                              
        

                                    <div class="row mb-2">
                                        <label for="" class="col-12 col-form-label">Email</label>
                                        <div class="col-12">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    
                                            <div class="invalid-feedback">
                                            Please enter valid email address.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <label for="" class="col-12 col-form-label">Password</label>
                                        <div class="col-12">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    
                                            <div class="invalid-feedback">
                                            Please enter your password!
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
        
                                    <div class="text-danger d-none" id="loginFailedErr" >Incorrect username or password. Please re-enter</div>
                                    
                                    
                                  
                                    <div class="col-12 mt-4 ">
                                      <button id="submitButton" class="btn btn-primary w-100" type="button" onclick="checkLogin();">Login</button>
                                      <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Please wait...
                                        </button>
                                    </div>
                                    
                                     <div class="col-12 mt-2 ">
                                       <button class="btn btn-primary w-100" type="button" onclick="registerUser();" >Register</button>
                                     
                                    </div>
                                   
                          
                          
                          
        
                        </div>
                       
                        
                     </div>
                     
                     
                     <div class="card mb-3 d-none" id="authDiv">

                        <div class="card-body">
        
                              <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Provider Login</h5>
                                <p class="text-center small">Website for Provider Activities</p>
                              </div>
                              
                              
                                    <div class="row mb-2">
                                        <label for="" class="col-12 col-form-label">Enter authentication code</label>
                                        <div class="col-12">
                                            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter authentication code">
                    
                                            <div class="invalid-feedback">
                                            Please enter authentication code.
                                            </div>
                                        </div>
                                    </div>
                                    
                                   
                                    
        
                                    <div class="text-danger d-none" id="authFailedErr" >Authentication failed. Please re-enter</div>
                                    
                                    
                                  
                                    <div class="col-12 mt-4 mb-2">
                                      <button id="submitButton1" class="btn btn-primary w-100" type="button" onclick="authNow();">Verify</button>
                                      <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton1" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                        Please wait...
                                        </button>
                                    </div>
                                    
                                    <div class="text-secondary pb-4 d-none" id="authInfoMess" ></div>
                                   
                          
                          
                          
        
                        </div>
                        
                      
                        
                        
                     </div>
                     
                     
                     
                      
                        <div class="credits pb-4" align="center" style="padding:10px;">
                       
                            <a href="login.php" class="border btn btn-muted text-primary">I am a staff in Machooos International</a>
                        </div>
                     

                      <!--<div class="credits">-->
                       
                      <!--  Designed by <a href="https://machooosinternational.com/">Machooos International</a>-->
                      <!--</div>-->
                    
                    
                </div>
                
                
                
            </div>
            
            
            
        </div>
        
        
        
    </section>
    
    
</div>



  <?php 

include("templates/footer.php")

?>

<script>
  $( document ).ready(function() {
     $('#email').removeClass('is-invalid');
     $('#password').removeClass('is-invalid');
     $('#loginFailedErr').addClass('d-none');
     $('#authFailedErr').addClass('d-none');
     
     $('#submitLoadingButton').addClass('d-none');
    $("#submitButton").removeClass("d-none");
    
    $('#submitLoadingButton1').addClass('d-none');
    $("#submitButton1").removeClass("d-none");
    
    $("#loginDiv").removeClass("d-none");
    $("#authDiv").addClass("d-none");
    
    $("#authInfoMess").addClass("d-none");
    $("#registerUserDiv").addClass("d-none");
    
    
        getCounty("selCounty");
       getState('selState');
       getCity('selCity');
       getServiceCenter('selServiceCenter');

     
     
    

  });
  
   function getServiceCenter(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Service Center Type</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.center_name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.center_name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServiceCenterActiveList" };
    
    apiCall(data,successFn);
    
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
  
  function registerUser(){
      $("#loginDiv").addClass("d-none");
      $("#registerUserDiv").removeClass("d-none");
      
        $("#inpEmail").val("");
       $("#inpName").val("");
       
        
       $("#inpPassword").val("");
       $("#inpRePassword").val("");
       
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#selCity").val("").trigger('change');
       $("#selServiceCenter").val("").trigger('change');
       
       
       
       
       $("#registrationFailedErr").addClass("d-none");
       $("#registrationFailedErr").html("");
       
          $('#submitLoadingButton11').addClass('d-none');
        $("#submitButton11").removeClass("d-none");
      
      
  }
  
  function registerNow(){
      
       $('#inpEmail').removeClass('is-invalid');
     $('#inpName').removeClass('is-invalid');
     $('#inpPassword').removeClass('is-invalid');
     $('#inpRePassword').removeClass('is-invalid');
     $('#selCounty').removeClass('is-invalid');
     $('#selState').removeClass('is-invalid');
     $('#selCity').removeClass('is-invalid');
     $('#selServiceCenter').removeClass('is-invalid');
     
     var inpEmail = $('#inpEmail').val();
     var inpName = $('#inpName').val();
     var inpPassword = $('#inpPassword').val();
     var inpRePassword = $('#inpRePassword').val();
     var selCounty = $('#selCounty').val();
     var selState = $('#selState').val();
     var selCity = $('#selCity').val();
     var selServiceCenter = $('#selServiceCenter').val();
     
       if(inpEmail == ""){
         $('#inpEmail').addClass('is-invalid');
         $('#inpEmail').focus();
         return false;
     }
     
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(inpEmail)) {
            $('#inpEmail').addClass('is-invalid');
             $('#inpEmail').focus();
             return false;
        }

       if(inpName == ""){
         $('#inpName').addClass('is-invalid');
         $('#inpName').focus();
         return false;
     }
     
        if(inpPassword == ""){
         $('#inpPassword').addClass('is-invalid');
         $('#inpPassword').focus();
         return false;
     }
      
       if(inpRePassword != inpPassword){
         $('#inpRePassword').addClass('is-invalid');
         $('#inpRePassword').focus();
         return false;
     }
     
      if(selCounty == ""){
         $('#selCounty').addClass('is-invalid');
         $('#selCounty').focus();
         return false;
     }
     
      if(selState == ""){
         $('#selState').addClass('is-invalid');
         $('#selState').focus();
         return false;
     }
      
       if(selCity == ""){
         $('#selCity').addClass('is-invalid');
         $('#selCity').focus();
         return false;
     }
     
       if(selServiceCenter == ""){
         $('#selServiceCenter').addClass('is-invalid');
         $('#selServiceCenter').focus();
         return false;
     }
     
      $('#submitLoadingButton11').removeClass('d-none');
    $("#submitButton11").addClass("d-none");
     
      successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton11').addClass('d-none');
            $("#submitButton11").removeClass("d-none");
            
         
            
            $('#authFailedErr').addClass('d-none');
            
            $('#otp').removeClass('is-invalid');
            
             $("#registerUserDiv").addClass("d-none");
             $("#loginDiv").addClass("d-none");
            $("#authDiv").removeClass("d-none");
            
            $("#authInfoMess").removeClass("d-none");
            $("#authInfoMess").html("Authentication code send to "+inpEmail);
            
            $('#email').val(inpEmail);
            
    
            
        }else{
            $("#registrationFailedErr").removeClass("d-none");
            $("#registrationFailedErr").html(resp.data);
        }
        
       
        $('#submitLoadingButton11').addClass('d-none');
        $("#submitButton11").removeClass("d-none");
      
    }
    data = { "function": 'User',"method": "registerServiceProvider" , "email":inpEmail, "password":inpPassword, 'name':inpName ,'county':selCounty,'state':selState ,'city':selCity ,'save':'add','servicescenter_id':selServiceCenter };
    
    apiCall(data,successFn);

      
  }
  
  function LoginUser(){
      $("#loginDiv").removeClass("d-none");
      $("#registerUserDiv").addClass("d-none");
      
  }
  
  
  function checkLogin(){
      
      $('#email').removeClass('is-invalid');
     $('#password').removeClass('is-invalid');
     $('#loginFailedErr').addClass('d-none');
     
     var email = $('#email').val();
     var password = $('#password').val();
     
     if(email == ""){
         $('#email').addClass('is-invalid');
         $('#email').focus();
         return false;
     }
     
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
             $('#email').focus();
             return false;
        }
     
     if(password == ""){
         $('#password').addClass('is-invalid');
         $('#password').focus();
         return false;
     }
     
     
      $('#submitLoadingButton').removeClass('d-none');
    $("#submitButton").addClass("d-none");
    
    
    successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton1').addClass('d-none');
            $("#submitButton1").removeClass("d-none");
            $('#authFailedErr').addClass('d-none');
            
            $('#otp').removeClass('is-invalid');
            
             $("#loginDiv").addClass("d-none");
            $("#authDiv").removeClass("d-none");
            
            $("#authInfoMess").removeClass("d-none");
            $("#authInfoMess").html("Authentication code send to "+email);
            
    
            
        }else{
            $('#loginFailedErr').removeClass('d-none');
        }
        
       
        $('#submitLoadingButton').addClass('d-none');
        $("#submitButton").removeClass("d-none");
      
    }
    data = { "function": 'User',"method": "checkProviderLogin" , "email":email, "password":password  };
    
    apiCall(data,successFn);
      
      
  }
  
  function authNow(){
      
      $('#otp').removeClass('is-invalid');
      $('#authFailedErr').addClass('d-none');
      
       var email = $('#email').val();
       var otp = $('#otp').val();
       
        if(otp == ""){
         $('#otp').addClass('is-invalid');
         $('#otp').focus();
         return false;
        }
        
        $('#submitLoadingButton1').removeClass('d-none');
        $("#submitButton1").addClass("d-none");
        
         successFn = function(resp)  {
        
            if(resp.status == 1){
              window.location.href = '/admin/provider-dashboard.php';

            }else{
                $('#authFailedErr').removeClass('d-none');
            }
            
           
            $('#submitLoadingButton1').addClass('d-none');
            $("#submitButton1").removeClass("d-none");
          
        }
        data = { "function": 'User',"method": "authProviderNow" , "email":email, "otp":otp  };
        
        apiCall(data,successFn);
      
      
  }
  
  
  
  
</script>
 
  