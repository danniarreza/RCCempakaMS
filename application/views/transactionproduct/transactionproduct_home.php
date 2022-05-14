<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transaksi
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('TransactionProduct/')?>"><i class="fa fa-dashboard"></i>Transaksi</a></li>
            <li class="active">Transaksi Produk</li>

        </ol>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Transaksi Produk</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <?php
                    if (is_array($transactionlist)) {
                        ?>
                        <div>
                            <button onclick="" type="button" style="margin-bottom:10px" class="btn btn-success"
                                data-toggle="modal" data-target="#modal-transactionproduct-add">
                                Tambah Transaksi Baru
                                <i style="padding-left:10px" class="fa fa-download"></i>
                            </button>
                        </div>
                        <?php
                    }

                    ?>



                        <div class="modal fade" id="modal-transactionproduct-add">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form role="form"
                                        action="<?php echo site_url('TransactionProduct/transactionProductAddHandler');?>"
                                        method="post" enctype="multipart/form-data"
                                        onsubmit="return add_transactionproduct_validation();">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Tambah Transaksi Baru</h4>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group" id="customer_form_group">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                        <label>Nama Pelanggan</label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-6" style="text-align:right">
                                                        <button onclick="" type="button" style="margin-bottom:10px"
                                                            class="btn btn-xs btn-success" data-toggle="modal"
                                                            data-target="#modal-customer-add">
                                                            Pelanggan Baru
                                                            <i style="padding-left:10px" class="fa fa-user-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="customer" id="customer">
                                                    <?php
                                                        foreach ($customerslist as $row) {
                                                            ?>
                                                    <option value="<?php echo $row['ID_CUSTOMER']?>">
                                                        <?php echo $row['NAME_CUSTOMER'] . ' - ' . $row['ADDRESS_CUSTOMER']; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <span class="help-block" id="customer_span"></span>
                                            </div>

                                            <div class="form-group" id="therapistname_form_group">
                                                <label for="exampleInputEmail1">Nama Therapist</label>
                                                <input readOnly type="text" name="therapistname"
                                                    value="<?php echo $this->session->user_name;?>" id="therapistname"
                                                    class="form-control" style="border-radius: 4px" placeholder="...">
                                                <span class="help-block" id="therapistname_span"></span>
                                            </div>

                                            <div class="form-group" id="therapistid_form_group">
                                                <!-- <label for="exampleInputEmail1">Nama Therapist</label> -->
                                                <input readOnly type="hidden" name="therapistid"
                                                    value="<?php echo $this->session->user_id;?>" id="therapistid"
                                                    class="form-control" style="border-radius: 4px" placeholder="...">
                                                <span class="help-block" id="therapistid_span"></span>
                                            </div>

                                            <div class="form-group" id="vendor_form_group">
                                                <label>Toko Cabang</label>
                                                <select class="form-control select2" style="width: 100%;" name="vendor"
                                                    id="vendor">
                                                    <?php
                                                        foreach ($therapistvisibility as $row) {
                                                            ?>
                                                    <option value="<?php echo $row['ID_VENDOR']?>">
                                                        <?php echo $row['NAME_VENDOR']; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <span class="help-block" id="vendor_span"></span>
                                            </div>

                                            <div class="form-group" id="transactiondate_form_group">
                                                <label>Tanggal Transaksi</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon"
                                                        style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input readOnly type="text" name="transactiondate"
                                                        id="transactiondate"
                                                        style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                                        class="form-control pull-right"
                                                        value="<?php echo date('d M Y');?>">
                                                </div>
                                                <span class="help-block" id="transactiondate_span"></span>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" id="submitbutton" class="btn btn-primary">Buat
                                                Transaksi Baru</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <?php $this->view('transactionproduct/transactionproduct_customeradd_modal');?>

                        <div class="table-responsive">
                            <table id="transactiontable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Therapist</th>
                                        <th>Toko</th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Detail Transaksi</th>
                                        <!-- <th>Arsip</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (is_array($transactionlist)) {
                                        $totaltransaction = 0;
                                        foreach ($transactionlist as $row) {
                                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['ID_TRANSACTION']?>
                                        </td>
                                        <td>
                                            <?php echo date('d M Y', strtotime($row['DATE_TRANSACTION']))?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_CUSTOMER']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_USER']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_VENDOR']?>
                                        </td>
                                        <td>
                                            <?php echo 'Rp ' . number_format($row['TOTAL_TRANSACTION'], 2, ",", ".");
                                            $totaltransaction = $totaltransaction + $row['TOTAL_TRANSACTION']; ?>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                onclick="(function(){window.location.href = '<?php echo site_url('TransactionProduct/transactionDetailView/'.$row['ID_TRANSACTION'])?>';})()"
                                                formtarget="_blank"
                                                style="width:50%; margin-left: auto; margin-right:auto"
                                                class="btn btn-block btn-primary btn-xs">
                                                <i style="margin-left: auto; margin-right: auto"
                                                    class="fa fa-fw fa-download"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php
                                        }
                                    } elseif (!is_array($transactionlist)) {
                                        ?>
                                    <tr>
                                        <td valign="top" colspan="9" class="dataTables_empty">
                                            <?php echo $transactionlist?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>

                                </tbody>
                                <tfoot>
                                    <?php if (is_array($transactionlist)) {?>
                                    <tr>
                                        <th>Total Transaksi</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th id="paymenttotal">
                                            <?php echo 'Rp ' . number_format($totaltransaction, 2, ",", ".")?></th>
                                        <th></th>
                                        <!-- <th>Arsip</th> -->
                                    </tr>
                                    <?php } else if(!is_array($transactionlist)){
                                    ?>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pelanggan</th>
                                        <th>Therapist</th>
                                        <th>Toko</th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Detail Transaksi</th>
                                        <!-- <th>Arsip</th> -->
                                    </tr>
                                    <?php
                                }
                                    
                                    ?>
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
var initialload = true;

function countTransactionProductTotal() {
    var table = document.getElementById('transactiontable');
    var rows = table.rows;
    var total = 0;
    var number = 0;

    // console.log(rows[2].cells[0].getAttribute('class'));
    // console.log('Ini table');
    // console.log(table.rows);

    if (rows[0].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        console.log('Ini yg 0');
        console.log(rows[0]);
        total = 0;

        
    } else if (rows[1].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        console.log('Ini yg 1');
        console.log(rows[1]);
        for (let index = 0; index < rows.length; index++) {

            if (window.initialload == true) {
                if (index != 0 && table.rows[index].cells[5].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            } else {
                if (index != 0 && index != 1 && table.rows[index].cells[5].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            }

        }
    } else if (rows[2].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        console.log('Ini yg 2');
        console.log(rows[2]);
        for (let index = 0; index < rows.length; index++) {

            if (window.initialload == true) {
                if (index != 0 && table.rows[index].cells[5].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            } else {
                if (index != 0 && index != 1 && table.rows[index].cells[5].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            }

        }
    } else if (rows[2].cells[0].getAttribute('class') == 'dataTables_empty') {
        total = 0;
    }



    total = number_format(total, 0, ',', '.');
    document.getElementById('paymenttotal').innerHTML = 'Rp ' + total + ',00';
    window.initialload = false;

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

function add_transactionproduct_validation(params) {
    var transactiondate = document.getElementById('transactiondate').value;

    var successArray = [false];
    var success = false;

    transactiondate == '' ?
        (
            document.getElementById('transactiondate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('transactiondate_span').innerHTML = "Harap isikan tanggal transaksi",
            successArray[0] = false

        ) :
        (
            document.getElementById('transactiondate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('transactiondate_span').innerHTML = "",
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
</script>