<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-paper"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">History Stock</span>
                        <span class="info-box-text"><?php setlocale(LC_TIME, "id_ID"); echo strftime("%B %Y");?></span>
                        <span class="info-box-number" id="historystockbannerlabel"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-user-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pelanggan Baru</span>
                        <span class="info-box-text"><?php setlocale(LC_TIME, "id_ID"); echo strftime("%B %Y");?></span>
                        <span class="info-box-number" id="newcustomerbannerlabel">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Transaksi Produk</span>
                        <span class="info-box-text"><?php setlocale(LC_TIME, "id_ID"); echo strftime("%B %Y");?></span>
                        <span class="info-box-number" id="transactionproductbannerlabel">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Transaksi Perawatan</span>
                        <span class="info-box-text"><?php setlocale(LC_TIME, "id_ID"); echo strftime("%B %Y");?></span>
                        <span class="info-box-number" id="transactiontreatmentbannerlabel">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rekap Transaksi Bulanan</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>

                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="text-center">
                                    <strong>Periode:
                                        <?php echo '1 January ' . strftime("%Y") . ' - 31 December ' . strftime("%Y");?></strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <p class="text-center">
                                    <strong>Keterangan</strong>
                                </p>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Transaksi Produk</span>
                                    <!-- <span class="progress-number"><b>480</b>/800</span> -->

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Transaksi Perawatan</span>
                                    <!-- <span class="progress-number"><b>250</b>/500</span> -->

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow" style="width: 100%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="description-block border-right">
                                    <!-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>17%</span> -->
                                    <h5 class="description-header" id="totaltransactionproductlabel">Rp 0,00</h5>
                                    <span class="description-text">TOTAL TRANSAKSI PRODUK</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="description-block border-right">
                                    <!-- <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i>0%</span> -->
                                    <h5 class="description-header" id="totaltransactiontreatmentlabel">Rp 0,00</h5>
                                    <span class="description-text">TOTAL TRANSAKSI PERAWATAN</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="description-block border-right">
                                    <!-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i>20%</span> -->
                                    <h5 class="description-header" id="totaltransactionalllabel">Rp 0,00</h5>
                                    <span class="description-text">TOTAL TRANSAKSI TAHUN
                                        <?php setlocale(LC_TIME, "id_ID"); echo strftime("%Y");?></span>
                                </div>
                                <!-- /.description-block -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">

                <!-- TABLE: LATEST TRANSACTION PRODUCT -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaksi Produk Hari Ini</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin" id="todaytransactionproducttable">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Therapist</th>
                                        <th>Toko</th>
                                        <th>Jumlah Transaksi</th>

                                    </tr>
                                </thead>
                                <tbody id="todaytransactionproducttablebody">
                                    <tr style="text-align:center">
                                        <td valign="top" colspan="6" class="dataTables_empty">
                                            <i class="fa fa-spin fa-refresh">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Therapist</th>
                                        <th>Toko</th>
                                        <th>Jumlah Transaksi</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">


                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Distribusi Transaksi Produk</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="150"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix" id="piechartvendorlegend">
                                    <!-- <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                                    <li><i class="fa fa-circle-o text-green"></i> IE</li>
                                    <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                                    <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                                    <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                                    <li><i class="fa fa-circle-o text-gray"></i> Navigator</li> -->
                                </ul>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-3" style="text-align:center; margin-top:7px">
                                        Bulan
                                    </div>
                                    <div class="col-md-1 col-sm-1 col-xs-1" style="text-align:center; margin-top:7px">
                                        :
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <select onchange="getVendorDistributionRedraw()" class="form-control"
                                            name="vendorDistributionMonth" id="vendorDistributionMonth"
                                            style="width: 100%">
                                            <option value="00" selected>Semua</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>

                                        </select>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /.box -->

                <!-- PRODUCT LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Produk Baru Ditambah/Diupdate</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box" style="text-align:center" id="latestproductlist">

                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="javascript:void(0)" class="uppercase">View All Products</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
var currentYearTransactions = [];

function dashboardInitialization() {
    getCurrentMonthStockHistory();
    getCurrentMonthNewCustomer();
    getCurrentMonthTransactionProduct();
    getCurrentMonthTransactionTreatment();

    currentYearSalesChartInitialize();
    currentDateTransactionProductInitialize();

    latestProductListInitialize();
}

