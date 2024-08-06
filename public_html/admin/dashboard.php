<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['user_id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}
include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    // if (strpos($userPermissionsList, 'Dashboard') === false) {
    //     echo '<script>';
    //     echo 'window.location.href = "login.php";';
    //     echo '</script>';
    // }
    
 
    
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

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card">

               

                <div class="card-body">
                  <h5 class="card-title">Total Online Album <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book-half"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="totalOnlineAlbum">--
                      </h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card revenue-card">

               
                <div class="card-body">
                  <h5 class="card-title">Signature Album <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-richtext-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="SignatureAlbum">--</h6><span id="SignatureAlbumEvents"></span>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Customers </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfCustomers">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            
            
            <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Wedding Films </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-film"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfWeddingFilms">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            
             <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">File Downloads </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-download"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfDwdFiles">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            
             <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Total SA view </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-images"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfSAView">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
             <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Total OA view </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-journal-plus"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfOAView">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
              <div class="col-xxl-3 col-xl-12">

              <div class="card info-card customers-card">

               

                <div class="card-body">
                  <h5 class="card-title">Total WF view </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-camera-reels-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="noOfWFView">--</h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div>
            
            
            
            
            
            
            
            
            
            

            <!-- Reports -->
            <!--<div class="col-12">-->
            <!--  <div class="card">-->

            <!--    <div class="filter">-->
            <!--      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
            <!--      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
            <!--        <li class="dropdown-header text-start">-->
            <!--          <h6>Filter</h6>-->
            <!--        </li>-->

            <!--        <li><a class="dropdown-item" href="#">Today</a></li>-->
            <!--        <li><a class="dropdown-item" href="#">This Month</a></li>-->
            <!--        <li><a class="dropdown-item" href="#">This Year</a></li>-->
            <!--      </ul>-->
            <!--    </div>-->

            <!--    <div class="card-body">-->
            <!--      <h5 class="card-title">Reports <span>/This Week</span></h5>-->

                  <!-- Line Chart -->
            <!--      <div id="reportsChart"></div>-->

            <!--      <script>-->
            <!--        document.addEventListener("DOMContentLoaded", () => {-->
            <!--          new ApexCharts(document.querySelector("#reportsChart"), {-->
            <!--            series: [{-->
            <!--              name: 'Sales',-->
            <!--              data: [31, 40, 28, 51, 42, 82, 56],-->
            <!--            }, {-->
            <!--              name: 'Revenue',-->
            <!--              data: [11, 32, 45, 32, 34, 52, 41]-->
            <!--            }, {-->
            <!--              name: 'Customers',-->
            <!--              data: [15, 11, 32, 18, 9, 24, 11]-->
            <!--            }],-->
            <!--            chart: {-->
            <!--              height: 350,-->
            <!--              type: 'area',-->
            <!--              toolbar: {-->
            <!--                show: false-->
            <!--              },-->
            <!--            },-->
            <!--            markers: {-->
            <!--              size: 4-->
            <!--            },-->
            <!--            colors: ['#4154f1', '#2eca6a', '#ff771d'],-->
            <!--            fill: {-->
            <!--              type: "gradient",-->
            <!--              gradient: {-->
            <!--                shadeIntensity: 1,-->
            <!--                opacityFrom: 0.3,-->
            <!--                opacityTo: 0.4,-->
            <!--                stops: [0, 90, 100]-->
            <!--              }-->
            <!--            },-->
            <!--            dataLabels: {-->
            <!--              enabled: false-->
            <!--            },-->
            <!--            stroke: {-->
            <!--              curve: 'smooth',-->
            <!--              width: 2-->
            <!--            },-->
            <!--            xaxis: {-->
            <!--              type: 'datetime',-->
            <!--              categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]-->
            <!--            },-->
            <!--            tooltip: {-->
            <!--              x: {-->
            <!--                format: 'dd/MM/yy HH:mm'-->
            <!--              },-->
            <!--            }-->
            <!--          }).render();-->
            <!--        });-->
            <!--      </script>-->
                  <!-- End Line Chart -->

            <!--    </div>-->

            <!--  </div>-->
            <!--</div><!-- End Reports -->
            
            
            
            
            
            

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

              
                <div class="card-body">
                  <h5 class="card-title">Recent Online Wedding Album <span></span></h5>
                  
                  
                    <table class="table table-striped mt-2 table-borderless" id="userListTable123" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">User</th>
                            <th scope="col">Event Name</th>

                     
                              <th scope="col">County</th>
                             <th scope="col">State</th>
                              <th scope="col">District</th>
                              
                              
                              <th scope="col">Create Date</th>

                            
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                  
                  
                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

              

                <div class="card-body">
                  <h5 class="card-title">Recent Signature Album <span></span></h5>
                  
                  
                   <table class="table table-striped mt-2 table-borderless" id="userListTable456" width="100%">
                        <thead>
                          <tr>
                             <th scope="col">#</th> 
                            <th scope="col">User</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Expiry Date</th>
                           
                              <th scope="col">County</th>
                             <th scope="col">State</th>
                              <th scope="col">District</th>
                              
                              
                              
                              <th scope="col">Create Date</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                  
                  
                  
                  
                  
                 
                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#" onclick="getRecentActivity(1)">Today</a></li>
                <li><a class="dropdown-item" href="#" onclick="getRecentActivity(2)">This Week</a></li>
                <li><a class="dropdown-item" href="#" onclick="getRecentActivity(3)">All</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span id="activityFilter">| Today</span></h5>

              <div class="activity" id="listRecentActivity">


              </div>

            </div>

            <div class="d-none" style="text-align: right; padding-right: 20px;padding-bottom: 20px;" id='moreRecentActivity'>
              <a class="icon" href="recent-activity.php" >View more >></a>
             
            </div>


          </div><!-- End Recent Activity -->
          
          
          
          
          

          <!-- Budget Report -->
        <!--  <div class="card">-->
        <!--    <div class="filter">-->
        <!--      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
        <!--      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
        <!--        <li class="dropdown-header text-start">-->
        <!--          <h6>Filter</h6>-->
        <!--        </li>-->

        <!--        <li><a class="dropdown-item" href="#">Today</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Month</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Year</a></li>-->
        <!--      </ul>-->
        <!--    </div>-->

        <!--    <div class="card-body pb-0">-->
        <!--      <h5 class="card-title">Budget Report <span>| This Month</span></h5>-->

        <!--      <div id="budgetChart" style="min-height: 400px;" class="echart"></div>-->

        <!--      <script>-->
        <!--        document.addEventListener("DOMContentLoaded", () => {-->
        <!--          var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({-->
        <!--            legend: {-->
        <!--              data: ['Allocated Budget', 'Actual Spending']-->
        <!--            },-->
        <!--            radar: {-->
                      <!--// shape: 'circle',-->
        <!--              indicator: [{-->
        <!--                  name: 'Sales',-->
        <!--                  max: 6500-->
        <!--                },-->
        <!--                {-->
        <!--                  name: 'Administration',-->
        <!--                  max: 16000-->
        <!--                },-->
        <!--                {-->
        <!--                  name: 'Information Technology',-->
        <!--                  max: 30000-->
        <!--                },-->
        <!--                {-->
        <!--                  name: 'Customer Support',-->
        <!--                  max: 38000-->
        <!--                },-->
        <!--                {-->
        <!--                  name: 'Development',-->
        <!--                  max: 52000-->
        <!--                },-->
        <!--                {-->
        <!--                  name: 'Marketing',-->
        <!--                  max: 25000-->
        <!--                }-->
        <!--              ]-->
        <!--            },-->
        <!--            series: [{-->
        <!--              name: 'Budget vs spending',-->
        <!--              type: 'radar',-->
        <!--              data: [{-->
        <!--                  value: [4200, 3000, 20000, 35000, 50000, 18000],-->
        <!--                  name: 'Allocated Budget'-->
        <!--                },-->
        <!--                {-->
        <!--                  value: [5000, 14000, 28000, 26000, 42000, 21000],-->
        <!--                  name: 'Actual Spending'-->
        <!--                }-->
        <!--              ]-->
        <!--            }]-->
        <!--          });-->
        <!--        });-->
        <!--      </script>-->

        <!--    </div>-->
        <!--  </div><!-- End Budget Report -->

          <!-- Website Traffic -->
        <!--  <div class="card">-->
        <!--    <div class="filter">-->
        <!--      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
        <!--      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
        <!--        <li class="dropdown-header text-start">-->
        <!--          <h6>Filter</h6>-->
        <!--        </li>-->

        <!--        <li><a class="dropdown-item" href="#">Today</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Month</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Year</a></li>-->
        <!--      </ul>-->
        <!--    </div>-->

        <!--    <div class="card-body pb-0">-->
        <!--    <div class="card-body">-->
        <!--      <h5 class="card-title">Signature Album Validity</h5>-->

              <!-- Default Tabs -->
        <!--      <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100 active" id="home-ta-b" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">ONLINE</button>-->
        <!--        </li>-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100" id="profile-ta-b" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">DEADLINE</button>-->
        <!--        </li>-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100" id="contact-ta-b" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">EXPIRED</button>-->
        <!--        </li>-->
        <!--      </ul>-->
        <!--      <div class="tab-content pt-2" id="myTabjustifiedContent">-->
        <!--        <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-success">Online</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-success">Online</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--        <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-warning">Deadline</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-warning">Deadline</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--        <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-danger">not Active</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-danger">not Active</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--      </div><!-- End Default Tabs -->

        <!--    </div>-->
        <!--        <a href="Sig_album_users.html">more details</a>	-->
        <!--    </div>-->
        <!--  </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
        <!--  <div class="card">-->
        <!--    <div class="filter">-->
        <!--      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>-->
        <!--      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">-->
        <!--        <li class="dropdown-header text-start">-->
        <!--          <h6>Filter</h6>-->
        <!--        </li>-->

        <!--        <li><a class="dropdown-item" href="#">Today</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Month</a></li>-->
        <!--        <li><a class="dropdown-item" href="#">This Year</a></li>-->
        <!--      </ul>-->
        <!--    </div>-->

        <!--    <div class="card-body">-->
        <!--      <h5 class="card-title">Online Wedding Album</h5>-->

              <!-- Default Tabs -->
        <!--      <ul class="nav nav-tabs d-flex" id="myTabjustifieda" role="tablist">-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100 active" id="home-ta-b-a" data-bs-toggle="tab" data-bs-target="#home-justifieda" type="button" role="tab" aria-controls="home" aria-selected="true">ONLINE</button>-->
        <!--        </li>-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100" id="profile-ta-b-a" data-bs-toggle="tab" data-bs-target="#profile-justifieda" type="button" role="tab" aria-controls="profile" aria-selected="false">DEADLINE</button>-->
        <!--        </li>-->
        <!--        <li class="nav-item flex-fill" role="presentation">-->
        <!--          <button class="nav-link w-100" id="contact-ta-b-a" data-bs-toggle="tab" data-bs-target="#contact-justifieda" type="button" role="tab" aria-controls="contact" aria-selected="false">EXPIRY</button>-->
        <!--        </li>-->
        <!--      </ul>-->
        <!--      <div class="tab-content pt-2" id="myTabjustifiedContent">-->
        <!--        <div class="tab-pane fade show active" id="home-justifieda" role="tabpanel" aria-labelledby="home-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-success">Online</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-success">Online</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--        <div class="tab-pane fade" id="profile-justifieda" role="tabpanel" aria-labelledby="profile-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-warning">Deadline</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-warning">Deadline</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--        <div class="tab-pane fade" id="contact-justifieda" role="tabpanel" aria-labelledby="contact-tab">-->
        <!--          <table>-->
        <!--            <tr>-->
        <!--              <th>User</th>-->
        <!--              <th>Viewers</th>-->
        <!--              <th>Validity</th>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Brandon Jacob</td>-->
        <!--              <td>557</td>-->
        <!--              <td><span class="badge bg-danger">not Active</span></td>-->
        <!--            </tr>-->
        <!--            <tr>-->
        <!--              <td>Bridie Kessler</td>-->
        <!--              <td>625</td>-->
        <!--            <td><span class="badge bg-danger">not Active</span></td>-->
        <!--            </tr>-->
        <!--          </table>-->
        <!--        </div>-->
        <!--      </div><!-- End Default Tabs -->

        <!--    </div>-->
	       <!--   <a href="Sig_album_users.html">more details</a>		  -->
        <!--  </div><!-- End News & Updates -->
			

        <!--</div><!-- End Right side columns -->
        
        
        

      </div>
    </section>

