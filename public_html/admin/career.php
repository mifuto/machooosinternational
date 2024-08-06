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
    
    if (strpos($userPermissionsList, 'Career') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?>

    <div class="pagetitle">
      <h1>Career</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Career</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="careerFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT">Add wedding film</h5>

              <!-- General Form Elements -->
              <!-- <form id="addEventForm" class="needs-validation" novalidate> -->
              <form id="addCareerForm"  >
               
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Job Title</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="eventTitle" name="eventTitle">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the job title!.
                        </div>
                    </div>
                    
                   <input type="hidden" value = '123' id="inputJobId" name="inputJobId">
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-3 col-form-label">County</label>
                    <label for="" class="col-3 col-form-label">State</label>
                    <label for="" class="col-3 col-form-label">District</label>
                    <label for="" class="col-3 col-form-label">City</label>
                    
                     <div class="col-3">
                            <select class="form-control" id="inputCounty" name="inputCounty">
                                <option value="India" selected>India</option>
                                <option value="Uk">UK</option>
                            </select>
                        <div class="invalid-feedback">
                        Please select district!.
                        </div>
                    </div>
                    
                    
                    
                    <div class="col-3">
                        
                        <select class="form-control" id="inputState" name="inputState">
                            <option value="" selected>Select State</option>
                            <option value="Andra Pradesh">Andra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala" >Kerala</option>
                            <option value="Madya Pradesh">Madya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Orissa">Orissa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttaranchal">Uttaranchal</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                            <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                            <option value="Chandigarh">Chandigarh</option>
                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu">Daman and Diu</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Lakshadeep">Lakshadeep</option>
                            <option value="Pondicherry">Pondicherry</option>
                          </select>
      
                        
                   
                        <div class="invalid-feedback">
                        Please select State!.
                        </div>
                    </div>
                    <div class="col-3">
                            <select class="form-control" id="inputDistrict" name="inputDistrict">
                                <option value="">-- select one -- </option>
                            </select>
                        <div class="invalid-feedback">
                        Please select district!.
                        </div>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" id="inputCity" name="inputCity">
                        <div class="invalid-feedback">
                        Please enter the city!.
                        </div>
                    </div>
                </div>
                
                
                  
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Job description</label>
                    <div class="col-12">
                        <textarea class="form-control" id="eventDescription" name="eventDescription"></textarea>

                        <div class="invalid-feedback">
                        Please enter the job description!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Job summary</label>
                    <div class="col-12">
                        <textarea class="form-control" id="jobsummary" name="jobsummary"></textarea>

                        <div class="invalid-feedback">
                        Please enter the job summary!.
                        </div>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Workig conditions</label>
                    <div class="col-12">
                        <textarea class="form-control" id="Workigconditions" name="Workigconditions"></textarea>

                        <div class="invalid-feedback">
                        Please enter the Workig conditions!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Job duties</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="Jobduties" name="Jobduties">

                        <div class="invalid-feedback">
                        Please enter the Job duties!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Qualifications to be needed</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="Qualifications" name="Qualifications">

                        <div class="invalid-feedback">
                        Please enter the Qualifications to be needed!.
                        </div>
                    </div>
                </div>
               
                
                
                <div class="row mb-3">
                    <label for="" class="col-4 col-form-label">Experience</label>
                    <label for="" class="col-8 col-form-label">Skills</label>
                    <div class="col-4">
                        <input type="number" class="form-control" id="Experience" name="Experience">

                        <div class="invalid-feedback">
                        Please enter the Experience!.
                        </div>
                    </div>
                    <div class="col-8">
                        <input type="text" class="form-control" id="Skills" name="Skills">

                        <div class="invalid-feedback">
                        Please enter the Skills!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Responsibiities</label>
                    <div class="col-12">
                        <textarea class="form-control" id="Responsibiities" name="Responsibiities"></textarea>

                        <div class="invalid-feedback">
                        Please enter the Responsibiities!.
                        </div>
                    </div>
                </div>
            
                
                
                
                
                 <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                    <label for="EventCoverImgFile" class="col-form-label" style="padding-left: 0;"> Image</label>
                    <input type="file" id="EventCoverImgFile" name="EventCoverImgFile[]" accept="image/*" multiple>
                    <div class="text-danger" id="EventCoverImgFilerr"></div>
                  </div>
                
               
                
                
                
                
                <div class="row mb-3 mt-5">
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-danger d-none" id="careerUploadsStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <button type="button" class="btn btn-danger" onclick="cancelCareerForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    <section id="careerListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Career</h5>
                </div>

               
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddCareerSection();">Add New Career</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Job Id</th>
                      <th scope="col">Title</th>
                      <th scope="col">County</th>
                      
                      
                        <th scope="col">State</th>
                      <th scope="col">District</th>
                      <th scope="col">City</th>

                      <th scope="col"> Description</th>
                      
                      
                      <!--<th scope="col">Job summary</th>-->
                      <!--  <th scope="col">Workig conditions</th>-->
                      <!--<th scope="col">Job duties</th>-->
                      <th scope="col">Qualifications</th>

                      <th scope="col"> Experience</th>
                      
                      <!--<th scope="col"> Skills</th>-->
                      <!--<th scope="col"> Responsibiities</th>-->
                      
                      
                      
                      
                      
                      
                      
                      <th scope="col">Img</th>
                      <th scope="col">Posted date</th>
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
    
    <section class="section d-none" id="jobApplicationListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-4">
                  <h5 class="card-title" id="jobApplicationName"></h5>
                </div>
                
                 <div class="col-4">
\                  <select class="form-control select2" aria-label="Default select example" id="applicationStatus" onchange='tablelApplications();' name="applicationStatus">
    <option value="" selected>All</option>
    <option value="0" >PENDING</option>
    <option value="1" >SHORT LISTED</option>
    <option value="2" >ACCEPTED</option>
    <option value="3" >DECLINED</option>
                            </select>
                </div>

              
                <div class="col-4 pt-4 " align="right">
                    <button class="btn btn-success " onclick="viewTotalSummy();">Detailed overview</button>
                  <button class="btn btn-primary " onclick="cancelJobApplication();">Back</button>
                </div>
              </div> 
              
            
              <hr>
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="applicationListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone1</th>
                      <!--  <th scope="col">Phone2</th>-->
                      <!--<th scope="col">Address1</th>-->
                      <!--<th scope="col">Address2</th>-->

                      <!--<th scope="col"> Nationality</th>-->
                      
                      
                      <!--<th scope="col">State</th>-->
                      <!--  <th scope="col">District</th>-->
                      <th scope="col">Experienece</th>
                      <th scope="col">Education</th>

                      <!--<th scope="col"> Camera</th>-->
                      
                      <!--<th scope="col"> AboutUs</th>-->
                      <!--<th scope="col"> CV</th>-->
                      
                      <!--<th scope="col">Aadhar</th>-->
                      <!--<th scope="col">Passport</th>-->
                      <th scope="col">Status</th>
                      <th scope="col">Apply Date</th>
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
    
    
    
    
    <div class="modal fade" id="showFullDetailView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Job Application</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="extendSAEventDateModalForm" class="g-3 needs-validation" novalidate="">
            <div class="modal-body" id="disApplicationDetails">
                
            </div>
            <div class="modal-footer">
            
              <input type="hidden" id="selApplicationId" name="selApplicationId" value="">
              
              
               <button type="button" class="btn btn-success" id='btn_s_2' onclick="applyApplicationStatus(2);">Accept</button>
               <button type="button" class="btn btn-danger" id='btn_s_3' onclick="applyApplicationStatus(3);">Declin</button>
               <button type="button" class="btn btn-primary" id='btn_s_1' onclick="applyApplicationStatus(1);">Short list</button>
                  
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
        </form>
      </div>
    </div>
  </div>
  
  
   <div class="modal fade" id="showFullSummaryView" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title">Detailed overview</h5>
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
  $( document ).ready(function() {
      getjobs("eventTitle");
      getCareerList();
 $('#EventCoverImgFile').imageuploadify();
     
  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    var selShowJobId = '';
    var selShowJobName = '';
      var selShowJobcode = '';
    
  
  function getjobs(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select job</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.position_id+"'>"+value.position_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);

    }
    data = { "function": 'Career',"method": "getjobs"};
    
    apiCall(data,successFn);
    
}
  
  
  function showAddCareerSection(){
      
      emptyForm();
      

     
    $("#careerListSection").addClass("d-none");
        $('#addEVT').html('Add career');
        
       
        $('#careerFormSection').removeClass("d-none");
      
  }
  
  function editCareerList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

       $('#uploadStatus').html('');
       
       $("#careerUploadsStatus").width('0%');
        $("#careerUploadsStatus").html('0%');
     
        $('#addEVT').html('Update career');
          $('#careerFormSection').removeClass("d-none");
                $("#careerListSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $("#eventTitle").val(eventList['tittle']).trigger('change');
               $("#eventDescription").val(eventList['sub_tittle']);
               
               $("#inputJobId").val(eventList['inputJobId']);
               
               $("#inputCity").val(eventList['city']);
       $("#inputState").val(eventList['state']).trigger('change');
       $("#inputDistrict").val(eventList['district']).trigger('change');
       
       $("#inputCounty").val(eventList['County']).trigger('change');
               
               $("#EventCoverImgFile").val('');
               
               
               $("#jobsummary").val(eventList['jobsummary']);
               $("#Workigconditions").val(eventList['Workigconditions']);
               $("#Jobduties").val(eventList['Jobduties']);
               $("#Qualifications").val(eventList['Qualifications']);
               $("#Experience").val(eventList['Experience']);
               $("#Skills").val(eventList['Skills']);
               $("#Responsibiities").val(eventList['Responsibiities']);
               

            }
           
            
          
        }
        data = { "function": 'Career',"method": "geteditCareerList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  function emptyForm(){
      $('#addCareerForm').removeClass('was-validated');
      $('.ri-close-circle-line').click();
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       $("#eventTitle").val("").trigger('change');
       $("#eventDescription").val("");
       
       $("#inputCity").val("");
      $("#inputState").val("").trigger('change');
      $("#inputDistrict").val('').trigger('change');
      
      $("#inputCounty").val('India').trigger('change');
      
      
       $("#inputJobId").val("");
       $("#EventCoverImgFile").val("");
       
        $("#jobsummary").val('');
               $("#Workigconditions").val('');
               $("#Jobduties").val('');
               $("#Qualifications").val('');
               $("#Experience").val('');
               $("#Skills").val('');
               $("#Responsibiities").val('');
       
       
      
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

       $('#uploadStatus').html('');
       
       $("#careerUploadsStatus").width('0%');
        $("#careerUploadsStatus").html('0%');
  }
  
  function cancelCareerForm(){
      emptyForm();
      $('#careerFormSection').addClass("d-none");
      $("#careerListSection").removeClass("d-none");
  }
  
  
  
  $("#addCareerForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var hiddenEventId = $('#hiddenEventId').val();
        
        if(hiddenEventId ==""){
              var eventCoverFile = $('#EventCoverImgFile')[0].files;

                if(eventCoverFile.length == 0){
                    $("#EventCoverImgFilerr").html("Plese upload the cover image!.");
                    return false;
                }else if(eventCoverFile.length > 1){
                    $("#EventCoverImgFilerr").html("Plese You can upload only one image !.");
                    return false;
                }else{
                    $("#EventCoverImgFilerr").html("");
                }
        
   
        }
        
      
        var save = $("#save").val();
       
        
        var form = $("#addCareerForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'Career');
        formData.append('method', 'saveCareer');

        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this career",
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
                        $("#updateEventButton").addClass("d-none");
                        
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
                                $('#careerUploadsStatus').removeClass('d-none');
                            },
                            error:function(){
                                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Career "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getCareerList();
                                    
                                    $("#eventListSection").removeClass("d-none");
                                    $('#eventFormSection').addClass("d-none");
                                    
                                    $('#careerFormSection').addClass("d-none");
                                    $("#careerListSection").removeClass("d-none");
                                    
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
                        $("#hiddenEventId").val("");
                    }
            });
        
        
       
    },
    rules: {
        eventTitle: {
            required: true
        },
        inputJobId: {
            required: true
        },
        inputState: {
            required: true
        },
        inputDistrict: {
            required: true
        },
        inputCity: {
            required: true
        },
        eventDescription: {
            required: true
        }
        
        ,
        jobsummary: {
            required: true
        }
        ,
        Workigconditions: {
            required: true
        }
        ,
        Jobduties: {
            required: true
        }
        ,
        Qualifications: {
            required: true
        }
        ,
        Experience: {
            required: true
        }
        ,
        Skills: {
            required: true
        }
        
        ,
        Responsibiities: {
            required: true
        }
        
    },
    messages: {
        eventTitle: {
            required: "Please select the job title"
        },
         inputJobId: {
            required: "Please enter the job id"
        },
        inputState: {
            required: "Please select State"
        },
         inputDistrict: {
            required: "Please select District"
        },
         inputCity: {
            required: "Please select City"
        },
        eventDescription: {
            required: "Please enter job description"
        }
        
        ,
        jobsummary: {
            required: "Please enter job summary"
        }
        ,
        Workigconditions: {
            required: "Please enter Workig conditions"
        }
        ,
        Jobduties: {
            required: "Please enter Jobduties"
        }
        ,
        Qualifications: {
            required: "Please enter Qualifications"
        }
        ,
        Experience: {
            required: "Please enter Experience"
        }
        ,
        Skills: {
            required: "Please enter Skills"
        }
        
        ,
        Responsibiities: {
            required: "Please enter Responsibiities"
        }
       
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

function applyApplicationStatus(status){
    
    if(status == 1) var sts = 'short list';
    else if(status == 2) var sts = 'accept';
    else if(status == 3) var sts = 'decline';
    
    var selApplicationId = $('#selApplicationId').val();
    
    return new swal({
             title: "Are you sure?",
             text: "You want to "+sts+" this application",
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
                                 title: 'Successfully '+sts+' application',
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                             tablelApplications();
                             $("#showFullDetailView").modal('hide');
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: 'Failed to '+sts+' application',
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'Career',"method": "applyApplicationStatus" ,"sel_id":selApplicationId ,'status':status };
                     apiCall(data,successFn);
                 }
         });
    
}

