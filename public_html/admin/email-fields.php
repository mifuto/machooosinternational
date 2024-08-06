<?php 

include("templates/header.php");


?>

    <div class="pagetitle">
      <h1>Add Mail Template Fields</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Email Templates</a></li>
          <li class="breadcrumb-item active"><a href="email-fields.php">Add Mail Template Fields</a></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12" id="typeTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Mail Template Fields</h6>

              <div class="col-sm-3 form-group ">
                    <select class="form-select " id="sel_mail_type" name="sel_mail_type" onchange="getsel_mail_template();getLinkFields();" >
                      <option selected value="">Select mail type</option>
                    </select>
                  </div>

                  <div class="col-sm-3 form-group ">
                    <select class="form-select " id="sel_mail_template" name="sel_mail_template" onchange="getLinkFields();" >
                      <option selected value="">Select mail template</option>
                    </select>
                  </div>

              <div class="  m-0 ">
                <a class="btn btn-primary m-0 " href="javascript:void(0);" role="button" onclick="LinkFields()">Add New Field</a>
              </div>

            </div>
            <div class="card-body">
              <div class="card  table-responsive">
                <table class="table table-hover table-striped " id="Dt_Templates">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mail Type</th>
                      <th>Mail Templates</th>
                      <th>Mail Fields</th>
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

        <div class="col-lg-12  d-none" id="LinkFieldsTable">
          <div class="card  ">
            <div class="card-header m-0  py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="card-title m-0 ">Add Mail Template Field</h6>
              <div class="   mt-4">
                <a class="btn btn-secondary m-0 " href="javascript:void(0);" role="button" onclick="showTemplates()">Cancel</a>
              </div>
            </div>
            <div class="card-body ">
              <form id="form_type">

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
                    <select class="form-select " id="mail_template" name="mail_template" >
                      <option selected value="">Select mail template</option>
                    </select>
                  </div>
                </div>
               
              
                <div class="row mb-2 ">
                  <label class="col-sm-2 col-form-label">Field</label>
                  <div class="col-sm-10  form-group ">
                    <input type="text" class="form-control" id="mail_field" name="mail_field" placeholder="eg: username"/>
                  </div>
                </div>
             
             
        
                <div class="row mb-2 ">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10  form-group ">
                    <input  type="submit" id="SubmitButton" class="btn btn-primary" >
                    <button class="btn btn-primary d-none"  id="LoadingBtn" disabled>
                      <span class="spinner-border spinner-border-sm"></span>
                        Please Wait--.
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
    // LinkFields();
    getLinkFields();
    getLinkFieldsForSel();
  });

  function getLinkFieldsForSel(){
    $('#sel_mail_type').empty();
    $('#sel_mail_type')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail type"));
    successFn = function(resp) {
        for (var key in resp.data.Type) {
            $('#sel_mail_type')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_type"]));
          
        }

    }
    data = { "function": 'EmailTemplates',"method": "getMailTypeForSel" };
    apiCall(data,successFn);

    

  }

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

 
  function LinkFields(save='add',id=''){
    $('#mail_type').empty();
    $('#mail_type')
         .append($("<option></option>")
                    .attr("value", "")
                    .text("Select mail type"));
    successFn = function(resp) {
        for (var key in resp.data.Type) {
            $('#mail_type')
         .append($("<option></option>")
                    .attr("value", resp.data.Type[key]["id"])
                    .text(resp.data.Type[key]["mail_type"]));
          
        }

    }
    data = { "function": 'EmailTemplates',"method": "getMailTypeForSel" };
    apiCall(data,successFn);

    $('#typeTable').addClass('d-none');
    $('#LinkFieldsTable').removeClass('d-none');

    $('#LoadingBtn').addClass('d-none');
    $('#SubmitButton').removeClass('d-none');

    

    if(save=='add'){
      $('#mail_type').val('');
      $('#mail_field').val('');
      $('#mail_template').val('');
    
    }


    $('#form_type').validate({
      ignore: [],
      submitHandler: function(form) {
        $('#SubmitButton').addClass('d-none');
        $('#LoadingBtn').removeClass('d-none');
        // alert('validation success');    
        
        
       
        var form = $("#form_type");
        var data = new FormData(form[0]);
        data.append('function', 'EmailTemplates');
        data.append('method', 'LinkFields');
        data.append('save', save);
        data.append('id',id);

       

        successFn = function(resp)  {
          if(resp.status==1){
            Swal.fire({
              title: 'Successfully add field',
              timer: 1500
            });
            //getLinkFields();
          }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops--.',
              text: 'Error while adding the field',
            });
          }
          // getDescriptions();

          $('#SubmitButton').removeClass('d-none');
          $('#LoadingBtn').addClass('d-none');
        }
        apiCallForm(data,successFn);
      },

      rules: {
        mail_type:{ 
          required: true, 
        },
        mail_field:{ 
          required: true, 
        },
        mail_template: { 
          required: true, 
        },

      },
      messages: {
        mail_type:{ 
          required: "Please select mail type ", 
        },
        mail_field:{ 
          required: "Please enter field ", 
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

  function getLinkFields(){
    $('#LinkFieldsTable').addClass('d-none');
    $('#typeTable').removeClass('d-none');

    var sel_mail_type =  $('#sel_mail_type').val();
    var sel_mail_template =  $('#sel_mail_template').val();
    
    successFn = function(resp) {
      // Templates
      $('#Dt_Templates_body').empty();
      ind=0;
      for (var key in resp.data.Type) {
        ind++;
        $('#Dt_Templates_body').append(` 
          <tr id="Dt_templates_tr_${resp.data.Type[key]["id"]}">
            <td>${ind}</td>
            <td><span >${resp.data.Type[key]["mail_type"]}</span></td>
            <td><span >${resp.data.Type[key]["mail_template"]}</span></td>
            <td><span >${resp.data.Type[key]["mail_field"]}</span></td>
            
            <td> <span id="a_in_${resp.data.Type[key]["id"]}"></span></td>
          </tr>`);

        if(resp.data.Type[key]["active"]==1) {
          $('#a_in_'+resp.data.Type[key]["id"]).append(`<a  href="javascript:void(0);" onclick="templates_inactive(${resp.data.Type[key]["id"]});"  class="badge bg-success">active</a>`);
        }else{
          $('#a_in_'+resp.data.Type[key]["id"]).append(`<a  href="javascript:void(0);" onclick="templates_active(${resp.data.Type[key]["id"]});"  class="badge bg-warning">in-active</a>`);
        }

     

      }


    }
    data = { "function": 'EmailTemplates',"method": "getLinkFields" ,'sel_mail_type':sel_mail_type,'sel_mail_template':sel_mail_template };
    apiCall(data,successFn);
  }

  function showTemplates(){
    $('#LinkFieldsTable').addClass('d-none');
    $('#typeTable').removeClass('d-none');

    
  }

  


  function templates_inactive(id){
    successFn = function(resp) {
      getLinkFields();
    }
    data = { "function": 'EmailTemplates',"method": "setMailFieldsActiveInactive", "id":id, "active":0  };
    apiCall(data,successFn);
  }

  function templates_active(id){
  
    successFn = function(resp) {
      getLinkFields();
    }
    data = { "function": 'EmailTemplates',"method": "setMailFieldsActiveInactive", "id":id, "active":1 };
    apiCall(data,successFn);
  }

  function deleteFields(id){

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
                title: 'Field Removed Successfully',
                timer: 1500
                });
            }else{
                Swal.fire({
                icon: 'error',
                title: 'Oops--.',
                text: 'Error while deleting the Field',
                });
                // alert('Failed in deleting record');
            }
            // alert(resp.data);
            }
            data = { "function": 'EmailTemplates',"method": "deleteFields" ,"id": id };
            apiCall(data,successFn);

        }
    })

    return false;


  }




</script>