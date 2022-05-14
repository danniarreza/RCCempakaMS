<div class="modal fade" id="modal-stock-expired">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url('Stock/StockExpiredAddHandler');?>" method="post"
                enctype="multipart/form-data" onsubmit="return add_stockexpired_validation();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="stock_expired_modaltitle"></h4>
                </div>

                <div class="modal-body">

                    <div class="form-group" id="stock_expired_expiredselect_form_group">
                        <label>Expired/Rusak</label>
                        <select onchange="stock_expired_select_onchange()" class="form-control"
                            name="stock_expired_expiredselect" id="stock_expired_expiredselect"
                            style="width: 100%; border-radius: 4px">
                            <option value="7-Expired" selected>Expired</option>
                            <option value="8-Rusak">Rusak</option>
                        </select>
                        <span class="help-block" id="stock_expired_expiredselect_span"></span>
                    </div>

                    <div class="form-group" id="stock_expired_id_form_group">
                        <label for="exampleInputEmail1">Kode Produk</label>
                        <input readOnly type="text" name="stock_expired_id"
                            value="<?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?>"
                            id="stock_expired_id" class="form-control" style="border-radius: 4px"
                            placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_expired_id_span"></span>
                    </div>

                    <div class="form-group" id="stock_expired_name_form_group">
                        <label for="exampleInputEmail1">Nama Produk</label>
                        <input readOnly type="text" name="stock_expired_name"
                            value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_expired_name"
                            class="form-control" style="border-radius: 4px" placeholder="Contoh: Cream Malam ...">
                        <span class="help-block" id="stock_expired_name_span"></span>
                    </div>

                    <div class="form-group" id="stock_expired_amount_form_group">
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <label for="exampleInputEmail1" id="stock_expired_amountlabel"></label>
                            </div>
                            <div style="text-align:right" class="col-md-3 col-sm-3 col-xs-3">
                                <label for="exampleInputEmail1">Sisa :
                                    <?php echo $remainingstock?></label>
                            </div>
                        </div>

                        <input oninput="stock_expired_amount_onchange()" type="number" name="stock_expired_amount" value=""
                            id="stock_expired_amount" class="form-control" style="border-radius: 4px" min="0"
                            placeholder="Contoh: ketik 10 atau bisa klik +/- di kanan ->">
                        <span class="help-block" id="stock_expired_amount_span"></span>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_expired_sendervendor_form_group">
                                <label>Dari</label>
                                <select onchange="sendervendor_onchange()" class="form-control"
                                    name="stock_expired_sendervendor" id="stock_expired_sendervendor"
                                    style="width: 100%; border-radius: 4px">
                                    <option value="" selected>-- Pilih Cabang --</option>

                                </select>
                                <span class="help-block" id="stock_expired_sendervendor_span"></span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group" id="stock_expired_senderuser_form_group">
                                <label>Oleh</label>
                                <select class="form-control" name="stock_expired_senderuser"
                                    id="stock_expired_senderuser" style="width: 100%; border-radius: 4px">

                                    <option value="<?php echo $this->session->user_id;?>">
                                        <?php echo $this->session->user_name;?></option>

                                </select>
                                <span class="help-block" id="stock_expired_senderuser_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stock_expired_entrydate_form_group">
                        <label>Tanggal Entry</label>
                        <div class="input-group date">
                            <div class="input-group-addon"
                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input readOnly type="text" name="stock_expired_entrydate" id="stock_expired_entrydate"
                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                class="form-control pull-right" value="<?php echo date('d M Y');?>">
                        </div>
                        <span class="help-block" id="stock_expired_entrydate_span"></span>
                    </div>

                    <div class="form-group" id="stock_expired_description_form_group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="exampleInputEmail1" id="stock_expired_description_label">Keterangan</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                <label style="font-weight:100"
                                    id="stock_expired_description_textlimit_label">100</label>
                            </div>
                        </div>
                        <input oninput="stock_expired_description_onchange()" type="text" autocomplete="false"
                            name="stock_expired_description" value="" id="stock_expired_description"
                            class="form-control" style="border-radius: 4px"
                            placeholder="Isikan keterangan apabila perlu">
                        <span class="help-block" id="stock_expired_description_span"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="stock_expired_submitbutton" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function add_stockexpired_initialization() {

    stock_expired_select_onchange();
    stock_expired_sendervendor_list_request();


}

