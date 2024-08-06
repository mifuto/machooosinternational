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
    
    if (strpos($userPermissionsList, 'Online-Album') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?>

    <div class="pagetitle">
      <h1>ONLINE ALBUM</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Online album</li>
          <li class="breadcrumb-item active">Events</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <div class="modal fade" id="extendEventDateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Extend event expiry date</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" >
              <div class="row mb-3 mt-4">
                <label class="col-sm-3 col-form-label">Expiry Date</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="ExpiryDateVal" name="ExpiryDateVal" value="">
                  <div class="invalid-feedback">
                    Plese select Expiry Date!.
                  </div>
                </div>
              </div>


            
            </div>
            <div class="modal-footer">
            
              <input type="hidden" id="extendEventDateid" name="extendEventDateid" value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="saveExtendEventDate();" >Extend </button>
             
            </div>
        </form>
      </div>
    </div>
  </div>

    <section class="section d-none" id="eventFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT">Add event</h5>

              <!-- General Form Elements -->
              <!-- <form id="addEventForm" class="needs-validation" novalidate> -->
              <form id="addEventForm"  >
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                        <label for="usersList" class="col-sm-12 col-form-label">User</label>
                        <div class="col-sm-12">
                            <select class="form-control select2" aria-label="Default select example" id="usersList" name="usersList">
                            <!-- <option selected>Select User</option>
                            <option value="1">User1</option>
                                        <option value="2">User2</option> -->
                            </select>
                            <div class="invalid-feedback">
                            Plese select a user!.
                            </div>
                        </div>
                        </div>
                        
                        <div class="row mb-3">
                        <label for="eventName" class="col-sm-12 col-form-label">Event Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="eventName" name="eventName">
                            <div class="invalid-feedback">
                            Plese enter the event name!.
                            </div>
                        </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="inputEmail" class="col-sm-12 col-form-label">Venue</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="venue" name="venue">
                                <div class="invalid-feedback">
                                Plese enter the venue!.
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="row mb-3">
                            <label for="pageNumber" class="col-sm-12 col-form-label">Page no</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="pageNumber" name="pageNumber">
                                <div class="invalid-feedback">
                                Plese enter the page no!.
                                </div>
                            </div>
                        </div>-->
                        <div class="row mb-3" id="showFolderName">
                            <label for="folderName" class="col-sm-12 col-form-label">Folder Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="folderName" name="folderName">
                                <div class="invalid-feedback">
                                Plese enter the folder name!.
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="eventFiles" name="eventFiles">
                            <div class="invalid-feedback">
                            Plese select the zip file!.
                            </div>
                        </div>
                        </div> -->
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-12 pt-0">Album Type</legend>
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Portraits Album
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check ">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Landscape album
                                    </label>
                                    <div class="invalid-feedback">More example invalid feedback text</div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-12 col-form-label">Uploaded Date</label>
                            <div class="col-sm-12">
                            <input type="date" class="form-control" id="uploadedDate" name="uploadedDate">
                            <div class="invalid-feedback">
                                Plese enter the uploaded date!.
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="eventFiles" name="eventFiles">
                            <div class="invalid-feedback">
                            Plese select the zip file!.
                            </div>
                        </div>
                        </div> -->
                        <div class="row mb-3">
                            <label for="coverImage" class="col-sm-12 col-form-label">Cover image</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" id="coverImage" name="coverImage">
                                <div class="invalid-feedback">
                                Plese upload the cover image!.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="albumPdf" class="col-sm-12 col-form-label">Album PDF</label>
                            <div class="col-sm-12">
                                <input class="form-control" type="file" id="albumPdf" name="albumPdf">
                                <div class="invalid-feedback">
                                Plese upload the album file!.
                                </div>
                            </div>
                        </div>
                        <!--<div class="row mb-3">
                            <label for="albumPdf" class="col-sm-12 col-form-label">Album Size</label>
                            <div class="col-sm-6">
                                <label for="albmWidth" class="col-sm-12 col-form-label">Width</label>
                                <input class="form-control" type="text" id="albmWidth" name="albmWidth">
                                <div class="invalid-feedback">
                                Plese enter albun width!.
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="albmHeight" class="col-sm-12 col-form-label">Height</label>
                                <input class="form-control" type="text" id="albmHeight" name="albmHeight">
                                <div class="invalid-feedback">
                                Plese enter albun height!.
                                </div>
                            </div>
                        </div>-->
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Description</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" style="height: 100px" id="description" name="description"></textarea>
                                <div class="invalid-feedback">
                                Plese enter the description!.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputDate" class="col-sm-12 col-form-label">Event Date</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="eventdate" name="eventdate">
                                <div class="invalid-feedback">
                                Plese enter the event date!.
                                </div>
                            </div>
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
                        <button type="submit" id="submitButton" class="btn btn-primary float-right">SAVE</button>
                        <button type="submit" id="updateEventButton" class="btn btn-primary float-right d-none">Update</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="showEventListSection();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>



    <section id="eventListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h5 class="card-title">Event details</h5>
                </div>

                <div class="col-sm-3 pt-4 " >
                    <select class="select2" aria-label="Default select example" id="sel_user" name="sel_user" onchange="getEvents();">
                    <option value="" selected>Select User</option>
                     </select>
                 
                </div>
                
                <div class="col-sm-6 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddEventSection();">Add New Event</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">User</th>
                      <th scope="col">Event Name</th>
                      <th scope="col">Venue</th>
                      <th scope="col">Event Date</th>
                      <th scope="col">Description</th>
                      <th scope="col">Album Type</th>
                       <th scope="col">Responses</th>
                       <th scope="col">View PIN</th>
                      <th scope="col">Uploaded Date</th>
                      <th scope="col">Expiry Date</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                      <th scope="row">1</th>
                      <td>Brandon Jacob</td>
                      <td>Designer</td>
                      <td>admin</td>
                      <td>admin</td>
                      <td>admin</td>
                      <td>admin</td>
                      <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                    </tr> -->
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
  $( document ).ready(function() {
      getusers("usersList");
      getEvents();
      getusers("sel_user");
      $('#usersList').select2();
      $('#sel_user').select2();
  });

 



</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>