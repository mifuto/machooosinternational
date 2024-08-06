<?php 

include("admin/config.php");
include("get_session.php");

$albums = [];
$isFrist = false;

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

$user_state_vals = $_COOKIE["user_state_val"];

$where = '';
if($user_state_vals != "")$where = " and FIND_IN_SET($user_state_vals, a.state_id) ";

$sql = "SELECT a.* FROM tbl_latest_news a WHERE a.active=0 $where ORDER BY a.id DESC";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

if($count > 0) {	
    
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($albums,$row);

    }
}


include("templates/header.php");

?>

<div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-title alighn-title" style="padding: 10px;">
                                            <!--<h4>The Studio</h4>-->
                                            <h2>Latest News</h2>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div>
                        
                        
                        <?php if(count($albums) > 0) { ?>
                        
                        
                        
                        
                            <?php
                            foreach ($albums as $key => $album) { 
                                $title = $album['title'];
                                
                                $dateString = $album['dis_date'];
                                
                                // Create a DateTime object from the input string
                                $date = new DateTime($dateString);
                                
                                // Format the date as 'd M Y'
                                $formattedDate = $date->format('d M Y');

                                      
                            ?>
                            
                            
                             
                                <div class="row">
                                    
                                    <div class="col-12">
                                      <article class="card card-full hover-a mb-4 mt-2" style="padding-top:15px;padding-bottom:10px;">
                                        <!--thumbnail-->
                                      
                                        <div class="card-body">
                                          <!-- title -->
                                          <h2 class="card-title" style="font-size: 2.2em;text-align: left;">
                                            <a href="#" style="color:#804bd8;"><?=$album['title']?></a>
                                          </h2>
                                          <!-- author, date and comments --> 
                                          <div class="card-text mb-2 text-muted small" style="text-align: left;">
                                            <span class="d-none d-sm-inline me-1">
                                              <a class="fw-bold" href="#"><?=$album['location']?></a>
                                            </span>
                                            <time datetime="2019-10-22"><?=$formattedDate?></time>
                                           
                                          </div>
                                          <!--description-->
                                          <div class="card-text" style="font-size: medium;text-align: left;font-weight: 400;"><?=$album['description']?></div>
                                          <div class="card-text" style="font-size: small;text-align: left;padding-top:5px;"><?=$album['news']?></div>
                                        </div>
                                      </article>
                                    </div>
                                </div>
                                
                                
                               
                            <?php } ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <? } else { ?>
                        
                        
                          <div class="row">
                                    
                                    <div class="col-12">
                                      <article class="card card-full hover-a mb-4 mt-2" style="padding-top:15px;padding-bottom:10px;">
                                        <!--thumbnail-->
                                      
                                        <div class="card-body">
                                       
                                          <!-- author, date and comments --> 
                                          <div class="card-text mb-2 text-muted small" >
                                            <span class="d-none d-sm-inline me-1">
                                              <a class="fw-bold text-danger" href="#">No blogs available!</a>
                                            </span>

                                          </div>
                                        
                                        </div>
                                      </article>
                                    </div>
                                </div>
                        
                        
                   
                        
                        <?php } ?>
                        
                        
                       
                   


                        

                        
                    </div>
                    <!-- content end -->
                    <div class="clearfix"></div>
                    <footer class="main-footer">
                        <div class="policy-box">
                            <span>&#169; MI 2022 . All rights reserved. </span>
                        </div>
                        <div class="footer-social ">
                            <ul >
                                <li style="margin-right: 20px;margin-left: 0px;"><a href="privacy-policy.php" target="_blank">Privacy Policy </a></li>
                                <li style="margin-right: 20px;margin-left: 0px;"><a href="terms-and-conditions.php" target="_blank">Terms & Conditions</a></li>
                               
                            </ul>
                        </div>
                        <div class="footer-social">
                            <ul>
                                <li><a href="https://www.facebook.com/machooos" target="_blank">Facebook</a></li>
                                <li><a href="https://www.instagram.com/machooosinternational" target="_blank">Instagram</a></li>
                                <li><a href="https://twitter.com/Machooos_wed" target="_blank">Twitter</a></li>
                                <li><a href="https://g.co/kgs/Mmpk9z" target="_blank">Google</a></li>
                                <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?view_as=subscriber" target="_blank">Youtube</a></li>
                            </ul>
                        </div>
                        <div class="to-top-btn color-bg to-top"><i class="fal fa-long-arrow-up"></i></div>
                    </footer>
                </div>
                <!-- content-holder end -->


<?php 
 
 include("templates/footer.php");
 
 ?>