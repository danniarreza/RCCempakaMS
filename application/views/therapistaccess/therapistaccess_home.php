<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Akses Therapist
            <!-- <small>advanced tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('TherapistAccess/')?>"><i class="fa fa-dashboard"></i>Therapist</a></li>
            <li class="active">Hak Akses Therapist</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Hak Akses</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="therapisttable" class="table table-bordered table-striped">
                                <form role="form"
                                    action="<?php echo site_url('TherapistAccess/therapistaccessAddHandler');?>"
                                    method="post" enctype="multipart/form-data">
                                    <thead>
                                        <tr>
                                            <th>Kode Therapist</th>
                                            <th>Nama Therapist</th>
                                            <?php
                                        foreach ($vendorslist as $vendor) {
                                            ?>
                                            <th><?php echo $vendor['NAME_VENDOR']?></th>
                                            <?php
                                        }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    foreach ($therapistslist as $therapist) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $therapist['ID_USER']?>
                                            </td>
                                            <td>
                                                <?php echo $therapist['NAME_USER']?>
                                            </td>

                                            <?php
                                        foreach ($vendorslist as $vendor) {
                                            ?>
                                            <td style="text-align:center">
                                                <input
                                                    onclick="uservisibilitySubmitAttempt('uv_<?php echo $therapist['ID_USER'] .'_'. $vendor['ID_VENDOR']?>')"
                                                    name="uv_<?php echo $therapist['ID_USER'] .'_'. $vendor['ID_VENDOR']?>"
                                                    id="uv_<?php echo $therapist['ID_USER'] .'_'. $vendor['ID_VENDOR']?>"
                                                    value="<?php echo $therapist['ID_USER'] .'-'. $vendor['ID_VENDOR']?>"
                                                    type="checkbox" <?php 
                                                    foreach ($uservisibilitylist as $uv) {
                                                        if($uv['ID_USER'] == $therapist['ID_USER'] && $uv['ID_VENDOR'] == $vendor['ID_VENDOR']){
                                                            echo 'checked';
                                                        }

                                                    }
                                                ?>>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Kode Therapist</th>
                                            <th>Nama Therapist</th>
                                            <?php
                                        foreach ($vendorslist as $vendor) {
                                            ?>
                                            <th><?php echo $vendor['NAME_VENDOR']?></th>
                                            <?php
                                        }
                                        ?>
                                        </tr>
                                    </tfoot>
                                </form>
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
function uservisibilitySubmitAttempt(params) {

    var clickedInput = document.getElementById(params);
    var id_user = clickedInput.value.split('-')[0];
    var id_vendor = clickedInput.value.split('-')[1];

    var data = new FormData();

    data.append('id_user', id_user);
    data.append('id_vendor', id_vendor);

    var method = 'POST';
    var url = "<?php echo site_url('TherapistAccess/therapistaccessAddHandler/');?>";

    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onload = function() {

        console.log(this.responseText);

        // var response = JSON.parse(this.responseText);
        // console.log(response);

    };
    xhr.send(data);



}
</script>