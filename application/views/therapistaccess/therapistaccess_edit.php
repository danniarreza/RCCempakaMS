  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Detail & Edit Therapist
              <!-- <small>Preview</small> -->
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Forms</a></li>
              <li class="active">Advanced Elements</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- SELECT2 EXAMPLE -->
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Detail Therapist</h3>
                  <!-- <h3 class="box-title"><?php echo $therapistslist[0]['NAME_USER']?></h3> -->
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                              class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                              class="fa fa-remove"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <form role="form"
                  action="<?php echo site_url('Therapist/therapistEditHandler/'.$therapistslist[0]['ID_USER']);?>"
                  method="post" enctype="multipart/form-data" onsubmit="return edit_therapist_validation();">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Kode Therapist</label>
                                  <input disabled type="text" class="form-control" id="id" style="border-radius: 4px"
                                      placeholder="Kode Therapist..." name="id"
                                      value="<?php echo $therapistslist[0]['ID_USER']?>">
                              </div>
                              <div class="form-group" id="name_form_group">
                                  <label for="exampleInputEmail1">Nama Therapist</label>
                                  <input type="text" class="form-control" id="name" style="border-radius: 4px"
                                      placeholder="Nama Therapist..." name="name"
                                      value="<?php echo $therapistslist[0]['NAME_USER']?>">
                                  <span class="help-block" id="name_span"></span>
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
                                          class="form-control pull-right"
                                          value="<?php echo date('d M Y', strtotime($therapistslist[0]['WORKING_SINCE']))?>">
                                  </div>
                                  <span class="help-block" id="workingsince_span"></span>
                              </div>
                              <div class="form-group" id="salary_form_group">
                                  <label for="exampleInputEmail1">Gaji Pokok Therapist</label>
                                  <div class="input-group">
                                      <div class="input-group-addon"
                                          style="border-bottom-left-radius: 4px; border-top-left-radius: 4px; padding-bottom:0px">
                                          <!-- <i class="fa fa-calendar"></i> -->
                                          <p style="font-size:12px; padding-top:4px;">Rp</p>
                                      </div>
                                      <input type="text" class="form-control" id="salary"
                                          placeholder="Gaji Therapist..." name="salary"
                                          value="<?php echo number_format($therapistslist[0]['SALARY_USER'], 0, ",", ".")?>">
                                      <span class="input-group-addon"
                                          style="border-bottom-right-radius: 4px; border-top-right-radius: 4px">.00</span>
                                  </div>
                                  <span class="help-block" id="salary_span"></span>
                              </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-md-6">
                              <div class="form-group" id="address_form_group">
                                  <label for="exampleInputEmail1">Alamat Therapist</label>
                                  <input type="text" class="form-control" id="address" style="border-radius:4px"
                                      placeholder="Alamat Therapist..." name="address"
                                      value="<?php echo $therapistslist[0]['ADDRESS_USER']?>">
                                  <span class="help-block" id="address_span"></span>
                              </div>

                              <div class="form-group" id="notelp_form_group">
                                  <label for="exampleInputEmail1">Nomor Telepon</label>
                                  <input type="text" class="form-control" id="notelp" style="border-radius: 4px"
                                      placeholder="Nomor Telepon Therapist..." name="notelp"
                                      value="<?php echo $therapistslist[0]['NOTELP_USER']?>">
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
                                          value="<?php echo date('d M Y', strtotime($therapistslist[0]['BIRTHDATE_USER']))?>">
                                  </div>
                                  <span class="help-block" id="birthdate_span"></span>
                              </div>
                              <div class="form-group" id="status_form_group">
                                  <label>Status Therapist</label>
                                  <select class="form-control select2" name="status" id="status" style="width: 100%;">
                                      <option value="ACTIVE"
                                          <?php echo ($therapistslist[0]['STATUS_USER'] == 'ACTIVE') ? 'selected':''?>>
                                          Active</option>
                                      <option value="ARCHIVE"
                                          <?php echo ($therapistslist[0]['STATUS_USER'] == 'ARCHIVE') ? 'selected':''?>>
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
                          <h3 class="box-title">History Transaksi Produk</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                          <div class="table-responsive">
                              <table id="producttransactionhistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>Tanggal</th>
                                          <th>Oleh</th>
                                          <th>Produk</th>
                                          <th>Jumlah</th>
                                          <th>Total</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                    for ($i=0; $i < 30; $i++) {
                                        ?>
                                      <tr>
                                          <td>
                                              <?php
                                                echo date('Y-m-d')
                                              ?>
                                          </td>
                                          <td>
                                              <?php
                                                    if (($i+1) % 2 == 0) {
                                                        echo 'Sengon - Nur';
                                                    } else {
                                                        echo 'Araya - Anjar';
                                                    } ?>
                                          </td>
                                          <td>
                                              <?php
                                                if (($i+1) % 2 == 0) {
                                                    echo 'Cream Malam M5';
                                                } else {
                                                    echo 'Cream Malam M4';
                                                } ?>
                                          </td>
                                          <td>
                                              <?php
                                                    $digits = 2;
                                        echo rand(pow(10, $digits-1), pow(10, $digits)-1); ?>
                                          </td>
                                          <td>
                                              <?php
                                                    $digits = 6;
                                        $value = rand(pow(10, $digits-1), pow(10, $digits)-1);
                                        $valueFormatted = number_format($value, 2, ",", ".");
                                        echo 'Rp ' . $valueFormatted; ?>
                                          </td>
                                      </tr>
                                      <?php
                                    }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th>Tanggal</th>
                                          <th>Oleh</th>
                                          <th>Produk</th>
                                          <th>Jumlah</th>
                                          <th>Total</th>
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
                              <table id="treatmenttransactionhistory" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>Tanggal</th>
                                          <th>Oleh</th>
                                          <th>Therapist</th>
                                          <th>Jumlah</th>
                                          <th>Penjualan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                    for ($i=0; $i < 30; $i++) {
                                        ?>
                                      <tr>
                                          <td>
                                              <?php
                                                echo date('Y-m-d')
                                              ?>
                                          </td>
                                          <td>
                                              <?php
                                                    if (($i+1) % 2 == 0) {
                                                        echo 'Sengon - Nur';
                                                    } else {
                                                        echo 'Araya - Anjar';
                                                    } ?>
                                          </td>
                                          <td>
                                              <?php
                                                if (($i+1) % 2 == 0) {
                                                    echo 'Masuk';
                                                } else {
                                                    echo 'Keluar';
                                                } ?>
                                          </td>
                                          <td>
                                              <?php
                                                    $digits = 2;
                                        echo rand(pow(10, $digits-1), pow(10, $digits)-1); ?>
                                          </td>
                                          <td>
                                              <?php
                                                    $digits = 6;
                                        $value = rand(pow(10, $digits-1), pow(10, $digits)-1);
                                        $valueFormatted = number_format($value, 2, ",", ".");
                                        echo 'Rp ' . $valueFormatted; ?>
                                          </td>
                                      </tr>
                                      <?php
                                    }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th>Tanggal</th>
                                          <th>Oleh</th>
                                          <th>Therapist</th>
                                          <th>Jumlah</th>
                                          <th>Penjualan</th>
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
function edit_therapist_validation() {
    var name = document.getElementById('name').value;
    var workingsince = document.getElementById('workingsince').value;
    var salary = document.getElementById('salary').value;

    var salarysplitarray = salary.split(".");
    var salarynumber = '';

    salarysplitarray.forEach(element => {
        salarynumber = salarynumber + element;
    });
    var salary_isnum = /^\d+$/.test(salarynumber);

    var birthdate = document.getElementById('birthdate').value;
    var address = document.getElementById('address').value;
    var notelp = document.getElementById('notelp').value;
    var status = document.getElementById('status').value;

    var successArray = [false, false, false, false, false, false, false];
    var success = false;

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama therapist",
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

    salary == '' ?
        (
            document.getElementById('salary_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('salary_span').innerHTML = "Harap lengkapi gaji pokok therapist",
            successArray[2] = false
        ) :
        (
            salary_isnum == false ||
            salarysplitarray[salarysplitarray.length - 1] == '' ||
            salarysplitarray[salarysplitarray.length - 1] == '0' ||
            salarysplitarray[salarysplitarray.length - 1] == '00' ?
            (
                document.getElementById('salary_form_group').setAttribute("class", "form-group has-error"),
                document.getElementById('salary_span').innerHTML =
                "Harap isikan dengan format : 1000000 atau 1.000.000",
                successArray[2] = false
            ) :
            (
                document.getElementById('salary_form_group').setAttribute("class", "form-group has-success"),
                document.getElementById('salary_span').innerHTML = "",
                successArray[2] = true
            )
        );

    birthdate == '' ?
        (
            document.getElementById('birthdate_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('birthdate_span').innerHTML = "Harap lengkapi tanggal lahir therapist",
            successArray[3] = false
        ) :
        (
            document.getElementById('birthdate_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('birthdate_span').innerHTML = "",
            successArray[3] = true
        );

    address == '' ?
        (
            document.getElementById('address_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('address_span').innerHTML = "Harap lengkapi alamat therapist",
            successArray[4] = false
        ) :
        (
            document.getElementById('address_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('address_span').innerHTML = "",
            successArray[4] = true
        );

    notelp == '' ?
        (
            document.getElementById('notelp_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('notelp_span').innerHTML = "Harap lengkapi nomor telepon therapist",
            successArray[5] = false
        ) :
        (
            document.getElementById('notelp_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('notelp_span').innerHTML = "",
            successArray[5] = true
        );

    status == '' ?
        (
            document.getElementById('status_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('status_span').innerHTML = "Harap lengkapi status therapist",
            successArray[6] = false
        ) :
        (
            document.getElementById('status_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('status_span').innerHTML = "",
            successArray[6] = true
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