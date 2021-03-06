<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Promo</h3><br><br>
                <td>
                  <a href="<?= base_url()?>UMKM/TambahPromo">
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
                      <th style="text-align: center;">Nama Promo</th>
                      <th style="text-align: center;">Kode Promo</th>
                      <th style="text-align: center;">Besar Promo (%)</th>
                      <th style="text-align: center;">Detail</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;width: 20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($tampil as $value) { ?>
                      <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td><?= $value->nama_promo ?></td>
                        <td style="text-align: center;"><b><?= $value->kode_promo ?></b></td>
                        <td style="text-align: center;"><?= $value->besar_promo ?> %</td>
                        <td style="text-align: center;">
                          <a class="btn btn-success" data-toggle="modal" href="#" data-target="#detail<?=$value->id_promo?>">
                              <i class="fa fa-fw fa-eye"></i> Lihat Konten
                          </a>  
                        </td>
                        <td style="text-align: center;">
                            <?php
                                if ($value->status_promo=='tidak aktif') {
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
                          <a href="<?= base_url()?>UMKM/EditPromo/<?= $value->id_promo ?>">
                            <button class="btn btn-warning">
                              <div><i class="fa fa-fw fa-pencil"></i>Edit</div>
                            </button>
                          </a>
                          <?php 
                            if($value->status_promo!='tidak aktif'){
                          ?>
                            <a class="btn btn-danger" data-toggle="modal" href="#" data-target="#nonAktifkan<?=$value->id_promo?>">
                              <i class="fa fa-fw fa-eye"></i> Non-aktifkan
                            </a>
                          <?php
                            }else{
                          ?>
                             <a class="btn btn-primary" data-toggle="modal" href="#" data-target="#aktifkan<?=$value->id_promo?>">
                              <i class="fa fa-fw fa-eye"></i> Aktifkan
                            </a>
                          <?php
                            }
                          ?>
                         
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
  <div class="modal fade" id="detail<?=$key->id_promo?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Detail Promo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="font-size: 20px">
            <b>Besar Promo :</b> <?= $key->besar_promo ?> % <br>
            <b>Minimal Belanja :</b> Rp <?= number_format($key->minimal_belanja) ?> <br>
            <b>Maksimal Potongan :</b> Rp <?= number_format($key->maksimum_potongan) ?> <br>
            <b>Status Promo :</b> <?= $key->status_promo ?> <br>
            <b>Berlaku sampai :</b> <?php $time = strtotime($key->berlaku_sampai); echo date('d F Y',$time); ?><br>
            <b>Foto Promo :</b><br>
            <?php if ($key->foto_promo) { ?>
                            <img src="<?= base_url()?>assets/foto_promo/<?=$key->foto_promo?>" width='100px'>
            <?php }else{?>
                            (foto promo belum ada. silahkan tambahkan foto)
            <?php } ?>
          </p>
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

<?php foreach ($tampil as $key) { ?>
  <div class="modal fade" id="nonAktifkan<?=$key->id_promo?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Non AKtif</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Menonaktifkan Promo <b><?= $key->nama_promo ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/Aktivasi_Promo/<?= $key->id_promo ?>/0" class="btn btn-danger">Iya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<?php foreach ($tampil as $key) { ?>
  <div class="modal fade" id="aktifkan<?=$key->id_promo?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Aktivasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda Yakin Ingin Mengaktifkan Promo <b><?= $key->nama_promo ?></b> ?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
          <a href="<?= site_url()?>UMKM/Aktivasi_Promo/<?= $key->id_promo ?>/1" class="btn btn-danger">Iya</a>
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