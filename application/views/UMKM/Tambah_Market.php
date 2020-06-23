<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Produk
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" id="tambah" action="<?= $action?>" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="namaProduk">Nama Market</label>
                  <input type="text" name="nama_market" class="form-control" value="<?php echo set_value('nama_market'); ?>">
                  <?php echo form_error('nama_market'); ?>
                </div>
                <div class="form-group">
                  <label for="fotoProduk">Alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?php echo set_value('alamat'); ?>">
                  <?php echo form_error('alamat'); ?>
                </div>
                <div class="form-group">
                  <label for="keterangan">Link</label>
                  <input type="text" name="link" class="form-control" value="<?php echo set_value('link'); ?>">
                  <?php echo form_error('link'); ?>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Market" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <button type="submit"  class="btn btn-primary pull-right">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

</body>
</html>