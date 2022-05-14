<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Therapist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Therapist_Model');
        $this->load->model('Customer_Model');
        $this->load->model('Product_Model');
        $this->load->model('ProductType_Model');
        $this->load->model('Stock_Model');
        $this->load->model('Vendor_Model');
        $this->load->model('Transaction_Model');
        $this->load->model('User_Model');

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
        $params['header']['headertitle'] = 'Therapist';
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

        $params['sidebar']['sidebar_active'] = 'Therapist_List';

        $params['content_wrapper'] = 'therapist/therapist_home';

        // $params_table = 'USER';
        // $params_columns = [
        //     'id_user',
        //     'name_user',
        //     'address_user',
        //     'notelp_user'
        // ];
        // $params_conditions = [
        //     ['STATUS_USER','ACTIVE'],
        //     ['ID_USER_TYPE', '3'],

        // ];
        // $params['contents']['therapistslist'] = $this->Therapist_Model->getTherapistByColumn($params_table, $params_columns, $params_conditions);

        $params_table = 'USER';
        $params_columns = [
            'USER.ID_USER',
            'USER.NAME_USER',
            'USER.ADDRESS_USER',
            'USER.NOTELP_USER'
        ];
        $params_conditions = [
            ['USER.STATUS_USER','ACTIVE'],
            ['USER.ID_USER_TYPE', '2'],
            ['USER.ID_USER_TYPE', '3', 'OR']
        ];
        $params_join = [
            ['USER_TYPE', 'USER_TYPE.ID_USER_TYPE = USER.ID_USER_TYPE'],
        ];
        $params['contents']['therapistslist'] = $this->Therapist_Model->getTherapistByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);


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


        $this->load->view('therapist/therapist_template', $params);
    }


    public function therapistEditView($id_user)
    {
        $params['header']['headertitle'] = 'Edit Therapist';
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

        $params['sidebar']['sidebar_active'] = 'Therapist_List';

        $params['content_wrapper'] = 'therapist/therapist_edit';
        $params['contents']['therapistslist'] = $this->Therapist_Model->getTherapistById('USER', ['ID_USER','NAME_USER', 'BIRTHDATE_USER', 'NOTELP_USER', 'WORKING_SINCE', 'SALARY_USER', 'ADDRESS_USER',  'STATUS_USER'], [['ID_USER',$id_user]]);

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
            ['TRANSACTION.ID_USER', $id_user]
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

        $this->load->view('therapist/therapist_template', $params);
    }

    public function therapistAddHandler()
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $workingsince = ($this->input->post('workingsince') != null ? $this->input->post('workingsince') : null);
        $workingsinceDBFormatted;
        $birthdate = ($this->input->post('birthdate') != null ? $this->input->post('birthdate') : null);
        $birthdateDBFormatted;
        $address = ($this->input->post('address') != null ? $this->input->post('address') : null);
        $notelp = ($this->input->post('notelp') != null ? $this->input->post('notelp') : null);

        $workingsinceDBFormatted = date('Y/m/d', strtotime($workingsince));
        $birthdateDBFormatted = date('Y/m/d', strtotime($birthdate));

        // echo $name;
        // echo '<br>';
        // echo $workingsince;
        // echo '<br>';
        // echo $birthdate;
        // echo '<br>';
        // echo $birthdateDBFormatted;
        // echo '<br>';
        // echo $address;
        // echo '<br>';
        // echo $notelp;

        $params_table = 'USER';
        $params_columns = [
            ['NAME_USER',$name],
            ['BIRTHDATE_USER',$birthdateDBFormatted],
            ['WORKING_SINCE',$workingsinceDBFormatted],
            ['ADDRESS_USER',$address],
            ['NOTELP_USER',$notelp],
        ];
        $params_conditions = null;

        $result = $this->Therapist_Model->insertNewTherapist($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Therapist') : $this->errorviewPage('Ada kegagalan ketika menambahkan data therapist') ;
    }

    public function therapistEditHandler($id_user)
    {
        $name = ($this->input->post('name') != null ? $this->input->post('name') : 'kosoong');
        $workingsince = ($this->input->post('workingsince') != null ? $this->input->post('workingsince') : null);
        $salary = ($this->input->post('salary') != null ? $this->input->post('salary') : null);
        $salaryDBFormatted = '';
        $birthdate = ($this->input->post('birthdate') != null ? $this->input->post('birthdate') : null);
        $birthdateDBFormatted = '';
        $address = ($this->input->post('address') != null ? $this->input->post('address') : null);
        $notelp = ($this->input->post('notelp') != null ? $this->input->post('notelp') : null);
        $status = ($this->input->post('status') != null ? $this->input->post('status') : null);
    
        $salaryExplode = explode(".",$salary);
        $workingsinceDBFormatted = date('Y/m/d', strtotime($workingsince));
        $birthdateDBFormatted = date('Y/m/d', strtotime($birthdate));

        foreach ($salaryExplode as $row) {
           $salaryDBFormatted = $salaryDBFormatted . $row;
        }

        // echo 'id: '.$id_user;
        // echo '<br>';
        // echo 'name: '.$name;
        // echo '<br>';
        // echo 'workingsince: '.$workingsinceDBFormatted;
        // echo '<br>';
        // echo 'salary: '.(int)$salaryDBFormatted;
        // echo '<br>';
        // echo 'birthdate: '.$birthdateDBFormatted;
        // echo '<br>';
        // echo 'address: '.$address;
        // echo '<br>';
        // echo 'notelp: '.$notelp;
        // echo '<br>';
        // echo 'status: '.$status;

        $params_table = 'USER';
        $params_columns = [
            ['NAME_USER',$name],
            ['WORKING_SINCE',$workingsinceDBFormatted],
            ['SALARY_USER',(int)$salaryDBFormatted],
            ['BIRTHDATE_USER',$birthdateDBFormatted],
            ['ADDRESS_USER',$address],
            ['NOTELP_USER',$notelp],
            ['STATUS_USER',$status],
        ];
        $params_conditions = [
            ['ID_USER',$id_user]
        ];

        $result = $this->Therapist_Model->updateTherapist($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Therapist') : $this->errorviewPage('Ada kegagalan ketika memperbarui data pelanggan') ;
    }

    public function therapistArchiveHandler($id_user)
    {
        // echo $id_user;

        $params_table = 'USER';
        $params_columns = [
            ['STATUS_USER','ARCHIVE'],
        ];
        $params_conditions = [
            ['ID_USER',$id_user]
        ];

        $result = $this->Therapist_Model->updateTherapist($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Therapist') : $this->errorviewPage('Ada kegagalan ketika mengarsip data pelanggan') ;
    }

    public function errorviewPage($error_message)
    {
        // echo $error_message;

        $params['header']['headertitle'] = 'Therapist';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Therapist_List';

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

        $this->load->view('therapist/therapist_template', $params);
    }
}