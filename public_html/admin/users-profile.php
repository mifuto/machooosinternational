<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']);
if($_SESSION['MachooseAdminUser']['id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}
include("templates/provider-header.php");

$sql3 = "SELECT short_name FROM tblcountries WHERE country_id=".$county_id;
$result3 = $DBC->query($sql3);
$row3 = mysqli_fetch_assoc($result3);


$servicescenter_id = $_SESSION['MachooseAdminUser']['servicescenter_id'];
$sql4 = "SELECT center_name FROM tblservicescenter WHERE id=".$servicescenter_id;
$result4 = $DBC->query($sql4);
$row4 = mysqli_fetch_assoc($result4);

?>

 
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="provider-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-icon-design-free-vector.jpg" alt="Profile" class="rounded-circle">
              <h2><?=$Username?></h2>
              <h3><?=$RoleName?></h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
             
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                 

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?=$Username?></div>
                  </div>

               
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$_SESSION['MachooseAdminUser']['email']?></div>
                  </div>
                  
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Role</div>
                    <div class="col-lg-9 col-md-8"><?=$RoleName?></div>
                  </div>
                  
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">County</div>
                    <div class="col-lg-9 col-md-8"><?=$row3['short_name']?></div>
                  </div>
                  
                  
                   <div class="row">
                    <div class="col-lg-3 col-md-4 label">State</div>
                    <div class="col-lg-9 col-md-8"><?=$state?></div>
                  </div>
                  
                   <div class="row">
                    <div class="col-lg-3 col-md-4 label">District</div>
                    <div class="col-lg-9 col-md-8"><?=$city?></div>
                  </div>
                  
                     <div class="row">
                    <div class="col-lg-3 col-md-4 label">Service Center Type</div>
                    <div class="col-lg-9 col-md-8"><?=$row4['center_name']?></div>
                  </div>
                  
                 
               
                  
                </div>

              

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>


<?php 

include("templates/footer.php")

?>