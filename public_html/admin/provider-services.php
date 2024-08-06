<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['id'] == ""){
  header("Location: service-provider-login.php");
  // print_r("sasaa");
}
include("templates/provider-header.php");

$isProvider = $_SESSION['isProvider'];

if(!$isProvider){
    echo '<script>';
    echo 'window.location.href = "service-provider-login.php";';
    echo '</script>';
    
}

$logedUserID = $_SESSION['MachooseAdminUser']['id'];

$sql = "SELECT * FROM tblproviderusercompany WHERE is_accept_company = 1 and user_id=".$logedUserID;
$result = $DBC->query($sql);
$rowcount = mysqli_num_rows($result);
if($rowcount > 0) $isNoCompany = false;
else $isNoCompany = true;


?>

    <div class="pagetitle">
      <h1>Our Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Our Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    
    <?php if($isNoCompany){ ?>
    
        <section id="StateListSection">
          <div class="row">
            <div class="col-lg-12 ">
              <div class="card">
               <div class="card-body">
                   
                <br>
                  
                   <div class="alert alert-warning  fade show" role="alert">
                <h4 class="alert-heading">Company has not been approved</h4>
                <p>You cannot access or add services because your company has not been accepted. Please navigate to the <a href="provider-details.php">Our Organization</a> menu, complete the company details, and await acceptance. Once your company is accepted, you can add your provided services.</p>
                <hr>
                <p class="mb-0">Machooos International</p>
              </div>
                   
                </div>
              </div>
            </div>
          </div>
        </section>
        
    <?php }else{ ?>
        
    
    
    

        <section class="section d-none" id="StateFormSection">
          <div class="row">
            <div class="col-lg-12">
    
              <div class="card">
                <div class="card-body" id="addEventFormDiv">
                  <h5 class="card-title mb-4" id="addEVT">Add State</h5>
    
                 
                  <form id="addCountyForm"  >
                      
                      
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Service provider</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selServiceProvider" name="selServiceProvider">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Service provider!.
                                </div>
                            </div>
                            
                        </div>
                      
                      
                      
                   
                    
                    <div class="row mb-3">
                        <label for="" class="col-12 col-form-label">Service name</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpServiceName" name="inpServiceName">
    
                            <div class="invalid-feedback">
                            Please enter the Service name!.
                            </div>
                        </div>
                    </div>
                    
                    
                     <div class="row mb-3">
                        <label for="" class="col-12 col-form-label">Upload service image</label>
                        <div class="col-12">
                            <input type="file" class="form-control" id="import_image" name="import_image" accept="image/*">
    
                            <div class="invalid-feedback">
                            Please upload service image!.
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="" class="col-12 col-form-label">Description</label>
                        <div class="col-12">
                            <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>

                            <div class="invalid-feedback">
                            Please enter Description!.
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3 d-none">
                        <label for="" class="col-12 col-form-label">Service provide price</label>
                        <div class="col-12">
                            <input type="text" class="form-control" id="inpServicePrice" name="inpServicePrice">
    
                            <div class="invalid-feedback">
                            Please enter the Service provide price!.
                            </div>
                        </div>
                    </div>
                    
                    
                        
                        <div class="row mb-3 d-none">
                            <label for="" class="col-12 col-form-label text-dark">Allowed maximum numbers of family members</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpNumberOfMembers" name="inpNumberOfMembers">
        
                                <div class="invalid-feedback">
                                Please enter the Allowed maximum numbers of family members!.
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="row mb-3 d-none">
                            <label for="" class="col-12 col-form-label text-dark">Extra price per head</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpExtraPrice" name="inpExtraPrice">
        
                                <div class="invalid-feedback">
                                Please enter the Extra price per head!.
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
        
        
        <section id="StateListSection">
          <div class="row">
            <div class="col-lg-12 ">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <h5 class="card-title">My Services</h5>
                    </div>
                   
                   
                    
                    <div class="col-9 pt-4 " align="right">
                      <button class="btn btn-primary " onclick="showAddStateSection();">Add New Service</button>
                    </div>
                  </div> 
                  <div class="col-sm-12 table-responsive">
                    <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Service provider</th>
                          <th scope="col">Image</th>
                          <th scope="col">Service name</th>
                          <th scope="col">Description</th>
                          <!--<th scope="col">Price</th>-->
                          
                          <!--<th scope="col">Number of members</th>-->
                          <!--<th scope="col">Extra price per head</th>-->
                          
                         
                          <th scope="col">Created on</th>
                          <th scope="col">Status</th>
                          <th scope="col"></th>
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
    
    <?php } ?>
  
    

