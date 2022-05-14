<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock Detail
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Stock/')?>"><i class="fa fa-dashboard"></i> Stock</a></li>
            <li><a href="<?php echo site_url('Stock/')?>">Stock</a></li>
            <li class="active">Stock Detail History</li>
        </ol>
    </section>

    <?php 
    $uvstore = '';
    foreach ($therapistvisibility as $uv) {
        if($uv['NAME_VENDOR'] == 'Sengon'){
            $uvstore = $uv['NAME_VENDOR'];
            break;
        }
    }
    
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="box-title">
                                    <?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?> :
                                    <?php echo $contenttitle['NAME_PRODUCT'];?>
                                </h3>

                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right">
                                <h3 class="box-title">
                                    Sisa stok : <?php echo $remainingstock?>
                                </h3>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_stockreceipt_initialization()" type="button"
                                    style="margin-bottom:10px" class="btn btn-success" data-toggle="modal"
                                    data-target="#modal-stock-receipt">
                                    Stock Masuk
                                    <i style="padding-left:10px" class="fa fa-download"></i>
                                </button>
                                <?php $this->view('stock/stock_receipt_modal');?>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_stocktransfer_initialization()" type="button"
                                    style="margin-bottom:10px" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-stock-transfer">
                                    Stock Transfer
                                    <i style="padding-left:10px" class="fa fa-upload"></i>
                                </button>
                                <?php $this->view('stock/stock_transfer_modal');?>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_stockrepack_initialization()" type="button"
                                    style="margin-bottom:10px" class="btn btn-warning" data-toggle="modal"
                                    data-target="#modal-stock-repack">
                                    Stock Repack
                                    <i style="padding-left:10px" class="fa fa-cubes"></i>
                                </button>
                                <?php $this->view('stock/stock_repack_modal');?>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_stockrecycle_initialization()" type="button"
                                    style="margin-bottom:10px; background-color: #d37b00" class="btn btn-warning"
                                    data-toggle="modal" data-target="#modal-stock-recycle">
                                    Stock Menyusut
                                    <i style="padding-left:10px" class="fa fa-hourglass-3"></i>
                                </button>
                                <?php $this->view('stock/stock_recycle_modal');?>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_stockexpired_initialization()" type="button"
                                    style="margin-bottom:10px" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modal-stock-expired">
                                    Stock Expired
                                    <i style="padding-left:10px" class="fa fa-ban"></i>
                                </button>
                                <?php $this->view('stock/stock_expired_modal');?>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <button onclick="add_transactionproduct_initialization()" type="button"
                                    style="margin-bottom:10px" class="btn btn-default" data-toggle="modal"
                                    data-target="#modal-stock-transactionproduct">
                                    Transaksi Baru
                                    <i style="padding-left:10px" class="fa fa-shopping-cart"></i>
                                </button>
                                <?php $this->view('stock/stock_transactionproduct_modal');?>
                            </div>
                            <!-- <div class="col-md-2 col-sm-6 col-xs-6">
                                <button onclick="" type="button"
                                    style="margin-bottom:10px" class="btn btn-default" data-toggle="modal"
                                    data-target="#modal-expired">
                                    Print Laporan Stock
                                    <i style="padding-left:10px" class="fa fa-print"></i>
                                </button>
                            </div> -->
                        </div>

                        <div class="table-responsive">
                            <table id="stockRecapitulationtable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Entry</th>
                                        <th>Tanggal Entry</th>
                                        <th>Jenis</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Sumber/Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Stok Terakhir</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <!-- <th>Arsip</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($stocklist as $row) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['ID_ENTRY']?>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y', strtotime($row['DATE_ENTRY']))?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $row['NAME_STOCK_TYPE'];
                                        // if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                //     echo $row['NAME_STOCK_TYPE'];
                                                // }
                                                // elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                //     echo 'Transaksi Produk';
                                                // }?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if ($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak') {
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                } elseif ($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut') {
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                } elseif (explode(" ", $row['NAME_STOCK_TYPE'])[0] == 'Transaksi') {
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                }
                                            }
                                        // elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                            //     echo $row['NAME_USER'] . ' - ' . $row['NAME_VENDOR'];
                                            //     ;
                                            // }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if ($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak') {
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                } elseif ($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut') {
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                } elseif (explode(" ", $row['NAME_STOCK_TYPE'])[0] == 'Transaksi') {
                                                    echo $row['NAME_CUSTOMER'] . ' - ' . $row['ADDRESS_CUSTOMER'];
                                                }
                                            } ?>
                                        </td>
                                        <td>
                                            <?php echo $row['AMOUNT']?>
                                        </td>
                                        <td>
                                            <?php echo $row['LATEST_STOCK_AMOUNT']?>
                                        </td>
                                        <td>
                                            <?php echo($row['DESCRIPTION'] != '' ? $row['DESCRIPTION'] : '-')?>
                                        </td>
                                        <td style="text-align:center">
                                            <div class="btn-group">
                                                <button type="button" data-toggle="dropdown" class="dropdown-toggle btn 
                                                <?php if (strtoupper($row['NAME_STOCK_STATUS']) == 'VERIFIED - THERAPIST') {
                                                            echo 'btn-success';
                                                            $name_stock_status = 'Verified';
                                                        } elseif (strtoupper($row['NAME_STOCK_STATUS']) == 'VERIFIED - ADMIN') {
                                                            echo 'btn-warning';
                                                            $name_stock_status = 'Verified';
                                                        } elseif (strtoupper($row['NAME_STOCK_STATUS']) == 'PENDING') {
                                                            echo 'btn-default';
                                                            $name_stock_status = $row['NAME_STOCK_STATUS'];
                                                        } elseif (strtoupper($row['NAME_STOCK_STATUS']) == 'REJECTED') {
                                                            echo 'btn-danger';
                                                            $name_stock_status = $row['NAME_STOCK_STATUS'];
                                                        } ?>"><?php echo $name_stock_status?></button>
                                                <?php                                                 
                                                if($this->session->user_type == 'Admin' || $this->session->user_type == 'Super Admin' || $uvstore == 'Sengon'){
                                                    ?>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a
                                                            onclick="verifyStockAttempt(<?php echo $row['ID_ENTRY']?>, '<?php echo $contenttitle['TYPE_PRODUCT']?>', '<?php echo $contenttitle['ID_PRODUCT']?>', '<?php echo $row['VENDOR_RECEIVER']?>', '<?php echo $uvstore?>', '<?php echo ( $this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin' ? 3 : 2 )?>')">Verified</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a
                                                            onclick="verifyStockAttempt(<?php echo $row['ID_ENTRY']?>, '<?php echo $contenttitle['TYPE_PRODUCT']?>', '<?php echo $contenttitle['ID_PRODUCT']?>', '<?php echo $row['VENDOR_RECEIVER']?>', '<?php echo $uvstore?>', '1')">Pending</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a
                                                            onclick="verifyStockAttempt(<?php echo $row['ID_ENTRY']?>, '<?php echo $contenttitle['TYPE_PRODUCT']?>', '<?php echo $contenttitle['ID_PRODUCT']?>', '<?php echo $row['VENDOR_RECEIVER']?>', '<?php echo $uvstore?>', '4')">Reject</a>
                                                    </li>
                                                </ul>
                                                <?php
                                                }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <th>Jumlah Stok</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="stocktotal"><?php echo $remainingstock?></th> 
                                        -->
                                        <th>Kode Entry</th>
                                        <th>Tanggal Entry</th>
                                        <th>Jenis</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Sumber/Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Stok Terakhir</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
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
function countstockRecapitulationTotal() {
    var table = document.getElementById('stockRecapitulationtable');
    var rows = table.rows;
    var total = 0;
    var number = 0;

    // console.log(rows[1].cells[0].getAttribute('class'));

    if (rows[1].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        for (let index = 0; index < rows.length - 1; index++) {
            if (index != 0) {
                type = table.rows[index].cells[1].innerText;
                number = table.rows[index].cells[4].innerText;
                number = parseFloat(number);
                total += number;
                // console.log(type);
                // if(type == 'Stok Transfer' || type == 'Transaksi Produk'){
                //     total -= number;
                // } else {
                //     total += number;
                // }

            }
        }
    } else if (rows[1].cells[0].getAttribute('class') == 'dataTables_empty') {
        total = 0;
    }

    total = number_format(total, 0, ',', '.');
    document.getElementById('stocktotal').innerHTML = total;
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

function sendervendor_onchange() {

    if (document.getElementById('sendervendor').value.split("-")[2].toLowerCase() == 'supplier') {

        var val = 99;
        var sel = document.getElementById('senderuser');

        var opts = sel.options;
        for (var opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == val) {
                sel.selectedIndex = j;
                break;
            }
        }
    }
}

