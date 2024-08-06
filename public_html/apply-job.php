<!DOCTYPE HTML>
<?php 

include("admin/config.php");
include("get_session.php");


$projIdString = base64_decode($_REQUEST['jobId']);
$arr = explode('_', $projIdString);
$jobId = $arr[1];

$user_data = get_session();
$album = [];

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

$sql = "SELECT a.*,b.position_name FROM tbl_career a left join tblhr_job_position b on a.tittle = b.position_id
		WHERE a.active=0 and a.disabled =0 and a.id='$jobId' ";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

if($count > 0) {	
    
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($album,$row);
        
    }
}else{
    header("location: index.php");
}


 $image = $album[0]['image'];
$position_name = $album[0]['position_name'];


if (stripos($position_name, 'photographer') !== false) {
    $disCam = true;
} else {
    $disCam = false;
}


$sub_tittle = $album[0]['sub_tittle'];
$Experience = $album[0]['Experience'];

$County = $album[0]['County'];
$state = $album[0]['state'];
$district = $album[0]['district'];
$city = $album[0]['city'];

$jobsummary = $album[0]['jobsummary'];
$Workigconditions = $album[0]['Workigconditions'];
$Jobduties = $album[0]['Jobduties'];
$Qualifications = $album[0]['Qualifications'];
$Skills = $album[0]['Skills'];
$Responsibiities = $album[0]['Responsibiities'];


$created_date = $album[0]['created_date'];

$plancreated_date = new DateTime($created_date);

// Get year, month, and day part from the date
$year = $plancreated_date->format('Y');
$month = $plancreated_date->format('n');
$day = $plancreated_date->format('d');

// Assuming $monthNames is an array with month names
$monthNames = array(
    "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
);

$filmCDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;


?>