function showApplications(id,job,code){
    $('#careerFormSection').addClass("d-none");
      $("#careerListSection").addClass("d-none");
      $("#jobApplicationListSection").removeClass("d-none");
      
      $("#jobApplicationName").html(job+" - "+code);
      
      selShowJobId = id;
      selShowJobName = job;
      selShowJobcode = code;
      
      
      tablelApplications();
      
      
}

function tablelApplications(){
    
    var id = selShowJobId;
    var code = selShowJobcode;
    var job = selShowJobName;
    
    setSummaryData(selShowJobId);
    
    
    var applicationStatus = $('#applicationStatus').val();
      
      successFn = function(resp)  {
        $('#applicationListTable').DataTable().destroy();
        var eventList = resp.data;
       
        $('#applicationListTable').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              { "data": "Name" },
              { "data": "Email" },
              { "data": "Phone1" },
            //   { "data": "Phone2" },
            //   { "data": "Address1" },
            //   { "data": "Address2" },
            //   { "data": "Nationality" },
            //   { "data": "State" },
            //   { "data": "District" },
              { "data": "Experienece" },
              { "data": "Education" },
            //   { "data": "camera" },
            //   { "data": "AboutUs" },
              
            //   { "data": "uploadCV", 
            //       render: function ( data ) {
            //         return '<image width="150px" height="auto" src="'+data+'"></image>';
            //     }
            //   },
              
            //   { "data": "uploadAadhar", 
            //       render: function ( data ) {
            //         return '<image width="150px" height="auto" src="'+data+'"></image>';
            //     }
            //   },
              
            //   { "data": "uploadPassport", 
            //       render: function ( data ) {
            //         return '<image width="150px" height="auto" src="'+data+'"></image>';
            //     }
            //   },
            
            { "data": "active",
              
                "render": function ( data, type, full, meta ) {
                    if(data == 0) return '<label ><b>PENDING</b></label>';
                    else if(data == 1) return '<label class="text-primary"><b>SHORT LIST</b></label>';
                    else if(data == 2) return '<label class="text-success"><b>ACCEPT</b></label>';
                    else if(data == 3) return '<label class="text-danger"><b>DECLINE</b></label>';
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
                  var str = '<span class="btn btn-primary" onclick="showFullDetails('+item.id+',`'+job+'`,`'+code+'`);" style="cursor:pointer">View</span>';
                  
               
                return str;
                    
                    }
                },
             
             
              
          
             
            ]
        });
    }
    data = { "function": 'Career',"method": "getApplicationList","jobId":id ,'applicationStatus':applicationStatus};
    
    apiCall(data,successFn);
      
}

