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
                                    <div id="messageSubscribe" class="text-danger" style="text-align: left;"></div>
                                    <input class="enteremail" name="email" id="username" placeholder="USERNAME" spellcheck="false" type="text">
									<input class="enteremail" name="password" id="password" placeholder="PASSWORD" spellcheck="false" type="password">
                                    
                                    <button type="submit" id="subscribe-button" class="subscribe-button" onclick="checkUser();">Submit</button>
                                    
                                    <button type="button" id="register-button" class="subscribe-button register-button" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
									
                                    <label  class="subscribe-message" ></label>

                                    <a href="javascript:void(0);" onclick="showForgot()" style="margin: 30px 0 5px 0;" class="new-text-sub-fond-link">Forgot password</a>
									
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="blk-forgot-pass" class="sb-widget-wrap fl-wrap" style="display: none">
                        <h3 class="new-text-sub-fond">Forgot Password</h3>
                        <div class="sb-widget  fl-wrap">
                            <!-- <p>This Login for Our Online album </p> -->
                            <div id="blk-forgot-pass-form" class="subcribe-form fl-wrap" style="margin-bottom: 30px;">
                            </div>
                            <a href="javascript:void(0);" onclick="showLogin()" style="margin: 30px 0 5px 0;" class="new-text-sub-fond-link">Login</a> | <a href="javascript:void(0);" onclick="showRegister()" class="new-text-sub-fond-link" style="margin: 30px 0 5px 0;">Register</a>
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
                    
                    <div id="blk-setStateCountry" class="sb-widget-wrap fl-wrap" style="display: none">
                        <h3 class="new-text-sub-fond">Select State</h3>
                        <div class="sb-widget  fl-wrap">
                            <!-- <p>This Login for Our Online album </p> -->
                            <div id="blk-forgot-pass-form" class="subcribe-form fl-wrap" style="margin-bottom: 30px;">
                            </div>
                            <a href="javascript:void(0);" onclick="showLogin()" style="margin: 30px 0 5px 0;" class="new-text-sub-fond-link">Login</a> | <a href="javascript:void(0);" onclick="showRegister()" class="new-text-sub-fond-link" style="margin: 30px 0 5px 0;">Register</a>
                        </div>
                    </div>
                    
                    
                    
                    
                    <!-- sb-widget-wrap end-->	
                    <div>
                        <div loading="lazy" data-mc-src="4f9bb84e-1d2a-4fc6-ac58-b6e72c478d99#null"></div>
                        <!--<script src="https://cdn2.woxo.tech/a.js#6357872aa9490458b8a6f710" async data-usrc></script>-->
                        <script 
                          src="https://cdn2.woxo.tech/a.js#649e89aa7346240ed1519abe" 
                          async data-usrc>
                        </script>
                    </div>
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
        
       
        

        <!--=============== scripts  ===============-->  
        <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <script  src="./admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script> -->
        <script src="./js/popper.min.js"></script>
        <script src="./js/bootstrap-datepicker.js"></script>
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
        <script  src="./js/infinityScroll.min.js"></script>
        <script  src="./js/jquery.imagesloaded.min.js"></script>
        
       

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
            
            .masonry-layout {
              --columns: 1;
              --gap: 2rem;
              box-sizing: border-box;
              display: grid;
              grid-template-columns: repeat(var(--columns), 1fr);
              grid-gap: var(--gap);
              padding: 2rem;
            }
            .masonry-layout > div > img,
            .masonry-layout > div > div {
              width: 100%;
              margin-bottom: 2rem;
            }
            .masonry-layout.columns-1 {
              --columns: 1;
            }
            .masonry-layout.columns-2 {
              --columns: 2;
            }
            .masonry-layout.columns-3 {
              --columns: 3;
            }
            .masonry-layout.columns-4 {
              --columns: 4;
            }
            
            .grid {
              background: #DDD;
            }
            
            /* clear fix */
            .grid:after {
              content: '';
              display: block;
              clear: both;
            }
            
            /* ---- .grid-item ---- */
            
            .grid-sizer,
            .grid-item {
              width: 25%;
            }
            
            .grid-item {
              float: left;
              position: relative;
            }
            
            .grid-item img {
              display: block;
              width: 100%;
            }
            
           @media only screen and (max-width: 768px) {
              .grid-item {
                width: 50%;
              }
            }
            
            @media only screen and (min-width: 1000px) {
              .grid-item {
                width: 25%;
              }
            }
            
            @media (min-width: 1700px) {
              .grid-item {
                width: 25%;
              }
            }
            
            @media (min-width: 2100px) {
              .grid-item {
                width: 20%;
              }
            }
            
            
        </style>
        <script>
        
        var user_state_val = '<?=$user_state_val?>';
        var user_county_val = '<?=$user_county_val?>';
        var user_sel_account_type = '<?=$user_sel_account_type?>';

            
            $(document).ready(function(){
                $('.span2').datepicker();
                initValik();
                var data = {ajax: "true"};
                
                // $('#SCModal').modal({
                //     backdrop: 'static',
                //     keyboard: false
                // });
                
                if(user_sel_account_type == ""){
                    showSelAccountType();
                }else{
                    
                    if(user_sel_account_type == 'Guest'){
                         if(user_state_val == "" || user_county_val == ''){
                            setStateCountry();
                            
                        }else {
                            getandshowPopup(2);
                        }
                    }else{
                        $("#btn-sign-in").trigger('click');
                        var contact_user_id = "<?=$contact_user_id?>";
                        if(contact_user_id != ""){
                            getandshowPopup(1);
                        }

                        
                    }
                    
                    
                   
                }
                

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
                        
                        changeCountry();
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

    function closeConvertBtn(){
        $("#mydiv-draggable").addClass('d-none');
    }
    
    function convertToCustomer(){
        var state_val = user_state_val;
       var county_val = user_county_val;
       var state_name = '<?=$state_name?>';
       $("#country").val(county_val).trigger('change');
       
       var guestUserName = '<?=$guestUserName?>';
       var guestUserEmail = '<?=$guestUserEmail?>';
       var guestUserPhone = '<?=$guestUserPhone?>';
        var nameArray = guestUserName.split(' ');
        if (nameArray.length >= 1) {
            $("#firstname").val(nameArray[0]);
        }
        
        if (nameArray.length >= 2) {
            $("#lastname").val(nameArray[1]);
        }
       
       $("#email").val(guestUserEmail);
       $("#contact_phonenumber").val(guestUserPhone);

       
       
       
       
       changeCountry(state_name);
        getEventType(state_name);
     
       showRegister();
      
        
    }

    function closePopup(){
        $("#staticBackdrop").modal('hide');
    }

    function getandshowPopup(val){
       var popup_show_id = "<?=$popup_show_id?>";
       var state_val = user_state_val;
       var county_val = user_county_val;

        successFn = function(resp)  {
            if(resp.status == 1){
                var data = resp.data;
                var arrayLength = data.length;
                if(arrayLength > 0){
                    var dataArr = data[0];
                    
                    if(popup_show_id != dataArr['id'] ){
                          var dishtml = '<a href="'+dataArr['url_address']+'"><div class="text-center image-container-pop mt-2"> <img src="/admin/'+dataArr['image']+'" ></div></a>';
                        //  if(dataArr['url_address'] != ""){
                        //       dishtml += '<div class="text-white mt-2"><div> <a href="'+dataArr['url_address']+'" class="btn text-white" style="background: #804bd8;">View details</a></div></div>';
                         
                        //  }
                         
                         $('#popupWindow').html(dishtml);
                         $("#staticBackdrop").modal('show');
                         setCookie('popup_show_id', dataArr['id'], 30);
                    }

                     
                   
                }
               
            }
       
         
          
        }
        data = { "function": 'SystemManage',"method": "getandshowPopup" , "state_val":state_val, "county_val":county_val ,"userType":val };
        
        apiCall(data,successFn);
       
       
       
       
      
       
    }


    function checkUser() {
        // console.log("data");
        var $username = $("#blk-login #username").val();
        var $password = $("#blk-login #password").val();
        $('#messageSubscribe').html('');
        if($username == "") {
            $('#messageSubscribe').html('Please enter username');
            return false;
        }
        
        if($password == "") {
            $('#messageSubscribe').html('Please enter password');
            return false;
        }
        
        
        
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

                    window.location.reload();
                } else $('#messageSubscribe').html('invalid user name or password');
            },
            error: function (x,h,r) {
                //called when there is an error
                // console.log(x);
                // console.log(h);
                // console.log(r);
                // alert("invalid user name or password");
                $('#messageSubscribe').html('invalid user name or password');
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
                    setCookie('user_state_val', '', 30);
                    setCookie('user_county_val', '', 30);
                    setCookie('user_sel_account_type', '', 30);
                    
                    setCookie('popup_show_id', '', 30);

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
    
    
    
    function changeCountry(val1="",val2="",selET=""){
        var selCounty = $('#country').val();
        
         successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select State</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.state+"'>"+value.state+"</option>";
      });
    //   alert("#"+selectId);

      $("#state").html(options);
      $("#state").select2();
      if(val1 !="") $("#state").val(val1).trigger('change');
      
         
      changeState(val2,selET);
      
     
      
    }
    data = { "function": 'SystemManage',"method": "getState" , "selCounty":selCounty};
    
    apiCall(data,successFn);
        
        
        
        
    }
    
    function changeState(val2="",val3=""){
        
        
        var selState = $('#state').val();
        
          successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select District</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.city+"'>"+value.city+"</option>";
      });
    //   alert("#"+selectId);

      $("#city").html(options);
      $("#city").select2();
      
      if(val2 !="")$("#city").val(val2).trigger('change');
      
      
      getEventType(selState,val3);
      
     
      
    }
    data = { "function": 'SystemManage',"method": "getCity" , "selState":selState};
    
    apiCall(data,successFn);
        
        
      
        
    }
    
    
    function getEventType(selState,val2=""){
        
      
          successFn = function(resp)  {
        // resp = JSON.parse(resp);
      
      var users = resp["data"];
      var options = "<option selected value=''>Select Event type</option>";
      $.each(users, function(key,value) {
        // console.log(value.id);
        options += "<option value='"+value.name+"'>"+value.name+"</option>";
      });
    //   alert("#"+selectId);

      $("[name='custom_fields[customers][2]']").html(options);
      $("[name='custom_fields[customers][2]']").select2();
      
      if(val2 !="")$("[name='custom_fields[customers][2]']").val(val2).trigger('change');
      
   
      
    }
    data = { "function": 'SystemManage',"method": "getET" , "selState":selState};
    
    apiCall(data,successFn);
        
        
      
        
    }
    
    
    
    
    
    
    
    

    function registerUser() {
        
        var selState = $('#state').val();
        var selCity = $('#city').val();
        
        if(selState ==""){
            $('#errState').removeClass('d-none');
            return false;
        }
        
         $('#errState').addClass('d-none');
        
         if(selCity ==""){
            $('#errCity').removeClass('d-none');
            return false;
        }
        
        var selET = $("[name='custom_fields[customers][2]']").val();
        
      
      $('#errCity').addClass('d-none');

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
                    
                    changeCountry(selState,selCity,selET);
                    getEventType(selState,selET);

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
    
    function logoutGuestUser(){
        setCookie('guestLoginId', '', 30);
        setCookie('guestLoginName', '', 30);
        setCookie('guestLoginEmail', '', 30);
        setCookie('guestLoginPhone', '', 30);
        
        setCookie('user_state_val', '', 30);
        setCookie('user_county_val', '', 30);
        setCookie('user_sel_account_type', '', 30);
        
        setCookie('popup_show_id', '', 30);

        
        
        location.reload();

    }
    
   
    
    function setCookie(name, value, expirationDays) {
        const expirationDate = new Date();
        expirationDate.setTime(expirationDate.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + expirationDate.toUTCString();
        document.cookie = name + "=" + value + "; " + expires + "; path=/";
    }
    
    function showGuestUserModal(){
        getSCCounty("selSCCounty");
        getSCState('selSCState');
        
        
        $("#page1").removeClass('d-none');
            $("#page2").addClass('d-none');
            $("#page3").addClass('d-none');
            $('#loginSCErr').addClass('d-none');
            $('#otpSCErr').addClass('d-none');
            $('#otpInfo').html('');
            
            $('#frstSCErr').addClass('d-none');
            $('#frstSCErr').html('');
            
        
             
            $("#SCModal").modal('show');
        
        return false;
         
        $('#loginGuestUser').modal('show');
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

    function setNotificationRead(id){
        successFn = function(resp)  {
           console.log(resp)
        }
        data = {"function": 'Dashboard', "method": "setNotificationRead", "notfy_id":id };
        
        apiCall(data,successFn);
    }
    
     function setAllNotificationRead(userId,userType){
        successFn = function(resp)  {
           console.log(resp);
            window.location.reload();
           
        }
        data = {"function": 'Dashboard', "method": "setAllNotificationRead", "userId":userId,"userType":userType };
        
        apiCall(data,successFn);
    }
    
    
    
    
    function addCart(albumID,albumType,id,imageCount=0){
        var quantity = $('#quantity_'+id).val();
        var user_id = '<?=$contact_user_id?>';
      
         var postData = {
            function: 'AlbumSubscription',
            method: "addCart",
            albumID: albumID,
            albumType: albumType,
           quantity: quantity,
           'imageCount':imageCount,
           'user_id':user_id,
          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (data) {
                console.log(data);
                console.log(data.status);
                //called when successful
                if (data.status == 1) {
                    
                  location.reload();
               
                }
               
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                console.log(h);
                console.log(r);
               
            }
        });
        
    }
    
    function gotoCart(){
        window.location.href = '/dashboard/cart.php';

    }
    
    
    function showSelAccountType(){
        window.onload = function() {
            $("#AccountTypeModal").modal('show');
        }
       
    }
    
    function setGuestUser(){
        $("#AccountTypeModal").modal('hide');
        setCookie('user_sel_account_type', 'Guest', 30);
        window.location.reload();
       
    }
    
    function setCustomerUser(){
        $("#AccountTypeModal").modal('hide');
        setCookie('user_sel_account_type', 'Customer', 30);
        window.location.reload();
    }
    
    
    
    
    
    
    
    function setStateCountry(){
        
        getSCCounty("selSCCounty");
        getSCState('selSCState');
             
        
        window.onload = function() {
            
            $("#page1").removeClass('d-none');
            $("#page11").addClass('d-none');
                $("#page2").addClass('d-none');
                $("#page3").addClass('d-none');
                $('#loginSCErr').addClass('d-none');
                $('#otpSCErr').addClass('d-none');
                $('#otpInfo').html('');
                
                $('#frstSCErr').addClass('d-none');
                $('#frstSCErr').html('');
            
        
             
            $("#SCModal").modal('show');
        };
    
  

    }
    
    
    function getSCCounty(selectId) {
        
          var postData = {
            function: 'SystemManage',
            method: "getCountries",

          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (resp) {
                
                var users = resp["data"];
                var options = "<option selected value=''>-- Select your country -- </option>";
                
                // Check if users is an array and not empty
                if (Array.isArray(users) && users.length > 0) {
                    // Loop through the array and build the options
                    $.each(users, function (key, value) {
                        // Make sure the properties exist in your data
                        if (value.country_id !== undefined && value.short_name !== undefined) {
                            options += "<option value='" + value.country_id + "'>" + value.short_name + "</option>";
                        }
                    });
                
                    // Set options
                    
                } 
                
                $("#" + selectId).html(options);

            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
        
        
    }


  function getSCState(selectId) {
      var selCounty = '';
      
       selCounty = document.getElementById('selSCCounty').value;
      
      
          var postData = {
            function: 'SystemManage',
            method: "getState",
            "selCounty":selCounty,

          }
      
        $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (resp) {
                
                var users = resp["data"];
                var options = "<option selected value=''>-- Select your state --</option>";
                
                // Check if users is an array and not empty
                if (Array.isArray(users) && users.length > 0) {
                    // Loop through the array and build the options
                    $.each(users, function (key, value) {
                        // Make sure the properties exist in your data
                        if (value.state !== undefined && value.state !== undefined) {
                            options += "<option value='" + value.state + "'>" + value.state + "</option>";
                        }
                    });
                
                    // Set options
                    
                } 
                
                $("#" + selectId).html(options);
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
      
      
      
      
      
    
}


function applySCNew(){
      
        $('#frstSCErr').addClass('d-none');
        $('#frstSCErr').html('');
        
        
        SCemail = document.getElementById('SCemail').value;

        
        if(SCemail == ""){
             $('#frstSCErr').removeClass('d-none');
            $('#frstSCErr').html('Please enter email');
            document.getElementById('SCemail').focus();
            return false;
        }
        
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(SCemail)) {
             $('#frstSCErr').removeClass('d-none');
            $('#frstSCErr').html('Please enter valid email');
            document.getElementById('SCemail').focus();
            return false;
        }
        
      
        
      var postData = {
        function: 'Comments',
        method: "checkUserAndUpdateNew",
        "email":SCemail,
       

      }
      
       $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (resp) {
                
                if(resp.status == 1){
                    $("#page1").addClass('d-none');
                    $("#page2").addClass('d-none');
                    $("#page3").addClass('d-none');
                    $("#page11").removeClass('d-none');
                    $('#otpSCErr').addClass('d-none');
                    

                    $('#frstSCErr').addClass('d-none');
                    $('#frstSCErr').html('');
                    
                    
                }else if(resp.status == 2){
                    $("#page1").addClass('d-none');
                    $("#page2").removeClass('d-none');
                    $("#page3").addClass('d-none');
                    $("#page11").addClass('d-none');
                     $('#loginSCErr').addClass('d-none');
                     
                     $('#frstSCErr').addClass('d-none');
                    $('#frstSCErr').html('');
                    
                }else if(resp.status == 3){
                    $('#frstSCErr').removeClass('d-none');
                    $('#frstSCErr').html(resp.data);
                    
                }else{
                    window.location.reload();
                }
                
                
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
        return false;
       
    }
        
          
    function applySC(){
        selCounty = document.getElementById('selSCCounty').value;
        selState = document.getElementById('selSCState').value;
        
        $('#frst1SCErr').addClass('d-none');
        $('#frst1SCErr').html('');
        
        
        SCname = document.getElementById('SCname').value;
        SCemail = document.getElementById('SCemail').value;
        SCphone = document.getElementById('SCphone').value;

        if(selCounty == ""){
            $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please select county');
            document.getElementById('selSCCounty').focus();
            return false;
        }
        
        if(selState == ""){
            $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please select state');
            document.getElementById('selSCState').focus();
            return false;
        }
        
        
         if(SCname == ""){
             $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please enter name');
            document.getElementById('SCname').focus();
            return false;
        }
        
        if(SCemail == ""){
             $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please enter email');
            document.getElementById('SCemail').focus();
            return false;
        }
        
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(SCemail)) {
             $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please enter valid email');
            document.getElementById('SCemail').focus();
            return false;
        }
        
         if(SCphone == ""){
              $('#frst1SCErr').removeClass('d-none');
            $('#frst1SCErr').html('Please enter phone');
            document.getElementById('SCphone').focus();
            return false;
        }
        
        
      var postData = {
        function: 'Comments',
        method: "checkUserAndUpdate",
        "name":SCname,
        "email":SCemail,
        "phone":SCphone,
        'selCounty':selCounty,
        'selState':selState,
        'callFrom':'Machooos kids'

      }
      
       $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (resp) {
                
                if(resp.status == 1){
                    $("#page1").addClass('d-none');
                    $("#page2").addClass('d-none');
                    $("#page3").removeClass('d-none');
                    $('#otpSCErr').addClass('d-none');
                    $("#page11").addClass('d-none');
                    $('#otpInfo').html('Otp send to '+SCemail);
                    
                    $('#frst1SCErr').addClass('d-none');
                    $('#frst1SCErr').html('');
                    
                    
                }else if(resp.status == 2){
                    $("#page1").addClass('d-none');
                    $("#page2").removeClass('d-none');
                    $("#page3").addClass('d-none');
                    $("#page11").addClass('d-none');
                     $('#loginSCErr').addClass('d-none');
                     
                     $('#frst1SCErr').addClass('d-none');
                    $('#frst1SCErr').html('');
                    
                }else if(resp.status == 3){
                    $('#frst1SCErr').removeClass('d-none');
                    $('#frst1SCErr').html(resp.data);
                    
                }else{
                    window.location.reload();
                }
                
                
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
               
            }
        });
        
        
        
        return false;
       
    }
    
    function loginSC(){
        
        $username = document.getElementById('SCemail').value;
        $password = document.getElementById('SCpassword').value;
        
        $('#loginSCErr').addClass('d-none');
        $('#loginSCErr').html('');
        
        if($password == ""){
            $('#loginSCErr').removeClass('d-none');
            $('#loginSCErr').html('Please enter password');
            document.getElementById('SCpassword').focus();
            return false;
        }
         
        var data = {action: 'checkUser', email: $username, password: $password, ajax:true};
        $.ajax({
            url: '/crm/authentication/login/api',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    window.location.reload();
                } else{
                    $('#loginSCErr').removeClass('d-none');
                    $('#loginSCErr').html('Invalid password');
                };
            },
            error: function (x,h,r) {
                 $('#loginSCErr').removeClass('d-none');
                 $('#loginSCErr').html('Something went wrong please try again');
            }
        });
        return false;
    }
    
    function validateSC(){
        SCemail = document.getElementById('SCemail').value;
        SCotp = document.getElementById('SCotp').value;
         selCounty = document.getElementById('selSCCounty').value;
        selState = document.getElementById('selSCState').value;
        
        $('#otpSCErr').addClass('d-none');
        $('#otpSCErr').html('');
        
        
        if(SCotp == ""){
            $('#otpSCErr').removeClass('d-none');
            $('#otpSCErr').html('Please enter otp');
            document.getElementById('SCotp').focus();
            return false;
        }
        
          var postData = {
            function: 'Comments',
            method: "validateSCOTP",
            "token":SCotp,
            "UserEmail":SCemail,
             'selCounty':selCounty,
            'selState':selState,
          
          }
      
       $.ajax({
            url: '/admin/ajaxHandler.php',
            type: 'POST',
            data: postData,
            dataType: "json",
            success: function (resp) {
                if (resp.status == 1) {
                    window.location.reload();
                } else{
                    $('#otpSCErr').removeClass('d-none');
                    $('#otpSCErr').html('Authentication failed');
                };
                
            },
            error: function (x,h,r) {
            //called when there is an error
                console.log(x);
                $('#otpSCErr').removeClass('d-none');
                 $('#otpSCErr').html('Something went wrong please try again');
               
            }
        });
        
        
        
        return false;
        
        
    }
    
    
    

</script>

<script>

$(document).ready(function() {
  var toggle = $('#bubble_lever');
  var menu = $('#bubble_menu');
  var rot;
  
  $('#bubble_lever').on('click', function() {
    rot = parseInt($(this).data('rot')) - 180;
    menu.css('transform', 'rotate(' + rot + 'deg)');
    menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
    if ((rot / 180) % 2 == 0) {
      //Moving in
      toggle.parent().addClass('ss_active');
      toggle.addClass('close');
    } else {
      //Moving Out
      toggle.parent().removeClass('ss_active');
      toggle.removeClass('close');
    }
    $(this).data('rot', rot);
  });

  menu.on('transitionend webkitTransitionEnd oTransitionEnd', function() {
    if ((rot / 180) % 2 == 0) {
      $('#bubble_menu div i').addClass('ss_animate');
      $('#shortMainMenu').addClass('hide');
      $('#shortMainSubMenu').removeClass('hide');
      
    } else {
      $('#bubble_menu div i').removeClass('ss_animate');
      $('#shortMainSubMenu').addClass('hide');
      $('#shortMainMenu').removeClass('hide');
    }
  });
  
});
    
    
    
</script>

