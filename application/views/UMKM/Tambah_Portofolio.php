<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah Portofolio
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
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <form role="form" id="tambah" action="<?= $action?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Judul</label>
                  <input type="text" name="judul_portofolio" class="form-control" id="Judul" value="<?php echo set_value('judul_portofolio'); ?>">
                    <?php echo form_error('judul_portofolio'); ?>
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Unggah Foto Portofolio</label>
                  <input type="file" name="foto_portofolio" class="form-control" id="Foto">
                </div>       
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label><br>
                  <textarea name="keterangan" id="Keterangan" style="height: 100px; width: 100%" class="form-control">
                    <?php echo set_value('keterangan'); ?>
                  </textarea>
                   <?php echo form_error('keterangan'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tempat</label>
                  <input type="text" name="alamat" class="form-control" id="Tempat" value="<?php echo set_value('alamat'); ?>">
                    <?php echo form_error('alamat'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="Tanggal"  value="<?php echo set_value('tanggal'); ?>">
                    <?php echo form_error('tanggal'); ?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <a href="<?= base_url()?>UMKM/TampilPortofolio/<?= $id_umkm ?>" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
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