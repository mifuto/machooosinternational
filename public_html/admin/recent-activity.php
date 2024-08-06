<?php 

include("templates/header.php")

?>

<div class="pagetitle">
    <h1> Recent Activity</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active"><a class="" href="recent-activity.php" role="button" >Recent Activity</a></li>
    </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"></h5>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <label for="inputText" class="col-sm-3 col-form-label">Filter</label>
                        <select class="form-control select2" aria-label="Default select example" id="selfilter" name="selfilter" onchange="FilterNow();">
                            <option value="1" selected>Today</option>
                            <option value="2" >This Week</option>
                            <option value="3" >All</option>
                        </select>
                    </div>

                  
                    <div class="col-sm-8">
                        <div class="float-end" style="padding-top: 40px">
                            <a type="button" class="btn btn-dark" href="dashboard.php"> Cancel</a>
                        </div>
                    </div>
                
                </div>

                <table class="table table-striped mt-4" id="ActivityListTable" width="100%">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">County</th>
                        <th scope="col">State</th>
                        <th scope="col">District</th>
                        <th scope="col">Time</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>

                


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
        FilterNow();
    
    });

    function FilterNow(){
        var filter = $('#selfilter').val();

        successFn = function(resp)  {
            $('#ActivityListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ActivityListTable').DataTable({
                "language": {
                    "emptyTable": "No activitys available"
                },
                "data": eventList,
                "aaSorting": [],
                "columns": [
                { "data": "id",
                
                        "render": function ( data, type, full, meta ) {
                            return  meta.row + 1;
                        }
                },
                { "data": "task" },
                { "data": "country" },
                { "data": "state" },
                { "data": "city" },
                { "data": "created_in",
                    "render": function ( data, type, full, meta ) {

                         // Specify the target date and time
                        var targetDate = new Date(data);

                        // Calculate the time difference in milliseconds
                        var timeDifference = new Date(full.nowtime) - targetDate.getTime();

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
                        return  activityTime ;
                    }
                },
              
                
                ]
            });
        }
        data = {"function": 'Dashboard', "method": "getRecentActivity" ,"filter":filter };
        
        apiCall(data,successFn);

    }


 </script>
