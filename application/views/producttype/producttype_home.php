        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Produk
                    <!-- <small>advanced tables</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('ProductType/')?>"><i class="fa fa-dashboard"></i> Produk</a></li>
                    <li class="active">Jenis Produk</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Jenis Produk</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div>
                                    <button type="button" style="margin-bottom:10px" class="btn btn-success"
                                        data-toggle="modal" data-target="#modal-default">
                                        Tambah Jenis Produk
                                        <!-- <i class="fa fa-plus-circle"></i> -->
                                    </button>
                                </div>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form role="form"
                                                action="<?php echo site_url('ProductType/producttypeAddHandler');?>"
                                                method="post" enctype="multipart/form-data"
                                                onsubmit="return add_producttype_validation();">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Tambah Jenis Produk</h4>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- <p>One fine body&hellip;</p> -->

                                                    <div class="form-group" id="id_form_group">
                                                        <label for="exampleInputEmail1">Kode Jenis Produk</label>
                                                        <input type="text" name="id" id="id" class="form-control"
                                                            style="border-radius: 4px"
                                                            placeholder="Contoh : D, B, M ...">
                                                        <span class="help-block" id="id_span"></span>
                                                    </div>

                                                    <div class="form-group" id="name_form_group">
                                                        <label for="exampleInputEmail1">Jenis Produk</label>
                                                        <input type="text" name="name" id="name" class="form-control"
                                                            style="border-radius: 4px"
                                                            placeholder="Contoh : Depan, Belakang, Masker ...">
                                                        <span class="help-block" id="name_span"></span>
                                                    </div>

                                                    <div class="form-group" id="description_form_group">
                                                        <label for="exampleInputEmail1">Deskripsi Jenis Produk</label>
                                                        <input type="text" name="description" id="description"
                                                            class="form-control" style="border-radius: 4px"
                                                            placeholder="Contoh : M digunakan untuk produk masker dkk ...">
                                                        <span class="help-block" id="description_span"></span>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Jenis Produk</button>
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
                                                <th>Kode Jenis Produk</th>
                                                <th>Nama Jenis Produk</th>
                                                <th>Deskripsi Jenis Produk</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Arsip</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    foreach ($producttypeslist as $row) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['ID_PRODUCT_TYPE']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['NAME_PRODUCT_TYPE']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['DESCRIPTION_PRODUCT_TYPE'] == '' ? '* Belum tersedia *' : $row['DESCRIPTION_PRODUCT_TYPE'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['STATUS_PRODUCT_TYPE']?>
                                                </td>
                                                <td>
                                                    <button type="submit" onclick="(
                                                            function(){
                                                                window.location.href = '<?php echo site_url('ProductType/producttypeEditView/'.$row['ID_PRODUCT_TYPE'])?>';
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
                                                        var result = confirm('Apakah anda yakin ingin meng-arsip jenis produk ini?');
                                                        if(result == true){
                                                            // alert('Yakin!');
                                                            window.location.href = '<?php echo site_url('ProductType/producttypeArchiveHandler/'.$row['ID_PRODUCT_TYPE'])?>';
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
                                                <th>Kode Jenis Produk</th>
                                                <th>Nama Jenis Produk</th>
                                                <th>Deskripsi Jenis Produk</th>
                                                <th>Status</th>
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
function add_producttype_validation() {
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;

    var successArray = [false, false, false];
    var success = false;

    id == '' ?
        (
            document.getElementById('id_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('id_span').innerHTML = "Harap lengkapi kode jenis produk",
            successArray[1] = false
        ) :
        (
            document.getElementById('id_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('id_span').innerHTML = "",
            successArray[1] = true
        );

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama jenis produk",
            successArray[0] = false

        ) :
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('name_span').innerHTML = "",
            successArray[0] = true
        );


    description == '' ?
        (
            document.getElementById('description_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('description_span').innerHTML = "Harap lengkapi deskripsi jenis produk",
            successArray[2] = false
        ) :
        (
            document.getElementById('description_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('description_span').innerHTML = "",
            successArray[2] = true
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