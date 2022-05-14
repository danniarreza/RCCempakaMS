  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Detail & Edit Produk
              <!-- <small>Preview</small> -->
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url('Product/')?>"><i class="fa fa-dashboard"></i> Produk</a></li>
              <li><a href="<?php echo site_url('Product/')?>">Daftar Produk</a></li>
              <li class="active">Edit Detail Produk</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- SELECT2 EXAMPLE -->
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Detail Produk</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                              class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                              class="fa fa-remove"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <form role="form"
                  action="<?php echo site_url('Product/productEditHandler/'.$productslist[0]['TYPE_PRODUCT'].'-'.$productslist[0]['ID_PRODUCT']);?>"
                  method="post" enctype="multipart/form-data" onsubmit="return edit_product_validation();">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">

                              <div class="form-group" id="type_form_group">
                                  <label>Jenis Produk</label>
                                  <select onchange="type_product_onchange()" class="form-control" name="type" id="type"
                                      style="width: 100%; border-radius: 4px">
                                      <?php
                                        foreach ($producttypeslist as $row) {
                                            ?>
                                      <option value="<?php echo $row['ID_PRODUCT_TYPE']; ?>"
                                          <?php echo ($productslist[0]['TYPE_PRODUCT'] == $row['ID_PRODUCT_TYPE']) ? 'selected':''?>>
                                          <?php echo $row['NAME_PRODUCT_TYPE']; ?></option>
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
                                              <?php echo $productslist[0]['TYPE_PRODUCT']?>
                                          </p>
                                      </div>
                                      <input readOnly onchange="number_formatter()"
                                          oninput="product_duplicate_check('id')" type="text" class="form-control"
                                          id="id" placeholder="Contoh : 005 atau 015 ..." name="id"
                                          value="<?php echo $productslist[0]['ID_PRODUCT']?>">
                                  </div>
                                  <span class="help-block" id="id_span"></span>
                              </div>

                              <div class="form-group" id="name_form_group">
                                  <label for="exampleInputEmail1">Nama Produk</label>
                                  <input type="text" class="form-control" id="name" style="border-radius: 4px"
                                      placeholder="Nama Produk..." name="name"
                                      value="<?php echo $productslist[0]['NAME_PRODUCT']?>">
                                  <span class="help-block" id="name_span"></span>
                              </div>

                              <div class="form-group" id="dateadded_form_group">
                                  <label for="exampleInputEmail1">Tanggal Dibuat</label>
                                  <input readOnly type="text" class="form-control" id="dateadded" style="border-radius: 4px"
                                      placeholder="Tanggal Dibuat..." name="dateadded"
                                      value="<?php echo date('d M Y', strtotime($productslist[0]['DATE_ADDED_PRODUCT']))?>">
                                  <span class="help-block" id="dateadded_span"></span>
                              </div>

                          </div>
                          <!-- /.col -->
                          <div class="col-md-6">

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
                                      <input type="number" class="form-control" id="capitalprice"
                                          placeholder="Contoh : 100000 atau 100.000" name="capitalprice"
                                          value="<?php echo number_format($productslist[0]['CAPITAL_PRICE_PRODUCT'], 0, ",", ".")?>">
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
                                          placeholder="Contoh : 100000 atau 100.000" name="sellprice"
                                          value="<?php echo number_format($productslist[0]['SELL_PRICE_PRODUCT'], 0, ",", ".")?>">
                                      <span class="input-group-addon"
                                          style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                  </div>
                                  <span class="help-block" id="sellprice_span"></span>
                              </div>

                              <div class="form-group" id="description_form_group">
                                  <label for="exampleInputEmail1">Deskripsi Produk</label>
                                  <input type="text" class="form-control" name="description" id="description"
                                      style="border-radius: 4px" placeholder="Deskripsi Produk ..."
                                      value="<?php echo $productslist[0]['DESCRIPTION_PRODUCT']?>">
                                  <span class="help-block" id="description_span"></span>
                              </div>

                              <div class="form-group" id="status_form_group">
                                  <label>Status Produk</label>
                                  <select class="form-control" name="status" id="status" style="width: 100%;">
                                      <option value="ACTIVE"
                                          <?php echo ($productslist[0]['STATUS_PRODUCT'] == 'ACTIVE') ? 'selected':''?>>
                                          Active</option>
                                      <option value="ARCHIVE"
                                          <?php echo ($productslist[0]['STATUS_PRODUCT'] == 'ARCHIVE') ? 'selected':''?>>
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
                  <div class="box-footer" style="text-align: right">
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
                          <h3 class="box-title">History Stok</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="table-responsive">
                              <table id="productdetailstockhistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Tanggal</th>
                                          <th>Jenis</th>
                                          <th>PJ</th>
                                          <th>Sumber/Tujuan</th>
                                          <th>Jumlah</th>
                                          <!-- <th>Arsip</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $totalamount = 0;
                                    foreach ($stocklist as $row) {
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
                                                    echo $row['NAME_STOCK_TYPE'];
                                                } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                    echo 'Transaksi Produk';
                                                } ?>
                                          </td>
                                          <td>
                                              <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak'){
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                } else if($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut'){
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                }
                                            } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                echo $row['NAME_USER'] . ' - ' . $row['NAME_VENDOR'];;
                                            } ?>
                                          </td>
                                          <td>
                                              <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak'){
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                } else if($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut'){
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                }
                                            } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                echo $row['NAME_CUSTOMER'] . ' - ' . $row['ADDRESS_CUSTOMER'];
                                            } ?>
                                          </td>
                                          <td>
                                              <?php 
                                                echo $row['AMOUNT'];
                                                $totalamount = $totalamount + $row['AMOUNT'];
                                              ?>
                                          </td>

                                      </tr>
                                      <?php
                                    }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Tanggal</th>
                                          <th>Jenis</th>
                                          <th>PJ</th>
                                          <th>Sumber/Tujuan</th>
                                          <th>Jumlah</th>
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
                          <h3 class="box-title">History Transaksi</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="table-responsive">
                              <table id="productdetailtransactionhistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Tanggal</th>
                                          <!-- <th>Jenis</th> -->
                                          <th>PJ</th>
                                          <th>Customer</th>
                                          <th>Jumlah</th>
                                          <!-- <th>Arsip</th> -->
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $totalamount = 0;
                                    foreach ($transactionlist as $row) {
                                        ?>
                                      <tr>
                                          <!-- <td>
                                            <?php echo $row['ID_ENTRY']?>
                                        </td> -->
                                          <td>
                                              <?php echo date('d M Y', strtotime($row['DATE_ENTRY']))?>
                                          </td>
                                          <!-- <td>
                                              <?php
                                                if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                    echo $row['NAME_STOCK_TYPE'];
                                                } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                    echo 'Transaksi Produk';
                                                } ?>
                                          </td> -->
                                          <td>
                                              <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak'){
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                } else if($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut'){
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                }
                                            } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                echo $row['NAME_USER'] . ' - ' . $row['NAME_VENDOR'];;
                                            } ?>
                                          </td>
                                          <td>
                                              <?php
                                            if (isset($row['NAME_STOCK_TYPE'])) { // stock
                                                if($row['NAME_STOCK_TYPE'] == 'Stok Transfer' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Repack' || $row['NAME_STOCK_TYPE'] == 'Stok Keluar Menyusut' || $row['NAME_STOCK_TYPE'] == 'Stok Expired' || $row['NAME_STOCK_TYPE'] == 'Stok Rusak'){
                                                    echo $row['USER_RECEIVER'] . ' - ' . $row['VENDOR_RECEIVER'];
                                                } else if($row['NAME_STOCK_TYPE'] == 'Stok Masuk' || $row['NAME_STOCK_TYPE'] == 'Stok Masuk Menyusut'){
                                                    echo $row['USER_SENDER'] . ' - ' . $row['VENDOR_SENDER'];
                                                }
                                            } elseif (!isset($row['NAME_STOCK_TYPE'])) { // transaksi
                                                echo $row['NAME_CUSTOMER'] . ' - ' . $row['ADDRESS_CUSTOMER'];
                                            } ?>
                                          </td>
                                          <td>
                                              <?php echo $row['AMOUNT'];
                                              $totalamount = $totalamount + $row['AMOUNT'];?>
                                          </td>

                                      </tr>
                                      <?php
                                    }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <!-- <th>Kode Entry</th> -->
                                          <th>Tanggal</th>
                                          <!-- <th>Jenis</th> -->
                                          <th>PJ</th>
                                          <th>Customer</th>
                                          <th>Jumlah</th>
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
function countProductStockTotal() {
    var table = document.getElementById('productdetailstockhistory');
    var rows = table.rows;
    var total = 0;
    var number = 0;

    // console.log(rows[1].cells[0].getAttribute('class'));

    if (rows[1].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        for (let index = 0; index < rows.length - 1; index++) {
            if (index != 0) {
                number = table.rows[index].cells[4].innerText;
                number = parseFloat(number);
                total += number;

            }
        }
    } else if (rows[1].cells[0].getAttribute('class') == 'dataTables_empty') {
        total = 0;
    }

    total = number_format(total, 0, ',', '.');
    document.getElementById('stocktotal').innerHTML = total;
}

