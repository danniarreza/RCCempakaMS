<div class="modal fade" id="modal-stock-recycle">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?php echo site_url('Stock/stockRecycleAddHandler');?>" method="post"
                enctype="multipart/form-data" onsubmit="return add_stockrecycle_validation();">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Stok Menyusut</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_recycle_id_form_group">
                                <label for="exampleInputEmail1">Kode Produk</label>
                                <input readOnly type="text" name="stock_recycle_id"
                                    value="<?php echo $contenttitle['TYPE_PRODUCT'] . '-' . $contenttitle['ID_PRODUCT']?>"
                                    id="stock_recycle_id" class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: Cream Malam ...">
                                <span class="help-block" id="stock_recycle_id_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_recycle_name_form_group">
                                <label for="exampleInputEmail1">Nama Produk</label>
                                <input readOnly type="text" name="stock_recycle_name"
                                    value="<?php echo $contenttitle['NAME_PRODUCT']?>" id="stock_recycle_name"
                                    class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: Cream Malam ...">
                                <span class="help-block" id="stock_recycle_name_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_recycle_amountinitial_form_group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Stock
                                            Menyusut</label>
                                    </div>
                                    <div style="text-align:right" class="col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Sisa :
                                            <?php echo $remainingstock?></label>
                                    </div>
                                </div>
                                <input oninput="stock_recycle_amount_onchange()" type="number" step="0.05" min="0"
                                    name="stock_recycle_amountinitial" value="" id="stock_recycle_amountinitial"
                                    class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: ketik 10 atau bisa klik +/- ->">
                                <span class="help-block" id="stock_recycle_amountinitial_span"></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_recycle_amountresult_form_group">
                                <label for="exampleInputEmail1">Hasil Menyusut</label>
                                <input oninput="stock_recycle_amount_onchange()" type="number" step="0.05" min="0"
                                    name="stock_recycle_amountresult" value="" id="stock_recycle_amountresult"
                                    class="form-control" style="border-radius: 4px"
                                    placeholder="Contoh: ketik 0.1 atau bisa klik +/- ->">
                                <span class="help-block" id="stock_recycle_amountresult_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-right:10px">
                            <div class="form-group" id="stock_recycle_sendervendor_form_group">
                                <label>Di</label>
                                <select onchange="stock_recycle_senderuser_list_request()" class="form-control"
                                    name="stock_recycle_sendervendor" id="stock_recycle_sendervendor"
                                    style="width: 100%; border-radius: 4px">

                                </select>
                                <span class="help-block" id="stock_recycle_sendervendor_span"></span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left:10px">
                            <div class="form-group" id="stock_recycle_senderuser_form_group">
                                <label>Oleh</label>
                                <select class="form-control" name="stock_recycle_senderuser"
                                    id="stock_recycle_senderuser" style="width: 100%; border-radius: 4px">
                                    <option value="" selected>-- Pilih Penanggung Jawab --
                                    </option>
                                    
                                </select>
                                <span class="help-block" id="stock_recycle_senderuser_span"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="stock_recycle_entrydate_form_group">
                        <label>Tanggal Entry</label>
                        <div class="input-group date">
                            <div class="input-group-addon"
                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input readOnly type="text" name="stock_recycle_entrydate" id="stock_recycle_entrydate"
                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                class="form-control pull-right" value="<?php echo date('d M Y');?>">
                        </div>
                        <span class="help-block" id="stock_recycle_entrydate_span"></span>
                    </div>

                    <div class="form-group" id="stock_recycle_description_form_group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label for="exampleInputEmail1"
                                    id="stock_recycle_description_label">Keterangan</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6" style="text-align: right;">
                                <label style="font-weight:100"
                                    id="stock_recycle_description_textlimit_label">100</label>
                            </div>
                        </div>
                        <input oninput="stock_recycle_description_onchange()" type="text" autocomplete="false"
                            name="stock_recycle_description" value="" id="stock_recycle_description"
                            class="form-control" style="border-radius: 4px"
                            placeholder="Isikan keterangan apabila perlu">
                        <span class="help-block" id="stock_recycle_description_span"></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="stock_recycle_submitbutton" class="btn btn-primary">Simpan
                        Stok Menyusut</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
function add_stockrecycle_initialization() {
    stock_recycle_sendervendor_list_request();
}

function stock_recycle_sendervendor_list_request() {
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
        var stock_recycle_sendervendor = document.getElementById('stock_recycle_sendervendor');
        var current_vendor = '<?php echo $name_vendor;?>';
        for (var item of items) {
            if (item.NAME_VENDOR == current_vendor) {
                str += "<option selected value='" + item.ID_VENDOR + "-" + item.NAME_VENDOR + "'>" +
                    item.NAME_VENDOR + "</option>"
            }
        }
        stock_recycle_sendervendor.innerHTML = str;
        stock_recycle_senderuser_list_request();

    };
    xhr.send(data);
}

function stock_recycle_senderuser_list_request() {
    var sendervendorselected = document.getElementById('stock_recycle_sendervendor').value;
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
        document.getElementById("stock_recycle_senderuser").innerHTML = str;

    };
    xhr.send(data);

}