function getVendorDistributionInitialize(transactions) {
    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Vendor/VendorListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is getVendorDistributionInitialize');
        var vendors = JSON.parse(this.responseText);
        console.log(vendors);

        transactions.forEach(transaction => {

            if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION == undefined) {
                vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = 0;
            }

            if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION != undefined) {
                if (transaction.TOTAL_TRANSACTION != null) {
                    vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                        1].TOTAL_TRANSACTION + parseInt(transaction.TOTAL_TRANSACTION);
                } else {
                    vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                        1].TOTAL_TRANSACTION + 0;
                }
            }
        });

        vendors.forEach(vendor => {
            if (vendor.TOTAL_TRANSACTION == undefined) {
                vendor.TOTAL_TRANSACTION = 0;
            }
        });

        var str = "";
        var piechartvendorlegend = document.getElementById('piechartvendorlegend');

        var colorsArray = [{
                color: 'red',
                hex: '#dd4b39'
            },
            {
                color: 'green',
                hex: '#00a65a'
            },
            {
                color: 'yellow',
                hex: '#f39c12'
            },
            {
                color: 'aqua',
                hex: '#00c0ef'
            },
            {
                color: 'light-blue',
                hex: '#3c8dbc'
            },
            {
                color: 'gray',
                hex: '#d2d6de'
            }
        ];

        var PieData = [];

        if (vendors.length > 0) {
            for (let index = 0; index < vendors.length; index++) {
                str += "<li><i class='fa fa-circle-o text-" + colorsArray[index].color + "'></i> " + vendors[index]
                    .NAME_VENDOR + "</li>";

                PieData[index] = {
                    value: vendors[index].TOTAL_TRANSACTION,
                    color: colorsArray[index].hex,
                    highlight: colorsArray[index].hex,
                    label: vendors[index].NAME_VENDOR
                }

            }
        } else if (vendors.length == 0) {
            // str += "<tr style='text-align:center'>"
            // str += "<td valign='top' colspan='6'>Belum ada produk terbaru</td>"
            // str += "</tr>"
        }
        piechartvendorlegend.innerHTML = str;
        // console.log('Ini PieData');
        // console.log(PieData);

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);

        var pieOptions = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            // String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps: 100,
            // String - Animation easing effect
            animationEasing: 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            // String - A legend template
            legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
            // String - A tooltip template
            tooltipTemplate: function(label) {
                return 'Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            onAnimationComplete: function() {
                this.showTooltip(this.segments, true);

                //Show tooltips in bar chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                //this.showTooltip(this.datasets[0].bars, true);

                //Show tooltips in line chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                //this.showTooltip(this.datasets[0].points, true);  
            },

            tooltipEvents: [],

            showTooltips: true
        };
        // Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);


    };
    xhr.send(data);
}

function latestProductListInitialize() {
    document.getElementById('latestproductlist').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Product/latestProductListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is latestProductListInitialize');
        var items = JSON.parse(this.responseText);
        console.log(items);

        var str = "";
        var latestproductlist = document.getElementById('latestproductlist');

        if (items.length > 0) {
            for (var item of items) {

                var link = '<?php echo site_url('Product/productEditView/');?>';

                str += "<li class='item'>"

                str += "<a href='javascript:void(0)' class='product-title'>" + item.TYPE_PRODUCT + "-" + item
                    .ID_PRODUCT + "<span class='label label-warning pull-right'>Rp " + number_format(item
                        .SELL_PRICE_PRODUCT, 0, ',', '.') + ",00</span></a>"
                str += "<span class='product-description'>" + item.NAME_PRODUCT + "</span>"

                if (item.IS_UPDATED_PRODUCT == 0) {
                    str += "<span class='product-description'>Dibuat Tanggal : " + item.DATE_ADDED_PRODUCT +
                        " oleh " + item.NAME_USER_ADDED + "</span>"
                } else if (item.IS_UPDATED_PRODUCT == 1) {
                    str += "<span class='product-description'>Diupdate Tanggal : " + item.DATE_UPDATED_PRODUCT +
                        " oleh " + item.NAME_USER_UPDATED + "</span>"
                }

                str += "</li>"

            }
        } else if (items.length == 0) {
            str += "<tr style='text-align:center'>"
            str += "<td valign='top' colspan='6'>Belum ada produk terbaru</td>"
            str += "</tr>"
        }
        latestproductlist.removeAttribute('style');
        latestproductlist.innerHTML = str;


    };
    xhr.send(data);
}

