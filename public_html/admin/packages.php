<?php 
// include_once('config.php');
include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Sales') === false) {
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
      <h1>Subscription</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Subscription</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section id="sec-list" class="section">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <h5 class="card-title mb-4">Subscription plans</h5>
            </div>
            
             <div class="col-md-3 mt-3">
                <select class="form-control select2" aria-label="Default select example" id="disType" name="disType" onchange="getSubPlans();">
                            <option value="" selected>All albums</option>
                            <option value="1">Online albums</option>
                            <option value="2">Signature albums</option> 
                        </select>
                       
              </div>
            
            
            
            
            
            <div class="col-md-6">
              <button class="btn btn-primary float-end mt-3" onclick="showAddSubscriptionSection();">Add New Subscription</button>
            </div>
          </div>
          
          <div class="row" id="blk-plans-on">

        

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
                <label for="subName" class="col-sm-12 col-form-label">Subscription Name</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="subName" name="subName" onchange="removeErrAlert('subName');">
                  <div class="invalid-feedback">
                    Plese enter the subscription name!.
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <label for="subPeriod" class="col-sm-12 col-form-label">How much year</label>
                <div class="col-sm-12">
                  <select name="subPeriod" id="subPeriod" class="form-control" onchange="removeErrAlert('subPeriod');">
                    <option value="0">-- Select Year --</option>
                    <option value="1">One Year</option>
                    <!--<option value="2">Two Years</option>-->
                    <option value="3">Three Years</option>
                    <!--<option value="4">Four Years</option>-->
                    <option value="5">Five Years</option>
                    <!--<option value="6">Six Years</option>-->
                    <!--<option value="7">Seven Years</option>-->
                    <!--<option value="8">Eight Years</option>-->
                    <!--<option value="9">Nine Years</option>-->
                    <option value="10">Ten Years</option>
                  </select>
                  <div class="invalid-feedback">
                    Plese enter the subscription period!.
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="subAmount" class="col-sm-12 col-form-label">Subscription Amount</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="subAmount" name="subAmount" onchange="removeErrAlert('subAmount');setOfferAmt();">
                  <div class="invalid-feedback">
                    Plese enter the subscription amount!.
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                <label for="subOfferAmount" class="col-sm-12 col-form-label">Subscription Offer (%)</label>
                <div class="col-sm-12">
                  <input type="number" min="0" max="100" value='0' class="form-control" id="subOfferAmount" name="subOfferAmount" onchange="removeErrAlert('subOfferAmount');setOfferAmt();">
                  <div class="invalid-feedback">
                    Plese enter subscription offer (%).
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                <label for="" class="col-sm-12 col-form-label">Final Amount : &#8377;<b id="totalOfferAmt">0</b></label>
                
              </div>
              
              
            </div>
            
            
            <div class="row">
              <div class="col-lg-12">
                <h4 class="card-title mt-4 mb-2">Plan Details</h4>
              </div>

              <div class="col-lg-6">
                <label class="col-sm-12 col-form-label">Select album</label>
                <div class="col-sm-12">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="s" onchange="showHideCount(this.checked)" name="chk-albums" id="chk-signature-album">
                    <label class="form-check-label" for="chk-signature-album">Signature Album</label>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" value="o" name="chk-albums" id="chk-online-album" onchange="changeOnline(this.checked)">
                    <label class="form-check-label" for="chk-online-album" >Online Album</label>
                  </div>
                  <div class="invalid-feedback">
                    Plese select one option!.
                  </div>
                </div>
              </div>
              
              
              
              
              
              <div class="col-lg-6 d-none" id="blk-album-count">
                <div  class="blk-photo-count ">
                  <label for="subAlbumCount" class="col-sm-12 col-form-label">How much album</label>
                  <div class="col-sm-12">
                    <select name="subAlbumCount" id="subAlbumCount" class="form-control" onchange="removeErrAlert('subAlbumCount');">
                      <option value="0">-- Select number of album --</option>
                      <option value="1">1 album</option>
                      <option value="2">2 album</option>
                      <option value="3">3 album</option>
                      <option value="4">4 album</option>
                      <option value="5">5 album</option>
                      <option value="6">6 album</option>
                      <option value="7">7 album</option>
                      <option value="8">8 album</option>
                      <option value="9">9 album</option>
                      <option value="10">10 album</option>
                    </select>
                    <div class="invalid-feedback">
                      Plese select number of album!.
                    </div>
                  </div>
                </div>
              </div>
          
             <div class="col-lg-6 d-none" id="blk-photo-count">
                <div  class="blk-photo-count ">
                  <label for="subPhotoCount" class="col-sm-12 col-form-label">Photo Count</label>
                  <div class="col-sm-12">
                    <select name="subPhotoCount" id="subPhotoCount" class="form-control" onchange="removeErrAlert('subPhotoCount');">
                      <option value="0">-- Select number of images --</option>
                      <!--<option value="499">Upto 499 photos</option>-->
                      <option value="1499">Upto 1499 photos</option>
                      <option value="2999">Upto 2999 photos</option>
                      <option value="4999">Upto 4999 photos</option>
                      <option value="Unlimited">Unlimited</option>
                    </select>
                    <div class="invalid-feedback">
                      Plese select number of images!.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <div class=" d-none" id="featureOA">
                
                  <?php foreach ($planFeatures as $key => $value) { ?>
                  <div class="row mt-4 " >
                    <div class="col-lg-6">
                      <div class="col-sm-12">
                        <div class="form-check form-switch">
                          <input class="form-check-input" name="chk-feature" type="checkbox" value="<?= $key ?>" id="chk-<?= $key ?>" checked>
                          <label class="form-check-label" for="chk-<?= $key ?>"><?= $value ?></label>
                        </div>
                        <div class="invalid-feedback">
                          Plese select atleast one feature!.
                        </div>
                      </div>
                    </div>
    
                  </div>
                <?php } ?>
                    
            </div>
            
            <div class="d-none" id="featureSA">
                
                 <?php foreach ($planFeatures2 as $key2 => $value2) { ?>
                  <div class="row mt-4 " >
                    <div class="col-lg-6">
                      <div class="col-sm-12">
                        <div class="form-check form-switch">
                          <input class="form-check-input" name="chk2-feature" type="checkbox" value="<?= $key2 ?>" id="chk2-<?= $key2 ?>" checked>
                          <label class="form-check-label" for="chk2-<?= $key2 ?>"><?= $value2 ?></label>
                        </div>
                        <div class="invalid-feedback">
                          Plese select atleast one feature!.
                        </div>
                      </div>
                    </div>
    
                  </div>
                <?php } ?>

                
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
                    <button type="button" class="btn btn-danger float-end mr-3" onclick="showSubscriptionListSection();">Cancel</button>
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
  showAddSubscriptionSection = () =>{
    // alert("ddfdfd");
    $("#sec-list").addClass("d-none");
    $('#sec-edit').removeClass("d-none");

    $("#hiddenSubId").val("");
    $("#subName").val('');
    $("#subPeriod").val(0);
    $("#subAmount").val('');
    $("#subOfferAmount").val('');
    
    
    $("#chk-signature-album").prop("checked", false);
    $("#chk-online-album").prop("checked", false);
    
     $("#blk-album-count").addClass("d-none");
     $("#blk-photo-count").addClass("d-none");
     
     
     $("#featureOA").addClass("d-none");
     $("#featureSA").addClass("d-none");
     
      $("#subPhotoCount").val(0);
      $("#subAlbumCount").val(0);
      
      
      $("#totalOfferAmt").html(0);
      
      

    $("input[name='chk-feature']").prop( "checked", true );
    $("input[name='chk2-feature']").prop( "checked", true );
    
    $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');


  }

  showSubscriptionListSection = () =>{
    $("#sec-list").removeClass("d-none");
    $('#sec-edit').addClass("d-none");
  }

  showHideCount = (ischecked) => {
    $("#chk-online-album").prop("checked", false);
    $("#blk-album-count").addClass("d-none");
    
     $("#featureOA").addClass("d-none");
    
  
    if(ischecked) {
      $("#blk-photo-count").removeClass("d-none");
       $("#featureSA").removeClass("d-none");
    
      $("#chk-online-album").closest('.form-switch').removeClass('is-invalid');
      $("#chk-signature-album").closest('.form-switch').removeClass('is-invalid');

    } else {
      $("#blk-photo-count").addClass("d-none");
       $("#featureSA").addClass("d-none");
    
      
      
    }
    
    
  }

  changeOnline = (ischecked) => {
      
     $("#chk-signature-album").prop("checked", false);
    $("#blk-photo-count").addClass("d-none");
    
     $("#featureSA").addClass("d-none");
   
    if(ischecked) {
      $("#blk-album-count").removeClass("d-none");
      $("#chk-signature-album").closest('.form-switch').removeClass('is-invalid');
      $("#chk-online-album").closest('.form-switch').removeClass('is-invalid');
        $("#featureOA").removeClass("d-none");


    } else {
      $("#blk-album-count").addClass("d-none");
          $("#featureOA").addClass("d-none");

      
    }
  }



  var planFeatures = <?= json_encode($planFeatures) ?> ;
  var planFeatures2 = <?= json_encode($planFeatures2) ?> ;

  $(document).ready(function(){
   getSubPlans();
    $("#submitButton").on('click', function(e){
      e.preventDefault();

      name = $("#subName").val();
      period = $("#subPeriod").val();
      amount = $("#subAmount").val();
      pamount = $("#subOfferAmount").val();
      
      signature = $("#chk-signature-album").prop("checked");
      online = $("#chk-online-album").prop("checked");
      
      photoCount = $("#subPhotoCount").val();
      albumCount = $("#subAlbumCount").val();

      feature = [];
      
      $("input[name='chk-feature']:checked").each(function(){
        feature.push(this.value);
      });
      
      feature2 = [];
      
      $("input[name='chk2-feature']:checked").each(function(){
        feature2.push(this.value);
      });

      hasErr = false;

      if(name.trim() == "") {
        hasErr = true;
        $("#subName").addClass('is-invalid');
      }

      if(period.trim() == "" || period.trim() == 0 || period.trim() == "0") {
        hasErr = true;
        $("#subPeriod").addClass('is-invalid');
      }

      if(amount.trim() == "") {
        hasErr = true;
        $("#subAmount").addClass('is-invalid');
      }

      if(pamount.trim() == "") {
        hasErr = true;
        $("#subOfferAmount").addClass('is-invalid');
      }
      
      if(pamount < 0 || pamount > 100){
           hasErr = true;
        $("#subOfferAmount").addClass('is-invalid');
      }

      if(signature) {
        if(photoCount.trim() == "" || photoCount.trim() == 0 || photoCount.trim() == "0") {
          hasErr = true;
          $("#subPhotoCount").addClass('is-invalid');
        }
      }
      
      if(online) {
        if(albumCount.trim() == "" || albumCount.trim() == 0 || albumCount.trim() == "0") {
          hasErr = true;
          $("#subAlbumCount").addClass('is-invalid');
        }
      }

      if(!signature && !online) {
        hasErr = true;
        $("#chk-online-album").closest('.form-switch').addClass('is-invalid');
      }
      
      if(online) {
         if(feature.length <= 0) {
            hasErr = true;
            $("input[name='chk-feature']:first").closest('.form-switch').addClass('is-invalid');
          }
      }
      
      if(signature) {
         if(feature2.length <= 0) {
            hasErr = true;
            $("input[name='chk2-feature']:first").closest('.form-switch').addClass('is-invalid');
          }
      }

     

      if(hasErr) {
        return false;
      }

      id = $("#hiddenSubId").val();
      if(signature){
          feature = feature2;
      }else{
        photoCount = albumCount;
      }
      
      $('#submitButton').addClass('d-none');
      $('#submitLoadingButton').removeClass('d-none');
      
      

      postData = {
        function: 'AlbumSubscription',
        method: "save",
        name: name,
        period: period,
        amount: amount,
        pamount: pamount,
        signature: signature,
        photo_count: photoCount,
        online: online,
        features: feature,
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
          }else{
            Swal.fire(
              'Error',
              resp.data,
              'error'
            )
          }
        getSubPlans();
        
        $('#submitButton').removeClass('d-none');
        $('#submitLoadingButton').addClass('d-none');
        
        
        
      }

      apiCall(postData,successFn);

    });
  });
  
  function setOfferAmt(){
      
      amount = $("#subAmount").val();
      pamount = $("#subOfferAmount").val();
      if(pamount == "") pamount = 0;
      if(amount == "") amount = 0;
      
         var newAmt = ( parseInt(amount) - ( ( parseInt(amount) / 100 ) * parseInt(pamount) ) ).toFixed(2) ;
     
        $("#totalOfferAmt").html(newAmt);
  }

  function editPlan(id){
      
      showAddSubscriptionSection();
      
      postData = {
        function: 'AlbumSubscription',
        method: "getOne",
        id: id,
      }

      console.log(postData);

      successFn = function(resp) {
        // console.log(resp);
        
        var data = resp.data;

        $("#hiddenSubId").val(data[0]['id']);
        
        $("#subName").val(data[0]['name']);
        $("#subPeriod").val(data[0]['period']);
        $("#subAmount").val(data[0]['amount']);
        $("#subOfferAmount").val(data[0]['pamount']);
        
        var newAmt = ( parseInt(data[0]['amount']) - ( ( parseInt(data[0]['amount']) / 100 ) * parseInt(data[0]['pamount']) ) ).toFixed(2) ;
        
        
        $("#totalOfferAmt").html(newAmt);
        
        if(data[0]['signature'] == 1){
          $("#chk-signature-album").prop("checked", true);
          $("#subPhotoCount").val(data[0]['photo_count']);
          $("#blk-photo-count").removeClass("d-none");
          $("#featureSA").removeClass("d-none");
     
          showHideCount(true);
        }
        
        
        if(data[0]['online'] == 1){
          $("#chk-online-album").prop("checked", true);
          $("#blk-album-count").removeClass("d-none");
          $("#subAlbumCount").val(data[0]['photo_count']);
          $("#featureOA").removeClass("d-none");
        }

    
        $("input[name='chk-feature']").prop( "checked", false );
        $("input[name='chk2-feature']").prop( "checked", false );

        const featursArray = data[0]['featurs'].split(",");
        
        if(data[0]['online'] == 1){
             for(var i=0;i<featursArray.length;i++){
              $("#chk-"+featursArray[i]).prop("checked", true);
            }
        }else{
             for(var i=0;i<featursArray.length;i++){
              $("#chk2-"+featursArray[i]).prop("checked", true);
            }
        }


      }

      apiCall(postData,successFn);
  }


  function getSubPlans() {
      
      var disType = $('#disType').val();
      
      
      
    postData = {
      function: 'AlbumSubscription',
      method: "get",
      'disType':disType
    }

    console.log(postData);

    successFn = function(resp) {
      console.log(resp);

      if(resp.status == 1) {
        var html = '';
        if( resp.data.length > 0){
          $.each(resp.data, function(k,v){

            html +='<div class="col-md-3 pt-2">';

            if(v.delete == 1){
              html +='<div class="price-col feature1 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
            }else if(v.is_primary == 1){
              html +='<div class="price-col feature wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
            }else{
              html +='<div class="price-col  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">';
            }

            html +='<div class=" card-action dropdown">';
            html +='<a class="nav-link nav-profile pull-right align-items-center btPpop" href="#" id="dropdownMenuLink" data-toggle="dropdown" >';
            html +='<i data-bs-toggle="dropdown" class="bi bi-three-dots-vertical popover-elem"></i>';

            if(v.active == 1) html +='<i class="bi bi-lightbulb-fill text-warning"></i>';
            else html +='<i class="bi bi-lightbulb-off"></i>';
           

            html +='</a>';

            html +='<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" aria-labelledby="dropdownMenuLink">';
            html +='<ul >';
            if(v.delete == 1){

              html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="restorePlan('+v.id+')"><i class="bi bi-arrow-clockwise"></i><span>Restore</span></a></li>';
              html +='<li><hr class="dropdown-divider"></li>';
              html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="deletePermanent('+v.id+')"><i class="bi bi-trash"></i><span>Permanent delete</span></a></li>';

            }else{

            html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="editPlan('+v.id+')"><i class="bx bxs-edit"></i><span>Edit Plan</span></a></li>';
            // html +='<li><hr class="dropdown-divider"></li>';

            // if(v.is_primary == 1){
            //   html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="setPlanAsPrimary('+v.id+',0,'+v.signature+','+v.online+')"><i class="bi bi-eye"></i><span>Set as Default</span></a></li>';
            // }else{
            //   html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="setPlanAsPrimary('+v.id+',1,'+v.signature+','+v.online+')"><i class="bi bi-eye"></i><span>Set as Primary</span></a></li>';
            // }

            // html +='<li><hr class="dropdown-divider"></li>';

            // if(v.active == 1){
            //   html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="setPlanActivate('+v.id+',0)"><i class="bi bi-check-circle"></i><span>Deactivate</span></a></li>';
            // }else{
            //   html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="setPlanActivate('+v.id+',1)"><i class="bi bi-check-circle-fill"></i><span>Activate</span></a></li>';
            // }

            // html +='<li><hr class="dropdown-divider"></li>';
            // html +='<li><a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" onclick="deletePlan('+v.id+')"><i class="bi bi-trash"></i><span>Delete Plan</span></a></li>';

            }
            html +='</ul>';
            html +='</div>';
            html +='</div>';

            html +='<h5>' + v.name + '</h5>';
            html +='<div class="p-value">';
            
            html +='<div style="font-size: 12px;font-weight: normal;">' + v.pamount  + '% OFF</div>';
            
            var newAmt = ( parseInt(v.amount) - ( ( parseInt(v.amount) / 100 ) * parseInt(v.pamount) ) ).toFixed(2) ;
            
            html +='<div class="dollar" style="font-size: 18px;font-weight: blod;">'+ '&#8377; ' + newAmt + ' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>'+ '&#8377; ' + v.amount + '</del> </label> </div>';
            html +='<div class="duration" style="font-size: 12px;">'+ v.period + (v.period == 1 ?' Year' : ' Years') + '</div>';
            
            
            if(v.online == 1){
             html +='<div style="font-size: 12px;font-weight: normal;">' + v.photo_count  + ' Albums</div>';
            }else if(v.signature == 1){
              html +='<div style="font-size: 12px;font-weight: normal;">' + v.photo_count  + ' Images</div>';
            }
            
            
            
            
            

            if(v.delete == 1){
              var divclr = "bg-dark mt-2 text-white";
            }else if(v.is_primary == 1){
              var divclr = "bg-secondary mt-2 text-white";
            }else{
              var divclr = "bg-success mt-2 text-white";
              
            }
            

            if(v.signature == 1){
              html +='<div class="'+divclr+'" style="padding-top: 6px; padding-bottom: 6px;">';
              html +='<div class="duration p-2" style="font-size: 12px;" >Signature Album  </div>';
            }else if(v.online == 1){
              html +='<div class="'+divclr+'" style="padding-top: 6px; padding-bottom: 6px;">';
              html +='<div class="duration p-2" style="font-size: 12px;">Online Album  </div>';
            }

            

            html +='</div>';

            html +='</div>';
            html +='<ul style="list-style: initial;" align="left">';
            var fet = v.featurs.split(',');
            
            if(v.online == 1){
                $.each(fet, function(i, f) {
                  html +=  '<li style="font-size: 8px;">' + planFeatures[f] + '</li>';
                });
            }else if(v.signature == 1){
                $.each(fet, function(i, f) {
                  html +=  '<li style="font-size: 8px;">' + planFeatures2[f] + '</li>';
                });
            }
            
            
            
            html += '</ul>';

                 

               
                
            html += '<!-- <a href="#" class="p-btn">purchase this plan</a> -->';
            html += '</div>';
            html += '</div>';



          });

        }else{
          html += '<div class="col-md-12 text-center">No subscription plans available</div>';

        }

        

        $("#blk-plans-on").html(html);


        showSubscriptionListSection();
      }
    }

    apiCall(postData,successFn);
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
          method: "delete",
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
          getSubPlans();
        }

        apiCall(postData,successFn);
       



      }
    })

    return false;

      
  }

  function setPlanActivate(id,state){

    if(state == 0) var name = "Deactivate";
    else var name = "Activate";

    Swal.fire({
      title: 'Are you sure to '+name+'?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: name
    }).then((result) => {
      if (result.isConfirmed) {

        postData = {
          function: 'AlbumSubscription',
          method: "setPlanActivate",
          id: id,
          state: state,
        }
        console.log(postData);

        successFn = function(resp) {
            if(resp.status==1){
              Swal.fire(
                'Success',
                'Successfully '+name+'d the plan ',
                'success'
              )
            }else{
              Swal.fire(
                'Error',
                'Failed to '+name+'d the plan ',
                'error'
              )
            }
          getSubPlans();
        }

        apiCall(postData,successFn);
        



      }
    })

    return false;


     
  }

  function setPlanAsPrimary(id,is_set,signature,online){
    postData = {
        function: 'AlbumSubscription',
        method: "setPlanAsPrimary",
        id: id,
        is_set:is_set,
        signature:signature,
        online:online,
      }

      console.log(postData);

      successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Success',
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
        getSubPlans();
      }

      apiCall(postData,successFn);

  }

  function deletePermanent(id){

    Swal.fire({
      title: 'Are you sure?',
      text: "To delete this permanently!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        postData = {
          function: 'AlbumSubscription',
          method: "permanentDelete",
          id: id,
        }

        console.log(postData);

        successFn = function(resp) {
          if(resp.status==1){
            Swal.fire(
              'Success',
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
          getSubPlans();
        }

        apiCall(postData,successFn);
        
        }
    })

    return false;


  

  }

  function restorePlan(id){
      postData = {
        function: 'AlbumSubscription',
        method: "restore",
        id: id,
      }

      successFn = function(resp) {
        if(resp.status==1){
            Swal.fire(
              'Success',
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
        getSubPlans();
      }

      apiCall(postData,successFn);

  }

</script>
<?php 

include("templates/footer.php")

?>