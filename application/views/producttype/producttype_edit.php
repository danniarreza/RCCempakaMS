  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Detail & Edit Jenis Produk
              <!-- <small>Preview</small> -->
          </h1>
          <ol class="breadcrumb">
              <li><a href="<?php echo site_url('ProductType/')?>"><i class="fa fa-dashboard"></i> Produk</a></li>
              <li><a href="<?php echo site_url('Product/')?>">Jenis Produk</a></li>
              <li class="active">Edit Jenis Produk</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- SELECT2 EXAMPLE -->
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Detail Jenis Produk</h3>

                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                              class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                              class="fa fa-remove"></i></button>
                  </div>
              </div>
              <!-- /.box-header -->
              <form role="form"
                  action="<?php echo site_url('ProductType/producttypeEditHandler/'.$producttypeslist[0]['ID_PRODUCT_TYPE']);?>"
                  method="post" enctype="multipart/form-data" onsubmit="return edit_producttype_validation();">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group" id="id_form_group">
                                  <label for="exampleInputEmail1">Kode Jenis Produk</label>
                                  <input type="text" class="form-control" name="id" id="id" style="border-radius: 4px"
                                      placeholder="Kode Jenis Produk ..."
                                      value="<?php echo $producttypeslist[0]['ID_PRODUCT_TYPE']?>">
                                  <span class="help-block" id="id_span"></span>
                              </div>
                              <div class="form-group" id="name_form_group">
                                  <label for="exampleInputEmail1">Jenis Produk</label>
                                  <input type="text" class="form-control" name="name" id="name"
                                      style="border-radius: 4px" placeholder="Name Jenis Produk ..."
                                      value="<?php echo $producttypeslist[0]['NAME_PRODUCT_TYPE']?>">
                                  <span class="help-block" id="name_span"></span>
                              </div>

                          </div>
                          <!-- /.col -->
                          <div class="col-md-6">

                              <div class="form-group" id="description_form_group">
                                  <label for="exampleInputEmail1">Deskripsi Jenis Produk</label>
                                  <input type="text" class="form-control" name="description" id="description"
                                      style="border-radius: 4px" placeholder="Deskripsi Jenis Produk ..."
                                      value="<?php echo $producttypeslist[0]['DESCRIPTION_PRODUCT_TYPE']?>">
                                  <span class="help-block" id="description_span"></span>
                              </div>

                              <div class="form-group" id="status_form_group">
                                  <label>Status Jenis Produk</label>
                                  <select class="form-control" name="status" id="status"
                                      style="width: 100%; border-radius: 4px">>
                                      <option value="ACTIVE"
                                          <?php echo ($producttypeslist[0]['STATUS_PRODUCT_TYPE'] == 'ACTIVE') ? 'selected':''?>>
                                          Active</option>
                                      <option value="ARCHIVE"
                                          <?php echo ($producttypeslist[0]['STATUS_PRODUCT_TYPE'] == 'ARCHIVE') ? 'selected':''?>>
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
              <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                      <div class="box-header with-border">
                          <h3 class="box-title">Daftar Produk</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
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
                                              <?php echo 'Rp ' . number_format($row['SELL_PRICE_PRODUCT'], 2, ",", ".")?>
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
                  </div>
                  <!-- /.box -->
              </div>
          </div>

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
function edit_producttype_validation() {
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var status = document.getElementById('status').value;

    var successArray = [false, false, false, false];
    var success = false;

    id == '' ?
        (
            document.getElementById('id_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('id_span').innerHTML = "Harap lengkapi kode jenis produk",
            successArray[0] = false
        ) :
        (
            document.getElementById('id_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('id_span').innerHTML = "",
            successArray[0] = true
        );

    name == '' ?
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('name_span').innerHTML = "Harap lengkapi nama jenis produk",
            successArray[1] = false

        ) :
        (
            document.getElementById('name_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('name_span').innerHTML = "",
            successArray[1] = true
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

    status == '' ?
        (
            document.getElementById('status_form_group').setAttribute("class", "form-group has-error"),
            document.getElementById('status_span').innerHTML = "Harap lengkapi status therapist",
            successArray[3] = false
        ) :
        (
            document.getElementById('status_form_group').setAttribute("class", "form-group has-success"),
            document.getElementById('status_span').innerHTML = "",
            successArray[3] = true
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