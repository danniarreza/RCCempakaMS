<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Vendor_Model');
        $this->load->model('Vendor_Model');
        $this->load->model('Product_Model');
        $this->load->model('ProductType_Model');
        $this->load->model('Stock_Model');
        $this->load->model('Vendor_Model');
        $this->load->model('Transaction_Model');
        $this->load->model('User_Model');

        if ($this->session->has_userdata('logged_in') == false) {
            redirect('Login/');
        }
    }
    
    public function index()
    {
        if ($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin') {
            $this->vendorHomeView();
        } else {
            redirect('Product/');
        }     
    }

    public function vendorHomeView()
    {
        $params['header']['headertitle'] = 'Vendor';
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

        $params['sidebar']['sidebar_active'] = 'Vendor';

        $params['content_wrapper'] = 'vendor/vendor_home';
        $params['contents']['vendorslist'] = $this->Vendor_Model->getVendorByColumn('VENDOR', ['id_vendor','name_vendor', 'type_vendor'], []);

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

        $this->load->view('vendor/vendor_template', $params);

        // echo $this->Vendor_Model->getVendorByColumn('vendor', ['id_vendor','name_vendor'], '');

        // $anu = $this->Vendor_Model->getVendorByColumn('vendor', ['id_vendor','name_vendor'], '');
        // echo '<pre>';
        // print_r($anu);
        // echo '</pre>';
    }

    public function vendorAddHandler()
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $type = ($this->input->post('type') != null ? $this->input->post('type') : 'SUPPLIER');

        // echo $name;
        // echo '<br>';
        // echo $type;
        // echo '<br>';

        $params_table = 'VENDOR';
        $params_columns = [
            ['NAME_VENDOR',$name],
            ['TYPE_VENDOR',$type]
        ];
        $params_conditions = null;

        $result = $this->Vendor_Model->insertNewVendor($params_table, $params_columns, $params_conditions);

        $result > 0 ? redirect('Vendor') : $this->errorviewPage('Ada kegagalan ketika menambahkan data vendor');
        // if($source == ''){
        //     $result > 0 ? redirect('Vendor') : $this->errorviewPage('Ada kegagalan ketika menambahkan data pelanggan');
        // } else if($source == 'api'){
        //     echo $result;
        // }
    }

    public function vendorEditView($id_vendor)
    {
        $params['header']['headertitle'] = 'Edit Vendor';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css'),
            base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'),
            base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'),
            base_url('assets/bower_components/select2/dist/css/select2.min.css'),
            base_url('assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'),
            base_url('assets/plugins/iCheck/all.css'),
            base_url('assets/plugins/timepicker/bootstrap-timepicker.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Vendor';
        // $params['contents']['vendorslist'] = 'ngeng';
        $params['contents']['vendorslist'] = $this->Vendor_Model->getVendorById('VENDOR', ['id_vendor','name_vendor', 'type_vendor'], [['ID_VENDOR',$id_vendor]]);

        $params['content_wrapper'] = 'vendor/vendor_edit';

        if ($params['contents']['vendorslist'][0]['TYPE_VENDOR'] == 'STORE') {
            $params_table_transaction = 'TRANSACTION';
            $params_columns_transaction = [
                    'TRANSACTION.ID_TRANSACTION AS ID_ENTRY',
                    'TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',
                    'TRANSACTION.DATE_TRANSACTION AS DATE_ENTRY',
                    'USER.NAME_USER',
                    'VENDOR.NAME_VENDOR',
                    'PRODUCT.TYPE_PRODUCT',
                    'PRODUCT.ID_PRODUCT',
                    'PRODUCT.NAME_PRODUCT',
                    'TRANSACTION_PRODUCT.AMOUNT_PRODUCT AS AMOUNT',
                    'TRANSACTION_PRODUCT.TOTAL_PRICE'
                ];

            $params_conditions_transaction = [
            ['VENDOR.ID_VENDOR', $id_vendor]
    
                ];

            $params_join_transaction = [
                    ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                    ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                    ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                    ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
                ];
    
            $transactionlist = $this->Transaction_Model->getTransactionByColumnJoin($params_table_transaction, $params_columns_transaction, $params_conditions_transaction, $params_join_transaction);
            $params['contents']['transactionproductlist'] = $transactionlist;
        }

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/select2/dist/js/select2.full.min.js'),
            base_url('assets/plugins/input-mask/jquery.inputmask.js'),
            base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js'),
            base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js'),
            base_url('assets/bower_components/moment/min/moment.min.js'),
            base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'),
            base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'),
            base_url('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'),
            base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js'),
            base_url('assets/plugins/iCheck/icheck.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'),
            base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/dist/js/demo.js')
        ];

        $this->load->view('vendor/vendor_template', $params);
    }

    public function vendorEditHandler($id_vendor)
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $type = ($this->input->post('type') != null ? $this->input->post('type') : 'STORE');
        
        // echo $id_vendor;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $type;

        $params_table = 'VENDOR';
        $params_columns = [
            ['NAME_VENDOR',$name],
            ['TYPE_VENDOR',$type]
        ];
        $params_conditions = [
            ['ID_VENDOR',$id_vendor]
        ];

        $result = $this->Vendor_Model->updateVendor($params_table, $params_columns, $params_conditions);
        
        $result == 1 ? redirect('Vendor/vendorEditView/'.$id_vendor) : $this->errorviewPage('Ada kegagalan ketika memperbarui data pelanggan') ;
    }

    public function VendorListRequest()
    {
        $params_table = 'VENDOR';
        $params_columns = [
            'ID_VENDOR',
            'NAME_VENDOR'
        ];
        $params_conditions = [
            ['TYPE_VENDOR','STORE']
        ];
        $result = $this->Vendor_Model->getVendorByColumn($params_table, $params_columns, $params_conditions);
        print_r(json_encode($result));
    }
}