<html>
	<head>
 <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Machooos International</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="images/favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="career/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="career/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="career/css/bootstrap.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="career/css/owl.carousel.min.css">
	<link rel="stylesheet" href="career/css/owl.theme.default.min.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="career/css/magnific-popup.css">

	<link rel="stylesheet" href="career/css/style.css">


	<!-- Modernizr JS -->
	<script src="career/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="career/js/respond.min.js"></script>
	<![endif]-->

	</head>
	<style>
	    #apply-fixed-button {
          position: fixed;
          top: 80px;
          right: 0px;
          display: block;
           z-index: 1000; /* Ensure it's above other elements */
           background-color: #f0f0f0;
            color: black;
            height:10%;
            width:20%;
        }
        
        #colorlib-main-nav .form-group {
            margin-bottom: 15px !important;
          
        }
        
        #Address1::placeholder, #Address2::placeholder {
          color: #555555; 
        }
        
        .invalid-feedback{
            color:red;
            font-size: 15px;
        }
        
        /* loader.css */
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #CA82F8;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999; /* Ensures the loader appears on top of other content */
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

	</style>
	<body>
	    <button
                type="button"
                class="btn btn-primary btn-outline js-colorlib-nav-toggle colorlib-nav-toggle"
                id="apply-fixed-button"
                onclick="openForm();"
                >
          Apply Now
        </button>
        
        
        <nav id="colorlib-main-nav" role="navigation" style="width: 60% !important;">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle active"><i></i></a>
	
		<div class="js-fullheight colorlib-table">
			<div class="colorlib-table-cell js-fullheight">
				<div class="row">
					<div class="col-md-12">
						<h2>Apply job</h2>
					</div>
				</div>
				<div id="footer" style="padding: 0px !important;">
    					<div class="row">
    					    
    					    <form id="applyNowForm">
    					        
        						<div class="col-md-6 ">
        							<div class="subscribe text-left">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<input type="text" class="form-control text-center" id="Name" name="Name" placeholder="*Enter your name" required title="Please enter your name.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="email" class="form-control text-center" id="Email" name="Email" placeholder="*Enter email address" required title="Please enter your email.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<input type="text" class="form-control text-center" id="Phone1" name="Phone1" placeholder="*Enter your phone number" required pattern="^\d{10}$" title="Please enter a 10-digit phone number.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="text" class="form-control text-center" id="Phone2" name="Phone2" placeholder="Enter your phone number 2" pattern="^\d{10}$" title="Please enter a 10-digit phone number.">
        								
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-12 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<textarea class="form-control text-center" id="Address1" name="Address1" placeholder="*Enter your address line 1" required title="Please enter address line 1."></textarea>
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-12 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<textarea class="form-control text-center" id="Address2" name="Address2" placeholder="Enter your address line 2" title="Please enter address line 2."></textarea>
        								</div>
        							</div>
        						</div>
        						
        						
        							<div class="col-md-4 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        								    
        								    <select class="form-control text-center" id="Nationality" name="Nationality" required title="Please select your nationality.">
                                              <option value="" disabled selected>*Select your nationality</option>
                                              <option value="indian">Indian</option>
                                              
                                            </select>
        								    
        									
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-4 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        								    
        								    <select class="form-control text-center" id="inputState" name="inputState" required title="Please select your state.">
                                                <option value="" disabled selected>*Select State</option>
                                                <option value="Andra Pradesh">Andra Pradesh</option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka">Karnataka</option>
                                                <option value="Kerala" >Kerala</option>
                                                <option value="Madya Pradesh">Madya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Orissa">Orissa</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttaranchal">Uttaranchal</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="West Bengal">West Bengal</option>
                                                <option disabled style="background-color:#aaa; color:#fff">UNION Territories</option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu">Daman and Diu</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Lakshadeep">Lakshadeep</option>
                                                <option value="Pondicherry">Pondicherry</option>
                                            </select>
        								    
        									
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-4 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        								    
        								    <select class="form-control text-center" id="inputDistrict" name="inputDistrict" required title="Please select your district.">
                                              <option value="" disabled selected>*Select District </option>
                                             
                                            </select>
        								    
        									
        								</div>
        							</div>
        						</div>
        						
        						
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        								    
        								    <select class="form-control text-center" id="Education" name="Education" required title="Please select your education.">
                                              <option value="" disabled selected>*Select your education</option>
                                              <option value="High School">10th pass</option>
                                              <option value="High School">High School</option>
                                              <option value="Bachelor's Degree">Bachelor's Degree</option>
                                              <option value="Master's Degree">Master's Degree</option>
                                              <option value="None of this">None of this</option>
                                            </select>
        								    
        									
        								</div>
        							</div>
        						</div>
        						
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        								    
        								    <select class="form-control text-center" id="Experienece" name="Experienece" required title="Please select your experienece.">
                                              <option value="" disabled selected>*Select your experienece</option>
                                              <option value="below 1 year">Below 1 year</option>
                                              <option value="1 year">1 year</option>
                                              <option value="2 year">2 year</option>
                                              <option value="3 year">3 year</option>
                                              <option value="4 year">4 year</option>
                                              <option value="5 year">5 year</option>
                                              <option value="6 year">6 year</option>
                                              <option value="7 year">7 year</option>
                                              <option value="8 year">8 year</option>
                                              <option value="9 year">9 year</option>
                                              <option value="10 year">10 year</option>
                                              <option value="11 year">11 year</option>
                                              <option value="12 year">12 year</option>
                                              <option value="13 year">13 year</option>
                                              <option value="14 year">14 year</option>
                                              <option value="15 year">15 year</option>
                                              <option value="Above 15">Above 15</option>
                                            </select>
        								    
        								    
        								 
        								</div>
        							</div>
        						</div>
        						
        						<?php if($disCam){ ?>
        						
            						<div class="col-md-12 ">
            							<div class="subscribe text-center">
            								<div class="form-group" style="margin-bottom: 0px !important;">
            								    
            								    <select class="form-control text-center" id="camera" name="camera" required title="What camera are you currently using?">
                                                  <option value="" disabled selected>*What camera are you currently using?</option>
                                                  <option value="Canon">Canon</option>
                                                  <option value="Sony">Sony</option>
                                                  <option value="Nikon">Nikon</option>
                                                  <option value="Fujifilm">Fujifilm</option>
                                                  <option value="Panasonic">Panasonic</option>
                                                  <option value="OM SYSTEM / Olympus">OM SYSTEM / Olympus</option>
                                                  <option value="PENTAX">PENTAX</option>
                                                  <option value="Other">Other</option>
                                                  
                                                </select>
            								    
            								    
            								 
            								</div>
            							</div>
            						</div>
            						
            						
            					
            						
        						
        						<?php }else{ ?>
        						    <input type='hidden' value='' id='camera' name='camera' >
        						
            					
        						
        						<?php } ?>
        						
        							<div class="col-md-12 ">
            							<div class="subscribe text-center">
            								<div class="form-group" style="margin-bottom: 0px !important;">
            								    
            								    <select class="form-control text-center" id="AboutUs" name="AboutUs" required title="Please select How did you hear about us?">
                                                  <option value="" disabled selected> *How did you hear about us? </option>
                                                  <option value="Search Engine">Search Engine</option>
                                                  <option value="Google Ads">Google Ads</option>
                                                  <option value="Facebook Ads">Facebook Ads</option>
                                                  <option value="Youtube Ads">Youtube Ads</option>
                                                  <option value="Other paid social media advertising">Other paid social media advertising</option>
                                                  <option value="Facebook post/group">Facebook post/group</option>
                                                  <option value="Twitter post">Twitter post</option>
                                                  <option value="Instagram post/story">Instagram post/story</option>
                                                  <option value="Other social media">Other social media</option>
                                                  <option value="Email">Email</option>
                                                  <option value="Radio">Radio</option>
                                                  <option value="TV">TV</option>
                                                  <option value="Newspaper">Newspaper</option>
                                                  <option value="Word of mouth">Word of mouth</option>
                                                  <option value="Other">Other</option>
                                                </select>
            								    
            								    
            								   
            								</div>
            							</div>
            						</div>
            						
            						
            					<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="url" class="form-control text-center" id="SocialMedia1" name="SocialMedia1" placeholder="Your socialmedia link 1" title="Your socialmedia link.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="url" class="form-control text-center" id="SocialMedia2" name="SocialMedia2" placeholder="Your socialmedia link 2" title="Your socialmedia link.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="url" class="form-control text-center" id="PersonalWeb" name="PersonalWeb" placeholder="Your personal website" title="Your personal website.">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-6 ">
        							<div class="subscribe text-center" style="margin-bottom: 0px !important;">
        								<div class="form-group">
        									<input type="url" class="form-control text-center" id="OtherMedia" name="OtherMedia" placeholder="Other socialmedia link" title="Other socialmedia link.">
        								</div>
        							</div>
        						</div>
            						
            						
            						
            						
            						
        						
        					
        						
        						<div class="col-md-8 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;margin-top: 20px !important;">
        									<input type="file" class="form-control text-center" id="uploadCV" name="uploadCV"  required title="Please upload your CV">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-4 ">
        							<div class="subscribe text-left">
        								<div class="form-group" style="margin-bottom: 0px !important;margin-top: 20px !important;">
        									<small>*Upload your CV</small>
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-8 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<input type="file" class="form-control text-center" id="uploadAadhar" name="uploadAadhar"  required title="Please upload your Aadhar">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-4 ">
        							<div class="subscribe text-left">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<small>*Upload your Aadhar</small>
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-8 ">
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<input type="file" class="form-control text-center" id="uploadPassport" name="uploadPassport" accept="image/*"  required title="Please upload your Image">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-4 ">
        							<div class="subscribe text-left">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<small>*Upload your Image</small>
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-12 ">
        							<div class="subscribe text-left">
        								<div class="form-group" style="margin-bottom: 0px !important;">
        									<input type="checkbox" id="acceptTerms" name="acceptTerms" >
                                            <label for="acceptTerms">I read these <a href="/career_terms-and-conditions.php" target="_blank">Terms & Conditions</a> and <a href="/privacy-policy.php" target="_blank">Privacy Policy </a> carefully before using the website</label>
                                            <span id="acceptTermsError" class="error-message text-danger hide">*Please accept the terms and conditions.</span>
        								</div>
        							</div>
        						</div>
        						
        						
        						

        						
        						<div class="col-md-12 hide" id="successMeg">
        							<div class="subscribe text-center ">
        								<div class="form-group" style="margin-top: 20px !important;">
        									<span class="text-success" id="sccMeg"></span>
        									<span class="text-danger" id="errMeg"></span>
        								</div>
        							</div>
        						</div>
        						
        					
        						
        						<div class="col-md-12 " >
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-top: 10px !important;">
        									<input type="submit" value="Apply Now" id="applyBtn" class="btn btn-primary btn-custom">
        								</div>
        							</div>
        						</div>
        						
        						<div class="col-md-12 " >
        							<div class="subscribe text-center">
        								<div class="form-group" style="margin-top: 10px !important;">
        									<div id="loader" class="loader"></div>
        								</div>
        							</div>
        						</div>
        						
        						
        					</form>
    						
    						
    						
    					</div>
    				
    			</div>
				
			</div>
		</div>
	</nav>
        
        
        
        
        
        
        
        

	
	<div id="colorlib-page">
		<header style="position:fixed;">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="colorlib-navbar-brand">
							<a class="colorlib-logo" href="career.php"><span>Back to list</span></a>
						
						</div>
						
					</div>
				</div>
			</div>
		</header>
		
		 
		
	
		<div id="colorlib-services">
			<div class="container">
				<div class="row text-center">
					<h2 class="bold">Apply Now</h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="services-flex">
							<div class="one-third">
								<div class="row">
									<div class="col-md-12 col-md-offset-0 animate-box intro-heading">
									    <span><?=$city?>,&nbsp;<?=$district?>,&nbsp;<?=$state?>,&nbsp;<?=$County?></span>
										<h2><?=$position_name?></h2>
										<p><?=$sub_tittle?></p>
										<span><?=$Experience?> year experience</span>
										
									
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="rotate">
											<h2 class="heading">Job details</h2>
										</div>
									</div>
									<div class="col-md-12">
										<div class="services animate-box">
											<h3>Job summary</h3>
											<p><?=$jobsummary?></p>
										</div>
										<div class="services animate-box">
											<h3>Workig conditions</h3>
											<p><?=$Workigconditions?></p>
										</div>
										<div class="services animate-box">
											<h3>Job duties</h3>
											<p><?=$Jobduties?></p>
										</div>
										<div class="services animate-box">
											<h3>Qualifications to be needed</h3>
											<p><?=$Qualifications?></p>
										</div>
										<div class="services animate-box">
											<h3>Skills</h3>
											<p><?=$Skills?></p>
										</div>
										<div class="services animate-box">
											<h3>Responsibiities</h3>
											<p><?=$Responsibiities?></p>
										</div>
									</div>
								</div>
							</div>
							<div class="one-forth services-img" >
							    <img class="img-responsive about-img" src="admin/<?=$image?>" >
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		
		
		

		<footer>
			<div id="footer">
				<div class="container">
					
					<div class="row">
						<div class="col-md-12 text-center">
							<p>
								<span>&#169; MI 2022 . All rights reserved. </span>
							</p>
						</div>
						
						<div class="col-md-12 text-center text-light">
						    
						    <p>
								<span><a href="privacy-policy.php" target="_blank">Privacy Policy </a></span> &nbsp;&nbsp;
								<span><a href="terms-and-conditions.php" target="_blank">Terms & Conditions</a></span>
							</p>
						 
						</div>
						
						
						
					
					</div>
				</div>
			</div>
		</footer>
	
	</div>

	<!-- jQuery -->
	<script src="career/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="career/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="career/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="career/js/jquery.waypoints.min.js"></script>
	<!-- Owl Carousel -->
	<script src="career/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="career/js/jquery.magnific-popup.min.js"></script>
	<script src="career/js/magnific-popup-options.js"></script>

	<!-- Main JS (Do not remove) -->
	<script src="career/js/main.js"></script>
	<script src="career/js/jquery.validate.min.js"></script>
	
	
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>-->

	
	<script>
	
	
    const loader = document.getElementById("loader");
    function showLoader() {
        loader.style.display = "block";
    }
    function hideLoader() {
        loader.style.display = "none";
    }

	
	function openForm(){
         $('#successMeg').addClass('hide');
         $('#sccMeg').html('');
         $('#errMeg').html('');
         
         hideLoader();
	}
	
	
	$("#applyNowForm").submit(function(event) {
        event.preventDefault();
    }).validate({
      submitHandler: function(form) {
          
        const acceptTermsCheckbox = document.getElementById('acceptTerms');

        if (!acceptTermsCheckbox.checked) {
            $('#acceptTermsError').removeClass('hide');
            return false;
        }
        $('#acceptTermsError').addClass('hide');

         $('#applyBtn').addClass('hide');
         $('#successMeg').addClass('hide');
         $('#sccMeg').html('');
         showLoader();
         
        var formData = new FormData(form);
        formData.append('function', 'Career');
        formData.append('method', 'applyJob');
        formData.append('save', 'add');
        formData.append('jobId', '<?=$jobId?>');

        $.ajax({
          url: 'admin/ajaxHandler.php', // Replace with your API endpoint URL
          type: 'POST',
          data: formData,
          processData: false, // Prevent jQuery from processing the data
          contentType: false, // Prevent jQuery from setting the content type
          success: function(resp) {
              hideLoader();
              
              var responseObj = JSON.parse(resp);
                var status = responseObj.status;
              
            if (status == 1) {
              $('#successMeg').removeClass('hide');
              $('#sccMeg').html('Your application has been submitted');
              $('#errMeg').html('');

            }else{
                $('#applyBtn').removeClass('hide');
                $('#sccMeg').html('');
                $('#successMeg').removeClass('hide');
                $('#errMeg').html('Your application not submitted, Please try again.');

            }
          },
          error: function(resp) {
              $('#applyBtn').removeClass('hide');
             $('#successMeg').addClass('hide');
             $('#sccMeg').html('');
             $('#errMeg').html('Your application not submitted, Please try again.');
             hideLoader();
            console.log(resp);
          }
        });

       
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
	    
 
 
 
 
 
 
 
 
 
 var AndraPradesh = ["Anantapur","Chittoor","East Godavari","Guntur","Kadapa","Krishna","Kurnool","Prakasam","Nellore","Srikakulam","Visakhapatnam","Vizianagaram","West Godavari"];
var ArunachalPradesh = ["Anjaw","Changlang","Dibang Valley","East Kameng","East Siang","Kra Daadi","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Namsai","Papum Pare","Siang","Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang","Itanagar"];
var Assam = ["Baksa","Barpeta","Biswanath","Bongaigaon","Cachar","Charaideo","Chirang","Darrang","Dhemaji","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Hojai","Jorhat","Kamrup Metropolitan","Kamrup (Rural)","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Majuli","Morigaon","Nagaon","Nalbari","Dima Hasao","Sivasagar","Sonitpur","South Salmara Mankachar","Tinsukia","Udalguri","West Karbi Anglong"];
var Bihar = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur","Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa","Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"];
var Chhattisgarh = ["Balod","Baloda Bazar","Balrampur","Bastar","Bemetara","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Gariaband","Janjgir Champa","Jashpur","Kabirdham","Kanker","Kondagaon","Korba","Koriya","Mahasamund","Mungeli","Narayanpur","Raigarh","Raipur","Rajnandgaon","Sukma","Surajpur","Surguja"];
var Goa = ["North Goa","South Goa"];
var Gujarat = ["Ahmedabad","Amreli","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Botad","Chhota Udaipur","Dahod","Dang","Devbhoomi Dwarka","Gandhinagar","Gir Somnath","Jamnagar","Junagadh","Kheda","Kutch","Mahisagar","Mehsana","Morbi","Narmada","Navsari","Panchmahal","Patan","Porbandar","Rajkot","Sabarkantha","Surat","Surendranagar","Tapi","Vadodara","Valsad"];
var Haryana = ["Ambala","Bhiwani","Charkhi Dadri","Faridabad","Fatehabad","Gurugram","Hisar","Jhajjar","Jind","Kaithal","Karnal","Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamunanagar"];
var HimachalPradesh = ["Bilaspur","Chamba","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul Spiti","Mandi","Shimla","Sirmaur","Solan","Una"];
var JammuKashmir = ["Anantnag","Bandipora","Baramulla","Budgam","Doda","Ganderbal","Jammu","Kargil","Kathua","Kishtwar","Kulgam","Kupwara","Leh","Poonch","Pulwama","Rajouri","Ramban","Reasi","Samba","Shopian","Srinagar","Udhampur"];
var Jharkhand = ["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribagh","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu","Ramgarh","Ranchi","Sahebganj","Seraikela Kharsawan","Simdega","West Singhbhum"];
var Karnataka = ["Bagalkot","Bangalore Rural","Bangalore Urban","Belgaum","Bellary","Bidar","Vijayapura","Chamarajanagar","Chikkaballapur","Chikkamagaluru","Chitradurga","Dakshina Kannada","Davanagere","Dharwad","Gadag","Gulbarga","Hassan","Haveri","Kodagu","Kolar","Koppal","Mandya","Mysore","Raichur","Ramanagara","Shimoga","Tumkur","Udupi","Uttara Kannada","Yadgir"];
var Kerala = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thiruvananthapuram","Thrissur","Wayanad"];
var MadhyaPradesh = ["Agar Malwa","Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Datia","Dewas","Dhar","Dindori","Guna","Gwalior","Harda","Hoshangabad","Indore","Jabalpur","Jhabua","Katni","Khandwa","Khargone","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Raisen","Rajgarh","Ratlam","Rewa","Sagar","Satna",
"Sehore","Seoni","Shahdol","Shajapur","Sheopur","Shivpuri","Sidhi","Singrauli","Tikamgarh","Ujjain","Umaria","Vidisha"];
var Maharashtra = ["Ahmednagar","Akola","Amravati","Aurangabad","Beed","Bhandara","Buldhana","Chandrapur","Dhule","Gadchiroli","Gondia","Hingoli","Jalgaon","Jalna","Kolhapur","Latur","Mumbai City","Mumbai Suburban","Nagpur","Nanded","Nandurbar","Nashik","Osmanabad","Palghar","Parbhani","Pune","Raigad","Ratnagiri","Sangli","Satara","Sindhudurg","Solapur","Thane","Wardha","Washim","Yavatmal"];
var Manipur = ["Bishnupur","Chandel","Churachandpur","Imphal East","Imphal West","Jiribam","Kakching","Kamjong","Kangpokpi","Noney","Pherzawl","Senapati","Tamenglong","Tengnoupal","Thoubal","Ukhrul"];
var Meghalaya = ["East Garo Hills","East Jaintia Hills","East Khasi Hills","North Garo Hills","Ri Bhoi","South Garo Hills","South West Garo Hills","South West Khasi Hills","West Garo Hills","West Jaintia Hills","West Khasi Hills"];
var Mizoram = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip","Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"];
var Nagaland = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];
var Odisha = ["Angul","Balangir","Balasore","Bargarh","Bhadrak","Boudh","Cuttack","Debagarh","Dhenkanal","Gajapati","Ganjam","Jagatsinghpur","Jajpur","Jharsuguda","Kalahandi","Kandhamal","Kendrapara","Kendujhar","Khordha","Koraput","Malkangiri","Mayurbhanj","Nabarangpur","Nayagarh","Nuapada","Puri","Rayagada","Sambalpur","Subarnapur","Sundergarh"];
var Punjab = ["Amritsar","Barnala","Bathinda","Faridkot","Fatehgarh Sahib","Fazilka","Firozpur","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Mohali","Muktsar","Pathankot","Patiala","Rupnagar","Sangrur","Shaheed Bhagat Singh Nagar","Tarn Taran"];
var Rajasthan = ["Ajmer","Alwar","Banswara","Baran","Barmer","Bharatpur","Bhilwara","Bikaner","Bundi","Chittorgarh","Churu","Dausa","Dholpur","Dungarpur","Ganganagar","Hanumangarh","Jaipur","Jaisalmer","Jalore","Jhalawar","Jhunjhunu","Jodhpur","Karauli","Kota","Nagaur","Pali","Pratapgarh","Rajsamand","Sawai Madhopur","Sikar","Sirohi","Tonk","Udaipur"];
var Sikkim = ["East Sikkim","North Sikkim","South Sikkim","West Sikkim"];
var TamilNadu = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Nagapattinam","Namakkal","Nilgiris","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Theni","Thoothukudi","Tiruchirappalli","Tirunelveli","Tiruppur","Tiruvallur","Tiruvannamalai","Tiruvarur","Vellore","Viluppuram","Virudhunagar"];
var Telangana = ["Adilabad","Bhadradri Kothagudem","Hyderabad","Jagtial","Jangaon","Jayashankar","Jogulamba","Kamareddy","Karimnagar","Khammam","Komaram Bheem","Mahabubabad","Mahbubnagar","Mancherial","Medak","Medchal","Nagarkurnool","Nalgonda","Nirmal","Nizamabad","Peddapalli","Rajanna Sircilla","Ranga Reddy","Sangareddy","Siddipet","Suryapet","Vikarabad","Wanaparthy","Warangal Rural","Warangal Urban","Yadadri Bhuvanagiri"];
var Tripura = ["Dhalai","Gomati","Khowai","North Tripura","Sepahijala","South Tripura","Unakoti","West Tripura"];
var UttarPradesh = ["Agra","Aligarh","Allahabad","Ambedkar Nagar","Amethi","Amroha","Auraiya","Azamgarh","Baghpat","Bahraich","Ballia","Balrampur","Banda","Barabanki","Bareilly","Basti","Bhadohi","Bijnor","Budaun","Bulandshahr","Chandauli","Chitrakoot","Deoria","Etah","Etawah","Faizabad","Farrukhabad","Fatehpur","Firozabad","Gautam Buddha Nagar","Ghaziabad","Ghazipur","Gonda","Gorakhpur","Hamirpur","Hapur","Hardoi","Hathras","Jalaun","Jaunpur","Jhansi","Kannauj","Kanpur Dehat","Kanpur Nagar","Kasganj","Kaushambi","Kheri","Kushinagar","Lalitpur","Lucknow","Maharajganj","Mahoba","Mainpuri","Mathura","Mau","Meerut","Mirzapur","Moradabad","Muzaffarnagar","Pilibhit","Pratapgarh","Raebareli","Rampur","Saharanpur","Sambhal","Sant Kabir Nagar","Shahjahanpur","Shamli","Shravasti","Siddharthnagar","Sitapur","Sonbhadra","Sultanpur","Unnao","Varanasi"];
var Uttarakhand  = ["Almora","Bageshwar","Chamoli","Champawat","Dehradun","Haridwar","Nainital","Pauri","Pithoragarh","Rudraprayag","Tehri","Udham Singh Nagar","Uttarkashi"];
var WestBengal = ["Alipurduar","Bankura","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah","Jalpaiguri","Jhargram","Kalimpong","Kolkata","Malda","Murshidabad","Nadia","North 24 Parganas","Paschim Bardhaman","Paschim Medinipur","Purba Bardhaman","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"];
var AndamanNicobar = ["Nicobar","North Middle Andaman","South Andaman"];
var Chandigarh = ["Chandigarh"];
var DadraHaveli = ["Dadra Nagar Haveli"];
var DamanDiu = ["Daman","Diu"];
var Delhi = ["Central Delhi","East Delhi","New Delhi","North Delhi","North East Delhi","North West Delhi","Shahdara","South Delhi","South East Delhi","South West Delhi","West Delhi"];
var Lakshadweep = ["Lakshadweep"];
var Puducherry = ["Karaikal","Mahe","Puducherry","Yanam"];


$("#inputState").change(function(){
  var StateSelected = $(this).val();
  var optionsList;
  var htmlString = "";
  
  switch (StateSelected) {
    case "Andra Pradesh":
        optionsList = AndraPradesh;
        break;
    case "Arunachal Pradesh":
        optionsList = ArunachalPradesh;
        break;
    case "Assam":
        optionsList = Assam;
        break;
    case "Bihar":
        optionsList = Bihar;
        break;
    case "Chhattisgarh":
        optionsList = Chhattisgarh;
        break;
    case "Goa":
        optionsList = Goa;
        break;
    case  "Gujarat":
        optionsList = Gujarat;
        break;
    case "Haryana":
        optionsList = Haryana;
        break;
    case "Himachal Pradesh":
        optionsList = HimachalPradesh;
        break;
    case "Jammu and Kashmir":
        optionsList = JammuKashmir;
        break;
    case "Jharkhand":
        optionsList = Jharkhand;
        break;
    case  "Karnataka":
        optionsList = Karnataka;
        break;
    case "Kerala":
        optionsList = Kerala;
        break;
    case  "Madya Pradesh":
        optionsList = MadhyaPradesh;
        break;
    case "Maharashtra":
        optionsList = Maharashtra;
        break;
    case  "Manipur":
        optionsList = Manipur;
        break;
    case "Meghalaya":
        optionsList = Meghalaya ;
        break;
    case  "Mizoram":
        optionsList = Mizoram;
        break;
    case "Nagaland":
        optionsList = Nagaland;
        break;
    case  "Orissa":
        optionsList = Orissa;
        break;
    case "Punjab":
        optionsList = Punjab;
        break;
    case  "Rajasthan":
        optionsList = Rajasthan;
        break;
    case "Sikkim":
        optionsList = Sikkim;
        break;
    case  "Tamil Nadu":
        optionsList = TamilNadu;
        break;
    case  "Telangana":
        optionsList = Telangana;
        break;
    case "Tripura":
        optionsList = Tripura ;
        break;
    case  "Uttaranchal":
        optionsList = Uttaranchal;
        break;
    case  "Uttar Pradesh":
        optionsList = UttarPradesh;
        break;
    case "West Bengal":
        optionsList = WestBengal;
        break;
    case  "Andaman and Nicobar Islands":
        optionsList = AndamanNicobar;
        break;
    case "Chandigarh":
        optionsList = Chandigarh;
        break;
    case  "Dadar and Nagar Haveli":
        optionsList = DadraHaveli;
        break;
    case "Daman and Diu":
        optionsList = DamanDiu;
        break;
    case  "Delhi":
        optionsList = Delhi;
        break;
    case "Lakshadeep":
        optionsList = Lakshadeep ;
        break;
    case  "Pondicherry":
        optionsList = Pondicherry;
        break;
   
}
if(StateSelected !=""){
     for(var i = 0; i < optionsList.length; i++){
    htmlString = htmlString+"<option value='"+ optionsList[i] +"'>"+ optionsList[i] +"</option>";
  }
  $("#inputDistrict").html(htmlString);
}
 

});



	</script>

	</body>
</html>

