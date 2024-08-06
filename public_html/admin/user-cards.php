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
    
    if (strpos($userPermissionsList, 'Cards') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}




?>

    <div class="pagetitle">
      <h1>Cards</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Cards</li>
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
                    <label for="" class="col-12 col-form-label">Card name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpCardName" name="inpCardName" >
        
                                <div class="invalid-feedback">
                                Please enter Card name!.
                                </div>
                            </div>
                </div>
                
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Card image</label>
                    <div class="col-12">
                        <input type="file" class="form-control" id="uploadImg" name="uploadImg" accept="image/*" >


                        <div class="invalid-feedback">
                        Please upload image!.
                        </div>
                    </div>
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Card validity</label>
                    <div class="col-12">
                        
                        <select class="form-control select2" aria-label="Default select example" id="inpExp" name="inpExp">
                            <option value='' selected>Select validity</option>
                            <option value='1' >1 year</option>
                            <option value='2' >2 year</option>
                            <option value='3' >3 year</option>
                            <option value='5' >5 year</option>
                            <option value='8' >8 year</option>
                            <option value='10' >10 year</option>
                        </select>
                       
                        <div class="invalid-feedback">
                        Please select Card validity!.
                        </div>
                    </div>
                </div>
                
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Card details</label>
                    <div class="col-12">
                        
                        <textarea class="form-control" style="height: 100px" id="inpCSD" name="inpCSD"></textarea>
                        
                        
                        <div class="invalid-feedback">
                        Please enter details!.
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="" class="col-12 col-form-label">Number of services use</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpNumberOfServices" name="inpNumberOfServices" >
        
                                <div class="invalid-feedback">
                                Please enter Number of services use!.
                                </div>
                            </div>
                </div>
                
                
                
                
                
                
                
                
                <div class="row mb-3">
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Actual amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpAamount" name="inpAamount" onchange="disTotalPayableAmt();disTotalPayableExpiredAmt();disTotalPayableGuestUserAmt();">
        
                                <div class="invalid-feedback">
                                Please enter actual amount!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Discout amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpDamount" name="inpDamount" onchange="disTotalPayableAmt();disTotalPayableGuestUserAmt();">
        
                                <div class="invalid-feedback">
                                Please enter discout amount!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Discout Type</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selDiscoutType" name="selDiscoutType" onchange="disTotalPayableAmt();">
                                     <option value="1"  selected>Amount</option>
                                     <option value="2"  >Percentage</option>
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Discout Type!.
                                </div>
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <b>Total payable amount : ₹<label id="disTotalpayableamount"></label></b>
                    </div>
                    
                </div>
                
                <div class="row mb-3">
                    
                     <div class="col-4 d-none">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label ">After expired Actual amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpExpiredAamount" name="inpExpiredAamount" onchange="disTotalPayableExpiredAmt();">
        
                                <div class="invalid-feedback">
                                Please enter actual amount!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">After expired Discout amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpExpiredDamount" name="inpExpiredDamount" onchange="disTotalPayableExpiredAmt();">
        
                                <div class="invalid-feedback">
                                Please enter discout amount!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">After expired Discout Type</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selExpiredDiscoutType" name="selExpiredDiscoutType" onchange="disTotalPayableExpiredAmt();">
                                     <option value="1"  selected>Amount</option>
                                     <option value="2"  >Percentage</option>
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Discout Type!.
                                </div>
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <b>Total payable expired amount : ₹<label id="disTotalpayableExpiredamount"></label></b>
                    </div>
                    
                </div>
                
               
                
                <div class="row mb-3 d-none">
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Card Purchase</label>
                            <div class="col-12">
                                <select class="form-control select2" aria-label="Default select example" id="CardPurchase" name="CardPurchase" >
                                     <option value="1"  selected>1</option>
                                     <option value="2"  >2</option>
                                     <option value="3"  >3</option>
                                     <option value="4"  >4</option>
                                     <option value="5"  >5</option>
                                     <option value="6"  >6</option>
                                     <option value="7"  >7</option>
                                     <option value="8"  >8</option>
                                     <option value="9"  >9</option>
                                     <option value="10"  >10</option>
                                     <option value="11"  >11</option>
                                    </select>
        
                                <div class="invalid-feedback">
                                Please enter Card Purchase!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                  
                    
                    <div class="col-4">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">&nbsp;</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="CardPurchaseType" name="CardPurchaseType" >
                                     <option value="months"  selected>months</option>
                                     <option value="year"  >year</option>
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Discout Type!.
                                </div>
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                
                
                <hr>
                
                <div class="row mb-3">
                    
                   
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Guest user Additional amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpAdditionalamount" name="inpAdditionalamount" onchange="disTotalPayableGuestUserAmt();">
        
                                <div class="invalid-feedback">
                                Please enter the amount!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Guest user Additional amount Type</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="inpAdditionalamountType" name="inpAdditionalamountType" onchange="disTotalPayableGuestUserAmt();">
                                     <option value="1"  selected>Amount</option>
                                     <option value="2"  >Percentage</option>
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the amount Type!.
                                </div>
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <b>Total payable expired amount : ₹<label id="disTotalpayableGuestUseramount"></label></b>
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
                  <h5 class="card-title">Cards</h5>
                </div>
                
              
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddCardSection();">Add new card</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Card Name</th>
                    <th scope="col">Card Image</th>
                    <th scope="col">Expiry </th>
                    <th scope="col">Number of Services</th>
                    
                    <th scope="col">Payable Amount</th>
                    <th scope="col">Payable Expired Amount</th>
                    <th scope="col">Guest user Payable Amount</th>
                    
                    
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
var isEditMode = false;
var isServiceNotAvl = 1;
var isEditMode1 = false;


  $( document ).ready(function() {
      
     
      
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
              
    
      getDisCardsListData();
      
    
  });
  
  
  
  
    function disTotalPayableGuestUserAmt(){
      var inpAamount = $("#inpAamount").val();
       var inpDamount1 = $("#inpDamount").val();
      var selDiscoutType1 = $("#selDiscoutType").val();
      
       if(selDiscoutType1 == '1'){
              if(inpDamount1 != '') {
                  inpAamount = parseInt(inpAamount) - parseInt(inpDamount1);
              }
              
          }else{
              if(inpDamount1 != '') {
                  var dctat1 = ( parseInt(inpAamount) / 100 ) * parseInt(inpDamount1);
                  inpAamount = (parseInt(inpAamount) - dctat1).toFixed(2);
              }
          }
      
      
      var inpDamount = $("#inpAdditionalamount").val();
      var selDiscoutType = $("#inpAdditionalamountType").val();
      
      if(selDiscoutType == '1'){
          if(inpDamount == '') $('#disTotalpayableGuestUseramount').html("");
          else {
              
              $('#disTotalpayableGuestUseramount').html(parseInt(inpDamount)+parseInt(inpAamount));
          }
          
      }else{
          if(inpDamount == '') $('#disTotalpayableGuestUseramount').html('');
          else {
              var dctat = ( parseInt(inpAamount) / 100 ) * parseInt(inpDamount);
              dctat = parseInt(inpAamount) + parseInt(dctat);
              $('#disTotalpayableGuestUseramount').html( (dctat).toFixed(2) );
          }
      }
      
      
      
      
  }
  
  
  
  
  
  
  
    function showAddCardSection(){
      
      emptyForm();
     

     
    $("#HVSection").addClass("d-none");
        $('#addEVT').html('Add card');
        
       
        $('#HVSectionFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       isEditMode = false;
       isEditMode1 = false;
       
       
       $("#inpCardName").val("");
       $("#uploadImg").val("");
       $("#inpExp").val("").trigger('change');
       
       $("#inpCSD").val("");
       
       // Initialize TinyMCE on #inpCSD
        tinymce.init({
          selector: '#inpCSD',
          // other TinyMCE options...
        });
        
        // Set content after initialization
        tinymce.get('inpCSD').setContent("");
        
        $("#inpNumberOfServices").val("");
        
         
       $("#inpAamount").val("");
       $("#inpDamount").val("");
       
       
       
       $('#disTotalpayableamount').html('');
       
       $("#selDiscoutType").val("1").trigger('change');
       
       $("#inpExpiredAamount").val("");
       $("#inpExpiredDamount").val("");
       $("#selExpiredDiscoutType").val("1").trigger('change');
       
       $('#disTotalpayableExpiredamount').html('');
       
        $("#CardPurchase").val("1").trigger('change');
       $("#CardPurchaseType").val("months").trigger('change');
       
       
       $("#inpAdditionalamount").val('');
      $("#inpAdditionalamountType").val("1").trigger('change');
      $('#disTotalpayableGuestUseramount').html("");
        
        
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');


       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  } 
  
  
   $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
      
        $("#inpCSD").removeClass('is-invalid');
        var inpCSD = tinymce.get('inpCSD').getContent();
         if(inpCSD == ''){
            $("#inpCSD").addClass('is-invalid');
            $("#inpCSD").focus();
            return false;
        }
        
        
        var save = $("#save").val();
        
        var uploadImg = $("#uploadImg").val();
            
        if(uploadImg == "" && save == "add"){
             $("#uploadImg").addClass('is-invalid');
            $("#uploadImg").focus();
            return false;
        }
     
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
    
        formData.append('function', 'AlbumSubscription');
        formData.append('method', 'saveUserCard');
        formData.append('cardDetails', inpCSD);
        
        
         
      
        
       
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this card",
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
                                        title: "Card "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getDisCardsListData();
                                    
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
         inpCardName: {
            required: true
        },
      
        inpExp:{
            required: true
        },
         inpCSD:{
            required: true
        },
        
          inpNumberOfServices:{
            required: true
        },
        
         inpAamount: {
            required: true
        },
        inpDamount :{
            required: true
        },
        selDiscoutType:{
            required: true
        },
       
        inpExpiredDamount:{
            required: true
        },
         selExpiredDiscoutType:{
            required: true
        },
        
           inpAdditionalamount:{
            required: true
        },
         inpAdditionalamountType:{
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
  
  
  
  function getDisCardsListData(){
   
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
              
              { "data": "card_name" },
              
               {"data":null,"render":function(item){
                  
                  if(item.image !="") return '<img width="250px" height="auto" src="'+item.image+'"></img>';
                  else '';
                  
                
                    
                    }
                },
                
                  
                  { "data": null,
                render: function ( data ) {
                    
                    var date = data['exp'];

              
                    return date+' year';
                }
              },
                
              
              
              { "data": "number_of_service" },
             
              
               { "data": null,
                render: function ( data ) {
                    
                    var amount = data['amount'];
                    var discout = data['discout'];
                    var discout_type = data['discout_type'];
                    
                    if(discout_type == 1) {
                        var dctat =parseInt(amount) - parseInt(discout);
                        return 'Amount ₹'+amount+'<br>Discout ₹'+discout+'<br>Total payable amount  ₹'+ dctat;
                        
                    }
                    else {
                        var dctat = (parseInt(amount) - ( ( parseInt(amount) / 100 ) * parseInt(discout) )).toFixed(2) ;
                        return 'Amount ₹'+amount+'<br>Discout '+discout+'%<br>Total payable amount  ₹'+ dctat;
                    }

              
                    
                }
              },
              
               { "data": null,
                render: function ( data ) {
                    
                    var amount = data['amount'];
                    var discout = data['exp_discout'];
                    var discout_type = data['exp_discout_type'];
                    
                    if(discout_type == 1) {
                        var dctat =parseInt(discout);
                        return 'Discout ₹'+discout+'<br>Total payable amount  ₹'+ dctat;
                        
                    }
                    else {
                        var dctat = (( parseInt(amount) / 100 ) * parseInt(discout)).toFixed(2);
                        return 'Discout '+discout+'%<br>Total payable amount  ₹'+ dctat;
                    }

              
                    
                }
              },
              
              
                { "data": null,
                render: function ( data ) {
                    
                    var amount = data['amount'];
                    var inpDamount1 = data['discout'];
                    var selDiscoutType1 = data['discout_type'];
                    
                    
                    if(selDiscoutType1 == '1'){
                          if(inpDamount1 != '') {
                              amount = parseInt(amount) - parseInt(inpDamount1);
                          }
                          
                      }else{
                          if(inpDamount1 != '') {
                              var dctat1 = ( parseInt(amount) / 100 ) * parseInt(inpDamount1);
                              amount = (parseInt(amount) - dctat1).toFixed(2);
                          }
                      }
                    
                    
                    
                    
                    
                    
                    var discout = data['guestuser_additional_amt'];
                    var discout_type = data['guestuser_additional_amt_type'];
                    
                    if(discout_type == 1) {
                        var dctat =parseInt(discout) + parseInt(amount) ;
                        return 'Additional ₹'+discout+'<br>Total payable amount  ₹'+ dctat;
                        
                    }
                    else {
                        var dctat = (( parseInt(amount) / 100 ) * parseInt(discout)).toFixed(2);
                        dctat = parseInt(amount) + parseInt(dctat);
                        return 'Additional '+discout+'%<br>Total payable amount  ₹'+ dctat;
                    }

              
                    
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
                  var str = '<span class="badge bg-info text-dark" onclick="editSubCardList('+item.id+');" style="cursor:pointer">edit</span>';
                  
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
    data = { "function": 'AlbumSubscription',"method": "getUserCardsListData" };
    
    apiCall(data,successFn);
}



  function editSubCardList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');



    
        $('#addEVT').html('Update card');
          $('#HVSectionFormSection').removeClass("d-none");
                $("#HVSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                
                
                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                isEditMode = true;
                isEditMode1 = true;
                
                $("#inpCardName").val(eventList['card_name']);
                $("#inpExp").val(eventList['exp']).trigger('change');
                $("#inpCSD").html(eventList['description']);
                  $("#uploadImg").val("");
                // Initialize TinyMCE on #inpCSD
                tinymce.init({
                  selector: '#inpCSD',
                  // other TinyMCE options...
                });
                
                // Set content after initialization
                tinymce.get('inpCSD').setContent(eventList['description']);
                
                $("#inpNumberOfServices").val(eventList['number_of_service']);
                
               
                
                $("#inpAamount").val(eventList['amount']);
                $("#inpDamount").val(eventList['discout']);
                
                $("#selDiscoutType").val(eventList['discout_type']).trigger('change');
                
                
                $("#inpExpiredAamount").val(eventList['exp_amount']);
                $("#inpExpiredDamount").val(eventList['exp_discout']);
                
                $("#selExpiredDiscoutType").val(eventList['exp_discout_type']).trigger('change');
                
                 $("#CardPurchase").val(eventList['CardPurchase']).trigger('change');
                $("#CardPurchaseType").val(eventList['CardPurchaseType']).trigger('change');
                
                
                 $("#inpAdditionalamount").val(eventList['guestuser_additional_amt']);
                
                $("#inpAdditionalamountType").val(eventList['guestuser_additional_amt_type']).trigger('change');
                
                
                
     

            }
           
            
          
        }
        data = { "function": 'AlbumSubscription',"method": "geteditUserCardList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  
  
  
  
  function cancelCountyForm(){
      emptyForm();
      $('#HVSectionFormSection').addClass("d-none");
      $("#HVSection").removeClass("d-none");
  }
  
  
  
 

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
             text: "You want to "+dis+" this Card",
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
                            getDisCardsListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'AlbumSubscription',"method": "setsetactiveevUserCard" ,"sel_id":id,"setVal":setVal,"dis":dis };
                     apiCall(data,successFn);
                 }
         });
}
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  function getMainCards(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Card</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.CardName+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'AlbumSubscription',"method": "getmainCards"};
    
    apiCall(data,successFn);
    
}

