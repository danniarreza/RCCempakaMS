<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionProduct extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Transaction_Model');
        $this->load->model('Product_Model');
        $this->load->model('Stock_Model');
        $this->load->model('Vendor_Model');
        $this->load->model('User_Model');
        $this->load->model('Customer_Model');

        if ($this->session->has_userdata('logged_in') == false) {
            redirect('Login/');
        }
    }

    public function index()
    {
        $this->transactionproductHomeView();
    }

    public function transactionproductHomeView()
    {
        $params['header']['headertitle'] = 'Transaksi Produk';
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

        $params['sidebar']['sidebar_active'] = 'Transaction_Product';

        $params['content_wrapper'] = 'transactionproduct/transactionproduct_home';

        $params_table = 'USER_VISIBILITY';
        $params_columns = [
                'USER_VISIBILITY.ID_USER',
                'USER_VISIBILITY.ID_VENDOR',
                'VENDOR.NAME_VENDOR'
            ];
        $params_conditions = [
                ['ID_USER',$this->session->user_id]
            ];

        $params_join = [
                ['VENDOR', 'VENDOR.ID_VENDOR = USER_VISIBILITY.ID_VENDOR']
            ];
        $therapistvisibility = $this->User_Model->getUserByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        $params['contents']['therapistvisibility'] = $therapistvisibility;

        // ---------------------------------------------------------------------------------------------------------------------------------------

        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION.DATE_TRANSACTION',
                'CUSTOMER.NAME_CUSTOMER',
                'USER.NAME_USER',
                'VENDOR.NAME_VENDOR',
                '(SELECT SUM(TOTAL_PRICE * (100 - DISCOUNT_PRODUCT) / 100 )
                FROM transaction_product
                WHERE ID_TRANSACTION = TRANSACTION.ID_TRANSACTION
                GROUP BY ID_TRANSACTION) as TOTAL_TRANSACTION'
            ];
        $params_conditions = [
        
        ];

        $params_join = [
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR']
            ];

        if (count($therapistvisibility) > 0 && isset($therapistvisibility[0])) {
            for ($i=0; $i < count($therapistvisibility); $i++) {
                $i == 0 ?
                (
                    array_push($params_conditions, ['TRANSACTION.ID_VENDOR', $therapistvisibility[$i]['ID_VENDOR'], 'AND'])
                ) :
                (
                    array_push($params_conditions, ['TRANSACTION.ID_VENDOR', $therapistvisibility[$i]['ID_VENDOR'], 'OR'])
                );
            }
            
            $params['contents']['transactionlist'] = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        } else {
            $params['contents']['transactionlist'] = 'Anda tidak memiliki hak akses untuk melihat stok produk';
        }

        // ---------------------------------------------------------------------------------------------------------------------------------------

        $params_table = 'CUSTOMER';
        $params_columns = [
            'ID_CUSTOMER',
            'NAME_CUSTOMER',
            'ADDRESS_CUSTOMER'
        ];
        $params_conditions = [];
        $params['contents']['customerslist'] = $this->Customer_Model->getCustomerByColumn($params_table, $params_columns, $params_conditions);
            
        // echo "<pre>";
        // print_r ($params['contents']['therapistvisibility']);
        // echo "</pre>";
            

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

        $this->load->view('transactionproduct/transactionproduct_template', $params);
    }

    public function transactionProductAddHandler()
    {
        $customer = ($this->input->post('customer') != null ? $this->input->post('customer') : 'kosoong');
        $therapistid = ($this->input->post('therapistid') != null ? $this->input->post('therapistid') : 'kosoong');
        $vendor = ($this->input->post('vendor') != null ? $this->input->post('vendor') : 'kosoong');
        $transactiondate = ($this->input->post('transactiondate') != null ? $this->input->post('transactiondate') : 'kosoong');
        $transactiondateDBFormatted = date('Y/m/d', strtotime($transactiondate));

        // echo $customer;
        // echo '<br>';
        // echo $therapistid;
        // echo '<br>';
        // echo $vendor;
        // echo '<br>';
        // echo $transactiondateDBFormatted;
        // echo '<br>';
        
        $params_table = 'TRANSACTION';
        $params_columns = [
            ['DATE_TRANSACTION',$transactiondateDBFormatted],
            ['ID_USER',$therapistid],
            ['ID_CUSTOMER',$customer],
            ['ID_VENDOR',$vendor]
        ];
        $params_conditions = [];

        $result = $this->Transaction_Model->insertNewTransaction($params_table, $params_columns, $params_conditions);

        
        // echo "<pre>";
        // print_r ($result);
        // echo "</pre>";
        

        $result > 1 ? redirect('TransactionProduct/transactionDetailView/' . $result) : $this->errorviewPage('Ada kegagalan ketika menambahkan transaksi baru') ;
    }

    public function transactionDetailView($id_transaction)
    {
        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION.DATE_TRANSACTION',
                'CUSTOMER.NAME_CUSTOMER',
                'TRANSACTION.ID_USER',
                'USER.NAME_USER',
                'VENDOR.ID_VENDOR',
                'VENDOR.NAME_VENDOR',
                '(SELECT SUM(TOTAL_PRICE * (100 - DISCOUNT_PRODUCT) / 100 )
                FROM transaction_product
                WHERE ID_TRANSACTION = TRANSACTION.ID_TRANSACTION
                GROUP BY ID_TRANSACTION) as TOTAL_TRANSACTION'
            ];
        $params_conditions = [
            ['ID_TRANSACTION', $id_transaction]
        ];

        $params_join = [
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR']
            ];
        $transactionbyid = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        $params['contents']['transactionbyid'] = $transactionbyid;

        // ------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        $params_table = 'USER_VISIBILITY';
        $params_columns = [
                'USER_VISIBILITY.ID_USER',
                'USER_VISIBILITY.ID_VENDOR',
                'VENDOR.NAME_VENDOR'
            ];
        $params_conditions = [
                ['ID_USER',$this->session->user_id]
            ];

        $params_join = [
                ['VENDOR', 'VENDOR.ID_VENDOR = USER_VISIBILITY.ID_VENDOR']
            ];
        $therapistvisibility = $this->User_Model->getUserByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

        $user_visibility = null;
        $name_vendor = $transactionbyid[0]['NAME_VENDOR'];

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('TransactionProduct/');
        } else {
            $params['header']['headertitle'] = 'Edit Transaksi Produk';
            $params['header']['stylesheet'] = [
                base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
                base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
                base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
                base_url('assets/bower_components/select2/dist/css/select2.min.css'),
                base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'),
                base_url('assets/dist/css/AdminLTE.min.css'),
                base_url('assets/dist/css/skins/_all-skins.min.css')
            ];
    
            $params['sidebar']['sidebar_active'] = 'Transaction_Product';
    
            $params['content_wrapper'] = 'transactionproduct/transactionproduct_detail';
    
            $params_table = 'TRANSACTION';
            $params_columns = [
                    'TRANSACTION.ID_TRANSACTION',
                    'TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',
                    'TRANSACTION.DATE_TRANSACTION',
                    'USER.NAME_USER',
                    'CUSTOMER.NAME_CUSTOMER',
                    'VENDOR.NAME_VENDOR',
                    'PRODUCT.TYPE_PRODUCT',
                    'PRODUCT.ID_PRODUCT',
                    'PRODUCT.NAME_PRODUCT',
                    'TRANSACTION_PRODUCT.AMOUNT_PRODUCT',
                    'TRANSACTION_PRODUCT.TOTAL_PRICE',
                    'TRANSACTION_PRODUCT.DISCOUNT_PRODUCT',
                    'TRANSACTION_PRODUCT.DATE_TRANSACTION_PRODUCT',
                    'VENDOR.NAME_VENDOR'
                ];
            $params_conditions = [
                    ['TRANSACTION.ID_TRANSACTION',$id_transaction]
                ];
    
            $params_join = [
                    ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                    ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                    ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                    ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                    ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
                ];
            $params['contents']['transactionlist'] = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_table = 'PRODUCT_TYPE';
            $params_columns = [
                'ID_PRODUCT_TYPE',
                'NAME_PRODUCT_TYPE'
            ];
            $params_conditions = [];
            $params['contents']['producttypeslist'] = $this->Product_Model->getProductByColumn($params_table, $params_columns, $params_conditions);
    
            $params['footer']['scriptsrc'] = [
                base_url('assets/bower_components/jquery/dist/jquery.min.js'),
                base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
                base_url('assets/bower_components/fastclick/lib/fastclick.js'),
                base_url('assets/bower_components/select2/dist/js/select2.full.min.js'),
                base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'),
                base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'),
                base_url('assets/dist/js/adminlte.min.js'),
                base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
                base_url('assets/dist/js/demo.js')
            ];
    
            $this->load->view('transactionproduct/transactionproduct_template', $params);
        }
    }

    public function transactionProductDetailAddHandler()
    {
        $idtransaction = ($this->input->post('idtransaction') != null ? $this->input->post('idtransaction') : 'kosoong');
        $idvendor = ($this->input->post('idvendor') != null ? $this->input->post('idvendor') : 'kosoong');
        $idtherapist = ($this->input->post('idtherapist') != null ? $this->input->post('idtherapist') : 'kosoong');
        $typeproduct = ($this->input->post('typeproduct') != null ? $this->input->post('typeproduct') : 'kosoong');
        $idproduct = ($this->input->post('idproduct') != null ? $this->input->post('idproduct') : 'kosoong');
        $idproductArray = explode("-", $idproduct);
        $idproduct = $idproductArray[0];
        
        $nameproduct = ($this->input->post('nameproduct') != null ? $this->input->post('nameproduct') : 'kosoong');
        $amount = ($this->input->post('amount') != null ? $this->input->post('amount') : 'kosoong');
        $discount = ($this->input->post('discount') != null ? $this->input->post('discount') : 'kosoong');
        $sellprice = ($this->input->post('sellprice') != null ? $this->input->post('sellprice') : 'kosoong');
        $sellpriceDBFormatted = '';
        $sellpriceExplode = explode(".", $sellprice);
        foreach ($sellpriceExplode as $row) {
            $sellpriceDBFormatted = $sellpriceDBFormatted . $row;
        }


        $discountprice = ($this->input->post('discountprice') != null ? $this->input->post('discountprice') : 'kosoong');
        $discountpriceDBFormatted = '';
        $discountpriceExplode = explode(".", $discountprice);
        foreach ($discountpriceExplode as $row) {
            $discountpriceDBFormatted = $discountpriceDBFormatted . $row;
        }

        $transactionproductdate = date('d M Y');
        $transactionproductdateDBFormatted = date('Y/m/d', strtotime($transactionproductdate));

        // echo $idtransaction;
        // echo '<br>';
        // echo $idvendor;
        // echo '<br>';
        // echo $typeproduct;
        // echo '<br>';
        // echo $idproduct;
        // echo '<br>';
        // echo $nameproduct;
        // echo '<br>';
        // echo $amount;
        // echo '<br>';
        // echo $discount;
        // echo '<br>';
        // echo $sellpriceDBFormatted;
        // echo '<br>';
        // echo $discountpriceDBFormatted;
        // echo '<br>';
        // echo $transactionproductdateDBFormatted;
        // echo '<br>';


        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_VENDOR',$idvendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];

        // -----------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_VENDOR',$idvendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // -----------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_STOCK_TYPE',9],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$idvendor],
            ['ID_USER_SENDER',$idtherapist],
            ['ID_VENDOR_RECEIVER',$idvendor],
            ['ID_USER_RECEIVER',$idtherapist],
            ['DATE_STOCK_HISTORY',$transactionproductdateDBFormatted],
            ['LATEST_STOCK_AMOUNT', $lateststock - $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
        $id_stock_history = $result;

        // -----------------------------------------------------------------------------------------------------------

        $params_table = 'TRANSACTION_PRODUCT';
        $params_columns = [
            ['ID_TRANSACTION',$idtransaction],
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_STOCK_HISTORY',$id_stock_history],
            ['AMOUNT_PRODUCT',$amount],
            ['DISCOUNT_PRODUCT',$discount],
            ['TOTAL_PRICE',$sellpriceDBFormatted],
            ['DATE_TRANSACTION_PRODUCT',$transactionproductdateDBFormatted]
        ];
        $params_conditions = [];

        $result = $this->Transaction_Model->insertNewTransaction($params_table, $params_columns, $params_conditions);

        $result > 0 ? redirect('TransactionProduct/transactionDetailView/' . $idtransaction) : $this->errorviewPage('Ada kegagalan ketika menambahkan transaksi baru') ;
    }

    public function transactionProductDetailEditHandler()
    {
        // -- Get the post data from form --
        $idtransaction = ($this->input->post('idtransaction') != null ? $this->input->post('idtransaction') : 'kosoong');
        $idtransactionproduct = ($this->input->post('idtransactionproduct') != null ? $this->input->post('idtransactionproduct') : 'kosoong');
        $typeproduct = ($this->input->post('typeproduct') != null ? $this->input->post('typeproduct') : 'kosoong');
        $idproduct = ($this->input->post('idproduct') != null ? $this->input->post('idproduct') : 'kosoong');
        $idtherapist = ($this->input->post('idtherapist') != null ? $this->input->post('idtherapist') : 'kosoong');
        $idproductArray = explode("-", $idproduct);
        $idproduct = $idproductArray[0];
        
        $nameproduct = ($this->input->post('nameproduct') != null ? $this->input->post('nameproduct') : 'kosoong');
        $amount = ($this->input->post('amount') != null ? $this->input->post('amount') : 'kosoong');
        $discount = ($this->input->post('discount') != null ? $this->input->post('discount') : 'kosoong');
        $sellprice = ($this->input->post('sellprice') != null ? $this->input->post('sellprice') : 'kosoong');
        $sellpriceDBFormatted = '';
        $sellpriceExplode = explode(".", $sellprice);
        foreach ($sellpriceExplode as $row) {
            $sellpriceDBFormatted = $sellpriceDBFormatted . $row;
        }


        $discountprice = ($this->input->post('discountprice') != null ? $this->input->post('discountprice') : 'kosoong');
        $discountpriceDBFormatted = '';
        $discountpriceExplode = explode(".", $discountprice);
        foreach ($discountpriceExplode as $row) {
            $discountpriceDBFormatted = $discountpriceDBFormatted . $row;
        }

        $transactionproductdate = date('d M Y');
        $transactionproductdateDBFormatted = date('Y/m/d', strtotime($transactionproductdate));

        // -- Print the formdata --

        // echo $idtransaction;
        // echo '<br>';
        // echo $typeproduct;
        // echo '<br>';
        // echo $idproduct;
        // echo '<br>';
        // echo $nameproduct;
        // echo '<br>';
        // echo $amount;
        // echo '<br>';
        // echo $discount;
        // echo '<br>';
        // echo $sellpriceDBFormatted;
        // echo '<br>';
        // echo $discountpriceDBFormatted;
        // echo '<br>';

        // -- Get transactionproduct data/row by id --

        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',
                'TRANSACTION_PRODUCT.ID_STOCK_HISTORY',
                'VENDOR.ID_VENDOR',
                'PRODUCT.TYPE_PRODUCT',
                'PRODUCT.ID_PRODUCT',
                'PRODUCT.NAME_PRODUCT',
                'TRANSACTION_PRODUCT.AMOUNT_PRODUCT',
                'VENDOR.NAME_VENDOR'
            ];
        $params_conditions = [
                ['TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',$idtransactionproduct]
            ];

        $params_join = [
                ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
            ];
        $transactionbyid = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

            
        echo "<pre>";
        print_r($transactionbyid);
        echo "</pre>";

        // -- Get the latest stock amount of the product in transactionbyid --

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$transactionbyid[0]['TYPE_PRODUCT']],
            ['ID_PRODUCT',$transactionbyid[0]['ID_PRODUCT']],
            ['ID_VENDOR',$transactionbyid[0]['ID_VENDOR']]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];

        // -- Return the latest stock amount of the product in transactionbyid to before transaction --

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock + $transactionbyid[0]['AMOUNT_PRODUCT']],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$transactionbyid[0]['TYPE_PRODUCT']],
            ['ID_PRODUCT',$transactionbyid[0]['ID_PRODUCT']],
            ['ID_VENDOR',$transactionbyid[0]['ID_VENDOR']]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$transactionbyid[0]['TYPE_PRODUCT']],
            ['ID_PRODUCT',$transactionbyid[0]['ID_PRODUCT']],
            ['ID_STOCK_TYPE',11],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$transactionbyid[0]['ID_VENDOR']],
            ['ID_USER_SENDER',$idtherapist],
            ['ID_VENDOR_RECEIVER',$transactionbyid[0]['ID_VENDOR']],
            ['ID_USER_RECEIVER',$idtherapist],
            ['DATE_STOCK_HISTORY',$transactionproductdateDBFormatted],
            ['LATEST_STOCK_AMOUNT', $lateststock + $transactionbyid[0]['AMOUNT_PRODUCT']]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
        $id_stock_history = $result;


        // -- Get the latest stock amount of the product in transactionbyid --

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_VENDOR',$transactionbyid[0]['ID_VENDOR']]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];

        // -- Update the latest stock amount of the product in the editted transactionproduct from form --
        
        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_VENDOR',$transactionbyid[0]['ID_VENDOR']]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['ID_STOCK_TYPE',9],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$transactionbyid[0]['ID_VENDOR']],
            ['ID_USER_SENDER',$idtherapist],
            ['ID_VENDOR_RECEIVER',$transactionbyid[0]['ID_VENDOR']],
            ['ID_USER_RECEIVER',$idtherapist],
            ['DATE_STOCK_HISTORY',$transactionproductdateDBFormatted],
            ['LATEST_STOCK_AMOUNT', $lateststock - $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
        $id_stock_history = $result;

        // -- Update the editted transactionproduct from form --

        $params_table = 'TRANSACTION_PRODUCT';
        $params_columns = [
            ['TYPE_PRODUCT',$typeproduct],
            ['ID_PRODUCT',$idproduct],
            ['AMOUNT_PRODUCT',$amount],
            ['DISCOUNT_PRODUCT',$discount],
            ['TOTAL_PRICE',$sellpriceDBFormatted],
            ['ID_STOCK_HISTORY',$id_stock_history]
        ];
        $params_conditions = [
            ['ID_TRANSACTION_PRODUCT',$idtransactionproduct]
        ];

        $result = $this->Transaction_Model->updateTransaction($params_table, $params_columns, $params_conditions);
        // echo $result;
        $result >= 1 ? redirect('TransactionProduct/transactionDetailView/' . $idtransaction) : $this->errorviewPage('Ada kegagalan ketika merubah transaksi produk') ;
    }

    public function transactionproductByIdRequest()
    {
        $id_transaction_product = ($this->input->post('id_transaction_product') != null ? $this->input->post('id_transaction_product') : 'kosoong');

        // echo $id_transaction_product;

        $params_table = 'TRANSACTION_PRODUCT';
        $params_columns = [
                'TRANSACTION_PRODUCT.ID_TRANSACTION',
                'TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',
                'TRANSACTION_PRODUCT.TYPE_PRODUCT',
                'TRANSACTION_PRODUCT.ID_PRODUCT',
                'PRODUCT.NAME_PRODUCT',
                'PRODUCT.SELL_PRICE_PRODUCT',
                'TRANSACTION_PRODUCT.AMOUNT_PRODUCT',
                'TRANSACTION_PRODUCT.DISCOUNT_PRODUCT',
                'TRANSACTION_PRODUCT.TOTAL_PRICE'
            ];
        $params_conditions = [
                ['TRANSACTION_PRODUCT.ID_TRANSACTION_PRODUCT',$id_transaction_product]
            ];

        $params_join = [
                ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
            ];
        $result = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

        print_r(json_encode($result));
    }
    
    public function errorviewPage($error_message)
    {
        // echo $error_message;

        $params['header']['headertitle'] = 'Transaksi Produk';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Transaction_Product';

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

        $this->load->view('transactionproduct/transactionproduct_template', $params);
    }

    public function transactionProductCurrentDateListRequest()
    {
        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION.DATE_TRANSACTION',
                'CUSTOMER.NAME_CUSTOMER',
                'USER.NAME_USER',
                'VENDOR.NAME_VENDOR',
                '(SELECT SUM(TOTAL_PRICE * (100 - DISCOUNT_PRODUCT) / 100 )
                FROM transaction_product
                WHERE ID_TRANSACTION = TRANSACTION.ID_TRANSACTION
                GROUP BY ID_TRANSACTION) as TOTAL_TRANSACTION'
            ];
        $params_conditions = [
                ['TRANSACTION.DATE_TRANSACTION', date('y-m-d'), 'AND', 'LIKE']
            ];

        $params_join = [
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR']
            ];

        $result = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        $newResult = [];
        // foreach ($result as $row) {
        //     $row['DATE_TRANSACTION'] = date('d M Y', strtotime($row['DATE_TRANSACTION']));
        // }

        for ($i=0; $i < count($result); $i++) {
            $newResult[$i] = $result[$i];
            $newResult[$i]['DATE_TRANSACTION'] = date('d F Y', strtotime($newResult[$i]['DATE_TRANSACTION']));
        }

        $result = $newResult;
        
        print_r(json_encode($result));
    }

    public function transactionProductCurrentMonthListRequest()
    {
        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION.DATE_TRANSACTION',
                'CUSTOMER.NAME_CUSTOMER',
                'USER.NAME_USER',
                'VENDOR.NAME_VENDOR',
                '(SELECT SUM(TOTAL_PRICE * (100 - DISCOUNT_PRODUCT) / 100 )
                FROM transaction_product
                WHERE ID_TRANSACTION = TRANSACTION.ID_TRANSACTION
                GROUP BY ID_TRANSACTION) as TOTAL_TRANSACTION'
            ];
        $params_conditions = [
                ['TRANSACTION.DATE_TRANSACTION', date('y-m'), 'AND', 'LIKE']
            ];

        $params_join = [
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR']
            ];

        $result = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

        print_r(json_encode($result));
    }

    public function transactionProductCurrentYearListRequest()
    {
        $params_table = 'TRANSACTION';
        $params_columns = [
                'TRANSACTION.ID_TRANSACTION',
                'TRANSACTION.DATE_TRANSACTION',
                'CUSTOMER.NAME_CUSTOMER',
                'USER.NAME_USER',
                'VENDOR.ID_VENDOR',
                'VENDOR.NAME_VENDOR',
                '(SELECT SUM(TOTAL_PRICE * (100 - DISCOUNT_PRODUCT) / 100 )
                FROM transaction_product
                WHERE ID_TRANSACTION = TRANSACTION.ID_TRANSACTION
                GROUP BY ID_TRANSACTION) as TOTAL_TRANSACTION'
            ];
        $params_conditions = [
                ['TRANSACTION.DATE_TRANSACTION', date('y'), 'AND', 'LIKE']
            ];

        $params_join = [
                ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR']
            ];

        $result = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

        print_r(json_encode($result));
    }
}
