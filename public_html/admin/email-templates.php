<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'System-settings') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}


?>

    <div class="pagetitle">
      <h1>Create Email Templates</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="email-templates.php">Email Templates</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12" id="templatesTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Templates</h6>
              <div class="col-sm-5 form-group "></div>

              <div class="col-sm-3 form-group ">
                    <select class="form-select " id="sel_mail_type" name="sel_mail_type" onchange="getsel_mail_template();getTemplates();" >
                      <option selected value="">Select mail type</option>
                    </select>
                  </div>

                  <div class="col-sm-3 form-group ">
                    <select class="form-select " id="sel_mail_template" name="sel_mail_template" onchange="getTemplates();" >
                      <option selected value="">Select mail template</option>
                    </select>
                  </div>


              <!--<div class="  m-0 ">-->
              <!--  <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="addTemplates()">Add New Templates</a>-->
              <!--</div>-->

            </div>
            <div class="card-body">
              <div class="card  table-responsive">
                <table class="table table-hover table-striped " id="Dt_Templates">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mail Type</th>
                      <th>Mail Templates</th>
                      <th>Subject</th>
                      <th>Mail Body</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="Dt_Templates_body">
                  </tbody>
                </table>
              </div>
            </div>

          </div>

        </div>

        <div class="col-lg-12  d-none" id="addTemplatesTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 " id="disADDEDit">Add Templates</h6>
              <div class="   mt-4">
                <a class="btn btn-secondary m-0 " href="javascript:void(0);" role="button" onclick="showTemplates()">Cancel</a>
              </div>
            </div>
            <div class="card-body ">
              <form id="form_templates">

                <div class="row">
                  <div class="col-8">

                        
                      <div class="row mt-3 mb-2 form-group">
                        <label class="col-sm-2 col-form-label mt-2">Mail type</label>
                        <div class="col-sm-10 form-group ">
                          <select class="form-select " id="mail_type" name="mail_type" onchange="getmailtemplate();">
                            <option selected value="">Select mail type</option>
                          </select>
                        </div>
                      </div>

                      <div class="row mt-3 mb-2 form-group">
                        <label class="col-sm-2 col-form-label mt-2">Mail template</label>
                        <div class="col-sm-10 form-group ">
                          <select class="form-select " id="mail_template" name="mail_template" onchange="changeMailTemplate()">
                            <option selected value="">Select mail template</option>
                          </select>
                        </div>
                      </div>
                    
                      <div class="row mb-2 ">
                        <label class="col-sm-2 col-form-label">Subject</label>
                        <div class="col-sm-10  form-group ">
                          <input type="text" class="form-control" id="subject" name="subject" />
                        </div>
                      </div>
                    
                      <div class="row mb-2 ">
                        <label for="description" class="col-sm-2 col-form-label">Mail Body</label>
                        <div class="col-sm-10  form-group ">
                          <textarea class="form-control" style="height: 100px" id="description" name="description" ></textarea>
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
                              Please Wait--.
                          </button>

                        </div>
                      </div>


                  </div>
                  <div class="col-4 mt-2">

                      <label for="main_tittle" class="col-sm-12 col-form-label">Include Fields</label>

                      <ul class="list-group" id="listMailFieldsList">
                      
                      </ul>


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
<!-- 
<script src="https://cdn.tiny.cloud/1/ctfo3flxbrxx8z7yhpgbdf830sxdm0ekzhpw99oqpp6h51sm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->