function viewTotalSummy(){
    $("#showFullSummaryView").modal('show');
}

function setSummaryData(id){
    $("#disApplicationSummaryDetails").html('');
    
    successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                var disData ='';
                
                disData +='<br><div class="row "><label class="col-sm-8 col-form-label"><b>Total applications</b></label><div class="col-sm-4"><b>: '+eventList['totalCount']+'</b></div></div>';
                
                 disData +='<br><div class="row "><label class="col-sm-8 col-form-label text-warning"><b>Pending applications</b></label><div class="col-sm-4 text-warning"><b>: '+eventList['pendingCount']+'</b></div></div>';
                
                
               disData +='<br><div class="row "><label class="col-sm-8 col-form-label text-primary"><b>Shortlisted applications</b></label><div class="col-sm-4 text-primary"><b>: '+eventList['shortListCount']+'</b></div></div>';
                
                 disData +='<br><div class="row "><label class="col-sm-8 col-form-label text-success"><b>Accepted applications</b></label><div class="col-sm-4 text-success"><b>: '+eventList['acceptCount']+'</b></div></div>';
                
                 disData +='<br><div class="row "><label class="col-sm-8 col-form-label text-danger"><b>Declined applications</b></label><div class="col-sm-4 text-danger"><b>: '+eventList['declineCount']+'</b></div></div>';
                
                
                
            
             
                $('#disApplicationSummaryDetails').html(disData);
             

            }
           
            
          
        }
        data = { "function": 'Career',"method": "setSummaryData" ,"sel_id":id };
        
        apiCall(data,successFn);
   
    
}




