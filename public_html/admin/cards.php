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
      <h1>Cards</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Cards</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section id="sec-list" class="section">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <h5 class="card-title mb-4">Cards</h5>
            </div>
            
             <div class="col-md-3 mt-3">
            
                       
              </div>
            
            
            
            <div class="col-md-6">
              <button class="btn btn-primary float-end mt-3" onclick="showAddCard();">Add New Card</button>
            </div>
          </div>
          
          <div class="row" id="blk-plans-on">
              
                <table class="table table-striped mt-4" id="ListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Card Name</th>
                        <th scope="col">County</th>
                        <th scope="col"> State</th>
                      
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
          <h5 class="card-title mb-4">Cards</h5>
          <form action="" id="frm-subs">
            <div class="row">
                
              <div class="col-6">
                <label for="CouponCode" class="col-sm-12 col-form-label">Card Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="CardName" name="CardName">
                  <div class="invalid-feedback">
                    Plese enter the card name!.
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row">
              
              
              
              <div class="col-6">
                <label for="" class="col-sm-12 col-form-label">County</label>
                <div class="col-sm-12">
                  <select class="form-control select2" aria-label="Default select example" id="selCounty" name="selCounty" onchange="getState('selState');">
                                    </select>
                  <div class="invalid-feedback">
                                Please select the County!.
                                </div>
                </div>
              </div>
              
              
              <div class="col-6">
                <label for="" class="col-sm-12 col-form-label">State</label>
                <div class="col-sm-12">
                                
                                     <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" multiple>
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the State!.
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
  showAddCard = () =>{
    // alert("ddfdfd");
    $("#sec-list").addClass("d-none");
    $('#sec-edit').removeClass("d-none");

    $("#hiddenSubId").val("");
    
    $("#CardName").val('');
    
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
   
    
    $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');


  }

    
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    

  $(document).ready(function(){
  getAllCards();
  
   getCounty("selCounty");
       getState('selState');
  
  
  

    $("#submitButton").on('click', function(e){
      e.preventDefault();

      CardName = $("#CardName").val();
      selCounty = $("#selCounty").val();
      
      $("#CardName").removeClass('is-invalid');
      $("#selCounty").removeClass('is-invalid');
      $("#selState").removeClass('is-invalid');
     
     
      hasErr = false;

      if(CardName.trim() == "") {
        hasErr = true;
        $("#CardName").addClass('is-invalid');
      }

      if(selCounty.trim() == "") {
        hasErr = true;
        $("#selCounty").addClass('is-invalid');
      }
      
       var mulSel = $('#selState').val();
        if(mulSel == ''){
            $('#selState').addClass('is-invalid');
            return false;
        }
        $('#selState').removeClass('is-invalid');

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
        method: "saveCards",
        CardName: CardName,
        selCounty: selCounty,
        'multipleSel': mulSel.toString(),
        save:save,
        id:id,
      }

      console.log(postData);

      successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Success',
              resp.data,
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
    //   $("#"+selectId).select2();
      
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


  
  

  function editCard(id){
      
      showAddCard();
      
      postData = {
        function: 'AlbumSubscription',
        method: "getCardOne",
        id: id,
      }

      console.log(postData);

      successFn = function(resp) {
        // console.log(resp);
        
        var data = resp.data;

        $("#hiddenSubId").val(data[0]['id']);
        
        $("#CardName").val(data[0]['CardName']);
        
         $("#selCounty").val(data[0]['county_id']).trigger('change');
       
        var valuesArray = data[0]['state_id'].split(',').map(Number);
        
        getState('selState',valuesArray);
        
     

      }

      apiCall(postData,successFn);
  }


  function getAllCards() {
     
    postData = {
      function: 'AlbumSubscription',
      method: "getAllCards",
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
                  { "data": "CardName"},
                  { "data": "county_id"},
                  { "data": "state_id"},
                 
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
          method: "deleteCard",
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