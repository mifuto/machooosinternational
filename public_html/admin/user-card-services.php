<?php 
include_once('config.php');
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

<script src="assets/js/bootstrap.bundle.min.js" ></script>

  <style>
    .price-col {
      padding: 30px;
      text-align: center;
      border: 1px solid #e8e8e8;
      background: #fff;
      padding-top: 10px;
    }

    .price-col .card-action {
      text-align: right;
      padding-bottom: 15px;
      height: 20px;
      margin: 10px -3px;
    }

    .price-col .card-action i {
      float: right;
    }

    .price-col.feature {
      border: 1px solid #222;
      background: #222;
      color: #fff;
    }

    .price-col.feature1 {
      border: 1px solid #222;
      background:  #4d0000;
      color: #fff;
    }

    .price-col h1 {
      margin-bottom: 30px;
      text-transform: uppercase;
      font-size: 16px;
    }

    .price-col.feature h1 {
      color: #cc0000;
    }
    .price-col.feature1 h1 {
      color: #fff;
    }

    .price-col .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid #e5e5e5;
      border-bottom: 1px solid #e5e5e5;
    }

    .price-col.feature .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid rgba(255, 255, 255, .2);
      border-bottom: 1px solid rgba(255, 255, 255, .2);
    }
    .price-col.feature1 .p-value {
      margin-bottom: 20px;
      padding: 20px 0;
      border-top: 1px solid rgba(255, 255, 255, .2);
      border-bottom: 1px solid rgba(255, 255, 255, .2);
    }
    .price-col .dollar {
      font-size: 42px;
      font-weight: normal;
    }

    .price-col .dollar span {
      margin-left: -10px;
      font-size: 16px;
    }

    .price-col .duration {
      text-transform: uppercase;
      font-size: 12px;
    }

    .price-col ul {
      display: block;
      margin-bottom: 20px;
      padding: 0;
      list-style: none;
    }

    .price-col ul {
      display: block;
      margin-bottom: 20px;
      padding: 0;
      list-style: none;
    }

    .price-col.feature ul li {
      color: #7d7d7d;
    }
    .price-col.feature1 ul li {
      color: #ffcccc;
    }
    .price-col ul li {
      margin-bottom: 15px;
      color: #222;
    }

    .price-col .p-btn {
      display: inline-block;
      display: inherit;
      padding: 15px 20px;
      text-transform: uppercase;
      color: #222;
      border: 1px solid #e8e8e8;
      font-family: 'Abel', sans-serif;
      font-weight: normal;
      letter-spacing: 2px;
    }

    .price-col.feature .p-btn, .price-col.feature .p-btn:hover {
      color: #222;
      background: #fff;
    }
    .price-col.feature1 .p-btn, .price-col.feature1 .p-btn:hover {
      color: #222;
      background: #fff;
    }
  </style>

    <div class="pagetitle">
      <h1>Card Services</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Card services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section id="sec-list" class="section">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <h5 class="card-title mb-4">Card Services</h5>
            </div>
            
             <div class="col-md-3 mt-3">
                 
                 <select class="form-control select2" aria-label="Default select example" id="selServiceProvider1" name="selServiceProvider1" onchange="getAllCards();">
                     <option selected value=''>Select service provider</option>
                            </select>
            
                       
              </div>
            
            
            
            <div class="col-md-6">
              <button class="btn btn-primary float-end mt-3" onclick="showAddCard();">Add New Service</button>
            </div>
          </div>
          
          <div class="row" id="blk-plans-on">
              
                <table class="table table-striped mt-4" id="ListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service provider</th>
                          <th scope="col">Service</th>
                        <th scope="col">Card Service</th>
                        
                          <th scope="col">Price</th>
                        <th scope="col"> Max members</th>
                        <th scope="col"> Extra price</th>
                        <th scope="col"> Shoot </th>
                        <th scope="col"> Finish time </th>
                      
                      
                        <th scope="col">Created On</th>
                        <th scope="col"></th>

                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>

        

          </div>
        </div>
      </div>
    </section>


    <section id="sec-edit" class="section d-none">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Services</h5>
          <form action="" id="frm-subs">
            <div class="row">
                
                
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label text-dark">Service provider</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selServiceProvider" name="selServiceProvider" onchange="getServices('selService');">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Service provider!.
                        </div>
                    </div>
                    
                </div>
                
                
                 <div class="row mb-3">
                    <label for="" class="col-12 col-form-label text-dark">Service</label>
                   
                    <div class="col-12">
                        
                         <select class="form-control select2" aria-label="Default select example" id="selService" name="selService">
                            </select>
                        
                        
                        
                        <div class="invalid-feedback">
                        Please select the Service provider!.
                        </div>
                    </div>
                    
                </div>
                
                
                <div class="col-12">
                    <label for="CouponCode" class="col-sm-12 col-form-label">Card Service</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="CardService" name="CardService">
                        </textarea>
                      <div class="invalid-feedback">
                        Plese enter the service!.
                      </div>
                    </div>
                  </div>
                  
                </div>
                
                
                 <div class="row mb-3">
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Actual amount</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpAamount" name="inpAamount" onchange="disTotalPayableAmt();">
        
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
                                <input type="text" class="form-control" id="inpDamount" name="inpDamount" onchange="disTotalPayableAmt();">
        
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
                
                    
                    
                        
                <div class="row mb-3 ">
                    <label for="" class="col-12 col-form-label text-dark">Allowed maximum numbers of family members</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpNumberOfMembers" name="inpNumberOfMembers">

                        <div class="invalid-feedback">
                        Please enter the Allowed maximum numbers of family members!.
                        </div>
                    </div>
                   
                </div>
                
                <div class="row mb-3 ">
                    <label for="" class="col-12 col-form-label text-dark">Extra price per head</label>
                    <div class="col-12">
                        <input type="text" class="form-control" id="inpExtraPrice" name="inpExtraPrice">

                        <div class="invalid-feedback">
                        Please enter the Extra price per head!.
                        </div>
                    </div>
                   
                </div>
                
                
                <div class="row mb-3">
                  
                    
                    <div class="col-6">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Number of photographer</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selPhotographer" name="selPhotographer" >
                                     <option value="0"  >0 photographer</option>
                                     <option value="1"  >1 photographer</option>
                                     <option value="2"  >2 photographer</option>
                                     <option value="3"  >3 photographer</option>
                                     <option value="4"  >4 photographer</option>
                                     <option value="5"  >5 photographer</option>
                                     <option value="6"  >6 photographer</option>
                                    </select>
                                
                              
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-6">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Number of videographer</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selVideographer" name="selVideographer" >
                                     <option value="0"  >0 videographer</option>
                                     <option value="1"  >1 videographer</option>
                                     <option value="2"  >2 videographer</option>
                                     <option value="3"  >3 videographer</option>
                                     <option value="4"  >4 videographer</option>
                                     <option value="5"  >5 videographer</option>
                                     <option value="6"  >6 videographer</option>
                                    </select>
                                
                              
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                
                
               
                
                
                <div class="row mb-3">
                  
                    
                    <div class="col-4">
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">Finish time</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpFinishTime" name="inpFinishTime" value="30">
        
                                <div class="invalid-feedback">
                                Please enter finish time!.
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-4">
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label">&nbsp;</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selFinishTimeType" name="selFinishTimeType" >
                                     <option value="min"  selected>min</option>
                                     <option value="hr"  >hr</option>
                                    </select>
                                
                              
                            </div>
                            
                        </div>
                                
                    </div>
                    
                </div>
                    
                
              
            
          
           
            

            <div class="row mb-3 mt-5">
              <div class="col-sm-6"></div>
              <div class="col-sm-6">
                  <div class="float-right">
                    <input type="hidden" id="hiddenSubId" name="hiddenSubId" value="">
                    <button type="button" id="submitButton" class="btn btn-primary float-end">Save</button>
                    <button class="btn btn-primary float-end d-none" type="button" id="submitLoadingButton" disabled>
                      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                      Please wait...
                    </button>
                    <div class="d-inline float-end" style="width: 15px; display: inline-block;">&nbsp;</div>
                    <button type="button" class="btn btn-danger float-end mr-3" onclick="closeCardsDiv();">Cancel</button>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>

    <div id="popover-content" style="display:none">
      <button class="pop-sync"></button>
      <button class="pop-delete"></button>
    </div>
    
    
    
    
    
    