function getServiceDatas(){
   
    isServiceNotAvl = 1;
    
    selState = $('#selState').val();
    
    if(selState == "" || selState == null) {
        $('#serviceDataList').html('');
        return false;
    }
  
    successFn = function(resp)  {
        
        if(resp['status'] == 1){
            
            var tbls ='';
             // Loop through the array
            for (var i = 0; i < resp['data'].length; i++) {
                isServiceNotAvl = 0;
                
                var CardServiceId = resp['data'][i]['id'];
                var CardService = resp['data'][i]['CardService'];
                
                
                tbls +='<div class="col-12">';
                tbls +='<input type="checkbox" value="'+CardServiceId+'" id="myServiceCheckbox_'+CardServiceId+'" name="myServiceCheckboxName">  '+CardService+'';
                tbls +='</div>';
            }
            
            
            $('#serviceDataList').html(tbls);
            
            
            
        }else $('#serviceDataList').html('');
        
        
      
        
   
    }
    data = { "function": 'AlbumSubscription',"method": "getCardServiceState" , "selState":selState};
    
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
      $("#"+selectId).select2();
      
      if(val !="")$("#selCity").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}

function fetchCard(val="",val1=""){
    
    if(isEditMode){
        if(val == '') {
            isEditMode = false;
            return false;
        }
    }
      
    var id = $('#selCard').val();
    
      postData = {
        function: 'AlbumSubscription',
        method: "getCardOne",
        id: id,
      }

      console.log(postData);

      successFn = function(resp) {
        // console.log(resp);
        
        var data = resp.data;

        // var valuesArray = data[0]['state_id'].split(',').map(Number);
        getState('selState',data[0]['state_id'],val,val1);
        
     

      }

      apiCall(postData,successFn);
  }
  
  function getState(selectId,data="",val="",val1="") {
   
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option selected value='"+value.id+"'>"+value.state+"</option>";
        else options += "<option value='"+value.id+"'>"+value.state+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    //   if(val !="")$("#selState").val(val).trigger('change');
      
       getCity('selCity',val1,val);
                
      
      
    }
    data = { "function": 'AlbumSubscription',"method": "getCardState" , "selData":data};
    
    apiCall(data,successFn);
    
}

    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    
 
  
  function disTotalPayableAmt(){
      var inpAamount = $("#inpAamount").val();
      var inpDamount = $("#inpDamount").val();
      var selDiscoutType = $("#selDiscoutType").val();
      
      if(inpAamount == '') $('#disTotalpayableamount').html('');
      else{
          if(selDiscoutType == '1'){
              if(inpDamount == '') $('#disTotalpayableamount').html(inpAamount);
              else {
                  $('#disTotalpayableamount').html(parseInt(inpAamount) - parseInt(inpDamount));
              }
              
          }else{
              if(inpDamount == '') $('#disTotalpayableamount').html(inpAamount);
              else {
                  var dctat = ( parseInt(inpAamount) / 100 ) * parseInt(inpDamount);
                  $('#disTotalpayableamount').html( (parseInt(inpAamount) - dctat).toFixed(2));
              }
          }
      }
      
      
      
      
  }
  
   function disTotalPayableExpiredAmt(){
      var inpAamount = $("#inpAamount").val();
      var inpDamount = $("#inpExpiredDamount").val();
      var selDiscoutType = $("#selExpiredDiscoutType").val();
      
      if(selDiscoutType == '1'){
          if(inpDamount == '') $('#disTotalpayableExpiredamount').html("");
          else {
              $('#disTotalpayableExpiredamount').html(parseInt(inpDamount));
          }
          
      }else{
          if(inpDamount == '') $('#disTotalpayableExpiredamount').html('');
          else {
              var dctat = ( parseInt(inpAamount) / 100 ) * parseInt(inpDamount);
              $('#disTotalpayableExpiredamount').html( (dctat).toFixed(2) );
          }
      }
      
      
      
      
  }
  
  
  
  
  
  
  




  
  

