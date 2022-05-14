  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Detail & Edit Pelanggan
              <!-- <small>Preview</small> -->
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url('Customer/')?>"><i class="fa fa-dashboard"></i>Pelanggan</a></li>
              <li><a href="<?php echo site_url('Customer/')?>">Daftar Pelanggan</a></li>
              <li class="active">Edit Detail Pelanggan</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- SELECT2 EXAMPLE -->
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Detail Pelanggan</h3>
                  <!-- <h3 class="box-title"><?php echo $customerslist[0]['NAME_CUSTOMER']?></h3> -->
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                              class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                              class="fa fa-remove"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <form role="form"
                  action="<?php echo site_url('Customer/customerEditHandler/'.$customerslist[0]['ID_CUSTOMER']);?>"
                  method="post" enctype="multipart/form-data" onsubmit="return edit_customer_validation();">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kode Pelanggan</label>
                                  <input disabled type="text" class="form-control" id="id" style="border-radius: 4px"
                                      placeholder="Kode Pelanggan..." name="id"
                                      value="<?php echo $customerslist[0]['ID_CUSTOMER']?>">
                              </div>
                              <div class="form-group" id="name_form_group">
                                  <label for="exampleInputEmail1">Nama Pelanggan</label>
                                  <input type="text" class="form-control" id="name" style="border-radius: 4px"
                                      placeholder="Nama Pelanggan..." name="name"
                                      value="<?php echo $customerslist[0]['NAME_CUSTOMER']?>">
                                  <span class="help-block" id="name_span"></span>
                              </div>
                              <div class="form-group" id="gender_form_group">
                                  <label>Jenis Kelamin</label>
                                  <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                      <option value="F"
                                          <?php echo ($customerslist[0]['GENDER_CUSTOMER'] == 'F') ? 'selected':''?>>
                                          Perempuan</option>
                                      <option value="M"
                                          <?php echo ($customerslist[0]['GENDER_CUSTOMER'] == 'M') ? 'selected':''?>>
                                          Laki-Laki</option>
                                  </select>
                                  <span class="help-block" id="gender_span"></span>
                              </div>
                              <div class="form-group" id="dateadded_form_group">
                                  <label for="exampleInputEmail1">Tanggal Didaftarkan</label>
                                  <input readOnly type="text" class="form-control" id="dateadded" style="border-radius: 4px"
                                      placeholder="Tanggal Dibuat..." name="dateadded"
                                      value="<?php echo date('d M Y', strtotime($customerslist[0]['DATE_ADDED_CUSTOMER']))?>">
                                  <span class="help-block" id="dateadded_span"></span>
                              </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-md-6">
                              <div class="form-group" id="address_form_group">
                                  <label for="exampleInputEmail1">Alamat Pelanggan</label>
                                  <input type="text" class="form-control" id="address" style="border-radius:4px"
                                      placeholder="Alamat Pelanggan..." name="address"
                                      value="<?php echo $customerslist[0]['ADDRESS_CUSTOMER']?>">
                                  <span class="help-block" id="address_span"></span>
                              </div>

                              <div class="form-group" id="notelp_form_group">
                                  <label for="exampleInputEmail1">Nomor Telepon</label>
                                  <input type="text" class="form-control" id="notelp" style="border-radius: 4px"
                                      placeholder="Nomor Telepon Pelanggan..." name="notelp"
                                      value="<?php echo $customerslist[0]['NOTELP_CUSTOMER']?>">
                                  <span class="help-block" id="notelp_span"></span>
                              </div>

                              <div class="form-group" id="birthdate_form_group">
                                  <label>Tanggal Lahir</label>
                                  <div class="input-group date">
                                      <div class="input-group-addon"
                                          style="border-bottom-left-radius: 4px; border-top-left-radius: 4px">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" name="birthdate" id="birthdate"
                                          style="border-bottom-right-radius: 4px; border-top-right-radius: 4px"
                                          class="form-control pull-right"
                                          value="<?php echo date('d M Y', strtotime($customerslist[0]['BIRTHDATE_CUSTOMER']))?>">
                                  </div>
                                  <span class="help-block" id="birthdate_span"></span>
                              </div>
                              <div class="form-group" id="status_form_group">
                                  <label>Status Pelanggan</label>
                                  <select class="form-control select2" name="status" id="status" style="width: 100%;">
                                      <option value="ACTIVE"
                                          <?php echo ($customerslist[0]['STATUS_CUSTOMER'] == 'ACTIVE') ? 'selected':''?>>
                                          Active</option>
                                      <option value="ARCHIVE"
                                          <?php echo ($customerslist[0]['STATUS_CUSTOMER'] == 'ARCHIVE') ? 'selected':''?>>
                                          Archive</option>
                                  </select>
                                  <span class="help-block" id="status_span"></span>
                              </div>
                          </div>

                          <!-- /.col -->
                      </div>
                      <!-- /.row -->
                  </div>
                  <!-- /.box-body -->
                  <div class="modal-footer">
                      <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button> -->
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
              </form>
          </div>
          <!-- /.box -->

          <div class="row">
              <!-- left column -->
              <div class="col-md-6">
                  <!-- general form elements -->
                  <div class="box box-primary">
                      <div class="box-header with-border">
                          <h3 class="box-title">History Transaksi Produk</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="table-responsive">
                              <table id="transactionproducthistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Tanggal</th>
                                          <th>PJ</th>
                                          <th>Produk</th>
                                          <th>Jumlah</th>
                                          <th>Pembayaran</th>
                                          <!-- <th>Arsip</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                        $totaltransaction = 0;
                                        foreach ($transactionproductlist as $row) {
                                            ?>
                                      <tr>
                                          <!-- <td>
                                            <?php echo $row['ID_ENTRY']?>
                                        </td> -->
                                          <td>
                                              <?php echo date('d M Y', strtotime($row['DATE_ENTRY']))?>
                                          </td>
                                          <td>
                                              <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if ($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak') {
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                } elseif ($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut') {
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                }
                                            } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                echo $row['NAME_USER'] . ' - ' . $row['NAME_VENDOR'];
                                                ;
                                            } ?>
                                          </td>
                                          <td>
                                              <?php echo $row['NAME_PRODUCT']; ?>
                                          </td>
                                          <td>
                                              <?php echo $row['AMOUNT']; ?>
                                          </td>
                                          <td>
                                              <?php echo 'Rp ' . number_format($row['TOTAL_PRICE'], 2, ",", ".");
                                            $totaltransaction = $totaltransaction + $row['TOTAL_PRICE']; ?>
                                          </td>

                                      </tr>
                                      <?php
                                        }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Total Pembayaran</th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th id="paymenttotal">
                                              <?php echo 'Rp ' . number_format($totaltransaction, 2, ",", ".")?></th>
                                          <!-- <th>Arsip</th> -->
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
                  <!-- /.box -->


              </div>
              <!--/.col (left) -->
              <!-- right column -->
              <div class="col-md-6">
                  <!-- Horizontal Form -->
                  <div class="box box-info">
                      <div class="box-header with-border">
                          <h3 class="box-title">History Transaksi Perawatan</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="table-responsive">
                              <table id="transactiontreatmenthistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>Tanggal</th>
                                          <th>PJ</th>
                                          <th>Perawatan</th>
                                          <th>Pembayaran</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <!-- <tr>

                                    </tr> -->
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Total Pembayaran</th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <!-- <th><?php echo 'Rp ' . number_format($totaltransaction, 2, ",", ".")?></th> -->
                                          <!-- <th>Arsip</th> -->
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
                  <!-- /.box -->

              </div>
              <!--/.col (right) -->
          </div>

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
var initialload = true;

