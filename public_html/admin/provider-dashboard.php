<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['id'] == ""){
  header("Location: service-provider-login.php");
  // print_r("sasaa");
}
include("templates/provider-header.php");

$isProvider = $_SESSION['isProvider'];

if(!$isProvider){
    echo '<script>';
    echo 'window.location.href = "service-provider-login.php";';
    echo '</script>';
    
}


?>

<style>
    .dataTables_paginate {
        width: 50%;
        float: left !important;
    }
</style>

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

<?php 

include("templates/footer.php")

?>

<script>

$( document ).ready(function() {
   



 });
 
 
 

 </script>

