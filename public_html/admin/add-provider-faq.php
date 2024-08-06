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
    
    if (strpos($userPermissionsList, 'Provider-management') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>FAQ </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">FAQ </li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="RolesFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT"></h5>

             
              <form id="addRolesForm"  >
               
             <div class="row mb-3">
        <label for="seluser" class="col-12 col-form-label">Users</label>
        <div class="col-3">
            <select class="form-control select2" aria-label="Default select example" id="seluser" name="seluser">
                            </select>
            <div class="invalid-feedback">
                Please select the County!.
            </div>
        </div>
    </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Question</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpRole" name="inpRole">

                        <div class="invalid-feedback">
                        Please enter the Question!.
                        </div>
                    </div>
                </div>
                
             
             
                
                  
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Answer</label>
                    <div class="col-12">
                        
                        <textarea class="form-control" style="height: 100px" id="inpCSD" name="inpCSD"></textarea>
                        
                        
                        <div class="invalid-feedback">
                        Please enter Answer!.
                        </div>
                    </div>
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
                        <button type="button" class="btn btn-danger" onclick="cancelRoleForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="RolesListSection">
      <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <h5 class="card-title">FAQ</h5>
                    </div>
                    <div class="col-3">
                        <select class="form-control select2" aria-label="Default select example" id="inpfaq" name="inpfaq" onchange="getRolesListData();">
                            <option value="customer">Customer</option>
                            <option value="provider">Provider</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary" onclick="showAddRolesSection();">Add New FAQ</button>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped" width="100%" id="eventListTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">User</th>
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
      getRolesListData();
      getCounty("seluser");
      getCounty("inpfaq");
      
      
       tinymce.init({
            selector: '#inpCSD',
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
              


  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
 
  
  function showAddRolesSection(){
      
     emptyForm();
      

     
    //$("#RolesListSection").addClass("d-none");
       // $('#addEVT').html('Add FAQ');
        
       
        //$('#RolesFormSection').removeClass("d-none");

        
        
        
        $('#RolesFormSection').addClass("d-none");
      $('#addEVT').html('Add FAQ');
      $("#RolesListSection").removeClass("d-none");
      
      emptyForm();
      
      tinymce.init({
          selector: '#inpCSD',
          // other TinyMCE options...
        });
        
        // Set content after initialization
        // tinymce.get('inpCSD').setContent("");
     
    $("#RolesListSection").addClass("d-none");
        $('#addEVT').html('Add FAQ');
        
       
        $('#RolesFormSection').removeClass("d-none");
      
  }
  function emptyForm(){
      $('#addRolesForm').removeClass('was-validated');
      $("#hiddenEventId").val("");
       $("#save").val("add");
       

       $("#inpRole").val("");
       
     
        tinymce.init({
          selector: '#inpCSD',
          // other TinyMCE options...
        });
        
        // Set content after initialization
        tinymce.get('inpCSD').setContent("");
      
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  function getRolesListData(){
      var inpfaq = $('#inpfaq').val();
      
    
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
            
              
              { "data": "role" },
              { "data": "description" },
              { "data": "newuser" },
              
               
            //   {"data":null,"render":function(item){
            //      if(item.isProvider == 1) return 'Provider';
            //      else return 'Staff'
                    
            //         }
            //     },
              
              
              
             
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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteCity('+item.id+');" style="cursor:pointer">delete</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getFAQListData","inpfaq":inpfaq };
    
    apiCall(data,successFn);
}

  
  
  function getCounty(selectId) {
     
     successFn = function(resp)  {
         // resp = JSON.parse(resp);
       
       var users = resp["data"];
       var options = "<option selected value=''>All Users</option>";
       $.each(users, function(key,value) {
         // console.log(value.id);
         options += "<option value='"+value.newuser+"'>"+value.newuser+"</option>";
       });
     //   alert("#"+selectId);
 
       $("#"+selectId).html(options);
       $("#"+selectId).select2();
       
     }
     data = { "function": 'SystemManage',"method": "getnewuser"};
     
     apiCall(data,successFn);
     
 }
  
  function deleteCity(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this FAQ",
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
                            getRolesListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteFAQ" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
  
  
  
  
  
  
  
  
  
  
  function editStateList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

    
        $('#addEVT').html('Update FAQ');
          $('#RolesFormSection').removeClass("d-none");
                $("#RolesListSection").addClass("d-none");
        
        $("#hiddenEventId").val(id);
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                // $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
               $("#inpRole").val(eventList['role']);
              $("#inpCSD").val(eventList['description']);
               
          
                  tinymce.init({
                  selector: '#inpCSD',
                  // other TinyMCE options...
                });
                
                // Set content after initialization
                tinymce.get('inpCSD').setContent(eventList['description']);
              
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditFAQList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelRoleForm(){
      emptyForm();
      $('#RolesFormSection').addClass("d-none");
      $("#RolesListSection").removeClass("d-none");
  }
  
  
  
  $("#addRolesForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
      
        
         $("#inpCSD").removeClass('is-invalid');
        var inpCSD = tinymce.get('inpCSD').getContent();
        if(inpCSD == ''){
            $("#inpCSD").addClass('is-invalid');
            return false;
        }
        
         
     
        var save = $("#save").val();
        
    
        
        var form = $("#addRolesForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveFAQ');
        formData.append('inpCSD', inpCSD);
      
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this FAQ",
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

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton").removeClass("d-none");
                                $("#submitLoadingButton").addClass("d-none");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "FAQ "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getRolesListData();
                                    
                                    cancelRoleForm();
                                    
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
                    }
            });
            
            
    
    },
    rules: {
        inpRole: {
            required: true
        },
        inpCSD:{
            required: true
         },
         seluser:{
            required: true
         },
      
       
    },
    messages: {
        inpRole: {
            required: "Please enter the Question"
        },
        inpCSD: {
            required: "Please enter the Answer"
        },
        seluser: {
            required: "Please enter the Question"
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





</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>