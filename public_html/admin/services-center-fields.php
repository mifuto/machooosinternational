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
    
    
    

    <section class="section d-none" id="StateFormSection12">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv12">
              <h5 class="card-title mb-4" id="addEVT1">Add service center sub category</h5>

             
              <form id="addCountyForm12"  >
                  
                  
                   <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Service Centers</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selAttributeServiceCenters" name="selAttributeServiceCenters" >
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Service Centers!.
                        </div>
                    </div>
                    
                </div>
               
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter sub category</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpServicesCenterSubCat" name="inpServicesCenterSubCat">

                        <div class="invalid-feedback">
                        Please enter the sub category!.
                        </div>
                    </div>
                </div>
                
                
               
                <div class="row mb-3 mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                      <div class="float-right">
                        <input type="hidden" id="hiddenEventId12" name="hiddenEventId12" value="">
                        <input type="hidden" id="save12" name="save12" value="add">
                        <input type="hidden" id="oldType1" name="oldType1" value="">
                        <button type="submit" id="submitButton12" class="btn btn-primary float-right">SAVE</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton12" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm12();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="StateListSection12">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Service center sub cateory</h5>
                </div>
                
               
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddStateSection12();">Add new category</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable12">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
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
  $( document ).ready(function() {
      getStateListData12();

        getAttribute12("selAttributeServiceCenters");

  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
   
    
    
     function getAttribute12(selectId) {
     
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
    
 
  
  function showAddStateSection12(){
      
      emptyForm12();
      

     
    $("#StateListSection12").addClass("d-none");
        $('#addEVT1').html('Add category');
        
       
        $('#StateFormSection12').removeClass("d-none");
      
  }
  
  function emptyForm12(){
      $('#addCountyForm12').removeClass('was-validated');
       $("#hiddenEventId12").val("");
       $("#save12").val("add");
       
       $("#inpServicesCenterSubCat").val("");
       
       $("#selAttributeServiceCenters").val("").trigger('change');
      
       
       $('#submitLoadingButton12').addClass('d-none');
       $("#submitButton12").removeClass("d-none");


  }
  
  
  function getStateListData12(){
      
    successFn = function(resp)  {
        $('#eventListTable12').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable12').DataTable( { } );
        $('#eventListTable12').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
            
              
              { "data": "center_name" },
              { "data": "category_name" },

              
           

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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList12('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteState12('+item.id+');" style="cursor:pointer">delete</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesServicescentersubcatListData" };
    
    apiCall(data,successFn);
}

  
  
  function editStateList12(id){
      
    //   emptyForm12();
       $('#submitLoadingButton12').addClass('d-none');
       $("#submitButton12").removeClass("d-none");

    
        $('#addEVT1').html('Update category');
          $('#StateFormSection12').removeClass("d-none");
                $("#StateListSection12").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId12").val(id);
                $("#save12").val("edit");
                
               $("#inpServicesCenterSubCat").val(eventList['category_name']);
               
               
                 
               $("#selAttributeServiceCenters").val(eventList['service_center_id']).trigger('change');
              

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicescentersubcatList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm12(){
      emptyForm12();
      $('#StateFormSection12').addClass("d-none");
      $("#StateListSection12").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm12").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
      

        var save = $("#save12").val();
       
        
        var form = $("#addCountyForm12");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicescentersubcat');
        formData.append('save', save);

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this category",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton12').removeClass('d-none');
                        $("#submitButton12").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton12").removeClass("d-none");
                                $("#submitLoadingButton12").addClass("d-none");
                                // $("#hiddenEventId12").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "category "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm12();
                                    getStateListData12();
                                    
                                    cancelCountyForm12();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton12").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton12").removeClass("d-none");
                                        $("#submitLoadingButton12").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton12").removeClass("d-none");
                        $("#submitLoadingButton12").addClass("d-none");
                        // $("#hiddenEventId12").val("");
                    }
            });
            
            
    
    },
    rules: {
        
        inpServicesCenterSubCat: {
            required: true
        },
        selAttributeServiceCenters: {
            required: true
        },
        
        
      
       
    },
    messages: {
      
         inpServicesCenterSubCat: {
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



function deleteState12(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this category",
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
                             emptyForm12();
                            getStateListData12();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicescentersubcat" ,"sel_id":id };
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