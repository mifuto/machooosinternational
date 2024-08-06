<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
   echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    
}

$sql = "SELECT * FROM mail_templates WHERE mail_type=12 and mail_template=90 and deleted=0";
$result = $DBC->query($sql);
$row = mysqli_fetch_assoc($result);

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
    <h1>Send common mail</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="#" role="button" >Send common mail</a></li>
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
                            <label for="inputText" class=" col-form-label">Select user type</label>
                            <select class="form-control select2" aria-label="Default select example" id="userstypeList" name="userstypeList" onchange="changeUserType();">
                                   <option value="1" selected>Main user</option>
                                   <option value="2" >Guest user</option>
                            </select>
                             
                          </div>
                          
                          <div class="col-3">
                            <label for="inputText" class=" col-form-label">County</label>
                            <select class="form-control select2" aria-label="Default select example" id="selCounty" name="selCounty" onchange="getState('selState');">
                            </select>
                             
                          </div>
                          
                          
                          
                        <div class="col-3">
                            <label for="inputText" class=" col-form-label">State</label>
                            <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" onchange="getCity('selCity');">
                            </select>
                             
                          </div>
                
                
                        <div class="col-3" id="divDistrict">
                            <label for="inputText" class=" col-form-label">District</label>
                            <select class="form-control select2" aria-label="Default select example" id="selCity" name="selCity">
                            </select>
                             
                          </div>
                
                
                    </div>
                          
                          
                     <div class="row mb-3">
                          
                       <div class="col-6 " align="right">
                          <button class="btn btn-primary " id="submitButton" onclick="sendDemo();">Send demo</button>
                          <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                              Please wait...
                            </button>
                          
                          
                        </div>
                        <div class="col-6 " align="left">
                          <button class="btn btn-primary " id="submitButton1" onclick="sendMailToUser();">Send mail</button>
                           <button class="btn btn-primary d-none" type="button" id="submitLoadingButton1" disabled>
                              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                              Please wait...
                            </button>
                        </div>
                     
                    </div>
                    <hr>
                    
                    
                    <div class="col-sm-12 table-responsive mt-4" align="center">
                        <h5 class="text-secondary"><span class="text-dark">Set mail: </span>System settings / Email Templates : Common - Common mail </h5>
                        
                        <div class="row mb-3" style="padding:20px;">
                            <div class="col-12 mb-3" align="left">
                              <label><b>Subject :</b> <?=$row['subject']?></label>
                            </div>
                            <div class="col-12 " align="left">
                                <div class="bg-light p-2 " > <?=$row['mail_body']?>  </div>
                              
                            </div>
                            
                        </div>
                        
                        
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
        
         $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");
       
         $('#submitLoadingButton1').addClass('d-none');
       $("#submitButton1").removeClass("d-none");
      
          getCounty("selCounty");
       getState('selState');
       getCity('selCity');
    
    });
    
    function changeUserType(){
        var userstypeList = $('#userstypeList').val();
        if(userstypeList == 1) $('#divDistrict').removeClass('d-none');
        else $('#divDistrict').addClass('d-none');
    }
    
    function sendDemo(){
        var userstypeList = $('#userstypeList').val();
        var selCounty = $('#selCounty').val();
        var selState = $('#selState option:selected').text();
        var selCity = $('#selCity option:selected').text();

        if(selState == 'Select State') selState = '';
        if(selCity == 'Select District') selCity = '';
        
        
         $('#submitLoadingButton').removeClass('d-none');
        $("#submitButton").addClass("d-none");
        
         successFn = function(resp)  {
             if(resp.status == 1){
                 Swal.fire({
                     icon: 'success',
                     title: resp.data,
                     showConfirmButton: false,
                     timer: 1500
                 });
                  
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
                 
             
             
             
         }
         data = { "function": 'User',"method": "sendDemo" };
         apiCall(data,successFn);
        
        
    }
    
     function sendMailToUser(){
        var userstypeList = $('#userstypeList').val();
        var selCounty = $('#selCounty').val();
        var selState = $('#selState option:selected').text();
        var selCity = $('#selCity option:selected').text();

        if(selState == 'Select State') selState = '';
        if(selCity == 'Select District') selCity = '';
        
        
         $('#submitLoadingButton1').removeClass('d-none');
        $("#submitButton1").addClass("d-none");
        
         successFn = function(resp)  {
             if(resp.status == 1){
                 Swal.fire({
                     icon: 'success',
                     title: resp.data,
                     showConfirmButton: false,
                     timer: 1500
                 });
                  
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
                 
             
             
             
         }
         data = { "function": 'User',"method": "sendMailToUser" , "usertype":userstypeList, "selCounty":selCounty, "selState":selState, "selCity":selCity };
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
      $("#"+selectId).select2();
      
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
      $("#"+selectId).select2();
      
    
      
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
      $("#"+selectId).select2();
      
      if(val !="")$("#selCity").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}


    
  

 </script>
