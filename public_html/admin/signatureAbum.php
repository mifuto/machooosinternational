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
    #btn-back-to-bottom {
  position: fixed;
  top: 80px;
  right: 20px;
  display: none;
   z-index: 1000; /* Ensure it's above other elements */
   background-color: #4154f1;
    color: white;
}


  /* Add a class to style the sticky header */
        .sticky-header {
            position: sticky;
            top: 6%;
            background-color: #fff; 
            z-index: 100; 
            padding-top:10px;
        }
        
      


#loadMore {
  width: 150px;
  color: #6b6b6b;
  display: block;
  text-align: center;
  margin: 10px auto;
  padding: 5px;
  border-radius: 10px;
  border: 1px solid #6b6b6b;
  background-color: #fff;
  transition: .3s;
  text-decoration: none;
}
#loadMore:hover {
  color: #fff;
  background-color: #6b6b6b;
  border: 1px solid #6b6b6b;
  text-decoration: none;
}

.lightbox .lb-image {
   
    border: 0px solid #fff !important;
}

</style>
<link rel="stylesheet" href="/lightbox2-master/dist/css/lightbox.min.css">
<link rel="stylesheet" href="/css/justifiedGallery.min.css" />


   <input type="hidden" value="" id="sel_file_folder">
                <input type="hidden" value="" id="sel_albumId">
                <input type="hidden" value="" id="sel_isHide">
                
                <input type="hidden" value="" id="sel_folder">
                <input type="hidden" value="" id="sel_userId">
                <input type="hidden" value="" id="sel_folder_name">
                <input type="hidden" value="" id="sel_img_folder">
               
                
                <input type="hidden" value="0" id="sel_numberOfLoading">
                
                <input type="hidden" value="" id="sel_project_id">



<div class="pagetitle">
  <h1>CREATE SIGNATURE ALBUM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item">Signature album</li>
      <li class="breadcrumb-item active">Create Folder</li>
    </ol>
  </nav>
</div>

   <button
                        type="button"
                        class="btn "
                        id="btn-back-to-bottom"
                        >
                  <i class="bi bi-arrow-down"></i>
                </button>



