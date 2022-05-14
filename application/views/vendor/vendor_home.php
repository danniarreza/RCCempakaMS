        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Vendor
                    <!-- <small>advanced tables</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('Vendor/')?>"><i class="fa fa-dashboard"></i>Vendor</a></li>
                    <li class="active">Daftar Vendor</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Daftar Vendor</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div>
                                    <button type="button" style="margin-bottom:10px" class="btn btn-success"
                                        data-toggle="modal" data-target="#modal-default">
                                        Tambah Vendor
                                        <!-- <i class="fa fa-plus-circle"></i> -->
                                    </button>
                                </div>

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form role="form" action="<?php echo site_url('Vendor/vendorAddHandler');?>"
                                                method="post" enctype="multipart/form-data"
                                                onsubmit="return add_vendor_validation();">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Tambah Vendor</h4>
                                                </div>

                                                <div class="modal-body">
                                                    <!-- <p>One fine body&hellip;</p> -->
                                                    <div class="form-group" id="name_form_group">
                                                        <label for="exampleInputEmail1">Nama Vendor</label>
                                                        <input type="text" name="name" id="name" class="form-control"
                                                            style="border-radius: 4px" id="exampleInputEmail1"
                                                            placeholder="Nama ...">
                                                        <span class="help-block" id="name_span"></span>
                                                    </div>

                                                    <div class="form-group" id="type_form_group">
                                                        <label>Jenis Vendor</label>
                                                        <select class="form-control" name="type" id="type"
                                                            style="width: 100%; border-radius: 4px">
                                                            <option value="STORE" selected="selected">Store</option>
                                                            <option value="SUPPLIER">Supplier</option>
                                                        </select>
                                                        <span class="help-block" id="type_span"></span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Vendor</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <div class="table-responsive">
                                    <table id="vendortable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Vendor</th>
                                                <th>Nama Vendor</th>
                                                <th>Tipe Vendor</th>
                                                <th>Detail</th>
                                                <th>Arsip</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                    foreach ($vendorslist as $row) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['ID_VENDOR']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['NAME_VENDOR']?>
                                                </td>
                                                <td>
                                                    <?php echo $row['TYPE_VENDOR']?>
                                                </td>
                                                <td>
                                                    <button type="submit" onclick="(
                                                            function(){
                                                                window.location.href = '<?php echo site_url('Vendor/vendorEditView/'.$row['ID_VENDOR'])?>';
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
                                                        var result = confirm('Apakah anda yakin ingin meng-arsip vendor ini?');
                                                        if(result == true){
                                                            // alert('Yakin!');
                                                            window.location.href = '<?php echo site_url('Vendor/vendorArchiveHandler/'.$row['ID_VENDOR'])?>';
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
                                                <th>Kode Cabang</th>
                                                <th>Nama Cabang</th>
                                                <th>Tipe Vendor</th>
                                                <th>Detail</th>
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
function add_vendor_validation() {
    var name = document.getElementById('name').value;
    var type = document.getElementById('type').value;

    var successArray = [false, false];
    var success = false;

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama vendor",
            successArray[0] = false

        ) :
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('name_span').innerHTML = "",
            successArray[0] = true
        );

    type == '' ?
        (
            document.getElementById('type_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('type_span').innerHTML = "Harap lengkapi jenis vendor",
            successArray[1] = false
        ) :
        (
            document.getElementById('type_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('type_span').innerHTML = "",
            successArray[1] = true
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