function stock_recycle_amount_onchange() {
    if (document.getElementById('stock_recycle_amountinitial').value < 1) {
        document.getElementById('stock_recycle_amountinitial').value = '';
    }

    if (document.getElementById('stock_recycle_amountinitial').value > <?php echo $remainingstock?>) {
        document.getElementById('stock_recycle_amountinitial').value = <?php echo $remainingstock?>;

        document.getElementById('stock_recycle_amountinitial_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_recycle_amountinitial_span').innerHTML =
            "Jumlah stok awal tidak bisa melebihi sisa stok";
        console.log('Lho!');
    } else {
        document.getElementById('stock_recycle_amountinitial_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_recycle_amountinitial_span').innerHTML = "";
    }

    // ----------------------------------------------------------------------------------------------------

    // if (document.getElementById('stock_recycle_amountinitial').value > 0 || document.getElementById(
    //         'stock_recycle_amountinitial').value != '') {
    //     document.getElementById('stock_recycle_amountinitial_form_group').setAttribute("class", "form-group");
    //     document.getElementById('stock_recycle_amountinitial_span').innerHTML = "";
    // }
}

function stock_recycle_description_onchange() {
    var limit = 100;
    var stock_recycle_description = document.getElementById('stock_recycle_description');

    if (stock_recycle_description.value.length > limit) {
        console.log(stock_recycle_description.value.length);

        document.getElementById('stock_recycle_description_textlimit_label').innerHTML = 0;

        stock_recycle_description.value = stock_recycle_description.value.substring(0, limit);

        document.getElementById('stock_recycle_description_form_group').setAttribute("class", "form-group has-error");
        document.getElementById('stock_recycle_description_span').innerHTML = "Melebihi batas 100 karakter!";
    } else if (stock_recycle_description.value.length <= limit) {

        document.getElementById('stock_recycle_description_textlimit_label').innerHTML = limit - stock_recycle_description.value
            .length;

        document.getElementById('stock_recycle_description_form_group').setAttribute("class", "form-group");
        document.getElementById('stock_recycle_description_span').innerHTML = "";
    }
}

function add_stockrecycle_validation(params) {
    var idrecycle = document.getElementById('stock_recycle_id').value;
    var namerecycle = document.getElementById('stock_recycle_name').value;
    var amountinitial = document.getElementById('stock_recycle_amountinitial').value;
    var amountresult = document.getElementById('stock_recycle_amountresult').value;
    var sendervendorrecycle = document.getElementById('stock_recycle_sendervendor').value;
    var senderuserrecycle = document.getElementById('stock_recycle_senderuser').value;
    var receivervendorrecycle = sendervendorrecycle;
    var receiveruserrecycle = senderuserrecycle;
    var entrydate = document.getElementById('stock_recycle_entrydate').value;

    console.log('Ini')
    console.log(idrecycle);
    console.log(namerecycle);
    console.log(amountinitial);
    console.log(amountresult);
    console.log(sendervendorrecycle);
    console.log(senderuserrecycle);
    console.log(receivervendorrecycle);
    console.log(receiveruserrecycle);
    console.log(entrydate);

    var successArray = [false, false, false, false, false];
    var success = false;

    amountinitial == '' ?
        (
            document.getElementById('stock_recycle_amountinitial_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_recycle_amountinitial_span').innerHTML = "Harap masukkan jumlah stok masuk",
            successArray[0] = false

        ) :
        (
            document.getElementById('stock_recycle_amountinitial_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_recycle_amountinitial_span').innerHTML = "",
            successArray[0] = true
        );

    amountresult == '' ?
        (
            document.getElementById('stock_recycle_amountresult_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_recycle_amountresult_span').innerHTML = "Harap masukkan jumlah stok masuk",
            successArray[1] = false

        ) :
        (
            document.getElementById('stock_recycle_amountresult_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_recycle_amountresult_span').innerHTML = "",
            successArray[1] = true
        );

    sendervendorrecycle == '' ?
        (
            document.getElementById('stock_recycle_sendervendor_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_recycle_sendervendor_span').innerHTML = "Harap pilih sumber stok masuk",
            successArray[2] = false

        ) :
        (
            document.getElementById('stock_recycle_sendervendor_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_recycle_sendervendor_span').innerHTML = "",
            successArray[2] = true
        );

    senderuserrecycle == '' ?
        (
            document.getElementById('stock_recycle_senderuser_form_group').setAttribute("class",
                "form-group has-error"),
            document.getElementById('stock_recycle_senderuser_span').innerHTML = "Harap pilih pengirim stok masuk",
            successArray[3] = false

        ) :
        (
            document.getElementById('stock_recycle_senderuser_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_recycle_senderuser_span').innerHTML = "",
            successArray[3] = true
        );


    entrydate == '' ?
        (
            document.getElementById('stock_recycle_entrydate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('stock_recycle_entrydate_span').innerHTML = "Harap pilih penerima stok masuk",
            successArray[4] = false

        ) :
        (
            document.getElementById('stock_recycle_entrydate_form_group').setAttribute("class",
                "form-group has-success"),
            document.getElementById('stock_recycle_entrydate_span').innerHTML = "",
            successArray[4] = true
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