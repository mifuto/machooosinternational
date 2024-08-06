<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']);
if($_SESSION['MachooseAdminUser']['user_id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}

include("templates/header.php")

?>
<div class="pagetitle">
  <h1>CREATE SIGNATURE ALBUM</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="dashboard.php">Home</a>
      </li>
      <li class="breadcrumb-item">Online album</li>
      <li class="breadcrumb-item active">Create Folder</li>
      
    </ol>
  </nav>
</div>
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
              <label for="inputText" class="col-sm-2 col-form-label">Select User</label>
              <div class="col-sm-10">
                <select class="form-control select2" aria-label="Default select example" id="signAlbumUsersList" name="signAlbumUsersList"></select>
                <div class="invalid-feedback">
                  Plese select a user!.
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-12">
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"> Create folder </button> -->
                <button type="submit" class="btn btn-primary float-end" data-bs-toggle="tooltip" data-bs-placement="top" title="Create folder"> Create folder </button>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-sm-12">
                <button type="submit" class="btn btn-primary float-end" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Project"> Create Project </button>
              </div>
            </div>
          </form>
          <div class="modal fade" id="uploadImageModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Create Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="uploadSigExtrafilesForm" class="needs-validation" novalidate>
                      <div class="modal-body">
                        <div class="row mb-3 mt-4">
                          <label for="uploadsigAlbmFolderName" class="col-sm-3 col-form-label">Folder Name</label>
                          <div class="col-sm-9">
                            <input type="text"  class="form-control" id="uploadsigAlbmFolderName" name="uploadsigAlbmFolderName" value="" disabled>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="signatureAlbumFiles" class="col-sm-3 col-form-label">File Upload</label>
                          <div class="col-sm-9">
                          <!-- <input class="form-control" type="file" id="formFileMultiple" multiple /> -->
                          <input id="uploadSignatureAlbumFiles" name="uploadSignatureAlbumFiles[]" type="file" class="form-control"  data-show-upload="false" data-show-caption="true" multiple>
                            <div class="invalid-feedback">
                              Plese select the zip file!.
                            </div>
                          </div>
                        </div>
                        <!-- <div class="row mb-3">
                          <label for="inputEmail" class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-10">
                            <span class="badge bg-success">
                              <i class="bi bi-check-circle me-1"></i> Create Successfully </span>
                          </div>
                        </div> -->
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="selectedUplSigUserId" name="selectedUplSigUserId" value="">
                        <input type="hidden" id="selectedUplSigAlbmId" name="selectedUplSigAlbmId" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="uplSigFilesSubmit">Create</button>
                        <button class="btn btn-primary d-none" type="button" id="uplSigFilesLoadingButton" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal fade" id="createFolderModal" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      
                    <h5 class="modal-title">Create Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form id="createSigAlbmFolderForm" class="needs-validation" novalidate>
                      <div class="modal-body">
                        <div class="row mb-3 mt-4">
                          <label for="sigAlbmFolderName" class="col-sm-3 col-form-label">Folder Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="sigAlbmFolderName" name="sigAlbmFolderName">
                            <div class="invalid-feedback">
                              Plese enter the folder name!.
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label for="signatureAlbumFiles" class="col-sm-3 col-form-label">File Upload</label>
                          <div class="col-sm-9">
                            <input class="form-control" type="file" id="signatureAlbumFiles" name="signatureAlbumFiles">
                            <div class="invalid-feedback">
                              Plese select the zip file!.
                            </div>
                          </div>
                        </div>
                        <div class="progress mt-3">
                          <div class="progress-bar progress-bar-striped bg-danger d-none" id="signalbmUploadStatus" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="uploadStatus"></div>
                        <!-- <div class="row mb-3">
                          <label for="inputEmail" class="col-sm-2 col-form-label"></label>
                          <div class="col-sm-10">
                            <span class="badge bg-success">
                              <i class="bi bi-check-circle me-1"></i> Create Successfully </span>
                          </div>
                        </div> -->
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" id="selectedUserId" name="selectedUserId" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="createFolderSubmit">Create</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Basic Modal-->
            <!-- <div class="row mb-3">
              <label for="inputEmail" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <button type="button" class="btn btn-primary">Folder1</button>
                <button type="button" class="btn btn-primary">Folder2</button>
                <button type="button" class="btn btn-primary">Folder3</button>
                <button type="button" class="btn btn-primary">Folder4</button>
              </div>
            </div> -->
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Folders</h5>
                <!-- Default Tabs -->
                <ul class="nav nav-tabs" id="signatureAlbumTabs" role="tablist">
                  <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Folder1</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Folder2</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Folder3</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Photo-tab" data-bs-toggle="tab" data-bs-target="#photo" type="button" role="tab" aria-controls="contact" aria-selected="false">Folder4</button>
                  </li> -->
                </ul>
                <div class="pt-4 pb-4" id="signatureAlbumEmptyData">
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Not selected the user to view the albums!
                    </div>
                  </div>
                </div>
                <div class="pt-4 pb-4 d-none" id="signatureAlbumEmptyDataForUser">
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>
                      Not created the folder to view !
                    </div>
                  </div>
                </div>
                <div class="tab-content pt-2 d-none" id="signatureAlbumTabContent">
                  <!-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    
                      <img src="Photos/Cus_id/2010-10-30_Wikipedia_Bodensee_Treffen_Übersicht.jpg" width="450" height="276">
                    </p>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"> Upload photos/Drag Here 
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> Upload photos/Drag here 
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="photo" role="tabpanel" aria-labelledby="contact-tab"> Upload photos/Drag here 
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div> -->
                </div>
                <!-- End Default Tabs -->
              </div>
            </div>
            <div class="row mb-3">
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
            </div>
          <!-- End General Form Elements -->
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-12">
      <div class="row" id="3_xcxcx" style="position: relative;">
        <div class="rem-masonry my-masonry">
        <ul class="rem-masonry my-masonry">
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS9073-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS8636-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS8614-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS9492-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS9116-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS8921-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS9036-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS8987-copy.jpg" alt="masonry"></div>
          <div><img src="signatureAlbumUploads/3_xcxcx/MCHS9972-copy.jpg" alt="masonry"></div>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS0094-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS8513-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9588-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9739-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9528-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9092-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9409-copy.jpg" alt="masonry"></li>
          <li><img src="signatureAlbumUploads/3_xcxcx/MCHS9157-copy.jpg" alt="masonry"></li>
        </ul>
      </div>
      </div>
    </div> -->
  </div>
</section>

<?php 

  include("templates/footer.php");

?>


<script>
  $( document ).ready(function() {
      getusers("signAlbumUsersList");
      $('#signAlbumUsersList').select2();
      
  });
</script>