function countTransactionProductTotal() {
    var table = document.getElementById('transactionproducthistory');
    var rows = table.rows;
    var total = 0;
    var number = 0;

    // console.log(rows[1].cells[0].getAttribute('class'));

    // if (rows[1].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
    //     for (let index = 0; index < rows.length - 1; index++) {
    //         if (index != 0 && table.rows[index].cells[4].innerText.split('Rp')[1].split(',')[0].replace(".", "") !=
    //             undefined) {
    //             number = table.rows[index].cells[4].innerText.split('Rp')[1].split(',')[0].replace(".", "");
    //             number = parseInt(number);
    //             total += number;
    //         }
    //     }
    // } else if (rows[1].cells[0].getAttribute('class') == 'dataTables_empty') {
    //     total = 0;
    // }

    // total = number_format(total, 0, ',', '.');
    // document.getElementById('paymenttotal').innerHTML = 'Rp ' + total + ',00';

    // console.log(rows[2].cells[0].getAttribute('class'));
    // console.log('Ini table');
    // console.log(table.rows);
    // console.log(rows[2].cells[1].getAttribute('class'));

    if (rows[2].cells[1].getAttribute('class').split('_')[0] == 'sorting') {

        for (let index = 0; index < rows.length; index++) {

            // if (index != 0 && index != 1 && table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "") !=
            //     undefined) {
            // number = table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0].replace(".", "");
            // if (table.rows[index].cells[5].innerText.split('Rp')[1].split(',')[0] != undefined) {

            if (window.initialload == true) {
                if (index != 0 && table.rows[index].cells[4].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[4].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            } else {
                if (index != 0 && index != 1 && table.rows[index].cells[4].innerText.split('Rp')[1] != undefined) {
                    // console.log('Ini Number ' + index);
                    // console.log(table.rows[index].cells[5].innerText.split('Rp')[1]);

                    number = table.rows[index].cells[4].innerText.split('Rp')[1].split(',')[0].replace(".", "");
                    number = parseInt(number);
                    total += number;
                }
            }


            // }
            //     number = parseInt(number);

            //     total += number;
            //     console.log('Ini Total');
            //     console.log(total);
            // }
        }
    } else if (rows[2].cells[0].getAttribute('class') == 'dataTables_empty') {
        total = 0;
    }



    total = number_format(total, 0, ',', '.');
    document.getElementById('transactionproducthistory_totaltransaction').innerHTML = 'Rp ' + total + ',00';
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

function edit_customer_validation() {
    var name = document.getElementById('name').value;
    var gender = document.getElementById('gender').value;
    var birthdate = document.getElementById('birthdate').value;
    var address = document.getElementById('address').value;
    var notelp = document.getElementById('notelp').value;

    var successArray = [false, false, false, false, false];
    var success;

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

    gender == '' ?
        (
            document.getElementById('gender_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('gender_span').innerHTML = "Harap lengkapi jenis kelamin pelanggan",
            successArray[1] = false
        ) :
        (
            document.getElementById('gender_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('gender_span').innerHTML = "",
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