<?php 

include("templates/footer.php")

?>
<script>
  $( document ).ready(function() {
      
      getStateListData();
      
      getServiceProvider('selServiceProvider');
    

  });
  
  
  function getServiceProvider(selectId,val="") {
    

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select service provider</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.company_name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.company_name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServiceProviderForProvider" };
    
    apiCall(data,successFn);
    
}
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    function showAddStateSection(){
      
      emptyForm();
      

     
    $("#StateListSection").addClass("d-none");
        $('#addEVT').html('Add Service');
        
       
        $('#StateFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       $("#inpServiceName").val("");
       $("#inpDescription").val("");
       $("#inpServicePrice").val("");
       $("#import_image").val("");
       
       $("#inpNumberOfMembers").val("");
       $("#inpExtraPrice").val("");
       
        $(".progress-bar").width('0%');
        $('#import_image').removeClass('is-invalid');
        
        $("#selServiceProvider").val('').trigger('change');
      
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
   function cancelCountyForm(){
      emptyForm();
      $('#StateFormSection').addClass("d-none");
      $("#StateListSection").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var save = $("#save").val();
        
        var import_image = $("#import_image").val();
        
        $('#import_image').removeClass('is-invalid');
            
        if(import_image == "" && save == "add"){
            $('#import_image').addClass('is-invalid');
            return false;
        }
        
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveProviderService');
        
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Service",
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
                                        title: "Service "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getStateListData();
                                    
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
        inpServiceName: {
            required: true
        },
        inpDescription: {
            required: true
        },
        //  inpServicePrice: {
        //     required: true
        // },
        // inpNumberOfMembers: {
        //     required: true
        // },
        //  inpExtraPrice: {
        //     required: true
        // },
          selServiceProvider: {
            required: true
        },
       
    },
    messages: {
       
       
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


function getStateListData(){
      

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
              
              { "data": "company_name" },
            
              {"data":null,"render":function(item){
                  
                  if(item.image !="") return '<img width="100px" height="auto" src="'+item.image+'"></img>';
                  else '';
                  
                
                    
                    }
                },
              
              { "data": "name" },
              
                {"data":null,"render":function(item){
                  
                   var description = item.description;
    
                    // Set the maximum length for the text
                    var maxLength = 60;
                
                    // Trim the text and add ellipsis if needed
                    var trimmedText = description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
              
                  return trimmedText;
                
                    
                    }
                },
              
            //      {"data":null,"render":function(item){
                  
            //         return '₹'+item.price;
                    
            //         }
            //     },
                
              
            //   { "data": "number_of_members" },
              

            //      {"data":null,"render":function(item){
                  
            //         return '₹'+item.additional_member_price;
                    
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
                  
                        if(item.is_accept == 0){
                            return '<b class="text-warning">Pending</b>';
                        }if(item.is_accept == 2){
                            return '<b class="text-danger">Service rejected</b>';
                        }else{
                            return '<b class="text-success">Service accepted</b>';
                        }
                    
                    }
                },
              
              
              {"data":null,"render":function(item){
                  
                  if(item.is_accept == 0){
                      
                      var str = '<span class="badge bg-info text-dark" onclick="editStateList('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteState('+item.id+');" style="cursor:pointer">delete</span>';
                    return str;
                  }else if(item.is_accept == 2){
                      return item.reject_description ;
                    }else{
                      return '';
                  }
                  
                  
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getProviderServiceListData" };
    
    apiCall(data,successFn);
}


function editStateList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

    
        $('#addEVT').html('Update service');
          $('#StateFormSection').removeClass("d-none");
                $("#StateListSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
             
               
                 $("#inpServiceName").val(eventList['name']);
               $("#inpDescription").val(eventList['description']);
               $("#inpServicePrice").val(eventList['price']);
               $("#import_image").val("");
               
                $("#inpNumberOfMembers").val(eventList['number_of_members']);
               $("#inpExtraPrice").val(eventList['additional_member_price']);
               
                $(".progress-bar").width('0%');
                $('#import_image').removeClass('is-invalid');
                
                $("#selServiceProvider").val(eventList['main_id']).trigger('change');
              
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditProviderServiceList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  

function deleteState(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Service",
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
                            getStateListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteProviderService" ,"sel_id":id };
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