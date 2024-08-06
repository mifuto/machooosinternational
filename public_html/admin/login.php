
<?php 
session_start();

// print_r($_SESSION['MachooseAdminUser']);die;

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
                    
                    <div class="d-flex justify-content-center ">
                         <!--<a href="index.html" class="logo d-flex align-items-center w-auto"> -->
                          <!--<img src="../images/logo.png" alt=""> -->
                          <!-- <span class="d-none d-lg-block">NiceAdmin</span> -->
                        </a>
                        
                    </div><!-- End Logo -->
                    <IMG SRC="Photos/machooos.gif" style="width:350px;height:250px;">.
                    
                    <div class="card mb-3" id="loginDiv">

                        <div class="card-body">
        
                              <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Staff Login</h5>
                                <p class="text-center small">Website for Staff Activities</p>
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
                                   
                          
                          
                          
        
                        </div>
                        
                      
                        
                     </div>
                     
                     
                     <div class="card mb-3 d-none" id="authDiv">

                        <div class="card-body">
        
                              <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Staff Login</h5>
                                <p class="text-center small">Website for Staff Activities</p>
                              </div>
                              
                              
                                    <div class="row mb-2">
                                        <label for="" class="col-12 col-form-label">Enter authentication code</label>
                                        <div class="col-12">
                                            <input type="password" class="form-control" id="otp" name="otp" placeholder="Enter authentication code">
                    
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
                     
                     
                       <!--<div class="credits pb-4" align="center" style="padding:10px;">-->
                       
                       <!--     <a href="service-provider-login.php" class="border btn btn-muted text-primary">I am a service provider in Machooos International</a>-->
                       <!-- </div>-->
                     
                     

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
    
    
     
     
    

  });
  
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
    data = { "function": 'User',"method": "checkLogin" , "email":email, "password":password  };
    
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
               window.location.href = '/admin/dashboard.php';
                
            }else{
                $('#authFailedErr').removeClass('d-none');
            }
            
           
            $('#submitLoadingButton1').addClass('d-none');
            $("#submitButton1").removeClass("d-none");
          
        }
        data = { "function": 'User',"method": "authNow" , "email":email, "otp":otp  };
        
        apiCall(data,successFn);
      
      
  }
  
  
  
  
</script>
 
  