<!-- End Page Title -->
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <!-- General Form Elements -->
          <form id="sigAlbmSelectUserForm" class="needs-validation" novalidate>
            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="inputText" class="col-sm-3 col-form-label">Select User</label>
                <select class="form-control select2" aria-label="Default select example" id="signAlbumUsersList" name="signAlbumUsersList"></select>
                <div class="text-danger" id="signAlbumUsersListErr"></div>
              </div>
              <div class="col-sm-6">
                <div class="float-end" style="padding-top: 40px">
                  <!-- <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#basicModal"> Create folder </button> -->
                  <button type="button" id="creatNewProjBtn" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Create new project"> Create New Project</button>
                </div>
              </div>
            </div>
          </form>

          
    <div class="modal fade" id="SAextendEventDateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Extend event expiry date</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendSAEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" >
              <div class="row mb-3 mt-4">
                <label class="col-sm-3 col-form-label">Expiry Date</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="SAExpiryDateVal" name="SAExpiryDateVal" value="">
                  <div class="invalid-feedback">
                    Plese select Expiry Date!.
                  </div>
                </div>
              </div>


            
            </div>
            <div class="modal-footer">
            
              <input type="hidden" id="SAextendEventDateid" name="SAextendEventDateid" value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveSAExtendEventDate();" >Extend </button>
             
            </div>
        </form>
      </div>
    </div>
  </div>




  <div class="modal fade" id="uploadImageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Upload Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="uploadSigExtrafilesForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" >
              <div class="row mb-3 mt-4">
                <label for="sigAlbmEventName" class="col-sm-3 col-form-label">Event Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="uploadsigAlbmFolderName" name="uploadsigAlbmFolderName" value="" disabled>
                  <div class="invalid-feedback">
                    Plese enter the event name!.
                  </div>
                </div>
              </div>
              
              
               <div class="container mt-5">
                    <div class="card p-4">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="uploadSignatureAlbumFiles" name="uploadSignatureAlbumFiles[]" accept="image/*" multiple>
                            <label class="custom-file-label" for="imageUploader">Choose Image(s)</label>
                            <div class="text-danger" id="uploadSignatureAlbumFilesErr"></div>
                        </div>
                    </div>
                    <hr>
                    <h5 id="disUploadImgTitle">Uploaded images</h5>
                    <div class="mt-3" id="imageList"></div>
                </div>
              
              
              
              
              
              
              
              

              <!--<div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">-->
              <!--  <label for="EventCoverImgFile" class="col-form-label" style="padding-left: 0;">Event Images</label>-->
              <!--  <input type="file" id="uploadSignatureAlbumFiles" name="uploadSignatureAlbumFiles[]" accept="image/*" multiple>-->
              <!--  <div class="text-danger" id="uploadSignatureAlbumFilesErr"></div>-->
              <!--</div>-->
              <div class="progress mt-3">
                <!-- Update the ID to match the selector used in the JavaScript -->
                <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
              <div id="uploadMoreStatus"></div>
            </div>
            <div class="modal-footer">
                <h5 id="disUploadImgTitlenew" style="flex: auto;"></h5>
              <input type="hidden" id="selectedUplSigfile_folder" name="selectedUplSigfile_folder" value="">
              <input type="hidden" id="selectedUplSigUserId" name="selectedUplSigUserId" value="">
              <input type="hidden" id="selectedUplSigAlbmId" name="selectedUplSigAlbmId" value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="uplSigFilesSubmit" onclick="uploadMultipleImg();">Upload Image</button>
              <button type="button" class="btn btn-primary d-none" id="rUplSigFilesSubmit" onclick="reloadUploadMultipleImg();" >Try again</button>
              <button class="btn btn-primary d-none" type="button" id="uplSigFilesLoadingButton" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
              </button>

            </div>
        </form>
      </div>
    </div>
  </div>

            
           
            <div class="card">
              <div class="card-body">
                  
                  <div class="sticky-header">
                        <div class="row">
                          <div class="col-sm-8">
                            <h5 class="card-title" id="card_main_title">Projects</h5>
                          </div>
                          <div class="col-sm-4 pt-3" id="eventAddBtnDiv">
                            
                          </div>
                          <div class="col-sm-12" id="eventAddBtnDiv2">
                            
                          </div>
                          
                          
                          
                          
                          
                        </div>
                    </div>
                    
                    <div style="padding:10px;">
                
                            <!-- Default Tabs -->
                            
                            <div class="pt-4 pb-4" id="signatureAlbumProjEmptyData">
                              <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                  Not selected the user to view the projects!
                                </div>
                              </div>
                            </div>
                            <div class="pt-4 pb-4 d-none" id="signatureAlbumProjEmptyDataForUser">
                              <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                  Not created the project to view !
                                </div>
                              </div>
                            </div>
                            <div class="pt-2" id="signatureAlbumProjContent"></div>
            
                            <div class="pt-2 d-none" id="signatureAlbumProjEventContent">
                              <div class="pt-4 pb-4 " id="ProjEventEmptyData">
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                  <div>
                                    Not created the events to view !
                                  </div>
                                </div>
                              </div>
                              <ul class="nav nav-tabs" id="signatureAlbumEventTabs" role="tablist">
                              </ul>
                              <div class="tab-content pt-2" id="signatureAlbumProjEvntTabContent"></div>
                              
                              <div >
                                <div class="tab-content pt-4 d-flex align-items-center" style="width:100% ;justify-content: center;">
                                    <span id="imageInfo"></span>
                                </div>
                            </div>
                               
                                                        <div class="d-none" id="imageLoadDiv">
                                                            <div class="tab-content" >
                                                                <!--<a href="#" onclick="loadMoreImages()" id="loadMore">Load More</a>-->
                                                                <button onclick="loadMoreImages();" id="loadMore" >Load more</button>
                                                            </div>
                                                        </div>
                            </div>
                            <!-- End Default Tabs -->
                </div>
                
                
                
              </div>
            </div>
            
            
            
            
            
            
            
            
            <!-- <div class="row mb-3">
              <label class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <div class="modal fade" id="verticalycentered" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">SUBMIT</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body"> If you are ok with these edits please go threw yes otherwise no </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                        <button type="button" class="btn btn-primary">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          <!-- End General Form Elements -->
        </div>
      </div>
    </div>
  </div>
