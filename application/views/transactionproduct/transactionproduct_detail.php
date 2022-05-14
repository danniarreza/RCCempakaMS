<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Detail Transaksi
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('TransactionProduct/')?>"><i class="fa fa-dashboard"></i>Transaksi</a></li>
            <li><a href="<?php echo site_url('TransactionProduct/')?>">Transaksi Produk</a></li>
            <li class="active">Edit Detail Transaksi Produk</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- <div class="callout callout-success">
            <h4>Reminder!</h4>
            Instructions for how to use modals are available on the
            <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
        </div> -->

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Transaksi</label>
                                    <input disabled type="text" class="form-control" id="idtransactiondisabled"
                                        style="border-radius: 4px" placeholder="Kode Transaksi..."
                                        name="idtransactiondisabled"
                                        value="<?php echo $transactionbyid[0]['ID_TRANSACTION']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Pelanggan</label>
                                    <input disabled type="text" class="form-control" id="namecustomer"
                                        style="border-radius: 4px" placeholder="Nama Pelanggan..." name="namecustomer"
                                        value="<?php echo $transactionbyid[0]['NAME_CUSTOMER']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tanggal Transaksi</label>
                                    <input disabled type="text" class="form-control" id="datetransaction"
                                        style="border-radius: 4px" placeholder="Tanggal Transaksi..."
                                        name="datetransaction"
                                        value="<?php echo date('d M Y', strtotime($transactionbyid[0]['DATE_TRANSACTION']))?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Therapist</label>
                                    <input disabled type="text" class="form-control" id="nametherapist"
                                        style="border-radius: 4px" placeholder="Nama Therapist..." name="nametherapist"
                                        value="<?php echo $transactionbyid[0]['NAME_USER']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Toko</label>
                                    <input disabled type="text" class="form-control" id="namevendor"
                                        style="border-radius: 4px" placeholder="Nama Toko..." name="namevendor"
                                        value="<?php echo $transactionbyid[0]['NAME_VENDOR']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total Transaksi</label>
                                    <input disabled type="text" class="form-control" id="id" style="border-radius: 4px"
                                        placeholder="Kode Transaksi..." name="id"
                                        value="<?php echo 'Rp ' . number_format($transactionbyid[0]['TOTAL_TRANSACTION'], 2, ",", ".")?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Pembelian Produk</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div>
                            <button onclick="add_transaction_initialization('Tambah Produk')" type="button"
                                style="margin-bottom:10px" class="btn btn-success" data-toggle="modal"
                                data-target="#modal-default">
                                Tambah Produk
                                <!-- <i class="fa fa-plus-circle"></i> -->
                            </button>
                        </div>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form role="form" id="modalform"
                                        action="<?php echo site_url('TransactionProduct/transactionProductDetailAddHandler');?>"
                                        method="post" enctype="multipart/form-data"
                                        onsubmit="return add_transaction_validation();">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modaltitle">Tambah Produk</h4>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group" id="idtransaction_form_group">
                                                <label id="typeproductlabel" name="typeproductlabel">Kode Produk</label>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-3 col-xs-5" style="padding-right:2.5px">
                                                        <input readOnly type="hidden" class="form-control"
                                                            id="idtherapist" style="border-radius: 4px"
                                                            placeholder="Nama Therapist..." name="idtherapist"
                                                            value="<?php echo $transactionbyid[0]['ID_USER']?>">
                                                        <input readOnly type="hidden" name="idtransaction"
                                                            id="idtransaction" class="form-control"
                                                            style="border-radius: 4px" placeholder="..."
                                                            value="<?php echo $transactionbyid[0]['ID_TRANSACTION']?>">
                                                        <input readOnly type="hidden" name="idtransactionproduct"
                                                            id="idtransactionproduct" class="form-control"
                                                            style="border-radius: 4px" placeholder="..." value="">
                                                        <input readOnly type="hidden" name="idvendor" id="idvendor"
                                                            class="form-control" style="border-radius: 4px"
                                                            placeholder="..."
                                                            value="<?php echo $transactionbyid[0]['ID_VENDOR']?>">
                                                        <select onchange="type_product_onchange()" class="form-control"
                                                            name="typeproduct" id="typeproduct"
                                                            style="width: 100%; border-radius: 4px">
                                                            <?php
                                                                foreach ($producttypeslist as $row) {
                                                                    ?>
                                                            <option value="<?php echo $row['ID_PRODUCT_TYPE']?>">
                                                                <?php echo $row['ID_PRODUCT_TYPE']; ?>
                                                            </option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                        <span class="help-block" id="typeproduct_span"></span>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9 col-xs-7" style="padding-left:2.5px">
                                                        <select onchange="idproduct_onchange()" class="form-control"
                                                            name="idproduct" id="idproduct"
                                                            style="width: 100%; border-radius: 4px">
                                                            <option value="" selected>-- Pilih ID Produk --
                                                            </option>
                                                        </select>
                                                        <span class="help-block" id="idproduct_span"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="nameproduct_form_group">
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                        <label for="nameproductlabel">Nama Produk</label>
                                                    </div>
                                                    <div style="text-align:right" class="col-md-3 col-sm-3 col-xs-3">
                                                        <label for="remainingstocklabel" id="remainingstocklabel"
                                                            name="remainingstocklabel">Sisa : <i
                                                                class="fa fa-spin fa-refresh"></i>&nbsp;</label>
                                                    </div>
                                                </div>
                                                <input readOnly type="text" name="nameproduct" id="nameproduct"
                                                    class="form-control" style="border-radius: 4px"
                                                    placeholder="Contoh: Cream Malam ...">
                                                <span class="help-block" id="nameproduct_span"></span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group" id="amount_form_group">
                                                        <label for="exampleInputEmail1">Jumlah</label>
                                                        <input type="number" onchange="amount_onchange()"
                                                            onkeypress="return noenter('amount_onchange')"
                                                            class="form-control" id="amount" min="1" step="1"
                                                            placeholder="Contoh : 10 atau 12.5" name="amount" value="1"
                                                            style="border-radius:4px">
                                                        <input type="hidden" class="form-control" id="previousamount"
                                                            placeholder="Contoh : 10 atau 12.5" name="previousamount"
                                                            value="1" style="border-radius:4px">

                                                        <span class="help-block" id="amount_span"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group" id="discount_form_group">
                                                        <label for="exampleInputEmail1">Diskon</label>
                                                        <div class="input-group">
                                                            <input type="number" onchange="discount_onchange()"
                                                                onkeypress="return noenter('discount_onchange')"
                                                                class="form-control" id="discount" min="0" step="0.1"
                                                                placeholder="Contoh : 10 atau 12.5" name="discount"
                                                                value="0"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                                            <span class="input-group-addon"
                                                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">%</span>
                                                        </div>
                                                        <span class="help-block" id="discount_span"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group" id="sellprice_form_group">
                                                        <label for="exampleInputEmail1">Harga Awal Produk</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                                                <!-- <i class="fa fa-calendar"></i> -->
                                                                <p style="font-size:12px; padding-top:4px;">Rp</p>
                                                            </div>
                                                            <input readOnly type="text" class="form-control"
                                                                id="sellprice"
                                                                placeholder="Contoh : 100000 atau 100.000"
                                                                name="sellprice" value="">
                                                            <span class="input-group-addon"
                                                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                                        </div>
                                                        <span class="help-block" id="sellprice_span"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="form-group" id="discountprice_form_group">
                                                        <label for="exampleInputEmail1">Harga Diskon Produk</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                                                <!-- <i class="fa fa-calendar"></i> -->
                                                                <p style="font-size:12px; padding-top:4px;">Rp</p>
                                                            </div>
                                                            <input readOnly type="text" class="form-control"
                                                                id="discountprice"
                                                                placeholder="Contoh : 100000 atau 100.000"
                                                                name="discountprice" value="">
                                                            <span class="input-group-addon"
                                                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                                        </div>
                                                        <span class="help-block" id="discountprice_span"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" id="submitbutton" class="btn btn-primary">Simpan
                                                Pembelian</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <div class="table-responsive">
                            <table id="transactionproductdetailtable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Entri</th>
                                        <th>Tanggal Entri</th>
                                        <th>Nama Toko</th>
                                        <th>Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Harga Awal</th>
                                        <th>Diskon</th>
                                        <th>Harga Total</th>
                                        <th>Edit Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($transactionlist as $row) {
                                        ?>
                                    <tr>
                                        <td id="id_transaction_product_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo $row['ID_TRANSACTION_PRODUCT']?>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y', strtotime($row['DATE_TRANSACTION_PRODUCT']))?>
                                        </td>
                                        <td id="name_vendor_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo $row['NAME_VENDOR']?>
                                        </td>
                                        <td id="type_product_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo $row['TYPE_PRODUCT'] . '-' . $row['ID_PRODUCT'] . ' ' . $row['NAME_PRODUCT']?>
                                        </td>
                                        <td id="amount_product_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo $row['AMOUNT_PRODUCT']?>
                                        </td>
                                        <td id="total_price_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo 'Rp ' . number_format($row['TOTAL_PRICE'], 2, ",", ".")?>
                                        </td>
                                        <td id="amount_product_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo $row['DISCOUNT_PRODUCT']?> %
                                        </td>
                                        <td id="total_price_<?php echo $row['ID_TRANSACTION_PRODUCT']?>">
                                            <?php echo 'Rp ' . number_format($row['TOTAL_PRICE'] * (100-$row['DISCOUNT_PRODUCT'])/100, 2, ",", ".")?>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                onclick="edit_transaction_initialization('Edit Produk', '<?php echo $row['ID_TRANSACTION_PRODUCT']?>')"
                                                data-toggle="modal" data-target="#modal-default"
                                                style="width:50%; margin-left: auto; margin-right:auto"
                                                class="btn btn-block btn-primary btn-xs">
                                                <i style="margin-left: auto; margin-right: auto"
                                                    class="fa fa-fw fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Kode Entri</th>
                                        <th>Tanggal Entri</th>
                                        <th>Nama Toko</th>
                                        <th>Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Harga Awal</th>
                                        <th>Diskon</th>
                                        <th>Harga Total</th>
                                        <th>Edit Pembelian</th>
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
var modalselected = '';

function add_transaction_initialization(modaltitle) {

    window.modalselected = 'add';

    document.getElementById('previousamount').value = 1;
    type_product_onchange();
    document.getElementById('modaltitle').innerHTML = modaltitle;

    document.getElementById('modalform').setAttribute("action",
        "<?php echo site_url('TransactionProduct/transactionProductDetailAddHandler');?>");

    var newidtransactionproduct = '';
    document.getElementById('idtransactionproduct').value = newidtransactionproduct;

    var newamount = 1;
    document.getElementById('amount').value = newamount;

    var newdiscount = 0;
    document.getElementById('discount').value = newdiscount;

}

function edit_transaction_initialization(modaltitle, id_transaction_product) {

    window.modalselected = 'edit';

    document.getElementById('modaltitle').innerHTML = modaltitle;

    document.getElementById('modalform').setAttribute("action",
        "<?php echo site_url('TransactionProduct/transactionProductDetailEditHandler');?>");

    var newtypeproduct = document.getElementById('type_product_' + id_transaction_product).innerHTML.trim().split(
        '-')[0];
    document.getElementById('typeproduct').value = newtypeproduct;
    type_product_onchange();

    var data = new FormData();
    data.append('id_transaction_product', id_transaction_product);

    var method = 'POST';
    var url = "<?php echo site_url('TransactionProduct/transactionproductByIdRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        items = items[0];
        console.log(items);

        var newidtransactionproduct = items.ID_TRANSACTION_PRODUCT;
        document.getElementById('idtransactionproduct').value = newidtransactionproduct;

        // var newidproduct = document.getElementById('type_product_' + id_transaction_product).innerHTML.trim().split('-')[1];
        var newidproduct = items.ID_PRODUCT;
        newidproduct = newidproduct + '-' + items.NAME_PRODUCT + '-' + items.SELL_PRICE_PRODUCT;
        document.getElementById('idproduct').value = newidproduct;

        var newnameproduct = items.NAME_PRODUCT;
        document.getElementById('nameproduct').value = newnameproduct;

        var newamount = items.AMOUNT_PRODUCT;
        document.getElementById('amount').value = newamount;

        var newdiscount = items.DISCOUNT_PRODUCT;
        document.getElementById('discount').value = newdiscount;

        var newsellprice = items.SELL_PRICE_PRODUCT * items.AMOUNT_PRODUCT;
        document.getElementById('sellprice').value = newsellprice;

        var newdiscountprice = items.TOTAL_PRICE;
        document.getElementById('discountprice').value = newdiscountprice;

    };
    xhr.send(data);
}


function type_product_onchange() {

    document.getElementById('typeproductlabel').innerHTML = 'Kode Produk    <i class="fa fa-spin fa-refresh">';
    document.getElementById('remainingstocklabel').innerHTML = 'Sisa :   <i class="fa fa-spin fa-refresh">';
    var typeproduct = document.getElementById('typeproduct').value;
    console.log(typeproduct);

    var data = new FormData();
    data.append('type', typeproduct);

    var method = 'POST';
    var url = "<?php echo site_url('Product/productByTypeRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        // var items = ["Apple", "Oranges", "Bananas"];
        var str = "";
        for (var item of items) {
            str += "<option value='" + item.ID_PRODUCT + "-" + item.NAME_PRODUCT + "-" + item.SELL_PRICE_PRODUCT +
                "'>" + item.ID_PRODUCT + " " +
                item.NAME_PRODUCT + "</option>"
        }
        document.getElementById("idproduct").innerHTML = str;
        document.getElementById('typeproductlabel').innerHTML = 'Kode Produk';

        idproduct_onchange();
        discount_onchange();

    };
    xhr.send(data);
}

