<div class="modal fade" id="modal-stock-repack">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url('Stock/stockRepackAddHandler');?>" method="post"
                enctype="multipart/form-data" onsubmit="return add_stockrepack_validation();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Stok Repack</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_repack_id_form_group">
                                <label for="exampleInputEmail1">Kode Produk Awal</label>
                                <input readOnly type="text" name="stock_repack_id"
                                    value="<?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?>"
                                    id="stock_repack_id" class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: Cream Malam ...">
                                <span class="help-block" id="stock_repack_id_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_repack_idrepack_form_group">
                                <label>Kode Produk Repack</label>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-5" style="padding-right:2.5px">
                                        <select onchange="typerepack_onchange()" class="form-control" name="stock_repack_typerepack"
                                            id="stock_repack_typerepack" style="width: 100%; border-radius: 4px">
                                            <option value="" selected>-- Pilih Kode Produk --
                                            </option>
                                        </select>
                                        <span class="help-block" id="stock_repack_typerepack_span"></span>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-7" style="padding-left:2.5px">
                                        <select onchange="idrepack_onchange()" class="form-control" name="stock_repack_idrepack"
                                            id="stock_repack_idrepack" style="width: 100%; border-radius: 4px">
                                            <option value="" selected>-- Pilih ID Produk --
                                            </option>
                                        </select>
                                        <span class="help-block" id="stock_repack_idrepack_span"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_repack_name_form_group">
                                <label for="exampleInputEmail1">Nama Produk Awal</label>
                                <input readOnly type="text" name="stock_repack_name"
                                    value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_repack_name"
                                    class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: Cream Malam ...">
                                <span class="help-block" id="stock_repack_name_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_repack_namerepack_form_group">
                                <label for="exampleInputEmail1">Nama Produk Repack</label>
                                <input readOnly type="text" name="stock_repack_namerepack"
                                    value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_repack_namerepack"
                                    class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: Cream Malam ...">
                                <span class="help-block" id="stock_repack_namerepack_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_repack_amount_form_group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Stock
                                            Awal</label>
                                    </div>
                                    <div style="text-align:right" class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Sisa :
                                            <?php echo $remainingstock?></label>
                                    </div>
                                </div>
                                <input oninput="stock_repack_amount_onchange()" type="number" step="0.05" min="0" name="stock_repack_amount"
                                    value="" id="stock_repack_amount" class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: ketik 10 atau bisa klik +/- ->">
                                <span class="help-block" id="stock_repack_amount_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_repack_amountrepack_form_group">
                                <label for="exampleInputEmail1">Jumlah Stok Repack</label>
                                <input oninput="stock_repack_amount_onchange()" type="number" step="0.05" min="0"
                                    name="stock_repack_amountrepack" value="" id="stock_repack_amountrepack" class="form-control"
                                    style="border-radius: 4px" placeholder="Contoh: ketik 10 atau bisa klik +/- ->">
                                <span class="help-block" id="stock_repack_amountrepack_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_repack_sendervendor_form_group">
                                <label>Di</label>
                                <select onchange="sendervendor_onchange()" class="form-control" name="stock_repack_sendervendor"
                                    id="stock_repack_sendervendor" style="width: 100%; border-radius: 4px">

                                </select>
                                <span class="help-block" id="stock_repack_sendervendor_span"></span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_repack_senderuser_form_group">
                                <label>Oleh</label>
                                <select class="form-control" name="stock_repack_senderuser" id="stock_repack_senderuser"
                                    style="width: 100%; border-radius: 4px">
                                    <option value="" selected>-- Pilih Penanggung Jawab --
                                    </option>

                                    <option value="<?php echo $row['ID_USER']; ?>">
                                        <?php echo $row['NAME_USER']; ?></option>
                                </select>
                                <span class="help-block" id="stock_repack_senderuser_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stock_repack_entrydate_form_group">
                        <label>Tanggal Entry</label>
                        <div class="input-group date">
                            <div class="input-group-addon"
                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input readOnly type="text" name="stock_repack_entrydate" id="stock_repack_entrydate"
                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                class="form-control pull-right" value="<?php echo date('d M Y');?>">
                        </div>
                        <span class="help-block" id="stock_repack_entrydate_span"></span>
                    </div>

                    <div class="form-group" id="stock_repack_description_form_group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="exampleInputEmail1"
                                    id="stock_repack_description_label">Keterangan</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                <label style="font-weight:100"
                                    id="stock_repack_description_textlimit_label">100</label>
                            </div>
                        </div>
                        <input oninput="stock_descriptionrepack_onchange()" type="text" autocomplete="false"
                            name="stock_repack_description" value="" id="stock_repack_description" class="form-control"
                            style="border-radius: 4px" placeholder="Isikan keterangan apabila perlu">
                        <span class="help-block" id="stock_repack_description_span"></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="stock_repack_submitbutton" class="btn btn-primary">Simpan
                        Stok Repack</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function add_stockrepack_initialization() {

    stock_repack_type_product_request();
    stock_repack_sendervendor_list_request();
    // typerepack_onchange();


}

