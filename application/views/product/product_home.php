        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Produk
                    <!-- <small>advanced tables</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('Product/')?>"><i class="fa fa-dashboard"></i> Produk</a></li>
                    <li class="active">Daftar Produk</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Daftar Produk</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div>
                                    <button onclick="type_product_onchange()" type="button" style="margin-bottom:10px"
                                        class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                        Tambah Produk
                                        <!-- <i class="fa fa-plus-circle"></i> -->
                                    </button>
                                </div>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form role="form"
                                                action="<?php echo site_url('Product/productAddHandler');?>"
                                                method="post" enctype="multipart/form-data"
                                                onsubmit="return add_product_validation();">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Tambah Produk</h4>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group" id="type_form_group">
                                                        <label>Jenis Produk</label>
                                                        <select onchange="type_product_onchange()" class="form-control"
                                                            name="type" id="type"
                                                            style="width: 100%; border-radius: 4px">
                                                            <option value="" selected>-- Pilih Jenis --</option>
                                                            <?php
                                                            foreach ($producttypeslist as $row) {
                                                                ?>
                                                            <option value="<?php echo $row['ID_PRODUCT_TYPE'];?>">
                                                                <?php echo $row['NAME_PRODUCT_TYPE'];?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="help-block" id="type_span"></span>
                                                    </div>

                                                    <div class="form-group" id="id_form_group">
                                                        <label for="exampleInputEmail1">Kode Produk</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                                                <!-- <i class="fa fa-calendar"></i> -->
                                                                <p id="id_p" style="font-size:12px; padding-top:4px;">
                                                                    <?php echo $producttypeslist[0]['ID_PRODUCT_TYPE']?>
                                                                </p>
                                                            </div>
                                                            <input readOnly onchange="number_formatter()"
                                                                oninput="product_duplicate_check('id')" type="text"
                                                                class="form-control" id="id"
                                                                placeholder="Contoh : 005 atau 015 ..." name="id"
                                                                value="">
                                                        </div>
                                                        <span class="help-block" id="id_span"></span>
                                                    </div>

                                                    <div class="form-group" id="name_form_group">
                                                        <label for="exampleInputEmail1">Nama</label>
                                                        <input oninput="product_duplicate_check('name')" type="text"
                                                            name="name" id="name" class="form-control"
                                                            style="border-radius: 4px" id="exampleInputEmail1"
                                                            placeholder="Contoh: Cream Malam ...">
                                                        <span class="help-block" id="name_span"></span>
                                                    </div>

                                                    <?php 
                                                    if ($this->session->user_type == 'Super Admin' || $this->session->user_type == 'Admin') {
                                                        ?>
                                                    <div class="form-group" id="capitalprice_form_group">
                                                        <label for="exampleInputEmail1">Harga Modal Produk</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                                                <!-- <i class="fa fa-calendar"></i> -->
                                                                <p style="font-size:12px; padding-top:4px;">Rp</p>
                                                            </div>
                                                            <input type="text" class="form-control" id="capitalprice"
                                                                placeholder="Contoh : 100000 atau 100.000"
                                                                name="capitalprice" value="">
                                                            <span class="input-group-addon"
                                                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                                        </div>
                                                        <span class="help-block" id="capitalprice_span"></span>
                                                    </div>

                                                    <?php
                                                    }
                                                    ?>

                                                    <div class="form-group" id="sellprice_form_group">
                                                        <label for="exampleInputEmail1">Harga Jual Produk</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"
                                                                style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                                                <!-- <i class="fa fa-calendar"></i> -->
                                                                <p style="font-size:12px; padding-top:4px;">Rp</p>
                                                            </div>
                                                            <input type="text" class="form-control" id="sellprice"
                                                                placeholder="Contoh : 100000 atau 100.000"
                                                                name="sellprice" value="">
                                                            <span class="input-group-addon"
                                                                style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                                        </div>
                                                        <span class="help-block" id="sellprice_span"></span>
                                                    </div>

                                                    <div class="form-group" id="description_form_group">
                                                        <label for="exampleInputEmail1">Deskripsi Produk</label>
                                                        <input type="text" name="description" id="description"
                                                            class="form-control" style="border-radius: 4px"
                                                            placeholder="Contoh : Cream malam ini digunakan untuk dst ...">
                                                        <span class="help-block" id="description_span"></span>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" id="submitbutton"
                                                        class="btn btn-primary">Simpan
                                                        Product</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="table-responsive">
                                    <table id="productcosmetictable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Tipe Produk</th>
                                                <th>Harga Satuan</th>
                                                <th>Edit</th>
                                                <th>Arsip</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    foreach ($productslist as $row) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['TYPE_PRODUCT'] . '-' . $row['ID_PRODUCT']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['NAME_PRODUCT']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['NAME_PRODUCT_TYPE']?>
                                                </td>
                                                <td>
                                                    <?php echo 'Rp ' . number_format($row['SELL_PRICE_PRODUCT'],2,",",".")?>
                                                </td>
                                                <td>
                                                    <button type="submit" onclick="(
                                                        function(){
                                                            window.location.href = '<?php echo site_url('Product/productEditView/'.$row['TYPE_PRODUCT'].'-'.$row['ID_PRODUCT'])?>';
                                                        }
                                                        )()" formtarget="_blank"
                                                        style="width:50%; margin-left: auto; margin-right:auto"
                                                        class="btn btn-block btn-primary btn-xs">
                                                        <i style="margin-left: auto; margin-right: auto"
                                                            class="fa fa-fw fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="(function(){
                                                        var result = confirm('Apakah anda yakin ingin meng-arsip produk ini?');
                                                        if(result == true){
                                                            // alert('Yakin!');
                                                            window.location.href = '<?php echo site_url('Product/productArchiveHandler/'.$row['TYPE_PRODUCT'].'-'.$row['ID_PRODUCT'])?>';
                                                        }
                                                    })()" style="width:50%; margin-left: auto; margin-right:auto"
                                                        class="btn btn-block btn-danger btn-xs">
                                                        <i class="fa fa-fw fa-archive"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                    }
                                    ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Tipe Produk</th>
                                                <th>Harga Satuan</th>
                                                <th>Edit</th>
                                                <th>Arsip</th>
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
function type_product_onchange() {
    if (document.getElementById('type').value != '') {
        document.getElementById('id').removeAttribute("readOnly");

        document.getElementById('id_p').innerHTML = document.getElementById('type').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                document.getElementById("id").value = this.responseText;

                product_duplicate_check('id');
                product_duplicate_check('name');
            }
        };
        xhttp.open("GET", "<?php echo site_url('Product/productLatestIdRequest/');?>" + document.getElementById('type')
            .value, true);
        xhttp.send();

    } else if (document.getElementById('type').value == '') {

        document.getElementById("id").value = "";
        document.getElementById("id_p").innerHTML = "";
        document.getElementById('id').setAttribute("readOnly", "true");

        product_duplicate_check('id');
        product_duplicate_check('name');
    }

}

