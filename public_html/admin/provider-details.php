<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}
include("templates/provider-header.php");

$isProvider = $_SESSION['isProvider'];

if(!$isProvider){
    echo '<script>';
    echo 'window.location.href = "service-provider-login.php";';
    echo '</script>';
    
}


?>

<style>
    .dataTables_paginate {
        width: 50%;
        float: left !important;
    }
</style>

    <div class="pagetitle">
      <h1>Company Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Company Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    
    <section class="section profile" id="companyListSection">
      <div class="row">
       

        <div class="col-xl-12">
            
            <div class="card">
                <div class="card-body pt-3">
                    
                    <div id="companyListDiv"></div>
                    
                </div>
                    
            </div>
            
        </div>
            
    </div>
            
    </section>
    
    
    <section class="section profile d-none" id="companyUpdateSection">
      <div class="row">
       

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
                
                 <div class="row">
       

                    <div class="col-xl-12" align="right">
                        <button type="button" class="btn btn-primary pull-right" onclick="getAllCompanyListWithDetails();">Cancel</button>
                        
                        
                    </div>
                </div>
                
                
                
                
                
                
                
                
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" onclick="getCompanyDetails();">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" onclick="editCompanyDetails();">Edit</button>
                </li>
                
                  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#property-instructions" onclick="editPropertyInstructions();">service/property</button>
                </li>
                
                 <li class="nav-item d-none" id="companyLogoMenu">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-logo" onclick="uploadLogo();">Logo</button>
                </li>
                
                 <li class="nav-item d-none" id="updatePhotographMenu">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-photographs" onclick="uploadPhotographs();">Photographs</button>
                </li>
                
                 <li class="nav-item d-none" id="updateAccountMenu">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-account" onclick="uploadAccount();">Bank account</button>
                </li>
                
                <li class="nav-item d-none" id="updateTCMenu">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#property-tac" onclick="editTermsAndConditions();">Terms & Conditions</button>
                </li>
                
                 <li class="nav-item d-none" id="updateDocumentsMenu">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#property-documents" onclick="uploadDocuments();">Documents</button>
                </li>
                
                
                
             
              </ul>
              <div class="tab-content pt-2">
                  
                   <div class="alert alert-danger d-none" role="alert" id="pendingAlert">
                      <strong>Company details are pending.</strong> Please update your company information.
                    </div>

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                      <div id="displayCompanyDetailsDiv"></div>
                      <div id="displayCompanyPhotographsDiv"></div>
                      
                    </div>

                <div class="tab-pane fade profile-edit " id="profile-edit">
                    
                    <h5 class="card-title">Update company details</h5>

                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Company name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpCompanyName" name="inpCompanyName">
        
                                <div class="invalid-feedback">
                                Please enter the Company name!.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Company email</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpCompanyEmail" name="inpCompanyEmail">
        
                                <div class="invalid-feedback">
                                Please enter the valid Company email!.
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">County</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selCounty" name="selCounty" onchange="getState('selState');">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the County!.
                                </div>
                            </div>
                            
                        </div>
                        
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">State</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selState" name="selState" onchange="getCity('selCity');">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the State!.
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">District</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selCity" name="selCity">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the District!.
                                </div>
                            </div>
                            
                        </div>
                        
                       <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Service Center Type</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selServiceCenter" name="selServiceCenter">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Service Center Type!.
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Company address</label>
                            <div class="col-12">
                                <textarea class="form-control" id="inpCompanyAddress" name="inpCompanyAddress"></textarea>
        
                                <div class="invalid-feedback">
                                Please enter the Company address!.
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Location</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpCompanyLocation" name="inpCompanyLocation">
        
                                <div class="invalid-feedback">
                                Please enter the Location!.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Website link</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpCompanyLink" name="inpCompanyLink">
        
                                <div class="invalid-feedback">
                                Please enter the Website link!.
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Contact number</label>
                            <div class="col-12">
                                
                                 <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="text" class="form-control" id="inpCompanyPhone" name="inpCompanyPhone" placeholder="Enter contact number" aria-label="Enter contact number" aria-describedby="basic-addon1">
                                      <div class="invalid-feedback">
                                    Please enter the Contact number!.
                                    </div>
                                </div>
                                
                              
                                
                            </div>
                           
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Whatsapp number</label>
                            <div class="col-12">
                                
                                 <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="text" class="form-control" id="inpWhatsappNumber" name="inpWhatsappNumber" placeholder="Enter whatsapp number" aria-label="Enter whatsapp number" aria-describedby="basic-addon1">
                                      <div class="invalid-feedback">
                                    Please enter the Whatsapp number!.
                                    </div>
                                </div>
                                
                                
                             
                            </div>
                           
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned your organisation staff</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpAssaignedHotelPerson" name="inpAssaignedHotelPerson">
        
                                <div class="invalid-feedback">
                                Please enter the Assaigned Hotel person!.
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned  staff contact number</label>
                            <div class="col-12">
                                
                                 <div class="input-group mb-3">
                                  <span class="input-group-text" id="basic-addon1">+91</span>
                                  <input type="text" class="form-control" id="inpHotelPersonPhone" name="inpHotelPersonPhone" placeholder="Enter contact number" aria-label="Enter contact number" aria-describedby="basic-addon1">
                                      <div class="invalid-feedback">
                                    Please enter the Assaigned hotel person contact number!.
                                    </div>
                                </div>
                                
                            </div>
                           
                        </div>
                        
                           
                      <!-- <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person</label>
                           
                            <div class="col-12">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="selAssaignedMachooosPerson" name="selAssaignedMachooosPerson">
                                    </select>
                                
                                
                                
                                <div class="invalid-feedback">
                                Please select the Assaigned machooos person!.
                                </div>
                            </div>
                            
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Assaigned machooos person contact number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpMachooosPersonPhone" name="inpMachooosPersonPhone" placeholder="Enter contact number">
        
                                <div class="invalid-feedback">
                                Please enter the Assaigned machooos person contact number!.
                                </div>
                            </div>
                           
                        </div>-->
                        
                         <!--<div class="row mb-3">
                           <!-- <label for="" class="col-12 col-form-label text-dark">Service hours (office working Hours )</label>
                           <!-- <div class="col-6">
                                <input type="text" class="form-control" id="inpServiceHours" name="inpServiceHours" >
        
                                <div class="invalid-feedback">
                                Please enter the Service hours!.
                                </div> 
                            </div>
                            
                             <div class="col-6">
                                
                                 <select class="form-control select2" aria-label="Default select example" id="inpServiceHoursType" name="inpServiceHoursType">
                                     <option selected value='hrs'>hrs</option>
                                     <option value='min'>min</option>
                                    </select>
                                
                                
                               
                            </div>
                           
                        </div>-->
                        
                         <div class="row mb-3">
                            <div class="col-12">
                                <input type="checkbox" id="provideWelcomeDrink" name="provideWelcomeDrink">
                                <label for="myCheckbox" class="text-dark">Provide welcome drink</label>
                            </div>
                            <div class="col-12">
                                <input type="checkbox" id="provideFood" name="provideFood">
                                <label for="myCheckbox" class="text-dark">Provide food</label>
                            </div>
                             <div class="col-12">
                                <input type="checkbox" id="provideSeperateCabin" name="provideSeperateCabin">
                                <label for="myCheckbox" class="text-dark">Provide seperate cabin</label>
                            </div>
                             <div class="col-12">
                                <input type="checkbox" id="provideCommonRestaurant" name="provideCommonRestaurant">
                                <label for="myCheckbox" class="text-dark">Provide common restaurant</label>
                            </div>
                            
                            
                             <div class="col-12">
                                <input type="checkbox" id="provideWifi" name="provideWifi">
                                <label for="myCheckbox" class="text-dark">Provide wifi</label>
                            </div>
                            
                             <div class="col-12">
                                <input type="checkbox" id="provideParking" name="provideParking">
                                <label for="myCheckbox" class="text-dark">Provide parking</label>
                            </div>
                            
                             <div class="col-12">
                                <input type="checkbox" id="provideAC" name="provideAC">
                                <label for="myCheckbox" class="text-dark">Provide air condition</label>
                            </div>
                            
                             <div class="col-12">
                                <input type="checkbox" id="provideRooftop" name="provideRooftop">
                                <label for="myCheckbox" class="text-dark">Provide rooftop</label>
                            </div>
                            
                             <div class="col-12">
                                <input type="checkbox" id="provideBathroom" name="provideBathroom">
                                <label for="myCheckbox" class="text-dark">Provide bathroom</label>
                            </div>
                            
                            <div class="col-12">
                                <input type="checkbox" id="provideExtraServices" name="provideExtraServices" onclick="changeProvideExtraServices();">
                                <label for="myCheckbox" class="text-dark">Provide any extra services</label>
                            </div>
                           
                        </div>
                        
                        
                         <div class="row mb-3 d-none" id="divExtraServices">
                            <label for="" class="col-12 col-form-label text-dark">Extra services</label>
                            <div class="col-12">
                                <textarea class="form-control" id="inpExtraServices" name="inpExtraServices"></textarea>
        
                                <div class="invalid-feedback">
                                Please enter the extra services!.
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Working hours</label>
                            
                            <div class="col-12 mb-3">
                                <input type="checkbox" value="Mon" id="workingHoursDays_Mon" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Monday</label>
                                
                                <input type="checkbox" value="Tue" id="workingHoursDays_Tue" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Tuesday</label>
                                
                                 <input type="checkbox" value="Wed" id="workingHoursDays_Wed" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Wednesday</label>
                                
                                <input type="checkbox" value="Thu" id="workingHoursDays_Thu" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Thursday</label>
                                
                                <input type="checkbox" value="Fri" id="workingHoursDays_Fri" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Friday</label>
                                
                                <input type="checkbox" value="Sat" id="workingHoursDays_Sat" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Saturday</label>
                                
                                <input type="checkbox" value="Sun" id="workingHoursDays_Sun" name="workingHoursDays" checked>
                                <label for="myCheckbox" class="text-dark">Sunday</label>
                               
                                
                            </div>
                            
                            
                            <div class="col-6">
                                <input type="time" class="form-control" id="inpWorkingHoursStart" name="inpWorkingHoursStart" >
        
                                <div class="invalid-feedback">
                                Please select the Working hours!.
                                </div>
                            </div>
                            
                             <div class="col-6">
                                <input type="time" class="form-control" id="inpWorkingHoursEnd" name="inpWorkingHoursEnd" >
        
                                <div class="invalid-feedback">
                                Please select the Working hours!.
                                </div>
                            </div>
                           
                        </div>
                        
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Social media links</label>
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpFacebook" name="inpFacebook" placeholder="Facebook link">
                            </div>
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpInstagram" name="inpInstagram" placeholder="Instagram link">
                            </div>
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpTwitter" name="inpTwitter" placeholder="Twitter link">
                            </div>
                              <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpLinkedin" name="inpLinkedin" placeholder="Linkedin link">
                            </div>
                             
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpPinterest" name="inpPinterest" placeholder="Pinterest link">
                            </div>
                            
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpYoutube" name="inpYoutube" placeholder="Youtube link">
                            </div>
                            
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpReddit" name="inpReddit" placeholder="Reddit link">
                            </div>
                            
                             <div class="col-12 mb-2">
                                <input type="text" class="form-control" id="inpTumbler" name="inpTumbler" placeholder="Tumbler link">
                            </div>
                             
                             
                             
                        </div>
                        
                      
                        
                        <div class="col-12 mt-4 " >
                          <button id="submitButton11" class="btn btn-primary w-100" type="button" onclick="saveCompanyDetails();">Save</button>
                          <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton11" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                            </button>
                        </div>
                             
                                    
                        
                        
                        
                        
                        
                        

                </div>
                
                <div class="tab-pane fade property-instructions " id="property-instructions">
                  <h5 class="card-title">service/Property using instructions</h5>
                  
                  
                   <div class="row mb-3">
                       
                        <div class="col-12">
                            <textarea class="form-control" id="inpPropertInstructions" name="inpPropertInstructions"></textarea>

                            <div class="invalid-feedback">
                            Please enter the service instructions!.
                            </div>
                        </div>
                    </div>
                    
                     <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Time allowed for service</label>
                            
                            <div class="col-6">
                                <input type="time" class="form-control" id="inpStartTime" name="inpStartTime" >
        
                                <div class="invalid-feedback">
                                Please select the Start time!.
                                </div>
                            </div>
                            
                             <div class="col-6">
                                <input type="time" class="form-control" id="inpEndTime" name="inpEndTime" >
        
                                <div class="invalid-feedback">
                                Please select the End time!.
                                </div>
                            </div>
                           
                        </div>
                        
                        
                        <!--<div class="row mb-3">-->
                        <!--    <label for="" class="col-12 col-form-label text-dark">Allowed maximum numbers of family members</label>-->
                        <!--    <div class="col-12">-->
                        <!--        <input type="text" class="form-control" id="inpNumberOfMembers" name="inpNumberOfMembers">-->
        
                        <!--        <div class="invalid-feedback">-->
                        <!--        Please enter the Allowed maximum numbers of family members!.-->
                        <!--        </div>-->
                        <!--    </div>-->
                           
                        <!--</div>-->
                        
                        <!--<div class="row mb-3">-->
                        <!--    <label for="" class="col-12 col-form-label text-dark">Extra price per head</label>-->
                        <!--    <div class="col-12">-->
                        <!--        <input type="text" class="form-control" id="inpExtraPrice" name="inpExtraPrice">-->
        
                        <!--        <div class="invalid-feedback">-->
                        <!--        Please enter the Extra price per head!.-->
                        <!--        </div>-->
                        <!--    </div>-->
                           
                        <!--</div>-->
                        
                        <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">If you have any additional information to mention, please do so.</label>
                          
                            <div class="col-12">
                                <textarea class="form-control" id="inpAdditionalInfo" name="inpAdditionalInfo"></textarea>
    
                                <div class="invalid-feedback">
                                Please enter the Additional informations!
                                
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Your office location link</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpPropertyLocationLink" name="inpPropertyLocationLink">
    
                                <div class="invalid-feedback">
                                Please enter the office location link!.
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="col-12 mt-4 " >
                          <button id="submitButton12" class="btn btn-primary w-100" type="button" onclick="savePropertyInstructions();">Save</button>
                          <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton12" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                            </button>
                        </div>
                  
                  
                </div>
                
                <div class="tab-pane fade profile-logo " id="profile-logo">
                    <h5 class="card-title">Company Logo</h5>
                    
                    <div id="displayCompanyLogoDiv" class="pb-4"></div>
                    
                    
                    
                    <form id="uploadCompanyLogoForm" class="g-3 needs-validation" novalidate="">
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadLogoFiles" name="uploadLogoFiles[]" accept="image/*" >
                                    <label class="custom-file-label" for="imageUploader">Upload logo (image size 300x48px)</label>
                                    <div class="text-danger" id="uploadLogoFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="progress mt-3">
                            <!-- Update the ID to match the selector used in the JavaScript -->
                            <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        
                        <div class="col-12 mt-4 " >
                            
                               
                              <button type="button" class="btn btn-primary" id="submitButton13" onclick="uploadCompanyLogoNow();">Update Logo</button>
                              <button class="btn btn-primary d-none" type="button" id="submitLoadingButton13" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Please wait...
                              </button>

                         
                        </div>
                        
                        
                    </form>
                    
                    
                    
                </div>
                
                <div class="tab-pane fade profile-photographs " id="profile-photographs">
                    <h5 class="card-title">Company Photographs</h5>
                    
                  
                    
                    <div id="displayCompanyPhotographsEditDiv" class="pb-4"></div>
                    <form id="uploadCompanyPhotographsForm" class="g-3 needs-validation" novalidate="">
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadPhotographsFiles" name="uploadPhotographsFiles[]" accept="image/*" multiple>
                                    <label class="custom-file-label" for="imageUploader">Upload Photographs</label>
                                    <div class="text-danger" id="uploadPhotographsFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="progress mt-3">
                            <!-- Update the ID to match the selector used in the JavaScript -->
                            <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar1" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        
                        <div class="col-12 mt-4 " >
                            
                               <h5 id="disUploadImgTitlenew" style="flex: auto;"></h5>
                              <button type="button" class="btn btn-primary" id="submitButton14" onclick="uploadCompanyPhotographsNow();">Update Photographs</button>
                              <button class="btn btn-primary d-none" type="button" id="submitLoadingButton14" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Please wait...
                              </button>

                         
                        </div>
                        
                        
                    </form>
                    
                    
                    
                </div>
                
                
                <div class="tab-pane fade profile-account " id="profile-account">
                  <h5 class="card-title">Bank account</h5>
                  
                 
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Bank name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpBankName" name="inpBankName">
    
                                <div class="invalid-feedback">
                                Please enter the Bank name!.
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Bank account holder's name</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpBankHolderName" name="inpBankHolderName">
    
                                <div class="invalid-feedback">
                                Please enter the Bank account holder's name!.
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Bank account number</label>
                            <div class="col-12">
                                <input type="password" class="form-control" id="inpBankNumber" name="inpBankNumber">
    
                                <div class="invalid-feedback">
                                Please enter the Bank account number!.
                                </div>
                            </div>
                        </div>
                        
                          <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">Re-enter bank account number</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpReBankNumber" name="inpReBankNumber">
    
                                <div class="invalid-feedback">
                                Bank account number not matching!.
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                            <label for="" class="col-12 col-form-label text-dark">IFSC code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="inpIFSC" name="inpIFSC">
    
                                <div class="invalid-feedback">
                                Please enter the IFSC code!.
                                </div>
                            </div>
                        </div>
                        
                        
                         <div class="col-12 mt-4 " >
                          <button id="submitButton15" class="btn btn-primary w-100" type="button" onclick="saveAccountDetails();">Save</button>
                          <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton15" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                            </button>
                        </div>
                  
                  
                </div>
                
                
                <div class="tab-pane fade property-tac " id="property-tac">
                  <h5 class="card-title">company Terms and Conditions</h5>
                  
                  
                   <div class="row mb-3">
                        <div class="col-12">
                            <textarea class="form-control" id="inpTermsAndConditions" name="inpTermsAndConditions"></textarea>

                            <div class="invalid-feedback">
                            Please enter the Terms and Conditions!.
                            </div>
                        </div>
                    </div>
                    
                 
                        
                        
                         <div class="col-12 mt-4 " >
                          <button id="submitButton22" class="btn btn-primary w-100" type="button" onclick="saveTermsAndConditions();">Save</button>
                          <button class="btn btn-primary w-100 d-none" type="button" id="submitLoadingButton22" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                            </button>
                        </div>
                  
                  
                </div>
                
                <div class="tab-pane fade property-documents " id="property-documents">
                    <h5 class="card-title">Upload Documents</h5>
                    
                   
                    
                 
                    <form id="uploadCompanyLogoForm" class="g-3 needs-validation" novalidate="">
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadDocumentsFiles" name="uploadDocumentsFiles[]" >
                                    <label class="custom-file-label" for="imageUploader">Upload Legal Documents</label>
                                    <div class="text-danger" id="uploadDocumentsFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="container ">
                            <div class="card p-4">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadBrucherFiles" name="uploadBrucherFiles[]" multiple>
                                    <label class="custom-file-label" for="imageUploader">Upload Brochures</label>
                                    <div class="text-danger" id="uploadBrucherFilesErr"></div>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="progress mt-3">
                            <!-- Update the ID to match the selector used in the JavaScript -->
                            <div class="progress-bar progress-bar-striped bg-danger" id="progress-bar3" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        
                        
                        <div class="col-12 mt-4 " >
                            
                               <h5 id="disUploadImgTitlenew1" style="flex: auto;"></h5>
                              <button type="button" class="btn btn-primary" id="submitButton131" onclick="uploadCompanyDocumentsNow();">Upload Documents</button>
                              <button class="btn btn-primary d-none" type="button" id="submitLoadingButton131" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                Please wait...
                              </button>

                         
                        </div>
                        
                        
                    </form>
                    
                    <br><hr>
                    
                     <h5 class="card-title">Legal Documents</h5>
                    
                     <div id="displayCompanyDocumentsDiv" class="pb-4"></div>
                    <div id="displayCompanyBrucherEditDiv" class="pb-4"></div>
                    
                    
                    
                </div>

              

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    
    
    
    

   

<?php 

include("templates/footer.php")

?>

<script>

var editState = false;
var editCity = false;
var uploadInProgress = false;
var totalImgUpload = 0;
var uploadImg = 0;

var selectedCompanyId = '';

$( document ).ready(function() {
    
    getAllCompanyListWithDetails();
    getCounty("selCounty");
    getState('selState');
    getCity('selCity');
    getServiceCenter('selServiceCenter');
    getAssaignedMachooosPerson('selAssaignedMachooosPerson');
    
    $('#uploadPhotographsFiles').imageuploadify();
    
    
 });
 
 function getAllCompanyListWithDetails(){
     
     $('#companyListDiv').html('');
     
     $('#companyUpdateSection').addClass('d-none');
     $('#companyListSection').removeClass('d-none');
     
     
    successFn = function(resp)  {
        
        if(resp.status == 1){
            var list = resp.data ;
            var tbl = '';
            if(list.length > 0 ){
                
                tbl +='<div class="row">';
                tbl +='<div class="col-8">';
                tbl +='<h5 class="card-title">My companys</h5>';
                tbl +='</div>';
                
                tbl +='<div class="col-4 mt-2">';
                 tbl +='<div align="right">';
                
                tbl +='<button type="button" class="btn btn-secondary" onclick="addNewCompany();">Add company</button>';
                tbl +='</div>';
                tbl +='</div>';
                
                tbl +='</div><br>';
               
                
                
                for (var i = 0; i < list.length; i++) {
                    if(i != 0) tbl +='<hr><br>';
                    
                    if(list[i]['is_company_add'] == 0){
                        
                        tbl +='<div class="alert alert-danger" role="alert" >';
                        tbl +='<strong>Company information is incomplete.</strong> Please update your company details.</div>';
                        
                        tbl +='<p class="text-muted">Your company information is incomplete. Please update your company details. Once updated, it will undergo approval. Until approval is granted, you will be unable to add any services.</p>';
                        tbl +='<div align="right"><br>';
                        tbl +='<button type="button" class="btn btn-primary " onclick="viewEditCompany(`'+list[i]['id']+'`);">Update company</button><br>';
                         tbl +='</div>';
                        
                    }else{
                        
                   
                    
                    
                        tbl +='<div class="row">';
                        tbl +='<div class="col-2">';
                          
                        tbl +='<div>';
                        if(list[i]['company_logo_url'] == '' || list[i]['company_logo_url'] == null) tbl +='<p class="text-danger">Logo not uploaded</p>';
                        else{
                            tbl +='<img src="'+list[i]['company_logo_url']+'" alt="" style="width: 100%;height: auto;">';
                        }
                        
                        tbl +='</div>';
                        tbl +='</div>';
                        tbl +='<div class="col-10">';
                        tbl +='<div>';
                        tbl +='<b class="text-dark">'+list[i]['company_name']+'</b> &nbsp;&nbsp;';
    
                        if(list[i]['is_accept_company'] == 0) tbl +='<span class="badge bg-warning">Pending</span>';
                        else if(list[i]['is_accept_company'] == 1) tbl +='<span class="badge bg-success">Accepted</span>';
                        else if(list[i]['is_accept_company'] == 2) tbl +='<span class="badge bg-danger">Rejected</span>';
                        
                        tbl +='<br>';
                        tbl +='<p>'+list[i]['company_address']+'</p>';
                        tbl +='<p>'+list[i]['city']+','+list[i]['state']+','+list[i]['short_name']+'</p>';
                        tbl +='<b class="text-primary">'+list[i]['company_link']+'</b><br>';
                        
                        if(list[i]['is_propert_instructions_add'] == 0 || list[i]['is_account_add'] == 0){
                            tbl +='<hr>';
                        }
                        
                        if(list[i]['is_propert_instructions_add'] == 0){
                            tbl +='<label class="text-danger">*service/property not updated</label><br>';
                        }
                        
                        if(list[i]['is_account_add'] == 0){
                            tbl +='<label class="text-danger">*Account details not updated</label><br>';
                        }
                        
                        
                        
                        
                        tbl +='</div>';
                        tbl +='</div>';
                        
                       
                        
                        tbl +='<div class="col-12">';
                        tbl +='<div align="right"><br>';
                        if(list[i]['is_accept_company'] == 0) tbl +='<button type="button" class="btn btn-danger " onclick="deleteCompany(`'+list[i]['id']+'`);">Delete</button>&nbsp;';
                        tbl +='<button type="button" class="btn btn-primary " onclick="viewEditCompany(`'+list[i]['id']+'`);">View company</button>&nbsp;';
                        tbl +='</div>';
                        tbl +='</div>';
                        tbl +='</div>';
                    
                    }
                    
                  
                }
                
               
                
                
            }else{
                
                tbl +='<h5 class="card-title">My companys</h5>';
                tbl +='<div class="alert alert-danger" role="alert" >';
                tbl +='<strong>You have no companys.</strong> Please add your company.</div>';
                
                tbl +='<p class="text-muted">You currently do not have a registered company associated with your account. Please add your company details to proceed. Once your company is added, it will undergo approval. Until approval is granted, you will be unable to add any services.</p>';
                
                tbl +='<button type="button" class="btn btn-secondary" onclick="addNewCompany();">Add company</button>';
                
                
            }
            $('#companyListDiv').html(tbl);
            
        }
        
        
    }
    data = { "function": 'SystemManage',"method": "getAllCompanyDetails" };
    
    apiCall(data,successFn);
     
 }
 
 function viewEditCompany(id){
     
      $('#companyUpdateSection').removeClass('d-none');
     $('#companyListSection').addClass('d-none');
     
     selectedCompanyId = id;
     
     getCompanyDetails();
     
 }
 

 
 function addNewCompany(){
     
     $('#companyUpdateSection').removeClass('d-none');
     $('#companyListSection').addClass('d-none');
     
     selectedCompanyId = '';
     
     getCompanyDetails();
     
     
 }
 
 function getCompanyDetails(){
     
     if(selectedCompanyId == ''){
         
         $('#updatePhotographMenu').addClass('d-none');
         $('#companyLogoMenu').addClass('d-none');
         $('#updateAccountMenu').addClass('d-none');
         $('#updateTCMenu').addClass('d-none');
          $('#updateDocumentsMenu').addClass('d-none');
     } 
     else{
         $('#updatePhotographMenu').removeClass('d-none');
         $('#companyLogoMenu').removeClass('d-none');
         $('#updateAccountMenu').removeClass('d-none');
         $('#updateTCMenu').removeClass('d-none');
         $('#updateDocumentsMenu').removeClass('d-none');
         
     } 
     
     
     
   
      tinymce.init({
            selector: '#inpPropertInstructions',
            height: 500,
            // theme : "advanced",
           // file_browser_callback : "fileBrowserCallBack",
        
            plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
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
          
          
          
          
          tinymce.init({
            selector: '#inpTermsAndConditions',
            height: 500,
            // theme : "advanced",
           // file_browser_callback : "fileBrowserCallBack",
        
            plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
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
              
              

     
     getAllPhotographs();
     getAllBrucher();
     
     $('#displayCompanyLogoDiv').html('');
     
      $('#displayCompanyDocumentsDiv').html('');
     $('#displayCompanyBrucherEditDiv').html('');
  
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            
            if(resp.data.is_company_add == 0) $('#pendingAlert').removeClass('d-none');
            else $('#pendingAlert').addClass('d-none');
            var disD = '';
            disD +='<h5 class="card-title">Company Logo</h5>';
            if(resp.data.company_logo_url == '' || resp.data.company_logo_url == null) disD +='<p class="text-muted">Logo not uploaded, Please update your company logo</p>';
            else{
                disD +='<img src="'+resp.data.company_logo_url+'" alt="" style="width: 10%;height: 10%;">';
            }
            
             var disD1 = '';
            if(resp.data.company_logo_url == '' || resp.data.company_logo_url == null) disD1 +='<p class="text-muted">Logo not uploaded, Please update your company logo</p>';
            else{
                disD1 +='<img src="'+resp.data.company_logo_url+'" alt="" style="width: 10%;height: 10%;">';
            }
            
            $('#displayCompanyLogoDiv').html(disD1);
            
            
             var disD2 = '';
            if(resp.data.company_document_url == '' || resp.data.company_document_url == null) disD2 +='<p class="text-muted">Document not uploaded, Please update document</p>';
            else{
                disD2 +='<a href="'+resp.data.company_document_url+'" target="_blank">'+resp.data.company_document_name+'</a>';
            }
            
            $('#displayCompanyDocumentsDiv').html(disD2);
            
        
            
            disD +='<h5 class="card-title">Company Details</h5>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Company name</div><div class="col-lg-9 col-md-8">'+resp.data.company_name+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Company email</div><div class="col-lg-9 col-md-8">'+resp.data.company_mail+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Company address</div><div class="col-lg-9 col-md-8">'+resp.data.company_address+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">County</div><div class="col-lg-9 col-md-8">'+resp.data.short_name+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">State</div><div class="col-lg-9 col-md-8">'+resp.data.state+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">District</div><div class="col-lg-9 col-md-8">'+resp.data.city+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Location</div><div class="col-lg-9 col-md-8">'+resp.data.company_location+'</div></div>';
            disD +='<br><div class="row"><div class="col-lg-3 col-md-4 label text-muted ">Website link</div><div class="col-lg-9 col-md-8"><a href="'+resp.data.company_link+'" target="_blank" >'+resp.data.company_link+'</a></div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Contact number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_phone+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Whatsapp number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_wa_number+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Assaigned Hotel person</div><div class="col-lg-9 col-md-8">'+resp.data.company_assistant+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Assaigned hotel person contact number</div><div class="col-lg-9 col-md-8">+91 '+resp.data.company_assistant_number+'</div></div>';
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Assaigned machooos person</div><div class="col-lg-9 col-md-8">'+resp.data.staff+'</div></div>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Assaigned machooos person contact number</div><div class="col-lg-9 col-md-8">'+resp.data.machoose_user_phone+'</div></div>';
            
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">ServiceHours</div><div class="col-lg-9 col-md-8">'+resp.data.service_hrs+' '+resp.data.service_hrs_type+'</div></div>';
            
            var provideS = '';
            if(resp.data.provide_welcome_drink == 1) provideS += 'Provide welcome drink <br>';

            if(resp.data.provide_food == 1) provideS += 'Provide food <br>';
    
            if(resp.data.provide_seperate_cabin == 1) provideS += 'Provide seperate cabin <br>';
    
            if(resp.data.provide_common_restaurant == 1) provideS += 'Provide common restaurant <br>';
            
            if(resp.data.provide_wifi == 1) provideS += 'Provide wifi <br>';
            if(resp.data.provide_parking == 1) provideS += 'Provide parking <br>';
            if(resp.data.provide_ac == 1) provideS += 'Provide air condition <br>';
            if(resp.data.provide_rooftop == 1) provideS += 'Provide rooftop <br>';
            if(resp.data.provide_bathroom == 1) provideS += 'Provide bathroom <br>';
            
            
            
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Company provide</div><div class="col-lg-9 col-md-8">'+provideS+'</div></div>';
            
            if(resp.data.provide_extra_service == 1){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Provide extra services</div><div class="col-lg-9 col-md-8">'+resp.data.extra_services+'</div></div>';
            }
            
            
            
            
            
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Working days</div><div class="col-lg-9 col-md-8">'+resp.data.working_days+'</div></div>';
            
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Working time</div><div class="col-lg-9 col-md-8">'+convertTo12HourFormat(resp.data.working_start)+' - '+convertTo12HourFormat(resp.data.working_end)+'</div></div>';
            
            
            
            disD +='<h5 class="card-title">Social media links</h5>';
            var ifnotlink = true;
            if(resp.data.facebook_link != '' && resp.data.facebook_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Facebook</div><div class="col-lg-9 col-md-8">'+resp.data.facebook_link+'</div></div>';
                ifnotlink = false;
            }
            
            if(resp.data.instagram_link != '' && resp.data.instagram_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Instagram</div><div class="col-lg-9 col-md-8">'+resp.data.instagram_link+'</div></div>';
                ifnotlink = false;
            }
            
            if(resp.data.twitter_link != '' && resp.data.twitter_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Twitter</div><div class="col-lg-9 col-md-8">'+resp.data.twitter_link+'</div></div>';
                ifnotlink = false;
            }
            
             if(resp.data.linkedin_link != '' && resp.data.linkedin_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Linkedin</div><div class="col-lg-9 col-md-8">'+resp.data.linkedin_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.pinterest_link != '' && resp.data.pinterest_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Pinterest</div><div class="col-lg-9 col-md-8">'+resp.data.pinterest_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.youtube_link != '' && resp.data.youtube_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Youtube</div><div class="col-lg-9 col-md-8">'+resp.data.youtube_link+'</div></div>';
                ifnotlink = false;
            }
            
               if(resp.data.reddit_link != '' && resp.data.reddit_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Reddit</div><div class="col-lg-9 col-md-8">'+resp.data.reddit_link+'</div></div>';
                ifnotlink = false;
            }
            
              if(resp.data.tumbler_link != '' && resp.data.tumbler_link != null){
                disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Tumbler</div><div class="col-lg-9 col-md-8">'+resp.data.tumbler_link+'</div></div>';
                ifnotlink = false;
            }
            
            
            
            if(ifnotlink) disD +='<p class="text-muted">No social media links available.</p>';
            
  
            
            
            disD +='<h5 class="card-title">service/property</h5>';
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">service/property</div><div class="col-lg-9 col-md-8">'+resp.data.propert_instructions+'</div></div>';
             disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Property use Time period</div><div class="col-lg-9 col-md-8">'+convertTo12HourFormat(resp.data.start_use_time)+' - '+convertTo12HourFormat(resp.data.end_use_time)+'</div></div>';
            //  disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Allowed maximum numbers of family members</div><div class="col-lg-9 col-md-8">'+resp.data.number_of_members+'</div></div>';
            // disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Extra price per head</div><div class="col-lg-9 col-md-8">₹'+resp.data.extra_price_per_head+'</div></div>';
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Additional informations</div><div class="col-lg-9 col-md-8">'+resp.data.additional_info+'</div></div>';
            
            disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Property location link</div><div class="col-lg-9 col-md-8">'+resp.data.property_location_link+'</div></div>';
            
            disD +='<h5 class="card-title">Bank account</h5>';
             if(selectedCompanyId == ''){
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank name</div><div class="col-lg-9 col-md-8"></div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank holder name</div><div class="col-lg-9 col-md-8"></div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Account number</div><div class="col-lg-9 col-md-8"></div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">IFSC code</div><div class="col-lg-9 col-md-8"></div></div>';
             }else{
                 
                 
                  disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank name</div><div class="col-lg-9 col-md-8">'+resp.data.bank_name+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Bank holder name</div><div class="col-lg-9 col-md-8">'+resp.data.bank_holder_name+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">Account number</div><div class="col-lg-9 col-md-8">'+resp.data.account_number+'</div></div>';
                 disD +='<div class="row"><div class="col-lg-3 col-md-4 label ">IFSC code</div><div class="col-lg-9 col-md-8">'+resp.data.ifsc_code+'</div></div>';
                 
              
             }
             
             disD +='<h5 class="card-title">Terms and Conditions</h5>';
              if(resp.data.terms_and_conditions == '' || resp.data.terms_and_conditions == null) disD +='<p class="text-muted">Terms and Conditions not uploaded, Please update your company Terms and Conditions</p>';
            else{
                disD +=resp.data.terms_and_conditions;
            }
             
            
            
            
            $('#displayCompanyDetailsDiv').html(disD);
            
      
              
         $("#selCounty").val(resp.data.county_id).trigger('change');
         
         getState('selState',resp.data.state_id);
         getCity('selCity',resp.data.city_id,resp.data.state_id);
         
         
         $("#selServiceCenter").val(resp.data.servicescenter_id).trigger('change');
            
        $('#inpCompanyName').val(resp.data.company_name);
        $('#inpCompanyEmail').val(resp.data.company_mail);
        $('#inpCompanyAddress').val(resp.data.company_address);
        $('#inpCompanyLocation').val(resp.data.company_location);
        $('#inpCompanyLink').val(resp.data.company_link);
        $('#inpCompanyPhone').val(resp.data.company_phone);
        $('#inpWhatsappNumber').val(resp.data.company_wa_number);
        $('#inpAssaignedHotelPerson').val(resp.data.company_assistant);
        $('#inpHotelPersonPhone').val(resp.data.company_assistant_number);
        $("#selAssaignedMachooosPerson").val(resp.data.machoose_user_id).trigger('change');
        $('#inpMachooosPersonPhone').val(resp.data.machoose_user_phone);
        $('#inpServiceHours').val(resp.data.service_hrs);
        $("#inpServiceHoursType").val(resp.data.service_hrs_type).trigger('change');
        
        if(resp.data.provide_welcome_drink == 1) $('#provideWelcomeDrink').prop('checked', true);
        else $('#provideWelcomeDrink').prop('checked', false);
        
        if(resp.data.provide_food == 1) $('#provideFood').prop('checked', true);
        else $('#provideFood').prop('checked', false);
        
        if(resp.data.provide_seperate_cabin == 1) $('#provideSeperateCabin').prop('checked', true);
        else $('#provideSeperateCabin').prop('checked', false);
        
        if(resp.data.provide_common_restaurant == 1) $('#provideCommonRestaurant').prop('checked', true);
        else $('#provideCommonRestaurant').prop('checked', false);
        
        if(resp.data.provide_wifi == 1) $('#provideWifi').prop('checked', true);
        else $('#provideWifi').prop('checked', false);
        
        if(resp.data.provide_parking == 1) $('#provideParking').prop('checked', true);
        else $('#provideParking').prop('checked', false);
        
        if(resp.data.provide_ac == 1) $('#provideAC').prop('checked', true);
        else $('#provideAC').prop('checked', false);
        
        if(resp.data.provide_rooftop == 1) $('#provideRooftop').prop('checked', true);
        else $('#provideRooftop').prop('checked', false);
        
        if(resp.data.provide_bathroom == 1) $('#provideBathroom').prop('checked', true);
        else $('#provideBathroom').prop('checked', false);
        
        if(resp.data.provide_extra_service == 1) $('#provideExtraServices').prop('checked', true);
        else $('#provideExtraServices').prop('checked', false);
        
        
        if(resp.data.provide_extra_service == 1){
            $('#inpExtraServices').val(resp.data.extra_services);
            $('#divExtraServices').removeClass('d-none');
        }else{
            $('#inpExtraServices').val('');
            $('#divExtraServices').addClass('d-none');
        }
        
        
        
         if(selectedCompanyId == ''){
             $('#inpBankName').val('');
             $('#inpBankHolderName').val('');
             $('#inpBankNumber').val('');
             $('#inpReBankNumber').val('');
             $('#inpIFSC').val('');
         }else{
              $('#inpBankName').val(resp.data.bank_name);
             $('#inpBankHolderName').val(resp.data.bank_holder_name);
             $('#inpBankNumber').val(resp.data.account_number);
             $('#inpReBankNumber').val(resp.data.account_number);
             $('#inpIFSC').val(resp.data.ifsc_code);
         }
             
    
        
        
        
        
        
        $('#inpWorkingHoursStart').val(resp.data.working_start);
        $("#inpWorkingHoursEnd").val(resp.data.working_end).trigger('change');
        
        $('input[name="workingHoursDays"]').prop('checked', false);
        
        var arrayOfNumbers = resp.data.working_days.split(',');
        
        for (var i = 0; i < arrayOfNumbers.length; i++) {
            $('#workingHoursDays_'+arrayOfNumbers[i]).prop('checked', true);
        }
        
        
        
        $('#inpPropertInstructions').val(resp.data.propert_instructions);
         $('#inpStartTime').val(resp.data.start_use_time);
         $('#inpEndTime').val(resp.data.end_use_time);
        //  $('#inpNumberOfMembers').val(resp.data.number_of_members);
        //  $('#inpExtraPrice').val(resp.data.extra_price_per_head);
         $('#inpAdditionalInfo').val(resp.data.additional_info);
         $('#inpPropertyLocationLink').val(resp.data.property_location_link);


            
        tinymce.init({
          selector: '#inpPropertInstructions',
          // other TinyMCE options...
        });
        
        // Set content after initialization
        tinymce.get('inpPropertInstructions').setContent(resp.data.propert_instructions);
      
            
        }
        
        
        $('#inpTermsAndConditions').val(resp.data.terms_and_conditions);
           
        tinymce.init({
          selector: '#inpTermsAndConditions',
          // other TinyMCE options...
        });
        
        // Set content after initialization
        tinymce.get('inpTermsAndConditions').setContent(resp.data.terms_and_conditions);
        
        
        
    
      
    }
    
    
    if(selectedCompanyId == '') data = { "function": 'SystemManage',"method": "getCompanyDetails" };
    else data = { "function": 'SystemManage',"method": "getAllCompanyEditDetails",'selectedCompanyId':selectedCompanyId };
    
    
    apiCall(data,successFn);
    
    
     
 }
 
 function convertTo12HourFormat(time24) {
     if(time24 == '' || time24 == null) return '';
    // Split the time string into hours and minutes
    var [hours, minutes] = time24.split(':');

    // Convert hours to 12-hour format
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (00:00)

    // Add leading zeros if needed
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '' + minutes : minutes;

    // Return the time in 12-hour format with AM/PM
    return hours + ':' + minutes + ' ' + ampm;
}

function getAllBrucher(){
     
     $('#displayCompanyBrucherEditDiv').html('');

     
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            var images = resp.data;
            if(images.length > 0){
                
                var disD = '';
                var disD1 = '';
                disD +='<h5 class="card-title">Brochures</h5>';
                
                for(var i=0;i<images.length;i++){
                    
                    var filepath = images[i]['file_path'];
                    disD +='<a href="'+filepath+'" target="_blank">'+images[i]['file_name']+' - '+images[i]['created_date']+' </a> <i onclick="deleteBrucher('+images[i]['id']+');" class="bi bi-x-lg text-danger"></i><br>';

                }
                
                
            }else{
                
                var disD = '';
                disD +='<h5 class="card-title">Brochures</h5>';
                disD +='<p class="text-muted">Brochures not uploaded, Please update your Brochures</p>';
                
             
                
                
            }
            
            $('#displayCompanyBrucherEditDiv').html(disD);
            
            
        }
        
    }
    data = { "function": 'SystemManage',"method": "getAllBruchers",'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
 }
 

function deleteBrucher(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this Brucher",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                        getCompanyDetails();
                     }
                     data = { "function": 'SystemManage',"method": "deleteBrucher" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 



 function editCompanyDetails(){
     
       $('#submitLoadingButton11').addClass('d-none');
        $("#submitButton11").removeClass("d-none");
        editState = true;
    editCity = true;
        
        getCompanyDetails();
     
 }

function saveCompanyDetails(){
     
      $('#inpCompanyName').removeClass('is-invalid');
     $('#inpCompanyEmail').removeClass('is-invalid');
     $('#selCounty').removeClass('is-invalid');
     $('#selState').removeClass('is-invalid');
     $('#selCity').removeClass('is-invalid');
     $('#selServiceCenter').removeClass('is-invalid');
     $('#inpCompanyAddress').removeClass('is-invalid');
     $('#inpCompanyLocation').removeClass('is-invalid');
     $('#inpCompanyLink').removeClass('is-invalid');
     $('#inpCompanyPhone').removeClass('is-invalid');
     $('#inpWhatsappNumber').removeClass('is-invalid');
     $('#inpAssaignedHotelPerson').removeClass('is-invalid');
     $('#inpHotelPersonPhone').removeClass('is-invalid');
     $('#selAssaignedMachooosPerson').removeClass('is-invalid');
     $('#inpMachooosPersonPhone').removeClass('is-invalid');
     $('#inpServiceHours').removeClass('is-invalid');
     $('#inpServiceHoursType').removeClass('is-invalid');
     $('#inpWorkingHoursStart').removeClass('is-invalid');
     $('#inpWorkingHoursEnd').removeClass('is-invalid');
     $('#inpExtraServices').removeClass('is-invalid');
     
     
     
     
     
     var inpCompanyName = $('#inpCompanyName').val();
     var inpCompanyEmail = $('#inpCompanyEmail').val();
     var selCounty = $('#selCounty').val();
     var selState = $('#selState').val();
     var selCity = $('#selCity').val();
     var selServiceCenter = $('#selServiceCenter').val();
     var inpCompanyAddress = $('#inpCompanyAddress').val();
     var inpCompanyLocation = $('#inpCompanyLocation').val();
     var inpCompanyLink = $('#inpCompanyLink').val();
     var inpCompanyPhone = $('#inpCompanyPhone').val();
     var inpWhatsappNumber = $('#inpWhatsappNumber').val();
     var inpAssaignedHotelPerson = $('#inpAssaignedHotelPerson').val();
     var inpHotelPersonPhone = $('#inpHotelPersonPhone').val();
     var selAssaignedMachooosPerson = $('#selAssaignedMachooosPerson').val();
     var inpMachooosPersonPhone = $('#inpMachooosPersonPhone').val();
     var inpServiceHours = $('#inpServiceHours').val();
     var inpServiceHoursType = $('#inpServiceHoursType').val();
     
     var inpFacebook = $('#inpFacebook').val();
     var inpInstagram = $('#inpInstagram').val();
     var inpTwitter = $('#inpTwitter').val();
     var inpLinkedin = $('#inpLinkedin').val();
     var inpPinterest = $('#inpPinterest').val();
     var inpYoutube = $('#inpYoutube').val();
     var inpReddit = $('#inpReddit').val();
     var inpTumbler = $('#inpTumbler').val();
     
     var isValid = false;
     
      if(inpCompanyName == ""){
             $('#inpCompanyName').addClass('is-invalid');
             $('#inpCompanyName').focus();
             isValid = true;
         }
     
     
       if(inpCompanyEmail == ""){
             $('#inpCompanyEmail').addClass('is-invalid');
             $('#inpCompanyEmail').focus();
             isValid = true;
         }
         
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(inpCompanyEmail)) {
            $('#inpCompanyEmail').addClass('is-invalid');
             $('#inpCompanyEmail').focus();
             isValid = true;
        }
        
           if(selCounty == ""){
         $('#selCounty').addClass('is-invalid');
         $('#selCounty').focus();
         isValid = true;
     }
     
      if(selState == ""){
         $('#selState').addClass('is-invalid');
         $('#selState').focus();
         isValid = true;
     }
      
       if(selCity == ""){
         $('#selCity').addClass('is-invalid');
         $('#selCity').focus();
         isValid = true;
     }
     
          if(selServiceCenter == ""){
         $('#selServiceCenter').addClass('is-invalid');
         $('#selServiceCenter').focus();
         isValid = true;
     }
     
    if(inpCompanyAddress == ""){
         $('#inpCompanyAddress').addClass('is-invalid');
         $('#inpCompanyAddress').focus();
         isValid = true;
     }
     
      if(inpCompanyLocation == ""){
         $('#inpCompanyLocation').addClass('is-invalid');
         $('#inpCompanyLocation').focus();
         isValid = true;
     }

      
      if(inpCompanyLink == ""){
         $('#inpCompanyLink').addClass('is-invalid');
         $('#inpCompanyLink').focus();
         isValid = true;
     }

      if(inpCompanyPhone == ""){
         $('#inpCompanyPhone').addClass('is-invalid');
         $('#inpCompanyPhone').focus();
         isValid = true;
     }

      if(inpWhatsappNumber == ""){
         $('#inpWhatsappNumber').addClass('is-invalid');
         $('#inpWhatsappNumber').focus();
         isValid = true;
     }
      
     if(inpAssaignedHotelPerson == ""){
         $('#inpAssaignedHotelPerson').addClass('is-invalid');
         $('#inpAssaignedHotelPerson').focus();
        isValid = true;
     }
      
     
     if(inpHotelPersonPhone == ""){
         $('#inpHotelPersonPhone').addClass('is-invalid');
         $('#inpHotelPersonPhone').focus();
         isValid = true;
     }
      
    //   if(selAssaignedMachooosPerson == ""){
    //      $('#selAssaignedMachooosPerson').addClass('is-invalid');
    //      $('#selAssaignedMachooosPerson').focus();
    //      isValid = true;
    //  }
    
    //   if(inpMachooosPersonPhone == ""){
    //      $('#inpMachooosPersonPhone').addClass('is-invalid');
    //      $('#inpMachooosPersonPhone').focus();
    //      isValid = true;
    //  }
    
      if(inpServiceHours == ""){
         $('#inpServiceHours').addClass('is-invalid');
         $('#inpServiceHours').focus();
         isValid = true;
     }
    
      if(inpServiceHoursType == ""){
         $('#inpServiceHoursType').addClass('is-invalid');
         $('#inpServiceHoursType').focus();
         isValid = true;
     }
     
     
    var provideWelcomeDrink = document.getElementById("provideWelcomeDrink");
    if (provideWelcomeDrink.checked) {
        provideWelcomeDrink = 1;
    } else {
        provideWelcomeDrink = 0;
    }
    
    var provideFood = document.getElementById("provideFood");
    if (provideFood.checked) {
        provideFood = 1;
    } else {
        provideFood = 0;
    }
    
    var provideSeperateCabin = document.getElementById("provideSeperateCabin");
    if (provideSeperateCabin.checked) {
        provideSeperateCabin = 1;
    } else {
        provideSeperateCabin = 0;
    }
    
    var provideCommonRestaurant = document.getElementById("provideCommonRestaurant");
    if (provideCommonRestaurant.checked) {
        provideCommonRestaurant = 1;
    } else {
        provideCommonRestaurant = 0;
    }
    
   
     var provideWifi = document.getElementById("provideWifi");
    if (provideWifi.checked) {
        provideWifi = 1;
    } else {
        provideWifi = 0;
    }
    
    
     var provideParking = document.getElementById("provideParking");
    if (provideParking.checked) {
        provideParking = 1;
    } else {
        provideParking = 0;
    }
    
    
     var provideAC = document.getElementById("provideAC");
    if (provideAC.checked) {
        provideAC = 1;
    } else {
        provideAC = 0;
    }
    
    
     var provideRooftop = document.getElementById("provideRooftop");
    if (provideRooftop.checked) {
        provideRooftop = 1;
    } else {
        provideRooftop = 0;
    }
    
    
     var provideBathroom = document.getElementById("provideBathroom");
    if (provideBathroom.checked) {
        provideBathroom = 1;
    } else {
        provideBathroom = 0;
    }
    
    var provideExtraServices = document.getElementById("provideExtraServices");
    if (provideExtraServices.checked) {
        provideExtraServices = 1;
    } else {
        provideExtraServices = 0;
    }
    
    var inpExtraServices = '';
    if(provideExtraServices == 1){
        
        var inpExtraServices = $('#inpExtraServices').val();
        
         if(inpExtraServices == ""){
             $('#inpExtraServices').addClass('is-invalid');
             $('#inpExtraServices').focus();
             isValid = true;
         }
        
    }
    
     var checkedWorkingHoursDaysValues = $('input[name="workingHoursDays"]:checked').map(function() {
            return $(this).val();
        }).get();
        
    
     var inpWorkingHoursStart = $('#inpWorkingHoursStart').val();
     var inpWorkingHoursEnd = $('#inpWorkingHoursEnd').val();
    
      if(inpWorkingHoursStart == ""){
         $('#inpWorkingHoursStart').addClass('is-invalid');
         $('#inpWorkingHoursStart').focus();
         isValid = true;
     }
    
      if(inpWorkingHoursEnd == ""){
         $('#inpWorkingHoursEnd').addClass('is-invalid');
         $('#inpWorkingHoursEnd').focus();
         isValid = true;
     }
    
    
    if(isValid) return false;
    
    $('#submitLoadingButton11').removeClass('d-none');
    $("#submitButton11").addClass("d-none");
    
      if(selectedCompanyId == '') var saveVal = 'add';
    else var saveVal = 'update';
    
     successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton11').addClass('d-none');
            $("#submitButton11").removeClass("d-none");
            
            selectedCompanyId = resp.data ;
            
            getCompanyDetails();
            
            Swal.fire(
              'Success',
              "Successfully "+saveVal+" company details",
              'success'
            )
            
        
            
        }else{
             Swal.fire(
              'Error',
              resp.data,
              'error'
            )
            
        }
        
       
        $('#submitLoadingButton11').addClass('d-none');
        $("#submitButton11").removeClass("d-none");
      
    }
    
  
    
    
    
    data = { "function": 'User',"method": "saveAllCompanyDetails" , "inpCompanyName":inpCompanyName, "inpCompanyEmail":inpCompanyEmail,'county':selCounty,'state':selState ,'city':selCity ,'save':saveVal,'servicescenter_id':selServiceCenter,'inpCompanyAddress':inpCompanyAddress,'inpCompanyLocation':inpCompanyLocation,'inpCompanyLink':inpCompanyLink,'inpCompanyPhone':inpCompanyPhone,'inpWhatsappNumber':inpWhatsappNumber,'inpAssaignedHotelPerson':inpAssaignedHotelPerson,'inpHotelPersonPhone':inpHotelPersonPhone,'selAssaignedMachooosPerson':selAssaignedMachooosPerson,'inpMachooosPersonPhone':inpMachooosPersonPhone,'inpServiceHours':inpServiceHours,'inpServiceHoursType':inpServiceHoursType,'provideWelcomeDrink':provideWelcomeDrink,'provideFood':provideFood,'provideSeperateCabin':provideSeperateCabin,'provideCommonRestaurant':provideCommonRestaurant,'workingHoursDays':checkedWorkingHoursDaysValues,'inpWorkingHoursStart':inpWorkingHoursStart,'inpWorkingHoursEnd':inpWorkingHoursEnd, 'provideWifi':provideWifi,'provideParking':provideParking,'provideAC':provideAC,'provideRooftop':provideRooftop,'provideBathroom':provideBathroom ,'provideExtraServices':provideExtraServices , 'inpExtraServices':inpExtraServices ,'selectedCompanyId':selectedCompanyId ,'inpFacebook':inpFacebook,'inpInstagram':inpInstagram,'inpTwitter':inpTwitter,'inpLinkedin':inpLinkedin,'inpPinterest':inpPinterest,'inpYoutube':inpYoutube,'inpReddit':inpReddit,'inpTumbler':inpTumbler };
    
    apiCall(data,successFn);
    
 }
 

 function editPropertyInstructions(){
     
       $('#submitLoadingButton12').addClass('d-none');
        $("#submitButton12").removeClass("d-none");
       
        
        getCompanyDetails();
     
 }
 
 function savePropertyInstructions(){
     
      $('#inpPropertInstructions').removeClass('is-invalid');
     $('#inpStartTime').removeClass('is-invalid');
     $('#inpEndTime').removeClass('is-invalid');
     $('#inpNumberOfMembers').removeClass('is-invalid');
     $('#inpExtraPrice').removeClass('is-invalid');
     $('#inpAdditionalInfo').removeClass('is-invalid');
     $('#inpPropertyLocationLink').removeClass('is-invalid');
     
     
     var inpPropertInstructions = tinymce.get('inpPropertInstructions').getContent();
      
    //  var inpPropertInstructions = $('#inpPropertInstructions').val();
     var inpStartTime = $('#inpStartTime').val();
     var inpEndTime = $('#inpEndTime').val();
     var inpNumberOfMembers = $('#inpNumberOfMembers').val();
     var inpExtraPrice = $('#inpExtraPrice').val();
     var inpAdditionalInfo = $('#inpAdditionalInfo').val();
     var inpPropertyLocationLink = $('#inpPropertyLocationLink').val();
    
       var isValid = false;
     
      if(inpPropertInstructions == ""){
             $('#inpPropertInstructions').addClass('is-invalid');
             $('#inpPropertInstructions').focus();
             isValid = true;
         }
     
      if(inpStartTime == ""){
             $('#inpStartTime').addClass('is-invalid');
             $('#inpStartTime').focus();
             isValid = true;
         }
         
          if(inpEndTime == ""){
             $('#inpEndTime').addClass('is-invalid');
             $('#inpEndTime').focus();
             isValid = true;
         }
         
         
    //       if(inpNumberOfMembers == ""){
    //          $('#inpNumberOfMembers').addClass('is-invalid');
    //          $('#inpNumberOfMembers').focus();
    //          isValid = true;
    //      }
     
    //   if(inpExtraPrice == ""){
    //          $('#inpExtraPrice').addClass('is-invalid');
    //          $('#inpExtraPrice').focus();
    //          isValid = true;
    //      }
         
          if(inpAdditionalInfo == ""){
             $('#inpAdditionalInfo').addClass('is-invalid');
             $('#inpAdditionalInfo').focus();
             isValid = true;
         }
         
          if(inpPropertyLocationLink == ""){
             $('#inpPropertyLocationLink').addClass('is-invalid');
             $('#inpPropertyLocationLink').focus();
             isValid = true;
         }
         
         
          if(isValid) return false;
    
    $('#submitLoadingButton12').removeClass('d-none');
    $("#submitButton12").addClass("d-none");
    
     if(selectedCompanyId == '') var saveVal = 'add';
    else var saveVal = 'update';
    
     successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton11').addClass('d-none');
            $("#submitButton11").removeClass("d-none");
            
            selectedCompanyId = resp.data ;
            
            getCompanyDetails();
            
            Swal.fire(
              'Success',
              "Successfully "+saveVal+" service/property",
              'success'
            )
            
        
            
        }else{
             Swal.fire(
              'Error',
              resp.data,
              'error'
            )
            
        }
        
       
        $('#submitLoadingButton12').addClass('d-none');
        $("#submitButton12").removeClass("d-none");
      
    }
    
   
    
    
    data = { "function": 'User',"method": "saveAllPropertyInstructions" , "inpPropertInstructions":inpPropertInstructions, "inpStartTime":inpStartTime,'inpEndTime':inpEndTime,'inpNumberOfMembers':inpNumberOfMembers ,'inpExtraPrice':inpExtraPrice ,'save':saveVal,'inpAdditionalInfo':inpAdditionalInfo ,'inpPropertyLocationLink':inpPropertyLocationLink,'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
     
     
 }
 
 
 function uploadLogo(){
      $('#submitLoadingButton13').addClass('d-none');
        $("#submitButton13").removeClass("d-none");
       
        var progressBar = document.getElementById("progress-bar");
        
    // Set the width of the progress bar to 0%
    progressBar.style.width = "0%";
    progressBar.setAttribute("aria-valuenow", "0");
    
    $("#submitButton13").removeClass("d-none");
    $("#uploadLogoFiles").val("");
    $('#uploadLogoFiles').val(null);
        
       
 }
 
 function uploadCompanyLogoNow(){
     
     if(selectedCompanyId == '') return false;
     
     $("#uploadLogoFilesErr").html("");
     
     var files = document.getElementById("uploadLogoFiles").files;
     if (files.length > 0) {
         
        let file = files[0];
        let formData = new FormData();
        
        var fileSizeInBytes = file.size;
        var fileSizeInKB = fileSizeInBytes / 1024;
        
        if(fileSizeInKB > 500){
            $("#uploadLogoFilesErr").html("Maximum image size is 500KB.");
            $("#submitButton13").removeClass("d-none");
            $("#submitLoadingButton13").addClass("d-none");
            return false;
        }
      

        formData.append('images[]', file);
        formData.append('selectedCompanyId', selectedCompanyId);
        
        var reader = new FileReader();
        reader.onload = function (e) {
           
            // Upload the image using AJAX
            $.ajax({
                xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            // Update the ID in the selector to match the HTML element ID
                            $("#progress-bar").width(percentComplete.toFixed(0) + '%');
                            $("#progress-bar").html(percentComplete.toFixed(0) + '%');
                        }
                    }, false);
                    return xhr;
                },
                url: '/admin/uploadCompanyLogo.php', // Replace with your PHP upload script
                type: 'POST',
                beforeSend: function(){
                    $("#progress-bar").width('0%');
                    // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                    $('#signalbmEventUploadStatus').removeClass('d-none');
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                    getCompanyDetails();
                    uploadLogo();
                 
                    console.log('Image uploaded:', response);
                },
                error: function () {
                    
                    Swal.fire(
                      'Error',
                      "Something went wrong, please try again",
                      'error'
                    )
                   
                    $("#submitButton13").removeClass("d-none");
                    $("#submitLoadingButton13").addClass("d-none");
                    return false;
                }
            });
        };
        reader.readAsDataURL(file);
        
        
         
         
         
         
         
     }else{
        $("#uploadLogoFilesErr").html("Please upload the company logo!.");
        $("#submitButton13").removeClass("d-none");
        $("#submitLoadingButton13").addClass("d-none");
        return false;
    }
     
     
    
     
 }
 
 function uploadPhotographs(){
      $('#submitLoadingButton14').addClass('d-none');
        $("#submitButton14").removeClass("d-none");
       
        var progressBar = document.getElementById("progress-bar1");
        
    // Set the width of the progress bar to 0%
    progressBar.style.width = "0%";
    progressBar.setAttribute("aria-valuenow", "0");
    
    
    $("#uploadPhotographsFilesErr").html("");
    
    $("#uploadPhotographsFiles").val("");
    $('#uploadPhotographsFiles').val(null);
    
    totalImgUpload = 0;
    $('#disUploadImgTitlenew').html('');
    uploadImg = 0;
    
    $('.ri-close-circle-line').click();
        
       
 }
 
 function uploadCompanyPhotographsNow(){
     
     if(selectedCompanyId == '') return false;
     
     
     $("#uploadPhotographsFilesErr").html("");
     
     var files = document.getElementById("uploadPhotographsFiles").files;
     if (files.length > 0) {
         uploadInProgress = false;
         uploadImages(files,0);
         
         totalImgUpload = files.length; 
         
         $('#disUploadImgTitlenew').html('Uploading images - Total ( '+totalImgUpload+' ) images');
         
     }else{
        $("#uploadPhotographsFilesErr").html("Plese upload the company photographs!.");
        $("#submitButton14").removeClass("d-none");
        $("#submitLoadingButton14").addClass("d-none");
        return false;
    }
     
 }
 
 function uploadImages(files,index = 0){
     var userId = '<?=$_SESSION['MachooseAdminUser']['id']?>';
     for (var i = index ; i < files.length; i++) {
         
         if(uploadInProgress){
            
            // setTimeout(function () {
            //     uploadImages(files,index);
            // }, 50000);
           
        }else{
            
            let file = files[i];
            let formData = new FormData();
            
            uploadInProgress = true;
            var fuCalbk = parseInt(i);
            
            formData.append('images[]', file);
            formData.append('userId', selectedCompanyId);
            
            var reader = new FileReader();
            reader.onload = function (e) {
               
                // Upload the image using AJAX
                $.ajax({
                    xhr: function() {
                      var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                // Update the ID in the selector to match the HTML element ID
                                $("#progress-bar1").width(percentComplete.toFixed(0) + '%');
                                $("#progress-bar1").html(percentComplete.toFixed(0) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: '/admin/uploadCompanyPhotographs.php', // Replace with your PHP upload script
                    type: 'POST',
                    beforeSend: function(){
                        $("#progress-bar1").width('0%');
                        // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                        $('#signalbmEventUploadStatus').removeClass('d-none');
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        
                        uploadImg ++;
                        
                        $('#disUploadImgTitlenew').html('Uploading images - Total ( '+uploadImg+' of '+totalImgUpload+' - Uploaded ) images');
                        
                        getCompanyDetails();
                        
                        if(uploadImg == totalImgUpload) {
                            uploadPhotographs();
                        }
                        
                        uploadInProgress = false;
                        uploadImages(files,fuCalbk+1);

                        console.log('Image uploaded:', response);
                    },
                    error: function () {
                        
                        Swal.fire(
                          'Error',
                          "Something went wrong, please try again",
                          'error'
                        )
                       
                        $("#submitButton13").removeClass("d-none");
                        $("#submitLoadingButton13").addClass("d-none");
                        return false;
                    }
                });
            };
            reader.readAsDataURL(file);
            
            
            
            
            
            
        }
         
     }
     
     
 }
 
 function getAllPhotographs(){
     
     $('#displayCompanyPhotographsDiv').html('');
     $('#displayCompanyPhotographsEditDiv').html('');
     
     
     
    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
        if(resp.status == 1){
            var images = resp.data;
            if(images.length > 0){
                
                var disD = '';
                var disD1 = '';
                disD +='<h5 class="card-title">Company Photographs</h5>';
                
                for(var i=0;i<images.length;i++){
                    
                    var filepath = images[i]['file_path'];
                    disD +='<img src="'+filepath+'" alt="" style="width: 10%;height: 10%;">';
                    disD1 +='<img src="'+filepath+'" alt="" style="width: 10%;height: 10%;"><i onclick="deleteImage('+images[i]['id']+');" class="btn btn-secondary btn-sm bi bi-x-lg text-white "></i>  ';
                    
                }
                
                
            }else{
                
                var disD = '';
                disD +='<h5 class="card-title">Company Photographs</h5>';
                disD +='<p class="text-muted">Company photographs not uploaded, Please update your company photographs</p>';
                
                var disD1 = '';
                disD1 +='<p class="text-muted">Company photographs not uploaded, Please update your company photographs</p>';
                
                
                
            }
            
            $('#displayCompanyPhotographsDiv').html(disD);
            $('#displayCompanyPhotographsEditDiv').html(disD1);
            
            
        }
        
    }
    data = { "function": 'SystemManage',"method": "getNewAllPhotographs",'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
 }
 
 
 function deleteImage(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this photographs",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                        getCompanyDetails();
                     }
                     data = { "function": 'SystemManage',"method": "deletePhotographs" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}


function deleteCompany(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to delete this company",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                        getAllCompanyListWithDetails();
                     }
                     data = { "function": 'SystemManage',"method": "deleteCompany" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 function uploadAccount(){
       $('#submitLoadingButton15').addClass('d-none');
        $("#submitButton15").removeClass("d-none");
       
        
        getCompanyDetails();
 }
 
 function saveAccountDetails(){
     if(selectedCompanyId == '') return false;
     
      $('#inpBankName').removeClass('is-invalid');
     $('#inpBankHolderName').removeClass('is-invalid');
     $('#inpBankNumber').removeClass('is-invalid');
     $('#inpReBankNumber').removeClass('is-invalid');
     $('#inpIFSC').removeClass('is-invalid');
    
    
     

     var inpBankName = $('#inpBankName').val();
     var inpBankHolderName = $('#inpBankHolderName').val();
     var inpBankNumber = $('#inpBankNumber').val();
     var inpReBankNumber = $('#inpReBankNumber').val();
     var inpIFSC = $('#inpIFSC').val();

       var isValid = false;
       
        
     
      if(inpBankName == ""){
             $('#inpBankName').addClass('is-invalid');
             $('#inpBankName').focus();
             isValid = true;
         }
     
      if(inpBankHolderName == ""){
             $('#inpBankHolderName').addClass('is-invalid');
             $('#inpBankHolderName').focus();
             isValid = true;
         }
         
          if(inpBankNumber == ""){
             $('#inpBankNumber').addClass('is-invalid');
             $('#inpBankNumber').focus();
             isValid = true;
         }
         
         
          if(inpReBankNumber == "" || (inpReBankNumber != inpBankNumber)){
             $('#inpReBankNumber').addClass('is-invalid');
             $('#inpReBankNumber').focus();
             isValid = true;
         }
         
          if(inpIFSC == ""){
             $('#inpIFSC').addClass('is-invalid');
             $('#inpIFSC').focus();
             isValid = true;
         }
         
         
          if(isValid) return false;
    
    $('#submitLoadingButton15').removeClass('d-none');
    $("#submitButton15").addClass("d-none");
    
     if(selectedCompanyId == '') var saveVal = 'add';
    else var saveVal = 'update';
    
     successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton15').addClass('d-none');
            $("#submitButton15").removeClass("d-none");
            
            selectedCompanyId = resp.data ;
            
            getCompanyDetails();
            
            Swal.fire(
              'Success',
              "Successfully "+saveVal+" bank account",
              'success'
            )
            
        
            
        }else{
             Swal.fire(
              'Error',
              resp.data,
              'error'
            )
            
        }
        
       
        $('#submitLoadingButton15').addClass('d-none');
        $("#submitButton15").removeClass("d-none");
      
    }
    
   
    
    
    data = { "function": 'User',"method": "saveAllBankAccount" , "inpBankName":inpBankName, "inpBankHolderName":inpBankHolderName,'inpBankNumber':inpBankNumber,'inpIFSC':inpIFSC ,'save':saveVal,'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
    
    
     
      
                  
     
     
     
     
     
 }
 
 
  function editTermsAndConditions(){
     
       $('#submitLoadingButton22').addClass('d-none');
        $("#submitButton22").removeClass("d-none");
       
        
        getCompanyDetails();
     
 }
 
 function saveTermsAndConditions(){
     
     if(selectedCompanyId == '') return false;
     
      $('#inpTermsAndConditions').removeClass('is-invalid');
    
     var inpTermsAndConditions = tinymce.get('inpTermsAndConditions').getContent();
      
   
       var isValid = false;
     
      if(inpTermsAndConditions == ""){
             $('#inpTermsAndConditions').addClass('is-invalid');
             $('#inpTermsAndConditions').focus();
             isValid = true;
         }
     
     
         
          if(isValid) return false;
    
    $('#submitLoadingButton22').removeClass('d-none');
    $("#submitButton22").addClass("d-none");
    
     successFn = function(resp)  {
        
        if(resp.status == 1){
           
            $('#submitLoadingButton22').addClass('d-none');
            $("#submitLoadingButton22").removeClass("d-none");
            
            getCompanyDetails();
            
            Swal.fire(
              'Success',
              "Successfully update Terms and Conditions",
              'success'
            )
            
        
            
        }else{
             Swal.fire(
              'Error',
              resp.data,
              'error'
            )
            
        }
        
       
        $('#submitLoadingButton22').addClass('d-none');
        $("#submitLoadingButton22").removeClass("d-none");
      
    }
    data = { "function": 'User',"method": "saveTermsAndConditions" , "inpTermsAndConditions":inpTermsAndConditions, 'selectedCompanyId':selectedCompanyId };
    
    apiCall(data,successFn);
     
     
 }
 
 
 
 function uploadDocuments(){
      $('#submitLoadingButton131').addClass('d-none');
        $("#submitButton131").removeClass("d-none");
       
        var progressBar = document.getElementById("progress-bar3");
        
    // Set the width of the progress bar to 0%
    progressBar.style.width = "0%";
    progressBar.setAttribute("aria-valuenow", "0");
    
    $("#submitButton131").removeClass("d-none");
    $("#uploadDocumentsFiles").val("");
    $('#uploadDocumentsFiles').val(null);
    
    $("#uploadBrucherFiles").val("");
    $('#uploadBrucherFiles').val(null);
    
    totalImgUpload = 0;
    $('#disUploadImgTitlenew').html('');
    uploadImg = 0;
    
    $("#uploadDocumentsFilesErr").html("");
     $("#uploadBrucherFilesErr").html("");
     
     $('#disUploadImgTitlenew1').html('');
     
     getCompanyDetails();
        
       
 }
 
 function uploadCompanyDocumentsNow(){
     
     if(selectedCompanyId == '') return false;
     
     $("#uploadDocumentsFilesErr").html("");
     $("#uploadBrucherFilesErr").html("");
     
     var files = document.getElementById("uploadDocumentsFiles").files;

     if (files.length > 0) {
         
        let file = files[0];
        let formData = new FormData();
      
        var userId = '<?=$_SESSION['MachooseAdminUser']['id']?>';
        
        formData.append('images[]', file);
        formData.append('userId', selectedCompanyId);
        
        var reader = new FileReader();
        reader.onload = function (e) {
           
            // Upload the image using AJAX
            $.ajax({
                xhr: function() {
                  var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100);
                            // Update the ID in the selector to match the HTML element ID
                            $("#progress-bar3").width(percentComplete.toFixed(0) + '%');
                            $("#progress-bar3").html(percentComplete.toFixed(0) + '%');
                        }
                    }, false);
                    return xhr;
                },
                url: '/admin/uploadCompanyDocuments.php', // Replace with your PHP upload script
                type: 'POST',
                beforeSend: function(){
                    $("#progress-bar3").width('0%');
                    // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                    $('#signalbmEventUploadStatus').removeClass('d-none');
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#uploadDocumentsFiles").val("");
                    $('#uploadDocumentsFiles').val(null);
                    uploadCompanyBrucherNow(false);
                    
                },
                error: function () {
                    
                    Swal.fire(
                      'Error',
                      "Something went wrong, please try again",
                      'error'
                    )
                   
                    $("#submitButton131").removeClass("d-none");
                    $("#submitLoadingButton131").addClass("d-none");
                    return false;
                }
            });
        };
        reader.readAsDataURL(file);
        
        
     }else{
        uploadCompanyBrucherNow(true);
    }
     
     
    
     
 }
 
 
 function uploadCompanyBrucherNow(isDoc){
    
     var files = document.getElementById("uploadBrucherFiles").files;

     if (files.length > 0) {
         
          uploadInProgress = false;
         uploadImagesD(files,0);
         
         totalImgUpload = files.length; 
         
         $('#disUploadImgTitlenew1').html('Uploading file - Total ( '+totalImgUpload+' ) files');
         
         
     }else{
         
         if(isDoc){
             $("#uploadDocumentsFilesErr").html("Please upload the document!.");
             $("#uploadBrucherFilesErr").html("Please upload the Brucher!.");
         }else{
            //  $("#uploadBrucherFilesErr").html("Please upload the Brucher!.");
         }
         
       
        $("#submitButton131").removeClass("d-none");
        $("#submitLoadingButton131").addClass("d-none");
        
         var progressBar = document.getElementById("progress-bar3");
        
        // Set the width of the progress bar to 0%
        progressBar.style.width = "0%";
        progressBar.setAttribute("aria-valuenow", "0");
        
        getCompanyDetails();
        return false;
    }
     
     
    
     
 }
 
 
  function uploadImagesD(files,index = 0){
     var userId = '<?=$_SESSION['MachooseAdminUser']['id']?>';
     for (var i = index ; i < files.length; i++) {
         
         if(uploadInProgress){
            
            // setTimeout(function () {
            //     uploadImages(files,index);
            // }, 50000);
           
        }else{
            
            let file = files[i];
            let formData = new FormData();
            
            uploadInProgress = true;
            var fuCalbk = parseInt(i);
            
            formData.append('images[]', file);
            formData.append('userId', selectedCompanyId);
            
            var reader = new FileReader();
            reader.onload = function (e) {
               
                // Upload the image using AJAX
                $.ajax({
                    xhr: function() {
                      var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                // Update the ID in the selector to match the HTML element ID
                                $("#progress-bar3").width(percentComplete.toFixed(0) + '%');
                                $("#progress-bar3").html(percentComplete.toFixed(0) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    url: '/admin/uploadCompanyBrucher.php', // Replace with your PHP upload script
                    type: 'POST',
                    beforeSend: function(){
                        $("#progress-bar3").width('0%');
                        // $('#uploadStatus').html('<img src="images/loading.gif"/>');
                        $('#signalbmEventUploadStatus').removeClass('d-none');
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        
                        uploadImg ++;
                        
                        $('#disUploadImgTitlenew1').html('Uploading file - Total ( '+uploadImg+' of '+totalImgUpload+' - Uploaded ) files');
                        
                      
                        getCompanyDetails();
                        
                        uploadInProgress = false;
                        uploadImagesD(files,fuCalbk+1);
                        
                        if(uploadImg == totalImgUpload){
                            uploadDocuments();
                        }

                        console.log('Image uploaded:', response);
                    },
                    error: function () {
                        
                        Swal.fire(
                          'Error',
                          "Something went wrong, please try again",
                          'error'
                        )
                       
                        $("#submitButton131").removeClass("d-none");
                        $("#submitLoadingButton131").addClass("d-none");
                        return false;
                    }
                });
            };
            reader.readAsDataURL(file);
            
            
            
            
            
            
        }
         
     }
     
     
 }
 
 
 
 
 
 
 
 
 
 function changeProvideExtraServices(){
     
     // Get the checkbox element
    var checkbox = document.getElementById("provideExtraServices");
    $("#inpExtraServices").val("");

    // Check if the checkbox is checked
    if (checkbox.checked) {
        $('#divExtraServices').removeClass('d-none');
    } else {
        $('#divExtraServices').addClass('d-none');
    }
     
 }
 
 
  function getAssaignedMachooosPerson(selectId,val="") {
      

    successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Assaigned machooos person</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        if(val == value.id) options += "<option value='"+value.id+"' selected>"+value.name+"</option>";
        else options += "<option value='"+value.id+"'>"+value.name+"</option>";
        
      });
    //   alert("#"+selectId);

      $("#"+selectId).html(options);
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getAssaignedMachooosPersonActiveList" };
    
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
    
    apiCall(data,successFn);
    
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
    //   $("#"+selectId).select2();
      
    }
    data = { "function": 'SystemManage',"method": "getCountries"};
    
    apiCall(data,successFn);
    
}


  function getState(selectId,val="") {
      
      if(editState && val == ""){
          editState = false;
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
    //   $("#"+selectId).select2();
      
    
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
    
}


function getCity(selectId,val="",selState="") {
    
    if(editCity && val == ""){
          editCity = false;
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
    //   $("#"+selectId).select2();
      
      if(val !="")$("#selCity").val(val).trigger('change');
      
      
    }
    data = { "function": 'SystemManage',"method": "getCityListData1" , "selState":selState};
    
    apiCall(data,successFn);
    
}
 

 </script>

