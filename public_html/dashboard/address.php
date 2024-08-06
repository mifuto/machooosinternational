 <?php
 
 include("header.php");
 
 
$sql1 = "SELECT b.*,c.short_name FROM tblcontacts a left join tblclients b on a.userid = b.userid left join tblcountries c on b.country = c.country_id WHERE a.id='$user_id' "; 

    
$result1 = $DBC->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

$sql2 = "SELECT country_id,short_name FROM tblcountries "; 
$countryData = [];

    
$result2 = $DBC->query($sql2);
 $count2 = mysqli_num_rows($result2);


    if($count2 > 0) {		
        while ($row = mysqli_fetch_assoc($result2)) {
            array_push($countryData,$row);
        }
    }
    
  

?>

        <!-- partial -->
        <div class="content-wrapper">
          <h3 class="page-heading mb-4">Address</h3>
          
          
           <div class="card-deck" id='viewAddress'>
                        <div class="card col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                          <div class="card-body">
                            <h5 class="card-title mb-2">Your billing address</h5><hr>
                            <div class="row d-flex align-items-left justify-items-left flex-column" style="padding-left:20px;">
                             
                            <h6 class="text-left bolder"><?=$row1['firstname'];?> <?=$row1['lastname'];?></h6>
                              <p class="text-muted text-left">
                                <?=$row1['address'];?>
                              </p>
                              
                              
                              <h6 class="text-left text-muted"><?=$row1['city'];?>, <?=$row1['state'];?>, <?=$row1['short_name'];?></h6>
                              <h6 class="text-left bolder text-muted"><?=$row1['zip'];?></h6>
                              
                              <div class="text-right ">
                                <button type="button" onclick="return editAddress();" class="btn btn-primary mr-2">Change</button>
                              </div>
                              
                             
                              
                            </div>
                          </div>
                        </div>
                    
                    </div>
          
         
            
            
            
            
            <div class="row mb-2 d-none" id="editForm">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Edit address</h5>
                      <form class="forms-sample" >
                          
                        <div class="form-group">
                          <label for="InputCountry">Select country</label>

                            <select class="form-control p-input" id="InputCountry" onchange="changeCountry();">
                              <option value="" selected>-- Select country -- </option>
                              <?php
                                foreach ($countryData as $key => $ctry ) { 
                                
                                    $country_id = $ctry['country_id'];
                                    $short_name = $ctry['short_name'];
                                    if($country_id == $row1['country']) $select = 'selected';
                                    else $select = '';
                                    
                                    
                                ?>
                                
                                <option value="<?=$country_id;?>" <?=$select?> ><?=$short_name;?> </option>
                                <?php } ?>
                            </select>
                            <div id="countryError" class="error-message text-danger"></div>
                          
                          
                          
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select state</label>
                          <select class="form-control p-input" id="InputState" onchange="changeState();" value="<?=$row1['state'];?>">
                            </select>
                          
                          <div id="stateError" class="error-message text-danger"></div>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Select district</label>
                          <select class="form-control p-input" id="InputCity" value="<?=$row1['city'];?>">
                            </select>
                          
                          
                          <div id="cityError" class="error-message text-danger"></div>
                        </div>
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Zip </label>
                          <input type="text" class="form-control p-input" id="InputZip" value="<?=$row1['zip'];?>"  placeholder="Enter zip">
                          <div id="zipError" class="error-message text-danger"></div>
                        </div>
                        
                        <div class="form-group" style="flex: 0 0 100% ;max-width: 100%;">
                          <label for="exampleTextarea">Enter full address</label>
                          <textarea class="form-control p-input" id="TextAddress" rows="5" placeholder="Enter full address...."><?=$row1['address'];?></textarea>
                          <div id="addressError" class="error-message text-danger"></div>
                        </div>
                        
                      
                        
                        <div class="form-group">
                          <button class="btn btn-primary" id="updateButton" onclick="return validateAddress();">Update</button>
                          <button onclick="showAddress();" class="btn btn-danger">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
             </div>
          
          
          
        </div>
        
        
      
        
<?php
   