</section>

  <div class="modal fade" id="createEventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Create Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="createSigAlbmEventForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" >
              <div class="row mb-3 mt-4">
                <label for="sigAlbmEventName" class="col-sm-3 col-form-label">Event Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="sigAlbmEventName" name="sigAlbmEventName" required>
                  <div class="invalid-feedback">
                    Plese enter the event name!.
                  </div>
                </div>
              </div>

              <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                <label for="EventCoverImgFile" class="col-form-label" style="padding-left: 0;">Cover Image</label>
                <input type="file" id="EventCoverImgFile" name="EventCoverImgFile[]" accept="image/*" multiple>
                <div class="text-danger" id="EventCoverImgFilerr"></div>
              </div>

              <div class="row mb-3 d-none" style="padding-left: 10px;padding-right: 10px;">
                <label for="EventCoverImgFile" class="col-form-label" style="padding-left: 0;">Event Images</label>
                <input type="file" id="signatureAlbumEventFiles" name="signatureAlbumEventFiles[]" accept="image/*" multiple>
                <div class="text-danger" id="signatureAlbumEventFilesErr"></div>
              </div>
              <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-danger d-none" id="signalbmEventUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div id="uploadStatus"></div>
            </div>
            <div class="modal-footer">
              <input type="hidden" id="selectedEventUserId" name="selectedEventUserId" value="">
              <input type="hidden" id="selectedProjecEventtId" name="selectedProjecEventtId" value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="createEventSubmit">Create</button>
              <button class="btn btn-primary d-none" type="button" id="createEventSubmitLoadingButton" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Please wait...
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
  
  
  
   <div class="modal fade" id="changeCoverModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Change cover image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
            
            
            
                    <div class="container mt-5">
                        <div class="card p-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadLogoFiles" name="uploadLogoFiles[]" accept="image/*" multiple>
                                <label class="custom-file-label" for="imageUploader">Choose Image(s)</label>
                                <div class="text-danger" id="uploadLogoFilesErr"></div>
                            </div>
                        </div>
                      
                    </div>
            
           
            
            
            
            
                    <div class="progress mt-3">
                        <!-- Update the ID to match the selector used in the JavaScript -->
                        <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar99" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
            
            
                    <div class="col-12 mt-4 " >
                        
                        <input type="hidden" id="chngeImgevtId">
                        <input type="hidden" id="chngeImgprojid">
                        
                           
                          <button type="button" class="btn btn-primary" id="submitButton13" onclick="uploadCompanyLogoNow();">Change cover image</button>
                          <button class="btn btn-primary d-none" type="button" id="submitLoadingButton13" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                          </button>
        
                     
                    </div>
                                        
            
        </div>
        </div>
    </div>
  </div>
  
  
  
  
  
  
  
  

<!--Create new project modal -->
<div class="modal fade" id="createProjectModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Project</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="createSigAlbmProjectForm" class="g-3 needs-validation" novalidate="">
      <!-- <form  class="needs-validation" novalidate> -->
          <div class="modal-body">
            <div class="row mb-3 mt-4">
              <label for="sigAlbmProjName" class="col-sm-3 col-form-label">Project Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="sigAlbmProjName" name="sigAlbmProjName" required>
                <div class="invalid-feedback">
                  Plese enter the project name!.
                </div>
              </div>
            </div>
            <!-- <div class="row mb-3">
              <label for="signatureAlbumFiles" class="col-sm-3 col-form-label">File Upload</label>
              <div class="col-sm-9">
                <input class="form-control" type="file" id="signatureAlbumFiles" name="signatureAlbumFiles">
                <div class="invalid-feedback">
                  Plese select the zip file!.
                </div>
              </div>
            </div> -->
            <div class="row mb-12">
              <label for="signatureAlbumCover" class="col-sm-3 col-form-label">Upload cover image</label>
              <div class="col-sm-12">
    
                <div class="signatureAlbumCoverDiv" id="signatureAlbumCoverDiv">

                  <input class="form-control" type="file" id="signatureAlbumCover" name="signatureAlbumCover" accept="image/*" multiple required>
                </div>


                <div class="text-danger" id="signatureAlbumCoverErr">
                  
                </div>
              </div>
            </div>
            <div class="progress mt-3">
              <div class="progress-bar progress-bar-striped bg-danger d-none" id="coverImageUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="uploadStatus"></div>
          </div>
          <div class="modal-footer" >
            <input type="hidden" id="selectedProjUserId" name="selectedProjUserId" value="">
            <input type="hidden" id="selectedProjId" name="selectedProjId" value="">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="createProjrctSubmit">Create</button>
            <button class="btn btn-primary d-none" type="button" id="createProjrctSubmitdingButton" disabled>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Please wait...
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
<!--Create new project modal end-->


<?php 

  include("templates/footer.php");

?>

<script src="/lightbox2-master/dist/js/lightbox.js"></script>
<script  src="/js/jquery.justifiedGallery.min.js"></script>

<script>

var totalImgUpload = 0;
var uploadInProgress = false;

 
var uploadImg = 0;
var succImg = 0;

function reloadUploadMultipleImg(){
     return new swal({
        title: "confirmation of intent",
        text: "Would you like to continue?",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Yes'
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                uploadMultipleImg();
            }else{
                return false;
            }
        });
}

