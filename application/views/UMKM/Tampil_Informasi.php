<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Informasi</h3><br><br>
                <td>
                  <a href="<?= base_url()?>UMKM/TambahInformasi">
                    <button class="btn btn-primary" type="button">
                      <div><i class="fa fa-fw fa-plus"></i>Tambah Data</div>
                    </button>
                  </a>
                </td>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?= $this->session->flashdata('notif')?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="text-align: center; width: 3%">No</th>
                      <th style="text-align: center; width: 10%">Judul</th>
                      <th style="text-align: center; width: 10%">Konten</th>
                      <th style="text-align: center; width: 10%">Gambar</th>
                      <th style="text-align: center; width: 1%">Status</th>
                      <th style="text-align: center; width: 15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($informasi as $value) {?>
                      <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= $value->judul_informasi ?></td>
                        <td  style="text-align: center;">
                           <a class="btn btn-success" data-toggle="modal" href="#" data-target="#konten<?=$value->id_informasi?>">
                            <i class="fa fa-fw fa-eye"></i> Lihat Konten
                           </a>  
                        </td>
                        <td style="text-align: center">
                          <?php 
                          if (!$value->gambar) { ?>
                           <img src="<?= base_url()?>assets/foto_informasi/informasi.png" width='50px'>
                         <?php } else { ?>
                          <img src="<?= base_url()?>assets/foto_informasi/<?=$value->gambar ?>"  width='50px'>
                        <?php } ?>
                      </td>
                      <td style="text-align: center;">
                        <?php
                                if ($value->status_informasi=='tidak aktif') {
                            ?>
                                  <small class="label bg-red"><?php echo "Tidak Aktif"; ?></small>
                            <?php
                                }
                                else {
                            ?>
                                 <small class="label bg-green"><?php echo "Aktif"; ?></small>
                            <?php
                                }              
                            ?>
                      </td>
                      <td style="text-align: center">

                        <?php if ($value->status_informasi == 'tidak aktif') {?>
                          <a class="btn btn-success" data-toggle="modal" href="#" data-target="#aktifkan<?=$value->id_informasi?>" style="width: 100px">
                            Aktifkan
                          </a>
                        <?php }elseif ($value->status_informasi == 'aktif') { ?>
                          <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#nonAktifkan<?=$value->id_informasi?>">
                            Non Aktifkan
                          </a>
                        <?php } ?>
                        <a href="<?= base_url()?>UMKM/editInformasi/<?= $value->id_informasi ?>">
                          <button class="btn btn-warning">
                            <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                          </button>
                        </a>
                        <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$value->id_informasi?>">
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

 <?php foreach ($informasi as $key) { ?>
  <div class="modal fade" id="konten<?=$key->id_informasi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konten Informasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p><?= $key->isi_informasi ?></p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

 <?php foreach ($informasi as $key) { ?>
  <div class="modal fade" id="hapus<?=$key->id_informasi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menghapus Informasi <b><?= $key->judul_informasi ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/HapusInformasi/<?= $key->id_informasi ?>" class="btn btn-danger">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<?php foreach ($informasi as $key) { ?>
  <div class="modal fade" id="nonAktifkan<?=$key->id_informasi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Non AKtif</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menonaktifkan <b><?= $key->judul_informasi ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/Aktifasi/<?= $key->id_informasi ?>/0" class="btn btn-danger">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<?php foreach ($informasi as $key) { ?>
  <div class="modal fade" id="aktifkan<?=$key->id_informasi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Aktivasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Mengaktifkan <b><?= $key->judul_informasi ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/Aktifasi/<?= $key->id_informasi ?>/1" class="btn btn-danger">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

</body>
</html>