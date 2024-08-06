 <?php
 include("header.php");
 
$sql1 = "SELECT t1.Count AS totalOnlineAlbum, t2.Count AS SignatureAlbum,t4.Count AS noOfWeddingFilms FROM (SELECT COUNT(id) AS Count FROM tbevents_data WHERE `deleted` = 0 AND ( user_id='$user_id' OR user_id='$main_user_id' ) ) AS t1, (SELECT COUNT(id) AS Count FROM tbesignaturealbum_projects WHERE `deleted` = 0 AND ( user_id='$user_id' OR user_id='$main_user_id' ) ) AS t2, (SELECT COUNT(id) AS Count FROM wedding_films WHERE `active`=0 AND (user_id='$user_id' OR user_id='$main_user_id') ) AS t4"; 
    
$result1 = $DBC->query($sql1);
$row1 = mysqli_fetch_assoc($result1);

$OAalbums = [];
 
$sql = "SELECT *, (SELECT COUNT(*) FROM cart 
WHERE album_id = E.id AND active=0 AND album_type='OA' ) AS cartCount, E.id album_id 
    FROM tbevents_data E
    JOIN tbeevent_files F ON(F.event_id = E.id)
    WHERE ( E.user_id = '$user_id' OR E.user_id='$main_user_id' ) and E.deleted = 0";

$result = $DBC->query($sql);

$count = mysqli_num_rows($result);

if($count > 0) {		
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($OAalbums,$row);
    }
}
    
$SAalbums = [];

 
$sql3 = "SELECT * , (SELECT COUNT(*) FROM cart 
WHERE album_id = tbesignaturealbum_projects.id AND active=0 AND album_type='SA' ) AS cartCount, (SELECT COUNT(*) FROM tbesignaturealbum_data 
WHERE project_folder_id = tbesignaturealbum_projects.id AND deleted=0) AS eventsCount, (SELECT COUNT(*) FROM `tbesignalbm_folderfiles` 
WHERE album_id IN (SELECT id FROM tbesignaturealbum_data WHERE project_folder_id = tbesignaturealbum_projects.id AND deleted=0 )) AS imageCount FROM `tbesignaturealbum_projects` WHERE (`user_id`='$user_id' OR user_id='$main_user_id' ) AND `deleted`=0";

$result3 = $DBC->query($sql3);

$count3 = mysqli_num_rows($result3);

if($count3 > 0) {		
    while ($row3 = mysqli_fetch_assoc($result3)) {
        array_push($SAalbums,$row3);
    }
}


$sqlAnn = "SELECT * FROM `tblannouncements` where `showtousers`=1 order by `announcementid` desc";
$resultAnn = $DBC->query($sqlAnn);
$rowAnn = mysqli_fetch_assoc($resultAnn);

