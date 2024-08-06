
<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$albums = [];
$SAalbums = [];
$plans = [];
$isExpMessage = false;



$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $user_id = $user_data['contact_user_id'];
    $main_user_id = $user_data['main_user_id'];
  
    
	$sql = "SELECT *, (SELECT COUNT(*) FROM cart 
WHERE album_id = E.id AND active=0 AND album_type='OA' ) AS cartCount, E.id album_id , (SELECT COUNT(*) FROM tbevents_views
    WHERE project_id = E.id) AS viewCounts ,(SELECT COUNT(*) FROM onl_alb_shares
        WHERE project_id = E.id) AS shareCounts,(SELECT COUNT(*) FROM tbevents_views
        WHERE project_id = E.id) AS viewsCounts,(SELECT COUNT(*) FROM onl_alb_comments
        WHERE project_id = E.id AND status = 1 AND deleted = 0 ) AS commentCounts,(SELECT COUNT(*) FROM onl_alb_like
    WHERE project_id = E.id AND status=1 AND active=0 ) AS likeCounts 
        FROM tbevents_data E
        JOIN tbeevent_files F ON(F.event_id = E.id)
        WHERE  (E.user_id = '$user_id' or E.user_id = '$main_user_id' ) and E.deleted = 0";

    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);

    $tmpData = [];

    if($count > 0) {		
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($albums,$row);
        }
    }
    
    
    
     
    $sql1 = "SELECT * FROM `tbesignaturealbum_projects` WHERE ( `user_id`='$user_id' or `user_id`='$main_user_id' ) AND `deleted`=0 ORDER BY id DESC ";

    $result1 = $DBC->query($sql1);

    $count1 = mysqli_num_rows($result1);

    if($count1 > 0) {	
        
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push($SAalbums,$row1);
            
        }
    }
    
    
    $offerPriceP = "";
    $actualPrice = "";
    $finalPrice = "";
    
    
    $sql3 = "SELECT * FROM `tblalbumsubscription` WHERE `period`=1 AND photo_count=1 AND `online`=1 AND `delete`=0  ";
  
    $result3 = $DBC->query($sql3);
    
    $count3 = mysqli_num_rows($result3);

    if($count3 > 0) {	
        
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($plans,$row3);
            
            $offerPriceP = $row3['pamount'];
            $actualPrice = $row3['amount'];
            
            $finalPrice = ($actualPrice - (($actualPrice / 100) * $offerPriceP));
            $finalPrice = number_format($finalPrice, 2);
           
            
        }
    }
    
    
} else {
    header("location: index.php");
}

include("templates/header.php");

?>

<style>
          
          .testi-item:after {
            font-family: none !important;
            content: none !important;
          
        }
        
        .tc-pagination {
            display: none !important;
        }
        
        .fw_cb {
            width: 30px !important;
            height: 30px !important;
            line-height: 30px !important;
            
        }
        
        
        
.card {
    background-color: #fff;
    border: none;
    border-radius: 10px;
    width: 100%;
}



.voutchers {
    background-color: #fff;
    border: none;
    border-radius: 10px;
    width: 60%;
    overflow: hidden
}

.voutcher-divider {
    display: flex;
}

.voutcher-left {
    width: 100%;
    background-color: #17a2b8;
    color: #fff
    
}

.voutcher-name {
    color: grey;
    font-size: 9px;
    font-weight: 500
}

.voutcher-code {
    font-size: 11px;
    font-weight: bold;
    padding-top:5px;
}

.voutcher-right {
    width: 100%;
    background-color: #58d8a3;
    color: #fff
}

.btn {
   
    --bs-btn-line-height: 0.1;
  
    --bs-btn-border-width: .1px;
  
}

.form-control {
    width: 100%;
    padding: 0.1rem 0.2rem;
   
    line-height: .1;
  
}

.input-group>.form-control, .input-group>.form-floating, .input-group>.form-select {
    flex: .3 1 auto;
  
}

