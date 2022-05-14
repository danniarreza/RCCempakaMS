<div class="modal fade" id="modal-stock-transactionproduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url('Stock/stockRecapitulationTransactionProductAddHandler');?>"
                method="post" enctype="multipart/form-data" onsubmit="return add_transactionproduct_validation();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Transaksi Baru</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group" id="stock_transactionproduct_customer_form_group">
                        <label>Nama Pelanggan</label>
                        <select class="form-control select2" style="width: 100%;"
                            name="stock_transactionproduct_customer" id="stock_transactionproduct_customer">

                        </select>
                        <span class="help-block" id="stock_transactionproduct_customer_span"></span>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_vendor_form_group">
                        <label>Toko Cabang</label>
                        <select class="form-control select2" style="width: 100%;" name="stock_transactionproduct_vendor"
                            id="stock_transactionproduct_vendor">

                        </select>
                        <span class="help-block" id="stock_transactionproduct_vendor_span"></span>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_therapistname_form_group">
                        <label for="exampleInputEmail1">Nama Therapist</label>
                        <input readOnly type="text" name="stock_transactionproduct_therapistname"
                            value="<?php echo $this->session->user_name;?>" id="stock_transactionproduct_therapistname"
                            class="form-control" style="border-radius: 4px" placeholder="...">
                        <span class="help-block" id="stock_transactionproduct_therapistname_span"></span>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_therapistid_form_group">
                        <!-- <label for="exampleInputEmail1">Nama Therapist</label> -->
                        <input readOnly type="hidden" name="stock_transactionproduct_therapistid"
                            value="<?php echo $this->session->user_id;?>" id="stock_transactionproduct_therapistid"
                            class="form-control" style="border-radius: 4px" placeholder="...">
                        <span class="help-block" id="stock_transactionproduct_therapistid_span"></span>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_productid_form_group">
                        <label for="exampleInputEmail1">Kode Produk</label>
                        <input readOnly type="text" name="stock_transactionproduct_productid"
                            value="<?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?>"
                            id="stock_transactionproduct_productid" class="form-control" style="border-radius: 4px"
                            placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_transactionproduct_productid_span"></span>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_productname_form_group">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <label for="exampleInputEmail1">Nama Produk</label>
                            </div>
                            <div style="text-align:right" class="col-md-3 col-sm-3 col-xs-3">
                                <label for="stock_transactionproduct_remainingstocklabel" id="stock_transactionproduct_remainingstocklabel"
                                    name="stock_transactionproduct_remainingstocklabel">Sisa : <?php echo $remainingstock;?></label>
                            </div>
                        </div>

                        <input readOnly type="text" name="stock_transactionproduct_productname"
                            value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_transactionproduct_productname"
                            class="form-control" style="border-radius: 4px" placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_transactionproduct_productname_span"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transactionproduct_amount_form_group">
                                <label for="exampleInputEmail1">Jumlah</label>
                                <input type="number" onchange="stock_transactionproduct_amount_onchange()"
                                    onkeypress="return stock_transactionproduct_noenter('amount_onchange')" class="form-control"
                                    id="stock_transactionproduct_amount" min="1" step="1"
                                    placeholder="Contoh : 10 atau 12.5" name="stock_transactionproduct_amount" value="1"
                                    style="border-radius:4px">
                                <input type="hidden" class="form-control" id="stock_transactionproduct_previousamount"
                                    placeholder="Contoh : 10 atau 12.5" name="stock_transactionproduct_previousamount"
                                    value="1" style="border-radius:4px">

                                <span class="help-block" id="stock_transactionproduct_amount_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transactionproduct_discount_form_group">
                                <label for="exampleInputEmail1">Diskon</label>
                                <div class="input-group">
                                    <input type="number" onchange="stock_transactionproduct_discount_onchange()"
                                        onkeypress="return stock_transactionproduct_noenter('discount_onchange')" class="form-control"
                                        id="stock_transactionproduct_discount" min="0" step="0.1"
                                        placeholder="Contoh : 10 atau 12.5" name="stock_transactionproduct_discount"
                                        value="0" style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                    <span class="input-group-addon"
                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">%</span>
                                </div>
                                <span class="help-block" id="stock_transactionproduct_discount_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transactionproduct_sellprice_form_group">
                                <label for="exampleInputEmail1">Harga Awal Produk</label>
                                <div class="input-group">
                                    <div class="input-group-addon"
                                        style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                        <!-- <i class="fa fa-calendar"></i> -->
                                        <p style="font-size:12px; padding-top:4px;">Rp</p>
                                    </div>
                                    <input readOnly type="text" class="form-control"
                                        id="stock_transactionproduct_sellprice"
                                        placeholder="Contoh : 100000 atau 100.000"
                                        name="stock_transactionproduct_sellprice" value="">
                                    <span class="input-group-addon"
                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                </div>
                                <span class="help-block" id="stock_transactionproduct_sellprice_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transactionproduct_discountprice_form_group">
                                <label for="exampleInputEmail1">Harga Diskon Produk</label>
                                <div class="input-group">
                                    <div class="input-group-addon"
                                        style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                        <!-- <i class="fa fa-calendar"></i> -->
                                        <p style="font-size:12px; padding-top:4px;">Rp</p>
                                    </div>
                                    <input readOnly type="text" class="form-control"
                                        id="stock_transactionproduct_discountprice"
                                        placeholder="Contoh : 100000 atau 100.000"
                                        name="stock_transactionproduct_discountprice" value="">
                                    <span class="input-group-addon"
                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                </div>
                                <span class="help-block" id="stock_transactionproduct_discountprice_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stock_transactionproduct_transactiondate_form_group">
                        <label>Tanggal Transaksi</label>
                        <div class="input-group date">
                            <div class="input-group-addon"
                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input readOnly type="text" name="stock_transactionproduct_transactiondate"
                                id="stock_transactionproduct_transactiondate"
                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                class="form-control pull-right" value="<?php echo date('d M Y');?>">
                        </div>
                        <span class="help-block" id="stock_transactionproduct_transactiondate_span"></span>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="stock_transactionproduct_submitbutton" class="btn btn-primary">Buat
                        Transaksi Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function add_transactionproduct_initialization() {
    stock_transactionproduct_customer_list_request();
    stock_transactionproduct_vendor_list_request();

    stock_transactionproduct_product_initialization();
}

