<?php

 include("../admin/config.php");
include("../get_session.php");

$user_data = get_session();
  
 $DBC = mysqli_connect(HOST, DB_USER, DB_PASS,DB_NAME);

if(isset($user_data['userID']) && $user_data['userID'] > 0) {
    $user_id = $user_data['contact_user_id'];
    
    $main_user_id = $user_data['main_user_id'];
 
    
   $logginUserName = $user_data['firstname']." ".$user_data['lastname'];
} else {
    header("location: /index.php");
}


$isWeddingUser = false;
$isWeddingUserDate = '';
$userWeddingDatas = [];


$sql3 = "SELECT a.id,a.name, a.start_date, a.clientid ,b.firstname , b.lastname, b.email, b.phonenumber FROM tblprojects a left join tblcontacts b on a.clientid = b.userid where b.userid='$user_id' and a.start_date <= CURDATE() order by a.id asc ";
// $sql3 = "SELECT a.id,a.name, a.start_date, a.clientid ,b.firstname , b.lastname, b.email, b.phonenumber FROM tblprojects a left join tblcontacts b on a.clientid = b.userid where a.start_date <= CURDATE() order by a.id asc ";

$userHaveEvent = 0;

$result3 = $DBC->query($sql3);

$count3 = mysqli_num_rows($result3);

if($count3 > 0) {		
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $nameW = $row3['name'];
        $userHaveEvent = 1;
        
        // if (stripos($nameW, "Wedding") !== false) {
        //     $isWeddingUser = true;
        //     array_push($userWeddingDatas,$row3);
        //     $isWeddingUserDate = $row3['start_date'];
        // }
        
      
    }
}

// $isWeddingUser = true;
// $isWeddingUserDate = '2020-06-02';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
   <meta charset="UTF-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Machooos International</title>
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
            <meta name="MachooosInterational" content="Kerala wedding photography,Best wedding photographers in Kerala,Professional wedding photography Kerala,Kerala destination wedding photographers
Candid wedding photographers Kerala,Traditional wedding photography Kerala,Kerala wedding photography packages,Top wedding photographers in Kerala,Kerala wedding photojournalists,Wedding videography Kerala,Pre-wedding photoshoot Kerala,Kerala bridal photoshoot,Outdoor wedding photography Kerala,Creative wedding photographers in Kerala,Kerala wedding photography prices,Kerala wedding album design,Kerala wedding cinematography,South Indian wedding photography Kerala,Best wedding venues in Kerala for photography,Kerala wedding photography ti, Kerala kids photography,ernakulam kids phtography,trivandrum kids photography,trivandrum baby photographer,trivandrum birthday photographer,trivandrum newborn baby photographer,trivandrum kids props rent, trivandrum newborn baby props rent,kochi birthday photographer,kochi birthday event planner,birthday photographer,kids only,premium wedding photographer ernakulam,premium wedding photographer kochi, premium wedding photographer trivandrum,No1 wedding photographer ernakulam,No1 wedding photographer kochi,No1 wedding photographer kerala,No1 wedding photographer trivandrum,No1 wedding photographer india,Online album wedding company,">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="shortcut icon" href="/images/favicon.ico">
  
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

  
    <!--=============== css  ===============-->	
        <!--<link href="/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <!--<link type="text/css" rel="stylesheet" href="/css/plugins.css">-->
        <!--<link type="text/css" rel="stylesheet" href="/css/style.css">-->
        <link type="text/css" rel="stylesheet" href="/css/color.css">
        <!--<link rel="stylesheet" href="/css/lc_lightbox.css" />-->
        <!--=============== favicons ===============-->

</head>

<style>

/*------ footer------------------------------------------------------*/
.main-footer {
	background: #151515;
	padding: 90px 0;
	position: relative;
	width: 100%;
}
.main-footer:before {
	content: '';
	position: absolute;
	top: 0;
	left: 50%;
	height: 80px;
	width: 1px;
	background: rgba(255,255,255,0.1);
}
.policy-box {
	float: left;
	color: #fff;
	text-transform: uppercase;
    font-size: 10px;
    font-weight: 500;
    letter-spacing: 2px;
}
.footer-social {
	float: right;
}
.footer-social li   {
	float: left;
	margin-left: 20px;
}
.footer-social li a   {
 	position: relative;
	color: #fff;
	font-size: 13px;
}
.to-top-btn {
	position: absolute;
	bottom: 0;
	left: 50%;
	width: 40px;
	height: 60px;
	line-height: 60px;
	color: #fff;
	z-index: 10;
	margin-left: -20px;
	cursor: pointer;
}
.to-top i {
    position:relative;
    top: 0;
    transition: all 200ms linear;
}
.to-top:hover i {
     top:-8px;
}