function idproduct_onchange() {
    // getRemainingStock();
    document.getElementById('remainingstocklabel').innerHTML = 'Sisa :   <i class="fa fa-spin fa-refresh">';
    var remainingstocklabel = document.getElementById('remainingstocklabel');

    var type_product = document.getElementById('typeproduct').value;
    var id_product = document.getElementById('idproduct').value.split('-')[0];
    var name_vendor = document.getElementById('namevendor').value;

    var data = new FormData();
    data.append('type_product', type_product);
    data.append('id_product', id_product);
    data.append('name_vendor', name_vendor);

    var method = 'POST';
    var url = "<?php echo site_url('Stock/productRemainingStockRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        if (items.length > 0) {
            document.getElementById('remainingstocklabel').innerHTML = 'Sisa : ' + items[0].STOCK_PRODUCT;
        } else {
            document.getElementById('remainingstocklabel').innerHTML = 'Sisa : 0';
        }


        var amount = document.getElementById('amount');
        var previousamount = document.getElementById('previousamount');
        var nameproduct_value = document.getElementById('idproduct').value.split('-')[1];
        var sellprice_value = document.getElementById('idproduct').value.split('-')[2];

        console.log('Ini sellprice value');
        console.log(sellprice_value);

        if (window.modalselected == 'add') {
            amount.value = 1;
            previousamount.value = 1;
            sellprice_value = sellprice_value * amount.value;
        } else if (window.modalselected == 'edit') {

            previousamount.value = 1;
            sellprice_value = sellprice_value;
        }



        console.log('Ini sellprice value setelah dikalikan amount ' + amount.value);
        console.log(sellprice_value);

        var discount_value = document.getElementById('discount').value;
        var discountprice_value = sellprice_value - (sellprice_value * (discount_value / 100));

        sellprice_value = number_format(sellprice_value, 0, ',', '.');
        discountprice_value = number_format(discountprice_value, 0, ',', '.');

        console.log(nameproduct_value);
        console.log(sellprice_value);

        if (nameproduct_value != undefined || nameproduct_value != null) {
            document.getElementById('nameproduct').value = nameproduct_value;
            document.getElementById('sellprice').value = sellprice_value;
            document.getElementById('discountprice').value = discountprice_value;
        } else {
            document.getElementById('nameproduct').value = '';
            document.getElementById('sellprice').value = '';
            document.getElementById('discountprice').value = '';
        }

        amount_onchange();

    };
    xhr.send(data);

    // console.log(document.getElementById('idproduct').value.split('-'));

}