</style>


                <!-- content-holder -->
                <input type="hidden" value="<?php echo $user_id; ?>" id="lonlineAlbumUserId">
            
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        
                        <div class="alert warning d-none" style="padding-bottom: 10px;" id="alertMeg">
                        	<span class='alert-close' onclick="this.parentElement.style.display='none';">&times;</span>
                        	<b>Warning</b><br>
                        	
                            <ul>
                                <li>Customers who do not renew the plan after 1 years will be charged an additional 10% of the total amount after 1 years.</li>
                        	    <li>Customers who do not renew the plan after 3 years will be charged an additional 20% of the total amount after 3 years.</li>
                        	    <li>Customers who do not renew the plan after 5 years will be charged an additional 30% of the total amount after 5 years.</li>
                        	    <li>Customers who do not renew the plan after 10 years will be charged an additional 40% of the total amount after 10 years.</li>
                            </ul>
                        </div>
                        
                        
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-title alighn-title" style="padding: 0px;">
                                            <h4>The MI</h4>
                                            <h2>Portable Photo Book</h2>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="clearfix"></div>

                         <!-- container-->
                         <div style="padding-top: 0px;">
                            <div >
                                
                                
                                <div class="" style="padding-top:10px;">
                                    
                                    <?php if(count($albums) > 0) { ?>
                                    
                                        <div class="gallery-items no-padding four-column fl-wrap lightgallery">
                                            <?php
                                                foreach ($albums as $key => $album) { 
                                                
                                                    
                                                    $currentDate = date('Y-m-d');
                                                    $planExpDate = $album['expiry_date'];
                                                    
                                                    $planExpDate1 = new DateTime($planExpDate);
    
                                                    // Get year, month, and day part from the date
                                                    $year = $planExpDate1->format('Y');
                                                    $month = $planExpDate1->format('n');
                                                    $day = $planExpDate1->format('d');
                                                    
                                                    // Assuming $monthNames is an array with month names
                                                    $monthNames = array(
                                                        "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                    );
                                                    
                                                    $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                    
                                                    $timestamp = time(); // Get the current timestamp
                                                    $vl = 2;
                                        			$state = base64_encode($timestamp . "_".$vl);
                                        			
                                        			$id = $album['album_id'];
                                        			
                                        			$decodeId = base64_encode($timestamp . "_".$id);
                                        			
                                        			$cartCount= $album['expiry_date'];
    
                                                
                                                ?>
                                                
                                                
                                                <div class="gallery-item  " style="padding:10px;">
                                                           <div class="grid-item-holder ">
                                                              
                                                                    <a style="position: unset !important;" href="online_album_sa.php?pId=<?=$decodeId?>" >
                                                              
                                                              
                                                               <?php if($album['upload_server'] == 1 ){ ?>
                                                                            <img style="width:100%"  src="<?=$album['covering_name']?>" alt="">
                                                                <?php }else{ ?>
                                                                    <img style="width:100%"  src="admin/<?= EVENT_UPLOAD_PATH. $album['uploader_folder'].'/'.$album['covering_name'] ?>" alt="">
                                                                <?php } ?>
                                                              
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <div class="grid-item-holder_title " style="bottom: 60% !important;">
                                                                    <h1 class="text-white new-text-sub-fond" style="font-size: 1.2rem !important;font-weight: 600 !important;"><?=$album['event_name']?></h1>
                                                                    <img src="images/machooos-img-dis-logo.png" alt="" style="background: transparent;width: 10%;height: 10%;">
                                                                </div>
                                                                </a>
                                                                
                                                                <div class="row" style="padding-left:10px;padding-right:10px;">
                                                                    <div class="col-12">
                                                                        <div class="d-flex justify-content-start" style="padding-top:20px;">
                                                                            
                                                                <?php if($planExpDate > $currentDate){ ?>
                                                                    <span class="mr-3" > Expire on <?=$formattedExpDate?> </span>
                                                                 <?php }else{ $isExpMessage = true; ?>
                                                                    <span class="mr-3 text-danger" > Expired on <?=$formattedExpDate?> </span>
                                                                <?php } ?>
                                                                
                                                                </div>
                                                                </div>
                                                                
                                                                <div class="col-12">
                                                                    <div class="d-flex justify-content-start" style="padding-top:5px;">
                                                                        <span class="mr-3" ><i class="far fa-eye"></i> <?=$album['viewCounts']?></span>
                                                                        <span class="mr-3" style="padding-left:10px;"><i class="far fa-heart"></i> <?=$album['likeCounts']?></span>
                                                                        <span class="mr-3" style="padding-left:10px;"><i class="far fa-comment"></i> <?=$album['commentCounts']?></span>
                                                                        <span style="padding-left:10px;"><i class="fas fa-share"></i> <?=$album['shareCounts']?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                 <div class="row" style="padding-left:5px;padding-right:5px;">
                                                                    <div class="col-12">
                                                                        <div class="d-flex justify-content-start" style="padding-top:5px;">
                                                                            
                                                                        <b class="mr-3 text-success" > Album view token: <?=$album['view_token']?> </b>
                                                                        </div>
                                                                
                                                                    </div>
                                                                </div>
                                                                
                                                             
                                                                
                                                                
                                                                <div class="row" style="padding-left:5px;padding-right:5px;">
                                                                    <div class="col-5">
                                                                        <div class="d-flex justify-content-start" style="padding-top:5px;">
                                                                            <span class="mr-3 text-danger" style="font-weight: bold;"><b id="offer_<?=$id?>" ><?=$offerPriceP?>% off</b></span>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-7">
                                                                        <div class="d-flex justify-content-end" style="padding-top:5px;">
                                                                            <b><span class="mr-3" id="price_<?=$id?>" >₹ <?=$finalPrice?> / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>₹ <?=$actualPrice?></del></span></b>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row d-flex justify-content-center" style="padding-left:10px;padding-right:10px;">
                                                                  
                                                                   
                                                                     <div class="col-12 d-flex justify-content-center">
                                                                        <div class="d-flex justify-content-center" style="padding-top:5px;">
                                                                            <span class="mr-3 " ><b>Validity&nbsp;&nbsp;</b></span>
                                                                             <div class="input-group">
                                                                                <span class="input-group-btn">
                                                                                    <button onclick="quantityChange(1,<?=$id?>)" type="button" class="btn btn-secondary btn-number" data-type="minus" data-field="quantity">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </button>
                                                                                </span>
                                                                                <input type="text" onchange="quantityChange(3,<?=$id?>)" name="quantity" id="quantity_<?=$id?>" class="form-control input-number" value="1" min="1" max="10">
                                                                                <span class="input-group-btn">
                                                                                    <button type="button" onclick="quantityChange(2,<?=$id?>)" class="btn btn-secondary btn-number" data-type="plus" data-field="quantity">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </button>
                                                                                </span>
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                  
                                                                </div>
                                                                
                                                                
                                                                <?php if($album['cartCount'] <= 0 ){ ?>
                                                                
                                                                    <div class="row" style="padding-left:5px;padding-right:5px;">
                                                                        <div class="col-12">
                                                                            <div class="d-flex justify-content-center" style="padding-top:5px;">
                                                                                <div class="card voutchers" onclick="addCart(<?=$album['album_id']?>,'OA',<?=$id?>);">
                                                                                    <div class="voutcher-divider">
                                                                                        <div class="voutcher-left text-center"> 
                                                                                            <h5 class="voutcher-code">Add to cart <i class="fa fa-shopping-cart"></i></h5>
                                                                                        </div>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                        
                                                                     
                                                                    </div>
                                                                    
                                                                 <?php }else{ ?>
                                                                 
                                                                    <div class="row" style="padding-left:5px;padding-right:5px;">
                                                                        <div class="col-12">
                                                                            <div class="d-flex justify-content-center" style="padding-top:5px;">
                                                                                <div class="card voutchers" onclick="gotoCart();" >
                                                                                    <div class="voutcher-divider">
                                                                                        <div class="voutcher-right text-center"> 
                                                                                            <h5 class="voutcher-code">Go to cart <i class="fa fa-shopping-cart"></i></h5>
                                                                                        </div>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                        
                                                                     
                                                                    </div>
                                                                    
                                                                <?php } ?>
                                                              
                                                             
                                                              
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                               
                                                
                                                 <?php } ?>
                                         </div>
                                      
                                     <? } else { ?>
                                    
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div>
                                            Not created the folder to view !
                                            </div>
                                        </div>
                                    
                                    <?php } ?>
                              
                                </div>
                                
                                
                             
                                
                                <?php if(count($SAalbums) > 0) { ?>
                                    <div class="row" style="padding-bottom:30px;">
                                           
                                 <hr>
                                 
                                 
                                
                                        <div class="col-12" align="left">
                                            <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;">Your Signature albums</h3>
                                        </div>
                                        
                                        
                                        
                                         <div class="testilider fl-wrap">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    
                                                    
                                                    
                                                     <?php
                                                        foreach ($SAalbums as $key => $album) { 
                                                            $currentDate = date('Y-m-d');
                                                            $planExpDate = $album['expiry_date'];
                                                            
                                                            $planExpDate1 = new DateTime($planExpDate);
            
                                                            // Get year, month, and day part from the date
                                                            $year = $planExpDate1->format('Y');
                                                            $month = $planExpDate1->format('n');
                                                            $day = $planExpDate1->format('d');
                                                            
                                                            // Assuming $monthNames is an array with month names
                                                            $monthNames = array(
                                                                "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"
                                                            );
                                                            
                                                            $formattedExpDate = $day . ' ' . $monthNames[$month - 1] . ' ' . $year;
                                                            
                                                            $timestamp = time(); // Get the current timestamp
                                                            $vl = 1;
                                                			$state = base64_encode($timestamp . "_".$vl);
                                                			
                                                			$id = $album['id'];
                                                			
                                                			$decodeId = base64_encode($timestamp . "_".$id);
                                                       
                                                    ?>
                                                    
                                                    
                                                     <!-- swiper-slide -->
                                                    <div class="swiper-slide">
                                                        <div class="">
                                                            
                                                            <div class="gallery-item  " style="width: 100% !important;">
                                                                <div class="grid-item-holder ">
                                                                    <?php if($planExpDate > $currentDate){ ?>
                                                                                   
                                                                        <a style="position: unset !important;" href="signature_album_sa.php?pId=<?=$decodeId?>" >
                                                                    <?php }else{ ?>
                                                                       
                                                                        <a style="position: unset !important;" href="subscription_plans.php?id=<?=$decodeId?>&state=<?=$state?>" >
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                    
                                                                       <div class="image-container justify-content-center align-items-center" style="width: 100%; height: 160px; overflow: hidden;">
                                                                           
                                                                        <?php if($album['upload_server'] == 1 ){ ?>
                                                                            <img style="width: 100%;" src="<?=$album['cover_img_path']?>" alt="">
                                                                        <?php }else{ ?>
                                                                            <img style="width: 100%;" src="admin/<?=$album['cover_img_path']?>" alt="">
                                                                        <?php } ?>
                                                                           
                                                                           
                                                                           
</div>
                                                                    
                                                                    
                                                                    
                                                                        <div class="grid-item-holder_title " style="bottom: 20% !important;">
                                                                            <!--<h1 class="text-white new-text-sub-fond" style="font-size: 1.2rem !important;font-weight: 600 !important;"><?=$album['project_name']?></h1>-->
                                                                            <img src="images/machooos-img-dis-logo.png" alt="" style="background: transparent;width: 10%;height: 10%;">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                             </div>
                                                           
                                                           
                                                           
                                                           
                                                        </div>
                                                    </div>
                                                    <!-- swiper-slide end-->
                                                  
                                                    
                                                    
                                                        
                                                    <?php } ?>
                                                    
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="tc-pagination fl-wrap"></div>
                                            <div class="fw_cb ts-button-prev"><i class="fal fa-long-arrow-left"></i></div>
                                            <div class="fw_cb ts-button-next"><i class="fal fa-long-arrow-right"></i></div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                <? } ?>
                                
                                
                                
                        

                                <div class="row " style="margin-bottom: 30px;">

                                    <div class="col-sm-4 " ></div>

                                    <div class="col-sm-4 border rounded" >
                                        <div class="post-item_wrap fl-wrap " style="padding: 0px !important;">
                                           
                                            <div class="post-item_content fl-wrap" style="padding-bottom: 0px !important;padding: 10px !important;">
                                            <h2 class="img-heading" style="font-size: 18px; margin-top: 10px;">Hope you liked it.</h2>
                                            </div>
                                            
                                            <div class="post-item_content fl-wrap d-flex justify-content-center" style="padding-top: 0px !important">
                                            <a href="javascript:void(0);" onclick="showEnquiryform();" class="single-btn fl-wrap" style="margin-top: 0px;padding-top: 10px;
    padding-bottom: 10px;"><span>Talk to us</span></a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-4 " ></div>   

                                </div>
                              
                            </div>
                            <!-- section end-->
                        </div>
                        <!-- container end--> 




                        

                        
                    </div>
                    <!-- content end -->
                    <div class="clearfix"></div>
                    <?php  include("templates/footer-tpl.php"); ?>
                </div>
                <!-- content-holder end -->
 <?php 
 
 include("templates/footer.php");
 
 ?>
 <style type="text/css">
/*! normalize.css v2.1.2 | MIT License | git.io/normalize */article,aside,details,figcaption,figure,footer,

/* .elem, .elem * {
	box-sizing: border-box;
	margin: 0 !important;	
}
.elem {
	display: inline-block;
	font-size: 0;
	width: 33%;
	border: 20px solid transparent;
	border-bottom: none;
	background: #fff;
	padding: 10px;
	height: auto;
	background-clip: padding-box;
}
.elem > span {
	display: block;
	cursor: pointer;
	height: 0;
	padding-bottom:	70%;
	background-size: cover;	
	background-position: center center;
} */
.elem
 { 
   display: inline-block;
    background: #fff;
    /*padding: 1em;*/
    /*margin: 0 0 1.5em;*/
    width: 100%;
	-webkit-transition:1s ease all;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    /*box-shadow: 2px 2px 4px 0 #ccc;*/
}

.masonry { /* Masonry container */
    -webkit-column-count: 8;
  -moz-column-count:8;
  column-count: 8;
  -webkit-column-gap: 1em;
  -moz-column-gap: 1em;
  column-gap: 1em;
   margin: 0em;
    padding: 15px;
    -moz-column-gap: 1.5em;
    -webkit-column-gap: 1.5em;
    column-gap: 1.5em;
    font-size: .85em;
}
.elem img{max-width:100%; height: auto;}
.lcl_txt{
    display: none !important;
}

element.style {
    /* background: #E75A34; */
    /* color: #fff; */
    /* font-size: 16px; */
}
.nav-tabs .nav-link {
    font-size: 14px;
    color: #000000;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
    background: #000000;
    color: #ffffff;
    font-size: 16px;
}



.alert{font-family: -apple-system,BlinkMacSystemFont,'Roboto','Segoe UI','Oxygen-Sans','Ubuntu','Cantarell','Helvetica Neue',sans-serif;
    min-height: 38px;
    padding: 12px 15px 15px;
    margin: 5px auto;
    border-radius: 4px;
    border-left: 4px solid;
	opacity:1;
	   transition: opacity 0.6s;
	max-width:90%
}
.warning {
    background: rgba(244, 215, 201, .37);
    color: #d93025;
    border-color: #d93025;
}
.info {
    background: rgba(186, 208, 228, .37);
    color: #00539f;
    border-color: #00539f;
}
.success {
    background: #edf7ee;
    color: #4CAF50;
    border-color: #4CAF50;
}
.tip {
    background: #fff5e6;
    color: #ff9800;
    border-color: #ff9800;
}
.alert-close{
	   padding-left: 15px;
    font-weight: bold;
    float: right;
    font-size: 20px;
    line-height: 18px;
    cursor: pointer;
	   transition:.30s all;
}
.alert-close:hover{
	color:#000;
}
.alert code, .alert .mark{
    background: #fff;
    opacity: 0.9;
    padding: 3px 5px;
    border-radius: 4px;
    font-family: Consolas,Monaco,'Andale Mono',monospace;
    font-size: 89%;
    font-weight: normal;
}



</style>

<script>

$('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').addClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
        
        
    document.addEventListener("DOMContentLoaded", function(event) { 

        // Uses sharer.js 
        //  https://ellisonleao.github.io/sharer.js/#twitter  
        var shareUrl = window.location.href;
        var shareTitle = document.title;
        var shareSubject = "Read this good article";
        var shareImage = "yourTwitterUsername";
        var shareDescription = "yourTwitterUsername";


        //facebook
        $('#share-fb').attr('data-url', shareUrl).attr('data-sharer', 'facebook');
        //twitter
        $('#share-tw').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'twitter');
        //linkedin
        $('#share-li').attr('data-url', shareUrl).attr('data-sharer', 'linkedin');
        // google plus
        $('#share-wh').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-sharer', 'whatsapp');
        // email
        $('#share-em').attr('data-url', shareUrl).attr('data-title', shareTitle).attr('data-subject', shareSubject).attr('data-sharer', 'email');
        window.Sharer.init();


    });
  $( document ).ready(function() {

      lc_lightbox('.elem', {
		wrap_class: 'lcl_fade_oc',
		gallery : true,	
		thumb_attr: 'data-lcl-thumb', 
		
		skin: 'minimal',
		radius: 0,
		padding	: 0,
		border_w: 0,
	});	
	
	
		var isExpMeg = '<?=$isExpMessage?>';
	if(isExpMeg){
	    $('#alertMeg').removeClass('d-none');
	}
	
	// Get all elements with class="closebtn"
    var close = document.getElementsByClassName("alert-close");
    var i;
    
    // Loop through all close buttons
    for (i = 0; i < close.length; i++) {
        // When someone clicks on a close button
        close[i].onclick = function(){
    
            // Get the parent of <span class="closebtn"> (<div class="alert">)
            var div = this.parentElement;
    
            // Set the opacity of div to 0 (transparent)
            div.style.opacity = "0";
    
            // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
	
      
  });
  
  
  	
	function quantityChange(btn,id){
	    var quantity = $('#quantity_'+id).val();
	    if(btn ==1){
	        
	        quantity = parseInt(quantity);
	        if(quantity == 1 ) $('#quantity_'+id).val(1);
	        else if(quantity == 3 ) $('#quantity_'+id).val(1);
	        else if(quantity == 5 ) $('#quantity_'+id).val(3);
	        else if(quantity == 10 ) $('#quantity_'+id).val(5);
	        
	        
	        quantityValSet(id);
	        
	    }else if(btn ==2){
	        quantity = parseInt(quantity);
	        if(quantity == 1 ) $('#quantity_'+id).val(3);
	        else if(quantity == 3 ) $('#quantity_'+id).val(5);
	        else if(quantity == 5 ) $('#quantity_'+id).val(10);
	        else if(quantity == 10 ) $('#quantity_'+id).val(10);
	        
	        quantityValSet(id);
	    }else{
	        var newquantity = parseInt(quantity);
	        
	        if(newquantity <= 10 && newquantity >= 1 ) {
	            quantity = parseInt(quantity);
	            
    	        if(quantity == 1 ) $('#quantity_'+id).val(1);
    	        else if(quantity == 3 || quantity == 2 ) $('#quantity_'+id).val(3);
    	        else if(quantity == 5 || quantity == 4  ) $('#quantity_'+id).val(5);
    	        else if(quantity == 10 || quantity == 9 || quantity == 8 || quantity == 7 || quantity == 6 ) $('#quantity_'+id).val(10);
	            
	        }
	        else $('#quantity_'+id).val(1);
	        
	        quantityValSet(id);
	    }
	    
	}
	

	 function quantityValSet(id){
        var quantity = $('#quantity_'+id).val();
        
         var postData = {
            function: 'AlbumSubscription',
            method: "quantityValSet",
            quantity: quantity,
            albumType: "OA",
           
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {
                    var plan = data.data;
                    // console.log(plan);
                    
                    var newAmt = ( parseInt(plan['amount']) - ( ( parseInt(plan['amount']) / 100 ) * parseInt(plan['pamount']) ) ).toFixed(2) ;
                    $('#offer_'+id).html(plan['pamount']+'% off');
                    $('#price_'+id).html('&#8377; ' + newAmt + ' / <label class="dollar" style="font-size: 10px;font-weight: blod;"><del>'+ '&#8377; ' + plan['amount'] + '</del>' );
                    
                   
               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        
    }
    
	
</script>


