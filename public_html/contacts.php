<?php 

include("templates/header.php");

?>
                <!-- content-holder -->
                <div class="content-holder fw-ch hide-dec">
                   
                    <div class="map-container" >
                        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1L6O2qEDd_1j_QhAaI68bXAn8mz--QRQ&ehbc=2E312F" width="2000" height="1200" style="border:0;" 
allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!--content-holder end -->
                
                <script>
                    $('#navLinkMenuHome').removeClass('act-link');
        $('#navLinkMenuAbout').removeClass('act-link');
        $('#navLinkMenuPortfolio').removeClass('act-link');
        $('#navLinkMenuDA').removeClass('act-link');
        $('#navLinkMenuContact').addClass('act-link');
                </script>

<?php 

include("templates/footer.php")

?>