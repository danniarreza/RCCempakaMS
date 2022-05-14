<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('User_Model');

        if ($this->session->has_userdata('logged_in') == FALSE) {
            redirect('Login/');
        } 

        // if ($_SESSION['loggedin']==FALSE) {
        // 	redirect('LoginController');
        // }else if ($_SESSION['level']==1 || $_SESSION['level']==3) {
        // 	redirect('DashboardController');
        // }else if($_SESSION['level']==0){
        // 	redirect('AdminController');
        // }
    }

    public function index()
    {
        if ($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin') {
            $this->dashboardHomeView();
        } else {
            redirect('Product/');
        }     
    }

    public function dashboardHomeView()
    {
        $params['header']['headertitle'] = 'Dashboard';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'), 
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            // base_url('assets/bower_components/jvectormap/jquery-jvectormap.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Dashboard';

        $params['content_wrapper'] = 'dashboard/dashboard_home';

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'),
            // base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'),
            // base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/bower_components/chart.js/Chart.js'),
            base_url('assets/dist/js/pages/dashboard2.js'),
            base_url('assets/dist/js/demo.js')
        ];

        $this->load->view('dashboard/dashboard_template', $params);
    }
}