?>

        <!-- partial -->
        <div class="content-wrapper">
          <h3 class="page-heading mb-4">Dashboard</h3>
          
          <div class="row">
              
              
              <?php if(isset($rowAnn)){
                  $dateTime = new DateTime($rowAnn['dateadded']);
                  $formattedDateTime = $dateTime->format("Y-m-d h:i A");
              
              ?>
                  
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                  <div class="card card-statistics" onclick="viewSignatureAlbum();">
                    <div class="card-body">
                        <h5 class="text-info">Announcement!</h5>
                        <p class="text-dark">
                            From: <?=$rowAnn['userid']?>
                        </p>
                        <p class="text-dark">
                            Date posted: <?=$formattedDateTime?>
                        </p>
                        <hr>
                        <h5 class="text-dark"><?=$rowAnn['name']?></h5>
                        <p class="text-dark">
                            <?=$rowAnn['message']?>
                        </p>
                      
                      
                        
                    </div>
                  </div>
                </div>
                
                <?php } ?>
              
              
              
              
              
              
              
              
              
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4">
              <div class="card card-statistics" onclick="viewSignatureAlbum();">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h4 class="text-danger">
                        <i class="fa fa-file-image-o highlight-icon" aria-hidden="true"></i>
                      </h4>
                    </div>
                    <div class="float-right">
                     
                      <h4 class="bold-text"><?=$row1['SignatureAlbum']?></h4>
                      <p class="card-text text-muted">albums</p>
                    </div>
                  </div>
                  <p class="text-dark">
                    Signature Albums
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4">
              <div class="card card-statistics" onclick="viewOnlineAlbum();">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h4 class="text-warning">
                        <i class="fa fa-book highlight-icon" aria-hidden="true"></i>
                      </h4>
                    </div>
                    <div class="float-right">
                      <h4 class="bold-text"><?=$row1['totalOnlineAlbum']?></h4>
                      <p class="card-text text-muted">albums</p>
                    </div>
                  </div>
                  <p class="text-dark">
                    Online Albums
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <h4 class="text-success">
                        <i class="fa fa-film highlight-icon" aria-hidden="true"></i>
                      </h4>
                    </div>
                    <div class="float-right">
                      <h4 class="bold-text"><?=$row1['noOfWeddingFilms']?></h4>
                      <p class="card-text text-muted">films</p>
                    </div>
                  </div>
                  <p class="text-dark">
                    Wedding films
                  </p>
                </div>
              </div>
            </div>
           
          </div>
          
          
            <div class="row mb-2 d-none" id="viewOA">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Your online albums</h5>
                      
                      
                      <?php if(count($OAalbums) > 0) { ?>
                      
                        <div class="row">
                            
                                <?php
                                    foreach ($OAalbums as $key => $album) { 
                                    
                                        
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
    
                                    
                                    ?>
                                    
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 mb-4" >
                                        
                                         <?php if($album['upload_server'] == 1 ){ ?>
                                            <div class="card" style="background-image: url('<?= $album['covering_name'] ?>'); background-size: cover; background-position: center;">
                                        <?php }else{ ?>
                                            <div class="card" style="background-image: url('/admin/<?= EVENT_UPLOAD_PATH. $album['uploader_folder'].'/'.$album['covering_name'] ?>'); background-size: cover; background-position: center;">
                                        <?php } ?>
                                        
                                        
                                        
                                      
                                          
                                          
                                          
                                          
                                        <div class="card-body">
                                         
                                          <h4 class="card-title font-weight-normal text-success"><b><?=$album['event_name']?></b></h4>
                                          
                                           <?php if($planExpDate > $currentDate){ ?>
                                                <h6 class="card-subtitle mb-4 text-warning" >Expire on <?=$formattedExpDate?></h6>

                                             <?php }else{ ?>
                                                <h6 class="card-subtitle mb-4 text-danger">Expired on <?=$formattedExpDate?> </h6>
                                            <?php } ?>
                                            
                                              <h6 class="card-subtitle mb-4 text-white" >&nbsp;</h6>
                                              
                                              
                                               <div class="clearfix" id="album_OA_<?=$album['album_id']?>">
                                                  
                                                       <button class="btn btn-success float-right text-white" onclick="gotoOAAlbum(`<?=$decodeId?>`);" >View album</button>
                                                   
                                              </div>
                                            
                                            
                                          
                                          
                                          <!--<div class="clearfix" id="album_OA_<?=$album['album_id']?>">-->
                                          <!--  <?php if($album['cartCount'] <= 0 ){ ?>-->
                                          <!--     <button class="btn btn-info float-right text-white" onclick="addCart(<?=$album['album_id']?>,'OA');">Add to cart <i class="fa fa-shopping-cart"></i></button>-->

                                          <!--       <?php }else{ ?>-->
                                          <!--         <button class="btn btn-success float-right text-white" onclick="gotoCart();">Go to cart <i class="fa fa-shopping-cart"></i></button>-->
                                          <!--      <?php } ?>-->
                                              
                                          <!--</div>-->
                                         
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                    <?php } ?>
                                
                                
                        </div>
                      
                      
                      
                      <?php } ?>
                      
                      
                      
                      
                    </div>
                  </div>
                </div>
             </div>
             
             <div class="row mb-2 d-none" id="viewSA">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-4">Your signature albums</h5>
                      
                       <?php if(count($SAalbums) > 0) { ?>
                      
                        <div class="row">
                            
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
                                    
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 mb-4" >
                                        
                                        <?php if($album['upload_server'] == 1 ){ ?>
                                            <div class="card" style="background-image: url('<?=$album['cover_img_path']?>'); background-size: cover; background-position: center;">
                                        <?php }else{ ?>
                                            <div class="card" style="background-image: url('/admin/<?=$album['cover_img_path']?>'); background-size: cover; background-position: center;">
                                        <?php } ?>
                                        
                                        
                                        
                                      
                                          
                                          
                                        <div class="card-body">
                                          
                                          <h4 class="card-title font-weight-normal text-success"><b><?=$album['project_name']?></b></h4>
                                          
                                           <?php if($planExpDate > $currentDate){ ?>
                                                <h6 class="card-subtitle mb-4 text-warning" >Expire on <?=$formattedExpDate?></h6>

                                             <?php }else{ ?>
                                                <h6 class="card-subtitle mb-4 text-danger">Expired on <?=$formattedExpDate?> </h6>
                                            <?php } ?>
                                            
                                            <h6 class="card-subtitle mb-4 text-white" ><b><?=$album['eventsCount']?> Events </b>(<?=$album['imageCount']?> images)</h6>
                                            
                                            
                                            
                                             
                                               <div class="clearfix" id="album_OA_<?=$album['album_id']?>">
                                                  
                                                       <button class="btn btn-success float-right text-white" onclick="gotoSAAlbum(`<?=$decodeId?>`);" >View album</button>
                                                   
                                              </div>
                                            
                                          
                                          
                                          <!--<div class="clearfix" id="album_SA_<?=$album['id']?>">-->
                                              
                                          <!--     <?php if($album['cartCount'] <= 0 ){ ?>-->
                                          <!--     <button class="btn btn-info float-right text-white" onclick="addCart(<?=$album['id']?>,'SA');">Add to cart <i class="fa fa-shopping-cart"></i></button>-->

                                          <!--       <?php }else{ ?>-->
                                          <!--         <button class="btn btn-success float-right text-white" onclick="gotoCart();">Go to cart <i class="fa fa-shopping-cart"></i></button>-->
                                          <!--      <?php } ?>-->
                                              
                                              
                                              
                                            
                                          <!--</div>-->
                                         
                                        </div>
                                      </div>
                                    </div>
                                    
                                    
                                    <?php } ?>
                                
                                
                        </div>
                      
                      
                      
                      <?php } ?>
                      

                    </div>
                  </div>
                </div>
             </div>
             
             
          
          
          
          
          
          
          
        </div>
        
       
        
        
        