include("footer.php");
?>

 <script>
  
    document.getElementById("menu1").classList.remove("active");
    document.getElementById("menu2").classList.remove("active");
    document.getElementById("menu3").classList.add("active");
    document.getElementById("menu5").classList.remove("active");
    document.getElementById("menu4").classList.remove("active");
    document.getElementById("menu8").classList.remove("active");
    
    
    function editAddress(){
        document.getElementById("editForm").classList.remove("d-none");
        document.getElementById("viewAddress").classList.add("d-none");
        changeCountry();
    }
    
    function showAddress(){
        document.getElementById("editForm").classList.add("d-none");
        document.getElementById("viewAddress").classList.remove("d-none");
    }
    
    
     function changeCountry(){
        var selCounty = $('#InputCountry').val();
        var stateVal = '<?=$row1['state'];?>';
        
        
         var postData = {
            function: 'SystemManage',
            method: "getState",
            selCounty: selCounty,
          
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                
                 var users = data.data;
                  var options = "<option selected value=''>Select State</option>";
                  $.each(users, function(key,value) {
                    // console.log(value.id);
                    if(stateVal == value.state) options += "<option value='"+value.state+"' selected>"+value.state+"</option>";
                    else options += "<option value='"+value.state+"'>"+value.state+"</option>";
                  });
                //   alert("#"+selectId);
            
                  $("#InputState").html(options);

                  changeState();
                    
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
    }
    
    
     function changeState(){
        var selState = $('#InputState').val();
        var cityVal = '<?=$row1['city'];?>';

          var postData = {
            function: 'SystemManage',
            method: "getCity",
            selState: selState,
          
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                
                 var users = data.data;
                  var options = "<option selected value=''>Select District</option>";
                  $.each(users, function(key,value) {
                    // console.log(value.id);
                    if(cityVal == value.city) options += "<option value='"+value.city+"' selected>"+value.city+"</option>";
                    else options += "<option value='"+value.city+"'>"+value.city+"</option>";
                  });
                //   alert("#"+selectId);
            
                  $("#InputCity").html(options);

            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
        
    }
    
    
    
    
    
    
    function validateAddress(){
        var InputCountry = document.getElementById("InputCountry").value;
        var InputState = document.getElementById("InputState").value;
        var InputCity = document.getElementById("InputCity").value;
        var InputZip = document.getElementById("InputZip").value;
        var TextAddress = document.getElementById("TextAddress").value;
        
        if(InputCountry == ""){
            showError("countryError", "Please select a Country.");
            return false;
        }
        showError("countryError", "");
        
        if(InputState == ""){
            showError("stateError", "Please select a State.");
            return false;
        }
        showError("stateError", "");
        
        if(InputCity == ""){
            showError("cityError", "Please select a District.");
            return false;
        }
        showError("cityError", "");
        
        if(InputZip == ""){
            showError("zipError", "Please enter a zip.");
            return false;
        }
        showError("zipError", "");
        
        if(TextAddress == ""){
            showError("addressError", "Please enter a address.");
            return false;
        }
        showError("addressError", "");
        
        document.getElementById("updateButton").disabled = true;
        document.getElementById("updateButton").innerHTML = 'Please wait...';
        
         var postData = {
            function: 'AlbumSubscription',
            method: "validateAddress",
            InputCountry: InputCountry,
            InputState: InputState,
            InputCity: InputCity,
            InputZip: InputZip,
            TextAddress: TextAddress,
            userid:'<?=$row1['userid'];?>',
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                console.log(data.status);
                //called when successful
                if (data.status == 1) {
                window.location.href = "address.php";
                }
                document.getElementById("updateButton").disabled = false;
                document.getElementById("updateButton").innerHTML = 'Update';
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
                document.getElementById("updateButton").disabled = false;
                document.getElementById("updateButton").innerHTML = 'Update';
            }
        });
        
       return false;
        
    }
    
    // Function to display an error message
    function showError(elementId, message) {
        var errorContainer = document.getElementById(elementId);
        if (errorContainer) {
            errorContainer.innerHTML = message;
        }
    }
  
  

</script>