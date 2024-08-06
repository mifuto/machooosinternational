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
      <h1>Service Attribute Fields</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Attribute Fields</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    
    

    <section class="section d-none" id="StateFormSection1">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv1">
              <h5 class="card-title mb-4" id="addEVT1">Add Service Attribute Fields</h5>

             
              <form id="addCountyForm1"  >
                  
                  
                   <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Attribute</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttribute" name="selAttribute" >
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Attribute!.
                        </div>
                    </div>
                    
                </div>
               
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter attribute field</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpServicesCenter1" name="inpServicesCenter1">

                        <div class="invalid-feedback">
                        Please enter the attribute field!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Field type</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selFieldType" name="selFieldType" onchange="changeFeildType();">
                             <option value="" selected>Select field type</option>
                             <option value="dropdown">dropdown</option>
                             <option value="text">text</option>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Field type!.
                        </div>
                    </div>
                    
                </div>
                
                
                
                <div class="row mb-3 d-none" id="disFieldType">
                    
                     <div class="col-6">
                         
                         <div class="row ">
                            <label for="" class="col-12 col-form-label">Min</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpMin" name="inpMin" value='0'>
        
                                <div class="invalid-feedback">
                                Please enter the Min!.
                                </div>
                            </div>
                        </div>
                         
                         
                         
                     </div>
                     
                     <div class="col-6">
                         
                         
                          <div class="row ">
                            <label for="" class="col-12 col-form-label">Max</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpMax" name="inpMax" value='0'>
        
                                <div class="invalid-feedback">
                                Please enter the Max!.
                                </div>
                            </div>
                        </div>
                         
                         
                         
                     </div>
                   
                </div>
                
              
             
                
                
               
                <div class="row mb-3 mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                      <div class="float-right">
                        <input type="hidden" id="hiddenEventId1" name="hiddenEventId1" value="">
                        <input type="hidden" id="save1" name="save1" value="add">
                        <input type="hidden" id="oldType1" name="oldType1" value="">
                        <button type="submit" id="submitButton1" class="btn btn-primary float-right">SAVE</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton1" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm1();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="StateListSection1">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Service Attribute Fields</h5>
                </div>
                
               
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddStateSection1();">Add new service attribute fields</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable1">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Attribute</th>
                      <th scope="col">Feild</th>
                      <th scope="col">Type</th>
                     
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
      getStateListData1();

        getAttribute("selAttribute");

  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    
    
    function changeFeildType(){
        var selFieldType = $('#selFieldType').val();
        
        $('#inpMin').val(0);
        $('#inpMax').val(0);
        
        
        if(selFieldType == 'dropdown'){
            $('#disFieldType').removeClass('d-none');
        }else{
            $('#disFieldType').addClass('d-none');
        }
    }
    
    
    
   
    
    
     function getAttribute(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Attribute</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.attribute_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getServicesAttributesListData"};
    
    apiCall(data,successFn);
    
}
    
 
  
  function showAddStateSection1(){
      
      emptyForm1();
      

     
    $("#StateListSection1").addClass("d-none");
        $('#addEVT1').html('Add attribute feild');
        
       
        $('#StateFormSection1').removeClass("d-none");
      
  }
  
  function emptyForm1(){
      $('#addCountyForm1').removeClass('was-validated');
       $("#hiddenEventId1").val("");
       $("#save1").val("add");
       
       $("#inpServicesCenter1").val("");
       
       $("#selAttribute").val("").trigger('change');
       $("#selFieldType").val("").trigger('change');
       
       
       $('#inpMin').val(0);
        $('#inpMax').val(0);
        $('#disFieldType').addClass('d-none');
       
       
      
       
       $('#submitLoadingButton1').addClass('d-none');
       $("#submitButton1").removeClass("d-none");


  }
  
  
  function getStateListData1(){
      
    successFn = function(resp)  {
        $('#eventListTable1').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable1').DataTable( { } );
        $('#eventListTable1').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
            
              
              { "data": "attribute_name" },
              { "data": "attribute_feild" },

              
              
                { "data": null,
                render: function ( data ) {
                    
                    var attribute_type = data['attribute_type'];
                    if(attribute_type == 'dropdown'){
                        return attribute_type+'<br> ( '+ data['attribute_min'] +' to '+data['attribute_max']+' ) ';
                    }else return attribute_type;
                    
                 
                    
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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList1('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteState1('+item.id+');" style="cursor:pointer">delete</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesAttributesFeildListData" };
    
    apiCall(data,successFn);
}

  
  
  function editStateList1(id){
      
    //   emptyForm1();
       $('#submitLoadingButton1').addClass('d-none');
       $("#submitButton1").removeClass("d-none");

    
        $('#addEVT1').html('Update attribute feild');
          $('#StateFormSection1').removeClass("d-none");
                $("#StateListSection1").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId1").val(id);
                $("#save1").val("edit");
                
               $("#inpServicesCenter1").val(eventList['attribute_feild']);
               
               
                 
               $("#selAttribute").val(eventList['attribute_id']).trigger('change');
               $("#selFieldType").val(eventList['attribute_type']).trigger('change');
               
               
               $('#inpMin').val(eventList['attribute_min']);
                $('#inpMax').val(eventList['attribute_max']);
                
                if(eventList['attribute_type'] == 'dropdown') $('#disFieldType').removeClass('d-none');
                else $('#disFieldType').addClass('d-none');
                
             

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm1(){
      emptyForm1();
      $('#StateFormSection1').addClass("d-none");
      $("#StateListSection1").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm1").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var selFieldType = $('#selFieldType').val();
        
        $('#inpMin').removeClass('is-invalid');
        $('#inpMax').removeClass('is-invalid');
        
        var inpMin = $('#inpMin').val();
        var inpMax = $('#inpMax').val();
        
        
        if(selFieldType == 'dropdown'){
            
            if(inpMin == ''){
                $('#inpMin').addClass('is-invalid');
                return false;
            }
            
            if(inpMax == '' || inpMax == 0 || inpMax <= inpMin){
                $('#inpMax').addClass('is-invalid');
                return false;
            }
            
            
            
        }else{
            $('#inpMin').val(0);
            $('#inpMax').val(0);
        }
        

        var save = $("#save1").val();
       
        
        var form = $("#addCountyForm1");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesAttributeFeild');
        formData.append('save', save);

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Attribute feild",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton1').removeClass('d-none');
                        $("#submitButton1").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton1").removeClass("d-none");
                                $("#submitLoadingButton1").addClass("d-none");
                                // $("#hiddenEventId1").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Attribute feild "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm1();
                                    getStateListData1();
                                    
                                    cancelCountyForm1();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton1").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton1").removeClass("d-none");
                                        $("#submitLoadingButton1").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton1").removeClass("d-none");
                        $("#submitLoadingButton1").addClass("d-none");
                        // $("#hiddenEventId1").val("");
                    }
            });
            
            
    
    },
    rules: {
        
        inpServicesCenter1: {
            required: true
        },
        selFieldType: {
            required: true
        },
        selAttribute: {
            required: true
        },
        
        
      
       
    },
    messages: {
      
         inpServicesCenter1: {
            required: "Please enter the State"
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



function deleteState1(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Attribute feild",
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
                             emptyForm1();
                            getStateListData1();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicesAttributesFeild" ,"sel_id":id };
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