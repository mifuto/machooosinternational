<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$albums = [];
$OLalbums = [];
$isExpMessage = false;


$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $user_id = $user_data['contact_user_id'];
    $main_user_id = $user_data['main_user_id'];
    
   
    
	$sql = "SELECT *, (SELECT COUNT(*) FROM cart 
WHERE album_id = tbesignaturealbum_projects.id AND active=0 AND album_type='SA' ) AS cartCount , (SELECT COUNT(*) FROM tbeproject_comments
    WHERE project_id = tbesignaturealbum_projects.id) AS commentCount , (SELECT COUNT(*) FROM tbeproject_views
    WHERE project_id = tbesignaturealbum_projects.id) AS viewCounts , (SELECT COUNT(*) FROM tbeproject_shares
    WHERE project_id = tbesignaturealbum_projects.id) AS shareCounts,(SELECT COUNT(*) FROM signature_album_like
    WHERE project_id = tbesignaturealbum_projects.id AND status=1 AND active=0 ) AS likeCounts, (SELECT COUNT(*) FROM tbesignaturealbum_data 
    WHERE project_folder_id = tbesignaturealbum_projects.id AND deleted=0) AS eventsCount, (SELECT COUNT(*) FROM `tbesignalbm_folderfiles` 
    WHERE album_id IN (SELECT id FROM tbesignaturealbum_data WHERE project_folder_id = tbesignaturealbum_projects.id AND deleted=0 )) AS imageCount FROM `tbesignaturealbum_projects` WHERE ( `user_id`='$user_id' or `user_id`='$main_user_id' ) AND `deleted`=0";
    
   

    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);

    $tmpData = [];

    if($count > 0) {		
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($albums,$row);
        }
    }
    
       
      $sql2 = "SELECT *, E.id album_id , (SELECT COUNT(*) FROM tbevents_views
    WHERE project_id = E.id) AS viewCounts 
        FROM tbevents_data E
        JOIN tbeevent_files F ON(F.event_id = E.id)
        WHERE (E.user_id = '$user_id' or E.user_id = '$main_user_id') and E.deleted = 0 ORDER BY E.id DESC ";

    $result2 = $DBC->query($sql2);

    $count2 = mysqli_num_rows($result2);

    if($count2 > 0) {	
        
        while ($row2 = mysqli_fetch_assoc($result2)) {
            array_push($OLalbums,$row2);
            
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
                <input type="hidden" value="<?php echo $user_id; ?>" id="lsignatureAlbumUserId">
                <input type="hidden" value="<?php echo $main_user_id; ?>" id="main_user_id">
                
                
            
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        
                       
                        
                        
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-title alighn-title" style="padding: 0px;">
                                            <h4>The Studio</h4>
                                            <h2>Face Recognition</h2>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="clearfix"></div>
                        
                        <div style="padding-top: 0px;padding-bottom: 30px;">
                            
                            <h3>Select project</h3>
                            
                            <select id="projectIDForFR" name="projectIDForFR">
                                <option value="" selected>Please select project</option>
                                
                                <?php if(count($albums) > 0) { ?>
                                    <?php
                                        foreach ($albums as $key => $album) { 
                                    ?>
                                
                                
                                    <option value="<?=$album['id']?>"><?=$album['project_name']?></option>
                                
                                    <?php } ?>
                                
                                 <? } ?>
                                
                                
                                
                                
                            </select>
                            
                    
                            
                        </div>
                        
                         <div style="padding-top: 0px;padding-bottom: 30px;">
                            
                            <h3>Upload image to search</h3>
                            
                            <input type="file" id="imageInput" name="imageInput" accept="image/*">
                            
                           
                            
                    
                            
                        </div>
                        
                        <div style="padding-top: 0px;padding-bottom: 30px;">
                            
                           <button type="button" onclick="getFileNameForFR();">Search matches</button>
                            
                        </div>
                        
                        


                        

                        
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
    getUserProjectlList("");

      lc_lightbox('.elem', {
		wrap_class: 'lcl_fade_oc',
		gallery : true,	
		thumb_attr: 'data-lcl-thumb', 
		
		skin: 'minimal',
		radius: 0,
		padding	: 0,
		border_w: 0,
	});	
	

	
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
  
  
  function getFileNameForFR(){
      var projectIDForFR = $('#projectIDForFR').val();
      if(projectIDForFR == ""){
          alert("Please select project frist");
          $('#projectIDForFR').focus();
          return false;
      }
      
      var files = document.getElementById("imageInput").files;
      if (files.length > 0) {
          
          
           var postData = {
                function: 'SignatureAlbum',
                method: "getFileNameForFR",
                projectID: projectIDForFR,
              
            }
          
            $.ajax({
                url: '/admin/ajaxHandler.php',
                type: 'POST',
                data: postData,
                dataType: "json",
                success: function (data) {
            //   console.log(data);
                    if (data.status == 1) {
                        
                        getMatchedFaces(data.data['proj_folder_path']);
                       
                    }
                   
                },
                error: function (x,h,r) {
                //called when there is an error
                    console.log(x);
                    console.log(h);
                    console.log(r);
                   
                }
            });
          
          
          
          
      }else{
          alert("Please upload image");
          $('#imageInput').focus();
          return false;
      }
      
      
      
  }
  
  
  function getMatchedFaces(fileName){
      
      
     // Replace this with your Flask API endpoint
        var apiUrl = 'http://127.0.0.1:5000/detectfaces';

        // Replace this with the data you want to send in the POST request
        var postData = {
            fileName: 'yourFileName'
        };

        // Fetch data from the Flask API using a POST request
        fetch(apiUrl, {
            method: 'POST',
            mode: 'no-cors', // Set the request mode to 'no-cors'
            headers: {
                'Content-Type': 'application/json',
                // Add any additional headers if needed
            },
            body: JSON.stringify(postData),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Handle the data from the Flask API
            console.log(data);
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });
      
      
      return false;
      
      
      
      var files = document.getElementById("imageInput").files;
      
     var postData = {
        fileName: fileName,
    };
    
    $.ajax({
        url: 'http://127.0.0.1:5000/detectfaces/',
        type: 'POST',
        data: postData,
        dataType: "json",
        success: function (data) {
            console.log(data);
        },
        error: function (xhr, status, error) {
            // Log the details of the error
            console.log("XHR:", xhr);
            console.log("Status:", status);
            console.log("Error:", error);
        },
        // Additional settings for handling HTTPS
        xhrFields: {
            withCredentials: true
        },
        crossDomain: true,
    });

      
  }
  
  
  	
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
        var imageCount = $('#imageCount_'+id).val();
        
         var postData = {
            function: 'AlbumSubscription',
            method: "quantityValSetSA",
            quantity: quantity,
            albumType: "SA",
            imageCount:imageCount,
           
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