function uploadMultipleImg(){
    
    $("#uplSigFilesSubmit").addClass("d-none");
    $("#uplSigFilesLoadingButton").removeClass("d-none");
    totalImgUpload = 0;
    
    var selectedUplSigAlbmId = $("#selectedUplSigAlbmId").val();
    
    var files = document.getElementById("uploadSignatureAlbumFiles").files;

    if (files.length > 0) {
        
        successFn = function(resp)  {
            // console.log("rrerere");
            console.log(resp.data);
            var imgArr = resp.data;
            
            var imageList = $('#imageList');
            imageList.html('');
            
            totalImgUpload = files.length; 
            
            $('#disUploadImgTitlenew').html('Uploading images - Total ( '+totalImgUpload+' ) images');
            $('#rUplSigFilesSubmit').removeClass('d-none');
            
             
            
            uploadImg = 0;
            succImg = 0;
            uploadInProgress = false;
            uploadImages(files,imgArr,0);
            
           
        }
        errorFn = function(resp){
            console.log(resp);
            
            Swal.fire({
                icon: 'error',
                title: "Failed to save event",
                showConfirmButton: false,
                timer: 1500
            });
            $("#uplSigFilesSubmit").removeClass("d-none");
            $("#uplSigFilesLoadingButton").addClass("d-none");
         
            return false;
        }
    
        data = { "function": 'SignatureAlbum',"method": "fetchAllUploadImage", 'selectedUplSigAlbmId': selectedUplSigAlbmId };
        apiCall(data,successFn,errorFn);
    
        
        
    }else{
        $("#uploadSignatureAlbumFilesErr").html("Plese upload the event images!.");
        $("#uplSigFilesSubmit").removeClass("d-none");
        $("#uplSigFilesLoadingButton").addClass("d-none");
        return false;
    }
    
    
}

function uploadImages(files,imgArr,index = 0) {
    console.log(index+".  "+uploadInProgress)
    
    
    var folderName = $("#uploadsigAlbmFolderName").val();
    var selectedUplSigfile_folder = $("#selectedUplSigfile_folder").val();
    var selectedUplSigAlbmId = $("#selectedUplSigAlbmId").val();
   

    for (var i = index ; i < files.length; i++) {
        
          
        if(uploadInProgress){
            
            // setTimeout(function () {
            //     uploadImages(files,imgArr,index);
            // }, 50000);
           
        }else{
            
                let file = files[i];
                let formData = new FormData();
              
                // if(imgArr.length == 0) var exists = true;
                // else 
                let exists = imgArr.some(imgArr => imgArr.file_name === file['name']);
                
                console.log(exists);
        
                
                if (!exists) {
                    
                    uploadInProgress = true;
                    var fuCalbk = parseInt(i);
                     
                    formData.append('images[]', file);
                
                  
                    formData.append('folderName', folderName);
                    formData.append('selectedUplSigfile_folder', selectedUplSigfile_folder);
                    formData.append('selectedUplSigAlbmId', selectedUplSigAlbmId);
                  
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        
                       
                        
                        console.log('ajax call');
                       
                       
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
                            url: '/admin/uploadEventImage.php', // Replace with your PHP upload script
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
                                // Handle the response (e.g., save the image URL)
                                var imgElement = $('<img class="img-thumbnail" style="max-width: 5% !important;">');
                                imgElement.attr('src', e.target.result);
                                $('#imageList').append(imgElement);
                                uploadImg ++;
                                succImg ++;
                                
                                $('#disUploadImgTitlenew').html('Uploading images - Total ( '+uploadImg+' of '+totalImgUpload+' - Uploaded ) images');
                                
                              
                                if(totalImgUpload == succImg){
                                    
                                      
                                    
                                        Swal.fire({
                                            icon: 'success',
                                            // title: resp.data,
                                            title: "Image upload successfully completed",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
            
                                        // $('#uploadForm')[0].reset();
                                      $("#uploadImageModal").modal('hide');
                                        $("#selectedUplSigUserId").val("");
                                        $("#uploadsigAlbmFolderName").val("");
                                        $("#uploadSignatureAlbumFiles").val("");   
                                        $("#uplSigFilesSubmit").removeClass("d-none");
                                        $("#uplSigFilesLoadingButton").addClass("d-none");
                                        
                                      console.log('succ');
                                        // getSignatureALbumList();
                                        
                                           var folder = $('#sel_folder').val();
                        var userId = $('#sel_userId').val();
                        var folder_name = $('#sel_folder_name').val();
                            var albumId = $('#sel_albumId').val();
                            
                            getAlbumFiles(folder, userId, albumId, folder_name);
                                        
                                        
                                        
                                    
                                }else if(totalImgUpload == uploadImg){
                                      uploadMultipleImg();
                                 }
                                 
                                 uploadInProgress = false;
                                uploadImages(files,imgArr,fuCalbk+1);
                                    
                                
            
                                console.log('Image uploaded:', response);
                            },
                            error: function () {
                                console.error('Error uploading image');
                              uploadImg ++;
                              $('#disUploadImgTitlenew').html('Uploading images - Total ( '+uploadImg+' of '+totalImgUpload+' - Pending ) images');
                              if(totalImgUpload == uploadImg){
                                  uploadMultipleImg();
                              }
                              
                              uploadInProgress = false;
                                uploadImages(files,imgArr,fuCalbk+1);
                              
                              
                            }
                        });
                    };
                    reader.readAsDataURL(file);
                } else {
                    uploadImg ++;
                    succImg ++;
                    
                    $('#disUploadImgTitlenew').html('Uploading images - Total ( '+uploadImg+' of '+totalImgUpload+' - Duplicate ) images');
                    
                    
                    
                      if(totalImgUpload == succImg){
                          Swal.fire({
                                icon: 'success',
                                // title: resp.data,
                                title: "Image upload successfully completed",
                                showConfirmButton: false,
                                timer: 1500
                            });
                
                            // $('#uploadForm')[0].reset();
                          $("#uploadImageModal").modal('hide');
                            $("#selectedUplSigUserId").val("");
                            $("#uploadsigAlbmFolderName").val("");
                            $("#uploadSignatureAlbumFiles").val("");   
                            $("#uplSigFilesSubmit").removeClass("d-none");
                            $("#uplSigFilesLoadingButton").addClass("d-none");
                            
                          console.log('succ');
                            // getSignatureALbumList();
                            
                               var folder = $('#sel_folder').val();
                        var userId = $('#sel_userId').val();
                        var folder_name = $('#sel_folder_name').val();
                            var albumId = $('#sel_albumId').val();
                            
                            getAlbumFiles(folder, userId, albumId, folder_name);
                            
                            
                            
                            
                      }else if(totalImgUpload == uploadImg){
                          uploadMultipleImg();
                      }
                      
                  
                      
                }
                 
        }
        
        
    }
}




