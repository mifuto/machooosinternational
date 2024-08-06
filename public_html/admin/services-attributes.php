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
      <h1>Service Attributes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Service Attributes</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    
    <section class="section">
         
        <div class="card pt-3">
            <div class="card-body" >
                
               
    
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-right: 1px solid #ccc;padding-right:5px;" style="width: 30%;">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-Attributes" aria-selected="true" onclick="getAttributesData();">Attributes</button>
                        <button class="nav-link" id="v-pills-Feilds-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Feilds" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" onclick="getAttributesFeildsData();">Feilds</button>
                        <button class="nav-link" id="v-pills-Service-Type-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Service-Type" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onclick="getServiceTypeData();">Service Type</button>
                        
                        <button class="nav-link" id="v-pills-Service-category-tab" data-bs-toggle="pill" data-bs-target="#v-pills-category-Type" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onclick="getServicecategoryData();">Sub Category</button>
                        
                        <button class="nav-link" id="v-pills-Service-Link-tab" data-bs-toggle="pill" data-bs-target="#v-pills-Link-Type" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" onclick="getServiceLinkData();">Link Attributes</button>
                       
                    </div>
                    <div class="tab-content" id="v-pills-tabContent" style="width: 85%;">
                        <div class="tab-pane fade show active" id="v-pills-Attributes" role="tabpanel" aria-labelledby="v-pills-Attributes" >
                            
                            <div id="disTab1">
                            
                            
                                <section class="section d-none" id="StateFormSection">
                                   <div class="row">
                                        <div class="col-lg-12">
                                            <div  id="addEventFormDiv">
                                                <h5 class="card-title mb-4" id="addEVT">Add Service Attributes</h5>
                                                 <form id="addCountyForm"  >
                                                    <div class="row mb-3">
                                                       <label for="" class="col-12 col-form-label">Enter service attribute</label>
                                                       <div class="col-12">
                                                          <input type="text" class="form-control" id="inpServicesCenter" name="inpServicesCenter">
                                                          <div class="invalid-feedback">
                                                             Please enter the attributes!.
                                                          </div>
                                                       </div>
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
                                                 </form>
                                             <!-- End General Form Elements -->
                                            </div>
                                        </div>
                                     </div>
                                </section>
                            
                                <section id="StateListSection">
                                   <div class="row">
                                        <div class="col-lg-12 ">
                                             <div class="row" >
                                                <div class="col-3">
                                                   <h5 class="card-title">Service Attributes</h5>
                                                </div>
                                                <div class="col-9 pt-4 " align="right">
                                                   <button class="btn btn-primary " onclick="showAddStateSection();">Add new service attributes</button>
                                                </div>
                                             </div>
                                             <div class="col-sm-12 table-responsive">
                                                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                                                   <thead>
                                                      <tr>
                                                         <th scope="col">#</th>
                                                         <th scope="col">Attribute</th>
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
                                </section>
                                
                            </div>
                               
                        </div>
                        
                        <div class="tab-pane fade" id="v-pills-Feilds" role="tabpanel" aria-labelledby="v-pills-Feilds">
                            
                            <div id="disTab2">
                                <section class="section d-none" id="StateFormSection1">
                                   <div class="row">
                                        <div class="col-lg-12">
                                          <div class="" id="addEventFormDiv1">
                                             <h5 class="card-title mb-4" id="addEVT1">Add Service Attribute Fields</h5>
                                             <form id="addCountyForm1"  >
                                                <div class="row mb-3">
                                                   <label for="" class="col-12 col-form-label">Attribute</label>
                                                   <div class="col-12">
                                                      <select class="form-control select2" aria-label="Default select example" id="selAttribute" name="selAttribute" >
                                                      </select>
                                                      <div class="invalid-feedback">
                                                         Please select the Attribute!.
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row mb-3">
                                                   <label for="" class="col-12 col-form-label">Enter attribute field</label>
                                                   <div class="col-12">
                                                      <input type="text" class="form-control" id="inpServicesCenter1" name="inpServicesCenter1">
                                                      <div class="invalid-feedback">
                                                         Please enter the attribute field!.
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row mb-3">
                                                   <label for="" class="col-12 col-form-label">Field type</label>
                                                   <div class="col-12">
                                                      <select class="form-control select2" aria-label="Default select example" id="selFieldType" name="selFieldType" onchange="changeFeildType();">
                                                         <option value="" selected>Select field type</option>
                                                         <option value="dropdown">dropdown</option>
                                                         <option value="text">text</option>
                                                         <option value="dropdown with options">dropdown with options</option>
                                                      </select>
                                                      <div class="invalid-feedback">
                                                         Please select the Field type!.
                                                      </div>
                                                   </div>
                                                </div>
                                                
                                                
                                                <div class="row mb-3 d-none" id="disFieldType3">
                                                    <label for="" class="col-12 col-form-label">Value In</label>
                                                     <div class="col-12">
                                                            <div class="container">
                                                              <div class="radio">
                                                                <label><input type="radio" name="optionsRadios" id="radiotext" value="text" checked> text</label>
                                                              </div>
                                                              <div class="radio">
                                                                <label><input type="radio" name="optionsRadios" id="radioprice" value="price"> price</label>
                                                              </div>
                                                              <div class="radio">
                                                                <label><input type="radio" name="optionsRadios" id="radiopercentage" value="percentage"> percentage</label>
                                                              </div>
                                                            </div>
                                                       </div>
                                                    
                                                </div>
                                                
                                                
                                                <div class="row mb-3 d-none" id="disFieldType2">
                                                    
                                                     <div class="col-12">
                                                          <div class="row ">
                                                             <label for="" class="col-12 col-form-label">Options (add options separated by commas)</label>
                                                             <div class="col-12">
                                                                <textarea class="form-control" id="inpOptions" name="inpOptions"></textarea>
                                                                <div class="invalid-feedback">
                                                                   Please enter the options!.
                                                                </div>
                                                             </div>
                                                          </div>
                                                       </div>
                                                    
                                                </div>
                                                
                                                
                                                
                                                <div class="row mb-3 d-none" id="disFieldType">
                                                   <div class="col-6">
                                                      <div class="row ">
                                                         <label for="" class="col-12 col-form-label">Min</label>
                                                         <div class="col-12">
                                                            <input type="text" class="form-control" id="inpMin" name="inpMin" value='0'>
                                                            <div class="invalid-feedback">
                                                               Please enter the Min!.
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-6">
                                                      <div class="row ">
                                                         <label for="" class="col-12 col-form-label">Max</label>
                                                         <div class="col-12">
                                                            <input type="text" class="form-control" id="inpMax" name="inpMax" value='0'>
                                                            <div class="invalid-feedback">
                                                               Please enter the Max!.
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row mb-3 mt-5">
                                                   <div class="col-sm-9"></div>
                                                   <div class="col-sm-3">
                                                      <div class="float-right">
                                                         <input type="hidden" id="hiddenEventId1" name="hiddenEventId1" value="">
                                                         <input type="hidden" id="save1" name="save1" value="add">
                                                         <input type="hidden" id="oldType1" name="oldType1" value="">
                                                         <button type="submit" id="submitButton1" class="btn btn-primary float-right">SAVE</button>
                                                         <button class="btn btn-primary d-none" type="button" id="submitLoadingButton1" disabled>
                                                         <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                         Please wait...
                                                         </button>
                                                         <button type="button" class="btn btn-danger" onclick="cancelCountyForm1();">Cancel</button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </form>
                                             <!-- End General Form Elements -->
                                          </div>
                                        </div>
                                    </div>
                                </section>
                                
                                
                                <section id="StateListSection1">
                                   <div class="row">
                                      <div class="col-lg-12 ">
                                         <div class="row">
                                            <div class="col-3">
                                               <h5 class="card-title">Service Attribute Fields</h5>
                                            </div>
                                            <div class="col-9 pt-4 " align="right">
                                               <button class="btn btn-primary " onclick="showAddStateSection1();">Add new service attribute fields</button>
                                            </div>
                                         </div>
                                         <div class="col-sm-12 table-responsive">
                                            <table class="table table-striped mt-4 " width="100%" id="eventListTable1">
                                               <thead>
                                                  <tr>
                                                     <th scope="col">#</th>
                                                     <th scope="col">Attribute</th>
                                                     <th scope="col">Feild</th>
                                                     <th scope="col">Type</th>
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
                                </section>
                            </div>                
                            
                               
                        </div>
                        <div class="tab-pane fade" id="v-pills-Service-Type" role="tabpanel" aria-labelledby="v-pills-Service-Type-tab">
                            
                            
                            <div id="disTab3">
                                
                                 <section class="section d-none" id="StateFormSection2">
                                      <div class="row">
                                        <div class="col-lg-12">
                                
                                            <div class="" id="addEventFormDiv2">
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
                                    </section>
        
                                <section id="StateListSection2">
                                  <div class="row">
                                    <div class="col-lg-12 ">
                                     
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
                                </section>
        
                            </div>  
                            
                            
                            
                            
                            
                        </div>
                       
                        
                        <div class="tab-pane fade" id="v-pills-category-Type" role="tabpanel" aria-labelledby="v-pills-Service-category-tab" >
                            <div id="disTab5" >
                               <section class="section d-none" id="StateFormSection12">
                                  <div class="row">
                                     <div class="col-lg-12">
                                        <div class="" id="addEventFormDiv12">
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
                                           </form>
                                        </div>
                                     </div>
                               </section>
                               <section id="StateListSection12">
                                   <div class="row">
                                   <div class="col-lg-12 ">
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
                               </section>
                            </div>
                        </div>
                        
                        
                        <div class="tab-pane fade" id="v-pills-Link-Type" role="tabpanel" aria-labelledby="v-pills-Service-Link-tab">
                            
                            <div id="disTab6">
                                
                                
                                
                                    <section class="section d-none" id="StateFormSection123">
                                      <div class="row">
                                        <div class="col-lg-12">
                                
                                          <div class="">
                                            <div class="" id="addEventFormDiv123">
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
                                    </section>
                                
                                
                                
                                
                                
                                
                            </div>
                            
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

   var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
 var service_center_sub_id_edt = false;
 
  $( document ).ready(function() {
      
        getAttributesData();
        
  });
  
  
  function getServiceLinkData(){
        $('#disTab1').addClass('d-none');
      $('#disTab2').addClass('d-none');
      $('#disTab3').addClass('d-none');
      $('#disTab5').addClass('d-none');
      
      $('#disTab6').removeClass('d-none');
      
      
        getStateListData123();

        getAttribute123("selAttributeServiceCentersLink");
        
        getAttributeStaffLink("selAttributeStafftypeLink");
        getAttributeUserLink("selAttributeUsertypeLink");
        
        getSCSubCat("selAttributeServiceCentersSubLink");
        
        
        
      
      
      
      
      
  }
  
  
  
   
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
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList",'sel_id':2};
        
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
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList",'sel_id':1};
        
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
 
 
  
  
  
  
  
  function getServicecategoryData(){
       $('#disTab1').addClass('d-none');
      $('#disTab2').addClass('d-none');
      $('#disTab3').addClass('d-none');
      $('#disTab5').removeClass('d-none');
      
      $('#disTab6').addClass('d-none');
      
      getStateListData12();
      getAttribute12("selAttributeServiceCenters");
  }
  
  
   
    
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
 
 
 
  
  
  
  
  
  
  function getServiceTypeData(){
      
       $('#disTab1').addClass('d-none');
      $('#disTab2').addClass('d-none');
      $('#disTab3').removeClass('d-none');
      
      $('#disTab5').addClass('d-none');
      $('#disTab6').addClass('d-none');
      
      getStateListData2();
      
  }
  
  
  
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
 
 
  
  
  
  
  
  
  function getAttributesFeildsData(){
      $('#disTab1').addClass('d-none');
      $('#disTab2').removeClass('d-none');
      $('#disTab3').addClass('d-none');
      $('#disTab5').addClass('d-none');
      $('#disTab6').addClass('d-none');
      
      
       getStateListData1();

        getAttribute("selAttribute");
        
      
  }
  
  
  
  
   function changeFeildType(){
        var selFieldType = $('#selFieldType').val();
        
        $('#inpMin').val(0);
        $('#inpMax').val(0);
        $('#inpOptions').val('');
        $('#radiotext').prop('checked', true);
        
        
        if(selFieldType == 'dropdown'){
            $('#disFieldType').removeClass('d-none');
            $('#disFieldType2').addClass('d-none');
            $('#disFieldType3').addClass('d-none');
        }else if( selFieldType == 'dropdown with options'){
            $('#disFieldType2').removeClass('d-none');
            $('#disFieldType').addClass('d-none');
            $('#disFieldType3').addClass('d-none');
        }else{
            $('#disFieldType3').removeClass('d-none');
            $('#disFieldType').addClass('d-none');
            $('#disFieldType2').addClass('d-none');
        }
    }
    
    
    
   
    
    
     function getAttribute(selectId) {
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Attribute</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.id+"'>"+value.attribute_name+"</option>";
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
      $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getServicesAttributesListData"};
    
    apiCall(data,successFn);
    
}
    
 
  
  function showAddStateSection1(){
      
      emptyForm1();
      

     
    $("#StateListSection1").addClass("d-none");
        $('#addEVT1').html('Add attribute feild');
        
       
        $('#StateFormSection1').removeClass("d-none");
      
  }
  
  function emptyForm1(){
      $('#addCountyForm1').removeClass('was-validated');
       $("#hiddenEventId1").val("");
       $("#save1").val("add");
       
       $("#inpServicesCenter1").val("");
       
       $("#selAttribute").val("").trigger('change');
       $("#selFieldType").val("").trigger('change');
       
       
       $('#inpMin').val(0);
        $('#inpMax').val(0);
        $('#disFieldType').addClass('d-none');
       $('#inpOptions').val('');
       $('#disFieldType2').addClass('d-none');
       
       $('#disFieldType3').addClass('d-none');
       $('#radiotext').prop('checked', true);
       
      
       
       $('#submitLoadingButton1').addClass('d-none');
       $("#submitButton1").removeClass("d-none");


  }
  
  
  function getStateListData1(){
      
    successFn = function(resp)  {
        $('#eventListTable1').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable1').DataTable( { } );
        $('#eventListTable1').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
            
              
              { "data": "attribute_name" },
              { "data": "attribute_feild" },

              
              
                { "data": null,
                render: function ( data ) {
                    
                    var attribute_type = data['attribute_type'];
                    if(attribute_type == 'dropdown'){
                        return attribute_type+'<br> ( '+ data['attribute_min'] +' to '+data['attribute_max']+' ) ';
                    }else  if(attribute_type == 'dropdown with options'){
                        return attribute_type+'<br> ( '+ data['attribute_options'] +' ) ';
                    }else return attribute_type+' ('+ data['attribute_checkedvalue'] +')';
                    
                 
                    
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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList1('+item.id+');" style="cursor:pointer">edit</span>';
                  
                //   <span class="badge bg-danger" onclick="deleteState1('+item.id+');" style="cursor:pointer">delete</span>
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesAttributesFeildListData" };
    
    apiCall(data,successFn);
}

  
  
  function editStateList1(id){
      
    //   emptyForm1();
       $('#submitLoadingButton1').addClass('d-none');
       $("#submitButton1").removeClass("d-none");

    
        $('#addEVT1').html('Update attribute feild');
          $('#StateFormSection1').removeClass("d-none");
                $("#StateListSection1").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId1").val(id);
                $("#save1").val("edit");
                
               $("#inpServicesCenter1").val(eventList['attribute_feild']);
               
               
                 
               $("#selAttribute").val(eventList['attribute_id']).trigger('change');
               $("#selFieldType").val(eventList['attribute_type']).trigger('change');
               
               
               $('#inpMin').val(eventList['attribute_min']);
                $('#inpMax').val(eventList['attribute_max']);
                $('#inpOptions').val(eventList['attribute_options']);
                
                $('#disFieldType').addClass('d-none');
                $('#disFieldType2').addClass('d-none');
                $('#disFieldType3').addClass('d-none');
                
                
                $('#radio'+eventList['attribute_checkedvalue']).prop('checked', true);
                
                
                if(eventList['attribute_type'] == 'dropdown') $('#disFieldType').removeClass('d-none');
                else if(eventList['attribute_type'] == 'dropdown with options') $('#disFieldType2').removeClass('d-none');
                else $('#disFieldType3').removeClass('d-none');
                
             

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesFeildList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm1(){
      emptyForm1();
      $('#StateFormSection1').addClass("d-none");
      $("#StateListSection1").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm1").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
        var selFieldType = $('#selFieldType').val();
        
        $('#inpMin').removeClass('is-invalid');
        $('#inpMax').removeClass('is-invalid');
        
        var inpMin = $('#inpMin').val();
        var inpMax = $('#inpMax').val();
        var inpOptions = $('#inpOptions').val();
        
        if(selFieldType == 'dropdown'){
            
            if(inpMin == ''){
                $('#inpMin').addClass('is-invalid');
                return false;
            }
            
            if(inpMax == '' || inpMax == 0 && inpMax <= inpMin){
                $('#inpMax').addClass('is-invalid');
                return false;
            }
            $('#inpOptions').val('');
            
            
        }else if( selFieldType == 'dropdown with options'){
           if(inpOptions == ''){
                $('#inpOptions').addClass('is-invalid');
                return false;
            }
            
            $('#inpMin').val(0);
            $('#inpMax').val(0);
        }else{
            $('#inpMin').val(0);
            $('#inpMax').val(0);
            $('#inpOptions').val('');
        }
        
        var checkedValue = $('input[name="optionsRadios"]:checked').val();
        
   

        var save = $("#save1").val();
       
        
        var form = $("#addCountyForm1");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesAttributeFeild');
        formData.append('save', save);
        formData.append('checkedValue', checkedValue);
        
        

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Attribute feild",
                icon: false,
                // buttons: true,
                // dangerMode: true,
                showCancelButton: true,
                confirmButtonText: 'Yes'
                }).then((confirm) => {
                    // console.log(confirm.isConfirmed);
                    if (confirm.isConfirmed) {
                        
                        $('#submitLoadingButton1').removeClass('d-none');
                        $("#submitButton1").addClass("d-none");

                        $.ajax({
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton1").removeClass("d-none");
                                $("#submitLoadingButton1").addClass("d-none");
                                // $("#hiddenEventId1").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Attribute feild "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm1();
                                    getStateListData1();
                                    
                                    cancelCountyForm1();
                                    
                                    // $("#updateEventButton").removeClass("d-none");
                                    // $("#submitLoadingButton1").addClass("d-none");
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: resp.data,
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $("#submitButton1").removeClass("d-none");
                                        $("#submitLoadingButton1").addClass("d-none");
                                    }
                                    
                                }
                        });
                    }else{
                        $("#submitButton1").removeClass("d-none");
                        $("#submitLoadingButton1").addClass("d-none");
                        // $("#hiddenEventId1").val("");
                    }
            });
            
            
    
    },
    rules: {
        
        inpServicesCenter1: {
            required: true
        },
        selFieldType: {
            required: true
        },
        selAttribute: {
            required: true
        },
        
        
      
       
    },
    messages: {
      
         inpServicesCenter1: {
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



function deleteState1(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Attribute feild",
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
                             emptyForm1();
                            getStateListData1();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicesAttributesFeild" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
  
  
  
  
  
  
  function getAttributesData(){
      $('#disTab2').addClass('d-none');
      $('#disTab1').removeClass('d-none');
      $('#disTab3').addClass('d-none');
      $('#disTab5').addClass('d-none');
      $('#disTab6').addClass('d-none');
      getStateListData();
  }
  
 
  
  function showAddStateSection(){
      
      emptyForm();
      

     
    $("#StateListSection").addClass("d-none");
        $('#addEVT').html('Add services attribute');
        
       
        $('#StateFormSection').removeClass("d-none");
      
  }
  
  function emptyForm(){
      $('#addCountyForm').removeClass('was-validated');
       $("#hiddenEventId").val("");
       $("#save").val("add");
       
       $("#inpServicesCenter").val("");
      
       
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");


  }
  
  
  function getStateListData(){
      
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
            
              
              { "data": "attribute_name" },
              
           

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
                  var str = '<span class="badge bg-info text-dark" onclick="editStateList('+item.id+');" style="cursor:pointer">edit</span>';
                  
                //   <span class="badge bg-danger" onclick="deleteState('+item.id+');" style="cursor:pointer">delete</span>
                  
                
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesAttributesListData" };
    
    apiCall(data,successFn);
}

  
  
  function editStateList(id){
      
    //   emptyForm();
       $('#submitLoadingButton').addClass('d-none');
       $("#submitButton").removeClass("d-none");

    
        $('#addEVT').html('Update Services attribute');
          $('#StateFormSection').removeClass("d-none");
                $("#StateListSection").addClass("d-none");
        
        
        
        successFn = function(resp)  {
            if(resp.status == 1){
              
                var eventList = resp.data;

                $("#hiddenEventId").val(id);
                $("#save").val("edit");
                
               $("#inpServicesCenter").val(eventList['attribute_name']);
             

            }
           
            
          
        }
        data = { "function": 'SystemManage',"method": "geteditServicesAttributesList" ,"sel_id":id };
        
        apiCall(data,successFn);
        
        
        
        
      
  }
  
  
  
  function cancelCountyForm(){
      emptyForm();
      $('#StateFormSection').addClass("d-none");
      $("#StateListSection").removeClass("d-none");
  }
  
  
  
  $("#addCountyForm").submit(function(event) {
    event.preventDefault();
}).validate({
    submitHandler: function(form) {
        
      
        var save = $("#save").val();
       
        
        var form = $("#addCountyForm");
        var formData = new FormData(form[0]);
        
        formData.append('function', 'SystemManage');
        formData.append('method', 'saveServicesAttributes');

       
        return new swal({
                title: "Are you sure?",
                text: "You want to "+save+" this Attributes",
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
                           
                            type: 'POST',
                            url: 'ajaxHandler.php',
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData:false,
                            error:function(){
                               $("#submitButton").removeClass("d-none");
                                $("#submitLoadingButton").addClass("d-none");
                                // $("#hiddenEventId").val("");
                            },
                            success: function(resp){
                                // console.log(resp);
                                resp=JSON.parse(resp);
                                if(resp.status == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        // title: resp.data,
                                        title: "Attributes "+save+" successfully",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // $('#uploadForm')[0].reset();
                                    emptyForm();
                                    getStateListData();
                                    
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
        
        inpServicesCenter: {
            required: true
        },
      
       
    },
    messages: {
      
         inpServicesCenter: {
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



function deleteState(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Attribute",
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
                            getStateListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "deleteServicesAttributes" ,"sel_id":id };
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