function stock_repack_sendervendor_list_request() {
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
        var stock_repack_sendervendor = document.getElementById('stock_repack_sendervendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR == current_vendor) {
                str += "<option selected value='" + item.ID_VENDOR + "-" + item.NAME_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_repack_sendervendor.innerHTML = str;
        stock_repack_senderuser_list_request();

    };
    xhr.send(data);
}

function stock_repack_senderuser_list_request() {
    var sendervendorselected = document.getElementById('stock_repack_sendervendor').value;
    console.log(sendervendorselected);

    var vendorselected = sendervendorselected.split("-")[1];
    console.log(vendorselected);

    var data = new FormData();
    data.append('name_vendor', vendorselected);

    var method = 'POST';
    var url = "<?php echo site_url('TherapistAccess/therapistaccessListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);
        var current_userid = '<?php echo $this->session->user_id;?>';
        var str = "";
        for (var item of items) {
            if (item.ID_USER == current_userid) {
                str += "<option value='" + item.ID_USER + "'>" + item.NAME_USER + "</option>"
            }
        }
        document.getElementById("stock_repack_senderuser").innerHTML = str;

    };
    xhr.send(data);

}

function stock_repack_type_product_request() {
    var data = new FormData();

    var method = 'POST';
    var url = "<?php echo site_url('Product/productTypeRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        var str = "";
        var initialtype = document.getElementById('stock_repack_id').value.split('-')[0];

        // console.log(initialtype);
        for (var item of items) {
            if (initialtype == item.ID_PRODUCT_TYPE) {
                str += "<option selected value='" + item.ID_PRODUCT_TYPE + "'>" + item.ID_PRODUCT_TYPE + "</option>"
            } else {
                str += "<option value='" + item.ID_PRODUCT_TYPE + "'>" + item.ID_PRODUCT_TYPE + "</option>"
            }
        }
        document.getElementById("stock_repack_typerepack").innerHTML = str;

        typerepack_onchange();

    };
    xhr.send(data);
}

function typerepack_onchange() {

    var typerepack = document.getElementById('stock_repack_typerepack').value;
    var data = new FormData();
    data.append('type', typerepack);

    var method = 'POST';
    var url = "<?php echo site_url('Product/productByTypeRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        // var items = ["Apple", "Oranges", "Bananas"];
        var str = "";
        var initialproduct = document.getElementById('stock_repack_id').value;
        for (var item of items) {
            if (initialproduct != item.TYPE_PRODUCT + '-' + item.ID_PRODUCT) {
                str += "<option value='" + item.ID_PRODUCT + "-" + item.NAME_PRODUCT + "'>" + item.ID_PRODUCT +
                    " " +
                    item.NAME_PRODUCT + "</option>"
            }
        }
        document.getElementById("stock_repack_idrepack").innerHTML = str;

        idrepack_onchange();

    };
    xhr.send(data);
}

function idrepack_onchange() {
    // console.log(document.getElementById('idrepack').value.split('-'));
    var idrepack_value = document.getElementById('stock_repack_idrepack').value.split('-')[1];

    if (idrepack_value != undefined || idrepack_value != null) {
        document.getElementById('stock_repack_namerepack').value = idrepack_value;
    } else {
        document.getElementById('stock_repack_namerepack').value = '';
    }
}

function stock_repack_amount_onchange() {
    if (document.getElementById('stock_repack_amount').value < 1) {
        document.getElementById('stock_repack_amount').value = '';
    }

    if (document.getElementById('stock_repack_amount').value > <?php echo $remainingstock?>) {
        document.getElementById('stock_repack_amount').value = <?php echo $remainingstock?>;

        document.getElementById('stock_repack_amount_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_repack_amount_span').innerHTML =
            "Jumlah stok awal tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('stock_repack_amount_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_repack_amount_span').innerHTML = "";
    }

    // ----------------------------------------------------------------------------------------------------

    if (document.getElementById('stock_repack_amountrepack').value > 0 || document.getElementById(
            'stock_repack_amountrepack').value != '') {
        document.getElementById('stock_repack_amountrepack_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_repack_amountrepack_span').innerHTML = "";
    }
}

