<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Produk</h3><br><br>
                <td>
                  <a href="<?= base_url()?>UMKM/TambahProduk">
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
                      <th style="text-align: center;">Nama Produk</th>
                      <th style="text-align: center;">Foto</th>
                      <th style="text-align: center;">Deskripsi</th>
                      <th style="text-align: center;width: 15%">Harga</th>
                      <th style="text-align: center;">Kategori Produk</th>
                      <th style="text-align: center;width: 18%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($tampil as $value) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value->nama_produk ?></td>
                        <td style="text-align: center">
                          <?php 
                          if (!$value->foto_produk) { ?>
                           <img src="<?= base_url()?>assets/foto_produk/produk.png" width='50px'>
                         <?php } else { ?>
                          <img src="<?= base_url()?>assets/foto_produk/<?=$value->foto_produk ?>"  width='50px'>
                        <?php } ?>
                      </td>
                      <td><?= $value->deskripsi_produk ?></td>
                      <td>Rp <?= number_format($value->harga_produk,2,',','.') ?></td>
                      <td><?= $value->nama_kategori_produk ?></td>
  <!--                         <td style="text-align: center">
                          <a href="<?= base_url()?>UMKM/DetailProduk/<?= $value->id_produk ?>">
                            <button class="btn btn-success">
                              <div><i class="fa fa-fw fa-eye"></i>Lihat</div>
                            </button>
                          </a>
                        </td> -->
                        <td style="text-align: center">
                          <a href="<?= base_url()?>UMKM/EditProduk/<?= $value->id_produk ?>">
                            <button class="btn btn-warning">
                              <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                            </button>
                          </a>
                          <!-- <a href="<?= base_url()?>UMKM/HapusProduk/<?= $value->id_produk ?>">
                            <button class="btn btn-danger">
                              <div><i class="fa fa-fw fa-trash"></i>Hapus</div>
                            </button>
                          </a> -->
                          <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#hapus<?=$value->id_produk?>">
                            <i class="fa fa-fw fa-trash"></i> Hapus
                          </a>
                        </td>
                      </tr>
                    <?php }?>
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
  <div class="modal fade" id="hapus<?=$key->id_produk?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menghapus Produk UMKM <b><?= $key->nama_produk ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/HapusProduk/<?= $value->id_produk ?>" class="btn btn-danger">Iya</a>
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