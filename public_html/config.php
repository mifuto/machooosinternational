<?php 

require_once("get_session.php");
$sdsds = get_session();

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
else  
        $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    
    
// echo $url;

$url_components = parse_url($url);
 
// Use parse_str() function to parse the
// string passed via URL
parse_str($url_components['query'], $params);
     
// Display result
// echo ' Hi '.$params['uid'];
// print_r($sdsds);
$lsignatureAlbumUserId ="";
if(isset($params['uid'])){
    
    $lsignatureAlbumUserId = base64_decode($params['uid']);
    // echo $lsignatureAlbumUserId;
    // $logedUser = $sdsds['firstname'].' '.$sdsds['lastname'];
}
$lsignatureAlbumUserId = $sdsds['contact_user_id'];
if($sdsds != ""){
    // print_r();
    $contact_user_id = $sdsds['contact_user_id'];
    $logedUser = $sdsds['firstname'].' '.$sdsds['lastname'];
}else{
    $contact_user_id = "";
    $logedUser = '';
}

define('HOST', "localhost");
define('DB_USER','u775466301_machooscrm');
define('DB_PASS','Raj.sarath522@123');
define('DB_NAME','u775466301_machooscrm');


?>