function stock_descriptionrepack_onchange() {
    var limit = 100;
    var descriptionrepack = document.getElementById('stock_repack_description');

    if (descriptionrepack.value.length > limit) {
        console.log(descriptionrepack.value.length);

        document.getElementById('stock_repack_description_textlimit_label').innerHTML = 0;

        descriptionrepack.value = descriptionrepack.value.substring(0, limit);

        document.getElementById('stock_repack_description_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_repack_description_span').innerHTML = "Melebihi batas 100 karakter!";
    } else if (descriptionrepack.value.length <= limit) {

        document.getElementById('stock_repack_description_textlimit_label').innerHTML = limit - descriptionrepack.value.length;

        document.getElementById('stock_repack_description_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_repack_description_span').innerHTML = "";
    }
}

function add_stockrepack_validation(params) {
    var id = document.getElementById('stock_repack_id').value;
    var typerepack = document.getElementById('stock_repack_typerepack').value;
    var idrepack = document.getElementById('stock_repack_idrepack').value;
    var name = document.getElementById('stock_repack_name').value;
    var namerepack = document.getElementById('stock_repack_namerepack').value;
    var amount = document.getElementById('stock_repack_amount').value;
    var amountrepack = document.getElementById('stock_repack_amountrepack').value;
    var sendervendor = document.getElementById('stock_repack_sendervendor').value;
    var senderuser = document.getElementById('stock_repack_senderuser').value;
    var receivervendor = sendervendor;
    var receiveruser = senderuser;
    var entrydate = document.getElementById('stock_repack_entrydate').value;

    // console.log('Ini')
    // console.log(id);
    // console.log(typerepack + '-' + idrepack.split("-")[0]);
    // console.log(name);
    // console.log(namerepack);
    // console.log('Ini amount');
    // console.log(amount);
    // console.log('Ini amount repack');
    // console.log(amountrepack);
    // console.log(sendervendor);
    // console.log(senderuser);
    // console.log(receivervendor);
    // console.log(receiveruser);
    // console.log(entrydate);

    var successArray = [false, false, false, false, false, false];
    var success = false;

    typerepack == '' ?
        (
            document.getElementById('stock_repack_idrepack_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_repack_idrepack_span').innerHTML = "Harap pilih kode produk repack",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_repack_idrepack_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_repack_idrepack_span').innerHTML = "",
            successArray[0] = true
        );

    amount == '' ?
        (
            document.getElementById('stock_repack_amount_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_repack_amount_span').innerHTML = "Harap masukkan jumlah stok awal",
            successArray[1] = false

        ) :
        (
            document.getElementById('stock_repack_amount_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_repack_amount_span').innerHTML = "",
            successArray[1] = true
        );

    amountrepack == '' ?
        (
            document.getElementById('stock_repack_amountrepack_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_repack_amountrepack_span').innerHTML = "Harap masukkan jumlah stok repack",
            successArray[2] = false

        ) :
        (
            document.getElementById('stock_repack_amountrepack_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_repack_amountrepack_span').innerHTML = "",
            successArray[2] = true
        );

    sendervendor == '' ?
        (
            document.getElementById('stock_repack_sendervendor_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_repack_sendervendor_span').innerHTML = "Harap pilih sumber stok masuk",
            successArray[3] = false

        ) :
        (
            document.getElementById('stock_repack_sendervendor_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_repack_sendervendor_span').innerHTML = "",
            successArray[3] = true
        );

    senderuser == '' ?
        (
            document.getElementById('stock_repack_senderuser_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_repack_senderuser_span').innerHTML = "Harap pilih pengirim stok masuk",
            successArray[4] = false

        ) :
        (
            document.getElementById('stock_repack_senderuser_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_repack_senderuser_span').innerHTML = "",
            successArray[4] = true
        );


    entrydate == '' ?
        (
            document.getElementById('stock_repack_entrydate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_repack_entrydate_span').innerHTML = "Harap masukkan tanggal entry",
            successArray[5] = false

        ) :
        (
            document.getElementById('stock_repack_entrydate_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_repack_entrydate_span').innerHTML = "",
            successArray[5] = true
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
</script>