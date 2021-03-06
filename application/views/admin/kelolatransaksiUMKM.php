<?php $this->load->view('admin/Head') ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php $this->load->view('admin/Header') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->load->view('admin/Sidebar') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Transaksi
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Kelola Transaksi</li>
        <li class="active"> Transaksi UMKM</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Transaksi UMKM</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <p>**uang yang harus dikirimkan pada UMKM</p>
          <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama UMKM</th>
              <th>Nama Produk</th>
              <th>Jumlah Produk</th>
              <th>Total</th>
              <th>Detail</th>
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
              <td><?php echo $u->nama_umkm ?></td>
              <td><?php echo $u->nama_produk ?></td>
              <td><?php echo $u->jumlah_produk ?></td>
              <td><?php echo $u->jumlah_harga ?></td>
              <td>
                <a class="btn btn-info" data-toggle="modal" href="#" data-target="#detail<?=$u->id_transaksi?>">
                  <i class="fa fa-fw fa-camera"></i> Detail
                </a>
              </td>
              <td>
                <?php
                if ($u->status == 'diterima') {
                  echo 'dana belum dikirim';
                }else if($u->status){
                  echo $u->status;
                }?>
              </td>
              <td>
                <?php if ($u->status == 'diterima'){ ?>
                  <a class="btn btn-default" href="<?=base_url()?>Admin/updateTerkirim/<?=$u->id_transaksi?>">
                      <i class="fa fa-fw fa-money"></i> Kirim Uang
                  </a>
                  <?php
                }else if ($u->status == 'dana dikirim'){ ?>
                  <a class="btn btn-danger" href="<?=base_url()?>Admin/updateBlmTerkirim/<?=$u->id_transaksi?>">
                      <i class="fa fa-fw fa-minus-square"></i>  Batalkan
                  </a>
              <?php }else if($u->status == 'selesai'){
                echo 'terkirim';
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

  <?php $this->load->view('admin/Footer') ?>
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

<!-- ini bagian detail barang dibeli -->
<?php foreach ($transaksi as $key) { ?>
<div class="modal fade" id="detail<?=$key->id_transaksi?>" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="ExampleModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <h4 class="modal-title" id="ExampleModalLabel">Detail Transaksi ID <?=$key->id_transaksi?></h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     <div class="" style="float:right;color:red;margin-top:20px">
       <p style=""><?=$key->tanggal_transaksi ?></p>
     </div>
   </div>

   <div class="modal-body">
      <table border="1" cellpadding="10" width="100%" class="table table-bordered">
        <tr>
          <td>Detail barang yang Diorder</td>
          <td>:</td>
          <td>
            <?php $ini = $this->M_admin->iniprodukk($key->id_transaksi,$key->nama_umkm);
              foreach ($ini as $e) { ?>
                <ul>
                  <li>
                      <img src="<?=base_url()?>assets/foto_produk/<?php echo $e->foto_produk ?>" width="100px"><br>
                      <p><?php echo $e->nama_produk ?> - <span style="color:red"><?php echo $e->harga_produk ?></span></p>
                  </li>
                </ul>
              <?php } ?>
          </td>
        </tr>
        <tr>
          <td>Total Bayar</td>
          <td>:</td>
          <td> <b style="color:red"><?php echo "Rp ".number_format($key->jumlah_harga) ?></b> </td>
        </tr>
        <tr>
          <td>Status Order</td>
          <td>:</td>
          <td><?php echo $key->status ?></td>
        </tr>
      </table>
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
