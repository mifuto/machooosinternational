<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['id'] == ""){
  header("Location: service-provider-login.php");
  // print_r("sasaa");
}
include("templates/provider-header.php");

$isProvider = $_SESSION['isProvider'];

if(!$isProvider){
    echo '<script>';
    echo 'window.location.href = "service-provider-login.php";';
    echo '</script>';
    
}


?>

<style>
    .dataTables_paginate {
        width: 50%;
        float: left !important;
    }
</style>

    <div class="pagetitle">
      <h1>Terms and Conditions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Terms and Conditions</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    
    <section class="section profile">
      <div class="row">
       

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" onclick="getCompanyDetails();">Terms and Conditions</button>
                </li>

                  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#property-tac" onclick="editTermsAndConditions();">Update Terms and Conditions</button>
                </li>
                
                  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#property-documents" onclick="uploadDocuments();">Documents</button>
                </li>
             
              

              </ul>
              <div class="tab-content pt-2">
                  
               <div class="alert alert-danger d-none" role="alert" id="pendingAlert">
                  <strong>Terms and Conditions are pending.</strong> Please update your Terms and Conditions.
                </div>

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div id="displayCompanyDetailsDiv" style="padding:10px;"></div>

                </div>

                <div class="tab-pane fade property-tac " id="property-tac">
                  <h5 class="card-title">Terms and Conditions</h5>
                  
                  
                   <div class="row mb-3">
                        <div class="col-12">
                            <textarea class="form-control" id="inpTermsAndConditions" name="inpTermsAndConditions"></textarea>

                            <div class="invalid-feedback">
                            Please enter the Terms and Conditions!.
                            </div>
                        </div>
                    </div>
                    
                 
                        
                        
                         <div class="col-12 mt-4 " >
                          <button id="submitButton12" class="btn btn-primary w-100" type="button" onclick="saveTermsAndConditions();">Save</button>
                          <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton12" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                            </button>
                        </div>
                  
                  
                </div>
                
                
                 <div class="tab-pane fade property-documents " id="property-documents">
                    <h5 class="card-title">Upload Documents</h5>
                    
                    <div id="displayCompanyDocumentsDiv" class="pb-4"></div>
                    <div id="displayCompanyBrucherEditDiv" class="pb-4"></div>
                    
                 
                    <form id="uploadCompanyLogoForm" class="g-3 needs-validation" novalidate="">
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadDocumentsFiles" name="uploadDocumentsFiles[]" >
                                    <label class="custom-file-label" for="imageUploader">Upload Documents</label>
                                    <div class="text-danger" id="uploadDocumentsFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadBrucherFiles" name="uploadBrucherFiles[]" multiple>
                                    <label class="custom-file-label" for="imageUploader">Upload Brucher</label>
                                    <div class="text-danger" id="uploadBrucherFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="progress mt-3">
                            <!-- Update the ID to match the selector used in the JavaScript -->
                            <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        
                        <div class="col-12 mt-4 " >
                            
                               <h5 id="disUploadImgTitlenew" style="flex: auto;"></h5>
                              <button type="button" class="btn btn-primary" id="submitButton13" onclick="uploadCompanyDocumentsNow();">Upload Documents</button>
                              <button class="btn btn-primary d-none" type="button" id="submitLoadingButton13" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Please wait...
                              </button>

                         
                        </div>
                        
                        
                    </form>
                    
                    
                    
                </div>
                

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    
    
    
    

   

<?php 

include("templates/footer.php")

?>

<script>

var uploadInProgress = false;
var totalImgUpload = 0;
var uploadImg = 0;

