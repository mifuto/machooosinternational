<?php 
session_start();

// Set Error Reporting Options 
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', '1');

if (!isset($_COOKIE['mchs_session']))
{
    die();
}

$ses = $_COOKIE['mchs_session'];

// var_dump($ses);

$DBC = mysqli_connect("localhost", "root", "",'u775466301_machooscrm');

if (mysqli_connect_error())
{
    header('Location:../index.php');
}

$sql = "SELECT `data` FROM tblsessions WHERE id = '".$ses."'";
// echo $sql;
$result = $DBC->query($sql);

// var_dump($result);

$count = mysqli_num_rows($result);

$retArray = [];

if($count > 0)
{		
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($retArray,$row);
    }
} else {
    header('Location:../index.php');
}

// var_dump($retArray[0]['data']);

$data = explode(';', $retArray[0]['data']);

// var_dump($data);

$user_data = [];

foreach ($data as $key => $value) {
    if($value != "") {
        $pd = explode('|', $value);
        $dd = explode(':', $value);

        $user_data[$pd[0]] = $dd[0] == 's' ? $dd[2]:$dd[1];
    }
}

?>