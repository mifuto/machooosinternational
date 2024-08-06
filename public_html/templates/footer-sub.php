</div>
            <!-- wrapper end -->
            <!-- sidebar-->
            <div class="sidebar-wrap">
                
                <div class="sidebar-wrap-container">				
                    <!-- sb-widget-wrap-->
                    <div><i class="fas fa-times-circle" id="closeSidebar" style="font-size: 27px; float: right;}"></i></div>
                    <div id="blk-login" class="sb-widget-wrap fl-wrap">
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

                                    <a href="javascript:void(0);" onclick="showForgot()" style="margin: 30px 0 5px 0;">Forgot password</a>
									
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="blk-forgot-pass" class="sb-widget-wrap fl-wrap" style="display: none">
                        <h3>Forgot Password</h3>
                        <div class="sb-widget  fl-wrap">
                            <!-- <p>This Login for Our Online album </p> -->
                            <div id="blk-forgot-pass-form" class="subcribe-form fl-wrap" style="margin-bottom: 30px;">
                            </div>
                            <a href="javascript:void(0);" onclick="showLogin()" style="margin: 30px 0 5px 0;">Login</a> | <a href="javascript:void(0);" onclick="showRegister()" style="margin: 30px 0 5px 0;">Register</a>
                        </div>
                    </div>
                    <div id="blk-reset-pass" class="sb-widget-wrap fl-wrap" style="display: none">
                        <h3>Reset Password</h3>
                        <div class="sb-widget  fl-wrap">
                            <!-- <p>This Login for Our Online album </p> -->
                            <div id="blk-reset-pass-form" class="subcribe-form fl-wrap" style="margin-bottom: 30px;">
                            </div>
                            <a href="javascript:void(0);" onclick="showLogin()" style="margin: 30px 0 5px 0;">Login</a> | <a href="javascript:void(0);" onclick="showRegister()" style="margin: 30px 0 5px 0;">Register</a>
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

        <!-- <script  src="js/jquery.min.js"></script> -->

        

        <!--=============== scripts  ===============-->  
        <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> -->
        <script src="./js/popper.min.js"></script>
         <!--<script src="./js/bootstrap-datepicker.js"></script> -->
        <script  src="./js/plugins.js"></script>
        <script  src="./js/scripts.js"></script>
        <script  src="./js/appbase.js"></script>
        <script  src="./js/lc_lightbox.lite.js" type="text/javascript"></script>
        <script  src="./js/sharer.min.js"></script>
        <script  src="./admin/assets/js/select2.js"></script>
        <script  src="./js/jquery.justifiedGallery.min.js"></script>
        <script  src="./js/jquery.emojiarea.js"></script>
        <script src="admin/assets/js/sweetalert/sweetalert2.min.js"></script>
        <link href="admin/assets/js/sweetalert/sweetalert2.dark.css" rel="stylesheet">
        <script src="admin/assets/js/sweetalert/MySweetAlert.js"></script>
        <script  src="./js/bootstrap-select.min.js"></script>
        

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

            .tost {
                right: 10px;
                z-index: 99999;
                position: absolute;
                bottom: 10px;
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

            #register-form input, #forgot-password-form input, #blk-reset-pass-form input {
                background-color: none;
                border: 1px solid #e4e4e4;
                font-size: 12px;
                height: 55px;
                padding: 0 20px;
                width: 100%;
                outline: none;
                border-radius: 0;
            }

            #register-form label, #forgot-password-form label, #blk-reset-pass-form label {
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

            #register-form #btn-register, #forgot-password-form button, #blk-reset-pass-form button {
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
            .grid_row--vcenter__3pA74 {
                align-items: center;
            }
            .grid_row--position-relative__21aAJ {
                position: relative;
            }
            .grid_row__2Ynwz {
                display: flex;
            }
            .grid_col--5__zagq7 {
                width: 41.67%;
            }
            .color_color--shade-blue__9lTbQ, .color_color--shade-blue__9lTbQ a {
                color: var(--color-blue);
            }

            .color_color__724I3 {
                transition: color .3s ease-in;
            }
            .icon_icon--size-sm__1JLG6, .icon_icon--size-sm__1JLG6 svg {
                height: 20px;
                width: 20px;
            }

            .icon_icon__3-fTT {
                display: inline-block;
            }
            .grid_space--4px__23yHd {
                margin-right: var(--4px);
            }
            .grid_space__AEDhR {
                display: inline-block;
            }
            .grid_col--9__153gG {
                width: 75%;
                text-align: left;
                padding-left: 10px;
            }
            .text_text--display-block__35429 {
                display: block;
            }
            .text_text--size-5__JFPBK {
                font-size: var(--text-size-5);
                line-height: var(--text-size-5-lh);
            }

            .text_text__1RBPx {
                font-family: var(--font-family-seconday);
                word-break: break-word;
            }
            .text_text--boldness-bold__ePKsm {
                font-weight: var(--font-weight-bold);
            }
            .color_color--shade-dark__2DZUJ {
                color: var(--text-color-dark);
            }
            .color_color__724I3 {
                transition: color .3s ease-in;
            }
            .buttons_grouped-btns--style-default__33LXf .buttons_grouped-btns__btn___oEeK {
                padding: var(--3px) calc(var(--3px) - 1px) var(--3px) var(--3px);
            }
            [type=reset], [type=submit], button, html [type=button] {
                -webkit-appearance: button;
            }
            .buttons_grouped-btns__btn___oEeK, a.buttons_grouped-btns__btn___oEeK {
                background: #fff;
                border: none;
                border-right: 1px solid var(--grouped-btns-border-color);
                color: var(--text-color-dark);
                cursor: pointer;
                display: flex;
            }
            .buttons_grouped-btns__32QS2 {
                background-color: #fff;
                border: 1px solid var(--grouped-btns-border-color);
                border-radius: 4px;
                display: inline-flex;
            }
            .icon_icon--size-md__PF8Ya, .icon_icon--size-md__PF8Ya svg {
                height: var(--icon-size-md);
                width: var(--icon-size-md);
            }
            .buttons_grouped-btns__btn___oEeK {
                background: #f8f8f8;
                color: var(--text-color-dark);
                cursor: pointer;
                display: flex;
                padding: 5px 14px !important;
                border: 1px solid #eee;
            }
            .buttons_grouped-btns__btn___oEeK a {
                font-size: 22px;
            }
            .form-check {
                text-align: left;
            }
            .datepicker-dropdown {
                z-index: 99999999 !important;
            }
            .datepicker td,th{
                text-align: center;
                padding: 8px 12px;
                font-size: 14px;
            }
            .form-select {
                padding: 15px 30px;
                background-color: #eee;
                border: none;
                border-radius: 0;
                margin-bottom: 20px;
                font-size: 12px;
            }
        </style>
        <script>
            
            $(document).ready(function(){
                $('.span2').datepicker();
                initValik();
                var data = {ajax: "true"};

                $.ajax({
                    url: 'crm/authentication/register/api',
                    type: 'GET',
                    data: data,
                    // dataType: "json",
                    success: function (data) {
                        // console.log(data);
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
                        // alert("invalid user name or password");
                    }
                });

                $.ajax({
                    url: 'crm/authentication/forgot_password/api',
                    type: 'GET',
                    data: data,
                    // dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        var html = $.parseHTML(data);
                        
                        var formcontent = $(html).find('#forgot-password-form');

                        $("#blk-forgot-pass-form").html(formcontent);
                        $('#blk-forgot-pass button').attr('type', 'button');
                        $('#blk-forgot-pass button').attr('id', 'btn-forgot-pass');
                        $('#blk-forgot-pass button').attr('onclick', 'return forgotpPassword()');
                    },
                    error: function (x,h,r) {
                        // alert("invalid request");
                    }
                });


                <?php if(isset($_REQUEST['reset_password']) && $_REQUEST['reset_password']==1) { ?>
                    $.ajax({
                        url: 'crm/authentication/reset_password/<?=$_REQUEST['flag']?>/<?=$_REQUEST['uid']?>/<?=$_REQUEST['token']?>',
                        type: 'GET',
                        data: data,
                        // dataType: "json",
                        success: function (data) {
                            // console.log(data);
                            if(isJson(data)) {
                                jdata = JSON.parse(data);
                                if(jdata.status == 1) {
                                    html = '<div class="alert alert-' + jdata.type + ' text-center">'+jdata.message+'</div>';
                                } else {
                                    html = '<div class="alert alert-danger text-center">Something went wrong. Please try after some time.</div>';
                                }

                                $("#subscribe").prepend(html);
                            }else {
                                var html = $.parseHTML(data);
                                
                                var formcontent = $(html).find('form');

                                $("#blk-reset-pass-form").html(formcontent);

                                $('#blk-reset-pass form').attr('id', 'frm-reset-pass');
                                $('#blk-reset-pass button').attr('type', 'button');
                                $('#blk-reset-pass button').attr('id', 'btn-reset-pass');
                                $('#blk-reset-pass button').attr('onclick', 'return resetPassword()');

                                showReset();
                            }

                            $("#btn-sign-in").trigger('click');
                        },
                        error: function (x,h,r) {
                            // alert("invalid request");
                        }
                    });
                <?php } ?>
            });
        </script>

    </body>
