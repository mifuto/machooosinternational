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
    
    if (strpos($userPermissionsList, 'Wedding-Films') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>WEDDING FILMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Wedding films</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="weddingFilmsFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT">Add wedding film</h5>

              <!-- General Form Elements -->
              <!-- <form id="addEventForm" class="needs-validation" novalidate> -->
              <form id="addWeddingFilmForm"  >
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
                            Please select a user!.
                            </div>
                        </div>
                        </div>
                        
                    </div>
                    
                   
                   
                </div> 
                
                <div class="row mb-3">
                    <label for="" class="col-sm-6 col-form-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="eventTitle" name="eventTitle">
                        <div class="invalid-feedback">
                        Please enter the title!.
                        </div>
                    </div>
                </div>
                
                  
                <div class="row mb-3">
                    <label for="" class="col-sm-6 col-form-label">Small description</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="eventDescription" name="eventDescription">
                        <div class="invalid-feedback">
                        Please enter the description!.
                        </div>
                    </div>
                </div>
                
                  <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                    <label for="EventCoverImgFile" class="col-form-label" style="padding-left: 0;">Cover Image</label>
                    <input type="file" id="EventCoverImgFile" name="EventCoverImgFile[]" accept="image/*" multiple>
                    <div class="text-danger" id="EventCoverImgFilerr"></div>
                  </div>
                
                <div class="row mb-3">
                    <label for="" class="col-sm-12 col-form-label">Upload Video</label>
                    <div class="col-sm-3">
                        <select class="form-control select2" aria-label="Default select example" id="vedioType" name="vedioType" onchange="changeVedioType();">
                            <option selected value="url">URL</option>
                            <option value="upv">Upload Video</option>
                            
                        </select>
                    </div>
                    <div class="col-sm-9" id="urlDiv">
                        <input type="text" class="form-control" id="eventURL" name="eventURL" placeholder="Enter url address">
                        <div class="invalid-feedback">
                        Please enter the url!.
                        </div>
                    </div>
                    
                     <div class="col-sm-9 d-none" id="uploadDiv">
                        <input type="file" class="form-control" id="eventUpload" name="eventUpload" accept="video/*">
                        <div class="invalid-feedback">
                        Please upload vedio !.
                        </div>
                    </div>
                </div>
                
                
                
                
                
                <div class="row mb-3 mt-5">
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-danger d-none" id="weddingAlbumUploadsStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <button type="button" class="btn btn-danger" onclick="cancelWeddingForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>



    <section id="weddingFilmsListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h5 class="card-title">Wedding films</h5>
                </div>

                <div class="col-sm-3 pt-4 " >
                    <select class="select2" aria-label="Default select example" id="sel_user" name="sel_user" onchange="getWeddingFilms();">
                    <option value="" selected>Select User</option>
                     </select>
                 
                </div>
                
                <div class="col-sm-6 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddFilmsSection();">Add New Film</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">User</th>
                      <th scope="col">Title</th>
                      <th scope="col">Small Description</th>
                      <th scope="col">Cover</th>
                      <th scope="col">Wedding film</th>
                      <th scope="col">Responses</th>
                      <th scope="col">Created on</th>
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

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      getusers("usersList");
      getWeddingFilms();
      getusers("sel_user");
      $('#usersList').select2();
      $('#sel_user').select2();
      
       $('#EventCoverImgFile').imageuploadify();
  });
  
  
  function showAddFilmsSection(){
      
      emptyForm();
      

     
    $("#weddingFilmsListSection").addClass("d-none");
        $('#addEVT').html('Add wedding film');
        
       
        $('#weddingFilmsFormSection').removeClass("d-none");
      
  }
  
  function editWeddingFilm(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

       $('#uploadStatus').html('');
       
       $("#weddingAlbumUploadsStatus").width('0%');
        $("#weddingAlbumUploadsStatus").html('0%');
     
        $('#addEVT').html('Update wedding film');
          $('#weddingFilmsFormSection').removeClass("d-none");
                $("#weddingFilmsListSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $("#usersList").val(eventList['user_id']).trigger('change');
                $("#eventTitle").val(eventList['tittle']);
               $("#eventDescription").val(eventList['sub_tittle']);
               $("#vedioType").val(eventList['video_type']);
               $("#oldType").val(eventList['video_type']);
               $("#eventURL").val(eventList['orginal_url']);
               changeVedioType();

            }
           
            
          
        }
        data = { "function": 'WeddingFilms',"method": "getEditWeddingFilm" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  function emptyForm(){
       $("#usersList").val("").trigger('change');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       $("#eventTitle").val("");
       $("#eventDescription").val("");
       $("#vedioType").val('url');
       $("#eventURL").val("");
       $("#eventUpload").val("");
       $("#oldType").val('url');
       
       $("#EventCoverImgFile").val("");
       $('.ri-close-circle-line').click();
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

       $('#uploadStatus').html('');
       
       $("#weddingAlbumUploadsStatus").width('0%');
        $("#weddingAlbumUploadsStatus").html('0%');
  }
  
  function cancelWeddingForm(){
      emptyForm();
      $('#weddingFilmsFormSection').addClass("d-none");
      $("#weddingFilmsListSection").removeClass("d-none");
  }
  
  function changeVedioType(){
      var sel_type = $("#vedioType").val();
      if(sel_type == "url") {
         $('#uploadDiv').addClass("d-none");
        $("#urlDiv").removeClass("d-none");
      }else{
          $('#urlDiv').addClass("d-none");
            $("#uploadDiv").removeClass("d-none");
      }
  }
  
  
  $("#addWeddingFilmForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        if(sel_type == "url") {
        
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
        var sel_type = $("#vedioType").val();
        var oldType = $("#oldType").val();
        
        
        
        
        
        if(sel_type == "url") {
            var urlVal = $("#eventURL").val();
            if(urlVal == ""){
                $("#eventURL").focus();
                $("#eventURL").addClass('is-invalid');
                return false;
            }
        }else{
            
            if( save == 'add'  ){
                var fileInput = $('#eventUpload');
                if (fileInput.val() === '') {
                    $("#eventUpload").focus();
                    $("#eventUpload").addClass('is-invalid');
                    return false;
                }
                
            }else{
                if(oldType == 'url'){
                    var fileInput = $('#eventUpload');
                    if (fileInput.val() === '') {
                        $("#eventUpload").focus();
                        $("#eventUpload").addClass('is-invalid');
                        return false;
                    }
                }
            }
            
           
            
        }
        
        var form = $("#addWeddingFilmForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'WeddingFilms');
        formData.append('method', 'saveFilm');

        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this film",
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
                                $('#weddingAlbumUploadsStatus').removeClass('d-none');
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
                                        title: "Wedding film "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getWeddingFilms();
                                    
                                    $("#eventListSection").removeClass("d-none");
                                    $('#eventFormSection').addClass("d-none");
                                    
                                    $('#weddingFilmsFormSection').addClass("d-none");
                                    $("#weddingFilmsListSection").removeClass("d-none");
                                    
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
        usersList: {
            required: true
        },
        eventTitle: {
            required: true
        },
        eventDescription: {
            required: true
        }
    
    },
    messages: {
        usersList: {
            required: "Please select the User"
        },
        eventTitle: {
            required: "Please enter the title"
        },
        eventDescription: {
            required: "Please enter small description"
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


function getWeddingFilms(){
     var sel_user =  $('#sel_user').val();

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
              {"data":null,"render":function(item){
                return item.firstname+' '+item.lastname;
                    
                    }
                },
              { "data": "tittle" },
              
                {"data":null,"render":function(item){
                  
                   var description = item.sub_tittle;
    
                    // Set the maximum length for the text
                    var maxLength = 60;
                
                    // Trim the text and add ellipsis if needed
                    var trimmedText = description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
              
                  return trimmedText;
                
                    
                    }
                },
              
              
              
            //   { "data": "sub_tittle" },
               { "data": "cover_image", 
                  render: function ( data ) {
                    return '<image width="250px" height="auto" src="'+data+'"></image>';
                }
              },
              { "data": "video_upload", 
                  render: function ( data ) {
                    return '<iframe width="250px" height="auto" src="' + data + '" autoplay="false"></iframe>';
                }
              },
               {"data":null,"render":function(item){
                   var $ds = item.commentCounts+" Cmts";
                   $ds += "<br>"+item.shareCounts+" Shares";
                   $ds += "<br>"+item.viewsCounts+" Views";
                return $ds;
                    
                    }
                },
              { "data": "created_date" },
              {"data":null,"render":function(item){
                return '<span class="badge bg-info text-dark" onclick="editWeddingFilm('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteFilm('+item.id+');" style="cursor:pointer">delete</span>';
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'WeddingFilms',"method": "getWeddingFilms" ,"sel_user":sel_user };
    
    apiCall(data,successFn);
}

function deleteFilm(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this wedding film",
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
                            getWeddingFilms();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'WeddingFilms',"method": "deleteFilm" ,"sel_id":id };
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