#footer-twiit div.user {
	margin-bottom:10px;
	font-size:11px;
	font-style:italic;
}
#footer-twiit div.user a {
	color:#666;
}
#footer-twiit div.user img {
	display:none;
}
#footer-twiit {
	text-align:left;
}
#footer-twiit p.interact {
	 float:left;
	 width:100%;
	 margin:0 0 5px;
}
#footer-twiit p.interact a {
	float:left;
	color:#fff;
	margin-right:10px;
	background:#292929;
	padding:3px 10px;
	font-size:10px;
	font-weight:500;
}
#footer-twiit p.interact a:hover {
	color:#888;
}
#footer-twiit ul li {
	margin-bottom:20px;
	float:left;
	width:100%;
	padding-bottom:10px;
	border-bottom:1px solid #eee;
}
#footer-twiit ul li:last-child {
	border-bottom:none;
	padding-bottom:0;
	margin-bottom:0;
}
#footer-twiit p.tweet {
	text-align:left;
	font-size: 12px;
	padding: 15px 25px;
	background: #f9f9f9;
	font-family: Montserrat,sans-serif;
}
#footer-twiit p.tweet a:hover {
	color:#888;
}
#footer-twiit  .timePosted a {
	color:#999;
	font-style:italic;
	text-align:left;
	margin-top: 10px;
	display: block;
}
</style>







<body>
    
    
    
  <div class=" container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="bg-white text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="/index.php"><img src="/images/logo.png" /></a>
        <a class="navbar-brand brand-logo-mini" href="/index.php"><img src="/images/machooos-img-dis-logo.png" alt=""></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
          <span class="navbar-toggler-icon"></span>
        </button>
        
         <ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
          <li class="nav-item">
            <a class="nav-link profile-pic" href="#">Welcome: <span class="text-muted"><?=$logginUserName?></span></a>
          </li>
         
        </ul>
       
       
        <button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
        <nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
         
          <ul class="nav">
            <li class="nav-item "  id="menu1">
              <a class="nav-link" href="index.php">
                <img src="images/icons/1.png" alt="">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            
            <li class="nav-item " id="menu3">
              <a class="nav-link " href="address.php"  >
                <img src="images/icons/002-placeholder.png" alt="">
                <span class="menu-title">Address</span>
              </a>
            </li>
            
            <li class="nav-item " id="menu5">
              <a class="nav-link " href="cart.php"  >
                <img src="images/icons/cartpng.png" alt="">
                <span class="menu-title">Cart</span>
              </a>
            </li>
            
              <li class="nav-item" id="menu2">
              <a class="nav-link" href="orders.php"  >
                <img src="images/icons/008-list.png" alt="">
                <span class="menu-title">Orders</span>
              </a>
            </li>
            
          
            <!-- <li class="nav-item" id="menu4">-->
            <!--  <a class="nav-link " href="my-cards.php"  >-->
            <!--    <img src="images/icons/card.png" alt="">-->
            <!--    <span class="menu-title">My card</span>-->
            <!--  </a>-->
            <!--</li>-->
         
           
            
            
            
            <!--  <li class="nav-item" id="menu8">-->
            <!--  <a class="nav-link" href="purchased-cards.php"  >-->
            <!--    <img src="images/icons/card01.png" alt="">-->
            <!--    <span class="menu-title">Purchased Cards</span>-->
            <!--  </a>-->
            <!--</li>-->
            
            <li class="nav-item ">
              <a class="nav-link" href="/index.php">
                <img src="images/icons/4.png" alt="">
                <span class="menu-title">Home</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="logout();" >
                <img src="images/icons/003-outbox.png" alt="">
                <span class="menu-title">Logout</span>
              </a>
            </li>
            
           
          </ul>
        </nav>
        
        
        