// Function to compress an image using canvas
function compressImage(file, maxWidth, maxHeight, quality) {
    console.log(file.name);
    
    return new Promise((resolve, reject) => {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (event) => {
            var img = new Image();
            img.src = event.target.result;
            img.onload = () => {
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                let newWidth = img.width;
                let newHeight = img.height;

                if (img.width > maxWidth) {
                    newWidth = maxWidth;
                    newHeight = (img.height * maxWidth) / img.width;
                }

                if (newHeight > maxHeight) {
                    newHeight = maxHeight;
                    newWidth = (img.width * maxHeight) / img.height;
                }

                canvas.width = newWidth;
                canvas.height = newHeight;
                ctx.drawImage(img, 0, 0, newWidth, newHeight);

                // Convert the canvas to a compressed data URL
                canvas.toBlob(
                    (blob) => {
                         const compressedBlob = new Blob([blob], { type: file.type });
                        compressedBlob.name = "qwertyuio." + file.name.split(".").pop();
                        resolve(compressedBlob);
                    },
                    file.type,
                    quality
                );
            };
        };
        reader.onerror = (error) => {
            reject(error);
        };
    });
}




// // Event listener for the "Compress and Upload" button
// $("#uplSigFilesSubmit").click(async () => {
    
//     $("#uplSigFilesSubmit").addClass("d-none");
//     $("#uplSigFilesLoadingButton").removeClass("d-none");
    
//     var input = document.getElementById("uploadSignatureAlbumFiles");
//     var files = input.files;

//     // Define maximum dimensions and quality for compression
//     var maxWidth = 1236; // Adjust as needed
//     var maxHeight = 1236; // Adjust as needed
//     var quality = 1; // Adjust as needed (0.7 means 70% quality)

//     var compressedFiles = [];

//     // Compress each selected image
//     for (let i = 0; i < files.length; i++) {
//         var compressedFile = await compressImage(files[i], maxWidth, maxHeight, quality);
//         console.log(compressedFile.name);
//         compressedFiles.push(compressedFile);
//     }

//     // Now you can upload the compressed files using an AJAX request
//     // Include your AJAX upload logic here

//     // For demonstration purposes, log the compressed files to the console
//     console.log("Compressed Files:", compressedFiles);
    
//     const formData = new FormData();
//     for (let i = 0; i < compressedFiles.length; i++) {
//         console.log("Compressed Files data:", compressedFiles[i]);
//         formData.append("uploadSignatureAlbumFiles[]", compressedFiles[i]);
//     }
    
