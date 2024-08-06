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
    
    if (strpos($userPermissionsList, 'Website') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>User popups</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">User popups</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="HVSectionFormSection">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv">
              <h5 class="card-title mb-4" id="addEVT"></h5>

             
              <form id="addCountyForm"  >
               
                
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
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">State</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selState" name="selState">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the State!.
                        </div>
                    </div>
                    
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Expiry date</label>
                    <div class="col-12">
                        <input type="date" class="form-control" id="inpExp" name="inpExp">

                        <div class="invalid-feedback">
                        Please select Expiry date!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">URL</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpURL" name="inpURL">

                        <div class="invalid-feedback">
                        Please enter URL!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">User type</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selUserType" name="selUserType" >
                             <option value="" selected >Select user type</option>
                             <option value="1"  >Customer</option>
                             <option value="2"  >Guest user</option>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the User type!.
                        </div>
                    </div>
                    
                </div>
                
              
              
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Upload image</label>
                    <div class="col-12">
                        <input type="file" class="form-control" id="uploadImg" name="uploadImg" accept="image/*" >


                        <div class="invalid-feedback">
                        Please upload image!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3 mt-5">
                    <div class="progress mt-3">
                      <div class="progress-bar progress-bar-striped bg-danger d-none" id="signalbmUploadStatus" role="progressbar" style="width: 50%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="HVSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">User popups</h5>
                </div>
                
              
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddPopupSection();">Add new popups</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Country</th>
                      <th scope="col">State</th>
                    <th scope="col">Popup Image</th>
                    <th scope="col">URL</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Expiry Date</th>
                   
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
      getCounty("selCounty");
      getDisPopupListData();
     
      getState('selState');
    
  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
 
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
      $("#"+selectId).select2();
      
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

function getState1(selectId) {
      
      var selCounty = $('#disType').val();
     
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
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}
  
  
  function showAddPopupSection(){
      
      emptyForm();
      
      

     
    $("#HVSection").addClass("d-none");
        $('#addEVT').html('Add popup');
        
       
        $('#HVSectionFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       $("#uploadImg").val("");
       $("#inpExp").val("");
       $("#inpURL").val("");
       $("#selUserType").val("").trigger('change');
       
       
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');



       
    
      getState('selState');
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  function getDisPopupListData(){
   
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
            
              
              { "data": "short_name" },
              { "data": "state" },
              {"data":null,"render":function(item){
                  
                  if(item.vedio !="") return '<img width="250px" height="auto" src="'+item.image+'"></img>';
                  else '';
                  
                
                    
                    }
                },
                { "data": "url_address" },
                 {"data":null,"render":function(item){
                  
                  if(item.user_type ==1) return 'Customer';
                  else return 'Guest user';
                  
                
                    
                    }
                },
                
                
                  { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['exp']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
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
                  var str = '<span class="badge bg-info text-dark" onclick="editPopList('+item.id+');" style="cursor:pointer">edit</span>';
                  
                   if( item.active == 0){
                      str +='<span class="badge bg-success" onclick="setactiveeventtype('+item.id+','+item.active+');" style="cursor:pointer">active</span>';
                  }else{
                      str +='<span class="badge bg-danger" onclick="setactiveeventtype('+item.id+','+item.active+');" style="cursor:pointer">deactive</span>';
                  }
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getPopupListData" };
    
    apiCall(data,successFn);
}

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function editPopList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');



    
        $('#addEVT').html('Update Popup');
          $('#HVSectionFormSection').removeClass("d-none");
                $("#HVSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $("#selCounty").val(eventList['county_id']).trigger('change');
                

               getState('selState',eventList['state_id']);
               
               $("#inpExp").val(eventList['exp']);
               $("#inpURL").val(eventList['url_address']);
               $("#selUserType").val(eventList['user_type']).trigger('change');
              
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditPopupList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm(){
      emptyForm();
      $('#HVSectionFormSection').addClass("d-none");
      $("#HVSection").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        
      
        var save = $("#save").val();
        
        var uploadImg = $("#uploadImg").val();
            
        if(uploadImg == "" && save == "add"){
            Swal.fire('Please upload the image ')
            return false;
        }
     
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'savePopups');
        
      
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this popup",
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
                            $('#signalbmUploadStatus').removeClass('d-none');
                        },
                     
                            error:function(){
                               $("#submitButton").removeClass("d-none");
                                $("#submitLoadingButton").addClass("d-none");
                                // $("#hiddenEventId").val("");
                                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Popup "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getDisPopupListData();
                                    
                                    cancelCountyForm();
                                    
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
        selCounty: {
            required: true
        },
        selState :{
            required: true
        },
        inpExp:{
            required: true
        },
         selUserType:{
            required: true
        },
       
       
    },
    messages: {
        selCounty: {
            required: "Please select the County"
        },
        selState: {
            required: "Please select the State"
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




function setactiveeventtype(id,val){
    if(val == 0){
        var dis = 'deactive';
        var setVal = 1;
    } 
    else {
        var dis = 'active';
        var setVal = 0;
    }
     return new swal({
             title: "Are you sure?",
             text: "You want to "+dis+" this Popup",
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
                            getDisPopupListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "setsetactiveevPopuptype" ,"sel_id":id,"setVal":setVal,"dis":dis };
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