function number_formatter() {
    var id = document.getElementById('id').value;
    if (id.length < 3) {
        var newid = id;
        console.log('start');
        for (let index = 0; index < 3 - id.length; index++) {
            newid = '0' + newid;
            console.log(newid);
        }
        // id = newid;
        document.getElementById('id').value = newid;
    }
}

function product_duplicate_check(input) {

    var data = new FormData();
    var method = 'POST';
    var url = "<?php echo site_url('Product/productDuplicateCheck/');?>";

    if (input == 'id') {
        var type = document.getElementById('type').value;
        var id = document.getElementById('id').value;

        data.append('input', input)
        data.append('type', type);
        data.append('id', id);
    } else if (input == 'name') {
        var name = document.getElementById('name').value;

        data.append('input', input)
        data.append('name', name);
    }

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        console.log(response);
        if (response[0]) {
            response = response[0];
            document.getElementById(input + '_form_group').setAttribute("class", "form-group has-error");
            document.getElementById(input + '_span').innerHTML = "Sudah ada produk " + response.TYPE_PRODUCT + "-" +
                response.ID_PRODUCT +
                " : " + response.NAME_PRODUCT + "";

            // document.getElementById('submitbutton').setAttribute('disabled', "true");

            return false;
        } else {
            document.getElementById(input + '_form_group').setAttribute("class", "form-group");
            document.getElementById(input + '_span').innerHTML = "";

            return true;

            // document.getElementById('submitbutton').removeAttribute('disabled');
        }
    };
    xhr.send(data);


}

function add_product_validation() {
    var type = document.getElementById('type').value;
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;

    if (document.getElementById('capitalprice') != null) {
        var capitalprice = document.getElementById('capitalprice').value;
        var capitalpricesplitarray = capitalprice.split(".");
        var capitalpricenumber = '';
        capitalpricesplitarray.forEach(element => {
            capitalpricenumber = capitalpricenumber + element;
        });
        var capitalprice_isnum = /^\d+$/.test(capitalpricenumber);

    }

    var sellprice = document.getElementById('sellprice').value;

    var sellpricesplitarray = sellprice.split(".");
    var sellpricenumber = '';

    sellpricesplitarray.forEach(element => {
        sellpricenumber = sellpricenumber + element;
    });
    var sellprice_isnum = /^\d+$/.test(sellpricenumber);
    var description = document.getElementById('description').value;

    var successArray = [false, false, false, false];
    var success = false;

    type == '' ?
        (
            document.getElementById('type_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('type_span').innerHTML = "Harap pilih jenis produk",
            successArray[0] = false

        ) :
        (
            document.getElementById('type_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('type_span').innerHTML = "",
            successArray[0] = true
        );

    id == '' ?
        (
            document.getElementById('id_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('id_span').innerHTML = "Harap lengkapi kode produk",
            successArray[1] = false

        ) :
        (
            product_duplicate_check('id') == false ?
            (
                successArray[1] = false
            ) :
            (
                document.getElementById('id_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('id_span').innerHTML = "",
                successArray[1] = true
            )
        );

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama produk",
            successArray[2] = false

        ) :
        (
            product_duplicate_check('name') == false ?
            (
                successArray[2] = false
            ) :
            (
                document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('name_span').innerHTML = "",
                successArray[2] = true
            )
        );

    sellprice == '' ?
        (
            document.getElementById('sellprice_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('sellprice_span').innerHTML = "Harap lengkapi harga jual produk",
            successArray[3] = false
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
                successArray[3] = false
            ) :
            (
                document.getElementById('sellprice_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('sellprice_span').innerHTML = "",
                successArray[3] = true
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
        </script>