<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Portofolio</h3><br><br>
                <td>
                  <a href="<?= base_url()?>UMKM/TambahPortofolio/<?= $id_umkm ?>">
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
                      <th style="text-align: center; width: 10%">No</th>
                      <th style="text-align: center">Judul</th>
                      <th style="text-align: center">Foto</th>
                      <th style="text-align: center">Keterangan</th>
                      <th style="text-align: center">Tempat</th>
                      <th style="text-align: center">Tanggal</th>
                      <th style="text-align: center; width: 20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($tampil as $value) {?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->judul_portofolio ?></td>
                        <td>
                          <?php if ($value->foto_portofolio) { ?>
                            <img src="<?= base_url()?>assets/foto_portofolio/<?= $value->foto_portofolio ?>" style="width: 100px">
                          <?php }else{ ?>
                            <img src="<?= base_url()?>assets/foto_portofolio/portofolio.png" style="width: 100px">
                          <?php } ?>
                        </td>
                        <td><?= $value->keterangan ?></td>
                        <td><?= $value->alamat ?></td>
                        <td><?= $value->tanggal ?></td>
                 <!--        <td style="text-align: center">
                          <a href="<?= base_url()?>UMKM/DetailPortofolio/<?= $value->id_portofolio ?>">
                            <button class="btn btn-info">
                              <div><i class="fa fa-fw fa-eye"></i>Detail</div>
                            </button>
                          </a>
                        </td> -->
                        <td style="text-align: center">
                          <a href="<?= base_url()?>UMKM/EditPortofolio/<?= $value->id_portofolio ?>">
                            <button class="btn btn-warning">
                              <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                            </button>
                          </a>
                          <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$value->id_portofolio?>">
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
  <div class="modal fade" id="hapus<?=$key->id_portofolio?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menghapus Portofolio <b><?= $key->judul_portofolio ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/HapusPortofolio/<?= $key->id_portofolio ?>" class="btn btn-danger">Iya</a>
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