<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Banner</h3><br><br>
                <td>
                 
                    <button class="btn btn-primary" type="button" data-toggle="modal" href="#" data-target="#tambahBanner<?=$id_umkm?>">
                      <div><i class="fa fa-fw fa-plus"></i>Tambah Data</div>
                    </button>
                  
                </td>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?= $this->session->flashdata('notif')?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 3%">No</th>
                      <th style="text-align: center">Banner</th>
                      <th style="text-align: center">Nama Banner</th>
                      <th style="text-align: center;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($tampil as $value) {?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td style="text-align: center">                          
                            <img src="<?= base_url()?>assets/foto_banner/<?= $value->foto_banner ?>" style="width: 100px">                          
                        </td>
                        <td><?= $value->nama_banner ?></td>
                        <td style="text-align: center">
                          <a class="btn btn-warning" data-toggle="modal" href="#" data-target="#edit<?=$value->id_banner?>">
                            <i class="fa fa-fw fa-pencil"></i> Edit
                          </a>
                          <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$value->id_banner?>">
                            <i class="fa fa-fw fa-trash"></i> Hapus
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
  </div>
  <!-- /.content-wrapper -->



  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <?php foreach ($tampil as $key) { ?>
  <div class="modal fade" id="hapus<?=$key->id_banner?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menghapus Banner ini?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/HapusBanner/<?= $value->id_banner ?>" class="btn btn-danger">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

 <div class="modal fade" id="tambahBanner<?=$id_umkm?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="ExampleModalLabel">Tambah Banner</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form role="form" id="tambah" action="<?= base_url()?>UMKM/CreateBanner/<?= $id_umkm ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="">Tambah Foto Banner</label>
                      <input type="file" name="foto" id="Foto" required="">
                    </div>
                    <div class="form-group">
                      <label for="">Nama Banner</label>
                      <input type="text" name="nama_banner" required="" class="form-control" required="">
                    </div>     
                  </div>        
                    <!-- /.box-body -->
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batalkan</button>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


<?php foreach ($tampil as $key) { ?>
  <div class="modal fade" id="edit<?=$key->id_banner?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="ExampleModalLabel">Edit Banner</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <form role="form" id="tambah" action="<?= base_url()?>UMKM/EditBanner/<?= $key->id_banner ?>" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <img src="<?= base_url()?>assets/foto_banner/<?=$key->foto_banner?>" width='100px'><br><br>
                      <label for="">Edit Foto Banner</label>
                      <input type="file" name="foto" id="Foto">
                      <input name="banner_old" type="hidden" value="<?=$key->foto_banner?>">
                    </div>
                    <div class="form-group">
                      <label for="">Nama Banner</label>
                      <input type="text" name="nama_banner" required="" class="form-control" value="<?php echo $key->nama_banner ?>">
                    </div>     
                  </div>        
                    <!-- /.box-body -->
               
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batalkan</button>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
            </div>
         </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>
</body>
</html>