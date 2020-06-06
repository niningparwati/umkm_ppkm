<?php $this->load->view('admin/head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Akun
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Transaksi</li>
        <li class="active"> Transaksi Produk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Transaksi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Konsumen</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah Produk</th>
              <th>Tanggal Transaksi</th>
              <th>Total</th>
              <th>Bukti Pembayaran</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $n = 1;
              foreach ($transaksi as $u): ?>
            <tr>
              <td><?php echo $n++ ?></td>
              <td><?php echo $u->nama_konsumen ?></td>
              <td><?php echo $u->nama_produk ?></td>
              <td><?php echo $u->harga_produk ?></td>
              <td><?php echo $u->jumlah_produk ?></td>
              <td><?php echo $u->tanggal_transaksi ?></td>
              <td><?php echo $u->total_harga ?></td>
              <td>
                <a class="btn btn-info" data-toggle="modal" href="#" data-target="#bukti<?=$u->id_transaksi?>">
                  <i class="fa fa-fw fa-camera"></i> Bukti
                </a>
              </td>
              <td><?php echo $u->status?></td>
              <td>
                <?php if ($u->status == 'diproses'){ ?>
                  <a class="btn btn-danger" href="<?=base_url()?>Admin/updateBatal/<?=$u->id_transaksi?>">
                      <i class="fa fa-fw fa-minus-square"></i> Batalkan
                  </a>
                <?php }else if ($u->status =='diterima'){?>
                <?php echo 'terkirim pada konsumen';
                        }else if ($u->status =='menunggu konfirmasi'){?>
                      <a class="btn btn-primary" href="<?=base_url()?>Admin/updateDiproses/<?=$u->id_transaksi?>">
                          <i class="fa fa-fw fa-check-square"></i> Approval
                      </a>
                  <?php }else if ($u->status =='menunggu pembayaran'){
                        echo 'belum dibayar';
                        }else if ($u->status =='ditolak'){?>
                          <a class="btn btn-primary" href="<?=base_url()?>Admin/updateDiproses/<?=$u->id_transaksi?>">
                              <i class="fa fa-fw fa-check-square"></i> Approval
                          </a>
                  <?php
                  }else {
                    echo 'diproses UMKM';
                  } ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <script type="text/javascript">
          $('#dataTable').DataTable();
        </script>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('admin/footer') ?>
</div>
<!-- ./wrapper -->

<!-- ini bagian buka hapus -->
<?php foreach ($transaksi as $s) { ?>
<div class="modal fade" id="hapus<?=$s->id_transaksi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Konfirmasi Hapus</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <p>Anda Yakin Akan Menghapus <?= $s->nama_transaksi ?>?</p>
   </div>
   <div class="modal-footer justify-content-between">
     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tidak</button>
     <a href="<?= site_url()?>Admin/hapusUMKM/<?= $s->id_transaksi ?>" class="btn btn-danger">Iya</a>
   </div>
 </div>
 <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>

<!-- ini bagian buka bukti -->
<?php foreach ($transaksi as $key) { ?>
<div class="modal fade" id="bukti<?=$key->id_transaksi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Bukti Pembayaran</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   <div class="modal-body">
     <?php if($key->bukti_pembayaran == NULL){
       echo "<h5>Bukti pembayaran belum ada</h5>";
     }else{?>
    <img src="<?=base_url()?>assets/foto_bukti/<?= $key->bukti_pembayaran ?>" width="300px">
  <?php } ?>
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