//     if(compressedFiles.length <= 0){
//         $("#uploadSignatureAlbumFilesErr").html("Plese upload the event images!.");
//         $("#uplSigFilesSubmit").removeClass("d-none");
//         $("#uplSigFilesLoadingButton").addClass("d-none");
//         return false;
//     }else{
//         $("#uploadSignatureAlbumFilesErr").html("");
//     }
    
//     var folderName = $("#uploadsigAlbmFolderName").val();
//     var selectedUplSigfile_folder = $("#selectedUplSigfile_folder").val();
//     var selectedUplSigAlbmId = $("#selectedUplSigAlbmId").val();
    
//     formData.append('function', 'SignatureAlbum');
//     formData.append('method', 'saveSignatureAlbumExtraFiles');
//     formData.append('save', "add");
//     formData.append('folderName', folderName);
//     formData.append('selectedUplSigfile_folder', selectedUplSigfile_folder);
//     formData.append('selectedUplSigAlbmId', selectedUplSigAlbmId);
    
    
//     return new swal({
//         title: "Are you sure?",
//         text: "You want to save this folder",
//         icon: false,
//         // buttons: true,
//         // dangerMode: true,
//         showCancelButton: true,
//         confirmButtonText: 'Yes'
//         }).then((confirm) => {
//             // console.log(confirm.isConfirmed);
//             if (confirm.isConfirmed) {
                
//                 $.ajax({
                    // xhr: function() {
                    //   var xhr = new window.XMLHttpRequest();
                    //     xhr.upload.addEventListener("progress", function(evt) {
                    //         if (evt.lengthComputable) {
                    //             var percentComplete = ((evt.loaded / evt.total) * 100);
                    //             // Update the ID in the selector to match the HTML element ID
                    //             $("#progress-bar").width(percentComplete.toFixed(0) + '%');
                    //             $("#progress-bar").html(percentComplete.toFixed(0) + '%');
                    //         }
                    //     }, false);
                    //     return xhr;
                    // },
//                     type: 'POST',
//                     url: 'ajaxHandler.php',
//                     data: formData,
//                     contentType: false,
//                     cache: false,
//                     processData:false,
                    // beforeSend: function(){
                    //     $("#progress-bar").width('0%');
                    //     // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                    //     $('#signalbmEventUploadStatus').removeClass('d-none');
                    // },
                    // error:function(){
                    //     $('#uploadMoreStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                    //      $("#uplSigFilesSubmit").removeClass("d-none");
                    //         $("#uplSigFilesLoadingButton").addClass("d-none");
                            
                            
                    // },
//                     success: function(resp){
//                         // console.log(resp);
//                         resp=JSON.parse(resp);
//                         if(resp.status == 1){
//                             Swal.fire({
//                                 icon: 'success',
//                                 // title: resp.data,
//                                 title: "Image upload successfully completed",
//                                 showConfirmButton: false,
//                                 timer: 1500
//                             });

//                             // $('#uploadForm')[0].reset();
//                           $("#uploadImageModal").modal('hide');
//                             $("#selectedUplSigUserId").val("");
//                             $("#uploadsigAlbmFolderName").val("");
//                             $("#uploadSignatureAlbumFiles").val("");   
//                             $("#uplSigFilesSubmit").removeClass("d-none");
//                             $("#uplSigFilesLoadingButton").addClass("d-none");
                            
//                           console.log('succ');
//                             getSignatureALbumList();
//                             // getSignatureALbumList();
//                             // setTimeout(function(){
//                             //     history.go(0);
//                             // },500)
//                         }else{
//                             Swal.fire({
//                                 icon: 'error',
//                                 title: resp.data,
//                                 showConfirmButton: false,
//                                 timer: 1500
//                             });
//                             $("#uplSigFilesSubmit").removeClass("d-none");
//                             $("#uplSigFilesLoadingButton").addClass("d-none");
//                         }
                        
//                     }
//                 });
                
              
//             }else{
//                 $("#uplSigFilesSubmit").removeClass("d-none");
//                 $("#uplSigFilesLoadingButton").addClass("d-none");
//             }
//     });
    
    
    
    
    
// });



// $("#createEventSubmit").click(async () => {
    
  
//     $("#createEventSubmit").addClass("d-none");
//     $("#createEventSubmitLoadingButton").removeClass("d-none");
    
//     var input = document.getElementById("EventCoverImgFile");
//     var files = input.files;

//     // Define maximum dimensions and quality for compression
//     var maxWidth = 1236; // Adjust as needed
//     var maxHeight = 1236; // Adjust as needed
//     var quality = 1; // Adjust as needed (0.7 means 70% quality)

//     var compressedFiles = [];

