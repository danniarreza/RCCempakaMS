<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('User_Model');
        $this->load->model('Therapist_Model');

        if ($this->session->has_userdata('logged_in') == true && $this->session->logged_in == true) {
            if ($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin') {
                redirect('Dashboard/');
            } elseif ($this->session->user_type == 'Therapist') {
                redirect('Product/');
            }
        }
    }
    
    public function index()
    {
        $this->loginView();
    }

    public function loginView()
    {
        $params['header']['headertitle'] = 'Login';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/plugins/iCheck/square/blue.css')
        ];

        $params['content_wrapper'] = 'landing/login_body';

        $params['contents'] = '';

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/plugins/iCheck/icheck.min.js')
        ];

        $this->load->view('landing/landing_template', $params);
    }

    public function loginAttemptHandler()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $params_table = 'USER';
        $params_columns = [
            'ID_USER',
            'NAME_USER',
            'PASSWORD_USER',
            'NAME_USER_TYPE',
            'WORKING_SINCE'

        ];
        $params_conditions = [
            ['NAME_USER',$username],
            ['PASSWORD_USER',$password]
        ];
        $params_join = [
            ['USER_TYPE', 'USER.ID_USER_TYPE = USER_TYPE.ID_USER_TYPE'],
        ];
        $result = $this->User_Model->getUserByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        
        if (count($result) > 0) {

            $params_table = 'USER_VISIBILITY';
            $params_columns = [
                'USER_VISIBILITY.ID_USER',
                'USER_VISIBILITY.ID_VENDOR',
                'VENDOR.NAME_VENDOR'
            ];
            $params_conditions = [
                ['ID_USER',$result[0]['ID_USER']]
            ];

            $params_join = [
                ['VENDOR', 'VENDOR.ID_VENDOR = USER_VISIBILITY.ID_VENDOR']
            ];
            $gettherapist = $this->Therapist_Model->getTherapistByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

            $array = array(
                'user_id'  => $result[0]['ID_USER'],
                'user_name'  => $result[0]['NAME_USER'],
                'user_type' => $result[0]['NAME_USER_TYPE'],
                'working_since' => $result[0]['WORKING_SINCE'],
                'user_visibility' => $gettherapist,
                'logged_in' => true
            );

            $this->session->set_userdata($array);
        }
        print_r(json_encode($result));
    }
}
