<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Customer_Model');
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
        $this->customerHomeView();
        // $this->customerEditView(1);
    }

    public function customerHomeView()
    {
        $params['header']['headertitle'] = 'Pelanggan';
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

        $params['sidebar']['sidebar_active'] = 'Customer';

        $params['content_wrapper'] = 'customer/customer_home';
        $params['contents']['customerslist'] = $this->Customer_Model->getCustomerByColumn('CUSTOMER', ['id_customer','name_customer','address_customer','notelp_customer'], [['STATUS_CUSTOMER','ACTIVE']]);

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

        $this->load->view('customer/customer_template', $params);

        // echo $this->Customer_Model->getCustomerByColumn('customer', ['id_customer','name_customer','address_customer','notelp_customer'], '');

        // $anu = $this->Customer_Model->getCustomerByColumn('customer', ['id_customer','name_customer','address_customer','notelp_customer'], '');
        // echo '<pre>';
        // print_r($anu);
        // echo '</pre>';
    }


    public function customerEditView($id_customer)
    {
        $params['header']['headertitle'] = 'Edit Pelanggan';
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

        $params['sidebar']['sidebar_active'] = 'Customer';
        // $params['contents']['customerslist'] = 'ngeng';
        $params['contents']['customerslist'] = $this->Customer_Model->getCustomerById('CUSTOMER', ['id_customer','name_customer','address_customer','notelp_customer', 'gender_customer', 'birthdate_customer', 'status_customer', 'date_added_customer'], [['ID_CUSTOMER',$id_customer]]);

        $params['content_wrapper'] = 'customer/customer_edit';

        $params_table_transaction = 'TRANSACTION';
        $params_columns_transaction = [
                    'TRANSACTION.ID_TRANSACTION AS ID_ENTRY',
                    'TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',
                    'TRANSACTION.DATE_TRANSACTION AS DATE_ENTRY',
                    'USER.NAME_USER',
                    'CUSTOMER.NAME_CUSTOMER',
                    'CUSTOMER.ADDRESS_CUSTOMER',
                    'VENDOR.NAME_VENDOR',
                    'PRODUCT.TYPE_PRODUCT',
                    'PRODUCT.ID_PRODUCT',
                    'PRODUCT.NAME_PRODUCT',
                    'TRANSACTION_PRODUCT.AMOUNT_PRODUCT AS AMOUNT',
                    'TRANSACTION_PRODUCT.TOTAL_PRICE',
                    'VENDOR.NAME_VENDOR'
                ];

        $params_conditions_transaction = [
            ['TRANSACTION.ID_CUSTOMER', $id_customer]
                    // ['PRODUCT.TYPE_PRODUCT', $type_product],
                    // ['PRODUCT.ID_PRODUCT', $id_product],
                    // ['VENDOR.NAME_VENDOR', $name_vendor]
    
                ];

        $params_join_transaction = [
                    ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                    ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                    ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                    ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                    ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
                ];
    
        $transactionlist = $this->Transaction_Model->getTransactionByColumnJoin($params_table_transaction, $params_columns_transaction, $params_conditions_transaction, $params_join_transaction);
        $params['contents']['transactionproductlist'] = $transactionlist;

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

        $this->load->view('customer/customer_template', $params);
    }

    public function customerAddHandler()
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $gender = ($this->input->post('gender') != null ? $this->input->post('gender') : 'F');
        $birthdate = ($this->input->post('birthdate') != null ? $this->input->post('birthdate') : null);
        $birthdateDBFormatted;
        $address = ($this->input->post('address') != null ? $this->input->post('address') : null);
        $notelp = ($this->input->post('notelp') != null ? $this->input->post('notelp') : null);
        $source = ($this->input->post('source') != null ? $this->input->post('source') : '');

        $birthdateDBFormatted = date('Y/m/d', strtotime($birthdate));
        $dateadded = date('d M Y');
        $dateaddedDBFormatted = date('Y/m/d', strtotime($dateadded));

        // echo $name;
        // echo '<br>';
        // echo $gender;
        // echo '<br>';
        // echo $birthdate;
        // echo '<br>';
        // echo $birthdateDBFormatted;
        // echo '<br>';
        // echo $address;
        // echo '<br>';
        // echo $notelp;

        $params_table = 'CUSTOMER';
        $params_columns = [
            ['NAME_CUSTOMER',$name],
            ['GENDER_CUSTOMER',$gender],
            ['BIRTHDATE_CUSTOMER',$birthdateDBFormatted],
            ['ADDRESS_CUSTOMER',$address],
            ['NOTELP_CUSTOMER',$notelp],
            ['DATE_ADDED_CUSTOMER',$dateaddedDBFormatted]
        ];
        $params_conditions = null;

        $result = $this->Customer_Model->insertNewCustomer($params_table, $params_columns, $params_conditions);
        if($source == ''){
            $result > 0 ? redirect('Customer') : $this->errorviewPage('Ada kegagalan ketika menambahkan data pelanggan');
        } else if($source == 'api'){
            echo $result;
        }
    }

    public function customerEditHandler($id_customer)
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $gender = ($this->input->post('gender') != null ? $this->input->post('gender') : 'F');
        $birthdate = ($this->input->post('birthdate') != null ? $this->input->post('birthdate') : null);
        $birthdateDBFormatted;
        $address = ($this->input->post('address') != null ? $this->input->post('address') : null);
        $notelp = ($this->input->post('notelp') != null ? $this->input->post('notelp') : null);
        $status = ($this->input->post('status') != null ? $this->input->post('status') : null);
    
        $birthdateDBFormatted = date('Y/m/d', strtotime($birthdate));

        // echo $id_customer;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $gender;
        // echo '<br>';
        // echo $birthdate;
        // echo '<br>';
        // echo $birthdateDBFormatted;
        // echo '<br>';
        // echo $address;
        // echo '<br>';
        // echo $notelp;

        $params_table = 'CUSTOMER';
        $params_columns = [
            ['NAME_CUSTOMER',$name],
            ['GENDER_CUSTOMER',$gender],
            ['BIRTHDATE_CUSTOMER',$birthdateDBFormatted],
            ['ADDRESS_CUSTOMER',$address],
            ['NOTELP_CUSTOMER',$notelp],
            ['STATUS_CUSTOMER',$status],
        ];
        $params_conditions = [
            ['ID_CUSTOMER',$id_customer]
        ];

        $result = $this->Customer_Model->updateCustomer($params_table, $params_columns, $params_conditions);
        
        $result == 1 ? redirect('Customer/customerEditView/'.$id_customer) : $this->errorviewPage('Ada kegagalan ketika memperbarui data pelanggan') ;
    }

    public function customerArchiveHandler($id_customer)
    {
        // echo $id_customer;

        $params_table = 'CUSTOMER';
        $params_columns = [
            ['STATUS_CUSTOMER','ARCHIVE'],
        ];
        $params_conditions = [
            ['ID_CUSTOMER',$id_customer]
        ];

        $result = $this->Customer_Model->updateCustomer($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Customer') : $this->errorviewPage('Ada kegagalan ketika mengarsip data pelanggan') ;
    }

    public function errorviewPage($error_message)
    {
        // echo $error_message;

        $params['header']['headertitle'] = 'Pelanggan';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Customer';

        $params['content_wrapper'] = 'shared/500';
        $params['contents']['error_message'] = $error_message;

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/dist/js/demo.js')
        ];

        $this->load->view('customer/customer_template', $params);
    }

    public function customerListRequest()
    {
        $params_table = 'CUSTOMER';
        $params_columns = [
            'ID_CUSTOMER',
            'NAME_CUSTOMER',
            'ADDRESS_CUSTOMER'
        ];
        $params_conditions = [];
        $result = $this->Customer_Model->getCustomerByColumn($params_table, $params_columns, $params_conditions);
        print_r(json_encode($result));
    }

    public function customerCurrentMonthListRequest()
    {
        $params_table = 'CUSTOMER';
        $params_columns = [
            'ID_CUSTOMER',
            'NAME_CUSTOMER',
            'ADDRESS_CUSTOMER'
        ];
        $params_conditions = [
            ['DATE_ADDED_CUSTOMER', '%'.date('y-m').'%', 'LIKE']
        ];
        $result = $this->Customer_Model->getCustomerByColumn($params_table, $params_columns, $params_conditions);
        print_r(json_encode($result));
    }
}