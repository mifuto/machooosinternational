
<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$albums = [];

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

	$sql = "SELECT a.*,b.position_name FROM tbl_career a left join tblhr_job_position b on a.tittle = b.position_id
			WHERE a.active=0 and a.disabled =0 ORDER BY a.id DESC";

    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);

    if($count > 0) {	
        
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($albums,$row);
            
        }
    }


?>


<!DOCTYPE HTML>
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
	<body>


	<div id="colorlib-page">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="colorlib-navbar-brand">
						    <a class="colorlib-logo" href="index.php"><span>Home</span></a>
							<!--<a class="colorlib-logo" href="#"><span>Career</span></a>-->
						</div>
						
					</div>
				</div>
			</div>
		</header>
		<div id="colorlib-about">
			<div class="container">
				<div class="row text-center">
					<h2 class="bold">Career</h2>
				</div>
				
				
				<?php if(count($albums) > 0) { ?>
    				<div class="row">
    					<div class="col-md-5 animate-box">
    						<div class="owl-carousel3">
    						    
    						    <?php
                                    foreach ($albums as $key => $album) { 
                                        $image = $album['image'];
    						    
    						    ?>
    							<div class="item">
    								<img class="img-responsive about-img" src="admin/<?=$image?>" >
    							</div>
    							
    							<?php if(count($albums) == 1) { ?>
    								<div class="item">
        								<img class="img-responsive about-img" src="admin/<?=$image?>" >
        							</div>
    							<?php
                                    }
    						    ?>
    							
    							<?php
                                    }
    						    ?>
    							
    							
    						
    							
    						</div>
    					</div>
    					<div class="col-md-6 col-md-push-1 animate-box">
    						<div class="about-desc">
    						    
    							<div class="owl-carousel3">
    							    
    							     <?php
                                        foreach ($albums as $key => $album) { 
                                            $position_name = $album['position_name'];
        						    
        						    ?>
        							<div class="item">
    									<h2><span><?=$position_name?></span></h2>
    								</div>
    								
    									<?php if(count($albums) == 1) { ?>
            								<div class="item">
        									<h2><span><?=$position_name?></span></h2>
        								</div>
            							<?php
                                            }
            						    ?>
        							
        							<?php
                                        }
        						    ?>
    							    
    							    
    							</div>
    							<div class="desc">
    								<div class="rotate">
    									<h2 class="heading">Details</h2>
    								</div>
    								
    									<div class="owl-carousel3">
    									    
    									     <?php
                                                foreach ($albums as $key => $album) { 
                                                    $sub_tittle = $album['sub_tittle'];
                                                    $Experience = $album['Experience'];
                                                    
                                                    $County = $album['County'];
                                                    $state = $album['state'];
                                                    $district = $album['district'];
                                                    $city = $album['city'];
                                                    
                                                    $timestamp = time(); // Get the current timestamp
                                                   
                                        			$id = $album['id'];
                                        			
                                        			$decodeId = base64_encode($timestamp . "_".$id);
                						    
                						    ?>
                							<div class="item">
                							    <p><?=$Experience?> year experience</p>
            									<p><?=$sub_tittle?></p><hr>
            									<p><?=$city?>,&nbsp;<?=$district?>,&nbsp;<?=$state?>,&nbsp;<?=$County?></p>
            									
            									
            									<p><a href="apply-job.php?jobId=<?=$decodeId?>" class="btn btn-primary btn-outline">View details</a></p>
            									
            								</div>
            								
            								
            									<?php if(count($albums) == 1) { ?>
                        							<div class="item">
                    							    <p><?=$Experience?> year experience</p>
                									<p><?=$sub_tittle?></p><hr>
                									<p><?=$city?>,&nbsp;<?=$district?>,&nbsp;<?=$state?>,&nbsp;<?=$County?></p>
                									
                									
                									<p><a href="apply-job.php?jobId=<?=$decodeId?>" class="btn btn-primary btn-outline">View details</a></p>
                									
                								</div>
                    							<?php
                                                    }
                    						    ?>
            								
            								
            								
            								
                							
                							<?php
                                                }
                						    ?>
    							    
    									   
            							</div>
    								
    								
    								
    							</div>
    						</div>
    					</div>
    				</div>
    				
    			<? } else { ?>
                    <div class="row">
    					<div class="col-md-5 animate-box">
    						<div class="">
    							<div class="item">
    								<img class="img-responsive about-img" src="images/machooos-img-dis-logo.png" >
    							</div>
    						
    						</div>
    					</div>
    					<div class="col-md-6 col-md-push-1 animate-box">
    						<div class="about-desc">
    							<div class="">
    								<div class="item">
    									<h2><span>Come</span><span>Work with us</span></h2>
    								</div>
    							
    							</div>
    							<div class="desc">
    								<div class="rotate">
    									<h2 class="heading">vacancys</h2>
    								</div>
    								
    									<div class="">
            							
            								<div class="item">
            									<p>Thank you for your interest in MACHOOOS INTERNATIONAL. Unfortunately, at this time, we do not have any job vacancies that match your qualifications and experience. We appreciate your application and will keep your information on file for future opportunities.</p>
            								</div>
            							</div>
    								
    								
    							</div>
    						</div>
    					</div>
    				</div>
                
                <?php } ?>
				
				
				
				
				
			</div>
		</div>
		

		<?php if(count($albums) > 0) { ?>

		<div id="colorlib-blog">
			<div class="container">
				<div class="row text-center">
					<h2 class="bold">Career</h2>
				</div>
				<div class="row">
					<div class="col-md-12 col-md-offset-0 text-center animate-box intro-heading">
						<span>Career</span>
						<h2>Latest Jobs</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="rotate">
							<h2 class="heading">MACHOOOS INTERNATIONAL</h2>
						</div>
					</div>
				</div>
				<div class="row animate-box">
					<div class="owl-carousel1">
					    
					    
					    
					    <?php
                            foreach ($albums as $key => $album) { 
                                
                                $image = $album['image'];
                                $position_name = $album['position_name'];
                                
                                
                                $sub_tittle = $album['sub_tittle'];
                                $Experience = $album['Experience'];
                                
                                $County = $album['County'];
                                $state = $album['state'];
                                $district = $album['district'];
                                $city = $album['city'];
                                
                                
                                // $currentDate = date('Y-m-d');
                                                    $created_date = $album['created_date'];
                                                    
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
                                                    
                                                    $timestamp = time(); // Get the current timestamp
                                                   
                                        			$id = $album['id'];
                                        			
                                        			$decodeId = base64_encode($timestamp . "_".$id);
					    
					    ?>
						<div class="item">
							<div class="col-md-12">
								<div class="article">
									<a href="apply-job.php?jobId=<?=$decodeId?>" class="blog-img">
										<img class="img-responsive" src="admin/<?=$image?>" >
										<div class="overlay"></div>
										<div class="link">
											<span class="read">View details</h2>
										</div>
									</a>
									<div class="desc">
										<span class="meta"><?=$filmCDate?></span>
										<h2><?=$position_name?></h2>
										<p><?=$city?>,&nbsp;<?=$district?>,&nbsp;<?=$state?>,&nbsp;<?=$County?></p><hr>
										<p><?=$Experience?> year experience</p>
										<p><?=$sub_tittle?></p>
									</div>
								</div>
							</div>
						</div>
						
						<?php
                            }
					    ?>
					    
					    
						
					</div>
				</div>
			</div>
		</div>
		
		<?php } ?>

		

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

	</body>
</html>