function showFullDetails(id,job,code){
    $("#showFullDetailView").modal('show');
    $('#selApplicationId').val(id);
    
    
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                var disData ='';
                
                disData +='<div class="row "><div class="col-sm-3"> <image width="100%" height="auto" src="'+eventList['uploadPassport']+'"></image> </div><div class="col-sm-9"> '+eventList['Name']+' <br> '+eventList['Email']+' <br> '+eventList['Phone1']+' <br> '+eventList['Phone2']+' <br> '+eventList['Address1']+' <br> '+eventList['Address2']+' <br> '+eventList['District']+', '+eventList['State']+', '+eventList['Nationality']+' </div></div>';
                
                
                
                disData +='<br><div class="row "><label class="col-sm-3 col-form-label">Job ID </label><div class="col-sm-9">: '+code+'</div></div>';
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Job </label><div class="col-sm-9">: '+job+'</div></div>';
                
              
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Experienece </label><div class="col-sm-9">: '+eventList['Experienece']+'</div></div>';
                
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Education </label><div class="col-sm-9">: '+eventList['Education']+'</div></div>';
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Hear about us </label><div class="col-sm-9">: '+eventList['AboutUs']+'</div></div>';
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Camera </label><div class="col-sm-9">: '+eventList['camera']+'</div></div>';
                
                
                 var date = new Date(eventList['created_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                
                disData +='<div class="row "><label class="col-sm-3 col-form-label">Applied </label><div class="col-sm-9">: '+formattedDate+'</div></div>';
                
                disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['uploadCV']+'" download>Download CV</a></div></div>';
                disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['uploadAadhar']+'" download>Download Aadhar</a></div></div>';
                
                disData +='<hr><h5>Social media links</h5>';
                
                
                 if(eventList['SocialMedia1'] != "") disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['SocialMedia1']+'" target="_blank">Social media link 1 </a></div></div>';
                if(eventList['SocialMedia2'] != "") disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['SocialMedia2']+'" target="_blank">Social media link 2</a></div></div>';
                 if(eventList['PersonalWeb'] != "") disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['PersonalWeb']+'" target="_blank">Personal website link</a></div></div>';
                if(eventList['OtherMedia'] != "") disData +='<div class="row "><div class="col-sm-12 "><a href="'+eventList['OtherMedia']+'" target="_blank">Other social media link</a></div></div>';
                
                if(eventList['SocialMedia1'] == "" && eventList['SocialMedia2'] == "" && eventList['PersonalWeb'] == "" && eventList['OtherMedia'] == ""){
                    disData +='<div class="row "><div class="col-sm-12 text-danger">link unavailable</div></div>';
                }
                
                
                
                
                
              
                $('#btn_s_1').removeClass('d-none');
                $('#btn_s_2').removeClass('d-none');
                $('#btn_s_3').removeClass('d-none');
                
                
                $('#btn_s_'+eventList['active']).addClass('d-none');
             
                $('#disApplicationDetails').html(disData);
             

            }
           
            
          
        }
        data = { "function": 'Career',"method": "getApplicationDataList" ,"sel_id":id };
        
        apiCall(data,successFn);
    
    
    
    
    
    
}




