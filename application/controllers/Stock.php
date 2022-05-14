<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Product_Model');
        $this->load->model('Stock_Model');
        $this->load->model('Transaction_Model');
        $this->load->model('Vendor_Model');
        $this->load->model('User_Model');

        if ($this->session->has_userdata('logged_in') == false) {
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
        $this->stockHomeView();
    }

    public function stockHomeView()
    {
        $params['header']['headertitle'] = 'Stock';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'),
            base_url('assets/bower_components/select2/dist/css/select2.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Stock';

        $params['content_wrapper'] = 'stock/stock_home';

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

        $params_table = 'STOCK';
        $params_columns = [
            'STOCK.TYPE_PRODUCT',
            'STOCK.ID_PRODUCT',
            'PRODUCT.NAME_PRODUCT',
            'VENDOR.NAME_VENDOR',
            'STOCK.STOCK_PRODUCT',
        ];
        $params_conditions = [
            ['PRODUCT.STATUS_PRODUCT','ACTIVE']
        ];
        $params_join = [
            ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = STOCK.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = STOCK.ID_PRODUCT', 'AND'],
            ['VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
        ];

        if (count($therapistvisibility) > 0 && isset($therapistvisibility[0])) {
            for ($i=0; $i < count($therapistvisibility); $i++) {
                $i == 0 ?
                (
                    array_push($params_conditions, ['STOCK.ID_VENDOR', $therapistvisibility[$i]['ID_VENDOR'], 'AND'])
                ) :
                (
                    array_push($params_conditions, ['STOCK.ID_VENDOR', $therapistvisibility[$i]['ID_VENDOR'], 'OR'])
                );
            }
            
            $params['contents']['stocklist'] = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        } else {
            $params['contents']['stocklist'] = 'Anda tidak memiliki hak akses untuk melihat stok produk';
        }

        $params['footer']['scriptsrc'] = [
            base_url('assets/bower_components/jquery/dist/jquery.min.js'),
            base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
            base_url('assets/bower_components/fastclick/lib/fastclick.js'),
            base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'),
            base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'),
            base_url('assets/bower_components/select2/dist/js/select2.full.min.js'),
            base_url('assets/dist/js/adminlte.min.js'),
            base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'),
            base_url('assets/dist/js/demo.js')
        ];

        $this->load->view('stock/stock_template', $params);
    }

    public function stockReceiptView($product_stock)
    {
        $type_product = explode("-", $product_stock)[0];
        $id_product = explode("-", $product_stock)[1];
        $name_vendor = explode("-", $product_stock)[2];

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

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('Stock/');
        } else {
            $params['header']['headertitle'] = 'Stock Masuk';
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
    
            $params['sidebar']['sidebar_active'] = 'Stock';
    
            $params['content_wrapper'] = 'stock/stock_receipt';
    
            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                'STOCK_HISTORY.ID_STOCK_HISTORY',
                'STOCK_HISTORY.TYPE_PRODUCT',
                'STOCK_HISTORY.ID_PRODUCT',
                'PRODUCT.NAME_PRODUCT',
                'STOCK_HISTORY.AMOUNT_STOCK',
                'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                'USER_SENDER.NAME_USER AS USER_SENDER',
                'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                'STOCK_HISTORY.DATE_STOCK_HISTORY',
                'STOCK_HISTORY.STATUS_STOCK_HISTORY'
            ];
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_RECEIVER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',1]
            ];
            $params_join = [
                ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
            ];
            $params['contents']['stocklist'] = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            
            $params_table = 'PRODUCT';
            $params_columns = [
                'NAME_PRODUCT'
            ];
            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT', $id_product]
            ];
            $getnameproduct = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);
            
            $name_product = $getnameproduct[0]['NAME_PRODUCT'];
    
            $params['contents']['contenttitle'] = array(
                "ID_PRODUCT" => $id_product,
                "TYPE_PRODUCT" => $type_product,
                "NAME_PRODUCT" => $name_product
            );
    
            $params_table = 'VENDOR';
            $params_columns = [
                'ID_VENDOR',
                'NAME_VENDOR',
                'TYPE_VENDOR'
            ];
            $params_conditions = [];
            $params['contents']['vendorslist'] = $this->Vendor_Model->getVendorByColumn($params_table, $params_columns, $params_conditions);
    
            $params_table = 'USER';
            $params_columns = [
                'ID_USER',
                'NAME_USER'
            ];
            $params_conditions = [
                ['STATUS_USER', 'ACTIVE']
            ];
            $params['contents']['userslist'] = $this->User_Model->getUserByColumn($params_table, $params_columns, $params_conditions);
            
            $params_table = 'STOCK';
            $params_columns = [
                'STOCK.STOCK_PRODUCT'
            ];
            $params_conditions = [
                ['STOCK.TYPE_PRODUCT',$type_product],
                ['STOCK.ID_PRODUCT',$id_product],
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];
            $params_join = [
                ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
            ];
    
            $remainingstock = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            $params['contents']['remainingstock'] = $remainingstock[0]['STOCK_PRODUCT'];

            $params['contents']['therapistvisibility'] = $therapistvisibility;
            
            $params['contents']['name_vendor'] = $name_vendor;
            
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
    
            $this->load->view('stock/stock_template', $params);
        }
    }

    public function stockReceiptAddHandler()
    {
        $id = ($this->input->post('stock_receipt_id') != null ? $this->input->post('stock_receipt_id') : 'kosoong');
        $name = ($this->input->post('stock_receipt_name') != null ? $this->input->post('stock_receipt_name') : 'kosoong');
        $name_vendor = ($this->input->post('stock_receipt_name_vendor') != null ? $this->input->post('stock_receipt_name_vendor') : 'kosoong');
        $amount = ($this->input->post('stock_receipt_amount') != null ? $this->input->post('stock_receipt_amount') : null);
        $sendervendor = ($this->input->post('stock_receipt_sendervendor') != null ? $this->input->post('stock_receipt_sendervendor') : 'kosoong');
        $senderuser = ($this->input->post('stock_receipt_senderuser') != null ? $this->input->post('stock_receipt_senderuser') : 'kosoong');
        $receivervendor = ($this->input->post('stock_receipt_receivervendor') != null ? $this->input->post('stock_receipt_receivervendor') : null);
        $receiveruser = ($this->input->post('stock_receipt_receiveruser') != null ? $this->input->post('stock_receipt_receiveruser') : null);
        $description = ($this->input->post('stock_receipt_description') != null ? $this->input->post('stock_receipt_description') : '');
        $entrydate = ($this->input->post('stock_receipt_entrydate') != null ? $this->input->post('stock_receipt_entrydate') : null);
        $entrydateDBFormatted = date('Y/m/d', strtotime($entrydate));

        $type_product = explode("-", $id)[0];
        $id_product = explode("-", $id)[1];

        $id_sender_vendor = explode("-", $sendervendor)[0];
        $name_sender_vendor = explode("-", $sendervendor)[1];
        $id_receiver_vendor = explode("-", $receivervendor)[0];
        $name_receiver_vendor = explode("-", $receivervendor)[1];

        // echo $id;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $amount;
        // echo '<br>';
        // echo $sendervendor;
        // echo '<br>';
        // echo $senderuser;
        // echo '<br>';
        // echo $receivervendor;
        // echo '<br>';
        // echo $receiveruser;
        // echo '<br>';
        // echo $entrydateDBFormatted;

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_VENDOR',$id_receiver_vendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ---------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock + $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_VENDOR',$id_receiver_vendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);
        
        // ---------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_STOCK_TYPE',1],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$id_sender_vendor],
            ['ID_USER_SENDER',$senderuser],
            ['ID_VENDOR_RECEIVER',$id_receiver_vendor],
            ['ID_USER_RECEIVER',$receiveruser],
            ['DESCRIPTION_STOCK_HISTORY', $description],
            ['DATE_STOCK_HISTORY',$entrydateDBFormatted],
            ['LATEST_STOCK_AMOUNT',$lateststock + $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);

        // print_r($result);

        // ---------------------------------------------------------------------------------------------------------

        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $type_product . '-' . $id_product . '-' . $name_receiver_vendor) : $this->errorviewPage('Ada kegagalan ketika menambahkan stock masuk') ;
    }

    public function stockReceiptVerify()
    {
        // echo 'Verify!';

        // echo $this->input->post('idstockhistory');
        // echo $this->input->post('userid');
        if ($this->session->user_type == 'Admin' || $this->session->user_type == 'Super Admin' || $this->input->post('uvstore') == 'Sengon') {
            
            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                ['ID_STOCK_STATUS', $this->input->post('status')],
            ];
            $params_conditions = [
                ['ID_STOCK_HISTORY',$this->input->post('idstockhistory')]
            ];
    
            $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);
    
            $result = ($result == 1) ?
            (
                array(
                    'status' => true,
                    'message' => 'Stock history berhasil diverifikasi'
                )
            )
            :
            (
                array(
                    'status' => false,
                    'message' => 'Stock history gagal diverifikasi'
                )
            );
    
            print_r(json_encode($result));
        } else {
            $result = array(
                    'status' => false,
                    'message' => 'Anda tidak memiliki hak akses untuk memverifikasi');
    
            print_r(json_encode($result));
        }
    }
    
    public function stockTransferView($product_stock)
    {
        $type_product = explode("-", $product_stock)[0];
        $id_product = explode("-", $product_stock)[1];
        $name_vendor = explode("-", $product_stock)[2];

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

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('Stock/');
        } else {
            $params['header']['headertitle'] = 'Stock Transfer';
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
    
            $params['sidebar']['sidebar_active'] = 'Stock';
    
            $params['content_wrapper'] = 'stock/stock_transfer';
    
            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                'STOCK_HISTORY.ID_STOCK_HISTORY',
                'STOCK_HISTORY.TYPE_PRODUCT',
                'STOCK_HISTORY.ID_PRODUCT',
                'PRODUCT.NAME_PRODUCT',
                'STOCK_HISTORY.AMOUNT_STOCK',
                'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                'USER_SENDER.NAME_USER AS USER_SENDER',
                'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                'STOCK_HISTORY.DATE_STOCK_HISTORY',
                'STOCK_HISTORY.STATUS_STOCK_HISTORY',
                'STOCK_HISTORY.LATEST_STOCK_AMOUNT'
            ];
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',2]
            ];
            $params_join = [
                ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER'],
                ['STOCK_HISTORY AS REFERENCE_STOCK', 'REFERENCE_STOCK.ID_STOCK_HISTORY = STOCK_HISTORY.LATEST_STOCK_AMOUNT', 'left'],
            ];
            $params['contents']['stocklist'] = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_table = 'PRODUCT';
            $params_columns = [
                'NAME_PRODUCT'
            ];
            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT', $id_product]
            ];
            $getnameproduct = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);
            
            $name_product = $getnameproduct[0]['NAME_PRODUCT'];
    
            $params['contents']['contenttitle'] = array(
                "ID_PRODUCT" => $id_product,
                "TYPE_PRODUCT" => $type_product,
                "NAME_PRODUCT" => $name_product
            );
    
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
    
            $params_table = 'USER';
            $params_columns = [
                'ID_USER',
                'NAME_USER'
            ];
            $params_conditions = [
                ['STATUS_USER', 'ACTIVE']
            ];
            $params['contents']['userslist'] = $this->User_Model->getUserByColumn($params_table, $params_columns, $params_conditions);
            
            $params_table = 'STOCK';
            $params_columns = [
                'STOCK.STOCK_PRODUCT'
            ];
            $params_conditions = [
                ['STOCK.TYPE_PRODUCT',$type_product],
                ['STOCK.ID_PRODUCT',$id_product],
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];
            $params_join = [
                ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
            ];
    
            $remainingstock = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            $params['contents']['remainingstock'] = $remainingstock[0]['STOCK_PRODUCT'];
            
            $params['contents']['name_vendor'] = $name_vendor;
            $params['contents']['therapistvisibility'] = $therapistvisibility;
    
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
    
            $this->load->view('stock/stock_template', $params);
        }
    }

    public function stockTransferAddHandler()
    {
        $id = ($this->input->post('stock_transfer_id') != null ? $this->input->post('stock_transfer_id') : 'kosoong');
        $name = ($this->input->post('stock_transfer_name') != null ? $this->input->post('stock_transfer_name') : 'kosoong');
        $name_vendor = ($this->input->post('stock_transfer_name_vendor') != null ? $this->input->post('stock_transfer_name_vendor') : 'kosoong');
        $amount = ($this->input->post('stock_transfer_amount') != null ? $this->input->post('stock_transfer_amount') : null);
        $sendervendor = ($this->input->post('stock_transfer_sendervendor') != null ? $this->input->post('stock_transfer_sendervendor') : 'kosoong');
        $senderuser = ($this->input->post('stock_transfer_senderuser') != null ? $this->input->post('stock_transfer_senderuser') : 'kosoong');
        $receivervendor = ($this->input->post('stock_transfer_receivervendor') != null ? $this->input->post('stock_transfer_receivervendor') : null);
        $receiveruser = ($this->input->post('stock_transfer_receiveruser') != null ? $this->input->post('stock_transfer_receiveruser') : null);
        $description = ($this->input->post('stock_transfer_description') != null ? $this->input->post('stock_transfer_description') : '');
        $entrydate = ($this->input->post('stock_transfer_entrydate') != null ? $this->input->post('stock_transfer_entrydate') : null);
        $entrydateDBFormatted = date('Y/m/d', strtotime($entrydate));

        $type_product = explode("-", $id)[0];
        $id_product = explode("-", $id)[1];

        $id_sender_vendor = explode("-", $sendervendor)[0];
        $name_sender_vendor = explode("-", $sendervendor)[1];
        $id_receiver_vendor = explode("-", $receivervendor)[0];
        $name_receiver_vendor = explode("-", $receivervendor)[1];

        // echo $id;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $amount;
        // echo '<br>';
        // echo $sendervendor;
        // echo '<br>';
        // echo $senderuser;
        // echo '<br>';
        // echo $receivervendor;
        // echo '<br>';
        // echo $receiveruser;
        // echo '<br>';
        // echo $entrydateDBFormatted;

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_VENDOR',$id_sender_vendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ------------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_VENDOR',$id_sender_vendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // print_r($result);

        // ------------------------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$type_product],
            ['ID_PRODUCT',$id_product],
            ['ID_STOCK_TYPE',2],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$id_sender_vendor],
            ['ID_USER_SENDER',$senderuser],
            ['ID_VENDOR_RECEIVER',$id_receiver_vendor],
            ['ID_USER_RECEIVER',$receiveruser],
            ['DESCRIPTION_STOCK_HISTORY', $description],
            ['DATE_STOCK_HISTORY',$entrydateDBFormatted],
            ['LATEST_STOCK_AMOUNT',$lateststock - $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);

        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $type_product . '-' . $id_product . '-' . $name_sender_vendor) : $this->errorviewPage('Ada kegagalan ketika menambahkan stock transfer') ;
    }

    public function stockRecycleView($product_stock)
    {
        $type_product = explode("-", $product_stock)[0];
        $id_product = explode("-", $product_stock)[1];
        $name_vendor = explode("-", $product_stock)[2];

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

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('Stock/');
        } else {
            $params['header']['headertitle'] = 'Stock Repack/Menyusut';
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
    
            $params['sidebar']['sidebar_active'] = 'Stock';
    
            $params['content_wrapper'] = 'stock/stock_recycle';
    
            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                'STOCK_HISTORY.ID_STOCK_HISTORY',
                'STOCK_HISTORY.TYPE_PRODUCT',
                'STOCK_HISTORY.ID_PRODUCT',
                'STOCK_TYPE.NAME_STOCK_TYPE',
                'PRODUCT.NAME_PRODUCT',
                'STOCK_HISTORY.AMOUNT_STOCK',
                'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                'USER_SENDER.NAME_USER AS USER_SENDER',
                'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                'STOCK_HISTORY.DATE_STOCK_HISTORY',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                'STOCK_HISTORY.STATUS_STOCK_HISTORY'
            ];
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',3]
            ];
            $params_join = [
                ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
            ];
            $stockrepackoutbound = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',4]
            ];
            
            $stockrepackinbound = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',5]
            ];
            
            $stockrecycleoutbound = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',6]
            ];
            
            $stockrecycleinbound = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params['contents']['stocklist'] = array_merge($stockrepackoutbound, $stockrepackinbound, $stockrecycleoutbound, $stockrecycleinbound);
            
            $params_table = 'PRODUCT';
            $params_columns = [
                'NAME_PRODUCT'
            ];
            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT', $id_product]
            ];
            $getnameproduct = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);
            
            $name_product = $getnameproduct[0]['NAME_PRODUCT'];
    
            $params['contents']['contenttitle'] = array(
                "ID_PRODUCT" => $id_product,
                "TYPE_PRODUCT" => $type_product,
                "NAME_PRODUCT" => $name_product
            );
    
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
    
            $params_table = 'PRODUCT_TYPE';
            $params_columns = [
                'ID_PRODUCT_TYPE'
            ];
            $params_conditions = [];
            $params['contents']['producttypeslist'] = $this->Product_Model->getProductByColumn($params_table, $params_columns, $params_conditions);
    
            $params_table = 'USER';
            $params_columns = [
                'ID_USER',
                'NAME_USER'
            ];
            $params_conditions = [
                ['STATUS_USER', 'ACTIVE']
            ];
            $params['contents']['userslist'] = $this->User_Model->getUserByColumn($params_table, $params_columns, $params_conditions);
                    
            $params_table = 'STOCK';
            $params_columns = [
                'STOCK.STOCK_PRODUCT'
            ];
            $params_conditions = [
                ['STOCK.TYPE_PRODUCT',$type_product],
                ['STOCK.ID_PRODUCT',$id_product],
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];
            $params_join = [
                ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
            ];
    
            $remainingstock = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            $params['contents']['remainingstock'] = $remainingstock[0]['STOCK_PRODUCT'];
            
            $params['contents']['name_vendor'] = $name_vendor;
            
    
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
    
            $this->load->view('stock/stock_template', $params);
        }
    }

    public function stockExpiredView($product_stock)
    {
        $type_product = explode("-", $product_stock)[0];
        $id_product = explode("-", $product_stock)[1];
        $name_vendor = explode("-", $product_stock)[2];

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

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('Stock/');
        } else {
            $params['header']['headertitle'] = 'Stock Expired/Rusak';
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
    
            $params['sidebar']['sidebar_active'] = 'Stock';
    
            $params['content_wrapper'] = 'stock/stock_expired';
    
            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                'STOCK_HISTORY.ID_STOCK_HISTORY',
                'STOCK_HISTORY.TYPE_PRODUCT',
                'STOCK_HISTORY.ID_PRODUCT',
                'STOCK_TYPE.NAME_STOCK_TYPE',
                'PRODUCT.NAME_PRODUCT',
                'STOCK_HISTORY.AMOUNT_STOCK',
                'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                'USER_SENDER.NAME_USER AS USER_SENDER',
                'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                'STOCK_HISTORY.DATE_STOCK_HISTORY',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                'STOCK_HISTORY.STATUS_STOCK_HISTORY'
            ];
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',7]
            ];
            $params_join = [
                ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
            ];
            $stockexpired = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params_conditions = [
                ['STOCK_HISTORY.TYPE_PRODUCT',$type_product],
                ['STOCK_HISTORY.ID_PRODUCT',$id_product],
                ['VENDOR_SENDER.NAME_VENDOR',$name_vendor],
                ['STOCK_HISTORY.ID_STOCK_TYPE',8]
            ];
            
            $stockdefect = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
    
            $params['contents']['stocklist'] = array_merge($stockexpired, $stockdefect);
    
            $params_table = 'PRODUCT';
            $params_columns = [
                'NAME_PRODUCT'
            ];
            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT', $id_product]
            ];
            $getnameproduct = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);
            
            $name_product = $getnameproduct[0]['NAME_PRODUCT'];
    
            $params['contents']['contenttitle'] = array(
                "ID_PRODUCT" => $id_product,
                "TYPE_PRODUCT" => $type_product,
                "NAME_PRODUCT" => $name_product
            );
    
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
    
            $params_table = 'USER';
            $params_columns = [
                'ID_USER',
                'NAME_USER'
            ];
            $params_conditions = [
                ['STATUS_USER', 'ACTIVE']
            ];
            $params['contents']['userslist'] = $this->User_Model->getUserByColumn($params_table, $params_columns, $params_conditions);
    
            $params_table = 'STOCK';
            $params_columns = [
                'STOCK.STOCK_PRODUCT'
            ];
            $params_conditions = [
                ['STOCK.TYPE_PRODUCT',$type_product],
                ['STOCK.ID_PRODUCT',$id_product],
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];
            $params_join = [
                ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
            ];
    
            $remainingstock = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            $params['contents']['remainingstock'] = $remainingstock[0]['STOCK_PRODUCT'];
            
            $params['contents']['name_vendor'] = $name_vendor;
    
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
    
            $this->load->view('stock/stock_template', $params);
        }
    }

    public function stockRepackAddHandler()
    {
        $id = ($this->input->post('stock_repack_id') != null ? $this->input->post('stock_repack_id') : 'kosong');
        // $type = ($this->input->post('type') != null ? $this->input->post('type') : null);
        $type = explode("-", $id)[0];
        $id = explode("-", $id)[1];
        
        $idrepack = ($this->input->post('stock_repack_idrepack') != null ? $this->input->post('stock_repack_idrepack') : 'kosong');
        $idrepack = explode("-", $idrepack)[0];
        $typerepack = ($this->input->post('stock_repack_typerepack') != null ? $this->input->post('stock_repack_typerepack') : null);
        
        $name = ($this->input->post('stock_repack_name') != null ? $this->input->post('stock_repack_name') : null);
        $namerepack = ($this->input->post('stock_repack_namerepack') != null ? $this->input->post('stock_repack_namerepack') : null);

        $amount = ($this->input->post('stock_repack_amount') != null ? $this->input->post('stock_repack_amount') : null);
        $amountrepack = ($this->input->post('stock_repack_amountrepack') != null ? $this->input->post('stock_repack_amountrepack') : null);

        $sendervendor = ($this->input->post('stock_repack_sendervendor') != null ? $this->input->post('stock_repack_sendervendor') : null);
        $sendervendorname = explode('-', $sendervendor)[1];
        $sendervendor = explode('-', $sendervendor)[0];
        $senderuser = ($this->input->post('stock_repack_senderuser') != null ? $this->input->post('stock_repack_senderuser') : null);
        $receivervendor = ($this->input->post('stock_repack_sendervendor') != null ? $this->input->post('stock_repack_sendervendor') : null);
        $receivervendorname = explode('-', $receivervendor)[1];
        $receivervendor = explode('-', $receivervendor)[0];
        $receiveruser = ($this->input->post('stock_repack_senderuser') != null ? $this->input->post('stock_repack_senderuser') : null);

        $descriptionrepack = ($this->input->post('stock_repack_description') != null ? $this->input->post('stock_repack_description') : '');

        $entrydate = ($this->input->post('stock_repack_entrydate') != null ? $this->input->post('stock_repack_entrydate') : null);
        $entrydateDBFormatted = date('Y/m/d', strtotime($entrydate));

        // echo 'Ini stock';
        // echo '<br>';
        // echo 'id : '.$id;
        // echo '<br>';
        // echo 'type : '.$type;
        // echo '<br>';
        // echo 'idrepack : '.$idrepack;
        // echo '<br>';
        // echo 'typerepack : '.$typerepack;
        // echo '<br>';
        // echo 'name : '.$name;
        // echo '<br>';
        // echo 'namerepack : '.$namerepack;
        // echo '<br>';
        // echo 'amount : '.$amount;
        // echo '<br>';
        // echo 'amount : '.$amountrepack;
        // echo '<br>';
        // echo 'sendervendor : '.$sendervendor;
        // echo '<br>';
        // echo 'senderuser : '.$senderuser;
        // echo '<br>';
        // echo 'receivervendor : '.$receivervendor;
        // echo '<br>';
        // echo 'receiveruser : '.$receiveruser;
        // echo '<br>';
        // echo 'entrydate : '.$entrydate;

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_VENDOR',$sendervendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_VENDOR',$sendervendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_STOCK_TYPE',3],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$sendervendor],
            ['ID_USER_SENDER',$senderuser],
            ['ID_VENDOR_RECEIVER',$receivervendor],
            ['ID_USER_RECEIVER',$receiveruser],
            ['DESCRIPTION_STOCK_HISTORY', $descriptionrepack],
            ['DATE_STOCK_HISTORY',$entrydateDBFormatted],
            ['LATEST_STOCK_AMOUNT',$lateststock - $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
    

        // ------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------
    
        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerepack],
            ['ID_PRODUCT',$idrepack],
            ['ID_VENDOR',$receivervendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock + $amountrepack],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerepack],
            ['ID_PRODUCT',$idrepack],
            ['ID_VENDOR',$receivervendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$typerepack],
            ['ID_PRODUCT',$idrepack],
            ['ID_STOCK_TYPE',4],
            ['AMOUNT_STOCK',$amountrepack],
            ['ID_VENDOR_SENDER',$sendervendor],
            ['ID_USER_SENDER',$senderuser],
            ['ID_VENDOR_RECEIVER',$receivervendor],
            ['ID_USER_RECEIVER',$receiveruser],
            ['DATE_STOCK_HISTORY',$entrydateDBFormatted],
            ['DESCRIPTION_STOCK_HISTORY', $descriptionrepack],
            ['LATEST_STOCK_AMOUNT',$lateststock + $amountrepack]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);

        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $type . '-' . $id . '-' . $sendervendorname) : $this->errorviewPage('Ada kegagalan ketika menambahkan stock') ;
    }

    public function stockRecycleAddHandler()
    {
        // $type = explode("-", $id)[0];
        // $id = explode("-", $id)[1];
        $idrecycle = ($this->input->post('stock_recycle_id') != null ? $this->input->post('stock_recycle_id') : 'kosong');
        $typerecycle = explode("-", $idrecycle)[0];
        $idrecycle = explode("-", $idrecycle)[1];

        $namerecycle = ($this->input->post('stock_recycle_name') != null ? $this->input->post('stock_recycle_name') : null);

        $amountrecycleinitial = ($this->input->post('stock_recycle_amountinitial') != null ? $this->input->post('stock_recycle_amountinitial') : null);
        $amountrecycleresult = ($this->input->post('stock_recycle_amountresult') != null ? $this->input->post('stock_recycle_amountresult') : null);

        $sendervendorrecycle = ($this->input->post('stock_recycle_sendervendor') != null ? $this->input->post('stock_recycle_sendervendor') : null);
        $sendervendorrecyclename = explode('-', $sendervendorrecycle)[1];
        $sendervendorrecycle = explode('-', $sendervendorrecycle)[0];
        
        $senderuserrecycle = ($this->input->post('stock_recycle_senderuser') != null ? $this->input->post('stock_recycle_senderuser') : null);
        
        $receivervendorrecycle = ($this->input->post('stock_recycle_sendervendor') != null ? $this->input->post('stock_recycle_sendervendor') : null);
        $receivervendorrecyclename = explode('-', $receivervendorrecycle)[1];
        $receivervendorrecycle = explode('-', $receivervendorrecycle)[0];
        
        $receiveruserrecycle = ($this->input->post('stock_recycle_senderuser') != null ? $this->input->post('stock_recycle_senderuser') : null);

        $descriptionrecycle = ($this->input->post('stock_recycle_description') != null ? $this->input->post('stock_recycle_description') : '');

        $entrydaterecycle = ($this->input->post('stock_recycle_entrydate') != null ? $this->input->post('stock_recycle_entrydate') : null);
        $entrydaterecycleDBFormatted = date('Y/m/d', strtotime($entrydaterecycle));

        // echo 'Ini stock';
        // echo '<br>';
        // echo 'id : '.$idrecycle;
        // // echo '<br>';
        // // echo 'type : '.$type;
        // // echo '<br>';
        // // echo 'idrepack : '.$idrepack;
        // // echo '<br>';
        // // echo 'typerepack : '.$typerepack;
        // // echo '<br>';
        // // echo 'name : '.$name;
        // echo '<br>';
        // echo 'namerecycle : '.$namerecycle;
        // echo '<br>';
        // echo 'amountrecycleinitial : '.$amountrecycleinitial;
        // echo '<br>';
        // echo 'amountrecycleresult : '.$amountrecycleresult;
        // echo '<br>';
        // echo 'sendervendorrecycle : '.$sendervendorrecycle;
        // echo '<br>';
        // echo 'senderuserrecycle : '.$senderuserrecycle;
        // echo '<br>';
        // echo 'receivervendorrecycle : '.$receivervendorrecycle;
        // echo '<br>';
        // echo 'receiveruserrecycle : '.$receiveruserrecycle;
        // echo '<br>';
        // echo 'entrydaterecycleDBFormatted : '.$entrydaterecycleDBFormatted;

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_VENDOR',$sendervendorrecycle]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ------------------------------------------------------------------------------------------
    
        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amountrecycleinitial],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_VENDOR',$sendervendorrecycle]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_STOCK_TYPE',5],
            ['AMOUNT_STOCK',$amountrecycleinitial],
            ['ID_VENDOR_SENDER',$sendervendorrecycle],
            ['ID_USER_SENDER',$senderuserrecycle],
            ['ID_VENDOR_RECEIVER',$receivervendorrecycle],
            ['ID_USER_RECEIVER',$receiveruserrecycle],
            ['DESCRIPTION_STOCK_HISTORY', $descriptionrecycle],
            ['DATE_STOCK_HISTORY',$entrydaterecycleDBFormatted],
            ['LATEST_STOCK_AMOUNT',$lateststock - $amountrecycleinitial]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_VENDOR',$receivervendorrecycle]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);


        // ------------------------------------------------------------------------------------------
    
        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock + $amountrecycleresult],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_VENDOR',$receivervendorrecycle]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$typerecycle],
            ['ID_PRODUCT',$idrecycle],
            ['ID_STOCK_TYPE',6],
            ['AMOUNT_STOCK',$amountrecycleresult],
            ['ID_VENDOR_SENDER',$sendervendorrecycle],
            ['ID_USER_SENDER',$senderuserrecycle],
            ['ID_VENDOR_RECEIVER',$receivervendorrecycle],
            ['ID_USER_RECEIVER',$receiveruserrecycle],
            ['DATE_STOCK_HISTORY',$entrydaterecycleDBFormatted],
            ['DESCRIPTION_STOCK_HISTORY', $descriptionrecycle],
            ['LATEST_STOCK_AMOUNT',$lateststock + $amountrecycleresult]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);
        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $typerecycle . '-' . $idrecycle . '-' . $sendervendorrecyclename) : $this->errorviewPage('Ada kegagalan ketika menambahkan stock') ;
    }

    public function stockExpiredAddHandler()
    {
        // $type = explode("-", $id)[0];
        // $id = explode("-", $id)[1];

        $expiredselect = ($this->input->post('stock_expired_expiredselect') != null ? explode('-', $this->input->post('stock_expired_expiredselect'))[0] : 'kosong');

        $id = ($this->input->post('stock_expired_id') != null ? $this->input->post('stock_expired_id') : 'kosong');
        $type = explode("-", $id)[0];
        $id = explode("-", $id)[1];

        $name = ($this->input->post('stock_expired_name') != null ? $this->input->post('stock_expired_name') : null);

        $amount = ($this->input->post('stock_expired_amount') != null ? $this->input->post('stock_expired_amount') : null);
        
        $sendervendor = ($this->input->post('stock_expired_sendervendor') != null ? $this->input->post('stock_expired_sendervendor') : null);
        $sendervendorname = explode('-', $sendervendor)[1];
        $sendervendor = explode('-', $sendervendor)[0];
        
        $senderuser = ($this->input->post('stock_expired_senderuser') != null ? $this->input->post('stock_expired_senderuser') : null);
        
        $receivervendorname = $sendervendorname;
        $receivervendor = $sendervendor;
        
        $receiveruser = $senderuser;

        $description = ($this->input->post('stock_expired_description') != null ? $this->input->post('stock_expired_description') : '');

        $entrydate = ($this->input->post('stock_expired_entrydate') != null ? $this->input->post('stock_expired_entrydate') : null);
        $entrydateDBFormatted = date('Y/m/d', strtotime($entrydate));

        echo 'Ini stock';
        echo '<br>';
        echo 'expiredselect : '.$expiredselect;
        echo '<br>';
        echo 'type : '.$type;
        echo '<br>';
        echo 'id : '.$id;
        
        echo '<br>';
        echo 'name : '.$name;
        echo '<br>';
        echo 'amount : '.$amount;
        
        echo '<br>';
        echo 'sendervendor : '.$sendervendor;
        echo '<br>';
        echo 'senderuser : '.$senderuser;
        echo '<br>';
        echo 'receivervendor : '.$receivervendor;
        echo '<br>';
        echo 'receiveruser : '.$receiveruser;
        echo '<br>';
        echo 'entrydateDBFormatted : '.$entrydateDBFormatted;

        $params_table = 'STOCK';
        $params_columns = [
            'type_product',
            'id_product',
            'id_vendor',
            'stock_product'
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_VENDOR',$sendervendor]
        ];

        $getlateststock = $this->Stock_Model->getStockById($params_table, $params_columns, $params_conditions);
        $lateststock = $getlateststock[0]['STOCK_PRODUCT'];
        // print_r($lateststock);

        // ------------------------------------------------------------------------------------------------

        $params_table = 'STOCK';
        $params_columns = [
            ['STOCK_PRODUCT', $lateststock - $amount],
        ];
        $params_conditions = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_VENDOR',$sendervendor]
        ];

        $result = $this->Stock_Model->updateStock($params_table, $params_columns, $params_conditions);

        // print_r($result);

        // ------------------------------------------------------------------------------------------------

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            ['TYPE_PRODUCT',$type],
            ['ID_PRODUCT',$id],
            ['ID_STOCK_TYPE',$expiredselect],
            ['AMOUNT_STOCK',$amount],
            ['ID_VENDOR_SENDER',$sendervendor],
            ['ID_USER_SENDER',$senderuser],
            ['ID_VENDOR_RECEIVER',$receivervendor],
            ['ID_USER_RECEIVER',$receiveruser],
            ['DESCRIPTION_STOCK_HISTORY', $description],
            ['DATE_STOCK_HISTORY',$entrydateDBFormatted],
            ['LATEST_STOCK_AMOUNT',$lateststock - $amount]
        ];
        $params_conditions = [];

        $result = $this->Stock_Model->insertNewStock($params_table, $params_columns, $params_conditions);

        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $type . '-' . $id . '-' . $sendervendorname) : $this->errorviewPage('Ada kegagalan ketika menambahkan stock expired/rusak') ;
    }

    public function errorviewPage($error_message)
    {
        // echo $error_message;

        $params['header']['headertitle'] = 'Stock';
        $params['header']['stylesheet'] = [
            base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
            base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
            base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
            base_url('assets/dist/css/AdminLTE.min.css'),
            base_url('assets/dist/css/skins/_all-skins.min.css')
        ];

        $params['sidebar']['sidebar_active'] = 'Stock';

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

        $this->load->view('stock/stock_template', $params);
    }

    public function stockRecapitulationView($product_stock)
    {

        $type_product = explode("-", $product_stock)[0];
        $id_product = explode("-", $product_stock)[1];
        $name_vendor = explode("-", $product_stock)[2];

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

        foreach ($therapistvisibility as $uv) {
            if ($name_vendor == $uv['NAME_VENDOR']) {
                $user_visibility = $uv;
                break;
            }
        }

        if ($user_visibility == null) {
            redirect('Stock/');
        } else {

            $params['header']['headertitle'] = 'Rekapitulasi Stok';
            $params['header']['stylesheet'] = [
                base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'),
                base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'),
                base_url('assets/bower_components/Ionicons/css/ionicons.min.css'),
                base_url('assets/bower_components/select2/dist/css/select2.min.css'),
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

            $params['sidebar']['sidebar_active'] = 'Stock';
            $params['content_wrapper'] = 'stock/stock_recapitulation';

            $params_table = 'STOCK';
            $params_columns = [
                'STOCK.STOCK_PRODUCT'
            ];
            $params_conditions = [
                ['STOCK.TYPE_PRODUCT',$type_product],
                ['STOCK.ID_PRODUCT',$id_product],
                ['VENDOR.NAME_VENDOR',$name_vendor]
            ];
            $params_join = [
                ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
            ];
    
            $remainingstock = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
            $params['contents']['remainingstock'] = $remainingstock[0]['STOCK_PRODUCT'];

            $params_table = 'PRODUCT';
            $params_columns = [
                'NAME_PRODUCT'
            ];
            $params_conditions = [
                ['TYPE_PRODUCT', $type_product],
                ['ID_PRODUCT', $id_product]
            ];
            $getnameproduct = $this->Product_Model->getProductById($params_table, $params_columns, $params_conditions);
            
            $name_product = $getnameproduct[0]['NAME_PRODUCT'];

            $params['contents']['contenttitle'] = array(
                "ID_PRODUCT" => $id_product,
                "TYPE_PRODUCT" => $type_product,
                "NAME_PRODUCT" => $name_product
            );

            $params_table = 'STOCK_HISTORY';
            $params_columns = [
                'STOCK_HISTORY.ID_STOCK_HISTORY AS ID_ENTRY',
                'STOCK_HISTORY.TYPE_PRODUCT',
                'STOCK_HISTORY.ID_PRODUCT',
                'STOCK_TYPE.NAME_STOCK_TYPE',
                'PRODUCT.NAME_PRODUCT',
                'STOCK_HISTORY.AMOUNT_STOCK AS AMOUNT',
                'STOCK_HISTORY.LATEST_STOCK_AMOUNT',
                'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                'USER_SENDER.NAME_USER AS USER_SENDER',
                'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                'STOCK_HISTORY.DATE_STOCK_HISTORY AS DATE_ENTRY',
                'STOCK_STATUS.NAME_STOCK_STATUS',
                'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY AS DESCRIPTION'
            ];

            $stocklist = [];

            for ($i=0; $i < 11; $i++) { 
                $j = $i+1;
                if($j == 1 || $j == 3 || $j == 4 || $j == 5 || $j == 6 || $j == 7 || $j == 8){
                    $params_conditions = [
                        ['STOCK_HISTORY.TYPE_PRODUCT', $type_product],
                        ['STOCK_HISTORY.ID_PRODUCT', $id_product],
                        ['VENDOR_RECEIVER.NAME_VENDOR', $name_vendor],
                        ['STOCK_HISTORY.ID_STOCK_TYPE', $j]
                    ];

                    $params_join = [
                        ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                        ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                        ['STOCK_STATUS', 'STOCK_STATUS.ID_STOCK_STATUS = STOCK_HISTORY.ID_STOCK_STATUS'],
                        ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                        ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                        ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                        ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
                    ];
                } else if($j == 2){
                    $params_conditions = [
                        ['STOCK_HISTORY.TYPE_PRODUCT', $type_product],
                        ['STOCK_HISTORY.ID_PRODUCT', $id_product],
                        ['VENDOR_SENDER.NAME_VENDOR', $name_vendor],
                        ['STOCK_HISTORY.ID_STOCK_TYPE', $j]
                    ];

                    $params_join = [
                        ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                        ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                        ['STOCK_STATUS', 'STOCK_STATUS.ID_STOCK_STATUS = STOCK_HISTORY.ID_STOCK_STATUS'],
                        ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                        ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                        ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                        ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']

                    ];
                } 
                else if($j == 9 || $j == 10 || $j == 11){
                    // $params_columns = array_push($params_columns, 'TRANSACTION.ID_USER','TRANSACTION.ID_VENDOR');

                    $params_columns = [
                        'STOCK_HISTORY.ID_STOCK_HISTORY AS ID_ENTRY',
                        'STOCK_HISTORY.TYPE_PRODUCT',
                        'STOCK_HISTORY.ID_PRODUCT',
                        'STOCK_TYPE.NAME_STOCK_TYPE',
                        'PRODUCT.NAME_PRODUCT',
                        'STOCK_HISTORY.AMOUNT_STOCK AS AMOUNT',
                        'STOCK_HISTORY.LATEST_STOCK_AMOUNT',
                        'VENDOR_SENDER.NAME_VENDOR AS VENDOR_SENDER',
                        'VENDOR_RECEIVER.NAME_VENDOR AS VENDOR_RECEIVER',
                        'VENDOR_SENDER.TYPE_VENDOR AS VENDOR_SENDER_TYPE',
                        'USER_SENDER.NAME_USER AS USER_SENDER',
                        'USER_RECEIVER.NAME_USER AS USER_RECEIVER',
                        'VENDOR_RECEIVER.TYPE_VENDOR AS VENDOR_RECEIVER_TYPE',
                        'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY',
                        'STOCK_HISTORY.DATE_STOCK_HISTORY AS DATE_ENTRY',
                        'STOCK_STATUS.NAME_STOCK_STATUS',
                        'STOCK_HISTORY.DESCRIPTION_STOCK_HISTORY AS DESCRIPTION', 
                        'TRANSACTION.ID_USER',
                        'CUSTOMER.NAME_CUSTOMER',
                        'CUSTOMER.ADDRESS_CUSTOMER',
                        'TRANSACTION.ID_VENDOR'
                    ];

                    $params_conditions = [
                        ['STOCK_HISTORY.TYPE_PRODUCT', $type_product],
                        ['STOCK_HISTORY.ID_PRODUCT', $id_product],
                        ['VENDOR_SENDER.NAME_VENDOR', $name_vendor],
                        ['STOCK_HISTORY.ID_STOCK_TYPE', $j]
                    ];

                    $params_join = [
                        ['PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK_HISTORY.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK_HISTORY.TYPE_PRODUCT'],
                        ['TRANSACTION_PRODUCT', 'STOCK_HISTORY.ID_STOCK_HISTORY = TRANSACTION_PRODUCT.ID_STOCK_HISTORY'],
                        ['TRANSACTION', 'TRANSACTION.ID_TRANSACTION = TRANSACTION_PRODUCT.ID_TRANSACTION'],
                        ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                        ['STOCK_TYPE', 'STOCK_TYPE.ID_STOCK_TYPE = STOCK_HISTORY.ID_STOCK_TYPE'],
                        ['STOCK_STATUS', 'STOCK_STATUS.ID_STOCK_STATUS = STOCK_HISTORY.ID_STOCK_STATUS'],
                        ['VENDOR AS VENDOR_SENDER', 'VENDOR_SENDER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_SENDER'],
                        ['VENDOR AS VENDOR_RECEIVER', 'VENDOR_RECEIVER.ID_VENDOR = STOCK_HISTORY.ID_VENDOR_RECEIVER'],
                        ['USER AS USER_SENDER', 'USER_SENDER.ID_USER = STOCK_HISTORY.ID_USER_SENDER'],
                        ['USER AS USER_RECEIVER', 'USER_RECEIVER.ID_USER = STOCK_HISTORY.ID_USER_RECEIVER']
                    ];

                }
                // $stocklist[$i] = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
                $result = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
                $stocklist = array_merge($stocklist, $result);
            }

            $params_table = 'TRANSACTION';
            $params_columns = [
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
                    'STOCK_HISTORY.LATEST_STOCK_AMOUNT',
                    'TRANSACTION_PRODUCT.TOTAL_PRICE',
                    'VENDOR.NAME_VENDOR',
                    'TRANSACTION_PRODUCT.DESCRIPTION_TRANSACTION_PRODUCT AS DESCRIPTION'
                ];
            $params_conditions = [
                    ['PRODUCT.TYPE_PRODUCT', $type_product],
                    ['PRODUCT.ID_PRODUCT', $id_product],
                    ['VENDOR.NAME_VENDOR', $name_vendor]
    
                ];
    
            $params_join = [
                    ['TRANSACTION_PRODUCT', 'TRANSACTION_PRODUCT.ID_TRANSACTION = TRANSACTION.ID_TRANSACTION'],
                    ['STOCK_HISTORY', 'STOCK_HISTORY.ID_STOCK_HISTORY = TRANSACTION_PRODUCT.ID_STOCK_HISTORY'],
                    ['CUSTOMER', 'CUSTOMER.ID_CUSTOMER = TRANSACTION.ID_CUSTOMER'],
                    ['USER', 'USER.ID_USER = TRANSACTION.ID_USER'],
                    ['VENDOR', 'VENDOR.ID_VENDOR = TRANSACTION.ID_VENDOR'],
                    ['PRODUCT', 'PRODUCT.TYPE_PRODUCT = TRANSACTION_PRODUCT.TYPE_PRODUCT AND PRODUCT.ID_PRODUCT = TRANSACTION_PRODUCT.ID_PRODUCT']
                ];
            $transactionlist = $this->Transaction_Model->getTransactionByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

            // $params['contents']['stocklist'] = array_merge($stocklist, $transactionlist);
            $params['contents']['stocklist'] = array_merge($stocklist);
            $params['contents']['therapistvisibility'] = $therapistvisibility;

            $params['contents']['name_vendor'] = $name_vendor;
            
            $params['footer']['scriptsrc'] = [
                base_url('assets/bower_components/jquery/dist/jquery.min.js'),
                base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'),
                base_url('assets/bower_components/select2/dist/js/select2.full.min.js'),
                base_url('assets/plugins/input-mask/jquery.inputmask.js'),
                base_url('assets/plugins/input-mask/jquery.inputmask.date.extensions.js'),
                base_url('assets/plugins/input-mask/jquery.inputmask.extensions.js'),
                base_url('assets/bower_components/moment/min/moment.min.js'),
                base_url('assets/bower_components/select2/dist/js/select2.full.min.js'),
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

            
            // echo "<pre>";
            // print_r ($transactionlist);
            // echo "</pre>";
            
    
            $this->load->view('stock/stock_template', $params);
    
        }

    }

    public function stockRecapitulationTransactionProductAddHandler()
    {

        // ------------------------------------------------------------------------------------------------------------------------------------------------

        $customer = ($this->input->post('stock_transactionproduct_customer') != null ? $this->input->post('stock_transactionproduct_customer') : 'kosoong');
        $therapistid = ($this->input->post('stock_transactionproduct_therapistid') != null ? $this->input->post('stock_transactionproduct_therapistid') : 'kosoong');
        $vendor = ($this->input->post('stock_transactionproduct_vendor') != null ? $this->input->post('stock_transactionproduct_vendor') : 'kosoong');
        $vendorid = explode("-", $vendor)[0];
        $vendorname = explode("-", $vendor)[1];
        $transactiondate = ($this->input->post('stock_transactionproduct_transactiondate') != null ? $this->input->post('stock_transactionproduct_transactiondate') : 'kosoong');
        $transactiondateDBFormatted = date('Y/m/d', strtotime($transactiondate));

        // echo '------------------------------------------------------------------------------------------------------------------------------------------------';
        // echo '<br>';
        // echo 'Transaction';
        // echo '<br>';
        // echo $customer;
        // echo '<br>';
        // echo $therapistid;
        // echo '<br>';
        // echo $vendorid;
        // echo '<br>';
        // echo $transactiondateDBFormatted;
        // echo '<br>';

        $params_table = 'TRANSACTION';
        $params_columns = [
            ['DATE_TRANSACTION',$transactiondateDBFormatted],
            ['ID_USER',$therapistid],
            ['ID_CUSTOMER',$customer],
            ['ID_VENDOR',$vendorid]
        ];
        $params_conditions = [];

        $result = $this->Transaction_Model->insertNewTransaction($params_table, $params_columns, $params_conditions);

        // ------------------------------------------------------------------------------------------------------------------------------------------------
    
        $idtransaction = $result;
        $idvendor = $vendorid;
        $idtherapist = $therapistid;
        $product = ($this->input->post('stock_transactionproduct_productid') != null ? $this->input->post('stock_transactionproduct_productid') : 'kosoong');
        $typeproduct = explode("-", $product)[0];
        $idproduct = explode("-", $product)[1];        
        
        $nameproduct = ($this->input->post('stock_transactionproduct_productname') != null ? $this->input->post('stock_transactionproduct_productname') : 'kosoong');
        $amount = ($this->input->post('stock_transactionproduct_amount') != null ? $this->input->post('stock_transactionproduct_amount') : 'kosoong');
        $discount = ($this->input->post('stock_transactionproduct_discount') != null ? $this->input->post('stock_transactionproduct_discount') : 'kosoong');
        $sellprice = ($this->input->post('stock_transactionproduct_sellprice') != null ? $this->input->post('stock_transactionproduct_sellprice') : 'kosoong');
        $sellpriceDBFormatted = '';
        $sellpriceExplode = explode(".", $sellprice);
        foreach ($sellpriceExplode as $row) {
            $sellpriceDBFormatted = $sellpriceDBFormatted . $row;
        }


        $discountprice = ($this->input->post('stock_transactionproduct_discountprice') != null ? $this->input->post('stock_transactionproduct_discountprice') : 'kosoong');
        $discountpriceDBFormatted = '';
        $discountpriceExplode = explode(".", $discountprice);
        foreach ($discountpriceExplode as $row) {
            $discountpriceDBFormatted = $discountpriceDBFormatted . $row;
        }

        $transactionproductdate = ($this->input->post('stock_transactionproduct_transactiondate') != null ? $this->input->post('stock_transactionproduct_transactiondate') : 'kosoong');
        $transactionproductdateDBFormatted = date('Y/m/d', strtotime($transactionproductdate));

        // echo '------------------------------------------------------------------------------------------------------------------------------------------------';
        // echo '<br>';
        // echo 'Transaction Detail';
        // echo '<br>';
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

        $result > 0 ? redirect('Stock/stockRecapitulationView/' . $typeproduct . '-' . $idproduct . '-' . $vendorname) : $this->errorviewPage('Ada kegagalan ketika menambahkan transaksi baru');
    
    }

    // ------------------------------------------------------------------------------------------------------------------------

    public function vendorListRequest()
    {
        $params_table = 'VENDOR';
        $params_columns = [
            'ID_VENDOR',
            'NAME_VENDOR',
            'TYPE_VENDOR'
        ];
        $params_conditions = [];
        $result = $this->Vendor_Model->getVendorByColumn($params_table, $params_columns, $params_conditions);
        print_r(json_encode($result));
    }

    public function userVisibilityRequest()
    {
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
        $result = $this->User_Model->getUserByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        print_r(json_encode($result));
    }

    public function productRemainingStockRequest()
    {
        $type_product = ($this->input->post('type_product') != null ? $this->input->post('type_product') : 'kosoong');
        $id_product = ($this->input->post('id_product') != null ? $this->input->post('id_product') : 'kosoong');
        $name_vendor = ($this->input->post('name_vendor') != null ? $this->input->post('name_vendor') : 'kosoong');

        $params_table = 'STOCK';
        $params_columns = [
            'PRODUCT.TYPE_PRODUCT',
            'PRODUCT.ID_PRODUCT',
            'PRODUCT.NAME_PRODUCT',
            'PRODUCT.CAPITAL_PRICE_PRODUCT',
            'PRODUCT.SELL_PRICE_PRODUCT',
            'STOCK.STOCK_PRODUCT'
        ];
        $params_conditions = [
            ['STOCK.TYPE_PRODUCT',$type_product],
            ['STOCK.ID_PRODUCT',$id_product],
            ['VENDOR.NAME_VENDOR',$name_vendor]
        ];
        $params_join = [
            ['PRODUCT AS PRODUCT', 'PRODUCT.ID_PRODUCT = STOCK.ID_PRODUCT AND PRODUCT.TYPE_PRODUCT = STOCK.TYPE_PRODUCT'],
            ['VENDOR AS VENDOR', 'VENDOR.ID_VENDOR = STOCK.ID_VENDOR']
        ];

        $result = $this->Stock_Model->getStockByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);
        
        print_r(json_encode($result));
    }

    public function stockHistoryCurrentMonthListRequest()
    {

        $params_table = 'STOCK_HISTORY';
        $params_columns = [
            'STOCK_HISTORY.ID_STOCK_HISTORY AS ID_ENTRY'
        ];
        $params_conditions = [

        ];
        $params_join = [

        ];

        $result = $this->Stock_Model->getStockByColumn($params_table, $params_columns, $params_conditions);
        
        print_r(json_encode($result));
    }
    
}