//     // Compress each selected image
//     for (let i = 0; i < files.length; i++) {
//         var compressedFile = await compressImage(files[i], maxWidth, maxHeight, quality);
//         console.log(compressedFile.name);
//         compressedFiles.push(compressedFile);
//     }
    
//      var sigAlbmEventName = $("#sigAlbmEventName").val();
    
//     if(compressedFiles.length <= 0 || sigAlbmEventName == ""){
//          $("#createEventSubmit").removeClass("d-none");
//         $("#createEventSubmitLoadingButton").addClass("d-none");
//         return false;
//     }
    
    

//     // Now you can upload the compressed files using an AJAX request
//     // Include your AJAX upload logic here

//     // For demonstration purposes, log the compressed files to the console
//     console.log("Compressed Files:", compressedFiles);
    
//     const formData = new FormData();
//     for (let i = 0; i < compressedFiles.length; i++) {
//         console.log("Compressed Files data:", compressedFiles[i]);
//         formData.append("EventCoverImgFile[]", compressedFiles[i]);
//     }
   
    
//     var selectedEventUserId = $("#selectedEventUserId").val();
//     var selectedProjecEventtId = $("#selectedProjecEventtId").val();
    
//     formData.append('function', 'SignatureAlbum');
//     formData.append('method', 'saveSignatureAlbum');
//     formData.append('save', "add");
    
//     formData.append('selectedEventUserId', selectedEventUserId);
//     formData.append('sigAlbmEventName', sigAlbmEventName);
//     formData.append('selectedProjecEventtId', selectedProjecEventtId);
    
    
//     return new swal({
//                 title: "Are you sure?",
//                 text: "You want to save this folder",
//                 icon: false,
//                 // buttons: true,
//                 // dangerMode: true,
//                 showCancelButton: true,
//                 confirmButtonText: 'Yes'
//                 }).then((confirm) => {
//                     // console.log(confirm.isConfirmed);
//                     if (confirm.isConfirmed) {
//                         $.ajax({
//                             xhr: function() {
//                                 var xhr = new window.XMLHttpRequest();
//                                 xhr.upload.addEventListener("progress", function(evt) {
//                                     if (evt.lengthComputable) {
//                                         var percentComplete = ((evt.loaded / evt.total) * 100);
//                                         $(".progress-bar").width(percentComplete.toFixed(0) + '%');
//                                         $(".progress-bar").html(percentComplete.toFixed(0) +'%');
//                                     }
//                                 }, false);
//                                 return xhr;
//                             },
//                             type: 'POST',
//                             url: 'ajaxHandler.php',
//                             data: formData,
//                             contentType: false,
//                             cache: false,
//                             processData:false,
//                             beforeSend: function(){
//                                 $(".progress-bar").width('0%');
//                                 // $('#uploadStatus').html('<img src="images/loading.gif"/>');
//                                 $('#signalbmEventUploadStatus').removeClass('d-none');
//                             },
//                             error:function(){
//                                 $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
//                                  $("#createEventSubmit").removeClass("d-none");
//                                     $("#createEventSubmitLoadingButton").addClass("d-none");
//                             },
//                             success: function(resp){
//                                 // console.log(resp);
//                                 resp=JSON.parse(resp);
//                                 if(resp.status == 1){
//                                     Swal.fire({
//                                         icon: 'success',
//                                         // title: resp.data,
//                                         title: "Image upload successfully completed",
//                                         showConfirmButton: false,
//                                         timer: 1500
//                                     });
        
//                                     // $('#uploadForm')[0].reset();
//                                     $("#createEventModal").modal('hide');
//                                     $("#sigAlbmEventName").val("");
//                                     $("#EventCoverImgFile").val("");
//                                     $("#signatureAlbumEventFiles").val("");
//                                     $("#signatureAlbumFiles").val("");   
//                                     $("#createEventSubmit").removeClass("d-none");
//                                     $("#createEventSubmitLoadingButton").addClass("d-none");
        
//                                     var project_id = $("#selectedProjecEventtId").val();
//                                     var userId = $("#selectedEventUserId").val();
//                                     viewProjectEvents(project_id, userId)
        
//                                     $("#selectedEventUserId").val("");
//                                     $("#selectedProjecEventtId").val("");
        
//                                     // getSignatureALbumList();
//                                     // setTimeout(function(){
//                                     //     history.go(0);
//                                     // },500)
//                                 }else{
//                                     Swal.fire({
//                                         icon: 'error',
//                                         title: resp.data,
//                                         showConfirmButton: false,
//                                         timer: 1500
//                                     });
//                                     $("#createEventSubmit").removeClass("d-none");
//                                     $("#createEventSubmitLoadingButton").addClass("d-none");
//                                 }
                                