function cancelJobApplication(){
    $('#careerFormSection').addClass("d-none");
      $("#careerListSection").removeClass("d-none");
      $("#jobApplicationListSection").addClass("d-none");
}

function getCareerList(){

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
               { "data": "position_code",
              
                "render": function ( data, type, full, meta ) {
                    return  '<a onclick="showApplications('+full['id']+',`'+full['position_name']+'`,`'+full['position_code']+'`);" class="text-primary ">'+data+'</a>';
                }
              },
              { "data": "position_name" },
               { "data": "County" },
              
              
              { "data": "state" },
              { "data": "district" },
              { "data": "city" },
              
              
              {
                  "data": "sub_tittle",
                  "render": function (data) {
                    if (data.length > 25) {
                      return data.substring(0, 25) + '...';
                    }
                    return data;
                  }
                },
                
            //      {
            //       "data": "jobsummary",
            //       "render": function (data) {
            //         if (data.length > 25) {
            //           return data.substring(0, 25) + '...';
            //         }
            //         return data;
            //       }
            //     },
                
            //      {
            //       "data": "Workigconditions",
            //       "render": function (data) {
            //         if (data.length > 25) {
            //           return data.substring(0, 25) + '...';
            //         }
            //         return data;
            //       }
            //     },
              
            //   {
            //       "data": "Jobduties",
            //       "render": function (data) {
            //         if (data.length > 25) {
            //           return data.substring(0, 25) + '...';
            //         }
            //         return data;
            //       }
            //     },
              
              { "data": "Qualifications" },
              { "data": "Experience" },
              
            //   {
            //       "data": "Skills",
            //       "render": function (data) {
            //         if (data.length > 25) {
            //           return data.substring(0, 25) + '...';
            //         }
            //         return data;
            //       }
            //     },

            //   {
            //       "data": "Responsibiities",
            //       "render": function (data) {
            //         if (data.length > 25) {
            //           return data.substring(0, 25) + '...';
            //         }
            //         return data;
            //       }
            //     },

              
              
              
              
              { "data": "image", 
                  render: function ( data ) {
                    return '<image width="150px" height="auto" src="'+data+'"></image>';
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
                  var str = '<span class="badge bg-info text-dark" onclick="editCareerList('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deletecarrer('+item.id+');" style="cursor:pointer">delete</span>';
                  
                  if(item.disabled == 0){
                      str +='<span class="badge bg-success" onclick="Disablecarrer('+item.id+');" style="cursor:pointer">Enabled</span>';
                  }else{
                      str +='<span class="badge bg-warning" onclick="Enablecarrer('+item.id+');" style="cursor:pointer">Disabled</span>';
                  }
                  
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'Career',"method": "getCareerList" };
    
    apiCall(data,successFn);
}



function Disablecarrer(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to disable this career",
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
                            getCareerList();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'Career',"method": "Disablecarrer" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
 
 
 function Enablecarrer(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to enable this career",
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
                            getCareerList();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'Career',"method": "Enablecarrer" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
 
 





function deletecarrer(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this career",
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
                            getCareerList();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'Career',"method": "deletecarrer" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 var AndraPradesh = ["Anantapur","Chittoor","East Godavari","Guntur","Kadapa","Krishna","Kurnool","Prakasam","Nellore","Srikakulam","Visakhapatnam","Vizianagaram","West Godavari"];
var ArunachalPradesh = ["Anjaw","Changlang","Dibang Valley","East Kameng","East Siang","Kra Daadi","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Namsai","Papum Pare","Siang","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang","Itanagar"];
var Assam = ["Baksa","Barpeta","Biswanath","Bongaigaon","Cachar","Charaideo","Chirang","Darrang","Dhemaji","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Hojai","Jorhat","Kamrup Metropolitan","Kamrup (Rural)","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Majuli","Morigaon","Nagaon","Nalbari","Dima Hasao","Sivasagar","Sonitpur","South Salmara Mankachar","Tinsukia","Udalguri","West Karbi Anglong"];
var Bihar = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur","Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa","Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"];
var Chhattisgarh = ["Balod","Baloda Bazar","Balrampur","Bastar","Bemetara","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Gariaband","Janjgir Champa","Jashpur","Kabirdham","Kanker","Kondagaon","Korba","Koriya","Mahasamund","Mungeli","Narayanpur","Raigarh","Raipur","Rajnandgaon","Sukma","Surajpur","Surguja"];
var Goa = ["North Goa","South Goa"];
var Gujarat = ["Ahmedabad","Amreli","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Botad","Chhota Udaipur","Dahod","Dang","Devbhoomi Dwarka","Gandhinagar","Gir Somnath","Jamnagar","Junagadh","Kheda","Kutch","Mahisagar","Mehsana","Morbi","Narmada","Navsari","Panchmahal","Patan","Porbandar","Rajkot","Sabarkantha","Surat","Surendranagar","Tapi","Vadodara","Valsad"];
var Haryana = ["Ambala","Bhiwani","Charkhi Dadri","Faridabad","Fatehabad","Gurugram","Hisar","Jhajjar","Jind","Kaithal","Karnal","Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamunanagar"];
var HimachalPradesh = ["Bilaspur","Chamba","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul Spiti","Mandi","Shimla","Sirmaur","Solan","Una"];
var JammuKashmir = ["Anantnag","Bandipora","Baramulla","Budgam","Doda","Ganderbal","Jammu","Kargil","Kathua","Kishtwar","Kulgam","Kupwara","Leh","Poonch","Pulwama","Rajouri","Ramban","Reasi","Samba","Shopian","Srinagar","Udhampur"];
var Jharkhand = ["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribagh","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu","Ramgarh","Ranchi","Sahebganj","Seraikela Kharsawan","Simdega","West Singhbhum"];
var Karnataka = ["Bagalkot","Bangalore Rural","Bangalore Urban","Belgaum","Bellary","Bidar","Vijayapura","Chamarajanagar","Chikkaballapur","Chikkamagaluru","Chitradurga","Dakshina Kannada","Davanagere","Dharwad","Gadag","Gulbarga","Hassan","Haveri","Kodagu","Kolar","Koppal","Mandya","Mysore","Raichur","Ramanagara","Shimoga","Tumkur","Udupi","Uttara Kannada","Yadgir"];
var Kerala = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad"];
var MadhyaPradesh = ["Agar Malwa","Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Datia","Dewas","Dhar","Dindori","Guna","Gwalior","Harda","Hoshangabad","Indore","Jabalpur","Jhabua","Katni","Khandwa","Khargone","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Raisen","Rajgarh","Ratlam","Rewa","Sagar","Satna",
"Sehore","Seoni","Shahdol","Shajapur","Sheopur","Shivpuri","Sidhi","Singrauli","Tikamgarh","Ujjain","Umaria","Vidisha"];
var Maharashtra = ["Ahmednagar","Akola","Amravati","Aurangabad","Beed","Bhandara","Buldhana","Chandrapur","Dhule","Gadchiroli","Gondia","Hingoli","Jalgaon","Jalna","Kolhapur","Latur","Mumbai City","Mumbai Suburban","Nagpur","Nanded","Nandurbar","Nashik","Osmanabad","Palghar","Parbhani","Pune","Raigad","Ratnagiri","Sangli","Satara","Sindhudurg","Solapur","Thane","Wardha","Washim","Yavatmal"];
var Manipur = ["Bishnupur","Chandel","Churachandpur","Imphal East","Imphal West","Jiribam","Kakching","Kamjong","Kangpokpi","Noney","Pherzawl","Senapati","Tamenglong","Tengnoupal","Thoubal","Ukhrul"];
var Meghalaya = ["East Garo Hills","East Jaintia Hills","East Khasi Hills","North Garo Hills","Ri Bhoi","South Garo Hills","South West Garo Hills","South West Khasi Hills","West Garo Hills","West Jaintia Hills","West Khasi Hills"];
var Mizoram = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip","Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"];
var Nagaland = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];
var Odisha = ["Angul","Balangir","Balasore","Bargarh","Bhadrak","Boudh","Cuttack","Debagarh","Dhenkanal","Gajapati","Ganjam","Jagatsinghpur","Jajpur","Jharsuguda","Kalahandi","Kandhamal","Kendrapara","Kendujhar","Khordha","Koraput","Malkangiri","Mayurbhanj","Nabarangpur","Nayagarh","Nuapada","Puri","Rayagada","Sambalpur","Subarnapur","Sundergarh"];
var Punjab = ["Amritsar","Barnala","Bathinda","Faridkot","Fatehgarh Sahib","Fazilka","Firozpur","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Mohali","Muktsar","Pathankot","Patiala","Rupnagar","Sangrur","Shaheed Bhagat Singh Nagar","Tarn Taran"];
var Rajasthan = ["Ajmer","Alwar","Banswara","Baran","Barmer","Bharatpur","Bhilwara","Bikaner","Bundi","Chittorgarh","Churu","Dausa","Dholpur","Dungarpur","Ganganagar","Hanumangarh","Jaipur","Jaisalmer","Jalore","Jhalawar","Jhunjhunu","Jodhpur","Karauli","Kota","Nagaur","Pali","Pratapgarh","Rajsamand","Sawai Madhopur","Sikar","Sirohi","Tonk","Udaipur"];
var Sikkim = ["East Sikkim","North Sikkim","South Sikkim","West Sikkim"];
var TamilNadu = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Nagapattinam","Namakkal","Nilgiris","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Theni","Thoothukudi","Tiruchirappalli","Tirunelveli","Tiruppur","Tiruvallur","Tiruvannamalai","Tiruvarur","Vellore","Viluppuram","Virudhunagar"];
var Telangana = ["Adilabad","Bhadradri Kothagudem","Hyderabad","Jagtial","Jangaon","Jayashankar","Jogulamba","Kamareddy","Karimnagar","Khammam","Komaram Bheem","Mahabubabad","Mahbubnagar","Mancherial","Medak","Medchal","Nagarkurnool","Nalgonda","Nirmal","Nizamabad","Peddapalli","Rajanna Sircilla","Ranga Reddy","Sangareddy","Siddipet","Suryapet","Vikarabad","Wanaparthy","Warangal Rural","Warangal Urban","Yadadri Bhuvanagiri"];
var Tripura = ["Dhalai","Gomati","Khowai","North Tripura","Sepahijala","South Tripura","Unakoti","West Tripura"];
var UttarPradesh = ["Agra","Aligarh","Allahabad","Ambedkar Nagar","Amethi","Amroha","Auraiya","Azamgarh","Baghpat","Bahraich","Ballia","Balrampur","Banda","Barabanki","Bareilly","Basti","Bhadohi","Bijnor","Budaun","Bulandshahr","Chandauli","Chitrakoot","Deoria","Etah","Etawah","Faizabad","Farrukhabad","Fatehpur","Firozabad","Gautam Buddha Nagar","Ghaziabad","Ghazipur","Gonda","Gorakhpur","Hamirpur","Hapur","Hardoi","Hathras","Jalaun","Jaunpur","Jhansi","Kannauj","Kanpur Dehat","Kanpur Nagar","Kasganj","Kaushambi","Kheri","Kushinagar","Lalitpur","Lucknow","Maharajganj","Mahoba","Mainpuri","Mathura","Mau","Meerut","Mirzapur","Moradabad","Muzaffarnagar","Pilibhit","Pratapgarh","Raebareli","Rampur","Saharanpur","Sambhal","Sant Kabir Nagar","Shahjahanpur","Shamli","Shravasti","Siddharthnagar","Sitapur","Sonbhadra","Sultanpur","Unnao","Varanasi"];
var Uttarakhand  = ["Almora","Bageshwar","Chamoli","Champawat","Dehradun","Haridwar","Nainital","Pauri","Pithoragarh","Rudraprayag","Tehri","Udham Singh Nagar","Uttarkashi"];
var WestBengal = ["Alipurduar","Bankura","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah","Jalpaiguri","Jhargram","Kalimpong","Kolkata","Malda","Murshidabad","Nadia","North 24 Parganas","Paschim Bardhaman","Paschim Medinipur","Purba Bardhaman","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"];
var AndamanNicobar = ["Nicobar","North Middle Andaman","South Andaman"];
var Chandigarh = ["Chandigarh"];
var DadraHaveli = ["Dadra Nagar Haveli"];
var DamanDiu = ["Daman","Diu"];
var Delhi = ["Central Delhi","East Delhi","New Delhi","North Delhi","North East Delhi","North West Delhi","Shahdara","South Delhi","South East Delhi","South West Delhi","West Delhi"];
var Lakshadweep = ["Lakshadweep"];
var Puducherry = ["Karaikal","Mahe","Puducherry","Yanam"];


$("#inputState").change(function(){
  var StateSelected = $(this).val();
  var optionsList;
  var htmlString = "";
  
  switch (StateSelected) {
    case "Andra Pradesh":
        optionsList = AndraPradesh;
        break;
    case "Arunachal Pradesh":
        optionsList = ArunachalPradesh;
        break;
    case "Assam":
        optionsList = Assam;
        break;
    case "Bihar":
        optionsList = Bihar;
        break;
    case "Chhattisgarh":
        optionsList = Chhattisgarh;
        break;
    case "Goa":
        optionsList = Goa;
        break;
    case  "Gujarat":
        optionsList = Gujarat;
        break;
    case "Haryana":
        optionsList = Haryana;
        break;
    case "Himachal Pradesh":
        optionsList = HimachalPradesh;
        break;
    case "Jammu and Kashmir":
        optionsList = JammuKashmir;
        break;
    case "Jharkhand":
        optionsList = Jharkhand;
        break;
    case  "Karnataka":
        optionsList = Karnataka;
        break;
    case "Kerala":
        optionsList = Kerala;
        break;
    case  "Madya Pradesh":
        optionsList = MadhyaPradesh;
        break;
    case "Maharashtra":
        optionsList = Maharashtra;
        break;
    case  "Manipur":
        optionsList = Manipur;
        break;
    case "Meghalaya":
        optionsList = Meghalaya ;
        break;
    case  "Mizoram":
        optionsList = Mizoram;
        break;
    case "Nagaland":
        optionsList = Nagaland;
        break;
    case  "Orissa":
        optionsList = Orissa;
        break;
    case "Punjab":
        optionsList = Punjab;
        break;
    case  "Rajasthan":
        optionsList = Rajasthan;
        break;
    case "Sikkim":
        optionsList = Sikkim;
        break;
    case  "Tamil Nadu":
        optionsList = TamilNadu;
        break;
    case  "Telangana":
        optionsList = Telangana;
        break;
    case "Tripura":
        optionsList = Tripura ;
        break;
    case  "Uttaranchal":
        optionsList = Uttaranchal;
        break;
    case  "Uttar Pradesh":
        optionsList = UttarPradesh;
        break;
    case "West Bengal":
        optionsList = WestBengal;
        break;
    case  "Andaman and Nicobar Islands":
        optionsList = AndamanNicobar;
        break;
    case "Chandigarh":
        optionsList = Chandigarh;
        break;
    case  "Dadar and Nagar Haveli":
        optionsList = DadraHaveli;
        break;
    case "Daman and Diu":
        optionsList = DamanDiu;
        break;
    case  "Delhi":
        optionsList = Delhi;
        break;
    case "Lakshadeep":
        optionsList = Lakshadeep ;
        break;
    case  "Pondicherry":
        optionsList = Pondicherry;
        break;
   
}
if(StateSelected !=""){
     for(var i = 0; i < optionsList.length; i++){
    htmlString = htmlString+"<option value='"+ optionsList[i] +"'>"+ optionsList[i] +"</option>";
  }
  $("#inputDistrict").html(htmlString);
}
 

});






</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>