function stock_transactionproduct_customer_list_request() {
    var data = new FormData();

    var method = 'POST';
    var url = "<?php echo site_url('Customer/customerListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        // var items = ["Apple", "Oranges", "Bananas"];
        var str = "";
        var stock_transactionproduct_customer = document.getElementById('stock_transactionproduct_customer');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {

            str += "<option value='" + item.ID_CUSTOMER + "'>" +
                item.NAME_CUSTOMER + " - " + item.ADDRESS_CUSTOMER + "</option>"

        }
        stock_transactionproduct_customer.innerHTML = str;
        stock_recycle_senderuser_list_request();

    };
    xhr.send(data);
}

function stock_transactionproduct_vendor_list_request() {
    var data = new FormData();

    var method = 'POST';
    var url = "<?php echo site_url('Stock/userVisibilityRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        // var items = ["Apple", "Oranges", "Bananas"];
        var str = "";
        var stock_transactionproduct_vendor = document.getElementById('stock_transactionproduct_vendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR == current_vendor) {
                str += "<option selected value='" + item.ID_VENDOR + '-' + item.NAME_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_transactionproduct_vendor.innerHTML = str;
        // stock_recycle_senderuser_list_request();

    };
    xhr.send(data);
}

function stock_transactionproduct_product_initialization() {
    // document.getElementById('stock_transactionproduct_remainingstocklabel').innerHTML = 'Sisa :   <i class="fa fa-spin fa-refresh">';
    var remainingstocklabel = document.getElementById('stock_transactionproduct_remainingstocklabel');

    var type_product = document.getElementById('stock_transactionproduct_productid').value.split("-")[0];
    var id_product = document.getElementById('stock_transactionproduct_productid').value.split("-")[1];
    var name_vendor = '<?php echo $name_vendor;?>';

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
        console.log('he');
        console.log(items);
        document.getElementById('stock_transactionproduct_remainingstocklabel').innerHTML = 'Sisa : ' + items[0].STOCK_PRODUCT;
        document.getElementById('stock_transactionproduct_sellprice').value = items[0].SELL_PRICE_PRODUCT;

        var amountvalue = document.getElementById('stock_transactionproduct_amount').value;
        var previousamountvalue = document.getElementById('stock_transactionproduct_previousamount').value;
        var nameproductvalue = document.getElementById('stock_transactionproduct_productname').value;
        var sellpricevalue = document.getElementById('stock_transactionproduct_sellprice').value;

        console.log('Ini sellprice value');
        console.log(sellpricevalue);

        if (window.modalselected == 'add') {
            amountvalue = 1;
            previousamountvalue = 1;
            sellpricevalue = sellpricevalue * amountvalue;
        } else if (window.modalselected == 'edit') {

            previousamountvalue = 1;
            sellpricevalue = sellpricevalue;
        }



        console.log('Ini sellprice value setelah dikalikan amount ' + amountvalue);
        console.log(sellpricevalue);

        var discountvalue = document.getElementById('stock_transactionproduct_discount').value;
        var discountpricevalue = sellpricevalue - (sellpricevalue * (discountvalue / 100));

        sellpricevalue = number_format(sellpricevalue, 0, ',', '.');
        discountpricevalue = number_format(discountpricevalue, 0, ',', '.');

        console.log(nameproductvalue);
        console.log(sellpricevalue);

        if (nameproductvalue != undefined || nameproductvalue != null) {
            // document.getElementById('nameproduct').value = nameproductvalue;
            document.getElementById('stock_transactionproduct_sellprice').value = sellpricevalue;
            document.getElementById('stock_transactionproduct_discountprice').value = discountpricevalue;
        } else {
            // document.getElementById('nameproduct').value = '';
            document.getElementById('stock_transactionproduct_sellprice').value = '';
            document.getElementById('stock_transactionproduct_discountprice').value = '';
        }

        stock_transactionproduct_amount_onchange();

    };
    xhr.send(data);

    // console.log(document.getElementById('idproduct').value.split('-'));
}

