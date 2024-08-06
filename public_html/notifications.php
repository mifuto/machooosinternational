<?php 


include("admin/config.php");
include("get_session.php");


$user_data = get_session();
if(isset($user_data['userID']) && $user_data['userID'] > 0) {
  
    $user_type_val = 1;
    $user_id_like = $user_data['contact_user_id'];
 

}else if($_COOKIE['guestLoginId'] != 0){
    
    
    if(!isset($_COOKIE['guestLoginId'])) $guestLoginId ="";
    else { $guestLoginId =$_COOKIE['guestLoginId']; }
  
 
    $user_type_val = 2;
    $user_id_like = $guestLoginId;
}
else {
   
    $user_type_val = '';
    $user_id_like = '';
    
}

include("templates/header.php");



?>

<input type="hidden" value="<?php echo $user_type_val; ?>" id="user_type_val">
<input type="hidden" value="<?php echo $user_id_like; ?>" id="user_id_like">


  <link href="css/jquery.dataTables.min.css" rel="stylesheet">
  
                <!-- content-holder -->
                <div class="content-holder vis-dec-anim">
                    <!-- content -->
                    <div class="content" style="padding-bottom:50px;">
                        <div class="post_header fl-wrap">
                            <div class="container ">

                                <table class="table table-striped mt-4" id="ActivityListTable" width="100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Time</th>
                                        <th scope="col"></th>
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
                                


                            </div>
                        </div>
                        <div class="clearfix"></div>
                       
                    </div>
                    <!-- content end -->
                    <div class="clearfix"></div>
                    <?php  include("templates/footer-tpl.php"); ?>
                </div>
                <!-- content-holder end -->



<?php 

include("templates/footer.php");

?>
  <!-- DataTables -->
        <script src="js/jquery.dataTables.min.js"></script>

<script>

$('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').removeClass('act-link');
        
        
        
    $( document ).ready(function() {
        FilterNow();
    
    });

    function FilterNow(){
        
          var user_type_val = $("#user_type_val").val();
            var user_id_like = $("#user_id_like").val();

        successFn = function(resp)  {
            $('#ActivityListTable').DataTable().destroy();
            var eventList = resp.data;
        
            $('#ActivityListTable').DataTable({
                "language": {
                    "emptyTable": "No notifications available"
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
                { "data": "id",
                
                        "render": function ( data, type, full, meta ) {
                            return  '<a href="'+full.url+'" onclick="setNotificationRead('+full.id+');"><i class="bi bi-arrow-up-right-square"></i></a>';
                        }
                },
              
                
                ]
            });
        }
        data = {"function": 'Dashboard', "method": "getUserNotification", "user_id":user_id_like ,"user_type":user_type_val  };
        
        apiCall(data,successFn);

    }


 </script>