function getRemainingStock() {
    var remainingstocklabel = document.getElementById('remainingstocklabel');

    var type_product = document.getElementById('typeproduct').value;
    var id_product = document.getElementById('idproduct').value.split('-')[0];
    var name_vendor = document.getElementById('namevendor').value;

    var data = new FormData();
    data.append('type_product', type_product);
    data.append('id_product', id_product);
    data.append('name_vendor', name_vendor);

    var method = 'POST';
    var url = "<?php echo site_url('Stock/productRemainingStockRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);
        document.getElementById('remainingstocklabel').innerHTML = 'Sisa : ' + items[0].STOCK_PRODUCT;
        document.getElementById('amount').value = 1;
        amount_onchange();

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

function amount_onchange() {
    var amount = document.getElementById('amount');
    var remainingstock = document.getElementById('remainingstocklabel').innerHTML;
    remainingstock = remainingstock.substring(remainingstock.lastIndexOf(" ") + 1);

    if (parseInt(amount.value) < 1 || amount.value == '') {
        amount.value = 1;
    }

    if (parseInt(amount.value) > parseInt(remainingstock)) {
        amount.value = remainingstock;

        document.getElementById('amount_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('amount_span').innerHTML = "Jumlah dijual tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('amount_form_group').setAttribute("class", "form-group");
        document.getElementById('amount_span').innerHTML = "";

    }

    var previousamount = document.getElementById('previousamount');
    var sellprice = document.getElementById('sellprice');
    var discountprice = document.getElementById('discountprice');

    var sellpriceArray = sellprice.value.split(".");
    var sellpricenumber = '';
    var discountpriceArray = discountprice.value.split(".");
    var discountpricenumber = '';

    sellpriceArray.forEach(price => {
        sellpricenumber = sellpricenumber + price;
    });

    console.log("ini amount value");
    console.log(amount.value);

    console.log('Ini sellpricenumber');
    console.log(sellpricenumber);

    discountpriceArray.forEach(price => {
        discountpricenumber = discountpricenumber + price;
    });
    console.log('Ini discountpricenumber');
    console.log(discountpricenumber);

    (amount.value < 1) ?
    (
        sellpricenumber = sellpricenumber * 1 / 1,
        discountpricenumber = discountpricenumber * 1 / 1,
        previousamount.value = 1
    ) :
    (
        sellpricenumber = sellpricenumber * amount.value / previousamount.value,
        discountpricenumber = discountpricenumber * amount.value / previousamount.value,
        previousamount.value = amount.value
    );

    console.log('Ini sellpricenumber');
    console.log(sellpricenumber);
    sellprice.value = number_format(sellpricenumber, 0, ',', '.');

    // () ? 
    // (
    //     discountpricenumber = discountpricenumber * 1 / 1;
    // ):
    // (
    //     discountpricenumber = discountpricenumber * amount.value / previousamount.value;
    // );

    console.log('Ini discountpricenumber');
    console.log(discountpricenumber);
    discountprice.value = number_format(discountpricenumber, 0, ',', '.');



}

function discount_onchange() {

    var sellprice = document.getElementById('sellprice');
    var discount = document.getElementById('discount');

    if (discount.value < 0 || discount.value == '') {
        discount.value = 0;
    }

    var discountprice = document.getElementById('discountprice');
    var sellpriceArray = sellprice.value.split(".");
    var sellpricenumber = '';
    var discountpricenumber = '';

    sellpriceArray.forEach(price => {
        sellpricenumber = sellpricenumber + price;
    });

    discountpricenumber = sellpricenumber - (sellpricenumber * (discount.value / 100));
    discountprice.value = number_format(discountpricenumber, 0, ',', '.');

}

function add_transaction_validation() {
    var type = document.getElementById('typeproduct').value;
    var id = document.getElementById('idproduct').value;
    var name = document.getElementById('nameproduct').value;
    var discountprice = document.getElementById('discountprice').value;

    var discountpricesplitarray = discountprice.split(".");
    var discountpricenumber = '';

    discountpricesplitarray.forEach(element => {
        discountpricenumber = discountpricenumber + element;
    });
    var discountprice_isnum = /^\d+$/.test(discountpricenumber);

    var sellprice = document.getElementById('sellprice').value;

    var sellpricesplitarray = sellprice.split(".");
    var sellpricenumber = '';

    sellpricesplitarray.forEach(element => {
        sellpricenumber = sellpricenumber + element;
    });
    var sellprice_isnum = /^\d+$/.test(sellpricenumber);
    // var description = document.getElementById('description').value;

    var successArray = [false, false, false, false, false];
    var success = false;

    type == '' ?
        (
            document.getElementById('idtransaction_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('typeproduct_span').innerHTML = "Harap pilih jenis produk",
            successArray[0] = false

        ) :
        (
            document.getElementById('idtransaction_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('typeproduct_span').innerHTML = "",
            successArray[0] = true
        );

    id == '' ?
        (
            document.getElementById('idtransaction_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('idproduct_span').innerHTML = "Harap lengkapi kode produk",
            successArray[1] = false

        ) :
        (
            document.getElementById('idtransaction_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('idproduct_span').innerHTML = "",
            successArray[1] = true
        );

    name == '' ?
        (
            document.getElementById('nameproduct_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('nameproduct_span').innerHTML = "Harap lengkapi nama produk",
            successArray[2] = false

        ) :
        (
            document.getElementById('nameproduct_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('nameproduct_span').innerHTML = "",
            successArray[2] = true
        );

    discountprice == '' ?
        (
            document.getElementById('discountprice_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('discountprice_span').innerHTML = "Harap lengkapi harga modal produk",
            successArray[3] = false
        ) :
        (
            discountprice_isnum == false ||
            discountpricesplitarray[discountpricesplitarray.length - 1] == '' ||
            discountpricesplitarray[discountpricesplitarray.length - 1] == '0' ||
            discountpricesplitarray[discountpricesplitarray.length - 1] == '00' ?
            (
                document.getElementById('discountprice_form_group').setAttribute("class", "form-group has-error"),
                document.getElementById('discountprice_span').innerHTML =
                "Harap isikan dengan format : 1000000 atau 1.000.000",
                successArray[3] = false
            ) :
            (
                document.getElementById('discountprice_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('discountprice_span').innerHTML = "",
                successArray[3] = true
            )
        );

    sellprice == '' ?
        (
            document.getElementById('sellprice_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('sellprice_span').innerHTML = "Harap lengkapi harga jual produk",
            successArray[4] = false
        ) :
        (
            sellprice_isnum == false ||
            sellpricesplitarray[sellpricesplitarray.length - 1] == '' ||
            sellpricesplitarray[sellpricesplitarray.length - 1] == '0' ||
            sellpricesplitarray[sellpricesplitarray.length - 1] == '00' ?
            (
                document.getElementById('sellprice_form_group').setAttribute("class", "form-group has-error"),
                document.getElementById('sellprice_span').innerHTML =
                "Harap isikan dengan format : 1000000 atau 1.000.000",
                successArray[4] = false
            ) :
            (
                document.getElementById('sellprice_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('sellprice_span').innerHTML = "",
                successArray[4] = true
            )
        );


    // return false;

    for (let index = 0; index < successArray.length; index++) {
        if (successArray[index] == true) {
            success = successArray[index];
        } else if (successArray[index] == false) {
            success = successArray[index];
            break;
        }
    }
    return success;

}

function noenter(functionname) {
    // console.log(functioname);
    // console.log(!(window.event && window.event.keyCode == 13));

    if (window.event && window.event.keyCode == 13) {
        if (functionname == 'amount_onchange') {
            amount_onchange();
        } else if (functionname == 'discount_onchange') {
            discount_onchange();
        }
    }

    return !(window.event && window.event.keyCode == 13);
}
</script>