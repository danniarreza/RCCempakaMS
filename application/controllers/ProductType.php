<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductType extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('ProductType_Model');
        $this->load->model('Product_Model');

        if ($this->session->has_userdata('logged_in') == FALSE) {
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
        $this->producttypeHomeView(0);
        // $this->producttypeEditView(1);
    }

    public function producttypeHomeView()
    {       
        $params['header']['headertitle'] = 'Jenis Produk';
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

        $params['sidebar']['sidebar_active'] = 'Product_Type';

        $params['content_wrapper'] = 'producttype/producttype_home';

        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            'ID_PRODUCT_TYPE',
            'NAME_PRODUCT_TYPE',
            'DESCRIPTION_PRODUCT_TYPE',
            'STATUS_PRODUCT_TYPE',
        ];
        $params_conditions = [
            ['STATUS_PRODUCT_TYPE','ACTIVE']
        ];
        $params['contents']['producttypeslist'] = $this->ProductType_Model->getProductTypeByColumn($params_table, $params_columns, $params_conditions);

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

        $this->load->view('producttype/producttype_template', $params);
    }


    public function producttypeEditView($id_product_type)
    {
        $params['header']['headertitle'] = 'Edit Jenis Produk';
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

        $params['sidebar']['sidebar_active'] = 'Product_Type';

        $params['content_wrapper'] = 'producttype/producttype_edit';
        $params['contents']['producttypeslist'] = $this->ProductType_Model->getProductTypeById('product_type', ['id_product_type','name_product_type', 'description_product_type', 'status_product_type'], [['ID_PRODUCT_TYPE',$id_product_type]]);

        $params_table = 'PRODUCT';
        $params_columns = [
            'TYPE_PRODUCT',
            'ID_PRODUCT',
            'NAME_PRODUCT',
            'NAME_PRODUCT_TYPE',
            'SELL_PRICE_PRODUCT',
        ];
        $params_conditions = [
            ['STATUS_PRODUCT','ACTIVE'],
            ['TYPE_PRODUCT', $id_product_type]
        ];
        $params_join = [
            ['PRODUCT_TYPE', 'PRODUCT.TYPE_PRODUCT', 'PRODUCT_TYPE.ID_PRODUCT_TYPE'],
        ];
        $params['contents']['productslist'] = $this->Product_Model->getProductByColumnJoin($params_table, $params_columns, $params_conditions, $params_join);

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

        $this->load->view('producttype/producttype_template', $params);
    }

    public function producttypeAddHandler()
    {
        $id = ($this->input->post('id') != null ? $this->input->post('id') : null);
        $name = ($this->input->post('name') != null ? $this->input->post('name') : null);
        $description = ($this->input->post('description') != null ? $this->input->post('description') : null);
        
        // echo $id;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $description;

        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            ['ID_PRODUCT_TYPE',$id],
            ['NAME_PRODUCT_TYPE',$name],
            ['DESCRIPTION_PRODUCT_TYPE',$description]
        ];
        $params_conditions = null;

        $result = $this->ProductType_Model->insertNewProductType($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('ProductType') : $this->errorviewPage('Ada kegagalan ketika menambahkan jenis produk') ;

    }

    public function producttypeEditHandler($id_product_type)
    {
        $id = ($this->input->post('id') != null ? $this->input->post('id') : null);
        $name = ($this->input->post('name') != null ? $this->input->post('name') : null);
        $description = ($this->input->post('description') != null ? $this->input->post('description') : null);
        $status = ($this->input->post('status') != null ? $this->input->post('status') : null);
        
        // echo $id;
        // echo '<br>';
        // echo $name;
        // echo '<br>';
        // echo $description;
        // echo '<br>';
        // echo $status;


        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            ['ID_PRODUCT_TYPE',$id],
            ['NAME_PRODUCT_TYPE',$name],
            ['DESCRIPTION_PRODUCT_TYPE',$description],
            ['STATUS_PRODUCT_TYPE',$status]
        ];
        $params_conditions = [
            ['ID_PRODUCT_TYPE', $id_product_type]
        ];

        $result = $this->ProductType_Model->updateProductType($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('ProductType') : $this->errorviewPage('Ada kegagalan ketika memperbarui jenis produk') ;

    }

    public function producttypeArchiveHandler($id_product_type)
    {
        // echo $id_product_type;

        $params_table = 'PRODUCT_TYPE';
        $params_columns = [
            ['STATUS_PRODUCT_TYPE','ARCHIVE'],
        ];
        $params_conditions = [
            ['ID_PRODUCT_TYPE',$id_product_type]
        ];

        $result = $this->ProductType_Model->updateProductType($params_table, $params_columns, $params_conditions);
        $result == 1 ? redirect('ProductType') : $this->errorviewPage('Ada kegagalan ketika mengarsip jenis produk') ;

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
}