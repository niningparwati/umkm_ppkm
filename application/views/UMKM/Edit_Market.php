<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Produk
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
            <form role="form" id="edit" action="<?= $action?>/<?= $market->id_market?>" method="post" enctype="multipart/form-data" >
              <div class="box-body">
                <div class="form-group">
                  <label for="namaProduk">Nama Market</label>
                  <input type="text" name="nama_market" class="form-control" value="<?=$market->nama_market?>">
                    <?php echo form_error('nama_market'); ?>
                </div>
                <div class="form-group">
                  <label for="keterangan">Alamat</label>
                  <input type="text" name="alamat" class="form-control" value="<?=$market->alamat_market ?>">
                   <?php echo form_error('alamat'); ?>
                </div>
                <div class="form-group">
                  <label for="harga">Link</label>
                  <input type="text" name="link" class="form-control" value="<?=$market->link_market ?>">
                   <?php echo form_error('link'); ?>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="<?= base_url()?>UMKM/Market" class="btn btn-danger"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                <input name="id_umkm" type="hidden" value="<?=$market->id_umkm?>">
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
          <p>Anda yakin ingin mengubah data <?=$market->nama_market?> ?</p>
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