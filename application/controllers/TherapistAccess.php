<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TherapistAccess extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Therapist_Model');
        $this->load->model('Vendor_Model');

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
            $this->therapistHomeView(0);
        } else {
            redirect('Product/');
        }
    }

    public function therapistHomeView()
    {
        $params['header']['headertitle'] = 'Akses Therapist';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'),
            base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css'),
            base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Therapist_Access';

        $params['content_wrapper'] = 'therapistaccess/therapistaccess_home';

        $params_table = 'USER';
        $params_columns = [
            'id_user',
            'name_user',
            'address_user',
            'notelp_user'
        ];
        $params_conditions = [
            ['STATUS_USER','ACTIVE']
        ];
        $params['contents']['therapistslist'] = $this->Therapist_Model->getTherapistByColumn($params_table, $params_columns, $params_conditions);

        $params_table = 'VENDOR';
        $params_columns = [
            'ID_VENDOR',
            'NAME_VENDOR',
            'TYPE_VENDOR'
        ];
        $params_conditions = [
            ['TYPE_VENDOR', 'STORE']
        ];
        $params['contents']['vendorslist'] = $this->Vendor_Model->getVendorByColumn($params_table, $params_columns, $params_conditions);

        $params_table = 'USER_VISIBILITY';
        $params_columns = [
            'ID_USER',
            'ID_VENDOR'
        ];
        $params_conditions = [
        ];
        $params['contents']['uservisibilitylist'] = $this->Therapist_Model->getTherapistByColumn($params_table, $params_columns, $params_conditions);
        

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'),
            base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'),
            base_url('assets/bower_components/moment/min/moment.min.js'),
            base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'),
            base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/dist/js/demo.js')
        ];


        $this->load->view('therapistaccess/therapistaccess_template', $params);
    }


    public function therapistaccessAddHandler()
    {
        $id_user = ($this->input->post('id_user') != null ? $this->input->post('id_user') : 'kosoong');
        $id_vendor = ($this->input->post('id_vendor') != null ? $this->input->post('id_vendor') : null);
        
        // echo 'ngeng';
        // echo '<br>';
        // echo $id_user;
        // echo '<br>';
        // echo $id_vendor;
        // echo '<br>';

        $params_table = 'USER_VISIBILITY';
        $params_columns = [
            'id_user',
            'id_vendor'
        ];
        $params_conditions = [
            ['ID_USER',$id_user],
            ['ID_VENDOR',$id_vendor]
        ];

        $gettherapist = $this->Therapist_Model->getTherapistById($params_table, $params_columns, $params_conditions);

        if (isset($gettherapist[0]) == true) {
            $params_table = 'USER_VISIBILITY';
            $params_columns = [];
            $params_conditions = array(
                'id_user' => $id_user,
                'id_vendor' => $id_vendor
            );

            $result = $this->Therapist_Model->deleteTherapistById($params_table, $params_columns, $params_conditions);

            echo $result;
        } else {
            $params_table = 'USER_VISIBILITY';
            $params_columns = [
                ['ID_USER',$id_user],
                ['ID_VENDOR',$id_vendor]
            ];
            $params_conditions = null;

            $result = $this->Therapist_Model->insertNewTherapist($params_table, $params_columns, $params_conditions);

            echo $result;
        }
    }

    public function therapistaccessListRequest()
    {
        $name_vendor = $this->input->post('name_vendor');

        if ($name_vendor == '') {
            $params_table = 'USER';

            $params_columns = [
                    'USER.ID_USER',
                    'USER.NAME_USER'
                ];

            $params_conditions = [
            ];

            $result = $this->Therapist_Model->getTherapistByColumn($params_table, $params_columns, $params_conditions);

        } else if ($name_vendor != '') {
            $params_table = 'USER_VISIBILITY';

            $params_columns = [
                    'USER_VISIBILITY.ID_USER',
                    'USER_VISIBILITY.ID_VENDOR',
                    'USER.NAME_USER',
                    'VENDOR.NAME_VENDOR'
                ];

            $params_conditions = [
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];

            $params_join = [
                ['USER', 'USER_VISIBILITY.ID_USER = USER.ID_USER'],
                ['VENDOR', 'USER_VISIBILITY.ID_VENDOR = VENDOR.ID_VENDOR']
            ];

            $result = $this->Therapist_Model->getTherapistByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        }
        
        print_r(json_encode($result));
    }
}
