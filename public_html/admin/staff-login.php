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
    
    if (strpos($userPermissionsList, 'Reports') === false) {
        echo '<script>';
        echo 'window.location.href = "dashboard.php";';
        echo '</script>';
    }
    
 
    
}



?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <div class="pagetitle">
      <h1>Staff Login</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Staff Login</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   
    
    <section id="userListSection">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-3">
                  <h5 class="card-title">Staff Login</h5>
                </div>
                
                  <div class="col-3">
                    <label for="inputText" class=" col-form-label">Select date range</label>
                   <input class="form-control select2" type="text" id="date-range-picker">
                           
                  </div>
          
              </div> 
              <div class="col-sm-12 table-responsive">
                <table class="table table-striped mt-4 " width="100%" id="eventListTable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Role</th>
                      
                      <th scope="col">County</th>
                      <th scope="col">State</th>
                      <th scope="col">District</th>
                      

                      <th scope="col">Logged On</th>
                      <th scope="col">Time</th>
                      <!--<th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>-->
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

  // Calculate the end date (today)
      var endDate = moment(); // Use the "moment.js" library for date manipulation
      // Calculate the start date (one month above today)
      var startDate = moment().subtract(1, 'months');
      
  $( document ).ready(function() {
      getUserListData();
    
         $('#date-range-picker').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            opens: 'left',
            locale: {
              format: 'YYYY-MM-DD',
            },
          });

  });
  
  
    $('#date-range-picker').on('apply.daterangepicker', function (ev, picker) {
        endDate = picker.endDate;
        startDate = picker.startDate;
      // Handle the selected date range here
      console.log('Start Date: ' + picker.startDate.format('MM/DD/YYYY'));
      console.log('End Date: ' + picker.endDate.format('MM/DD/YYYY'));
      
      getUserListData();
    });
  
    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "June",
    "July", "Aug", "Sept", "Oct", "Nov", "Dec" ];
    
    
  
  
  function getUserListData(){
      
        
        var sd = startDate.format('YYYY-MM-DD');
        var ed = endDate.format('YYYY-MM-DD');
        
        const inputDate = new Date(ed); // Create a Date object for the input date
        const nextDay = new Date(inputDate); // Create a copy of the input date
        nextDay.setDate(inputDate.getDate() + 1); // Add 1 day to the copy
        
        // Format the next day in the desired format (e.g., YYYY-MM-DD)
        const nextDayFormatted = nextDay.toISOString().split('T')[0];
      
    
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
            
              
        
              { "data": "name" },
              { "data": "role_id" },
              
                  { "data": "county_id" },
              { "data": "state_id" },
              { "data": "city_id" },
              
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
              
                  { "data": null,
                render: function ( data ) {
                    
                     var istTimeString = convertUTCToIST(data['created_date']);
                    
                    var datetimeString = new Date(istTimeString);
                    

                    
                    var timeString = convertToTime(datetimeString);

             
                    return timeString;
                }
              },
              

            //     { "data": null,
            //     render: function ( data ) {
                    

            //      // Specify the target date and time
            //           var targetDate = new Date(data['created_date']);
            
            //           // Calculate the time difference in milliseconds
            //           var timeDifference = new Date(data['nowtime']) - targetDate.getTime();
            
            //           // Convert milliseconds to minutes
            //           var minutesAgo = Math.floor(timeDifference / (1000 * 60));
            
                 
                  
            //          if(minutesAgo < 1440){
            //             var hours = Math.floor(minutesAgo / 60);
            //             if(hours == 0) var activityTime = minutesAgo +" min" ;
            //             else var activityTime = hours +" hrs" ;
                        
                        
                    
            //         }else{
            //         var daysAgo = Math.floor(minutesAgo / (60 * 24));
            //         var activityTime = daysAgo +" day" ;
            //         }
                                
                    
                    
            //         return activityTime+" ago";
            //     }
            //   },
              
          
             
            ]
        });
    }
    data = { "function": 'User',"method": "getStaffLoginListData",'startDate':sd,'endDate':nextDayFormatted };
    
    apiCall(data,successFn);
}


function convertToTime(datetimeString) {
    // Parse the datetime string
    const datetime = new Date(datetimeString);

    // Get hours and minutes
    const hours = datetime.getHours();
    const minutes = datetime.getMinutes();

    // Convert hours to 12-hour format
    const formattedHours = hours % 12 || 12;

    // Determine if it's AM or PM
    const period = hours < 12 ? 'AM' : 'PM';

    // Pad minutes with leading zero if necessary
    const formattedMinutes = String(minutes).padStart(2, '0');

    // Construct the time string
    const timeString = `${formattedHours}:${formattedMinutes} ${period}`;

    return timeString;
}


function convertUTCToIST(utcTimeString) {
    // Parse the UTC time string
    const utcTime = new Date(utcTimeString);

    // Get UTC time in milliseconds since Unix epoch
    const utcMilliseconds = utcTime.getTime();

    // Indian Standard Time is UTC + 5 hours 30 minutes
    const ISTOffsetMilliseconds = 5.5 * 60 * 60 * 1000;

    // Convert UTC time to IST by adding the offset
    const istMilliseconds = utcMilliseconds + ISTOffsetMilliseconds;

    // Create a new Date object with IST
    const istTime = new Date(istMilliseconds);

    // Format the IST time string
    const formattedIST = istTime.toLocaleString('en-IN', { timeZone: 'Asia/Kolkata' });

    return formattedIST;
}

  
  


</script>
<style>
.select2-container {
    width: 100% !important;
}
</style>