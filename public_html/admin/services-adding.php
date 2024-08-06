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
      <h1>Service Adding Type</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Adding Type</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section d-none" id="StateFormSection2">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body" id="addEventFormDiv2">
              <h5 class="card-title mb-4" id="addEVT2">Add Service Adding Type</h5>

             
              <form id="addCountyForm2"  >
               
                
              
                
              
              
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Enter service adding type</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpServicesCenter2" name="inpServicesCenter2">

                        <div class="invalid-feedback">
                        Please enter the service adding type!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Description</label>
                    <div class="col-12">
                        <textarea class="form-control" id="inpDescription" name="inpDescription"></textarea>

                        <div class="invalid-feedback">
                        Please enter the description!.
                        </div>
                    </div>
                </div>
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Number of max members</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpMembers" name="inpMembers">

                        <div class="invalid-feedback">
                        Please enter the number of members!.
                        </div>
                    </div>
                </div>
                
                
             
                
                
               
                <div class="row mb-3 mt-5">
                  <div class="col-sm-9"></div>
                  <div class="col-sm-3">
                      <div class="float-right">
                        <input type="hidden" id="hiddenEventId2" name="hiddenEventId2" value="">
                        <input type="hidden" id="save2" name="save2" value="add">
                        <input type="hidden" id="oldType2" name="oldType2" value="">
                        <button type="submit" id="submitButton2" class="btn btn-primary float-right">SAVE</button>
                        <button class="btn btn-primary d-none" type="button" id="submitLoadingButton2" disabled>
                          <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                          Please wait...
                        </button>
                        <button type="button" class="btn btn-danger" onclick="cancelCountyForm2();">Cancel</button>
                      </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
        </div>
    </section>
    
    
    
    
    
    <section id="StateListSection2">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Service adding type</h5>
                </div>
                
               
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddStateSection2();">Add new service adding type</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable2">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Service adding type</th>
                      <th scope="col">Description</th>
                      <th scope="col">Number of members</th>

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
      getStateListData2();


  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
 
  
  function showAddStateSection2(){
      
      emptyForm2();
      

     
    $("#StateListSection2").addClass("d-none");
        $('#addEVT2').html('Add services adding type');
        
       
        $('#StateFormSection2').removeClass("d-none");
      
  }
  
  function emptyForm2(){
      $('#addCountyForm2').removeClass('was-validated');
       $("#hiddenEventId2").val("");
       $("#save2").val("add");
       
       $("#inpServicesCenter2").val("");
       $("#inpDescription").val("");
       
    $("#inpMembers").val("");
      
       
       $('#submitLoadingButton2').addClass('d-none');
       $("#submitButton2").removeClass("d-none");


  }
  
  
  function getStateListData2(){
      
    successFn = function(resp)  {
        $('#eventListTable2').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable2').DataTable( { } );
        $('#eventListTable2').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
            
              
              { "data": "center_name" },
              
                 {"data":null,"render":function(item){
                  
                   var description = item.description;
    
                    // Set the maximum length for the text
                    var maxLength = 60;
                
                    // Trim the text and add ellipsis if needed
                    var trimmedText = description.length > maxLength ? description.substring(0, maxLength) + '...' : description;
              
                  return trimmedText;
                
                    
                    }
                },
                
                 {"data":null,"render":function(item){
                  
                   return item.number_of_members+' person';
                  
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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList2('+item.id+');" style="cursor:pointer">edit</span><span class="badge bg-danger" onclick="deleteState2('+item.id+');" style="cursor:pointer">delete</span>';
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesAddingTypeListData" };
    
    apiCall(data,successFn);
}

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function editStateList2(id){
      
    //   emptyForm2();
       $('#submitLoadingButton2').addClass('d-none');
       $("#submitButton2").removeClass("d-none");

    
        $('#addEVT2').html('Update Services adding type');
          $('#StateFormSection2').removeClass("d-none");
                $("#StateListSection2").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId2").val(id);
                $("#save2").val("edit");
                
               $("#inpServicesCenter2").val(eventList['center_name']);
               $("#inpDescription").val(eventList['description']);
               
               $("#inpMembers").val(eventList['number_of_members']);
               
               
               
              
               

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAddingTypeList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm2(){
      emptyForm2();
      $('#StateFormSection2').addClass("d-none");
      $("#StateListSection2").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm2").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
      
        var save = $("#save2").val();
       
        
        var form = $("#addCountyForm2");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesAddingType');
        formData.append('save', save);

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Services adding type",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton2').removeClass('d-none');
                        $("#submitButton2").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton2").removeClass("d-none");
                                $("#submitLoadingButton2").addClass("d-none");
                                // $("#hiddenEventId2").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Services adding type "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm2();
                                    getStateListData2();
                                    
                                    cancelCountyForm2();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton2").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton2").removeClass("d-none");
                                        $("#submitLoadingButton2").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton2").removeClass("d-none");
                        $("#submitLoadingButton2").addClass("d-none");
                        // $("#hiddenEventId2").val("");
                    }
            });
            
            
    
    },
    rules: {
        
        inpServicesCenter2: {
            required: true
        },
         inpDescription: {
            required: true
        },
         inpMembers: {
            required: true
        },
       
    },
    messages: {
      
         inpServicesCenter2: {
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



function deleteState2(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Service adding type",
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
                             emptyForm2();
                            getStateListData2();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicesAddingType" ,"sel_id":id };
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