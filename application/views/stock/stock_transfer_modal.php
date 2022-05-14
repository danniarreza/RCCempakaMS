<div class="modal fade" id="modal-stock-transfer">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url('Stock/StockTransferAddHandler');?>" method="post"
                enctype="multipart/form-data" onsubmit="return add_stocktransfer_validation();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Stok Transfer</h4>
                </div>

                <div class="modal-body">

                    <div class="form-group" id="stock_transfer_id_form_group">
                        <label for="exampleInputEmail1">Kode Produk</label>
                        <input readOnly type="text" name="stock_transfer_id"
                            value="<?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?>"
                            id="stock_transfer_id" class="form-control" style="border-radius: 4px"
                            placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_transfer_id_span"></span>
                    </div>

                    <div class="form-group" id="stock_transfer_name_form_group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input readOnly type="text" name="stock_transfer_name"
                            value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_transfer_name"
                            class="form-control" style="border-radius: 4px" placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_transfer_name_span"></span>
                    </div>

                    <div class="form-group" id="stock_transfer_amount_form_group">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <label for="exampleInputEmail1">Jumlah Transfer</label>
                            </div>
                            <div style="text-align:right" class="col-md-3 col-sm-3 col-xs-3">
                                <label for="exampleInputEmail1">Sisa :
                                    <?php echo $remainingstock?></label>
                            </div>
                        </div>
                        <input oninput="stock_transfer_stock_amount_onchange()" type="number" name="stock_transfer_amount" value=""
                            id="stock_transfer_amount" class="form-control" style="border-radius: 4px"
                            placeholder="Contoh: ketik 10 atau bisa klik +/- di kanan ->">
                        <span class="help-block" id="stock_transfer_amount_span"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transfer_sendervendor_form_group">
                                <label>Dari</label>
                                <select class="form-control" name="stock_transfer_sendervendor"
                                    id="stock_transfer_sendervendor" style="width: 100%; border-radius: 4px">
                                    <option value=""> -- Pilih Transfer Dari --
                                    </option>
                                </select>
                                <span class="help-block" id="stock_transfer_sendervendor_span"></span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transfer_senderuser_form_group">
                                <label>Oleh</label>
                                <select class="form-control" name="stock_transfer_senderuser"
                                    id="stock_transfer_senderuser" style="width: 100%; border-radius: 4px">
                                    <option value="<?php echo $this->session->user_id?>" selected>
                                        <?php echo $this->session->user_name?>
                                    </option>
                                </select>
                                <span class="help-block" id="stock_transfer_senderuser_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transfer_receivervendor_form_group">
                                <label>Ke</label>
                                <select onchange="stock_transfer_receiveruser_list_request()" class="form-control"
                                    name="stock_transfer_receivervendor" id="stock_transfer_receivervendor"
                                    style="width: 100%; border-radius: 4px">
                                    <option value="" selected>-- Pilih Cabang --</option>
                                </select>
                                <span class="help-block" id="stock_transfer_receivervendor_span"></span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_transfer_receiveruser_form_group">
                                <label>Oleh</label>
                                <select class="form-control" name="stock_transfer_receiveruser"
                                    id="stock_transfer_receiveruser" style="width: 100%; border-radius: 4px">
                                    <!-- <option value="" selected>-- Pilih Penanggung Jawab --
                                                            </option> -->
                                    <?php
                                                            foreach ($userslist as $row) {
                                                                if ($row['ID_USER'] == 2) {
                                                                    ?>
                                    <option <?php echo ($row['ID_USER'] == 99) ? 'selected':''?>
                                        value="<?php echo $row['ID_USER'];?>">
                                        --</option>
                                    <?php
                                                                }
                                                            }
                                                            ?>
                                </select>
                                <span class="help-block" id="stock_transfer_receiveruser_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stock_transfer_entrydate_form_group">
                        <label>Tanggal Entry</label>
                        <div class="input-group date">
                            <div class="input-group-addon"
                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input readOnly type="text" name="stock_transfer_entrydate" id="stock_transfer_entrydate"
                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                class="form-control pull-right" value="<?php echo date('d M Y');?>">
                        </div>
                        <span class="help-block" id="stock_transfer_entrydate_span"></span>
                    </div>

                    <div class="form-group" id="stock_transfer_description_form_group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="exampleInputEmail1" id="stock_transfer_description_label">Keterangan</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                <label style="font-weight:100"
                                    id="stock_transfer_description_textlimit_label">100</label>
                            </div>
                        </div>
                        <input oninput="stock_description_onchange()" type="text" autocomplete="false"
                            name="stock_transfer_description" value="" id="stock_transfer_description"
                            class="form-control" style="border-radius: 4px"
                            placeholder="Isikan keterangan apabila perlu">
                        <span class="help-block" id="stock_transfer_description_span"></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="stock_transfer_submitbutton" class="btn btn-primary">Simpan
                        Stok Transfer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function add_stocktransfer_initialization() {
    stock_transfer_sendervendor_list_request();
    stock_transfer_receivervendor_list_request();
}

