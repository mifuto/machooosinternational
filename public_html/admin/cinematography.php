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

    <div class="pagetitle">
      <h1> CINEMATOGRAPHY</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Website</li>
          <li class="breadcrumb-item active"><a class="" href="javascript:void(0);" role="button" onclick="addCinematography()">Add Video Project</a></li>
        </ol>
      </nav>
    </div>




    <section class="section">
      <div class="row">
        <div class="col-lg-12" id="CinematographyTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Recent Video Project</h6>
              <div class="  m-0 ">
                <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addCinematography()">Add New Video Project</a>
              </div>

            </div>
            <div class="card-body">
                
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










        <div class="col-lg-12  d-none" id="addCinematographyTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Add Video Project</h6>
              <div class="   mt-4">
                <a class="btn btn-secondary m-0 " href="javascript:void(0);" role="button" onclick="showCinematography()">Cancel</a>
              </div>
            </div>
            <div class="card-body ">
              <form id="form_cinematography">

                <div class="row mb-2 mt-3">
                  <label for="main_tittle" class="col-sm-2 col-form-label">Video project title</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="main_tittle" name="main_tittle" />
                  </div>
                </div>

                <div class="row mb-2 ">
                  <label for="event_place" class="col-sm-2 col-form-label">Location</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="event_place" name="event_place" />
                  </div>
                </div>

                <div class="row  mb-2 form-group">
                    <label class="col-sm-2 col-form-label mt-2">Category</label>
                    <div class="col-sm-10 form-group ">
                        <select class="form-select " id="category" name="category" >
                        <option selected  value="">Select categcory</option>
                        <option  value="Birthday">Birthday</option>
                        <option  value="Corporate">Corporate</option>
                        <option  value="Couple Shoot">Couple Shoot</option>
                        <option  value="Family Photoshoot">Family Photoshoot</option>
                        <option  value="Maternity Photoshoot">Maternity Photoshoot</option>
                        <option  value="Fashion Model Photoshoot">Fashion Model Photoshoot</option>
                        <option  value="New Born Baby Photoshoot">New Born Baby Photoshoot</option>
                        <option  value="Product Photoshoot">Product Photoshoot</option>
                        <option  value="Real-estate Photoshoot">Real-estate Photoshoot</option>
                        <option  value="Restaurant Photoshoot">Restaurant Photoshoot</option>
                        <option  value="Theme Photoshoot">Theme Photoshoot</option>
                        <option  value="Wedding">Wedding</option>
                        <option  value="Others">Others</option>
                        </select>
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
                
                
                


                <div class="row mb-2">
                  <label for="small_description" class="col-sm-2 col-form-label">Small description</label>
                  <div class="col-sm-10  form-group">
                    <textarea class="form-control" style="height: 100px" id="small_description" name="small_description"></textarea>
                  </div>
                </div>

                  <div class="row mb-3">
                  <label for="small_description" class="col-sm-2 col-form-label">File</label>
                  <div class="col-sm-2  form-group" >
                    <select  class="form-control"  id="FileImageVideo" name="FileImageVideo">
                      <option value="0">Video</option>
                    </select>
                  </div>

               

                  <div class="col-sm-2  form-group " id="Div_Video">

                     <select  class="form-control" onchange="changeVideoYoutube(this.value)" id="FileVideoURL" name="FileVideoURL" >
                      <option value="1">URL</option>
                      <option value="0">Select File</option>
                    </select>
                  </div>

                    <div class="col-sm-6 form-group " id="Div_Video_url">
                      <input class="form-control" type="text" id="import_url" name="import_url"   />
                    </div>

                    <div class="col-sm-6 form-group d-none" id="Div_Video_link">
                      <input class="form-control" type="file" id="import_video" name="import_video"  accept="video/*"    />
                    </div>
                  </div>


                <div class="row mb-2 ">
                  <label for="description" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10  form-group ">
                    <textarea class="form-control" style="height: 100px" id="description" name="description" ></textarea>
                  </div>
                </div>
        
                <div class="row mb-2 ">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10  form-group ">
                    <input  type="hidden" id="id" name="id" >
                    <input  type="hidden" id="save" name="save" >
                    <input  type="submit" id="SubmitButton" class="btn btn-primary" >
                    <button class="btn btn-primary d-none"  id="LoadingBtn" disabled>
                      <span class="spinner-border spinner-border-sm"></span>
                        Please Wait...
                    </button>

                  </div>
                </div>

              </form> 
            </div> 
          </div>


        </div>










      </div>
    </section>

