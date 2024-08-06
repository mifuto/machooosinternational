<?php 

include("admin/config.php");
include("get_session.php");

$user_data = get_session();
$events = [];
$events1 = [];
$events2 = [];



$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $user_id = $user_data['contact_user_id'];
    
    $isNorec = true;
    

    $sql = "SELECT DISTINCT a.id, a.project_name,0 as selType FROM tbesignaturealbum_projects a left join tbesignaturealbum_data b on a.id = b.project_folder_id WHERE a.user_id=$user_id and b.deleted=0 and b.completeImgSel = 5 and a.deleted = 0 ORDER BY a.project_name ASC";
    
     $result3 = $DBC->query($sql);

    $count3 = mysqli_num_rows($result3);

    if($count3 > 0) {
        $isNorec = false;
        
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($events2,$row3);
            
        }
    }
    
    
     $sql1 = "SELECT DISTINCT a.id, a.project_name,1 as selType FROM tbesignaturealbum_projects a left join tbesignaturealbum_data b on a.id = b.project_folder_id left join tbesignaturealbum_subuser_data c on c.album_id = b.id WHERE c.user_id=$user_id and b.deleted=0 and c.completeImgSel = 5 and a.deleted = 0 ORDER BY a.project_name ASC";
    
     $result31 = $DBC->query($sql1);

    $count31 = mysqli_num_rows($result31);

    if($count31 > 0) {
        $isNorec = false;
        
        while ($row31 = mysqli_fetch_assoc($result31)) {
            array_push($events1,$row31);
            
        }
    }
    
    $events = array_merge($events2, $events1);
  
    
    if($isNorec) {
        header("location: index.php");
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
        
        .eventactive{
            color: black !important;
            background: #D3D3D3 !important;
        }
        
        .eventinactive{
            color:#6b6b6b !important;
            background: transparent !important;
        }
        
        .rem-masonry li img {
    width: 100%;
    height: auto;
    display: block;
    cursor: pointer;
}
        
        
        
        
        
        
</style>


 <style>
        #signatureAlbumTabs .nav-link.active {
          /* Add your desired styles here */
          color: black !important;
          background: #D3D3D3 !important;
        }
        
        /* Default styles for the button (website view) */
        #saveCommentsButton {
          padding: 10px;
          width: 25%;
          margin: 0;
        }
        
        /* Media query for mobile devices with a maximum width of 767px */
        @media (max-width: 767px) {
          #saveCommentsButton {
            width: 50%;
          }
        }
        
         /* Default styles for the button (website view) */
        #updateCommentsButton {
          padding: 10px;
          width: 25%;
          margin: 0;
        }
        
        /* Media query for mobile devices with a maximum width of 767px */
        @media (max-width: 767px) {
          #updateCommentsButton {
            width: 50%;
          }
        }
        
        /* Add a class to style the sticky header */
        .sticky-header {
            position: sticky;
            top: 0%;
            background-color: #f1f1f1; /* Add your preferred background color */
            z-index: 100; /* Make sure the header appears above other content */
        }
        
      

        /* Add some styling to the nav tabs for demonstration purposes */
        .nav-tabs {
            background-color: #ffffff; /* Add your preferred background color */
            border-bottom: 1px solid #ccc; /* Add a border to separate the header from the content */
        }

        /* Add some styling to the tab items for demonstration purposes */
        .nav-item {
            margin-right: 10px;
        }
        
        
      
        
    </style>
    
  

<style type="text/css">


