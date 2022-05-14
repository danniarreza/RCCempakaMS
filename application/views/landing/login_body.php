<!-- <body background="<?php echo base_url("assets/image/skin-care1.jpg");?>"> -->

<body>

    <div class="login-box">
        <div class="login-logo" style="margin-top:150px">
            <a href="../../index2.html"><b>RC </b>Cempaka</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in untuk masuk ke dalam sistem</p>
            
            <form action="<?php echo site_url('Dashboard/')?>" method="post" onsubmit="return loginAttempt();">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Nama User"
                        value="">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div id="login_form_group">
                    <div class="col-xs-9">
                        <span class="help-block" id="login_span"></span>
                    </div>
                    <div class="col-xs-3" style="text-align:right">
                        <span class="help-block" id="icon_span"></span>
                    </div>


                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>


        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- Footer. Contains Footer, Control Sidebar, JQuery and Script Source  -->
    <?php $this->view('shared/footer_landing', $footer)?>

    <script type="text/javascript">
    function loginAttempt() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        var data = new FormData();
        data.append('username', username);
        data.append('password', password);

        var method = 'POST';
        var url = "<?php echo site_url('Login/loginAttemptHandler/')?>";

        // console.log(username);

        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.onload = function() {
            var response = JSON.parse(this.responseText);
            console.log(response);

            if (response.length > 0) {
                // console.log('Berhasil!');
                document.getElementById('login_form_group').setAttribute("class", "form-group has-success");
                document.getElementById('login_span').innerHTML = "Login Berhasil !";

                setTimeout(function() {
                    document.getElementById('icon_span').innerHTML =
                        '<i class="fa fa-spin fa-refresh"></i>&nbsp;';
                }, 100);

                setTimeout(function() {
                    if(response[0].NAME_USER_TYPE == 'Super Admin' || response[0].NAME_USER_TYPE == 'Admin'){
                        window.location = "<?php echo site_url('Dashboard/')?>";
                    } else if (response[0].NAME_USER_TYPE == 'Therapist'){
                        window.location = "<?php echo site_url('Stock/')?>";
                    } 
                }, 1000);

            } else if (response.length == 0) {
                // console.log('Username atau password salah!!');
                document.getElementById('login_form_group').setAttribute("class", "form-group has-error");
                document.getElementById('login_span').innerHTML = "Username atau password salah !";

                document.getElementById('icon_span').innerHTML = '<i class="fa fa-exclamation-triangle"></i>&nbsp;';
            } else {
                // console.log('Gagal!');
                document.getElementById('login_form_group').setAttribute("class", "form-group has-error");
                document.getElementById('login_span').innerHTML =
                    "Ups, sepertinya ada kesalahan sistem ketika login";

                document.getElementById('icon_span').innerHTML = '<i class="fa fa-exclamation-triangle"></i>&nbsp;';
            }
        };
        xhr.send(data);

        return false;
    }
    </script>

    <script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    </script>
</body>