<?php 
include("admin/config.php");
include("get_session.php");

$albums = [];
$albumIdString = base64_decode($_REQUEST['albumId']);
$arr = explode('_', $albumIdString);
$albumId = $arr[1];

$DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);



    $sql = "SELECT *, E.id album_id , (SELECT COUNT(*) FROM tbevents_views
    WHERE project_id = E.id) AS viewCounts 
        FROM tbevents_data E
        JOIN tbeevent_files F ON(F.event_id = E.id)
        WHERE E.deleted = 0 AND E.id =$albumId ";

    $result = $DBC->query($sql);

    $count = mysqli_num_rows($result);

    $tmpData = [];

    if($count > 0) {		
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($albums,$row);
        }
    }


$imageURL = baseurl();
$baseURL = baseurl();
$token = '';

$user_id = 29 ;

// var_dump($albums);
// die($imageURL);

?>

<html lang="en">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Machooos International</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link href="admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="./css/plugins.css">
        <link type="text/css" rel="stylesheet" href="./css/style.css">
        <link type="text/css" rel="stylesheet" href="./css/color.css">
        <link rel="stylesheet" href="./css/lc_lightbox.css" />
        <!--<link rel="stylesheet" href="./skins/minimal.css" />-->
        <link type="text/css" rel="stylesheet" href="./admin/assets/css/select2.css">
        <link rel="stylesheet" href="./css/justifiedGallery.min.css" />
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="images/favicon.ico">
        <script  src="./js/jquery.min.js"></script>
    

<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="wow_book/wow_book.css" type="text/css" />
<link rel="stylesheet" href="css/main.css">

<script src="js/vendor/modernizr-2.7.1.min.js"></script>
<script type="text/javascript" src="wow_book/pdf.combined.min.js"></script>
<script src="wow_book/wow_book.min.js"></script>

</head>

<style>
    .demo-msg {
        display: none !important;
    }

    .flipwrap {
        height: 50vh;
        width: 95%;
        margin: 20px auto 100;
        box-shadow: 0 0 5px black;
        display: flex;
        align-items: center;
    }

    .content-holder {
        padding-top: 10px;
    }

    .hero-title {
        padding-bottom: 10px;
    }

    .wowbook-lightbox {
        background: #000000D0 !important;
    }

    
.wowbook-lightbox > .wowbook-close {
    background: none;
    border: none;
    top: 20px;
    right: 20px;
    font-size: 42px;
    color: white;
}

.event-list {
    display: inline-block;
    margin: 20px auto;
}

.eventitem-wrapper {
    cursor: pointer;
    border: solid 1px #dedede;
    border-radius: 2px;
    padding: 10px;
    max-width: 150px;
}

.event-item-img img {
    width: 100%;
}

.event-item-label {
    text-align: center;
    padding-top: 10px;
}

.no-eventitem-wrapper {
    color: #DEDEDE;
    font-size: 74px;
    padding: 10px 50px;
}

</style>
<body>

<div id="wrapper">



               
                    
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content">
                        <div class="post_header fl-wrap">
                            <div class="container">
                               

                        <!-- container-->
                        <div style="padding-top: 30px;">
                            <div class="fl-wrap content-item sec-anim"   >
                              

                                <div class="row fl-wrap" id="userProjectListDiv">
                                <?php if(count($albums) > 0) {
                                                foreach ($albums as $key => $album) { ?>

                                                


                                                     <div class="col-sm-3" >
                                                        <div class="post-item_wrap fl-wrap" >
                                                            <div class="post-item_media fl-wrap"><img src="admin/<?= EVENT_UPLOAD_PATH. $album['uploader_folder'].'/'.$album['covering_name'] ?>" alt="" width="100%"></div>
                                                            <div class="post-item_content fl-wrap">
                                                                <h3 class="text-white"><?= $album['event_name'] ?> </h3>
                                                               

                                                                    <a href="#" id="show_book_<?= $album['album_id'] ?>" class="single-btn fl-wrap"><span>View Album</span></a>
                                                               
                                                                  

                                                                
                                                            </div>
                                                        </div>
                                                        </div>


                                                    <?php 
                                                    if($key == 0) $imageURL .= '/admin/'.EVENT_UPLOAD_PATH. $album['uploader_folder'].'/'.$album['covering_name'];
                                                }
                                            } else { ?>
                                               
                                               
                                            <?php } ?>

                                </div>


                              
                              
                            </div>
                            <!-- section end-->
                        </div>
                        <!-- container end--> 



                        <div class="event-albums">
                            <?php foreach ($albums as $key => $album) { 
                                if($album['pdffile_name'] == 'folder') { ?>
                                    <div id="book_<?= $album['album_id'] ?>">
                                        <?php
                                            $arrFiles = array();
                                            $dpath = 'admin/'.EVENT_UPLOAD_PATH. $album['uploader_folder'];
                                            $handle = opendir($dpath);
                                            if ($handle) {
                                                while (($entry = readdir($handle)) !== FALSE) {
                                                    $arrFiles[] = $entry;
                                                }
                                            }
                                            closedir($handle);
                                            // unset($arrFiles[0]);
                                            $arrFiles = array_slice($arrFiles, 2); 
                                            
                                            foreach ($arrFiles as $key => $value) {
                                                echo '<div><img src="'.$dpath.'/'.$value.'" alt=""></div>';
                                            }
                                        ?>
                                        
                                    </div>
                                <?php } else { ?>
                                    <div id="book_<?= $album['album_id'] ?>"></div>
                                <?php }
                            } ?>
                        </div>




                        
                    </div>
                   
                </div>
                <!-- content-holder end -->
 