<?php
   
include("footer.php");
?>

 <script>
    document.getElementById("menu1").classList.add("active");
    document.getElementById("menu2").classList.remove("active");
    document.getElementById("menu3").classList.remove("active");
    document.getElementById("menu4").classList.remove("active");
    document.getElementById("menu5").classList.remove("active");
    document.getElementById("menu8").classList.remove("active");
    
    $(document).ready(function() {
        viewSignatureAlbum();
    });
    
    function viewSignatureAlbum(){
        document.getElementById("viewOA").classList.add("d-none");
        document.getElementById("viewSA").classList.remove("d-none");
    }
    
    function viewOnlineAlbum(){
        document.getElementById("viewSA").classList.add("d-none");
        document.getElementById("viewOA").classList.remove("d-none");
        
      
        
    }
    
    function addCart(albumID,albumType){
        
        
         var postData = {
            function: 'AlbumSubscription',
            method: "addCart",
            albumID: albumID,
            albumType: albumType,
           
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
                    
                    document.getElementById("album_"+albumType+"_"+albumID).innerHTML = '<button class="btn btn-success float-right text-white" onclick="gotoCart();">Go to cart <i class="fa fa-shopping-cart"></i></button>';
               
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
    
    function gotoCart(){
        window.location.href = 'cart.php';

    }
    
    function gotoOAAlbum(url){
        window.location.href = "/online_album_sa.php?pId="+url;
    }
  
    function gotoSAAlbum(url){
        window.location.href = "/signature_album_sa.php?pId="+url;
    }

    </script>