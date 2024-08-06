<?php 

include("templates/header.php")

?>
<!-- content-holder -->
<div class="content-holder vis-dec-anim">
    <!-- content -->
    <div class="content">
        <div class="post_header fl-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="hero-title alighn-title">
                            <h4>Beautiful Moments</h4>
                            <h2>The Momentories of Your World</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- container-->
        <div class="container">
            <div class="fl-wrap content-item sec-anim">
                <script src="flipbook/three.min.js"></script>
                <script src="flipbook/pdf.min.js"></script>

                <script type="text/javascript">
                window.PDFJS_LOCALE = {
                    pdfJsWorker: 'flipbook/pdf.worker.js',
                    pdfJsCMapUrl: 'cmaps'
                };
                </script>
                <script src="flipbook/3dflipbook.min.js"></script>

                <script type="text/javascript">
                $('.sample-container').FlipBook({
                    pdf: 'flipbook/CondoLiving.pdf',
                    template: function() {
                        return {
                            html: [{
                                url: 'flipbook/default-book-view.html',
                                data: jsData.urls['flipbook/default-book-view.html']
                            }],
                            script: [{
                                url: 'flipbook/default-book-view.js',
                                data: jsData.urls['flipbook/default-book-view.js']
                            }],
                            styles: [{
                                url: 'css/font-awesome.min.css',
                                data: jsData.urls['css/font-awesome.min.css']
                            }, {
                                url: 'flipbook/black-book-view.css',
                                data: jsData.urls['flipbook/black-book-view.css']
                            }, ],
                            sounds: {
                                "startFlip": "flipbook\/start-flip.mp3",
                                "endFlip": "flipbook\/end-flip.mp3"
                            },
                            init: undefined
                        };
                    }
                });
                </script>
            </div>
            <!-- section end-->
        </div>
        <!-- container end-->
    </div>
    <!-- content end -->
    <div class="clearfix"></div>
    <footer class="main-footer">
        <div class="policy-box">
            <span>&#169; MI 2022 . All rights reserved. </span>
        </div>
        <div class="footer-social">
            <ul>
                <li><a href="https://www.facebook.com/machooos" target="_blank">Facebook</a></li>
                <li><a href="https://www.instagram.com/machooosinternational/" target="_blank">Instagram</a></li>
                <li><a href="https://twitter.com/Machooos_wed" target="_blank">Twitter</a></li>
                <li><a href="https://g.co/kgs/Mmpk9z" target="_blank">Google</a></li>
                <li><a href="https://www.youtube.com/channel/UCosFkEQwFyTVsF-CNRZ7tXA?view_as=subscriber"
                        target="_blank">Youtube</a></li>
            </ul>
        </div>
        <div class="to-top-btn color-bg to-top"><i class="fal fa-long-arrow-up"></i></div>
    </footer>
</div>
<!-- content-holder end -->

<?php 

include("templates/footer.php");

?>