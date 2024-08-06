<?php 
session_start();
require_once("classes/DBConnection.php");

date_default_timezone_set ("Asia/Calcutta");
$today		=	Date('Y-m-j');
$nowM		=	Date('m');
$nowD		=	Date('d');
$nowY		=	Date('Y');
$xdays		=	10;
// $GLOBALS['today']=$today;

define('HOST', "localhost");
define('DB_USER','u775466301_machooscrm');
define('DB_PASS','Raj.sarath522@123');
define('DB_NAME','u775466301_machooscrm');
// define('DB_NAME','forstar_new'); //delete this
define('EVENT_UPLOAD_PATH','eventUploads/');
define('SIGNATUREALBUM_UPLOAD_PATH','signatureAlbumUploads/');

define('CAREER_UPLOAD_PATH','careerUploads/');
define('CAREER_DATA_UPLOAD_PATH','careerDataUploads/');


// define('HOST', "localhost");
// define('DB_USER','root');
// define('DB_PASS','');
// define('DB_NAME','u775466301_machooscrm');
// define('DB_NAME','forstar_new'); //delete this
// define('EVENT_UPLOAD_PATH','eventUploads/');
// define('SIGNATUREALBUM_UPLOAD_PATH','signatureAlbumUploads/');
 $_SESSION["GUESTUSERDETAILS"] = "";
 
 define('AWS_KEY','AKIASEOXOVG2M6D4JVUD');
 define('AWS_SECRET','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');
 define('AWS_REGION','ap-south-2');
 define('AWS_BUCKET','machooosinternational');
 
 ini_set('session.gc_maxlifetime', 86400);




$planFeatures = array();

$planFeatures["10TO6"] = "10 AM TO 6 PM SUPPORT INDIAN STD TIME";
$planFeatures["UMTS"] = "UNLIMITED ALBUM SHARES";
$planFeatures["ECMMF"] = "EXPRESSION, COMMENT MANY MORE FUTURES";


$planFeatures2 = array();

$planFeatures2["10TO6"] = "10 AM TO 6 PM SUPPORT INDIAN STD TIME";
$planFeatures2["UMTS"] = "UNLIMITED ALBUM SHARES";
$planFeatures2["PSO"] = "PHOTO SELECTION OPTION AVAILABLE";
$planFeatures2["ECMMF"] = "EXPRESSION, COMMENT MANY MORE FUTURES";

$dbc = new DBConnection();


function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'].'/admin';
}
// $url=url();



function baseurl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

define('RZRP_KEY','rzp_test_9WY7UYLUuTqWJr');
define('RZRP_PASS','E87Ozs20k3zgb80cMlQXmblS'); 
?>
