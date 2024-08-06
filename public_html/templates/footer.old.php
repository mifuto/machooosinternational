            </div>
            <!-- wrapper end -->
            <!-- sidebar-->
            <div class="sidebar-wrap">
                
                <div class="sidebar-wrap-container">				
                    <!-- sb-widget-wrap-->
                    <div><i class="fas fa-times-circle" id="closeSidebar" style="font-size: 27px; float: right;
}"></i></div>
                    <div class="sb-widget-wrap fl-wrap">
                        <h3>Customer Login</h3>
                        <div class="sb-widget  fl-wrap">
                            <!-- <p>This Login for Our Online album </p> -->
                            <div class="subcribe-form fl-wrap">
                                <form id="subscribe">
                                    <input class="enteremail" name="email" id="username" placeholder="USERNAME" spellcheck="false" type="text">
									<input class="enteremail" name="password" id="password" placeholder="PASSWORD" spellcheck="false" type="password">
                                    
                                    <button type="submit" id="subscribe-button" class="subscribe-button" onclick="checkUser();">Submit</button>
                                    
                                    <button type="button" id="register-button" class="subscribe-button register-button" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
									
                                    <label for="subscribe-email" class="subscribe-message" ></label>
                                    <a href="crm/authentication/forgot_password" style="margin: 30px 0 5px 0;">Forgot password</a>
									<!-- <div data-mc-src="49e5553a-09d5-4445-821f-de2d749a8cb6#instagram"></div> -->
        
                                    <!-- <script 
                                    src="https://cdn2.woxo.tech/a.js#6357872aa9490458b8a6f710" 
                                    async data-usrc>
                                    </script> -->
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <!-- sb-widget-wrap end-->			
                </div>
            </div>
            <div class="sb-overlay"></div>
            <!-- sidebar end-->
            <!-- progress-bar  -->
            <div class="progress-bar-wrap hide_pw">
                <div class="progress-bar color-bg"></div>
            </div>
            <!-- progress-bar end -->			
            <!-- content-bg -->	
            <div class="content-bg hide_cb"></div>
            <!-- content-bg end -->
            <div class="pl-spinner"></div>
            <!-- cursor-->
            <div class="element">
                <div class="element-item"></div>
            </div>
            <!-- cursor end-->			
        </div>

        <!-- Main end -->

        <div class="modal" id="registerModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3>Customer Registration</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" id="registerModalBody">
                        
                    </div>

                    <!-- Modal footer 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>-->

                </div>
            </div>
        </div>

        <!--=============== scripts  ===============-->  
        <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script  src="./js/plugins.js"></script>
        <script  src="./js/scripts.js"></script>
        <script  src="./js/appbase.js"></script>
        <script  src="./js/lc_lightbox.lite.js" type="text/javascript"></script>
        <script  src="./js/sharer.min.js"></script>
        <script  src="./admin/assets/js/select2.js"></script>
        <script  src="./js/jquery.justifiedGallery.min.js"></script>

        <style>
            #register .enteremail {
                background-color: none;
                border: 1px solid #e4e4e4;
                font-size: 12px;
                height: 55px;
                padding: 0 20px;
                width: 100%;
                outline: none;
            }

            .register-button {
                margin-top: 10px;
                width: 100%;
                height: 55px;
                float: right;
                background: #292929;
                color: #fff;
                font-weight: 700;
                border: none;
                font-size: 11px;
                cursor: pointer;
                border-radius: 0;
            }

            #register-form input {
                background-color: none;
                border: 1px solid #e4e4e4;
                font-size: 12px;
                height: 55px;
                padding: 0 20px;
                width: 100%;
                outline: none;
                border-radius: 0;
            }

            #register-form label {
                margin-top: 5px;
                display: block;
                text-align: left;
            }

            .select2-container {
                width: 100% !important;
                border-radius: 0;
                height: 55px;
                z-index: 99999;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 55px;
                text-align: left;
            }

            .select2-container--default .select2-selection--single {
                width: 100% !important;
                border-radius: 0;
                border: 1px solid #e4e4e4;
                height: 55px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                top: 15px;
            }

            .select2-results__option {
                text-align: left;
            }

            .select2-search--dropdown .select2-search__field {
                height: 55px;
                z-index: 100000;
            }

            #register-form .input-group.date .input-group-addon {
                display: none;
                position: absolute;
                right: 15px;
                top: 20px;
            }

            .register-contact-info-heading, .register-company-info-heading {
                display: none;
            }

            #register-form #btn-register {
                margin-top: 10px;
                width: 100%;
                height: 55px;
                float: right;
                background: #292929;
                color: #fff;
                font-weight: 700;
                border: none;
                font-size: 11px;
                cursor: pointer;
                border-radius: 0;
            }
        </style>
        <script>
            $(document).ready(function(){
                var data = {ajax: "true"};

                $.ajax({
                    url: 'crm/authentication/register/api',
                    type: 'GET',
                    data: data,
                    // dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var html = $.parseHTML(data);
                        
                        var formcontent = $(html).find('#register-form');

                        $("#registerModalBody").html(formcontent);

                        $('#registerModalBody select').select2({
                            dropdownParent: $("#registerModalBody")
                        });

                        $('#registerModalBody .register-company-custom-fields input.datepicker').attr('type', 'date');
                        $('#registerModalBody button').attr('type', 'button');
                        $('#registerModalBody button').attr('id', 'btn-register');
                        $('#registerModalBody button').attr('onclick', 'return registerUser()');
                    },
                    error: function (x,h,r) {
                        //called when there is an error
                        // console.log(x);
                        // console.log(h);
                        // console.log(r);
                        alert("invalid user name or password");
                    }
                });


                // $('#customers').select2({
                //     dropdownParent: $("#registerModalBody")
                // });
                // $('#country').select2({
                //     dropdownParent: $("#registerModalBody")
                // });
            });
        </script>
    </body>
