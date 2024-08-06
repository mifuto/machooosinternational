<?php 

include("config.php");
// echo $contact_user_id;
?>
<!DOCTYPE HTML>
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
    </head>
    <body>
        <!--loader-->
        <div class="main-loader-wrap">
            <div class="loading-text-container ">
                <span class="loading-text">Load<strong>ing</strong></span> 
                <div class="loader_count_wrap">
                    <div class="loader_count">0</div>
                </div>
            </div>
        </div>
        <!--loader end-->
        <!--  main start  -->
        <div id="main">
            <input type="hidden" value="<?php echo $contact_user_id; ?>" id="loggedUserId">
            
            <!--  header main-header  -->
            <header class="main-header">
                <a href="index.php" class="ajax logo-holder"><img src="images/logo.png" alt=""></a>
                <?php
                // echo basename($_SERVER['PHP_SELF']);
                    if($contact_user_id){
                        echo '<div class="hero-title" style="position: absolute; right: 3%; color: #0e0e0e;top: 9%;"><h4>Loged in as '.$logedUser.'</h4></div><div class="sb-button" style="height: 33px; line-height: 32px; margin-top: 9px;" onclick="logout();">Sign Out</div>';
                    }else{
                        echo '<div class="sb-button c_sb" style="height: 33px; line-height: 32px; margin-top: 9px;">Sign In</div>';
                    }
                ?>
             	
                 <?php 
                                // $top = 'top: 5%';
                                // if(basename($_SERVER['PHP_SELF']) == "index.php"){
                                //     $top = 'top: 18%';
                                // }
                                // if($contact_user_id){
                                    
                                //     echo '<div class="hero-title" style="position: absolute; z-index: 999; right: 4.2%; color: #804bd8; '.$top.';"><h4>Loged in as '.$logedUser.'</h4></div>';
                                // }else{
                                //     echo '<div class="hero-title" style="position: absolute; z-index: 999; right: 4.2%; color: #804bd8; '.$top.';"><h4>Loged in as '.$logedUser.'</h4></div>';
                                // }
                            ?>
                <!-- <div class="sb-button c_sb"><span></span></div> -->
                <!-- <div class="sb-button showLogin"><span></span></div> -->
                <div class="nav-button-wrap">
                    <div class="nav-button"><span></span><span></span><span></span></div>
                </div>
                <!--  navigation -->
                <div class="nav-holder main-menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php" class="act-link ajax">Home </a>
                            </li>
                            
                            <li>
                                <a href="about.php" class="ajax">About</a>
                            </li>
                            <!--<li>-->
                            <!--    <a href="stories.php" class="ajax">Stories</a>-->
                            <!--</li>-->
                            <li>
                                <a href="contacts.php" class="ajax">Contacts</a>
                            </li>
                            <li>
                                 <a href="javascript:void(0)">Pages </a>
                                <ul>
									<li><a href="portfolio-single3.php" class="ajax"> Cinematography</a></li>
                                    <!--<li><a href="blog_01.php" class="ajax">Blog Details</a></li>-->
                                </ul>
                            </li>
                            <?php
                                if($contact_user_id){
                            ?>
                           
                            <li>
                                 <a href="javascript:void(0)">Albums </a>
                                <ul>
									<li><a href="online-album.php" class=""> Online Album</a></li>
                                    <!--<li><a href="signature_album.php?uid=<?php echo base64_encode($contact_user_id); ?>" class="" >Signature Album</a></li>-->
                                    <li><a href="signature_album_sa.php?uid=<?php echo base64_encode($contact_user_id); ?>" class="" >Signature Album</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="crm" class="" target="_blank" style="top: 0;background: #000;color: #fff;line-height: 20px; padding-right: 20px;padding-left: 20px;">CRM </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li>
                            
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- navigation  end --> 
                
            </header>
            <!-- Header   end-->
            
            <!-- wrapper -->
            <div id="wrapper">
            		