function countProductTransactionTotal() {
    var table = document.getElementById('productdetailtransactionhistory');
    var rows = table.rows;
    var total = 0;
    var number = 0;

    if (rows[1].cells[0].getAttribute('class').split('_')[0] == 'sorting') {
        for (let index = 0; index < rows.length - 1; index++) {
            if (index != 0) {
                number = table.rows[index].cells[3].innerText;
                number = parseFloat(number);
                total += number;

            }
        }
    } else if (rows[1].cells[0].getAttribute('class') == 'dataTables_empty') {
        total = 0;
    }

    total = number_format(total, 0, ',', '.');
    document.getElementById('transactiontotal').innerHTML = total;
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

function type_product_onchange() {
    document.getElementById('id_p').innerHTML = document.getElementById('type').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("id").value = this.responseText;
        }
    };
    xhttp.open("GET", "<?php echo site_url('Product/productLatestIdRequest/');?>" + document.getElementById('type')
        .value, true);
    xhttp.send();
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

    var type = document.getElementById('type').value;
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;

    var type_id = type + '-' + id;
    var type_id_check = '<?php echo $productslist[0]['TYPE_PRODUCT'] . '-' . $productslist[0]['ID_PRODUCT']?>';

    if (type_id != type_id_check) {
        var data = new FormData();
        var method = 'POST';
        var url = "<?php echo site_url('Product/productDuplicateCheck/');?>";

        if (input == 'id') {
            data.append('input', input)
            data.append('type', type);
            data.append('id', id);
        } else if (input == 'name') {
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
                document.getElementById(input + '_span').innerHTML = "Sudah ada produk " + response.TYPE_PRODUCT +
                    "-" +
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


}

function edit_product_validation() {
    var type = document.getElementById('type').value;
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;

    var sellprice = document.getElementById('sellprice').value;

    var sellpricesplitarray = sellprice.split(".");
    var sellpricenumber = '';

    sellpricesplitarray.forEach(element => {
        sellpricenumber = sellpricenumber + element;
    });
    var sellprice_isnum = /^\d+$/.test(sellpricenumber);

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
            document.getElementById('id_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('id_span').innerHTML = "",
            successArray[1] = true
        );

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama produk",
            successArray[2] = false

        ) :
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('name_span').innerHTML = "",
            successArray[2] = true
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