</html>
<script>
    function checkUser() {
        // console.log("data");
        var $username = $("#username").val();
        var $password = $("#password").val();
        var data = {action: 'checkUser', email: $username, password: $password, ajax:true};
        $.ajax({
            url: 'crm/authentication/login/api',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                // console.log(data.status);
                //called when successful
                if (data.status == 1) {

                    window.location.href = "index.php";
                } else alert("invalid user name or password");
            },
            error: function (x,h,r) {
                //called when there is an error
                // console.log(x);
                // console.log(h);
                // console.log(r);
                alert("invalid user name or password");
            }
        });
        return false;
    }
    
    function logout() {
        console.log("data");
        var data = {action: 'logout',ajax:true};
        $.ajax({
            url: 'crm/authentication/logout/api',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                console.log(data.status);
                //called when successful
                if (data.status == 1) {
                window.location.href = "index.php";
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

    function registerUser() {

        data = $("#register-form").serialize() + "&ajax=true";

        $.ajax({
            url: 'crm/authentication/register/api',
            type: 'POST',
            data: data,
            // dataType: "json",
            success: function (data) {
                console.log(data);
                if(isJson(data)) {
                    console.log("get json data");
                    window.location.reload();
                }else {
                    var html = $.parseHTML(data);
                
                    var formcontent = $(html).find('#register-form');

                    $("#registerModalBody").html(formcontent);

                    $('#registerModalBody select').select2({
                        dropdownParent: $("#registerModalBody")
                    });

                    $('#registerModalBody .register-company-custom-fields input.datepicker').attr('type', 'date');
                    $('#registerModalBody button').attr('type', 'button');
                    $('#registerModalBody button').attr('id', 'btn-register');
                    $('#registerModalBody button').attr('onclick', 'return registerUser()');
                }
            },
            error: function (x,h,r) {
                //called when there is an error
                // console.log(x);
                // console.log(h);
                // console.log(r);
                alert("invalid user name or password");
            }
        });
    }

    

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

</script>