function currentDateTransactionProductInitialize() {
    // document.getElementById('transactionproductbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';
    // document.getElementById('transactiontreatmentbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('TransactionProduct/transactionProductCurrentDateListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is currentDateTransactionProductInitialize');
        var items = JSON.parse(this.responseText);
        console.log(items);

        var str = "";
        var todaytransactionproducttablebody = document.getElementById('todaytransactionproducttablebody');

        if (items.length > 0) {
            for (var item of items) {

                var link = '<?php echo site_url('TransactionProduct/transactionDetailView/');?>';

                str += "<tr>"

                str += "<td><a href='" + link + item.ID_TRANSACTION + "'>" + item.ID_TRANSACTION + "</a></td>"
                str += "<td>" + item.DATE_TRANSACTION + "</td>"
                str += "<td>" + item.NAME_CUSTOMER + "</td>"
                str += "<td>" + item.NAME_USER + "</td>"
                str += "<td>" + item.NAME_VENDOR + "</td>"
                str += "<td>Rp " + number_format(item.TOTAL_TRANSACTION, 0, ',', '.') + "</td>"

                str += "</tr>"

            }
        } else if (items.length == 0) {
            str += "<tr style='text-align:center'>"
            str += "<td valign='top' colspan='6'>Belum ada transaksi yang tercatat hari ini</td>"
            str += "</tr>"
        }
        todaytransactionproducttablebody.innerHTML = str;
        // senderuser_list_request();

        // document.getElementById('transactionproductbannerlabel').innerHTML = response.length;
        // document.getElementById('transactiontreatmentbannerlabel').innerHTML = 'N/A';

    };
    xhr.send(data);
}

function getCurrentMonthStockHistory() {

    document.getElementById('historystockbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Stock/stockHistoryCurrentMonthListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is getCurrentMonthStockHistory');
        var response = JSON.parse(this.responseText);
        console.log(response);

        document.getElementById('historystockbannerlabel').innerHTML = response.length;

    };
    xhr.send(data);

}

function getCurrentMonthNewCustomer() {
    document.getElementById('newcustomerbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Customer/customerCurrentMonthListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is getCurrentMonthNewCustomer');
        var response = JSON.parse(this.responseText);
        console.log(response);

        document.getElementById('newcustomerbannerlabel').innerHTML = response.length;

    };
    xhr.send(data);
}

function getCurrentMonthTransactionProduct() {
    document.getElementById('transactionproductbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';
    document.getElementById('transactiontreatmentbannerlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('TransactionProduct/transactionProductCurrentMonthListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is getCurrentMonthTransactionProduct');
        var response = JSON.parse(this.responseText);
        console.log(response);

        document.getElementById('transactionproductbannerlabel').innerHTML = response.length;
        document.getElementById('transactiontreatmentbannerlabel').innerHTML = 'N/A';

    };
    xhr.send(data);
}

function getCurrentMonthTransactionTreatment() {

}

function currentYearSalesChartInitialize() {

    document.getElementById('totaltransactionproductlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';
    document.getElementById('totaltransactiontreatmentlabel').innerHTML = '<i class="fa fa-spin fa-refresh">';
    document.getElementById('totaltransactionalllabel').innerHTML = '<i class="fa fa-spin fa-refresh">';

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('TransactionProduct/transactionProductCurrentYearListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is currentYearSalesChartInitialize');
        var transactions = JSON.parse(this.responseText);
        console.log(transactions);

        var monthlySales = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var totaltransactionproduct = 0;
        var totaltransactiontreatment = 0;
        var totaltransactionall = 0;

        transactions.forEach(transaction => {
            var month = transaction.DATE_TRANSACTION.split("-")[1];

            month = month.replace('0', '');

            if (transaction.TOTAL_TRANSACTION != null) {
                monthlySales[month - 1] = monthlySales[month - 1] + parseInt(transaction.TOTAL_TRANSACTION);
                totaltransactionproduct = totaltransactionproduct + parseInt(transaction.TOTAL_TRANSACTION);
            } else {
                monthlySales[month - 1] = monthlySales[month - 1] + 0;
                totaltransactionproduct = totaltransactionproduct + 0;
            }

        });

        totaltransactionall = number_format(totaltransactionproduct + totaltransactiontreatment, 0, ',', '.');
        totaltransactionproduct = number_format(totaltransactionproduct, 0, ',', '.');
        totaltransactiontreatment = number_format(totaltransactiontreatment, 0, ',', '.');

        getVendorDistributionInitialize(transactions);

        // console.log(monthlySales);
        window.currentYearTransactions = transactions;
        currentYearSalesChartDraw(monthlySales);
        document.getElementById('totaltransactionproductlabel').innerHTML = 'Rp ' + totaltransactionproduct + ',00';
        // document.getElementById('totaltransactiontreatmentlabel').innerHTML = 'Rp ' + totaltransactiontreatment +
        //     ',00';
        document.getElementById('totaltransactiontreatmentlabel').innerHTML = 'N/A';
        document.getElementById('totaltransactionalllabel').innerHTML = 'Rp ' + totaltransactionall +
            ',00';

    };
    xhr.send(data);


}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function currentYearSalesChartDraw(data) {
    $(function() {
            // Get context with jQuery - using jQuery's .get() method.
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas);

            var salesChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October',
                    'November', 'December'
                ],
                display: true,
                datasets: [{
                    label: 'Transaksi Perawatan',
                    fillColor: '#f39c12',
                    strokeColor: '#f39c12',
                    pointColor: '#f39c12',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: '#f39c12',
                    data: ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0']
                }, {
                    label: 'Transaksi Produk',
                    fillColor: '#00a65a',
                    strokeColor: '#00a65a',
                    pointColor: '#00a65a',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: '#00a65a',
                    data: data
                }]
            };

            var salesChartOptions = {
                // Boolean - If we should show the scale at all
                showScale: true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                // String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth: 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                // Boolean - Whether the line is curved between points
                bezierCurve: true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension: 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot: false,
                // Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                // String - A legend template
                legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                        maintainAspectRatio     : true,
                        // Boolean - whether to make the chart responsive to window resizing
                        responsive              : true,
                        // Function - to set the scale label
                        scaleLabel:
                            function(label){
                                return  'Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            },
                        tooltipFontSize: 14,
                        multiTooltipTemplate: 
                            function(label) {
                                return 'Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            },
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontColor: "#000080",
                            }
                        },
                        
                        
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
});
}

