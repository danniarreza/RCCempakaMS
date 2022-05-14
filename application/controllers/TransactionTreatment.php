<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionTreatment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        // $this->load->model('Therapist_Model');

        if ($this->session->has_userdata('logged_in') == FALSE) {
            redirect('Login/');
        } 
    }

    public function index()
    {
        $this->transactiontreatmentHomeView();
    }

    public function transactiontreatmentHomeView()
    {
        $params['header']['headertitle'] = 'Transaksi Treatment';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Transaction_Treatment';

        $params['content_wrapper'] = 'transactiontreatment/transactiontreatment_home';

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'),
            base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/dist/js/demo.js')
        ];

        $this->load->view('transactiontreatment/transactiontreatment_template', $params);
    }
}
