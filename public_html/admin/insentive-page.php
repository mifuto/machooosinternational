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
    
    if (strpos($userPermissionsList, 'Insentive') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}else{
    echo '<script>';
    echo 'window.location.href = "dashboard.php";';
    echo '</script>';
}

$UserRoleID = $_SESSION['UserRole'];

$serviceData = [];

$getService = "SELECT * FROM tblinsentive_roles where FIND_IN_SET($UserRoleID, role_id) and active=0 ORDER BY name DESC";
$resultService = $DBC->query($getService);

$countService = mysqli_num_rows($resultService);

$isServiceNotAvl = 1;

if($countService > 0) {	
    $isServiceNotAvl = 0;
    while ($row = mysqli_fetch_assoc($resultService)) {
        array_push($serviceData,$row);
    }
}



?>

    <div class="pagetitle">
      <h1>Insentive</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Insentive</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="HVSectionFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT"></h5>

             
              <form id="addCountyForm"  >
                  
                  
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Full Name</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpName" name="inpName" value="<?=$Username?>" disabled>

                        <div class="invalid-feedback">
                        Please enter Name!.
                        </div>
                    </div>
                </div>
                
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Employee ID/Code</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpCode" name="inpCode" value="<?=$loggedUserIdVal?>" disabled>

                        <div class="invalid-feedback">
                        Please enter Employee ID/Code!.
                        </div>
                    </div>
                </div>
                
                  
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Project Name</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selProjectName" name="selProjectName" >
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Project Name!.
                        </div>
                    </div>
                    
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Start Date</label>
                    <div class="col-12">
                        <input type="date" class="form-control" id="inpStartDate" name="inpStartDate">

                        <div class="invalid-feedback">
                        Please select Start Date!.
                        </div>
                    </div>
                </div>
                
                  <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Project End Date</label>
                    <div class="col-12">
                        <input type="date" class="form-control" id="inpProjectEndDate" name="inpProjectEndDate">

                        <div class="invalid-feedback">
                        Please select Project End Date!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Project Description</label>
                    <div class="col-12">
                        <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>

                        <div class="invalid-feedback">
                        Please enter Description!.
                        </div>
                    </div>
                </div>
                
                
                <?php if(count($serviceData) > 0) { ?>
                
                
                 <div class="row mb-3">
                        
                    <div class="col-12">
                        <b>Staff jobs for Insentive</b>
                    </div>
                    
                    <?php
                        foreach ($serviceData as $key => $album) { 
                             $sID = $album['id'];
                            $sName = $album['name'];
                            $price = $album['price'];
                        ?>
                        
                        <div class="col-12">
                            <input type="checkbox" value="<?=$sID?>" id="myServiceCheckbox_<?=$sID?>" name="myServiceCheckboxName" onchange="changeServiceCheckbox(<?=$sID?>,`<?=$price?>`)">  <?=$sName?>
                        </div>
                        
                        
                        <?php } ?>
                    
                    
                  
                   
                    
                </div>
                
                <? } ?>
                
                
                
                
                
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Your Role in the Project</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpRole" name="inpRole" value="" >

                        <div class="invalid-feedback">
                        Please enter Your Role in the Project!.
                        </div>
                    </div>
                </div>
                
                
                <?php if($isServiceNotAvl == 1){ ?>
                
                    <div class="row mb-3">
                        <label for="" class="col-12 col-form-label">Total amount the product</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpTotalAmount" name="inpTotalAmount" value="" >
    
                            <div class="invalid-feedback">
                            Please enter Total amount the product!.
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="row mb-3 ">
                        <label for="" class="col-12 col-form-label">Discounted amount</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpDiscountedAmount" name="inpDiscountedAmount" value="" >
    
                            <div class="invalid-feedback">
                            Please enter Discounted amount !.
                            </div>
                        </div>
                    </div>
                    
                <?php }else{ ?>
                
                
                    <div class="row mb-3 d-none">
                        <label for="" class="col-12 col-form-label">Total amount the product</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpTotalAmount" name="inpTotalAmount" value="0" >
    
                            <div class="invalid-feedback">
                            Please enter Total amount the product!.
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="row mb-3 d-none">
                        <label for="" class="col-12 col-form-label">Discounted amount</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpDiscountedAmount" name="inpDiscountedAmount" value="0" >
    
                            <div class="invalid-feedback">
                            Please enter Discounted amount !.
                            </div>
                        </div>
                    </div>
                
                
                <?php } ?>
                
                
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Key Achievements or Contributions to the Project</label>
                    <div class="col-12">
                        <textarea class="form-control" id="inpAchievements" name="inpAchievements"></textarea>

                        <div class="invalid-feedback">
                        Please enter Key Achievements or Contributions to the Project!.
                        </div>
                    </div>
                </div>
                
                  <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Challenges Faced and How They Were Overcom</label>
                    <div class="col-12">
                        <textarea class="form-control" id="inpChallenges" name="inpChallenges"></textarea>

                        <div class="invalid-feedback">
                        Please enter Challenges Faced and How They Were Overcom!.
                        </div>
                    </div>
                </div>
                
                
                  <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Share Any Suggestions for Future Project Improvement</label>
                    <div class="col-12">
                        <textarea class="form-control" id="inpSuggestions" name="inpSuggestions"></textarea>

                        <div class="invalid-feedback">
                        Please enter Share Any Suggestions for Future Project Improvement!.
                        </div>
                    </div>
                </div>
                
               
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Upload Supporting Documents or Project Deliverables</label>
                    <div class="col-12">
                        <input type="file" class="form-control" id="import_video" name="import_video" accept="image/*">

                        <div class="invalid-feedback">
                        Please upload file!.
                        </div>
                    </div>
                </div>
                
                
                  <div class="row mb-3">
                    <div class="col-12">
                       <input type="checkbox" id="checkBoxSel" name="checkBoxSel"  > I have read and agree to the Terms and Conditions
                       
                        <div class="invalid-feedback">
                        Please accept Terms and Conditions!.
                        </div>
                    </div>
                </div>
                
                
                
                
                
                <div class="row mb-3 mt-5">
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-danger d-none" id="signalbmUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div id="uploadStatus"></div>
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
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="HVSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">My Insentives</h5>
                </div>
                
              
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddHVSection();">Add Insentive</button>
                </div>
              </div> 
              
              
                <div class="row mb-3 pt-2">
                        <!--<div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">-->
                        <!--   <label for="inputText" class="col-form-label text-muted"> Total Requests</label>-->
                        <!--   <h5 id="disPrice"></h5>-->
                        <!--</div>-->
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Accepted</label>
                           <h5 id="disAccepted"></h5>
                        </div>
                        
                         <div class="col-3 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Paid</label>
                           <h5 id="disPaid"></h5>
                        </div>
                        
                         <div class="col-2 text-center" style="border: 1px solid #d8d8d8; border-radius: 10px;margin:1px;">
                           <label for="inputText" class="col-form-label text-muted"> Pending</label>
                           <h5 id="disPending"></h5>
                        </div>
                        
                      

                       
                   </div>
              
              
              
              
              
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Project Name</th>
                      <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Role</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                   
                      <th scope="col">Created on</th>
                      <th scope="col">Status</th>
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
    
    
    
    
    <div class="modal fade" id="showFullSummaryView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Detailed view</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendSAEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" id="disApplicationSummaryDetails">
                
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
var isEditMode = false;
var checkBoxPrice = 0;


  $( document ).ready(function() {
      getProjectNames("selProjectName");
      
      getDisHVListData();
     

  });
  
  
    
 
  function getProjectNames(selectId) {
     
        successFn = function(resp)  {
            // resp = JSON.parse(resp);
          
          var users = resp["data"];
          var options = "<option selected value=''>Select project name</option>";
          $.each(users, function(key,value) {
            // console.log(value.id);
            options += "<option value='"+value.id+"'>"+value.name+"</option>";
          });
        //   alert("#"+selectId);
    
          $("#"+selectId).html(options);
          $("#"+selectId).select2();
          
        }
        data = { "function": 'SystemManage',"method": "getProjectNames"};
        
        apiCall(data,successFn);
        
    }

  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    
     function showAddHVSection(){
      
      emptyForm();
      
      

     
    $("#HVSection").addClass("d-none");
        $('#addEVT').html('Add Insentive');
        
       
        $('#HVSectionFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       
       $("#inpStartDate").val("");
       $("#inpProjectEndDate").val("");
       $("#selProjectName").val("").trigger('change');
       $("#inpDescription").val("");
       $("#inpRole").val("");
       
       var isServiceNotAvl = '<?=$isServiceNotAvl?>';
       if(isServiceNotAvl == 1){
           $("#inpTotalAmount").val("");
            $("#inpDiscountedAmount").val("");
       }else{
           $("#inpTotalAmount").val(0);
            $("#inpDiscountedAmount").val(0);
       }
       
       
       
      
      
       $("#inpAchievements").val("");
        $("#inpChallenges").val("");
       $("#inpSuggestions").val("");
       
       $('input[name="myServiceCheckboxName"]').prop('checked', false);
       
       $('#checkBoxSel').prop('checked', false);
     
       $("#import_video").val("");
       
       isEditMode = false;
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');

       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  
   
  function cancelCountyForm(){
      emptyForm();
      $('#HVSectionFormSection').addClass("d-none");
      $("#HVSection").removeClass("d-none");
  }
  
  function changeServiceCheckbox(id,price){
      
      var checkbox = document.getElementById("myServiceCheckbox_"+id);

        // Check if the checkbox is checked
        if (checkbox.checked) {
             $('input[name="myServiceCheckboxName"]').prop('checked', false);
            checkBoxPrice = price;
            $("#myServiceCheckbox_"+id).prop('checked', true);
            
            
        } else {
             $('input[name="myServiceCheckboxName"]').prop('checked', false);
            checkBoxPrice = 0;
        }
      
     
      
      
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var isServiceNotAvl = '<?=$isServiceNotAvl?>';
        var checkedValues = $('input[name="myServiceCheckboxName"]:checked').map(function() {
            return $(this).val();
        }).get();
        
        if(isServiceNotAvl == 0){
            if(checkedValues == ''){
                Swal.fire({
                    icon: 'error',
                    title: "Please select Staff jobs for Insentive",
                    showConfirmButton: false,
                    timer: 1500
                });
                return false;
            } 
        }
        
       
        var save = $("#save").val();
        
        var import_video = $("#import_video").val();
            
        if(import_video == "" && save == "add"){
            Swal.fire('Please upload the file ')
            return false;
        }
        
        
        var Username = '<?=$Username?>';
        var loggedUserIdVal = '<?=$loggedUserIdVal?>';
        
        var selectedText = $('#selProjectName option:selected').text();
        
        
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveInsentive');
        formData.append('Username', Username);
        formData.append('loggedUserIdVal', loggedUserIdVal);
        formData.append('selectedProject', selectedText);
        formData.append('selServices', checkedValues);
        formData.append('STP', checkBoxPrice);
        formData.append('CHK', isServiceNotAvl);
        
      
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Insentive",
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
                            xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = ((evt.loaded / evt.total) * 100);
                                    $(".progress-bar").width(percentComplete.toFixed(0) + '%');
                                    $(".progress-bar").html(percentComplete.toFixed(0) +'%');
                                }
                            }, false);
                            return xhr;
                        },
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                             contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){
                            $(".progress-bar").width('0%');
                            // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                            $('#signalbmUploadStatus').removeClass('d-none');
                        },
                     
                            error:function(){
                               $("#submitButton").removeClass("d-none");
                                $("#submitLoadingButton").addClass("d-none");
                                // $("#hiddenEventId").val("");
                                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Insentive "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getDisHVListData();
                                    
                                    cancelCountyForm();
                                    
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
        inpStartDate: {
            required: true
        },
        inpProjectEndDate :{
            required: true
        },
        selProjectName:{
            required: true
        },
       
        inpDescription: {
            required: true
        },
        inpRole :{
            required: true
        },
        inpTotalAmount:{
            required: true
        },
        
         inpDiscountedAmount: {
            required: true
        },
        inpAchievements :{
            required: true
        },
        inpChallenges:{
            required: true
        },
       
        checkBoxSel:{
            required: true
        },
       
    },
    messages: {
        checkBoxSel: {
            required: "Please accept Terms and Conditions"
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


  function getTotalCount(){
         var disType = '<?=$loggedUserIdVal?>';
      
     
        successFn = function(resp)  {
             var eventList = resp.data;
            //  if(eventList['sumOfTotal'] == null) $('#disPrice').html("₹0");
            //  else $('#disPrice').html("₹"+eventList['sumOfTotal']);
             
             if(eventList['sumOfTotalAccepted'] == null) $('#disAccepted').html("₹0");
             else $('#disAccepted').html("₹"+eventList['sumOfTotalAccepted']);
             
             if(eventList['sumOfTotalPaid'] == null) $('#disPaid').html("₹0");
             else $('#disPaid').html("₹"+eventList['sumOfTotalPaid']);
             
              if(eventList['sumOfTotalPending'] == null) $('#disPending').html("₹0");
             else $('#disPending').html("₹"+eventList['sumOfTotalPending']);
           

            
        }
        data = {"function": 'SystemManage', "method": "getTotalCountUser" ,"disType":disType  };
        
        apiCall(data,successFn);
        
        
        
    }
    
    
    function viewDetails(id){
    
    $("#disApplicationSummaryDetails").html('');
    
     successFn = function(resp)  {
            if(resp.status == 1){
                
                 $("#showFullSummaryView").modal('show');
              
                var eventList = resp.data;
                
                disData +='<div class="row ">';
                if(eventList['status'] == 0) disData +='<b class="text-warning">Pending</b>';
                else if(eventList['status'] == 1){
                     disData += '<b class="text-success">Accepted</b><br>';
                     if(eventList['is_paid'] == 0 ) disData += '<label class="text-danger">Cash not paid</label>';
                     else disData += '<label class="text-success">Cash paid</label>';
                    
                }
                else if(eventList['status'] == 2){
                    disData += '<b class="text-danger">Rejected</b><br>';
                    disData += '<label class="text-dark">'+eventList['reject_description']+'</label><br>';
                    
                } 
                disData +='</div><hr>';
                
                disData +='<div class="row ">';
                disData += '<b class="text-success">Insentive amount : ₹'+eventList['total_paid_amt']+'</b><br>';
                
                disData +='</div><hr>';
                
                
                
                disData +='<div class="row ">';
                disData +='<label><b>Full Name : </b>'+eventList['name']+'</label><br>';
                disData +='<label><b>Employee ID/Code : </b>'+eventList['code']+'</label><br>';
                disData +='<label><b>Project Name : </b>'+eventList['selected_project']+'</label><br>';
                disData +='<label><b>Start Date : </b>'+eventList['start_date']+'</label><br>';
                disData +='<label><b>End Date : </b>'+eventList['end_date']+'</label><br>';
                disData +='<label><b>Project Description : </b>'+eventList['description']+'</label><br>';
                disData +='<label><b>Your Role in the Project : </b>'+eventList['role']+'</label><br>';
                disData +='<label><b>Total amount the product : </b>₹'+eventList['total_amt']+'</label><br>';
                disData +='<label><b>Discounted amount : </b>₹'+eventList['discount_amt']+'</label><br>';
                disData +='<label><b>Key Achievements or Contributions to the Project : </b>'+eventList['achievements']+'</label><br>';
                disData +='<label><b>Challenges Faced and How They Were Overcom : </b>'+eventList['challenges']+'</label><br>';
                disData +='<label><b>Share Any Suggestions for Future Project Improvement : </b>'+eventList['suggestions']+'</label><br>';
                disData +='</div><br>';
                
                if(eventList['sel_services_names'] != "" && eventList['sel_services_names'] != null){
                      
                     disData +='<div class="row ">';
                   disData +='<label><b>Staff jobs for Insentive : </b>'+eventList['sel_services_names']+'</label><br>';
                    disData +='</div><br>';
                
                }
              
                
                
                
                disData +='<div class="row ">';
                disData +='<img src="'+eventList['vedio']+'" style="width: 40%;" script="max-height:100px" />';
                disData +='</div>';
                
        
                
                $("#disApplicationSummaryDetails").html(disData);
            

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditInsentiveList" ,"sel_id":id };
        
        apiCall(data,successFn);
    
}




  function getDisHVListData(){ 
      
      var userId = '<?=$loggedUserIdVal?>';
      
      getTotalCount()
   
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
            
              
              { "data": "selected_project" },
              
                { "data": null,
                render: function ( data ) {
                    
                  
                    var date = new Date(data['start_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
                   { "data": null,
                render: function ( data ) {
                    
                  
                    var date = new Date(data['end_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
                
                { "data": "description" },
                
              { "data": "role" },
               {"data":null,"render":function(item){
                  
                return '₹'+item.total_amt;
                
                    
                    }
                },
              
              {"data":null,"render":function(item){
                  
                return '<img src="'+item.vedio+'" width="150px" script="max-height:100px" />';
                
                    
                    }
                },
             


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
                  
                        if(item.status == 0) return '<b class="text-warning">Pending</b>';
                        else if(item.status == 1){
                            if(item.is_paid == 0){
                                return '<b class="text-success">Accepted</b><hr><b class="text-danger">Cash not paid</b>';
                            }else{
                                return '<b class="text-success">Accepted</b><hr><b class="text-success">Cash paid</b>';
                            }
                            
                            
                            
                        } 
                        else if(item.status == 2) return '<b class="text-danger">Rejected</b>';
                        
                        
                        
                
                    
                    }
                },
              
              
              {"data":null,"render":function(item){
                  var str = '<span class="badge bg-info text-dark" onclick="viewDetails('+item.id+');" style="cursor:pointer">View</span>';
                  
                  if( item.status == 0){
                      
                          str +='<span class="badge bg-primary text-white" onclick="editServiceTypeList('+item.id+');" style="cursor:pointer">edit</span>';
                          
                          str +='<span class="badge bg-danger" onclick="setactiveeventtype('+item.id+');" style="cursor:pointer">delete</span>';
                    
                        
                          
                        
                        
                  }
                  
                  return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getInsentiveListData" ,"userId":userId };
    
    apiCall(data,successFn);
}

  
  
  
  function editServiceTypeList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');



    
        $('#addEVT').html('Update Insentive');
          $('#HVSectionFormSection').removeClass("d-none");
                $("#HVSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                isEditMode = true;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $('input[name="myServiceCheckboxName"]').prop('checked', false);
                
                
              
                   $("#inpStartDate").val(eventList['start_date']);
                   $("#inpProjectEndDate").val(eventList['end_date']);
                   $("#selProjectName").val(eventList['project_name']).trigger('change');
                   $("#inpDescription").val(eventList['description']);
                   $("#inpRole").val(eventList['role']);
                   
                   
                   if(eventList['is_chk'] == 1){
                       $("#inpTotalAmount").val(eventList['total_amt']);
                        $("#inpDiscountedAmount").val(eventList['discount_amt']);
                   }else{
                       $("#inpTotalAmount").val(0);
                        $("#inpDiscountedAmount").val(0);
                        
                        checkBoxPrice = eventList['total_amt'];
                        
                   }
                   
                   
                   
                  
                  
                   $("#inpAchievements").val(eventList['achievements']);
                    $("#inpChallenges").val(eventList['challenges']);
                   $("#inpSuggestions").val(eventList['suggestions']);
                   
                   $('#checkBoxSel').prop('checked', true);
                 
                   $("#import_video").val("");
                   
                   var arrayOfNumbers = eventList['sel_services'].split(',');
                   
                    for (var i = 0; i < arrayOfNumbers.length; i++) {
                        $('#myServiceCheckbox_'+arrayOfNumbers[i]).prop('checked', true);
                    }
                
                
            

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditInsentiveList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
 

function setactiveeventtype(id){
  
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Insentive",
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
                            getDisHVListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteInsentive" ,"sel_id":id };
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