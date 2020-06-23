<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Informasi
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
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" id="tambah" action="<?= $action?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="Judul">Judul</label>
                  <input type="text" name="judul" class="form-control" value="<?php echo set_value('judul'); ?>">
                  <?php echo form_error('judul'); ?>
                </div>
                <div class="form-group">
                  <label for="Konten">Konten</label>
                   <textarea name="konten" id="Keterangan" style="height: 100px; width: 100%" class="form-control">
                    <?php echo set_value('konten'); ?>
                  </textarea>
                   <?php echo form_error('konten'); ?>      
                </div>
                <div class="form-group">
                  <label for="Gambar">Gambar</label>
                  <input type="file" name="gambar" class="form-control">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Informasi" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
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