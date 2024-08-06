<?php 
session_start();
print_r($_SESSION['MachooseAdminUser']['user_id']);
if($_SESSION['MachooseAdminUser']['user_id'] == ""){
  header("Location: login.php");
  // print_r("sasaa");
}
include("templates/header.php");


?>

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
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Total Online Album <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
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
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Signature Album <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="SignatureAlbum">--</h6><span id="SignatureAlbumEvents"></span>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Customers <span>| This Year</span></h5>

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

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/This Week</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#reportsChart"), {
                        series: [{
                          name: 'Sales',
                          data: [31, 40, 28, 51, 42, 82, 56],
                        }, {
                          name: 'Revenue',
                          data: [11, 32, 45, 32, 34, 52, 41]
                        }, {
                          name: 'Customers',
                          data: [15, 11, 32, 18, 9, 24, 11]
                        }],
                        chart: {
                          height: 350,
                          type: 'area',
                          toolbar: {
                            show: false
                          },
                        },
                        markers: {
                          size: 4
                        },
                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                        fill: {
                          type: "gradient",
                          gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.3,
                            opacityTo: 0.4,
                            stops: [0, 90, 100]
                          }
                        },
                        dataLabels: {
                          enabled: false
                        },
                        stroke: {
                          curve: 'smooth',
                          width: 2
                        },
                        xaxis: {
                          type: 'datetime',
                          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                        },
                        tooltip: {
                          x: {
                            format: 'dd/MM/yy HH:mm'
                          },
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Online Wedding Album <span></span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Viewers</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>644</td>
                        <td><span class="badge bg-success">Online</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2456</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>147</td>
                        <td><span class="badge bg-warning">Deadline</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2455</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>147</td>
                        <td><span class="badge bg-danger">not Active</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2454</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Click Here More Details</a></td>
                        <td>67</td>
                        <td><span class="badge bg-warning">Deadline</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2453</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>165</td>
                        <td><span class="badge bg-success">Online</span></td>
                      </tr>
                    </tbody>
                  </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
                </div>

              </div>
            </div><!-- End Recent Sales -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Signature Album <span></span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Product</th>
                        <th scope="col">Viewers</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">#2457</a></th>
                        <td>Brandon Jacob</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>644</td>
                        <td><span class="badge bg-success">Online</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2456</a></th>
                        <td>Bridie Kessler</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>147</td>
                        <td><span class="badge bg-warning">Deadline</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2455</a></th>
                        <td>Ashleigh Langosh</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>147</td>
                        <td><span class="badge bg-danger">not Active</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2454</a></th>
                        <td>Angus Grady</td>
                        <td><a href="#" class="text-primar">Click Here More Details</a></td>
                        <td>67</td>
                        <td><span class="badge bg-warning">Deadline</span></td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">#2453</a></th>
                        <td>Raheem Lehner</td>
                        <td><a href="#" class="text-primary">Click Here More Details</a></td>
                        <td>165</td>
                        <td><span class="badge bg-success">Online</span></td>
                      </tr>
                    </tbody>
                  </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
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

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">

                <div class="activity-item d-flex">
                  <div class="activite-label">32 min</div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">56 min</div>
                  <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                  <div class="activity-content">
                    Voluptatem blanditiis blanditiis eveniet
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 hrs</div>
                  <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                  <div class="activity-content">
                    Voluptates corrupti molestias voluptatem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">1 day</div>
                  <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                  <div class="activity-content">
                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">2 days</div>
                  <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                  <div class="activity-content">
                    Est sit eum reiciendis exercitationem
                  </div>
                </div><!-- End activity item-->

                <div class="activity-item d-flex">
                  <div class="activite-label">4 weeks</div>
                  <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                  <div class="activity-content">
                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                  </div>
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Budget Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Budget Report <span>| This Month</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Sales',
                          max: 6500
                        },
                        {
                          name: 'Administration',
                          max: 16000
                        },
                        {
                          name: 'Information Technology',
                          max: 30000
                        },
                        {
                          name: 'Customer Support',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div><!-- End Budget Report -->

          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
            <div class="card-body">
              <h5 class="card-title">Signature Album Validity</h5>

              <!-- Default Tabs -->
              <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-ta-b" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">ONLINE</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-ta-b" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">DEADLINE</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-ta-b" data-bs-toggle="tab" data-bs-target="#contact-justified" type="button" role="tab" aria-controls="contact" aria-selected="false">EXPIRED</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-success">Online</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-success">Online</span></td>
                    </tr>
                  </table>
                </div>
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-warning">Deadline</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-warning">Deadline</span></td>
                    </tr>
                  </table>
                </div>
                <div class="tab-pane fade" id="contact-justified" role="tabpanel" aria-labelledby="contact-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-danger">not Active</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-danger">not Active</span></td>
                    </tr>
                  </table>
                </div>
              </div><!-- End Default Tabs -->

            </div>
                <a href="Sig_album_users.html">more details</a>	
            </div>
          </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Online Wedding Album</h5>

              <!-- Default Tabs -->
              <ul class="nav nav-tabs d-flex" id="myTabjustifieda" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-ta-b-a" data-bs-toggle="tab" data-bs-target="#home-justifieda" type="button" role="tab" aria-controls="home" aria-selected="true">ONLINE</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-ta-b-a" data-bs-toggle="tab" data-bs-target="#profile-justifieda" type="button" role="tab" aria-controls="profile" aria-selected="false">DEADLINE</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-ta-b-a" data-bs-toggle="tab" data-bs-target="#contact-justifieda" type="button" role="tab" aria-controls="contact" aria-selected="false">EXPIRY</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">
                <div class="tab-pane fade show active" id="home-justifieda" role="tabpanel" aria-labelledby="home-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-success">Online</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-success">Online</span></td>
                    </tr>
                  </table>
                </div>
                <div class="tab-pane fade" id="profile-justifieda" role="tabpanel" aria-labelledby="profile-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-warning">Deadline</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-warning">Deadline</span></td>
                    </tr>
                  </table>
                </div>
                <div class="tab-pane fade" id="contact-justifieda" role="tabpanel" aria-labelledby="contact-tab">
                  <table>
                    <tr>
                      <th>User</th>
                      <th>Viewers</th>
                      <th>Validity</th>
                    </tr>
                    <tr>
                      <td>Brandon Jacob</td>
                      <td>557</td>
                      <td><span class="badge bg-danger">not Active</span></td>
                    </tr>
                    <tr>
                      <td>Bridie Kessler</td>
                      <td>625</td>
                    <td><span class="badge bg-danger">not Active</span></td>
                    </tr>
                  </table>
                </div>
              </div><!-- End Default Tabs -->

            </div>
	          <a href="Sig_album_users.html">more details</a>		  
          </div><!-- End News & Updates -->
			

        </div><!-- End Right side columns -->

      </div>
    </section>

<?php 

include("templates/footer.php")

?>

<script>

$( document ).ready(function() {
      getCounts();



 });

 function getCounts(){
    successFn = function(resp)  {
      $("#totalOnlineAlbum").html(resp.data['totalOnlineAlbum']);
      $("#SignatureAlbum").html(resp.data['SignatureAlbum']);
      $("#noOfCustomers").html(resp.data['noOfCustomers']);
      $("#SignatureAlbumEvents").html("( "+resp.data['SignatureAlbum']+" Events )");
    }
    data = {"function": 'Dashboard', "method": "getCounts"};
    apiCall(data,successFn);
 }


 </script>

