<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Website') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}

?>

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

.rounded-label-active {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 20px;
  background-color: green;
  color: white;
}

.rounded-label-in-active {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 20px;
  background-color: red;
  color: white;
  align-items: right;
}

.containerdlt {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .3s ease;
  background-color: white;
}

.containerdlt:hover .overlay {
  opacity: .3;
}

.icon {
  color: red;
  font-size: 100px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.fa-user:hover {
  color: #eee;
}
</style>

<div class="pagetitle">
    <h1> STORIES</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item">Website</li>
        <li class="breadcrumb-item active"><a class="" href="javascript:void(0);" role="button" onclick="addStory()">Add Stories</a></li>
    </ol>
    </nav>
</div>

<section class="section">
      <div class="row">
          
          
          <div class="col-lg-12 d-none" id="addStoryModal">

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <h5 class="card-title" id="card_main_title">Add Story</h5>
                  </div>
                  
                  <div class="col-sm-12 pt-3">
                      
                       <form id="form_story" >
                           
                              <div >
                    
                                  <div class="row mt-3 mb-2 form-group">
                                      <label for="event_date" class="col-sm-2 col-form-label mt-2">Event date</label>
                                      <div class="col-sm-10 form-group ">
                                        <input type="date" class="form-control" id="event_date" name="event_date">
                                      </div>
                                    </div>
                                  
                                    <div class="row mb-2 ">
                                      <label for="event_place" class="col-sm-2 col-form-label">Event place</label>
                                      <div class="col-sm-10  form-group ">
                                        <input type="text" class="form-control" id="event_place" name="event_place" />
                                      </div>
                                    </div>
                                 
                                    <div class="row mb-2 ">
                                      <label for="main_tittle" class="col-sm-2 col-form-label">Main tittle</label>
                                      <div class="col-sm-10  form-group ">
                                        <input type="text" class="form-control" id="main_tittle" name="main_tittle" />
                                      </div>
                                    </div>
                    
                                    <div class="row mb-2">
                                      <label for="small_description" class="col-sm-2 col-form-label">Small description</label>
                                      <div class="col-sm-10  form-group">
                                        <textarea class="form-control" style="height: 100px" id="small_description" name="small_description"></textarea>
                                      </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                     <div class="row mb-3">
                                    
                                        
                                         <div class="col-4">
                                        
                                        
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
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        <div class="col-4">
                                        
                                        
                                             <div class="row mb-3">
                                                <label for="" class="col-12 col-form-label">State</label>
                                               
                                                <div class="col-12">
                                                    
                                                     <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" multiple>
                                                        </select>
                                                    
                                                    
                                                    
                                                    <div class="invalid-feedback">
                                                    Please select the State!.
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                            
                                        <div class="col-4 d-none">
                                        
                                        
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
                                        </div>
                                        
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                    
                                      <div class="row mb-3">
                                      <label for="small_description" class="col-sm-2 col-form-label">File</label>
                                      <div class="col-sm-2  form-group" >
                                        <select  class="form-control" onchange="changeImageVideo(this.value)" id="FileImageVideo" name="FileImageVideo">
                                          <option value="1">Image</option>
                                          <option value="0">Video</option>
                                        </select>
                                      </div>
                                      <div class="col-sm-8  form-group " id="Div_Image">
                                        <input class="form-control" type="file" id="image_story" name="image_story"  />
                                      </div>
                    
                                      <div class="col-sm-2  form-group d-none" id="Div_Video">
                    
                                         <select  class="form-control" onchange="changeVideoYoutube(this.value)" id="FileVideoURL" name="FileVideoURL" >
                                          <option value="1">URL</option>
                                          <option value="0">Select File</option>
                                        </select>
                                      </div>
                    
                                        <div class="col-sm-6 form-group d-none" id="Div_Video_url">
                                          <input class="form-control" type="text" id="import_url" name="import_url"   />
                                        </div>
                    
                                        <div class="col-sm-6 form-group d-none" id="Div_Video_link">
                                          <input class="form-control" type="file" id="import_video" name="import_video"  accept="video/*"    />
                                        </div>
                                      </div>
                    
                    
                                      <div class="row mb-2 ">
                                      <label class="col-sm-2 col-form-label"></label>
                                      <div class="col-sm-10  form-group ">
                                        
                                        <input  type="hidden" id="id" name="id" >
                                              <input  type="hidden" id="save" name="save" >
                    
                    
                                        
                    
                                      </div>
                                    </div>
                               
                    
                    
                              
                              </div>
                              <div align="right">
                              
                                <button type="button" class="btn btn-secondary" onclick="closeAddModel();">Close</button>
                                <input  type="submit" id="SubmitButton" class="btn btn-primary" value="Save">
                                <button class="btn btn-primary d-none"  id="LoadingBtn" disabled>
                                          <span class="spinner-border spinner-border-sm"></span>
                                            Please Wait...
                                        </button>
                                
                              </div>
                          </form>

                  </div>
                
                  

                 

                </div>
                
               
              </div>
            </div>

        </div>
          
          
          
          
          

        <div class="col-lg-12 d-none" id="viewStoriesDIV">

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8">
                    <h5 class="card-title" id="card_main_title">Storie Details</h5>
                  </div>
                  <div class="col-sm-4 pt-3 " align="right">
                    <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addSubImg()">Add Images</a>
                    <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="hideviewStory()">Cancel</a>
                  </div>
                  <div class="col-sm-12 pt-3" id="viewStoriesDIVData">

                  </div>

                  <div class="col-sm-12 pt-3" id="viewStoriesDIVIMGLIST">

                  </div>

                  <div class="pt-4 pb-4" id="viewStoriesDIVIMGLISTEmptyData">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                      <div>
                          No images available !
                      </div>
                    </div>
                  </div>

                </div>
                
               
              </div>
            </div>

        </div>



        <div class="col-lg-12" id="viewListStoriesDIV">

            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8">
                    <h5 class="card-title" id="card_main_title">Recent Stories</h5>
                  </div>
                  <div class="col-sm-4 pt-3 " align="right">
                    <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addStory()">Add Story</a>
                  </div>
                  
                  
                   <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                       <th>#</th>
                      <th>Name</th>
                      
                         <th scope="col">County</th>
                      <th scope="col">State</th>
                      <!--<th scope="col">District</th>-->
                    
                      <th>Small Desc</th>
                      <th>Photoplay</th>
                      <th>Action</th>
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
    </div>
</section>




<div class="modal fade" id="addStoryIMGModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"  >
      <div class="modal-header">
        <h5 class="modal-title">Add Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addImgForm" >
          <div class="modal-body" >

          
            <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;">
                <label for="" class="col-form-label" style="padding-left: 0;"> Images</label>
                <input type="file" id="StoryImgFiles" name="StoryImgFiles[]" accept="image/*,.zip" multiple>
                <div class="text-danger" id="StoryImgFilesErr"></div>
              </div>

              <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-danger d-none" id="ImgUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div id="uploadStatus"></div>

             

          
          </div>
          <div class="modal-footer">
          
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="SubmitButton">Add</button>
              <button class="btn btn-primary d-none"  id="LoadingBtn" disabled>
                      <span class="spinner-border spinner-border-sm"></span>
                        Please Wait...
                    </button>
            
          </div>
      </form>
    </div>
  </div>
</div>


<?php 

include("templates/footer.php")

?>

<script type="text/javascript">
  var editIMGID = "";
  $(document).ready(function() {
    // addStory();
    $('#StoryImgFiles').imageuploadify();
    getStories();
  });
  
   getCounty("selCounty");
       getState('selState');
       getCity('selCity');
       
       
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
        options += "<option value='"+value.id+"'>"+value.state+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
      if(val !="")$("#selState").val(val).trigger('change');
      
    
      
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

  
       
       

  function getSubIMG(id){

    successFn = function(resp) {

    var html1 = '<div class="row">';

    for(var i=0;i<resp.data.SRV.length;i++){

        html1 +='<div class="col-sm-3"><div class="containerdlt"><img src="'+resp.data.SRV[i]['file_path']+'" alt="Avatar" class="image"><div class="overlay"><a href="#" onclick="deleteFile('+resp.data.SRV[i]['id']+','+id+')" class="icon" title="Delete"> <i class="bi bi-trash"></i> </a> </div></div> </div>';


    }

    html1 +='</div>';

    if(resp.data.SRV.length > 0){
      $("#viewStoriesDIVIMGLIST").html(html1);
      $('#viewStoriesDIVIMGLISTEmptyData').addClass('d-none');

    }else{
      $("#viewStoriesDIVIMGLIST").html("");
      $('#viewStoriesDIVIMGLISTEmptyData').removeClass('d-none');
    }

    }
    data = { "function": 'Stories',"method": "getStorysIMgfiles","id":id };
    apiCall(data,successFn);

  }

  function deleteFile(id,callback){
    return new swal({
        title: "Are you sure?",
        text: "You want to delete this image",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Yes'
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
                successFn = function(resp) {
                if(resp.status==1){
                    // alert('Blog Deleted Successfully');
                    Swal.fire({
                    title: 'Image Removed Successfully',
                    timer: 1500
                    });
                    viewStory(editIMGID);
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error while deleting the image',
                    });
                    // alert('Failed in deleting record');
                }
                // alert(resp.data);
                }
                data = { "function": 'Stories',"method": "deleteStorysIMgfile" ,"id": id };
                apiCall(data,successFn);
                        
            }
        });
  }

  function addSubImg(){
    $("#addStoryIMGModal").modal('show');

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    $('#addImgForm').removeClass('was-validated');
    $('.ri-close-circle-line').click();
    $("#ImgUploadStatus").width('0%');
    $("#ImgUploadStatus").html('0%');

    $('#addImgForm').validate({
      ignore: [],
      submitHandler: function(form) {
        var StoryImgFiles = $('#StoryImgFiles')[0].files;

        if(StoryImgFiles.length == 0){
            $("#StoryImgFilesErr").html("Plese upload the images (zip or images)!.");
            return false;
        }else{
            $("#StoryImgFilesErr").html("");
        }


        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');


        var form = $("#addImgForm");
        var data = new FormData(form[0]);
        data.append('function', 'Stories');
        data.append('method', 'addImages');
        data.append('save', save);
        data.append('id',editIMGID );


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
            data: data,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                $('#ImgUploadStatus').removeClass('d-none');
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
                        title: "Successfully add images.",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#SubmitButton').removeClass('d-none');
                    $('#LoadingBtn').addClass('d-none');
                    viewStory(editIMGID);
                    $("#addStoryIMGModal").modal('hide');

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: resp.data,
                        showConfirmButton: false,
                        timer: 1500
                    });
                   
                    $('#SubmitButton').removeClass('d-none');
                    $('#LoadingBtn').addClass('d-none');
                }
                
            }
        });

       
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

  }

  function viewStory(id){
    $('#viewStoriesDIV').removeClass('d-none');
    $('#viewListStoriesDIV').addClass('d-none');
    $('#viewStoriesDIVData').html("");
    editIMGID = id ;
    getSubIMG(id);

    successFn = function(resp) {

      var tabContents = '<div class="row">';
      tabContents += '<div class="col-sm-4">';

      if(resp.data.Story["image_story"]==''){
        if(resp.data.Story["video"] !=''){
          tabContents += '<iframe width="100%" height="auto" src="'+resp.data.Story["video"]+'"></iframe>';
        }

      }else{
        tabContents += '<img src="'+resp.data.Story["image_story"]+'" class="card-img-top" alt="">';
      }
      tabContents += '</div>';

      tabContents += '<div class="col-sm-8">';

      tabContents += '<h5 class="card-title">'+resp.data.Story["main_tittle"]+'</h5>';
      tabContents += '<label >'+resp.data.Story["small_description"]+'</label><br>';

      tabContents += '<br><label >'+resp.data.Story["event_date"]+'</label><br>';
      tabContents += '<label >'+resp.data.Story["event_place"]+'</label><br>';

      tabContents += '</div>';

      tabContents += '</div>';
      $('#viewStoriesDIVData').html(tabContents);

    }
    data = { "function": 'Blog',"method": "getStory","id":id };
    apiCall(data,successFn);



  }

  function hideviewStory(id){
    $('#viewStoriesDIV').addClass('d-none');
    $('#viewListStoriesDIV').removeClass('d-none');
  }

  function changeImageVideo(val){
    if(val==0){
      $('#Div_Image').addClass('d-none');

      $('#Div_Video').removeClass('d-none');
      $('#Div_Video_url').removeClass('d-none');

    }else{
      $('#Div_Video_url').addClass('d-none');
      $('#Div_Video').addClass('d-none');

      $('#Div_Image').removeClass('d-none');

    }


  }

  

  function changeVideoYoutube(val){
    if(val==0){
      $('#Div_Video_url').addClass('d-none');
      $('#Div_Video_link').removeClass('d-none');

    }else{
      $('#Div_Video_link').addClass('d-none');
      $('#Div_Video_url').removeClass('d-none');

    }


  }
  
  function closeAddModel(){
      
        $("#addStoryModal").addClass('d-none');
            $("#viewStoriesDIV").addClass('d-none');
    $("#viewListStoriesDIV").removeClass('d-none');
      
  }

  function addStory(save='add',id=''){

    $("#addStoryModal").removeClass('d-none');
    
    $("#viewStoriesDIV").addClass('d-none');
    $("#viewListStoriesDIV").addClass('d-none');

    $('#id').val(id);
    $('#save').val(save);

    if(save=='add'){
      $('#event_date').val('');
      $('#event_place').val('');
      $('#main_tittle').val('');
      $('#description').val('');
      $('#small_description').val('');
      
      
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#selCity").val("").trigger('change');
    }

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    $('#form_story').validate({
      ignore: [],
      submitHandler: function(form) {
        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');
        
        
          var mulSel = $('#selState').val();
        if(mulSel == ''){
            $('#selState').addClass('is-invalid');
            return false;
        }
        $('#selState').removeClass('is-invalid');

        var form = $("#form_story");
        var data = new FormData(form[0]);
        data.append('function', 'Blog');
        data.append('method', 'addStory');
        data.append('description', "");
        // data.append('id',id);
        data.append('multipleSel', mulSel);

        successFn = function(resp)  {
          if(resp.status==1){
            Swal.fire({
              title: 'Story Saved Successfully',
              timer: 1500
            });
            getStories();
            $("#addStoryModal").addClass('d-none');
            $("#viewStoriesDIV").addClass('d-none');
    $("#viewListStoriesDIV").removeClass('d-none');
           
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Error while saving the story',
            });
            $('#LoadingBtn').addClass('d-none');
            $('#SubmitButton').removeClass('d-none');

          }
          // getDescriptions();
        }
        apiCallForm(data,successFn);
      },

      rules: {
        event_date:{ 
          required: true, 
        },
        event_place:{ 
          required: true, 
        },
        main_tittle:{ 
          required: true, 
        },
        // image_story:{ 
        //   required: true, 
        // },
        small_description:{ 
          required: true, 
        },
             selCounty: {
            required: true
        },
        selState: {
            required: true
        },
        // selCity: {
        //     required: true
        // },
       
      },
      messages: {
        event_date:{ 
          required: "Please enter the date ", 
        },
        event_place:{ 
          required: "Please enter the place", 
        },
        main_tittle:{ 
          required: "Please enter the title", 
        },
        image_story:{ 
          required: "Please select an image", 
        },
      
        small_description:{ 
          required: "Please enter the small  description", 
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


  }

  function editStory(id){
    addStory('update',id);
    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
    successFn = function(resp) {
      $('#import_url').val('');
      $('#event_date').val(resp.data.Story['event_date']);
      $('#event_place').val(resp.data.Story['event_place']);
      $('#main_tittle').val(resp.data.Story['main_tittle']);
      // $('#description').val(resp.data.Story['description']);
      $('#small_description').val(resp.data.Story['small_description']);
      
      
         $("#selCounty").val(resp.data.Story['county_id']).trigger('change');
         var valuesArray = resp.data.Story['state_id'].split(',').map(Number);
        
        getState('selState',valuesArray);
        // getCity('selCity',resp.data.Story['city_id'],resp.data.Story['state_id']);
      
      
      

      // if(resp.data.Story['image_story']!=''){
      //   $('#image_story').rules('remove', 'required');
      // }

      if(resp.data.Story['image_story']!=''){

        $('#FileImageVideo').val(1).trigger('change');
      }else{
        $('#FileImageVideo').val(0).trigger('change');
        // alert(resp.data.Story['video']);
        st=(resp.data.Story['video']).substring(0,10);
        // alert(st);
        if(st!='storyImage'){
          // alert(st);
          $('#FileVideoURL').val(1).trigger('change');

          st2= (resp.data.Story['video']).replace("embed/", "watch?v=");

          $('#import_url').val(st2);

        }else{
          setTimeout( function() {
          $('#FileVideoURL').val(0).trigger('change');

          }, 1000); 



        }
      }



    }
    data = { "function": 'Blog',"method": "getStory","id":id };
    apiCall(data,successFn);


  }

  function getStories(){
      
      
      
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
            
              
              { "data": "main_tittle" },
              { "data": "county_id" },
              { "data": "state_id" },
            //   { "data": "city_id" },
              
               {"data":null,"render":function(item){
                  
                   var description = item.small_description;
    
                    // Set the maximum length for the text
                    var maxLength = 60;
                
                    // Trim the text and add ellipsis if needed
                    var trimmedText = description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
              
                  return trimmedText;
                
                    
                    }
                },
              
              
               
              
              {"data":null,"render":function(item){
                  
                  if(item.image_story == ''){
                      if(item.video !="") return '<iframe width="250px" height="auto" src="'+item.video+'"></iframe>';
                  }else{
                      return '<img src="'+item.image_story+'" width="150px" script="max-height:100px" />';
                  }
                  
                
                    
                    }
                },
             
              
              
              
              {"data":null,"render":function(item){
                  var str = '<span class="badge bg-primary text-white" onclick="viewStory('+item.id+');" style="cursor:pointer">view</span><span class="badge bg-info text-white" onclick="editStory('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteStory('+item.id+');" style="cursor:pointer">delete</span>';
                  
                  if(item.active == 1){
                      str += '<span class="badge bg-success text-white" onclick="story_inactive('+item.id+');" style="cursor:pointer">active</span>';
                  }else{
                      str += '<span class="badge bg-warning text-white" onclick="story_active('+item.id+');" style="cursor:pointer">in-active</span>';
                  }
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'Blog',"method": "getStories1" };
    
    apiCall(data,successFn);
    
  
     
  }

  function deleteStory(id){

    return new swal({
        title: "Are you sure?",
        text: "You want to delete this story",
        icon: false,
        // buttons: true,
        // dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Yes'
        }).then((confirm) => {
            // console.log(confirm.isConfirmed);
            if (confirm.isConfirmed) {
              successFn = function(resp) {
                if(resp.status==1){
                  // alert('Blog Deleted Successfully');
                  Swal.fire({
                    title: 'Story Removed Successfully',
                    timer: 1500
                  });
                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error while deleting the story',
                  });
                  // alert('Failed in deleting record');
                }
                getStories();
                // alert(resp.data);
              }
              data = { "function": 'Blog',"method": "deleteStory" ,"id": id };
              apiCall(data,successFn);
                
            }else{
               return false;
            }
        });


   
  }


  
  function story_inactive(id){
    successFn = function(resp) {
      getStories();
    }
    data = { "function": 'Blog',"method": "setStoryActiveInactive", "id":id, "active":0};
    apiCall(data,successFn);
  }

  function story_active(id){
    successFn = function(resp) {
      getStories();
    }
    data = { "function": 'Blog',"method": "setStoryActiveInactive", "id":id, "active":1};
    apiCall(data,successFn);
  }


</script>