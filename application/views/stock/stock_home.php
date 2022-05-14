<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stock Produk
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('Stock/')?>"><i class="fa fa-dashboard"></i> Stock</a></li>
            <li class="active">Stock Terakhir</li>
        </ol>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Stok Terakhir</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <!-- <div>
                            <button onclick="type_stock_onchange()" type="button" style="margin-bottom:10px"
                                class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                Tambah Stok
                            </button>
                        </div> -->

                        <div class="table-responsive">
                            <table id="stocktable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Nama Toko</th>
                                        <th>Jumlah Stok</th>
                                        <th>Rekapitulasi Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if (is_array($stocklist)) {
                                        foreach ($stocklist as $row) {
                                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['TYPE_PRODUCT'] . '-' . $row['ID_PRODUCT']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_PRODUCT']?>
                                        </td>
                                        <td>
                                            <?php echo $row['NAME_VENDOR']?>
                                        </td>
                                        <td>
                                            <?php echo $row['STOCK_PRODUCT']?>
                                        </td>
                                        <td>
                                            <button type="submit"
                                                onclick="(function(){window.location.href = '<?php echo site_url('Stock/stockRecapitulationView/'.$row['TYPE_PRODUCT'].'-'.$row['ID_PRODUCT'].'-'.$row['NAME_VENDOR'])?>';})()"
                                                formtarget="_blank"
                                                style="width:50%; margin-left: auto; margin-right:auto"
                                                class="btn btn-block btn-success btn-xs">
                                                <i style="margin-left: auto; margin-right: auto"
                                                    class="fa fa-fw fa-list"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else if (!is_array($stocklist)) {
                                        ?>
                                    <tr>
                                        <td valign="top" colspan="9" class="dataTables_empty">
                                            <?php echo $stocklist?>
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
                                        <th>Nama Toko</th>
                                        <th>Jumlah Stok</th>
                                        <!-- <th>Stok Masuk</th>
                                        <th>Stok Transfer</th>
                                        <th>Stok Repack/Menyusut</th>
                                        <th>Stok Rusak/Expired</th> -->
                                        <th>Stok Detail</th>
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