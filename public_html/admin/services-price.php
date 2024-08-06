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
    
    if (strpos($userPermissionsList, 'Service-Provider') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}






?>

    <div class="pagetitle">
      <h1>Service Price</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Price</li>
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
                     <div class="col-4">
                         
                        <div class="row ">
                            <label for="" class="col-12 col-form-label">County</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selCounty" name="selCounty" onchange="getState('selState');">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the County!.
                                </div>
                            </div>
                            
                        </div>
                         
                         
                     </div>
                         
                         <div class="col-4">
                             
                              <div class="row ">
                                <label for="" class="col-12 col-form-label">State</label>
                               
                                <div class="col-12">
                                    
                                     <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" onchange="getCity('selCity');">
                                        </select>
                                    
                                    
                                    
                                    <div class="invalid-feedback">
                                    Please select the State!.
                                    </div>
                                </div>
                                
                            </div>
                
                             
                             
                             
                         </div>
                         
                         <div class="col-4">
                             
                             
                             <div class="row ">
                                <label for="" class="col-12 col-form-label">District</label>
                               
                                <div class="col-12">
                                    
                                     <select class="form-control select2" aria-label="Default select example" id="selCity" name="selCity" multiple>
                                        </select>
                                    
                                    
                                    
                                    <div class="invalid-feedback">
                                    Please select the District!.
                                    </div>
                                </div>
                                
                            </div>
                             
                             
                             
                             
                            </div>
                     
                </div>
                
                <div class="row mb-3">
                    
                    <div class="col-3">
                        
                        
                        <div class="row">
                            <label for="" class="col-12 col-form-label">Linked Attributes</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selPriceCategory" name="selPriceCategory">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the category!.
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        
                    </div>
                    
                    <div class="col-3">
                        
                        
                          <div class="row mb-3">
                                <label for="" class="col-12 col-form-label">Service Type</label>
                               
                                <div class="col-12">
                                    
                                     <select class="form-control select2" aria-label="Default select example" id="selServiceType" name="selServiceType" onchange="getNumberOfMember();">
                                        </select>
                                    
                                    
                                    
                                    <div class="invalid-feedback">
                                    Please select the service type!.
                                    </div>
                                </div>
                                
                            </div>
                                    
                        
                        
                        
                    </div>
                    
                    
                    <div class="col-3">
                        <label for="" class="col-12 col-form-label">Max number of members</label><br>
                        <b class="text-primary" id="numberOfPersonDisplat">--</b>
                       
                        
                        
                    </div>
                    
                    <div class="col-3">
                        
                        <?php 
                        
                            $pricePerHd = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=3"));
                         
                        ?>
                        
                        
                         <div class="row ">
                             <label for="" class="col-12 col-form-label"><?=$pricePerHd['attribute_feild']?></label>
                             <div class="col-12">
                                 
                                 <?php if($pricePerHd['attribute_type'] == 'dropdown'){ ?>
                                 
                                    <select class="form-control select2" aria-label="Default select example" id="extraPricePerHead" name="extraPricePerHead">
                                        <option value="" selected>--select--</option>
                                        <?php for($i=$pricePerHd['attribute_min'];$i<=$pricePerHd['attribute_max'];$i++){ ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        
                                    </select>
                                 
                                    
                                     
                                 <?php }else if($pricePerHd['attribute_type'] == 'dropdown with options'){ 
                                     
                                     $numbers_arr = explode(',', $pricePerHd['attribute_options']);
                                 
                                 
                                 ?>
                                 
                                 
                                    <select class="form-control select2" aria-label="Default select example" id="extraPricePerHead" name="extraPricePerHead">
                                        <option value="" selected>--select--</option>
                                        
                                        <?php foreach ($numbers_arr as $i) { ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        
                                    </select>
                                 
                                 
                                 <?php }else { ?>
                                 
                                    <input type="text" class="form-control" id="extraPricePerHead" name="extraPricePerHead" >
                              
                                 <?php } ?>
                                 
                                
                                
                                
                                
                                <div class="invalid-feedback">
                                   This field is required!
                                </div>
                             </div>
                          </div>
                        
                        
                        
                        
                        
                    </div>
                    
                </div>
                
                <hr>
                
                
                
                <div class="row">
                    
                    <div class="col-4">
                        <label for="" class="col-12 col-form-label"><font color="red"><b>This service minimum time</b></font></label>
                    </div>
                    
                    <div class="col-2">
                        <label for="" class="col-12 col-form-label">PHOTOGRAPHER PRICE</label>
                    </div>
                    
                    <div class="col-2">
                        <label for="" class="col-12 col-form-label">CINEMATOGRAPHER PRICE </label>
                    </div>
                    
                    <div class="col-2">
                        <label for="" class="col-12 col-form-label">PHOTOGRAPHER EXTRA PRICE(Per minute)</label>
                    </div>
                    
                    <div class="col-2">
                        <label for="" class="col-12 col-form-label">CINEMATOGRAPHER EXTRA PRICE (Per minute) </label>
                    </div>
                    
                </div>
                
                
                
                    <?php 
                    
                        $selMins = [];
                        
                        $minitime = $DBC->query("SELECT * FROM tblservicesattributefeild WHERE attribute_id=4");
                        
                        while ($row = mysqli_fetch_assoc($minitime)) {
                           array_push($selMins,$row);
                           
                       }
                       
                       $j = 0;
                       
                       foreach($selMins as $vl){
                           
                           $j ++;
                       
                       ?>
                       
                       <input type="hidden" id="runMinId_<?=$j?>" name="runMinId_<?=$j?>" value="<?=$vl['id']?>">
                       
                       
                       <div class="row">
                    
                            <div class="col-2">
                                <label for="" class="col-12 col-form-label"><?=$vl['attribute_feild']?></label>
                            </div>
                            
                            <div class="col-2">
                                
                                
                                            <div class="row ">
                                             <div class="col-12">
                                                 
                                                 <?php if($vl['attribute_type'] == 'dropdown'){ ?>
                                                 
                                                    <select class="form-control select2" aria-label="Default select example" id="extraMin_<?=$j?>" name="extraMin_<?=$j?>">
                                                        <option value="" selected>minimum time</option>
                                                        <?php for($i=$vl['attribute_min'];$i<=$vl['attribute_max'];$i++){ ?>
                                                            <option value="<?=$i?>"><?=$i?></option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                 
                                                    
                                                     
                                                 <?php }else if($vl['attribute_type'] == 'dropdown with options'){ 
                                                     
                                                     $numbers_arr = explode(',', $vl['attribute_options']);
                                                 
                                                 
                                                 ?>
                                                 
                                                 
                                                    <select class="form-control select2" aria-label="Default select example" id="extraMin_<?=$j?>" name="extraMin_<?=$j?>">
                                                        <option value="" selected>--select--</option>
                                                        
                                                        <?php foreach ($numbers_arr as $i) { ?>
                                                            <option value="<?=$i?>"><?=$i?></option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                 
                                                 
                                                 <?php }else { ?>
                                                 
                                                    <input type="text" class="form-control" id="extraMin_<?=$j?>" name="extraMin_<?=$j?>" >
                                                    
                                               
                                                 
                                                 <?php } ?>
                                                 
                                                
                                                
                                                
                                                
                                                <div class="invalid-feedback">
                                                   This field is required!
                                                </div>
                                             </div>
                                          </div>
                                
                                
                                
                                
                                
                                
                            </div>
                            
                            <div class="col-2">
                                
                                
                                
                                 <?php 
                                 
                                    $fid= 6 + $j;
                        
                                        $pricePerPhto = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$fid"));
                                     
                                    ?>
                                    
                                    
                                     <div class="row ">
                                         <div class="col-12">
                                             
                                             <?php if($pricePerPhto['attribute_type'] == 'dropdown'){ ?>
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="phtoPrice_<?=$j?>" name="phtoPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    <?php for($i=$pricePerPhto['attribute_min'];$i<=$pricePerPhto['attribute_max'];$i++){ ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                                
                                                 
                                             <?php }else if($pricePerPhto['attribute_type'] == 'dropdown with options'){ 
                                                 
                                                 $numbers_arr = explode(',', $pricePerPhto['attribute_options']);
                                             
                                             
                                             ?>
                                             
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="phtoPrice_<?=$j?>" name="phtoPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    
                                                    <?php foreach ($numbers_arr as $i) { ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                             
                                             <?php }else { ?>
                                             
                                                <input type="text" class="form-control" id="phtoPrice_<?=$j?>" name="phtoPrice_<?=$j?>" >
                                                
                                              
                                             
                                             <?php } ?>
                                             
                                            
                                            
                                            
                                            
                                            <div class="invalid-feedback">
                                               This field is required!
                                            </div>
                                         </div>
                                      </div>
                                    
                        
                                
                                
                                
                            
                            </div>
                            
                            <div class="col-2">
                                
                                
                                
                                 <?php 
                                 
                                    $vfeid= 12 + $j;
                        
                                        $pricePerVdo = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$vfeid"));
                                     
                                    ?>
                                    
                                    
                                     <div class="row ">
                                         <div class="col-12">
                                             
                                             <?php if($pricePerVdo['attribute_type'] == 'dropdown'){ ?>
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="vedioPrice_<?=$j?>" name="vedioPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    <?php for($i=$pricePerVdo['attribute_min'];$i<=$pricePerVdo['attribute_max'];$i++){ ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                                
                                                 
                                             <?php }else if($pricePerVdo['attribute_type'] == 'dropdown with options'){ 
                                                 
                                                 $numbers_arr = explode(',', $pricePerVdo['attribute_options']);
                                             
                                             
                                             ?>
                                             
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="vedioPrice_<?=$j?>" name="vedioPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    
                                                    <?php foreach ($numbers_arr as $i) { ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                             
                                             <?php }else { ?>
                                             
                                                <input type="text" class="form-control" id="vedioPrice_<?=$j?>" name="vedioPrice_<?=$j?>" >
                                                
                                            
                                             
                                             <?php } ?>
                                             
                                            
                                            
                                            
                                            
                                            <div class="invalid-feedback">
                                               This field is required!
                                            </div>
                                         </div>
                                      </div>
                                    
                                
                                
                                
                            </div>
                            
                            <div class="col-2">
                                
                                
                                
                                 <?php 
                                 
                                    $feid= 9 + $j;
                        
                                        $pricePerPhtoExra = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$feid"));
                                     
                                    ?>
                                    
                                    
                                     <div class="row ">
                                         <div class="col-12">
                                             
                                             <?php if($pricePerPhtoExra['attribute_type'] == 'dropdown'){ ?>
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="phtoExtraPrice_<?=$j?>" name="phtoExtraPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    <?php for($i=$pricePerPhtoExra['attribute_min'];$i<=$pricePerPhtoExra['attribute_max'];$i++){ ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                                
                                                 
                                             <?php }else if($pricePerPhtoExra['attribute_type'] == 'dropdown with options'){ 
                                                 
                                                 $numbers_arr = explode(',', $pricePerPhtoExra['attribute_options']);
                                             
                                             
                                             ?>
                                             
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="phtoExtraPrice_<?=$j?>" name="phtoExtraPrice_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    
                                                    <?php foreach ($numbers_arr as $i) { ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                             
                                             <?php }else { ?>
                                             
                                                <input type="text" class="form-control" id="phtoExtraPrice_<?=$j?>" name="phtoExtraPrice_<?=$j?>" >
                                           
                                             
                                             <?php } ?>
                                             
                                            
                                            
                                            
                                            
                                            <div class="invalid-feedback">
                                               This field is required!
                                            </div>
                                         </div>
                                      </div>
                                    
                        
                                
                                
                                
                                
                            </div>
                            
                            <div class="col-2">
                                
                                
                                <?php 
                                 
                                    $vfeid= 15 + $j;
                        
                                        $pricePerVdoExtr = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$vfeid"));
                                     
                                    ?>
                                    
                                    
                                     <div class="row ">
                                         <div class="col-12">
                                             
                                             <?php if($pricePerVdoExtr['attribute_type'] == 'dropdown'){ ?>
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="vedioPriceExtra_<?=$j?>" name="vedioPriceExtra_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    <?php for($i=$pricePerVdoExtr['attribute_min'];$i<=$pricePerVdoExtr['attribute_max'];$i++){ ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                                
                                                 
                                             <?php }else if($pricePerVdoExtr['attribute_type'] == 'dropdown with options'){ 
                                                 
                                                 $numbers_arr = explode(',', $pricePerVdoExtr['attribute_options']);
                                             
                                             
                                             ?>
                                             
                                             
                                                <select class="form-control select2" aria-label="Default select example" id="vedioPriceExtra_<?=$j?>" name="vedioPriceExtra_<?=$j?>">
                                                    <option value="" selected>--select--</option>
                                                    
                                                    <?php foreach ($numbers_arr as $i) { ?>
                                                        <option value="<?=$i?>"><?=$i?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                             
                                             
                                             <?php }else { ?>
                                             
                                                <input type="text" class="form-control" id="vedioPriceExtra_<?=$j?>" name="vedioPriceExtra_<?=$j?>" >
                                       
                                             
                                             <?php } ?>
                                             
                                            
                                            
                                            
                                            
                                            <div class="invalid-feedback">
                                               This field is required!
                                            </div>
                                         </div>
                                      </div>
                                
                                
                            </div>
                            
                        </div>
                           
                           
                           
                           
                           
                           
                    <?php        
                       }
                        
                    ?>
                    
                    <input type="hidden" id="totalMinRow" name="totalMinRow" value="<?=$j?>">
                
                
                <br>
                
                
                 <hr>
                
                
                 <div class="row">
                     
                     <div class="col-2">
                        <label for="" class="col-12 col-form-label"></label>
                    </div>
                    
                    <div class="col-10">
                        <div class="row">
                    
                            <div class="col-3">
                                <label for="" class="col-12 col-form-label">MI COMMISSIONS</label>
                            </div>
                            
                            <div class="col-3">
                                <label for="" class="col-12 col-form-label">EXTRA TIME MI COMMISSIONS(per mins)</label>
                            </div>
                            
                            <div class="col-3">
                                <label for="" class="col-12 col-form-label">PROVIDER COMMISSION </label>
                            </div>
                            
                            <div class="col-3">
                                <label for="" class="col-12 col-form-label">EXTRA TIME PROVIDER COMMISSION (per mins)</label>
                            </div>
                        </div>
                    </div>
                    
                 
                    
                </div>
                
                
                 <?php 
                        
                    $comsn = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=20"));
                    
                    $numbers_arr = explode(',', $comsn['attribute_options']);
                    
                    $k = 0;
                    
                    foreach ($numbers_arr as $i) {
                        
                    $k ++;
                 
                ?>
                
                
                <input type="hidden" id="commissionId_<?=$k?>" name="commissionId_<?=$k?>" value="<?=$i?>">
                
                <div class="row">
                    
                    <div class="col-2">
                        <label for="" class="col-12 col-form-label"><?=$i?></label>
                    </div>
                    
                    <div class="col-10">
                        <div class="row">
                    
                            <div class="col-3">
                                
                                
                                
                                            <?php 
                                         
                                            $fid= 20 + $k;
                                
                                                $MIC = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$fid"));
                                             
                                            ?>
                                            
                                            
                                             <div class="row ">
                                                 
                                                 <div class="col-6">
                                                     
                                                     <?php if($MIC['attribute_type'] == 'dropdown'){ ?>
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="miCommission_<?=$k?>" name="miCommission_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <?php for($i=$MIC['attribute_min'];$i<=$MIC['attribute_max'];$i++){ ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                        
                                                         
                                                     <?php }else if($MIC['attribute_type'] == 'dropdown with options'){ 
                                                         
                                                         $numbers_arr = explode(',', $MIC['attribute_options']);
                                                     
                                                     
                                                     ?>
                                                     
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="miCommission_<?=$k?>" name="miCommission_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            
                                                            <?php foreach ($numbers_arr as $i) { ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                     
                                                     <?php }else { ?>
                                                     
                                                        <input type="text" class="form-control" id="miCommission_<?=$k?>" name="miCommission_<?=$k?>" >
                                                        
                                                    
                                                     
                                                     <?php } ?>
                                                     
                                                    
                                                    
                                                    
                                                    
                                                    <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                 </div>
                                                 
                                                 <div class="col-6">
                                                     
                                                     <select class="form-control select2" aria-label="Default select example" id="miCommissionType_<?=$k?>" name="miCommissionType_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <option value="amount">amount</option>
                                                            <option value="percentage">percentage</option>
                                                            
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                     
                                                     
                                                 </div>
                                                 
                                              </div>
                                            
                                
                            
                            </div>
                            
                            <div class="col-3">
                                
                                
                                
                                            <?php 
                                         
                                            $fide= 23 + $k;
                                
                                                $MICE = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$fide"));
                                             
                                            ?>
                                            
                                            
                                             <div class="row ">
                                                 <div class="col-6">
                                                     
                                                     <?php if($MICE['attribute_type'] == 'dropdown'){ ?>
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="miCommissionExtra_<?=$k?>" name="miCommissionExtra_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <?php for($i=$MICE['attribute_min'];$i<=$MICE['attribute_max'];$i++){ ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                        
                                                         
                                                     <?php }else if($MICE['attribute_type'] == 'dropdown with options'){ 
                                                         
                                                         $numbers_arr = explode(',', $MICE['attribute_options']);
                                                     
                                                     
                                                     ?>
                                                     
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="miCommissionExtra_<?=$k?>" name="miCommissionExtra_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            
                                                            <?php foreach ($numbers_arr as $i) { ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                     
                                                     <?php }else { ?>
                                                     
                                                        <input type="text" class="form-control" id="miCommissionExtra_<?=$k?>" name="miCommissionExtra_<?=$k?>" >
                                                        
                                                    
                                                     
                                                     <?php } ?>
                                                     
                                                    
                                                    
                                                    
                                                    
                                                    <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                 </div>
                                                 
                                                  <div class="col-6">
                                                     
                                                     <select class="form-control select2" aria-label="Default select example" id="miCommissionExtraType_<?=$k?>" name="miCommissionExtraType_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <option value="amount">amount</option>
                                                            <option value="percentage">percentage</option>
                                                            
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                     
                                                     
                                                 </div>
                                                 
                                                 
                                              </div>
                                            
                                
                             
                            </div>
                            
                            <div class="col-3">
                                
                                
                                
                                   <?php 
                                         
                                            $fid= 26 + $k;
                                
                                                $MIC = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$fid"));
                                             
                                            ?>
                                            
                                            
                                             <div class="row ">
                                                 <div class="col-6">
                                                     
                                                     <?php if($MIC['attribute_type'] == 'dropdown'){ ?>
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="providerCommission_<?=$k?>" name="providerCommission_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <?php for($i=$MIC['attribute_min'];$i<=$MIC['attribute_max'];$i++){ ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                        
                                                         
                                                     <?php }else if($MIC['attribute_type'] == 'dropdown with options'){ 
                                                         
                                                         $numbers_arr = explode(',', $MIC['attribute_options']);
                                                     
                                                     
                                                     ?>
                                                     
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="providerCommission_<?=$k?>" name="providerCommission_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            
                                                            <?php foreach ($numbers_arr as $i) { ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                     
                                                     <?php }else { ?>
                                                     
                                                        <input type="text" class="form-control" id="providerCommission_<?=$k?>" name="providerCommission_<?=$k?>" >
                                                     
                                                     
                                                     <?php } ?>
                                                     
                                                    
                                                    
                                                    
                                                    
                                                    <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                 </div>
                                                 
                                                 <div class="col-6">
                                                     
                                                     <select class="form-control select2" aria-label="Default select example" id="providerCommissionType_<?=$k?>" name="providerCommissionType_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <option value="amount">amount</option>
                                                            <option value="percentage">percentage</option>
                                                            
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                     
                                                     
                                                 </div>
                                              </div>
                                            
                                
                                
                              
                            </div>
                            
                            <div class="col-3">
                                
                                
                                
                                <?php 
                                         
                                            $fid= 29 + $k;
                                
                                                $MIC = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=$fid"));
                                             
                                            ?>
                                            
                                            
                                             <div class="row ">
                                                 <div class="col-6">
                                                     
                                                     <?php if($MIC['attribute_type'] == 'dropdown'){ ?>
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="providerCommissionExtra_<?=$k?>" name="providerCommissionExtra_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <?php for($i=$MIC['attribute_min'];$i<=$MIC['attribute_max'];$i++){ ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                        
                                                         
                                                     <?php }else if($MIC['attribute_type'] == 'dropdown with options'){ 
                                                         
                                                         $numbers_arr = explode(',', $MIC['attribute_options']);
                                                     
                                                     
                                                     ?>
                                                     
                                                     
                                                        <select class="form-control select2" aria-label="Default select example" id="providerCommissionExtra_<?=$k?>" name="providerCommissionExtra_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            
                                                            <?php foreach ($numbers_arr as $i) { ?>
                                                                <option value="<?=$i?>"><?=$i?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                     
                                                     
                                                     <?php }else { ?>
                                                     
                                                        <input type="text" class="form-control" id="providerCommissionExtra_<?=$k?>" name="providerCommissionExtra_<?=$k?>" >
                                                        
                                                  
                                                     
                                                     <?php } ?>
                                                     
                                                    
                                                    
                                                    
                                                    
                                                    <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                 </div>
                                                 
                                                 <div class="col-6">
                                                     
                                                     <select class="form-control select2" aria-label="Default select example" id="providerCommissionExtraType_<?=$k?>" name="providerCommissionExtraType_<?=$k?>">
                                                            <option value="" selected>--select--</option>
                                                            <option value="amount">amount</option>
                                                            <option value="percentage">percentage</option>
                                                            
                                                            
                                                        </select>
                                                        <div class="invalid-feedback">
                                                       This field is required!
                                                    </div>
                                                     
                                                     
                                                 </div>
                                              </div>
                                            
                                
                                
                                
                                
                                
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
                
                                                        
                <?php } ?>
                
                <input type="hidden" id="totalCommissionRow" name="totalCommissionRow" value="<?=$k?>">
                
                
                <hr>
                
                <div class="row">
                    
                 <div class="col-3">
                        
                        <?php 
                        
                            $pricePerHd = mysqli_fetch_assoc($DBC->query("SELECT * FROM tblservicesattributefeild WHERE id=33"));
                         
                        ?>
                        
                        
                         <div class="row ">
                             <label for="" class="col-12 col-form-label">GST *( percentage )</label>
                             <div class="col-12">
                                 
                                 <?php if($pricePerHd['attribute_type'] == 'dropdown'){ ?>
                                 
                                    <select class="form-control select2" aria-label="Default select example" id="gst_val" name="gst_val">
                                        <option value="" selected>--select--</option>
                                        <?php for($i=$pricePerHd['attribute_min'];$i<=$pricePerHd['attribute_max'];$i++){ ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        
                                    </select>
                                 
                                    
                                     
                                 <?php }else if($pricePerHd['attribute_type'] == 'dropdown with options'){ 
                                     
                                     $numbers_arr = explode(',', $pricePerHd['attribute_options']);
                                 
                                 
                                 ?>
                                 
                                 
                                    <select class="form-control select2" aria-label="Default select example" id="gst_val" name="gst_val">
                                        <option value="" selected>--select--</option>
                                        
                                        <?php foreach ($numbers_arr as $i) { ?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        
                                    </select>
                                 
                                 
                                 <?php }else { ?>
                                 
                                    <input type="text" class="form-control" id="gst_val" name="gst_val" >
                              
                                 <?php } ?>
                                 
                                
                                
                                
                                
                                <div class="invalid-feedback">
                                   This field is required!
                                </div>
                             </div>
                          </div>
                        
                        
                        
                        
                        
                    </div>
                    
                    </div>
                
                <hr>
                
                <div class="row">
                    
                    <b for="" class="col-12 col-form-label">Generate Price</b>
                    <div class="col-6">
                        
                        <div class="row pt-3">
                            
                            <div class="col-6">
                                                     
                                 <input type="text" class="form-control" id="generatePriceTime" name="generatePriceTime" placeholder="Enter generate price time" onkeyup="generatePrice();">
                                    <div class="invalid-feedback">
                                   This field is required!
                                </div>
                                 
                             </div>
                             
                             <div class="col-6">
                                                     
                                 <select class="form-control select2" aria-label="Default select example" id="generatePriceTimeType" name="generatePriceTimeType" onchange="generatePrice();">>
                                        <option value="minute" selected>minute</option>
                                       
                                    </select>
                                    <div class="invalid-feedback">
                                   This field is required!
                                </div>
                                 
                                 
                             </div>
                            
                            
                            
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-6">
                        
                        <div class="row pt-3">
                            
                             <div class="col-6">
                                                     
                                 <input type="text" class="form-control" id="numberOfPersonMax" name="numberOfPersonMax" placeholder="Max number of members" onkeyup="generatePrice();">
                                    <div class="invalid-feedback">
                                   This field is required!
                                </div>
                                 
                             </div>
                             
                            <div class="col-6">
                                 
                                <button type="button" class=" btn btn-dark " onclick="generatePrice();">Generate</button>
                                 
                            </div>
                            
                        </div>
                        
                  
                        
                    </div>
                    <div id="disGeneratePrice"></div>
                    
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
                  <h5 class="card-title">Service Price</h5>
                </div>
                
              
                
                <div class="col-9 pt-4 " align="right">
                  <button class="btn btn-primary " onclick="showAddHVSection();">Add New Service Price</button>
                </div>
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>
                
                    <th scope="col">Category</th>
                    <th scope="col">Service Type</th>
                    <th scope="col">Extra Price Per Head</th>
                    <th scope="col">GST</th>
                    
                    
                    <th scope="col" >Mins</th>
                    <th scope="col">Hours</th>
                    <th scope="col">Days</th>
                    
                    
                   
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
    
  <style>
    /* Remove default list styling */
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Style list items */
    li {
        margin-bottom: 5px;
        font-size: 16px;
    }
</style>
    

<?php 

include("templates/footer.php")

?>
<script>
var isEditMode = false;
var isStateEdt = false;
var isCityEdt = false;

var allowedMaxNumberOfPerson = '' ;


 var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];

  $( document ).ready(function() {
      
      
         getCounty("selCounty");
       getState('selState');
       getCity('selCity');
       
       
       getPriceCategory("selPriceCategory");
       
       
       getServiceType('selServiceType');
       
       
       
    //   getServiceCenter('selServiceCenter');
      
      
      
      
      
      
      
      
      
      getDisHVListData();
     
    

  });
  
  
  function generatePrice(){
      $('#disGeneratePrice').html('');
      var generatePriceTime = $('#generatePriceTime').val();

      if(generatePriceTime == ""){
         $('#generatePriceTime').addClass('is-invalid');
         $('#generatePriceTime').focus();
        return false;
      }
      
      var numberOfPersonMax = $('#numberOfPersonMax').val();
       if(numberOfPersonMax == ""){
         $('#numberOfPersonMax').addClass('is-invalid');
         $('#numberOfPersonMax').focus();
        return false;
      }
      
      if(allowedMaxNumberOfPerson == ''){
          $('#selServiceType').addClass('is-invalid');
         $('#selServiceType').focus();
        return false;
      }
      
      var extraPricePerHead = $('#extraPricePerHead').val();
       if(extraPricePerHead == ""){
         $('#extraPricePerHead').addClass('is-invalid');
         $('#extraPricePerHead').focus();
        return false;
      }
      
      
      
      
      var finalExtraPricePerHead = 0;
      var morePerson = 0;
      if( parseInt(numberOfPersonMax) > parseInt(allowedMaxNumberOfPerson)  ){
          morePerson = parseInt(numberOfPersonMax) - parseInt(allowedMaxNumberOfPerson);
          finalExtraPricePerHead = morePerson * parseInt(extraPricePerHead) ; 
          
      }
      
  
      var gstPercentage = $('#gst_val').val();
      
      if(gstPercentage == ""){
         $('#gst_val').addClass('is-invalid');
         $('#gst_val').focus();
        return false;
      }
      
      for(var i=1;i<=3;i++){
          if($("#extraMin_"+i).val() == "" ){
              $("#extraMin_"+i).addClass('is-invalid');
                return false;
          }
          
          if($("#phtoPrice_"+i).val() == "" ){
              $("#phtoPrice_"+i).addClass('is-invalid');
                return false;
          }
          
          if($("#vedioPrice_"+i).val() == "" ){
              $("#vedioPrice_"+i).addClass('is-invalid');
                return false;
          }
          
           if($("#phtoExtraPrice_"+i).val() == "" ){
              $("#phtoExtraPrice_"+i).addClass('is-invalid');
                return false;
          }
          
           if($("#vedioPriceExtra_"+i).val() == "" ){
              $("#vedioPriceExtra_"+i).addClass('is-invalid');
                return false;
          }
          
          
          
      }
      
      
      
         for(var i=1;i<=3;i++){
             
              if($("#miCommission_"+i).val() == "" ){
                  $("#miCommission_"+i).addClass('is-invalid');
                    return false;
              }
              
              if($("#miCommissionType_"+i).val() == "" ){
                  $("#miCommissionType_"+i).addClass('is-invalid');
                    return false;
              }
              
              if($("#miCommissionExtra_"+i).val() == "" ){
                  $("#miCommissionExtra_"+i).addClass('is-invalid');
                    return false;
              }
              
               if($("#miCommissionExtraType_"+i).val() == "" ){
                  $("#miCommissionExtraType_"+i).addClass('is-invalid');
                    return false;
              }
              
              if($("#providerCommission_"+i).val() == "" ){
                  $("#providerCommission_"+i).addClass('is-invalid');
                    return false;
              }
              
              if($("#providerCommissionType_"+i).val() == "" ){
                  $("#providerCommissionType_"+i).addClass('is-invalid');
                    return false;
              }
              
                 
              if($("#providerCommissionExtra_"+i).val() == "" ){
                  $("#providerCommissionExtra_"+i).addClass('is-invalid');
                    return false;
              }
              
              if($("#providerCommissionExtraType_"+i).val() == "" ){
                  $("#providerCommissionExtraType_"+i).addClass('is-invalid');
                    return false;
              }
          
         }
         
       
      
      var runFn = 0;
      
      
       var isRun = true;
          var finalPicPrice = 0;
       var finalVidPrice = 0;
       
       var finalPicExtraPrice = "";
       var finalVidExtraPrice = "";
       
       
          var finalmiCommissionPrice = 0;
       var finalproviderCommissionPrice = 0;
       
        var finalmiCommissionExtraPrice = "";
       var finalproviderCommissionExtraPrice = "";
       
       
        var extraMin_1 = $("#extraMin_1").val();
      var phtoPrice_1 = $("#phtoPrice_1").val();
      var vedioPrice_1 = $("#vedioPrice_1").val();
      var phtoExtraPrice_1 = $("#phtoExtraPrice_1").val();
      var vedioPriceExtra_1 = $("#vedioPriceExtra_1").val();
      
     
      
      if(parseFloat(generatePriceTime) <= parseFloat(extraMin_1) && isRun ){
       
        finalPicPrice = phtoPrice_1;
        finalVidPrice = vedioPrice_1;
        
        isRun = false;
        
        runFn = 1;
        
        
    }else if(parseFloat(generatePriceTime) < 60 && isRun){
    
        var extraMins = parseFloat(generatePriceTime) - parseFloat(extraMin_1) ;
        
        finalPicExtraPrice = "( ₹"+phtoPrice_1+" for "+extraMin_1+" mins & ₹"+parseFloat(extraMins*phtoExtraPrice_1)+" for extra "+extraMins+" mins  )";
        finalVidExtraPrice = "( ₹"+vedioPrice_1+" for "+extraMin_1+" mins & ₹"+parseFloat(extraMins*vedioPriceExtra_1)+" for extra "+extraMins+" mins  )";
     
        finalPicPrice = (parseFloat(phtoPrice_1) + parseFloat(extraMins*phtoExtraPrice_1) );
        finalVidPrice = (parseFloat(vedioPrice_1) + parseFloat(extraMins*vedioPriceExtra_1) );
        
        isRun = false;
        runFn = 2;
    }
    
    
    var extraMin_2 = $("#extraMin_2").val();
      var phtoPrice_2 = $("#phtoPrice_2").val();
      var vedioPrice_2 = $("#vedioPrice_2").val();
      var phtoExtraPrice_2 = $("#phtoExtraPrice_2").val();
      var vedioPriceExtra_2 = $("#vedioPriceExtra_2").val();
      
      var hrToMin = parseFloat(extraMin_2) * 60;
      
      if(parseFloat(generatePriceTime) <= parseFloat(hrToMin) && isRun){
          
   
        finalPicPrice = phtoPrice_2;
        finalVidPrice = vedioPrice_2;
        
        isRun = false;
        runFn = 3;
          
      }else if(parseFloat(generatePriceTime) < 1440 && isRun){
     
        var extraMins = parseFloat(generatePriceTime) - parseFloat(hrToMin) ;
        
        finalPicExtraPrice = "( ₹"+phtoPrice_2+" for "+extraMin_2+" hr & ₹"+parseFloat(extraMins*phtoExtraPrice_2)+" for extra "+extraMins+" mins  )";
        finalVidExtraPrice = "( ₹"+vedioPrice_2+" for "+extraMin_2+" hr & ₹"+parseFloat(extraMins*vedioPriceExtra_2)+" for extra "+extraMins+" mins  )";
  
        finalPicPrice = (parseFloat(phtoPrice_2) + parseFloat(extraMins*phtoExtraPrice_2) );
        finalVidPrice = (parseFloat(vedioPrice_2) + parseFloat(extraMins*vedioPriceExtra_2) );
          
          isRun = false;
          runFn = 4;
          
      }
      
      var extraMin_3 = $("#extraMin_3").val();
      var phtoPrice_3 = $("#phtoPrice_3").val();
      var vedioPrice_3 = $("#vedioPrice_3").val();
      var phtoExtraPrice_3 = $("#phtoExtraPrice_3").val();
      var vedioPriceExtra_3 = $("#vedioPriceExtra_3").val();
      
      var dayToMin = parseFloat(extraMin_3) * 1440 ;
      
       if(parseFloat(generatePriceTime) <= parseFloat(dayToMin) && isRun){
    
        finalPicPrice = phtoPrice_3;
        finalVidPrice = vedioPrice_3;
        
        isRun = false;
        runFn = 5;
          
      }else if(isRun){
      
        var extraMins = parseFloat(generatePriceTime) - parseFloat(dayToMin) ;
        
        finalPicExtraPrice = "( ₹"+phtoPrice_3+" for "+extraMin_3+" day & ₹"+parseFloat(extraMins*phtoExtraPrice_3)+" for extra "+extraMins+" mins  )";
        finalVidExtraPrice = "( ₹"+vedioPrice_3+" for "+extraMin_3+" day & ₹"+parseFloat(extraMins*vedioPriceExtra_3)+" for extra "+extraMins+" mins  )";
     
        finalPicPrice = (parseFloat(phtoPrice_3) + parseFloat(extraMins*phtoExtraPrice_3) );
        finalVidPrice = (parseFloat(vedioPrice_3) + parseFloat(extraMins*vedioPriceExtra_3) );
          
          isRun = false;
          
          runFn = 6;
          
      }
    
    
       
       var ActualAmt = parseFloat(finalPicPrice) + parseFloat(finalVidPrice) ;
       
   
       var finalGst = ((parseFloat(ActualAmt) + parseFloat(finalExtraPricePerHead) )*gstPercentage)/100;
       
       var payableAmt = parseFloat(ActualAmt) + finalGst + parseFloat(finalExtraPricePerHead);
       
       var out = "";
       out += '<div class="col-12">';
       
       out += '<div class="row">';
       out += '<h5 class="text-danger pt-2">Customer side invoice</h5>';
       out += '<label class="text-muted">'+generatePriceTime+' mins service</label>';
       
       
       out += '<ul>';
        out += '<li>PHOTOGRAPHER PRICE  &nbsp;&nbsp;  ₹'+finalPicPrice+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalPicExtraPrice+'</li>';
        out += '<li>CINEMATOGRAPHER PRICE &nbsp;&nbsp;&nbsp; ₹'+finalVidPrice+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalVidExtraPrice+'</li>';
        
        out += '<li>EXTRA PRICE PER HEAD &nbsp;&nbsp;&nbsp; ₹'+finalExtraPricePerHead+' &nbsp;&nbsp;&nbsp;&nbsp;( '+morePerson+' additional persons available )</li>';
        
        
        out += '<li><b>Actual amount &nbsp;&nbsp;&nbsp; ₹'+( parseFloat(ActualAmt) + parseFloat(finalExtraPricePerHead)) +'</b></li>';
        
        out += '<li>gst '+gstPercentage+'% &nbsp;&nbsp;&nbsp; ₹'+finalGst+'</li>';
          out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+payableAmt+'</b></li>';
        out += '<li><hr></li>';
       
        
        
        out += '</ul>';
        out += '</div>';
        
         out += '<div class="row">';
       out += '<h5 class="text-danger pt-2">MI admin side (same customer invoice)</h5>';
       out += '<label class="text-muted">'+generatePriceTime+' mins service</label>';
       
       out += '<ul>';
        out += '<li>PHOTOGRAPHER PRICE  &nbsp;&nbsp;  ₹'+finalPicPrice+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalPicExtraPrice+'</li>';
        out += '<li>CINEMATOGRAPHER PRICE &nbsp;&nbsp;&nbsp; ₹'+finalVidPrice+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalVidExtraPrice+'</li>';
        out += '<li>EXTRA PRICE PER HEAD &nbsp;&nbsp;&nbsp; ₹'+finalExtraPricePerHead+' &nbsp;&nbsp;&nbsp;&nbsp;( '+morePerson+' additional persons available )</li>';
        
        out += '<li><b>Actual amount &nbsp;&nbsp;&nbsp; ₹'+( parseFloat(ActualAmt) + parseFloat(finalExtraPricePerHead))+'</b></li>';
        
        out += '<li>gst '+gstPercentage+'% &nbsp;&nbsp;&nbsp; ₹'+finalGst+'</li>';
         out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+payableAmt+'</b></li>';
        out += '<li><hr></li>';
        
        
        
        out += '</ul>';
       
    
       
        out += '</div>';
        
        ActualAmt = ( parseFloat(ActualAmt) + parseFloat(finalExtraPricePerHead)) ;
     
         
        var miCommission_1 = $("#miCommission_1").val();
          var miCommissionType_1 = $("#miCommissionType_1").val();
          var miCommissionExtra_1 = $("#miCommissionExtra_1").val();
          var miCommissionExtraType_1 = $("#miCommissionExtraType_1").val();
          var providerCommission_1 = $("#providerCommission_1").val();
           var providerCommissionType_1 = $("#providerCommissionType_1").val();
          var providerCommissionExtra_1 = $("#providerCommissionExtra_1").val();
          var providerCommissionExtraType_1 = $("#providerCommissionExtraType_1").val();
          
          var miCommission_2 = $("#miCommission_2").val();
          var miCommissionType_2 = $("#miCommissionType_2").val();
          var miCommissionExtra_2 = $("#miCommissionExtra_2").val();
          var miCommissionExtraType_2 = $("#miCommissionExtraType_2").val();
          var providerCommission_2 = $("#providerCommission_2").val();
           var providerCommissionType_2 = $("#providerCommissionType_2").val();
          var providerCommissionExtra_2 = $("#providerCommissionExtra_2").val();
          var providerCommissionExtraType_2 = $("#providerCommissionExtraType_2").val();
          
          var miCommission_3 = $("#miCommission_3").val();
          var miCommissionType_3 = $("#miCommissionType_3").val();
          var miCommissionExtra_3 = $("#miCommissionExtra_3").val();
          var miCommissionExtraType_3 = $("#miCommissionExtraType_3").val();
          var providerCommission_3 = $("#providerCommission_3").val();
           var providerCommissionType_3 = $("#providerCommissionType_3").val();
          var providerCommissionExtra_3 = $("#providerCommissionExtra_3").val();
          var providerCommissionExtraType_3 = $("#providerCommissionExtraType_3").val();
        
      

        if(runFn == 1 ){
            if(miCommissionType_1 =='amount'){
                finalmiCommissionPrice = miCommission_1;
            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_1))/100;
            }
            
            if(providerCommissionType_1 =='amount'){
                finalproviderCommissionPrice = providerCommission_1;
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_1))/100;
            }
            
        
            
        }else if(runFn == 2 ){
            if(miCommissionType_1 =='amount'){
                
                finalmiCommissionPrice = miCommission_1;
                
                if(miCommissionExtraType_1 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+miCommission_1+" for "+extraMin_1+" mins & ₹"+miCommissionExtra_1+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(miCommission_1) + parseFloat(miCommissionExtra_1) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_1))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_1+" mins & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }
                

            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_1))/100;
                
                if(miCommissionExtraType_1 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_1+" mins & ₹"+miCommissionExtra_1+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(miCommissionExtra_1) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_1))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_1+" mins & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }
                
            

            }
            
            if(providerCommissionType_1 =='amount'){
                
                finalproviderCommissionPrice = providerCommission_1;
                
                if(providerCommissionExtraType_1 == 'amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+providerCommission_1+" for "+extraMin_1+" mins & ₹"+providerCommissionExtra_1+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(providerCommission_1) + parseFloat(providerCommissionExtra_1) ;
                }else{
                     var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_1))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_1+" mins & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                    
                }
              
                
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_1))/100;
                
                if(providerCommissionExtraType_1 =='amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_1+" mins & ₹"+providerCommissionExtra_1+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(providerCommissionExtra_1) ;
                    
                }else{
                    var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_1))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_1+" mins & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                }
                
            
                
            }
         
        }else if(runFn == 3 ){
            if(miCommissionType_2 =='amount'){
                finalmiCommissionPrice = miCommission_2;
            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_2))/100;
            }
            
            if(providerCommissionType_2 =='amount'){
                finalproviderCommissionPrice = providerCommission_2;
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_2))/100;
            }
            
        
            
        }else if(runFn == 4 ){
            if(miCommissionType_2 =='amount'){
                
                finalmiCommissionPrice = miCommission_2;
                
                
                if(miCommissionExtraType_2 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+miCommission_2+" for "+extraMin_2+" hr & ₹"+miCommissionExtra_2+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(miCommission_2) + parseFloat(miCommissionExtra_2) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_2))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_2+" hr & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }

            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_2))/100;
                
                if(miCommissionExtraType_2 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_2+" hr & ₹"+miCommissionExtra_2+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(miCommissionExtra_2) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_2))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_2+" hr & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }
                
              

            }
            
            if(providerCommissionType_2 =='amount'){
                
                finalproviderCommissionPrice = providerCommission_2;
                
                if(providerCommissionExtraType_2 == 'amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+providerCommission_2+" for "+extraMin_2+" hr & ₹"+providerCommissionExtra_2+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(providerCommission_2) + parseFloat(providerCommissionExtra_2) ;
                }else{
                     var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_2))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_2+" hr & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                    
                }
                
         
                
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_2))/100;
                
                if(providerCommissionExtraType_2 =='amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_2+" hr & ₹"+providerCommissionExtra_2+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(providerCommissionExtra_2) ;
                    
                }else{
                    var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_2))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_2+" hr & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                }
                
                
            }
         
        }else if(runFn == 5 ){
             if(miCommissionType_3 =='amount'){
                finalmiCommissionPrice = miCommission_3;
            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_3))/100;
            }
            
            if(providerCommissionType_3 =='amount'){
                finalproviderCommissionPrice = providerCommission_3;
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_3))/100;
            }
            
        
            
        }else if(runFn == 6 ){
            if(miCommissionType_3 =='amount'){
                
                finalmiCommissionPrice = miCommission_3;
                finalmiCommissionExtraPrice = "( extra time used )";
                
                if(miCommissionExtraType_3 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+miCommission_3+" for "+extraMin_3+" day & ₹"+miCommissionExtra_3+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(miCommission_3) + parseFloat(miCommissionExtra_3) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_3))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_3+" day & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }
                

            }else{
                finalmiCommissionPrice = (parseFloat(ActualAmt)*parseFloat(miCommission_3))/100;
                
                if(miCommissionExtraType_3 =='amount'){
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_3+" day & ₹"+miCommissionExtra_3+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(miCommissionExtra_3) ;
                    
                }else{
                    var extra = ((parseFloat(finalmiCommissionPrice)*parseFloat(miCommissionExtra_3))/100)*extraMins;
                    
                    finalmiCommissionExtraPrice = "( ₹"+finalmiCommissionPrice+" for "+extraMin_3+" day & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalmiCommissionPrice = parseFloat(finalmiCommissionPrice) + parseFloat(extra) ;
                }
                
             

            }
            
            if(providerCommissionType_3 =='amount'){
                
                finalproviderCommissionPrice = providerCommission_3;
                
                if(providerCommissionExtraType_3 == 'amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+providerCommission_3+" for "+extraMin_3+" day & ₹"+providerCommissionExtra_3+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(providerCommission_3) + parseFloat(providerCommissionExtra_3) ;
                }else{
                     var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_3))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_3+" day & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                    
                }
                
              
                
            }else{
                finalproviderCommissionPrice = (parseFloat(ActualAmt)*parseFloat(providerCommission_3))/100;
                
                 if(providerCommissionExtraType_3 =='amount'){
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_3+" day & ₹"+providerCommissionExtra_3+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(providerCommissionExtra_3) ;
                    
                }else{
                    var extra = ((parseFloat(finalproviderCommissionPrice)*parseFloat(providerCommissionExtra_3))/100)*extraMins;
                    
                    finalproviderCommissionExtraPrice = "( ₹"+finalproviderCommissionPrice+" for "+extraMin_3+" day & ₹"+extra.toFixed(2)+" for extra "+extraMins+" mins  )";
                    finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice) + parseFloat(extra) ;
                }
                
                
            }
         
        }
        
        finalproviderCommissionPrice = parseFloat(finalproviderCommissionPrice);

        
        out += '<div class="row">';
         out += '<h5 class="text-danger pt-2">MI commission voucher</h5>';
         
          out += '<ul>';
          
           out += '<li>MI COMMISSIONS  &nbsp;&nbsp;  ₹'+finalmiCommissionPrice.toFixed(2)+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalmiCommissionExtraPrice+'</li>';
         out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+finalmiCommissionPrice.toFixed(2)+'</b></li>';
          
          out += '</ul>';
        
        out += '</div>';
        
         out += '<div class="row">';
         out += '<h5 class="text-danger pt-2">SP commission voucher</h5>';
          out += '<ul>';
         out += '<li>PROVIDER COMMISSIONS  &nbsp;&nbsp;  ₹'+finalproviderCommissionPrice.toFixed(2)+' &nbsp;&nbsp;&nbsp;&nbsp;'+finalproviderCommissionExtraPrice+'</li>';
         out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+finalproviderCommissionPrice.toFixed(2)+'</b></li>';
         
          out += '</ul>';
        
        out += '</div>';
        
        out += '<hr>';
        
        var totalPicPay = ( parseFloat(finalPicPrice) + ( parseFloat(finalExtraPricePerHead) / 2 ) ) - ( ( parseFloat(finalmiCommissionPrice) / 2 ) + ( parseFloat(finalproviderCommissionPrice) / 2 ) ) ;
        var totalVidPay = ( parseFloat(finalVidPrice) + ( parseFloat(finalExtraPricePerHead) / 2 ) ) - ( ( parseFloat(finalmiCommissionPrice) / 2 ) + ( parseFloat(finalproviderCommissionPrice) / 2 ) ) ;
        
        
         out += '<div class="row">';
         out += '<h5 class="text-danger pt-2">Photographer payment</h5>';
          out += '<ul>';
         out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+totalPicPay.toFixed(2)+'</b></li>';
          out += '</ul>';
        
        out += '</div>';
        
        out += '<div class="row">';
         out += '<h5 class="text-danger pt-2">Videographer payment</h5>';
          out += '<ul>';
         out += '<li><b>Total payable &nbsp;&nbsp;&nbsp; ₹'+totalVidPay.toFixed(2)+'</b></li>';
          out += '</ul>';
        
        out += '</div>';
        
        
        
        
        
        
        
        
        
        
        
        out += '</div>';
        
        
        
       
       
       
       
       $('#disGeneratePrice').html(out);
     
  
  }
  
  
  
  
  
  
  function getNumberOfMember(){
      var selServiceType = $('#selServiceType').val();
      if(selServiceType == ""){
          $('#numberOfPersonDisplat').html('--');
          allowedMaxNumberOfPerson = '';
          return false;
      }

      successFn = function(resp)  {
          
          
          var users = resp["data"];
          $('#numberOfPersonDisplat').html(users['number_of_members']+' people(s)');
          allowedMaxNumberOfPerson = users['number_of_members'];
          return false;
        
    
      
    }
    data = { "function": 'SystemManage',"method": "geteditServicesAddingTypeList","sel_id":selServiceType };
    
    apiCallForProvider(data,successFn);
      
      
      
      
  }
  
  
  function getPriceCategory(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Attribute</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.link_name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.link_name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServicesServicesAttLinkListData" };
    
    apiCallForProvider(data,successFn);
    
}
  
  
  
  function getServiceType(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select service type</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.center_name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.center_name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServicesAddingTypeListData" };
    
    apiCallForProvider(data,successFn);
    
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
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList",'sel_id':1};
        
        apiCall(data,successFn);
        
    }
    
  
  
  function getServiceCenter(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Service Center Type</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.center_name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.center_name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getServiceCenterActiveList" };
    
    apiCallForProvider(data,successFn);
    
}
  
  
  
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
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getCountries"};
    
    apiCall(data,successFn);
    
}


  function getState(selectId,val="") {
      
      if(isStateEdt && val == ""){
          isStateEdt = false;
          return false;
      }
      
      var selCounty = $('#selCounty').val();
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.state+"</option>";
        else options += "<option value='"+value.id+"'>"+value.state+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}


