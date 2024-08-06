<?php 
session_start();
// print_r($_SESSION['MachooseAdminUser']);
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
    
    if (strpos($userPermissionsList, 'Provider-staff') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

    <div class="pagetitle">
      <h1>Staffs</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Staffs</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

  
    
    <section id="StateListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Staffs</h5>
                </div>
                
            
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Location</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Details</th>
                      
                      <th scope="col">Certifications</th>

                      <th scope="col">Created on</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
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
      getStateListData();


  });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
    
    function getStateListData(){
      
    successFn = function(resp)  {
        $('#eventListTable').DataTable().destroy();
        var eventList = resp.data;
        // console.log(resp.data);
        // $('#eventListTable').DataTable( { } );
        $('#eventListTable').DataTable({
            "data": eventList,
            "aaSorting": [],
            "columns": [
              { "data": "id",
              
                "render": function ( data, type, full, meta ) {
                    return  meta.row + 1;
                }
              },
              
               {"data":null,"render":function(item){
                
                  return item.name+" "+item.lastname;
                
                    
                    }
                },
            
              
              { "data": "email" },
              {"data":null,"render":function(item){
                
                  return item.address+"<br> "+ item.city+", "+item.state+", "+item.short_name+"<br> "+item.zip;
                
                    
                    }
                },
              
                 { "data": "phone" },
                 
                 {"data":null,"render":function(item){
                     
                     var out ='';
                     out +='<b>Gender</b> :'+item.gender;
                     out +='<br><b>BOD</b> :'+item.dob;
                     out +='<br><b>Photography business name</b> :'+item.pbn;
                     out +='<br><b>Website/Portfolio URL</b> :'+item.website;
                     out +='<br><b>Specialization</b> :'+item.specialization;
                     out +='<br><b>Experience level</b> :'+item.experience_level;
                     out +='<br><b>Biography</b> :'+item.biography;
                     
                
                  return out;
                
                    
                    }
                },
                
                 {"data":null,"render":function(item){
                     
                     var out ='';
                     if(item.ExperienceCertificate != null) out +='<a href="'+item.ExperienceCertificate+'" target="_blank">View Experience Certificate</a>';
                     if(item.EyeTestingCertificate != null) out +='<br><br><a href="'+item.EyeTestingCertificate+'" target="_blank">View Eye Testing Certificate</a>';
                     if(item.PoliceClearanceCertificate != null) out +='<br><br><a href="'+item.PoliceClearanceCertificate+'" target="_blank">View Police Clearance Certificate</a>';
                     if(item.Aadhar != null) out +='<br><br><a href="'+item.Aadhar+'" target="_blank">View Aadhar</a>';
                     if(item.Passport != null) out +='<br><br><a href="'+item.Passport+'" target="_blank">View Passport</a>';

                     
             
                  return out;
                
                    
                    }
                },
                 

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
              
              
              {"data":null,"render":function(item){
                  var str = '';
                  if(item.user_status == 1){
                      str += '<span class="text-success">Confrimed</span>';
                  }else{
                       str += '<span class="badge bg-success" onclick="confrimStaff('+item.id+');" style="cursor:pointer">Confrim</span>';
                  
                  }
                  
                 
                  
                return str;
                    
                    }
                },
             
            ]
        });
    }
    data = { "function": 'SystemManage',"method": "getServicesProviderStaffListData" };
    
    apiCall(data,successFn);
}

  
  
  function confrimStaff(id){
     return new swal({
             title: "Are you sure?",
             text: "You want to confrim this Staff",
             icon: false,
             // buttons: true,
             // dangerMode: true,
             showCancelButton: true,
             confirmButtonText: 'Yes'
             }).then((confirm) => {
                 // console.log(confirm.isConfirmed);
                 if (confirm.isConfirmed) {
                     successFn = function(resp)  {
                         if(resp.status == 1){
                             Swal.fire({
                                 icon: 'success',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                             emptyForm();
                            getStateListData();
                             
                         }else{
                             Swal.fire({
                                 icon: 'error',
                                 title: resp.data,
                                 showConfirmButton: false,
                                 timer: 1500
                             });
                         }
                     }
                     data = { "function": 'SystemManage',"method": "confrimProviderStaff" ,"sel_id":id };
                     apiCall(data,successFn);
                 }
         });
}
 
 
 
  
    
    
    
    
    
    

</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>