<script>

 var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    var idEditService = false;

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
    data = { "function": 'SystemManage',"method": "getServiceProviderForAdminSide" };
    
    apiCall(data,successFn);
    
}

function getServices(selectId,val="") {
    
    if(idEditService && val ==""){
        idEditService = false;
        return false;
    }
    
    var selServiceProvider = $('#selServiceProvider').val();
    

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select service</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServicesForAdminSide","selServiceProvider":selServiceProvider };
    
    apiCall(data,successFn);
    
}



 function getAllCards() {
     
     var selServiceProvider1 = $('#selServiceProvider1').val();

    postData = {
      function: 'AlbumSubscription',
      method: "getAlluserCardservicesList",
      'selServiceProvider':selServiceProvider1
    }

    console.log(postData);

    successFn = function(resp) {
      console.log(resp);

      if(resp.status == 1) {
          
           $('#ListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ListTable').DataTable({
                "language": {
                    "emptyTable": "No cards available"
                },
                "data": eventList,
                "aaSorting": [],
                "columns": [
                 { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  meta.row + 1;
                    }
                  },
                  
                  { "data": "company_name"},
                   { "data": "service_name"},
                   { "data": "CardService"},
                   
                   
                    { "data": null,
                render: function ( data ) {
                    
                    var amount = data['actual_amt'];
                    var discout = data['discount_amt'];
                    var discout_type = data['discount_type'];
                    
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
                   

                  
                   { "data": "num_of_member"},
                   
                      { "data": null,
                        render: function ( data ) {
                            
                            return "₹"+data['extra_price'];
        
                        }
                      },
                
                      { "data": null,
                        render: function ( data ) {
                            
                            return data['photographers']+" photographer <br> "+data['videographers']+" videographer";
        
                        }
                      },
                   
                   
                   

                    { "data": null,
                        render: function ( data ) {
                            
                            return data['finish_time']+" "+data['finish_time_type'];
        
                        }
                      },
                
                
                 
              { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['created_on']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
            
              { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  '<a class="text-primary" href="javascript:void(0);" onclick="editCard('+data+')"><i class="bx bxs-edit"></i></a><a class="text-danger" href="javascript:void(0);" onclick="deleteCard('+data+')"><i class="bi bi-trash"></i></a>';
                    }
                  },
                
                ]
            });
       


        closeCardsDiv();
      }
    }

    apiCall(postData,successFn);
  }







  showAddCard = () =>{
    // alert("ddfdfd");
    $("#sec-list").addClass("d-none");
    $('#sec-edit').removeClass("d-none");

    $("#hiddenSubId").val("");
    
      $("#selServiceProvider").val("").trigger('change');
       $("#selService").val("").trigger('change');
       
       $("#CardService").val('');
       
       $("#inpAamount").val("");
       $("#inpDamount").val("");
       $('#disTotalpayableamount').html('');
       $("#selDiscoutType").val("1").trigger('change');
       
       $("#inpNumberOfMembers").val("");
       $("#inpExtraPrice").val("");
       
       $("#inpFinishTime").val(30);
       $("#selFinishTimeType").val("min").trigger('change');
       
       $("#selPhotographer").val("0").trigger('change');
       $("#selVideographer").val("0").trigger('change');
       
    
     
    
    $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');


  }
  
  
  function editCard(id){
      
      showAddCard();
      
      postData = {
        function: 'AlbumSubscription',
        method: "getUserCardServiceOne",
        id: id,
      }

      console.log(postData);

      successFn = function(resp) {
        // console.log(resp);
        
        var data = resp.data;

        $("#hiddenSubId").val(data[0]['id']);
        
        $("#CardService").val(data[0]['CardService']);
        
        
         $("#selServiceProvider").val(data[0]['provider_id']).trigger('change');
         idEditService = true;
         
         getServices('selService',data[0]['service_id']);
         

       $("#inpAamount").val(data[0]['actual_amt']);
       $("#inpDamount").val(data[0]['discount_amt']);
       $("#selDiscoutType").val(data[0]['discount_type']).trigger('change');
       
       $("#inpNumberOfMembers").val(data[0]['num_of_member']);
       $("#inpExtraPrice").val(data[0]['extra_price']);
       
       $("#inpFinishTime").val(data[0]['finish_time']);
       $("#selFinishTimeType").val(data[0]['finish_time_type']).trigger('change');
       
       $("#selPhotographer").val(data[0]['photographers']).trigger('change');
       $("#selVideographer").val(data[0]['videographers']).trigger('change');
       
        

      }

      apiCall(postData,successFn);
  }


  $(document).ready(function(){
      
       getServiceProvider('selServiceProvider');
       getServices('selService');
      getServiceProvider('selServiceProvider1');
      
  getAllCards();
  
 

    $("#submitButton").on('click', function(e){
      e.preventDefault();
      
      
      $("#selServiceProvider").removeClass('is-invalid');
      $("#selService").removeClass('is-invalid');
      $("#CardService").removeClass('is-invalid');
      $("#inpAamount").removeClass('is-invalid');
      $("#inpDamount").removeClass('is-invalid');
      $("#inpNumberOfMembers").removeClass('is-invalid');
      $("#inpFinishTime").removeClass('is-invalid');
      $("#inpExtraPrice").removeClass('is-invalid');
      

      selServiceProvider = $("#selServiceProvider").val();
      selService = $("#selService").val();
      CardService = $("#CardService").val();
      inpAamount = $("#inpAamount").val();
      inpDamount = $("#inpDamount").val();
      selDiscoutType = $("#selDiscoutType").val();
      inpNumberOfMembers = $("#inpNumberOfMembers").val();
      inpExtraPrice = $("#inpExtraPrice").val();
      inpFinishTime = $("#inpFinishTime").val();
      selFinishTimeType = $("#selFinishTimeType").val();
      
      selPhotographer = $("#selPhotographer").val();
      selVideographer = $("#selVideographer").val();
      
      hasErr = false;
      
       if(selServiceProvider.trim() == "") {
        hasErr = true;
        $("#selServiceProvider").addClass('is-invalid');
      }
      
       if(selService.trim() == "") {
        hasErr = true;
        $("#selService").addClass('is-invalid');
      }
      
      
       if(CardService.trim() == "") {
        hasErr = true;
        $("#CardService").addClass('is-invalid');
      }
      
       if(inpAamount.trim() == "") {
        hasErr = true;
        $("#inpAamount").addClass('is-invalid');
      }
      
        if(inpDamount.trim() == "") {
        hasErr = true;
        $("#inpDamount").addClass('is-invalid');
      }
      
       
       if(inpNumberOfMembers.trim() == "") {
        hasErr = true;
        $("#inpNumberOfMembers").addClass('is-invalid');
      }
      
       if(inpExtraPrice.trim() == "") {
        hasErr = true;
        $("#inpExtraPrice").addClass('is-invalid');
      }
      
         if(inpFinishTime.trim() == "") {
        hasErr = true;
        $("#inpFinishTime").addClass('is-invalid');
      }
      
       if(hasErr) {
        return false;
      }
      
    
      var id = $("#hiddenSubId").val();
      var save = 'add';
      if(id !="") var save = 'update';
      
      $('#submitButton').addClass('d-none');
      $('#submitLoadingButton').removeClass('d-none');
     
      postData = {
        function: 'AlbumSubscription',
        method: "saveUserCardService",
        
        selServiceProvider: selServiceProvider,
        selService: selService,
        CardService: CardService,
        inpAamount: inpAamount,
        inpDamount: inpDamount,
        selDiscoutType: selDiscoutType,
        inpNumberOfMembers: inpNumberOfMembers,
        inpExtraPrice: inpExtraPrice,
        inpFinishTime: inpFinishTime,
        selFinishTimeType: selFinishTimeType,
        selPhotographer: selPhotographer,
        selVideographer: selVideographer,

        save:save,
        id:id,
      }
      
   
      console.log(postData);

      successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Success',
              "Successfully "+save+" service",
              'success'
            )
            
             getAllCards();

          }else{
            Swal.fire(
              'Error',
              resp.data,
              'error'
            )
          }
        
        $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');
        
        
        
      }

      apiCall(postData,successFn);

    });
  });
  
  
  
  
  
  
  
  

  


 
  
   closeCardsDiv = () =>{
        $("#sec-list").removeClass("d-none");
        $('#sec-edit').addClass("d-none");
      }


  function removeErrAlert(id){
    $("#"+id).removeClass('is-invalid');
  }

  function deleteCard(id){

    Swal.fire({
      title: 'Are you sure to delete?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Delete'
    }).then((result) => {
      if (result.isConfirmed) {

        postData = {
          function: 'AlbumSubscription',
          method: "deleteUserCardService",
          id: id,
        }

        console.log(postData);

        successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Deleted',
              resp.data,
              'success'
            )
          }else{
            Swal.fire(
              'Error',
              resp.data,
              'error'
            )
          }
          getAllCards();
        }

        apiCall(postData,successFn);
       



      }
    })

    return false;

      
  }

  

</script>
<?php 

include("templates/footer.php")

?>