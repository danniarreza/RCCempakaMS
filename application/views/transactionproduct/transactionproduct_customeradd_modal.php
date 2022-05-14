<div class="modal fade" id="modal-customer-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Pelanggan</h4>
            </div>

            <div class="modal-body">
                <!-- <p>One fine body&hellip;</p> -->
                <div class="form-group" id="customeradd_name_form_group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" id="customeradd_name" class="form-control" style="border-radius: 4px"
                        id="customeradd_exampleInputEmail1" placeholder="Nama ...">
                    <span class="help-block" id="customeradd_name_span"></span>
                </div>

                <div class="form-group" id="customeradd_gender_form_group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="gender" id="customeradd_gender"
                        style="width: 100%; border-radius: 4px">
                        <option value="F" selected="selected">Perempuan</option>
                        <option value="M">Laki-Laki</option>
                    </select>
                    <span class="help-block" id="customeradd_gender_span"></span>
                </div>

                <div class="form-group" id="customeradd_birthdate_form_group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group date">
                        <div class="input-group-addon"
                            style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="birthdate" id="customeradd_birthdate"
                            style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                            class="form-control pull-right">
                    </div>
                    <span class="help-block" id="customeradd_birthdate_span"></span>
                </div>

                <div class="form-group" id="customeradd_address_form_group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="address" id="customeradd_address" class="form-control"
                        style="border-radius: 4px;" id="customeradd_exampleInputEmail1" placeholder="Alamat ...">
                    <span class="help-block" id="customeradd_address_span"></span>
                </div>

                <div class="form-group" id="customeradd_notelp_form_group">
                    <label for="exampleInputEmail1">Nomor Telepon</label>
                    <input type="number" name="notelp" id="customeradd_notelp" class="form-control"
                        style="border-radius: 4px;" id="customeradd_exampleInputEmail1" placeholder="Nomor Telepon ...">
                    <span class="help-block" id="customeradd_notelp_span"></span>
                </div>

                <!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="add_customer_validation()" type="submit" id="submit_button"
                    class="btn btn-primary">Simpan
                    Pelanggan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
function add_customer_validation() {

    var submit_button = document.getElementById('submit_button');
    submit_button.innerHTML = '<i class="fa fa-spin fa-refresh">';
    submit_button.setAttribute("disabled", "disabled");

    var name = document.getElementById('customeradd_name').value;
    var gender = document.getElementById('customeradd_gender').value;
    var birthdate = document.getElementById('customeradd_birthdate').value;
    var address = document.getElementById('customeradd_address').value;
    var notelp = document.getElementById('customeradd_notelp').value;

    var successArray = [false, false, false, false, false];
    var success = false;

    name == '' ?
        (
            document.getElementById('customeradd_name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('customeradd_name_span').innerHTML = "Harap lengkapi nama pelanggan",
            successArray[0] = false

        ) :
        (
            document.getElementById('customeradd_name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('customeradd_name_span').innerHTML = "",
            successArray[0] = true
        );

    gender == '' ?
        (
            document.getElementById('customeradd_gender_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('customeradd_gender_span').innerHTML = "Harap lengkapi jenis kelamin pelanggan",
            successArray[1] = false
        ) :
        (
            document.getElementById('customeradd_gender_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('customeradd_gender_span').innerHTML = "",
            successArray[1] = true
        );

    birthdate == '' ?
        (
            // document.getElementById('customeradd_birthdate_form_group').setAttribute("class", "form-group has-error"),
            // document.getElementById('customeradd_birthdate_span').innerHTML = "Harap lengkapi tanggal lahir pelanggan",
            // successArray[2] = false
            successArray[2] = true
        ) :
        (
            document.getElementById('customeradd_birthdate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('customeradd_birthdate_span').innerHTML = "",
            successArray[2] = true
        );

    address == '' ?
        (
            document.getElementById('customeradd_address_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('customeradd_address_span').innerHTML = "Harap lengkapi alamat pelanggan",
            successArray[3] = false
        ) :
        (
            document.getElementById('customeradd_address_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('customeradd_address_span').innerHTML = "",
            successArray[3] = true
        );

    notelp == '' ?
        (
            document.getElementById('customeradd_notelp_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('customeradd_notelp_span').innerHTML = "Harap lengkapi nomor telepon pelanggan",
            successArray[4] = false
        ) :
        (
            document.getElementById('customeradd_notelp_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('customeradd_address_span').innerHTML = "",
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
    // return success;

    if (success == true) {
        console.log('Berhasil!');

        var data = new FormData();
        data.append('name', name);
        data.append('gender', gender);
        data.append('birthdate', birthdate);
        data.append('address', address);
        data.append('notelp', notelp);
        data.append('source', 'api');

        var method = 'POST';
        var url = "<?php echo site_url('Customer/customerAddHandler/');?>";

        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.onload = function() {
            // var items = JSON.parse(this.responseText);
            // console.log(this.responseText);
            var result = this.responseText;
            if (result > 0) {
                $(function() {
                    $('#modal-customer-add').modal('hide');
                });

                document.getElementById('customeradd_name').value = '';
                document.getElementById('customeradd_gender').value = '';
                document.getElementById('customeradd_birthdate').value = '';
                document.getElementById('customeradd_address').value = '';
                document.getElementById('customeradd_notelp').value = '';


                document.getElementById('customeradd_name_form_group').setAttribute("class",
                    "form-group has-success");
                document.getElementById('customeradd_name_span').innerHTML = "";

                document.getElementById('customeradd_gender_form_group').setAttribute("class",
                    "form-group has-success");
                document.getElementById('customeradd_gender_span').innerHTML = "";

                document.getElementById('customeradd_birthdate_form_group').setAttribute("class",
                    "form-group has-success");
                document.getElementById('customeradd_birthdate_span').innerHTML = "";

                document.getElementById('customeradd_address_form_group').setAttribute("class",
                    "form-group has-success");
                document.getElementById('customeradd_address_span').innerHTML = "";

                document.getElementById('customeradd_notelp_form_group').setAttribute("class",
                    "form-group has-success");
                document.getElementById('customeradd_address_span').innerHTML = "";

                customeradd_customer_list_request();
            }

        };
        xhr.send(data);


    } else if (success == false) {
        console.log('Gagal!');
    }

    submit_button.innerHTML = 'Simpan Pelanggan';
    submit_button.removeAttribute('disabled');

}

function customeradd_customer_list_request() {
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
        var customer = document.getElementById('customer');

        for (var item of items) {

            str += "<option value='" + item.ID_CUSTOMER + "'>" +
                item.NAME_CUSTOMER + " - " + item.ADDRESS_CUSTOMER + "</option>"

        }
        customer.innerHTML = str;
    };
    xhr.send(data);
}

function ngeng() {
    // $('modal-customer-add').modal('hide');
    $(function() {
        // $(".custom-close").on('click', function() {
        $('#modal-customer-add').modal('hide');
        // });
    });
}
</script>