.swal2-input {
  color: white;
}

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
        padding-left: 1.5%;
        padding-right: 1.5%;
        padding-top: 3%; 
        margin: 0; 
        width: 100%;
        -webkit-transition:1s ease all;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        /* box-shadow: 2px 2px 4px 0 #ccc; */
    }

    .masonry { /* Masonry container */
        -webkit-column-count: 5;
    -moz-column-count:5;
    column-count: 5;
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
    .image figcaption{
position: absolute;
top: 50%;
bottom: 50%;
left: 40%;
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
    @media (min-width:320px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid transparent;
            padding: 0px 3px;
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            cursor: pointer;
            z-index: 9;
            font-size: 16px;
            color: #ccc;
            height: 22px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:480px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid transparent;
            padding: 0px 3px;
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            cursor: pointer;
            z-index: 9;
            font-size: 16px;
            color: #ccc;
            height: 22px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:600px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid transparent;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #ccc;
            height: 32px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:801px)  {
        .btPpop{
            border-radius: 50%;
            border: 1px solid transparent;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #ccc;
            height: 32px;
        }
        .commentsListDiv{
            width: 100%;
        }
    }
    @media (min-width:1025px) {
        .btPpop{
            border-radius: 50%;
            border: 1px solid transparent;
            padding: 0px 4px;
            position: absolute;
            top: 15px;
            right: 15px;
            background: transparent;
            cursor: pointer;
            z-index: 9;
            font-size: 22px;
            color: #ccc;
            height: 32px;
        }
        .commentsListDiv{
            width: 60%;
        }
    }
    .subMenu{
        font-size: 16px;
        color: #8391a1;
        /* border-right: 1px solid #ccc; */
        padding: 10px;
    }
    .mainCommentFormTextarea .emoji-picker-icon{
        left: 20px !important;
    }
    
    
    .portfolio-menu{
	text-align:center;
}
.portfolio-menu ul li{
	display:inline-block;
	margin:0;
	list-style:none;
	padding:10px 15px;
	cursor:pointer;
	-webkit-transition:all 05s ease;
	-moz-transition:all 05s ease;
	-ms-transition:all 05s ease;
	-o-transition:all 05s ease;
	transition:all .5s ease;
}

.portfolio-item{
	/*width:100%;*/
}
.portfolio-item .item{
	/*width:303px;*/
	float:left;
	margin-bottom:10px;
}
</style>

<script>
     function fristLoad(id,selType){
            window.onload = function() {
                // Your JavaScript code to run before the page finishes loading
                getuSignatureAlbums(id,selType);
            };
        }
        
</script>
    

                <!-- content-holder -->
                <input type="hidden" value="<?php echo $user_id; ?>" id="lsignatureAlbumUserId">
            
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        
                        
                        
                        <div class="post_header fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-title alighn-title" style="padding: 0px;">
                                            <!--<h4>The Studio</h4>-->
                                            <h2>Selected Images</h2>
                                        </div>
                                    </div>
                                </div>
                                
                        <div class="clearfix"></div>

                         <!-- container-->
                         <div style="padding-top: 0px;padding-bottom: 30px;">
                             
                             
                             <?php if(count($events) >= 2) { ?>
                             
                             
                             
                                <div class="row">
                                    <div class="col-12 text-center my-2">
                                        <h3 class="img-heading" style="padding-top:10px;font-size: 1.0rem !important;font-weight: 500 !important;letter-spacing: .06rem !important;color: black;">Project</h3>
                                    </div>
                                 </div>
                                 <div class="portfolio-menu mt-2 mb-4">
                                    <ul>
                                        
                                        
                                        <?php
                                            $callFn = true;
                                            foreach ($events as $key => $ev) { 
                                                $project_id = $ev['id'];
                                                $project_name = $ev['project_name'];
                                                $selType = $ev['selType'];
                                                
                                                
                                                if($callFn){
                                                    echo '<script>';
                                                    echo 'fristLoad(' . $project_id . ','.$selType.');';
                                                    echo '</script>';
                                                }
                                               
                                                
                                        ?>
                                        
                                        <li class="btn btn-outline-dark <?php if($callFn) echo 'active'; ?>" name="projectBtn" id="projectBtnId_<?=$project_id?>" onclick="changeProject(<?=$project_id?>,<?=$selType?>)"><?=$project_name?></li>
                                            
                                        <?php  $callFn = false; } ?>
                                        
                                      
                                       
                                    </ul>
                                 </div>
                             
                             
                           
                             
                             <? }else{
                                 
                                echo '<script>';
                                echo 'fristLoad(' . $events[0]['id'] . ',' . $events[0]['selType'] . ');';
                                echo '</script>';

                                 
                             } ?>
                             
                             
                                <div style="padding-top: 20px;">
                                                                
                                    <ul class="nav nav-tabs" id="signatureAlbumTabs" role="tablist" style="border-radius: 5px;"></ul>
                                    
                                </div>
                                
                                 <div style=" background-color: #f9f9f9;">
                                     
                                    <div class="tab-content pt-2" id="signatureAlbumTabContent" >
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
</style>

<style>
        /* Add a CSS rule to change the cursor to a pointer on hover */
        a:hover {
            cursor: pointer;
        }
    </style>

<script>

$('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').addClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
        
  
  $( document ).ready(function() {
      
    //   getuSignatureAlbums(67);
   
      lc_lightbox('.elem', {
		wrap_class: 'lcl_fade_oc',
		gallery : true,	
		thumb_attr: 'data-lcl-thumb', 
		
		skin: 'minimal',
		radius: 0,
		padding	: 0,
		border_w: 0,
	});	
      
  });
  
  function changeProject(id,selType){
      
      var elements = document.querySelectorAll('[name="projectBtn"]');

    // Loop through the elements and remove the "active" class
    elements.forEach(function(element) {
        element.classList.remove('active');
    });
      
      $('#projectBtnId_'+id).addClass('active');
      getuSignatureAlbums(id,selType);
  }
  
  
  
  
  function getuSignatureAlbums(projId,selType) {
      
      
      
      
    successFn = function(resp)  {
        
      var users = resp["data"];
      var tabsTitle = "";
      var tabContents = "";
      var count = 0; 
      console.log(users);
        if(users != ""){

            var ValufolderName = "";
            var user = "";
            var albumId = "";
            var imgPth = "";

            $.each(users, function(key,value) {

                var active = "";
                var tabTactive = "";
                var folder_name_str = "'"+value.folder_name+"'";
                var folder_name_str = "'"+value.file_folder+"'";
                if(count == 0){
                    active = "show active";
                    tabTactive = "show active";
                }
                console.log("11111", value.user_id);
                var jjj = value.folder_name;

                var valuefolder_name = value.folder_name.replace(/\s/g,'');
                
              
                        tabsTitle += '<li class="nav-item" role="presentation" style="margin-right: 0px !important;white-space: nowrap;--bs-btn-padding-x: 0.25rem !important;"><button class="sa-tab-text nav-link '+active+'" id="b-'+value.id+'-tab" data-bs-toggle="tab" data-bs-target="#b-'+value.id+'" type="button" role="tab" aria-controls="b-'+value.id+'" aria-selected="true" onclick="getAlbumFiles(\''+jjj+'\', '+value.user_id+', '+value.id+',`'+value.cover_image_path+'`,1,'+projId+','+selType+')" style=" color: #6b6b6b;">'+value.folder_name+'  ';
                        tabsTitle += '</button></li>';
                        
                        
                   
                var folder_name = value.folder_name+"_"+value.id;
             
                tabContents += '<div class="tab-pane fade '+tabTactive+'" role="tabpanel" id="b-'+value.id+'"></div>';

                if(count == 0){
                    ValufolderName = valuefolder_name;
                    user = value.user_id;
                    albumId = value.id;
                    imgPth = value.cover_image_path ;
                }
              
                count++;
            });
            
            $("#signatureAlbumTabContent").html(tabContents);
            
            getAlbumFiles(ValufolderName, user, albumId,imgPth,1,projId,selType);
          

        }

      $("#signatureAlbumTabs").html(tabsTitle);
   

    }
   
    data = { "function": 'SignatureAlbum',"method": "getProjectEventsForSel", 'projId': projId ,'selType':selType , 'user_id':'<?=$user_id?>' };

    apiCall(data,successFn);
}

function enableMulDlt(albumId){
    $('#enableDltBtn_'+albumId).addClass('d-none');
    $('#mulDltBtn_'+albumId).removeClass('d-none');
    $('#disableDltBtn_'+albumId).removeClass('d-none');
    
    $('[name="multipleImgSelectionChk"]').removeClass('d-none');
    $('[name="3dotDiv"]').addClass('d-none');
    
}

function disableMulDlt(albumId){
    $('#enableDltBtn_'+albumId).removeClass('d-none');
    $('#disableDltBtn_'+albumId).addClass('d-none');
    $('#mulDltBtn_'+albumId).addClass('d-none');
    
    $('[name="multipleImgSelectionChk"]').addClass('d-none');
    $('[name="3dotDiv"]').addClass('d-none');
    $('[name="3dotDiv"]').removeClass('d-none');
    
}
  
function deleteMultipleImage(folder, userId, albumId,imgPth, startVal,projId,selType){
   
    var checkedValues = [];

    // Find all checkboxes with the name "multipleImgSelectionChk" that are checked
    $('input[name="multipleImgSelectionChk"]:checked').each(function() {
      // Add the value of each checked checkbox to the array
      checkedValues.push($(this).val());
    });
    
    if(checkedValues == ""){
       
        swal.fire({
            icon: 'error',
            title: "error",
            text: "Please select atleast one image",
            showConfirmButton: false,
            timer: 1500
        });
        
        return false;
    }
    
    
    return new swal({
        title: "Are you sure?",
        text: "You want to remove this ("+checkedValues.length+") images, Images are not removed from your signature album.",
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
                       
                        
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Images are removed from your image selection",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        
                        getAlbumFiles (folder, userId, albumId,imgPth, startVal,projId,selType);
                       
                        $('#enableDltBtn_'+albumId).removeClass('d-none');
                        $('#disableDltBtn_'+albumId).addClass('d-none');
                        $('#mulDltBtn_'+albumId).addClass('d-none');
                        $('[name="3dotDiv"]').removeClass('d-none');
                        $('[name="multipleImgSelectionChk"]').addClass('d-none');
                        
                    }else{
                       
                        swal.fire({
                            icon: 'error',
                            title: "error",
                            text: "Failed to remove images",
                            showConfirmButton: false,
                            timer: 2000
                        });
                      
                    }
                    
                }
                data = { "function": 'SignatureAlbum',"method": "removeMulFrmList" ,"imgID":checkedValues , 'user_id':'<?=$user_id?>','selType':selType };
                apiCall(data,successFn);
                
            }
    });
    
    
    
    
    
    
}
  
  function getAlbumFiles (folder, userId, albumId,imgPth, startVal=1,projId,selType){
      

    var tabContentsDiv = '<div class="row " style="padding: 10px;"><div class="col-md-4 col-sm-12" align="left"><div class="badge bg-info text-dark " >Total selected images : <label id="imgC_'+albumId+'"></label></div></div> <div class="col-md-8 col-sm-12" align="right"><a onclick="enableMulDlt('+albumId+');" id="enableDltBtn_'+albumId+'"><div class="badge bg-danger text-white " style="padding:10px;">Select multiple images</div></a>  <a class="d-none" onclick="deleteMultipleImage(`'+folder+'`, '+userId+', '+albumId+',`'+imgPth+'`, '+startVal+','+projId+','+selType+')" id="mulDltBtn_'+albumId+'"><div class="badge bg-danger text-white " style="padding:10px;">Remove selected images</div></a> <a class="d-none" onclick="disableMulDlt('+albumId+');" id="disableDltBtn_'+albumId+'"><div class="badge bg-warning text-white " style="padding:10px;">Cancel selecting</div></a>  <a onclick="addMoreImgs('+albumId+','+projId+','+selType+')"><div class="badge bg-primary text-white " style="padding:10px;">Add more</div></a> <a onclick="completeImageSel('+albumId+','+projId+','+selType+')"><div class="badge bg-success text-white " style="padding:10px;">Complete</div></a></div></div>';
    
    tabContentsDiv += '<div id="masonryGallery'+albumId+'"></div>';
    
    $("#b-"+albumId).html(tabContentsDiv);
    
    var img_folder = userId+"_"+folder;
    var file_folder = folder;
  
    var data = { "function": 'SignatureAlbum',"method": "getFilesFromFolderSel", "albumId": albumId ,"selType":selType , 'user_id':'<?=$user_id?>' };
   


        $.ajax({
            url: "admin/ajaxHandler.php",
            type:"POST",
            data : data,
            async: true,
            success: function(result){
                
             
                result=JSON.parse(result);
                var images = result.data;
               
                var gdggd = 0;
                $.each(images, function(key1,value1) {

                    var file_name = value1.file_name;
                    var file_path = value1.file_path;
                    var thumb_image_path = value1.thumb_image_path;
                    
                    if(value1.upload_server == 1){
                        var thumb_img = thumb_image_path;
                        var img = file_path;
                    }else{
                        var thumb_img = "admin/"+thumb_image_path;
                        var img = "admin/"+file_path;
                    }
                    
                    
                    // var thumb_img = "admin/"+thumb_image_path;
                    // var img = "admin/"+file_path;
                    var tabContents = '';
                    
                 
                   
                            tabContents += '<div class="grid-item">';
                            tabContents += '<a name="3dotDiv" class="nav-link nav-profile d-flex align-items-center btPpop" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical"></i></a>';
                            tabContents += '<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" >';

                            tabContents += '<li><a class="dropdown-item d-flex align-items-center" onclick="removeFrmList('+value1.id+',`'+folder+'`, '+userId+', '+albumId+',`'+imgPth+'`, '+startVal+','+projId+','+selType+');" ><i class="fas fa-undo"></i><span style="font-size: 12px; margin-left: 5px;">Remove from selected</span></a></li>';
                            
                            
                            
                            tabContents += '</ul>';
                            
                           
                            tabContents += '<a class="elem" href="'+img+'" title="'+file_name+'" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="'+img+'"><img src="'+thumb_img+'" class="image"></img></a>';
                            
                            
                            tabContents += '<input type="checkbox" value="'+value1.id+'"  name="multipleImgSelectionChk" class="d-none"  style="position: absolute; top: 5%; left: 10%; transform: translate(-50%, -20%); width: 20px; height: 20px;">';
                           
                            
                            
                            tabContents += '</div>';
                      
                    $("#masonryGallery"+albumId).append(tabContents);
                    
                    gdggd++;
                });
               
                 $("#masonryGallery"+albumId).justifiedGallery({ margins:0, lastRow : 'nojustify', rowHeight : 250});
                 
                 $('#imgC_'+albumId).html(gdggd);
               
               
            },
            error: function(result) {
                
            }
          });
          
}

