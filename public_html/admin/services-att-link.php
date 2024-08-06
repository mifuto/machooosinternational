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
    
    
    

    <section class="section d-none" id="StateFormSection123">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv123">
              <h5 class="card-title mb-4" id="addEVT123">Link Attributes</h5>

             
              <form id="addCountyForm123"  >
                  
                  
                        <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter Name</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpServicesLinkName" name="inpServicesLinkName">

                        <div class="invalid-feedback">
                        Please enter the sub category!.
                        </div>
                    </div>
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Staff type</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttributeStafftypeLink" name="selAttributeStafftypeLink" multiple>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Staff type!.
                        </div>
                    </div>
                    
                </div>
                
                  <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">User type</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttributeUsertypeLink" name="selAttributeUsertypeLink" multiple>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the User type!.
                        </div>
                    </div>
                    
                </div>
               
               
                
                
                
                
                  
                  
                   <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Service Centers</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttributeServiceCentersLink" name="selAttributeServiceCentersLink" onchange="getSCSubCat('selAttributeServiceCentersSubLink');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Service Centers!.
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class="row mb-3 d-none" id="linkSubCatDiv">
                    <label for="" class="col-12 col-form-label">Service center sub category</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttributeServiceCentersSubLink" name="selAttributeServiceCentersSubLink" multiple>
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Service center sub category!.
                        </div>
                    </div>
                    
                </div>
                
                
                
               
                
          
                
               
                <div class="row mb-3 mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                      <div class="float-right">
                        <input type="hidden" id="hiddenEventId123" name="hiddenEventId123" value="">
                        <input type="hidden" id="save123" name="save123" value="add">
                        <input type="hidden" id="oldType123" name="oldType123" value="">
                        <button type="submit" id="submitButton123" class="btn btn-primary float-right">SAVE</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton123" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm123();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="StateListSection123">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Link Attributes</h5>
                </div>
                
               
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddStateSection123();">Add new link</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable123">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      
                      <th scope="col">Name</th>
                      
                      <th scope="col">Staff Types</th>
                      <th scope="col">User Types</th>
                      
                      
                      <th scope="col">Service Center</th>
                      
                      <th scope="col">Sub Category</th>

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

    var service_center_sub_id_edt = false;
  $( document ).ready(function() {
      getStateListData123();

        getAttribute123("selAttributeServiceCentersLink");
        
        getAttributeStaffLink("selAttributeStafftypeLink");
        getAttributeUserLink("selAttributeUsertypeLink");
        
        getSCSubCat("selAttributeServiceCentersSubLink");
        
        
        

  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
     function getSCSubCat(selectId,val="",selVal='') {
         
         $('#linkSubCatDiv').addClass('d-none');
         
         if(service_center_sub_id_edt == true && val == "" ){
             service_center_sub_id_edt = false;
             var selAttributeServiceCentersLink = selVal;
             return false;
         }else{
             var selAttributeServiceCentersLink = $('#selAttributeServiceCentersLink').val();
         }
         
         
     
        successFn = function(resp)  {
            // resp = JSON.parse(resp);
          
          var users = resp["data"];
          var options = "<option selected value=''>Select service center sub category</option>";
          $.each(users, function(key,value) {
              $('#linkSubCatDiv').removeClass('d-none');
            // console.log(value.id);
            options += "<option value='"+value.id+"'>"+value.category_name+"</option>";
          });
        //   alert("#"+selectId);
    
          $("#"+selectId).html(options);
          $("#"+selectId).select2();
          if(val != '') $("#"+selectId).val(val).trigger('change');
          
        }
        data = { "function": 'SystemManage',"method": "getSCSubCat" ,'selAttributeServiceCentersLink':selAttributeServiceCentersLink };
        
        apiCall(data,successFn);
        
    }
    
    
   
    
    
    function getAttributeUserLink(selectId) {
     
        successFn = function(resp)  {
            // resp = JSON.parse(resp);
          
          var users = resp["data"]['attribute_options'];
          var staffArray = users.split(",");

          var options = "<option selected value=''>Select user type</option>";
          
            for (var i = 0; i < staffArray.length; i++) {
                
                options += "<option value='"+staffArray[i]+"'>"+staffArray[i]+"</option>";
            }
          
       
    
          $("#"+selectId).html(options);
          $("#"+selectId).select2();
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList",'sel_id':55};
        
        apiCall(data,successFn);
        
    }
    
    
    function getAttributeStaffLink(selectId) {
     
        successFn = function(resp)  {
            // resp = JSON.parse(resp);
          
          var users = resp["data"]['attribute_options'];
          var staffArray = users.split(",");

          var options = "<option selected value=''>Select staff type</option>";
          
            for (var i = 0; i < staffArray.length; i++) {
                
                options += "<option value='"+staffArray[i]+"'>"+staffArray[i]+"</option>";
            }
          
       
    
          $("#"+selectId).html(options);
          $("#"+selectId).select2();
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList",'sel_id':56};
        
        apiCall(data,successFn);
        
    }
    
    
    
   
    
    
     function getAttribute123(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select service center</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.center_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getServicesCenterListData"};
    
    apiCall(data,successFn);
    
}
    
 
  
  function showAddStateSection123(){
      
      emptyForm123();
      

     
    $("#StateListSection123").addClass("d-none");
        $('#addEVT123').html('Link Attributes');
        
       
        $('#StateFormSection123').removeClass("d-none");
      
  }
  
  function emptyForm123(){
      $('#addCountyForm123').removeClass('was-validated');
       $("#hiddenEventId123").val("");
       $("#save123").val("add");
       
       service_center_sub_id_edt = false;
       
       $("#inpServicesLinkName").val("");
       
       $("#selAttributeServiceCentersLink").val("").trigger('change');
       
       $("#selAttributeUsertypeLink").val("").trigger('change');
       $("#selAttributeStafftypeLink").val("").trigger('change');
       $("#selAttributeServiceCentersSubLink").val("").trigger('change');
      
       
       $('#submitLoadingButton123').addClass('d-none');
       $("#submitButton123").removeClass("d-none");


  }
  
  
  function getStateListData123(){
      
    successFn = function(resp)  {
        $('#eventListTable123').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable123').DataTable( { } );
        $('#eventListTable123').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
            
               { "data": "link_name" },
               
               { "data": null,
                render: function ( data ) {
               
                    
                    return data['staff_types'].replace(/^,/, '');
                }
              },
              
               { "data": null,
                render: function ( data ) {
               
                    
                    return data['user_types'].replace(/^,/, '');
                }
              },
             
              

              { "data": "center_name" },
              
               { "data": "service_center_sub_names" },

              
           

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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList123('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteState123('+item.id+');" style="cursor:pointer">delete</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesServicesAttLinkListData" };
    
    apiCall(data,successFn);
}

  
  
  function editStateList123(id){
      
    //   emptyForm123();
       $('#submitLoadingButton123').addClass('d-none');
       $("#submitButton123").removeClass("d-none");

    
        $('#addEVT123').html('Link Attributes');
          $('#StateFormSection123').removeClass("d-none");
                $("#StateListSection123").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                
                service_center_sub_id_edt = true;

                $("#hiddenEventId123").val(id);
                $("#save123").val("edit");
                
               $("#inpServicesLinkName").val(eventList['link_name']);
               
               
                 
               $("#selAttributeServiceCentersLink").val(eventList['service_center_id']).trigger('change');
               
               
               var op1 = eventList['staff_types'].replace(/^,/, '');
               
                var valuesArray = op1.split(",");
                
                $("#selAttributeStafftypeLink").val(valuesArray).trigger('change');
                
        var op2 = eventList['user_types'].replace(/^,/, '');
                var valuesArray1 = op2.split(",");
                
                 $("#selAttributeUsertypeLink").val(valuesArray1).trigger('change');
                 
                 var op3 = eventList['service_center_sub_id'].replace(/^,/, '');
                var valuesArray2 = op3.split(",");
                
        
              
               getSCSubCat('selAttributeServiceCentersSubLink',valuesArray2,eventList['service_center_id'])
              

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttLinkList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm123(){
      emptyForm123();
      $('#StateFormSection123').addClass("d-none");
      $("#StateListSection123").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm123").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        
          var mulSelselAttributeStafftypeLink = $('#selAttributeStafftypeLink').val();
        if(mulSelselAttributeStafftypeLink == ''){
            $('#selAttributeStafftypeLink').addClass('is-invalid');
            return false;
        }
        $('#selAttributeStafftypeLink').removeClass('is-invalid');
   
   
   
     var mulSelselAttributeUsertypeLink = $('#selAttributeUsertypeLink').val();
        if(mulSelselAttributeUsertypeLink == ''){
            $('#selAttributeUsertypeLink').addClass('is-invalid');
            return false;
        }
        $('#selAttributeUsertypeLink').removeClass('is-invalid');
        
        
         var attributeServiceCentersSubLink = $('#selAttributeServiceCentersSubLink').val();
       

        var save = $("#save123").val();
       
        
        var form = $("#addCountyForm123");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesAttLink');
        formData.append('save', save);
        
        formData.append('mulSelselAttributeStafftypeLink', mulSelselAttributeStafftypeLink);
        formData.append('mulSelselAttributeUsertypeLink', mulSelselAttributeUsertypeLink);
        formData.append('attributeServiceCentersSubLink', attributeServiceCentersSubLink);

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Link Attributes",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton123').removeClass('d-none');
                        $("#submitButton123").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton123").removeClass("d-none");
                                $("#submitLoadingButton123").addClass("d-none");
                                // $("#hiddenEventId123").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Link Attributes "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm123();
                                    getStateListData123();
                                    
                                    cancelCountyForm123();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton123").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton123").removeClass("d-none");
                                        $("#submitLoadingButton123").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton123").removeClass("d-none");
                        $("#submitLoadingButton123").addClass("d-none");
                        // $("#hiddenEventId123").val("");
                    }
            });
            
            
    
    },
    rules: {
        
        inpServicesLinkName: {
            required: true
        },
        selAttributeServiceCentersLink: {
            required: true
        },
         selAttributeUsertypeLink: {
            required: true
        },
        selAttributeStafftypeLink: {
            required: true
        },
        
        
      
       
    },
    messages: {
      
         inpServicesLinkName: {
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



function deleteState123(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Link",
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
                             emptyForm123();
                            getStateListData123();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicesAttLink" ,"sel_id":id };
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