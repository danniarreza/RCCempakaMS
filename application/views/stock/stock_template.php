<!DOCTYPE html>
<html>

<head>
    <?php $this->view('shared/header', $header)?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="<?php
                if ($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin') {
                    echo site_url('Dashboard/');
                } elseif ($this->session->user_type == 'Therapist') {
                    echo site_url('Product/');
                }
            
            ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>RC</b>C</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>RC</b>Cempaka</span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('assets/dist/img/user3-128x128.jpg');?>"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('assets/dist/img/user4-128x128.jpg');?>"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('assets/dist/img/user3-128x128.jpg');?>"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url('assets/dist/img/user4-128x128.jpg');?>"
                                                        class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the
                                                page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo "https://ui-avatars.com/api/?name=". $this->session->user_name ."&background=0D8ABC&color=fff";?>"
                    class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->user_name;?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo "https://ui-avatars.com/api/?name=". $this->session->user_name ."&background=0D8ABC&color=fff";?>"
                    class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $this->session->user_name;?> -
                                        <?php echo $this->session->user_type;?>
                                        <small>Member since
                                            <?php echo date('M Y', strtotime($this->session->working_since));?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-6 text-center">
                                            <a href="#">Produk</a>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <a href="#">Perawatan</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('Logout/');?>"
                                            class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <?php $this->view('shared/sidebar_panel', $sidebar)?>

        <!-- Content Wrapper. Contains page content -->
        <?php $this->view($content_wrapper, $contents)?>
        <!-- /.content-wrapper -->

        <!-- Footer. Contains Footer, Control Sidebar, JQuery and Script Source  -->
        <?php $this->view('shared/footer', $footer)?>
        <!-- /.content-wrapper -->
        
        <script>
        $(function() {
            // $('#example1').DataTable()
            $('.select2').select2()

            // ------------------------------------------------------------------------------------------------------------------------------------------------

            if (document.getElementById('stocktable') != null) {
                $('#stocktable tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<div class="form-group"><input type="text" class="form-control" style="border-radius: 4px" placeholder="Search ..." /></div>'
                    );
                });

                // DataTable
                // var table = $('#example').DataTable();
                var table = $('#stocktable').DataTable({
                    'responsive': true,
                    'pageLength': 100,
                    'autoWidth': true,
                    "order": [
                        [0, "desc"]
                    ]

                })

                // Apply the search
                table.columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });

                });

                var r = $('#stocktable tfoot tr');
                r.find('th').each(function() {
                    $(this).css('padding', 8);
                });
                $('#stocktable thead').append(r);
                $('#search_0').css('text-align', 'center');
            }

            // ------------------------------------------------------------------------------------------------------------------------------------------------

            if (document.getElementById('stockRecapitulationtable') != null) {
                $('#stockRecapitulationtable tfoot th').each(function() {
                    var title = $(this).text();
                    $(this).html(
                        '<div class="form-group"><input type="text" class="form-control" style="border-radius: 4px" placeholder="Search ..." /></div>'
                    );
                });

                // DataTable
                // var table = $('#example').DataTable();
                var table = $('#stockRecapitulationtable').DataTable({
                    'responsive': true,
                    'pageLength': 100,
                    'autoWidth': true,
                    "order": [
                        [0, "desc"]
                    ]

                })

                // Apply the search
                table.columns().every(function() {
                    var that = this;

                    $('input', this.footer()).on('keyup change', function() {
                        if (that.search() !== this.value) {
                            that
                                .search(this.value)
                                .draw();
                        }
                    });

                });

                var r = $('#stockRecapitulationtable tfoot tr');
                r.find('th').each(function() {
                    $(this).css('padding', 8);
                });
                $('#stockRecapitulationtable thead').append(r);
                $('#search_0').css('text-align', 'center');
            }


            // $('#stock_receipt_entrydate').datepicker({
            //     format: 'dd MM yyyy',
            //     autoclose: true,
            //     changeMonth: true,
            //     changeYear: true
            // })

            // $('#stock_transfer_entrydate').datepicker({
            //     format: 'dd MM yyyy',
            //     autoclose: true,
            //     changeMonth: true,
            //     changeYear: true
            // })

            // $('#stock_repack_entrydate').datepicker({
            //     format: 'dd MM yyyy',
            //     autoclose: true,
            //     changeMonth: true,
            //     changeYear: true
            // })

        })

        // $(document).ready(function() {
        //     $('#stockRecapitulationtable').DataTable({
        //         "order": [
        //             [0, "desc"]
        //         ]
        //     });
        // });
        </script>

</body>

</html>