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
      <h1> BLOGS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Website</li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="showHideBlog('blogTable','addBlogForm')">Add BLOG</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
          
          
          
          
          
          
          
          <div class="col-lg-12 ">
          <div class="card" id="blogTable">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Recent Blogs</h5>
                </div>
                
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showHideBlog( 'blogTable','addBlogForm')">Add Blog</button>
                </div>
              </div> 
              
              
              
                   <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                        <th scope="col">#</th>
                                <th scope="col">Tittle</th>
                                
                                 <th scope="col">County</th>
                                  <th scope="col">State</th>

                                
                                
                                <th scope="col">small Desc</th>
                                <th scope="col">PhotoPlay</th>
                                <th scope="col"> edit</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
              
              
              
              
            </div>
          </div>
        </div>
        
        
        
          
          
        


        <div class="col-lg-12  d-none" id="addBlogForm">

          <div class="card">
            <div class="card-header">
              <h5 class="card-header d-flex justify-content-between align-items-center">
                Add Blog
                <button type="button" class="btn btn-sm btn-secondary" onclick="showHideBlog('addBlogForm', 'blogTable')"> Cancel</button>
              </h5>
            </div>
            <div class="card-body">
              <h5 class="card-title"></h5>

              <form id="form_addBlog">
                <div class="row mb-3">
                  <label for="tittle" class="col-sm-2 col-form-label">Tittle</label>
                  <div class="col-sm-10  form-group">
                    <input type="text" class="form-control" id="tittle" name="tittle">
                    <input type="hidden"   id="id" name="id">
                    <input  type="hidden" id="save" name="save" >
                  </div>
                </div>
                
				        <div class="row mb-3">
                  <label for="sub_tittle" class="col-sm-2 col-form-label">Subtittle</label>
                  <div class="col-sm-10  form-group">
                    <input type="text" class="form-control" id="sub_tittle" name="sub_tittle">
                  </div>
                </div>
				        <div class="row mb-3">
                  <label for="posted_date" class="col-sm-2 col-form-label">Posted Date</label>
                  <div class="col-sm-10  form-group">
                    <input type="date" class="form-control" id="posted_date" name="posted_date" value="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                
                
				<div class="row mb-3">
                  <label for="author" class="col-sm-2 col-form-label">Author</label>
                  <div class="col-sm-10  form-group">
                      <select class="form-control select2" aria-label="Default select example" id="author" name="author">
                         
                            </select>
                    <!--<input type="text" class="form-control" id="author" name="author">-->
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
                  <label for="small_description" class="col-sm-2 col-form-label">Small Description</label>
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
                    <input class="form-control" type="file" id="import_image" name="import_image"  />
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


            
				        <div class="row mb-3">
                  <label for="long_description" class="col-sm-2 col-form-label">Long Description</label>
                  <div class="col-sm-10 form-group">
                    <textarea class="form-control" style="height: 100px" id="long_description" name="long_description"></textarea>
                  </div>
                </div>

               
       
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                 <div class="col-sm-10">

                   <button type="submit" class="btn btn-primary" id="SubmitButton">Save</button>
              <button class="btn btn-primary d-none"  id="LoadingBtn" disabled>
                      <span class="spinner-border spinner-border-sm"></span>
                        Please Wait...
                    </button>
                    


              </div>
            </div>


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

 <script>

  $(document).ready(function() {

    // addBlog();
    getBlogs();
    getstaffusers('author');
    
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




  function showHideBlog(id1,id2){
    $('#'+id1).addClass('d-none');
    $('#'+id2).removeClass('d-none');

    if(id2=='addBlogForm')addBlog();
  }

  tinymce.init({
    selector: '#long_description',
    height: 500,
    // theme : "advanced",
   // file_browser_callback : "fileBrowserCallBack",

    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
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


  function getBlogs(){

    showHideBlog('addBlogForm','blogTable');
    
     
      $('#eventListTable').DataTable().destroy();
      
       successFn = function(resp)  {
        
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
            
              
              { "data": "tittle" },
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
                  
                  if(item.image == ''){
                      if(item.video !="") return '<iframe width="250px" height="auto" src="'+item.video+'"></iframe>';
                  }else{
                      return '<img src="'+item.image+'" width="150px" script="max-height:100px" />';
                  }
                  
                
                    
                    }
                },
             
              
              
              
              {"data":null,"render":function(item){
                  var str = '<span class="badge bg-info text-white" onclick="editBlog('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteBlog('+item.id+');" style="cursor:pointer">delete</span>';
                  
                  if(item.active == 1){
                      str += '<span class="badge bg-success text-white" onclick="blog_inactive('+item.id+');" style="cursor:pointer">active</span>';
                  }else{
                      str += '<span class="badge bg-warning text-white" onclick="blog_active('+item.id+');" style="cursor:pointer">in-active</span>';
                  }
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'Blog',"method": "getBlogsNew" };
    
    apiCall(data,successFn);
    
    return false;
    
    
    
    
    
    
    
    
    
    $('#Dt_blog_body').empty();
    $('#Dt_blog').DataTable().destroy();
    ind=0;
    successFn = function(resp) {
      for (var key in resp.data.Blogs) {
        ind++;

        $('#Dt_blog_body').append(`<tr id="Dt_blog_tr_${resp.data.Blogs[key]["id"]}"><th scope="row">${ind}</th>
          <td>${resp.data.Blogs[key]["tittle"]}</td>
          
          <td>${resp.data.Blogs[key]["county_id"]}</td>
          <td>${resp.data.Blogs[key]["state_id"]}</td>

          
          <td>${resp.data.Blogs[key]["small_description"]}</td>
          <td id="blog_vid_${resp.data.Blogs[key]["id"]}"></td>
          <td><a href="javascript:void(0);" onclick="editBlog(${resp.data.Blogs[key]["id"]});" class="badge bg-info text-dark" >edit</a> &nbsp <a  href="javascript:void(0);" onclick="deleteBlog(${resp.data.Blogs[key]["id"]});"  class="badge bg-danger">delete</a> &nbsp <span id="a_in_${resp.data.Blogs[key]["id"]}"></span></td></tr>`);



        if(resp.data.Blogs[key]["image"]==''){
          if(resp.data.Blogs[key]["video"] !=''){
            $('#blog_vid_'+resp.data.Blogs[key]["id"]).append(`
              <iframe width="250px" height="auto" src="${resp.data.Blogs[key]["video"]}"></iframe>
            `);
          }

        }else{
          $('#blog_vid_'+resp.data.Blogs[key]["id"]).append(`
            <img src="${resp.data.Blogs[key]["image"]}" width="150px" script="max-height:100px" />
          `);
        }




        if(resp.data.Blogs[key]["active"]==1) {
          $('#a_in_'+resp.data.Blogs[key]["id"]).append(`<a  href="javascript:void(0);" onclick="blog_inactive(${resp.data.Blogs[key]["id"]});"  class="badge bg-success">active</a>`);
        }else{
          $('#a_in_'+resp.data.Blogs[key]["id"]).append(`<a  href="javascript:void(0);" onclick="blog_active(${resp.data.Blogs[key]["id"]});"  class="badge bg-warning">in-active</a>`);
        }

      }



       $("#Dt_blog").DataTable();



    }
    data = { "function": 'Blog',"method": "getBlogs" };
    apiCall(data,successFn);
  }

  function blog_inactive(id){
    successFn = function(resp) {
      getBlogs();
    }
    data = { "function": 'Blog',"method": "setActiveInactive", "id":id, "active":0};
    apiCall(data,successFn);
  }

  function blog_active(id){
    successFn = function(resp) {
      getBlogs();
    }
    data = { "function": 'Blog',"method": "setActiveInactive", "id":id, "active":1};
    apiCall(data,successFn);
  }




  function addBlog(save='add',id=''){
    $('#id').val('');
    $('#tittle').val('');
    $('#sub_tittle').val('');
    $('#posted_date').val('');
    $('#author').val('');
    $('#small_description').val('');
    $(tinymce.get('long_description').getBody()).html('');
    
       $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
    
    
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#selCity").val("").trigger('change');
       

    $('#save').val(save);



    $.validator.addMethod("validate_image_dimensions", function(value, element) {
      var file = element.files[0];
      var img = new Image();
      img.src = window.URL.createObjectURL(file);
      img.onload = function() {
        if (this.width == 580 && this.height == 216) {
          result = true;
        } else {
          result = false;
        }
      };
      return result;

    });

  
    $('#form_addBlog').validate({
      ignore: [],

      submitHandler: function(form) {
        // $('#SubmitButton').addClass('d-none');
        // $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');
        
          var mulSel = $('#selState').val();
        if(mulSel == ''){
            $('#selState').addClass('is-invalid');
            return false;
        }
        $('#selState').removeClass('is-invalid');
        
         $('#LoadingBtn').removeClass('d-none');
            $('#SubmitButton').addClass('d-none');
          
        

        var form = $("#form_addBlog");
        var data = new FormData(form[0]);
        data.append('function', 'Blog');
        data.append('method', 'addBlog');
        // data.append('save', save);
        data.append('id', $('#id').val());
        data.append('multipleSel', mulSel);

        successFn = function(resp)  {
            
             $('#LoadingBtn').addClass('d-none');
            $('#SubmitButton').removeClass('d-none');
          
          if(resp.status==1){
             Swal.fire({
              title: 'Blog Saved Successfully',
              // showConfirmButton: false,
              timer: 1500
            });
            getBlogs();
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Error while saving the blog',
            });
          }
          // getDescriptions();
          
           
          
          
        }
        apiCallForm(data,successFn);
      },

      rules: {
        tittle:{ 
          required: true, 
        },
        sub_tittle:{ 
          required: true, 
        },
        posted_date:{ 
          required: true, 
        },
        author:{ 
          required: true, 
        },
        small_description:{ 
          required: true, 
        },
        // import_image:{ 
        //   required: true,
        //   accept: "image/*",
        //   validate_image_dimensions: true,
        // },
        long_description:{ 
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
        tittle:{ 
          required: "Please enter the tittle", 
        },
        sub_tittle:{ 
          required: "Please enter the sub tittle", 
        },
        posted_date:{ 
          required: "Please enter the date", 
        },
        author:{ 
          required: "Please enter the author", 
        },
        small_description:{ 
          required: "Please enter the description", 
        },
        import_image:{ 
          required: "Please choose the image", 
          validate_image_dimensions: "Please choose an image with dimension 580 x  216 ",
        },
        long_description:{ 
          required: "Please enter the description", 
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

  function editBlog(id){
    showHideBlog('blogTable','addBlogForm');
    // addBlog('update',id);
    
       $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
      
    successFn = function(resp) {
      $('#id').val(resp.data.Blog['id']);
      $('#tittle').val(resp.data.Blog['tittle']);
      $('#sub_tittle').val(resp.data.Blog['sub_tittle']);
      $('#posted_date').val(resp.data.Blog['posted_date']);
      $('#author').val(resp.data.Blog['author']);
      $('#small_description').val(resp.data.Blog['small_description']);
      
      
       $("#selCounty").val(resp.data.Blog['county_id']).trigger('change');
       
        var valuesArray = resp.data.Blog['state_id'].split(',').map(Number);
        
        getState('selState',valuesArray);
        // getCity('selCity',resp.data.Blog['city_id'],resp.data.Blog['state_id']);
      
      
      
      
      
      $(tinymce.get('long_description').getBody()).html(resp.data.Blog['long_description']);


      if(resp.data.Blog['image']!=''){

        $('#FileImageVideo').val(1).trigger('change');
      }else{
        $('#FileImageVideo').val(0).trigger('change');
        st=(resp.data.Blog['video']).substring(0,10);
        if(st!='blogImages'){
          $('#FileVideoURL').val(1).trigger('change');
          st2= (resp.data.Blog['video']).replace("embed/", "watch?v=");
          $('#import_url').val(st2);
        }else{
          setTimeout( function() {
          $('#FileVideoURL').val(0).trigger('change');
          }, 1000); 



        }

      }


    }
    data = { "function": 'Blog',"method": "getBlog" ,"id": id };
    apiCall(data,successFn);


  }

  function deleteBlog(id){
      
       return new swal({
             title: "Are you sure?",
             text: "You want to delete this Blog",
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
                        $('#Dt_blog_tr_'+id).remove();
                
                        Swal.fire({
                          title: resp.data,
                          timer: 1500
                        });
                        
                        getBlogs()
                
                      }else{
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: resp.data,
                          timer: 1500
                        });
                
                        // alert('Failed in deleting record');
                      }
                      // alert(resp.data);
                    }
                    data = { "function": 'Blog',"method": "deleteBlog" ,"id": id };
                    apiCall(data,successFn);
                    
                 }
         });
      
      
  }







    


</script>