<?php 

include("templates/footer.php")

?>

<script>

$( document ).ready(function() {
      getCounts();

      getRecentActivity(1);
      
      getOnlineAlbumUserData();
      
      getSignatureAlbumUserData();



 });
 
 
 function getSignatureAlbumUserData(){

      
      var userId = '';
       var albumDisType = '';
     
      var d1 = new Date();

    var year1 = d1.getFullYear();
    var month1 = String(d1.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with '0' if needed.
    var day1 = String(d1.getDate()).padStart(2, '0');
    
    var todayDate = `${year1}-${month1}-${day1}`;
      
      
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
      
      
      
       successFn = function(resp)  {
        $('#userListTable456').DataTable().destroy();
        var eventList = resp.data;
        console.log(resp);
        // $('#eventListTable').DataTable( { } );
        $('#userListTable456').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
            { "data": null,
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              { "data": null,
                render: function ( data ) {
                    return data['firstname']+" "+data['lastname'];
                }
              },
             
               { "data": "event_name" },
                
                  { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['expiry_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
                  
              
           
              
               { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
                 
                 
                
                       
               
              
              
              
                { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['created_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
              
          
                
               
              
              
          
            ]
        });
        

    }
    data = { "function": 'SignatureAlbum',"method": "getSAlbumListDashboard","userId":userId ,"albumDisType":albumDisType,"todayDate":todayDate };
    
    apiCall(data,successFn);
      
      
  }
 
 
 function getOnlineAlbumUserData(){
  
      var userId = '';
       var albumDisType = '';
     
      var d1 = new Date();

    var year1 = d1.getFullYear();
    var month1 = String(d1.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with '0' if needed.
    var day1 = String(d1.getDate()).padStart(2, '0');
    
    var todayDate = `${year1}-${month1}-${day1}`;
      
      
        var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
      
      
      
       successFn = function(resp)  {
        $('#userListTable123').DataTable().destroy();
        var eventList = resp.data;
        console.log(resp);
        // $('#eventListTable').DataTable( { } );
        $('#userListTable123').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
            { "data": null,
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              
              { "data": null,
                render: function ( data ) {
                    return data['firstname']+" "+data['lastname'];
                }
              },
               { "data": "event_name" },
               
            
           
              
               { "data": "country" },
                 { "data": "state" },
                 { "data": "city" },
                 
                 
               
               
                  
              
              
              
                { "data": null,
                render: function ( data ) {
                    
                    var date = new Date(data['created_date']);

                // Get year, month, and day part from the date
                var year = date.toLocaleString("default", { year: "numeric" });
                var month = date.toLocaleString("default", { month: "numeric" });
                var day = date.toLocaleString("default", { day: "2-digit" });

                var formattedDate = day+ ' '+ monthNames[month-1] + ' '+ year;
                    
                    
                    
                    return formattedDate;
                }
              },
              
              
          
              
          
            ]
        });
        

    }
    data = { "function": 'OnlineAlbum',"method": "getOAlbumListDashboard","userId":userId ,"albumDisType":albumDisType,"todayDate":todayDate };
    
    apiCall(data,successFn);
      
      
  }
 
 
 
 
 
 
 

 function getRecentActivity(filter){

  if(filter == 1 ) $("#activityFilter").html("| Today");
  else if(filter == 2 ) $("#activityFilter").html("| This Week");
  else $("#activityFilter").html("| All");

  

    successFn = function(resp)  {
      if(resp.status == 1){
        var Activitys = resp.data ;
        var len = Activitys.length ;
        if(len >= 11){
          $('#moreRecentActivity').removeClass('d-none');
          len = 10;
        }else{
          $('#moreRecentActivity').addClass('d-none');
        }


        var activityData = "";
        for(var i=0;i<len;i++){

          // Specify the target date and time
          var targetDate = new Date(Activitys[i]['created_in']);

          // Calculate the time difference in milliseconds
          var timeDifference = new Date(Activitys[i]['nowtime']) - targetDate.getTime();

          // Convert milliseconds to minutes
          var minutesAgo = Math.floor(timeDifference / (1000 * 60));

     
      
         if(minutesAgo < 1440){
            var hours = Math.floor(minutesAgo / 60);
            if(hours == 0) var activityTime = minutesAgo +" min" ;
            else var activityTime = hours +" hrs" ;
            
            
        
        }else{
        var daysAgo = Math.floor(minutesAgo / (60 * 24));
        var activityTime = daysAgo +" day" ;
        }

        
          activityData +='<div class="activity-item d-flex">';
          activityData +='<div class="activite-label">'+activityTime+'</div>';

          if(Activitys[i]['action'] == "create"){
            activityData +="<i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>";
          }else if(Activitys[i]['action'] == "update"){
            activityData +="<i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>";
          }else if(Activitys[i]['action'] == "delete"){
            activityData +="<i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>";
          }else if(Activitys[i]['action'] == "extend"){
            activityData +="<i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>";
          }else{
            activityData +="<i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>";
          }

          

          activityData +='<div class="activity-content">';
          activityData +=Activitys[i]['task'] ;
          activityData +='</div>';
          activityData +='</div>';



        }

        $("#listRecentActivity").html(activityData);

      }else $("#listRecentActivity").html("");
      
      
    }
    data = {"function": 'Dashboard', "method": "getRecentActivity" ,"filter":filter };
    apiCall(data,successFn);
 }

 function getCounts(){
    successFn = function(resp)  {
      $("#totalOnlineAlbum").html(resp.data['totalOnlineAlbum']);
      $("#SignatureAlbum").html(resp.data['SignatureAlbum']);
      $("#noOfCustomers").html(resp.data['noOfCustomers']);
      $("#noOfWeddingFilms").html(resp.data['noOfWeddingFilms']);
      $("#noOfDwdFiles").html(resp.data['noOfDwdFiles']);
      $("#SignatureAlbumEvents").html("( "+resp.data['SignatureAlbum']+" Events )");
      
      
      
      $("#noOfSAView").html(resp.data['noOfSAView']);
      $("#noOfOAView").html(resp.data['noOfOAView']);
      $("#noOfWFView").html(resp.data['noOfWFView']);
      
    }
    data = {"function": 'Dashboard', "method": "getCounts"};
    apiCall(data,successFn);
 }


 </script>

