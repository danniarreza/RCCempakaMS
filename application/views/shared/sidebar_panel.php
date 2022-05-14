<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo "https://ui-avatars.com/api/?name=". $this->session->user_name ."&background=0D8ABC&color=fff";?>"
                    class="img-circle" alt="User Image">

            </div>
            <div class="pull-left info">
                <!-- <p>Danniar Reza</p> -->
                <p><?php echo $this->session->user_name;?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN MENU</li>

            <?php if($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin'){
                ?>
            <li <?php echo ($sidebar_active == 'Dashboard'? 'class="active"':'')?>>
                <a href="<?php echo site_url('Dashboard/')?>">
                    <i class="fa fa-bar-chart"></i>
                    <span>Dashboard</span>
                    <span class="pull-right-container">
                        <!-- <i class="fa fa-angle-left pull-right"></i> -->
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                </a>
            </li>
            <?php
            }?>

            <li
                <?php echo (isset(explode("_", $sidebar_active)[0]) && explode("_", $sidebar_active)[0] == 'Product' ? 'class="active treeview"' : 'class="treeview"') ?>>
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Produk</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                    <ul class="treeview-menu">
                        <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'List' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('Product/')?>"><i class="fa fa-circle-o"></i> Daftar Produk</a>
                        </li>
                        <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'Type' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('ProductType/')?>"><i class="fa fa-circle-o"></i> Jenis
                                Produk</a>
                        </li>
                    </ul>
                </a>
            </li>
            <li <?php echo ($sidebar_active == 'Stock'? 'class="active"':'')?>>
                <a href="<?php echo site_url('Stock/')?>">
                    <i class="fa fa-book"></i>
                    <span>Stock</span>
                    <span class="pull-right-container">
                        <!-- <i class="fa fa-angle-left pull-right"></i> -->
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                </a>
            </li>
            <li
                <?php echo (isset(explode("_", $sidebar_active)[0]) && explode("_", $sidebar_active)[0] == 'Transaction' ? 'class="active treeview"' : 'class="treeview"') ?>>
                <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Transaksi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                    <ul class="treeview-menu">
                        <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'Product' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('TransactionProduct/')?>"><i class="fa fa-circle-o"></i>
                                Produk</a>
                        </li>
                        <!-- <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'Treatment' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('TransactionTreatment/')?>"><i class="fa fa-circle-o"></i>
                                Perawatan</a>
                        </li> -->
                    </ul>
                </a>
            </li>
            <li <?php echo ($sidebar_active == 'Customer'? 'class="active"':'')?>>
                <a href="<?php echo site_url('Customer/')?>">
                    <i class="fa fa-user"></i>
                    <span>Pelanggan</span>
                    <span class="pull-right-container">
                        <!-- <i class="fa fa-angle-left pull-right"></i> -->
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                </a>
            </li>

            <?php if($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin'){
            ?>
            <li
                <?php echo (isset(explode("_", $sidebar_active)[0]) && explode("_", $sidebar_active)[0] == 'Therapist' ? 'class="active treeview"' : 'class="treeview"') ?>>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Therapist</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                    <ul class="treeview-menu">
                        <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'List' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('Therapist/')?>"><i class="fa fa-circle-o"></i> Daftar
                                Therapist</a>
                        </li>
                        <li
                            <?php echo (isset(explode("_", $sidebar_active)[1]) && explode("_", $sidebar_active)[1] == 'Access' ? 'class="active"': '')?>>
                            <a href="<?php echo site_url('TherapistAccess/')?>"><i class="fa fa-circle-o"></i> Hak
                                Akses</a>
                        </li>
                    </ul>
                </a>
            </li>

            <?php
            }?>


            <?php if($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin'){
            ?>
            <li <?php echo ($sidebar_active == 'Vendor'? 'class="active"':'')?>>
                <a href="<?php echo site_url('Vendor/')?>">
                    <i class="fa fa-user"></i>
                    <span>Vendor</span>
                    <span class="pull-right-container">
                        <!-- <i class="fa fa-angle-left pull-right"></i> -->
                        <!-- <span class="label label-primary pull-right">0</span> -->
                    </span>
                </a>
            </li>
            <?php 
            }
            ?>

            <!-- <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a>
                    </li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a>
                    </li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>
                    </span>
                </a>
            </li>
            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-yellow">12</small>
                        <small class="label pull-right bg-green">16</small>
                        <small class="label pull-right bg-red">5</small>
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                    <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                    <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                    <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                    <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a>
                    </li>
                    <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                    <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                    <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                    <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Level One
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                </ul>
            </li>
            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a>
            </li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul> -->
    </section>
    <!-- /.sidebar -->
</aside>