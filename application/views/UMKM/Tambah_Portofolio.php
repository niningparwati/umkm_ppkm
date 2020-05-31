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
                  <input type="text" name="judul_portofolio" class="form-control" id="Judul" required>
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Unggah Foto Portofolio</label>
                  <input type="file" name="foto_portofolio" class="form-control" id="Foto">
                </div>       
                <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label><br>
                  <textarea name="keterangan" id="Keterangan" style="height: 100px; width: 100%" required></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tempat</label>
                  <input type="text" name="alamat" class="form-control" id="Tempat" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="Tanggal" required>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <a href="<?= base_url()?>UMKM/TampilPortofolio/<?= $id_umkm ?>" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                  <a class="btn btn-primary pull-right" data-toggle="modal" href="#" data-target="#addData">Simpan</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>

    <div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Tambah Portofolio</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menambah portofolio?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
            <button type="submit" class="btn btn-primary" form="tambah">Iya</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

  </body>
  </html>