function getServiceDatasNew(selState,arrayOfNumbers){
    isServiceNotAvl = 1;
   
    if(selState == "" || selState == null) {
        $('#serviceDataList').html('');
        return false;
    }
    
    
    
    successFn = function(resp)  {
        
        if(resp['status'] == 1){
            
            var tbls ='';
             // Loop through the array
            for (var i = 0; i < resp['data'].length; i++) {
                isServiceNotAvl = 0;
                
                var CardServiceId = resp['data'][i]['id'];
                var CardService = resp['data'][i]['CardService'];
                
                
                tbls +='<div class="col-12">';
                tbls +='<input type="checkbox" value="'+CardServiceId+'" id="myServiceCheckbox_'+CardServiceId+'" name="myServiceCheckboxName">  '+CardService+'';
                tbls +='</div>';
            }
            
            
            $('#serviceDataList').html(tbls);
            
             // Loop through the array
                for (var i = 0; i < arrayOfNumbers.length; i++) {
                    $('#myServiceCheckbox_'+arrayOfNumbers[i]).prop('checked', true);
                }
            
            
            
        }else $('#serviceDataList').html('');
        
        
      
        
   
    }
    data = { "function": 'AlbumSubscription',"method": "getCardServiceState" , "selState":selState};
    
    apiCall(data,successFn);
    
}
    
    
    
 
 


</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>