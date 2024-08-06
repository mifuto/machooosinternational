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
      <h1>coupons</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">coupons</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section id="sec-list" class="section">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <h5 class="card-title mb-4">coupons</h5>
            </div>
            
           
            
            
            <div class="col-md-9">
              <button class="btn btn-primary float-end mt-3" onclick="showAddCoupon();">Add New Coupon</button>
            </div>
          </div>
          
          <div class="row" id="blk-plans-on">
              
                <table class="table table-striped mt-4" id="ListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Coupon Code</th>
                        <th scope="col"> Start Date</th>
                        <th scope="col"> End Date</th>
                        <th scope="col">Coupon Discount</th>
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
          <h5 class="card-title mb-4">Subscription plan</h5>
          <form action="" id="frm-subs">
            <div class="row">
              <div class="col-lg-6">
                <label for="CouponCode" class="col-sm-12 col-form-label">Coupon code</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="CouponCode" name="CouponCode" onchange="removeErrAlert('CouponCode');">
                  <div class="invalid-feedback">
                    Plese enter the coupon code!.
                  </div>
                </div>
              </div>
             
              
               <div class="col-lg-6">
                <label for="CouponsStartDate" class="col-sm-12 col-form-label">Coupon Start Date</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" id="CouponsStartDate" name="CouponsStartDate" onchange="removeErrAlert('CouponsStartDate');">
                  <div class="invalid-feedback">
                    Plese select coupon start date.
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="CouponsEndDate" class="col-sm-12 col-form-label">Coupon End Date</label>
                <div class="col-sm-12">
                  <input type="date" class="form-control" id="CouponsEndDate" name="CouponsEndDate" onchange="removeErrAlert('CouponsEndDate');">
                  <div class="invalid-feedback">
                    Plese select coupon end date.
                  </div>
                </div>
              </div>
              
              
               <div class="col-lg-6">
                <label class="col-sm-12 col-form-label">Discount type</label>
                <div class="col-sm-12">
                  <select name="DiscountType" id="DiscountType" class="form-control" onchange="removeErrAlert('DiscountType');">
                    <option value="">-- Select discount type --</option>
                    <option value="1">Amount</option>
                    <option value="2">Percentage</option>
                   
                  </select>
                  <div class="invalid-feedback">
                    Plese select discount type!.
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                <label for="CouponDiscount" class="col-sm-12 col-form-label">Coupon Discount</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" id="CouponDiscount" name="CouponDiscount" onchange="removeErrAlert('CouponDiscount');">
                  <div class="invalid-feedback">
                    Plese enter coupons discount amount or percentage.
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
                    <button type="button" class="btn btn-danger float-end mr-3" onclick="closeCouponDiscount();">Cancel</button>
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
  showAddCoupon = () =>{
    // alert("ddfdfd");
    $("#sec-list").addClass("d-none");
    $('#sec-edit').removeClass("d-none");

    $("#hiddenSubId").val("");
    $("#CouponCode").val('');
    $("#CouponsEndDate").val('');
    $("#CouponsStartDate").val('');
    
    $("#DiscountType").val('');
    $("#CouponDiscount").val('');
    
    
   
    
    $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');


  }

    
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    

  $(document).ready(function(){
  getSubCouponDiscount();

    $("#submitButton").on('click', function(e){
      e.preventDefault();

      CouponCode = $("#CouponCode").val();
      CouponsEndDate = $("#CouponsEndDate").val();
      CouponsStartDate = $("#CouponsStartDate").val();
     
      DiscountType = $("#DiscountType").val();
      CouponDiscount = $("#CouponDiscount").val();
      
      $("#CouponCode").removeClass('is-invalid');
      $("#CouponsEndDate").removeClass('is-invalid');
      $("#CouponsStartDate").removeClass('is-invalid');
      
      $("#DiscountType").removeClass('is-invalid');
      $("#CouponDiscount").removeClass('is-invalid');
   
     
      hasErr = false;

      if(CouponCode.trim() == "") {
        hasErr = true;
        $("#CouponCode").addClass('is-invalid');
      }

   

      if(CouponsEndDate.trim() == "") {
        hasErr = true;
        $("#CouponsEndDate").addClass('is-invalid');
      }

      if(CouponsStartDate.trim() == "") {
        hasErr = true;
        $("#CouponsStartDate").addClass('is-invalid');
      }
      
       if(DiscountType.trim() == "") {
        hasErr = true;
        $("#DiscountType").addClass('is-invalid');
      }

      if(CouponDiscount.trim() == "") {
        hasErr = true;
        $("#CouponDiscount").addClass('is-invalid');
      }
      
     

      if(hasErr) {
        return false;
      }

      id = $("#hiddenSubId").val();
      
     
      
      $('#submitButton').addClass('d-none');
      $('#submitLoadingButton').removeClass('d-none');
     
      postData = {
        function: 'AlbumSubscription',
        method: "saveCardCoupon",
        CouponCode: CouponCode,
        CouponsEndDate: CouponsEndDate,
        CouponsStartDate: CouponsStartDate,
        DiscountType: DiscountType,
        CouponDiscount: CouponDiscount,
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
            
             getSubCouponDiscount();

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
  
  

  function editPlan(id){
      
      showAddCoupon();
      
      postData = {
        function: 'AlbumSubscription',
        method: "getCardCouponOne",
        id: id,
      }

      console.log(postData);

      successFn = function(resp) {
        // console.log(resp);
        
        var data = resp.data;

        $("#hiddenSubId").val(data[0]['id']);
        
        $("#CouponCode").val(data[0]['CouponCode']);
        $("#CouponsEndDate").val(data[0]['CouponsEndDate']);
        $("#CouponsStartDate").val(data[0]['CouponsStartDate']);
        
     
    
    $("#DiscountType").val(data[0]['DiscountType']);
    $("#CouponDiscount").val(data[0]['CouponDiscount']);
        
       



      }

      apiCall(postData,successFn);
  }


  function getSubCouponDiscount() {
      

    postData = {
      function: 'AlbumSubscription',
      method: "getCardCouponDiscount",
    }

    console.log(postData);

    successFn = function(resp) {
      console.log(resp);

      if(resp.status == 1) {
          
           $('#ListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ListTable').DataTable({
                "language": {
                    "emptyTable": "No coupon available"
                },
                "data": eventList,
                "aaSorting": [],
                "columns": [
                 { "data": "id",
                  
                    "render": function ( data, type, full, meta ) {
                        return  meta.row + 1;
                    }
                  },
                  { "data": "CouponCode"},
                
                  
                  { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['CouponsStartDate']);

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
                    
                    var date = new Date(data['CouponsEndDate']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
               { "data": "DiscountType",
                  
                    "render": function ( data, type, full, meta ) {
                        if(data==1) return  '₹'+full['CouponDiscount']+' OFF';
                        else return  full['CouponDiscount']+'% OFF';
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
                        return  '<a class="text-primary" href="javascript:void(0);" onclick="editPlan('+data+')"><i class="bx bxs-edit"></i></a><a class="text-danger" href="javascript:void(0);" onclick="deletePlan('+data+')"><i class="bi bi-trash"></i></a>';
                    }
                  },
                
                ]
            });
       


        closeCouponDiscount();
      }
    }

    apiCall(postData,successFn);
  }
  
   closeCouponDiscount = () =>{
        $("#sec-list").removeClass("d-none");
        $('#sec-edit').addClass("d-none");
      }


  function removeErrAlert(id){
    $("#"+id).removeClass('is-invalid');
  }

  function deletePlan(id){

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
          method: "deleteCardCoupon",
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
          getSubCouponDiscount();
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