<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Portofolio
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
            <form role="form" id="edit" action="<?= base_url()?>UMKM/UpdatePortofolio/<?= $tampil->id_portofolio ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4">
                       <div class="form-group">
                          <label for="fotoProduk">Foto Portofolio</label><br>
                          <?php if ($tampil->foto_portofolio) { ?>
                            <img src="<?= base_url()?>assets/foto_portofolio/<?=$tampil->foto_portofolio?>" width='200px'><br><br>
                            <input name="foto_old" type="hidden" value="<?=$tampil->foto_portofolio?>">
                            <input type="file" name="foto_portofolio" class="form-control">
                          <?php }else{?>
                            <br>
                            <b>(foto portofolio belum ada. silahkan tambahkan foto)</b><br><br>
                            <input type="file" name="foto_portofolio" class="form-control">
                          <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-8">
                        <div class="form-group">
                          <label for="exampleInputUjudl">Judul</label>
                          <input type="text" name="judul_portofolio" class="form-control" id="Judul" value="<?= $tampil->judul_portofolio ?>">
                          <?php echo form_error('judul_portofolio'); ?>
                        </div>
                     
                        <div class="form-group">
                          <label for="exampleInputKeterangan">Keterangan</label><br>
                          <textarea name="keterangan" style="height: 150px; width: 100%" class="form-control"><?= $tampil->keterangan?></textarea>
                          <?php echo form_error('keterangan'); ?>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputTempat">Tempat</label>
                          <input type="text" name="alamat" class="form-control" id="Tempat" value="<?= $tampil->alamat ?>">
                          <?php echo form_error('alamat'); ?>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputTanggal">Tanggal</label>
                          <input type="date" name="tanggal" class="form-control" id="Tanggal" value="<?= $tampil->tanggal ?>">
                           <?php echo form_error('tanggal'); ?>
                        </div>
                  </div>
                  
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="id_portofolio" class="form-control" id="id_portofolio" value="<?= $tampil->id_portofolio ?>">
                <a href="<?= base_url()?>UMKM/TampilPortofolio/<?= $id_umkm ?>" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <a class="btn btn-primary pull-right" data-toggle="modal" href="#" data-target="#editData">Update</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin mengubah data portofolio?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary" form="edit">Iya</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

</body>
</html>