<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
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
        $this->productHomeView(0);
        // $this->productEditView(1);
    }

    public function productHomeView()
    {
        $params['header']['headertitle'] = 'Produk';
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

        $params['sidebar']['sidebar_active'] = 'Product_List';

        $params['content_wrapper'] = 'product/product_home';

        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            'ID_PRODUCT_TYPE',
            'NAME_PRODUCT_TYPE'
        ];
        $params_conditions = [
            ['STATUS_PRODUCT_TYPE','ACTIVE']
        ];
        $params['contents']['producttypeslist'] = $this->ProductType_Model->getProductTypeByColumn($params_table, $params_columns, $params_conditions);

        $params_table = 'PRODUCT';
        $params_columns = [
            'TYPE_PRODUCT',
            'ID_PRODUCT',
            'NAME_PRODUCT',
            'NAME_PRODUCT_TYPE',
            'SELL_PRICE_PRODUCT',
        ];
        $params_conditions = [
            ['STATUS_PRODUCT','ACTIVE']
        ];
        $params_join = [
            ['PRODUCT_TYPE', 'PRODUCT.TYPE_PRODUCT', 'PRODUCT_TYPE.ID_PRODUCT_TYPE'],
        ];
        $params['contents']['productslist'] = $this->Product_Model->getProductByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

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

        $this->load->view('product/product_template', $params);
    }


    public function productEditView($id_product)
    {
        $params['header']['headertitle'] = 'Edit Produk';
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

        $params['sidebar']['sidebar_active'] = 'Product_List';
        $params['content_wrapper'] = 'product/product_edit';

        $type_product = explode("-", $id_product)[0];
        $id_product = explode("-", $id_product)[1];
        $params_table = 'PRODUCT';
        $params_columns = [
            'type_product',
            'id_product',
            'name_product',
            'capital_price_product',
            'sell_price_product',
            'description_product',
            'status_product',
            'date_added_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT', $type_product],
            ['ID_PRODUCT',$id_product]
        ];

        $params['contents']['productslist'] = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);

        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            'ID_PRODUCT_TYPE',
            'NAME_PRODUCT_TYPE'
        ];
        $params_conditions = [
            ['STATUS_PRODUCT_TYPE','ACTIVE']
        ];
        $params['contents']['producttypeslist'] = $this->ProductType_Model->getProductTypeByColumn($params_table, $params_columns, $params_conditions);

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

        $params_table_stock = 'STOCK_HISTORY';
        $params_columns_stock = [
            'STOCK_HISTORY.ID_STOCK_HISTORY AS ID_ENTRY',
            'STOCK_HISTORY.TYPE_PRODUCT',
            'STOCK_HISTORY.ID_PRODUCT',
            'STOCK_TYPE.NAME_STOCK_TYPE',
            'PRODUCT.NAME_PRODUCT',
            'STOCK_HISTORY.AMOUNT_STOCK AS AMOUNT',
            'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
            'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
            'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
            'USER_SENDER.NAME_USER AS USER_SENDER',
            'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
            'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
            'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
            'STOCK_HISTORY.DATE_STOCK_HISTORY AS DATE_ENTRY',
            'STOCK_STATUS.NAME_STOCK_STATUS'
        ];

        $params_join_stock = [
            ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
            ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
            ['STOCK_STATUS', 'STOCK_STATUS.ID_STOCK_STATUS = STOCK_HISTORY.ID_STOCK_STATUS'],
            ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
            ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
            ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
            ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
        ];

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
        $params_join_transaction = [
                    ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                    ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                    ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                    ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                    ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
                ];

        $stocklist = [];
        $transactionlist = [];
        
        foreach ($therapistvisibility as $uv) {
            $stocks = [];
            $name_vendor = $uv['NAME_VENDOR'];

            for ($i=0; $i < 8; $i++) {
                $j = $i+1;
                if ($j == 1 || $j == 3 || $j == 4 || $j == 5 || $j == 6 || $j == 7 || $j == 8) {
                    $params_conditions_stock = [
                        ['STOCK_HISTORY.TYPE_PRODUCT', $type_product],
                        ['STOCK_HISTORY.ID_PRODUCT', $id_product],
                        ['VENDOR_RECEIVER.NAME_VENDOR', $name_vendor],
                        ['STOCK_HISTORY.ID_STOCK_TYPE', $j]
                    ];
                } elseif ($j == 2) {
                    $params_conditions_stock = [
                        ['STOCK_HISTORY.TYPE_PRODUCT', $type_product],
                        ['STOCK_HISTORY.ID_PRODUCT', $id_product],
                        ['VENDOR_SENDER.NAME_VENDOR', $name_vendor],
                        ['STOCK_HISTORY.ID_STOCK_TYPE', $j]
                    ];
                }
                $result = $this->Stock_Model->getStockByColumnJoin($params_table_stock, $params_columns_stock, $params_conditions_stock, $params_join_stock);
                $stocks = array_merge($stocks, $result);
            }

            $stocklist = array_merge($stocklist, $stocks);

            $params_conditions_transaction = [
                ['PRODUCT.TYPE_PRODUCT', $type_product],
                ['PRODUCT.ID_PRODUCT', $id_product],
                ['VENDOR.NAME_VENDOR', $name_vendor]

            ];

            $result = $this->Transaction_Model->getTransactionByColumnJoin($params_table_transaction, $params_columns_transaction, $params_conditions_transaction, $params_join_transaction);
            $transactionlist = array_merge($transactionlist, $result);
        }

        // $params['contents']['stocklist'] = array_merge($stocklist, $transactionlist);
        $params['contents']['stocklist'] = $stocklist;
        $params['contents']['transactionlist'] = $transactionlist;

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

        $this->load->view('product/product_template', $params);
    }

    public function productAddHandler()
    {
        $type = ($this->input->post('type') != null ? $this->input->post('type') : null);
        $id = ($this->input->post('id') != null ? $this->input->post('id') : 'kosong');
        $name = ($this->input->post('name') != null ? $this->input->post('name') : null);
        $capitalprice = ($this->input->post('capitalprice') != null ? $this->input->post('capitalprice') : null);
        $capitalpriceDBFormatted = '';
        $sellprice = ($this->input->post('sellprice') != null ? $this->input->post('sellprice') : null);
        $sellpriceDBFormatted = '';
        $description = ($this->input->post('description') != null ? $this->input->post('description') : null);
        $useraddedproduct = $this->session->user_id;
        $userupdatedproduct = $this->session->user_id;
        
        $capitalpriceExplode = explode(".", $capitalprice);
        foreach ($capitalpriceExplode as $row) {
            $capitalpriceDBFormatted = $capitalpriceDBFormatted . $row;
        }

        $sellpriceExplode = explode(".", $sellprice);
        foreach ($sellpriceExplode as $row) {
            $sellpriceDBFormatted = $sellpriceDBFormatted . $row;
        }

        $dateadded = date('d M Y');
        $dateaddedDBFormatted = date('Y/m/d', strtotime($dateadded));

        $dateupdated = date('d M Y');
        $dateupdatedDBFormatted = date('Y/m/d', strtotime($dateupdated));

        // echo $type;
        // echo '<br>';
        // echo $id;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $capitalpriceDBFormatted;
        // echo '<br>';
        // echo $sellpriceDBFormatted;
        // echo '<br>';
        // echo $description;

        $params_table = 'PRODUCT';
        $params_columns = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['NAME_PRODUCT',$name],
            ['CAPITAL_PRICE_PRODUCT',$capitalpriceDBFormatted],
            ['DATE_ADDED_PRODUCT',$dateaddedDBFormatted],
            ['USER_ADDED_PRODUCT',$useraddedproduct],
            ['DATE_UPDATED_PRODUCT',$dateupdatedDBFormatted],
            ['USER_UPDATED_PRODUCT',$userupdatedproduct],
            ['SELL_PRICE_PRODUCT',$sellpriceDBFormatted],
            ['DESCRIPTION_PRODUCT',$description],
            ['IS_UPDATED_PRODUCT', 0]
        ];
        $params_conditions = null;

        // $result = 1;
        $result = $this->Product_Model->insertNewProduct($params_table, $params_columns, $params_conditions);
        // $result == 1 ? redirect('Product') : $this->errorviewPage('Ada kegagalan ketika menambahkan produk');
    
        if ($result == 1) {
            $params_table = 'VENDOR';
            $params_columns = [
                'ID_VENDOR',
                'NAME_VENDOR'
            ];
            $params_conditions = [
                ['TYPE_VENDOR','STORE']
            ];
            $stores = $this->Vendor_Model->getVendorByColumn($params_table, $params_columns, $params_conditions);
            
            // echo '<pre>';
            // print_r($stores);
            // echo '</pre>';

            foreach ($stores as $key => $row) {
                // echo $row['ID_VENDOR'];
                $params_table = 'STOCK';
                $params_columns = [
                    ['TYPE_PRODUCT',$type],
                    ['ID_PRODUCT',$id],
                    ['ID_VENDOR',$row['ID_VENDOR']],
                    ['STOCK_PRODUCT',0],
                    ['STATUS_STOCK','ACTIVE']
                 ];
                $params_conditions = null;

                $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
                // echo $result;
                // echo '<br>';
            }
            redirect('Product');
        } else {
            $this->errorviewPage('Ada kegagalan ketika menambahkan produk');
        };
    }

    public function productEditHandler($id_product)
    {
        $type_product = explode("-", $id_product)[0];
        $id_product = explode("-", $id_product)[1];
       
        $type = ($this->input->post('type') != null ? $this->input->post('type') : null);
        $id = ($this->input->post('id') != null ? $this->input->post('id') : 'kosong');
        $name = ($this->input->post('name') != null ? $this->input->post('name') : null);
        $capitalprice = ($this->input->post('capitalprice') != null ? $this->input->post('capitalprice') : null);
        $capitalpriceDBFormatted = '';
        $sellprice = ($this->input->post('sellprice') != null ? $this->input->post('sellprice') : null);
        $sellpriceDBFormatted = '';
        $description = ($this->input->post('description') != null ? $this->input->post('description') : null);
        $status = ($this->input->post('status') != null ? $this->input->post('status') : null);

        $userupdatedproduct = $this->session->user_id;

        $dateupdated = date('d M Y');
        $dateupdatedDBFormatted = date('Y/m/d', strtotime($dateupdated));
        
        $capitalpriceExplode = explode(".", $capitalprice);
        foreach ($capitalpriceExplode as $row) {
            $capitalpriceDBFormatted = $capitalpriceDBFormatted . $row;
        }

        $sellpriceExplode = explode(".", $sellprice);
        foreach ($sellpriceExplode as $row) {
            $sellpriceDBFormatted = $sellpriceDBFormatted . $row;
        }

        echo $type;
        echo '<br>';
        echo $id;
        echo '<br>';
        echo $name;
        echo '<br>';
        echo $capitalpriceDBFormatted;
        echo '<br>';
        echo $sellpriceDBFormatted;
        echo '<br>';
        echo $description;

        $params_table = 'PRODUCT';
        $params_columns = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['NAME_PRODUCT',$name],
            ['CAPITAL_PRICE_PRODUCT',$capitalpriceDBFormatted],
            ['DATE_UPDATED_PRODUCT',$dateupdatedDBFormatted],
            ['USER_UPDATED_PRODUCT',$userupdatedproduct],
            ['SELL_PRICE_PRODUCT',$sellpriceDBFormatted],
            ['DESCRIPTION_PRODUCT',$description],
            ['STATUS_PRODUCT',$status],
            ['IS_UPDATED_PRODUCT', 1]
        ];
        $params_conditions = [
            ['TYPE_PRODUCT', $type_product],
            ['ID_PRODUCT',$id_product]
        ];

        $result = $this->Product_Model->updateProduct($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Product/productEditView/'. $type_product . '-' . $id_product) : $this->errorviewPage('Ada kegagalan ketika memperbarui produk') ;
    }

    public function productArchiveHandler($id_product)
    {
        // echo $id_product;
        
        $type_product = explode("-", $id_product)[0];
        $id_product = explode("-", $id_product)[1];

        $params_table = 'PRODUCT';
        $params_columns = [
            ['STATUS_PRODUCT','ARCHIVE'],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT', $type_product],
            ['ID_PRODUCT',$id_product]
        ];

        $result = $this->Product_Model->updateProduct($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('Product') : $this->errorviewPage('Ada kegagalan ketika mengarsip produk') ;
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

        $params['sidebar']['sidebar_active'] = 'Product_Type';

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

        $this->load->view('product_type/product_type_template', $params);
    }

    public function productLatestIdRequest($type_product)
    {
        // echo $type_product;

        $params_table = 'PRODUCT';
        $params_columns = [
            'ID_PRODUCT'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT', $type_product]
        ];
        $params_orderby = [
            ['ID_PRODUCT', 'DESC']
        ];
        $params_limit = 1;
        $result = $this->Product_Model->getProductOrderByLimit($params_table, $params_columns, $params_conditions, $params_orderby, $params_limit);
        if (count($result) > 0) {
            $result = $result[0]['ID_PRODUCT'];
            $result = sprintf('%03d', $result + 1);
        } else {
            $result = '001';
        }

        print_r($result);
    }

    public function productDuplicateCheck()
    {
        if ($this->input->post('input') == 'id') {
            $type_product = $this->input->post('type');
            $id_product = $this->input->post('id');

            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT',$id_product]
            ];
        } elseif ($this->input->post('input') == 'name') {
            $name_product = $this->input->post('name');

            $params_conditions = [
                ['NAME_PRODUCT', $name_product],
            ];
        }

        $params_table = 'PRODUCT';
        $params_columns = [
            'type_product',
            'id_product',
            'name_product'
        ];
        
        $result = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);

        print_r(json_encode($result));
    }

    public function productByTypeRequest()
    {
        // print_r($this->input->post('type'));
        $params_table = 'PRODUCT';
        $params_columns = [
            'TYPE_PRODUCT',
            'ID_PRODUCT',
            'NAME_PRODUCT',
            'CAPITAL_PRICE_PRODUCT',
            'SELL_PRICE_PRODUCT'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT', $this->input->post('type')]
        ];
        
        $result = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);

        print_r(json_encode($result));
    }

    public function productTypeRequest()
    {
        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
                'ID_PRODUCT_TYPE'
            ];
        $params_conditions = [];
        $result = $this->Product_Model->getProductByColumn($params_table, $params_columns, $params_conditions);

        print_r(json_encode($result));
    }

    public function latestProductListRequest()
    {
        $params_table = 'PRODUCT';
        $params_columns = [
            'PRODUCT.TYPE_PRODUCT',
            'PRODUCT.ID_PRODUCT',
            'PRODUCT.NAME_PRODUCT',
            'PRODUCT.SELL_PRICE_PRODUCT',
            'PRODUCT.DATE_ADDED_PRODUCT',
            'USER_ADDED.NAME_USER as NAME_USER_ADDED',
            'PRODUCT.DATE_UPDATED_PRODUCT',
            'USER_UPDATED.NAME_USER as NAME_USER_UPDATED',
            'PRODUCT.IS_UPDATED_PRODUCT'
        ];
        $params_conditions = [
            ['STATUS_PRODUCT','ACTIVE']
        ];
        $params_join = [
            ['USER as USER_ADDED', 'PRODUCT.USER_ADDED_PRODUCT', 'USER_ADDED.ID_USER'],
            ['USER as USER_UPDATED', 'PRODUCT.USER_UPDATED_PRODUCT', 'USER_UPDATED.ID_USER'],
        ];
        $params_orderby = [
            ['DATE_UPDATED_PRODUCT', 'DESC'],
            ['DATE_ADDED_PRODUCT', 'DESC']
        ];
        $params_limit = 5;
        
        $result = $this->Product_Model->getProductOrderByColumnJoinLimit($params_table, $params_columns, $params_conditions, $params_orderby, $params_join, $params_limit);
        
        $newResult = [];
        // foreach ($result as $row) {
        //     $row['DATE_TRANSACTION'] = date('d M Y', strtotime($row['DATE_TRANSACTION']));
        // }

        for ($i=0; $i < count($result); $i++) {
            $newResult[$i] = $result[$i];
            $newResult[$i]['DATE_ADDED_PRODUCT'] = date('d F Y', strtotime($newResult[$i]['DATE_ADDED_PRODUCT']));
            $newResult[$i]['DATE_UPDATED_PRODUCT'] = date('d F Y', strtotime($newResult[$i]['DATE_UPDATED_PRODUCT']));
        }

        $result = $newResult;

        print_r(json_encode($result));
    }
}