  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              500 Error Page
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Examples</a></li>
              <li class="active">500 error</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">


          <div class="error-content">
              <h3><i class="fa fa-warning text-red"></i> Oops! Ada kesalahan sistem.</h3>

              <p>
                  <?php echo $error_message;?>
              </p>
          </div>
          <!-- /.error-page -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->