function currentYearSalesChartModifier() {
    $(function() {
                // Get context with jQuery - using jQuery's .get() method.
                var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
                // This will get the first returned node in the jQuery collection.
                var salesChart = new Chart(salesChartCanvas);

                var salesChartData = {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October',
                        'November', 'December'
                    ],
                    datasets: [{
                            label: 'Electronics',
                            fillColor: 'rgb(210, 214, 222)',
                            strokeColor: 'rgb(210, 214, 222)',
                            pointColor: 'rgb(210, 214, 222)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgb(220,220,220)',
                            data: [65000, 59000, 80000, 81000, 56000, 55000, 40000, 80000, 81000, 56000, 55000,
                                40000
                            ]
                        },
                        {
                            label: 'Digital Goods',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: [28000, 48000, 40000, 19000, 86000, 27000, 90000, 40000, 19000, 86000, 27000,
                                90000
                            ]
                        }
                    ]
                };

                var salesChartOptions = {
                        // Boolean - If we should show the scale at all
                        showScale: true,
                        // Boolean - Whether grid lines are shown across the chart
                        scaleShowGridLines: false,
                        // String - Colour of the grid lines
                        scaleGridLineColor: 'rgba(0,0,0,.05)',
                        // Number - Width of the grid lines
                        scaleGridLineWidth: 1,
                        // Boolean - Whether to show horizontal lines (except X axis)
                        scaleShowHorizontalLines: true,
                        // Boolean - Whether to show vertical lines (except Y axis)
                        scaleShowVerticalLines: true,
                        // Boolean - Whether the line is curved between points
                        bezierCurve: true,
                        // Number - Tension of the bezier curve between points
                        bezierCurveTension: 0.3,
                        // Boolean - Whether to show a dot for each point
                        pointDot: false,
                        // Number - Radius of each point dot in pixels
                        pointDotRadius: 4,
                        // Number - Pixel width of point dot stroke
                        pointDotStrokeWidth: 1,
                        // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                        pointHitDetectionRadius: 20,
                        // Boolean - Whether to show a stroke for datasets
                        datasetStroke: true,
                        // Number - Pixel width of dataset stroke
                        datasetStrokeWidth: 2,
                        // Boolean - Whether to fill the dataset with a color
                        datasetFill: true,
                        // String - A legend template
                        legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio     : true,
    // Boolean - whether to make the chart responsive to window resizing
    responsive              : true
  };

  // Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
});
}

