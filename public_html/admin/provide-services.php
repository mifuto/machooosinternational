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
  background-color: red;
}

.containerdlt:hover .overlay {
  opacity: 1;
}

.icon {
  color: white;
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
      <h1>Services That I Provide</h1>
      <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Website</li>
          <li class="breadcrumb-item active"><a href="provide-services.php">Services That I Provide</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12" id="typeTable">

            <div class="card  d-none" id="detailviewDiv">
                <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="card-title m-0 ">Detail View</h6>
                <div class="  m-0 ">
                    <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addSubImg()">Add Images</a>
                <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="detailviewDivCancel()">Cancel</a>
                </div>

                </div>
                <div class="card-body">

                    <div class="pt-2" id="disDetailContent">
                    </div>
                    <hr/>
                    <div class="pt-2" id="disDetailContentFiles">
                    </div>

                </div>

            </div>



          <div class="card  " id="listviewDiv">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Provide Services</h6>

            
              <div class="  m-0 ">
                <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addNewService()">Add New Service</a>
              </div>

            </div>
            <div class="card-body">
                
                <div class="col-sm-12 table-responsive">
                    <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col"></th>
                        <th scope="col">Name</th>

                          <th scope="col">Country</th>
                          <th scope="col">State</th>
                        <th scope="col">Category</th>
    
                          
                         
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


        <div class="col-lg-12  d-none" id="addNewServiceTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 " id="addRDIT"></h6>
              <div class="   mt-4">
                <a class="btn btn-secondary m-0 " href="javascript:void(0);" role="button" onclick="showNewService()">Cancel</a>
              </div>
            </div>
            <div class="card-body ">


            <form id="createServiceForm" >
            <div class="modal-body" >
                <div class="row mb-2 mt-3">
                  <label for="main_tittle" class="col-sm-2 col-form-label">Service Name</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="main_tittle" name="main_tittle" />
                  </div>
                </div>



              <div class="row mb-2 ">
                <label for="ServiceImgFile" class="col-sm-2 col-form-label">Service Cover Img</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="ServiceCoverImgFile" name="ServiceCoverImgFile[]"  accept="image/*" >
                  <div class="text-danger" id="ServiceCoverImgFilerr"></div>
                </div>
              </div>


              <div class="row mb-3" style="padding-left: 10px;padding-right: 10px;" id="mulImgUpService">
                <label for="" class="col-form-label" style="padding-left: 0;">Service Images</label>
                <input type="file" id="ServiceEventFiles" name="ServiceEventFiles[]" accept="image/*,.zip" multiple>
                <div class="text-danger" id="ServiceEventFilesErr"></div>
              </div>

              <div class="row mb-2 ">
                  <label for="event_place" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="event_place" name="event_place" />
                  </div>
                </div>

             

                <div class="row mb-2 ">
                  <label for="client" class="col-sm-2 col-form-label">Client</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="client" name="client" />
                  </div>
                </div>

                <div class="row mb-2 ">
                  <label for="client" class="col-sm-2 col-form-label">Camera</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="camera" name="camera" />
                  </div>
                </div>
                
                
                
                  
                
                
                
                
                 <div class="row mb-3 ">
                
                    
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
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" onchange="getCategory('category');">
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
                
                
                <div class="row  mb-2 form-group">
                    <label class="col-sm-2 col-form-label mt-2">Category</label>
                    <div class="col-sm-10 form-group ">
                        
                        <select class="form-control select2" aria-label="Default select example" id="category" name="category">
                                    </select>
                        
                      
                    </div>
                </div>
                


                <div class="row mb-2">
                  <label for="small_description" class="col-sm-2 col-form-label">Small description</label>
                  <div class="col-sm-10  form-group">
                    <textarea class="form-control" style="height: 100px" id="small_description" name="small_description"></textarea>
                  </div>
                </div>

                <div class="row mb-2 ">
                  <label for="description" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10  form-group ">
                    <textarea class="form-control" style="height: 100px" id="description" name="description" ></textarea>
                  </div>
                </div>





              <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-danger d-none" id="ServiceUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div id="uploadStatus"></div>
            </div>
            <div class="modal-footer mt-4">

            <input  type="hidden" id="id" name="id" >
                          <input  type="hidden" id="save" name="save" >
          
              <button type="submit" class="btn btn-primary" id="SubmitButton">Save</button>
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
<script src="tinyMce/js/tinymce/tinymce2.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">

var editIMGID = "";
var ImgUploadPath = "";



  $(document).ready(function() {
    $('#ServiceEventFiles').imageuploadify();

    getServices();
    
      
    getCounty("selCounty");
       getState('selState');
       getCity('selCity');
       
       getCategory('category');
       
      $('#StoryImgFiles').imageuploadify();

  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    
    function editServices(id){

    addNewService('update',id);
    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
   
    successFn = function(resp) {

      $('#mulImgUpService').addClass('d-none');
       $('#addRDIT').html('Update Service');
    $('#event_place').val(resp.data.Services['event_place']);
      $('#main_tittle').val(resp.data.Services['main_tittle']);
      $('#description').val(resp.data.Services['description']);
      $('#small_description').val(resp.data.Services['small_description']);

      $('#client').val(resp.data.Services['client']);
      $('#camera').val(resp.data.Services['camera']);
      $('#ServiceCoverImgFile').val('');
      
      
     
      
         $("#selCounty").val(resp.data.Services['county_id']).trigger('change');
        
        // getCity('selCity',resp.data.Services['city_id'],resp.data.Services['state_id']);

        getState('selState',resp.data.Services['state_id'],resp.data.Services['category'],);
        
         
      
      
    

    }
    data = { "function": 'Services',"method": "getaddServices","id":id };
    apiCall(data,successFn);


  }
    
  
  
  function getCategory(selectId,val="",selState ="") {
      if(selState == "0" ) selState = "";
      if(selState == "" ) selState = $('#selState').val();
      
  
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Category</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
      if(val !="")$("#category").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCategoryListData1" ,'selState':selState };
    
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
    //   $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getCountries"};
    
    apiCall(data,successFn);
    
}


  function getState(selectId,val="",val2="") {
      
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
    //   $("#"+selectId).select2();
    
    if(val2 != ""){
        getCategory('category',val2,val)
    }
      
    
      
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
        data.append('function', 'Services');
        data.append('method', 'addImages');
        data.append('save', save);
        data.append('id',editIMGID );
        data.append('uploadDidectory',ImgUploadPath );


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
                    viewProjectEvents(editIMGID);
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
  
  
  


  function detailviewDivCancel(){
    $('#detailviewDiv').addClass('d-none');
    $('#listviewDiv').removeClass('d-none');
    
  }

  function viewProjectEvents(id){
    $('#detailviewDiv').removeClass('d-none');
    $('#listviewDiv').addClass('d-none');
    
    editIMGID = id;

    successFn = function(resp) {

        var html = '<div class="row"><div class="col-sm-4"><img src="'+resp.data.CMA['cover_image_path']+'" class="card-img-top" alt="...">';
        html +='</div><div class="col-sm-8"><ul class="list-group">';
        html +='<li class="list-group-item "><b>Title :</b> '+resp.data.CMA['main_tittle']+'</li>';
        html += '<li class="list-group-item "><b>Category :</b> '+resp.data.CMA['categoryD']+'</li>';
        html +='<li class="list-group-item "><b>Place :</b> '+resp.data.CMA['event_place']+'</li>';
        html +='<li class="list-group-item "><b>Camera :</b> '+resp.data.CMA['camera']+'</li>';
        html +='<li class="list-group-item "><b>Client :</b> '+resp.data.CMA['client']+'</li>';
        
         html +='<li class="list-group-item "><b>County :</b> '+resp.data.CMA['county_id']+'</li>';
        html +='<li class="list-group-item "><b>State :</b> '+resp.data.CMA['state_id']+'</li>';
        html +='<li class="list-group-item "><b>District :</b> '+resp.data.CMA['city_id']+'</li>';
        
        html +='<li class="list-group-item "><b>Small Description :</b> '+resp.data.CMA['small_description']+'</li>';

        html +='<li class="list-group-item "><b>Description :</b> '+resp.data.CMA['description']+'</li>';

       html +='</ul></div>';
       
       html +='</div>';

        
        ImgUploadPath = resp.data.CMA['file_folder'];
       $("#disDetailContent").html(html);


    }
    data = { "function": 'Services',"method": "getServicesId","id":id };
    apiCall(data,successFn);


        successFn = function(resp) {

            var html1 = '<div class="row">';

            for(var i=0;i<resp.data.SRV.length;i++){

                html1 +='<div class="col-sm-3"><div class="containerdlt"><img src="'+resp.data.SRV[i]['file_path']+'" alt="Avatar" class="image"><div class="overlay"><a href="#" onclick="deleteFile('+resp.data.SRV[i]['id']+','+id+')" class="icon" title="Delete"> <i class="bi bi-trash"></i> </a> </div></div> </div>';


            }

            html1 +='</div>';



            $("#disDetailContentFiles").html(html1);


        }
        data = { "function": 'Services',"method": "getServicesIdfiles","id":id };
        apiCall(data,successFn);


   

  }

  function deleteFile(id,callback){
    return new swal({
        title: "Are you sure?",
        text: "You want to delete this service",
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
                    viewProjectEvents(callback);
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
                data = { "function": 'Services',"method": "deleteServicesfile" ,"id": id };
                apiCall(data,successFn);
                        
            }
        });
  }

  function getServices(){
   
    $('#typeTable').removeClass('d-none');
    $('#addNewServiceTable').addClass('d-none');
    
    
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
                  return '<img src="'+item.cover_image_path+'" width="150px" script="max-height:100px" >';
                  
                
                
                    }
                },
            
               { "data": "main_tittle" },
              { "data": "short_name" },
            //   { "data": "state" },
              
               { "data": null,
                render: function ( data ) {
                    
                   if(data['state'] == '' || data['state'] == null ) return data['stateNames'];
                   else return data['state'];

               
                }
              },
             
              { "data": "categoryD" },
             
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
                  var str = '<span class="badge bg-info text-dark" onclick="viewProjectEvents('+item.id+');" style="cursor:pointer">view</span><span class="badge bg-danger" onclick="deleteProject('+item.id+');" style="cursor:pointer">delete</span><span class="badge bg-primary text-white" onclick="editServices('+item.id+');" style="cursor:pointer">edit</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'Services',"method": "getServicesListData" };
    
    apiCall(data,successFn);
    
    
    
  }

  function deleteProject(id){
    return new swal({
        title: "Are you sure?",
        text: "You want to delete this service",
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
                    title: 'Service Removed Successfully',
                    timer: 1500
                    });
                    getServices();
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error while deleting the service',
                    });
                    // alert('Failed in deleting record');
                }
                // alert(resp.data);
                }
                data = { "function": 'Services',"method": "deleteServices" ,"id": id };
                apiCall(data,successFn);
                        
            }
        });
  }



 
 
  function addNewService(save='add',id=''){
      
      $('#mulImgUpService').removeClass('d-none');
  

    $('#typeTable').addClass('d-none');
    $('#addNewServiceTable').removeClass('d-none');

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    $('#createServiceForm').removeClass('was-validated');
    $('.ri-close-circle-line').click();
    $("#ServiceUploadStatus").width('0%');
    $("#ServiceUploadStatus").html('0%');

    $('#id').val(id);
    $('#save').val(save);

    

    if(save=='add'){
        $('#addRDIT').html('Add Service');
    $('#event_place').val('');
      $('#main_tittle').val('');
      $('#description').val('');
      $('#small_description').val('');

      $('#category').val('');
      $('#client').val('');
      $('#camera').val('');
      
      $('#ServiceCoverImgFile').val('');
      
      
      
    
      $("#selCounty").val("").trigger('change');
      $("#selState").val("").trigger('change');
    //   $("#selCity").val("").trigger('change');
       

    
    }else{
        $('#addRDIT').html('Edit Service');
    }

    tinymce.init({
      selector: '#description',
      height: 500,
      // theme : "advanced",
     // file_browser_callback : "fileBrowserCallBack",

      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | cut copy paste| forecolor backcolor  | fontselect fontsizeselect | blocks fontfamily fontsize |  bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat  | ',

      tinycomments_mode: 'embedded',
      // a11y_advanced_options: true,
      file_picker_types: 'file image media',
      tinycomments_author: 'Author name',
    

      paste_data_images: true,
      file_picker_callback: function(callback, value, meta) {
        if(meta.filetype == 'image') {
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

    $('#createServiceForm').validate({
      ignore: [],
      submitHandler: function(form) {
          
          
         var save = $('#save').val();
         if(save == 'add'){
             
               var eventFile = $('#ServiceEventFiles')[0].files;
            var eventCoverFile = $('#ServiceCoverImgFile')[0].files;
    
            if(eventCoverFile.length == 0){
                $("#ServiceCoverImgFilerr").html("Plese upload the cover image!.");
                $("#ServiceCoverImgFilerr").focus();
                return false;
            }else if(eventCoverFile.length > 1){
                $("#ServiceCoverImgFilerr").html("Plese You can upload only one image !.");
                $("#ServiceCoverImgFilerr").focus();
                return false;
            }else{
                $("#ServiceCoverImgFilerr").html("");
            }
    
            if(eventFile.length == 0){
                $("#ServiceEventFilesErr").html("Plese upload the event images (zip or images)!.");
                $("#ServiceEventFilesErr").focus();
                return false;
            }else{
                $("#ServiceEventFilesErr").html("");
            }
             
         }
        

        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');


        var form = $("#createServiceForm");
        var data = new FormData(form[0]);
        data.append('function', 'Services');
        data.append('method', 'addServices');
        // data.append('save', save);
        // data.append('id',id);


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
                $('#ServiceUploadStatus').removeClass('d-none');
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
                        title: "Service saved successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#SubmitButton').removeClass('d-none');
                    $('#LoadingBtn').addClass('d-none');
                    showNewService();
                    getServices();
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

      rules: {
        category:{ 
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
        description:{ 
          required: true, 
        },
        client:{ 
          required: true, 
        },
        camera:{ 
          required: true, 
        },
            selCounty: {
            required: true
        },
        // selState: {
        //     required: true
        // },
        // selCity: {
        //     required: true
        // },
      },
      messages: {
        category:{ 
          required: "Please select the category ", 
        },
        event_place:{ 
          required: "Please enter the place", 
        },
        main_tittle:{ 
          required: "Please enter the name", 
        },
        image_story:{ 
          required: "Please select an image", 
        },
        description:{ 
          required: "Please enter the description", 
        },
        small_description:{ 
          required: "Please enter the small  description", 
        },
        client:{ 
            required: "Please enter the client", 
        },
        camera:{ 
            required: "Please enter the camera", 
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

  
  function showNewService(){
 
    $('#typeTable').removeClass('d-none');
    $('#addNewServiceTable').addClass('d-none');

    
  }





</script>