function getCity(selectId,val="",selState="") {
    
    if(isCityEdt && val == ""){
      isCityEdt = false;
      return false;
    }
      
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

  
  
  
  function showAddHVSection(){
      
      emptyForm();
      
      

     
    $("#HVSection").addClass("d-none");
        $('#addEVT').html('Add Service Price');
        
       
        $('#HVSectionFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       isEditMode = false;
       isStateEdt = false;
       isCityEdt = false;
       
       $("#selCounty").val("").trigger('change');
       $("#selState").val("").trigger('change');
       
       getState('selState');
       
       $("#selCity").val("").trigger('change');
       
       $("#selPriceCategory").val("").trigger('change');
       
       $("#selServiceType").val("").trigger('change');
       
       $("#extraPricePerHead").val("").trigger('change');
       $("#gst_val").val("").trigger('change');
       
       
       
       $('#generatePriceTime').val('');
      $('#disGeneratePrice').html('');
       
       
       for(var i=1;i<=3;i++){
           
           $("#extraMin_"+i).val("").trigger('change');
           $("#phtoPrice_"+i).val("").trigger('change');
           $("#vedioPrice_"+i).val("").trigger('change');
           $("#phtoExtraPrice_"+i).val("").trigger('change');
           $("#vedioPriceExtra_"+i).val("").trigger('change');
           
           
           $("#miCommission_"+i).val("").trigger('change');
           $("#miCommissionType_"+i).val("").trigger('change');
           $("#miCommissionExtra_"+i).val("").trigger('change');
           $("#miCommissionExtraType_"+i).val("").trigger('change');
           $("#providerCommission_"+i).val("").trigger('change');
           $("#providerCommissionType_"+i).val("").trigger('change');
           $("#providerCommissionExtra_"+i).val("").trigger('change');
           $("#providerCommissionExtraType_"+i).val("").trigger('change');
           
           
           
       }
       
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  function getDisHVListData(){
      
   
   
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
            
              
              { "data": "short_name" },
              { "data": "state" },

              {"data":null,"render":function(item){
                  
                  return item.city_id.replace(/,/g, ",<br>");
                  
                
                    
                    }
                },
              
              
          
                
                { "data": "link_name" },
                { "data": "serviceType" },
                
                
                {"data":null,"render":function(item){
                  
                  return "₹"+item.price_per_head;
                  
                    }
                },
                
                 {"data":null,"render":function(item){
                  
                  return item.gst_val+"%";
                  
                    }
                },
                
                {"data":null,"render":function(item){
                    
                    var out = '<span style="margin-right: 400px;" >&nbsp;</span><br><b class="text-muted">'+item.mins_time_interval+'mins</b><br>';
                    out += 'PHOTOGRAPHER PRICE : <span class="text-primary">₹'+item.mins_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER PRICE : <span class="text-primary">₹'+item.mins_vedio_price+'</span><br>';
                    out += 'PHOTOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.mins_extra_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.mins_extra_vedio_price+'</span><hr>';
                    
                    if(item.mins_mi_commission_type == 'amount') out += 'MI COMMISSIONS : <span class="text-primary">₹'+item.mins_mi_commission+'</span><br>';
                    else out += 'MI COMMISSIONS : <span class="text-primary">'+item.mins_mi_commission+'%</span><br>';
                    
                    if(item.mins_mi_commission_extra_type == 'amount') out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">₹'+item.mins_mi_commission_extra+'</span><br>';
                    else out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">'+item.mins_mi_commission_extra+'%</span><br>';
                    
                    if(item.mins_provider_commission_type == 'amount') out += 'PROVIDER COMMISSION : <span class="text-primary">₹'+item.mins_provider_commission+'</span><br>';
                    else out += 'PROVIDER COMMISSION : <span class="text-primary">'+item.mins_provider_commission_type+'%</span><br>';
                    
                    if(item.mins_provider_commission_extra_type == 'amount') out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">₹'+item.mins_provider_commission_extra+'</span><br>';
                    else out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">'+item.mins_provider_commission_extra+'%</span><br>';
                    
                    
                    
                    
                  
                  return out;
                  
                    }
                },
                
                {"data":null,"render":function(item){
                    
                    var out = '<span style="margin-right: 400px;" >&nbsp;</span><br><b class="text-muted">'+item.hrs_time_interval+'mins</b><br>';
                    out += 'PHOTOGRAPHER PRICE : <span class="text-primary">₹'+item.hrs_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER PRICE : <span class="text-primary">₹'+item.hrs_vedio_price+'</span><br>';
                    out += 'PHOTOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.hrs_extra_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.hrs_extra_vedio_price+'</span><hr>';
                    
                    if(item.hrs_mi_commission_type == 'amount') out += 'MI COMMISSIONS : <span class="text-primary">₹'+item.hrs_mi_commission+'</span><br>';
                    else out += 'MI COMMISSIONS : <span class="text-primary">'+item.hrs_mi_commission+'%</span><br>';
                    
                    if(item.hrs_mi_commission_extra_type == 'amount') out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">₹'+item.hrs_mi_commission_extra+'</span><br>';
                    else out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">'+item.hrs_mi_commission_extra+'%</span><br>';
                    
                    if(item.hrs_provider_commission_type == 'amount') out += 'PROVIDER COMMISSION : <span class="text-primary">₹'+item.hrs_provider_commission+'</span><br>';
                    else out += 'PROVIDER COMMISSION : <span class="text-primary">'+item.hrs_provider_commission_type+'%</span><br>';
                    
                    if(item.hrs_provider_commission_extra_type == 'amount') out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">₹'+item.hrs_provider_commission_extra+'</span><br>';
                    else out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">'+item.hrs_provider_commission_extra+'%</span><br>';
                    
                    
                    
                    
                  
                  return out;
                  
                    }
                },
                
                
                {"data":null,"render":function(item){
                    
                    var out = '<span style="margin-right: 400px;" >&nbsp;</span><br><b class="text-muted">'+item.day_time_interval+'mins</b><br>';
                    out += 'PHOTOGRAPHER PRICE : <span class="text-primary">₹'+item.day_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER PRICE : <span class="text-primary">₹'+item.day_vedio_price+'</span><br>';
                    out += 'PHOTOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.day_extra_pic_price+'</span><br>';
                    out += 'CINEMATOGRAPHER EXTRA PRICE : <span class="text-primary">₹'+item.day_extra_vedio_price+'</span><hr>';
                    
                    if(item.day_mi_commission_type == 'amount') out += 'MI COMMISSIONS : <span class="text-primary">₹'+item.day_mi_commission+'</span><br>';
                    else out += 'MI COMMISSIONS : <span class="text-primary">'+item.day_mi_commission+'%</span><br>';
                    
                    if(item.day_mi_commission_extra_type == 'amount') out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">₹'+item.day_mi_commission_extra+'</span><br>';
                    else out += 'MI COMMISSIONS EXTRA ( per mins ) : <span class="text-primary">'+item.day_mi_commission_extra+'%</span><br>';
                    
                    if(item.day_provider_commission_type == 'amount') out += 'PROVIDER COMMISSION : <span class="text-primary">₹'+item.day_provider_commission+'</span><br>';
                    else out += 'PROVIDER COMMISSION : <span class="text-primary">'+item.day_provider_commission_type+'%</span><br>';
                    
                    if(item.day_provider_commission_extra_type == 'amount') out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">₹'+item.day_provider_commission_extra+'</span><br>';
                    else out += 'PROVIDER COMMISSION EXTRA ( per mins ) : <span class="text-primary">'+item.day_provider_commission_extra+'%</span><br>';
                    
                    
                    
                    
                  
                  return out;
                  
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
                  var str = '<span class="badge bg-info text-dark" onclick="editServiceTypeList('+item.id+');" style="cursor:pointer">edit</span>';
                  
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
    data = { "function": 'SystemManage',"method": "getServicePriceListData" };
    
    apiCall(data,successFn);
}

  
  
  
  function editServiceTypeList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");
       
         $("#signalbmUploadStatus").width('0%');
            $("#signalbmUploadStatus").html('0%');



    
        $('#addEVT').html('Update Price');
          $('#HVSectionFormSection').removeClass("d-none");
                $("#HVSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;
                isEditMode = true;
                isStateEdt = true;
                isCityEdt = true;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
                $("#selCounty").val(eventList['county_id']).trigger('change');
                getState('selState',eventList['state_id']);
                
                
                
                var valuesArray = eventList['city_id'].split(',').map(Number);
                getCity('selCity',valuesArray,eventList['state_id']);
                
                
                $("#selPriceCategory").val(eventList['price_category_id']).trigger('change');
                $("#selServiceType").val(eventList['service_type_id']).trigger('change');
                $("#extraPricePerHead").val(eventList['price_per_head']).trigger('change');
                $("#gst_val").val(eventList['gst_val']).trigger('change');
                
                
                for(var i=1;i<=3;i++){
                    if(i==1) var j = 'mins';
                    else if(i==2) var j = 'hrs';
                    else var j = 'day';
           
                   $("#extraMin_"+i).val(eventList[j+'_time_interval']).trigger('change');
                  $("#phtoPrice_"+i).val(eventList[j+'_pic_price']).trigger('change');
                  $("#vedioPrice_"+i).val(eventList[j+'_vedio_price']).trigger('change');
                  $("#phtoExtraPrice_"+i).val(eventList[j+'_extra_pic_price']).trigger('change');
                  $("#vedioPriceExtra_"+i).val(eventList[j+'_extra_vedio_price']).trigger('change');
                   
                   
                  $("#miCommission_"+i).val(eventList[j+'_mi_commission']).trigger('change');
                  $("#miCommissionType_"+i).val(eventList[j+'_mi_commission_type']).trigger('change');
                  $("#miCommissionExtra_"+i).val(eventList[j+'_mi_commission_extra']).trigger('change');
                  $("#miCommissionExtraType_"+i).val(eventList[j+'_mi_commission_extra_type']).trigger('change');
                  $("#providerCommission_"+i).val(eventList[j+'_provider_commission']).trigger('change');
                  $("#providerCommissionType_"+i).val(eventList[j+'_provider_commission_type']).trigger('change');
                  $("#providerCommissionExtra_"+i).val(eventList[j+'_provider_commission_extra']).trigger('change');
                  $("#providerCommissionExtraType_"+i).val(eventList[j+'_provider_commission_extra_type']).trigger('change');
                   
                   
                   
               }
 

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicePriceList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm(){
      emptyForm();
      $('#HVSectionFormSection').addClass("d-none");
      $("#HVSection").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        
      
        var save = $("#save").val();
        
    
           var mulSel = $('#selCity').val();
        if(mulSel == ''){
            $('#selCity').addClass('is-invalid');
            return false;
        }
        $('#selCity').removeClass('is-invalid');
   
        
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesPriceDetails');
        formData.append('multipleSel', mulSel);
        
    
       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Price",
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
                                        title: "Price "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getDisHVListData();
                                    
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
        selCounty: {
            required: true
        },
        selState :{
            required: true
        },
         selCity :{
            required: true
        },
        selPriceCategory: {
            required: true
        },
        selServiceType :{
            required: true
        },
        extraPricePerHead :{
            required: true
        },
         gst_val :{
            required: true
        },
        
     
        extraMin_1 :{
            required: true
        },
        phtoPrice_1 :{
            required: true
        },
        vedioPrice_1 :{
            required: true
        },
         phtoExtraPrice_1 :{
            required: true
        },
        vedioPriceExtra_1 :{
            required: true
        },
        
      
        extraMin_2 :{
            required: true
        },
        phtoPrice_2 :{
            required: true
        },
        vedioPrice_2 :{
            required: true
        },
         phtoExtraPrice_2 :{
            required: true
        },
        vedioPriceExtra_2 :{
            required: true
        },
        
       
        extraMin_3 :{
            required: true
        },
        phtoPrice_3 :{
            required: true
        },
        vedioPrice_3 :{
            required: true
        },
         phtoExtraPrice_3 :{
            required: true
        },
        vedioPriceExtra_3 :{
            required: true
        },
        
        
        miCommission_1 :{
            required: true
        },
        miCommissionType_1 :{
            required: true
        },
        miCommissionExtra_1 :{
            required: true
        },
         miCommissionExtraType_1 :{
            required: true
        },
        providerCommission_1 :{
            required: true
        },
         providerCommissionType_1 :{
            required: true
        },
         providerCommissionExtra_1 :{
            required: true
        },
        providerCommissionExtraType_1 :{
            required: true
        },
        
        miCommission_2 :{
            required: true
        },
        miCommissionType_2 :{
            required: true
        },
        miCommissionExtra_2 :{
            required: true
        },
         miCommissionExtraType_2 :{
            required: true
        },
        providerCommission_2 :{
            required: true
        },
         providerCommissionType_2 :{
            required: true
        },
         providerCommissionExtra_2 :{
            required: true
        },
        providerCommissionExtraType_2 :{
            required: true
        },
        
        miCommission_3 :{
            required: true
        },
        miCommissionType_3 :{
            required: true
        },
        miCommissionExtra_3 :{
            required: true
        },
         miCommissionExtraType_3 :{
            required: true
        },
        providerCommission_3 :{
            required: true
        },
         providerCommissionType_3 :{
            required: true
        },
         providerCommissionExtra_3 :{
            required: true
        },
        providerCommissionExtraType_3 :{
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
             text: "You want to "+dis+" this Price",
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
                            getDisHVListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "setactiveServicePrice" ,"sel_id":id,"setVal":setVal,"dis":dis };
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