function removeFrmList(id,folder, userId, albumId,imgPth, startVal,projId,selType){
    
     return new swal({
    title: "Are you sure?",
    text: "You want to remove this (1) image, Images are not removed from your signature album.",
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
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Image removed from your image selection.",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        
                        getAlbumFiles (folder, userId, albumId,imgPth, startVal,projId,selType)
                      
                        
               
            }
        }
        data = { "function": 'SignatureAlbum',"method": "removeFrmList" ,"imgID":id , 'user_id':'<?=$user_id?>','selType':selType };
        apiCall(data,successFn);
        
        
        }else{
            return false;
        }
    });
   
}

function addMoreImgs(id,projId,selType){
    successFn = function(resp)  {
         if(resp.status == 1){
                   var currentdate = Base64.encode(Date.now()+"_"+projId );  
                   window.location.href = "signature_album_sa.php?pId="+currentdate ;
        }
    }
    data = { "function": 'SignatureAlbum',"method": "addMoreSelImgs" ,"eventID":id,"selType":selType,'user_id':'<?=$user_id?>' };
    apiCall(data,successFn);
}

function completeImageSel(id,projId,selType){
    
    
     return new swal({
    title: "Comfirm",
    text: "Please pay attention! Once you click the complete button, your selected images page will disappear. So complete only after verifying the images, after completion contact us to see the images again +91980999533",
    icon: false,
    // buttons: true,
    // dangerMode: true,
    showCancelButton: true,
    confirmButtonText: 'Complete'
    }).then((confirm) => {
        // console.log(confirm.isConfirmed);
        if (confirm.isConfirmed) {
            
            if(selType == 0){
                successFn = function(resp)  {
                     if(resp.status == 1){
                         
                       
                        swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Successfully submit your selected images",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        window.location.reload();
                         
                       
                    }
                }
                data = { "function": 'SignatureAlbum',"method": "completeSelection" ,"albumId":id};
                apiCall(data,successFn);
            }else{
                
                successFn = function(resp)  {
                     if(resp.status == 1){
                         
                      
                          swal.fire({
                            icon: 'success',
                            title: "success",
                            text: "Successfully submit your selected images",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        
                        // Reload the current page
                        window.location.reload();

                         
                         
                    }
                }
                data = { "function": 'SignatureAlbum',"method": "completeSubuserSelection" ,"albumId":id,"userIdVal":'<?=$user_id?>' };
                apiCall(data,successFn);
                
                
            }
            
            
        }else{
            return false;
        }
    });
   
   
}
  
  
  
  
  
</script>