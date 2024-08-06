<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userdescription = $row['description'];
    if($userdescription == ""){
        $userdescription = "<label class='text-muted' >No instructions available</label>";
    }
  
}

?>

<div class="pagetitle">
    <h1> Staff instructions</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="countries.php" role="button" >Staff instructions</a></li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"></h5>
                
                <div><?php print_r($userdescription); ?></div>
                

                </div>
            </div>
        </div>
    </div>
</section>





<?php 

include("templates/footer.php")

?>

<script>
    $( document ).ready(function() {
      
    
    });



 </script>