$( document ).ready(function() {
   
  
        getCompanyDetails();
     

 });
 
 
 function uploadDocuments(){
      $('#submitLoadingButton13').addClass('d-none');
        $("#submitButton13").removeClass("d-none");
       
        var progressBar = document.getElementById("progress-bar");
        
    // Set the width of the progress bar to 0%
    progressBar.style.width = "0%";
    progressBar.setAttribute("aria-valuenow", "0");
    
    $("#submitButton13").removeClass("d-none");
    $("#uploadDocumentsFiles").val("");
    $('#uploadDocumentsFiles').val(null);
    
    $("#uploadBrucherFiles").val("");
    $('#uploadBrucherFiles').val(null);
    
    totalImgUpload = 0;
    $('#disUploadImgTitlenew').html('');
    uploadImg = 0;
        
       
 }
 
 function uploadCompanyDocumentsNow(){
     
     $("#uploadDocumentsFilesErr").html("");
     $("#uploadBrucherFilesErr").html("");
     
     var files = document.getElementById("uploadDocumentsFiles").files;

     if (files.length > 0) {
         
        let file = files[0];
        let formData = new FormData();
      
        var userId = '<?=$_SESSION['MachooseAdminUser']['id']?>';
        
        formData.append('images[]', file);
        formData.append('userId', userId);
        
        var reader = new FileReader();
        reader.onload = function (e) {
           
            // Upload the image using AJAX
            $.ajax({
                xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            // Update the ID in the selector to match the HTML element ID
                            $("#progress-bar").width(percentComplete.toFixed(0) + '%');
                            $("#progress-bar").html(percentComplete.toFixed(0) + '%');
                        }
                    }, false);
                    return xhr;
                },
                url: '/admin/uploadCompanyDocuments.php', // Replace with your PHP upload script
                type: 'POST',
                beforeSend: function(){
                    $("#progress-bar").width('0%');
                    // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                    $('#signalbmEventUploadStatus').removeClass('d-none');
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#uploadDocumentsFiles").val("");
                    $('#uploadDocumentsFiles').val(null);
                    uploadCompanyBrucherNow(false);
                    
                },
                error: function () {
                    
                    Swal.fire(
                      'Error',
                      "Something went wrong, please try again",
                      'error'
                    )
                   
                    $("#submitButton13").removeClass("d-none");
                    $("#submitLoadingButton13").addClass("d-none");
                    return false;
                }
            });
        };
        reader.readAsDataURL(file);
        
        
     }else{
        uploadCompanyBrucherNow(true);
    }
     
     
    
     
 }
 
 
 function uploadCompanyBrucherNow(isDoc){
    
     var files = document.getElementById("uploadBrucherFiles").files;

     if (files.length > 0) {
         
          uploadInProgress = false;
         uploadImages(files,0);
         
         totalImgUpload = files.length; 
         
         $('#disUploadImgTitlenew').html('Uploading images - Total ( '+totalImgUpload+' ) images');
         
         
     }else{
         
         if(isDoc){
             $("#uploadDocumentsFilesErr").html("Please upload the document!.");
             $("#uploadBrucherFilesErr").html("Please upload the Brucher!.");
         }else{
             $("#uploadBrucherFilesErr").html("Please upload the Brucher!.");
         }
         
        
        $("#submitButton13").removeClass("d-none");
        $("#submitLoadingButton13").addClass("d-none");
        return false;
    }
     
     
    
     
 }
 
 
  function uploadImages(files,index = 0){
     var userId = '<?=$_SESSION['MachooseAdminUser']['id']?>';
     for (var i = index ; i < files.length; i++) {
         
         if(uploadInProgress){
            
            // setTimeout(function () {
            //     uploadImages(files,index);
            // }, 50000);
           
        }else{
            
            let file = files[i];
            let formData = new FormData();
            
            uploadInProgress = true;
            var fuCalbk = parseInt(i);
            
            formData.append('images[]', file);
            formData.append('userId', userId);
            
            var reader = new FileReader();
            reader.onload = function (e) {
               
                // Upload the image using AJAX
                $.ajax({
                    xhr: function() {
                      var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                // Update the ID in the selector to match the HTML element ID
                                $("#progress-bar1").width(percentComplete.toFixed(0) + '%');
                                $("#progress-bar1").html(percentComplete.toFixed(0) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: '/admin/uploadCompanyBrucher.php', // Replace with your PHP upload script
                    type: 'POST',
                    beforeSend: function(){
                        $("#progress-bar1").width('0%');
                        // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                        $('#signalbmEventUploadStatus').removeClass('d-none');
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        
                        uploadImg ++;
                        
                        $('#disUploadImgTitlenew').html('Uploading images - Total ( '+uploadImg+' of '+totalImgUpload+' - Uploaded ) images');
                        
                        if(uploadImg == totalImgUpload){
                            uploadDocuments();
                        }
                        
                        getCompanyDetails();
                        
                        uploadInProgress = false;
                        uploadImages(files,fuCalbk+1);

                        console.log('Image uploaded:', response);
                    },
                    error: function () {
                        
                        Swal.fire(
                          'Error',
                          "Something went wrong, please try again",
                          'error'
                        )
                       
                        $("#submitButton13").removeClass("d-none");
                        $("#submitLoadingButton13").addClass("d-none");
                        return false;
                    }
                });
            };
            reader.readAsDataURL(file);
            
            
            
            
            
            
        }
         
     }
     
     
 }
 
 
 
 
 
 
 
 
  function editTermsAndConditions(){
     
       $('#submitLoadingButton12').addClass('d-none');
        $("#submitButton12").removeClass("d-none");
       
        
        getCompanyDetails();
     
 }
 
 function saveTermsAndConditions(){
     
      $('#inpTermsAndConditions').removeClass('is-invalid');
    
     var inpTermsAndConditions = tinymce.get('inpTermsAndConditions').getContent();
      
   
       var isValid = false;
     
      if(inpTermsAndConditions == ""){
             $('#inpTermsAndConditions').addClass('is-invalid');
             $('#inpTermsAndConditions').focus();
             isValid = true;
         }
     
     
         
          if(isValid) return false;
    
    $('#submitLoadingButton12').removeClass('d-none');
    $("#submitButton12").addClass("d-none");
    
     successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton11').addClass('d-none');
            $("#submitButton11").removeClass("d-none");
            
            getCompanyDetails();
            
            Swal.fire(
              'Success',
              "Successfully update Terms and Conditions",
              'success'
            )
            
        
            
        }else{
             Swal.fire(
              'Error',
              resp.data,
              'error'
            )
            
        }
        
       
        $('#submitLoadingButton12').addClass('d-none');
        $("#submitButton12").removeClass("d-none");
      
    }
    data = { "function": 'User',"method": "saveTermsAndConditions" , "inpTermsAndConditions":inpTermsAndConditions };
    
    apiCall(data,successFn);
     
     
 }
 
 function getAllBrucher(){
     
     $('#displayCompanyBrucherEditDiv').html('');

     
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            var images = resp.data;
            if(images.length > 0){
                
                var disD = '';
                var disD1 = '';
                disD +='<h5 class="card-title">Bruchers</h5>';
                
                for(var i=0;i<images.length;i++){
                    
                    var filepath = images[i]['file_path'];
                    disD +='<a href="'+filepath+'" target="_blank">'+images[i]['file_name']+' - '+images[i]['created_date']+' </a> <i onclick="deleteBrucher('+images[i]['id']+');" class="bi bi-x-lg text-danger"></i><br>';

                }
                
                
            }else{
                
                var disD = '';
                disD +='<h5 class="card-title">Bruchers</h5>';
                disD +='<p class="text-muted">Bruchers not uploaded, Please update your Bruchers</p>';
                
             
                
                
            }
            
            $('#displayCompanyBrucherEditDiv').html(disD);
            
            
        }
        
    }
    data = { "function": 'SystemManage',"method": "getAllBruchers" };
    
    apiCall(data,successFn);
 }
 
 function deleteBrucher(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Brucher",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                        getCompanyDetails();
                     }
                     data = { "function": 'SystemManage',"method": "deleteBrucher" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
 
 function getCompanyDetails(){
     
     $('#displayCompanyDocumentsDiv').html('');
     $('#displayCompanyBrucherEditDiv').html('');
     getAllBrucher();
      tinymce.init({
            selector: '#inpTermsAndConditions',
            height: 500,
            // theme : "advanced",
           // file_browser_callback : "fileBrowserCallBack",
        
            plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | cut copy paste| forecolor backcolor  | fontselect fontsizeselect | blocks fontfamily fontsize |  bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat  | ',
        
            tinycomments_mode: 'embedded',
            // a11y_advanced_options: true,
            file_picker_types: 'file image media',
            tinycomments_author: 'Author name',
            mergetags_list: [
              { value: 'First.Name', title: 'First Name' },
              { value: 'Email', title: 'Email' },
            ],
        
            paste_data_images: true,
            file_picker_callback: function(callback, value, meta) {
              if (meta.filetype == 'image') {
                $('#upload').trigger('click');
                $('#upload').on('change', function() {
                  var file = this.files[0];
                  var reader = new FileReader();
                  reader.onload = function(e) {
                    callback(e.target.result, {
                      alt: ''
                    });
                  };
                  reader.readAsDataURL(file);
                });
              }
            },
            image_caption: true,
              images_upload_url: 'upload.php', // replace with your upload URL
              images_upload_credentials: true,
              automatic_uploads: true
        
          });
              

  
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            
            
            
            var disD1 = '';
            if(resp.data.company_document_url == '' || resp.data.company_document_url == null) disD1 +='<p class="text-muted">Document not uploaded, Please update document</p>';
            else{
                disD1 +='<a href="'+resp.data.company_document_url+'" target="_blank">View uploaded document</a>';
            }
            
           
            
            
            
            $('#displayCompanyDocumentsDiv').html(disD1);
            
            
            
            
            
            
            
            
            if(resp.data.terms_and_conditions == "" || resp.data.terms_and_conditions == null) $('#pendingAlert').removeClass('d-none');
            else $('#pendingAlert').addClass('d-none');
            
            
            var disD = '';

            if(resp.data.terms_and_conditions == '' || resp.data.terms_and_conditions == null) disD +='<p class="text-muted">Terms and Conditions not uploaded, Please update your company Terms and Conditions</p>';
            else{
                disD +=resp.data.terms_and_conditions;
            }
            
            
            $('#displayCompanyDetailsDiv').html(disD);
            
      
        
        
            $('#inpTermsAndConditions').val(resp.data.terms_and_conditions);
           
            tinymce.init({
              selector: '#inpTermsAndConditions',
              // other TinyMCE options...
            });
            
            // Set content after initialization
            tinymce.get('inpTermsAndConditions').setContent(resp.data.terms_and_conditions);
      
            
        }
    
      
    }
    data = { "function": 'SystemManage',"method": "getCompanyDetails" };
    
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

