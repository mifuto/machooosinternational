<?php 

include("templates/header.php")

?>

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
        <div class="col-lg-12" id="storyTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Recent Stories</h6>
              <div class="  m-0 ">
                <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addStory()">Add Story</a>
              </div>

            </div>
            <div class="card-body">
              <div class="card  table-responsive">
                <table class="table table-hover table-striped " id="Dt_Stories">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Small Desc</th>
                      <th>Photoplay</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="Dt_Stories_body">
                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>

        <div class="col-lg-12  d-none" id="addStoryTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Add Story</h6>
              <div class="   mt-4">
                <a class="btn btn-secondary m-0 " href="javascript:void(0);" role="button" onclick="showStories()">Cancel</a>
              </div>
            </div>
            <div class="card-body ">
              <form id="form_story">
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




<!-- 
                <div class="row mb-2 ">
                  <label for="image_story" class="col-sm-2 col-form-label">1 images</label>
                  <div class="col-sm-10  form-group ">
                    <input class="form-control" type="file" id="image_story" name="image_story" />
                      8.1inch x3 inch
                  </div>
                </div>

                <div class="row mb-2 ">
                  <label for="import_video" class="col-sm-2 col-form-label"> Video</label>
                  <div class="col-sm-10  form-group">
                    <input class="form-control" type="file" id="import_video" name="import_video"  accept="video/*"  />
                  </div>

                </div> -->
                <div class="row mb-2 ">
                  <label for="description" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10  form-group ">
                    <textarea class="form-control" style="height: 100px" id="description" name="description" /></textarea>
                  </div>
                </div>
        
                <div class="row mb-2 ">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10  form-group ">
                    <input  type="submit" id="SubmitButton" class="btn btn-primary" >
                    <input  type="hidden" id="id" name="id" >
                          <input  type="hidden" id="save" name="save" >


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
    // addStory();
    getStories();
  });

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


  function addStory(save='add',id=''){
    $('#storyTable').addClass('d-none');
    $('#addStoryTable').removeClass('d-none');

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    
    $('#id').val(id);
    $('#save').val(save);

    if(save=='add'){
      $('#event_date').val('');
      $('#event_place').val('');
      $('#main_tittle').val('');
      $('#description').val('');
      $('#small_description').val('');
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
      automatic_uploads: true,
      

    });


    $('#form_story').validate({
      ignore: [],
      submitHandler: function(form) {
        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');

        var form = $("#form_story");
        var data = new FormData(form[0]);
        data.append('function', 'Blog');
        data.append('method', 'addStory');
        // data.append('save', save);
        // data.append('id',id);

        successFn = function(resp)  {
          if(resp.status==1){
            Swal.fire({
              title: 'Story Saved Successfully',
              timer: 1500
            });
            getStories();
            setTimeout(function(){
                      location.reload(true);
                  }, 2000);
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
        description:{ 
          required: true, 
        },
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
        description:{ 
          required: "Please enter the description", 
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

  function getStories(){
    $('#addStoryTable').addClass('d-none');
    $('#storyTable').removeClass('d-none');
    
    successFn = function(resp) {
      // Stories
      $('#Dt_Stories_body').empty();
      ind=0;
      for (var key in resp.data.Stories) {
        ind++;
        $('#Dt_Stories_body').append(` 
          <tr id="Dt_story_tr_${resp.data.Stories[key]["id"]}">
            <td>${ind}</td>
            <td>${resp.data.Stories[key]["main_tittle"]}</td>
            <td>${resp.data.Stories[key]["small_description"]}</td>
            <td  id="story_vid_${resp.data.Stories[key]["id"]}"></td>
            <td><a href="javascript:void(0);" onclick="editStory(${resp.data.Stories[key]["id"]});" class="badge bg-info text-dark" >edit</a> &nbsp <a  href="javascript:void(0);" onclick="deleteStory(${resp.data.Stories[key]["id"]});"  class="badge bg-danger">delete</a> &nbsp <span id="a_in_${resp.data.Stories[key]["id"]}"></span></td>
          </tr>`);

        if(resp.data.Stories[key]["image_story"]==''){
          if(resp.data.Stories[key]["video"] !=''){
            // $('#story_vid_'+resp.data.Stories[key]["id"]).append(`
            //   <iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            //     <video width="300" controls>
            //      <source src="${resp.data.Stories[key]["video"]}" type="video/mp4">
            //      <source src="${resp.data.Stories[key]["video"]}" type="video/ogg">
            //      <source src="${resp.data.Stories[key]["video"]}" type="video/avi">
            //      <source src="${resp.data.Stories[key]["video"]}" type="video/wmv">
            //      <source src="${resp.data.Stories[key]["video"]}" type="video/mov">
            //     </video>
            //   `);

            $('#story_vid_'+resp.data.Stories[key]["id"]).append(`
              <iframe width="250px" height="auto" src="${resp.data.Stories[key]["video"]}"></iframe>
            `);
          }

        }else{
          $('#story_vid_'+resp.data.Stories[key]["id"]).append(`
            <img src="${resp.data.Stories[key]["image_story"]}" width="150px" script="max-height:100px" />
          `);
        }
          


        if(resp.data.Stories[key]["active"]==1) {
          $('#a_in_'+resp.data.Stories[key]["id"]).append(`<a  href="javascript:void(0);" onclick="story_inactive(${resp.data.Stories[key]["id"]});"  class="badge bg-success">active</a>`);
        }else{
          $('#a_in_'+resp.data.Stories[key]["id"]).append(`<a  href="javascript:void(0);" onclick="story_active(${resp.data.Stories[key]["id"]});"  class="badge bg-warning">in-active</a>`);
        }

      }


    }
    data = { "function": 'Blog',"method": "getStories" };
    apiCall(data,successFn);
  }

  function showStories(){
    $('#addStoryTable').addClass('d-none');
    $('#storyTable').removeClass('d-none');

    
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
      $('#description').val(resp.data.Story['description']);
      $('#small_description').val(resp.data.Story['small_description']);

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


  function story_inactive(id){
    successFn = function(resp) {
      $('#a_in_'+id).empty().append(`<a  href="javascript:void(0);" onclick="story_active(${id});"  class="badge bg-warning">in-active</a>`);
    }
    data = { "function": 'Blog',"method": "setStoryActiveInactive", "id":id, "active":0};
    apiCall(data,successFn);
  }

  function story_active(id){
    successFn = function(resp) {
      $('#a_in_'+id).empty().append(`<a  href="javascript:void(0);" onclick="story_inactive(${id});"  class="badge bg-success">active</a>`);
    }
    data = { "function": 'Blog',"method": "setStoryActiveInactive", "id":id, "active":1};
    apiCall(data,successFn);
  }

  function deleteStory(id){
    successFn = function(resp) {
      if(resp.status==1){
        // alert('Blog Deleted Successfully');
        $('#Dt_story_tr_'+id).remove();
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
      // alert(resp.data);
    }
    data = { "function": 'Blog',"method": "deleteStory" ,"id": id };
    apiCall(data,successFn);
  }




</script>