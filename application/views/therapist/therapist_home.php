<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Therapist
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Therapist/')?>"><i class="fa fa-dashboard"></i>Therapist</a></li>
            <li class="active">Daftar Therapist</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Therapist</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div>
                            <button type="button" style="margin-bottom:10px" class="btn btn-success" data-toggle="modal"
                                data-target="#modal-default">
                                Tambah Therapist
                                <!-- <i class="fa fa-plus-circle"></i> -->
                            </button>
                        </div>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form role="form" action="<?php echo site_url('Therapist/therapistAddHandler');?>"
                                        method="post" enctype="multipart/form-data"
                                        onsubmit="return add_therapist_validation();">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Tambah Therapist</h4>
                                        </div>

                                        <div class="modal-body">
                                            <!-- <p>One fine body&hellip;</p> -->
                                            <div class="form-group" id="name_form_group">
                                                <label for="exampleInputEmail1">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    style="border-radius: 4px" id="exampleInputEmail1"
                                                    placeholder="Nama ...">
                                                <span class="help-block" id="name_span"></span>
                                            </div>

                                            <!-- <div class="form-group" id="workingsince_form_group">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control" name="workingsince" id="workingsince"
                                                    style="width: 100%; border-radius: 4px">
                                                    <option value="F" selected="selected">Perempuan</option>
                                                    <option value="M">Laki-Laki</option>
                                                </select>
                                                <span class="help-block" id="workingsince_span"></span>
                                            </div> -->

                                            <div class="form-group" id="birthdate_form_group">
                                                <label>Tanggal Lahir</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon"
                                                        style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="birthdate" id="birthdate"
                                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                                        class="form-control pull-right">
                                                </div>
                                                <span class="help-block" id="birthdate_span"></span>
                                            </div>

                                            <div class="form-group" id="notelp_form_group">
                                                <label for="exampleInputEmail1">Nomor Telepon</label>
                                                <input type="text" name="notelp" id="notelp" class="form-control"
                                                    style="border-radius: 4px;" id="exampleInputEmail1"
                                                    placeholder="Nomor Telepon ...">
                                                <span class="help-block" id="notelp_span"></span>
                                            </div>

                                            <div class="form-group" id="workingsince_form_group">
                                                <label>Tanggal Mulai Bekerja</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon"
                                                        style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" name="workingsince" id="workingsince"
                                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                                        class="form-control pull-right">
                                                </div>
                                                <span class="help-block" id="workingsince_span"></span>
                                            </div>

                                            <div class="form-group" id="address_form_group">
                                                <label for="exampleInputEmail1">Alamat</label>
                                                <input type="text" name="address" id="address" class="form-control"
                                                    style="border-radius: 4px;" id="exampleInputEmail1"
                                                    placeholder="Alamat ...">
                                                <span class="help-block" id="address_span"></span>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="exampleInputFile">File input</label>
                                                <input type="file" id="exampleInputFile">

                                                <p class="help-block">Example block-level help text here.
                                                </p>
                                            </div> -->
                                            <!-- <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Check me out
                                                </label>
                                            </div> -->
                                            <!-- /.box-body -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Simpan
                                                Therapist</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <div class="table-responsive">
                            <table id="therapisttable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Therapist</th>
                                        <th>Nama Therapist</th>
                                        <th>Alamat Therapist</th>
                                        <th>No Telp Therapist</th>
                                        <th>Detail</th>
                                        <th>Arsip</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($therapistslist as $row) {
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['ID_USER']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_USER']?>
                                        </td>
                                        <td>
                                            <?php echo $row['ADDRESS_USER']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NOTELP_USER']?>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                onclick="(function(){window.location.href = '<?php echo site_url('Therapist/therapistEditView/'.$row['ID_USER'])?>';})()"
                                                formtarget="_blank"
                                                style="width:50%; margin-left: auto; margin-right:auto"
                                                class="btn btn-block btn-primary btn-xs">
                                                <i style="margin-left: auto; margin-right: auto"
                                                    class="fa fa-fw fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" onclick="(function(){
                                                        var result = confirm('Apakah anda yakin ingin meng-arsip pelanggan ini?');
                                                        if(result == true){
                                                            // alert('Yakin!');
                                                            window.location.href = '<?php echo site_url('Therapist/therapistArchiveHandler/'.$row['ID_USER'])?>';
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
                                        <th>Kode Therapist</th>
                                        <th>Nama Therapist</th>
                                        <th>Alamat Therapist</th>
                                        <th>No Telp Therapist</th>
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
function add_therapist_validation() {
    var name = document.getElementById('name').value;
    var workingsince = document.getElementById('workingsince').value;
    var birthdate = document.getElementById('birthdate').value;
    var address = document.getElementById('address').value;
    var notelp = document.getElementById('notelp').value;

    var successArray = [false, false, false, false, false];
    var success = false;

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama pelanggan",
            successArray[0] = false

        ) :
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('name_span').innerHTML = "",
            successArray[0] = true
        );

    workingsince == '' ?
        (
            document.getElementById('workingsince_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('workingsince_span').innerHTML = "Harap lengkapi tanggal mulai bekerja",
            successArray[1] = false
        ) :
        (
            document.getElementById('workingsince_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('workingsince_span').innerHTML = "",
            successArray[1] = true
        );

    birthdate == '' ?
        (
            document.getElementById('birthdate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('birthdate_span').innerHTML = "Harap lengkapi tanggal lahir pelanggan",
            successArray[2] = false
        ) :
        (
            document.getElementById('birthdate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('birthdate_span').innerHTML = "",
            successArray[2] = true
        );

    address == '' ?
        (
            document.getElementById('address_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('address_span').innerHTML = "Harap lengkapi alamat pelanggan",
            successArray[3] = false
        ) :
        (
            document.getElementById('address_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('address_span').innerHTML = "",
            successArray[3] = true
        );

    notelp == '' ?
        (
            document.getElementById('notelp_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('notelp_span').innerHTML = "Harap lengkapi nomor telepon pelanggan",
            successArray[4] = false
        ) :
        (
            document.getElementById('notelp_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('address_span').innerHTML = "",
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