<script>
    $(function(){

        // Using window.innerWidth
        var screenWidth = window.innerWidth;
        var screenHeight = window.innerHeight;
        console.log(screenWidth, screenHeight);

        <?php foreach ($albums as $key => $album) { ?>
            var albumHeight = <?= ($album['album_height'] != '' ? $album['album_height']: 1024)  ?>;
            var albumWidth = <?= ($album['album_width'] != '' ? $album['album_width']: 768) ?>; // * 2;
            
            console.log('actual album => ' + albumWidth + 'X' + albumHeight);

            if(albumHeight > screenHeight || albumWidth > screenWidth) {
                hRatio = parseFloat(screenHeight) / parseFloat(albumHeight);
                wRatio = parseFloat(screenWidth) / parseFloat(albumWidth);

                if(hRatio > wRatio) {
                    albumWidth = screenWidth;
                    albumHeight = parseInt(parseFloat(albumHeight) * wRatio);
                } else {
                    albumHeight = screenHeight;
                    albumWidth = parseInt(parseFloat(albumWidth) * hRatio);
                }
            }
            
            console.log('corrected album => ' + albumWidth + 'X' + albumHeight);
            console.log('Screen => ' + screenWidth + 'X' + screenHeight);

            var bookOptions_<?= $album['album_id'] ?> = {
                height   : albumHeight
                ,width    : albumWidth*2 + 500
                ,scaleToFit: ".event-albums"

                ,centeredWhenClosed : true
                ,hardcovers : true
                ,toolbar : "lastLeft, left, right, lastRight, zoomin, zoomout, slideshow, flipsound, fullscreen, thumbnails, download"
                ,thumbnailsPosition : 'bottom'
                ,responsiveHandleWidth : 50
                ,responsiveSinglePage: true
                ,lightbox: "#show_book_<?= $album['album_id'] ?>"
                ,lightboxColor: "#eee"
                ,toolbarPosition: "bottom"
                <?php if($album['pdffile_name'] != 'folder') { 
                    $dpath = 'admin/'.EVENT_UPLOAD_PATH. $album['uploader_folder'];
                    ?>
                    ,pdf: "<?= $dpath. '/'. $album['pdffile_name'] ?>"
                <?php } ?>
            };

            $('#book_<?= $album['album_id'] ?>').wowBook( bookOptions_<?= $album['album_id'] ?> );
        <?php } ?>

    })
</script>

 <!--=============== scripts  ===============-->  
 <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script  src="./admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> -->
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap-datepicker.js"></script>
<script  src="./js/plugins.js"></script>
<script  src="./js/scripts.js"></script>
<script  src="./js/appbase.js"></script>
<script  src="./js/lc_lightbox.lite.js" type="text/javascript"></script>
<script  src="./js/sharer.min.js"></script>
<script  src="./admin/assets/js/select2.js"></script>
<script  src="./js/jquery.justifiedGallery.min.js"></script>
<script  src="./js/jquery.emojiarea.js"></script>
<script src="admin/assets/js/sweetalert/sweetalert2.min.js"></script>
<link href="admin/assets/js/sweetalert/sweetalert2.dark.css" rel="stylesheet">
<script src="admin/assets/js/sweetalert/MySweetAlert.js"></script>
<script  src="./js/bootstrap-select.min.js"></script>
<script  src="./js/infinityScroll.min.js"></script>
<script  src="./js/jquery.imagesloaded.min.js"></script>

<script>
    $(document).ready(function(){
        var showalbumId = <?=$albumId?>;
        $('#show_book_'+showalbumId).trigger('click');

    });

</script>