function stock_transfer_sendervendor_list_request() {
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
        var stock_transfer_sendervendor = document.getElementById('stock_transfer_sendervendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR == current_vendor) {
                str += "<option selected value='" + item.ID_VENDOR + "-" + item.NAME_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_transfer_sendervendor.innerHTML = str;
        // senderuser_list_request();

    };
    xhr.send(data);
}

function stock_transfer_receivervendor_list_request() {
    var data = new FormData();

    var method = 'POST';
    var url = "<?php echo site_url('Stock/vendorListRequest/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var items = JSON.parse(this.responseText);
        console.log(items);

        // var items = ["Apple", "Oranges", "Bananas"];
        var str = "";
        var stock_transfer_receivervendor = document.getElementById('stock_transfer_receivervendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR != current_vendor && item.TYPE_VENDOR == 'STORE') {
                str += "<option value='" + item.ID_VENDOR + "-" + item.NAME_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_transfer_receivervendor.innerHTML = str;
        stock_transfer_receiveruser_list_request();

    };
    xhr.send(data);
}

function stock_transfer_receiveruser_list_request() {
    var receivervendorselected = document.getElementById('stock_transfer_receivervendor').value;
    console.log(receivervendorselected);


    var vendorselected = receivervendorselected.split("-")[1];
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
        var str = "";
        for (var item of items) {
            str += "<option value='" + item.ID_USER + "'>" + item.NAME_USER + "</option>"
        }
        document.getElementById("stock_transfer_receiveruser").innerHTML = str;

    };
    xhr.send(data);

}

function stock_transfer_stock_amount_onchange() {
    if (document.getElementById('stock_transfer_amount').value < 1) {
        document.getElementById('stock_transfer_amount').value = '';
    }

    if (document.getElementById('stock_transfer_amount').value > <?php echo $remainingstock?>) {
        document.getElementById('stock_transfer_amount').value = <?php echo $remainingstock?>;

        document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_transfer_amount_span').innerHTML =
            "Jumlah transfer tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_transfer_amount_span').innerHTML = "";
    }
}

function add_stocktransfer_validation(params) {
    var id = document.getElementById('stock_transfer_id').value;
    var name = document.getElementById('stock_transfer_name').value;
    var amount = document.getElementById('stock_transfer_amount').value;
    var sendervendor = document.getElementById('stock_transfer_sendervendor').value;
    var senderuser = document.getElementById('stock_transfer_senderuser').value;
    var receivervendor = document.getElementById('stock_transfer_receivervendor').value;
    var receiveruser = document.getElementById('stock_transfer_receiveruser').value;
    var entrydate = document.getElementById('stock_transfer_entrydate').value;

    // console.log('Ini')
    // console.log(id);
    // console.log(name);
    // console.log(amount);
    // console.log(sendervendor);
    // console.log(senderuser);
    // console.log(receivervendor);
    // console.log(receiveruser);
    // console.log(entrydate);

    var successArray = [false, false, false, false, false, false];
    var success = false;

    amount == '' ?
        (
            document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_amount_span').innerHTML = "Harap masukkan jumlah stok masuk",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_amount_span').innerHTML = "",
            successArray[0] = true
        );

    amount == 0 ?
        (
            document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_amount_span').innerHTML = "Jumlah tidak boleh 0",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_transfer_amount_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_amount_span').innerHTML = "",
            successArray[0] = true
        );

    sendervendor == '' ?
        (
            document.getElementById('stock_transfer_sendervendor_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_sendervendor_span').innerHTML = "Harap pilih sumber stok masuk",
            successArray[1] = false

        ) :
        (
            document.getElementById('stock_transfer_sendervendor_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_sendervendor_span').innerHTML = "",
            successArray[1] = true
        );

    senderuser == '' ?
        (
            document.getElementById('stock_transfer_senderuser_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_senderuser_span').innerHTML = "Harap pilih pengirim stok masuk",
            successArray[2] = false

        ) :
        (
            document.getElementById('stock_transfer_senderuser_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_senderuser_span').innerHTML = "",
            successArray[2] = true
        );

    receivervendor == '' ?
        (
            document.getElementById('stock_transfer_receivervendor_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_receivervendor_span').innerHTML = "Harap pilih tujuan stok masuk",
            successArray[3] = false

        ) :
        (
            document.getElementById('stock_transfer_receivervendor_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_receivervendor_span').innerHTML = "",
            successArray[3] = true
        );

    receiveruser == '' ?
        (
            document.getElementById('stock_transfer_receiveruser_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_receiveruser_span').innerHTML = "Harap pilih penerima stok masuk",
            successArray[4] = false

        ) :
        (
            document.getElementById('stock_transfer_receiveruser_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_receiveruser_span').innerHTML = "",
            successArray[4] = true
        );

    entrydate == '' ?
        (
            document.getElementById('stock_transfer_entrydate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_transfer_entrydate_span').innerHTML = "Harap pilih penerima stok masuk",
            successArray[5] = false

        ) :
        (
            document.getElementById('stock_transfer_entrydate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_transfer_entrydate_span').innerHTML = "",
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