function stock_transactionproduct_amount_onchange() {
    var amount = document.getElementById('stock_transactionproduct_amount');
    var remainingstock = document.getElementById('stock_transactionproduct_remainingstocklabel').innerHTML;
    remainingstock = remainingstock.substring(remainingstock.lastIndexOf(" ") + 1);

    if (parseInt(amount.value) < 1 || amount.value == '') {
        amount.value = 1;
    }

    if (parseInt(amount.value) > parseInt(remainingstock)) {
        amount.value = remainingstock;

        document.getElementById('stock_transactionproduct_amount_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_transactionproduct_amount_span').innerHTML = "Jumlah dijual tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('stock_transactionproduct_amount_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_transactionproduct_amount_span').innerHTML = "";

    }

    var previousamount = document.getElementById('stock_transactionproduct_previousamount');
    var sellprice = document.getElementById('stock_transactionproduct_sellprice');
    var discountprice = document.getElementById('stock_transactionproduct_discountprice');

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

function stock_transactionproduct_discount_onchange() {

var sellprice = document.getElementById('stock_transactionproduct_sellprice');
var discount = document.getElementById('stock_transactionproduct_discount');

if (discount.value < 0 || discount.value == '') {
    discount.value = 0;
}

var discountprice = document.getElementById('stock_transactionproduct_discountprice');
var sellpriceArray = sellprice.value.split(".");
var sellpricenumber = '';
var discountpricenumber = '';

sellpriceArray.forEach(price => {
    sellpricenumber = sellpricenumber + price;
});

discountpricenumber = sellpricenumber - (sellpricenumber * (discount.value / 100));
discountprice.value = number_format(discountpricenumber, 0, ',', '.');

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

function stock_transactionproduct_stock_amount_onchange() {
    if (document.getElementById('stock_transactionproduct_amount').value < 1) {
        document.getElementById('stock_transactionproduct_amount').value = '';
    }

    if (document.getElementById('stock_transactionproduct_amount').value > <?php echo $remainingstock?>) {
        document.getElementById('stock_transactionproduct_amount').value = <?php echo $remainingstock?>;

        document.getElementById('stock_transactionproduct_amount_form_group').setAttribute("class",
            "form-group has-error");
        document.getElementById('stock_transactionproduct_amount_span').innerHTML =
            "Jumlah produk tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('stock_transactionproduct_amount_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_transactionproduct_amount_span').innerHTML = "";
    }
}

function add_transactionproduct_validation(params) {
    var transactiondate = document.getElementById('stock_transactionproduct_transactiondate').value;

    var successArray = [false];
    var success = false;

    transactiondate == '' ?
        (
            document.getElementById('stock_transactionproduct_transactiondate_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_transactionproduct_transactiondate_span').innerHTML =
            "Harap isikan tanggal transaksi",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_transactionproduct_transactiondate_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_transactionproduct_transactiondate_span').innerHTML = "",
            successArray[0] = true
        );

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

function stock_transactionproduct_noenter(functionname) {
    // console.log(functioname);
    // console.log(!(window.event && window.event.keyCode == 13));

    if (window.event && window.event.keyCode == 13) {
        if (functionname == 'amount_onchange') {
            stock_transactionproduct_amount_onchange();
        } else if (functionname == 'discount_onchange') {
            stock_transactionproduct_discount_onchange();
        }
    }

    return !(window.event && window.event.keyCode == 13);
}
</script>