function stock_description_onchange() {

    // console.log(document.getElementById('description').value.length);
    var limit = 100;
    var description = document.getElementById('description');

    if (description.value.length > limit) {
        console.log(description.value.length);

        document.getElementById('description_textlimit_label').innerHTML = 0;

        description.value = description.value.substring(0, limit);

        document.getElementById('description_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('description_span').innerHTML = "Melebihi batas 100 karakter!";
    } else if (description.value.length <= limit) {

        document.getElementById('description_textlimit_label').innerHTML = limit - description.value.length;

        document.getElementById('description_form_group').setAttribute("class", "form-group");
        document.getElementById('description_span').innerHTML = "";
    }

}

function verifyStockAttempt(idstockhistory, typeproduct, idproduct, vendor, uvstore, status) {

    var usertype = '<?php echo $this->session->user_type;?>';

    if (usertype == 'Admin' || usertype == 'Super Admin' || uvstore == 'Sengon') {
        var data = new FormData();
        var method = 'POST';
        var url = "<?php echo site_url('Stock/stockReceiptVerify/');?>";
        var userid = "<?php echo $this->session->user_id?>";

        data.append('idstockhistory', idstockhistory);
        data.append('userid', userid);
        data.append('status', status);
        data.append('uvstore', uvstore);

        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.onload = function() {
            // console.log(this.responseText);

            var response = JSON.parse(this.responseText);
            console.log(response);
            if (response.status == true) {

                window.location.href = '<?php echo site_url('Stock/stockRecapitulationView/')?>' + typeproduct + '-' +
                    idproduct + '-' + vendor;

                return false;
            } else {
                alert(response.message);
                return true;
            }
        };
        xhr.send(data);
    } else {
        alert('Anda tidak memiliki hak akses untuk memverifikasi!');
    }
}
</script>