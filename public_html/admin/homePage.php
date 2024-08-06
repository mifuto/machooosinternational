<?php 

include("templates/header.php");

$isAdmin = $_SESSION['isAdmin'];
if(!$isAdmin){
    $UserRole = $_SESSION['UserRole'];
    $sql = "SELECT * FROM tbluserroles WHERE id=".$UserRole;
    $result = $DBC->query($sql);
    $row = mysqli_fetch_assoc($result);
    
    $userPermissionsList = $row['userPermissions'];
    
    if (strpos($userPermissionsList, 'Website') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}

?>

    <div class="pagetitle">
      <h1>AAD HOMEPAGE&nbsp; IMAGES</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Website</li>
          <li class="breadcrumb-item active">Aad Image</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- General Form Elements -->
              <form>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Catagory</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>
                
				  <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Tittle</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control">
                  </div>
                </div>
				   
				  
				  <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px"></textarea>
                  </div>
                </div>
                
              <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">1 images</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile">
					4in x6in 200resolution
                  </div>
			
		        </div>
				  

                <fieldset class="row mb-3">
                  
                  
                </fieldset>
       
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                 <div class="col-sm-10">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                SUBMIT
              </button>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">SUBMIT</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      If you are ok with these edits please go threw yes otherwise no
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edit</button>
                      <button type="button" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        <div class="col-lg-6">

          <div class="card">
           
             <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent HOmepage images</h5>

              <!-- Advanced Form Elements -->
              <div class="card">
            <div class="card-body">
              <h5 class="card-title">Homepage</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tittle</th>
                    <th scope="col">Desc</th>
                    <th scope="col">Image</th>
                    <th scope="col"> edit</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Brandon Jacob</td>
                    <td>Designer</td>
                    <td><img src="../images/blog tittle/blog_machooos_2.jpg" class="card-img-top" alt="..."></td>
                     <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td><img src="../images/blog tittle/blog_machooos_1.jpg" class="card-img-top" alt="..."></td>
                     <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                   <td> <img src="../images/blog tittle/blog_machooos_3.jpg" class="card-img-top" alt="..."></td>
                     <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td><img src="../images/blog tittle/blog_machooos_4.jpg" class="card-img-top" alt="..."></td>
                     <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td><img src="../images/blog tittle/blog_machooos_5.jpg" class="card-img-top" alt="..."></td>
                     <td><span class="badge bg-info text-dark">edit</span><span class="badge bg-danger">delete</span></td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
				<!-- Pagination with icons -->
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav><!-- End Pagination with icons -->

            </div>
          </div>

                

                

                

             <!-- End General Form Elements -->

            </div>
          </div>
			</div>

        </div>
      </div>
    </section>

<?php 

include("templates/footer.php")

?>