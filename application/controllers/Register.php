<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model('User_Model');

        // if ($_SESSION['loggedin']==FALSE) {
        // 	redirect('RegisterController');
        // }else if ($_SESSION['level']==1 || $_SESSION['level']==3) {
        // 	redirect('DashboardController');
        // }else if($_SESSION['level']==0){
        // 	redirect('AdminController');
        // }
    }
    
    public function index()
    {
        $this->registerView();
    }

    public function registerView()
    {
        $params['content_wrapper'] = 'landing/register_body';
        $this->load->view('landing/landing_template', $params);
    }
}

    