<script type="text/javascript">
  $(document).ready(function() {
    // addTemplates();
    getTemplates();
    getLinkFieldsForSel();
  });

  function getsel_mail_template(){
    var mail_type =  $('#sel_mail_type').val();
    $('#sel_mail_template').empty();
    $('#sel_mail_template')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail template"));
    successFn = function(resp) {
        for (var key in resp.data.Type) {
            $('#sel_mail_template')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_template"]));
          
        }

    }
    data = { "function": 'EmailTemplates',"method": "getmailtemplateForSel","mail_type":mail_type };
    apiCall(data,successFn);

  }

  function getLinkFieldsForSel(){
    $('#mail_type').empty();
    $('#sel_mail_type').empty();
    $('#mail_type')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail type"));
    $('#sel_mail_type')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail type"));
    successFn = function(resp) {
        for (var key in resp.data.Type) {
            $('#mail_type')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_type"]));

                    $('#sel_mail_type')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_type"]));
          
        }

    }
    data = { "function": 'EmailTemplates',"method": "getMailTypeForSel" };
    apiCall(data,successFn);

  }

  function getmailtemplate(){
    var mail_type =  $('#mail_type').val();
    $('#mail_template').empty();
    $('#mail_template')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail template"));
    successFn = function(resp) {
        for (var key in resp.data.Type) {
            $('#mail_template')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_template"]));
          
        }

    }
    data = { "function": 'EmailTemplates',"method": "getmailtemplateForSel","mail_type":mail_type };
    apiCall(data,successFn);


  }


  function changeMailTemplate(){
    var mail_template =  $("#mail_template").val();
    successFn = function(resp) {
      var listMailFields = '';
        for (var key in resp.data.Fields) {
           listMailFields += '<li class="list-group-item">--'+resp.data.Fields[key]["mail_field"]+'</li>';
          
        }
        $('#listMailFieldsList').html(listMailFields);

    }
    data = { "function": 'EmailTemplates',"method": "getMailFieldWithTypeid" ,"mail_template":mail_template};
    apiCall(data,successFn);

   
  }


  function addTemplates(save='add',id=''){
    $('#templatesTable').addClass('d-none');
    $('#addTemplatesTable').removeClass('d-none');

  
    

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

    $('#id').val(id);
    $('#save').val(save);

    if(save=='add'){

      $('#disADDEDit').html('Add Mail Template  ');
      $('#mail_type').val('').trigger('change');
      $('#subject').val('');
      $('#listMailFieldsList').html('<li class="list-group-item">--</li>');
      $('#description').val('');
      $("#mail_type").prop("disabled", false);
      $("#mail_template").prop("disabled", false);

    }else{

      $('#disADDEDit').html('Edit Mail Template  ');
      successFn = function(resp) {
        $('#description').val('');

      $('#mail_type').val(resp.data.Templates['mail_type']).trigger('change');
      $("#mail_type").prop("disabled", true);
      var mail_template = resp.data.Templates['mail_template'];
      $('#mail_template').empty();
      $('#mail_template')
          .append($("<option></option>")
                      .attr("value", "")
                      .text("Select mail template"));
                      successFn = function(resp) {
                          for (var key in resp.data.Type) {
                              $('#mail_template')
                          .append($("<option></option>")
                                      .attr("value", resp.data.Type[key]["id"])
                                      .text(resp.data.Type[key]["mail_template"]));
                            
                          }

                          setTimeout( function() {
                            $('#mail_template').val(mail_template);
                            $("#mail_template").prop("disabled", true);
                          }, 1000); 

                          

                      }
                    data = { "function": 'EmailTemplates',"method": "getmailtemplateForSel","mail_type":resp.data.Templates['mail_type'] };
                    apiCall(data,successFn);


                    successFn = function(resp) {
                      var listMailFields = '';
                        for (var key in resp.data.Fields) {
                          listMailFields += '<li class="list-group-item">--'+resp.data.Fields[key]["mail_field"]+'</li>';
                          
                        }
                        $('#listMailFieldsList').html(listMailFields);

                    }
                    data = { "function": 'EmailTemplates',"method": "getMailFieldWithTypeid" ,"mail_template":resp.data.Templates['mail_template']};
                    apiCall(data,successFn);

      $('#subject').val(resp.data.Templates['subject']);

      // alert(resp.data.Templates['mail_body'])
      // // Get a reference to the TinyMCE editor instance
      // var editor = tinymce.get('#description');

      // // Set the HTML content of the editor
      // editor.setContent('<p>Your HTML content goes here</p>');
      
      $('#description').val(resp.data.Templates['mail_body']);
      

//       setTimeout( function() {
// }, 1000); 

      


      }
      data = { "function": 'EmailTemplates',"method": "getTemplatesforEdit","id":id };
      apiCall(data,successFn);

    }

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');





    $('#form_templates').validate({
      ignore: [],
      submitHandler: function(form) {
        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        $("#mail_type").prop("disabled", false);
        $("#mail_template").prop("disabled", false);

        // alert($('#description').val());
        // alert('validation success');

        // var description = $('#description').val();
        // var mail_type =  $("#mail_type").val();
        // var mailbodyErr = '';

        // successFn = function(resp) {
        //     for (var key in resp.data.Fields) {
        //       if(description.search("--"+resp.data.Fields[key]["mail_field"]) == -1){
        //         mailbodyErr = 'Please add --'+resp.data.Fields[key]["mail_field"]+' to mail body';           
        //       }
              
        //     }

        //     setTimeout( function() {
        //       if(mailbodyErr != ""){
        //         Swal.fire({
        //           title: mailbodyErr,
        //         });
        //         $('#description').focus();
        //         $('#SubmitButton').removeClass('d-none');
        //         $('#LoadingBtn').addClass('d-none');
        //         return false;

        //       }

              var form = $("#form_templates");
              var data = new FormData(form[0]);
              data.append('function', 'EmailTemplates');
              data.append('method', 'addTemplates');
              // data.append('save', save);
              // data.append('id',id);

              successFn = function(resp)  {
                if(resp.status==1){
                  Swal.fire({
                    title: 'Template Saved Successfully',
                    timer: 1500
                  });
                  getTemplates();

                  setTimeout(function(){
                      location.reload(true);
                  }, 2000);


                }else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops--.',
                    text: 'Error while saving the Template',
                  });
                  $("#mail_type").prop("disabled", true);
                  $("#mail_template").prop("disabled", true);
                }
                // getDescriptions();

                $('#SubmitButton').removeClass('d-none');
                $('#LoadingBtn').addClass('d-none');
              }
              apiCallForm(data,successFn);



        //     }, resp.data.Fields.length*100);


        // }
        // data = { "function": 'EmailTemplates',"method": "getMailFieldWithTypeid" ,"mail_type":mail_type};
        // apiCall(data,successFn);

       



      },

      rules: {
        mail_type:{ 
          required: true, 
        },
        subject:{ 
          required: true, 
        },
        description:{ 
          required: true, 
        },
        mail_template:{ 
          required: true, 
        },
      },
      messages: {
        mail_type:{ 
          required: "Please select mail type ", 
        },
        subject:{ 
          required: "Please enter the subject", 
        },
        description:{ 
          required: "Please enter the mail body", 
        },
        mail_template:{ 
          required: "Please select mail template ", 
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

  function getTemplates(){
    $('#addTemplatesTable').addClass('d-none');
    $('#templatesTable').removeClass('d-none');

    var sel_mail_type =  $('#sel_mail_type').val();
    var sel_mail_template =  $('#sel_mail_template').val();
    
    successFn = function(resp) {
      // Templates
      $('#Dt_Templates_body').empty();
      ind=0;
      for (var key in resp.data.Templates) {
        ind++;
        $('#Dt_Templates_body').append(` 
          <tr id="Dt_templates_tr_${resp.data.Templates[key]["id"]}">
            <td>${ind}</td>
            <td><span> ${resp.data.Templates[key]["mail_type_view"]} </span></td>
            <td><span> ${resp.data.Templates[key]["mail_template_view"]} </span></td>
            <td>${resp.data.Templates[key]["subject"]}</td>
            <td>
          
            
            <div class="bg-light p-2 " > ${resp.data.Templates[key]["mail_body"]}  </div>
            
            
            </td>
            
            <td><a href="javascript:void(0);" onclick="addTemplates('update',${resp.data.Templates[key]["id"]});" class="badge bg-info text-dark" >edit</a></td>
          </tr>`);



          //&nbsp  <a  href="javascript:void(0);" onclick="deleteTemplates(${resp.data.Templates[key]["id"]});"  class="badge bg-danger">delete</a> &nbsp; <span id="a_in_${resp.data.Templates[key]["id"]}"></span>

        // if(resp.data.Templates[key]["active"]==1) {
        //   $('#a_in_'+resp.data.Templates[key]["id"]).append(`<a  href="javascript:void(0);" onclick="templates_inactive(${resp.data.Templates[key]["id"]},'${resp.data.Templates[key]["mail_template"]}');"  class="badge bg-success">active</a>`);
        // }else{
        //   $('#a_in_'+resp.data.Templates[key]["id"]).append(`<a  href="javascript:void(0);" onclick="templates_active(${resp.data.Templates[key]["id"]},'${resp.data.Templates[key]["mail_template"]}');"  class="badge bg-warning">in-active</a>`);
        // }


      }


    }
    data = { "function": 'EmailTemplates',"method": "getTemplates",'sel_mail_type':sel_mail_type,'sel_mail_template':sel_mail_template };
    apiCall(data,successFn);
  }


  function editTemplates(id){
    addTemplates('update',id);
    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');
    


  }


  function showTemplates(){
    $('#addTemplatesTable').addClass('d-none');
    $('#templatesTable').removeClass('d-none');

    
  }

  


  function templates_inactive(id,type){
    successFn = function(resp) {
      getTemplates();
    }
    data = { "function": 'EmailTemplates',"method": "setTemplatesActiveInactive", "id":id, "active":0 , "type":type };
    apiCall(data,successFn);
  }

  function templates_active(id,type){
  
    successFn = function(resp) {
      getTemplates();
    }
    data = { "function": 'EmailTemplates',"method": "setTemplatesActiveInactive", "id":id, "active":1, "type":type };
    apiCall(data,successFn);
  }

  function deleteTemplates(id){

    Swal.fire({
      title: 'Are you sure to delete?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {

        successFn = function(resp) {
          if(resp.status==1){
            // alert('EmailTemplates Deleted Successfully');
            $('#Dt_templates_tr_'+id).remove();
            Swal.fire({
              title: 'Templates Removed Successfully',
              timer: 1500
            });
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops--.',
              text: 'Error while deleting the Templates',
            });
            // alert('Failed in deleting record');
          }
          // alert(resp.data);
        }
        data = { "function": 'EmailTemplates',"method": "deleteTemplates" ,"id": id };
        apiCall(data,successFn);

      }
    })

    return false;
  }




</script>