function getVendorDistributionRedraw() {
    var month = document.getElementById('vendorDistributionMonth').value;
    console.log(month);
    var transactions = window.currentYearTransactions;
    console.log(transactions);

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Vendor/VendorListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        // console.log(this.responseText);
        console.log('This is getVendorDistributionRedraw');
        var vendors = JSON.parse(this.responseText);

        if(month == '00'){
            transactions.forEach(transaction => {
           
                if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION == undefined) {
                    vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = 0;
                }

                if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION != undefined) {
                    if (transaction.TOTAL_TRANSACTION != null) {
                        vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                            1].TOTAL_TRANSACTION + parseInt(transaction.TOTAL_TRANSACTION);
                    } else {
                        vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                            1].TOTAL_TRANSACTION + 0;
                    }
                }
            });
        } else {
            transactions.forEach(transaction => {
            if(transaction.DATE_TRANSACTION.split('-')[1] == month){
                if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION == undefined) {
                    vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = 0;
                }

                if (vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION != undefined) {
                    if (transaction.TOTAL_TRANSACTION != null) {
                        vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                            1].TOTAL_TRANSACTION + parseInt(transaction.TOTAL_TRANSACTION);
                    } else {
                        vendors[transaction.ID_VENDOR - 1].TOTAL_TRANSACTION = vendors[transaction.ID_VENDOR -
                            1].TOTAL_TRANSACTION + 0;
                    }
                }
            }
        });
        }

        vendors.forEach(vendor => {
            if(vendor.TOTAL_TRANSACTION == undefined){
                vendor.TOTAL_TRANSACTION = 0;
            }
        });

        console.log(vendors);

        var str = "";
        var piechartvendorlegend = document.getElementById('piechartvendorlegend');

        var colorsArray = [{
                color: 'red',
                hex: '#dd4b39'
            },
            {
                color: 'green',
                hex: '#00a65a'
            },
            {
                color: 'yellow',
                hex: '#f39c12'
            },
            {
                color: 'aqua',
                hex: '#00c0ef'
            },
            {
                color: 'light-blue',
                hex: '#3c8dbc'
            },
            {
                color: 'gray',
                hex: '#d2d6de'
            }
        ];

        var PieData = [];

        if (vendors.length > 0) {
            for (let index = 0; index < vendors.length; index++) {
                str += "<li><i class='fa fa-circle-o text-" + colorsArray[index].color + "'></i> " + vendors[index]
                    .NAME_VENDOR + "</li>";

                PieData[index] = {
                    value: vendors[index].TOTAL_TRANSACTION,
                    color: colorsArray[index].hex,
                    highlight: colorsArray[index].hex,
                    label: vendors[index].NAME_VENDOR
                }

            }
        } else if (vendors.length == 0) {
            // str += "<tr style='text-align:center'>"
            // str += "<td valign='top' colspan='6'>Belum ada produk terbaru</td>"
            // str += "</tr>"
        }
        piechartvendorlegend.innerHTML = str;
        // console.log('Ini PieData');
        // console.log(PieData);

        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart = new Chart(pieChartCanvas);

        var pieOptions = {
            // Boolean - Whether we should show a stroke on each segment
            segmentShowStroke: true,
            // String - The colour of each segment stroke
            segmentStrokeColor: '#fff',
            // Number - The width of each segment stroke
            segmentStrokeWidth: 1,
            // Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            // Number - Amount of animation steps
            animationSteps: 100,
            // String - Animation easing effect
            animationEasing: 'easeOutBounce',
            // Boolean - Whether we animate the rotation of the Doughnut
            animateRotate: true,
            // Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale: false,
            // Boolean - whether to make the chart responsive to window resizing
            responsive: true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: false,
            // String - A legend template
            legendTemplate: '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
                // String - A tooltip template
                tooltipTemplate: function(label) {
                    return 'Rp ' + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
                onAnimationComplete: function() {
                    this.showTooltip(this.segments, true);

                    //Show tooltips in bar chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                    //this.showTooltip(this.datasets[0].bars, true);

                    //Show tooltips in line chart (issue: multiple datasets doesnt work http://jsfiddle.net/5gyfykka/14/)
                    //this.showTooltip(this.datasets[0].points, true);  
                },

                tooltipEvents: [],

                showTooltips: true
            };
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions);


        }; xhr.send(data);

    }
</script>