
        <footer class="main-footer" style="padding-left: 20px;padding-right: 20px;" id="footerDiv">
    <div class="policy-box">
        <span>&#169; MI 2022 . All rights reserved. </span>
    </div>
    <div class="footer-social nav-holder">
        <ul class="nav">
            <li style="margin-right: 20px;margin-left: 0px;"><a href="/privacy-policy.php" target="_blank">Privacy Policy </a></li>
            <li style="margin-right: 20px;margin-left: 0px;"><a href="/terms-and-conditions.php" target="_blank">Terms & Conditions</a></li>
            
        </ul>
    </div>
    <div class="footer-social nav-holder">
        <ul class="nav">
            <li><a href="https://www.facebook.com/machooos" target="_blank">Facebook</a></li>
            <li><a href="https://www.instagram.com/machooosinternational/" target="_blank">Instagram</a></li>
            <li><a href="https://twitter.com/Machooos_wed" target="_blank">Twitter</a></li>
            <li><a href="https://g.co/kgs/Mmpk9z" target="_blank">Google</a></li>
            <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?view_as=subscriber" target="_blank">Youtube</a></li>
            <li></li>
        </ul>
    </div>
</footer>
        
        <!--<footer class="footer">-->
        <!--  <div class="container-fluid clearfix">-->
        <!--    <span class="float-right">-->
        <!--        <a href="#">Star Admin</a> &copy; 2017-->
        <!--    </span>-->
        <!--  </div>-->
        <!--</footer>-->

        <!-- partial -->
      </div>
    </div>

  </div>

  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5NXz9eVnyJOA81wimI8WYE08kW_JMe8g&callback=initMap" async defer></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/chart.js"></script>
  <script src="js/maps.js"></script>
  
  <script>
       function logout() {
       
            console.log("data");
            var data = {action: 'logout',ajax:true};
            $.ajax({
                url: '/crm/authentication/logout/api',
                type: 'POST',
                data: data,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    console.log(data.status);
                    //called when successful
                    if (data.status == 1) {
                    window.location.href = "/index.php";
                    }
                },
                error: function (x,h,r) {
                //called when there is an error
                    console.log(x);
                    console.log(h);
                    console.log(r);
                }
            });
            return false;
        }
  </script>
  
  
  
  
</body>

</html>