<?php 

include("templates/footer.php")

?>
<script src="tinyMce/js/tinymce/tinymce2.min.js"></script>
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">



  $(document).ready(function() {
    getCinematography();
    
     
    getCounty("selCounty");
       getState('selState');
       getCity('selCity');
       
  });
  
   
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

  

 

  function changeVideoYoutube(val){
    $("#import_url").val('');
    $("#import_video").val('');

    if(val==0){
      $('#Div_Video_url').addClass('d-none');
      $('#Div_Video_link').removeClass('d-none');
      $("#import_url").val('');
      $("#import_video").val('');

    }else{
      $('#Div_Video_link').addClass('d-none');
      $('#Div_Video_url').removeClass('d-none');
      $("#import_url").val('');
      $("#import_video").val('');

    }


  }


  function addCinematography(save='add',id=""){

    $('#CinematographyTable').addClass('d-none');
    $('#addCinematographyTable').removeClass('d-none');

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    if(save=='add'){
      $('#event_place').val('');
      $('#main_tittle').val('');
      $('#description').val('');
      $('#small_description').val('');

      $('#category').val('');
      $('#client').val('');
      $('#camera').val('');

      $("#import_url").val('');
      $("#import_video").val('');
      
      
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#selCity").val("").trigger('change');
       

      
    }

    $('#id').val(id);
    $('#save').val(save);

    
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


    $('#form_cinematography').validate({
      ignore: [],
      submitHandler: function(form) {

        var FileVideoURL = $("#FileVideoURL").val();
        var pjtId = $("#id").val();

        if(FileVideoURL ==1){
            var import_url = $("#import_url").val();
            if(import_url == ""){
                Swal.fire('Please enter the vedio URL')
                return false;
            }
           

        }else{
            var import_video = $("#import_video").val();
            
            if(import_video == "" && pjtId == ""){
                Swal.fire('Please upload the vedio ')
                return false;
            }
           
        }
        
         var mulSel = $('#selState').val();
        if(mulSel == ''){
            $('#selState').addClass('is-invalid');
            return false;
        }
        $('#selState').removeClass('is-invalid');


        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');

        var form = $("#form_cinematography");
        var data = new FormData(form[0]);
        data.append('function', 'Cinematography');
        data.append('method', 'addCinematography');
        // data.append('save', save);
        //data.append('id',id);
         data.append('multipleSel', mulSel);

        successFn = function(resp)  {
          if(resp.status==1){
            if(pjtId == "") $sccmeg = 'Saved';
            else  $sccmeg = 'Updated';
            Swal.fire({
              title: 'Video Project Saved Successfully',
              timer: 1500
            });
            getCinematography();
            setTimeout(function(){
                      location.reload(true);
            }, 2000);
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Error while saving the  Video Project',
            });
            $('#LoadingBtn').addClass('d-none');
             $('#SubmitButton').removeClass('d-none');
          }
          // getDescriptions();
        }
        apiCallForm(data,successFn);
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
        selState: {
            required: true
        },
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
          required: "Please enter the title", 
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

  function getCinematography(){
    $('#addCinematographyTable').addClass('d-none');
    $('#CinematographyTable').removeClass('d-none');
    
    
    
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
                  var str = '<span class="badge bg-info text-dark" onclick="editCinematography('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteCinematography('+item.id+');" style="cursor:pointer">delete</span>';
                  
                   if(item.active == 1){
                      str += '<span class="badge bg-success text-white" onclick="Cinematography_inactive('+item.id+');" style="cursor:pointer">active</span>';
                  }else{
                      str += '<span class="badge bg-warning text-white" onclick="Cinematography_active('+item.id+');" style="cursor:pointer">in-active</span>';
                  }
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'Cinematography',"method": "getCinematography12" };
    
    apiCall(data,successFn);
    
   
  }

  function showCinematography(){
    $('#addCinematographyTable').addClass('d-none');
    $('#CinematographyTable').removeClass('d-none');

    
  }

  function editCinematography(id){

    addCinematography('update',id);
    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
    successFn = function(resp) {
      
      $('#category').val(resp.data.CMA['category']).trigger('change');
      $('#event_place').val(resp.data.CMA['event_place']);
      $('#main_tittle').val(resp.data.CMA['main_tittle']);
      $('#description').val(resp.data.CMA['description']);
      $('#small_description').val(resp.data.CMA['small_description']);
      $('#camera').val(resp.data.CMA['camera']);
      $('#client').val(resp.data.CMA['client']);
      
      
       $("#selCounty").val(resp.data.CMA['county_id']).trigger('change');
         var valuesArray = resp.data.CMA['state_id'].split(',').map(Number);
        
        getState('selState',valuesArray);
        // getCity('selCity',resp.data.CMA['city_id'],resp.data.CMA['state_id']);
      
      

      $("#import_url").val('');
      $("#import_video").val('');

      st=(resp.data.CMA['video']).substring(0,19);
      if(st == "cinematographyImage"){
        $('#FileVideoURL').val(0).trigger('change');

      }else{
        $('#FileVideoURL').val(1).trigger('change');
        st2= (resp.data.CMA['video']).replace("embed/", "watch?v=");

        $('#import_url').val(st2);
      }

   

      // if(resp.data.CMA['image_story']!=''){

      //   $('#FileImageVideo').val(1).trigger('change');
      // }else{
      //   $('#FileImageVideo').val(0).trigger('change');
      //   st=(resp.data.CMA['video']).substring(0,19);
      //   if(st!='cinematographyImages'){
      //     $('#FileVideoURL').val(1).trigger('change');

      //     st2= (resp.data.CMA['video']).replace("embed/", "watch?v=");

      //     $('#import_url').val(st2);

      //   }else{
      //     setTimeout( function() {
      //     $('#FileVideoURL').val(0).trigger('change');

      //     }, 1000); 



      //   }
      // }



    }
    data = { "function": 'Cinematography',"method": "getCinematographyId","id":id };
    apiCall(data,successFn);


  }


  function Cinematography_inactive(id){
    successFn = function(resp) {
      getCinematography();
    }
    data = { "function": 'Cinematography',"method": "setCinematographyActiveInactive", "id":id, "active":0};
    apiCall(data,successFn);
  }

  function Cinematography_active(id){
    successFn = function(resp) {
      getCinematography();
    }
    data = { "function": 'Cinematography',"method": "setCinematographyActiveInactive", "id":id, "active":1};
    apiCall(data,successFn);
  }

  function deleteCinematography(id){
      
       return new swal({
             title: "Are you sure?",
             text: "You want to delete this Cinematography",
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
        $('#Dt_VideoProject_tr_'+id).remove();
        Swal.fire({
          title: 'Video Project Removed Successfully',
          timer: 1500
        });
      }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Error while deleting the Video Project',
        });
        // alert('Failed in deleting record');
      }
      // alert(resp.data);
    }
    data = { "function": 'Cinematography',"method": "deleteCinematography" ,"id": id };
    apiCall(data,successFn);
                    
                    
                    
                 }
         });
      
      
      
    
  }




</script>