</html>
<script>
    function checkUser() {
        // console.log("data");
        var $username = $("#blk-login #username").val();
        var $password = $("#blk-login #password").val();
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

    function forgotpPassword() {
        uri = "crm/authentication/forgot_password/api";
        data = $("#forgot-password-form").serialize() + "&ajax=true";

        $.ajax({
            url: uri,
            type: 'POST',
            data: data,
            // dataType: "json",
            success: function (data) {
                console.log(data);
                if(isJson(data)) {
                    jdata = JSON.parse(data);
                    if(jdata.status == 1) {
                        html = '<div class="alert alert-' + jdata.type + ' text-center">'+jdata.message+'</div>';
                    } else {
                        html = '<div class="alert alert-danger text-center">Something went wrong. Please try after some time.</div>';
                    }

                    $("#blk-forgot-pass-form").prepend(html);
                    $("#blk-forgot-pass-form #email").val("");
                }else {
                    var html = $.parseHTML(data);
                        
                    var formcontent = $(html).find('#forgot-password-form');

                    $("#blk-forgot-pass-form").html(formcontent);
                    $('#blk-forgot-pass button').attr('type', 'button');
                    $('#blk-forgot-pass button').attr('id', 'btn-forgot-pass');
                    $('#blk-forgot-pass button').attr('onclick', 'return forgotpPassword()');
                }
            },
            error: function (x,h,r) {
                html = '<div class="alert alert-danger text-center">Something went wrong. Please try after some time.</div>';
                $("#blk-forgot-pass-form").prepend(html);
                $("#blk-forgot-pass-form #email").val("");
            }
        });
    }

    function showLogin() {
        $(".sidebar-wrap-container").find('.alert').remove();
        $("#blk-login").css("display", "block");
        $("#blk-forgot-pass").css("display", "none");
        $("#blk-reset-pass").css("display", "none");
    }

    function showForgot() {
        $(".sidebar-wrap-container").find('.alert').remove();
        $("#blk-login").css("display", "none");
        $("#blk-forgot-pass").css("display", "block");
        $("#blk-reset-pass").css("display", "none");
    }

    function showReset() {
        $(".sidebar-wrap-container").find('.alert').remove();
        $("#blk-login").css("display", "none");
        $("#blk-forgot-pass").css("display", "none");
        $("#blk-reset-pass").css("display", "block");
    }

    function showRegister() {
        $(".sidebar-wrap-container").find('.alert').remove();
        showLogin()
        $("#registerModal").modal('show');
    }

    <?php if(isset($_REQUEST['reset_password']) && $_REQUEST['reset_password']==1) { ?>
        function resetPassword() {
            uri = 'crm/authentication/reset_password/<?=$_REQUEST['flag']?>/<?=$_REQUEST['uid']?>/<?=$_REQUEST['token']?>';
            data = $("#frm-reset-pass").serialize() + "&ajax=true";

            $.ajax({
                url: uri,
                type: 'POST',
                data: data,
                // dataType: "json",
                success: function (data) {
                    console.log(data);
                    if(isJson(data)) {
                        jdata = JSON.parse(data);
                        if(jdata.status == 1) {
                            html = '<div class="alert alert-' + jdata.type + ' text-center">'+jdata.message+'</div>';
                            if(jdata.type == 'success') {
                                showLogin();
                                $("#subscribe").prepend(html);
                            } else {
                                $("#blk-reset-pass-form").prepend(html);
                            }
                        } else {
                            html = '<div class="alert alert-danger text-center">Something went wrong. Please try after some time.</div>';
                        }
                        
                        $("#blk-reset-pass-form #password").val("");
                        $("#blk-reset-pass-form #passwordr").val("");
                    }else {
                        var html = $.parseHTML(data);
                            
                        var formcontent = $(html).find('form');

                        $("#blk-reset-pass-form").html(formcontent);

                        $('#blk-reset-pass form').attr('id', 'frm-reset-pass');
                        $('#blk-reset-pass button').attr('type', 'button');
                        $('#blk-reset-pass button').attr('id', 'btn-reset-pass');
                        $('#blk-reset-pass button').attr('onclick', 'return resetPassword()');
                    }
                },
                error: function (x,h,r) {
                    html = '<div class="alert alert-danger text-center">Something went wrong. Please try after some time.</div>';
                    $("#blk-reset-pass-form").prepend(html);
                    $("#blk-reset-pass-form #password").val("");
                    $("#blk-reset-pass-form #passwordr").val("");
                }
            });
        }
    <?php } ?>

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

</script>