function stock_expired_select_onchange() {

    var expiredselect = document.getElementById('stock_expired_expiredselect').value.split('-')[1];
    document.getElementById('stock_expired_modaltitle').innerHTML = 'Tambah Stok ' + expiredselect;
    document.getElementById('stock_expired_amountlabel').innerHTML = 'Jumlah ' + expiredselect;
    document.getElementById('stock_expired_submitbutton').innerHTML = 'Simpan Stok ' + expiredselect;

}

function stock_expired_sendervendor_list_request() {
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
        var stock_expired_sendervendor = document.getElementById('stock_expired_sendervendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR == current_vendor) {
                str += "<option selected value='" + item.ID_VENDOR + "-" + item.NAME_VENDOR + "-" + item
                    .TYPE_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_expired_sendervendor.innerHTML = str;
        // stock_recycle_senderuser_list_request();

    };
    xhr.send(data);
}

function add_stockexpired_validation() {
    var expiredselect = document.getElementById('stock_expired_expiredselect').value;
    var id = document.getElementById('stock_expired_id').value;
    var name = document.getElementById('stock_expired_name').value;
    var amount = document.getElementById('stock_expired_amount').value;
    var sendervendor = document.getElementById('stock_expired_sendervendor').value;
    var senderuser = document.getElementById('stock_expired_senderuser').value;
    var entrydate = document.getElementById('stock_expired_entrydate').value;

    console.log('Ini')
    console.log(expiredselect);
    console.log(id);
    console.log(name);
    console.log(amount);
    console.log(sendervendor);
    console.log(senderuser);
    // console.log(receivervendor);
    // console.log(receiveruser);
    console.log(entrydate);

    var successArray = [false, false, false, false];
    var success = false;

    amount == '' ?
        (
            document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_expired_amount_span').innerHTML = "Harap masukkan jumlah stok masuk",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_expired_amount_span').innerHTML = "",
            successArray[0] = true
        );

    amount == 0 ?
        (
            document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_expired_amount_span').innerHTML = "Jumlah tidak boleh 0",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_expired_amount_span').innerHTML = "",
            successArray[0] = true
        );

    sendervendor == '' ?
        (
            document.getElementById('stock_expired_sendervendor_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_expired_sendervendor_span').innerHTML = "Harap pilih sumber stok masuk",
            successArray[1] = false

        ) :
        (
            document.getElementById('stock_expired_sendervendor_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_expired_sendervendor_span').innerHTML = "",
            successArray[1] = true
        );

    senderuser == '' ?
        (
            document.getElementById('stock_expired_senderuser_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_expired_senderuser_span').innerHTML = "Harap pilih pengirim stok masuk",
            successArray[2] = false

        ) :
        (
            document.getElementById('stock_expired_senderuser_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_expired_senderuser_span').innerHTML = "",
            successArray[2] = true
        );

    entrydate == '' ?
        (
            document.getElementById('stock_expired_entrydate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_expired_entrydate_span').innerHTML = "Harap pilih penerima stok masuk",
            successArray[3] = false

        ) :
        (
            document.getElementById('stock_expired_entrydate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('stock_expired_entrydate_span').innerHTML = "",
            successArray[3] = true
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

function stock_expired_amount_onchange() {
    if (document.getElementById('stock_expired_amount').value < 1) {
        document.getElementById('stock_expired_amount').value = '';
    }

    if (document.getElementById('stock_expired_amount').value > <?php echo $remainingstock?>) {
        document.getElementById('stock_expired_amount').value = <?php echo $remainingstock?>;

        document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_expired_amount_span').innerHTML = "Jumlah transfer tidak bisa melebihi sisa stok";
    } else {
        document.getElementById('stock_expired_amount_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_expired_amount_span').innerHTML = "";
    }
}

function stock_expired_description_onchange() {

// console.log(document.getElementById('description').value.length);
var limit = 100;
var description = document.getElementById('stock_expired_description');

if (description.value.length > limit) {
    console.log(description.value.length);

    document.getElementById('stock_expired_description_textlimit_label').innerHTML = 0;

    description.value = description.value.substring(0, limit);

    document.getElementById('stock_expired_description_form_group').setAttribute("class", "form-group has-error");
    document.getElementById('stock_expired_description_span').innerHTML = "Melebihi batas 100 karakter!";
} else if (description.value.length <= limit) {

    document.getElementById('stock_expired_description_textlimit_label').innerHTML = limit - description.value.length;

    document.getElementById('stock_expired_description_form_group').setAttribute("class", "form-group");
    document.getElementById('stock_expired_description_span').innerHTML = "";
}

}
</script>