//                             }
//                         });
//                     }else{
//                         $("#createEventSubmit").removeClass("d-none");
//                         $("#createEventSubmitLoadingButton").addClass("d-none");
//                     }
//                 });
    
    
    
    
    
// });







  var mybutton = document.getElementById("btn-back-to-bottom");
       
        scrollFunction();

        
        window.onscroll = function () {
          scrollFunction();
        };
        
        function scrollFunction() {
          if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
          ) {
            mybutton.style.display = "none";
          } else {
            mybutton.style.display = "block";
          }
        }
      
        
        
        mybutton.addEventListener("click", backToBottom);

        function backToBottom() {
                var element = document.getElementById('footer');
              if (element) {
                element.scrollIntoView({
                  behavior: 'smooth', // You can use 'auto' or 'smooth' for smooth scrolling
                  block: 'start', // You can use 'start', 'center', 'end', or 'nearest'
                  inline: 'nearest' // You can use 'start', 'center', 'end', or 'nearest'
                });
              }
        }
        
      
        








  $( document ).ready(function() {
      getusers("signAlbumUsersList");
     $('#signatureAlbumCover').imageuploadify();
      $('#signatureAlbumEventFiles').imageuploadify();
      $('#uploadSignatureAlbumFiles').imageuploadify();
      $('#EventCoverImgFile').imageuploadify();
      $('#uploadLogoFiles').imageuploadify();
      $('#signAlbumUsersList').select2();
      $("body").on('click', function (e) {
          // alert(111);
          $('[data-toggle=popover]').each(function () {
              // hide any open popovers when the anywhere else in the body is clicked
              if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                  $(this).popover('hide');
              }
          });
      })
 });


 

//  $("#signatureAlbumFiles").on("change", function onChange() {
//       var files = this.files;
//       console.log(files);
//       // retrieveFiles(files);
//   });
//   $(".well").on("drop", function onDrop(event) {
//       event.stopPropagation();
//       event.preventDefault();
//       var files = event.originalEvent.dataTransfer.files;
//       console.l og(files);
//   });
//   // imageuploadify-images-list
  // HTML CSS JSResult Skip Results Iframe
/* Bootstrap 5 JS included */

</script>
<style>
  .pop-text{
    margin-left: 10px;
  }
  .popover-body{
    padding: 0px;
  }
  .pop_list{
    border-bottom: 1px solid #ececec;
    padding: 10px 40px 10px 15px;
  }
  .btPpop{
    border-radius: 50%;
    border: 1px solid #ccc;
    padding: 2px 7px;
    position: absolute;
    top: 5px;
    right: 5px;
    background: #fff;
    cursor: pointer;
  }
  .fileDeleteBtn {
    position: relative;
    top: 0;
    right: 0;
    height: 37px;
    color: #ed3d3d;
    background: none;
    cursor: pointer;
  }
  .pop_list_content {
    cursor: pointer;
  }
  .last_menu{
    border-bottom: 1px !important;
  }
  :root {
  --colorPrimaryNormal: #00b3bb;
  --colorPrimaryDark: #00979f;
  --colorPrimaryGlare: #00cdd7;
  --colorPrimaryHalf: #80d9dd;
  --colorPrimaryQuarter: #bfecee;
  --colorPrimaryEighth: #dff5f7;
  --colorPrimaryPale: #f3f5f7;
  --colorPrimarySeparator: #f3f5f7;
  --colorPrimaryOutline: #dff5f7;
  --colorButtonNormal: #00b3bb;
  --colorButtonHover: #00cdd7;
  --colorLinkNormal: #00979f;
  --colorLinkHover: #00cdd7;
}

.upload_dropZone {
  color: #0f3c4b;
  background-color: var(--colorPrimaryPale, #c8dadf);
  outline: 2px dashed var(--colorPrimaryHalf, #c1ddef);
  outline-offset: -12px;
  transition:
    outline-offset 0.2s ease-out,
    outline-color 0.3s ease-in-out,
    background-color 0.2s ease-out;
}
.upload_dropZone.highlight {
  outline-offset: -4px;
  outline-color: var(--colorPrimaryNormal, #0576bd);
  background-color: var(--colorPrimaryEighth, #c8dadf);
}
.upload_svg {
  fill: var(--colorPrimaryNormal, #0576bd);
}
.btn-upload {
  color: #fff;
  background-color: var(--colorPrimaryNormal);
}
.btn-upload:hover,
.btn-upload:focus {
  color: #fff;
  background-color: var(--colorPrimaryGlare);
}
.upload_img {
  /* width: calc(33.333% - (2rem / 3)); */
  width: calc(15% - (2rem / 3));
  object-fit: contain;
}

.full-width{
    width:100% !important;
}
</style>
